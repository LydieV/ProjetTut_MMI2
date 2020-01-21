<?php

if(isset($_POST['modif'])){
    ?>
    <div class="banniere_mapage">
        <div class="couleur_banniere">
            <p> Bienvenue sur votre page personnelle. </p>
        </div>
    </div>
    <?php
    echo "<a href='index.php?action=mapage' class='buttonretour'> Retour </a>";
    if(isset($_POST['changepseudo'])){
        ?>
        <form method="POST" action="index.php?action=changepseudo" class="formchange">
            <h2> <?php echo $_SESSION['identifiant'] ?> </h2>
            <div class="elementchangement">
                <label for="ancienpseudo"> Votre ancien pseudo :</label>
                <input type="text" name="ancienpseudo" value="<?php echo $_SESSION['identifiant'] ?>" readonly="readonly" class="ancien"/>
            </div>
            <div class="elementchangement">
                <label for="pseudo"> Votre nouveau pseudo : </label>
                <input type="text" name="pseudo"/>
            </div>
            <div class="elementchangement">
                <label for="pseudoverif"> Confirmez votre pseudo : </label>
                <input type="text" name="pseudoverif"/>
            </div>
            <input type="submit" value="Confirmer" class="boutonconf"/>
        </form>
        <?php
    }

    if(isset($_POST['changeemail'])){
        ?>
        <form method="POST" action="index.php?action=changemail" class="formchange">
            <h2> <?php echo $_SESSION['identifiant'] ?> </h2>
            <div class="elementchangement">
                <label for="ancienmail"> Votre ancienne adresse mail : </label>
                <input type="text" name="ancienmail" value=""/>
            </div>
            <div class="elementchangement">
                <label for="mail"> Votre nouvelle adresse nouveau mail : </label>
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
        header("Location: index.php?action=mapage");
    }
} else{
    header("Location: index.php?action=mapage");
}





?>