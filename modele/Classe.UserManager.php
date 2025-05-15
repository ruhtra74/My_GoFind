<?php
    class UserManager{

        //Fonction qui prend en entree une adresse mail ou un numero de telephone et renvoi le nombre de fois 
        //que ces informations sont presentes dans la bd
        public function verifInfoMod($pseudo, $tel, $mail, $bd){
            $requete = $bd->prepare("SELECT COUNT(*) AS cnt FROM utilisateur WHERE (mail = ? OR tel = ? OR pseudo = ?) AND idUtilisateur != ?");

            $requete->execute([$mail, $tel, $pseudo, $_SESSION["idUtilisateur"]]);
            $resultat = $requete->fetch()[0];

            return $resultat;
            
        }

        //Fonction permettant d'ajouter dans la BD un nouvel utilisateur a partir de ses informations
        public function modifierUtilisateur($mail, $tel, $pseudo, $bd){
            $requete = $bd->prepare("UPDATE utilisateur SET mail = ?, tel = ?, pseudo = ? WHERE idUtilisateur = ?");
            $resultatReq = $requete->execute([$mail, $tel, $pseudo, $_SESSION["idUtilisateur"]]);

            return $resultatReq;
        }

        public function selectionnerUtilisateur($pseudo, $password, $db){
            $requete = $db->prepare("SELECT idUtilisateur FROM utilisateur WHERE pseudo = ? AND motDePasse = ? ");
            $requete->execute([$pseudo, $password]);
            $id = $requete->fetch()[0];

            return $id;
        }

        public function supprimerCompte($db){
            $requete = $db->prepare("DELETE FROM offrecolocation WHERE idAnnonceur = ?");
            $requete->execute([$_SESSION["idUtilisateur"]]);
            $requete = $db->prepare("DELETE FROM offrecovoiturage WHERE idAnnonceur = ?");
            $requete->execute([$_SESSION["idUtilisateur"]]);
            $requete = $db->prepare("DELETE FROM utilisateur WHERE idUtilisateur = ?");
            $requete->execute([$_SESSION["idUtilisateur"]]);

            return $requete;
        }
    }

?>