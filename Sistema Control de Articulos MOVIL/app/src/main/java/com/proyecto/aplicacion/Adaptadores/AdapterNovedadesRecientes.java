package com.proyecto.aplicacion.Adaptadores;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.proyecto.aplicacion.Modelo.Novedades;
import com.proyecto.aplicacion.R;

import java.util.ArrayList;

/**
 * Created by ADMIN on 25/10/2018.
 */

public class AdapterNovedadesRecientes extends RecyclerView.Adapter<AdapterNovedadesRecientes.Holder> {
    ArrayList<Novedades> iniciarSesionJsons;
    private OnClickListener mlistener;
    public interface OnClickListener{
        void itemClick(int position, View itemView);

    }
    String idNovedad;


    public AdapterNovedadesRecientes(ArrayList<Novedades> iniciarSesionJsons) {
        this.iniciarSesionJsons = iniciarSesionJsons;
    }

    public void setMlistener(OnClickListener mlistener) {
        this.mlistener = mlistener;
    }

    @NonNull
    @Override
    public AdapterNovedadesRecientes.Holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_list_novedades_recientes, parent, false);
        return new Holder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull AdapterNovedadesRecientes.Holder holder, int position) {

        holder.fijarDatos(iniciarSesionJsons.get(position));

    }



    @Override
    public int getItemCount() {
        return iniciarSesionJsons.size();
    }


    public class Holder extends RecyclerView.ViewHolder {

        TextView txtFecha, txtNumArticulos, txtAmbiente;
        ImageView imgEstado;
        public Holder(final View itemView) {
            super(itemView);

            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if (mlistener!=null){
                        int position = getLayoutPosition();
                        if (position!=RecyclerView.NO_POSITION){
                            mlistener.itemClick(position,itemView);
                        }
                    }
                }
            });


            txtFecha=itemView.findViewById(R.id.txtfechaNovedad);
            txtAmbiente=itemView.findViewById(R.id.txtAmbiente);
            txtNumArticulos=itemView.findViewById(R.id.txtNumeroArticulos);





        }

        public void fijarDatos(Novedades novedades) {


            txtFecha.setText(novedades.getFecha());

            txtAmbiente.setText(novedades.getAmbiente());
            txtNumArticulos.setText(Integer.toString(novedades.getArticulos())+" artículos");


        }
    }
}

