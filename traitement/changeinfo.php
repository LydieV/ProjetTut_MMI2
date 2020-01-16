<?php

if(isset($_POST['modif'])){
    if(isset($_POST['changepseudo'])){
        ?>
        <form method="POST" action="index.php?action=changepseudo">
            <input type="text" name="pseudo"/>
            <input type="text" name="pseudoverif"/>
            <input type="submit" value="Changer pseudo"/>
        </form>
        <?php
    }

    if(isset($_POST['changeemail'])){
        ?>
        <form method="POST" action="index.php?action=changemail">
            <input type="email" name="email"/>
            <input type="email" name="emailverif"/>
            <input type="submit" value="Changer adresse email"/>
        </form>
        <?php
    }

    if(isset($_POST['changemdp'])){
        ?>
        <form method="POST" action="index.php?action=changemdp">
            <input type="password" name="pwd"/>
            <input type="password" name="pwdverif"/>
            <input type="submit" value="Changer mot de passe"/>
        </form>

        <?php
    }

    if(!isset($_POST['changeemail']) && !isset($_POST['changemdp']) && !isset($_POST['changepseudo'])){
        header("Location: index.php?action=mapage");
    }
} else{
    header("Location: index.php?action=mapage");
}





?>