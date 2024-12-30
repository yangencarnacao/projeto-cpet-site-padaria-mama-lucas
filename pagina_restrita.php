<?php
session_start();

if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    header("Location: protect.php");

    exit();
}

// Mensagem caso usuario nao esteja logado ou com permissao
echo "Bem-vindo, você está logado!";
?>