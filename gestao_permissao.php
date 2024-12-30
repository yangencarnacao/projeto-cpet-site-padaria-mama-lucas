<?php
require_once 'config_gestao_permisssao.php';
include 'header_painel.php';

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Limpa caracteres especiais e previne XSS
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST['email']);
    $senha = sanitize_input($_POST['senha']);

    // Evita SQL injection
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row['senha']) && $row['ativo'] == 1) {
            session_start();

            session_regenerate_id(true);
            ini_set('session.cookie_secure', 1);
            ini_set('session.cookie_httponly', 1);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];

            if ($_SESSION['user_email'] === EMAIL_AUTORIZADO) {
                header("Location: gestao.php");
                exit;
            } else {
                echo "Você não tem permissão para acessar esta página.";
            }
        } else {
            echo "Você não tem permissão para acessar esta página.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Permitir Acesso Gestão de Funcionários</title>
</head>
<body>
    <h2>Login | Gestão de Funcionários</h2>
    <form method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>