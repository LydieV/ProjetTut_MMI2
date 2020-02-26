<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT *, DATE_FORMAT(dateEcrit, '%d/%m/%Y') AS dateEcritFormate FROM ecrit JOIN utilisateurs ON ecrit.idAuteur=utilisateurs.id WHERE ecrit.id=?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($id));
    $line=$query->fetch();
    $titre = $line['titre'];

    if($line['visible'] == 0 && !isset($_SESSION['admin'])){
        header('Location:./temoignages');
    }else{
        echo '<div class="contenutemoignage"><div class="bannieretemoignages">';
            echo '<div class="couleur_banniere">';
                echo "<p> Témoigner, c'est une marque de courage.<br/> Nous sommes là pour partager et s'entraider, et non juger. </p>";
            echo '</div>';
        echo '</div>';
        echo '<div class="temoignageentier">';
        echo "<div class='titretemoignage'><h3>$titre</h3></div>";
            echo '<div class="categorietemoignage">';
            if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && $line['visible']==0){
                echo "<form method='POST' action='index.php?action=acceptertemoignage'><input name='id' value='$id' type='hidden'>";
                echo "<div class='datepublication'>
                            <select name='categorie'>
                             <option selected value='Scolaire'>Scolaire</option>
                             <option value='Professionnel'>Professionnel</option>
                             <option value='Cyber'>Cyberharcèlement</option>
                             <option value='Sexuel'>Sexuel</option>
                            </select></div></div>";
                echo '<input type="text" placeholder="titre" name="titre" required>';
                echo '<input type="submit" value="Accepter"></form>';

            }else{
                echo "<p> Catégorie : ". $line['categorie'] . "</p>";
                echo '</div>';
            }

            echo '<div class="infotemoignage">';
                echo '<p> Publié le '.$line['dateEcritFormate'].' par </p>';
                echo '<p> '.$line['identifiant'] . '</p>';
            echo '</div>';
            echo '<div class="temoignagecontenu">"' . stripslashes($line['contenu']) . '"</div>';

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
            $sql="SELECT *, DATE_FORMAT(dateCommentaire, '%d/%m/%Y') AS dateCommentaireFormate, commentaires.id AS idcomm FROM commentaires JOIN utilisateurs ON idAuteur=utilisateurs.id WHERE idTemoignage=? ORDER BY commentaires.id DESC";
            $query = $pdo -> prepare($sql);
            $query->execute(array($_GET['id']));
            $count=$query->rowCount();

            while($line=$query->fetch()){
                if($line['visible'] == 1){
                    echo '<div class="uncommentaire">';
                    echo '<div class="infocom">';
                    echo '<p> Publié le '. $line['dateCommentaireFormate'] .' par</p>';
                    echo '<p>'. $line['identifiant'] .'</p>';
                    echo '</div>';
                    echo '<p class="contenucom"> "'. stripslashes($line['commentaire']) .'"</p>';
                    if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && $line['visible']==1){
                        echo '<form method="POST" action="index.php?action=masquercommentaire">
                        <input type="hidden" name="idcomm" value="'.$line['idcomm'].'">
                        <input type="hidden" name="idpage" value="'.$_GET['id'].'">
                        <input type="submit" value="Masquer">
                        </form>';
                    }
                    echo '</div>';
                }else{
                    if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && $line['visible']==0){
                        echo '<div class="uncommentaire">';
                        echo '<div class="infocom">';
                        echo '<p> Publié le '. $line['dateCommentaireFormate'] .' par</p>';
                        echo '<p>'. $line['identifiant'] .'</p>';
                        echo '</div>';
                        echo '<p class="contenucom"> "'. stripslashes($line['commentaire']) .'"</p>';
                        echo '<form method="POST" action="index.php?action=acceptercommentaire">
                        <input type="hidden" name="idcomm" value="'.$line['idcomm'].'">
                        <input type="hidden" name="idpage" value="'.$_GET['id'].'">
                        <input type="submit" value="Accepter">
                        </form>';
                        echo '</div>';
                    }
                }
            }

        ?></div>
        </div>

        <a href='./temoignages' class='buttonretour2'> Retour vers Témoignages </a>
        </div></div>
    <?php
    }
}?>