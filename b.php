<?php
ob_start(); 
session_start(); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Marker+Hatch&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Rubik+Marker+Hatch&family=Sedgwick+Ave+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Permanent+Marker&family=Whisper&display=swap" rel="stylesheet">
    <style>

        .btn-primary:hover {
            color: #fff;
            background-color: rgb(19, 156, 131);
            border-color: black;
        }

            
        .btn-primary {
            color: #fff;
            background-color: black;
            border-color: black;
        }

        .card {
            box-shadow: 0 10px 28px 0 rgba(0, 0, 0, 0.5);
            transition: 0.3s;
            text-align: center;
            display: inline-block;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .container {
            padding: 2px 16px;
        }

        .navbar-nav .nav-item {
            margin-right: 75px;
        }

        .navbar-brand {
            margin-right: 180px;
            color: rgb(0, 0, 0);
            font-family: 'Sedgwick Ave Display';
        }

        .navbar-nav .nav-link {
            color: rgb(0, 0, 0) !important;
            font-family: 'Lobster', cursive;
        }

        .navbar-nav .nav-link:hover {
            color: rgb(152, 161, 81) !important;
        }

        .h2 {
            padding: 50px;
            font-family: 'Bungee Shade', sans-serif;
            font-family: 'Permanent Marker', cursive;
            font-family: 'Whisper', cursive;
        }

        body {
            background-color: rgba(217, 217, 217, 0.664);
        }

        #background-video {
            width: 100%;
            height: auto;
            position: absolute;
            top: 0;
            left: 0;
            object-fit: cover;
            z-index: -1;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;                                                            
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
    <title>Navbar and Cards</title>
</head>

<body>

    <!-- Navbar -->
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
                    <a class="nav-link" href="#">Se Déconecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Basket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Vestes</a>
                </li>   
                <li class="nav-item">
                    <a class="nav-link" href="#">Pantalon</a>   
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
            <a href="#" class="btn btn-primary ml-2">Mon Panier <span class="badge badge-light"></span></a>
        </div>
    </nav>

    <body class="bg-light">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ajouter un utilisateur</h5>
                            <form method="post" action="b.php">
                                <div class="form-group">
                                    <label for="username">Nom d'utilisateur :</label>
                                    <input type="text" id="username" name="username" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email :</label>
                                    <input type="email" id="email" name="email" class="form-control" required>                                                                                                                                                      
                                </div>
                                <div class="form-group">
                                    <label for="password">Mot de passe :</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </form>
                        </div>
                    </div>  
                </div>
        
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Supprimer un utilisateur</h5>
                            <form method="post" action="b.php">
                                <div class="form-group">
                                    <label for="email_to_delete">Email de l'utilisateur à supprimer :</label>
                                    <input type="email" id="email_to_delete" name="email_to_delete" class="form-control">
                                </div>
                                <button type="submit" name="delete_user" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Se connecter</h5>
                            <form method="post" action="b.php">
                                <div class="form-group">
                                    <label for="login_username">Nom d'utilisateur :</label>
                                    <input type="text" id="login_username" name="login_username" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="login_password">Mot de passe :</label>
                                    <input type="password" id="login_password" name="login_password" class="form-control" required>
                                </div>
                                <button type="submit" name="login" class="btn btn-success">Se connecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new SQLite3('db.db');

            if (isset($_POST['delete_user'])) {
                $email_to_delete = $_POST['email_to_delete'];

                $stmt = $db->prepare("DELETE FROM utilisateurs WHERE email = :user_email");
                $stmt->bindParam(':user_email', $email_to_delete, SQLITE3_TEXT);
                $stmt->execute();

                echo "Utilisateur supprimé avec succès!";
            } else if (isset($_POST['login'])) {
                $login_username = $_POST['login_username'];
                $login_password = $_POST['login_password'];

                // Vérification des informations de connexion dans la base de données
                $stmt = $db->prepare("SELECT id_utilisateur, mot_de_passe FROM utilisateurs WHERE nom_utilisateur = :username");
                $stmt->bindParam(':username', $login_username, SQLITE3_TEXT);
                $result = $stmt->execute();
                $row = $result->fetchArray();

                if ($row && password_verify($login_password, $row['mot_de_passe'])) {
                    // Informations de connexion correctes, redirigez vers catalogue.php
                    session_start();
                    $_SESSION['user_id'] = $row['id_utilisateur'];
                    header('Location: catalogue.php');
                    exit;
                } else {
                    // Informations de connexion incorrectes, affichez un message d'erreur
                    echo "Nom d'utilisateur ou mot de passe incorrect.";
                }
            } else {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $stmt = $db->prepare("INSERT INTO utilisateurs (nom_utilisateur, email, mot_de_passe) VALUES (:username, :email, :password)");
                $stmt->bindParam(':username', $username, SQLITE3_TEXT);
                $stmt->bindParam(':email', $email, SQLITE3_TEXT);
                $stmt->bindParam(':password', $password, SQLITE3_TEXT);
                $stmt->execute();

               
                $user_id = $db->lastInsertRowID();
                session_start();
                $_SESSION['user_id'] = $user_id;

                echo "Utilisateur ajouté avec succès!";
            }

            $db->close();       
        }
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                // Fonction pour basculer l'affichage du mot de passe
                $('.input-group-text').on('click', function() {
                    const passwordInput = $(this).closest('.input-group').find('input');
                    const icon = $(this).find('i');

                    if (passwordInput.attr('type') === 'password') {
                        passwordInput.attr('type', 'text');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        passwordInput.attr('type', 'password');
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    }
                });
            });
        </script>
    </body>
    <?php
ob_end_flush(); 
?>
</html>