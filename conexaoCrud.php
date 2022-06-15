<?php
//CONEXÃO COM O BANCO PARA CRUD

$servidor = "localhost";
$usuario ="root";
$senha = "";
$nomeBanco = "books_system";

$conexao = mysqli_connect($servidor,$usuario,$senha,$nomeBanco);
mysqli_set_charset($conexao, "utf8");

if(mysqli_connect_error()){
    echo "
    
    <script>
        console.log('Erro na conexão!')
    </script> 
    
    ";
} else {
    echo "
    
    <script>
        console.log('Conectado com Sucesso!!')
    </script> 
    
    ";

}