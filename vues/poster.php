<?php if(!isset ($_SESSION['id'])){
    header('Location: ./temoignages');
}?>

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
            <textarea name="temoignage" placeholder="Décrivez les faits dont vous avez été victime..."></textarea>
            <input class="bouton envoitemoignage" type="submit" value="Envoyer mon témoigage"></input>
        </form>
    </div>
    <a href="./temoignages" class="buttonretour2"> Retour vers Témoignages </a>
</div>