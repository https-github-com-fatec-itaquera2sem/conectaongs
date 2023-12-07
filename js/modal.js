document.addEventListener("DOMContentLoaded", function () {
    const openModalButton = document.getElementById("openModal");
    const modal = document.querySelector(".modal");
    const closeModalButton = document.getElementById("closeModal");
    const form = document.getElementById("solicitarRecursos");
    const requireButton = document.getElementById("requireButton");

    function openModal() {
        modal.style.display = "block";
    }

    function closeModal() {
        modal.style.display = "none";
    }

    function validateAndSubmit(event) {
        event.preventDefault();

        const userName = form.querySelector('input[name="user"]').value;
        const userEmail = form.querySelector('input[name="email"]').value;
        const userRequest = form.querySelector('input[name="request"]').value;

        if (!userName || !userEmail || !userRequest) {
            alert("Por favor, preencha todos os campos.");
        } else {
            const formData = {
                user: userName,
                email: userEmail,
                request: userRequest,
            };

            // Teste para salvar informações na memória local (remover depois)
            localStorage.setItem("formData", JSON.stringify(formData));

            // Fetch para enviar dados ao backend (substitua "..//" pelo caminho correto depois)
            fetch("..//", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(formData),
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error("Erro ao enviar dados:", error);
                });

            alert("Formulário enviado com sucesso!");
            closeModal();
        }
    }

    openModalButton.addEventListener("click", openModal);
    closeModalButton.addEventListener("click", closeModal);
    requireButton.addEventListener("click", validateAndSubmit);
});