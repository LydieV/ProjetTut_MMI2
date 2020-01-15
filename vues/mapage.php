<?php

if(isset($_SESSION['id'])){

?>
    <div class="monprofil">
        <div class='infosprofil'>
            <h2> <?php echo $_SESSION['identifiant'] ?> </h2>
            <div class="info">
                
                <?php
                    $sql="SELECT * FROM utilisateurs WHERE id=?";
                    $query = $pdo->prepare($sql);
                    $query->execute(array($_SESSION['id']));
                    $infoPsn = $query->fetch();
                ?>
                
                <p> <span class="titreinfo"> Email : </span> <?php echo $infoPsn['email'] ?> </p>
                <form method="POST" action="index.php?action=changeinfo">
                    <input type="submit" class="changementinfo" name="changeemail" value="Vous désirez changer d'adresse mail ?"/>
                </form>
            </div>

            <div class="info">
                <p> <span class="titreinfo"> Mot de passe : </span> ******* </p>
                <form method="POST" action="index.php?action=changeinfo">
                    <input type="submit" class="changementinfo" name="changemdp" value="Vous désirez changer de mot de passe ?"/>
                </form>
            </div>
            <div class="info">
                <p> <span class="titreinfo"> Date de naissance : </span> <?php echo $infoPsn['datenaissance'] ?> </p>
            </div>

            <form method="POST" action="index.php?action=supcompte">
                <input type="submit" name="supprimercompte" value="Supprimer mon compte" id="supcompte"/>
            </form>
        </div>

        <div class="activitesprofil">
            <div>
                <h3> Les témoignages que j'ai postés </h3>
                <div></div>
            </div>
            <div>
                <h3> Les témoignages que j'ai sauvegardé </h3>
                <div></div>
            </div>
            <div>
                <h3> Les commentaires que j'ai posté</h3>
                <div></div>
            </div>
        </div>

    </div>

<?php
} else{
    header("Location:index.php?action=erreur");
}

?>

