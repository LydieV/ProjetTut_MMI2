<div id="inscription" class="inscription">
    <div class="modale">
        <i class="fas fa-times boutonfermer" onclick="fermermodaleinscription()"></i>
        <p class="msgconn"><span class="actif">Inscription</span><span class="afficherconnexion">Connexion</span></p>
        <p class="msginsc"><span class="afficherinscription">Inscription</span> <span class=" actif">Connexion</span></p>
        <form  method="POST" id="forminscription" action="#">
            <p class="msginfoinsc">Pour éviter toute tentative qui se voudrait malveillante, il est obligatoire  de créer un compte.</p>
            <div class="ligne1">
                <div class="identifiant">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" name="identifiant" id="identifiant">
                    <a onclick="idaleatoire()">Générer un identifiant au hasard ?</a>
                </div>
                <div class="datenaissance">
                    <label for="naissance">Année de naissance</label>
                    <div class="choixnaissance">
                        <select id="start" name="naissance" required>
                            <option>1900</option>
                            <?php $years = range(1901, strftime("%Y", time()));
                            foreach($years as $year) : ?>
                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                    <input type="submit" value="S'inscrire"></input>
                </div>

            </div>
            
        </form>
        <form  method="POST" id="formconnexion" action="#">
            <div class="ligne1">
                <div class="identifiant">
                    <label for="identifiant">Email</label>
                    <input type="text" name="identifiantconnexion" id="identifiantconnexion">
                </div>
                <div class="mdpconnexion">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" name="mdpconnexion">
                </div>
            </div>

            <div class="ligne4">
                <div class="captcha">
                    <p id="statusconnexion"></p>
                </div>
                <div class="envoi">
                    <input type="hidden" name="url" value="<?php echo $_SERVER["REQUEST_URI"];?>">
                    <input type="submit" value="Se connecter"></input>
                </div>

            </div>

        </form>
    </div>
</div>
