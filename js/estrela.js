var stars = document.querySelectorAll('.star-icon');
var numeroEstrelasSelecionadas = 0;
var estrelasAtivas = true;

document.addEventListener('click', function (e) {
    if (estrelasAtivas) {
        var classStar = e.target.classList;
        if (!classStar.contains('ativo')) {
            stars.forEach(function (star) {
                star.classList.remove('ativo');
            });
            classStar.add('ativo');
            numeroEstrelasSelecionadas = e.target.getAttribute('data-avaliacao');

        }
    }
});

document.getElementById('enviar').addEventListener('click', function () {
    if (numeroEstrelasSelecionadas > 0) {
        var evento = new CustomEvent('estrelasSelecionadas', { detail: { estrelas: numeroEstrelasSelecionadas } });
        document.dispatchEvent(evento);
    } else {
        alert("Selecione pelo menos uma estrela antes de enviar o comentário.");
    }
});

