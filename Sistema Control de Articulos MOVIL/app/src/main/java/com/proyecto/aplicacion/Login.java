package com.proyecto.aplicacion;


import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.support.constraint.ConstraintLayout;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.text.Editable;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.proyecto.aplicacion.Modelo.ActasJson;
import com.proyecto.aplicacion.Modelo.IniciarSesionJson;

import org.apache.commons.codec.binary.Hex;
import org.apache.commons.codec.digest.DigestUtils;

import java.lang.reflect.Type;
import java.util.ArrayList;
import java.util.List;

public class Login extends AppCompatActivity {
    Button btnLogin;
    AlertDialog.Builder alerta;
    public static ArrayList<IniciarSesionJson> iniciarSesionJson = new ArrayList<>();
    Gson gson = new Gson();
    public static Editable numDocumento;
    RequestQueue queue;
    public static String contras;
    public static ProgressBar progressBar;
    ConstraintLayout contenedorLogin;
    public  static ArrayList<ActasJson> actasJsons = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        progressBar = findViewById(R.id.progressBarLogin);
        progressBar.setVisibility(View.INVISIBLE);
        contenedorLogin=findViewById(R.id.contenedorLogin);


    }

    public void sesion(View view) {

        btnLogin = findViewById(R.id.btnLogin);


        alerta = new AlertDialog.Builder(this);

        final EditText numDocumentoUsuario = findViewById(R.id.txtNumDocumento);
        final EditText pwd = findViewById(R.id.txtPwd);
        String caja1 = numDocumentoUsuario.getText().toString();
        String caja2 = pwd.getText().toString();

        if (caja1.isEmpty()) {
            numDocumentoUsuario.setError("Debe ingresar un número de documento");
        }
        if (caja2.isEmpty()) {
            pwd.setError("Debe ingresar una contraseña");
        } else {

            getWindow().setFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE,
                    WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
            getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

            progressBar.setVisibility(View.VISIBLE);

            numDocumento = numDocumentoUsuario.getText();
            contras = pwd.getText().toString();
            btnLogin.setEnabled(false);

            //CONSULTA LOGIN

            queue = Volley.newRequestQueue(this);
            final String url = Constants.url+"login/"+ numDocumento + "&" + encriptar(contras);


// Request a string response from the provided URL.
            StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {

                            if (response.equals("[]")) {
                                alerta.setTitle("INICIO DE SESIÓN");
                                alerta.setMessage("El número de documento o la contraseña son " +
                                        "incorrectos");
                                alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {

                                        btnLogin.setEnabled(true);
                                        progressBar.setVisibility(View.INVISIBLE);
                                        getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                                        pwd.setText("");

                                        dialog.cancel();


                                    }

                                });

                                alerta.create();
                                alerta.show();

                            } else {
                                Type type = new TypeToken<List<IniciarSesionJson>>() {
                                }.getType();
                                iniciarSesionJson = gson.fromJson(response, type);

                                String url=Constants.url+"loginActas/"+numDocumento;

                                final StringRequest actas = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                                    @Override
                                    public void onResponse(String response) {

                                        Type type = new TypeToken<List<ActasJson>>() {
                                        }.getType();
                                        actasJsons = gson.fromJson(response, type);
                                        Intent intent = new Intent(Login.this,
                                                MainActivity.class);
                                        startActivity(intent);
                                        progressBar.setVisibility(View.INVISIBLE);
                                        Login.this.finish();

                                    }
                                }, new Response.ErrorListener() {
                                    @Override
                                    public void onErrorResponse(VolleyError error) {

                                    }
                                });
                                queue.add(actas);





                            }
                        }
                    }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    btnLogin.setEnabled(true);
                    Toast.makeText(Login.this, "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_LONG).show();
                    progressBar.setVisibility(View.INVISIBLE);
                    getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                }
            });
            queue.add(stringRequest);

        }

    }


    public static String encriptar(String contras) {
        return new String((Hex.encodeHex(DigestUtils.sha512(contras))));
    }


    @Override
    public void onBackPressed() {

        alerta = new AlertDialog.Builder(this);
        alerta.setTitle("INICIO DE SESIÓN");
        alerta.setMessage("¿Está seguro que desea salir de la aplicación?");
        alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {

                finish();
                System.exit(0);
            }

        });
        alerta.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.cancel();
            }
        });

        alerta.create();
        alerta.show();
        //
        // super.onBackPressed();

    }

    public void iniciarSesion() {
        SharedPreferences preferences = getSharedPreferences("sesion", MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        editor.putString("usuario", numDocumento.toString());
        editor.putString("contra", encriptar(contras));
        editor.putString("activado", "Si");
        editor.commit();
    }
}
