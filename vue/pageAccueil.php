<?php
    session_start();
    //Si on a pas les informations sur l'utilisateur alors on le redirige vers la page d'accueil
    if (!isset($_SESSION["idUtilisateur"])) {
        header("location: ../index.html");
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accueil - GoFind</title>
    <link rel="stylesheet" href="CSS/stylesPageAccueil.css" />
    <link rel="stylesheet" href="CSS/styleFormInfo.css" />
</head>

<body>
    <div class="container">
        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <img src="image/logo.png" alt="logo GoFind" />
            </div>
            <nav class="menu">
                <span id="monCompteButton" class="monCompteButton">Mon Compte</span>
                <span id="offre">Mes Offres</span>
                <span id="proposerOffre">Proposer Offre</span>
                <span id="repondreOffre">Répondre À Une Offre</span>
                <span id="declarerObjet">Déclarer Objet</span>
                <span id="objet">Mes Objets</span>
                <span class="active" id="acceuil">Accueil</span>
            </nav>
            <div class="bottom-menu">
                <a href="../controleur/deconnexion.php">Se Déconnecter</a>
            </div>
            <!-- volet mon compte qui s'affiche lorsque l'utilisateur clique sur mon compte -->
            <div class="volet-mon-compte volet-droit" id="volet-mon-compte" style="display: none;">
                <div class="mon-compte-name">
                    <span id="volet-mon-compte-cacher" class="volet-mon-compte-cacher">⬅</span> <span id="titreMonCompte" class="texteMonCompte"> Compte</span>
                </div>
                <div class="mon-compte-option">
                    <span id="modifierInfo">✏ Modifier Mes Informations</span>
                    <span id="supprimerCompte">🚪 Supprimer Mon Compte</span>
                </div>
            </div>
            <!-- Volet qui s'affiche lorsque l'utilisateur clique sur proposer une offre -->
            <div class="volet-proposer-offre volet-droit" id="volet-proposer-offre" style="display: none;">
                <div class="proposer-offre-name">
                    <span id="volet-proposer-offre-cacher" class="volet-proposer-offre-cacher">⬅</span> <span id="titreProposerOffre" class=""> Proposer Une Offre</span>
                </div>
                <div class="proposer-offre-option">
                    <span id="offreCoLoc">Offre de co-location</span>
                    <span id="offreCoVoi">Offre de co-voiturage</span>
                </div>
            </div>
            <!-- Volet qui s'affiche lorsque l'utilisateur clique sur repondre a une offre une offre -->
            <div class="volet-repondre-offre volet-droit" id="volet-repondre-offre" style="display: none;">
                <div class="proposer-offre-name">
                    <span id="volet-repondre-offre-cacher" class="volet-repondre-offre-cacher">⬅</span> <span id="titreRepondreOffre" class=""> Repondre a une Offre</span>
                </div>
                <div class="repondre-offre-option">
                    <span id="repondreOffreCoLoc">Offre de co-location</span>
                    <span id="repondreOffreCoVoi">Offre de co-voiturage</span>
                </div>
            </div>
        </aside>

        <div id="ombre" class="ombre"></div>
        <main class="main-content">
            <div class="offreCherchee" id="offreCherchee" style="display: none;">

            </div>
            <h1>Trouver ce que vous voulez</h1>
            <div class="offers" id="offres">
                <?php include("listeOffres.php"); ?>
            </div>
            <!-- Formulaire de modifications des informations de l'utilisateur -->
            <div class="card" style="display: none;" id="formModifInfo">
                <section class="form-section">
                    <h2>Modifier Mes Informations</h2>
                    <form action="../controleur/modifierInfo.php" method="POST">
                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" id="pseudo" name="pseudo" required />
                        </div>
                        <div class="form-group">
                            <label for="phone">Numéro De Téléphone</label>
                            <input type="number" id="phone" name="tel" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Adresse Mail</label>
                            <input type="email" id="email" name="mail" required />
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-save" name="modifierInfo">Modifier</button>
                            <button type="reset" class="btn btn-cancel" id="annulerModifInfo">Annuler</button>
                        </div>
                    </form>
                </section>
                <aside class="info-section">
                    <div class="icon">ℹ️</div>
                    <p>Remplacez ces valeurs par de nouvelles et cliquez sur enregistrer pour modifier vos informations</p>
                </aside>
            </div>
            <!-- Formulaire de confirmation de suppression de compte -->
            <div class="card" style="display: none;" id="formSupprCompte">
                <section class="form-section">
                    <h2>Supprimer Mon Compte</h2>
                    <form action="../controleur/supprimerCompte.php" method="POST">
                        <div class="form-group">
                            <label for="email">Voulez-vous vraiment supprimer vôtre compte?</label>
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-save" name="supprCompte">Supprimer</button>
                            <button type="reset" class="btn btn-cancel" id="annulerSuppr">Annuler</button>
                        </div>
                    </form>
                </section>
                <aside class="info-section">
                    <div class="icon">ℹ️</div>
                    <p>Si vous confirmé, vous perdrez toutes les données que vous avez enregistré et vous ne pourrez plus acceder à cette application.</p>
                </aside>
            </div>
            <!-- Formulaire pour les offres de co-location -->
            <div class="card" style="display: none;" id="formOffreColoc">
                <section class="form-section">
                    <h2>Proposer une offre de Co-Location</h2>
                    <form action="../controleur/proposerOffre.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group2-line">
                            <label for="photoLogement">Photo du logement</label>
                            <div class="photo-offre-coloc" id="photoLogement">Cliquer ici</div>
                            <input type="file" name="photoLogement" id="photoLogementInput" accept="image/*" style="display:none" required />
                        </div>
                        <div class="form-group">
                            <label for="typeLogement">Type de logement</label>
                            <select id="typeLogement" name="typeLogement" required>
                                <option value="">--Choisir un type--</option>
                                <option value="Appartement">Appartement</option>
                                <option value="Studio">Studio</option>
                                <option value="Chambre">Chambre</option>
                                <option value="Maison">Maison</option>
                                <option value="Villa">Villa</option>
                                <option value="Duplex">Duplex</option>
                                <option value="Bungalow">Bungalow</option>
                                <option value="Loft">Loft</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="adresseLogement">Adresse du logement</label>
                            <input type="text" id="adresseLogement" name="adresseLogement" required />
                        </div>
                        <div class="form-group">
                            <label for="nbrePieces">Nombre de pieces</label>
                            <input type="number" id="nbrePieces" name="nbrePieces" required />
                        </div>
                        <div class="form-group">
                            <label for="montantOffreColoc">Montant souhaité</label>
                            <input type="number" id="montantOffreColoc" name="montantOffreColoc" required />
                        </div>
                        <div class="form-group">
                            <label for="descLogement">Description supplementaire</label>
                            <textarea id="descLogement" name="descLogement" required></textarea>
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-save" name="propOffreColoc">Enregistrer</button>
                            <button type="reset" class="btn btn-cancel" id="annulerProposerColoc">Annuler</button>
                        </div>
                    </form>
                </section>
                <aside class="info-section">
                    <div class="icon">ℹ️</div>
                    <p>Remplissez le formulaire ci-contre avec les informations concernant votre logement et elles seront visibles par tous nos utilsateurs</p>
                </aside>
            </div>
            <!-- Formulaire pour les offres de co-voiturage -->
            <div class="card" style="display: none;" id="formOffreCoVoi">
                <section class="form-section">
                    <h2>Proposer une offre de Co-Voiturage</h2>
                    <form action="../controleur/proposerOffre.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group2-line">
                            <label for="photoVehiculeInput">Photo du vehicule</label>
                            <div class="photo-offre-covoi" id="photoVehicule">Cliquer ici</div>
                            <input type="file" name="photoVehicule" id="photoVehiculeInput" accept="image/*" style="display:none" required />
                        </div>
                        <div class="form-group">
                            <label for="adresseDepart">Adresse depart</label>
                            <input type="text" id="adresseDepart" name="adresseDepart" required />
                        </div>
                        <div class="form-group">
                            <label for="adresseArrive">Adresse arrivé</label>
                            <input type="text" id="adresseArrive" name="adresseArrive" required />
                        </div>
                        <div class="form-group">
                            <label for="dateDepart">Date depart</label>
                            <input type="datetime-local" id="dateDepart" name="dateDepart" required />
                        </div>
                        <div class="form-group">
                            <label for="nbrePlace">Nombre de places disponibles</label>
                            <input type="number" id="nbrePlace" name="nbrePlace" required />
                        </div>
                        <div class="form-group">
                            <label for="montantOffreCovoi">Montant souhaité</label>
                            <input type="number" id="montantOffreCovoi" name="montantOffreCovoi" required />
                        </div>
                        <div class="form-group2-line">
                            <div>
                                <label for="marqueVehicule">Marque du vehicule</label>
                                <select name="marqueVehicule" id="marqueVehicule" name="marqueVehicule" class="marque-vehicule">
                                    <option value="">--Choisir une marque--</option>
                                    <option value="Acura">Acura</option>
                                    <option value="Alfa Romeo">Alfa Romeo</option>
                                    <option value="Audi">Audi</option>
                                    <option value="BMW">BMW</option>
                                    <option value="BYD">BYD</option>
                                    <option value="Cadillac">Cadillac</option>
                                    <option value="Changan">Changan</option>
                                    <option value="Chevrolet">Chevrolet</option>
                                    <option value="Chery">Chery</option>
                                    <option value="Citroën">Citroën</option>
                                    <option value="Dacia">Dacia</option>
                                    <option value="Dodge">Dodge</option>
                                    <option value="Dongfeng">Dongfeng</option>
                                    <option value="Ferrari">Ferrari</option>
                                    <option value="Fiat">Fiat</option>
                                    <option value="Ford">Ford</option>
                                    <option value="Geely">Geely</option>
                                    <option value="Great Wall">Great Wall</option>
                                    <option value="Honda">Honda</option>
                                    <option value="Hyundai">Hyundai</option>
                                    <option value="Isuzu">Isuzu</option>
                                    <option value="Jaguar">Jaguar</option>
                                    <option value="Jeep">Jeep</option>
                                    <option value="Kia">Kia</option>
                                    <option value="Land Rover">Land Rover</option>
                                    <option value="Lexus">Lexus</option>
                                    <option value="Mahindra">Mahindra</option>
                                    <option value="Mazda">Mazda</option>
                                    <option value="Mercedes-Benz">Mercedes-Benz</option>
                                    <option value="Mini">Mini</option>
                                    <option value="Mitsubishi">Mitsubishi</option>
                                    <option value="Nissan">Nissan</option>
                                    <option value="Opel">Opel</option>
                                    <option value="Peugeot">Peugeot</option>
                                    <option value="Porsche">Porsche</option>
                                    <option value="RAM">RAM</option>
                                    <option value="Renault">Renault</option>
                                    <option value="Rolls-Royce">Rolls-Royce</option>
                                    <option value="Skoda">Skoda</option>
                                    <option value="Subaru">Subaru</option>
                                    <option value="Suzuki">Suzuki</option>
                                    <option value="Tata">Tata</option>
                                    <option value="Tesla">Tesla</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Volkswagen">Volkswagen</option>
                                    <option value="Volvo">Volvo</option>
                                </select>
                            </div>
                            <div>
                                <label for="modeleVehicule">Modele du vehicule</label>
                                <input type="text" id="modeleVehicule" name="modeleVehicule" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descVehicule">Description supplementaire</label>
                            <textarea id="descVehicule" name="descVehicule" required></textarea>
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-save" name="propOffreCoVoi">Enregistrer</button>
                            <button type="reset" class="btn btn-cancel" id="annulerProposerCoVoi">Annuler</button>
                        </div>
                    </form>
                </section>
                <aside class="info-section">
                    <div class="icon">ℹ️</div>
                    <p>Remplissez le formulaire ci-contre avec les informations concernant votre trajet et il sera visible par tous nos utilisateurs</p>
                </aside>
            </div>
            <!-- Formulaire pour les modifications des offres de co-location -->
            <div class="card" style="display: none;" id="formModifOffreColoc">
                <section class="form-section">
                    <h2>Modifier Les Informations De Votre Offre</h2>
                    <form action="../controleur/modifierOffre.php" method="POST" enctype="multipart/form-data" id="formulaireModifOffreColoc">
                        <div class="form-group2-line">
                            <label for="photoLogementModif">Photo du logement</label>
                            <div class="photo-offre-coloc" id="photoLogementModif">Cliquer ici</div>
                            <input type="file" name="photoLogementModif" id="photoLogementInputModif" accept="image/*" style="display:none" />
                        </div>
                        <div class="form-group">
                            <label for="typeLogementModif">Type de logement</label>
                            <select id="typeLogementModif" name="typeLogementModif" required>
                                <option value="">--Choisir un type--</option>
                                <option value="Appartement">Appartement</option>
                                <option value="Studio">Studio</option>
                                <option value="Chambre">Chambre</option>
                                <option value="Maison">Maison</option>
                                <option value="Villa">Villa</option>
                                <option value="Duplex">Duplex</option>
                                <option value="Bungalow">Bungalow</option>
                                <option value="Loft">Loft</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="adresseLogementModif">Adresse du logement</label>
                            <input type="text" id="adresseLogementModif" name="adresseLogementModif" required />
                        </div>
                        <div class="form-group">
                            <label for="nbrePiecesModif">Nombre de pieces</label>
                            <input type="number" id="nbrePiecesModif" name="nbrePiecesModif" required />
                        </div>
                        <div class="form-group">
                            <label for="montantOffreColocModif">Montant souhaité</label>
                            <input type="number" id="montantOffreColocModif" name="montantOffreColocModif" required />
                        </div>
                        <div class="form-group">
                            <label for="descLogementModif">Description supplementaire</label>
                            <textarea id="descLogementModif" name="descLogementModif" required></textarea>
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-save" name="modifOffreColoc">Modifier</button>
                            <button type="reset" class="btn btn-cancel" id="annulerModifColoc">Annuler</button>
                        </div>
                    </form>
                </section>
                <aside class="info-section">
                    <div class="icon">ℹ️</div>
                    <p>Remplissez le formulaire ci-contre avec les informations concernant votre logement et elle sera mise à jour</p>
                </aside>
            </div>
            <!-- Formulaire pour les modifications des offres de co-voiturage -->
            <div class="card" style="display: none;" id="formModifOffreCoVoi">
                <section class="form-section">
                    <h2>Modifier Les Informations De Votre Offre</h2>
                    <form action="../controleur/modifierOffre.php" method="POST" enctype="multipart/form-data" id="formulaireModifOffreCovoi">
                        <div class="form-group2-line">
                            <label for="photoVehiculeInputModif">Photo du vehicule</label>
                            <div class="photo-offre-covoi" id="photoVehiculeModif">Cliquer ici</div>
                            <input type="file" name="photoVehiculeModif" id="photoVehiculeInputModif" accept="image/*" style="display:none" />
                        </div>
                        <div class="form-group">
                            <label for="adresseDepartModif">Adresse depart</label>
                            <input type="text" id="adresseDepartModif" name="adresseDepartModif" required />
                        </div>
                        <div class="form-group">
                            <label for="adresseArriveModif">Adresse arrivé</label>
                            <input type="text" id="adresseArriveModif" name="adresseArriveModif" required />
                        </div>
                        <div class="form-group">
                            <label for="dateDepartModif">Date depart</label>
                            <input type="datetime-local" id="dateDepartModif" name="dateDepartModif" required />
                        </div>
                        <div class="form-group">
                            <label for="nbrePlaceModif">Nombre de places disponibles</label>
                            <input type="number" id="nbrePlaceModif" name="nbrePlaceModif" required />
                        </div>
                        <div class="form-group">
                            <label for="montantOffreCovoiModif">Montant souhaité</label>
                            <input type="number" id="montantOffreCovoiModif" name="montantOffreCovoiModif" required />
                        </div>
                        <div class="form-group2-line">
                            <div>
                                <label for="marqueVehiculeModif">Marque du vehicule</label>
                                <select id="marqueVehiculeModif" name="marqueVehiculeModif" class="marque-vehicule">
                                    <option value="">--Choisir une marque--</option>
                                    <option value="Acura">Acura</option>
                                    <option value="Alfa Romeo">Alfa Romeo</option>
                                    <option value="Audi">Audi</option>
                                    <option value="BMW">BMW</option>
                                    <option value="BYD">BYD</option>
                                    <option value="Cadillac">Cadillac</option>
                                    <option value="Changan">Changan</option>
                                    <option value="Chevrolet">Chevrolet</option>
                                    <option value="Chery">Chery</option>
                                    <option value="Citroën">Citroën</option>
                                    <option value="Dacia">Dacia</option>
                                    <option value="Dodge">Dodge</option>
                                    <option value="Dongfeng">Dongfeng</option>
                                    <option value="Ferrari">Ferrari</option>
                                    <option value="Fiat">Fiat</option>
                                    <option value="Ford">Ford</option>
                                    <option value="Geely">Geely</option>
                                    <option value="Great Wall">Great Wall</option>
                                    <option value="Honda">Honda</option>
                                    <option value="Hyundai">Hyundai</option>
                                    <option value="Isuzu">Isuzu</option>
                                    <option value="Jaguar">Jaguar</option>
                                    <option value="Jeep">Jeep</option>
                                    <option value="Kia">Kia</option>
                                    <option value="Land Rover">Land Rover</option>
                                    <option value="Lexus">Lexus</option>
                                    <option value="Mahindra">Mahindra</option>
                                    <option value="Mazda">Mazda</option>
                                    <option value="Mercedes-Benz">Mercedes-Benz</option>
                                    <option value="Mini">Mini</option>
                                    <option value="Mitsubishi">Mitsubishi</option>
                                    <option value="Nissan">Nissan</option>
                                    <option value="Opel">Opel</option>
                                    <option value="Peugeot">Peugeot</option>
                                    <option value="Porsche">Porsche</option>
                                    <option value="RAM">RAM</option>
                                    <option value="Renault">Renault</option>
                                    <option value="Rolls-Royce">Rolls-Royce</option>
                                    <option value="Skoda">Skoda</option>
                                    <option value="Subaru">Subaru</option>
                                    <option value="Suzuki">Suzuki</option>
                                    <option value="Tata">Tata</option>
                                    <option value="Tesla">Tesla</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Volkswagen">Volkswagen</option>
                                    <option value="Volvo">Volvo</option>
                                </select>
                            </div>
                            <div>
                                <label for="modeleVehiculeModif">Modele du vehicule</label>
                                <input type="text" id="modeleVehiculeModif" name="modeleVehiculeModif" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descVehiculeModif">Description supplementaire</label>
                            <textarea id="descVehiculeModif" name="descVehiculeModif" required></textarea>
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-save" name="modifOffreCoVoi">Enregistrer</button>
                            <button type="reset" class="btn btn-cancel" id="annulerModifCoVoi">Annuler</button>
                        </div>
                    </form>
                </section>
                <aside class="info-section">
                    <div class="icon">ℹ️</div>
                    <p>Remplissez le formulaire ci-contre avec les nouvelles informations concernant votre trajet.</p>
                </aside>
            </div>
            <!-- Formulaire de confirmation de suppression d'offre de co-location -->
            <div class="card" style="display: none;" id="formSupprOffreColoc">
                <section class="form-section">
                    <h2>Supprimer Votre Offre</h2>
                    <form action="../controleur/supprimerOffre.php" method="POST" id="formulaireSupprOffreColoc">
                        <div class="form-group">
                            <label for="email">Voulez-vous vraiment supprimer cette offre?</label>
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-save" name="supprOffreColoc">Supprimer</button>
                            <button type="reset" class="btn btn-cancel" id="annulerSupprOffreColoc">Annuler</button>
                        </div>
                    </form>
                </section>
                <aside class="info-section">
                    <div class="icon">ℹ️</div>
                    <p>Si vous confirmé, l'offre sera bel et bien supprimée et ne sera plus visible par les utilisateurs de l'application.</p>
                </aside>
            </div>
            <!-- Formulaire de confirmation de suppression d'offre de co-voiturage -->
            <div class="card" style="display: none;" id="formSupprOffreCovoi">
                <section class="form-section">
                    <h2>Supprimer Votre Offre</h2>
                    <form action="../controleur/supprimerOffre.php" method="POST" id="formulaireSupprOffreCovoi">
                        <div class="form-group">
                            <label for="email">Voulez-vous vraiment supprimer cette offre?</label>
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-save" name="supprOffreCovoi">Supprimer</button>
                            <button type="reset" class="btn btn-cancel" id="annulerSupprOffreCovoi">Annuler</button>
                        </div>
                    </form>
                </section>
                <aside class="info-section">
                    <div class="icon">ℹ️</div>
                    <p>Si vous confirmé, l'offre sera bel et bien supprimée et ne sera plus visible par les utilisateurs de l'application.</p>
                </aside>
            </div>
        </main>
    </div>
</body>
<script src="../controleur/JS/js3.js"></script>

<script src="../controleur/JS/js3-2.js"></script>

</html>