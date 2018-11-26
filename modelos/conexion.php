<?php

class Conexion
{

    static public function conectar()
    {

     // $link = new PDO('pgsql:user=jvdwioghpjqleb  dbname=d42v3gmecvlgdd password=
     //     ecb8e26902751ca156b5727322ab14f814d520244e2b6be875af2605cf6f4724;host=
     //     ec2-23-21-171-249.compute-1.amazonaws.com');

       //  $link = new PDO('pgsql:user=postgres dbname=final password=123');
       // $link->exec("set names utf8");
       // return $link;

     // $link = new PDO('pgsql:user=jvdwioghpjqleb  dbname=d42v3gmecvlgdd password=
     //     ecb8e26902751ca156b5727322ab14f814d520244e2b6be875af2605cf6f4724;host=
     //     ec2-23-21-171-249.compute-1.amazonaws.com');


       //   $link = new PDO("mysql:host=localhost;dbname=proyectofinal", "root", "");
       // $link->exec("set names utf8");
       // return $link;

       $link = new PDO("mysql:host=88.198.24.90;dbname=inventar_proyectofinal", "inventariosadsi", "SETQDnuHgv(_");
       $link->exec("set names utf8");
       return $link;


       $link->exec("set names utf8");

        return $link;

    }

}
