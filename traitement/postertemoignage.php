<?php

if (isset($_POST['temoignage']) && !empty($_POST['temoignage'])){
    session_start();
    $monid=$_SESSION['id'];
    $temoignage = htmlspecialchars(addslashes($_POST['temoignage']));

    //On insère le témoignage dans la bdd...
    include("../config/config.php");
    include("../config/bd.php");

    $sql = "INSERT INTO ecrit VALUES (NULL,?,NOW(),?,NULL,0,NULL)";
    $query = $pdo->prepare($sql);
    $query->execute(array($temoignage,$monid));
    echo 'Succes';
    //header('Location: index.php?action=temoignages');
}else{
    echo 'Erreur';
}




?>