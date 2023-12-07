document.getElementById('excluirbtn').addEventListener('click', ExcluirPermissoes);
function ExcluirPermissoes() {
    const id = document.getElementById('inputID3').value;
    const visibilidade = null;
    const interacoes = null;
    const acessos = null;
    alert("As permissões do id: "+ id + " foram excluidas");
    const permissoes = {
        id: id,
        visibilidade: visibilidade,
        interacoes: interacoes,
        acessos: acessos
    };

    fetch('', {
        method: 'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify(permissoes)
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
}