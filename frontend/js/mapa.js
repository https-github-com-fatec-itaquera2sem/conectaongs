function criarMarcadores(mapa) {
  fetch("js/JSON/locais.json")
    .then((response) => response.json())
    .then((data) => {
      data.locais.forEach((local) => {
        const marker = L.marker([local.latitude, local.longitude]).addTo(mapa);
        marker.bindPopup(`<b>${local.nome}</b><br>${local.cidade}`);
      });
    })
    .catch((error) => console.error("Error loading location data:", error));
}

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  console.log(position.coords.latitude);
  console.log(position.coords.longitude);
  const mapa = L.map("mapid").setView(
    [position.coords.latitude, position.coords.longitude],
    13
  );
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 18,
  }).addTo(mapa);

  const eu = L.marker([
    position.coords.latitude,
    position.coords.longitude,
  ]).addTo(mapa);
  eu.bindPopup(`<b>Estou</b><br>Aqui`);
  const c5 = L.circle([position.coords.latitude, position.coords.longitude], {
    color: "green",
    fillColor: "#eee",
    fillOpacity: 0.5,
    radius: 5000,
  }).addTo(mapa);
  c5.bindPopup(`<b> raio 5 km</b>`);
  const c3 = L.circle([position.coords.latitude, position.coords.longitude], {
    color: "green",
    fillColor: "#eeff",
    fillOpacity: 0.5,
    radius: 3000,
  }).addTo(mapa);
  c3.bindPopup(`<b> raio 3 km</b>`);
  const c = L.circle([position.coords.latitude, position.coords.longitude], {
    color: "red",
    fillColor: "#f03",
    fillOpacity: 0.5,
    radius: 1000,
  }).addTo(mapa);
  c.bindPopup(`<b> raio 1 km</b>`);
  criarMarcadores(mapa);
}

function showError(error) {
  alert(`Geolocation error: ${error.message}`);
}

getLocation();
