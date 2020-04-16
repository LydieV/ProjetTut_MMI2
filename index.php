<?php
include("config/config.php");
include("config/bd.php");
include("divers/balises.php");
include("config/actions.php");
session_start();
ob_start(); // Je démarre le buffer de sortie : les données à afficher sont stockées
?>

<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Traitement pour une requête AJAX
    ?>
    <div id="contenu">
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
    </div>
    <?php
}else{
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="description" content="Parlons harcèlement, campagne contre le harcèlement qui accompagne les victimes. Découvrez des témoignages et intéragissez."/>
        <link rel="icon" type="image/png" href="img/favicon.jpg" />
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
            <a href="accueil" data-pjax><img class="logobanniere" src="./img/logo.png" alt="Parlons Harcèlement"></a>
                <div id="items" class="items">
                    <a href="temoignages" data-pjax><p>Témoignages</p></a>
                    <a href="ressources" data-pjax><p>Ressources</p></a>
                    <a href="contact" data-pjax><p>Contact</p></a>
                    <a onclick="ouvrirmodaleinscription()"><i class="fas fa-user-alt"></i></a>
                </div>
                <img id="iconemenueo" class="iconemenu" src="img/menu.png" onclick="ouvrirmenu()">
                <img id="iconemenuec" class="iconemenuc" src="img/close.png" onclick="fermermenu()">
            </header>';
    }else{
        echo '<header>
            <a href="accueil" data-pjax><img class="logobanniere" src="./img/logo.png" alt="Parlons Harcèlement"></a>
                <div id="items" class="items">
                    <a href="temoignages" data-pjax><p>Témoignages</p></a>
                    <a href="ressources" data-pjax><p>Ressources</p></a>
                    <a href="contact" data-pjax><p>Contact</p></a>
                    <a href="mapage" data-pjax><p>Ma page</p></a>
                    <a href="deconnexion"><i class="fas fa-sign-out-alt"></i></a>
                </div>
                <img id="iconemenueo" class="iconemenu" src="img/menu.png" onclick="ouvrirmenu()">
                <img id="iconemenuec" class="iconemenuc" src="img/close.png" onclick="fermermenu()">
            </header>';
    }


    ?>
    <div id="contenu">
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
    </div>
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
                <p><a href="mentions-legales" data-pjax>Mentions légales</a> | <a href="confidentialite" data-pjax>Confidentialité</a></p>
            </div>
        </div>
    </footer>
    </body>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/jquery.pjax.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
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
    <?php
}
?>