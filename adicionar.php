<?php
session_start();
include('verifica_login.php');
include "conexao.php";

if (isset($_POST['codigo'])) {
    $codigo = trim($_POST['codigo']);
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $paginas = $_POST['paginas'];
    $publicacao = $_POST['publicacao'];
    $publicacao = date("Y-m-d",strtotime(str_replace('/','-',$publicacao))); 

    $sql = "select count(*) as total from livros where codigo = '$codigo'";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
	$_SESSION['codigo_duplicado'] = true;
        header('Location: adicionar.php');
        exit;
	
}
    if (mysqli_query($conexao, "insert into livros (codigo, titulo, autor, editora, paginas, publicacao, data_cadastro) values ('$codigo','$titulo','$autor','$editora','$paginas','$publicacao', NOW()) ")) {
    ?>
<script type="text/javascript">
alert("Livro adicionado com sucesso!")
window.location.href = "home.php";
</script>"
<?php

    } else {

        echo "
        <div>
        <p>Desculpe, algo não funcionou!</p>
        </div>";
    }
}
mysqli_close($conexao);


?>






<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
        <div style="margin:auto;width:40vw">
            <h4 class="center">TELA DE CADASTRO</h4><BR>
            <?php
                    if(isset($_SESSION['codigo_duplicado'])):
                    ?>
            <script type="text/javascript">
            alert("Erro: vocÊ não pode cadastrar dois livros com o mesmo código!")
            </script>
            <?php
                    endif;
                    unset($_SESSION['codigo_duplicado']);
                    ?>
            <form method="post" action="">

                <div class="mb-3">
                    <label class="form-label">Código do Livro</label>
                    <input class="form-control" type="text" name="codigo" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input class="form-control" type="text" name="titulo" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Autor</label>
                    <input class="form-control" type="text" name="autor" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Editora</label>
                    <input class="form-control" type="text" name="editora" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nº de Páginas</label>
                    <input class="form-control" type="text" name="paginas" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Data de Publicação</label>
                    <input class="form-control" type="date" name="publicacao" required>
                </div>
                <button type="submit" class="btn btn-dark">CADASTRAR</button>
            </form>
        </div>

        <!--JavaScript-->
        <script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>