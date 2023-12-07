document.getElementById("delete").addEventListener('click', deleteUser)
    function deleteUser() {
        const userId = document.getElementById("getUserId").value;

        if (!userId) {
            alert('Informe o ID do usuário');
            return;
        }

        fetch('caminho.beckend' + userId, {
            method: 'DELETE',
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
                alert("Não é possível deletar");
                document.getElementById("inpuNome").value = '';
            }else{
                alert("Usuário deletado");
                document.getElementById("inpuNome").value = data.usuario.nome; 
                document.getElementById("inputEmail").value = ''; 
            }
            })
            .catch(error => alert('Erro na requisição: ' + error));
    }