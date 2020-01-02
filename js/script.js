function ouvrirmodale(){
    document.getElementById('inscription').style.display="block";
}
function fermermodale(){
    document.getElementById('inscription').style.display="none";
}

function idaleatoire() {
    let size = Math.random() * (10 - 4) + 4;
    let liste = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9"];
    let resultat = '';
    for (i = 0; i < size; i++) {
        resultat += liste[Math.floor(Math.random() * liste.length)];
    }
    document.getElementById("identifiant").value=resultat;
}

function inscription() {
    document.getElementById('status').innerHTML = "Inscription en cours...";
    formData = {
        'identifiant'     : $('input[name=identifiant]').val(),
        'email'  : $('input[name=email]').val(),
        'mdp'  : $('input[name=mdp]').val(),
        'mdp2'  : $('input[name=mdp2]').val(),
    };


    $.post({
        url : "../traitement/inscription.php",
        type: "POST",
        async : false,
        data : formData,
        success: function(data, textStatus, jqXHR)
        {
            if (data != 'Succes'){
                document.getElementById('status').innerHTML = data;
            }else{
                document.location.href='index.php';
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            document.getElementById('status').innerHTML = jqXHR;

        }
    });
}