<?php

function kronos($response,$message,$error,$function,$filename,$module,$clientId,$data,$endpoint,$statusCode,$level) {

  // Establecer la zona horaria a Bogotá
date_default_timezone_set('America/Bogota');

// Obtener la fecha y hora actual en Bogotá
$now = new DateTime();
$now->setTimezone(new DateTimeZone('America/Bogota'));

// Formatear la fecha y hora actual
$currentDateTime = $now->format('Y-m-d H:i:s');
if($level==="true"){
    $level="info";
}
if($level==="error"){
    $level="error";
}
$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ip-api.com/json/$ip"));

$jsonData = '{
    "log":{
      "front":{
        "timestamp": "'.$currentDateTime.'",
        "level": "'.$level.'",
        "clientId": "'.$clientId.'",
        "module": "'.$module.'",
        "domain":"'.$_SERVER['HTTP_HOST'].'",
        "function":"'.$function.'",
        "file":"'.$filename.'",
        "response":"'.$response.'",
        "error":"'.$error.'",
        "clientIp":"'.$_SERVER['REMOTE_ADDR'].'",
        "clientLocation":"'.$details->country.' / '.$details->city.'"
      },
      "infoLog":{
        "endPoint":"'.$endpoint.'",
        
        "response":"'.$response.'",
        "message":"'.$message.'"
      }
    },"data":'.$data.',
     "status":{
      "code":"'.$statusCode.'"
    }
  }';




  
  $url ="https://dev-kronos.lugma.tech/kronos/apiLogs/v1/comLog/";
  
  // Definir los datos a enviar en la solicitud POST
  $data6 = array(
      'data' => $jsonData,
      'logType' => 'apiCom'
     
      
  );
  
  // Convertir los datos a formato JSON
  $json_data = json_encode($data6);
  
  // Inicializar la sesión cURL
  $curl = curl_init();
   
  // Configurar las opciones de la sesión cURL
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data6);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  
  // Ejecutar la solicitud y obtener la respuesta
  $responselog = curl_exec($curl);
  
  // Cerrar la sesión cURL
  curl_close($curl);

}

?>