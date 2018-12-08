package com.proyecto.aplicacion.Adaptadores;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.TextView;

import com.proyecto.aplicacion.Modelo.ArticuloNovedad;
import com.proyecto.aplicacion.Modelo.IniciarSesionJson;
import com.proyecto.aplicacion.R;

import org.w3c.dom.Text;

import java.util.ArrayList;

public class AdapterVerArticulosNovedad  extends RecyclerView.Adapter<AdapterVerArticulosNovedad.Holder> {
    ArrayList<ArticuloNovedad> articuloNovedads;
    private OnClickListener mlistener;
    public interface OnClickListener{
        void itemClick(int position, View itemView);

    }

    public AdapterVerArticulosNovedad(ArrayList<ArticuloNovedad> articuloNovedads) {
        this.articuloNovedads = articuloNovedads;
    }

    public void setMlistener(OnClickListener mlistener) {
        this.mlistener = mlistener;
    }


    @NonNull
    @Override
    public Holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_list_ver_articulos, parent, false);
        return new Holder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull Holder holder, int position) {

        holder.fijarDatos(articuloNovedads.get(position));

    }



    @Override
    public int getItemCount() {
        return articuloNovedads.size();
    }


    public class Holder extends RecyclerView.ViewHolder {

        TextView txtArticulo, txtTipoNovedad, txtEquipo, txtJornada;
        TextView txtImagen;
        ImageButton btnEliminarArticulo;
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
            txtJornada.setVisibility(View.GONE);







        }

        public void fijarDatos(ArticuloNovedad articuloNovedad) {

            txtArticulo.setText(articuloNovedad.getTipoarticulo());
            txtTipoNovedad.setText(articuloNovedad.getTiponovedad());
            txtEquipo.setText(articuloNovedad.getIdequipo());


        }
    }
}

