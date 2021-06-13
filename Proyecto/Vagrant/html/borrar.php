<?php
    $servername = "localhost";
    $username = "root";
    $password = "password";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=tecnoticos", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
    $id = $_POST["borrar"];
    $result = $conn->prepare("DELETE FROM respuesta WHERE id_dilema = $id");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();
    $result = $conn->prepare("DELETE FROM pregunta WHERE id_dilema = $id");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();
    $result = $conn->prepare("DELETE FROM dilema WHERE id_dilema = $id");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    header("Location: ./listarDilemas.php");

?>