<?php
  session_start();

  if (!isset($_SESSION['Autenticado']) || $_SESSION['Autenticado'] != 'SIM') {
    header('Location: ../index.html');
  }

  require_once('db_conexao.php');

  $stmt = $conexaoBD->query('SELECT * FROM tb_precocucas');
  $saborValores = $stmt->fetchAll(PDO::FETCH_ASSOC);

  
  $valorCucaSimples = (float) $saborValores[0]['preco'];
  $valorCucaBanana = (float) $saborValores[1]['preco'];
  $valorCucaChocolate = (float) $saborValores[2]['preco'];
  $valorCucaStikadinho = (float) $saborValores[3]['preco'];
  $valorCucaDoceLeite = (float) $saborValores[4]['preco'];
  $valorCucaGoibada = (float) $saborValores[5]['preco'];


?>


<div onload="onleade()" class="container border-start border-end">
    <form action="capturar_pedido.php" id="formulario_novoPedido" class="row" method="POST">
        <div class="col-6 my-2 form-floating">
            <input type="text" class="form-control form-control-sm" name="nomeCliente" id="nomeCliente" placeholder="Nome do cliente" autofocus>
            <label for="nomeCliente">Nome do cliente</label>
        </div>
        <div class="col-6 my-2 form-floating">
            <input type="text" class="form-control form-control-sm" name="contatoCliente" id="contatoCliente" placeholder="Contato do cliente">
            <label for="contatoCliente">Contato do cliente</label>
        </div>
        <div class="col-2 my-2 form-floating">
            <input type="date" class="form-control form-control-sm" name="diaEntrega" id="diaEntrega" placeholder="Informe a data de entrega" value="<?php echo date('Y-m-d'); ?>">
            <label for="dataEntrega">Dia da entrega</label>
        </div>
        <div class="col-2 my-2 form-floating">
            <input type="text" class="form-control form-control-sm" name="horarioEntrega" id="horarioEntrega" placeholder="Informe o horário">
            <label for="horarioEntrega">Horário</label>
        </div>
        <div class="col-8 my-2 form-floating">
            <input type="text" class="form-control form-control-sm" name="localEntrega" id="localEntrega" placeholder="Informe o local de entrega ou se o cliente retira">
            <label for="localEntrega">Endereço de entrega</label>
        </div>
        <div class="form-floating my-2 col-12">
            <textarea class="form-control" placeholder="Observações" name="observacoes" id="observacoes" style="height: 80px"></textarea>
            <label for="observacoes">Observações</label>
        </div>
        <div class="col-12">
            <h4 style="color: white; margin-top:15px">Sabores</h4>
        </div>
        <div class="col-2 my-2 form-floating">
            <input class="form-control form-control-sm" type="number" name="cucaSimples" id="cucaSimples" min="0" max="10" placeholder="0" oninput="calcularTotal()">
            <label for="cucaSimples">Simples</label>
        </div>
        <div class="col-2 my-2 form-floating">
            <input class="form-control form-control-sm" type="number" name="cucaBanana" id="cucaBanana" min="0" max="10" placeholder="0" oninput="calcularTotal()">
            <label for="cucaBanana">Banana</label>
        </div>
        <div class="col-2 my-2 form-floating">
            <input class="form-control form-control-sm" type="number" name="cucaChocolate" id="cucaChocolate" min="0" max="10" placeholder="0" oninput="calcularTotal()">
            <label for="cucaChocolate">Chocolate</label>
        </div>
        <div class="col-2 my-2 form-floating">
            <input class="form-control form-control-sm" type="number" name="cucaDoceLeite" id="cucaDoceLeite" min="0" max="10" placeholder="0" oninput="calcularTotal()">
            <label for="cucaDoceLeite">Doce de Leite</label>
        </div>
        <div class="col-2 my-2 form-floating">
            <input class="form-control form-control-sm" type="number" name="cucaStikadinho" id="cucaStikadinho" min="0" max="10" placeholder="0" oninput="calcularTotal()">
            <label for="cucaStikadinho">Stikadinho</label>
        </div>
        <div class="col-2 my-2 form-floating">
            <input class="form-control form-control-sm" type="number" name="cucaGoiabada" id="cucaGoiabada" min="0" max="10" placeholder="0" oninput="calcularTotal()">
            <label for="cucaGoiabada">Goiabada</label>
        </div>
        <div class="col-1 my-2 ">
            <input class="form-control text-center form-control-sm" type="text" name="totalCucas" id="totalCucas" readonly>
        </div>
        <div class="col-2 my-2 ">
            <input class="form-control text-center form-control-sm" type="text" name="valorTotal" id="valorTotal" readonly>
        </div>
        <div class="col-9 my-2 ">
            <button class="btn btn-sm btn-warning w-100 botao_acoes" type="submit">Fechar Pedido</button>
        </div>
    </form>
</div>