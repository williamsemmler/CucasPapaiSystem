<?php
    // iniciando o serviço de sessão
    session_start();

    // variável que verifica se a autenticação foi realizada
    $autenticado = false;
    
    try {
        require_once('db_conexao.php');

        $selecionaUsuariosDb = "select * from tb_usuariosistema";
        
        $stmt = $conexaoBD->query($selecionaUsuariosDb);
        $listaUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // print_r($listaUsuarios);
        // echo '<pre/>';
        // echo '<hr/>';

        foreach ($listaUsuarios as $users) {
            if ($users['nomeUsuario'] == $_POST['nomeAcesso'] && $users['senhaUsuario'] == $_POST['senhaAcesso']) {
                $autenticado = true;   
            }
        }
        if ($autenticado) {
            $_SESSION['Autenticado'] = 'SIM';
            header('Location: home.php'); // caso a autenticação retorne "SIM", então redireciona para a home da página
        } else {
            header('Location: ../index.html');
            $_SESSION['Autenticado'] = 'NÃO';
        }
        
    } catch (PDOException $erro) {
        echo $erro->getCode();
        echo '<hr/>';
        echo $erro->getMessage();
    };

?>