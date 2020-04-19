<?php if(!isset ($_SESSION['id'])){
    header('Location: ./temoignages');
}?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/jquery.wysibb.min.js"></script>
<script src="js/wysibb.fr.js"></script>
<link rel="stylesheet" href="css/wbbtheme.css" />
<script>

    var $j=jQuery.noConflict();
    var wbbOpt = {
        buttons: "bold,italic,underline,justifyleft,justifycenter,justifyright,fontsize,quote",
        lang: "fr"
    }
    $j(function(){
        $j("#poster").wysibb(wbbOpt);
    })
</script>
<div class="contenuposter">
    <div class="bannieretemoignages">
        <div class="couleur_banniere textebannieretemoignages">
            <p> Cette page vous permet de partager ce que vous avez vécu.<br />
                Utilisez vos propres mots afin d'écrire votre témoignage.</p>
        </div>
    </div>
    <div class="descriptionposter">
        <p>Pour témoigner, vous n'avez pas besoin de vous retenir, ni même de vous efforcer.<br />
        Quelques lignes sont amplement suffisantes. Pour plus de sécurité, nous enverrons votre témoignage
        dans la rubrique correspondante après lecture.</p>
    </div>
    <div class="formposter">
        <form id="formtemoignage" method="POST">
            <textarea id="poster" name="temoignage" placeholder="Décrivez les faits dont vous avez été victime..."></textarea>
            <input class="bouton envoitemoignage" type="submit" value="Envoyer mon témoigage"></input>
        </form>
    </div>
    <a href="./temoignages" class="buttonretour2" data-pjax> Retour vers Témoignages </a>
</div>

<script>
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
</script>