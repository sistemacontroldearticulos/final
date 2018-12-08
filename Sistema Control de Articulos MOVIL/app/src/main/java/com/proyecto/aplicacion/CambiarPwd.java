package com.proyecto.aplicacion;


import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.proyecto.aplicacion.Modelo.IniciarSesionJson;

import java.lang.reflect.Type;
import java.util.HashMap;
import java.util.List;
import java.util.Map;


/**
 * A simple {@link Fragment} subclass.
 */
public class CambiarPwd extends Fragment {

    View view;
    TextView txtContraActual;
    TextView txtContraNueva;
    TextView txtConfirmacion;
    Button btnCambiarContra;
    RequestQueue queue;
    String contraActual;
    String nuevaContra;
    String confirmaContra;
    ProgressBar progressBar;
    Gson gson = new Gson();
    String nueva;


    public CambiarPwd() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        view= inflater.inflate(R.layout.fragment_cambiar_pwd, container, false);

        inicializar();
        progressBar.setVisibility(View.INVISIBLE);

        btnCambiarContra.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                progressBar.setVisibility(View.VISIBLE);
                getActivity().getWindow().setFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE,
                        WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                getActivity().getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

                contraActual=txtContraActual.getText().toString();
                nuevaContra=txtContraNueva.getText().toString();
                confirmaContra=txtConfirmacion.getText().toString();

                if(contraActual.equals(""))
                {
                    txtContraActual.setError("Debe ingresar su contraseña actual");
                    progressBar.setVisibility(View.INVISIBLE);
                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                }
                if(nuevaContra.equals(""))
                {
                    txtContraNueva.setError("Debe ingresar una nueva contraseña");
                    progressBar.setVisibility(View.INVISIBLE);
                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                }
                if (confirmaContra.equals(""))
                {
                    txtConfirmacion.setError("Debe confirmar la nueva contraseña");
                    progressBar.setVisibility(View.INVISIBLE);
                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                }
                else
                {
                    if(!Login.iniciarSesionJson.get(0).getContraseniausuario().equals(Login.encriptar(contraActual)))
                    {
                        txtContraActual.setError("Contraseña actual incorrecta");
                        progressBar.setVisibility(View.INVISIBLE);
                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                    }
                    else
                    {
                        if(nuevaContra.equals(confirmaContra))
                        {
                            nueva=Login.encriptar(nuevaContra);
                            String url=Constants.url+"cambiarPwd/"+Login.iniciarSesionJson.get(0).getNumdocumentousuario();
                            StringRequest request = new StringRequest(Request.Method.PUT, url, new Response.Listener<String>() {
                                @Override
                                public void onResponse(String response) {
                                    Toast.makeText(getContext(), "Contraseña cambiada correctamente", Toast.LENGTH_SHORT).show();

                                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                                    actualizar();


                                }
                            }, new Response.ErrorListener() {
                                @Override
                                public void onErrorResponse(VolleyError error) {
                                    Toast.makeText(getContext(), error.toString(), Toast.LENGTH_SHORT).show();
                                    progressBar.setVisibility(View.INVISIBLE);
                                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);


                                }
                            }){
                                @Override
                                public Map<String, String> getParams() {
                                    Map<String, String> params = new HashMap<String, String>();
                                    params.put("contraNueva", nueva);


                                    return params;
                                }
                            };
                            queue.add(request);

                        }
                        else
                        {
                            txtConfirmacion.setError("Las contraseñas no coinciden");
                            progressBar.setVisibility(View.INVISIBLE);
                            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                        }
                    }
                }

            }
        });

        return  view;
    }

    private void actualizar() {

        String url = Constants.url + "login/" + Login.numDocumento + "&" +nueva;


        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {


                        Type type = new TypeToken<List<IniciarSesionJson>>() {
                        }.getType();
                        Login.iniciarSesionJson = gson.fromJson(response, type);




                        progressBar.setVisibility(View.INVISIBLE);
                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                        txtConfirmacion.setText("");
                        txtContraNueva.setText("");
                        txtContraActual.setText("");


                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

                Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                progressBar.setVisibility(View.INVISIBLE);
                getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);


            }
        });
        queue.add(stringRequest);
    }

    private void inicializar() {
        txtConfirmacion=view.findViewById(R.id.confirmarPwd);
        txtContraActual=view.findViewById(R.id.pwdActual);
        txtContraNueva=view.findViewById(R.id.nuevaPwd);
        queue= Volley.newRequestQueue(getContext());
        btnCambiarContra=view.findViewById(R.id.btnCambiarContraseña);
        progressBar= view.findViewById(R.id.progresBarCambioPwd);
    }

}
