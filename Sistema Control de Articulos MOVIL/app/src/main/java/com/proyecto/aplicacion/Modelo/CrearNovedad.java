package com.proyecto.aplicacion.Modelo;

public class CrearNovedad {
    public CrearNovedad() {
    }

    public String getNumdocumentousuario() {

        return numdocumentousuario;
    }

    public void setNumdocumentousuario(String numdocumentousuario) {
        this.numdocumentousuario = numdocumentousuario;
    }

    public String getNombreusuario() {
        return nombreusuario;
    }

    public void setNombreusuario(String nombreusuario) {
        this.nombreusuario = nombreusuario;
    }

    public String getNumeroficha() {
        return numeroficha;
    }

    public void setNumeroficha(String numeroficha) {
        this.numeroficha = numeroficha;
    }

    public String getFechaNovedad() {
        return fechaNovedad;
    }

    public void setFechaNovedad(String fechaNovedad) {
        this.fechaNovedad = fechaNovedad;
    }

    public String getArticulo() {
        return articulo;
    }

    public void setArticulo(String articulo) {
        this.articulo = articulo;
    }

    public Boolean getEstado() {
        return estado;
    }

    public void setEstado(Boolean estado) {
        this.estado = estado;
    }

    String numdocumentousuario;
    String nombreusuario;
    String numeroficha;
    String fechaNovedad;
    String articulo;
    Boolean estado;
}
