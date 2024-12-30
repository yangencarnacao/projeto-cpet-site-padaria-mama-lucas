CREATE DATABASE padaria CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

use padaria;
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);


INSERT INTO produtos (nome, categoria, preco)
VALUES
  ('Pão Francês', 'Pães', 2.50),
  ('Pão Integral', 'Pães', 3.50),
  ('Pacote de Pão de Forma', 'Pães', 8.00),
  ('Pão de Centeio', 'Pães', 5.50),
  ('Broa de milho', 'Doces', 3.50),
  ('Bolo de Chocolate', 'Doces', 18.00),
  ('Tortinha de Limão', 'Doces', 8.50),
  ('Brigadeiro', 'Doces', 3.00),
  ('Quindim', 'Doces', 5.00),
  ('Pastel', 'Salgados', 6.50),
  ('Empada de Frango', 'Salgados', 4.00),
  ('Empadão', 'Salgados', 6.50),
  ('Quiche de Queijo', 'Salgados', 10.50),
  ('Esfiha', 'Salgados', 4.00);



USE padaria;
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(20),
    endereco VARCHAR(255)
);

