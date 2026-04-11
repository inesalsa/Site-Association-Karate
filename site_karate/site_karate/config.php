<?php
// Configuration pour XAMPP
$host = 'localhost';
$port = '3306';             // Port par défaut de XAMPP pour MySQL
$dbname = 'association_db';  // Le nom de ta base de données créée dans phpMyAdmin
$user = 'root';             // Utilisateur par défaut de XAMPP
$pass = '';                 // TRÈS IMPORTANT : Sur XAMPP, il n'y a PAS de mot de passe par défaut

try {
    // Connexion PDO adaptée à XAMPP
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    
    // Mode d'erreur pour voir ce qui cloche en cas de souci
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>