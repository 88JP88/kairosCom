<?php
    
    class model_functions {
        function model_user($dta) {
    
            require_once 'database/db_users.php'; // Asegúrate de proporcionar la ruta correcta al archivo de conexión a la base de datos
         
            // Realiza la conexión a la base de datos (reemplaza conn() con tu propia lógica de conexión)
            $conectar = conn();
    
            // Verifica si la conexión se realizó correctamente
            if (!$conectar) {
                return "Error de conexión a la base de datos";
            }
    
            

            // Escapa los valores para prevenir inyección SQL
            $name = mysqli_real_escape_string($conectar, $dta['name']);
            $lastName = mysqli_real_escape_string($conectar, $dta['lastName']);
            $personalMail = mysqli_real_escape_string($conectar, $dta['personalMail']);
            $username = mysqli_real_escape_string($conectar, $dta['userName']);
            $userid = mysqli_real_escape_string($conectar, $dta['userId']);
            $profileId = mysqli_real_escape_string($conectar, $dta['profileId']);
            $apiToken = mysqli_real_escape_string($conectar, $dta['apiToken']);
            $ranCode = mysqli_real_escape_string($conectar, $dta['ranCode']);
            $rolId = mysqli_real_escape_string($conectar, $dta['rolId']);
            $contact = mysqli_real_escape_string($conectar, $dta['contact']);
            $clientId = mysqli_real_escape_string($conectar, $dta['clientId']);
            //$dato_encriptado = $keyword;
            
    
            $query= mysqli_query($conectar,"SELECT email FROM generalUsers where email='$personalMail'");
            $nr=mysqli_num_rows($query);
        
            if($nr>=1){
                echo "false|¡Correo electrónico inscrito en KAIROS y LUGMA previamente: ".$personalMail;
             //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
            }else{
        
              
                
                    if (strpos($username, " ") === false && strlen($username) > 5 && preg_match('/^[^@#%&,:ñÑ]+$/', $username)) {
                                  
        
                          // require_once 'model/modelSecurity/crypt/cryptic.php';
                           // $dato_encriptado1= $encriptar($keyword);

                           date_default_timezone_set('America/Bogota'); // Cambia 'America/Montevideo' por tu zona horaria deseada

// Obtener la fecha actual
$fechaActual = date('Y-m-d'); // Formato: Año-Mes-Día
$horaActual = date('H:i:s'); // Formato: Hora:Minutos:Segundos

$apiToken=  $dta['apk'];
$query= mysqli_query($conectar,"INSERT INTO generalUsers (userId,userName,name,lastName,rolId,contact,email,clientId) VALUES ('$userid','$username','$name','$lastName','$rolId','$contact','$personalMail','$clientId')");

$query2= mysqli_query($conectar,"INSERT INTO userSecrets (userId,apiKey,userRanCode) VALUES ('$userid','$apiToken','$ranCode')");
                                  
       

                          
                            echo "true|¡Usuario creado con exito, vincuado a LUGMA y KAIROS!";
                        //echo "true"; // muestra "/mi-pagina.php?id=123"
            
            
                            //echo "La cadena contiene números, letras mayúsculas, minúsculas y símbolos";
                        
        
                       
                        
                    } else {
                        return "false|¡usuario con espacios o cadena de texto menor a 5 caracteres!";
                       // echo "usuario con espacios o cadena de texto mayor a 12 caracteres";
                    }
                                  
                                    
                                }
            
        }


         function model_internaluser($dta) {
    
            require_once 'database/db_users.php'; // Asegúrate de proporcionar la ruta correcta al archivo de conexión a la base de datos
         
            // Realiza la conexión a la base de datos (reemplaza conn() con tu propia lógica de conexión)
            $conectar = conn();
    
            // Verifica si la conexión se realizó correctamente
            if (!$conectar) {
                return "Error de conexión a la base de datos";
            }
    
            

            // Escapa los valores para prevenir inyección SQL
            $name = mysqli_real_escape_string($conectar, $dta['name']);
            $lastName = mysqli_real_escape_string($conectar, $dta['lastName']);
            $personalMail = mysqli_real_escape_string($conectar, $dta['personalMail']);
            $username = mysqli_real_escape_string($conectar, $dta['userName']);
            $userid = mysqli_real_escape_string($conectar, $dta['userId']);
            $profileId = mysqli_real_escape_string($conectar, $dta['profileId']);
            $apiToken = mysqli_real_escape_string($conectar, $dta['apiToken']);
            $ranCode = mysqli_real_escape_string($conectar, $dta['ranCode']);
            $rolId = mysqli_real_escape_string($conectar, $dta['rolId']);
            $contact = mysqli_real_escape_string($conectar, $dta['contact']);
            $clientId = mysqli_real_escape_string($conectar, $dta['clientId']);
            //$dato_encriptado = $keyword;
            
    
            $query= mysqli_query($conectar,"SELECT email FROM internalUsers where email='$personalMail'");
            $nr=mysqli_num_rows($query);
        
            if($nr>=1){
                echo "false|¡Correo electrónico inscrito en KAIROS y LUGMA previamente: ".$personalMail;
             //echo "ups! el id del repo está repetido , intenta nuevamente, gracias.";
            }else{
        
              
                
                    if (strpos($username, " ") === false && strlen($username) > 5 && preg_match('/^[^@#%&,:ñÑ]+$/', $username)) {
                                  
        
                          // require_once 'model/modelSecurity/crypt/cryptic.php';
                           // $dato_encriptado1= $encriptar($keyword);

                           date_default_timezone_set('America/Bogota'); // Cambia 'America/Montevideo' por tu zona horaria deseada

// Obtener la fecha actual
$fechaActual = date('Y-m-d'); // Formato: Año-Mes-Día
$horaActual = date('H:i:s'); // Formato: Hora:Minutos:Segundos

$apiToken=  $dta['apk'];
$query= mysqli_query($conectar,"INSERT INTO internalUsers (userId,userName,name,lastName,rolId,contact,email,clientId) VALUES ('$userid','$username','$name','$lastName','$rolId','$contact','$personalMail','$clientId')");

$query2= mysqli_query($conectar,"INSERT INTO userSecrets (userId,apiKey,userRanCode) VALUES ('$userid','$apiToken','$ranCode')");
                                  
       

                          
                            echo "true|¡Usuario creado con exito, vincuado a LUGMA y KAIROS!";
                        //echo "true"; // muestra "/mi-pagina.php?id=123"
            
            
                            //echo "La cadena contiene números, letras mayúsculas, minúsculas y símbolos";
                        
        
                       
                        
                    } else {
                        return "false|¡usuario con espacios o cadena de texto menor a 5 caracteres!";
                       // echo "usuario con espacios o cadena de texto mayor a 12 caracteres";
                    }
                                  
                                    
                                }
            
        }

    }
    
    
?>