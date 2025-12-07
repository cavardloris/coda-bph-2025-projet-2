<?php
spl_autoload_register(function($className) {
    if(file_exists("managers/$className.php")) {
        require_once "managers/$className.php";
    }
    elseif(file_exists("services/$className.php")) {
        require_once "services/$className.php";
    }
    elseif(file_exists("controllers/$className.php")) {
        require_once "controllers/$className.php";
    }
});