<?php
session_start();
include('verifica_login.php');
include "conexaoCrud.php";

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
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <div style="margin:auto;width:40%">
        <h4 class="center">TELA DE EDIÇÃO</h4><BR>
        <form method="post" action="">

            <div>
                <h5>Código</h5>
                <input type="text" name="codigo" value=" <?php echo $dados["codigo"] ?> ">
            </div>
            <div>
                <h5>Título</h5>
                <input type="text" name="titulo" value="<?php echo $dados['titulo']?>">
            </div>
            <div>
                <h5>Autor</h5>
                <input type="text" name="autor" value="<?php echo $dados['autor']?>">
            </div>
            <div>
                <h5>Editora</h5>
                <input type="text" name="editora" value="<?php echo $dados['editora']?>">
            </div>
            <div>
                <h5>Nº de Páginas</h5>
                <input type="text" name="paginas" value="<?php echo $dados['paginas']?>">
            </div>
            <div>
                <h5>Data de Publicação</h5>
                <input type="date" name="publicacao" value="<?php echo $dados['publicacao']?>">
            </div>
            <button class="waves-effect waves-light black btn" style="width:100%" type="submit"> ATUALIZAR </button>
            <a href="home.php" class="waves-effect waves-light blue btn" style="width:100%"> VOLTAR </a>



            <!--JavaScript at end of body for optimized loading-->
            <script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>