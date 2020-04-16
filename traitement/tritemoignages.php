<?php
session_start();
if(isset($_POST['choix']) && !empty($_POST['choix'])){
    include ('../config/config.php');
    include('../config/bd.php');
    $choix = $_POST['choix'];

    if($choix == 'tout'){
        $sql = "SELECT *, DATE_FORMAT(dateEcrit, '%d/%m/%Y') AS dateEcritFormate FROM ecrit ORDER BY id DESC";
        $query = $pdo -> prepare($sql);
        $query->execute();
        $count = $query->rowCount();
        if($count == 0){
            echo 'Aucun témoignage n\'a été trouvé...';
        }else{
            while($line = $query->fetch()){
                $id=$line['id'];
                $contenu=stripslashes($line['contenu']);
                $categorie = $line['categorie'];
                $dateEcrit = $line['dateEcritFormate'];
                if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && $line['visible']==0){
                    echo '<div class="post filter '.$categorie.'"><div class="illustrationpost" style="background-image: url(/img/aucunecategorie.jpg);"></div><div class="contenupost">';
                    echo "<form method='POST' action='index.php?action=acceptertemoignage'><input name='id' value='$id' type='hidden'>";
                    echo "<div class='titrefiltre'>
                            <select name='categorie'>
                             <option selected value='Scolaire'>Scolaire</option>
                             <option value='Professionnel'>Professionnel</option>
                             <option value='Cyber'>Cyber</option>
                             <option value='Sexuel'>Sexuel</option>
                            </select></div>";
                    echo "<div class='datepublication'>Publié le $dateEcrit</div>";
                    echo '<input type="text" placeholder="titre" name="titre" required>';
                    echo '<div class="apercu">"'.substr($contenu, 0, 40).' ..."</div>';
                    echo '<a href="./temoignage-'.$line['id'].'"><div class="continuerlecture">continuer la lecture...</div></a>';
                    echo '<input type="submit" value="Accepter"></form>';
                    echo '<form method="POST" action="index.php?action=supprimertemoignage">';
                    echo "<input name='id' value='$id' type='hidden'>";
                    echo '<input type="submit" value="Supprimer"></form>';
                    echo '</div></div>';
                }else{
                    if($line['visible']=="1"){
                        $titre = $line['titre'];
                        echo '<div class="post filter '.$categorie.'">';
                        echo '<div class="illustrationpost"></div>';
                        echo '<div class="contenupost">';
                        echo "<div class='titretemoignage'><h3> $titre</h3></div>";
                        echo "<div class='datepublication'>Catégorie : $categorie</div>";
                        echo "<div class='datepublication'>Publié le $dateEcrit</div>";
                        echo '<div class="apercu">"'.substr($contenu, 0, 40).' ..."</div>';
                        echo '<div class="liresuite"><a href="./temoignage-'.$line['id'].'"> Lire la suite </a></div>';
                        if(isset($_SESSION['admin']) && $_SESSION['admin'] == "1"){
                            echo '<form method="POST" action="index.php?action=supprimertemoignage">';
                            echo "<input name='id' value='$id' type='hidden'>";
                            echo '<input type="submit" value="Supprimer"></form>';
                        }
                        echo '</div></div>';
                    }
                }
            }
        }
    }else{
        $sql = "SELECT *, DATE_FORMAT(dateEcrit, '%d/%m/%Y') AS dateEcritFormate FROM ecrit WHERE categorie=? ORDER BY id DESC";
        $query = $pdo -> prepare($sql);
        $query->execute(array($choix));
        $count = $query->rowCount();
        if($count == 0){
            echo '<div><p>Il n\'existe pas encore de témoignages pour cette catégorie.</p>';
            if(isset($_SESSION['id'])){
                echo '<a href="./poster"><div class="bouton rediger">
                <p>Déposer un témoignage</p>
                </div></div></a>';
            }else{
                echo '<br />Pour déposer un témoignage, il faut être connecté.</div>';
            }
        }else{
            while($line = $query->fetch()){
                $id=$line['id'];
                $contenu=stripslashes($line['contenu']);
                $categorie = $line['categorie'];
                $dateEcrit = $line['dateEcritFormate'];
                if($line['visible']=="1"){
                    $titre = $line['titre'];
                    echo '<div class="post filter '.$categorie.'">';
                    echo '<div class="illustrationpost"></div>';
                    echo '<div class="contenupost">';
                    echo "<div class='titretemoignage'><h3> $titre</h3></div>";
                    echo "<div class='datepublication'>Catégorie : $categorie</div>";
                    echo "<div class='datepublication'>Publié le $dateEcrit</div>";
                    echo '<div class="apercu">"'.substr($contenu, 0, 40).' ..."</div>';
                    echo '<div class="liresuite"><a href="./temoignage-'.$line['id'].'"> Lire la suite </a></div>';
                    if(isset($_SESSION['admin']) && $_SESSION['admin'] == "1"){
                        echo '<form method="POST" action="index.php?action=supprimertemoignage">';
                        echo "<input name='id' value='$id' type='hidden'>";
                        echo '<input type="submit" value="Supprimer"></form>';
                    }
                    echo '</div></div>';
                }
            }
        }
    }
}else{
    echo '<p>Merci de choisir une catégorie...</p>';
}

?>