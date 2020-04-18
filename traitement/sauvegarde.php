<?php
session_start();
if (isset($_SESSION['id']) && isset($_POST['idtemoignage'])){
    include ('../config/config.php');
    include('../config/bd.php');
    $monid=$_SESSION['id'];
    $idtemoignage=$_POST['idtemoignage'];

    //On vérifie si on aime déjà le témoignage

    $sql="SELECT * FROM sauvegarde WHERE idUtilisateur=? AND idTemoignage=?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($_SESSION['id'],$idtemoignage));
    $count=$query->rowCount();

    if($count == 0){
        //On ajoute le like
        $sqlajout = "INSERT INTO sauvegarde VALUES (NULL, ? , ?, NOW())";
        $queryajout = $pdo -> prepare($sqlajout);
        $queryajout->execute(array($monid,$idtemoignage));
        echo'Ne plus sauvegarder le témoignage';
    }else{
        //On retire le like
        $sqlsuppr = "DELETE FROM sauvegarde WHERE idUtilisateur=? AND idTemoignage=?";
        $querysuppr = $pdo -> prepare($sqlsuppr);
        $querysuppr->execute(array($monid,$idtemoignage));
        echo'Sauvegarder le témoignage';
    }

}




?>