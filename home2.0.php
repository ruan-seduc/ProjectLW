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
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!--meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div>
        <h3 class="center">Dashboard 2.0</h3>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th>Nº de Páginas</th>
                    <th>Data da Publicação</th>

                </tr>
            </thead>

            <tbody>
                <?php 
                 while( $res = mysqli_fetch_array($resultado)){
                    echo "<tr>   ";
                    echo "<td>". $res['codigo'] ."</td>";
                    echo "<td>".$res['titulo']."</td>";
                    echo "<td>". $res['autor'] ."</td>";
                    echo "<td>". $res['editora'] ."</td>";
                    echo "<td>". $res['paginas'] ."</td>";
                    echo "<td>". $res['publicacao'] ."</td>";
                    echo "<td>";
                    echo "<a href='deletar.php?codigo=". $res['codigo'] ."' class='btn-floating red'><i class='material-icons'>close</i></a>";
                    echo "<a href='editar.php?codigo=". $res['codigo'] ."' class='btn-floating grenn'><i class='material-icons'>edit</i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <div class="container">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the
                            collapse plugin adds the appropriate classes that we use to style each element. These
                            classes
                            control the overall appearance, as well as the showing and hiding via CSS transitions. You
                            can
                            modify any of this with custom CSS or overriding our default variables. It's also worth
                            noting
                            that just about any HTML can go within the <code>.accordion-body</code>, though the
                            transition
                            does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="adicionar.php">Adicionar</a><br><br>
        <h2><a href="logout.php">Sair</a></h2>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>