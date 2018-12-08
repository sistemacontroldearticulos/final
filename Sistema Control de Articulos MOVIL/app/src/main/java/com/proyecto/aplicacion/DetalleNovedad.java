package com.proyecto.aplicacion;


import android.app.Dialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.media.Image;
import android.os.Bundle;
import android.support.transition.TransitionInflater;
import android.support.v4.app.ActivityOptionsCompat;
import android.support.v4.app.Fragment;
import android.support.v4.view.ViewCompat;
import android.support.v7.app.AlertDialog;
import android.transition.AutoTransition;
import android.transition.Explode;
import android.transition.Fade;
import android.util.Base64;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;


/**
 * A simple {@link Fragment} subclass.
 */
public class DetalleNovedad extends Fragment {

    TextView txtFicha;
    TextView txtFecha;
    TextView txtTipoArticulo;
    TextView txtTipoNovedad;
    TextView txtEquipo;
    TextView txtJornada;
    TextView txtObservacion;
    ImageView imagenNovedad;
    TextView sinImagen;
    View view;
    Bitmap decodedByte;


    public DetalleNovedad() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        view= inflater.inflate(R.layout.fragment_detalle_novedad, container, false);

        inicializar();
        llenar();

        imagenNovedad.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if(NovedadesRecientes.imagenNovedad.equals(""))
                {
                    Toast.makeText(getContext(), "Ésta no tiene una imagen registrada", Toast.LENGTH_LONG).show();
                }
                else
                {
                    final Dialog dialog = new Dialog(getContext());
                    dialog.setContentView(R.layout.popupimagen);
                    //dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                    ImageView imgpopup=dialog.findViewById(R.id.imgDetalle);
                    imgpopup.setImageBitmap(decodedByte);
                    dialog.getWindow().setSharedElementEnterTransition(new Explode());
                    dialog.getWindow().setSharedElementExitTransition(new Fade());
                    dialog.setCancelable(true);
                    dialog.show();

                }



            }
        });

        return view;




    }

    private void inicializar() {

        txtEquipo=view.findViewById(R.id.txtEquipoDetalle);
        txtFecha=view.findViewById(R.id.txtFechaDetalle);
        txtFicha=view.findViewById(R.id.txtFichaDetalle);
        txtJornada=view.findViewById(R.id.txtJornadaDetalle);
        txtTipoArticulo=view.findViewById(R.id.txtTipoArticuloDetalle);
        txtObservacion=view.findViewById(R.id.txtDescripcionDetalle);
        imagenNovedad=view.findViewById(R.id.imgDetalle);
        sinImagen=view.findViewById(R.id.sinImagen);
        txtTipoNovedad=view.findViewById(R.id.txtTipoNovedadDetalle);

    }

    private void llenar()
    {
        txtObservacion.setText(NovedadesRecientes.observacionnovedad);
        txtTipoArticulo.setText(NovedadesRecientes.tipoArticulo);
        txtJornada.setText(NovedadesRecientes.jornadaFicha);
        txtFicha.setText(NovedadesRecientes.fichaNovedad);
        txtFecha.setText(NovedadesRecientes.fechaNovedad);
        txtEquipo.setText(NovedadesRecientes.equipoNovedad);
        txtTipoNovedad.setText(NovedadesRecientes.tipoNovedad);
        if(NovedadesRecientes.imagenNovedad==null || NovedadesRecientes.imagenNovedad.equals(""))
        {
            sinImagen.setVisibility(View.VISIBLE);
            imagenNovedad.setBackgroundResource(R.drawable.imageviewfondo);

        }
        else
        {
            convertir();
        }


    }

    private void convertir() {

        byte[] decodedString = Base64.decode(NovedadesRecientes.imagenNovedad, Base64.DEFAULT);

        decodedByte = BitmapFactory.decodeByteArray(decodedString, 0, decodedString.length);
        int altura=decodedByte.getHeight();
        int ancho=decodedByte.getWidth();

        if(altura<ancho)
        {
            imagenNovedad.setRotation(0);
            imagenNovedad.setImageBitmap(decodedByte);
        }


    }



}
