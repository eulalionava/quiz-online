<?php
    include_once 'conexion.php';

    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //PARA RECIBIR LOS PARAMETROS DE AXIOS
    $_POST = json_decode(file_get_contents("php://input"),true);

    //RECEPCION DE LOS DATOS ENVIADOS  MEDIANTE POST DE MAIN.JS
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    $id     = (isset($_POST['id']))     ? $_POST['id']      : '';
    $marca  = (isset($_POST['marca']))  ? $_POST['marca']   : '';
    $modelo  = (isset($_POST['modelo'])) ? $_POST['modelo']  : '';
    $stock  = (isset($_POST['stock']))  ? $_POST['stock']   : '';

    $data = [];
    switch($opcion){
        case 1:
            $consulta = "INSERT INTO moviles(marca,modelo,stock)VALUES('$marca','$modelo','$stock')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            break;

        case 2:
            $consulta = "UPDATE moviles SET marca = '$marca',modelo='$modelo',stock='$stock' WHERE id='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;

        case 3:
            $consulta = "DELETE FROM moviles WHERE id='$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            break;

        case 'getTemas':
            $consulta = "SELECT tema_id,tema_nombre,tema_activo FROM tema ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        
        case 'getPreguntas':
            $consulta = "SELECT * FROM preguntas WHERE tema_id = $id ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;

        case 'getRespuestas':
            $consulta = "SELECT * FROM respuesta WHERE pre_id = $id ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;


    }

    print  json_encode($data,JSON_UNESCAPED_UNICODE);
    $conexion = null;

?>