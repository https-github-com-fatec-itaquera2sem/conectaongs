document.getElementById("botaoEntrar").addEventListener('click', function (){
  const token = localStorage.getItem('token');
  const loginEmail = document.getElementById('email').value;
  const loginSenha = document.getElementById('senha').value;
  console.log(`Email: ${loginEmail} Senha: ${loginSenha}`);
  if(!loginEmail || !loginSenha) {
    let mensagem = "Preencha os campos ";
    if (!loginEmail) mensagem += "de email, ";
    if (!loginSenha) mensagem += "de senha, ";
    mensagem = mensagem.slice(0, -2); // Remove a vírgula final
    alert(mensagem + " para realizar o cadastro.");
    return;
  }

  const loginBody = {
    email: loginEmail,
    senha: loginPassword,
};

fetch('/backend/login.php', { 
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': token, 
    },
    body: JSON.stringify(loginBody)
})
.then(response => {
    if (!response.ok) {
        if (response.status === 401) {
            throw new Error('Nao autorizado');
        } else {
            throw new Error('Sem rede ou nao conseguiu localizar o recurso');
        }
    }
    return response.json();
})
.then(data => {
    if (data.token){
      localStorage.setItem('token', data.token)
      alert("Login efetuado com sucesso");
      window.location.href = './';
    } else {
      alert("Login não efetuado");
    } 
    
})
.catch(error => alert('Erro na requisicao: ' + error));
});
