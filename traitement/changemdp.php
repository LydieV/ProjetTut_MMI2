<?php

if(isset($_POST['pwd']) && isset($_POST['pwdverif']) && $_POST['pwd'] != null && $_POST['pwdverif'] != null){
    if($_POST['pwd'] == $_POST['pwdverif']){
        $mdp = $_POST['pwd'];
        $crypte = MD5('$mdp');
        $sql = "UPDATE utilisateurs SET mdp=? WHERE id=?";
        $query = $pdo->prepare($sql);
        $query->execute(array($crypte, $_SESSION['id']));
        header("Location:index.php?action=mapage");
    } else{
        echo 'Mdp pas pareil';
    }
}

if($_POST['pwd'] == null || $_POST['pwdverif'] == null){
    ?>
    <form method="POST" action="index.php?action=changemdp">
        <input type="password" name="pwd"/>
        <input type="password" name="pwdverif"/>
        <input type="submit" value="Changer mot de passe"/>
    </form>

    <?php
}

if(!isset($_POST['pwd']) && !isset($_POST['pwdverif'])){
    header("Location:index.php?action=mapage");
}

?>