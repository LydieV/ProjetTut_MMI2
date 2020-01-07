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
            $ok=false;
        }

        //On regarde si l'email est déjà enregistré
        $sql = "SELECT * FROM utilisateurs WHERE email=?";
        $query = $pdo -> prepare($sql);
        $query->execute(array($email));
        $count = $query->rowCount();
        if ($count == 1){
            $ok=false;
        }

        if($ok==false){
            echo 'Identifiant ou adresse mail déjà utilisé(e) !';
        }

    }else{
        echo 'Merci de remplir tous les champs !';

    }
?>