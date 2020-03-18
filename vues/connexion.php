<div id="connexion" class="connexion">
    <div class="modale">
        <i class="fas fa-times boutonfermer" onclick="fermermodaleconnexion()"></i>
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
