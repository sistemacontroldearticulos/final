package com.proyecto.aplicacion.Adaptadores;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.proyecto.aplicacion.Modelo.ActasJson;
import com.proyecto.aplicacion.R;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

/**
 * Created by ADMIN on 07/11/2018.
 */

public class AdapterActas   extends RecyclerView.Adapter<AdapterActas.Holder> {
    ArrayList<ActasJson> actasJsons;
    private AdapterActas.OnClickListener mlistener;
    public interface OnClickListener{
        void itemClick(int position, View itemView);

    }
    String idNovedad;


    public AdapterActas(ArrayList<ActasJson> actasJsons) {
        this.actasJsons = actasJsons;
    }

    public void setMlistener(AdapterActas.OnClickListener mlistener) {
        this.mlistener = mlistener;
    }

    @NonNull
    @Override
    public AdapterActas.Holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_list_novedades_recientes, parent, false);
        return new AdapterActas.Holder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull AdapterActas.Holder holder, int position) {

        holder.fijarDatos(actasJsons.get(position));

    }



    @Override
    public int getItemCount() {
        return actasJsons.size();
    }


    public class Holder extends RecyclerView.ViewHolder {

        TextView txtFecha, txtNumArticulos, txtAmbiente;
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
            txtNumArticulos.setPadding(0,-4,0,0);



        }

        public void fijarDatos(ActasJson actasJson) {
            String fecha2 = null;

            Date date = new Date();
            SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
            SimpleDateFormat dateFormat1 = new SimpleDateFormat("dd/MM/yyyy HH:mm");

            try {
                date=dateFormat.parse(actasJson.getFechaacta());
                fecha2=dateFormat1.format(date);

                txtFecha.setText(fecha2);
                txtAmbiente.setText(actasJson.getNombreequipo());
                txtNumArticulos.setText(actasJson.getNombreaprendiz());


            } catch (ParseException e) {
                e.printStackTrace();
            }




        }
    }
}