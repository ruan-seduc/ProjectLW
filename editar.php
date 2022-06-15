<?php
session_start();
include('verifica_login.php');
include "conexao.php";

if(isset($_GET['codigo'])){
    $id = $_GET['codigo'];
    $resultado = mysqli_query($conexao, "Select * from livros where codigo = '$id'");
    $dados = mysqli_fetch_array($resultado);

} 

if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $paginas = $_POST['paginas'];
    $publicacao = $_POST['publicacao'];
    $publicacao = date("Y-m-d",strtotime(str_replace('/','-',$publicacao))); 

    $sql = "UPDATE livros SET codigo = '$codigo', titulo = '$titulo', autor = '$autor', editora = '$editora', paginas = '$paginas', publicacao = '$publicacao' WHERE codigo = '$id'";
    if(mysqli_query($conexao, $sql)){
        $_SESSION['msg'] = "Atualizado com Sucesso!";

        echo '

            <script>
                    window.location.href = "home.php";
            </script>
        
        ';

    }

}





?>


<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
        <div style="margin:auto;width:40vw">
            <h4 class="center">TELA DE EDIÇÃO</h4><BR>
            <form method="post" action="">

                <div class="mb-3">
                    <label class="form-label">Código</label>
                    <input class="form-control" type="text" name="codigo" value=" <?php echo $dados["codigo"] ?> ">
                </div>
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input class="form-control" type="text" name="titulo" value="<?php echo $dados['titulo']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Autor</label>
                    <input class="form-control" type="text" name="autor" value="<?php echo $dados['autor']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Editora</label>
                    <input class="form-control" type="text" name="editora" value="<?php echo $dados['editora']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nº de Páginas</label>
                    <input class="form-control" ype="text" name="paginas" value="<?php echo $dados['paginas']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Data de Publicação</label>
                    <input class="form-control" type="date" name="publicacao" value="<?php echo $dados['publicacao']?>">
                </div>
                <button class="btn btn-dark" type="submit"> ATUALIZAR </button>

                <!--JavaScript at end of body for optimized loading-->
                <script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>