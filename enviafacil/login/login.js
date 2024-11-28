document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const errorMessage = document.getElementById("error-message");

    form.addEventListener("submit", (event) => {
        // Pega os valores dos campos
        const matricula = document.getElementById("matricula").value.trim();
        const senha = document.getElementById("senha").value.trim();

        // Validação básica
        if (!matricula || !senha) {
            event.preventDefault();
            showErrorMessage("Por favor, preencha todos os campos.");
            return;
        }

        // Exibe uma mensagem de sucesso ou prossegue com o envio do formulário
        alert("Login enviado!");
    });

    // Função para exibir mensagens de erro
    function showErrorMessage(message) {
        errorMessage.textContent = message;
        errorMessage.style.display = "block";
    }
});
