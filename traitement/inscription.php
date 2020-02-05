<?php

    if (isset($_POST['identifiant']) && !empty($_POST['identifiant']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['mdp2']) && !empty($_POST['mdp2'])){
        include("../config/config.php");
        include("../config/bd.php");
        //On crée des variables
        $identifiant=htmlspecialchars(trim($_POST['identifiant']));
        $email=htmlspecialchars(trim($_POST['email']));
        $mdp=htmlspecialchars($_POST['mdp']);
        $mdp2=htmlspecialchars($_POST['mdp2']);
        $naissance=$_POST['naissance'];
        $ok=true;

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

        //On vérifie le format de l'adresse email
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (preg_match($regex, $_POST['email'])){
            $formatemail=true;
        }else{
            $formatemail=false;
        }

        //On regarde si les deux mot de passe sont identiques
        if ($mdp == $mdp2){
            $motdepasse = true;
        }else{
            $motdepasse=false;
        }

        if($ok==false && $motdepasse == true){
            echo 'Identifiant ou adresse mail déjà utilisé(e) !';
        }
        if($ok==true && $motdepasse == false){
            echo 'Les mots de passe ne sont pas identiques !';
        }
        if($ok==true && $motdepasse == true && $formatemail == false){
            echo 'Le format de l\'adresse mail est incorrect !';
        }
        if($ok==true && $motdepasse == true && $formatemail == true){
            //On insère les données dans la bdd
            $sql = "INSERT INTO utilisateurs VALUES(NULL,'$identifiant',PASSWORD('$mdp'),'$email',NULL, '$naissance',0)";
            $query = $pdo->prepare($sql);
            $query->execute();
            $id = $pdo->lastInsertId();
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['identifiant'] = $identifiant;
            echo 'Succes';
        }




    }else{
        echo 'Merci de remplir tous les champs !';

    }
?>