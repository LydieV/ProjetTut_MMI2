<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && isset($_POST['id']) && !empty($_POST['id'])){
    $idaccepter=$_POST['id'];
    $sql = "DELETE FROM ecrit WHERE id = ?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($idaccepter));
    header('Location: index.php?action=temoignages');
}else{
    header('Location: index.php?action=temoignages');
}
?>