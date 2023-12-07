document.getElementById('botaoCadastroOng').addEventListener('click', criarOng);
function criarOng() {
    const nomeOng = document.getElementById('nomeOng').value;
    const cnpjOng = document.getElementById('cnpjOng').value;
    const emailOng = document.getElementById('emailOng').value;
    const senhaOng = document.getElementById('senhaOng').value;
    const conf_senhaOng = document.getElementById('conf_senhaOng').value;
    //Pop-up para várias ocasiões em caso de algum espaço não estar preenchido
    if(!nomeOng || !cnpjOng || !emailOng || !senhaOng || !conf_senhaOng){
        let mensagem = "Preencha os campos ";
        if (!nomeOng) mensagem += "de nome, ";
        if (!cnpjOng) mensagem += "de CNPJ, ";
        if (!emailOng) mensagem += "de email, ";
        if (!senhaOng) mensagem += "de senha, ";
        if (!conf_senhaOng) mensagem += "de confirmação de senha, ";
        mensagem = mensagem.slice(0, -2); // Remove a vírgula final
        alert(mensagem + " para realizar o cadastro.");
        return;
     
    }

    //Chamada das funções para caso a senha ou CNPJ não seja válido

    if (senhaOng != conf_senhaOng){
        alert("As senhas não coincidem.");
        return;
    }

    if (!aSenhaEhValida(senhaOng)) {
        alert("A senha deve conter no mínimo 6 caracteres alfanuméricos e caracteres especiais.");
        return;
    }

    if(oCNPJehValido(cnpjOng)){
        alert("O CNPJ não é válido.");
        return;
    }

    const ong = {
        nome: nomeOng,
        cpnj: cnpjOng,
        email: emailOng,
        senha: senhaOng,
    };

    fetch('/..', {
        method: 'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify(ong)
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


    //Funções para validação de senha e CNPJ
    function aSenhaEhValida(senha) {
        return /^(?=.*[a-zA-Z0-9])/.test(senha) && senha.length >= 6;
    }

    function oCNPJehValido(cnpj) {
        return /^(?=.*[0-9])/.test(cnpj) && cnpj.length != 14;
    }
}