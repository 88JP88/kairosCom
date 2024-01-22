<?php

require 'flight/Flight.php';
require_once 'database/db_users.php';
require_once 'model/users/postModel.php';
require_once 'model/users/responses.php';
require 'model/modelSecurity/authModule.php';
require_once 'env/domain.php';
require_once 'kronos/postLog.php';
require_once 'model/users/getModel.php';



Flight::route('POST /postProduct/@apk/@xapk', function ($apk,$xapk) {
  
        

            header("Access-Control-Allow-Origin: *");
            // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
            if (!empty($apk) && !empty($xapk)) {    
            


                $response11=modelAuth::authModel($apk,$xapk);//AUTH MODULE


        //DATA EXTRACTION ARRAY - JSON CONVERT
      
        $postData = Flight::request()->data->getData();
        $dt=json_encode($postData);
        //DATA EXTRACTION**


                if ($response11 == 'true' ) {
                   
                $query= modelPost::postProduct($postData);  //DATA MODAL

            //JSON DECODE RESPPNSE
                $data = json_decode($query, true);
                $responseSQL=$data['response'][0]['response'];
                $messageSQL=$data['response'][0]['message'];
                $apiMessageSQL=$data['response'][0]['apiMessage'];
                $apiStatusSQL=$data['response'][0]['status'];
                //JSON DECODE**

                } else {
                    $responseSQL="false";
                    $apiMessageSQL="¡Autenticación fallida!";
                    $apiStatusSQL="401";
                    $messageSQL="¡Autenticación fallida!";

                }
            } else {

                $responseSQL="false";
                $apiMessageSQL="¡Encabezados faltantes!";
                $apiStatusSQL="403";
                $messageSQL="¡Encabezados faltantes!";
            }

        
               // kronos($responseSQL,$apiMessageSQL,$apiMessageSQL,Flight::request()->data->clientId,$dt,Flight::request()->url,'RECEIVED',Flight::request()->data->trackId);  //LOG FUNCTION  
        
        echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

});


Flight::route('POST /postCatalog/@apk/@xapk', function ($apk,$xapk) {
  
          
                
                
            header("Access-Control-Allow-Origin: *");
            // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
            if (!empty($apk) && !empty($xapk)) {    
            


                $response11=modelAuth::authModel($apk,$xapk);//AUTH MODULE


        //DATA EXTRACTION ARRAY - JSON CONVERT
        $dta = array(
        
            'clientId' =>Flight::request()->data->clientId,
            
            'productId' => Flight::request()->data->productId,
            'categoryId' => Flight::request()->data->categoryId,
            'stock' => Flight::request()->data->stock,
            'secStock' => Flight::request()->data->secStock,
            'minQty' => Flight::request()->data->minQty,
            'maxQty' => Flight::request()->data->maxQty,
            'storeId' => Flight::request()->data->storeId,
            'outPrice' => Flight::request()->data->outPrice,
            'promoId' => Flight::request()->data->promoId,
            'discount' => Flight::request()->data->discount,
            'unit' => Flight::request()->data->unit,
            'readUnit' => Flight::request()->data->readUnit,
            'unitQty' => Flight::request()->data->unitQty,
            'unitUnit' => Flight::request()->data->unitUnit
        );
        $dt=json_encode($dta);
        //DATA EXTRACTION**


                if ($response11 == 'true' ) {

                $query= modelPost::postCatalog($dta);  //DATA MODAL

            //JSON DECODE RESPPNSE
                $data = json_decode($query, true);
                $responseSQL=$data['response'][0]['response'];
                $messageSQL=$data['response'][0]['message'];
                $apiMessageSQL=$data['response'][0]['apiMessage'];
                $apiStatusSQL=$data['response'][0]['status'];
                //JSON DECODE**

                } else {
                    $responseSQL="false";
                    $apiMessageSQL="¡Autenticación fallida!";
                    $apiStatusSQL="401";
                    $messageSQL="¡Autenticación fallida!";

                }
            } else {

                $responseSQL="false";
                $apiMessageSQL="¡Encabezados faltantes!";
                $apiStatusSQL="403";
                $messageSQL="¡Encabezados faltantes!";
            }

        
                kronos($responseSQL,$apiMessageSQL,$apiMessageSQL,Flight::request()->data->clientId,$dt,Flight::request()->url,'RECEIVED',Flight::request()->data->trackId);  //LOG FUNCTION  
        
        echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

});


Flight::route('POST /postStore/@apk/@xapk', function ($apk,$xapk) {
  
         
                    
            header("Access-Control-Allow-Origin: *");
            // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
            if (!empty($apk) && !empty($xapk)) {    
            


                $response11=modelAuth::authModel($apk,$xapk);//AUTH MODULE


        //DATA EXTRACTION ARRAY - JSON CONVERT
        $dta = array(
        
            'clientId' =>Flight::request()->data->clientId,
            
            'storeName' => Flight::request()->data->storeName,
            'comments' => Flight::request()->data->comments,
            'storeType' => Flight::request()->data->storeType
        );
        $dt=json_encode($dta);
        //DATA EXTRACTION**


                if ($response11 == 'true' ) {

                $query= modelPost::postSrore($dta);  //DATA MODAL

            //JSON DECODE RESPPNSE
                $data = json_decode($query, true);
                $responseSQL=$data['response'][0]['response'];
                $messageSQL=$data['response'][0]['message'];
                $apiMessageSQL=$data['response'][0]['apiMessage'];
                $apiStatusSQL=$data['response'][0]['status'];
                //JSON DECODE**

                } else {
                    $responseSQL="false";
                    $apiMessageSQL="¡Autenticación fallida!";
                    $apiStatusSQL="401";
                    $messageSQL="¡Autenticación fallida!";

                }
            } else {

                $responseSQL="false";
                $apiMessageSQL="¡Encabezados faltantes!";
                $apiStatusSQL="403";
                $messageSQL="¡Encabezados faltantes!";
            }

        
                kronos($responseSQL,$apiMessageSQL,$apiMessageSQL,Flight::request()->data->clientId,$dt,Flight::request()->url,'RECEIVED',Flight::request()->data->trackId);  //LOG FUNCTION  
        
        echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

});


Flight::route('POST /postCategorie/@apk/@xapk', function ($apk,$xapk) {
  
           

                    $clientId= Flight::request()->data->clientId;
                    $categoryName= Flight::request()->data->categoryName;
                    $comments= Flight::request()->data->comments;
                    $parentId= Flight::request()->data->parentId;
                    $categoryType= Flight::request()->data->categoryType;


            header("Access-Control-Allow-Origin: *");
            // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
            if (!empty($apk) && !empty($xapk)) {    
            


                $response11=modelAuth::authModel($apk,$xapk);//AUTH MODULE


        //DATA EXTRACTION ARRAY - JSON CONVERT
        $dta = array(
        
            'clientId' =>Flight::request()->data->clientId,
            
            'categoryName' => Flight::request()->data->categoryName,
            'comments' => Flight::request()->data->comments,
            'parentId' => Flight::request()->data->parentId,
            'categoryType' => Flight::request()->data->categoryType
        );
        $dt=json_encode($dta);
        //DATA EXTRACTION**


                if ($response11 == 'true' ) {

                $query= modelPost::postCategorie($dta);  //DATA MODAL

            //JSON DECODE RESPPNSE
                $data = json_decode($query, true);
                $responseSQL=$data['response'][0]['response'];
                $messageSQL=$data['response'][0]['message'];
                $apiMessageSQL=$data['response'][0]['apiMessage'];
                $apiStatusSQL=$data['response'][0]['status'];
                //JSON DECODE**

                } else {
                    $responseSQL="false";
                    $apiMessageSQL="¡Autenticación fallida!";
                    $apiStatusSQL="401";
                    $messageSQL="¡Autenticación fallida!";

                }
            } else {

                $responseSQL="false";
                $apiMessageSQL="¡Encabezados faltantes!";
                $apiStatusSQL="403";
                $messageSQL="¡Encabezados faltantes!";
            }

        
                kronos($responseSQL,$apiMessageSQL,$apiMessageSQL,Flight::request()->data->clientId,$dt,Flight::request()->url,'RECEIVED',Flight::request()->data->trackId);  //LOG FUNCTION  
        
        echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

});



