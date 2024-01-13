<?php
    $dbPass = '';
    $dbUser = 'root';
    $dbName = 'elitaformy';
    $dbHost = 'localhost';

    try {
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
