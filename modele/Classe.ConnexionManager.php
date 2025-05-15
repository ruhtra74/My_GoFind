<?php
    class ConnexionManager{
        const AUCUN_UTILISATEUR = -1;
        
        //Fonction qui prend en entree le pseudo et le mot de passe
        //et renvoi l'id de l'utilisateur correspondant ou alors une valeur precise(-1) s'il n'y a pas de correspondance
        public function verifInfoConnexion($pseudo, $password, $db){
            try{
                $requete = $db->prepare("SELECT idUtilisateur FROM utilisateur WHERE pseudo = ? AND motDePasse = ? ");
                $requete->execute([$pseudo, $password]);

                $ligne = $requete->fetch();
                if ($ligne) {
                    $resultat = $ligne[0];
                } else {
                    $resultat = ConnexionManager::AUCUN_UTILISATEUR;
                }

                return $resultat;
            }catch(PDOException $e){
                // En cas d'erreur, on logue l'erreur et on retourne false
                error_log($e->getMessage());
                return false;
            }
        }

        //Fonction qui prend en entre un id d'un utilisateuret renvoit ses informations(mail, tel et pseudo)
        public function recupererInfoUtilisateur($id, $db){
            try{
                $requete = $db->prepare("SELECT idUtilisateur, mail, tel, pseudo FROM utilisateur WHERE idUtilisateur = ?");
                $requete->execute([$id]);

                $info = $requete->fetch(PDO::FETCH_ASSOC);
                return $info;
            }catch(PDOException $e){
                // En cas d'erreur, on logue l'erreur et on retourne false
                error_log($e->getMessage());
                return false;
            }
        }

    // //Fonction permettant d'ajouter dans la BD un nouvel utilisateur a partir de ses informations
    // function ajouterUtilisateur($mail, $tel, $pseudo, $password)
    // {
    //     $requete = $this->getConnexion()->prepare("INSERT INTO utilisateur(mail, tel, pseudo, motDePasse) VALUES(?, ?, ?, ?)");
    //     $resultatReq = $requete->execute([$mail, $tel, $pseudo, $password]);

    //     return $resultatReq;
    // }
    }

?>