<?php
// admin/dashboard.php
session_start();
include '../db.php';

// Assurez-vous que l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Compter le nombre de produits et de commandes
$products_count = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$orders_count = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - E-commerce</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <header>
        <h1>Tableau de bord</h1>
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
        <h2>Statistiques</h2>
        <p>Nombre de produits : <?php echo $products_count; ?></p>
        <p>Nombre de commandes : <?php echo $orders_count; ?></p>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Mon E-commerce</p>
    </footer>

</body>

</html>