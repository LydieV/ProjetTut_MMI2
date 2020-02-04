<div class="contenutemoignages">
    <div class="bannieretemoignages">
        <div class="couleur_banniere textebanniere">
            <p> Sur cette page, vous pouvez lire des témoignages d'autres victimes de harcèlement. Ils
            peuvent aussi vous aider à identifier le type de harcèlement dont vous avez été victime.</p>
        </div>
    </div>
    <div class="temoignage">
        <div class="partiegauche">
            <p>Souhaitez-vous témoigner ?</p>
            <a href="index.php?action=poster">
                <div class="bouton rediger">
                    <p>Rédiger maintenant</p>
                </div>
            </a>
        </div>
        <div class="partiedroite">
            <div class="filtres">
                <div class="filtreviolet filter-button active" data-filter="tous"><p>Tous</p><div class="selecteur"></div></div>
                <div class="filtreviolet filter-button" data-filter="Scolaire"><p>Harcèlement scolaire</p><div class="selecteur"></div></div>
                <div class="filtreviolet filter-button" data-filter="Professionnel"><p>Harcèlement professionnel</p><div class="selecteur"></div></div>
                <div class="filtreviolet filter-button" data-filter="Cyber"><p>Cyber-harcèlement</p><div class="selecteur"></div></div>
                <div class="filtreviolet filter-button" data-filter="Sexuel"><p>Harcèlement sexuel</p><div class="selecteur"></div></div>
            </div>
            <div class="listeposts">
                <?php
                $sql = "SELECT *, DATE_FORMAT(dateEcrit, '%d/%m/%Y') AS dateEcritFormate FROM ecrit ORDER BY id DESC";
                $query = $pdo -> prepare($sql);
                $query->execute();
                $count = $query->rowCount();
                if($count == 0){
                    echo 'Aucun témoignage n\'a été trouvé...';
                }else{
                    while($line = $query->fetch()){
                        $contenu=$line['contenu'];
                        $categorie = $line['categorie'];
                        $dateEcrit = $line['dateEcritFormate'];
                        if (isset($_SESSION['admin']) && $_SESSION['admin']=="1" && $line['visible']==0){
                            echo '<div class="post filter '.$categorie.'"><div class="illustrationpost"></div><div class="contenupost">';
                            echo "<div class='titrefiltre'>$categorie</div>";
                            echo "<div class='datepublication'>Publié le $dateEcrit</div>";
                            echo '<div class="apercu">"'.substr($contenu, 0, 150).' ..."</div>';
                            echo '<a href="index.php?action=temoignage&id='.$line['id'].'"><div class="continuerlecture">continuer la lecture...</div></a>';
                            echo '<a href="index.php?action=acceptertemoignage&id='.$line['id'].'"><button>Accepter</button></a><a href="index.php?action=supprimertemoignage&id='.$line['id'].'"><button>Supprimer</button></a></div></div>';
                        }else{
                            if($line['visible']=="1"){
                                echo '<div class="post filter '.$categorie.'"><div class="illustrationpost"></div><div class="contenupost">';
                                echo "<div class='titrefiltre'>$categorie</div>";
                                echo "<div class='datepublication'>Publié le $dateEcrit</div>";
                                echo '<div class="apercu">"'.substr($contenu, 0, 150).' ..."</div>';
                                echo '<a href="index.php?action=temoignage&id='.$line['id'].'"><div class="continuerlecture">continuer la lecture...</div></a>';
                                echo '</div></div>';
                            }

                        }


                    }
                }

                ?>
            </div>
        </div>
    </div>
</div>

