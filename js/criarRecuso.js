document.getElementById('criarecursobtn').addEventListener('click', criarRecurso);
function criarRecurso() {
    const nomeRecurso = document.getElementById('inputNome').value;
    const descricaoRecurso = document.getElementById('inputDesc').value;
    const quantidadeRecurso = document.getElementById('inputQnt').value;
    const situacaoRecurso = document.getElementById('inputSitu').value;
    const nomeOngRecurso = document.getElementById('inputnomeOng').value;
    

    //Pop-up para várias ocasiões em caso de algum espaço não estar preenchido
    if (!nomeRecurso || !descricaoRecurso || !quantidadeRecurso || !situacaoRecurso) {
        alert("Preencha os campos");

        return;
    } 

    const recurso = {
        nome: nomeRecurso,
        descricao: descricaoRecurso,
        quantidade_disponivel: quantidadeRecurso,
        situacao_recurso: situacaoRecurso,
        id_ong: nomeOngRecurso,
        id_usuario:1
    };

    fetch('http://localhost/backend/recurso', {
        method: 'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify(recurso)
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error('Não autorizado');
            } else {
                throw new Error('Sem rede ou não conseguiu localizar o recurso');
            }
        }
        return response.json();
    })
    .then(data => {
        if(!data.status){
            alert('Recurso já existe')
        }else{
            alert("Recurso criado");
        }
    })
    .catch(error => alert('Erro na requisição: ' + error));
}