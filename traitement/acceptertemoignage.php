<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['categorie']) && !empty($_POST['categorie'])){
    $idaccepter = $_POST['id'];
    $categorie = $_POST['categorie'];
    $titre = $_POST['titre'];
    $sql = "UPDATE ecrit SET visible = 1, categorie = ?, titre = ? WHERE id = ?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($categorie,$titre,$idaccepter));
    header('Location: index.php?action=temoignage&id='.$idaccepter);
}else{
    header('Location: index.php?action=temoignages');
}
?>