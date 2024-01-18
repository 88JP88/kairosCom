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
        $dta = array(
        
            'clientId' =>Flight::request()->data->clientId,
            
            'productName' => Flight::request()->data->productName,
            'description' => Flight::request()->data->description,
            'ean1' => Flight::request()->data->ean1,
            'ean2' => Flight::request()->data->ean2,
            'sku' => Flight::request()->data->sku,
            'productType' => Flight::request()->data->productType,
            'inPrice' => Flight::request()->data->inPrice,
            'providerId' => Flight::request()->data->provderId,
            'imgUrl' => Flight::request()->data->imgUrl,
            'techSpef' => Flight::request()->data->techSpef
        );
        $dt=json_encode($dta);
        //DATA EXTRACTION**


                if ($response11 == 'true' ) {

                $query= modelPost::postProduct($dta);  //DATA MODAL

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


       // kronos($responseSQL,$apiMessageSQL,$apiMessageSQL,Flight::request()->data->clientId,$dt,Flight::request()->url,'RECEIVED',Flight::request()->data->trackId);  //LOG FUNCTION  

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
    'categoryId' => Flight::request()->data->categoryId
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



            $clientId= Flight::request()->data->clientId;
            $param= Flight::request()->data->param;
            $value= Flight::request()->data->value;
            $catalogId= Flight::request()->data->catalogId;
         
         
            $conectar=conn();

           if($param=="isEcommerce" && $value=="1" || $param=="isPos" && $value=="1"){
            $query = mysqli_query($conectar, "UPDATE generalCatalogs SET $param='$value' ,isStocked=0,isInternal=0 where clientId='$clientId' and catalogId='$catalogId'");

           }
           if($param=="isStocked" && $value=="1"){
            $query = mysqli_query($conectar, "UPDATE generalCatalogs SET $param='$value' ,isEcommerce=0,isPos=0,isInternal=0 where clientId='$clientId' and catalogId='$catalogId'");

           }
           if($param=="isInternal" && $value=="1"){
            $query = mysqli_query($conectar, "UPDATE generalCatalogs SET $param='$value' ,isEcommerce=0,isPos=0,isStocked=0 where clientId='$clientId' and catalogId='$catalogId'");

           }
           if($param=="catalogId" || $param=="clientId"){
            $query = mysqli_query($conectar, "UPDATE generalCatalogs SET clientId='$clientId' where clientId='$clientId' and catalogId='$catalogId'");

           }
           if($param=="del"){
            $query = mysqli_query($conectar, "UPDATE generalCatalogs SET status=0,isActive=0 where clientId='$clientId' and catalogId='$catalogId'");

           }
           else{
            $query = mysqli_query($conectar, "UPDATE generalCatalogs SET $param='$value' where clientId='$clientId' and catalogId='$catalogId'");

           }
           
            if ($query) {
                echo "true|¡Catálogo actualizado con éxito!";
            } else {
                // Si hay un error, imprime el mensaje de error
                echo "false|" . mysqli_error($conectar);
            }
            
           
     

       
        
           // echo json_encode($response1);
        } else {
            echo 'false|¡Autenticación fallida!';
           // echo json_encode($data);
        }
    } else {
        echo 'false|¡Encabezados faltantes!';
    }
});





Flight::start();
