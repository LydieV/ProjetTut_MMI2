<?php

if(isset($_POST['changeemail'])){
    ?>
        <form method="POST" action="#">
            <input type="email" name="email"/>
            <input type="email" name="emailverif"/>
            <input type="submit" value="Changer adresse email"/>
        </form>
    <?php
    
} 
if(isset($_POST['changemdp'])){
    ?>
        <form method="POST" action="#">
            <input type="password" name="pwd"/>
            <input type="password" name="pwdverif"/>
            <input type="submit" value="Changer mot de passe"/>
        </form>


    <?php
} 

if(isset($_POST['email']) && isset($_POST['emailverif']) && $_POST['email'] != null && $_POST['emailverif'] != null){
    if($_POST['email'] == $_POST['emailverif']){
        $sql = "UPDATE utilisateurs SET email=? WHERE id=?";
        $query = $pdo->prepare($sql);
        $query->execute($_POST['email'],array($_SESSION['id']));
        $result = $query->fetch();
        header("Location:index.php?action=mapage");
    } else{
        echo "pas pareil";
    }
        
}


?>