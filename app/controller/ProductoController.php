<?php
class ProductoController{
    public function index()
    {
        return 'vista desde el producto' ;
    }

    public function show($id)
    {
        $miarray = [
            "id" => $id,
            "name" => "152",
            "apellido" => "Gonzalez",
            "edad" => 25,
            "casa" => 2,
        ];
        $casa = 2;
        
        return view("producto.index", $miarray);
        // return $miarray;
    }

}
?>