Flight::route('GET /getProducts/@clientId/@filter/@param/@value', function ($clientId,$filter,$param,$value) {
    header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) ) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];

        $response1=modelAuth::authModel($apiKey,$xApiKey);//AUTH MODULE

        if ($response1 == 'true' ) {
           
            $dta = array(
        
                'clientId' =>$clientId,
                
                'filter' => $filter,
                'param' => $param,
                'value' => $value
            );

echo modelGet::getProducts($dta);
           

}else { 
    
    $responseSQL="false";
    $apiMessageSQL="¡Autenticación fallida!";
    $apiStatusSQL="401";
    $messageSQL="¡Autenticación fallida!";
    echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

}
} else {

$responseSQL="false";
$apiMessageSQL="¡Encabezados faltantes!";
$apiStatusSQL="403";
$messageSQL="¡Encabezados faltantes!";
echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

}
});



Flight::route('GET /getCatalogs/@clientId/@filter/@param/@value', function ($clientId,$filter,$param,$value) {
   
    header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) ) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];

        $response1=modelAuth::authModel($apiKey,$xApiKey);//AUTH MODULE

        if ($response1 == 'true' ) {
           
            $dta = array(
        
                'clientId' =>$clientId,
                
                'filter' => $filter,
                'param' => $param,
                'value' => $value
            );

echo modelGet::getCatalogs($dta);
           

}else { 
    
    $responseSQL="false";
    $apiMessageSQL="¡Autenticación fallida!";
    $apiStatusSQL="401";
    $messageSQL="¡Autenticación fallida!";
    echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

}
} else {

$responseSQL="false";
$apiMessageSQL="¡Encabezados faltantes!";
$apiStatusSQL="403";
$messageSQL="¡Encabezados faltantes!";
echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

}
});



Flight::route('GET /getStores/@clientId/@filter/@param/@value', function ($clientId,$filter,$param,$value) {
    header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) ) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];

        $response1=modelAuth::authModel($apiKey,$xApiKey);//AUTH MODULE

        if ($response1 == 'true' ) {
           
            $dta = array(
        
                'clientId' =>$clientId,
                
                'filter' => $filter,
                'param' => $param,
                'value' => $value
            );

echo modelGet::getStores($dta);
           

}else { 
    
    $responseSQL="false";
    $apiMessageSQL="¡Autenticación fallida!";
    $apiStatusSQL="401";
    $messageSQL="¡Autenticación fallida!";
    echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

}
} else {

$responseSQL="false";
$apiMessageSQL="¡Encabezados faltantes!";
$apiStatusSQL="403";
$messageSQL="¡Encabezados faltantes!";
echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

}
});



Flight::route('GET /getCategories/@clientId/@filter/@param/@value', function ($clientId,$filter,$param,$value) {
    header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) ) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];

        $response1=modelAuth::authModel($apiKey,$xApiKey);//AUTH MODULE
        $dta = array(
        
            'clientId' =>$clientId,
            
            'filter' => $filter,
            'param' => $param,
            'value' => $value
        );
        if ($response1 == 'true' ) {
           
            $dta = array(
        
                'clientId' =>$clientId,
                
                'filter' => $filter,
                'param' => $param,
                'value' => $value
            );

echo modelGet::getCategories($dta);
//  echo json_encode($dta);         

}else { 
    
    $responseSQL="false";
    $apiMessageSQL="¡Autenticación fallida!";
    $apiStatusSQL="401";
    $messageSQL="¡Autenticación fallida!";
    echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

}
} else {

$responseSQL="false";
$apiMessageSQL="¡Encabezados faltantes!";
$apiStatusSQL="403";
$messageSQL="¡Encabezados faltantes!";
echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

}
});


Flight::route('POST /putProduct/@apk/@xapk', function ($apk,$xapk) {
    header("Access-Control-Allow-Origin: *");
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apk) && !empty($xapk)) {    
    


        $response11=modelAuth::authModel($apk,$xapk);//AUTH MODULE


//DATA EXTRACTION ARRAY - JSON CONVERT
$dta = array(
        
    'clientId' =>Flight::request()->data->clientId,
    'param' => Flight::request()->data->param,
    'value' => Flight::request()->data->value,
    'productId' => Flight::request()->data->productId
);
$dt=json_encode($dta);
//DATA EXTRACTION**


        if ($response11 == 'true' ) {

        $query= modelPut::putProduct($dta);  //DATA MODAL

    //JSON DECODE RESPPNSE
        $data = json_decode($query, true);
        $responseSQL=$data['response'][0]['response'];
        $messageSQL=$data['response'][0]['message'];
        $apiMessageSQL=$data['response'][0]['apiMessage'];
        $apiStatusSQL=$data['response'][0]['status'];
        //JSON DECODE**

        } else {
            $responseSQL="false";
            $apiMessageSQL="¡Autenticación fallida!";
            $apiStatusSQL="401";
            $messageSQL="¡Autenticación fallida!";

        }
    } else {

        $responseSQL="false";
        $apiMessageSQL="¡Encabezados faltantes!";
        $apiStatusSQL="403";
        $messageSQL="¡Encabezados faltantes!";
    }


        kronos($responseSQL,$apiMessageSQL,$apiMessageSQL,Flight::request()->data->clientId,$dt,Flight::request()->url,'RECEIVED',Flight::request()->data->trackId);  //LOG FUNCTION  

echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

});

Flight::route('POST /putCategorie/@apk/@xapk', function ($apk,$xapk) {
  
    header("Access-Control-Allow-Origin: *");
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apk) && !empty($xapk)) {    
    


        $response11=modelAuth::authModel($apk,$xapk);//AUTH MODULE


//DATA EXTRACTION ARRAY - JSON CONVERT
$dta = array(
        
    'clientId' =>Flight::request()->data->clientId,
    'param' => Flight::request()->data->param,
    'value' => Flight::request()->data->value,
    'categoryId' => Flight::request()->data->categoryId
);
$dt=json_encode($dta);
//DATA EXTRACTION**


        if ($response11 == 'true' ) {

        $query= modelPut::putCategorie($dta);  //DATA MODAL

    //JSON DECODE RESPPNSE
        $data = json_decode($query, true);
        $responseSQL=$data['response'][0]['response'];
        $messageSQL=$data['response'][0]['message'];
        $apiMessageSQL=$data['response'][0]['apiMessage'];
        $apiStatusSQL=$data['response'][0]['status'];
        //JSON DECODE**

        } else {
            $responseSQL="false";
            $apiMessageSQL="¡Autenticación fallida!";
            $apiStatusSQL="401";
            $messageSQL="¡Autenticación fallida!";

        }
    } else {

        $responseSQL="false";
        $apiMessageSQL="¡Encabezados faltantes!";
        $apiStatusSQL="403";
        $messageSQL="¡Encabezados faltantes!";
    }


       // kronos($responseSQL,$apiMessageSQL,$apiMessageSQL,Flight::request()->data->clientId,$dt,Flight::request()->url,'RECEIVED',Flight::request()->data->trackId);  //LOG FUNCTION  

echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

});


Flight::route('POST /putStore/@apk/@xapk', function ($apk,$xapk) {
  
    header("Access-Control-Allow-Origin: *");
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apk) && !empty($xapk)) {    
    


        $response11=modelAuth::authModel($apk,$xapk);//AUTH MODULE


//DATA EXTRACTION ARRAY - JSON CONVERT
$dta = array(
        
    'clientId' =>Flight::request()->data->clientId,
    'param' => Flight::request()->data->param,
    'value' => Flight::request()->data->value,
    'storeId' => Flight::request()->data->storeId
);
$dt=json_encode($dta);
//DATA EXTRACTION**


        if ($response11 == 'true' ) {

        $query= modelPut::putStore($dta);  //DATA MODAL

    //JSON DECODE RESPPNSE
        $data = json_decode($query, true);
        $responseSQL=$data['response'][0]['response'];
        $messageSQL=$data['response'][0]['message'];
        $apiMessageSQL=$data['response'][0]['apiMessage'];
        $apiStatusSQL=$data['response'][0]['status'];
        //JSON DECODE**

        } else {
            $responseSQL="false";
            $apiMessageSQL="¡Autenticación fallida!";
            $apiStatusSQL="401";
            $messageSQL="¡Autenticación fallida!";

        }
    } else {

        $responseSQL="false";
        $apiMessageSQL="¡Encabezados faltantes!";
        $apiStatusSQL="403";
        $messageSQL="¡Encabezados faltantes!";
    }


       // kronos($responseSQL,$apiMessageSQL,$apiMessageSQL,Flight::request()->data->clientId,$dt,Flight::request()->url,'RECEIVED',Flight::request()->data->trackId);  //LOG FUNCTION  

echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

});




Flight::route('POST /putCatalog/@apk/@xapk', function ($apk,$xapk) {
  
    header("Access-Control-Allow-Origin: *");
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apk) && !empty($xapk)) {    
    


        $response11=modelAuth::authModel($apk,$xapk);//AUTH MODULE


//DATA EXTRACTION ARRAY - JSON CONVERT
$dta = array(
        
    'clientId' =>Flight::request()->data->clientId,
    'param' => Flight::request()->data->param,
    'value' => Flight::request()->data->value,
    'catalogId' => Flight::request()->data->catalogId
);
$dt=json_encode($dta);
//DATA EXTRACTION**


        if ($response11 == 'true' ) {

        $query= modelPut::putCatalog($dta);  //DATA MODAL

    //JSON DECODE RESPPNSE
        $data = json_decode($query, true);
        $responseSQL=$data['response'][0]['response'];
        $messageSQL=$data['response'][0]['message'];
        $apiMessageSQL=$data['response'][0]['apiMessage'];
        $apiStatusSQL=$data['response'][0]['status'];
        //JSON DECODE**

        } else {
            $responseSQL="false";
            $apiMessageSQL="¡Autenticación fallida!";
            $apiStatusSQL="401";
            $messageSQL="¡Autenticación fallida!";

        }
    } else {

        $responseSQL="false";
        $apiMessageSQL="¡Encabezados faltantes!";
        $apiStatusSQL="403";
        $messageSQL="¡Encabezados faltantes!";
    }


       // kronos($responseSQL,$apiMessageSQL,$apiMessageSQL,Flight::request()->data->clientId,$dt,Flight::request()->url,'RECEIVED',Flight::request()->data->trackId);  //LOG FUNCTION  

echo modelResponse::responsePost($responseSQL,$apiMessageSQL,$apiStatusSQL,$messageSQL);//RESPONSE FUNCTION

});




