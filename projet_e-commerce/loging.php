<?php
// login.php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion - E-commerce</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header>
        <h1>Mon E-commerce</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="register.php">Inscription</a></li>
            <li><a href="login.php">Connexion</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Connexion</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="button">Se connecter</button>
        </form>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Mon E-commerce</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>

</html>