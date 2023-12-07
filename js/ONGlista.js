const urlParams = new URLSearchParams(window.location.search);
const idDaURL = urlParams.get('id');

document.addEventListener("DOMContentLoaded", async function() {


 
    fetch('http://localhost/backend/ong?id='+idDaURL)
      .then((response) => response.json())
      .then((listaongs) => {
       exibirOng(listaongs);
      });
      const exibirOng = (dadoOng) => {
        document.getElementById("nomeong").innerText=dadoOng.Ong.nome
        document.getElementById("emailong").innerText=dadoOng.Ong.email
        
    };
    fetch('http://localhost/backend/ong/recurso?id='+idDaURL)
    .then((response) => response.json())
    .then((recursosOng)=>{
      const recursos = recursosOng.Ong;
      recursos.forEach(Recurso => {
        const Registro = Recurso[0];
        const container = document.getElementById("recursosong");

        const ListaRecurso = document.createElement("ul");
        const ItemNomeRecurso = document.createElement("h2")
        ItemNomeRecurso.innerText = `Nome: ${Registro.nome}  `
        const ItemDescricaoRecurso = document.createElement("li")
        ItemDescricaoRecurso.innerText = `Descrição: ${Registro.descricao} `
        const ItemQuantidadeRecurso = document.createElement("li")
        ItemQuantidadeRecurso.innerText = `Quantidade disponivel: ${Registro.quantidade_disponivel} `
        const ItemSituacaoRecurso = document.createElement("li")
        ItemSituacaoRecurso.innerText = `Situação recurso: ${Registro.situacao_recurso} `
        ListaRecurso.appendChild(ItemNomeRecurso);
        ListaRecurso.appendChild(ItemDescricaoRecurso);
        ListaRecurso.appendChild(ItemQuantidadeRecurso);
        ListaRecurso.appendChild(ItemSituacaoRecurso);
        container.appendChild(ListaRecurso);
      });
    })
    fetch('http://localhost/backend/ong/avaliacao?id='+idDaURL)
    .then((response) => response.json())
    .then((avaliacaoOng)=>{
      const avaliacoes = avaliacaoOng.Ong;
      avaliacoes.forEach(avaliacao => {
        
      });
      console.log(avaliacaoOng);
    });
    /* <div class="perfil">
                        <img src="img/perfil.png" alt="">
                        <div class="user">
                            <h1>Luis Carvalho</h1>
                            <p>Lorem ipsum dolor sit amet, 
                                consectetur adipisicing elit. </p>
                        </div>
                    </div> */
});

