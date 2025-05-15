<?php
class Controleur
{
    private $_connexion;    //Pour se connecter a la BD
    const AUCUNE_MODIFICATION = -1;
    const VALEURS_VALIDES = 1;


    public function __construct()
    {
        try {
            $db = new PDO('mysql:host=localhost; dbname=gofindbd', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            die("Echec de la connexion : " . $e->getMessage());
        }
        $this->setConnexion($db);
    }

    //Getters et Setters
    public function setConnexion(PDO $connec)
    {
        $this->_connexion = $connec;
    }
    public function getConnexion()
    {
        return $this->_connexion;
    }


/*




































Pour les connexions


































*/
    public function verifInfoConnexion($pseudo, $password){
        $connecManager = new ConnexionManager();

        $id = $connecManager->verifInfoConnexion($pseudo, $password, $this->getConnexion());
        if ($id == ConnexionManager::AUCUN_UTILISATEUR) {
            //Si l'utilisateur n'existe pas, on redirige vers la page de connexion
            echo "
                    <script>
                        alert('Cet utilisateur n\'existe pas 😥')
                        window.location.href='../vue/PageConnexion.php';
                    </script>
                ";
        } elseif($id == false) {
            //Si la requete a echoue, on redirige vers la page d'accueil
                echo "
                    <script>
                        window.location.href='../index.html';
                    </script>
                  ";  
        }else{
            //Maintenant qu'on a l'id de l'utilisateur qui veut se connecter,
            $infoUtilisateur = $connecManager->recupererInfoUtilisateur($id, $this->getConnexion());

            //On verifie si la requete a reussi
            if ($infoUtilisateur == false) {    //Si la requete a echoue, on redirige vers la page de connexion
                echo "
                    <script>
                        window.location.href='../vue/PageConnexion.php';
                    </script>
                ";
            }else{
                //On enregistre ses informations personnelles dans les sessions
                $this->enregistrerSessionPHP($infoUtilisateur);
                $this->enregistrerSessionJS($infoUtilisateur);


                //Et on se redirige vers la page d'accueil
                echo "
                    <script>
                        window.location.href='../vue/pageAccueil.php';
                    </script>
                ";
            }
        }
    }
/*



















enregistrer dans les sessions les informations de l'utilisateur qui se connecte






















*/
    //Fonction qui prend en parametre les information sur l'utilisateur qui souhaite se connecter
    //En enregistre ces valeurs la dans la session (PHP)
    private function enregistrerSessionPHP($infos)
    {
        foreach ($infos as $key => $valeur) {
            $_SESSION[$key] = $valeur;
        }
    }

    //Fonction qui prend en parametre les information sur l'utilisateur qui souhaite se connecter
    //En enregistre ces valeurs la dans la session (JS)
    private function enregistrerSessionJS($info)
    {
        // Convertir le tableau $info en JSON
        $jsonInfo = json_encode($info);
        echo "
            <script>
                var data = $jsonInfo;
                for (var key in data) {
                    sessionStorage.setItem(key, data[key]);
                }
            </script>
        ";
    }


    /*
    
    
    
    
    
    
    
    
    
    
    














    
    
    
    Pour les inscriptions































    */
    public function verifInfoInscription($pseudo, $tel, $mail, $password){
        $authentiMan = new AuthentificationManager();

        //On verifie d'abord si un utilisateur possedant ces informations est deja enregistre
        $nbre = $authentiMan->verifInfoInscription($mail, $tel, $pseudo, $this->getConnexion());

        if ($nbre > 0) {        //Si c'est le cas...
            echo "
                <script>
                    alert('Cet Utilisateur s\'est deja inscrit. 😬');
                    window.location.href='../vue/pageInscription.php';
                </script>
            ";
        } elseif($nbre == AuthentificationManager::ECHEC_REQUETE) { //Si la requete a echoue...
            echo "
                <script>
                    window.location.href='../vue/pageInscription.php';
                </script>
            ";
        }else{      //Si tout est ok...
            //On insere l'utilisateur dans la table utilisateur
            $ajout = $authentiMan->ajouterUtilisateur($mail, $tel, $pseudo, $password, $this->getConnexion());

            //Si l'ajout a reussi 
            if ($ajout) {
                //On recupere son id 
                $id = $authentiMan->selectionnerUtilisateur($pseudo, $password, $this->getConnexion());
                
                if($id == AuthentificationManager::ECHEC_REQUETE) {    //Si on a pas pu recupere l'id de l'utilisateur, on redirige vers la page d'inscription
                    echo "
                        <script>
                            window.location.href='../vue/pageInscription.php';
                        </script>
                    ";
                    exit();
                }else{
                    //Si on a bien recupere l'id de l'utilisateur, on recupere ses informations
                    $info = $authentiMan->recupererInfoUtilisateur($id, $this->getConnexion());
                }

                if ($info == AuthentificationManager::ECHEC_REQUETE) {    //Si on a pas pu recuperer ss informations, on redirige vers la page de connexion
                    echo "
                        <script>
                            window.location.href='../vue/PageConnexion.php';
                        </script>
                    ";
                } else {    //Si on a reussi a recuperer ses informations
                    //On enregistre ses informations personnelles dans les sessions
                    $this->enregistrerSessionPHP($info);
                    $this->enregistrerSessionJS($info);


                    //Et on se redirige vers la page d'accueil
                    echo "
                        <script>
                            alert('Bienvenue sur GoFind. 🤗');
                            window.location.href='../vue/pageAccueil.php';
                        </script>
                    ";
                }
            } elseif($ajout == AuthentificationManager::ECHEC_REQUETE) {//Si l'ajout de l'utilisateur a echoue
                //On redirige vers la page d'inscription
                echo "
                    <script>
                        alert('Erreur innatendue 🤔');
                        window.location.href='../vue/pageInscription.php';
                    </script>
                ";
            }
        }
    }

/*

































Pour les modifications des informations de l'utilisateur






























*/
    public function verifInfoMod($pseudo, $tel, $mail){
        $userMan = new UserManager();

        //On suppose que les valeurs entrees sont ok et 
        //si une des informations est deja utilise par un autre utilisateur
        $nbre = $userMan->verifInfoMod($pseudo, $tel, $mail, $this->getConnexion());

        if ($nbre > 0) {
            $message = "Modification impossible car l\'une de ces valeurs a déjà été attribué à un autre utilisateur. 😗";

            $this->afficherAlert($message);
            $this->redirection("../vue/pageAccueil.php");
        } else {
            $modif = $userMan->modifierUtilisateur($mail, $tel, $pseudo, $this->getConnexion());
            if ($modif) {
                //Maintenant que la modification a reussi, on cree un tableau contenant les nouvelles informations de l'utilisateur
                $infoUtilisateur = [
                    "mail" => $mail,
                    "pseudo" => $pseudo,
                    "tel" => $tel,
                    "idUtilisateur" => $_SESSION["idUtilisateur"]
                ];

                //On met donc a jour les sessions
                $this->enregistrerSessionPHP($infoUtilisateur);
                $this->enregistrerSessionJS($infoUtilisateur);

                $message = "Modifications enregistrées. 👍";
                $this->afficherAlert($message);
                $this->redirection("../vue/pageAccueil.php");
            } else {
                $message = "Erreur innatendue! 🤔";
                $this->afficherAlert($message);
                $this->redirection("../vue/pageAccueil.php");
            }
        }
    }


/*































Supprimer son compte


































*/
    public function supprimerCompte(){
        $userMan = new UserManager();

        $resultat = $userMan->supprimerCompte($this->getConnexion());
        if ($resultat) {
            $message = "Navré de vous voir nous quitter. 😔";
            $this->afficherAlert($message);
            $this->redirection("../index.html");
        } else {
            $message = "Euuuuhg, une erreur s'est produite désolé. 👀";
            $this->afficherAlert($message);
            $this->redirection("../vue/pageAccueil.php");
        }
    }
/*

















































enregistrer une offre de co-location


















































*/
    public function enregistrerOffreColoc($descLogement, $nbrePieces, $adresseLogement, $photologement, $typeLogement, $montant)
    {
        $offreMan = new OffreManager();

        //On deplace la photo vers le serveur 
        $cheminImage = "../vue/imagesUpload/" . $photologement["name"];        //Chemin ou sera enregistre l'image
        move_uploaded_file($photologement["tmp_name"], $cheminImage);

        $result = $offreMan->enregistrerOffreColoc($descLogement, $nbrePieces, $adresseLogement, $cheminImage, $typeLogement, $montant, $this->getConnexion());
        if ($result) {
            $message = "Votre offre a été enregistrée. 👌";
            $this->afficherAlert($message);
            $this->redirection("../vue/pageAccueil.php");
        } else {
            $message = "Euuuuhg, une erreur s'est produite désolé. 👀";
            $this->afficherAlert($message);
            $this->redirection("../vue/pageAccueil.php");
        }
    }

/*













































enregistrer une offre de co-voiturage




































































*/
    public function enregistrerOffreCovoi($photoVehicule, $adresseDepart, $adresseArrive, $dateDepart, $marqueVehicule, $modeleVehicule, $nbrePlace, $descVehicule, $montant){
        $offreMan = new OffreManager();

        //On deplace la photo vers le serveur 
        $cheminImage = "../vue/imagesUpload/" . $photoVehicule["name"];        //Chemin ou sera enregistre l'image
        move_uploaded_file($photoVehicule["tmp_name"], $cheminImage);
        //On converti pour SQL
        $dateDepart = str_replace("T", " ", $dateDepart) . ":00";

        $result = $offreMan->enregistrerOffreCovoi($cheminImage, $adresseDepart, $adresseArrive, $dateDepart, $marqueVehicule, $modeleVehicule, $nbrePlace, $descVehicule, $montant, $this->getConnexion());
        if ($result) {
            $message = "Votre offre a été enregistrée. 👌";
            $this->afficherAlert($message);
            $this->redirection("../vue/pageAccueil.php");

        } else {
            $message = "Euuuuhg, une erreur s\'est produite désolé. 👀";
            $this->afficherAlert($message);
            $this->redirection("../vue/pageAccueil.php");
        }
    }

/*






































affichage des offres












































*/

    //Methode appele pour l'affichage de toutes les offres dans la page d'accueil
    public function afficherOffres(){
        $offreMan = new OffreManager();

        $offres = $offreMan->afficherOffresColoc($this->getConnexion());

        //On affiche les offres de co-location

        echo "<div class=\"offers-section\">";
        if (empty($offres)) {
            $this->afficherSurPage("<p>Aucune offre de Co-Location disponible.</p>");
        } else {
            $this->afficherSurPage("<h2>Offres De Co-Location</h2>");
            foreach ($offres as $offre) {
                $this->afficherOffreColoc($offre['photoLogement'], $offre['adresseLogement'], $offre['typeLogement'], $offre['nbrePieces'], "tous", $offre['idOffre'], $offre['dateAjout']);
            }
        }
        echo "</div>";

        $offres = $offreMan->afficherOffresCoVoi($this->getConnexion());
        //On affiche les offres de co-voiturage
        
        echo "<div class=\"offers-section\">";
        if (empty($offres)) {
            $this->afficherSurPage("<p>Aucune offre de Co-Voiturage disponible.</p>");
        } else {
            echo "<h2>Offres De Co-Voiturage</h2>";
            foreach ($offres as $offre) {
                $this->afficherOffreCovoi($offre['photoVoiture'], $offre['depart'], $offre['destination'], $offre['dateDepart'], $offre['marqueVoiture'], $offre['modeleVoiture'], "tous", $offre['idOffre'], $offre['dateAjout']);
            }
        }
        echo "</div>";
    }

    //Methode appele pour l'affichage des offres de l'utilisateur dans la page d'accueil lorsqu'il clique dessus
    public function afficherMesOffres(){
        $offreMan = new OffreManager();
        $offres = $offreMan->afficherMesOffresColoc($this->getConnexion());

        //pour les offres de co-location
        echo "<div class=\"offers-section\">";
        if (empty($offres)) {
            //Dans le cas ou l'utilisateur n'a pas publier d'offre
            $this->afficherSurPage("<h2>Vous n'avez aucune offre de Co-Location.</h2>");
        }else{  //S'il en a...
            //On envoi les offres en JSON pour les afficher dans le formulaire
            echo "<script>
                offresColoc =" . json_encode($offres, JSON_HEX_TAG) . ";
                console.log(offresColoc);
            </script>";
            //Et on les affiche un a un
            $this->afficherSurPage("<h2>Offres De Co-Location</h2>");
            foreach ($offres as $offre) {
                $this->afficherOffreColoc($offre['photoLogement'], $offre['adresseLogement'], $offre['typeLogement'], $offre['nbrePieces'], "mesOffres", $offre['idOffre'], $offre['dateAjout']);
            }
        }
        echo "</div>";

        //Pour les offres de co-voiturage
        $offres = $offreMan->afficherMesOffresCoVoi($this->getConnexion());

        echo "<div class=\"offers-section\">";
        if (empty($offres)) {
            $this->afficherSurPage("<h2>Vous n'avez aucune offre de Co-Voiturage.</h2>");
        } else {
            //On envoi les offres en JSON pour les afficher dans le formulaire
            $this->afficherSurPage("<script>
                offresCovoi =".json_encode($offres, JSON_HEX_TAG).";
                console.log(offresCovoi);
            </script>");
            //Et on les affiche un a un
            $this->afficherSurPage("<h2>Offres De Co-Voiturage</h2>");
            foreach ($offres as $offre) {
                $this->afficherOffreCovoi($offre['photoVoiture'], $offre['depart'], $offre['destination'], $offre['dateDepart'], $offre['marqueVoiture'], $offre['modeleVoiture'], "mesOffres", $offre['idOffre'], $offre['dateAjout']);
            }
        }
        echo "</div>";
    }
/*







































modifier une offre
















































*/  //Pour lees offres de co-location
    public function modifierOffreColoc($idOffre, $descLogement, $nbrePieces, $adresseLogement, $typeLogement, $montant){
        $offreMan = new OffreManager();
        if(isset($_FILES["photoLogementModif"]) and !empty($_FILES["photoLogementModif"]["name"]) ){    //Si l'utilsateur a modifie la photo
            $photoLogementModif = $_FILES["photoLogementModif"];

            $cheminImage = "../vue/imagesUpload/" . $photoLogementModif["name"];        //Chemin ou sera enregistre l'image
            move_uploaded_file($photoLogementModif["tmp_name"], $cheminImage);     //Puis on deplace la photo vers le serveur
            $resultat = $offreMan->modifierPhoto($cheminImage, $idOffre, "photoLogement", "offreColocation", $this->getConnexion());
            
        }
        $resultat = $offreMan->modifierOffreColoc($descLogement, $nbrePieces, $adresseLogement, $typeLogement, $montant, $idOffre, $this->getConnexion());
        if($resultat){
            $message = "Votre offre a été modifiée. 👌";
            $this->afficherAlert($message);
            $this->redirection("../vue/pageAccueil.php?voirMesOffres=1");
        }
    }
    //Pour les offres de co-voiturage
    public function modifierOffreCovoi($idOffre, $adresseDepart, $adresseArrive, $dateDepart, $marqueVehicule, $modeleVehicule, $nbrePlace, $descVehicule, $montant){
        $offreMan = new OffreManager();
        if (isset($_FILES["photoVehiculeModif"]) and !empty($_FILES["photoVehiculeModif"]["name"])) {    //Si l'utilsateur a modifie la photo
            $photoVehiculeModif = $_FILES["photoVehiculeModif"];

            $cheminImage = "../vue/imagesUpload/" . $photoVehiculeModif["name"];        //Chemin ou sera enregistre l'image
            move_uploaded_file($photoVehiculeModif["tmp_name"], $cheminImage);     //Puis on deplace la photo vers le serveur
            $resultat = $offreMan->modifierPhoto($cheminImage, $idOffre, "photoVoiture", "offrecovoiturage", $this->getConnexion());
        }
        $resultat = $offreMan->modifierOffreCovoi($adresseDepart, $adresseArrive, $dateDepart, $marqueVehicule, $modeleVehicule, $nbrePlace, $descVehicule, $montant, $idOffre, $this->getConnexion());
        if ($resultat) {
            $message = "Votre offre a été modifiée. 👌";
            $this->afficherAlert($message);
            $this->redirection("../vue/pageAccueil.php?voirMesOffres=1");
        }
    }
/*






















































supprimer un offre




















































*/
    //Pour les offres de co-voiturage
    public function supprimerOffreCovoi($id){
        $offreMan = new OffreManager();
        $resultat = $offreMan->supprimerOffreCovoi($id, $this->getConnexion());
        if ($resultat) {
            $message = "Votre offre a été supprimée. 👍";
            $this->afficherAlert($message);	
            $this->redirection("../vue/pageAccueil.php?voirMesOffres=1");
        }
    }
    //Pour les offres de co-location
    public function supprimerOffreColoc($id){
        $offreMan = new OffreManager();
        $resultat = $offreMan->supprimerOffreColoc($id, $this->getConnexion());
        if ($resultat) {
            $message = "Votre offre a été supprimée. 👍";
            $this->afficherAlert($message);
            $this->redirection("../vue/pageAccueil.php?voirMesOffres=1");
        }
    }






































    private function redirection($url){
        echo "
            <script>
                window.location.href='$url';
            </script>
        ";
    }

    private function afficherAlert($message){
        echo "
            <script>
                alert('$message');
            </script>
        ";
    }

    private function afficherSurPage($message){
        echo $message;
    }



    //On recupere et on formate les informations sur l'offre avant de l'afficher
    private function afficherOffreCovoi($photoVoiture, $depart, $destination, $dateDepart, $marqueVoiture, $modeleVoiture, $quel, $id, $date){
        $message = "
            <div class='offer-card'>
                <div class='offer-info'>
                    <div class='offer-img'>
                        <img src='" .htmlspecialchars($photoVoiture) . "' alt='Image de l offre' />
                    </div>
                    <div class='offer-details'>
                        <strong> " . htmlspecialchars($depart) . " - " . htmlspecialchars($destination) . "</strong><br />
                        <small>" . htmlspecialchars($dateDepart) . "</small><br>
                        <small>" . htmlspecialchars($marqueVoiture) . " " . htmlspecialchars($modeleVoiture) . "</small><br />
                        <small>" . htmlspecialchars(substr($date, 0, 10)) . "</small>
                    </div>
                </div>
        ";
        $this->afficherSurPage($message);
        //Une fois les informations sur l'offre affichees, on affiche les boutons
        if ($quel == "tous") { //Si on est sur la page d'accueil on va afficher detail et repondre
            $message = "
                    <div class='offer-buttons'>
                        <button>Detail</button>
                        <button>Répondre</button>
                    </div>
                </div>
            ";
        } elseif ($quel == "mesOffres") {  //Si on est sur la page de mes offres, on va afficher modifier et supprimer
            $message = "
                    <div class='offer-buttons'>
                        <button class='actionOffre' onclick='modifierOffreCovoi(" . $id . ")'>Modifier</button>
                        <button class='actionOffre' onclick='supprimerOffreCovoi(" . $id . ")'>Supprimer</button>
                    </div>
                </div>
            ";
        }
        $this->afficherSurPage($message);
    }
    private function afficherOffreColoc($photoLogement, $adresseLogement, $typeLogement, $nbrePieces, $quel, $id, $date){
        $message = "
            <div class='offer-card'>
                <div class='offer-info'>
                    <div class='offer-img'>
                        <img src='" . htmlspecialchars($photoLogement) . "' alt='Image de l offre' />
                    </div>
                    <div class='offer-details'>
                        " . htmlspecialchars($adresseLogement) . "<br>
                        <strong>" . htmlspecialchars($typeLogement) . "</strong><br>
                        <small>" . htmlspecialchars($nbrePieces) . " Pièces</small> <br />
                        <small>" . htmlspecialchars(substr($date, 0, 10)) . "</small>
                    </div>
                </div>
            ";
        $this->afficherSurPage($message);
        //Une fois les informations sur l'offre affichees, on affiche les boutons
        if($quel == "tous"){ //Si on est sur la page d'accueil on va afficher detail et repondre
            $message ="
                    <div class='offer-buttons'>
                        <button>Detail</button>
                        <button>Répondre</button>
                    </div>
                </div>
            ";
        }elseif($quel == "mesOffres"){  //Si on est sur la page de mes offres, on va afficher modifier et supprimer
            $message = "
                    <div class='offer-buttons'>
                        <button class='actionOffre' onclick='modifierOffreColoc(".$id. ")'>Modifier</button>
                        <button class='actionOffre' onclick='supprimerOffreColoc(" . $id . ")'>Supprimer</button>
                    </div>
                </div>
            ";
        }

        $this->afficherSurPage($message);
    }
}
?>