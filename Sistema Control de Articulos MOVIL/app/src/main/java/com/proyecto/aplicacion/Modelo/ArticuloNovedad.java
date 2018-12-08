package com.proyecto.aplicacion.Modelo;

import android.text.Editable;

public class ArticuloNovedad {
    public ArticuloNovedad() {
    }

    public String getIdartculo() {

        return idartculo;
    }

    public void setIdartculo(String idartculo) {
        this.idartculo = idartculo;
    }

    public String getIdnovedad() {
        return idnovedad;
    }

    public void setIdnovedad(String idnovedad) {
        this.idnovedad = idnovedad;
    }

    public String getTiponovedad() {
        return tiponovedad;
    }

    public void setTiponovedad(String tiponovedad) {
        this.tiponovedad = tiponovedad;
    }

    public Editable getObservacionnovedad() {
        return observacionnovedad;
    }

    public void setObservacionnovedad(Editable observacionnovedad) {
        this.observacionnovedad = observacionnovedad;
    }

    String idartculo;
    String idnovedad;
    String tiponovedad;
    Editable observacionnovedad;

    public String getImagen() {
        return imagen;
    }

    public void setImagen(String imagen) {
        this.imagen = imagen;
    }

    String imagen;

    public String getTipoarticulo() {
        return tipoarticulo;
    }

    public void setTipoarticulo(String tipoarticulo) {
        this.tipoarticulo = tipoarticulo;
    }

    public String getIdequipo() {
        return idequipo;
    }

    public void setIdequipo(String idequipo) {
        this.idequipo = idequipo;
    }

    String tipoarticulo;

    String idequipo;
}
