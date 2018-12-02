<?php

class ControladorNotificaciones
{
    public static function CtrConsultarNotificaciones()
    {
        $tabla     = "notificaciones";
        $respuesta = ModeloNotificaciones::mdlConsultarNotificaciones($tabla);

        return $respuesta;

    }

    public static function CtrConsultarUsuariosNoti($dato)
    {
        $tabla     = "notificaciones";
        $respuesta = ModeloNotificaciones::mdlConsultarNotificaciones($tabla);

        return $respuesta;

    }

    public static function CtrActualizarNotificaciones()
    {

        if (isset($_GET["numdocumentousuario"])) {
            $idnotificacion = $_GET["numdocumentousuario"];
            $nombreusuario  = $_GET["nombreusuario"];
            $tabla          = "notificaciones";
            $respuesta      = ModeloNotificaciones::mdlActualizarNtificacion($tabla, $idnotificacion);

            if ($respuesta == "ok") {
                return $nombreusuario;

            }
        }

    }

}
