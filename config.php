<?php 

spl_autoload_register(function($classname){
    $filename = $classname . ".php";
    if (file_exists($filename)) {
        require_once ($filename);
    }
}) 

?>