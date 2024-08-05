<?php
session_start();

if (!isset($_SESSION['Autenticado']) || $_SESSION['Autenticado'] != 'SIM') {
    header('Location: ../index.html');
}

require_once('db_conexao.php');

$stmt = $conexaoBD->query('SELECT `Farinha de Trigo`, `Açúcar`, `Ovo`, `Óleo de Soja`, `Leite`, `Fermento`, `Farinha Cobertura`, `Açúcar Cobertura`, `Margarina Cobertura`, `Forma`, `Plástico` FROM tb_ingredientes_cucas WHERE id_receita_cuca = 1');
$ingredientesBase = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container border-start border-end">
    <div class="row">
        <!-- Inputs para diferentes tipos de cuca -->
        <div class="col-2 text-center my-2">
            <label for="cucaSimples">Simples</label>
            <input class="form-control form-control-sm text-center" type="number" name="cucaSimples" id="cucaSimples" min="0" max="10" value="0" oninput="calcularTotal()">
        </div>
        <div class="col-2 text-center my-2">
            <label for="cucaBanana">Banana</label>
            <input class="form-control form-control-sm text-center" type="number" name="cucaBanana" id="cucaBanana" min="0" max="10" value="0" oninput="calcularTotal()">
        </div>
        <div class="col-2 text-center my-2">
            <label for="cucaChocolate">Chocolate</label>
            <input class="form-control form-control-sm text-center" type="number" name="cucaChocolate" id="cucaChocolate" min="0" max="10" value="0" oninput="calcularTotal()">
        </div>
        <div class="col-2 text-center my-2">
            <label for="cucaDoceLeite">Doce de Leite</label>
            <input class="form-control form-control-sm text-center" type="number" name="cucaDoceLeite" id="cucaDoceLeite" min="0" max="10" value="0" oninput="calcularTotal()">
        </div>
        <div class="col-2 text-center my-2">
            <label for="cucaStikadinho">Stikadinho</label>
            <input class="form-control form-control-sm text-center" type="number" name="cucaStikadinho" id="cucaStikadinho" min="0" max="10" value="0" oninput="calcularTotal()">
        </div>
        <div class="col-2 text-center my-2">
            <label for="cucaGoiabada">Goiabada</label>
            <input class="form-control form-control-sm text-center" type="number" name="cucaGoiabada" id="cucaGoiabada" min="0" max="10" value="0" oninput="calcularTotal()">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-3 mx-auto my-2 d-flex">
            <label for="">Total de cucas</label>
            <input class="form-control text-center form-control-sm mx-2" type="text" name="totalCucas" id="totalCucas" readonly>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <table class="table bg-light table-sm text-center">
                <thead class="table-success border border-dark">
                    <tr>
                        <th>Ingrediente</th>
                        <th>Quantidade</th>
                        <th>Custo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ingredientesBase[0] as $chave => $valor) { ?>
                        <tr>
                            <td><?= $chave ?></td>
                            <td class="valor-cell" data-valor="<?= $valor ?>"><?= number_format($valor, 2, ',', '.') ?></td>
                            <td>0</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
