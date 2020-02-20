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
        <title>Parlons Harcèlement</title>


    

        <!-- Chargement des feuilles de style nécessaires -->
        <link href="./css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

        <!-- Chargement des polices -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
        <!-- Chargement de JQuery -->
        <script src="js/jquery-3.4.1.min.js"></script>
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
            <a href="./accueil"><img class="logobanniere" src="./img/logo.png" alt="Parlons Harcèlement"></a>
                <div id="items" class="items">
                    <a href="./temoignages"><p>Témoignages</p></a>
                    
                    <a href="./contact"><p>Contact</p></a>
                    <a onclick="ouvrirmodaleinscription()"><i class="fas fa-user-alt"></i></a>
                </div>
                <img id="iconemenueo" class="iconemenu" src="img/menu.png" onclick="ouvrirmenu()">
                <img id="iconemenuec" class="iconemenuc" src="img/close.png" onclick="fermermenu()">
            </header>';
        }else{
            echo '<header>
            <a href="./accueil"><img class="logobanniere" src="./img/logo.png" alt="Parlons Harcèlement"></a>
                <div id="items" class="items">
                    <a href="./temoignages"><p>Témoignages</p></a>
                    
                    <a href="./contact"><p>Contact</p></a>
                    <a href="./mapage"><p>Ma page</p></a>
                    <a href="./deconnexion"><i class="fas fa-sign-out-alt"></i></a>
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
        <footer>
            <div class="footer">
                <div class="contact_footer">
                    <a href="https://www.facebook.com/Parlons-harc%C3%A8lement-103908774511172/?view_public_for=103908774511172">
                        <img src="./img/icone_facebook_accueil.png" alt="icone_facebook_accueil"/>
                    </a>
                    <a href="https://twitter.com/ParlonsHarclem1">
                        <img src="./img/icone_twitter_accueil.png" alt="icone_twitter_accueil"/>
                    </a>
                    <a href="mailto:parlonsharcelementcontact@gmail.com">
                        <img src="./img/icone_mail_accueil.png" alt="icone_mail_accueil"/>
                    </a>
                </div>
                <div class="mentions">
                    <p><a href="./mentions-legales">Mentions légales</a> | <a href="./confidentialite">Confidentialité</a></p>
                </div>
            </div>

        </footer>
    </body>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script>
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": "#7C277D",
                    "text": "#ffffff"
                },
                "button": {
                    "background": "#F9A01B"
                }
            },
            "position": "bottom-right",
            "content": {
                "message": "En cliquant sur ”J’accepte”, vous acceptez l’utilisation des cookies. Vous pourrez toujours les désactiver ultérieurement. Si vous supprimez ou désactivez nos cookies, vous pourriez rencontrer des interruptions ou des problèmes d’accès au site.\"",
                "dismiss": "J'accepte",
                "link": "En savoir plus"
            }
        });
    </script>
</html>