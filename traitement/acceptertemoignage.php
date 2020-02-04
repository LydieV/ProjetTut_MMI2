<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && isset($_GET['id']) && !empty($_GET['id'])){
    $idaccepter=$_GET['id'];
    $sql = "UPDATE ecrit SET visible = 1 WHERE id = ?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($idaccepter));
    header('Location: index.php?action=temoignage&id='.$idaccepter);
}else{
    header('Location: index.php?action=temoignages');
}
?>