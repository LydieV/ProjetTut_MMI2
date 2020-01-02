<div id="inscription" class="inscription">
    <div class="modale">
        <i class="fas fa-times boutonfermer" onclick="fermermodale()"></i>
        <p>Pour éviter toute tentative qui se voudrait malveillante, il est obligatoire  de créer un compte.</p>
        <form  method="POST">
            <div class="ligne1">
                <div class="identifiant">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" name="identifiant" id="identifiant">
                    <a onclick="idaleatoire()">Générer un identifiant au hasard ?</a>
                </div>
                <div class="datenaissance">
                    <label for="naissance">Date de naissance</label>
                    <div class="choixnaissance">
                        <input list="jour" name="jour" placeholder="1">
                        <datalist id="jour">
                            <?php
                                for($i=1;$i<32;$i++){
                                    echo "<option value='$i'></option>";
                                }
                            ?>
                        </datalist>
                        <input list="mois" name="mois" placeholder="Jan.">
                        <datalist id="mois">
                            <?php
                                $tabmois=['Jan.','Fév.','Mars','Avr.','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov','Déc.'];
                                foreach($tabmois as $mois){
                                    echo "<option value='$mois'></option>";
                                }
                            ?>
                        </datalist>
                        <input list="annee" name="annee" placeholder="1900">
                        <datalist id="annee">
                            <?php
                                for($i=1900;$i<2020;$i++){
                                    echo "<option value='$i'></option>";
                                }
                            ?>
                        </datalist>
                    </div>
                </div>
            </div>
            
            <div class="ligne2">
                <label for="email">Email</label>
                <input type="email" name="email">
            </div>

            <div class="ligne3">
                <div class="mdp">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" name="mdp">
                </div>
                <div class="mdp2">
                    <label for="mdp2">Confirmez le mot de passe</label>
                    <input type="password" name="mdp2">
                </div>
            </div>

            <div class="ligne4">
                <div class="captcha">
                    <p id="status"></p>
                </div>
                <div class="envoi">
                    <div class="btn" onclick="inscription();">S'inscrire</div>
                </div>

            </div>
            
        </form>
    </div>
</div>
