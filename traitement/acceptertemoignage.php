<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['categorie']) && !empty($_POST['categorie'])){
    $idaccepter = $_POST['id'];
    $categorie = $_POST['categorie'];
    $sql = "UPDATE ecrit SET visible = 1, categorie = ? WHERE id = ?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($categorie, $idaccepter));
    header('Location: index.php?action=temoignage&id='.$idaccepter);
}else{
    header('Location: index.php?action=temoignages');
}
?>