<?php
    
    class model_validate {
        function  model_api_key($dta) {
            require_once 'database/db_users.php';
            $conectar = conn();
        
            if (!$conectar) {
                return "Error de conexión a la base de datos";
            }
        $apiKey=$dta['apiKey'];
        $xApiKey=$dta['xApiKey'];

            $apiKey1 = mysqli_real_escape_string($conectar, $apiKey);
        $xApiKey1 = mysqli_real_escape_string($conectar, $xApiKey);
            $query = mysqli_query($conectar, "SELECT clientId FROM clientSecrets WHERE apiKey = '$xApiKey'");
        
            if ($query) {
                $result = mysqli_fetch_assoc($query);
                if ($result) {
                   // return $result['secretId'];
return "true";

                  
            } else {
                return "UNABLE SECRET";
            }
        }else{
            return "UNABLE QUERY";
        }
    }

    function  model_api_keyKairos($dta) {
        require_once 'database/db_users.php';
        $conectar = conn();
    
        if (!$conectar) {
            return "Error de conexión a la base de datos";
        }
    $apiKey=$dta['apiKey'];
    $xApiKey=$dta['xApiKey'];

        $apiKey1 = mysqli_real_escape_string($conectar, $apiKey);
    $xApiKey1 = mysqli_real_escape_string($conectar, $xApiKey);

    function generarCodigoAleatorio($longitud) {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';
        
        for ($i = 0; $i < $longitud; $i++) {
            $posicion = rand(0, strlen($caracteres) - 1);
            $codigo .= $caracteres[$posicion];
        }
        
        return $codigo;
    }
    
    $codigoAleatorio = generarCodigoAleatorio(8);
        $query = mysqli_query($conectar, "SELECT userRanCode FROM userSecrets WHERE apiKey = '$apiKey'");
    
        if ($query) {
            $result = mysqli_fetch_assoc($query);
            if ($result) {
               // return $result['secretId'];
               $query1 = mysqli_query($conectar, "SELECT secRanCode FROM clientSecrets WHERE apiKey = '$xApiKey'");
    
               if ($query1) {
                   $result = mysqli_fetch_assoc($query1);
                   if ($result) {
                      // return $result['secretId'];
                     // $query2 = mysqli_query($conectar, "UPDATE userSecrets set userRanCode ='$codigoAleatorio' WHERE apiKey = '$apiKey'");
           
       return "true";
       
                     
               } else {
                   return "UNABLE SECRET";
               }
           }else{
               return "UNABLE QUERY";
           }


              
        } else {
            return "UNABLE SECRET";
        }
    }else{
        return "UNABLE QUERY";
    }
}




    function model_api_keyGateway($dta) {
        require_once 'database/db_users.php';
            $conectar = conn();
        
            if (!$conectar) {
                return "Error de conexión a la base de datos";
            }
        $apiKey=$dta['apiKey'];
        $xApiKey=$dta['xApiKey'];

            $apiKey1 = mysqli_real_escape_string($conectar, $apiKey);
        $xApiKey1 = mysqli_real_escape_string($conectar, $xApiKey);
            $query = mysqli_query($conectar, "SELECT clientId FROM clientSecrets WHERE apiKey = '$xApiKey'");
        
            if ($query) {
                $result = mysqli_fetch_assoc($query);
                if ($result) {
                   // return $result['secretId'];
return "true";

                  
            } else {
                return "UNABLE SECRET";
            }
        }else{
            return "UNABLE QUERY";
        }
    }


    function model_api_keyGatewayKoios($dta) {
        require_once 'database/db_users.php';
            $conectar = conn();
        
            if (!$conectar) {
                return "Error de conexión a la base de datos";
            }
        $apiKey=$dta['apiKey'];
        $xApiKey=$dta['xApiKey'];

            $apiKey1 = mysqli_real_escape_string($conectar, $apiKey);
        $xApiKey1 = mysqli_real_escape_string($conectar, $xApiKey);
            $query = mysqli_query($conectar, "SELECT apiKey FROM clientSecrets WHERE apiKey='$xApiKey'");
        
            if ($query) {
                $result = mysqli_fetch_assoc($query);
                if ($result) {
                  
    //return "true";

    $query1 = mysqli_query($conectar, "SELECT apiKey FROM userSecrets WHERE userRanCode= '$apiKey'");
        
    if ($query1) {
        $result = mysqli_fetch_assoc($query1);
        if ($result) {
           return $result['apiKey'];
//return "true";

          
    } else {
        return "UNABLE SECRET";
    }
}else{
    return "UNABLE QUERY";
}
            } else {
                return "UNABLE SECRET";
            }
        }else{
            return "UNABLE QUERY";
        }
    }


    function model_api_keyLog($dta) {
        require_once 'database/db_users.php';
        $conectar = conn();
    
        if (!$conectar) {
            return "Error de conexión a la base de datos";
        }
    
    $xApiKey=$dta['xApiKey'];

       
        $query = mysqli_query($conectar, "SELECT clientId FROM clientSecrets WHERE apiKey = '$xApiKey'");
    
        if ($query) {
            $result = mysqli_fetch_assoc($query);
            if ($result) {
               // return $result['secretId'];
return "true";

              
        } else {
            return "UNABLE SECRET";
        }
    }else{
        return "UNABLE QUERY";
    }
    }

    function model_api_keyLogGateway($dta) {
        require_once 'database/db_users.php';
        $conectar = conn();
    
        if (!$conectar) {
            return "Error de conexión a la base de datos";
        }
    
    $xApiKey=$dta['xApiKey'];

    $xApiKey1 = mysqli_real_escape_string($conectar, $xApiKey);
        $query = mysqli_query($conectar, "SELECT secretId FROM generalSecrets WHERE secretValue = '$xApiKey1'");
    
        if ($query) {
            $result = mysqli_fetch_assoc($query);
            if ($result) {
               // return $result['secretId'];


                
                        return "true";
                   
            } else {
                return "UNABLE QUERY";//ningun elemento
            }
        } else {
            return "UNABLE SECRET";
        }
    }

}

?>