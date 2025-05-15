<?php
    include("../modele/chargeurClasses.php");   //Fichier permettant d'importer les classes que l'on utilise
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription - GoFind</title>
    <link rel="stylesheet" href="../vue/CSS/stylePageConnexion.css" />
</head>

<body>
    <div class="background">
        <header class="header">
            <img src="../vue/image/logo.png" alt="GoFind Logo" class="logo" />
            <h1 class="slogan">Everything You Want</h1>
        </header>

        <main class="form-container">
            <h2 class="form-title">Connexion</h2>
            <form class="signup-form" id="signup-form" action="../controleur/seConnecter.php" method="POST">
                <div class="form-group">
                    <input type="text" placeholder="Pseudo *" name="pseudo" required />
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Mot de passe *" name="password" required />
                </div>
                <p id="pasEncore">J'ai oublie mon mot de passe</p>
                <div class="action-buttons">
                    <a href="../index.html"><button type="reset" class="submit-btn">Annuler</button></a>
                    <button type="submit" class="submit-btn" id="continuer">Continuer ➔</button>
                </div>
            </form>
        </main>
    </div>
</body>
<script src="../controleur/JS/js2.js"></script>

</html>