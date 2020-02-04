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

function ouvrirmenu(){
    let menu = document.getElementById("items");
    menu.style.height="-webkit-fill-available";
    let iconemenuo = document.getElementById("iconemenueo");
    iconemenuo.style.display="none";
    let iconemenuc = document.getElementById("iconemenuec");
    iconemenuc.style.display="block";
}

function fermermenu(){
    let menu = document.getElementById("items");
    menu.style.height="0";
    let iconemenuo = document.getElementById("iconemenueo");
    iconemenuo.style.display="block";
    let iconemenuc = document.getElementById("iconemenuec");
    iconemenuc.style.display="none";
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

    //Lors de l'envoi d'un témoignage
    $("#formtemoignage").submit(function(event){
        event.preventDefault();

        let formData = {
            'temoignage' : $('textarea[name=temoignage]').val(),
        };
        console.log(formData);

        $.post( "./traitement/postertemoignage.php", formData, function(data) {
            if (data != 'Succes'){
                //$('#statusconnexion').html(data);
            }else{
                $(location).attr('href',"index.php?action=temoignages");
            }
        });
    });

    /* Fonction permettant le filtrage par catÃ©gories */
    $(".filter-button").click(function(){
        $(".filter-button").removeClass('active');
        $(this).addClass("active");
        let value = $(this).attr('data-filter');

        if(value == "tous"){
            $('.filter').show('1000');
        }
        else{
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
        }
    });

    return false;
});


// Fonction page contact, effet
function glissement(a){
    if(document.body.clientWidth > 500){
        if(a == "email"){
            document.getElementById("label1").style.marginTop = "-20px";
        }
        if(a == "sujet"){
            document.getElementById("label2").style.marginTop = "60px";
        }
    }
}


//Fonction valider form contact
function validateForm() {

  document.getElementById('status').innerHTML = "Envoi en cours...";

    formData = {

        'email'    : $('input[name=email]').val(),

        'subject'  : $('input[name=sujet]').val(),

        'message'  : $('textarea[name=message]').val()

    };

    $.ajax({

        url : "traitement/mail.php",

        type: "POST",

        async : true,

        data : formData,

        success: function(data, textStatus, jqXHR)

        {

            $('#status').text(data.message);

            if (data.code) //Si le mail à bien été envoyé

                $('#contact-form').closest('form').find("input[type=text], textarea").val("");

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            document.getElementById('status').innerHTML = "L'envoi du mail a échoué !";
        }
    });
}

