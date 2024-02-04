<!DOCTYPE html>
<html>
<head>
    <title>Commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .commande-header {
            text-align: center;
            color: #333;
        }

        .commande-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .commande-item {
            background-color: #fff;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 30%;
            text-align: center;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
        }

        h2 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
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

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .btn {
            display: block;
            width: 150px;
            margin-top: 20px;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #555;
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

    </style>
</head>
<body>
    <h1 class="commande-header">Adresse de Livraison</h1>

    <?php
    session_start();

    if (isset($_GET['id_panier'])) {
        $id_panier = $_GET['id_panier'];
        $db = new SQLite3('db.db');
        
        // Récupérez les produits associés à ce panier depuis la table "commande_produits"
        $stmt = $db->prepare("SELECT produits.nom, produits.description, produits.image_url, commande_produits.prix FROM commande_produits
                     JOIN produits ON produits.id_produit = commande_produits.id_produit
                     WHERE commande_produits.id_commande = :id_commande");

        $stmt->bindValue(':id_commande', $id_panier, SQLITE3_INTEGER);
        $result = $stmt->execute();
        
        echo '<div class="commande-container">';
        
        $total = 0; // Initialisez le total à zéro
        
        while ($row = $result->fetchArray()) {
            echo '<div class="commande-item">';
            echo '<img src="' . $row['image_url'] . '" alt="' . $row['nom'] . '" style="width: 100px; height: 100px;">';
            echo '<h2>' . $row['nom'] . '</h2>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<p>Prix : $' . number_format($row['prix'], 2) . '</p>';
            echo '</div>';
            
            $total += $row['prix']; // Ajoutez le prix de chaque produit au total
        }
        
        echo '</div>';
        
        $db->close();

        echo '<p class="total">Total : $' . number_format($total, 2) . '</p>'; // Affichez le montant total

    // Formulaire pour collecter les informations d'adresse de l'utilisateur
    echo '<h2>Informations d\'adresse</h2>';
    echo '<form method="post" action="commande.php?id_panier=' . $id_panier . '">';
    echo 'Rue : <input type="text" name="adresse_rue" required><br>';
    echo 'Ville : <input type="text" name="ville" required><br>';
    echo 'État : <input type="text" name="etat" required><br>';
    echo 'Code Postal : <input type="text" name="code_postal" required><br>';
    echo '<input type="submit" name="confirmer_commande" value="Confirmer la Commande">';
    echo '</form>';
    
    if (isset($_POST['confirmer_commande'])) {
        // Récupérez les informations d'adresse depuis le formulaire
        $adresse_rue = $_POST['adresse_rue'];
        $ville = $_POST['ville'];
        $etat = $_POST['etat'];
        $code_postal = $_POST['code_postal'];

        // Mettez à jour la table des adresses avec les nouvelles informations
        $db = new SQLite3('db.db');
        $stmt = $db->prepare("INSERT INTO adresses (id_utilisateur, adresse_rue, ville, etat, code_postal) VALUES (:id_utilisateur, :adresse_rue, :ville, :etat, :code_postal)");
        $stmt->bindValue(':id_utilisateur', $user_id, SQLITE3_INTEGER);
        $stmt->bindValue(':adresse_rue', $adresse_rue, SQLITE3_TEXT);
        $stmt->bindValue(':ville', $ville, SQLITE3_TEXT);
        $stmt->bindValue(':etat', $etat, SQLITE3_TEXT);
        $stmt->bindValue(':code_postal', $code_postal, SQLITE3_TEXT);
        $stmt->execute();

        // Mettez à jour la table des commandes
        $stmt = $db->prepare("INSERT INTO commandes (id_utilisateur, date_commande, prix, nom_utilisateur) VALUES (:id_utilisateur, CURRENT_DATE, :prix, :nom_utilisateur)");
        $stmt->bindValue(':id_utilisateur', $user_id, SQLITE3_INTEGER);
        $stmt->bindValue(':prix', $total, SQLITE3_FLOAT);
        $stmt->bindValue(':nom_utilisateur', $_SESSION['username'], SQLITE3_TEXT); 
        $stmt->execute();

        $db->close();
        
        echo 'Commande confirmée! Elle sera Livrée chez vous dans les jours à venir '; 
    }
} else {
    echo 'ID de panier non spécifié.';
}
?>

<a class="btn" href="index.php">Retourner au Catalogue</a>

<footer>
        © 2023 TIBAY Site Web     
    </footer>
</body>
</html>
