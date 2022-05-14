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
    <!--meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <div>
        <h3 class="center">Dashboard</h3>
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
        <a href="adicionar.php" >Adicionar</a><br><br>
        <h2><a href="logout.php">Sair</a></h2>
    </div>
</body>
</html>