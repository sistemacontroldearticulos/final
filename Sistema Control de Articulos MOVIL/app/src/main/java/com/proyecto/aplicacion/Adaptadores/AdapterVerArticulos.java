package com.proyecto.aplicacion.Adaptadores;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.proyecto.aplicacion.Modelo.IniciarSesionJson;
import com.proyecto.aplicacion.R;

import java.util.ArrayList;

public class AdapterVerArticulos extends RecyclerView.Adapter<AdapterVerArticulos.Holder> {
    ArrayList<IniciarSesionJson> iniciarSesionJsons;
    private AdapterNovedadesRecientes.OnClickListener mlistener;

    public AdapterVerArticulos(ArrayList<IniciarSesionJson> iniciarSesionJsons) {
        this.iniciarSesionJsons = iniciarSesionJsons;
    }




    public void setMlistener(AdapterNovedadesRecientes.OnClickListener mlistener) {
        this.mlistener = mlistener;
    }


    @NonNull
    @Override
    public AdapterVerArticulos.Holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_list_ver_articulos, parent, false);
        return new AdapterVerArticulos.Holder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull AdapterVerArticulos.Holder holder, int position) {

        holder.fijarDatos(iniciarSesionJsons.get(position));

    }



    @Override
    public int getItemCount() {
        return iniciarSesionJsons.size();
    }




    public class Holder extends RecyclerView.ViewHolder {

        TextView txtArticulo, txtTipoNovedad, txtEquipo, txtJornada;
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

            txtArticulo=itemView.findViewById(R.id.txtArticulo);
            txtTipoNovedad=itemView.findViewById(R.id.txtTipoNovedad);
            txtEquipo=itemView.findViewById(R.id.txtEquipo);
            txtJornada=itemView.findViewById(R.id.txtJornada);


        }

        public void fijarDatos(IniciarSesionJson iniciarSesionJson) {

            txtArticulo.setText(iniciarSesionJson.getTipoarticulo());
            txtTipoNovedad.setText(iniciarSesionJson.getTiponovedad());
            txtEquipo.setText(iniciarSesionJson.getNombreequipo());
            txtJornada.setText(iniciarSesionJson.getJornadaficha().toUpperCase());
        }
    }
}

