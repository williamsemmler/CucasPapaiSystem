<?php
    session_start();

    if (!isset($_SESSION['Autenticado']) || $_SESSION['Autenticado'] != 'SIM') {
        header('Location: ../index.html');
    }

    require_once('db_conexao.php');

    $stmt = $conexaoBD->query('SELECT *, (precoCompra / qtdEmbalagem) as precoUnidade FROM tb_ingredientes ORDER BY id_ingredientes ASC');
    $ingredientes= $stmt->fetchAll(PDO::FETCH_OBJ);

    // echo '<pre>';
    // print_r($ingredientes);
    // echo '</pre>';
?>

<div class="container border-start border-end">
    <div class="row">
        <div class="col-12 table-responsive-sm">
            <table class="table bg-light table-sm text-center">
                <thead>
                    <tr class="table-success border border-dark">
                        <th scope="col">Ingrediente</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Qtd Embalagem</th>
                        <th scope="col">Unidade de medida</th>
                        <th scope="col">Preço da Unidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ingredientes as $indice => $ingrediente) { ?>
                        <tr class="border border-dark">
                            <td class=" table-success border border-dark"> <?= $ingrediente->nomeIngrediente ?> </td>
                            <td> <?= 'R$ ' . number_format($ingrediente->precoCompra, 2, ',','.') ?> </td>
                            <td> <?= $ingrediente->qtdEmbalagem ?> </td>
                            <td> <?= $ingrediente->unidade ?> </td>
                            <td><?= 'R$ ' . number_format($ingrediente->precoUnidade, 3, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>