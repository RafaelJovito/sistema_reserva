<?php
require_once '../config/conexao.php';

// Estabelecer a conexão com o banco de dados
$conexao = conectar();

// Recupera os dados do formulário
$reservaId = $_POST['reserva_id'];
$data = $_POST['data'];
$hora = $_POST['hora'];
$numPessoas = $_POST['num_pessoas'];

// Atualiza a reserva no banco de dados
$sql = "UPDATE reservas SET data = '$data', hora = '$hora', num_pessoas = $numPessoas WHERE id = $reservaId";
$resultado = mysqli_query($conexao, $sql);

// Verifica se a atualização foi bem-sucedida
if ($resultado) {
    echo "Reserva atualizada com sucesso!";
} else {
    echo "Erro ao atualizar a reserva: " . mysqli_error($conexao);
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>