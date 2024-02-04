<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $produit_id = $_GET['id'];
    $nom_produit = $_GET['nom'];
    $description_produit = $_GET['description'];
    $prix_produit = $_GET['prix'];
    $image_url_produit = $_GET['image_url'];

    $produit = [
        'id' => $produit_id,
        'nom' => $nom_produit,
        'description' => $description_produit,
        'prix' => $prix_produit,
        'image_url' => $image_url_produit
    ];

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    $_SESSION['panier'][] = $produit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $index = $_POST['supprimer'];
    if (isset($_SESSION['panier'][$index])) {
        unset($_SESSION['panier'][$index]);
        $_SESSION['panier'] = array_values($_SESSION['panier']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider_panier'])) {
    if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
        $db = new SQLite3('db.db');

        // Récupérez l'ID de l'utilisateur à partir de la session
        $user_id = $_SESSION['user_id'];

        // Créez un nouveau panier et obtenez son ID
        $stmt = $db->prepare("INSERT INTO paniers (id_utilisateur, prix) VALUES (:id_utilisateur, :prix)");
        $stmt->bindValue(':id_utilisateur', $user_id, SQLITE3_INTEGER);

        // Calcul du prix total du panier
        $total = 0;
        foreach ($_SESSION['panier'] as $product) {
            $total += $product['prix'];
        }

        $stmt->bindValue(':prix', $total, SQLITE3_FLOAT);
        $stmt->execute();
        $id_panier = $db->lastInsertRowID();

        // Enregistrez les produits dans la table "commande_produits"
        foreach ($_SESSION['panier'] as $product) {
            $id_produit = $product['id'];
            $stmt = $db->prepare("INSERT INTO commande_produits (id_commande, id_produit, prix) VALUES (:id_commande, :id_produit, :prix)");
            $stmt->bindValue(':id_commande', $id_panier, SQLITE3_INTEGER);
            $stmt->bindValue(':id_produit', $id_produit, SQLITE3_INTEGER);
            $stmt->bindValue(':prix', $product['prix'], SQLITE3_FLOAT);
            $stmt->execute();
        }

        $db->close();
        $_SESSION['panier'] = [];

        // Redirigez l'utilisateur vers la page de commande.php avec l'ID du panier
        header('Location: commande.php?id_panier=' . $id_panier);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mon Panier</title>
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td img {
            width: 50px;
            height: 50px;
        }

        td form {
            display: inline;
        }

        input[type="submit"] {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d32f2f;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
        }

        .empty-cart {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .valider-panier {
            text-align: center;
            margin-top: 20px;
        }

        footer {
            background-color: black;
            color: beige;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .valider-panier input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
        }

        .valider-panier input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Mon Panier</h1>

    <?php
    if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
        echo '<table>';
        echo '<tr><th>Produit</th><th>Nom</th><th>Description</th><th>Prix</th><th>Action</th></tr>';

        $total = 0;

        foreach ($_SESSION['panier'] as $index => $product) {
            echo '<tr>';
            echo '<td><img src="' . $product['image_url'] . '" alt="' . $product['nom'] . '"></td>';
            echo '<td>' . $product['nom'] . '</td>';
            echo '<td>' . $product['description'] . '</td>';
            echo '<td>$' . number_format($product['prix'], 2) . '</td>';
            echo '<td>';
            echo '<form method="post" action="panier.php">';
            echo '<input type="hidden" name="supprimer" value="' . $index . '">';
            echo '<input type="submit" value="Supprimer">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
            $total += $product['prix'];
        }

        echo '</table>';

        echo '<p class="total">Total : $' . number_format($total, 2) . '</p>';

        echo '<div class="valider-panier">';
        echo '<form method="post" action="panier.php">';
        echo '<input type="submit" name="valider_panier" value="Valider mon panier">';
        echo '</form>';
        echo '</div>';
    } else {
        echo '<p class="empty-cart">Votre panier est vide.</p>';
    }
    ?>

<footer>
        © 2023 TIBAY Site Web     
    </footer>
</body>
</html>
