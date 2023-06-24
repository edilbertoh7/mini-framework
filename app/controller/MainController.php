<?php

class MainController
{
    public function index()
    {
        return $persona = Persona::all('products');
       // $campos = [];
        // $campos =['name_reference','reference','price','stock'];// la consulta solo traera estos campos
        // return Persona::where('products', 'reference', 'Referencia cinco uno',$campos); // tabla, campo, valor a buscar 

    }

    public function show($id)
    {
        //return 'persona ->' .$id;

        /*$ARRAY = [
            "id" => $id,
            "name" => "152",
            "apellido" => "Gonzalez",
            "edad" => 25,
            "casa" => 2,
        ];
        return view('index',["id"=>$id]);*/
        return Persona::findById('products', $id);
    }

    public function store()
    {
        $body = json_decode(file_get_contents("php://input"), true);
        $persona = Persona::create('products', $body);
        if (isset($persona)) {
            return $persona;
        }
        return $body;
    }

    public function update($id)
    {
        $body = json_decode(file_get_contents("php://input"), true);
        $persona = Persona::edit('products', $body, $id);
        if (isset($persona)) {
            return $persona;
        }
        return $body;
    }
    public function destroy($id)
    {
        $persona = Persona::delete('products', $id);
        if (isset($persona)) {
            return $persona;
        }
        //return "eliminado producto con id: " . $id . "";
    }
    // http_response_code(404)
}
