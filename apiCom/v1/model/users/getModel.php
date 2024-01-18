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
                                        $numRows = mysqli_num_rows($query);

    if ($numRows > 0) {
                                        $response="true";
                                        $message="Consulta exitosa";
                                        $status="202";
                                        $apiMessage="¡Productos seleccionados ($numRows)!";
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
                                            'response' => [
                                                'response' => $response,
                                                'message' => $message,
                                                'apiMessage' => $apiMessage,
                                                'status' => $status,
                                                'sentData'=>$dta
                                            ],
                                            'products' => $values
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
                                            'products' => $values
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
                                        $apiMessage="¡Productos no selleccionados con éxito!";
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
                                            'products' => $values
                                        ];
                                        array_push($values,$value);
                                        
                            
                                //echo json_encode($students) ;
                                return json_encode($responseData);
                                                        }

                                                        
                                    
            }

            public static function getCatalogs($dta) {
            
                


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
                   

            $array = explode("|", $filter);
            $filter=$array[0];
            $ids=$array[1];
           
            $conectar=conn();
            
        
         
     
if($filter=="all"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1");


}

if($filter=="deleted"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=0");


}

          
  
if($filter=="basic"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.$param ='$value' and ca.status=1");


}
  
if($filter=="ecm"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and  ca.isEcommerce=1 and ca.status=1");


}
if($filter=="pos"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.isPos=1 and ca.status=1");


}

if($filter=="internal"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.isInternal=1 and ca.status=1");


}
if($filter=="stocked"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.isStocked=1 and ca.status=1");


}
if($filter=="browser"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and p.keyWords LIKE '%$value%' and ca.status=1");


}

if($filter=="filter"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.storeId='$ids' and p.keyWords LIKE ('%$value%')  and ca.status=1");


}

if($filter=="store"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.storeId='$ids' and ca.status=1");


}


                    if($query){
                        $numRows = mysqli_num_rows($query);

if ($numRows > 0) {
                        $response="true";
                        $message="Consulta exitosa";
                        $status="202";
                        $apiMessage="¡Catálogos seleccionados ($numRows)!";
                        $values=[];

                        while ($row = $query->fetch_assoc()) {
                            $value=[
                                'productId' => $row['productId'],
                                'clientId' => $row['clientId'],
                                'productName' => $row['productName'],
                                'catalogId' => $row['catalogId'],
                                'categoryId' => $row['categoryId'],
                                'stock' => $row['stock'],
                                'secStock' => $row['secStock'],
                                
                                'minQty' => $row['minQty'],
                                'maxQty' => $row['maxQty'],
                                'storeId' => $row['storeId'],
                                'outPrice' => $row['outPrice'],
                                'promoId' => $row['promoId'],
                                'isActive' => $row['isActive'],
                                'discount' => $row['discount'],
                                'isPromo' => $row['isPromo'],
                                'isDiscount' => $row['isDiscount'],
                                'isEcommerce' => $row['isEcommerce'],
                                'isPos' => $row['isPos'],
                                'isInternal' => $row['isInternal'],
                                'isStocked' => $row['isStocked'],
                                'unit' => $row['unit'],
                                'readUnit' => $row['readUnit'],
                                'unitQty' => $row['unitQty'],
                                'unitUnit' => $row['unitUnit'],
                                'storeName' => $row['storeName'],
                                'categoryName' => $row['catName'],
                                'description' => $row['description'],
                                'imgProduct' => $row['imgProduct'],
                                'spcProduct' => $row['spcProduct'],
                                'keyWords' => $row['keyWords']
    
                            ];
                            
                            array_push($values,$value);
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
                            'catalogs' => $values
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
                            'catalogs' => $values
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
                        $apiMessage="¡Catálogos no selleccionados con éxito!";
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
                            'catalogs' => $values
                        ];
                        array_push($values,$value);
                        
            
                //echo json_encode($students) ;
                return json_encode($responseData);
                                        }

                                        
                    
}


public static function getStores($dta) {
            
                


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

          
           
    $query= mysqli_query($conectar,"SELECT storeId,clientId,storeName,comments,isActive,storeType,keyWords FROM generalStores where clientId='$clientId'");


}

if($filter=="browser"){

          
    $query= mysqli_query($conectar,"SELECT storeId,clientId,storeName,comments,isActive,storeType,keyWords FROM generalStores where clientId='$clientId' and keyWords LIKE ('%$value%')");

}

if($filter=="filter"){

          
    $query= mysqli_query($conectar,"SELECT storeId,clientId,storeName,comments,isActive,storeType,keyWords FROM generalStores where clientId='$clientId' and $param='$value'");

}
        if($query){
            $numRows = mysqli_num_rows($query);

if ($numRows > 0) {
            $response="true";
            $message="Consulta exitosa";
            $status="202";
            $apiMessage="¡Tiendas seleccionadas ($numRows)!";
            $values=[];

            while ($row = $query->fetch_assoc()) {
                $value=[
                    'storeId' => $row['storeId'],
                    'storeName' => $row['storeName'],
                    'comments' => $row['comments'],
                    'isActive' => $row['isActive'],
                    'storeType' => $row['storeType'],
                    'clientId' => $row['clientId'],
                    'keyWords' => $row['keyWords']
                ];
                
                array_push($values,$value);
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
                'stores' => $values
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
                'stores' => $values
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
            $apiMessage="¡Tiendas no selleccionados con éxito!";
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
                'stores' => $values
            ];
            array_push($values,$value);
            

    //echo json_encode($students) ;
    return json_encode($responseData);
                            }

                            
        
}


public static function getCategories($dta) {
            
                


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

                        
                        
                    $query= mysqli_query($conectar,"SELECT catId,clientId,catName,comments,isActive,parentId,catType,keyWords FROM generalCategories where clientId='$clientId'");
                


                }

                if($filter=="browser"){

                        
                    $query= mysqli_query($conectar,"SELECT catId,clientId,catName,comments,isActive,parentId,catType,keyWords FROM generalCategories where clientId='$clientId' and keyWords LIKE ('%$value%')");

                }
                if($filter=="filter"){
                        
                    $query= mysqli_query($conectar,"SELECT catId,clientId,catName,comments,isActive,parentId,catType,keyWords FROM generalCategories where clientId='$clientId' and $param='$value'");

                }

        if($query){
            $numRows = mysqli_num_rows($query);

if ($numRows > 0) {
            $response="true";
            $message="Consulta exitosa";
            $status="202";
            $apiMessage="¡Categorías seleccionadas ($numRows)!";
            $values=[];

            while ($row = $query->fetch_assoc()) {
                $value = [
                    'categoryId' => $row['catId'],
                    'categoryName' => $row['catName'],
                    'comments' => $row['comments'],
                    'isActive' => $row['isActive'],
                    'categoryType' => $row['catType'],
                    'clientId' => $row['clientId'],
                    'parentId' => $row['parentId'],
                    'keyWords' => $row['keyWords']
                ];
                
                array_push($values,$value);
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
                'categories' => $values
            ];
            
            return json_encode($responseData);
          //return "hello";
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
                'categories' => $values
            ];
            array_push($values,$value);
            

    //echo json_encode($students) ;
    return json_encode($responseData);
        }

        //  return "true";
        //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
        }else{
            $response="false";
            $message="Error en la consulta: ";
            $status="404";
            $apiMessage="¡Categorías no selleccionados con éxito!";
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
                'categories' => $values
            ];
            array_push($values,$value);
            

    //echo json_encode($students) ;
    return json_encode($responseData);
                            }

                         
        
}
    }


    
?>