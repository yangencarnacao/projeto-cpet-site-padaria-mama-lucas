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
    <?php include 'header.php';
    
    ?>

    <main>
        <section id="contato">
            <h1>Peça pelo nosso WhatsApp</h1>
            <form id="contact-form">
            <div style="flex: 1;">
                    <label for="cep">Mensagem:</label>
                    <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
                </div>    
                <div style="display: flex; flex-wrap: wrap;">
                    <div style="flex: 1; margin-right: 20px;">
                        <label for="nome">Nome do Cliente:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div style="flex: 1;">
                        <label for="cep">CEP:</label>
                        <input type="text" id="cep" name="cep" required>
                    </div>
                </div>
                <div style="display: flex; flex-wrap: wrap;">
                    <div style="flex: 1; margin-right: 20px;">
                        <label for="nome">Logradouro:</label>
                        <input type="text" id="logradouro" name="logradouro" required>
                    </div>
                    <div style="flex: 1;">
                        <label for="cep">Cidade:</label>
                        <input type="text" id="cidade" name="cidade" required>
                    </div>
                </div>
                <div style="display: flex; flex-wrap: wrap;">
                    <div style="flex: 1; margin-right: 20px;">
                        <label for="nome">Número:</label>
                        <input type="text" id="numero" name="numero" required>
                    </div>
                    <div style="flex: 1;">
                        <label for="cep">Bairro:</label>
                        <input type="text" id="bairro" name="bairro" required>
                    </div>
                </div>
                <div style="flex: 1;">
                    <label for="cep">Telefone:</label>
                    <input type="tel" id="tel" name="tel" placeholder="(xx) xxxxxxxxx" />

                </div>  
                <div style="flex: 1;">
                    <label for="cep">Complemento/Referência:</label>
                    <textarea id="complemento" name="complemento"></textarea>
                </div>
                <button type="submit">Enviar</button>
            </form>
        </section>  
    </main>

    <script src="https://cdn.jsdelivr.net/npm/dompurify@3.0.0/dist/purify.min.js"></script>
    <script src="app.js"></script>
    </body>
    <?php
include('footer.php');
?>
</html>
