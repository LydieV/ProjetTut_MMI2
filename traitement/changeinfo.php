<?php

if(isset($_POST['modif'])){
    ?>
    <div class="contenumapage">
    <div class="banniere_changeinfo">
        <div class="couleur_banniere">
            <p> Bienvenue sur votre page personnelle. </p>
        </div>
    </div>
    <?php
    echo "<a href='index.php?action=mapage' class='buttonretour'> Retour </a>";

    if(isset($_POST['changeemail'])){
        ?>
        <form method="POST" action="index.php?action=changemail" class="formchange">
            <h2> <?php echo $_SESSION['identifiant'] ?> </h2>
            <div class="elementchangement">
                <label for="ancienmail"> Votre ancienne adresse mail : </label>
                <input type="text" name="ancienmail" value=""/>
            </div>
            <div class="elementchangement">
                <label for="mail"> Votre nouvelle adresse mail : </label>
                <input type="email" name="email"/>
            </div>
            <div class="elementchangement">
                <label for="emailverif"> Confirmez votre adresse mail : </label>
                <input type="email" name="emailverif"/>
            </div>
            <input type="submit" value="Confirmer" class="boutonconf"/>
        </form>
        <?php
    }

    if(isset($_POST['changemdp'])){
        ?>
        <form method="POST" action="index.php?action=changemdp" class="formchange">
            <h2> <?php echo $_SESSION['identifiant'] ?> </h2>
            <div class="elementchangement">
                <label for="pwd"> Votre nouveau mot de passe : </label>
                <input type="password" name="pwd"/>
            </div>
            <div class="elementchangement">
                <label for="pwdverif"> Confirmez votre mot de passe : </label>
                <input type="password" name="pwdverif"/>
            </div>
            <input type="submit" value="Confirmer" class="boutonconf"/>
        </form>

        <?php
    }

    if(!isset($_POST['changeemail']) && !isset($_POST['changemdp']) && !isset($_POST['changepseudo'])){
        header("Location: ./mapage");
    }
} else{
    header("Location: ./mapage");
}





?>
    </div>
