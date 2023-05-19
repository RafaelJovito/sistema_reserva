<?php

require_once 'models/MesaModel.php';

class ReservaController {
    private $mesaModel;

    public function __construct() {
        $this->mesaModel = new MesaModel();
    }

    public function obterMesasDisponiveis() {
        $mesas = $this->mesaModel->obterMesasDisponiveis();
        return $mesas;
    }

    public function exibirReservaMesas() {
        $mesas = $this->mesaModel->obterMesasDisponiveis();
        require 'views/reserva_mesas.php';
    }

    public function processarReserva() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numeroMesa = $_POST['numero_mesa'];
            $nomeCliente = $_POST['nome_cliente'];
            $dataReserva = $_POST['data_reserva'];
            $horaReserva = $_POST['hora_reserva'];

            // Verificar se todos os campos estão preenchidos
            if (empty($numeroMesa) || empty($nomeCliente) || empty($dataReserva) || empty($horaReserva)) {
                echo "Por favor, preencha todos os campos do formulário.";
                return; // Retorna para interromper o processamento caso haja campos vazios
            }

            // Verificar se a data da reserva é domingo
            $reservaData = strtotime($dataReserva);
            $diaSemana = date('w', $reservaData);
            if ($diaSemana == 0) {
                echo "Não é possível fazer reservas aos domingos.";
                return; // Retorna para interromper o processamento caso seja domingo
            }

            // Verificar se o horário de reserva é válido de acordo com os horários configurados
            $horariosReserva = include 'horarios.php';
            if (!in_array($horaReserva, $horariosReserva)) {
                echo "Horário de reserva inválido. Por favor, escolha um horário válido.";
                return; // Retorna para interromper o processamento caso o horário não seja válido
            }

            // Verificar se a mesa selecionada está disponível
            $mesaDisponivel = $this->mesaModel->verificarMesaDisponivel($numeroMesa);

            if ($mesaDisponivel) {
                // Verificar se o número máximo de mesas já foi atingido
                $numMesas = $this->mesaModel->contarMesas();
                $maxMesas = 15;
                if ($numMesas >= $maxMesas) {
                    echo "Desculpe, o número máximo de mesas do estabelecimento foi atingido.";
                    return; // Retorna para interromper o processamento caso o número máximo de mesas tenha sido atingido
                }

                // Realizar a reserva
                $reservaRealizada = $this->mesaModel->realizarReserva($numeroMesa, $nomeCliente, $dataReserva, $horaReserva);

                if ($reservaRealizada) {
                    echo "Reserva realizada com sucesso!";
                } else {
                    echo "Erro ao realizar a reserva. Por favor, tente novamente.";
                }
            } else {
                echo "Desculpe, a mesa selecionada não está mais disponível. Por favor, escolha outra mesa.";
            }
        }
    }
}