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
    <div class="banniere_mapage">
        <div class="couleur_banniere">
            <p> Bienvenue sur votre page personnelle. </p>
        </div>
    </div>
    <a href='index.php?action=mapage' class='buttonretour'> Retour </a>
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
            <label for="emailverif"> Confirmez votre mail : </label>
            <input type="email" name="emailverif"/>
        </div>
        <input type="submit" value="Confirmer" class="boutonconf"/>
    </form>
    <?php
}

if(!isset($_POST['email']) && !isset($_POST['emailverif'])){
    header("Location:index.php?action=mapage");
}

?>