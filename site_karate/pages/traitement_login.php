<?php
// On démarre la session pour "connecter" l'utilisateur
session_start();

// On inclut la config (port 3306, mdp vide pour XAMPP)
require_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['password'];

    // 1. On cherche l'utilisateur par son email
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // 2. On vérifie si l'utilisateur existe ET si le mot de passe est correct
    if ($user && password_verify($mdp, $user['mot_de_passe'])) {
        
        // 3. Succès ! On stocke les infos dans la SESSION
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];

        // Redirection vers l'accueil
        header("Location: ../index.html?login=success");
        exit();
    } else {
        // 4. Échec : on renvoie vers le login avec un message d'erreur
        header("Location: login.html?error=1");
        exit();
    }
} else {
    header("Location: login.html");
    exit();
}
?>