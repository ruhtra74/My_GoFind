document.getElementById("signup-form").addEventListener("submit", function(event) {
    /*  
        -Lorsqu'on soumet le formulaire, on regarde si on est dans la premiere partie ou dans la deuxieme
        -Si on est dans la premiere partie(Celle ou l'utilisateur entre ses informations) alors il n'y a pas encore de mot de passe, le if renvoit true et on masque les champs pour ses informations en affichant ceux pour le mot de passe(deuxieme partie)
        -Si on soumet et qu'il y'a le mot de passe, on verifie que les deux champs sont identiques et alors le formulaire est bien envoye
    */
    if (document.getElementById("motDePasse").value==""){
        document.getElementById("signup-form-1").style.display = "none";    //On masque
        document.getElementById("signup-form-2").style.display = "block";   //On affiche
        event.preventDefault();
    }else{
        if (document.getElementById("motDePasse").value != document.getElementById("confirmMotDePasse").value){
            alert("Les deux mots de passe ne sont pas identiques !😬");
            event.preventDefault();     //On ne soumet pas le formulaire
        }
    }
});

document.getElementById("signup-form").addEventListener("reset", function (event) {
    /*  
        - Lorsqu'on reinitialise le formulaire en cliquant sur Annuler, Si l'utilisateur est entrain de saisir son mot de passe, il est ramene a remplir ses informations
        - Si il etait encore en train de remplir ses informations, il est ramene a la page de bienvenu
    */
    if (document.getElementById("signup-form-2").style.display != "none" ){
        document.getElementById("signup-form-2").style.display = "none";    //On masque les champs le mot de passe
        document.getElementById("signup-form-1").style.display = "block";   //On affcihe les champs pour les informations
    }else{
        window.location.href = "../index.html";
    }
    
});