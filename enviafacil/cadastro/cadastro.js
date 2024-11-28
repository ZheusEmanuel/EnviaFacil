document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    form.addEventListener("submit", (event) => {
        // Pega os valores dos campos
        const nome = document.getElementById("nome").value.trim();
        const sobrenome = document.getElementById("sobrenome").value.trim();
        const email = document.getElementById("email").value.trim();
        const matricula = document.getElementById("matricula").value.trim();

        // Validação básica
        if (!nome || !sobrenome || !email || !matricula) {
            event.preventDefault();
            alert("Todos os campos são obrigatórios!");
            return;
        }

        // Validação do email
        if (!validateEmail(email)) {
            event.preventDefault();
            alert("Por favor, insira um e-mail válido!");
            return;
        }

        // Matrícula apenas com números (exemplo)
        if (!/^\d+$/.test(matricula)) {
            event.preventDefault();
            alert("A matrícula deve conter apenas números!");
            return;
        }

        // Exibe uma mensagem de sucesso (opcional)
        alert("Cadastro realizado com sucesso!");
    });

    // Função para validar e-mail
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
