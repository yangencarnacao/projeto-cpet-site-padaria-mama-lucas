<?php
include('header.php');

$username = 'root';
$password = 'root';
$dbname = 'login';
$servername = 'localhost';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o form foi enviado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepared statement para evitar SQL injection
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row['senha'])) {
            // Login bem-sucedido
            session_start();
            $_SESSION['usuario_logado'] = true;
            header("Location: administrativo.php");
            exit();
        } else {
            echo "Email ou senha inválidos";
        }
    } else {
        echo "Usuário não encontrado";
    }
}



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <main>
    <h1>Acesse sua conta</h1>
    <form action="" method="POST">
      <div class="form-group"> <label for="email">E-mail</label>
        <input type="text" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha">
      </div>
      <div class="form-group">
        <button type="submit">Entrar</button>
      </div>
    </form>
      </form>
  </main>
  <?php include('footer.php'); ?> </body>
</html>
