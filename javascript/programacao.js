function requisitarPagina(url) {
    // Obter o elemento com id 'tela_opcoes'
    let tela_modulos = document.getElementById('tela_opcoes');

    // Verificar se o elemento foi encontrado
    if (tela_modulos) {
        // Limpar o conteúdo do elemento
        tela_modulos.innerHTML = '';
    } else {
        console.error('Elemento com id "tela_opcoes" não encontrado.');
        return; // Parar a execução da função se o elemento não for encontrado
    }

    // Criar um novo objeto XMLHttpRequest
    const modulo = new XMLHttpRequest();

    // Definir uma função a ser chamada quando o estado do XMLHttpRequest mudar
    modulo.onreadystatechange = function() {
        // Verificar se a requisição está completa (readyState 4) e se foi bem-sucedida (status 200)
        if (modulo.readyState === 4 && modulo.status === 200) {
            // Atualizar o conteúdo do elemento com a resposta da requisição
            tela_modulos.innerHTML = modulo.responseText;
        } 
        if (modulo.readyState === 4 && modulo.status === 404) {
            tela_modulos.innerHTML = 'Erro! - Página não encontrada no servidor';
        }
    };

    // Inicializar a requisição com o método GET e a URL fornecida
    modulo.open("GET", url, true);

    // Enviar a requisição
    modulo.send();
}

function calcularTotal() {
    // Obtendo os valores dos campos
    let simples = parseInt(document.getElementById('cucaSimples').value) || 0;
    let banana = parseInt(document.getElementById('cucaBanana').value) || 0;
    let chocolate = parseInt(document.getElementById('cucaChocolate').value) || 0;
    let doceDeLeite = parseInt(document.getElementById('cucaDoceLeite').value) || 0;
    let stikadinho = parseInt(document.getElementById('cucaStikadinho').value) || 0;
    let goiabada = parseInt(document.getElementById('cucaGoiabada').value) || 0;

    // Calculando o total
    const total = simples + banana + chocolate + doceDeLeite + stikadinho + goiabada;

    // Atualizando o campo total
    document.getElementById('totalCucas').value = total;
}

function calcularTotal() {
    let total = 0;
    let cucaSimples = parseInt(document.getElementById('cucaSimples').value) || 0;
    let cucaBanana = parseInt(document.getElementById('cucaBanana').value) || 0;
    let cucaChocolate = parseInt(document.getElementById('cucaChocolate').value) || 0;
    let cucaDoceLeite = parseInt(document.getElementById('cucaDoceLeite').value) || 0;
    let cucaStikadinho = parseInt(document.getElementById('cucaStikadinho').value) || 0;
    let cucaGoiabada = parseInt(document.getElementById('cucaGoiabada').value) || 0;

    total = cucaSimples + cucaBanana + cucaChocolate + cucaDoceLeite + cucaStikadinho + cucaGoiabada;
    document.getElementById('totalCucas').value = total;

    calcularIngredientes(total);
}

function calcularIngredientes(total) {
    let valorCells = document.querySelectorAll('.valor-cell');

    valorCells.forEach(cell => {
        let valor = parseFloat(cell.getAttribute('data-valor')) || 0;
        let novoValor = valor * total;
        cell.textContent = novoValor.toFixed(2).replace('.', ',');
    });
}   