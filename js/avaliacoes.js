document.getElementById('enviar').addEventListener('click', VerificarConta);

document.addEventListener('estrelasSelecionadas', function(e){
    var numeroEstrelas = e.detail.estrelas;
    console.log("Número de Estrelas recebido:", numeroEstrelas);
    adicionarComentario(numeroEstrelas);
});

logado = true; // Ajustar para receber o status de logado do backend.
function VerificarConta() {
    if (logado == true) {
    } else {
        alert("VOCÊ NÃO ESTÁ LOGADO");
    }
}

function adicionarComentario(numeroEstrelas) {
    var comentario = document.getElementById("comentario").value;

    var novoComentario = document.createElement("div");
    novoComentario.className = "comentario";
    novoComentario.innerHTML = `
        <div class="perfil">
            <img src="img/perfil.png" alt="">
            <div class="user">
            <h1>Novo Usuário</h1>
            <p> ${criarEstrelasVisual(numeroEstrelas)}</p>
            <p>${comentario}</p>
            </div>
        </div>
    `;

    document.getElementById("novosComentarios").appendChild(novoComentario);
    document.getElementById("comentario").value = "";
}

function criarEstrelasVisual(numeroEstrelas) {
    var estrelasVisual = '';
    for (var i = 1; i <= 5; i++) {
        if (i <= numeroEstrelas) {
            estrelasVisual += '★'; 
        } else {
            estrelasVisual += '☆'; 
        }
    }
    return estrelasVisual;
}