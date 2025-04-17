<?php
    $host = 'localhost';
    $db = 'sindcesp_pingosalgado';
    $user = 'sindcesp_root'; 
    $pass = 'Leiria2025!';


try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>