<?php

require_once 'models/ClienteModel.php';

class ClienteController {
  private $clienteModel;

  public function __construct() {
    $this->clienteModel = new ClienteModel();
  }

  public function cadastrarCliente() {
    // Verificar se o formulário de cadastro foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obtém os dados do formulário
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $telefone = $_POST['telefone'];

      // Realizar a operação de cadastro do cliente
      $resultado = $this->clienteModel->cadastrarCliente($nome, $email, $telefone);

      if ($resultado) {
        // O cadastro foi realizado com sucesso
        echo "Cliente cadastrado com sucesso!";
      } else {
        // Ocorreu um erro ao cadastrar o cliente
        echo "Erro ao cadastrar o cliente. Por favor, tente novamente.";
      }
    }

    // Carregar a view de cadastro de cliente
    require 'views/cliente/cadastro.php';
  }

}