<?php
session_start();

// On prépare une réponse par défaut (non connecté)
$response = ['loggedin' => false];

// Si les variables de session existent, on les renvoie
if (isset($_SESSION['user_id'])) {
    $response = [
        'loggedin' => true,
        'nom' => $_SESSION['nom']
    ];
}

// On dit au navigateur qu'on envoie du JSON
header('Content-Type: application/json');
echo json_encode($response);
?>