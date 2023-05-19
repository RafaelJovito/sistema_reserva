<?php
require_once '../config/conexao.php';

$conexao = conectar();

// Verifica se o formulário de reserva foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $numeroMesa = $_POST['numero_mesa'];
    $nomeCliente = $_POST['nome_cliente'];
    $dataReserva = $_POST['data_reserva'];
    $horaReserva = $_POST['hora_reserva'];

    // Verifica se a mesa selecionada está disponível
    $sql = "SELECT * FROM mesas WHERE numero_mesa = $numeroMesa AND status = 'disponivel'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        // A mesa está disponível, então realiza a reserva
        $sql = "INSERT INTO reservas (numero_mesa, nome_cliente, data_reserva, hora_reserva) VALUES ('$numeroMesa', '$nomeCliente', '$dataReserva', '$horaReserva')";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            // A reserva foi realizada com sucesso
            echo "Reserva realizada com sucesso!";
        } else {
            // Ocorreu um erro ao inserir os dados da reserva
            echo "Erro ao realizar a reserva. Por favor, tente novamente.";
        }
    } else {
        // A mesa já foi reservada por outro cliente
        echo "Desculpe, a mesa selecionada não está mais disponível. Por favor, escolha outra mesa.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Reservas</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Mesa</th>
                    <th scope="col">Data</th>
                    <th scope="col">Hora</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Cliente 1</td>
                    <td>Mesa 1</td>
                    <td>2023-05-18</td>
                    <td>18:30</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Cliente 2</td>
                    <td>Mesa 3</td>
                    <td>2023-05-19</td>
                    <td>19:00</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Cliente 3</td>
                    <td>Mesa 2</td>
                    <td>2023-05-20</td>
                    <td>20:30</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>