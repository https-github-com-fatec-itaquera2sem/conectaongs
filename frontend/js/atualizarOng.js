document.getElementById('atualizarbtn').addEventListener('click', atualizarOng);
function atualizarOng() {
    const OngId = document.getElementById("inputID").value;
    const OngName = document.getElementById("inputNome").value;
    const cnpjOng = document.getElementById('inputCNPJ').value;
    const emailOng = document.getElementById('inputEmail').value;
    // Campos que serão atualizados
    
    const OngAtualizado = {
        nome: OngName,
        cnpj: cnpjOng,
        email: emailOng
    };

    fetch('/backend/...php?id=' + OngId, { 
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(OngAtualizado)
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
            alert("Não pode atualizar: ");
        }else{
            alert("Ong atualizada: " + JSON.stringify(data));

        } 
        
    })
    .catch(error => alert('Erro na requisição: ' + error));
}