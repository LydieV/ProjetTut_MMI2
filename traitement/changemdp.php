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
    <div class="banniere_mapage">
        <div class="couleur_banniere">
            <p> Bienvenue sur votre page personnelle. </p>
        </div>
    </div>
    <a href='index.php?action=mapage' class='buttonretour'> Retour </a>
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

if(!isset($_POST['pwd']) && !isset($_POST['pwdverif'])){
    header("Location:index.php?action=mapage");
}

?>