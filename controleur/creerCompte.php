<?php
    if (isset($_POST["creerCompte"]) AND isset($_POST["pseudo"]) AND isset($_POST["tel"]) AND isset($_POST["mail"]) AND isset($_POST["password"])) {
        session_start();
        include("../modele/chargeurClasses.php");

        /*                                             */
        /* Script qui gere le processus d'inscription. */
        /*                                             */

        //Objets
        $ctrl = new Controleur();

        $ctrl->verifInfoInscription($_POST["pseudo"], $_POST["tel"], $_POST["mail"], $_POST["password"]);

    }
?>