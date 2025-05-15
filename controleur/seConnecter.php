<?php
    session_start();
    /*                                               */
    /*script qui gere la connnexion d'un utilisateur.*/
    /*                                               */
    if(isset($_POST["pseudo"]) AND isset($_POST["password"])){      //Si on a bien renseigne tous les champs du formulaire, 
        include("../modele/chargeurClasses.php");
        $ctrl = new Controleur();

        $ctrl->verifInfoConnexion($_POST["pseudo"], $_POST["password"]);
    }
?>