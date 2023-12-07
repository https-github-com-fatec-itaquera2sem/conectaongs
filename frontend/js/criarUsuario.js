document.getElementById('botaoCadastro').addEventListener('click', criarUsuario);
function criarUsuario() {
    const nomeUsuario = document.getElementById('nome').value;
    const emailUsuario = document.getElementById('email').value;
    const senhaUsuario = document.getElementById('senha').value;
    const conf_senhaUsuario = document.getElementById('conf_senha').value;
    const categoria = "USUARIO"
    //Pop-up para várias ocasiões em caso de algum espaço não estar preenchido
    if (!nomeUsuario || !emailUsuario || !senhaUsuario || !conf_senhaUsuario) {
        let mensagem = "Preencha os campos ";
        if (!nomeUsuario) mensagem += "de nome, ";
        if (!emailUsuario) mensagem += "de email, ";
        if (!senhaUsuario) mensagem += "de senha, ";
        if (!conf_senhaUsuario) mensagem += "de confirmação de senha, ";
        mensagem = mensagem.slice(0, -2); // Remove a vírgula final
        alert(mensagem + " para realizar o cadastro.");
        return;
    } 

    //Chamada das funções para caso a senha ou CNPJ não seja válido

    if (senhaUsuario != conf_senhaUsuario){
        alert("As senhas não coincidem.");
        return;
    }

    if (!aSenhaEhValida(senhaUsuario)) {
        alert("A senha deve conter no mínimo 6 caracteres alfanuméricos e caracteres especiais.");
        return;
    }

    const usuario = {
        nome: nomeUsuario,
        email: emailUsuario,
        senha: senhaUsuario,
    };

    fetch('/..', {
        method: 'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify(usuario)
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
            alert('Usuário já existe')
        }else{
            alert("Usuário criado");
        }
    })
    .catch(error => alert('Erro na requisição: ' + error));

    //Funções para validação de senha
    function aSenhaEhValida(senha) {
        return /^(?=.*[a-zA-Z0-9])/.test(senha) && senha.length >= 6;
    }
}