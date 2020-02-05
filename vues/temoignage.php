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
        echo '<div class="banniere_mapage">';
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

            //On donne la possibilité de sauvegarder le témoignage
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

            echo '<div class="commentaire">';
                    echo '<form class="formnouvcom">';
                        echo '<input type="text" placeholder="Laissez un commentaire juste ici..." class="postercom"/>';
                    echo '</form>';
                    echo '<div class="listecommentaires">';
                        echo '<div class="uncommentaire">';
                            echo '<div class="infocom">';
                                echo '<p> Publié le 05/02/2020 par </p>';
                                echo '<p> Emilie Durant </p>';
                            echo '</div>';
                            echo '<p class="contenucom"> " Contenu du commentaire " </p>';
                        echo '</div>';
                    echo '</div>';
            echo '</div>';

            echo "<a href='index.php?action=temoignages' class='buttonretour2'> Retour vers Témoignages </a>";
        echo '</div>';
    }
}





?>