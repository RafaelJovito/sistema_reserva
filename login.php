<?php
require_once 'controllers/LoginController.php';

// Verifica se o formulário de login foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém as credenciais do usuário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cria uma instância do LoginController
    $loginController = new LoginController();

    // Autentica o usuário
    if ($loginController->autenticarUsuario($username, $password)) {
        // Autenticação bem-sucedida, redireciona para a página de administração
        session_start();
        $_SESSION['nome_usuario'] = $username;
        $_SESSION['senha'] = $password;
        header('Location: views/admin.php');
        exit;
    } else {
        // Autenticação falhou, exibe uma mensagem de erro
        $mensagemErro = 'Usuário ou senha incorretos. Tente novamente.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Sistema de Reserva</h1>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Login</h3>
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                        <?php if (isset($mensagemErro)) { ?>
                            <div class="alert alert-danger mt-3"><?php echo $mensagemErro; ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>