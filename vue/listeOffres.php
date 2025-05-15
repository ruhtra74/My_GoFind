<?php
    //La page a commence a s'afficher, on a deja demmarre la session, on va juste toutes les offres qui sont disponible
    include("../modele/chargeurClasses.php");
    $ctrl = new Controleur();
    
    if(isset($_GET["voirMesOffres"])){
        $ctrl->afficherMesOffres();
    }else{
        $ctrl->afficherOffres();
    }
        
    
?>

