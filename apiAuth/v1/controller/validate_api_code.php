<?php
    
    class validate_api_key {
        function validate_token($dta) {
            
           // require_once '../../apiAuth/v1/model/modelSecurity/uuid/uuidd.php';
            require_once '../../apiAuth/v1/model/validations/validate_api_code.php';
            //require_once '../../apiAuth/v1/model/validations/post_new_code.php';
           
            $validate = new model_validate();
           $result= $validate->model_api_key($dta);
            if($result=="UNABLE TOKEN" || $result=="UNABLE QUERY" || $result=="UNABLE SECRET"){
               
                
             //return json_encode(['response'=>$info]);
                return "false";
            }else{
               
               
             //return json_encode(['response'=>$info]);
            return $result;
            //$dta['uuid'] = $primeros_ocho;
            }
            
            
        }
        function validate_tokenKairos($dta) {
            
            // require_once '../../apiAuth/v1/model/modelSecurity/uuid/uuidd.php';
             require_once '../../apiAuth/v1/model/validations/validate_api_code.php';
             //require_once '../../apiAuth/v1/model/validations/post_new_code.php';
            
             $validate = new model_validate();
            $result= $validate->model_api_keyKairos($dta);
             if($result=="UNABLE TOKEN" || $result=="UNABLE QUERY" || $result=="UNABLE SECRET"){
                
                 
              //return json_encode(['response'=>$info]);
                 return "false";
             }else{
                
                
              //return json_encode(['response'=>$info]);
             return $result;
             //$dta['uuid'] = $primeros_ocho;
             }
             
             
         }
        function validate_tokenGateway($dta) {
            
            // require_once '../../apiAuth/v1/model/modelSecurity/uuid/uuidd.php';
             require_once '../../apiAuth/v1/model/validations/validate_api_code.php';
             //require_once '../../apiAuth/v1/model/validations/post_new_code.php';
            
             $validate = new model_validate();
            $result= $validate->model_api_keyGateway($dta);
             if($result=="UNABLE TOKEN" || $result=="UNABLE QUERY" || $result=="UNABLE SECRET"){
                
                 
              //return json_encode(['response'=>$info]);
                 return "false";
             }else{
                
                
              //return json_encode(['response'=>$info]);
             return $result;
             //$dta['uuid'] = $primeros_ocho;
             }
             
             
         }
         
        function validate_tokenGatewayKoios($dta) {
            
            // require_once '../../apiAuth/v1/model/modelSecurity/uuid/uuidd.php';
             require_once '../../apiAuth/v1/model/validations/validate_api_code.php';
             //require_once '../../apiAuth/v1/model/validations/post_new_code.php';
            
             $validate = new model_validate();
            $result= $validate->model_api_keyGatewayKoios($dta);
             if($result=="UNABLE TOKEN" || $result=="UNABLE QUERY" || $result=="UNABLE SECRET"){
                
                 
              //return json_encode(['response'=>$info]);
                 return "false";
             }else{
                
                
              //return json_encode(['response'=>$info]);
             return $result;
             //$dta['uuid'] = $primeros_ocho;
             }
             
             
         }
        function validate_tokenLog($dta) {
            
            // require_once '../../apiAuth/v1/model/modelSecurity/uuid/uuidd.php';
             require_once '../../apiAuth/v1/model/validations/validate_api_code.php';
             //require_once '../../apiAuth/v1/model/validations/post_new_code.php';
            
             $validate = new model_validate();
            $result= $validate->model_api_keyLog($dta);
             if($result=="UNABLE TOKEN" || $result=="UNABLE QUERY" || $result=="UNABLE SECRET"){
                
                 
              //return json_encode(['response'=>$info]);
                 return "false";
             }else{
                
                
              //return json_encode(['response'=>$info]);
             return $result;
             //$dta['uuid'] = $primeros_ocho;
             }
             
             
         }
         function validate_tokenLogGateway($dta) {
            
            // require_once '../../apiAuth/v1/model/modelSecurity/uuid/uuidd.php';
             require_once '../../apiAuth/v1/model/validations/validate_api_code.php';
             //require_once '../../apiAuth/v1/model/validations/post_new_code.php';
            
             $validate = new model_validate();
            $result= $validate->model_api_keyLogGateway($dta);
             if($result=="UNABLE TOKEN" || $result=="UNABLE QUERY" || $result=="UNABLE SECRET"){
                
                 
              //return json_encode(['response'=>$info]);
                 return "false";
             }else{
                
                
              //return json_encode(['response'=>$info]);
             return $result;
             //$dta['uuid'] = $primeros_ocho;
             }
             
             
         }

       
    }
    
?>