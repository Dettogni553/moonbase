const form = document.getElementById("form-contato");
const retorno = document.getElementById("form-retorno");

function mostrarRetorno(texto, sucesso) {
    retorno.textContent = texto;
    retorno.className = sucesso ? "sucesso" : "erro";
}

form.addEventListener("submit", (evento) => {
    evento.preventDefault();

    const nome = document.getElementById("nome").value.trim();
    const email = document.getElementById("email").value.trim();
    const mensagem = document.getElementById("mensagem").value.trim();
    const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    if (nome.length < 3) {
        mostrarRetorno("Digite seu nome (mínimo de 3 letras).", false);
        return;
    }

    if (!emailValido) {
        mostrarRetorno("Digite um e-mail válido, como nome@exemplo.com.", false);
        return;
    }

    if (mensagem.length < 10) {
        mostrarRetorno("A mensagem precisa ter pelo menos 10 caracteres.", false);
        return;
    }

    mostrarRetorno(`Obrigado, ${nome}! Sua mensagem foi enviada.`, true);
    form.reset();
});