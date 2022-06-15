<?php
    session_start();
    include('verifica_login.php');
    include "conexao.php";
    
    if(isset($_GET['codigo'])){
        $id = $_GET['codigo'];
        $resultado = mysqli_query($conexao, "Select * from registro where codigo = '$id'");
        $dados = mysqli_fetch_array($resultado);
    }

    if (isset($_POST['codigo'])) {
        $codigo = trim($_POST['codigo']);
        $nome = $_POST['nome'];
        $turma = $_POST['turma'];
        $emprestado = $_POST['data'];
        $prazo = $_POST['prazo'];
        $devolucao = $_POST['devolucao'];
    
        $sql = "select count(*) as total from registro where codigo = '$codigo'";
        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_query($conexao, "delete from registro where codigo = '$codigo'")) {
            $sqlb = "UPDATE livros SET status = 'disponivel' WHERE codigo = '$codigo'";
            if(mysqli_query($conexao, $sqlb)){
                ?>
<script type="text/javascript">
alert("Livro devolvido com sucesso!")
window.location.href = "home.php";
</script>
<?php

            }
        }}
        
     else {
    
            echo "
            <div>
            <p>Desculpe, algo não funcionou!</p>
            </div>";
        }
    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="fixed-top">
            <a href="home.php"><i class='material-icons' style="
    color: white;
    margin-left: -10px;">arrow_back</i>
            </a>
            <a href="logout.php">
                <i class='material-icons' style="
    color: white;
    margin-left: 900px;">power_settings_new</i>
            </a>
        </nav>
    </header>
    <div class="main">
        <h3 class="text-center">
            Devolver Livro</h3>
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
                    <input class="form-control" type="text" name="nome" value=" <?php echo $dados["nome"] ?>" required>
                </div>
                <div class=" mb-3">
                    <label class="form-label">Turma</label>
                    <input class="form-control" type="text" name="turma" value=" <?php echo $dados["turma"] ?>"
                        required>
                </div>
                <div class=" mb-3">
                    <label class="form-label">Data do Empréstimo</label>
                    <input class="form-control" type="text" name="data" value=" <?php echo $dados["data"] ?>" required>
                </div>
                <div class=" mb-3">
                    <label class="form-label">Prazo de Devolução</label>
                    <input class="form-control" type="text" name="prazo" value=" <?php echo $dados["prazo"]." dias" ?>"
                        required>
                </div>
                <div class=" mb-3">
                    <label class="form-label">Data da Devolução</label>
                    <input class="form-control" type="date" name="devolucao" required>
                </div>

                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>

    <!-- Main JS -->
    <script type="text/javascript" src="assets/js/main.js"></script>
</body>

</html>