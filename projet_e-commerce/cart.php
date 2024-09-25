<?php
// cart.php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Vérifier si le produit est déjà dans le panier
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Récupérer les infos du produit
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity
        ];
    }
}

// Affichage du panier
$cart = $_SESSION['cart'];
$total = 0;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Panier - E-commerce</title>
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
        <h2>Votre Panier</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cart)): ?>
                    <?php foreach ($cart as $id => $item): ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td>€<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>€<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        </tr>
                        <?php $total += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Votre panier est vide.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Total : €<?php echo number_format($total, 2); ?></h3>
        <a href="checkout.php" class="button">Passer à la caisse</a>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Mon E-commerce</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>

</html>