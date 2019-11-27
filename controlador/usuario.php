<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: token, Content-Type');
header('Access-Control-Max-Age: 178000');
header('Content-Length: 0');
header('Content-Type: application/json');
require ('coneccion.php'); 
$op=  $_GET['op'] ;
if( !isset($op) )
{
  echo  json_encode( "No se definió  la variable op");
  exit;
}
switch ($op) {
    case 'login': 	
        $txtusuario = pg_escape_string( $_POST['txtusuario']);
        $txtpassword = pg_escape_string( $_POST['txtpassword']);
        $sql = "SELECT * FROM usuario where login='$txtusuario' and password='$txtpassword' ";
        $result = pg_query($dbconn, $sql);
        if (!$result) {
               echo json_encode("Ocurrió un error en la consulta" );
        exit;
        }
        while($row = pg_fetch_row($result)) {
            $data[] = $row;
        }        
        if(isset($data))
                echo json_encode($data);
    break; 
    case 'select':
            $resultqry = pg_query($dbconn, 'SELECT * FROM usuario');
            if (!$resultqry) {
            echo json_encode("Ocurrió un error en la consulta");
            exit;
            }
            $result = array();
            $items = array();  
         
            while($row = pg_fetch_object($resultqry)) {
               array_push($items, $row);
            }
            $result["rows"] = $items;
            echo json_encode($result);

            break;
    default:
            echo json_encode( "Error no existe la opcion ".$op);

            }
?>