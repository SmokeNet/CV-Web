<?php

$servidor="localhost";
$baseDeDatos="proyecto_portafolio";
$usuario="root";
$password="";

try {
    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$password);
} catch (Exception $error) {
    echo $error->getMessage();
}

?>