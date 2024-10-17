create database IF NOT EXISTS empresa;

use empresa;
-- Criação tabelas Pais --
create table fornecedores(
fornecedor_id  int(11) auto_increment primary key,
nome varchar(100) not null,
telefone varchar(20) not null,
email varchar(100) not null,
endereco varchar (25)
);

create table setores(
setor_id int(11) auto_increment primary key,
nome varchar(100) not null,
descricao text
);

create table categorias(
categoria_id int(11) auto_increment primary key,
nome varchar(100) not null,
descricao text
);

-- Criação tabelas Filhos --
create table produtos(
produto_id  int(11) auto_increment primary key,
nome varchar(100) not null,
descricao text not null,
categoria_id int not null,
preco_venda decimal(10,2),
preco_custo decimal(10,2),
quantidade_estoque int,
unidade_medida varchar(200),
fornecedor_id int not null,
foreign key (categoria_id) references categorias(categoria_id),
foreign key (fornecedor_id) references fornecedores(fornecedor_id)
);

create table estoque(
estoque_id  int(11) auto_increment primary key,
produto_id int not null,
tipo_movimentacao enum('x-produto','y-produto','z-produto') not null,
quantidade int not null,
data_movimentacao datetime,
foreign key (produto_id) references produtos(produto_id)
);

create table funcionarios(
funcionario_id  int(11) auto_increment primary key,
nome varchar(100) not null,
cargo varchar(50) not null,
setor_id int not null,
telefone varchar(20),
email varchar(100) not null,
data_admissao date not null,
salario decimal(10,2),
metodo_pagamento varchar(50),
foreign key (setor_id) references setores(setor_id)
);

create table manutencoes(
manutencao_id  int(11) auto_increment primary key,
equipamento varchar(100) not null,
descricao_problema text not null,
data_inicio datetime not null,
data_termino datetime not null,
tecnico_responsavel varchar(100),
status enum('quebrado','funcional'),
responsavel_id int not null,
foreign key (responsavel_id) references funcionarios(funcionario_id)
);

create table pedidos(
pedido_id  int(11) auto_increment primary key,
data_pedido datetime not null,
status enum('Ativo', 'Inativo', 'Suspenso') not null,
valor_total decimal(10,2),
funcionario_id int not null,
foreign key (funcionario_id) references funcionarios(funcionario_id)
);

create table itens_pedidos(
itempedido_id  int(11) auto_increment primary key,
pedido_id int not null,
produto_id int not null,
quantidade int not null,
foreign key (pedido_id) references pedidos(pedido_id),
foreign key (produto_id) references produtos(produto_id)
);


INSERT INTO setores (nome, descricao) VALUES
('Setor A', 'Responsável pela produção'),
('Setor B', 'Setor de logística e transporte'),
('Setor C', 'Departamento financeiro'),
('Setor D', 'Recursos humanos'),
('Setor E', 'Manutenção e reparos'),
('Setor F', 'Suporte ao cliente'),
('Setor G', 'Vendas e marketing');

INSERT INTO categorias (nome, descricao) VALUES
('Categoria A', 'Categoria de eletrônicos'),
('Categoria B', 'Categoria de materiais de escritório'),
('Categoria C', 'Categoria de produtos alimentícios'),
('Categoria D', 'Categoria de vestuário'),
('Categoria E', 'Categoria de móveis'),
('Categoria F', 'Categoria de cosméticos'),
('Categoria G', 'Categoria de produtos de limpeza'),
('Categoria H', 'Categoria de brinquedos'),
('Categoria I', 'Categoria de ferramentas'),
('Categoria J', 'Categoria de materiais esportivos'),
('Categoria K', 'Categoria de produtos automotivos'),
('Categoria L', 'Categoria de livros e publicações'),
('Categoria M', 'Categoria de medicamentos'),
('Categoria N', 'Categoria de jardinagem'),
('Categoria O', 'Categoria de acessórios eletrônicos'),
('Categoria P', 'Categoria de artigos para pets'),
('Categoria Q', 'Categoria de produtos de beleza'),
('Categoria R', 'Categoria de alimentos congelados');

INSERT INTO fornecedores (nome, telefone, email, endereco) VALUES
('Fornecedor A', '11999990000', 'fornecedorA@example.com', 'Rua 1, Nº 100'),
('Fornecedor B', '21999990001', 'fornecedorB@example.com', 'Rua 2, Nº 101'),
('Fornecedor C', '31999990002', 'fornecedorC@example.com', 'Rua 3, Nº 102'),
('Fornecedor D', '41999990003', 'fornecedorD@example.com', 'Rua 4, Nº 103'),
('Fornecedor E', '51999990004', 'fornecedorE@example.com', 'Rua 5, Nº 104'),
('Fornecedor F', '61999990005', 'fornecedorF@example.com', 'Rua 6, Nº 105'),
('Fornecedor G', '71999990006', 'fornecedorG@example.com', 'Rua 7, Nº 106'),
('Fornecedor H', '81999990007', 'fornecedorH@example.com', 'Rua 8, Nº 107'),
('Fornecedor I', '91999990008', 'fornecedorI@example.com', 'Rua 9, Nº 108'),
('Fornecedor J', '11999990009', 'fornecedorJ@example.com', 'Rua 10, Nº 109'),
('Fornecedor K', '21999990010', 'fornecedorK@example.com', 'Rua 11, Nº 110'),
('Fornecedor L', '31999990011', 'fornecedorL@example.com', 'Rua 12, Nº 111');


