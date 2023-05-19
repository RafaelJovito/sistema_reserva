<?php

require_once '../config/conexao.php';

class MesaModel {
    private $conexao;

    public function __construct() {
        $this->conexao = conectar();
    }

    public function getMesasDisponiveis() {
        $sql = "SELECT * FROM mesas WHERE status = 'disponivel'";
        $resultado = mysqli_query($this->conexao, $sql);

        if (!$resultado) {
            die("Erro na consulta: " . mysqli_error($this->conexao));
        }

        $mesas = array();
        while ($row = mysqli_fetch_assoc($resultado)) {
            $mesas[] = $row;
        }

        return $mesas;
    }

    public function reservarMesa($numeroMesa, $nomeCliente, $dataReserva, $horaReserva) {
        // Verificar se a mesa selecionada está disponível
        $sql = "SELECT * FROM mesas WHERE numero_mesa = $numeroMesa AND status = 'disponivel'";
        $resultado = mysqli_query($this->conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            // A mesa está disponível, então verifica o horário de reserva
            $horariosReserva = include 'horarios.php';
            if (!in_array($horaReserva, $horariosReserva)) {
                // Horário de reserva inválido
                return false;
            }

            // Preparar os valores para inserção na consulta SQL
            $numeroMesa = mysqli_real_escape_string($this->conexao, $numeroMesa);
            $nomeCliente = mysqli_real_escape_string($this->conexao, $nomeCliente);
            $dataReserva = mysqli_real_escape_string($this->conexao, $dataReserva);
            $horaReserva = mysqli_real_escape_string($this->conexao, $horaReserva);

            // Realizar a reserva usando prepared statements
            $sql = "INSERT INTO reservas (numero_mesa, nome_cliente, data_reserva, hora_reserva) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->conexao, $sql);
            mysqli_stmt_bind_param($stmt, "isss", $numeroMesa, $nomeCliente, $dataReserva, $horaReserva);
            $resultado = mysqli_stmt_execute($stmt);

            if ($resultado) {
                // A reserva foi realizada com sucesso
                return true;
            } else {
                // Ocorreu um erro ao inserir os dados da reserva
                return false;
            }
        } else {
            // A mesa já foi reservada por outro cliente
            return false;
        }
    }
}
