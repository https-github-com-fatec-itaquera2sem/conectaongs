document.getElementById('salvarbtn').addEventListener('click', CadastrarPermissoes);
function CadastrarPermissoes() {
    const id_usuario = document.getElementById("id_user").value;
    var acessoUser = "none";
    if(document.getElementById("adm").checked == true && document.getElementById("comum").checked == true ){
        alert("Voce nao pode marcar as duas opções de acesso")
        return;
    }

    if(document.getElementById("comum").checked == true){
        acessoUser = "comum"
    }
    if(document.getElementById("adm").checked == true){
        acessoUser = "adm"
    }
    const permissoes = {
        id: id_usuario,
        acesso: acessoUser
    };
    fetch('/js/JSON/permissoes.json', {
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
    .then(data => {
            console.log(permissoes)
            
    })
    .catch(error => alert('Erro na requisição: ' + error));
}