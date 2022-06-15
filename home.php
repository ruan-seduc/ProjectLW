<?php
    session_start();
    include('verifica_login.php');
    include "conexaoCrud.php";


    $resultado = mysqli_query($conexao, "select * from livros");
    
    if(isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        echo ' <script> 
                    window.onload = function() {
                         M.toast({ html:"'. $msg .'" }); 
                    }
                </script> ';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!--Accordion CSS and boxicons-->
    <link rel="stylesheet" href="css/accordion.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">
    <!--meta-->
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
    <div class="container-fluid">

        <div class="main">
            <h3 class="text-center">Sistema Controle de Livros</h3>
            <br>
            <div class="input-group search d-flex justify-content-center">
                <input id="searchbar" class="form-control rounded" onkeyup="search_books()" type="text" name="search"
                    autocomplete="off" placeholder=" Pesquisar Livros">
            </div>
            <div class="float-right">
                <a class="btn btn-dark control-position" href="adicionar.php" role="button">+ Adicionar</a>
            </div>


            <section class='accordion container'>
                <div class='accordion__container'>

                    <?php 
                 while( $res = mysqli_fetch_array($resultado)){
                    echo "
                        <div class='accordion__item'>
                            <header class='accordion__header'>
                                <i class='bx bx-plus accordion__icon'></i>
                                <h3 class='accordion__title'>". $res['codigo']. " - ". $res['titulo']. "</h3>
                                <a href='deletar.php?codigo=". $res['codigo'] ."'><i class='material-icons' style='color: black;'>close</i></a>
                                <a href='editar.php?codigo=". $res['codigo'] ."' ><i class='material-icons' style='color: black;'>edit</i></a>
                                <a href='emprestimo.php?codigo=". $res['codigo'] ."'><i class='material-icons' style='color: black;' >app_registration</i></a>
                                </header>
                                <div class='accordion__content'>
                                <p class='accordion__description'>
                                    Autor: ".$res['autor']."<br>
                                    Editora: ".$res['editora']."<br>
                                    Nº de Páginas: ".$res['paginas']."<br>
                                    Data de Publicação: ".$res['publicacao']." <br>
                                    Status: ".$res['status']."
                                </p>
                            </div>
                        </div>";
                }
                ?>
                </div>
            </section>
        </div>
    </div>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/search.js"></script>
</body>

</html>