document.getElementById('buscarbtn').addEventListener('click', buscarOng);
function buscarOng() {
    const OngId = document.getElementById("inputID").value;
    fetch('../JSON/ong.json', {
        method: 'GET'
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
        console.log(data)
        
            document.getElementById("inputNome").value = data.usuario.inputNome; 
            document.getElementById("inputEmail").value = data.usuario.inputEmail;
            document.getElementById("inputCNPJ").value = data.usuario.inputCNPJ;

            // campos do formulario de ong
        
       
    })
    .catch(error => alert('Erro na requisição: ' + error));
}