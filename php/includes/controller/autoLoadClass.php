<?php 

    function carregarClass($pClassName) {
        $raiz = explode('/', $_SERVER['DOCUMENT_ROOT']);
        $raiz[] = 'teste' ;
        $raiz[] = 'php' ;
        $raiz[] = 'includes' ;
        $separador = DIRECTORY_SEPARATOR;
        
        $raiz = implode($separador, $raiz);

        include( $raiz.$separador ."model" .$separador . $pClassName . ".php");
    }

    spl_autoload_register("carregarClass");

   
?>