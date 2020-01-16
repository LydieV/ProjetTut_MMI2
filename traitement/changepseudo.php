<?php

if(isset($_POST['pseudo']) && isset($_POST['pseudoverif']) && $_POST['pseudo'] != null && $_POST['pseudoverif'] != null){
    if($_POST['pseudo'] == $_POST['pseudoverif']){
        $sql = "UPDATE utilisateurs SET identifiant=? WHERE id=?";
        $query = $pdo->prepare($sql);
        $query->execute(array($_POST['pseudo'], $_SESSION['id']));
        header("Location:index.php?action=mapage");
    } else{
        echo 'Pseudo pas pareil';
    }
}

if($_POST['pseudo'] == null || $_POST['pseudoverif'] == null) {
    ?>
    <form method="POST" action="#">
        <input type="text" name="pseudo"/>
        <input type="text" name="pseudoverif"/>
        <input type="submit" value="Changer pseudo"/>
    </form>
    <?php
}

if(!isset($_POST['pseudo']) && !isset($_POST['pseudoverif'])){
    header("Location:index.php?action=mapage");
}

?>