<?php
   
    class modelResponse {
        
       public static function responsePost($responseApi,$messageApi,$statusApi) {
    
        $values=[];

        $value=[
            'response' => $responseApi,
            'message' => $messageApi,
            'status' => $statusApi
            
        ];
        
        array_push($values,$value);
        
return json_encode(['response'=>$values]);
            
        }

        public static function postProduct($dta) {
    
            // Asegúrate de proporcionar la ruta correcta al archivo de conexión a la base de datos
        
           // Realiza la conexión a la base de datos (reemplaza conn() con tu propia lógica de conexión)
           $conectar = conn();
   
           // Verifica si la conexión se realizó correctamente
           if (!$conectar) {
               return "Error de conexión a la base de datos";
           }
   
           

           // Escapa los valores para prevenir inyección SQL
           $clientId = mysqli_real_escape_string($conectar, $dta['clientId']);
           $param = mysqli_real_escape_string($conectar, $dta['param']);
           $value = mysqli_real_escape_string($conectar, $dta['value']);
           $deliveryId = mysqli_real_escape_string($conectar, $dta['deliveryId']);
          
           //$dato_encriptado = $keyword;
           $keywords=$productName."-".$description."-".$sku."-".$productType."-".$techSpef;
        
   
           $query = mysqli_query($conectar, "INSERT INTO generalProducts (productId, clientId, productName, description, ean1, ean2, sku, productType, inPrice, providerId, imgProduct, spcProduct,keyWords) VALUES ('$productId', '$clientId', '$productName', '$description', '$ean1', '$ean2', '$sku', '$productType', '$inPrice', '$providerId', '$imgUrl', '$techSpef','$keywords')");
          
           if($query){
               echo "true";
            //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
           }else{
       
               echo "false";
           
               
                                 
                                   
                               }
           
       }

    }
    
    
?>