Flight::route('POST /postCatalogBulk/@apk/@xapk', function ($apk,$xapk) {
            
    header("Access-Control-Allow-Origin: *");
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apk) && !empty($xapk)) {    
        // Leer los datos de la solicitud
    




        




        $sub_domaincon=new model_domain();
        $sub_domain=$sub_domaincon->domKairos();
        $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKey/';
    
        $data = array(
            'apiKey' =>$apk, 
            'xApiKey' => $xapk
        
        );
    $curl = curl_init();
    
    // Configurar las opciones de la sesión cURL
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
    // Ejecutar la solicitud y obtener la respuesta
    $response11 = curl_exec($curl);

    


    curl_close($curl);

    

        // Realizar acciones basadas en los valores de los encabezados


        if ($response11 == 'true' ) {


            $bulk= Flight::request()->data->bulk;
            $clientId= Flight::request()->data->clientId;
        

            require_once '../../apiClient/v1/model/modelSecurity/uuid/uuidd.php';
        
        
            $gen_uuid = new generateUuid();
    
        // $orderId = substr($myuuid1, 0, 8);

            $conectar=conn();
        



$decodedData = urldecode($bulk);
$arrayData = json_decode($decodedData, true);

foreach ($arrayData as $item) {
    if (isset($item['item'])) {
        $myuuid = $gen_uuid->guidv4();
        //$myuuid1 = $gen_uuid->guidv4();
    

        $catalogId = substr($myuuid, 0, 8);
        $productId= $item['item']['productId'];
        $categoryId= $item['item']['categoryId'];
        $stock= $item['item']['stock'];
        $secStock= $item['item']['secStock'];
        $minQty= $item['item']['minQty'];
        $maxQty= $item['item']['maxQty'];
        $storeId= $item['item']['storeId'];
        $outPrice= $item['item']['outPrice'];
        $promoId= $item['item']['promoId'];
        $discount= $item['item']['discount'];
        $isPromo= $item['item']['isPromo'];
        $isDiscount= $item['item']['isDiscount'];
        $isEcommerce= $item['item']['isEcommerce'];
        $isPos= $item['item']['isPos'];
        $isInternal= $item['item']['isInternal'];
        $isStocked= $item['item']['isStocked'];
        $unit= $item['item']['unit'];
        $readUnit= $item['item']['readUnit'];
        $unitUnit= $item['item']['unit'];
        $isActive= $item['item']['isActive'];
        // Resto de tus variables aquí...

        // Tu consulta SQL aquí...



        $query3 = mysqli_query($conectar, "SELECT COUNT(productId) as proId from generalProducts WHERE productId='$productId' AND clientId='$clientId'");
        $query4 = mysqli_query($conectar, "SELECT COUNT(storeId) as stId from generalStores WHERE storeId='$storeId' AND clientId='$clientId'");
        $query5 = mysqli_query($conectar, "SELECT COUNT(catId) as catId from generalCategories WHERE catId='$categoryId' AND clientId='$clientId'");

            // Verificar si la consulta fue exitosa
            
                // Obtener la primera fila como un arreglo asociativo
                $fila = $query3->fetch_assoc();
                $fila1 = $query4->fetch_assoc();
                $fila2 = $query5->fetch_assoc();
            
                // Verificar si la fila tiene datos
                if ($fila && $fila1 && $fila2) {
                    // Obtener el valor de la columna 'coId'
                    $product = $fila['proId'];
                    $store = $fila1['stId'];
                    $cat = $fila2['catId'];

                    if($product>=1 && $store>=1 && $cat>=1){
                        $query = mysqli_query($conectar, "INSERT INTO generalCatalogs 
                        (catalogId, clientId, productId, categoryId, stock, secStock, minQty, maxQty, storeId, outPrice, promoId, discount,unit,readUnit,unitQty,unitUnit,isPromo,isDiscount,isEcommerce,isPos,isInternal,isStocked,isActive) 
                        VALUES
                        ('$catalogId', '$clientId', '$productId', '$categoryId', $stock, $secStock, $minQty, $maxQty, '$storeId', $outPrice, '$promoId', $discount,'$unit','$readUnit',1,'$unitUnit',$isPromo,$isDiscount,$isEcommerce,$isPos,$isInternal,$isStocked,$isActive)");
                
                    }
                // echo "El valor máximo de incId es: " . $valor;
                } else {


                }
                //  echo "N
    // $query = mysqli_query($conectar, "INSERT INTO posCar (carId, clientId, uniqueId, productId, catalogId, outPrice, productQty, discount, promotion, salePrice, inDate, inTime, storeId, categoryId, storeName, categoryName, saver, userId, fromStore, fromIp, fromBrowser) VALUES ('$cartId', '$clientId', '$uniqueId', '$productId', '$catalogId', $salePrice, $productQty, $discount, '$promotion', $outPrice, '$fechaBogota', '$hora_actual_bogota', '$storeId', '$categoryId', '$storeName', '$categoryName', $saver, '$userId', '$storeName', '$fromIp', '$fromBrowser')");
    
    
    
    
        // Verifica si la consulta se ejecutó correctamente y maneja los errores si es necesario
    
}}

        echo "true|¡Catálogo creado con éxito!"; 
        
        // echo json_encode($response1);
        } else {
            $response12='false|¡Autenticación fallida!'.$response11;

            //inicio de log
            require_once 'kronos/postLog.php';
       
            $backtrace = debug_backtrace();
            $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
            $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
           $justFileName = basename($currentFile);
           $rutaCompleta = __DIR__;
           $status = http_response_code();
           $cid=Flight::request()->data->clientId;
           
           //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
           $array = explode("|", $response12);
           $response12=$array[0];
           $message=$array[1];
           kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');
           //final de log
            echo 'false|¡Autenticación fallida!'.$response11;
        // echo json_encode($data);
        }
    } else {

        $response12='false|¡Encabezados faltantes!';

        //inicio de log
        require_once 'kronos/postLog.php';
   
        $backtrace = debug_backtrace();
        $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
        $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
       $justFileName = basename($currentFile);
       $rutaCompleta = __DIR__;
       $status = http_response_code();
       $cid=Flight::request()->data->clientId;
       
       //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
       $array = explode("|", $response12);
       $response12=$array[0];
       $message=$array[1];
       kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

       //final de log
        echo 'false|¡Encabezados faltantes!';
    }
});


