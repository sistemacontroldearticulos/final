package com.proyecto.aplicacion;


import android.content.Intent;
import android.os.Bundle;
import android.support.constraint.ConstraintLayout;

import android.support.v4.app.Fragment;
import android.support.v4.view.animation.FastOutLinearInInterpolator;
import android.support.v4.view.animation.LinearOutSlowInInterpolator;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.AnimationSet;
import android.view.animation.AnimationUtils;
import android.view.animation.LayoutAnimationController;
import android.view.animation.TranslateAnimation;
import android.widget.FrameLayout;
import android.widget.ImageView;

import android.widget.TextView;
import com.tomer.fadingtextview.FadingTextView;



/**
 * A simple {@link Fragment} subclass.
 */
public class Inicio extends Fragment {
    View view;
    ImageView muñeco;
    Thread splashTread;
    TextView txtBienvenida;
    TextView txtInfo;
    TextView txtDeslice;


    public Inicio() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment


        view = inflater.inflate(R.layout.fragment_inicio, container, false);
        inicializar();

        txtBienvenida.setText("Bienvenido(a)\n"+Login.iniciarSesionJson.get(0).getNombreusuario());





        Animation anim = AnimationUtils.loadAnimation(getContext(), R.anim.alpha);
        anim.reset();
        ConstraintLayout C= view.findViewById(R.id.fondoInicio);
        C.clearAnimation();
        C.startAnimation(anim);

        anim = AnimationUtils.loadAnimation(getContext(), R.anim.translate);
        anim.reset();
        ImageView iv = (ImageView) view.findViewById(R.id.muñeco);
        iv.clearAnimation();
        iv.startAnimation(anim);
        txtBienvenida.startAnimation(anim);
        txtInfo.setAnimation(anim);
        txtDeslice.setAnimation(anim);

        splashTread = new Thread() {
            @Override
            public void run() {
                try {
                    int waited = 0;
                    // Splash screen pause time
                    while (waited < 2000) {
                        sleep(100);
                        waited += 100;
                    }
                    //abrirSesion();

                } catch (InterruptedException e) {
                    // do nothing
                } finally {

                }

            }
        };
        splashTread.start();

        return  view;
    }

    private void inicializar() {
        muñeco=view.findViewById(R.id.muñeco);
        txtBienvenida=view.findViewById(R.id.txtBienvenida);
        txtDeslice=view.findViewById(R.id.txtDeslice);
        txtInfo=view.findViewById(R.id.txtInfo);
    }

}
