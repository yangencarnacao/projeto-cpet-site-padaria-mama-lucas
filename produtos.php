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
    include 'header.php';
    ?>

  
    <?php
require_once 'config.php'; 


$sqlPaes = "SELECT * FROM produtos WHERE categoria = 'paes'";
$resultPaes = mysqli_query($link, $sqlPaes);

$sqlSalgados = "SELECT * FROM produtos WHERE categoria = 'salgados'";
$resultSalgados = mysqli_query($link, $sqlSalgados);

$sqlDoces = "SELECT * FROM produtos WHERE categoria = 'doces'";
$resultDoces = mysqli_query($link, $sqlDoces);
?>

<!-- Exibição dos produtos -->
<div class="category-box">
<h2>Pães</h2>
<table>
    <thead>
        <tr>
            <th>Nome do Produto</th>
            <th>Preço</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($resultPaes)): ?>
            <tr>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['preco'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
        </div>

        <div class="category-box">

<h2>Doces</h2>
<table>
    <thead>
        <tr>
            <th>Nome do Produto</th>
            <th>Preço</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($resultDoces)): ?>
            <tr>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['preco'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
        </div>

        <div class="category-box">
<h2>Salgados</h2>
<table>
    <thead>
        <tr>
            <th>Nome do Produto</th>
            <th>Preço</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($resultSalgados)): ?>
            <tr>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['preco'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
        </div>

        <?php 
    include 'footer.php'
    ?>
</body>
    <script src="app.js"></script>
</body>
</html>
