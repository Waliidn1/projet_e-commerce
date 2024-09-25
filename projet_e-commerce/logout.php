<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Déconnexion</title>
</head>

<body>
    <?php
    // logout.php
    session_start(); // Démarrer la session
    session_destroy(); // Détruire la session pour déconnecter l'utilisateur

    // Rediriger vers la page d'accueil
    header('Location: index.php');
    exit;
    ?>
</body>

</html>