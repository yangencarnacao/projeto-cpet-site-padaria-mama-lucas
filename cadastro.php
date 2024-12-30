<?php
include 'pagina_restrita.php';

$username = 'root';
$password = 'root';
$dbname = 'login';
$servername = 'localhost';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $data_nascimento = $_POST['data_nascimento']; 
  
  $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo "<script>alert('Funcionário já existe!');</script>";
  } else {
    // Insere novo usuário
    $stmt = $conn->prepare("INSERT INTO usuarios (email, senha, data_nascimento) VALUES (?, ?, ?)");
    $hashed_password = password_hash($senha, PASSWORD_DEFAULT);
    $stmt->bind_param("sss", $email, $hashed_password, $data_nascimento); 
    $stmt->execute();

    echo "<script>alert('Funcionário cadastrado com sucesso!');</script>";
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Cadastro Funcionários</title>
  <script src="validaSenha.js"></script> 
</head>
<header>
  <nav>
    <ul>
      <li><a href="logout.php">Sair</a></li>
      <li><a href="administrativo.php">Administrativo</a></li>
    </ul>
  </nav>
</header>
<body>
  <h1>Cadastro do Funcionário</h1>
  <form action="" method="POST" onsubmit="return validarSenha()"> 
    <p>
      <label for="email">E-mail</label>
      <input type="email" name="email" id="email">
    </p>
    <p>
      <label for="senha">Senha</label>
      <input type="password" name="senha" id="senha">
    </p>
    <p> <label for="data_nascimento">Data de Nascimento</label>
      <input type="date" name="data_nascimento" id="data_nascimento">
    </p>
    <p>
      <a href="esqueci_senha.php">Esqueci minha senha</a>
    </p>
    <p>
      <button type="submit">Entrar</button>
    </p>
  </form>

  <style>
    a[href="#"] {
      color: #333;
      text-decoration: underline; 
    }
  </style>

</body>
</html>