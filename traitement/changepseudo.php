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
    <div class="banniere_mapage">
        <div class="couleur_banniere">
            <p> Bienvenue sur votre page personnelle. </p>
        </div>
    </div>
    <a href='index.php?action=mapage' class='buttonretour'> Retour </a>
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

if(!isset($_POST['pseudo']) && !isset($_POST['pseudoverif'])){
    header("Location:index.php?action=mapage");
}

?>