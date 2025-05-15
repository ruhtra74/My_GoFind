function modifierOffreColoc(id){
    //Lorsqu'on clique sur le bouton modifier, on recupere d'abord l'index de l'offre choisi dans le tableau offresColoc
    index = getIndexById(offresColoc, Number(id));
    //Puis on rempli le formulaire
    document.getElementById("montantOffreColocModif").value = offresColoc[index].montantOffre;
    document.getElementById("nbrePiecesModif").value = offresColoc[index].nbrePieces;
    document.getElementById("adresseLogementModif").value = offresColoc[index].adresseLogement;
    document.getElementById("typeLogementModif").value = offresColoc[index].typeLogement;
    document.getElementById("descLogementModif").value = offresColoc[index].descriptionLogement;
    mettreImage(offresColoc[index].photoLogement, "photoLogementModif");

    //On precise l'url de l'action du formulaire qui contient l'id de l'offre a modifier
    document.getElementById("formulaireModifOffreColoc").action = "../controleur/modifierOffre.php?idOffre=" + id;
    //On affiche ce dernier
    document.getElementById("formModifOffreColoc").style = "display: flex";
}

//Pour mettre l'image qui vient de la bd dans le div
function mettreImage (chemin, eltAModifier){
    if (!chemin) return;              // s'il n'y a pas de fichier, on sort de la fonction et on ne fait rien

    document.getElementById(eltAModifier).innerHTML = '';
    img = document.createElement('img');
    img.src = chemin;
    document.getElementById(eltAModifier).appendChild(img);
}
//lorsqu'on clique sur le div, on ouvre l'explorateur de fichiers
document.getElementById("photoLogementModif").addEventListener("click", function () {
    document.getElementById("photoLogementInputModif").click();
});
//Si on choisit une autre image
document.getElementById("photoLogementInputModif").addEventListener("change", function (event) {
    file = event.target.files[0];
    if (!file) return;              // s'il n'y a pas de fichier, on sort de la fonction et on ne fait rien

    url = URL.createObjectURL(file);
    // On vide le contenu du cadre et on insère l'image
    document.getElementById("photoLogementModif").innerHTML = '';
    img = document.createElement('img');
    img.src = url;
    document.getElementById("photoLogementModif").appendChild(img);
}); 



function getIndexById(tableau, idRecherche) {
    return tableau.findIndex(o => Number(o.idOffre) === idRecherche);
}



/*
la meme chose pour les offres de covoiturage
*/

function modifierOffreCovoi(id){
    //Lorsqu'on clique sur le bouton modifier, on recupere d'abord l'index de l'offre choisi dans le tableau offresColoc
    index = getIndexById(offresCovoi, Number(id));
    //Puis on rempli le formulaire
    document.getElementById("descVehiculeModif").value = offresCovoi[index].descriptionOffre;
    document.getElementById("modeleVehiculeModif").value = offresCovoi[index].modeleVoiture;
    document.getElementById("marqueVehiculeModif").value = offresCovoi[index].marqueVoiture;
    document.getElementById("montantOffreCovoiModif").value = offresCovoi[index].montantOffre;
    document.getElementById("nbrePlaceModif").value = offresCovoi[index].nbrePlaces; 
    document.getElementById("dateDepartModif").value = offresCovoi[index].dateDepart;
    document.getElementById("adresseArriveModif").value = offresCovoi[index].destination;
    document.getElementById("adresseDepartModif").value = offresCovoi[index].depart;

    mettreImage(offresCovoi[index].photoVoiture, "photoVehiculeModif");

    //On precise l'url de l'action du formulaire qui contient l'id de l'offre a modifier
    document.getElementById("formulaireModifOffreCovoi").action = "../controleur/modifierOffre.php?idOffre=" + id;
    //On affiche ce dernier
    document.getElementById("formModifOffreCoVoi").style = "display: flex";
}
//lorsqu'on clique sur le div, on ouvre l'explorateur
document.getElementById("photoVehiculeModif").addEventListener("click", function () {
    document.getElementById("photoVehiculeInputModif").click();
});
//Si on choisit une autre image
document.getElementById("photoVehiculeInputModif").addEventListener("change", function (event) {
    file = event.target.files[0];
    if (!file) return;              // s'il n'y a pas de fichier, on sort de la fonction et on ne fait rien

    url = URL.createObjectURL(file);
    // On vide le contenu du cadre et on insère l'image
    document.getElementById("photoVehiculeModif").innerHTML = '';
    img = document.createElement('img');
    img.src = url;
    document.getElementById("photoVehiculeModif").appendChild(img);
});

/*
Pour supprimer une offre
*/

function supprimerOffreColoc(id){
    //On precise l'url de l'action du formulaire qui contient l'id de l'offre a supprimer
    document.getElementById("formulaireSupprOffreColoc").action = "../controleur/supprimerOffre.php?idOffre=" + id;
    //On affiche ce dernier
    document.getElementById("formSupprOffreColoc").style = "display: flex";
}

function supprimerOffreCovoi(id) {
    //On precise l'url de l'action du formulaire qui contient l'id de l'offre a supprimer
    document.getElementById("formulaireSupprOffreCovoi").action = "../controleur/supprimerOffre.php?idOffre=" + id;
    //On affiche ce dernier
    document.getElementById("formSupprOffreCovoi").style = "display: flex";
}