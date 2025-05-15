<?php
    //Pour importer toutes les classes qu'on va utiliser
    function chargerClasse($className){
        $paths = [
        '../Controleur/',    
        '../Modele/',        
        '../Vue/',
        'controleur/',
        'modele/',
        'vue/',
        '',]; // Ajoute ici tous tes dossiers possibles
        foreach ($paths as $path) {
            $file = $path . 'Classe.' . $className . '.php';
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }

    spl_autoload_register('chargerClasse');
















/*
    function chargerClasse($className) {
    $paths = ['models/', 'controllers/', 'libs/', 'core/']; // Ajoute ici tous tes dossiers possibles
    foreach ($paths as $path) {
        $file = $path . 'Classe.' . $className . '.php';
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }
    spl_autoload_register('chargerClasse');

    function chargerClasse($className) {
        require 'Classe.' . $className . '.php';
    }
    spl_autoload_register('chargerClasse');

*/
?>