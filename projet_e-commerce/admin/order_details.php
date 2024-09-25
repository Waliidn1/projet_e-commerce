<?php
// admin/order_details.php
session_start();
include '../db.php';

// Assurez-vous que l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

$order_id = $_GET['id'];

// Récupérer les détails de la commande
$stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt->execute([$order_id]);
$order_items = $stmt->fetchAll();

// Récupérer les informations de la commande
$stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->execute([$order_id]);
$order = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détails de la commande - E-commerce</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <header>
        <h1>Détails de la commande #<?php echo $order_id; ?></h1>
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
        <h2>Informations sur la commande</h2>
        <p>ID Utilisateur : <?php echo $order['user_id']; ?></p>
        <p>Total : €<?php echo number_format($order['total'], 2); ?></p>
        <p>Date : <?php echo $order['created_at']; ?></p>

        <h2>Produits de la commande</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_items as $item): ?>
                    <?php
                    // Récupérer les informations du produit
                    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
                    $stmt->execute([$item['product_id']]);
                    $product = $stmt->fetch();
                    ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>€<?php echo number_format($item['price'], 2); ?></td>
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