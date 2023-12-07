// Linkando os botoes do radio com as variaveis ong e usuario
var usuario = document.getElementById("radioUsuario")
var ong = document.getElementById("radioONG")

// Quando os respectivos elementos forem clicado acontecera a troca de tela.
ong.addEventListener("click", function() {
    escondaA(this);
  }); 

  usuario.addEventListener("click", function() {
    escondaB(this);
  }); 

//função para troca de tipo  de cadastro
function escondaA(x){
    if(x.checked) {
        document.getElementById("formUsuario").style.display="none";
        document.getElementById("formONG").style.display="";
    }
}

function escondaB(x){
    if(x.checked) {
        document.getElementById("formONG").style.display="none";
        document.getElementById("formUsuario").style.display="";
    }
}