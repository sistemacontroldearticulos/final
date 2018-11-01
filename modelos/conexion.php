<?php

class Conexion
{

    public static function conectar()
    {

        // $link = new PDO("mysql:host=localhost;dbname=proyectofinal",
        //     "root",
        //     "");
        $link = new PDO('pgsql:user=postgres dbname=proyectofinal password=123');


        $link->exec("set names utf8");

        return $link;

    }

}
