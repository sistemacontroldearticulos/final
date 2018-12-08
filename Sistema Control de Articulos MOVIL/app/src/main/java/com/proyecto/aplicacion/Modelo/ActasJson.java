package com.proyecto.aplicacion.Modelo;

public class ActasJson {
    String nombreaprendiz;
    String fechaacta;
    String idacta;

    public String getIdacta() {
        return idacta;
    }

    public void setIdacta(String idacta) {
        this.idacta = idacta;
    }

    public String getNombreaprendiz() {
        return nombreaprendiz;
    }

    public void setNombreaprendiz(String nombreaprendiz) {
        this.nombreaprendiz = nombreaprendiz;
    }

    public String getFechaacta() {
        return fechaacta;
    }

    public void setFechaacta(String fechaacta) {
        this.fechaacta = fechaacta;
    }

    public String getNombreequipo() {
        return nombreequipo;
    }

    public void setNombreequipo(String nombreequipo) {
        this.nombreequipo = nombreequipo;
    }

    public String getNumeroficha() {
        return numeroficha;
    }

    public void setNumeroficha(String numeroficha) {
        this.numeroficha = numeroficha;
    }

    public String getNombreambiente() {
        return nombreambiente;
    }

    public void setNombreambiente(String nombreambiente) {
        this.nombreambiente = nombreambiente;
    }

    String nombreequipo;
    String numeroficha;
    String nombreambiente;

    public ActasJson() {
    }
}
