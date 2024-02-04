
Je regrette la confusion. Essayons une approche différente pour diagnostiquer le problème. Vous pouvez ajouter un peu de débogage pour voir ce qui se passe. Modifiez votre code comme suit pour afficher des informations de débogage :

php
Copy code
<?php
session_start();

// Debug: Affiche les informations de session
var_dump($_SESSION);

// Si l'utilisateur n'est pas connecté, redirigez vers la page de connexion
if (empty($_SESSION['user_id'])) {
    header("Location: b.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user information from the database
$db = new SQLite3('db.db');
$stmt = $db->prepare("SELECT id_utilisateur, nom_utilisateur, email FROM utilisateurs WHERE id_utilisateur = :user_id");
$stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
$result = $stmt->execute();

if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $user_id = $row['id_utilisateur'];
    $nom_utilisateur = $row['nom_utilisateur'];
    $email = $row['email'];
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Profil</title>
</head>

<body>
    <link rel="stylesheet" href="style.css">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Baayvin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="basket.php">Basket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="veste.php">Vestes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pantalon.php">Pantalon</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
            <a href="#" class="btn btn-primary ml-2">Mon Panier <span class="badge badge-light"></span></a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Profil de <?php echo $nom_utilisateur; ?></h2>
        <p><strong>ID Utilisateur:</strong> <?php echo $user_id; ?></p>
        <p><strong>Nom d'utilisateur:</strong> <?php echo $nom_utilisateur; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <footer>
        © 2023 Baayvin Site Web
    </footer>
</body>

</html>
