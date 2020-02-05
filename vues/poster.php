<?php if(!isset ($_SESSION['id'])){
    header('Location: index.php?action=temoignages');
}?>

<div class="contenuposter">
    <div class="bannieretemoignages">
        <div class="couleur_banniere textebannieretemoignages">
            <p> Cette page vous permet de partager les complications rencontrées au cours de votre vie. En témoignant, vous participerez non seulement à une meilleure compréhension de
            la définition du mot "harcèlement".<br />
            Qui plus est, votre témoignage peut également aider une personne à identifier le cas de harcèlement dont celle-ci fait face et l'aider à agir en conséquence.</p>
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
</div>