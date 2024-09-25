<?php
// index.php
include 'db.php';
session_start();

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil - E-commerce</title>
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
            <li><a href="register.php">Inscription</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Nos Produits</h2>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Prix : €<?php echo number_format($product['price'], 2); ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>" class="button">Voir plus</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Mon E-commerce</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>

</html>