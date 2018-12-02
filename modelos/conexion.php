<?php

class Conexion
{

    static public function conectar()
    {

      $link = new PDO("mysql:host=localhost;dbname=proyectofinal", "root", "");

       $link->exec("set names utf8");

       return $link;

      
       // $link = new PDO("mysql:host=88.198.24.90;dbname=inventar_proyectofinal", "inventariosadsi", "SETQDnuHgv(_");
       // $link->exec("set names utf8");
       // return $link;


       $link->exec("set names utf8");

        return $link;

    }

}
