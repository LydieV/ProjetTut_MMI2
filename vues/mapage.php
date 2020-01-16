<?php

if(isset($_SESSION['id'])){

?>
    <div class="monprofil">
        <div class='infosprofil'> <?php
            $sql="SELECT * FROM utilisateurs WHERE id=?";
            $query = $pdo->prepare($sql);
            $query->execute(array($_SESSION['id']));
            $infoPsn = $query->fetch();
            ?>

            <h2> <?php echo $infoPsn['identifiant'] ?> </h2>
            <form method="POST" action="index.php?action=changeinfo">
                <input type="hidden" name="changepseudo"/>
                <input type="submit" class="changementinfo" id="changepseudo" name="modif" value=""/>
            </form>

            <div class="info">

                
                <p> <span class="titreinfo"> Email : </span> <?php echo $infoPsn['email'] ?> </p>
                <form method="POST" action="index.php?action=changeinfo">
                    <input type="hidden" name="changeemail"/>
                    <input type="submit" class="changementinfo" name="modif" value="Vous désirez changer d'adresse mail ?"/>
                </form>
            </div>

            <div class="info">
                <p> <span class="titreinfo"> Mot de passe : </span> ******* </p>
                <form method="POST" action="index.php?action=changeinfo">
                    <input type="hidden" name="changemdp"/>
                    <input type="submit" class="changementinfo" name="modif" value="Vous désirez changer de mot de passe ?"/>
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