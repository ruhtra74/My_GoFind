boutonMenu = document.querySelectorAll('.menu span');
boutonMenu.forEach(item => {
    item.addEventListener('click', function () {
        masquerTout();
        // Retire la classe active de tous les menus
        boutonMenu.forEach(i => i.classList.remove('active'));
        // Ajoute la classe active à l'élément cliqué
        this.classList.add('active');
        document.getElementById("ombre").style = "display: block";
    });
});

// Sélectionne tous les boutons "Annuler"
annulerButtons = document.querySelectorAll('.btn-cancel');
// Sélectionne tous les formulaires à masquer (ayant la classe "card")
forms = document.querySelectorAll('.card');
annulerButtons.forEach(btn => {
    btn.addEventListener('click', function () {
        forms.forEach(form => {
            form.style.display = 'none';
            document.getElementById("ombre").click();
        });
    });
});



boutonMenu = document.querySelectorAll('.offer-buttons actionOffre');
boutonMenu.forEach(item => {
    item.addEventListener('click', function () {
        masquerTout();
        document.getElementById("ombre").style = "display: block";
    });
});

document.getElementById("monCompteButton").addEventListener("click", function(){        //Lorsqu'on clique sur le bouton Mon compte, 
    document.getElementById("volet-mon-compte").style = "display: block";               //On affiche le formulaire
    document.getElementById("titreMonCompte").setAttribute("class", "active");

});

//Fonction pour masquer tous les volets et les cartes qui sont affichés
function masquerTout() {
    document.querySelectorAll('.volet-droit').forEach(div => {
        div.style.display = "none";
    });
    document.querySelectorAll('.card').forEach(div => {
        div.style.display = "none";
    });
}



document.getElementById("modifierInfo").addEventListener("click", function(){
    document.getElementById("volet-mon-compte").style = "display: none";
    document.getElementById("formModifInfo").style = "display: flex";
    //On rempli le formulaire avec les informations de l'utilisateur
    document.getElementById("pseudo").value = sessionStorage.getItem("pseudo");
    document.getElementById("email").value = sessionStorage.getItem("mail");
    document.getElementById("phone").value = sessionStorage.getItem("tel");
}); 

document.getElementById("annulerModifInfo").addEventListener("click", function () {
    document.getElementById("formModifInfo").style = "display: none";
});


document.getElementById("volet-mon-compte-cacher").addEventListener("click", function () {
    document.getElementById("volet-mon-compte").style = "display: none";
    document.getElementById("ombre").click();
}); 

//Supprimer un compte

document.getElementById("supprimerCompte").addEventListener("click", function () {
    document.getElementById("volet-mon-compte").style = "display: none";
    document.getElementById("formSupprCompte").style = "display: flex";
});

document.getElementById("annulerSuppr").addEventListener("click", function () {
    document.getElementById("formSupprCompte").style = "display: none";
});

document.getElementById("proposerOffre").addEventListener("click", function(){
    document.getElementById("volet-proposer-offre").style = "display: flex";
    document.getElementById("titreProposerOffre").setAttribute("class", "active");
});
document.getElementById("volet-proposer-offre-cacher").addEventListener("click", function () {
    document.getElementById("volet-proposer-offre").style = "display: none";
    document.getElementById("ombre").click();
}); 

document.getElementById("offreCoLoc").addEventListener("click", function(){
    document.getElementById("volet-proposer-offre").style = "display: none";
    document.getElementById("formOffreColoc").style = "display: flex";
}); 
document.getElementById("annulerProposerColoc").addEventListener("click", function () {
    document.getElementById("formOffreColoc").style = "display: none";
    document.getElementById("photoLogement").innerHTML = 'Cliquer ici';
});

//Pour inserer les images de logement
document.getElementById("photoLogement").addEventListener("click", function() {
    document.getElementById("photoLogementInput").click();
});

document.getElementById("photoLogementInput").addEventListener("change", function(event) {
    file = event.target.files[0];
    if (!file) return;              // s'il n'y a pas de fichier, on sort de la fonction et on ne fait rien
    
    url = URL.createObjectURL(file);
    // On vide le contenu du cadre et on insère l'image
    document.getElementById("photoLogement").innerHTML = '';
    img = document.createElement('img');
    img.src = url;
    document.getElementById("photoLogement").appendChild(img);
}); 
/*-----------------------*/

document.getElementById("offreCoVoi").addEventListener("click", function () {
    document.getElementById("volet-proposer-offre").style = "display: none";
    document.getElementById("formOffreCoVoi").style = "display: flex";
}); 

//Pour inserer les images de vehicules
document.getElementById("photoVehicule").addEventListener("click", function () {
    document.getElementById("photoVehiculeInput").click();
});

document.getElementById("photoVehiculeInput").addEventListener("change", function (event) {
    file = event.target.files[0];
    if (!file) return;              // s'il n'y a pas de fichier, on sort de la fonction et on ne fait rien

    url = URL.createObjectURL(file);
    // On vide le contenu du cadre et on insère l'image
    document.getElementById("photoVehicule").innerHTML = '';
    img = document.createElement('img');
    img.src = url;
    document.getElementById("photoVehicule").appendChild(img);
}); 
/*------------------------------*/
document.getElementById("annulerProposerCoVoi").addEventListener("click", function () {
    document.getElementById("formOffreCoVoi").style = "display: none";
    document.getElementById("photoVehicule").innerHTML = 'Cliquer ici';
});


document.getElementById("repondreOffre").addEventListener("click", function () {
    document.getElementById("volet-repondre-offre").style = "display: flex";
    document.getElementById("titreRepondreOffre").setAttribute("class", "active");
    
});
document.getElementById("volet-repondre-offre-cacher").addEventListener("click", function () {
    document.getElementById("volet-repondre-offre").style = "display: none";
    document.getElementById("ombre").click();
});

document.getElementById("ombre").addEventListener("click", function () {
    document.getElementById("ombre").style = "display: none;"
    document.querySelectorAll('.volet-droit').forEach(div => {
        div.style.display = "none";
    });
    document.querySelectorAll('.active').forEach(div => {
        div.setAttribute("class", "");
    });
    document.getElementById("acceuil").click();
});

//lorsqu'on clique sur le bouton "Accueil" aucune ombre ne doit s'afficher
document.getElementById("acceuil").addEventListener("click", function () {
    window.location = "pageAccueil.php"
});

//afficher le formulaire de reponse a une offre
document.getElementById("repondreOffreCoLoc").addEventListener("click", function () {
    document.getElementById("volet-repondre-offre").style = "display: none";
    document.getElementById("formRepondreOffreColoc").style = "display: flex";
});
document.getElementById("annulerProposerColoc").addEventListener("click", function () {
    document.getElementById("formOffreColoc").style = "display: none";
    document.getElementById("photoLogement").innerHTML = 'Cliquer ici';
}); 

//lorsqu'on clique sur le bouton "Mes offres" dans le menu
document.getElementById("offre").addEventListener("click", function () {
    // Recharge la page avec un paramètre GET
    window.location.href = window.location.pathname + "?voirMesOffres=1";
});

// Vérifie si l'URL contient ?voirMesOffres=1
if (window.location.search.includes('voirMesOffres=1')) {
    // Retire la classe active de tous les boutons du menu
    document.querySelectorAll('.menu span').forEach(span => span.classList.remove('active'));
    // Ajoute la classe active uniquement au bouton "Mes Offres"
    document.getElementById('offre').classList.add('active');
}
