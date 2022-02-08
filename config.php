<?php 

spl_autoload_register(function($classname){
    $filename = "classes" . DIRECTORY_SEPARATOR . $classname . ".php";
    if (file_exists($filename)) {
        require_once ($filename);
    }
}) 

?>