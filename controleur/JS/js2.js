document.getElementById("pasEncore").addEventListener("click", function () {
    /*  
        Pour les fonctionnalites secondaires qui seront gerees plutard
    */
    alert("Cette fonctionnalite sera bientot disponible. 🙂");
});

document.getElementById("signup-form").addEventListener("reset", function (event) {
    /*  
        Lorsqu'on reinitialise le formulaire en cliquant sur Annuler, on est redirige vers la page de bienvenu.
    */
    window.location.href = "../index.html";
});