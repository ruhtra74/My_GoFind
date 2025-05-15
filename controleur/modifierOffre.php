<?php
    session_start();
    include("../modele/chargeurClasses.php");

    /*                                                            */
    /*  Script qui gere le processus d'enregistrement des offres. */
    /*                                                            */

    //Objet
    $ctrl = new Controleur();
    if (isset($_POST["modifOffreColoc"]) and isset($_GET["idOffre"]) and isset($_POST["montantOffreColocModif"]) and isset($_POST["typeLogementModif"]) and isset($_POST["adresseLogementModif"]) and isset($_POST["nbrePiecesModif"]) and isset($_POST["descLogementModif"])) {
        $ctrl->modifierOffreColoc($_GET["idOffre"], $_POST["descLogementModif"], $_POST["nbrePiecesModif"], $_POST["adresseLogementModif"], $_POST["typeLogementModif"], $_POST["montantOffreColocModif"]);
    } elseif (isset($_POST["modifOffreCoVoi"]) and isset($_GET["idOffre"]) and isset($_POST["adresseDepartModif"]) and isset($_POST["adresseArriveModif"]) and isset($_POST["dateDepartModif"]) and isset($_POST["marqueVehiculeModif"]) and isset($_POST["modeleVehiculeModif"]) and isset($_POST["descVehiculeModif"]) and isset($_POST["montantOffreCovoiModif"]) and isset($_POST["nbrePlaceModif"])) {
        $ctrl->modifierOffreCovoi($_GET["idOffre"], $_POST["adresseDepartModif"], $_POST["adresseArriveModif"], $_POST["dateDepartModif"], $_POST["marqueVehiculeModif"], $_POST["modeleVehiculeModif"], $_POST["nbrePlaceModif"], $_POST["descVehiculeModif"], $_POST["montantOffreCovoiModif"]);
    } else {
        echo "Merde";
    }
?>