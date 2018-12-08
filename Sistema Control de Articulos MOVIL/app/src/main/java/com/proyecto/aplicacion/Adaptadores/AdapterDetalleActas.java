package com.proyecto.aplicacion.Adaptadores;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.TextView;

import com.proyecto.aplicacion.Modelo.ArticuloNovedad;
import com.proyecto.aplicacion.Modelo.DetalleActas;
import com.proyecto.aplicacion.R;

import java.util.ArrayList;

public class AdapterDetalleActas extends RecyclerView.Adapter<AdapterDetalleActas.Holder> {
    ArrayList<DetalleActas> detalleActas;
    private OnClickListener mlistener;
    public interface OnClickListener{
        void itemClick(int position, View itemView);

    }

    public AdapterDetalleActas(ArrayList<DetalleActas> detalleActas) {
        this.detalleActas = detalleActas;
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

        holder.fijarDatos(detalleActas.get(position));

    }



    @Override
    public int getItemCount() {
        return detalleActas.size();
    }


    public class Holder extends RecyclerView.ViewHolder {

        TextView txtArticulo, txtTipoNovedad, txtEquipo, txtJornada;
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
            txtJornada.setPadding(2,8,2,0);
            txtJornada.setTextSize(9);



        }

        public void fijarDatos(DetalleActas detalleActas) {

            txtArticulo.setText(detalleActas.getAmbiente());
            txtTipoNovedad.setText(detalleActas.getFicha());
            txtEquipo.setText(detalleActas.getEquipo());
            txtJornada.setText(detalleActas.getNombre());

        }
    }
}
