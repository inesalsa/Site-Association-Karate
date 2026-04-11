<?php

$host = 'localhost';
$port = '3306';             // Port par défaut de MySQL
$dbname = 'association_db';  // Le nom de la base de données créée dans phpMyAdmin
$user = 'root';             
$pass = '';                 
try {
   
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>