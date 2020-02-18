<?php

if(isset($_SESSION['id'])){

?>
    <div class="contenumapage">
        <div class="banniere_mapage">
            <div class="couleur_banniere">
                <p> Bienvenue sur votre page personnelle. </p>
            </div>
        </div>

        <div class="monprofil">
            <div class='infosprofil'>

                <?php
                $sql="SELECT * FROM utilisateurs WHERE id=?";
                $query = $pdo->prepare($sql);
                $query->execute(array($_SESSION['id']));
                $infoPsn = $query->fetch();
                ?>

                <h2 class="ident"> <?php echo $infoPsn['identifiant'] ?> </h2>

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
                <div class="section_activite">
                    <h3 class="titre1"> Les témoignages que j'ai postés </h3>
                    <div class="carousel_activites">
                        <?php
                        $sql = "SELECT * FROM ecrit WHERE idAuteur=?";
                        $query = $pdo -> prepare($sql);
                        $query->execute(array($_SESSION['id']));
                        while($line=$query->fetch()){
                            $contenu=substr($line['contenu'], 0, 25). ' ...';
                            echo '<a href="./temoignage-'.$line['id'].'">';
                                echo '<div class="apercutemoignage">';
                                    echo '<p>"'.$contenu   .'"</p>';
                                echo '</div>';
                            echo '</a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="section_activite">
                    <h3 class="titre2"> Les témoignages que j'ai sauvegardés </h3>
                    <div class="carousel_activites">
                        <?php
                        $sql = "SELECT *, ecrit.id AS idecrit FROM ecrit JOIN sauvegarde ON idUtilisateur=? WHERE sauvegarde.idUtilisateur=? AND sauvegarde.idTemoignage=ecrit.id";
                        $query = $pdo -> prepare($sql);
                        $query->execute(array($_SESSION['id'],$_SESSION['id']));
                        while($line=$query->fetch()){
                            $contenu=substr($line['contenu'], 0, 25). ' ...';
                            echo '<a href="./temoignage-'.$line['idecrit'].'"><div class="apercutemoignage"><p>"'.$contenu   .'"</p></div></a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="section_activite">
                    <h3 class="titre3"> Les commentaires que j'ai postés </h3>
                    <div class="commentairemapage">
                        <?php
                        $sql = "SELECT * FROM commentaires WHERE idAuteur=? LIMIT 5";
                        $query = $pdo -> prepare($sql);
                        $query->execute(array($_SESSION['id']));
                        while($line=$query->fetch()){
                            $contenu=substr($line['commentaire'], 0, 25). ' ...';
                            echo '<a href="./temoignage-'.$line['idTemoignage'].'"><p>"'.$contenu.'"</p></a>';
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php
} else{
    header("Location:index.php?action=erreur");
}

?>
