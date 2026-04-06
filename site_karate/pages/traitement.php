<?php
// On inclut la connexion à la base de données (vérifie que le chemin est correct)
require_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Récupération et sécurisation des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $mdp_brut = $_POST['password'];

    // Récupération des nouveaux champs (Grade et Parent)
    // On utilise (int) pour forcer le type numérique pour la sécurité
    $grade_id = isset($_POST['grade_id']) ? (int)$_POST['grade_id'] : null;
    
    // Pour la checkbox : si elle est cochée, elle vaut 1, sinon 0
    $est_parent = isset($_POST['est_parent']) ? 1 : 0;

    // 2. Hachage du mot de passe (Sécurité)
    $mdp_hash = password_hash($mdp_brut, PASSWORD_DEFAULT);

    try {
        // 3. Préparation de la requête SQL avec les nouvelles colonnes
        // On ajoute grade_id et est_parent à la liste des colonnes et des paramètres (?)
        $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe, grade_id, est_parent) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        
        // 4. Exécution de la requête avec toutes les variables dans le bon ordre
        $stmt->execute([
            $nom, 
            $email, 
            $mdp_hash, 
            $grade_id, 
            $est_parent
        ]);

        // 5. Redirection vers la page d'inscription avec un message de succès
        header("Location: inscriptions.html?success=1");
        exit();

    } catch (PDOException $e) {
        // En cas d'erreur (ex: email déjà utilisé ou erreur SQL)
        // Tu peux décommenter la ligne suivante pour déboguer si ça ne marche pas :
        // die("Erreur : " . $e->getMessage());
        
        header("Location: inscriptions.html?error=1");
        exit();
    }

} else {
    // Si on tente d'accéder au fichier sans passer par le formulaire
    header("Location: inscriptions.html");
    exit();
}
?>