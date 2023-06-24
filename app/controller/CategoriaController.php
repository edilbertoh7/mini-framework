<?php

class CategoriaController
{
    public function index()
    {
        return $persona = Categoria::all('categories');
       // $campos = [];
         //$campos =['category_name','description'];//
        //return Categoria::where('categories', 'category_name', 'Bebidas no gaseosas',$campos);

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
        //return Categoria::findById('categories', $id);
    }

    public function store()
    {
        $body = json_decode(file_get_contents("php://input"), true);
        $persona = Categoria::create('categories', $body);
        if (isset($persona)) {
            return $persona;
        }
        return $body;
    }

    public function update($id)
    {
        $body = json_decode(file_get_contents("php://input"), true);
        $persona = Categoria::edit('categories', $body, $id);
        if (isset($persona)) {
            return $persona;
        }
        return $body;
    }
    public function destroy($id)
    {
        $persona = Categoria::delete('categories', $id);
        if (isset($persona)) {
            return $persona;
        }
        //return "eliminado producto con id: " . $id . "";
    }
    // http_response_code(404)
}
