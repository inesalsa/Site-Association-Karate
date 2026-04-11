<?php
session_start();


$response = ['loggedin' => false];


if (isset($_SESSION['user_id'])) {
    $response = [
        'loggedin' => true,
        'nom' => $_SESSION['nom']
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>