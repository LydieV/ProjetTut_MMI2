<?php

if (isset($_SESSION['id']) && isset($_POST['id'])){
    var_dump($_SESSION);
    $monid=$_SESSION['id'];
    $idtemoignage=$_POST['id'];

    $sql = "DELETE FROM sauvegarde WHERE idUtilisateur=? AND idTemoignage=?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($monid,$idtemoignage));
    header('Location: ./temoignage-'.$idtemoignage);
}




?>