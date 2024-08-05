<?php
    session_start();
    
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    // Captura do pedido e lançamento na variável $pedido
    $pedido = [
        'nome' => $_POST['nomeCliente'],
        'contato' => $_POST['contatoCliente'],
        'diaEntrega' => $_POST['diaEntrega'],
        'horario' => $_POST['horarioEntrega'],
        'entrega' => $_POST['localEntrega'],
        'observacoes' => $_POST['observacoes'],
        'sabores' => [
            'simples' => $_POST['cucaSimples'],
            'banana' => $_POST['cucaBanana'],
            'chocolate' => $_POST['cucaChocolate'],
            'doceLeite' => $_POST['cucaDoceLeite'],
            'stikadinho' => $_POST['cucaStikadinho'],
            'goiabada' => $_POST['cucaGoiabada']
        ],
        'qtdTotal' => $_POST['totalCucas'],
        'valorTotal' => $_POST['valorTotal']
    ];

    // echo '<pre>';
    // print_r($pedido);
    // echo '</pre>';
    
    // Conexão com o Banco de Dados
    require_once('db_conexao.php');

    $sql = "INSERT INTO tb_pedidos (nome, contato, diaEntrega, horario, entrega, observacoes, simples, banana, chocolate, doceLeite, stikadinho, goiabada, qtdTotal, valorTotal, id_status) 
    VALUES (:nome, :contato, :diaEntrega, :horario, :entrega, :observacoes, :simples, :banana, :chocolate, :doceLeite, :stikadinho, :goiabada, :qtdTotal, :valorTotal, :id_status)";
    
    $stmt = $conexaoBD->prepare($sql);
    
    $stmt->execute([
        ':nome' => $pedido['nome'],
        ':contato' => $pedido['contato'],
        ':diaEntrega' => $pedido['diaEntrega'],
        ':horario' => $pedido['horario'],
        ':entrega' => $pedido['entrega'],
        ':observacoes' => $pedido['observacoes'],
        ':simples' => $pedido['sabores']['simples'],
        ':banana' => $pedido['sabores']['banana'],
        ':chocolate' => $pedido['sabores']['chocolate'],
        ':doceLeite' => $pedido['sabores']['doceLeite'],
        ':stikadinho' => $pedido['sabores']['stikadinho'],
        ':goiabada' => $pedido['sabores']['goiabada'],
        ':qtdTotal' => $pedido['qtdTotal'],
        ':valorTotal' => $pedido['valorTotal'],
        ':id_status' => 1

    ]);

    header ('Location: home.php')
?>