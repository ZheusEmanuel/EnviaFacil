<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enviafacil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $conn->real_escape_string($_POST['email']);

    // Verificar se o email existe no banco de dados
    $sql = "SELECT id FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Gerar uma nova senha aleatória
        $nova_senha = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 8);
        $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

        // Atualizar a senha no banco
        $update_sql = "UPDATE usuarios SET senha = '$senha_hash' WHERE email = '$email'";
        if ($conn->query($update_sql) === TRUE) {
            echo "Sua nova senha é: <strong>$nova_senha</strong>";
        } else {
            echo "Erro ao atualizar a senha: " . $conn->error;
        }
    } else {
        echo "E-mail não encontrado.";
    }
}

$conn->close();
?>
