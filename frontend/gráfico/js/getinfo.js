function displayONGs(data) {
  let legendas = [];
  let valores = [];
  const recursos = data.recursos;
  recursos.forEach(ong=> {
    legendas.push(ong.recursosONG);
    valores.push(ong.quantidade_ong);
  });
  const barColors = ["red", "green","blue","orange","brown"];
  new Chart("myChart", {
      // type: "bar",
      type: "pie",
      data: {
      labels: legendas,
      datasets: [{
          backgroundColor: barColors,
          data: valores
      }]
      },
      options: {
          legend: {display: false},
          title: {
              display: true,
              text: "Idades cadastradas"
          }
      }
  });
}

function getRecursosList(){
  fetch('', {
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
    displayUsers(data);
})
.catch(error => alert('Erro na requisição: ' + error));
}
getIdadeList();
