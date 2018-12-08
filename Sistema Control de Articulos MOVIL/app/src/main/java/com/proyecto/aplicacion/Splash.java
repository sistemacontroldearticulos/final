package com.proyecto.aplicacion;

import android.app.Activity;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.PixelFormat;
import android.support.constraint.ConstraintLayout;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Window;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;
import android.widget.LinearLayout;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.Timer;
import java.util.TimerTask;

public class Splash extends Activity {

    RequestQueue requestQueue;
    public void onAttachedToWindow() {
        super.onAttachedToWindow();
        Window window = getWindow();
        window.setFormat(PixelFormat.RGBA_8888);
    }
    /** Called when the activity is first created. */
    Thread splashTread;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        TimerTask tarea = new TimerTask() {
            @Override
            public void run() {

                startActivity(new Intent(Splash.this, Login.class));
                finish();


            }
        };
        Timer timer = new Timer();
        timer.schedule(tarea,2000);
    }


    }


   /* public void abrirSesion(){
        final AlertDialog.Builder alerta = new AlertDialog.Builder(Splash.this);
        requestQueue = Volley.newRequestQueue(Splash.this);
        SharedPreferences preferences = getSharedPreferences("sesion",MODE_PRIVATE);
        String numDocumento = preferences.getString("usuario","No existe");
        String contras = preferences.getString("contra","No existe");
        String activado = preferences.getString("activado","No existe");
        if (activado.equals("Si")) {
            String url = "http://b96cadc0.ngrok.io" +
                    "/api/login/" + numDocumento + "&" + contras;
            StringRequest stringRequest = new StringRequest(url, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {

                    if (response.equals("[]")) {
                        Intent intent = new Intent(Splash.this,
                                Login.class);

                        startActivity(intent);
                        Splash.this.finish();

                    }else {

                        Intent intent = new Intent(Splash.this,
                                MainActivity.class);

                        startActivity(intent);
                        Splash.this.finish();

                    }

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {

                }
            });

            requestQueue.add(stringRequest);
        }else {
            Intent intent = new Intent(Splash.this,
                    Login.class);

            startActivity(intent);
            Splash.this.finish();
        }*/


//}