<?php
// checkout.php
session_start();
include 'db.php';

$cart = $_SESSION['cart'];
$total = 0;

if (empty($cart)) {
    header('Location: index.php'); // Redirige vers l'accueil si le panier est vide
    exit;
}

foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ici vous pouvez ajouter le traitement pour enregistrer la commande
    $user_id = $_SESSION['user_id'] ?? null; // Si l'utilisateur est connecté
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
    $stmt->execute([$user_id, $total]);
    $order_id = $pdo->lastInsertId();

    foreach ($cart as $id => $item) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $id, $item['quantity'], $item['price']]);
    }

    // Réinitialiser le panier
    unset($_SESSION['cart']);
    header('Location: index.php'); // Redirige vers l'accueil après la commande
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Paiement - E-commerce</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header>
        <h1>Mon E-commerce</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="cart.php">Panier</a></li>
            <li><a href="login.php">Connexion</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Paiement</h2>
        <h3>Total à payer : €<?php echo number_format($total, 2); ?></h3>
        <form method="POST">
            <button type="submit" class="button">Confirmer la commande</button>
        </form>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Mon E-commerce</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>

</html>