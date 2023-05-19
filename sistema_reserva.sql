-- Criação do banco de dados 'sistema_reserva'
CREATE DATABASE sistema_reserva;

-- Utilização do banco de dados 'sistema_reserva'
USE sistema_reserva;

-- Criação da tabela 'usuarios'
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Criação da tabela 'mesas'
CREATE TABLE mesas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_mesa INT NOT NULL,
    status VARCHAR(20) NOT NULL
);

-- Criação da tabela 'reservas'
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_mesa INT NOT NULL,
    nome_cliente VARCHAR(100) NOT NULL,
    data_reserva DATE NOT NULL,
    hora_reserva TIME NOT NULL,
    status VARCHAR(20) NOT NULL
);

-- Inserção de um usuário administrador
INSERT INTO usuarios (nome_usuario, senha) VALUES ('admin', '1234');

-- Inserção de mesas disponíveis
INSERT INTO mesas (numero_mesa, status) VALUES
(1, 'disponivel'),
(2, 'disponivel'),
(3, 'disponivel');

-- Inserção de reservas de exemplo
INSERT INTO reservas (numero_mesa, nome_cliente, data_reserva, hora_reserva, status) VALUES
(1, 'Cliente 1', '2023-05-20', '18:00', 'confirmada'),
(2, 'Cliente 2', '2023-05-21', '19:30', 'confirmada'),
(3, 'Cliente 3', '2023-05-22', '20:00', 'pendente');
