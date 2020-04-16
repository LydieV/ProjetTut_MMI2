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

function ouvrirmodale(src){
    //$('#fenetremodale').fadeIn(500);
    document.getElementById('fenetremodale').style.display="flex";
    document.getElementById('imagemodale').src=src;
}
function fermerfenetre(val){
    $('#fenetremodale').fadeOut(500);
}

function ouvrirmenu(){
    let menu = document.getElementById("items");
    menu.style.height="100vh";
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

//Traitement ajax de l'affichage des pages
$(document).pjax('[data-pjax] a, a[data-pjax]', '#contenu');

//On attends le chargement de JQuery
$(function(){
    //Ajout du display block au premier item pour le carousel
    $('.item0').css('display', 'block');

    $('.afficherconnexion').click(function () {
        $('#forminscription').slideUp().hide();
        $('#formconnexion').slideDown().css('display', 'flex');
        $('.msgconn').hide();
        $('.msginsc').show();
        $('.msginfoinsc').hide();
    });

    $('.afficherinscription').click(function () {
        $('#formconnexion').slideUp().hide();
        $('#forminscription').slideDown();
        $('.msgconn').show();
        $('.msginsc').hide();
        $('.msginfoinsc').show();
    });





    //Lors de l'envoi du formulaire d'inscription
    $("#forminscription").submit(function(event){
        event.preventDefault();
        //document.getElementById('status').innerHTML = "Inscription en cours...";

        let formData = {
            'identifiant' : $('input[name=identifiant]').val(),
            'email' : $('input[name=email]').val(),
            'mdp' : $('input[name=mdp]').val(),
            'mdp2' : $('input[name=mdp2]').val(),
            'naissance' : $('select[name=naissance]').val(),
        };
        console.log(formData);

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
                $(location).attr('href',$('input[name=url]').val());
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

    /* Fonction permettant le filtrage par catégories */
    $(".filter-button").click(function(){
        $(".filter-button").removeClass('active');
        $(this).addClass("active");
        let choix = $(this).attr('data-filter');

        let formData={
            'choix': choix
        };
        $.post( "traitement/tritemoignages.php", formData, function(data) {
            $('#listeposts').html(data);
        });
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

$('.menumobile').click(function () {
    if(document.body.clientWidth < 768){
        fermermenu();
    }
});


//Fonction valider form contact
function validateForm() {

  document.getElementById('statuscontact').innerHTML = "Envoi en cours...";

    formData = {

        'email'    : $('input[name=emailcontact]').val(),

        'sujet'  : $('input[name=sujetcontact]').val(),

        'message'  : $('textarea[name=message]').val()

    };

    $.ajax({

        url : "traitement/mail.php",

        type: "POST",

        async : true,

        data : formData,

        success: function(data, textStatus, jqXHR)

        {

            $('#statuscontact').text(data.message);

            if (data.code) //Si le mail à bien été envoyé

                $('#contact-form').closest('form').find("input[type=text], textarea").val("");

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            document.getElementById('statuscontact').innerHTML = "L'envoi du mail a échoué !";
        }
    });
}

/* Taille auto des textarea pour les commentaires */
$(document).one('focus.autoExpand', 'textarea.autoExpand', function(){
    var savedValue = this.value;
    this.value = '';
    this.baseScrollHeight = this.scrollHeight;
    this.value = savedValue;
})
    .on('input.autoExpand', 'textarea.autoExpand', function(){
        var minRows = this.getAttribute('data-min-rows')|0, rows;
        this.rows = minRows;
        rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
        this.rows = minRows + rows;
    });


/*$('[data-pjax]').click(function (e) {
    e.preventDefault();
    /*if($(this).attr('href') != 'http://localhost/ProjetTut_MMI2/'+$(this).attr('href')){
        let root = 'http://localhost/ProjetTut_MMI2/';
        let lien = $(this).attr('href');
        $.get( root+lien, null, function(data) {
            $('#contenu').html(data);
            history.pushState({url : root+lien},'Affichage page '+lien, lien);
        });
    }
    let root = 'http://localhost/ProjetTut_MMI2/';
    let lien = $(this).attr('href');
    $.get( root+lien, null, function(data) {
        $('#contenu').html(data);
        history.pushState({url : root+lien},'Affichage page '+history.length, lien);
    });
});*/
/*window.onpopstate = function (e) {
    e.preventDefault();
    console.log(e);
    //console.log(e.originalEvent.state);
    if(e.state != null){
        let root = 'http://localhost/ProjetTut_MMI2/';
        let lien = e.state.url;
        $.get( lien, null, function(data) {
            $('#contenu').html(data);
            history.replaceState({url : lien},'Affichage page '+lien, lien);
        });
    }else{
        $.get( './accueil', '', function(data) {
            $('#contenu').html(data);
            history.replaceState({url : 'http://localhost/ProjetTut_MMI2/accueil'},'Affichage page accueil', 'accueil');
        });
    }
};*/


