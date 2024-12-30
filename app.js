
function sanitizeInput(input) {
  return DOMPurify.sanitize(input, { ALLOWED_TAGS: [] });
}

document.getElementById("cep").addEventListener("input", consultarCEP);

async function consultarCEP() {
    const cepInput = document.getElementById("cep");
    const cep = cepInput.value.replace(/\D/g, ''); 

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if (data.erro) {
            console.error("CEP não encontrado.");
        } else {
            console.log("Dados do endereço:", data);
            document.getElementById("logradouro").value = data.logradouro;
            document.getElementById("bairro").value = data.bairro;
            document.getElementById("cidade").value = data.localidade;

        }
    } catch (error) {
        console.error("Erro ao consultar o CEP:", error);
    }
}

document.getElementById("contact-form").addEventListener("submit", function (event) {
  event.preventDefault();

  const nome = sanitizeInput(document.getElementById("nome").value);
  const cep = sanitizeInput(document.getElementById("cep").value);
  const logradouro = sanitizeInput(document.getElementById("logradouro").value);
  const bairro = sanitizeInput(document.getElementById("bairro").value);
  const numero = sanitizeInput(document.getElementById("numero").value);
  const tel = sanitizeInput(document.getElementById("tel").value);
  const complemento = sanitizeInput(document.getElementById("complemento").value);
  const mensagem = sanitizeInput(document.getElementById("mensagem").value);

  if (!/^\d+$/.test(cep)) {
    alert("Por favor, insira um CEP válido (apenas números).");
    return;
  }

  if (!/^\d+$/.test(numero)) {
    alert("Por favor, insira um NÚMERO válido (apenas números).");
    return;
  }

  const mensagemWhatsApp = `
  Cliente: ${encodeURIComponent(nome)},
  Endereço: 
    ${encodeURIComponent(logradouro)}, 
    Nº:
    ${encodeURIComponent(numero)},
    Bairro:
    ${encodeURIComponent(bairro)},
    Telefone:
    ${encodeURIComponent(tel)},
    CEP: ${encodeURIComponent(cep)}
  ${complemento ? `Complemento: ${encodeURIComponent(complemento)}` : ''}
  Pedido: 
  ${encodeURIComponent(mensagem)}`;
  window.open(`https://api.whatsapp.com/send?phone=+5521982533483&text=${mensagemWhatsApp}`, '_blank');
});
