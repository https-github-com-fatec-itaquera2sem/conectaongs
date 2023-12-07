document.getElementById('atualizarbtn').addEventListener('click', EditarPermissoes);
function EditarPermissoes() {
    
    const id = document.getElementById('inputID3').value;
    const visibilidade = document.getElementById('inputVisibilidade3').value;
    const interacoes = document.getElementById('inputInteracoes3').value;
    const acessos = document.getElementById('inputAcessos3').value;
    alert("Alterações no id: "+id)
    

    const permissoes = {
        id: id,
        visibilidade: visibilidade,
        interacoes: interacoes,
        acessos: acessos
    };
   
    fetch('/..', {
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

