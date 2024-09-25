<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion à la Base de Données</title>
</head>

<body>
    <?php
    // db.php
    $host = 'localhost:330'; // Changez ceci selon votre configuration
    $db = 'ecommerce'; // Nom de la base de données
    $user = 'root'; // Votre nom d'utilisateur MySQL
    $pass = ''; // Votre mot de passe MySQL

    try {
        // Créer une connexion à la base de données
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p>Connexion réussie à la base de données.</p>";
    } catch (PDOException $e) {
        echo "<p>Erreur de connexion : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    ?>
</body>

</html>