<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"/>
</head>

<?php

if(isset($_SESSION['id'])){

?>
    <div class="contenumapage">
        <div class="banniere_changeinfo">
            <div class="couleur_banniere">
                <p> Bienvenue sur votre page personnelle. </p>
            </div>
        </div>

        <div class="monprofil">
            <div class='infosprofil'>

                <?php
                $sql="SELECT * FROM utilisateurs WHERE id=?";
                $query = $pdo->prepare($sql);
                $query->execute(array($_SESSION['id']));
                $infoPsn = $query->fetch();
                ?>

                <h2 class="ident"> <?php echo $infoPsn['identifiant'] ?> </h2>

                <div class="info">
                    <p> <span class="titreinfo"> Email : </span> <?php echo $infoPsn['email'] ?> </p>
                    <form method="POST" action="index.php?action=changeinfo">
                        <input type="hidden" name="changeemail"/>
                        <input type="submit" class="changementinfo" name="modif" value="Vous désirez changer d'adresse mail ?"/>
                    </form>
                </div>

                <div class="info">
                    <p> <span class="titreinfo"> Mot de passe : </span> ******* </p>
                    <form method="POST" action="index.php?action=changeinfo">
                        <input type="hidden" name="changemdp"/>
                        <input type="submit" class="changementinfo" name="modif" value="Vous désirez changer de mot de passe ?"/>
                    </form>
                </div>
                <div class="info">
                    <p> <span class="titreinfo"> Date de naissance : </span> <?php echo $infoPsn['datenaissance'] ?> </p>
                </div>

                <form method="POST" action="index.php?action=supcompte">
                    <input type="submit" name="supprimercompte" value="Supprimer mon compte" id="supcompte"/>
                </form>
            </div>

            <div class="activitesprofil">
                <div class="section_activite">
                    <h3 class="titre1"> Les témoignages que j'ai postés </h3>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <?php
                            $sql = "SELECT COUNT(*) AS nb FROM ecrit WHERE idAuteur=?";
                            $query1 = $pdo->prepare($sql);
                            $query1->execute(array($_SESSION['id']));
                            $colums = $query1->fetch();
                            $nb = $colums['nb'];
                            $nombre = 1;
                            for($i=0; $i < $nb-1; $i++){
                                echo '<li data-target="#myCarousel" data-slide-to="'. $nombre. '"></li>';
                                $nombre = $nombre + 1;
                            }

                            if($nb == 0){
                                echo '</ol>';
                                echo '<div class="carousel-inner">';
                                    echo '<a>';
                                        echo '<div class="apercutemoignage item active">';
                                            echo "<p> Vous n'avez pas encore posté de témoignages. </p>";
                                        echo '</div>';
                                    echo '</a>';
                                echo '</div>';
                            } else {
                                echo '</ol>';
                            }
                            ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            $sql = "SELECT * FROM ecrit WHERE idAuteur=?";
                            $query = $pdo -> prepare($sql);
                            $query->execute(array($_SESSION['id']));
                            $nb=0;
                            while($line=$query->fetch()){
                                $contenu=substr($line['contenu'], 0, 25). ' ...';
                                if($nb == 0){
                                    echo '<a href="./temoignage-'.$line['id'].'" class="item active">';
                                        echo '<div class="apercutemoignage">';
                                            echo '<p>"'.$contenu   .'"</p>';
                                        echo '</div>';
                                    echo '</a>';
                                } else{
                                    echo '<a href="./temoignage-'.$line['id'].'" class="item">';
                                        echo '<div class="apercutemoignage">';
                                            echo '<p>"'.$contenu   .'"</p>';
                                        echo '</div>';
                                    echo '</a>';
                                }
                                $nb++;
                            }
                            ?>
                        </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="section_activite">
                    <h3 class="titre2"> Les témoignages que j'ai sauvegardés </h3>
                    <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
                            <?php
                            $sql = "SELECT COUNT(*) AS nb FROM ecrit JOIN sauvegarde ON idUtilisateur=? WHERE sauvegarde.idUtilisateur=? AND sauvegarde.idTemoignage=ecrit.id";
                            $query2 = $pdo->prepare($sql);
                            $query2->execute(array($_SESSION['id'],$_SESSION['id']));
                            $colums = $query2->fetch();
                            $nb = $colums['nb'];
                            $nombre = 1;
                            for($i=0; $i < $nb-1; $i++){
                                echo '<li data-target="#myCarousel" data-slide-to="'. $nombre. '"></li>';
                                $nombre = $nombre + 1;
                            }

                            if($nb == 0){
                                echo '</ol>';
                                echo '<div class="carousel-inner">';
                                    echo '<a>';
                                        echo '<div class="apercutemoignage item active">';
                                            echo "<p> Vous n'avez pas encore sauvegardé de témoignages. </p>";
                                        echo '</div>';
                                    echo '</a>';
                                echo '</div>';
                            } else {
                                echo '</ol>';
                            }
                            ?>

                        <div class="carousel-inner">
                        <?php
                        $sql = "SELECT *, ecrit.id AS idecrit FROM ecrit JOIN sauvegarde ON idUtilisateur=? WHERE sauvegarde.idUtilisateur=? AND sauvegarde.idTemoignage=ecrit.id";
                        $query = $pdo -> prepare($sql);
                        $query->execute(array($_SESSION['id'],$_SESSION['id']));
                        $nb = 0;
                        while($line=$query->fetch()){
                            $contenu=substr($line['contenu'], 0, 25). ' ...';
                            if($nb == 0){
                                echo '<a href="./temoignage-'.$line['idecrit'].'" class="item active">';
                                    echo '<div class="apercutemoignage">';
                                        echo '<p>"'.$contenu   .'"</p>';
                                        echo '</div></a>';

                            } else{
                                echo '<a href="./temoignage-'.$line['idecrit'].'" class="item">';
                                    echo '<div class="apercutemoignage">';
                                        echo '<p>"'.$contenu   .'"</p>';
                                        echo '</div></a>';

                            }
                            $nb++;
                        }
                        ?>
                        </div>
                        <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel2" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="section_activite">
                    <h3 class="titre3"> Les commentaires que j'ai postés </h3>
                    <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
                            <?php
                            $sql = "SELECT COUNT(*) AS nb FROM commentaires WHERE idAuteur=? LIMIT 5";
                            $query3 = $pdo->prepare($sql);
                            $query3->execute(array($_SESSION['id']));
                            $colums = $query3->fetch();
                            $nb = $colums['nb'];
                            $nombre = 1;
                            for($i=0; $i < $nb-1; $i++){
                                echo '<li data-target="#myCarousel" data-slide-to="'. $nombre. '"></li>';
                                $nombre = $nombre + 1;
                            }
                            if($nb == 0){
                                echo '</ol>';
                                echo '<div class="carousel-inner">';
                                echo '<a>';
                                echo '<div class="apercutemoignage item active">';
                                    echo "<p> Vous n'avez pas encore posté de commentaires. </p>";
                                    echo '</div>';
                                    echo '</a>';
                                    echo '</div>';
                            } else {
                                echo '</ol>';
                            }
                            ?>

                        <div class="carousel-inner">
                            <?php
                            $sql = "SELECT * FROM commentaires WHERE idAuteur=? LIMIT 5";
                            $query = $pdo -> prepare($sql);
                            $query->execute(array($_SESSION['id']));
                            $nb=0;
                            while($line=$query->fetch()){
                                $contenu=substr($line['commentaire'], 0, 25). ' ...';
                                if($nb == 0){
                                    echo '<a href="./temoignage-'.$line['idTemoignage'].'" class="item active">';
                                        echo '<div class="apercutemoignage">';
                                            echo '<p>"'.$contenu   .'"</p>';
                                        echo '</div>';
                                    echo '</a>';
                                } else{
                                    echo '<a href="./temoignage-'.$line['idTemoignage'].'" class="item">';
                                        echo '<div class="apercutemoignage">';
                                            echo '<p>"'.$contenu   .'"</p>';
                                        echo '</div>';
                                    echo '</a>';
                                }
                                $nb++;
                            }
                            ?>
                        </div>
                        <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel2" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php
} else{
    header("Location:index.php?action=erreur");
}

?>

