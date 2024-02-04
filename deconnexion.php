<?php
session_start();

// Déconnexion de l'utilisateur
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}

// Redirection vers la page d'accueil (ou une autre page après la déconnexion)
header("Location: index.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Ajoutez vos autres liens de style ici -->
    <style>
        /* Ajoutez votre CSS ici si nécessaire */
    </style>
    <title>Déconnexion</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="mb-4">Déconnexion réussie</h2>
                        <p>Vous avez été déconnecté avec succès.</p>
                        <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
