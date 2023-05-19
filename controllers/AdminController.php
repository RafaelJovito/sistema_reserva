<?php

require_once 'models/ReservaModel.php';

class AdminController {
  private $reservaModel;

  public function __construct() {
    $this->reservaModel = new ReservaModel();
  }

  public function exibirReservas() {
    $reservas = $this->reservaModel->obterReservas();
    require 'views/admin/reservas.php';
  }

  public function editarReserva($id) {
    // Lógica para obter os detalhes da reserva com o ID fornecido
    $reserva = $this->reservaModel->obterReservaPorId($id);

    // Verificar se a reserva existe
    if ($reserva) {
      // Lógica para exibir o formulário de edição da reserva
      require 'views/admin/editar_reserva.php';
    } else {
      // A reserva não foi encontrada, exiba uma mensagem de erro
      echo "A reserva não foi encontrada.";
    }
  }

  public function atualizarReserva($id) {
    // Lógica para atualizar os dados da reserva com o ID fornecido

    // Verificar se a reserva foi atualizada com sucesso
    if ($this->reservaModel->atualizarReserva($id, $novosDados)) {
      // A reserva foi atualizada com sucesso, redirecionar para a página de exibição de reservas
      header("Location: /admin/reservas");
      exit;
    } else {
      // Ocorreu um erro ao atualizar a reserva, exiba uma mensagem de erro
      echo "Erro ao atualizar a reserva. Por favor, tente novamente.";
    }
  }

  public function cancelarReserva($id) {
    // Lógica para cancelar a reserva com o ID fornecido

    // Verificar se a reserva foi cancelada com sucesso
    if ($this->reservaModel->cancelarReserva($id)) {
      // A reserva foi cancelada com sucesso, redirecionar para a página de exibição de reservas
      header("Location: /admin/reservas");
      exit;
    } else {
      // Ocorreu um erro ao cancelar a reserva, exiba uma mensagem de erro
      echo "Erro ao cancelar a reserva. Por favor, tente novamente.";
    }
  }

  public function gerenciarMesas() {
    // Obter todas as mesas disponíveis
    $mesas = $this->mesaModel->obterMesasDisponiveis();

    // Exibir a lista de mesas disponíveis e permitir ações de gerenciamento
    require 'views/gerenciar_mesas.php';
  }
}