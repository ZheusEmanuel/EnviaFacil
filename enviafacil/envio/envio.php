<?php
$conn = new mysqli('localhost', 'root', '', 'enviafacil');

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_aluno = $_POST['nome_aluno'];
    $arquivo = $_FILES['documento']['name'];
    $destino = "uploads/" . basename($arquivo);

    if (move_uploaded_file($_FILES['documento']['tmp_name'], $destino)) {
        $sql = "INSERT INTO documentos (nome_aluno, arquivo, status) VALUES ('$nome_aluno', '$arquivo', 'pendente')";
        if ($conn->query($sql) === TRUE) {
            echo "Documento enviado com sucesso!";
        } else {
            echo "Erro ao salvar no banco: " . $conn->error;
        }
    } else {
        echo "Erro ao fazer upload do arquivo.";
    }
}

$conn->close();
?>
