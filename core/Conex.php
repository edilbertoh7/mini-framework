<?php

class Conex{
    public static function conectar(){
        global $conex;
        $conex = mysqli_connect("localhost:3307","root","","cafeteria-konecta");
        mysqli_set_charset($conex,"utf8");
        if (mysqli_connect_errno()) {
            echo "Error al conectar con la base de datos: ".mysqli_connect_error();
        }
    }

    public static function query($sql){
        Conex::conectar();
         global $conex;
         $result = $conex->query($sql);
         return $result;
     }

     public static function data($sql){

        $result = Conex::query($sql); 
        foreach ($result as $resp ) {
           $resp = $resp;
        }
        return $resp;
    }
}
?>