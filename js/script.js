function ouvrirmodaleinscription(){
    $('#inscription').fadeIn(500);
}
function fermermodaleinscription(){
    $('#inscription').fadeOut(500);
}
function ouvrirmodaleconnexion(){
    $('#connexion').fadeIn(500);
}
function fermermodaleconnexion(){
    $('#connexion').fadeOut(500);
}

function idaleatoire() {
    let size = Math.random() * (10 - 4) + 4;
    let liste = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9"];
    let resultat = '';
    for (i = 0; i < size; i++) {
        resultat += liste[Math.floor(Math.random() * liste.length)];
    }
    $("#identifiant").val(resultat);
}

//On attends le chargement de JQuery
$(function(){
    //Lors de l'envoi du formulaire d'inscription
    $("#forminscription").submit(function(event){
        event.preventDefault();
        //document.getElementById('status').innerHTML = "Inscription en cours...";

        let formData = {
            'identifiant' : $('input[name=identifiant]').val(),
            'email' : $('input[name=email]').val(),
            'mdp' : $('input[name=mdp]').val(),
            'mdp2' : $('input[name=mdp2]').val(),
        };

        $.post( "./traitement/inscription.php", formData, function(data) {
            if (data != 'Succes'){
                $('#status').html(data);
            }else{
                $(location).attr('href',"index.php?");
            }
        });
    });

    //Lors de l'envoi du formulaire de connexion
    $("#formconnexion").submit(function(event){
        event.preventDefault();
        //document.getElementById('status').innerHTML = "Inscription en cours...";

        let formData = {
            'identifiant' : $('input[name=identifiantconnexion]').val(),
            'mdp' : $('input[name=mdpconnexion]').val(),
        };

        $.post( "./traitement/connexion.php", formData, function(data) {
            if (data != 'Succes'){
                $('#statusconnexion').html(data);
            }else{
                $(location).attr('href',"index.php?action=mapage");
            }
        });
    });
    return false;
});