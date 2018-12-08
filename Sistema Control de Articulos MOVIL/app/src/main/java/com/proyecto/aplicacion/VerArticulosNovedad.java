package com.proyecto.aplicacion;

import android.app.Activity;
import android.os.Build;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.transition.Fade;
import android.util.DisplayMetrics;
import android.view.Gravity;
import android.view.Window;
import android.view.WindowManager;

import com.proyecto.aplicacion.Adaptadores.AdapterVerArticulos;
import com.proyecto.aplicacion.Adaptadores.AdapterVerArticulosNovedad;
import com.proyecto.aplicacion.Modelo.IniciarSesionJson;

import org.jetbrains.annotations.Nullable;

import java.util.ArrayList;

public class VerArticulosNovedad extends Activity {

    RecyclerView recyclerArticulos;
    ArrayList<IniciarSesionJson> articulos;
    int item;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);


        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP)
        {
            getWindow().requestFeature(Window.FEATURE_CONTENT_TRANSITIONS);

            getWindow().setEnterTransition(new Fade());
        }





        setContentView(R.layout.popup_novedades);

        DisplayMetrics dm = new DisplayMetrics();

        getWindowManager().getDefaultDisplay().getMetrics(dm);

        int width=dm.widthPixels;
        int height=dm.heightPixels;

        getWindow().setLayout((int)(width*.8),(int)(height*.6));


        WindowManager.LayoutParams params = getWindow().getAttributes();
        params.gravity= Gravity.CENTER;
        params.x=0;
        params.y=0;
        params.width=params.WRAP_CONTENT;
        params.height= params.WRAP_CONTENT;

        item = R.layout.item_list_novedades_recientes;

        articulos = NovedadesRecientes.verNovedades;



        recyclerArticulos = this.findViewById(R.id.recyclerViewArticulos);
        recyclerArticulos.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.VERTICAL, false));
        recyclerArticulos.setHasFixedSize(true);
        AdapterVerArticulos adapterVerArticulos= new AdapterVerArticulos(articulos);
        recyclerArticulos.setAdapter(adapterVerArticulos);





    }
}
