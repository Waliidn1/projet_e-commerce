<?php
// product.php
include 'db.php';
session_start();

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?> - E-commerce</title>
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
        <h2><?php echo $product['name']; ?></h2>
        <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="max-width: 400px;">
        <p><?php echo $product['description']; ?></p>
        <p>Prix : €<?php echo number_format($product['price'], 2); ?></p>

        <form action="cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="quantity">Quantité:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>">
            <button type="submit" class="button">Ajouter au panier</button>
        </form>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Mon E-commerce</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>

</html>