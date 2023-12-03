<?php

require 'flight/Flight.php';

require_once 'database/db_users.php';
require_once 'env/domain.php';



Flight::route('POST /postProduct/@apk/@xapk', function ($apk,$xapk) {
  
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
            $productName= Flight::request()->data->productName;
            $description= Flight::request()->data->description;
            $ean1= Flight::request()->data->ean1;
            $ean2= Flight::request()->data->ean2;
            $sku= Flight::request()->data->sku;
            $productType= Flight::request()->data->productType;
            $inPrice= Flight::request()->data->inPrice;
            $providerId= Flight::request()->data->providerId;
            $imgUrl= Flight::request()->data->imgUrl;
            $techSpef= Flight::request()->data->techSpef;

            require_once '../../apiCom/v1/model/modelSecurity/uuid/uuidd.php';
           
   

            $gen_uuid = new generateUuid();
            $myuuid = $gen_uuid->guidv4();
         

            $productId = substr($myuuid, 0, 8);

         
            $conectar=conn();
$keywords=$productName."-".$description."-".$sku."-".$productType."-".$techSpef;
           
            $query = mysqli_query($conectar, "INSERT INTO generalProducts (productId, clientId, productName, description, ean1, ean2, sku, productType, inPrice, providerId, imgProduct, spcProduct,keyWords) VALUES ('$productId', '$clientId', '$productName', '$description', '$ean1', '$ean2', '$sku', '$productType', '$inPrice', '$providerId', '$imgUrl', '$techSpef','$keywords')");

            if ($query) {
                echo "true|¡Producto creado con éxito!";
            } else {
                // Si hay un error, imprime el mensaje de error
                echo "false|" . mysqli_error($conectar);
            }
            
           
     

       
        
           // echo json_encode($response1);
        } else {
            echo 'false|¡Autenticación fallida!'.$response11;
           // echo json_encode($data);
        }
    } else {
        echo 'false|¡Encabezados faltantes!';
    }
});


Flight::route('POST /postCatalog/@apk/@xapk', function ($apk,$xapk) {
  
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
            $productId= Flight::request()->data->productId;
            $categoryId= Flight::request()->data->categoryId;
            $stock= Flight::request()->data->stock;
            $secStock= Flight::request()->data->secStock;
            $minQty= Flight::request()->data->minQty;
            $maxQty= Flight::request()->data->maxQty;
            $storeId= Flight::request()->data->storeId;
            $outPrice= Flight::request()->data->outPrice;
            $promoId= Flight::request()->data->promoId;
            $discount= Flight::request()->data->discount;
          
            $unit= Flight::request()->data->unit;
            $readUnit= Flight::request()->data->readUnit;
            $unitQty= Flight::request()->data->unitQty;
            $unitUnit= Flight::request()->data->unitUnit;


            require_once '../../apiCom/v1/model/modelSecurity/uuid/uuidd.php';
           
   

            $gen_uuid = new generateUuid();
            $myuuid = $gen_uuid->guidv4();
         

            $catalogId = substr($myuuid, 0, 8);

         
            $conectar=conn();

           
            $query = mysqli_query($conectar, "INSERT INTO generalCatalogs (catalogId, clientId, productId, categoryId, stock, secStock, minQty, maxQty, storeId, outPrice, promoId, discount,unit,readUnit,unitQty,unitUnit) VALUES ('$catalogId', '$clientId', '$productId', '$categoryId', $stock, $secStock, $minQty, $maxQty, '$storeId', $outPrice, '$promoId', $discount,'$unit','$readUnit',$unitQty,'$unitUnit')");

            if ($query) {
                echo "true|¡Catalogo creado con éxito!";
            } else {
                // Si hay un error, imprime el mensaje de error
                echo "false|" . mysqli_error($conectar);
            }
            
           
     

       
        
           // echo json_encode($response1);
        } else {
            echo 'false|¡Autenticación fallida!'.$response11;
           // echo json_encode($data);
        }
    } else {
        echo 'false|¡Encabezados faltantes!';
    }
});


