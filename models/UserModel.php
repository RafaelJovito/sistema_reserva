<?php
require_once 'config/config.php';
class UserModel {
    private $conexao;

    public function __construct() {
        // Conexão com o banco de dados
        $servidor = 'localhost';
        $usuarioBD = 'root';
        $senhaBD = 'EAD2020$%';
        $nomeBD = 'sistema_reserva';

        $this->conexao = mysqli_connect($servidor, $usuarioBD, $senhaBD, $nomeBD);

        if (!$this->conexao) {
            die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
        }
    }

    public function getUserByUsername($username) {
        // Prepara a consulta SQL utilizando uma instrução preparada
        $query = "SELECT * FROM usuarios WHERE nome_usuario = ?";
        $stmt = mysqli_prepare($this->conexao, $query);
    
        if (!$stmt) {
            die("Erro na preparação da consulta: " . mysqli_error($this->conexao));
        }
    
        // Vincula o parâmetro
        mysqli_stmt_bind_param($stmt, "s", $username);
    
        // Executa a consulta preparada
        mysqli_stmt_execute($stmt);
    
        // Obtém o resultado da consulta
        $resultado = mysqli_stmt_get_result($stmt);
    
        if (!$resultado) {
            die("Erro na obtenção do resultado da consulta: " . mysqli_error($this->conexao));
        }
    
        // Verifica se a consulta teve resultados
        if (mysqli_num_rows($resultado) === 1) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null;
        }
    }

    function verifyPassword($password, $storedPassword) {
        // Verifica se a senha fornecida corresponde à senha armazenada
        return $password === $storedPassword;
    }
}