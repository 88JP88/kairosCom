<?php
    require_once 'database/db_users.php';
class modelGet {
    public static function getDelivery($dta) {
            
                


        // Asegúrate de proporcionar la ruta correcta al archivo de conexión a la base de datos
        
            // Realiza la conexión a la base de datos (reemplaza conn() con tu propia lógica de conexión)
            $conectar = conn();
    
            // Verifica si la conexión se realizó correctamente
            if (!$conectar) {
                return "Error de conexión a la base de datos";
            }
    
            
                

            // Escapa los valores para prevenir inyección SQL
            $clientId = mysqli_real_escape_string($conectar, $dta['clientId']);
            $filter = mysqli_real_escape_string($conectar, $dta['filter']);
            $param = mysqli_real_escape_string($conectar, $dta['param']);
            $value = mysqli_real_escape_string($conectar, $dta['value']);
           
    
            if($filter=="all"){

        
        
                $query= mysqli_query($conectar,"SELECT deliveryId,deliveryName,deliveryLastName,clientId,isActive,distanceRules,deliveryMail,deliveryContact FROM generalDelivery where clientId='$clientId'");
            }
            
        
    if($filter=="filter"){
    
            
            
        $query= mysqli_query($conectar,"SELECT deliveryId,deliveryName,deliveryLastName,clientId,isActive,distanceRules,deliveryMail,deliveryContact FROM generalDelivery where clientId='$clientId'");
    
    
    }
            if($query){
                $numRows = mysqli_num_rows($query);

if ($numRows > 0) {
                $response="true";
                $message="Consulta exitosa";
                $status="202";
                $apiMessage="¡Repartidores seleccionados ($numRows)!";
                $values=[];

                while ($row = $query->fetch_assoc()) {
                    $value=[
                        'deliveryId' => $row['deliveryId'],
                        'clientId' => $row['clientId'],
                        'deliveryName' => $row['deliveryName'],
                        'deliveryLastName' => $row['deliveryLastName'],
                        'isActive' => $row['isActive'],
                        'distanceRules' => $row['distanceRules'],
                        'deliveryMail' => $row['deliveryMail'],
                        'deliveryContact' => $row['deliveryContact']
                    ];
                
                    array_push($values, $value);
                }
                
                $row = $query->fetch_assoc();
               // return json_encode(['products'=>$values]);
                
                // Crear un array separado para el objeto 'response'
                $responseData = [
                    'response' => [
                        'response' => $response,
                        'message' => $message,
                        'apiMessage' => $apiMessage,
                        'status' => $status,
                        'sentData'=>$dta
                    ],
                    'delivery' => $values
                ];
                
                return json_encode($responseData);
            }else {
                // La consulta no arrojó resultados
                $response="false";
                $message="Error en la consulta";
                $status="204";
                $apiMessage="¡La consulta no produjo resultados, filas seleccionadas ($numRows)!";
                $values=[];
                $value = [
                    
                ];
                $responseData = [
                    'response' => [
                        'response' => $response,
                        'message' => $message,
                        'apiMessage' => $apiMessage,
                        'status' => $status,
                        'sentData'=>$dta
                    ],
                    'delivery' => $values
                ];
                array_push($values,$value);
                
    
        //echo json_encode($students) ;
        return json_encode($responseData);
            }

            //  return "true";
            //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
            }else{
                $response="false";
                $message="Error en la consulta: " . mysqli_error($conectar);
                $status="404";
                $apiMessage="¡Repartidores no selleccionados con éxito!";
                $values=[];

                $value = [
                    
                ];
                $responseData = [
                    'response' => [
                        'response' => $response,
                        'message' => $message,
                        'apiMessage' => $apiMessage,
                        'status' => $status,
                        'sentData'=>$dta
                    ],
                    'delivery' => $values
                ];
                array_push($values,$value);
                
    
        //echo json_encode($students) ;
        return json_encode($responseData);
                                }

                                
            
}

            
       
    }


    
?>