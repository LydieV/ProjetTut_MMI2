<?php

if (isset($_SESSION['id']) && isset($_POST['id'])){
    var_dump($_SESSION);
    $monid=$_SESSION['id'];
    $idtemoignage=$_POST['id'];

    $sql = "INSERT INTO sauvegarde VALUES (NULL, ? , ?, NOW())";
    $query = $pdo -> prepare($sql);
    $query->execute(array($monid,$idtemoignage));
    header('Location: index.php?action=temoignage&id='.$idtemoignage);
}




?>