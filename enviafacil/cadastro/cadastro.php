<?php
// Exibir erros no PHP (desenvolvimento apenas!)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = ""; // Substitua se necessário
$dbname = "enviafacil";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "enviafacil");

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST["matricula"];
    $senha = $_POST["senha"];

    // Consultar o banco de dados
    $sql = "SELECT senha, tipo FROM usuarios WHERE matricula = '$matricula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Verificar a senha
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row["senha"])) {
            $tipoUsuario = $row["tipo"];
            
            if ($tipoUsuario == 'cra') {
                // Redirecionar CRA para página de administrador
                header("Location: admin.html");
                exit;
            } else {
                // Redirecionar usuário normal
                header("Location: home.html");
                exit;
            }
        } else {
            echo "<script>alert('Senha incorreta!');</script>";
        }
    } else {
        echo "<script>alert('Matrícula não encontrada!');</script>";
    }
}


// Fechar conexão
$conn->close();
?>
