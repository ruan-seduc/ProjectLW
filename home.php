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
    <link rel="stylesheet" href="assets/css/accordion.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="assets/css/styles.css">
    <!--meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div>
        <h3 class="center">Dashboard 2.0</h3>
        <br>

        <section class='accordion container'>
            <div class='accordion__container'>

                <?php 
                 while( $res = mysqli_fetch_array($resultado)){
                    echo "
                        <div class='accordion__item'>
                            <header class='accordion__header'>
                                <i class='bx bx-plus accordion__icon'></i>
                                <h3 class='accordion__title'>". $res['codigo']. " - ". $res['titulo']. "</h3>
                                <a href='deletar.php?codigo=". $res['codigo'] ."' class='btn-floating red'><i class='material-icons'>close</i></a>
                                <a href='editar.php?codigo=". $res['codigo'] ."' class='btn-floating grenn'><i class='material-icons'>edit</i></a>
                                <a href='emprestimo.php?codigo=". $res['codigo'] ."'><i class='material'>emprestar/devolver</i></a>
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

        <a href="adicionar.php">Adicionar</a><br><br>
        <h2><a href="logout.php">Sair</a></h2>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="assets/js/main.js"></script>
</body>

</html>