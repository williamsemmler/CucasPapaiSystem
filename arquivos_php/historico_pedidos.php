<?php
    session_start();

    if (!isset($_SESSION['Autenticado']) || $_SESSION['Autenticado'] != 'SIM') {
        header('Location: ../index.html');
    }

    require_once('db_conexao.php');

    $stmt = $conexaoBD->query('SELECT * FROM tb_pedidos ORDER BY diaEntrega, horario ASC');
    $historico = $stmt->fetchAll(PDO::FETCH_OBJ);

    // echo '<pre>';
    // print_r($historico);
    // echo '</pre>';

    $stmt = $conexaoBD->query('SELECT SUM(qtdTotal) as totalQtd FROM tb_pedidos');
    $somaQtd = $stmt->fetch(PDO::FETCH_OBJ)->totalQtd;

    // echo '<pre>';
    // print_r($somaQtd);
    // echo '</pre>';

    $stmt = $conexaoBD->query('SELECT SUM(valorTotal) as valorTotal FROM tb_pedidos');
    $valorTotal = $stmt->fetch(PDO::FETCH_OBJ)->valorTotal;


?>

<div class="container border-start border-end">
    <div class="row">
        <div class="col-12 table-responsive-sm">
            <table class="table bg-light table-sm text-center">
                <thead>
                    <tr class="table-success border border-dark">
                        <th scope="col">Nº</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Lançado em</th>
                        <th scope="col">Entregue em</th>
                        <th scope="col">Sabores</th>
                        <th scope="col">Qtd Cucas</th>
                        <th scope="col">Valor total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historico as $indice => $resultado) { ?>
                        <tr class="border border-dark">
                            <td class=" table-success border border-dark"> <?= $resultado->id_pedido ?> </td>
                            <td> <?= $resultado->nome ?> </td>
                            <td> <?= date("d/m/Y", strtotime($resultado->dataLancamento)) ?> </td>
                            <td> <?= date("d/m/Y", strtotime($resultado->diaEntrega)) ?> </td>
                            <td>
                                <?php
                                    $sabores = [
                                        'Simples' => $resultado->simples,
                                        'Banana' => $resultado->banana,
                                        'Chocolate' => $resultado->chocolate,
                                        'Doce de Leite' => $resultado->doceLeite,
                                        'Stikadinho' => $resultado->stikadinho,
                                        'Goiabada' => $resultado->goiabada,
                                    ];

                                    foreach ($sabores as $sabor => $quantidade) {
                                        if ($quantidade != 0) {
                                            echo $sabor . ': ' . $quantidade . '<br>';
                                        }
                                    }
                                ?>
                            </td>
                            <td> <?= $resultado->qtdTotal ?> </td>
                            <td> <?= 'R$ ' . number_format($resultado->valorTotal,2,',','.') ?> </td>
                        </tr>
                    <?php } ?>
                    <tr class="table-success border border-dark">
                        <td colspan="4"></td>
                        <th>Totais</th>
                        <td scope="col"> <?= $somaQtd ?> </td>
                        <td scope="col"> <?= 'R$ ' . number_format($valorTotal,2,',','.') ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>