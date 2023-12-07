document.addEventListener("DOMContentLoaded", async function () {
  let equipes = {};
  await fetch('http://localhost/backend/ong', {
    method: 'GET'
  })
    .then(response => { return response.json(); })
    .then(data => { equipes = data.OngList; })
  console.log(equipes)
  const timesContainer = document.querySelector("#time");
  timesContainer.classList.add("row");
  equipes.forEach(projeto => {
    const cardcoluna = document.createElement("div");
    cardcoluna.classList.add("column");
    const container = document.createElement("div");
    container.classList.add("card");

// -----------------(implementado 07/12)-----------------

    timesContainer.style.marginTop = "2rem";
    timesContainer.style.display = "grid";
    timesContainer.style.gridTemplateColumns = "auto auto auto auto auto auto";
    timesContainer.style.justifyContent = "center";
    timesContainer.style.textAlign = "center";
    timesContainer.style.flexDirection = "row";

    container.style.margin = "1rem";
    container.style.backgroundColor = "#238ef1";
    container.style.width = "16rem";
    container.style.height = "20rem";
    container.style.borderRadius = "1.875rem";


    container.innerHTML = `
        <div class="container" >
        <h3>${projeto.nome}</h3>
        <p>${projeto.email}</p>
        </div>
      `;
// -----------------(fim da implementação)-----------------
    container.setAttribute('data-id', projeto.id_ong);
    container.addEventListener("click", () => {
      let cardID = container.getAttribute('data-id');
      window.location.href = 'perfilOng.html?id=' + cardID
    });
    cardcoluna.appendChild(container);
    timesContainer.appendChild(cardcoluna);
  });
});