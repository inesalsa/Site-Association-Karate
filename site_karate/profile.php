<?php
session_start();
require_once('../config.php');

// Sécurité : si pas connecté, retour au login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// On récupère les infos du grade avec une jointure
$stmt = $pdo->prepare("
    SELECT u.*, g.nom_grade 
    FROM utilisateurs u 
    LEFT JOIN grades g ON u.grade_id = g.id 
    WHERE u.id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Espace - SEK Karate</title>
    <link rel="stylesheet" href="../css/style.css"> <style>
        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        .badge-parent {
            background: #bc002d;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
        }
        .grade-info {
            font-size: 1.2em;
            margin: 20px 0;
            font-weight: bold;
        }
    </style>
</head>
<body>

<header>
    <h1>Espace Adhérent</h1>
</header>

<nav>
    <a href="../index.html">Accueil</a>
    <a href="logout.php">Déconnexion</a>
</nav>

<main class="container">
    <div class="profile-card">
        <h2>Bienvenue, <?php echo htmlspecialchars($user['nom']); ?> !</h2>
        
        <?php if($user['est_parent']): ?>
            <p><span class="badge-parent">Compte Parent d'élève</span></p>
        <?php endif; ?>

        <div class="grade-info">
            🥋 Grade actuel : 
            <span style="color: #bc002d;">
                <?php echo $user['nom_grade'] ? htmlspecialchars($user['nom_grade']) : "Non renseigné"; ?>
            </span>
        </div>

        <div class="news-section">
            <h3>Vos documents</h3>
            <p>Retrouvez bientôt ici vos convocations aux passages de grades.</p>
        </div>
    </div>
</main>

<footer>
    <p>2026 - Sport Ensemble Karate</p>
</footer>

</body>
</html>