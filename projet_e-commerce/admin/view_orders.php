<?php
// admin/view_orders.php
session_start();
include '../db.php';

// Assurez-vous que l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Lister les commandes
$stmt = $pdo->query("SELECT * FROM orders");
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Voir les commandes - E-commerce</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <header>
        <h1>Voir les commandes</h1>
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
        <h2>Commandes existantes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Utilisateur</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['user_id']; ?></td>
                        <td>€<?php echo number_format($order['total'], 2); ?></td>
                        <td><?php echo $order['created_at']; ?></td>
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