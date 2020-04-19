<?php
session_start();

if(isset($_POST['idtemoignage'])){
    include ('../config/config.php');
    include('../config/bd.php');
    $id=$_POST['idtemoignage'];

    $sql="SELECT *, DATE_FORMAT(dateEcrit, '%d/%m/%Y') AS dateEcritFormate FROM ecrit JOIN utilisateurs ON ecrit.idAuteur=utilisateurs.id WHERE ecrit.id=?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($id));
    $line=$query->fetch();
    $contenu = $line['contenu'];
    /*echo '<form id="formmodiftemoignage" method="POST">
            <textarea id="area" name="majtemoignage" placeholder="Décrivez les faits dont vous avez été victime..." data-idtemoignage="'.$id.'">'.stripslashes($contenu).'</textarea>
            <input class="bouton envoitemoignage" type="submit" value="Modifier le témoignage"></input>
        </form>';*/

    echo stripslashes($contenu);
}


?>
