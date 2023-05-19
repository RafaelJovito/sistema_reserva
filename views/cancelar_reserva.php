<?php
require_once '../config/conexao.php';

// Verificar a autenticação do usuário, se necessário

// Estabelecer a conexão com o banco de dados
$conexao = conectar();

// Recupera o ID da reserva da URL
$reservaId = $_GET['id'];

// Consulta SQL para recuperar os dados da reserva
$sql = "SELECT * FROM reservas WHERE id = $reservaId";
$resultado = mysqli_query($conexao, $sql);
$reserva = mysqli_fetch_assoc($resultado);

// Verifica se a reserva existe
if (!$reserva) {
    echo "Reserva não encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cancelar Reserva - Sistema de Reserva de Mesas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Cancelar Reserva</h1>
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Cancelar Reserva</h4>
            <p>Tem certeza de que deseja cancelar esta reserva?</p>
            <p><strong>Data:</strong> <?php echo $reserva['data']; ?></p>
            <p><strong>Hora:</strong> <?php echo $reserva['hora']; ?></p>
            <p><strong>Número de Pessoas:</strong> <?php echo $reserva['num_pessoas']; ?></p>
            <hr>
            <p class="mb-0">Essa ação não pode ser desfeita.</p>
        </div>
        <form action="confirma_cancelamento.php" method="POST">
            <input type="hidden" name="reserva_id" value="<?php echo $reservaId; ?>">
            <button type="submit" class="btn btn-danger">Confirmar Cancelamento</button>
            <a href="index.php" class="btn btn-secondary">Voltar à Página Inicial</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>