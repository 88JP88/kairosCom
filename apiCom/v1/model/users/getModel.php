<?php
    require_once 'database/db_users.php';
class modelGet {
          
        public static function getProducts($dta) {
            
                


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

                
                
                                        $query= mysqli_query($conectar,"SELECT productId,clientId,productName,description,ean1,ean2,sku,productType,inPrice,providerId,imgProduct,spcProduct,isActive,keyWords FROM generalProducts where clientId='$clientId'");
                                }
                                
                                if($filter=="browser"){
                
                                
                                
                                    $query= mysqli_query($conectar,"SELECT productId,clientId,productName,description,ean1,ean2,sku,productType,inPrice,providerId,imgProduct,spcProduct,isActive,keyWords FROM generalProducts where clientId='$clientId' and keyWords LIKE ('%$value%')");
                                
                                
                                }
                        if($filter=="filter"){
                
                                
                                
                            $query= mysqli_query($conectar,"SELECT productId,clientId,productName,description,ean1,ean2,sku,productType,inPrice,providerId,imgProduct,spcProduct,isActive,keyWords FROM generalProducts where clientId='$clientId' and $param='$value'");
                
                
                        }       
                                    if($query){
                                       
                                        $response="true";
                                        $message="Consulta exitosa";
                                        $status="202";
                                        $apiMessage="¡Productos seleccionados con éxito!";
                                        $values=[];
                
                                        while ($row = $query->fetch_assoc()) {
                                            $value = [
                                                'productId' => $row['productId'],
                                                'clientId' => $row['clientId'],
                                                'productName' => $row['productName'],
                                                'description' => $row['description'],
                                                'ean1' => $row['ean1'],
                                                'ean2' => $row['ean2'],
                                                'sku' => $row['sku'],
                                                'productType' => $row['productType'],
                                                'inPrice' => $row['inPrice'],
                                                'providerId' => $row['providerId'],
                                                'imgProduct' => $row['imgProduct'],
                                                'spcProduct' => $row['spcProduct'],
                                                'isActive' => $row['isActive'],
                                                'keyWords' => $row['keyWords']
                                            ];
                                        
                                            array_push($values, $value);
                                        }
                                        
                                        $row = $query->fetch_assoc();
                                       // return json_encode(['products'=>$values]);
                                        
                                        // Crear un array separado para el objeto 'response'
                                        $responseData = [
                                            'responses' => [
                                                'response' => $response,
                                                'message' => $message,
                                                'apiMessage' => $apiMessage,
                                                'status' => $status
                                            ],
                                            'products' => $values
                                        ];
                                        
                                        echo json_encode($responseData);


                                    //  return "true";
                                    //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
                                    }else{
                                        $response="true";
                                        $message="Error en la consulta: " . mysqli_error($conectar);
                                        $status="404";
                                        $apiMessage="¡Productos no selleccionados con éxito!";
                                        $values=[];

                                        $value=[
                                            'response' => $response,
                                            'message' => $message,
                                            'apiMessage' => $apiMessage,
                                            'status' => $status
                                            
                                        ];
                                        
                                        array_push($values,$value);
                                        
                            
                                //echo json_encode($students) ;
                                return json_encode(['response'=>$values]);
                                                        }

                                                        
                                    
            }

            
    }


    
?>