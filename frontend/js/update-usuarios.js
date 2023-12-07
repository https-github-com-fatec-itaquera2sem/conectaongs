document.getElementById("update").addEventListener('click', updateUser)
function updateUser() {
    const userId = document.getElementById("getUserId").value;
    const userName = document.getElementById("inpuNome").value;
    const userEmail = document.getElementById("inputEmail").value;
    const usuarioAtualizado = {
        nome: userName,
        email: userEmail
    };

    fetch('caminho.backend' + userId, { 
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuarioAtualizado)
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
            console.log("Usuário atualizado: " + JSON.stringify(data));
            alert("Usuário atualizado"); 
        } 
    })
    .catch(error => alert('Erro na requisição: ' + error));
}
