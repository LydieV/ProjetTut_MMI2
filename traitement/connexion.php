<?php

if (isset($_POST['identifiant']) && !empty($_POST['identifiant']) && isset($_POST['mdp']) && !empty($_POST['mdp']) ){
    include("../config/config.php");
    include("../config/bd.php");
    //On crée des variables
    $identifiant=htmlspecialchars(trim($_POST['identifiant']));
    $mdp=htmlspecialchars($_POST['mdp']);

    //On regarde si le couple identifiant / mdp existe
    $sql = "SELECT * FROM utilisateurs WHERE (identifiant=? OR email=?) AND mdp=PASSWORD(?)";
    $query = $pdo -> prepare($sql);
    $query->execute(array($identifiant, $identifiant, $mdp));
    $line = $query->fetch();
    $count = $query->rowCount();
    if ($count == 1){
        session_start();
        $_SESSION['id'] = $line['id'];
        $_SESSION['identifiant'] = $line['identifiant'];
        if($line['admin'] == "1"){
            $_SESSION['admin'] = true;
        }
        echo 'Succes';
    }else{
        echo 'Identifiant ou mot de passe invalide !';
    }
}else{
    echo 'Merci de remplir tous les champs !';
}


?>