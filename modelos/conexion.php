<?php

class Conexion
{

    public static function conectar()
    {

        // $link = new PDO("mysql:host=localhost;dbname=proyectofinal",
        //     "root",
        //     "");
        $link = new PDO('pgsql:user=jvdwioghpjqleb  dbname=d42v3gmecvlgdd password=
 ecb8e26902751ca156b5727322ab14f814d520244e2b6be875af2605cf6f4724;host=
ec2-23-21-171-249.compute-1.amazonaws.com');


        $link->exec("set names utf8");

        return $link;

    }

}
