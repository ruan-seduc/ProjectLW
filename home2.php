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
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="One Page Resume">
    <meta name="keywords"
        content="dd,design drastic,free online degital agency template, download free website template, premium html template download free, responsive template, html5 and css3 template,free responsive template,free html5 template,html5 template download">
    <meta name="author" content="DesignDrastic">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Page CV</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <!--Accordion CSS and boxicons-->
    <link rel="stylesheet" href="assets/css/accordion.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/tmstyle.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    <!--[if lt IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
		<![endif]-->
</head>

<body data-spy="scroll" data-target="#cvoptions">
    <!-- Sidebar Starts -->
    <aside>
        <nav class="text-center navbar navbar-expand-md bg-dark navbar-dark m-0 p-0 fixed-top d-md-none">
            <a class="navbar-brand " href="#">&nbsp; One Page CV</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#small_screen_nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="small_screen_nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link nav-a" href="#AboutMe">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-a " href="#Skills">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-a" href="#Projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-a" href="#Achievement">Achievement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-a" href="#ContactMe">Contact Me</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="div-left div-left-small d-none d-md-block d-lg-block d-xl-block m-0 p-0">
            <div class="d-flex flex-row justify-content-center align-items-center h-100">
                <div class="card card-bg-p">
                    <img class="card-img-top img-of-person center text-center" src="assets/images/avtar.png"
                        alt="Card image cap">
                    <h1 class="text-center text-light">John</h1>
                    <h6 class="text-center text-light"> Web Developer </h6>
                    <nav id="cvoptions">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link active nav-a" href="#AboutMe">About Me</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-a" href="#Skills">Skills</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-a" href="#Projects">Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-a" href="#Achievement">Achievement</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-a" href="#ContactMe">Contact Me</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </aside>
    <!-- Sidebar Ends -->

    <!-- About Me Starts -->
    <section id="AboutMe">
        <div class="div-right-1 div-right-1-small">
            <h1
                class="d-flex flex-row justify-content-center align-items-center text-dark heading-of-div extra-mrgn-abtme">
                About Me</h1>
            <div class="row p-5 main-content">
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
        </div>
    </section>
    <!-- About Me Ends -->

    <div class="clearfix"></div>

    <!-- Contact Ends -->

    <!-- jQuery JS -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <!-- Pooper JS -->
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <!-- Main JS -->
    <script type="text/javascript" src="assets/js/main.js"></script>
</body>

</html>