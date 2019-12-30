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