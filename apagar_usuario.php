<?php
$username = 'root';
$password = 'root';
$dbname = 'login';
$servername = 'localhost';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_GET['email'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Se o form foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $novoEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (!filter_var($novoEmail, FILTER_VALIDATE_EMAIL)) {
            echo "Email inválido.";
            exit;
        }

        // Verifica se o novo email já existe
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $novoEmail);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            echo "Email já cadastrado.";
            exit;
        }

        // Atualiza dados do usuário
        $sql = "UPDATE usuarios SET email = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $novoEmail, $email);
        $stmt->execute();

        header("Location: listar_usuarios.php");
        exit;
    } else {
        
    }
} else {
    echo "Usuário não encontrado.";
}

$conn->close();
?>