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
 case 'insert':
    $archivoguardado=0;
    $mensaje = "";
        $response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );          

            if( !empty( $_FILES['image']['name'])    )   
            {  
                  //codigo para almacenar la imagen
              $currentDir = getcwd();
              $uploadDirectory = "/imagenes/";  
             
              $fileExtensions = ['jpeg','jpg','png']; // Obtenga la  extension del archivo  
              $fileName = $_FILES['image']['name'];
              $fileSize = $_FILES['image']['size'];
              $fileTmpName  = $_FILES['image']['tmp_name'];
              $fileType = $_FILES['image']['type'];
              $fileExtension = strtolower(end(explode('.',$fileName)));  
              $uploadPath = $currentDir . $uploadDirectory . basename($fileName);       
              //$mysqli->insert_id      
              if (! in_array($fileExtension,$fileExtensions)) {
                    $mensaje  = "Esta extensión de archivo no está permitida. Cargue un archivo JPEG o PNG";
                  }
          
              if ($fileSize > 1000000) {
                    $mensaje = "Este archivo tiene más de 1 MB. Lo sentimos, tiene que ser menor o igual a 1 MB";
                  }  
                  if (empty($mensaje)) {
                      $didUpload = move_uploaded_file($fileTmpName, $uploadPath);  
                      if ($didUpload) {
                        $archivoguardado=1;                       
                      } else {
                        $mensaje =  "Se produjo un error en alguna parte. Inténtalo de nuevo o contacta al administrador";
                      }
                  }  
        
            }
            if( !empty( $_FILES['image']['name']) && empty( $mensaje) == false )
            {
                $response['msg'] =   $mensaje;

                echo json_encode($response);  
                exit;
            }

            $imagen ="";
            if(  $archivoguardado==1 ){ 
                
                $imagen ='$fileName';
            }  
            
            $login = $_POST['login']; 
            $password = $_POST['password'];   
            $nombre = $_POST['nombre'];  
            $fechanacimiento = $_POST['fechanacimiento'];  
            $codigo_rol = $_POST['codigo_rol'];            
            $sql = " INSERT INTO usuario(nombre,password,login,imagen,fechanacimiento,codigo_rol) VALUES ('$nombre','$password','$login', '$imagen','$fechanacimiento',  $codigo_rol) "; 
            $insert = pg_query($dbconn,$sql); 
             
            if($insert){ 
                $response['status'] = 1; 
                $response['msg'] = '¡Los datos del usuario se han agregado con éxito!'; 
            } 

            
            echo json_encode($response); 
 break; 

 case 'update':
        $response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );          
            if(!empty($_POST['login']) && !empty($_POST['nombre'])  ){ 
                $login = $_POST['login']; 
                $nombre = $_POST['nombre'];   
                $sql = "INSERT INTO usuario(nombre,password,login) VALUES ('$login','$nombre','$login', $fileName  )"; 
                $insert = pg_query($dbconn,$sql); 
                 
                if($insert){ 
                    $response['status'] = 1; 
                    $response['msg'] = '¡Los datos del usuario se han agregado con éxito!'; 
                } 
            }else{ 
                $response['msg'] = 'Por favor complete todos los campos obligatorios.'; 
            } 
             
            echo json_encode($response); 

 break; 
 case 'delete':
        $response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );          
            if(!empty($_POST['login'])   ){ 
                $login = $_POST['login']; 
              
                $sql = " delete from usuario where login ='$login' "; 
                $result = pg_query($sql); 
                 
                if ($result){
                        echo json_encode(array('success'=>true));
                } else {
                        echo json_encode(array('errorMsg'=>'Some errors occured.'));
                }
            }else{ 
                $response['msg'] = 'Por favor complete todos los campos obligatorios.'; 
            } 
             
            

 break; 
    default:
            echo json_encode( "Error no existe la opcion ".$op);


            }
?>