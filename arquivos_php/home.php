<?php
  session_start();

  if (!isset($_SESSION['Autenticado']) || $_SESSION['Autenticado'] != 'SIM') {
    header('Location: ../index.html');
  }
?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>

    <!-- Favicon do site -->
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
      :root {
        --backgroundCorpo: #6e0b28;
        --corMarromFraco: #ffd0d5;
        --corEsbranquicado: #fbf9fa;
      }
      body {
          background-color: var(--backgroundCorpo);
      }
      .botoes_opcoes {
        color: white;
      }
      .botoes_opcoes:hover {
        background-color: var(--corMarromFraco);
        color: black;
      }
      h5 {
        font-size: 30px;
      }
      #formulario_novoPedido {
        color: grey;
      }
      .botao_acoes {
        transition: 0.5s;
      }
      .botao_acoes:hover {
        background-color: var(--backgroundCorpo);
        color: white;
        border:1px solid white;

        transition: 0.5s
      }
      .cabecalho_tabela {
        background-color: var(--corMarromFraco):
      }
      tr:hover {
        background-color: var(--corMarromFraco);
        color: black;
      }
      .edit_status {
        cursor: pointer;
      }
      .edit_status:hover {
        color: var(--backgroundCorpo);
      }

    </style>

    <script src="../programacao.js"></script>
  </head>

  <body class="container">
    <div class="container mt-4">
      <header class="row">
        <div class="col-3 mx-auto d-flex align-items-center justify-content-center">
          <img src="../logo_oficial.jpg" class="rounded mx-auto d-block img-fluid" alt="logo da empresa">
        </div>
        <div class="col-2 d-flex align-items-center justify-content-center">
          <a class="btn btn-warning rounded botao_acoes" href="logoff.php">SAIR</a>
        </div>
      </header>
     

      <main class="row text-white">
      
        <div class="col-2">
          <div class="row">
            <h5 class="col p-2 d-flex justify-content-center">Opções</h5>
          </div>
          <div class="row">
            <a onclick="requisitarPagina('lancar_pedidos.php')" class="btn botoes_opcoes" role="button">Lançar pedidos</a>
            <a onclick="requisitarPagina('status_pedidos.php')" class="btn botoes_opcoes" role="button">Status dos pedidos</a>
            <a onclick="requisitarPagina('historico_pedidos.php')" class="btn botoes_opcoes" role="button">Histórico de pedidos</a>
            <a onclick="requisitarPagina('producao.php')" class="btn botoes_opcoes" role="button">Produção</a>
            <a onclick="requisitarPagina('custos.php')" class="btn botoes_opcoes" role="button">Custos</a>
          </div>
        </div>

        <div class="col-10 p-2">
          <div class="row">
            <div class="col" id="tela_opcoes">
            </div>
          </div>
        </div>
      </main>
    </div>

  </body>
</html>