INSERT INTO produtos (nome, descricao, preco_venda, quantidade_estoque, fornecedor_id, categoria_id) VALUES
('Produto A1', 'Descrição do Produto A1', 25.90, 50, 1, 1),
('Produto A2', 'Descrição do Produto A2', 15.75, 100, 2, 2),
('Produto A3', 'Descrição do Produto A3', 45.20, 30, 3, 3),
('Produto A4', 'Descrição do Produto A4', 120.00, 25, 4, 4),
('Produto A5', 'Descrição do Produto A5', 80.00, 40, 5, 5),
('Produto A6', 'Descrição do Produto A6', 18.00, 200, 6, 6),
('Produto A7', 'Descrição do Produto A7', 50.00, 75, 7, 7),
('Produto A8', 'Descrição do Produto A8', 60.50, 60, 8, 8),
('Produto A9', 'Descrição do Produto A9', 90.00, 20, 9, 9),
('Produto A10', 'Descrição do Produto A10', 45.99, 10, 10, 10),
('Produto A11', 'Descrição do Produto A11', 39.00, 150, 11, 11),
('Produto A12', 'Descrição do Produto A12', 25.50, 80, 12, 12);

INSERT INTO funcionarios (nome, email, cargo, salario, data_admissao, setor_id) VALUES
('João Silva', 'exemplo@email.com', 'Analista de Sistemas', 5000.00, '2021-01-15', 1),
('Maria Oliveira', 'exemplo@email.com', 'Gerente de Vendas', 7000.00, '2020-03-12', 2),
('Carlos Souza', 'exemplo@email.com', 'Coordenador de Logística', 5500.00, '2019-05-22', 3),
('Ana Paula', 'exemplo@email.com', 'Assistente Administrativo', 3000.00, '2021-07-18', 4),
('Roberto Costa', 'exemplo@email.com', 'Engenheiro de Produção', 6000.00, '2020-09-10', 5),
('Fernanda Lima', 'exemplo@email.com', 'Analista Financeiro', 4800.00, '2018-11-05', 6),
('Marcelo Santos', 'exemplo@email.com', 'Desenvolvedor de Software', 4500.00, '2021-02-27', 7);



INSERT INTO estoque (produto_id, tipo_movimentacao, quantidade, data_movimentacao) VALUES
(1, 'x-produto', 20, '2024-01-15 14:30:00'),
(2, 'y-produto', 15, '2024-01-16 10:00:00'),
(3, 'z-produto', 30, '2024-01-17 11:00:00'),
(4, 'x-produto', 50, '2024-01-18 13:15:00'),
(5, 'y-produto', 25, '2024-01-19 16:45:00'),
(6, 'z-produto', 60, '2024-01-20 09:00:00'),
(7, 'x-produto', 12, '2024-01-21 08:30:00'),
(8, 'y-produto', 18, '2024-01-22 14:10:00'),
(9, 'z-produto', 22, '2024-01-23 15:50:00'),
(10, 'x-produto', 28, '2024-01-24 12:00:00');

INSERT INTO funcionarios (nome, cargo, setor_id, telefone, email, data_admissao, salario, metodo_pagamento) VALUES
('Carlos Silva', 'Analista Financeiro', 1, '(11) 9988-7766', 'carlos.silva@empresa.com', '2023-01-10', 3500.00, 'Transferência Bancária'),
('Maria Oliveira', 'Operador de Produção', 2, '(21) 9977-6655', 'maria.oliveira@empresa.com', '2023-02-15', 2000.00, 'Cheque'),
('José Santos', 'Assistente de RH', 3, '(31) 9966-5544', 'jose.santos@empresa.com', '2023-03-20', 2500.00, 'Transferência Bancária'),
('Ana Costa', 'Vendedor', 4, '(41) 9955-4433', 'ana.costa@empresa.com', '2023-04-25', 3000.00, 'Dinheiro'),
('Luís Almeida', 'Técnico de TI', 5, '(51) 9944-3322', 'luis.almeida@empresa.com', '2023-05-30', 4000.00, 'Transferência Bancária'),
('Fernanda Rocha', 'Supervisor de Logística', 6, '(22) 9933-2211', 'fernanda.rocha@empresa.com', '2023-06-10', 4500.00, 'Cheque'),
('Paulo Mendes', 'Analista de Marketing', 7, '(47) 9922-1100', 'paulo.mendes@empresa.com', '2023-07-15', 3200.00, 'Dinheiro');

