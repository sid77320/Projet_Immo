<?php

$user = "audrey";
$password = "123456";


try {
    $db = new PDO('mysql:host = 127.0.0.1;dbname=immo;charset=utf8',$user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION); // mode de gestion d'erreur
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //http://php.net/manual/fr/pdo.setattribute.php


}catch(PDOException $ex){
    echo "ERREUR...";
}


?>