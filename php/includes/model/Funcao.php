<?php

    class Funcao{
        function validarEmail($email){

            return (is_null($email) || !filter_var($email, FILTER_VALIDATE_EMAIL));
    
        }

        function validarTexto($texto){
            return (is_null($texto) || empty($texto));
        }
        
        function validarId($id){

            $aId = explode(',', $id);

            foreach($aId as $i){
                if(($i == 0 || filter_var($i, FILTER_VALIDATE_INT) === false)){
                    return true;
                    break;
                }
            }

            return false;
        }

        function voltar(){
    
            return header("Location: ". $_SERVER['HTTP_REFERER']);
        }

        function agora(){
            return date('Y-m-d H:i:s');
        }
    }
  
   

?>