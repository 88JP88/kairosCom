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

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId  where ca.clientId='$clientId'");


}



          
  
if($filter=="basic"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.$param ='$value'");


}
  
if($filter=="ecm"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and  ca.isEcommerce=1");


}
if($filter=="pos"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.isPos=1 ");


}

if($filter=="internal"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.isInternal=1 ");


}
if($filter=="stocked"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.isStocked=1 ");


}
if($filter=="browser"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and p.keyWords LIKE '%$value%'");


}

if($filter=="filter"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.storeId='$ids' and p.keyWords LIKE ('%$value%')");


}

if($filter=="store"){

          
           
    $query= mysqli_query($conectar,"SELECT ca.catalogId,ca.clientId,ca.productId,ca.categoryId,ca.stock,ca.secStock,ca.minQty,ca.maxQty,ca.storeId,ca.outPrice,ca.promoId,ca.isActive,ca.discount,ca.isPromo,ca.isDiscount,ca.isEcommerce,ca.isPos,ca.isInternal,ca.isStocked,ca.unit,ca.readUnit,ca.unitQty,ca.unitUnit,s.storeName,ct.catName,p.productName,p.description,p.imgProduct,p.spcProduct,p.keyWords FROM generalCatalogs ca JOIN generalStores s ON ca.storeId=s.storeId JOIN generalCategories ct ON ct.catId=ca.categoryId JOIN generalProducts p ON p.productId=ca.productId where ca.clientId='$clientId' and ca.storeId='$ids'");


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

                $values=[];
          
                while($row = $query->fetch_assoc())
                {
                   
                        $value=[
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
                $row=$query->fetch_assoc();
                //echo json_encode($students) ;
                echo json_encode(['categories'=>$values]);
          
               
                
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
