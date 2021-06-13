<?php
include_once 'pep/DatabaseOOP.php';

$servername = "localhost";
$username = "root";
$password = "admin";

try {
    $conn = new PDO("mysql:host=$servername;dbname=tecnoticos", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$idUsuario = $_POST["borrar"];

$result = $conn->prepare("DELETE FROM respuesta WHERE id_usuario = $idUsuario");
$result->setFetchMode(PDO::FETCH_ASSOC);
$result->execute();
$result = $conn->prepare("DELETE FROM usuario WHERE id_usuario = $idUsuario");
$result->setFetchMode(PDO::FETCH_ASSOC);
$result->execute();

header("Location: ./index.php");
?>