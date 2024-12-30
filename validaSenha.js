function validarSenha() {
    var senha = document.getElementById("senha").value;
    var min_password_length = 8;
    var error_messages = [];

    if (senha.length < min_password_length) {
        error_messages.push("A senha deve ter no mínimo 8 caracteres.");
    }

    // Outras validações 
    if (!/[A-Z]/.test(senha)) {
        error_messages.push("A senha deve conter pelo menos uma letra maiúscula.");
    }
    if (!/[a-z]/.test(senha)) {
        error_messages.push("A senha deve conter pelo menos uma letra minúscula.");
    }
    if (!/\d/.test(senha)) {
        error_messages.push("A senha deve conter pelo menos um número.");
    }
    if (!/[^\w\s]/.test(senha)) {
        error_messages.push("A senha deve conter pelo menos um caractere especial.");
    }

    if (error_messages.length > 0) {
        // Exibir erro no alert
        alert(error_messages.join("\n"));
        return false;
    } else {
        return true;
    }
}