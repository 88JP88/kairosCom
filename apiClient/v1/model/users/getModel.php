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
                                        $apiMessage="¡Productos selleccionados con éxito!";
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
                                return json_encode(['responses'=>$values]);
                                                        }

                                                        
                                    
            }

            
        public static function postCatalog($dta) {
            
                
                // Asegúrate de proporcionar la ruta correcta al archivo de conexión a la base de datos
                
                    // Realiza la conexión a la base de datos (reemplaza conn() con tu propia lógica de conexión)
                    $conectar = conn();
            
                    // Verifica si la conexión se realizó correctamente
                    if (!$conectar) {
                        return "Error de conexión a la base de datos";
                    }
            
                    
                        
                    $gen_uuid = new generateUuid();
                    $myuuid = $gen_uuid->guidv4();
                    $catalogId = substr($myuuid, 0, 8);

                    // Escapa los valores para prevenir inyección SQL
                    $clientId = mysqli_real_escape_string($conectar, $dta['clientId']);
                    $productId = mysqli_real_escape_string($conectar, $dta['productId']);
                    $categoryId = mysqli_real_escape_string($conectar, $dta['categoryId']);
                    $stock = mysqli_real_escape_string($conectar, $dta['stock']);
                    $secStock = mysqli_real_escape_string($conectar, $dta['secStock']);
                    $minQty = mysqli_real_escape_string($conectar, $dta['minQty']);
                    $maxQty = mysqli_real_escape_string($conectar, $dta['maxQty']);
                    $storeId = mysqli_real_escape_string($conectar, $dta['storeId']);
                    $outPrice = mysqli_real_escape_string($conectar, $dta['outPrice']);
                    $promoId = mysqli_real_escape_string($conectar, $dta['promoId']);
                    $discount = mysqli_real_escape_string($conectar, $dta['discount']);
                    $unit = mysqli_real_escape_string($conectar, $dta['unit']);
                    $readUnit = mysqli_real_escape_string($conectar, $dta['readUnit']);
                    $unitQty = mysqli_real_escape_string($conectar, $dta['unitQty']);
                    $unitUnit = mysqli_real_escape_string($conectar, $dta['unitUnit']);
                    //$dato_encriptado = $keyword;
                    
            
                    $query = mysqli_query($conectar, "INSERT INTO generalCatalogs (catalogId, clientId, productId, categoryId, stock, secStock, minQty, maxQty, storeId, outPrice, promoId, discount,unit,readUnit,unitQty,unitUnit) VALUES ('$catalogId', '$clientId', '$productId', '$categoryId', $stock, $secStock, $minQty, $maxQty, '$storeId', $outPrice, '$promoId', $discount,'$unit','$readUnit',$unitQty,'$unitUnit')");

                    if($query){
                                $filasAfectadas = mysqli_affected_rows($conectar);
                                    if ($filasAfectadas > 0) 
                                        {
                                            // Éxito: La actualización se realizó correctamente
                                            $response="true";
                                            $message="Creación exitosa. Filas afectadas: $filasAfectadas";
                                            $apiMessage="¡Catálogo creado con éxito!";
                                            $status="201";
                                        } 
                                        else {
                                            $response="false";
                                            $message="Creación no exitosa. Filas afectadas: $filasAfectadas";
                                            $status="500";
                                            $apiMessage="¡Catálogo no credo con éxito!";
                                            }
                            //  return "true";
                            //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
                    }
                    else{
                            $response="true";
                            $message="Error en la actualización: " . mysqli_error($conectar);
                            $status="404";
                            $apiMessage="¡Catálogo no creado con éxito!";
                        
                        }

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


        public static function postSrore($dta) {
    
           


        // Asegúrate de proporcionar la ruta correcta al archivo de conexión a la base de datos
    
        // Realiza la conexión a la base de datos (reemplaza conn() con tu propia lógica de conexión)
        $conectar = conn();

        // Verifica si la conexión se realizó correctamente
        if (!$conectar) {
            return "Error de conexión a la base de datos";
        }

        
            
        $gen_uuid = new generateUuid();
        $myuuid = $gen_uuid->guidv4();
        $storeId = substr($myuuid, 0, 8);

        // Escapa los valores para prevenir inyección SQL
        $clientId = mysqli_real_escape_string($conectar, $dta['clientId']);
        $storeName = mysqli_real_escape_string($conectar, $dta['storeName']);
        $comments = mysqli_real_escape_string($conectar, $dta['comments']);
        $storeType = mysqli_real_escape_string($conectar, $dta['storeType']);
        //$dato_encriptado = $keyword;
        

        $keywords=$storeName." ".$comments." ".$storeType;
        $query = mysqli_query($conectar, "INSERT INTO generalStores (storeId, storeName, clientId, comments, storeType,keyWords) VALUES ('$storeId', '$storeName', '$clientId', '$comments', '$storeType','$keywords')");

        if($query){
            $filasAfectadas = mysqli_affected_rows($conectar);
            if ($filasAfectadas > 0) {
                // Éxito: La actualización se realizó correctamente
            $response="true";
            $message="Creación exitosa. Filas afectadas: $filasAfectadas";
            $apiMessage="¡Tienda creada con éxito!";
                $status="201";
            } else {
                $response="false";
            $message="Creación no exitosa. Filas afectadas: $filasAfectadas";
                $status="500";
                $apiMessage="¡Tienda no creda con éxito!";
            }
        //  return "true";
        //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
        }else{
            $response="true";
            $message="Error en la actualización: " . mysqli_error($conectar);
            $status="404";
            $apiMessage="¡Tienda no creada con éxito!";
        
                            }

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

    public static function postCategorie($dta) {
    
           


        // Asegúrate de proporcionar la ruta correcta al archivo de conexión a la base de datos
    
        // Realiza la conexión a la base de datos (reemplaza conn() con tu propia lógica de conexión)
        $conectar = conn();

        // Verifica si la conexión se realizó correctamente
        if (!$conectar) {
            return "Error de conexión a la base de datos";
        }

        
            
        $gen_uuid = new generateUuid();
        $myuuid = $gen_uuid->guidv4();
        $categoryId = substr($myuuid, 0, 8);

        // Escapa los valores para prevenir inyección SQL
        $clientId = mysqli_real_escape_string($conectar, $dta['clientId']);
        $categoryName = mysqli_real_escape_string($conectar, $dta['categoryName']);
        $comments = mysqli_real_escape_string($conectar, $dta['comments']);
        $parentId = mysqli_real_escape_string($conectar, $dta['parentId']);
        $categoryType = mysqli_real_escape_string($conectar, $dta['categoryType']);
        //$dato_encriptado = $keyword;
        
        $keywords=$categoryName." ".$comments." ".$categoryType;

        if($categoryType=="main"){
$parentId=$categoryId;
        }
        
        $query = mysqli_query($conectar, "INSERT INTO generalCategories (catId, clientId, catName, comments, parentId,catType,keyWords) VALUES ('$categoryId', '$clientId', '$categoryName', '$comments', '$parentId','$categoryType','$keywords')");

        if($query){
            $filasAfectadas = mysqli_affected_rows($conectar);
            if ($filasAfectadas > 0) {
                // Éxito: La actualización se realizó correctamente
            $response="true";
            $message="Creación exitosa. Filas afectadas: $filasAfectadas";
            $apiMessage="¡Categoría creada con éxito!";
                $status="201";
            } else {
                $response="false";
            $message="Creación no exitosa. Filas afectadas: $filasAfectadas";
                $status="500";
                $apiMessage="¡Categoría no creda con éxito!";
            }
        //  return "true";
        //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
        }else{
            $response="true";
            $message="Error en la actualización: " . mysqli_error($conectar);
            $status="404";
            $apiMessage="¡Categoría no creada con éxito!";
        
                            }

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


class modelPut{

        public static function putDelivery($dta) {
            
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
        

        $query = mysqli_query($conectar, "UPDATE generalDelivery SET $param='$value' where clientId='$clientId' and deliveryId='$deliveryId'");
    
        if($query){
            $filasAfectadas = mysqli_affected_rows($conectar);
            if ($filasAfectadas > 0) {
                // Éxito: La actualización se realizó correctamente
            $response="true";
            $message="Actualización exitosa. Filas afectadas: $filasAfectadas";
            $apiMessage="¡Repartidor actualizado con éxito!";
                $status="201";
            } else {
                $response="false";
            $message="Actualización no exitosa. Filas afectadas: $filasAfectadas";
                $status="500";
                $apiMessage="¡Repartidor no actualizado con éxito!";
            }
        //  return "true";
        //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
        }else{
            $response="true";
            $message="Error en la actualización: " . mysqli_error($conectar);
            $status="404";
            $apiMessage="¡Repartidor no actualizado con éxito!";
        
                            }

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
            public static function putProduct($dta) {
            
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
                $productId = mysqli_real_escape_string($conectar, $dta['productId']);
            
                //$dato_encriptado = $keyword;
                
        
                if($param=="isEcommerce" && $value=="1" || $param=="isPos" && $value=="1"){
                    $query = mysqli_query($conectar, "UPDATE generalProducts SET $param='$value' ,isStocked=0,isInternal=0 where clientId='$clientId' and productId='$productId'");

                }
                if($param=="isStocked" && $value=="1"){
                    $query = mysqli_query($conectar, "UPDATE generalProducts SET $param='$value' ,isEcommerce=0,isPos=0,isInternal=0 where clientId='$clientId' and productId='$productId'");

                }
                if($param=="isInternal" && $value=="1"){
                    $query = mysqli_query($conectar, "UPDATE generalProducts SET $param='$value' ,isEcommerce=0,isPos=0,isStocked=0 where clientId='$clientId' and productId='$productId'");

                }else{
                    $query = mysqli_query($conectar, "UPDATE generalProducts SET $param='$value' where clientId='$clientId' and productId='$productId'");

                }
                if($query){
                    $filasAfectadas = mysqli_affected_rows($conectar);
                    if ($filasAfectadas > 0) {
                        // Éxito: La actualización se realizó correctamente
                    $response="true";
                    $message="Actualización exitosa. Filas afectadas: $filasAfectadas";
                    $apiMessage="¡Producto actualizado con éxito!";
                        $status="201";
                    } else {
                        $response="false";
                    $message="Actualización no exitosa. Filas afectadas: $filasAfectadas";
                        $status="500";
                        $apiMessage="¡Producto no actualizado con éxito!";
                    }
                //  return "true";
                //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
                }else{
                    $response="true";
                    $message="Error en la actualización: " . mysqli_error($conectar);
                    $status="404";
                    $apiMessage="¡Producto no actualizado con éxito!";
                
                                    }
        
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
    
?>