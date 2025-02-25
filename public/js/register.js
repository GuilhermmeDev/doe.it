const frases = [
    "“No <span class='doeit'><b>Doeit</b></span>, cada doação é um ato de amor.<br>Que pode transformar vidas.”",
    "“No <span class='doeit'><b>Doeit</b></span>, pequenas ações geram grandes mudanças.<br>Juntos, podemos transformar o mundo.”",
    "“Cada peça de roupa, cada alimento doado.<br>No <span class='doeit'><b>Doeit</b></span>, sua generosidade aquece vidas.”",
];

let indice = 0;
const fraseElemento = document.getElementById("frase");
const indicadoresContainer = document.getElementById("indicadores");

// Criar os indicadores (bolinhas)
frases.forEach((_, i) => {
    const indicador = document.createElement("div");
    indicador.classList.add("indicador");
    if (i === 0) indicador.classList.add("ativo");
    indicador.addEventListener("click", () => mudarFrase(i, true));
    indicadoresContainer.appendChild(indicador);
});

const indicadores = document.querySelectorAll(".indicador");

function mudarFrase(novoIndice, manual = false) {
    indice = novoIndice;
    fraseElemento.innerHTML = frases[indice]; // Troquei textContent por innerHTML

    // Atualizar os indicadores (bolinhas)
    indicadores.forEach((ind, i) => {
        ind.classList.toggle("ativo", i === indice);
    });

    // Resetar o intervalo caso a troca seja manual
    if (manual) {
        clearInterval(intervalo);
        intervalo = setInterval(() => mudarFrase((indice + 1) % frases.length), 5000);
    }
}

// Mostrar a primeira frase
mudarFrase(0);

// Trocar a frase automaticamente a cada 5 segundos
let intervalo = setInterval(() => mudarFrase((indice + 1) % frases.length), 5000);




function togglePassword(id, icon) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        icon.src = "olho-fechado.svg"; // Troca para o SVG de olho fechado
    } else {
        input.type = "password";
        icon.src = "olho.svg"; // Volta para o SVG de olho aberto
    }
}



