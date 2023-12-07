document.addEventListener("DOMContentLoaded", function() {


const link2 = document.querySelector('.linka2');
const link3 = document.querySelector('.linka3');


link2.addEventListener("click", troca);
link3.addEventListener("click", troca);

function troca() {

    const divValores = document.getElementById('valores');
    const divAvaliacoes = document.getElementById('avaliacoes');

    // link1.style.borderLeft = "solid 3px #00ADFF";

    divValores.style.display = "none";
    divAvaliacoes.style.display = "none";

   if (this === link2) {
        divValores.style.display = "flex";

        link2.style.borderLeft = "solid 3px #00ADFF";
        link2.style.backgroundColor = "gray";
        link2.style.color = "white";

        link3.style.borderLeft = "solid 3px transparent";
        link3.style.backgroundColor = "transparent";
        link3.style.color = "black";

    } else if (this === link3) {
        divAvaliacoes.style.display = "flex";

        link2.style.borderLeft = "solid 2px transparent";
        link2.style.backgroundColor = "transparent";
        link2.style.color = "black";

        link3.style.borderLeft = "solid 3px #00ADFF";
        link3.style.backgroundColor = "gray";
        link3.style.color = "white";

    }
}
});