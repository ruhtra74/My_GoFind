<?php
    class OffreManager{


        public function enregistrerOffreColoc($descLogement, $nbrePieces, $adresseLogement, $photologement, $typeLogement, $montant, $bd){
            try{
                $requete = $bd->prepare("INSERT INTO offrecolocation(adresseLogement, typeLogement, photoLogement, descriptionLogement, nbrePieces, idAnnonceur, montantOffre) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $resultatReq = $requete->execute([$adresseLogement, $typeLogement, $photologement, $descLogement, $nbrePieces, $_SESSION["idUtilisateur"], $montant]);
                return $resultatReq;
            }catch(PDOException $e){
                error_log($e->getMessage());
                return false;
            }
        }

        public function enregistrerOffreCovoi($photoVehicule, $adresseDepart, $adresseArrive, $dateDepart, $marqueVehicule, $modeleVehicule, $nbrePlace, $descVehicule, $montantOffreCovoi, $bd){
            try{
                $requete = $bd->prepare("INSERT INTO offrecovoiturage(destination, depart, marqueVoiture, nbrePlaces, photoVoiture, modeleVoiture, dateDepart, descriptionOffre, montantOffre, idAnnonceur) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $resultatReq = $requete->execute([$adresseArrive, $adresseDepart, $marqueVehicule, $nbrePlace, $photoVehicule, $modeleVehicule, $dateDepart, $descVehicule, $montantOffreCovoi, $_SESSION["idUtilisateur"]]);
                return $resultatReq;
            }catch(PDOException $e){
                error_log($e->getMessage());
                return false;
            }
        }

        public function afficherOffresColoc($bd){
            try{
                $requete = $bd->prepare("SELECT * FROM offrecolocation WHERE statut=? ORDER BY dateAjout DESC");
                $requete->execute(["disponible"]);
                $resultatReq = $requete->fetchAll(PDO::FETCH_ASSOC);
                return $resultatReq;
            }
            catch(Exception $e){
                echo "Erreur : ".$e->getMessage();
                return [];
            } 
        }

        public function afficherOffresCovoi($bd){
            try{
                $requete = $bd->prepare("SELECT * FROM offrecovoiturage WHERE statut=? ORDER BY dateAjout DESC");
                $requete->execute(["disponible"]);
                $resultatReq = $requete->fetchAll(PDO::FETCH_ASSOC);
                return $resultatReq;
            }
            catch(Exception $e){
                echo "Erreur : ".$e->getMessage();
                return [];
            } 
        }

        public function afficherMesOffresColoc($bd){
            try {
                $requete = $bd->prepare("SELECT * FROM offrecolocation WHERE idAnnonceur = ?");
                $requete->execute([$_SESSION["idUtilisateur"]]);
                $resultatReq = $requete->fetchAll(PDO::FETCH_ASSOC);
                return $resultatReq;
            }catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                return [];
            }
        }


        public function afficherMesOffresCoVoi($bd)
        {
            try {
                $requete = $bd->prepare("SELECT * FROM offrecovoiturage WHERE idAnnonceur=?");
                $requete->execute([$_SESSION["idUtilisateur"]]);

                $resultatReq = $requete->fetchAll(PDO::FETCH_ASSOC);
                return $resultatReq;
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage();
                return [];
            }
        }

        public function modifierPhoto($photo, $idOffre, $champ, $table,  $bd){
            try{
                $requete = $bd->prepare("UPDATE $table SET $champ = ? WHERE idOffre = ?");
                $resultatReq = $requete->execute([$photo, $idOffre]);

                return $resultatReq;
            }catch(PDOException $e){
                error_log($e->getMessage());
                return false;
            }
        }

        public function modifierOffreColoc($descLogement, $nbrePieces, $adresseLogement, $typeLogement, $montant, $idOffre, $bd){
            $requete = $bd->prepare("UPDATE offrecolocation SET adresseLogement = ?, typeLogement = ?, descriptionLogement = ?, nbrePieces = ?, montantOffre = ? WHERE idOffre = ?");
            $resultatReq = $requete->execute([$adresseLogement, $typeLogement, $descLogement, $nbrePieces, $montant, $idOffre]);

            return $resultatReq;
        }

        public function modifierOffreCovoi($adresseDepart, $adresseArrive, $dateDepart, $marqueVehicule, $modeleVehicule, $nbrePlace, $descVehicule, $montantOffreCovoi, $idOffre, $bd){
            try{
                $requete = $bd->prepare("UPDATE offrecovoiturage SET destination = ?, depart = ?, marqueVoiture = ?, nbrePlaces = ?, modeleVoiture = ?, dateDepart = ?, descriptionOffre = ?, montantOffre = ? WHERE idOffre = ?");
                $resultatReq = $requete->execute([$adresseArrive, $adresseDepart, $marqueVehicule, $nbrePlace, $modeleVehicule, $dateDepart, $descVehicule, $montantOffreCovoi, $idOffre]);
                return $resultatReq;
            }catch(PDOException $e){
                error_log($e->getMessage());
                return false;
            }
        }
    

        public function supprimerOffreColoc($idOffre, $bd){
            try{
                $requete = $bd->prepare("DELETE FROM offrecolocation WHERE idOffre = ?");
                $resultatReq = $requete->execute([$idOffre]);
                return $resultatReq;
            }catch(PDOException $e){
                error_log($e->getMessage());
                return false;
            }
        }

        public function supprimerOffreCovoi($idOffre, $bd){
            try {
                $requete = $bd->prepare("DELETE FROM offrecovoiturage WHERE idOffre = ?");
                $resultatReq = $requete->execute([$idOffre]);
                return $resultatReq;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                return false;
            }
        }

    }
?>