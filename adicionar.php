<?php
session_start();
include('verifica_login.php');
include "conexaoCrud.php";

if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
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
    if (mysqli_query($conexao, "insert into livros (codigo, titulo, autor, editora, paginas, publicacao) Value ('$codigo','$titulo','$autor','$editora','$paginas','$publicacao') ")) {
        echo "
        <div>
        <p>Livro Adicionado com sucesso!.</p>
        </div>
        
        
        ";

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
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <div style="margin:auto;width:40%">
        <h4 class="center">TELA DE CADASTRO</h4><BR>
        <?php
                    if(isset($_SESSION['codigo_duplicado'])):
                    ?>
        <div>
            <p>ERRO: Você não pode cadastrar dois livros com o mesmo código.</p>
        </div>
        <?php
                    endif;
                    unset($_SESSION['codigo_duplicado']);
                    ?>
        <form method="post" action="">

            <div>
                <h5>Código</h5>
                <input type="text" name="codigo" required>
            </div>
            <div>
                <h5>Título</h5>
                <input type="text" name="titulo" required>
            </div>
            <div>
                <h5>Autor</h5>
                <input type="text" name="autor" required>
            </div>
            <div>
                <h5>Editora</h5>
                <input type="text" name="editora" required>
            </div>
            <div>
                <h5>Nº de Páginas</h5>
                <input type="text" name="paginas" required>
            </div>
            <div>
                <h5>Data de Publicação</h5>
                <input type="date" name="publicacao">
            </div>
            <button class="waves-effect waves-light black btn" style="width:100%" type="submit"> CADASTRAR </button>
        </form>
        <a href="home.php" class="waves-effect waves-light blue btn" style="width:100%"> VOLTAR </a>


        <!--JavaScript-->
        <script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>