INSERT INTO manutencoes (equipamento, descricao_problema, data_inicio, data_termino, tecnico_responsavel, status, responsavel_id) VALUES
('Máquina de Solda', 'Não liga após uso contínuo', '2024-02-01 08:00:00', '2024-02-03 17:00:00', 'Luís Almeida', 'funcional', 5),
('Esteira de Produção', 'Correia desalinhada', '2024-02-04 09:00:00', '2024-02-05 14:00:00', 'Marcos Lima', 'funcional', 9),
('Impressora 3D', 'Problemas na extrusão', '2024-02-06 10:00:00', '2024-02-07 18:00:00', 'Luís Almeida', 'funcional', 5),
('Computador', 'Tela azul da morte', '2024-02-08 11:00:00', '2024-02-09 15:00:00', 'Luís Almeida', 'funcional', 5),
('Empilhadeira', 'Bateria descarregando rapidamente', '2024-02-10 12:00:00', '2024-02-12 16:00:00', 'Marcos Lima', 'funcional', 9),
('Máquina de Corte', 'Fio de corte desgastado', '2024-02-13 13:00:00', '2024-02-14 17:00:00', 'Marcos Lima', 'funcional', 9),
('Central de Ar', 'Problema no compressor', '2024-02-15 14:00:00', '2024-02-17 16:00:00', 'Marcos Lima', 'quebrado', 9),
('Roteador', 'Interrupções frequentes de conexão', '2024-02-18 15:00:00', '2024-02-19 18:00:00', 'Luís Almeida', 'funcional', 5),
('Scanner', 'Digitalização distorcida', '2024-02-20 16:00:00', '2024-02-21 13:00:00', 'Luís Almeida', 'funcional', 5),
('Caminhão', 'Problemas na embreagem', '2024-02-22 17:00:00', '2024-02-25 14:00:00', 'Marcos Lima', 'funcional', 9);

INSERT INTO manutencoes (equipamento, descricao_problema, data_inicio, data_termino, tecnico_responsavel, status, responsavel_id) VALUES
('Máquina de Solda', 'Não liga após uso contínuo', '2024-02-01 08:00:00', '2024-02-03 17:00:00', 'Luís Almeida', 'funcional', 5),
('Esteira de Produção', 'Correia desalinhada', '2024-02-04 09:00:00', '2024-02-05 14:00:00', 'Marcos Lima', 'funcional', 9),
('Impressora 3D', 'Problemas na extrusão', '2024-02-06 10:00:00', '2024-02-07 18:00:00', 'Luís Almeida', 'funcional', 5),
('Computador', 'Tela azul da morte', '2024-02-08 11:00:00', '2024-02-09 15:00:00', 'Luís Almeida', 'funcional', 5),
('Empilhadeira', 'Bateria descarregando rapidamente', '2024-02-10 12:00:00', '2024-02-12 16:00:00', 'Marcos Lima', 'funcional', 9),
('Máquina de Corte', 'Fio de corte desgastado', '2024-02-13 13:00:00', '2024-02-14 17:00:00', 'Marcos Lima', 'funcional', 9),
('Central de Ar', 'Problema no compressor', '2024-02-15 14:00:00', '2024-02-17 16:00:00', 'Marcos Lima', 'quebrado', 9),
('Roteador', 'Interrupções frequentes de conexão', '2024-02-18 15:00:00', '2024-02-19 18:00:00', 'Luís Almeida', 'funcional', 5),
('Scanner', 'Digitalização distorcida', '2024-02-20 16:00:00', '2024-02-21 13:00:00', 'Luís Almeida', 'funcional', 5),
('Caminhão', 'Problemas na embreagem', '2024-02-22 17:00:00', '2024-02-25 14:00:00', 'Marcos Lima', 'funcional', 9);

INSERT INTO pedidos (data_pedido, status, valor_total, funcionario_id) VALUES
('2024-03-01 10:00:00', 'Ativo', 1500.00, 1),
('2024-03-02 11:00:00', 'Inativo', 2000.00, 2),
('2024-03-03 12:00:00', 'Suspenso', 3000.00, 3),
('2024-03-04 13:00:00', 'Ativo', 4000.00, 4),
('2024-03-05 14:00:00', 'Ativo', 500.00, 5),
('2024-03-06 15:00:00', 'Inativo', 700.00, 6),
('2024-03-07 16:00:00', 'Suspenso', 2500.00, 7),
('2024-03-08 17:00:00', 'Ativo', 800.00, 8),
('2024-03-09 18:00:00', 'Ativo', 1250.00, 9),
('2024-03-10 19:00:00', 'Inativo', 1600.00, 10);

INSERT INTO itens_pedidos (pedido_id, produto_id, quantidade) VALUES
(1, 1, 10),
(2, 2, 5),
(3, 3, 20),
(4, 4, 15),
(5, 5, 8),
(6, 6, 25),
(7, 7, 30),
(8, 8, 12),
(9, 9, 40),
(10, 10, 7);

