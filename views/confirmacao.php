<?php
require_once '../config/conexao.php';

// Estabelece a conexão com o banco de dados
$conexao = conectar();

// Verifica se o ID da reserva foi fornecido via parâmetro na URL
if (isset($_GET['id'])) {
    $idReserva = $_GET['id'];

    // Consulta SQL para obter os detalhes da reserva com base no ID
    $sql = "SELECT * FROM reservas WHERE id = $idReserva";
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se a reserva existe no banco de dados
    if (mysqli_num_rows($resultado) > 0) {
        $reserva = mysqli_fetch_assoc($resultado);
    } else {
        // A reserva não foi encontrada
        echo "Reserva não encontrada.";
        exit;
    }
} else {
    // O ID da reserva não foi fornecido
    echo "ID da reserva não especificado.";
    exit;
}
?>

<html>
<head>
    <title>Confirmação de Reserva - Sistema de Reserva de Mesas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Confirmação de Reserva</h1>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Reserva Confirmada!</h4>
            <p>A sua reserva foi confirmada com sucesso. Abaixo estão os detalhes da reserva:</p>
            <ul>
                <li><strong>Data:</strong> <?php echo $reserva['data']; ?></li>
                <li><strong>Hora:</strong> <?php echo $reserva['hora']; ?></li>
                <li><strong>Número de Pessoas:</strong> <?php echo $reserva['num_pessoas']; ?></li>
            </ul>
            <hr>
            <p class="mb-0">Obrigado por utilizar nosso sistema de reservas!</p>
        </div>
        <a href="index.php" class="btn btn-primary">Voltar à Página Inicial</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>