<?php
require_once 'config/config.php';

// Conexão com o banco de dados
function conectar() {
    $conexao = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Verifica se ocorreu algum erro na conexão
    if (mysqli_connect_errno()) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    return $conexao;
}
?>