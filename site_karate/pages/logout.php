<?php
session_start();
session_unset(); // Vide les variables
session_destroy(); // Détruit la session
header("Location: ../index.html"); // Retour à l'accueil
exit();
?>