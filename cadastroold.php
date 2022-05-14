<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Cadastro</title>
</head>

<body>
    <div>
        <h3>Sistema de Cadastro</h3>
        <?php
                    if(isset($_SESSION['usuario_existe'])):
                    ?>
        <div>
            <p>ERRO: Usuário já existe.</p>
        </div>
        <?php
                    endif;
                    unset($_SESSION['usuario_existe']);
                    ?>
        <?php
        if(isset($_SESSION['status_cadastro'])):
        ?>
        <div>
            <p>Cadastro efetuado com sucesso.</p>
        </div>
        <?php
        endif;
        unset($_SESSION['status_cadastro']);
        ?>

        <div>
            <form action="cadastrar.php" method="POST">
                <div>
                    <input name="nome" type="text" placeholder="Nome" autofocus required>
                </div>
                <div>
                    <input name="usuario" type="text" placeholder="Usuário" required>
                </div>
                <div>
                    <input name="senha" type="password" placeholder="Senha" required>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
    <div>
        <a href="index.php">Página de Login</a>
    </div>
    </section>
</body>

</html>