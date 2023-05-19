<?php
// Verifica se o usuário está autenticado
session_start();
if (!isset($_SESSION['nome_usuario'])) {
    header('Location: login.php');
    exit;
}
// Obtém o nome do usuário logado
$nomeUsuario = $_SESSION['nome_usuario'];

// Aqui você pode adicionar o código para buscar as reservas e outras informações necessárias
// ...

// Logout do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_destroy();
    header('Location: ../index.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Página de Administração</h1>

        <h2 class="mt-4">Olá, <?php echo $nomeUsuario; ?></h2>
        <form action="../index.php" method="post">
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
        <h2 class="mt-4">Reservas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Cliente</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($reserva = mysqli_fetch_assoc($resultadoReservas)) { ?>
                    <tr>
                        <td><?php echo $reserva['id']; ?></td>
                        <td><?php echo $reserva['data']; ?></td>
                        <td><?php echo $reserva['horario']; ?></td>
                        <td><?php echo $reserva['cliente']; ?></td>
                        <td>
                            <a href="editar_reserva.php?id=<?php echo $reserva['id']; ?>" class="btn btn-primary">Editar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2 class="mt-4">Gerenciar Mesas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($mesa = mysqli_fetch_assoc($resultadoMesas)) { ?>
                    <tr>
                        <td><?php echo $mesa['id']; ?></td>
                        <td><?php echo $mesa['nome']; ?></td>
                        <td><?php echo $mesa['descricao']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>