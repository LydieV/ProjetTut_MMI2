<div id="inscription" class="inscription">
    <div class="modale">
        <i class="fas fa-times boutonfermer" onclick="fermermodale()"></i>
        <p>Pour éviter toute tentative qui se voudrait malveillante, il est obligatoire  de créer un compte.</p>
        <form action="index.php?action=inscription">
            <div class="ligne1">
                <div class="identifiant">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" name="identifiant">
                    <a href="#">Générer un identifiant au hasard ?</a>
                </div>
                <div class="datenaissance">
                    <label for="naissance">Date de naissance</label>
                    <div class="choixnaissance">
                        <input list="jour" name="jour" placeholder="0">
                        <datalist id="jour">
                            <option value="0"></option>
                        </datalist>
                        <input list="mois" name="mois" placeholder="Jan.">
                        <datalist id="mois">
                            <option value="Jan."></option>
                        </datalist>
                        <input list="annee" name="annee" placeholder="1990">
                        <datalist id="annee">
                            <option value="1990"></option>
                        </datalist>
                    </div>
                </div>
            </div>
            
            <div class="ligne2">
                <label for="email">Email</label>
                <input type="email">
            </div>

            <div class="ligne3">
                <div class="mdp">
                    <label for="mdp">Mot de passe</label>
                    <input type="password">
                </div>
                <div class="mdp2">
                    <label for="mdp2">Confirmez le mot de passe</label>
                    <input type="password">
                </div>
            </div>

            <div class="ligne4">
                <div class="captcha">

                </div>
                <div class="envoi">
                    <input type="submit" value="S'inscrire">
                </div>

            </div>
            
        </form>
    </div>
</div>
