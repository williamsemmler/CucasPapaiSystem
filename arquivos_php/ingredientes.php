<?php

    session_start();

    if (!isset($_SESSION['Autenticado']) || $_SESSION['Autenticado'] != 'SIM') {
        header('Location: ../index.html');
    }

    require_once('db_conexao.php');

    $stmt = $conexaoBD->query('SELECT `Farinha de Trigo`, `Açúcar`, `Ovo`, `Óleo de Soja`, `Leite`, `Fermento`, `Farinha Cobertura`, `Açúcar Cobertura`, `Margarina Cobertura`, `Forma`, `Plástico` FROM tb_ingredientes_cucas WHERE id_receita_cuca = 1');

    $ingredientesBase = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Retornar dados em formato JSON
    echo json_encode($ingredientesBase);

?>