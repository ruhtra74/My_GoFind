<?php
    session_start();
    if (isset($_POST["modifierInfo"]) AND isset($_POST["pseudo"]) AND isset($_POST["tel"]) AND isset($_POST["mail"])) {
        include("../modele/chargeurClasses.php");
        /*                                                                                  */
        /*  Script qui gere le processus de modification des informations de l'utilisateur. */
        /*                                                                                  */

        //Objets
        $ctrl = new Controleur();
        
        $ctrl->verifInfoMod($_POST["pseudo"], $_POST["tel"], $_POST["mail"]);
    
    }else{
        header("location: pageAccueil.php");
    }
    //Pourquoi pas mettre le action du formulaire vers cette page et traiter tout ici, afficher les alert et revenir a la page 
    //d'accueil ou de de connexion en fonction des cas ??
    //Pourquoi pas mettre tout a partir du if dans le controleur??
?>