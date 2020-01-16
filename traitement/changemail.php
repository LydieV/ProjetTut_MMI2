<?php

if(isset($_POST['email']) && isset($_POST['emailverif']) && $_POST['email'] != null && $_POST['emailverif'] != null){
    if($_POST['email'] == $_POST['emailverif']){
        $sql = "UPDATE utilisateurs SET email=? WHERE id=?";
        $query = $pdo->prepare($sql);
        $query->execute(array($_POST['email'], $_SESSION['id']));
        header("Location:index.php?action=mapage");
    } else{
        echo 'Adresse pas pareil';
    }
}

if($_POST['email'] == null || $_POST['emailverif'] == null) {
    ?>
    <form method="POST" action="#">
        <input type="email" name="email"/>
        <input type="email" name="emailverif"/>
        <input type="hidden" value="<?php echo $_POST['changeemail'] ?>" name="changeemail"/>
        <input type="submit" value="Changer adresse email"/>
    </form>
    <?php
}

if(!isset($_POST['email']) && !isset($_POST['emailverif'])){
    header("Location:index.php?action=mapage");
}

?>