<?php
    if (isset($_POST["supprCompte"])) {
        session_start();
        include("../modele/chargeurClasses.php");
        /*                                                               */
        /*  Script qui gere le processus de suppresion de l'utilisateur. */
        /*                                                               */

        //Objet
        $ctrl = new Controleur();

        $ctrl->supprimerCompte();
    } else {
        header("location: ../vue/pageAccueil.php");
    }   
?>