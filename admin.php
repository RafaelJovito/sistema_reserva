<?php
require_once '../config/conexao.php';

// Estabelece a conexão com o banco de dados
$conexao = conectar();

// Verifica se o formulário de cancelamento foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém o ID da reserva a ser cancelada
    $idReserva = $_POST['id_reserva'];

    // Atualiza o status da reserva para "cancelada" no banco de dados
    $sql = "UPDATE reservas SET status = 'cancelada' WHERE id = $idReserva";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        // O cancelamento foi bem-sucedido
        echo "Reserva cancelada com sucesso!";
    } else {
        // Ocorreu um erro ao atualizar o status da reserva
        echo "Erro ao cancelar a reserva. Por favor, tente novamente.";
    }
}

// Consulta SQL para recuperar todas as reservas feitas
$sql = "SELECT * FROM reservas";
$resultado = mysqli_query($conexao, $sql);
$reservas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Administração - Sistema de Reserva de Mesas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Página de Administração</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Número de Pessoas</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>10/05/2023</td>
                    <td>19:30</td>
                    <td>4</td>
                    <td>Confirmada</td>
                    <td>
                        <a href="editar_reserva.php?id=1" class="btn btn-primary">Editar</a>
                        <a href="cancelar_reserva.php?id=1" class="btn btn-danger">Cancelar</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>15/05/2023</td>
                    <td>20:00</td>
                    <td>2</td>
                    <td>Pendente</td>
                    <td>
                        <a href="editar_reserva.php?id=2" class="btn btn-primary">Editar</a>
                        <a href="cancelar_reserva.php?id=2" class="btn btn-danger">Cancelar</a>
                    </td>
                </tr>
                <!-- Adicione mais linhas conforme necessário -->
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Voltar à Página Inicial</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>