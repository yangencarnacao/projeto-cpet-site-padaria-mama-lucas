<!DOCTYPE html>
<html>
<head>
    <style>
        .centralizado {
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
            padding: 20px;
            background-color: #f9f9f9;           
        }
        .botao-entrar {
            background-color: #0074d9;
             color: white; 
             border: none; 
             padding: 10px 20px; 
             text-align: center; 
             text-decoration: none; 
             display: inline-block; 
             font-size: 16px; 
             margin: 20px 2px; 
             cursor: pointer; 
             border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="centralizado">
        <?php
        if(!isset($_SESSION)) {
            session_start();
        }

        if(!isset($_SESSION['id'])) {
            die('<p>Você não pode acessar esta página porque não está logado.</p><a href="login.php" class="botao-entrar">Entrar</a>');
        }
        ?>
    </div>
</body>
</html>
