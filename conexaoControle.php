<?php
//CONEXÃO COM O BANCO PARA EMPRESTIMO

$servidor = "localhost";
$usuario ="root";
$senha = "";
$nomeBanco = "controle";

$conexaob = mysqli_connect($servidor,$usuario,$senha,$nomeBanco);
mysqli_set_charset($conexaob, "utf8");

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