<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <title>Sistema de Login</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-5">
                <div class="text-center m-10">
                    <h2>Login</h2>
                </div>
                <?php
                    if(isset($_SESSION['nao_autenticado'])):
                    ?>
                <div class="notification is-danger">
                    <p>ERRO: Usuário ou senha inválidos.</p>
                </div>
                <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                    ?>
                <form action="login.php" method="POST">
                    <div class="qq">
                        <input class="form-item form-control" name=" usuario" placeholder="Seu usuário" autofocus=""
                            required>
                    </div>

                    <div class="qq">
                        <input class="form-item form-control" name="senha" class="input is-large" type="password"
                            placeholder="Sua senha" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Entrar</button>
                </form>
                <div>
                    <a href="cadastro.php">Cadastrar</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>

</html>