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
            header('Location: devolucao.php?codigo='.$id);
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
        if (mysqli_query($conexaob, "insert into registro (codigo, nome, turma, emprestado, prazo) Value ('$codigo','$nome','$turma','$emprestado','$prazo') ")) {
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
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="fixed-top">
        </nav>
    </header>
    <div class="main">
        <h1 class="text-center">
            Emprestar Livro</h1>
        <div class="row p-5 main-content">
            <div style="margin:auto;width:40%">
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
                    <div class="mb-3">
                        <label class="form-label">Código do Livro</label>
                        <input class="form-control" type="text" name="codigo" value=" <?php echo $dados["codigo"] ?> "
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input class="form-control" type="text" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Turma</label>
                        <input class="form-control" type="text" name="turma" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data do Empréstimo</label>
                        <input class="form-control" type="date" name="data" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prazo de Devolução</label>
                        <input class="form-control" type="text" name="prazo" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <a href="home.php" style="width:100%"> VOLTAR </a>
            </div>



            <a href="adicionar.php">Adicionar</a><br><br>
            <h2><a href="logout.php">Sair</a></h2>
        </div>
    </div>

    <!-- Main JS -->
    <script type="text/javascript" src="assets/js/main.js"></script>
</body>

</html>