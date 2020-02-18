<?php
if (isset($_SESSION['id']) && isset($_POST['commentaire']) && !empty($_POST['commentaire']) && isset($_POST['idTemoignage'])){
    $idAuteur=$_SESSION['id'];
    $commentaire=htmlspecialchars(addslashes($_POST['commentaire']));
    $idTemoignage=$_POST['idTemoignage'];

    //On ajoute le commentaire dans la BDD
    include("../config/config.php");
    include("../config/bd.php");
    $sql="INSERT INTO commentaires VALUES (NULL, ? , ? , ? , NOW(), '0')";
    $query = $pdo->prepare($sql);
    $query->execute(array($commentaire,$idTemoignage,$idAuteur));
    header('Location: index.php?action=temoignage&id='.$_POST['idTemoignage']);
}else{
    if (isset($_POST['idTemoignage'])){
        header('Location: index.php?action=temoignage&id='.$_POST['idTemoignage']);
    }else{
        header('Location: index.php');
    }
}
?>