<?php

class Conex
{
    public static function conectar()
    {
        global $conex;
        $conex = mysqli_connect("localhost:3307", "root", "", "cafeteria-konecta");
        mysqli_set_charset($conex, "utf8");
        if (mysqli_connect_errno()) {
            echo "Error al conectar con la base de datos: " . mysqli_connect_error();
        }
    }

    public static function query($sql)
    {
        Conex::conectar();
        global $conex;
        $result = $conex->query($sql);
        return $result;
    }

    public static function data($sql)
    {

        $result = Conex::query($sql);
        foreach ($result as $resp) {
            $resp = $resp;
        }
        return $resp;
    }
}

class Model
{


    public static function all($table)
    {
        $sql = "SELECT * FROM $table";
        try {
            $result = Conex::query($sql);
            $rows = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
            return $rows;
        } catch (Exception $e) {

            return Model::sendError($e);

            die();
        }
    }

    public static function findById($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = $id";
        try {
            $result = Conex::query($sql);
            $rows = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
            return $rows;
        } catch (Exception $e) {
            return Model::sendError($e);
            die();
        }
    }
    public static function where($table, $column, $value, $field = [])
    {
        if ($field != []) {
            $field = "'" . implode("','", $field) . "'";
            $sql = "SELECT $field FROM $table WHERE $column = '$value'";
        } else {

            $sql = "SELECT * FROM $table WHERE $column = '$value'";
        }


        try {
            $result = Conex::query($sql);
            $rows = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
            return $rows;
        } catch (Exception $e) {
            return Model::sendError($e);
            die();
        }
    }
    public static function create($table, $data)
    {
        //print_r($data);
        foreach ($data as $key => $value) {
            $columns[] = $key;
            $values[] = $value;
        }
        $columns = implode("`,`", $columns);
        $values = implode("','", $values);

        try {
            $sql = "INSERT INTO `$table` (`$columns`) VALUES ('$values')";
            Conex::query($sql);
        } catch (Exception $e) {
            return Model::sendError($e);
            die();
        }
    }
    public static function edit($table, $data, $id)
    {
        //print_r($data);
        foreach ($data as $key => $value) {
            $columns[] = "`" . $key . "`" . '=' . "'" . $values[] = $value . "'";
        }
        $columns = implode(",", $columns);

        try {
            $sql = "UPDATE `$table` SET $columns  WHERE `id` = $id";
            Conex::query($sql);
        } catch (Exception $e) {
            return Model::sendError($e);
            die();
        }
    }

    public static function delete($table, $id)
    {

        header('Content-Type: application/json');
        $result = Model::findById($table, $id);
        try {
            if (count($result) == 0) {
                return json_encode('No se encontro el registro');
            }
            $sql = "DELETE FROM `$table` WHERE `id` = $id";
            Conex::query($sql);
        } catch (Exception $e) {
            return Model::sendError($e);
            die();
        }
        return json_encode("eliminado registro con id: " . $id . "");
    }

    public static function sendError($e)
    {
        $error = [
            "message" => $e->getMessage(),
            "code" => $e->getCode(),
            "line" => $e->getLine(),
            "file" => $e->getFile(),
            "trace" => $e->getTrace(),
        ];
        header('Content-Type: application/json');
        return json_encode($error);
    }
}
