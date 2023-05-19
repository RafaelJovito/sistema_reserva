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
    <title>Editar Reserva - Sistema de Reserva de Mesas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Editar Reserva</h1>
        <!-- Formulário de edição de reserva -->
        <form action="atualizar_reserva.php" method="POST">
            <input type="hidden" name="reserva_id" value="<?php echo $reserva['id']; ?>">
            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="data" name="data" value="<?php echo $reserva['data']; ?>">
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora" name="hora" value="<?php echo $reserva['hora']; ?>">
            </div>
            <div class="mb-3">
                <label for="numero-pessoas" class="form-label">Número de Pessoas</label>
                <input type="number" class="form-control" id="numero-pessoas" name="num_pessoas" value="<?php echo $reserva['num_pessoas']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="admin.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>