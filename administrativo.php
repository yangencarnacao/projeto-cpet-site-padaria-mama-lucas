<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mama Lucas | Sobre</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php 
    include 'header_painel.php';
    include 'pagina_restrita.php';






$conn = mysqli_connect('localhost', 'root', 'root', 'padaria');
if (!$conn) {
    die('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
}


// Busca todos os produtos
function getProdutos($conn) {
    $sql = 'SELECT * FROM produtos';
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Inser ou atualiza produto
function salvarProduto($conn, $produto) {
    $id = $produto['id'];
    $nome = $produto['nome'];
    $categoria = $produto['categoria'];
    $preco = $produto['preco'];

    if ($id) {
        $sql = "UPDATE produtos SET nome='$nome', categoria='$categoria', preco=$preco WHERE id=$id";
        $message = "Produto atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO produtos (nome, categoria, preco) VALUES ('$nome', '$categoria', $preco)";
        $message = "Produto adicionado com sucesso!";
    }

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('$message');</script>";
    } else {
        echo "<script>alert('Erro ao salvar o produto.');</script>";
    }
}

// Exclui produto
function excluirProduto($conn, $id) {
    $sql = "DELETE FROM produtos WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Produto excluído com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao excluir o produto.');</script>";
    }
}

// Processa o form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir'])) {
        $idExcluir = $_POST['excluir'];
        excluirProduto($conn, $idExcluir);
    } else {
        $produto = [
            'id' => $_POST['id'],
            'nome' => $_POST['nome'],
            'categoria' => $_POST['categoria'],
            'preco' => $_POST['preco']
        ];
        salvarProduto($conn, $produto);
    }
}

// Lista os produtos
$produtos = getProdutos($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Edição de Produtos</title>
</head>
<body>
    <h1>Cadastro e Edição de Produtos</h1>

    <form method="POST">
    <input type="hidden" name="id" value="">
    Nome: <input type="text" name="nome" required><br>
    Categoria: <input type="text" name="categoria" required><br>
    Preço: <input type="number" step="0.01" name="preco" required><br>
    <input type="submit" value="Salvar">
    </form>

    <h2>Produtos Cadastrados:</h2>    
    <ul>
        <?php foreach ($produtos as $produto) : ?>
            <li class="product-item">
    <span class="product-name" id="product-name-<?= $produto['id'] ?>"><?= $produto['nome'] ?></span>
    <span class="product-category">(<?= $produto['categoria'] ?>)</span>
    <span class="product-price">R$ <?= $produto['preco'] ?></span>
    <form method="POST" class="product-form">
        <input type="hidden" name="excluir" value="<?= $produto['id'] ?>">
        <button type="submit" class="product-button">Excluir</button>
    </form>
</li>

        <?php endforeach; ?>
    </ul>


   

    
</body>
 <?php include 'footer.php'; ?>
    <script src="app.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
