<?php
    session_start();

    if (!isset($_SESSION['Autenticado']) || $_SESSION['Autenticado'] != 'SIM') {
        header('Location: ../index.html');
    }

    require_once('db_conexao.php');

    $stmt = $conexaoBD->query('SELECT * FROM tb_pedidos LEFT JOIN tb_status ON (tb_pedidos.id_status = tb_status.id) ORDER BY diaEntrega DESC, horario DESC');
    $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);

    $stmt = $conexaoBD->query('SELECT * FROM tb_status');
    $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<pre>';
    print_r($status);
    echo '</pre>';
?>

<div class="container border-start border-end">
    <div class="row">
        <div class="col-12 table-responsive-sm">
            <table class="table bg-light table-sm text-center">
                <thead>
                    <tr class="table-success border border-dark">
                        <th scope="col">Nº</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Dia Entrega</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Observações</th>
                        <th scope="col">Sabores</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $indice => $resultado) {
                            if ($resultado->id_status !== 4) { ?>
                                <tr class="border border-dark">
                                    <td class=" table-success border border-dark"> <?= $resultado->id_pedido ?> </td>
                                    <td> <?= $resultado->nome ?> </td>
                                    <td> <?= date("d/m/Y", strtotime($resultado->diaEntrega)) ?> </td>
                                    <td> <?= $resultado->horario ?> </td>
                                    <td> <?= $resultado->observacoes ?> </td>
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
                                    <td class="table-warning border border-dark edit_status" onclick="edit_status()"> <?= $resultado->status ?></td>
                                </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>