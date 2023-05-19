<?php

require_once 'models/ReservaModel.php';
require_once 'models/MesaModel.php';

class AdminController {
  private $reservaModel;
  private $mesaModel;

  public function __construct() {
    $this->reservaModel = new ReservaModel();
    $this->mesaModel = new MesaModel();
  }

  public function exibirReservas() {
    $reservas = $this->reservaModel->obterReservas();
    return $reservas;
  }

  public function editarReserva($id) {
    $reserva = $this->reservaModel->obterReservaPorId($id);

    if ($reserva) {
      require 'views/editar_reserva.php';
    } else {
      echo "A reserva não foi encontrada.";
    }
  }

  public function atualizarReserva($id, $novosDados) {
    if ($this->reservaModel->atualizarReserva($id, $novosDados)) {
      header("Location: reservas.php");
      exit;
    } else {
      echo "Erro ao atualizar a reserva. Por favor, tente novamente.";
    }
  }

  public function cancelarReserva($id) {
    if ($this->reservaModel->cancelarReserva($id)) {
      header("Location: reservas.php");
      exit;
    } else {
      echo "Erro ao cancelar a reserva. Por favor, tente novamente.";
    }
  }

  public function gerenciarMesas() {
    $mesasDisponiveis = $this->mesaModel->obterMesasDisponiveis();
    require 'views/gerenciar_mesas.php';
  }
}