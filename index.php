<?php

// require './vendor/autoload.php';

// use Symfony\Component\ErrorHandler\Debug;
// use Symfony\Component\ErrorHandler\ErrorHandler;
// use Symfony\Component\ErrorHandler\DebugClassLoader;



// Debug::enable();

use Database\Database;

spl_autoload_register(function ($className){
    require __DIR__.'/'. str_replace('\\','/', $className) .'.php';



});


$db = new \Database\Database();