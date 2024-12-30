<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>  
    <?php
    include 'pagina_restrita.php';
    include 'header_esqueci_senha.php';


    $username = 'root';
    $password = '';
    $dbname = 'login';
    $servername = 'localhost';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['data_nascimento'])) {
            $email = $_POST['email'];
            $data_nascimento = $_POST['data_nascimento'];

            $sql = "SELECT * FROM usuarios WHERE email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if ($data_nascimento == $row['data_nascimento']) {
                    // Mostra forma para nova senha
                    ?>
                    <h1>Nova Senha</h1>
                    <form method="post">
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <label for="nova_senha">Nova Senha:</label>
                        <input type="password" id="nova_senha" name="nova_senha" required>
                        <button type="submit">Salvar</button>
                    </form>
                    <?php
                } else {
                    echo ('Data de nascimento incorreta.');

                }
            } else {
              echo "<script>alert('Usuário não encontrado.');</script>";
            }
        } else {
            // Atualiza a senha
            $email = $_POST['email'];
            $nova_senha = $_POST['nova_senha'];

            // Hashing da senha (senha é salva no banco em hash)
            $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

            $sql = "UPDATE usuarios SET senha='$nova_senha_hash' WHERE email='$email'";

            if ($conn->query($sql) === TRUE) {
                echo "Senha alterada com sucesso!";
            } else {
                echo "Erro ao alterar a senha: " . $conn->error;
            }
        }
    } else {
        ?>
        <h1>Redefinir Senha</h1>
        <form method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>
            <button type="submit">Continuar</button>
        </form>
        <?php
    }
    ?>
</body>
</html>