<?php
    class AuthentificationManager{
        const ECHEC_REQUETE = -1;

        //Fonction qui prend en entree une adresse mail ou un numero de telephone ou un pseudo et renvoi le nombre de fois 
        //que ces informations sont presentes dans la bd
        public function verifInfoInscription($mail, $tel, $pseudo, $bd){
            try{
                $requete = $bd->prepare("SELECT COUNT(*) AS cnt FROM utilisateur WHERE mail = ? OR tel = ? OR pseudo = ? ");
                $requete->execute([$mail, $tel, $pseudo]);
                $resultat = $requete->fetch()[0];  

                return $resultat;
            }catch(PDOException $e){
                // En cas d'erreur, on logue l'erreur et on retourne false
                error_log($e->getMessage());

                return AuthentificationManager::ECHEC_REQUETE;
            }
        }

        //Fonction permettant d'ajouter dans la BD un nouvel utilisateur a partir de ses informations
        public function ajouterUtilisateur($mail, $tel, $pseudo, $password, $bd){
            try{
                $requete = $bd->prepare
                ("INSERT INTO utilisateur(mail, tel, pseudo, motDePasse) VALUES(?, ?, ?, ?)");
                $resultatReq = $requete->execute([$mail, $tel, $pseudo, $password]);

                return $resultatReq;
            }catch(PDOException $e){
                // En cas d'erreur, on logue l'erreur et on retourne false
                error_log($e->getMessage());

                return AuthentificationManager::ECHEC_REQUETE;
            }
        }

        public function selectionnerUtilisateur($pseudo, $password, $db){
            try{
                $requete = $db->prepare("SELECT idUtilisateur FROM utilisateur WHERE pseudo = ? AND motDePasse = ? ");
                $requete->execute([$pseudo, $password]);
                $id = $requete->fetch()[0];

                return $id;
            }catch(PDOException $e){
                // En cas d'erreur, on logue l'erreur et on retourne false
                error_log($e->getMessage());

                return AuthentificationManager::ECHEC_REQUETE;
            }
        }

        public function recupererInfoUtilisateur($id, $db)
        {
            try {
                $requete = $db->prepare("SELECT idUtilisateur, mail, tel, pseudo FROM utilisateur WHERE idUtilisateur = ?");
                $requete->execute([$id]);

                $info = $requete->fetch(PDO::FETCH_ASSOC);
                return $info;
            } catch (PDOException $e) {
                // En cas d'erreur, on logue l'erreur et on retourne false
                error_log($e->getMessage());
                return AuthentificationManager::ECHEC_REQUETE;
            }
        }
    }
?>