<?php
$servername = "localhost"; // ou o endereço do seu servidor
$username = "root"; // ou o seu nome de usuário
$password = ""; // ou a senha do banco de dados
$dbname = "seu_banco_de_dados"; // o nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta SQL para selecionar documentos com status 'pendente'
$sql = "SELECT id, nome_aluno, arquivo FROM documentos WHERE status = 'pendente'";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Exibe cada linha de resultado
    while ($row = $result->fetch_assoc()) {
        echo "<div class='documento'>";
        echo "<p>ID do Documento: " . $row['id'] . "</p>";
        echo "<p>Nome do Aluno: " . $row['nome_aluno'] . "</p>";
        echo "<p>Arquivo: <a href='uploads/" . $row['arquivo'] . "'>Ver Documento</a></p>";
        echo "</div>";
    }
} else {
    echo "<p>Nenhum documento pendente encontrado.</p>";
}

// Fecha a conexão
$conn->close();
?>
