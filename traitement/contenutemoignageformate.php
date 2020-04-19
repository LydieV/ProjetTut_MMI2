<?php
session_start();

if(isset($_POST['idtemoignage'])){
    include ('../config/config.php');
    include('../config/bd.php');
    $id=$_POST['idtemoignage'];

    $sql="SELECT *, DATE_FORMAT(dateEcrit, '%d/%m/%Y') AS dateEcritFormate FROM ecrit JOIN utilisateurs ON ecrit.idAuteur=utilisateurs.id WHERE ecrit.id=?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($id));
    $line=$query->fetch();
    $contenu = $line['contenu'];
    /*echo '<form id="formmodiftemoignage" method="POST">
            <textarea id="area" name="majtemoignage" placeholder="Décrivez les faits dont vous avez été victime..." data-idtemoignage="'.$id.'">'.stripslashes($contenu).'</textarea>
            <input class="bouton envoitemoignage" type="submit" value="Modifier le témoignage"></input>
        </form>';*/
    require_once "../divers/jbbcode/Parser.php";

    $parser = new JBBCode\Parser();
    $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
    $parser->addBBCode('center', "<p class='centrer'>{param}</p>");
    $parser->addBBCode('left', "<p class='gauche'>{param}</p>");
    $parser->addBBCode('right', "<p class='droite'>{param}</p>");
    $parser->addBBCode('quote', "<blockquote>{param}</blockquote>");
    $parser->addBBCode('color', "{param}");
    $parser->parse(stripslashes(nl2br($contenu)));
    echo $parser->getAsHtml() ;
}


?>
