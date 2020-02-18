<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && isset($_POST['idcomm']) && !empty($_POST['idcomm'])){
    $idaccepter = $_POST['idcomm'];
    $idpage = $_POST['idpage'];
    $sql = "UPDATE commentaires SET visible = 1 WHERE id = ?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($idaccepter));
    header('Location: ./temoignage-'.$idpage);
}else{
    header('Location: ./temoignages');
}
?>