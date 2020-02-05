<div id="inscription" class="inscription">
    <div class="modale">
        <i class="fas fa-times boutonfermer" onclick="fermermodaleinscription()"></i>
        <p>Pour éviter toute tentative qui se voudrait malveillante, il est obligatoire  de créer un compte.</p>
        <form  method="POST" id="forminscription" action="#">
            <div class="ligne1">
                <div class="identifiant">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" name="identifiant" id="identifiant">
                    <a onclick="idaleatoire()">Générer un identifiant au hasard ?</a>
                </div>
                <div class="datenaissance">
                    <label for="naissance">Date de naissance</label>
                    <div class="choixnaissance">
                        <input type="date" id="start" name="naissance" required>
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
    </div>
</div>
