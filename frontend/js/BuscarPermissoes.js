document.getElementById('buscarbtn').addEventListener('click', buscarPermissoes);

function check(idcheck) {
    document.getElementById(idcheck).checked = true;
}

function uncheck(idcheck) {
    document.getElementById(idcheck).checked = false;
} 

function buscarPermissoes() {
    const id_usuario = document.getElementById("id_user").value;
    
    fetch('/js/JSON/permissoes.json', {
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
        console.log(data.users)
            document.getElementById("nomeUser").value = data.users[id_usuario-1].nomeUser;
            document.getElementById("emailUser").value = data.users[id_usuario-1].emailUser;
            var acesso_user = data.users[id_usuario-1].acessoUser;
            console.log(acesso_user);
            if(acesso_user == "adm"){
                uncheck("comum")
                check("adm");
            }
            if(acesso_user == "comum"){
                uncheck("adm")
                check("comum");
            }

    })
    .catch(error => alert('Erro na requisição: ' + error));

}
