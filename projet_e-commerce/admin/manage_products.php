<?php
// admin/manage_products.php
session_start();
include '../db.php';

// Assurez-vous que l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Ajouter un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_FILES['image']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $image);

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, stock) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $image, $stock]);

    header('Location: manage_products.php');
    exit;
}

// Lister les produits
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gérer les produits - E-commerce</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <header>
        <h1>Gérer les produits</h1>
    </header>

    <nav>
        <ul>
            <li><a href="dashboard.php">Tableau de bord</a></li>
            <li><a href="manage_products.php">Gérer les produits</a></li>
            <li><a href="view_orders.php">Voir les commandes</a></li>
            <li><a href="../logout.php">Déconnexion</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Ajouter un produit</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea>
            <label for="price">Prix :</label>
            <input type="number" id="price" name="price" step="0.01" required>
            <label for="stock">Stock :</label>
            <input type="number" id="stock" name="stock" required>
            <label for="image">Image :</label>
            <input type="file" id="image" name="image" required>
            <button type="submit" class="button">Ajouter</button>
        </form>

        <h2>Produits existants</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td>€<?php echo number_format($product['price'], 2); ?></td>
                        <td><?php echo $product['stock']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Mon E-commerce</p>
    </footer>

</body>

</html>