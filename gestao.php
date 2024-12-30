<?php

include 'header_esqueci_senha.php';
include 'pagina_restrita.php';


$username = 'root';
$password = 'root';
$dbname = 'login';
$servername = 'localhost';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lista todos os usuários
$sql = "SELECT id, email FROM usuarios";
$result = $conn->query($sql);

// Verifica se existe algum usuário para listar
if ($result->num_rows > 0) {
    // Se o form de exclusão foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_usuario = $_POST['id'];

        // Consulta para excluir o usuário
        $sql = "DELETE FROM usuarios WHERE id = $id_usuario";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário excluído com sucesso";
        } else {
            echo "Erro ao excluir usuário: " . $conn->error;
        }
    }



    if (!isset($_SESSION['user_id'])) {
        header("Location: gestao_permissao.php");
        exit;
    }
    
    echo "Bem-vindo à página de gestão!";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Excluir Funcionários</title>
</head>
<body>
    <h2>Lista de Usuários</h2>
    <table border="1">
        <tr>
            <th>Email</th>
            <th>Excluir</th>
        </tr>
        <?php
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>";
            ?>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                <button type="submit">Excluir</button>
            </form>
            <?php
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    
</body>
</html>
<?php
} else {
    echo "Nenhum usuário encontrado.";
}

$conn->close();
?>