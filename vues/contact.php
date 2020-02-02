<div class="banniere_mapage">
    <div class="couleur_banniere">
        <p> Vous avez des questions ? <br/> Une demande de partenariat ? <br/> Écrivez-nous directement depuis le formulaire. </p>
    </div>
</div>

<div class="pagecontact">
    <div>
        <form method="POST">
            <label for="email" id="label1"> Email </label>
            <input type="email" name="email" id="email" onclick="glissement(this.id)"/>
            <label for="email" id="label2"> Sujet </label>
            <input type="text" name="sujet" id="sujet" onclick="glissement(this.id)"/>
            <label for="msg" class="labelmsg"> Message </label>
            <textarea name="message" id="message"></textarea>
            <a class="boutonconf" onclick="validateForm()"> Envoyer</a>
        </form>
        <div>
            <p id="status"></p>
        </div>
    </div>
    <div class="infosreseaux">
        <div class="infonumvert">
            <p> Numéro vert </p>
            <p class="numerovert"> 0 800 00 00 01 </p>
        </div>
        <div class="reseaux">
            <p> Vous pouvez aussi consulter nos réseaux sociaux </p>
            <div class="reseausociaux">
                <a href="https://www.facebook.com/Parlons-harc%C3%A8lement-103908774511172/?view_public_for=103908774511172">
                    <img src="img/icone_facebook.png" alt="icone_facebook"/>
                </a>
                <a href="https://twitter.com/ParlonsHarclem1">
                    <img src="img/icone_twitter.png" alt="icone_twitter"/>
                </a>
            </div>
        </div>
    </div>
</div>

