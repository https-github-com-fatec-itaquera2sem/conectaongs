function loginUsuario() {
  const loginUsuario = document.getElementById("email").value;
  fetch('/...?id=' + loginUsuario, {
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
      if(!data.status){
        alert('Usuário não encontrado') 
        document.getElementById("inputEmail").value = ''; 
      }else{
        document.getElementById("inputEmail").value = data.usuario.email;
      }
  })
  .catch(error => alert('Erro na requisição: ' + error));
}