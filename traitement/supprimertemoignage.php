<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && isset($_GET['id']) && !empty($_GET['id'])){
    $idaccepter=$_GET['id'];
    $sql = "DELETE FROM ecrit WHERE id = ?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($idaccepter));
    header('Location: index.php?action=temoignages');
}else{
    header('Location: index.php?action=temoignages');
}
?>