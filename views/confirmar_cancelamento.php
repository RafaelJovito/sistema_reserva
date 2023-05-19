<?php
require_once '../config/conexao.php';

// Estabelecer a conexão com o banco de dados
$conexao = conectar();

// Recupera o ID da reserva
$reservaId = $_POST['reserva_id'];

// Atualiza o status da reserva para cancelado no banco de dados
$sql = "UPDATE reservas SET status = 'cancelado' WHERE id = $reservaId";
$resultado = mysqli_query($conexao, $sql);

// Verifica se o cancelamento foi bem-sucedido
if ($resultado) {
    echo "Reserva cancelada com sucesso!";
} else {
    echo "Erro ao cancelar a reserva: " . mysqli_error($conexao);
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>