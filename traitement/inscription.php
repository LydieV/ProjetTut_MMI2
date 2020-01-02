<?php

    if (isset($_POST['identifiant']) && !empty($_POST['identifiant']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['mdp2']) && !empty($_POST['mdp2'])){
        include("../config/config.php");
        include("../config/bd.php");
        //On crée des variables
        $identifiant=htmlspecialchars(trim($_POST['identifiant']));
        $email=htmlspecialchars(trim($_POST['email']));
        $mdp=htmlspecialchars($_POST['mdp']);
        $mdp=htmlspecialchars($_POST['mdp2']);

        //On regarde si l'identifiant existe déjà
        $sql = "SELECT * FROM utilisateurs WHERE identifiant=?";
        $query = $pdo -> prepare($sql);
        $query->execute(array($identifiant));
        $count = $query->rowCount();
        if ($count == 1){
            echo 'Cet identifiant est déjà utilisé !';
        }

    }else{
        echo 'Erreur';

    }
?>