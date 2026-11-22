function calcularFaseLua() {
    const hoje = new Date();
    const luaNovaConhecida = new Date("2000-01-06");
    const diasDesde = (hoje - luaNovaConhecida) / (1000 * 60 * 60 * 24);
    const cicloLunar = 29.5308867;

    let fase = (diasDesde % cicloLunar) / cicloLunar;
    if (fase < 0) fase += 1;

    let nomeFase = "";
    let emoji = "";

    if (fase < 0.03 || fase > 0.97) {
        nomeFase = "Lua Nova";
        emoji = "🌑";
    } else if (fase < 0.22) {
        nomeFase = "Lua Crescente";
        emoji = "🌒";
    } else if (fase < 0.28) {
        nomeFase = "Quarto Crescente";
        emoji = "🌓";
    } else if (fase < 0.47) {
        nomeFase = "Lua Crescente Gibosa";
        emoji = "🌔";
    } else if (fase < 0.53) {
        nomeFase = "Lua Cheia";
        emoji = "🌕";
    } else if (fase < 0.72) {
        nomeFase = "Lua Minguante Gibosa";
        emoji = "🌖";
    } else if (fase < 0.78) {
        nomeFase = "Quarto Minguante";
        emoji = "🌗";
    } else {
        nomeFase = "Lua Minguante";
        emoji = "🌘";
    }

    const div = document.getElementById("fase-lua")
    div.innerHTML = `
        <p class="fase-emoji">${emoji}</p>
        <p class="fase-nome">Fase da lua de hoje: <strong>${nomeFase}</strong></p>
    `;
}

calcularFaseLua();

const imagensGaleria = document.querySelectorAll(".galeria img");
const lightbox = document.getElementById("lightbox");
const lightboxImg = document.getElementById("lightbox-img");
const botaoFechar = document.querySelector(".lightbox-fechar");

imagensGaleria.forEach(img => {
    img.addEventListener("click", () => {
        lightbox.classList.add("ativo");
        lightboxImg.src = img.src;
        lightboxImg.alt = img.alt;
    });
});

botaoFechar.addEventListener("click", () => {
    lightbox.classList.remove("ativo");
});

lightbox.addEventListener("click", (evento) => {
    if (evento.target == lightbox) {
        lightbox.classList.remove("ativo");
    }
});

const curiosidades = [
    "A Lua está se afastando da Terra cerca de 3,8 cm por ano.",
    "Um dia na Lua dura aproximadamente 29,5 dias terrestres.",
    "A Lua não tem atmosfera, por isso o céu lunar é sempre negro, mesmo de dia.",
    "As pegadas dos astronautas na Lua podem durar milhões de anos, já que não há vento ou água para apagá-las.",
    "A força da gravidade na Lua é cerca de 1/6 da gravidade da Terra.",
    "A Lua sempre mostra a mesma face para a Terra — nunca vemos o 'lado escuro' diretamente.",
    "As marés dos oceanos são causadas principalmente pela atração gravitacional da Lua.",
    "A Lua é o único corpo celeste, além da Terra, onde seres humanos já pisaram.",
    "A temperatura na Lua varia de -173°C à noite até 127°C durante o dia.",
    "A Lua não tem luz própria — o que vemos é a luz do Sol refletida em sua superfície."
];

function mostrarCuriosidade() {
    const texto = document.getElementById("texto-curiosidade");
    texto.style.opacity = 0;

    setTimeout(() => {
        const indiceAleatorio = Math.floor(Math.random() * curiosidades.length);
        texto.textContent = curiosidades[indiceAleatorio];
        texto.style.opacity = 1;
    }, 500);
}

mostrarCuriosidade();
setInterval(mostrarCuriosidade, 8000);

const form = document.getElementById("form-contato");
const retorno = document.getElementById("form-retorno");

function mostrarRetorno(texto, sucesso) {
    retorno.textContent = texto;
    retorno.className = sucesso ? "sucesso" : "erro";
}

form.addEventListener("submit", (evento) => {
    evento.preventDefault();
});