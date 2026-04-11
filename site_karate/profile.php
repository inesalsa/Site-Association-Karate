<?php
session_start();
require_once('config.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}


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
    <link rel="stylesheet" href="css/style.css"> <style>
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
    <a href="index.html">Accueil</a>
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

        <div class="documents-section" style="margin-top: 30px; text-align: left; border-top: 2px dashed #eee; padding-top: 20px;">
            <h3><i class="fas fa-file-pdf"></i> Mes Documents officiels</h3>
            <ul style="list-style: none; padding: 0;">
                
                <li style="margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; background: #f8f8f8; padding: 10px; border-radius: 5px;">
                    <span>🥋 Convocation Passage de Grade (Juin 2026)</span>
                    <a href="documents/convocation_avril.pdf" target="_blank" class="btn-martial" style="padding: 5px 10px; font-size: 0.8em; text-decoration: none;">Télécharger</a>
                </li>

                <?php if($user['est_parent']): ?>
                <li style="margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; background: #fff5f5; padding: 10px; border-radius: 5px; border: 1px solid var(--rouge-karate);">
                    <span>👨‍👩‍👧‍👦 Autorisation parentale (Compétition)</span>
                    <a href="documents/autorisation_parentale.pdf" target="_blank" class="btn-martial" style="padding: 5px 10px; font-size: 0.8em; text-decoration: none;">Télécharger</a>
                <?php endif; ?>

                <li style="margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; background: #f8f8f8; padding: 10px; border-radius: 5px;">
                    <span>📜 Règlement intérieur du Dojo</span>
                    <a href="documents/reglement.pdf" target="_blank" class="btn-martial" style="padding: 5px 10px; font-size: 0.8em; text-decoration: none;">Voir le PDF</a>
                </li>
            </ul>
        </div>
    </div>
</main>

<footer>
    <p>2026 - Sport Ensemble Karate</p>
</footer>

</body>
</html>