Flight::route('POST /postStore/@apk/@xapk', function ($apk,$xapk) {
  
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
            $storeName= Flight::request()->data->storeName;
            $comments= Flight::request()->data->comments;
            $storeType= Flight::request()->data->storeType;


            require_once '../../apiCom/v1/model/modelSecurity/uuid/uuidd.php';
           
   

            $gen_uuid = new generateUuid();
            $myuuid = $gen_uuid->guidv4();
         

            $storeId = substr($myuuid, 0, 8);

         
            $conectar=conn();

            $keywords=$storeName." ".$comments." ".$storeType;
            $query = mysqli_query($conectar, "INSERT INTO generalStores (storeId, storeName, clientId, comments, storeType,keyWords) VALUES ('$storeId', '$storeName', '$clientId', '$comments', '$storeType','$keywords')");

            if ($query) {
                echo "true|¡Tienda creada con éxito!";
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



Flight::route('POST /postCategorie/@apk/@xapk', function ($apk,$xapk) {
  
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
            $categoryName= Flight::request()->data->categoryName;
            $comments= Flight::request()->data->comments;
            $parentId= Flight::request()->data->parentId;
            $categoryType= Flight::request()->data->categoryType;


            require_once '../../apiCom/v1/model/modelSecurity/uuid/uuidd.php';
           
   

            $gen_uuid = new generateUuid();
            $myuuid = $gen_uuid->guidv4();
         

            $categoryId = substr($myuuid, 0, 8);

         
            $conectar=conn();

            $keywords=$categoryName." ".$comments." ".$categoryType;

            if($categoryType=="main"){
$parentId=$categoryId;
            }
            
            $query = mysqli_query($conectar, "INSERT INTO generalCategories (catId, clientId, catName, comments, parentId,catType,keyWords) VALUES ('$categoryId', '$clientId', '$categoryName', '$comments', '$parentId','$categoryType','$keywords')");

            if ($query) {
                echo "true|¡Categoria creada con éxito!";
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
        
        $sub_domaincon=new model_domain();
        $sub_domain=$sub_domaincon->domKairos();
        $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKeyKairos/';
      
        $data = array(
          'apiKey' =>$apiKey, 
          'xApiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 == 'true' ) {
           



           
            $conectar=conn();
            
          if($filter=="all"){

          
           
                $query= mysqli_query($conectar,"SELECT productId,clientId,productName,description,ean1,ean2,sku,productType,inPrice,providerId,imgProduct,spcProduct,isActive,keyWords FROM generalProducts where clientId='$clientId'");
        }
         
        if($filter=="browser"){

          
           
            $query= mysqli_query($conectar,"SELECT productId,clientId,productName,description,ean1,ean2,sku,productType,inPrice,providerId,imgProduct,spcProduct,isActive,keyWords FROM generalProducts where clientId='$clientId' and keyWords LIKE ('%$value%')");
        
        
        }
if($filter=="filter"){

          
           
    $query= mysqli_query($conectar,"SELECT productId,clientId,productName,description,ean1,ean2,sku,productType,inPrice,providerId,imgProduct,spcProduct,isActive,keyWords FROM generalProducts where clientId='$clientId' and $param='$value'");


}



                $values=[];
          
                while($row = $query->fetch_assoc())
                {
                   
                        $value=[
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
                        
                        array_push($values,$value);
                        
                }
                $row=$query->fetch_assoc();
                //echo json_encode($students) ;
                echo json_encode(['products'=>$values]);
          
               
           

        } else {
            echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }
});



Flight::route('GET /getCatalogs/@clientId/@filter/@param/@value/@st', function ($clientId,$filter,$param,$value,$st) {
    header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) ) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        
        $sub_domaincon=new model_domain();
        $sub_domain=$sub_domaincon->domKairos();
        $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKeyKairos/';
      
        $data = array(
          'apiKey' =>$apiKey, 
          'xApiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 == 'true' ) {
           


            $array = explode("|", $filter);
            $filter=$array[0];
            $ids=$array[1];
           
            $conectar=conn();
            
        
         
     
if($filter=="all"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1");


}

if($filter=="deleted"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=0");


}

          
  
if($filter=="basic"){

          
           
   // $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.$param ='$value' and ca.status=1");
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and  ca.$param ='$value'");


}
  
if($filter=="ecm"){

          
           
   // $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and  ca.isEcommerce=1 and ca.status=1");
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and ca.isEcommerce=1");


}
if($filter=="pos"){

          
           
   // $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.isPos=1 and ca.status=1");
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and ca.isPos=1");


}






///caracteristicas de catalogo en especifico
if($filter=="specificCatalog"){
$value =1;
         
          if($param=="isActiveNot"){
            $value=0;
            $param="isActive";
                      }
         if($param=="isActiveNot"){
                        $value=0;
                        $param="isActive";
                                  }
                                 
                                              
                                 
           
    if($st=="ecm" || $st=="ECM"){

        if($param=="secStock"){
           
            $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=0 and  ca.stock <= ca.$param'");
    
                      }
        if($param=="stock"){
            $value=0;
            $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=0 and  ca.stock <= 0");
    
                                  }else{
        $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=0 and  ca.$param = '$value'");
                                  }
       }

       if($st=="pos" || $st=="POS"){



        if($param=="secStock"){
           // $value="stock";
            $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=0 and ca.stock <= ca.secStock and ca.stock > 0 ");
    
                      }
        if($param=="stock"){
           // $value=0;
            $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=0 and ca.stock = 0");
    
                                  }if($param!="secStock" && $param!="stock"){
        $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.$param = '$value'");
                                  }


    
       }
       if($st=="pos_ecm" || $st=="POS_ECM"){




        
        if($param=="secStock"){
            $value="stock";
            $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=1 and  ca.$value < ca.$param'");
    
                      }
        if($param=="stock"){
            $value=0;
            $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=1 and  ca.$param <= ca.$value'");
    
                                  }else{
        $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=1 and  ca.$param = '$value'");
                                  }
       // $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and  p.keyWords LIKE ('%$value%')");

       }

}







//carCTER Y PARÁMETO EN ESPEFÍFICO
if($filter=="browser"){

          
    if($param=="productName" || $param=="description"){
$pefix="p";
    }
    if($param=="stock" || $param=="outPrice" || $param=="discount"){
        $pefix="ca";
            }
    if($st=="ecm" || $st=="ECM"){
        $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=0 and  $pefix.$param = '$value'");
    
       }
       if($st=="pos" || $st=="POS"){
        $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=0 and ca.isPos=1  and  $pefix.$param = '$value'");
    
       }
       if($st=="pos_ecm" || $st=="POS_ECM"){
        $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=1  and  $pefix.$param = '$value'");
       // $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and  p.keyWords LIKE ('%$value%')");

       }
}

//filtro por palabras clave stocked por tienda y tipo de tienda
if($filter=="filter"){

          
    if($st=="ecm" || $st=="ECM"){
        $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=0 and ca.stock>ca.secStock and  p.keyWords LIKE ('%$value%')");
    
       }
       if($st=="pos" || $st=="POS"){
        $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=0 and ca.isPos=1 and ca.stock>ca.secStock and  p.keyWords LIKE ('%$value%')");
    
       }
       if($st=="pos_ecm" || $st=="POS_ECM"){
        $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=1 and ca.stock>ca.secStock and  p.keyWords LIKE ('%$value%')");
       // $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and  p.keyWords LIKE ('%$value%')");

       }
            
  //  $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.storeId='$ids' and p.keyWords LIKE ('%$value%')  and ca.status=1");

 

}


//isStock by store
if($filter=="store"){

          
           
   // $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.storeId='$ids' and ca.status=1");
   
   if($st=="ecm" || $st=="ECM"){
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=0 and ca.stock>ca.secStock");

   }
   if($st=="pos" || $st=="POS"){
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=0 and ca.isPos=1 and ca.stock>ca.secStock");

   }
   if($st=="pos_ecm" || $st=="POS_ECM"){
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId' and ca.status=1 and p.isActive=1 and ct.isActive=1 and s.isActive=1 and ca.isActive=1 and ca.storeId='$ids' and s.storeType LIKE ('%$st%') and ca.isEcommerce=1 and ca.isPos=1 and ca.stock>ca.secStock");

   }
 

}




if ($query) {

                $values=[];
          
                while($row = $query->fetch_assoc())
                {
                   
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
                $row=$query->fetch_assoc();
                //echo json_encode($students) ;
                echo json_encode(['catalogs'=>$values]);
          
               
                
                } else {
                    // Si hay un error, imprime el mensaje de error
                    echo "false|" . mysqli_error($conectar);
                }

        } else {
            echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
        }
    } else {
        echo 'Error: Encabezados faltantes';
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
        
        $sub_domaincon=new model_domain();
        $sub_domain=$sub_domaincon->domKairos();
        $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKeyKairos/';
      
        $data = array(
          'apiKey' =>$apiKey, 
          'xApiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 == 'true' ) {
           



           
            $conectar=conn();
            
        
         
     
if($filter=="all"){

          
           
    $query= mysqli_query($conectar,"SELECT storeId,clientId,storeName,comments,isActive,storeType,keyWords FROM generalStores where clientId='$clientId'");


}

if($filter=="browser"){

          
    $query= mysqli_query($conectar,"SELECT storeId,clientId,storeName,comments,isActive,storeType,keyWords FROM generalStores where clientId='$clientId' and keyWords LIKE ('%$value%')");

}

if($filter=="filter"){

          
    $query= mysqli_query($conectar,"SELECT storeId,clientId,storeName,comments,isActive,storeType,keyWords FROM generalStores where clientId='$clientId' and $param='$value'");

}

if ($query) {

                $values=[];
          
                while($row = $query->fetch_assoc())
                {
                   
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
                $row=$query->fetch_assoc();
                //echo json_encode($students) ;
                echo json_encode(['stores'=>$values]);
          
               
                
                } else {
                    // Si hay un error, imprime el mensaje de error
                    echo "false|" . mysqli_error($conectar);
                }

        } else {
            echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
        }
    } else {
        echo 'Error: Encabezados faltantes';
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
        
        $sub_domaincon=new model_domain();
        $sub_domain=$sub_domaincon->domKairos();
        $url = $sub_domain.'/kairosCore/apiAuth/v1/authApiKeyKairos/';
      
        $data = array(
          'apiKey' =>$apiKey, 
          'xApiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 == 'true' ) {
           



           
            $conectar=conn();
            
        
         
     
if($filter=="all"){

          
           
    $query= mysqli_query($conectar,"SELECT catId,clientId,catName,comments,isActive,parentId,catType,keyWords FROM generalCategories where clientId='$clientId'");
   


}

if($filter=="browser"){

          
    $query= mysqli_query($conectar,"SELECT catId,clientId,catName,comments,isActive,parentId,catType,keyWords FROM generalCategories where clientId='$clientId' and keyWords LIKE ('%$value%')");

}
if($filter=="filter"){
          
    $query= mysqli_query($conectar,"SELECT catId,clientId,catName,comments,isActive,parentId,catType,keyWords FROM generalCategories where clientId='$clientId' and $param='$value'");

}



if ($query) {

    $values = [];

    while ($row = $query->fetch_assoc()) {
        // Obtenemos el nombre de la categoría una vez
        $cid = $row['parentId'];
        $query2 = mysqli_query($conectar, "SELECT catName FROM generalCategories where catId ='$cid'");
        if ($row1 = $query2->fetch_assoc()) {
            // Guardar el valor en una variable de sesión
            $_SESSION['catName'] = $row1['catName'];
        }else{
            $_SESSION['catName'] = "na";
        }
    
        // Creamos el arreglo $value con todos los datos necesarios
        $value = [
            'categoryId' => $row['catId'],
            'categoryName' => $row['catName'],
            'comments' => $row['comments'],
            'isActive' => $row['isActive'],
            'categoryType' => $row['catType'],
            'clientId' => $row['clientId'],
            'parentId' => $row['parentId'],
            'keyWords' => $row['keyWords'],
            'parentName' => $_SESSION['catName']
        ];
    
        array_push($values, $value);
    }
    
    echo json_encode(['categories' => $values]);
    
               
                
                } else {
                    // Si hay un error, imprime el mensaje de error
                    echo "false|" . mysqli_error($conectar);
                }

        } else {
            echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }
});


Flight::route('POST /putProduct/@apk/@xapk', function ($apk,$xapk) {
  
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
            $productId= Flight::request()->data->productId;
         
         
            $conectar=conn();

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
           
            if ($query) {
                echo "true|¡Producto actualizado con éxito!";
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

Flight::route('POST /putCategorie/@apk/@xapk', function ($apk,$xapk) {
  
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
            $categoryId= Flight::request()->data->categoryId;
         
         
            $conectar=conn();

           if($param=="parentId"){
            if($categoryId==$value){
                $query = mysqli_query($conectar, "UPDATE generalCategories SET $param='$value' ,catType='main' where clientId='$clientId' and catId='$categoryId'");

            }else{
                $query = mysqli_query($conectar, "UPDATE generalCategories SET $param='$value' ,catType='sec' where clientId='$clientId' and catId='$categoryId'");

            }
           
           }
           else{
            $query = mysqli_query($conectar, "UPDATE generalCategories SET $param='$value' where clientId='$clientId' and catId='$categoryId'");

           }
           
            if ($query) {
                echo "true|¡Categoría actualizada con éxito!";
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


Flight::route('POST /putStore/@apk/@xapk', function ($apk,$xapk) {
  
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
            $storeId= Flight::request()->data->storeId;
         
         
            $conectar=conn();

          
                $query = mysqli_query($conectar, "UPDATE generalStores SET $param='$value' where clientId='$clientId' and storeId='$storeId'");

          
           
           
          
           
            if ($query) {
                echo "true|¡Tienda actualizada con éxito!";
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





Flight::route('POST /postClientOrder/@apk/@xapk', function ($apk,$xapk) {
  
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
            $cart= Flight::request()->data->cart;
            $userId= Flight::request()->data->userId;
            $fromIp= Flight::request()->data->fromIp;
            $fromBrowser= Flight::request()->data->fromBrowser;
         

            require_once '../../apiClient/v1/model/modelSecurity/uuid/uuidd.php';
           
         
            $gen_uuid = new generateUuid();
            $myuuid = $gen_uuid->guidv4();
            $myuuid1 = $gen_uuid->guidv4();
         

            $cartId = substr($myuuid, 0, 8);
            $orderId = substr($myuuid1, 0, 8);

            $conectar=conn();
           
            date_default_timezone_set('America/Bogota');
$hora_actual_bogota = date('H:i:s');
$fechaActual = gmdate('Y-m-d'); // Esto devuelve la fecha actual en formato 'YYYY-MM-DD'

// Crea un objeto DateTime con la fecha actual en UTC
$dateTimeUtc = new DateTime($fechaActual, new DateTimeZone('UTC'));

// Establece la zona horaria a Bogotá
$dateTimeUtc->setTimezone(new DateTimeZone('America/Bogota'));

// Obtiene la fecha en la zona horaria de Bogotá
$fechaBogota = $dateTimeUtc->format('Y-m-d'); // Esto devuelve la fecha actual en Bogotá



$decodedData = urldecode($cart);
$arrayData = json_decode($decodedData, true);

foreach ($arrayData as $item) {
    if (isset($item['item'])) {
        $uniqueId= $item['item']['uniqueId'];
        $productId= $item['item']['productId'];
        $catalogId= $item['item']['catalogId'];
        $outPrice= $item['item']['outPrice'];
        $productQty= $item['item']['productQty'];
        $discount= $item['item']['discount'];
        $promotion= $item['item']['promoId'];
        $salePrice= $item['item']['productPrice'];
        $storeId= $item['item']['storeId'];
        $categoryId= $item['item']['categoryId'];
        $storeName= $item['item']['storeName'];
        $categoryName= $item['item']['categoryName'];
        $saver= $item['item']['subTotalShopping']-$item['item']['totalShopping'];
        // Resto de tus variables aquí...

        // Tu consulta SQL aquí...
        $query = mysqli_query($conectar, "INSERT INTO posCar (carId, clientId, uniqueId, productId, catalogId, outPrice, productQty, discount, promotion, salePrice, inDate, inTime, storeId, categoryId, storeName, categoryName, saver, userId, fromStore, fromIp, fromBrowser) VALUES ('$cartId', '$clientId', '$uniqueId', '$productId', '$catalogId', $salePrice, $productQty, $discount, '$promotion', $outPrice, '$hora_actual_bogota', '$fechaBogota', '$storeId', '$categoryId', '$storeName', '$categoryName', $saver, '$userId', '$storeName', '$fromIp', '$fromBrowser')");
        $query = mysqli_query($conectar, "UPDATE generalCatalogs SET stock= (SELECT stock FROM generalCatalogs where catalogId='$catalogId')-$productQty WHERE catalogId='$catalogId' and clientId='$clientId'");
        
        // Verifica si la consulta se ejecutó correctamente y maneja los errores si es necesario
        if (!$query) {
            echo "Error al insertar datos: " . mysqli_error($conectar);
        }
    } else {
        if ($query) {
          //  $productName = $arrayData[0]['payment']['total'];
          $query1 = mysqli_query($conectar, "INSERT INTO generalOrders
           (orderId,carId, clientId, userId, shopperId, storeType, storeId, totalAmount, subtotalAmount, orderProgress, saver, fromIp, fromStore, fromBrowser, orderPayload, paymentMethod, returnCash, transactionStatus)
           VALUES
            ('$orderId', '$cartId', '$clientId', '$userId', '$userId', 'POS','$storeId',12345, 12356, 'PENDING', 12345, '$fromIp', '$storeId', '$fromBrowser', '123', 'CASH', 0, 'PENDING')");
      if($query1){
        echo "true|¡Orden creada con éxito !";
      } else {
        // Si hay un error, imprime el mensaje de error
        echo "false|" . mysqli_error($conectar);
    }
           
        } else {
            // Si hay un error, imprime el mensaje de error
            echo "false|" . mysqli_error($conectar);
        }
    }
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
