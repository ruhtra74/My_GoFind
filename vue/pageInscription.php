<?php
    include("../modele/chargeurClasses.php");   //Fichier permettant d'importer les classes que l'on utilise
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription - GoFind</title>
    <link rel="stylesheet" href="css/stylesPageInscription.css" />
</head>

<body>
    <div class="background">
        <header class="header">
            <img src="image/logo.png" alt="GoFind Logo" class="logo" />
            <h1 class="slogan">Everything You Want</h1>
        </header>

        <main class="form-container">
            <h2 class="form-title">Inscription</h2>
            <form class="signup-form" id="signup-form" action="../controleur/creerCompte.php" method="POST">
                <div id="signup-form-1">
                    <div class="form-group">
                        <input type="text" placeholder="Pseudo *" name="pseudo" required/>
                    </div>
                    <div class="form-group">
                        <input type="number" placeholder="Numéro de téléphone *" name="tel" required />
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="E-mail *" name="mail" required />
                    </div>
                    <div class="action-buttons">
                        <button type="reset" class="submit-btn">Annuler</button>
                        <button type="submit" class="submit-btn" id="continuer">Continuer ➔</button>
                    </div>
                </div>
                <div id="signup-form-2" style="display: none;">
                    <div class="form-group">
                        <input type="password" placeholder="Mot de passe" id="motDePasse" name="password"/>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Confirmer votre mot de passe" id="confirmMotDePasse" />
                    </div>
                    <div class="action-buttons">
                        <button type="reset" class="submit-btn" id="annuler">Annuler</button>
                        <button type="submit" class="submit-btn" name="creerCompte">Creer Votre Compte</button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>
<script src="../controleur/JS/js1.js"></script>
<?php
    if(isset($message)){
        echo
        "
            <script>alert('".$message."');</script>
        ";
    }
?>
</html>