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
        echo $line['categorie'];
        echo '<br />';
        echo 'Publié le '.$line['dateEcritFormate'].' par '.$line['identifiant'];
        echo '<br />';
        echo $line['contenu'];

        //On donne la possibilité de sauvegarder le témoignage
        $sql="SELECT * FROM sauvegarde WHERE idUtilisateur=? AND idTemoignage=?";
        $query = $pdo -> prepare($sql);
        $query->execute(array($_SESSION['id'],$id));
        $count=$query->rowCount();

        if($count == 0){
            echo '<form method="POST" action="index.php?action=sauvegarde">';
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='submit' value='Sauvegarder'>";
            echo '</form>';
        }else{
            echo '<form method="POST" action="index.php?action=retirersauvegarde">';
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='submit' value='Ne plus sauvegarder'>";
            echo '</form>';
        }


    }
}





?>