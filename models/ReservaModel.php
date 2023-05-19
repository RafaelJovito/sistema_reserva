<?php

require_once '../config/conexao.php';

class ReservaModel {
  private $conexao;

  public function __construct() {
    $this->conexao = conectar();
  }

  public function obterReservas() {
    $sql = "SELECT * FROM reservas";
    $resultado = mysqli_query($this->conexao, $sql);

    if (!$resultado) {
      die("Erro na consulta: " . mysqli_error($this->conexao));
    }

    $reservas = array();
    while ($row = mysqli_fetch_assoc($resultado)) {
      $reservas[] = $row;
    }

    return $reservas;
  }

  public function obterReservaPorId($id) {
    $sql = "SELECT * FROM reservas WHERE id = '$id'";
    $resultado = mysqli_query($this->conexao, $sql);

    if (!$resultado) {
      die("Erro na consulta: " . mysqli_error($this->conexao));
    }

    $reserva = mysqli_fetch_assoc($resultado);

    return $reserva;
  }

  public function atualizarReserva($id, $novosDados) {
    // Obter os dados existentes da reserva com base no ID
    $reservaExistente = $this->reservaModel->obterReservaPorId($id);

    // Verificar se a reserva existe
    if (!$reservaExistente) {
        echo "Reserva não encontrada.";
        return;
    }

    // Mesclar os novos dados com os dados existentes da reserva
    $dadosAtualizados = array_merge($reservaExistente, $novosDados);

    // Executar a lógica de atualização da reserva, por exemplo:
    $atualizacaoRealizada = $this->reservaModel->atualizarReservaNoBanco($id, $dadosAtualizados);

    // Verificar se a atualização foi bem-sucedida
    if ($atualizacaoRealizada) {
        echo "Reserva atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar a reserva. Por favor, tente novamente.";
    }
}

  public function cancelarReserva($id) {
    // Verificar se a reserva existe
    $reservaExistente = $this->reservaModel->obterReservaPorId($id);
    if (!$reservaExistente) {
          echo "Reserva não encontrada.";
          return;
    }

    // Executar a lógica de cancelamento da reserva, por exemplo:
    $cancelamentoRealizado = $this->reservaModel->cancelarReservaNoBanco($id);

    // Verificar se o cancelamento foi bem-sucedido
    if ($cancelamentoRealizado) {
        echo "Reserva cancelada com sucesso!";
    } else {
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