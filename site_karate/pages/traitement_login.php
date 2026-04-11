<?php
session_start();
require_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['password'];

    
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($mdp, $user['mot_de_passe'])) {
       
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['grade_id'] = $user['grade_id'];
        $_SESSION['est_parent'] = $user['est_parent'];

        
        header("Location: ../profile.php");
        exit();
    } else {
        header("Location: login.html?error=1");
        exit();
    }
} else {
    header("Location: login.html");
    exit();
}
?>