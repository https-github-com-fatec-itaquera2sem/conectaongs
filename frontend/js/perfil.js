document.addEventListener("DOMContentLoaded", function() {

const link1 = document.querySelector('.linka1');
const link2 = document.querySelector('.linka2');
const link3 = document.querySelector('.linka3');
const link4 = document.querySelector('.linka4');

link1.addEventListener("click", troca);
link2.addEventListener("click", troca);
link3.addEventListener("click", troca);

function troca() {
    const divSobre = document.getElementById('sobre');
    const divValores = document.getElementById('valores');
    const divAvaliacoes = document.getElementById('avaliacoes');

    // link1.style.borderLeft = "solid 3px #00ADFF";
    divSobre.style.display = "none";
    divValores.style.display = "none";
    divAvaliacoes.style.display = "none";

    if (this === link1) {
        divSobre.style.display = "flex";

        link1.style.borderLeft = "solid 3px #00ADFF";
        link1.style.backgroundColor = "gray";
        link1.style.color = "white";

        link2.style.borderLeft = "solid 3px transparent";
        link2.style.backgroundColor = "transparent";
        link2.style.color = "black";

        link3.style.borderLeft = "solid 3px transparent";
        link3.style.backgroundColor = "transparent";
        link3.style.color = "black";

        link4.style.borderLeft = "solid 3px transparent";
        link4.style.backgroundColor = "transparent";
        link4.style.color = "black";

    } else if (this === link2) {
        divValores.style.display = "flex";

        link1.style.borderLeft = "solid 3px transparent";
        link1.style.backgroundColor = "transparent";
        link1.style.color = "black";

        link2.style.borderLeft = "solid 3px #00ADFF";
        link2.style.backgroundColor = "gray";
        link2.style.color = "white";

        link3.style.borderLeft = "solid 3px transparent";
        link3.style.backgroundColor = "transparent";
        link3.style.color = "black";

        link4.style.borderLeft = "solid 3px transparent";
        link4.style.backgroundColor = "transparent";
        link4.style.color = "black";

    } else if (this === link3) {
        divAvaliacoes.style.display = "flex";
        link1.style.borderLeft = "solid 3px transparent";
        link1.style.backgroundColor = "transparent";
        link1.style.color = "black";

        link2.style.borderLeft = "solid 2px transparent";
        link2.style.backgroundColor = "transparent";
        link2.style.color = "black";

        link3.style.borderLeft = "solid 3px #00ADFF";
        link3.style.backgroundColor = "gray";
        link3.style.color = "white";

        link4.style.borderLeft = "solid 3px transparent";
        link4.style.backgroundColor = "transparent";
        link4.style.color = "black";

    }
}
});