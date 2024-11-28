<?php
$mysqli = new mysqli("localhost", "root", "", "enviafacil");

// Verifica a conexão
if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}

// Receber dados do formulário
$matricula = $_POST['matricula']; // Campo para matrícula
$senha = $_POST['senha'];

// Consulta ao banco
$query = "SELECT * FROM alunos WHERE matricula = '$matricula'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($senha, $user['senha'])) { // Verifica a senha
        echo "Login bem-sucedido! Bem-vindo, " . $user['nome'];
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Usuário não encontrado.";
}
?>
