<?php
   
    class modelResponse {
        
       public static function responsePost($responseApi,$messageApi,$statusApi,$messageSQL) {
    
        $values=[];

        $value=[
            'response' => $responseApi,
            'message' => $messageApi,
            'status' => $statusApi,
            'messageSQL'=>$messageSQL
            
        ];
        
        array_push($values,$value);
        
return json_encode(['response'=>$values]);
            
        }


    }
    
    
?>