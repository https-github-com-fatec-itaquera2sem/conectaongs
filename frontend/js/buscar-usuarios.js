document.getElementById("buscar").addEventListener('click', getUser)
function getUser() {
    const userId = document.getElementById("getUserId").value;

    if (!userId) {
        alert('Informe o ID do usuário');
        return;
    }

    fetch('caminho.backend' + userId, {
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
            if (!data.status) {
                alert('Usuário não encontrado');
                document.getElementById("inpuNome").value = '';
            } else {
                document.getElementById("inpuNome").value = data.usuario.nome;
                document.getElementById("inputEmail").value = data.usuario.email;
                console.log(data); 
            }
        })
        .catch(error => alert('Erro na requisição: ' + error));
}
