<?php

if (isset($_POST['temoignage']) && !empty($_POST['temoignage']) && isset($_POST['idtemoignage']) && !empty($_POST['idtemoignage'])){
    session_start();
    $temoignage = htmlspecialchars(addslashes($_POST['temoignage']));
    $idtemoignage = $_POST['idtemoignage'];

    //On update le témoignage dans la bdd...
    include("../config/config.php");
    include("../config/bd.php");

    $sql = "UPDATE ecrit SET contenu=? WHERE id=?";
    $query = $pdo->prepare($sql);
    $query->execute(array($temoignage,$idtemoignage));

    require_once "../divers/jbbcode/Parser.php";

    $parser = new JBBCode\Parser();
    $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
    $parser->addBBCode('center', "<p class='centrer'>{param}</p>");
    $parser->addBBCode('left', "<p class='gauche'>{param}</p>");
    $parser->addBBCode('right', "<p class='droite'>{param}</p>");
    $parser->addBBCode('quote', "<blockquote>{param}</blockquote>");
    $parser->addBBCode('color', "{param}");

    $parser->parse(stripslashes(nl2br($temoignage)));
    echo $parser->getAsHtml();
}else{
    echo 'Erreur';
}




?>