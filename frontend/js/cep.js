let Latjs;
let Lngjs;

const inputCep = document.getElementById('cep');
const inputRua = document.getElementById('rua');
const inputCidade = document.getElementById('cidade');

inputCep.addEventListener('blur', () => {
  const cep = inputCep.value;
  const rua = inputRua.value;
  const cidade = inputCidade.value;

  const address = rua + ',' + cidade + ',' + cep;
  updateMap(address);
});

async function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
    // Atualiza os campos com os valores.
    let address = conteudo.logradouro + ',' + conteudo.localidade;

    try {
      let response = await fetch(`https://nominatim.openstreetmap.org/search?q=${address}&format=json&limit=1`);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      let data = await response.json();

      console.log(data);
      Latjs = data[0].lat;
      console.log(Latjs);
      Lngjs = data[0].lon;
      console.log(Lngjs);
      createMap(Latjs, Lngjs);

      document.getElementById('utmy').value = Latjs;
      document.getElementById('utmx').value = Lngjs;
      document.getElementById('rua').value = (conteudo.logradouro);
      document.getElementById('bairro').value = (conteudo.bairro);
      document.getElementById('cidade').value = (conteudo.localidade);
      document.getElementById('uf').value = (conteudo.uf);
      document.getElementById('ibge').value = (conteudo.ibge);
    } catch (error) {
      alert("Erro ao obter Latitude e Longitude");
    }
  } else {
    // CEP não Encontrado.
    limpa_formulário_cep();
    alert("CEP não encontrado.");
  }
}

// function createMap(lat, lng) {
//   mymap = L.map('mapid').setView([lat, lng], 13);
//   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
//     maxZoom: 18
//   }).addTo(mymap);
//   L.marker([lat, lng]).addTo(mymap);
// }

// // Função para atualizar o mapa
// function updateMap(address) {
//   fetch(`https://nominatim.openstreetmap.org/search?q=${address}&format=json&limit=1`)
//     .then(response => {
//       if (!response.ok) {
//         throw new Error('Network response was not ok');
//       }
//       return response.json();
//     })
//     .then(data => {
//       Latjs = data[0].lat;
//       Lngjs = data[0].lon;
//       document.getElementById('utmy').value = Latjs;
//       document.getElementById('utmx').value = Lngjs;
//       if (mymap) {
//         mymap.remove();
//       }
//       createMap(Latjs, Lngjs);
//     })
//     .catch(error => {
//       console.error(error);
//     });
// }

function limpa_formulário_cep() {
  //Limpa valores do formulário de cep.
  document.getElementById('rua').value = ("");
  document.getElementById('bairro').value = ("");
  document.getElementById('cidade').value = ("");
  document.getElementById('uf').value = ("");
  document.getElementById('ibge').value = ("");
}

function meu_callback(conteudo) {
if (!("erro" in conteudo)) {
     //Atualiza os campos com os valores.
     document.getElementById('rua').value = (conteudo.logradouro);
     document.getElementById('bairro').value = (conteudo.bairro);
     document.getElementById('cidade').value = (conteudo.localidade);
     document.getElementById('ibge').value = (conteudo.ibge);
     document.getElementById('uf').value = (conteudo.uf);

   } //end if.
   else {
     //CEP não Encontrado.
     limpa_formulário_cep();
     alert("CEP não encontrado.");
   }
 }

function pesquisacep(valor) {

  //Nova variável "cep" somente com dígitos.
  var cep = valor.replace(/\D/g, '');

  //Verifica se campo cep possui valor informado.
  if (cep != "") {

    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if (validacep.test(cep)) {

      //Preenche os campos com "..." enquanto consulta webservice.
      document.getElementById('rua').value = "...";
      document.getElementById('bairro').value = "...";
      document.getElementById('cidade').value = "...";
      document.getElementById('uf').value = "...";
      document.getElementById('ibge').value = "...";

      var requestOptions = {
        method: 'GET',
        redirect: 'follow'
      };

      fetch("https://viacep.com.br/ws/" + cep + "/json/", requestOptions)
        .then(response => {

          //se a resposta for diferente de ok
          if (!response.ok) {
            //lança um erro
            throw new Error('Network response was not ok');
          }
          //senão retorna a resposta em Json
          return response.json();
        })
        .then(data => meu_callback(data))
        .catch(error => console.log('error', error));

    } //end if.
    else {
      //cep é inválido.
      limpa_formulário_cep();
      alert("Formato de CEP inválido.");
    }
  } //end if.
  else {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep();
  }
};
