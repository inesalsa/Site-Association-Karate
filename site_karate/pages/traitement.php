<?php
require_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $mdp_brut = $_POST['password'];
    
    // On récupère les nouvelles infos
    $grade_id = isset($_POST['grade_id']) ? (int)$_POST['grade_id'] : null;
    $est_parent = isset($_POST['est_parent']) ? 1 : 0;

    $mdp_hash = password_hash($mdp_brut, PASSWORD_DEFAULT);

    try {
        // Requête mise à jour avec grade_id et est_parent
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, grade_id, est_parent) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $email, $mdp_hash, $grade_id, $est_parent]);

        header("Location: inscriptions.html?success=1");
        exit();

    } catch (PDOException $e) {
        header("Location: inscriptions.html?error=1");
        exit();
    }
} else {
    header("Location: inscriptions.html");
    exit();
}
?>