Flight::route('POST /putCatalogBulk/@apk/@xapk', function ($apk,$xapk) {

header("Access-Control-Allow-Origin: *");
// Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
if (!empty($apk) && !empty($xapk)) {    
    // Leer los datos de la solicitud





    




    $sub_domaincon=new model_domain();
    $sub_domain=$sub_domaincon->domKairos();
    $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKey/';

    $data = array(
        'apiKey' =>$apk, 
        'xApiKey' => $xapk
    
    );
$curl = curl_init();

// Configurar las opciones de la sesión cURL
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Ejecutar la solicitud y obtener la respuesta
$response11 = curl_exec($curl);




curl_close($curl);



    // Realizar acciones basadas en los valores de los encabezados


    if ($response11 == 'true' ) {


        $bulk= Flight::request()->data->bulk;
        $clientId= Flight::request()->data->clientId;
    

    
    // $orderId = substr($myuuid1, 0, 8);

        $conectar=conn();
    



$decodedData = urldecode($bulk);
$arrayData = json_decode($decodedData, true);

foreach ($arrayData as $item) {
if (isset($item['item'])) {
    $catalogId= $item['item']['catalogId'];

    $categoryId= $item['item']['categoryId'];
    $stock= $item['item']['stock'];
    $secStock= $item['item']['secStock'];
    $minQty= $item['item']['minQty'];
    $maxQty= $item['item']['maxQty'];
    $storeId= $item['item']['storeId'];
    $outPrice= $item['item']['outPrice'];
    $promoId= $item['item']['promoId'];
    $discount= $item['item']['discount'];
    $isPromo= $item['item']['isPromo'];
    $isDiscount= $item['item']['isDiscount'];
    $isEcommerce= $item['item']['isEcommerce'];
    $isPos= $item['item']['isPos'];
    $isInternal= $item['item']['isInternal'];
    $isStocked= $item['item']['isStocked'];
    $unit= $item['item']['unit'];
    $readUnit= $item['item']['readUnit'];
    $unitUnit= $item['item']['unit'];
    $isActive= $item['item']['isActive'];
    // Resto de tus variables aquí...

    // Tu consulta SQL aquí...




            // Verificar si la fila tiene datos
    
                // Obtener el valor de la columna 'coId'
            
    $query3 = mysqli_query($conectar, "SELECT COUNT(catalogId) as proId from generalCatalogs WHERE catalogId='$catalogId' AND clientId='$clientId'");
    $query4 = mysqli_query($conectar, "SELECT COUNT(storeId) as stId from generalStores WHERE storeId='$storeId' AND clientId='$clientId'");
    $query5 = mysqli_query($conectar, "SELECT COUNT(catId) as catId from generalCategories WHERE catId='$categoryId' AND clientId='$clientId'");

        // Verificar si la consulta fue exitosa
        
            // Obtener la primera fila como un arreglo asociativo
            $fila = $query3->fetch_assoc();
            $fila1 = $query4->fetch_assoc();
            $fila2 = $query5->fetch_assoc();
        
            // Verificar si la fila tiene datos
            if ($fila && $fila1 && $fila2) {
                // Obtener el valor de la columna 'coId'
                $product = $fila['proId'];
                $store = $fila1['stId'];
                $cat = $fila2['catId'];

                if($product>=1 && $store>=1 && $cat>=1){
                
                    $query = mysqli_query($conectar, "UPDATE generalCatalogs SET categoryId='$categoryId',stock=$stock,secStock=$secStock,minQty='$minQty',maxQty='$maxQty',storeId='$storeId',outPrice='$outPrice',promoId='$promoId',discount='$discount',isPromo='$isPromo',isDiscount='$isDiscount',isEcommerce='$isEcommerce',isPos='$isPos',isInternal='$isInternal',isStocked='$isStocked',unit='$unit',readUnit='$readUnit',unitUnit='$unitUnit',isActive='$isActive'
                    WHERE
                    catalogId='$catalogId' and clientId='$clientId'");
                }
            // echo "El valor máximo de incId es: " . $valor;
            } else {


            }

            
            
                
            // echo "El valor máximo de incId es: " . $valor;
        
            //  echo "N
// $query = mysqli_query($conectar, "INSERT INTO posCar (carId, clientId, uniqueId, productId, catalogId, outPrice, productQty, discount, promotion, salePrice, inDate, inTime, storeId, categoryId, storeName, categoryName, saver, userId, fromStore, fromIp, fromBrowser) VALUES ('$cartId', '$clientId', '$uniqueId', '$productId', '$catalogId', $salePrice, $productQty, $discount, '$promotion', $outPrice, '$fechaBogota', '$hora_actual_bogota', '$storeId', '$categoryId', '$storeName', '$categoryName', $saver, '$userId', '$storeName', '$fromIp', '$fromBrowser')");




    // Verifica si la consulta se ejecutó correctamente y maneja los errores si es necesario

}}

    echo "true|¡Catálogo actualizado con éxito!"; 
    
    // echo json_encode($response1);
    } else {
        $response12='false|¡Autenticación fallida!'.$response11;

        //inicio de log
        require_once 'kronos/postLog.php';
   
        $backtrace = debug_backtrace();
        $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
        $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
       $justFileName = basename($currentFile);
       $rutaCompleta = __DIR__;
       $status = http_response_code();
       $cid=Flight::request()->data->clientId;
       
       //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
       $array = explode("|", $response12);
       $response12=$array[0];
       $message=$array[1];
       kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

       //final de log
        echo 'false|¡Autenticación fallida!'.$response11;
    // echo json_encode($data);
    }
} else {

    $response12='false|¡Encabezados faltantes!';

    //inicio de log
    require_once 'kronos/postLog.php';

    $backtrace = debug_backtrace();
    $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
    $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
   $justFileName = basename($currentFile);
   $rutaCompleta = __DIR__;
   $status = http_response_code();
   $cid=Flight::request()->data->clientId;
   
   //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
   $array = explode("|", $response12);
   $response12=$array[0];
   $message=$array[1];
   kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

   //final de log
    echo 'false|¡Encabezados faltantes!';
}
});


Flight::route('POST /postProductBulk/@apk/@xapk', function ($apk,$xapk) {

header("Access-Control-Allow-Origin: *");
// Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
if (!empty($apk) && !empty($xapk)) {    
    // Leer los datos de la solicitud





    




    $sub_domaincon=new model_domain();
    $sub_domain=$sub_domaincon->domKairos();
    $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKey/';

    $data = array(
        'apiKey' =>$apk, 
        'xApiKey' => $xapk
    
    );
$curl = curl_init();

// Configurar las opciones de la sesión cURL
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Ejecutar la solicitud y obtener la respuesta
$response11 = curl_exec($curl);




curl_close($curl);



    // Realizar acciones basadas en los valores de los encabezados


    if ($response11 == 'true' ) {


        $bulk= Flight::request()->data->bulk;
        $clientId= Flight::request()->data->clientId;
    

        require_once '../../apiClient/v1/model/modelSecurity/uuid/uuidd.php';
    
    
        $gen_uuid = new generateUuid();

    // $orderId = substr($myuuid1, 0, 8);

        $conectar=conn();
    



$decodedData = urldecode($bulk);
$arrayData = json_decode($decodedData, true);

foreach ($arrayData as $item) {
if (isset($item['item'])) {
    $myuuid = $gen_uuid->guidv4();
    //$myuuid1 = $gen_uuid->guidv4();


    $productId = substr($myuuid, 0, 8);
    $productName= $item['item']['productName'];
    $description= $item['item']['description'];
    $ean1= $item['item']['ean1'];
    $ean2= $item['item']['ean2'];
    $sku= $item['item']['sku'];
    $productType= $item['item']['productType'];
    $inPrice= $item['item']['inPrice'];
    $providerId= $item['item']['providerId'];
    $imgProduct= $item['item']['imgProduct'];
    $spcProduct= $item['item']['spcProduct'];
    $isActive= $item['item']['isActive'];
    $keyWords= $item['item']['keyWords'];
    // Resto de tus variables aquí...

        
            // Verificar si la fila tiene datos
        
                // Obtener el valor de la columna 'coId'
            
                    $query = mysqli_query($conectar, "INSERT INTO generalProducts 
                    (productId, clientId, productName, description, ean1, ean2, sku, productType, inPrice, providerId, imgProduct, spcProduct,isActive,keyWords) 
                    VALUES
                    ('$productId', '$clientId', '$productName', '$description', '$ean1', '$ean2', '$sku', '$productType', '$inPrice', '$providerId', '$imgProduct', '$spcProduct','$isActive','$keyWords')");
            
            // echo "El valor máximo de incId es: " . $valor;
        
            //  echo "N
// $query = mysqli_query($conectar, "INSERT INTO posCar (carId, clientId, uniqueId, productId, catalogId, outPrice, productQty, discount, promotion, salePrice, inDate, inTime, storeId, categoryId, storeName, categoryName, saver, userId, fromStore, fromIp, fromBrowser) VALUES ('$cartId', '$clientId', '$uniqueId', '$productId', '$catalogId', $salePrice, $productQty, $discount, '$promotion', $outPrice, '$fechaBogota', '$hora_actual_bogota', '$storeId', '$categoryId', '$storeName', '$categoryName', $saver, '$userId', '$storeName', '$fromIp', '$fromBrowser')");




    // Verifica si la consulta se ejecutó correctamente y maneja los errores si es necesario

}}

    echo "true|¡Productos creados con éxito!"; 
    
    // echo json_encode($response1);
    } else {
        $response12='false|¡Autenticación fallida!'.$response11;

        //inicio de log
        require_once 'kronos/postLog.php';
   
        $backtrace = debug_backtrace();
        $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
        $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
       $justFileName = basename($currentFile);
       $rutaCompleta = __DIR__;
       $status = http_response_code();
       $cid=Flight::request()->data->clientId;
       
       //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
       $array = explode("|", $response12);
       $response12=$array[0];
       $message=$array[1];
       kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

       //final de log
        echo 'false|¡Autenticación fallida!'.$response11;
    // echo json_encode($data);
    }
} else {

    $response12='false|¡Encabezados faltantes!';

    //inicio de log
    require_once 'kronos/postLog.php';

    $backtrace = debug_backtrace();
    $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
    $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
   $justFileName = basename($currentFile);
   $rutaCompleta = __DIR__;
   $status = http_response_code();
   $cid=Flight::request()->data->clientId;
   
   //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
   $array = explode("|", $response12);
   $response12=$array[0];
   $message=$array[1];
   kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

   //final de log
    echo 'false|¡Encabezados faltantes!';
}
});


Flight::route('POST /putProductBulk/@apk/@xapk', function ($apk,$xapk) {

header("Access-Control-Allow-Origin: *");
// Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
if (!empty($apk) && !empty($xapk)) {    
    // Leer los datos de la solicitud





    




    $sub_domaincon=new model_domain();
    $sub_domain=$sub_domaincon->domKairos();
    $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKey/';

    $data = array(
        'apiKey' =>$apk, 
        'xApiKey' => $xapk
    
    );
$curl = curl_init();

// Configurar las opciones de la sesión cURL
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Ejecutar la solicitud y obtener la respuesta
$response11 = curl_exec($curl);




curl_close($curl);



    // Realizar acciones basadas en los valores de los encabezados


    if ($response11 == 'true' ) {


        $bulk= Flight::request()->data->bulk;
        $clientId= Flight::request()->data->clientId;
    

    
    // $orderId = substr($myuuid1, 0, 8);

        $conectar=conn();
    



$decodedData = urldecode($bulk);
$arrayData = json_decode($decodedData, true);

foreach ($arrayData as $item) {
if (isset($item['item'])) {
    $productId= $item['item']['productId'];

    
    $productName= $item['item']['productName'];
    $description= $item['item']['description'];
    $ean1= $item['item']['ean1'];
    $ean2= $item['item']['ean2'];
    $sku= $item['item']['sku'];
    $productType= $item['item']['productType'];
    $inPrice= $item['item']['inPrice'];
    $providerId= $item['item']['providerId'];
    $imgProduct= $item['item']['imgProduct'];
    $spcProduct= $item['item']['spcProduct'];
    $isActive= $item['item']['isActive'];
    $keyWords= $item['item']['keyWords'];
    // Resto de tus variables aquí...

    // Tu consulta SQL aquí...




            // Verificar si la fila tiene datos
    
                // Obtener el valor de la columna 'coId'
            
    $query3 = mysqli_query($conectar, "SELECT COUNT(productId) as proId from generalProducts WHERE productId='$productId' AND clientId='$clientId'");

        // Verificar si la consulta fue exitosa
        
            // Obtener la primera fila como un arreglo asociativo
            $fila = $query3->fetch_assoc();
        
            // Verificar si la fila tiene datos
            if ($fila) {
                // Obtener el valor de la columna 'coId'
                $product = $fila['proId'];

                if($product>=1){
                
                    $query = mysqli_query($conectar, "UPDATE generalProducts SET productName='$productName',description='$description',ean1='$ean1',ean2='$ean2',sku='$sku',productType='$productType',inPrice='$inPrice',providerId='$providerId',imgProduct='$imgProduct',spcProduct='$spcProduct',isActive='$isActive',keyWords='$keyWords'
                    WHERE
                    productId='$productId' and clientId='$clientId'");
                }
            // echo "El valor máximo de incId es: " . $valor;
            } else {


            }

            
            
                
            // echo "El valor máximo de incId es: " . $valor;
        
            //  echo "N
// $query = mysqli_query($conectar, "INSERT INTO posCar (carId, clientId, uniqueId, productId, catalogId, outPrice, productQty, discount, promotion, salePrice, inDate, inTime, storeId, categoryId, storeName, categoryName, saver, userId, fromStore, fromIp, fromBrowser) VALUES ('$cartId', '$clientId', '$uniqueId', '$productId', '$catalogId', $salePrice, $productQty, $discount, '$promotion', $outPrice, '$fechaBogota', '$hora_actual_bogota', '$storeId', '$categoryId', '$storeName', '$categoryName', $saver, '$userId', '$storeName', '$fromIp', '$fromBrowser')");




    // Verifica si la consulta se ejecutó correctamente y maneja los errores si es necesario

}}

    echo "true|¡Inventario actualizado con éxito!"; 
    
    // echo json_encode($response1);
    } else {
        $response12='false|¡Autenticación fallida!'.$response11;

        //inicio de log
        require_once 'kronos/postLog.php';
   
        $backtrace = debug_backtrace();
        $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
        $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
       $justFileName = basename($currentFile);
       $rutaCompleta = __DIR__;
       $status = http_response_code();
       $cid=Flight::request()->data->clientId;
       
       //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
       $array = explode("|", $response12);
       $response12=$array[0];
       $message=$array[1];
       kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

       //final de log
        echo 'false|¡Autenticación fallida!'.$response11;
    // echo json_encode($data);
    }
} else {

    $response12='false|¡Encabezados faltantes!';

    //inicio de log
    require_once 'kronos/postLog.php';

    $backtrace = debug_backtrace();
    $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
    $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
   $justFileName = basename($currentFile);
   $rutaCompleta = __DIR__;
   $status = http_response_code();
   $cid=Flight::request()->data->clientId;
   
   //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
   $array = explode("|", $response12);
   $response12=$array[0];
   $message=$array[1];
   kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

   //final de log
    echo 'false|¡Encabezados faltantes!';
}
});


Flight::route('POST /postStoreBulk/@apk/@xapk', function ($apk,$xapk) {

header("Access-Control-Allow-Origin: *");
// Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
if (!empty($apk) && !empty($xapk)) {    
    // Leer los datos de la solicitud





    




    $sub_domaincon=new model_domain();
    $sub_domain=$sub_domaincon->domKairos();
    $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKey/';

    $data = array(
        'apiKey' =>$apk, 
        'xApiKey' => $xapk
    
    );
$curl = curl_init();

// Configurar las opciones de la sesión cURL
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Ejecutar la solicitud y obtener la respuesta
$response11 = curl_exec($curl);




curl_close($curl);



    // Realizar acciones basadas en los valores de los encabezados


    if ($response11 == 'true' ) {


        $bulk= Flight::request()->data->bulk;
        $clientId= Flight::request()->data->clientId;
    

        require_once '../../apiClient/v1/model/modelSecurity/uuid/uuidd.php';
    
    
        $gen_uuid = new generateUuid();

    // $orderId = substr($myuuid1, 0, 8);

        $conectar=conn();
    



$decodedData = urldecode($bulk);
$arrayData = json_decode($decodedData, true);

foreach ($arrayData as $item) {
if (isset($item['item'])) {
    $myuuid = $gen_uuid->guidv4();
    //$myuuid1 = $gen_uuid->guidv4();


    $storeId = substr($myuuid, 0, 8);
    $storeName= $item['item']['storeName'];
    $comments= $item['item']['comments'];
    $isActive= $item['item']['isActive'];
    $storeType= $item['item']['storeType'];
    $keyWords= $item['item']['keyWords'];
    // Resto de tus variables aquí...

        
            // Verificar si la fila tiene datos
        
                // Obtener el valor de la columna 'coId'
            
                    $query = mysqli_query($conectar, "INSERT INTO generalStores 
                    (storeId, clientId, storeName, comments, isActive, storeType, keyWords) 
                    VALUES
                    ('$storeId', '$clientId', '$storeName', '$comments', '$isActive', '$storeType', '$keyWords')");
            
            // echo "El valor máximo de incId es: " . $valor;
        
            //  echo "N
// $query = mysqli_query($conectar, "INSERT INTO posCar (carId, clientId, uniqueId, productId, catalogId, outPrice, productQty, discount, promotion, salePrice, inDate, inTime, storeId, categoryId, storeName, categoryName, saver, userId, fromStore, fromIp, fromBrowser) VALUES ('$cartId', '$clientId', '$uniqueId', '$productId', '$catalogId', $salePrice, $productQty, $discount, '$promotion', $outPrice, '$fechaBogota', '$hora_actual_bogota', '$storeId', '$categoryId', '$storeName', '$categoryName', $saver, '$userId', '$storeName', '$fromIp', '$fromBrowser')");




    // Verifica si la consulta se ejecutó correctamente y maneja los errores si es necesario

}}

    echo "true|¡Tiendas creadas con éxito!"; 
    
    // echo json_encode($response1);
    } else {
        $response12='false|¡Autenticación fallida!'.$response11;

        //inicio de log
        require_once 'kronos/postLog.php';
   
        $backtrace = debug_backtrace();
        $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
        $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
       $justFileName = basename($currentFile);
       $rutaCompleta = __DIR__;
       $status = http_response_code();
       $cid=Flight::request()->data->clientId;
       
       //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
       $array = explode("|", $response12);
       $response12=$array[0];
       $message=$array[1];
       kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

       //final de log
        echo 'false|¡Autenticación fallida!'.$response11;
    // echo json_encode($data);
    }
} else {

    $response12='false|¡Encabezados faltantes!';

    //inicio de log
    require_once 'kronos/postLog.php';

    $backtrace = debug_backtrace();
    $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
    $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
   $justFileName = basename($currentFile);
   $rutaCompleta = __DIR__;
   $status = http_response_code();
   $cid=Flight::request()->data->clientId;
   
   //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
   $array = explode("|", $response12);
   $response12=$array[0];
   $message=$array[1];
   kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

   //final de log
    echo 'false|¡Encabezados faltantes!';
}
});


Flight::route('POST /putStoreBulk/@apk/@xapk', function ($apk,$xapk) {

header("Access-Control-Allow-Origin: *");
// Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
if (!empty($apk) && !empty($xapk)) {    
    // Leer los datos de la solicitud





    




    $sub_domaincon=new model_domain();
    $sub_domain=$sub_domaincon->domKairos();
    $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKey/';

    $data = array(
        'apiKey' =>$apk, 
        'xApiKey' => $xapk
    
    );
$curl = curl_init();

// Configurar las opciones de la sesión cURL
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Ejecutar la solicitud y obtener la respuesta
$response11 = curl_exec($curl);




curl_close($curl);



    // Realizar acciones basadas en los valores de los encabezados


    if ($response11 == 'true' ) {


        $bulk= Flight::request()->data->bulk;
        $clientId= Flight::request()->data->clientId;
    

    
    // $orderId = substr($myuuid1, 0, 8);

        $conectar=conn();
    



$decodedData = urldecode($bulk);
$arrayData = json_decode($decodedData, true);

foreach ($arrayData as $item) {
if (isset($item['item'])) {
    $storeId= $item['item']['storeId'];

    $storeName= $item['item']['storeName'];
    $comments= $item['item']['comments'];
    $isActive= $item['item']['isActive'];
    $storeType= $item['item']['storeType'];
    $keyWords= $item['item']['keyWords'];

    // Tu consulta SQL aquí...




            // Verificar si la fila tiene datos
    
                // Obtener el valor de la columna 'coId'
            
    $query3 = mysqli_query($conectar, "SELECT COUNT(storeId) as proId from generalStores WHERE storeId='$storeId' AND clientId='$clientId'");

        // Verificar si la consulta fue exitosa
        
            // Obtener la primera fila como un arreglo asociativo
            $fila = $query3->fetch_assoc();
        
            // Verificar si la fila tiene datos
            if ($fila) {
                // Obtener el valor de la columna 'coId'
                $product = $fila['proId'];

                if($product>=1){
                
                    $query = mysqli_query($conectar, "UPDATE generalStores SET storeName='$storeName',comments='$comments',isActive='$isActive',storeType='$storeType',keyWords='$keyWords'
                    WHERE
                    storeId='$storeId' and clientId='$clientId'");
                }
            // echo "El valor máximo de incId es: " . $valor;
            } else {


            }

            
            
                
            // echo "El valor máximo de incId es: " . $valor;
        
            //  echo "N
// $query = mysqli_query($conectar, "INSERT INTO posCar (carId, clientId, uniqueId, productId, catalogId, outPrice, productQty, discount, promotion, salePrice, inDate, inTime, storeId, categoryId, storeName, categoryName, saver, userId, fromStore, fromIp, fromBrowser) VALUES ('$cartId', '$clientId', '$uniqueId', '$productId', '$catalogId', $salePrice, $productQty, $discount, '$promotion', $outPrice, '$fechaBogota', '$hora_actual_bogota', '$storeId', '$categoryId', '$storeName', '$categoryName', $saver, '$userId', '$storeName', '$fromIp', '$fromBrowser')");




    // Verifica si la consulta se ejecutó correctamente y maneja los errores si es necesario

}}

    echo "true|¡Tiendas actualizadas con éxito!"; 
    
    // echo json_encode($response1);
    } else {
        $response12='false|¡Autenticación fallida!'.$response11;

        //inicio de log
        require_once 'kronos/postLog.php';
   
        $backtrace = debug_backtrace();
        $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
        $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
       $justFileName = basename($currentFile);
       $rutaCompleta = __DIR__;
       $status = http_response_code();
       $cid=Flight::request()->data->clientId;
       
       //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
       $array = explode("|", $response12);
       $response12=$array[0];
       $message=$array[1];
       kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

       //final de log
        echo 'false|¡Autenticación fallida!'.$response11;
    // echo json_encode($data);
    }
} else {

    $response12='false|¡Encabezados faltantes!';

    //inicio de log
    require_once 'kronos/postLog.php';

    $backtrace = debug_backtrace();
    $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
    $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
   $justFileName = basename($currentFile);
   $rutaCompleta = __DIR__;
   $status = http_response_code();
   $cid=Flight::request()->data->clientId;
   
   //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
   $array = explode("|", $response12);
   $response12=$array[0];
   $message=$array[1];
   kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

   //final de log
    echo 'false|¡Encabezados faltantes!';
}
});


Flight::route('POST /postCategorieBulk/@apk/@xapk', function ($apk,$xapk) {

header("Access-Control-Allow-Origin: *");
// Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
if (!empty($apk) && !empty($xapk)) {    
    // Leer los datos de la solicitud





    




    $sub_domaincon=new model_domain();
    $sub_domain=$sub_domaincon->domKairos();
    $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKey/';

    $data = array(
        'apiKey' =>$apk, 
        'xApiKey' => $xapk
    
    );
$curl = curl_init();

// Configurar las opciones de la sesión cURL
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Ejecutar la solicitud y obtener la respuesta
$response11 = curl_exec($curl);




curl_close($curl);



    // Realizar acciones basadas en los valores de los encabezados


    if ($response11 == 'true' ) {


        $bulk= Flight::request()->data->bulk;
        $clientId= Flight::request()->data->clientId;
    

        require_once '../../apiClient/v1/model/modelSecurity/uuid/uuidd.php';
    
    
        $gen_uuid = new generateUuid();

    // $orderId = substr($myuuid1, 0, 8);

        $conectar=conn();
    



$decodedData = urldecode($bulk);
$arrayData = json_decode($decodedData, true);

foreach ($arrayData as $item) {
if (isset($item['item'])) {
    $myuuid = $gen_uuid->guidv4();
    //$myuuid1 = $gen_uuid->guidv4();


    $categoryId = substr($myuuid, 0, 8);
    $catName= $item['item']['catName'];
    $comments= $item['item']['comments'];
    $parentId= $item['item']['parentId'];
    $catType= $item['item']['catType'];
    $isActive= $item['item']['isActive'];
    $keyWords= $item['item']['keyWords'];
    // Resto de tus variables aquí...

        
            // Verificar si la fila tiene datos
        
                // Obtener el valor de la columna 'coId'
            
                    $query = mysqli_query($conectar, "INSERT INTO generalCategories 
                    (catId, clientId, catName, comments, parentId, catType, isActive,keyWords) 
                    VALUES
                    ('$categoryId', '$clientId', '$catName', '$comments', '$parentId', '$catType', '$isActive','$keyWords')");
            
            // echo "El valor máximo de incId es: " . $valor;
        
            //  echo "N
// $query = mysqli_query($conectar, "INSERT INTO posCar (carId, clientId, uniqueId, productId, catalogId, outPrice, productQty, discount, promotion, salePrice, inDate, inTime, storeId, categoryId, storeName, categoryName, saver, userId, fromStore, fromIp, fromBrowser) VALUES ('$cartId', '$clientId', '$uniqueId', '$productId', '$catalogId', $salePrice, $productQty, $discount, '$promotion', $outPrice, '$fechaBogota', '$hora_actual_bogota', '$storeId', '$categoryId', '$storeName', '$categoryName', $saver, '$userId', '$storeName', '$fromIp', '$fromBrowser')");




    // Verifica si la consulta se ejecutó correctamente y maneja los errores si es necesario

}}

    echo "true|¡Categorías creadas con éxito!"; 
    
    // echo json_encode($response1);
    } else {
        $response12='false|¡Autenticación fallida!'.$response11;

        //inicio de log
        require_once 'kronos/postLog.php';
   
        $backtrace = debug_backtrace();
        $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
        $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
       $justFileName = basename($currentFile);
       $rutaCompleta = __DIR__;
       $status = http_response_code();
       $cid=Flight::request()->data->clientId;
       
       //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
       $array = explode("|", $response12);
       $response12=$array[0];
       $message=$array[1];
       kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

       //final de log
        echo 'false|¡Autenticación fallida!'.$response11;
    // echo json_encode($data);
    }
} else {

    $response12='false|¡Encabezados faltantes!';

    //inicio de log
    require_once 'kronos/postLog.php';

    $backtrace = debug_backtrace();
    $info['Función'] = $backtrace[1]['function']; // 1 para obtener la función actual, 2 para la anterior, etc.
    $currentFile = __FILE__; // Obtiene la ruta completa y el nombre del archivo actual
   $justFileName = basename($currentFile);
   $rutaCompleta = __DIR__;
   $status = http_response_code();
   $cid=Flight::request()->data->clientId;
   
   //$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta
   $array = explode("|", $response12);
   $response12=$array[0];
   $message=$array[1];
   kronos($response12,$message,$message, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$url,$status,'true');

   //final de log
    echo 'false|¡Encabezados faltantes!';
}
});


Flight::route('POST /putCategorieBulk/@apk/@xapk', function ($apk,$xapk) {

header("Access-Control-Allow-Origin: *");
// Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
if (!empty($apk) && !empty($xapk)) {    
    // Leer los datos de la solicitud





    




    $sub_domaincon=new model_domain();
    $sub_domain=$sub_domaincon->domKairos();
    $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKey/';

    $data = array(
        'apiKey' =>$apk, 
        'xApiKey' => $xapk
    
    );
$curl = curl_init();

// Configurar las opciones de la sesión cURL
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Ejecutar la solicitud y obtener la respuesta
$response11 = curl_exec($curl);




curl_close($curl);



    // Realizar acciones basadas en los valores de los encabezados


    if ($response11 == 'true' ) {


        $bulk= Flight::request()->data->bulk;
        $clientId= Flight::request()->data->clientId;
    

    
    // $orderId = substr($myuuid1, 0, 8);

        $conectar=conn();
    



$decodedData = urldecode($bulk);
$arrayData = json_decode($decodedData, true);

foreach ($arrayData as $item) {
if (isset($item['item'])) {
    $categoryId= $item['item']['catId'];

    $catName= $item['item']['catName'];
    $comments= $item['item']['comments'];
    $parentId= $item['item']['parentId'];
    $catType= $item['item']['catType'];
    $isActive= $item['item']['isActive'];
    $keyWords= $item['item']['keyWords'];

    // Tu consulta SQL aquí...




            // Verificar si la fila tiene datos
    
                // Obtener el valor de la columna 'coId'
            
    $query3 = mysqli_query($conectar, "SELECT COUNT(catId) as proId from generalCategories WHERE catId='$categoryId' AND clientId='$clientId'");

        // Verificar si la consulta fue exitosa
        
            // Obtener la primera fila como un arreglo asociativo
            $fila = $query3->fetch_assoc();
        
            // Verificar si la fila tiene datos
            if ($fila) {
                // Obtener el valor de la columna 'coId'
                $product = $fila['proId'];

                if($product>=1){
                
                    $query = mysqli_query($conectar, "UPDATE generalCategories SET catName='$catName',comments='$comments',parentId='$parentId',catType='$catType',isActive='$isActive',keyWords='$keyWords'
                    WHERE
                    catId='$categoryId' and clientId='$clientId'");
                }
            // echo "El valor máximo de incId es: " . $valor;
            } else {


            }

            
            
                
            // echo "El valor máximo de incId es: " . $valor;
        
            //  echo "N
// $query = mysqli_query($conectar, "INSERT INTO posCar (carId, clientId, uniqueId, productId, catalogId, outPrice, productQty, discount, promotion, salePrice, inDate, inTime, storeId, categoryId, storeName, categoryName, saver, userId, fromStore, fromIp, fromBrowser) VALUES ('$cartId', '$clientId', '$uniqueId', '$productId', '$catalogId', $salePrice, $productQty, $discount, '$promotion', $outPrice, '$fechaBogota', '$hora_actual_bogota', '$storeId', '$categoryId', '$storeName', '$categoryName', $saver, '$userId', '$storeName', '$fromIp', '$fromBrowser')");




    // Verifica si la consulta se ejecutó correctamente y maneja los errores si es necesario

}}

$responseApi="true";
$messageApi="Categorias actualizadas con éxito!";
$statusApi="200";
// $response12="true|¡Repartidor actualizado con éxito!";


// echo "true|¡Repartidor actualizado con éxito!";







// echo json_encode($response1);
} else {
$responseApi="false";
$messageApi="¡Autenticación fallida!";
$statusApi="401";
}
} else {

$responseApi="false";
$messageApi="¡Encabezados faltantes!";
$statusApi="403";
}




//$response1 = trim($response1); // Eliminar espacios en blanco alrededor de la respuesta

//kronos($responseApi,$messageApi,$messageApi, $info['Función'],$justFileName,$rutaCompleta,$cid,$dt,$rutaActual,$statusApi,'received',$trackId,$urlreferer);
//final de log


$values=[];



$value=[
'response' => $responseApi,
'message' => $messageApi,
'status' => $statusApi

];

array_push($values,$value);


//echo json_encode($students) ;
echo json_encode(['response'=>$values]); 


});


Flight::start();
