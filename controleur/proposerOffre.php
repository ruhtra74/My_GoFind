<?php
    session_start();
    include("../modele/chargeurClasses.php");

    /*                                                            */
    /*  Script qui gere le processus d'enregistrement des offres. */
    /*                                                            */

    //Objet
    $ctrl = new Controleur();
    if (isset($_POST["propOffreColoc"]) AND isset($_FILES["photoLogement"]) AND isset($_POST["montantOffreColoc"]) AND isset($_POST["typeLogement"]) AND isset($_POST["adresseLogement"]) AND isset($_POST["nbrePieces"]) AND isset($_POST["descLogement"]) ) {
        $ctrl->enregistrerOffreColoc($_POST["descLogement"], $_POST["nbrePieces"], $_POST["adresseLogement"], $_FILES["photoLogement"], $_POST["typeLogement"], $_POST["montantOffreColoc"]);
    
    } elseif(isset($_POST["propOffreCoVoi"]) and isset($_FILES["photoVehicule"]) and isset($_POST["adresseDepart"]) and isset($_POST["adresseArrive"]) and isset($_POST["dateDepart"]) and isset($_POST["marqueVehicule"]) and isset($_POST["modeleVehicule"]) and isset($_POST["descVehicule"]) and isset($_POST["montantOffreCovoi"]) and isset($_POST["nbrePlace"]) ) {
        $ctrl->enregistrerOffreCovoi($_FILES["photoVehicule"], $_POST["adresseDepart"], $_POST["adresseArrive"], $_POST["dateDepart"], $_POST["marqueVehicule"], $_POST["modeleVehicule"], $_POST["nbrePlace"], $_POST["descVehicule"], $_POST["montantOffreCovoi"]);
    
    }else{
        echo "Merde";
    }
?>