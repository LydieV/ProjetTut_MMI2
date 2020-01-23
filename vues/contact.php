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
            <label for="msg"> Message </label>
            <textarea name="msg"></textarea>
            <input type="submit" value="Envoyer" class="boutonconf"/>
        </form>
    </div>
    <div>
        <div class="infonumvert">
            <p> Numéro vert </p>
            <p class="numerovert"> 0 800 00 00 01 </p>
        </div>
        <p> Vous pouvez aussi consulter nos réseaux sociaux </p>
        <div class="reseausociaux">
            <a href="#">
                <img src="img/icone_facebook.png" alt="icone_facebook"/>
            </a>
            <a href="#">
                <img src="img/icone_twitter.png" alt="icone_twitter"/>
            </a>
        </div>
    </div>
</div>

<?php

if(isset($_POST['email']) && isset($_POST['sujet']) && isset($_POST['msg'])){

    $emailpsn = $_POST['email'];
    ini_set("smtp_port", "25");
    $mail = mail('parlonsharcelementcontact@gmail.com', 'Sujet : '. $_POST['sujet'], $_POST['msg'], 'From : ' . $emailpsn );
    if($mail){
        echo "Message envoyé";
    } else {
        echo "erreur";
    }
}

?>