<?php
    session_start();
    include("chargeurClasses.php");

    /*                                                            */
    /*  Script qui gere le processus d'enregistrement des offres. */
    /*                                                            */

    //Objet
    $ctrl = new Controleur();
    if (isset($_POST["supprOffreColoc"]) and isset($_GET["idOffre"])) {

        $ctrl->supprimerOffreColoc($_GET["idOffre"]);

    } elseif (isset($_POST["supprOffreCovoi"]) and isset($_GET["idOffre"])) {
        
        $ctrl->supprimerOffreCovoi($_GET["idOffre"]);
    } else {
        echo "Merde";
    }
?>
