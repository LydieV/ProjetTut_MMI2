<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT *, DATE_FORMAT(dateEcrit, '%d/%m/%Y') AS dateEcritFormate FROM ecrit JOIN utilisateurs ON ecrit.idAuteur=utilisateurs.id WHERE ecrit.id=?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($id));
    $line=$query->fetch();

    if($line['visible'] == 0){
        header('Location:index.php?action=temoignages');
    }else{
        echo '<div class="contenutemoignage"><div class="banniere_mapage">';
            echo '<div class="couleur_banniere">';
                echo "<p> Témoigner, c'est une marque de courage </p>";
            echo '</div>';
        echo '</div>';
        echo '<div class="temoignageentier">';
            echo '<div class="titrefiltre">';
                echo $line['categorie'];
            echo '</div>';
            echo '<div class="infotemoignage">';
                echo '<p> Publié le '.$line['dateEcritFormate'].' par </p>';
                echo '<p> '.$line['identifiant'] . '</p>';
            echo '</div>';
            echo '<div class="temoignagecontenu">"' . $line['contenu'] . '"</div>';

            //On donne la possibilité de sauvegarder le témoignage si la pers est connextée
        if (isset($_SESSION['id'])){
            $sql="SELECT * FROM sauvegarde WHERE idUtilisateur=? AND idTemoignage=?";
            $query = $pdo -> prepare($sql);
            $query->execute(array($_SESSION['id'],$id));
            $count=$query->rowCount();

            if($count == 0){
                echo '<form method="POST" action="index.php?action=sauvegarde">';
                echo "<input type='hidden' name='id' value='$id'>";
                echo "<input type='submit' value='Sauvegarder le témoignage' class='boutonvalider'>";
                echo '</form>';
            }else{
                echo '<form method="POST" action="index.php?action=retirersauvegarde">';
                echo "<input type='hidden' name='id' value='$id'>";
                echo "<input type='submit' value='Ne plus sauvegarder le témoignage' class='boutonvalider'>";
                echo '</form>';
            }
        }
        ?>

        <div class="commentaire">
        <?php
            if (isset($_SESSION['id'])){
                echo '<form class="formnouvcom" action="index.php?action=nouveaucommentaire" method="POST">
                            <textarea type="text" placeholder="Laissez un commentaire juste ici..." class="postercom autoExpand" rows="1" data-min-rows="1" name="commentaire" /></textarea>
                            <input type="hidden" name="idTemoignage" value="'.$_GET['id'].'">
                            <input type="submit" id="submit" hidden><label for="submit"><i class="fas fa-paper-plane"></i></label>
                      </form>';
            }else{
                echo '<p>Vous devez posséder un compte pour pouvoir poster un commentaire.</p>';
            }

            echo '<div class="listecommentaires">';

            // On affiche les commentaires liés au post
            $sql="SELECT *, DATE_FORMAT(dateCommentaire, '%d/%m/%Y') AS dateCommentaireFormate FROM commentaires JOIN utilisateurs ON idAuteur=utilisateurs.id WHERE idTemoignage=? ORDER BY commentaires.id DESC";
            $query = $pdo -> prepare($sql);
            $query->execute(array($_GET['id']));
            $count=$query->rowCount();

            while($line=$query->fetch()){
                echo '<div class="uncommentaire">';
                echo '<div class="infocom">';
                echo '<p> Publié le '. $line['dateCommentaireFormate'] .' par</p>';
                echo '<p>'. $line['identifiant'] .'</p>';
                echo '</div>';
                echo '<p class="contenucom"> "'. $line['commentaire'] .'"</p>';
                echo '</div>';
            }

        ?></div>
        </div>

        <a href='index.php?action=temoignages' class='buttonretour2'> Retour vers Témoignages </a>
        </div></div>
    <?php
    }
}?>