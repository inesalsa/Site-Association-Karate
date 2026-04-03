<?php
// traitement.php

// 1. Inclure la configuration de la base de données (si tu l'utilises)
// require_once('config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Récupération et nettoyage des données (protection XSS)
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = $_POST['password'];

    // 3. Ici, tu placerais ton code SQL pour insérer dans la base de données
    // Exemple avec PDO (si ta config.php est active) :
    /*
    $hash = password_hash($mdp, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $email, $hash]);
    */

    // 4. Redirection après succès
    // On peut passer un message dans l'URL pour l'afficher plus tard
    header("Location: inscriptions.html?success=1");
    exit();
} else {
    // Si quelqu'un essaie d'accéder au fichier directement sans formulaire
    header("Location: inscriptions.html");
    exit();
}
?>