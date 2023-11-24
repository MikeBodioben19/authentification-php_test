<?php

$dns = 'mysql:host=localhost;dbname=auth';
$userDb = 'root';
$pwd = '1mike9ben';

try{
    $pdo = new PDO($dns,$userDb, $pwd,[
    PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO:: FETCH_ASSOC
    ]);}
catch(PDOException $e){
    echo 'error : '.$e->getMessage();
};

return $pdo;