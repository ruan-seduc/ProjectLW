<?php
    session_start();
    include('verifica_login.php');
    include "conexaoCrud.php";
    include "conexaoControle.php";

    
    if(isset($_GET['codigo'])){
        $id = $_GET['codigo'];
        $resultado = mysqli_query($conexao, "Select * from livros where codigo = '$id'");
        $dados = mysqli_fetch_array($resultado);
        
        $search = mysqli_query($conexao, "SELECT codigo, status FROM livros where codigo = '$id' AND status = 'emprestado'");
        if (mysqli_num_rows($search)){
            header('Location: devolucao.php');
            exit;   
        }; 
    }   
    

    if (isset($_POST['codigo'])) {
        $codigo = $_POST['codigo'];
        $nome = $_POST['nome'];
        $turma = $_POST['turma'];
        $emprestado = $_POST['data'];
        $prazo = $_POST['prazo'];
    
        $sql = "select count(*) as total from livros where codigo = '$codigo'";
        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result);
    
    if($row['total'] == 1) {
        $_SESSION['codigo_duplicado'] = true;
            header('Location: emprestimo.php');
            exit;
        
    }
        if (mysqli_query($conexaob, "insert into registro (id, nome, turma, emprestado, prazo) Value ('$codigo','$nome','$turma','$emprestado','$prazo') ")) {
            $sqlb = "UPDATE livros SET status = 'emprestado' WHERE codigo = '$id'";
            if(mysqli_query($conexao, $sqlb)){
                $_SESSION['msg'] = "Atualizado com Sucesso!";
                 echo "
            <div>
            <p>Empréstimo Efetuado com Sucesso!.</p>
            </div>
            ";
            }
    
        } else {
    
            echo "
            <div>
            <p>Desculpe, algo não funcionou!</p>
            </div>";
        }

    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <div style="margin:auto;width:40%">
        <h4 class="center">EMPRESTAR LIVRO</h4><BR>
        <?php
                    if(isset($_SESSION['codigo_duplicado'])):
                    ?>
        <div>
            <p>ERRO: O livro parece já estar emprestado!.</p>
        </div>
        <?php
                    endif;
                    unset($_SESSION['codigo_duplicado']);
                    ?>
        <form method="post" action="">

            <div>
                <h5>Código do Livro</h5>
                <input type="text" name="codigo" value=" <?php echo $dados["codigo"] ?> " required>
            </div>
            <div>
                <h5>Nome</h5>
                <input type="text" name="nome" required>
            </div>
            <div>
                <h5>Turma</h5>
                <input type="text" name="turma" required>
            </div>
            <div>
                <h5>Data do Empréstimo</h5>
                <input type="date" name="data" required>
            </div>
            <div>
                <h5>Prazo de devolução (em dias)</h5>
                <input type="text" name="prazo" required>
            </div>
            <button class="waves-effect waves-light black btn" style="width:100%" type="submit"> REGISTRAR </button>
        </form>
        <a href="home.php" class="waves-effect waves-light blue btn" style="width:100%"> VOLTAR </a>
    </div>

</body>

</html>