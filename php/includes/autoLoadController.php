<?php 

    function carregarController($pClassName) {
        include(__DIR__ . "/controller/" . $pClassName . ".php");
    }

    spl_autoload_register("carregarController");

    
?>