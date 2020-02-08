<?php

include("config/config.php");
include("config/bd.php");
include("divers/balises.php");
include("config/actions.php");
session_start();
ob_start(); // Je démarre le buffer de sortie : les données à afficher sont stockées


?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nom du site</title>


    

        <!-- Chargement des feuilles de style nécessaires -->
        <link href="./css/style.css" rel="stylesheet">
        <!-- Chargement des polices -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
        <!-- Chargement de JQuery -->
        <script src="js/jquery-3.2.1.min.js"></script>
    </head>

    <body>

        <?php
        if (isset($_SESSION['info'])) {
            echo "<div>
                <strong>Information : </strong> " . $_SESSION['info'] . "</div>";
            unset($_SESSION['info']);
        }

        if (!isset($_SESSION['identifiant'])){
            echo '<header>
            <a href="index.php"><h3>Parlons harcèlement</h3></a>
                <div id="items" class="items">
                    <a href="index.php?action=temoignages"><p>Témoignages</p></a>
                    <a href="index.php?action=ressources"><p>Ressources</p></a>
                    <a href="index.php?action=contact"><p>Contact</p></a>
                    <a onclick="ouvrirmodaleconnexion()"><p>Se connecter</p></a>
                    <a onclick="ouvrirmodaleinscription()"><p>S\'inscrire</p></a>
                </div>
                <img id="iconemenueo" class="iconemenu" src="img/menu.png" onclick="ouvrirmenu()">
                <img id="iconemenuec" class="iconemenuc" src="img/close.png" onclick="fermermenu()">
            </header>';
        }else{
            echo '<header>
            <a href="index.php"><h3>Parlons harcèlement</h3></a>
                <div id="items" class="items">
                    <a href="index.php?action=temoignages"><p>Témoignages</p></a>
                    <a href="index.php?action=ressources"><p>Ressources</p></a>
                    <a href="index.php?action=contact"><p>Contact</p></a>
                    <a href="index.php?action=mapage"><p>Ma page</p></a>
                </div>
                <img id="iconemenueo" class="iconemenu" src="img/menu.png" onclick="ouvrirmenu()">
                <img id="iconemenuec" class="iconemenuc" src="img/close.png" onclick="fermermenu()">
            </header>';
        }

        
        ?>

                    <?php
                    // Quelle est l'action à faire ?
                    if (isset($_GET["action"])) {
                        $action = $_GET["action"];
                    } else {
                        $action = "accueil";
                    }

                    // Est ce que cette action existe dans la liste des actions
                    if (array_key_exists($action, $listeDesActions) == false) {
                        include("vues/404.php"); // NON : page 404
                    } else {
                        include($listeDesActions[$action]); // Oui, on la charge
                    }

                    ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être
                    ?>

        <?php include("vues/inscription.php"); ?>
        <?php include("vues/connexion.php"); ?>
        <footer>
            <div><div class="apropos"><p>" Parlons Harcèlement " est une campagne contre le harcèlement dans toutes ses formes et accompagne les victimes à témoigner et agir contre le harcèlement. </p></div>
                <div class="reseauxsociaux"><p>Facebook</p><p>Twitter</p></div>
                <div class="contacts"><p>Mail : parlonsharcelementcontact@gmail.com</p><p>Téléphone : 0781257059</p></div>
            </div>
            <div class="mentions"><p>Mentions légales | Confodentialité | Cookies</p></div>
        </footer>
    </body>
    <script src="js/script.js"></script>
</html>