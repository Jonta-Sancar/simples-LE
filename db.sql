# CREATE DATABASE `<NOME DO BANCO>`
DROP DATABASE IF EXISTS `loja_esportes`; -- NUNCA USAR ISSO EM SISTEMA REAL
CREATE DATABASE `loja_esportes`;

USE `loja_esportes`;

# CREATE TABLE `loja_esportes`.`produtos` (
CREATE TABLE `produtos` (
	`id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- INT: numero inteiro
    `nome` VARCHAR(50), -- VARCHAR:  string
    `descricao` VARCHAR(500),
    `preco` FLOAT, -- FLOAT: numero decimal (ponto flutuante)
    `data_cadastro` DATETIME DEFAULT CURRENT_TIMESTAMP
);
## TEXT
## CHAR(2)

## DEFAULT & COMMENT

# CREATE TABLE `movimentacoes` (
# 	 `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
#  	 `tipo` ENUM('entrada', 'saida') COMMENT 'entrada = Reposição de estoque; saida = venda para o cliente', -- ENUM: lista de opções
#     `quantidade` INT DEFAULT 1,
#     `valor_unitario` FLOAT,
#     `id_produto` INT
# );

CREATE TABLE `movimentacoes` (
	`id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`tipo` ENUM('entrada', 'saida') COMMENT 'entrada = Reposição de estoque; saida = venda para o cliente', -- ENUM: lista de 
    `cadastro` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Pega a data e hora que a movimentação aconteceu'
);

# INSERT INTO `movimentacoes` (`tipo`, `valor_unitario`) VALUES ('entrada', 12)
# INSERT INTO `movimentacoes` (`tipo`, `quantidade`, `valor_unitario`) VALUES ('entrada', 3, 12)

CREATE TABLE `movimentacoes_produtos` (
	`id_produto` INT NOT NULL,
    `id_movimentacao` INT NOT NULL,
    `quantidade` INT DEFAULT 1 NOT NULL,
	`valor_unitario` FLOAT,
    FOREIGN KEY (`id_produto`) REFERENCES `produtos`(`id`),
    FOREIGN KEY (`id_movimentacao`) REFERENCES `movimentacoes`(`id`)
);

#####################################################################

## COMANDOS DE MANIPULAÇÃO DE DADOS ##

## Query == consulta

# INSERT INTO `nome_da_tabela` (`col_1`, `col_2`, `col_...`) VALUES ('val_1', 'val_2', 'val_...');
# INSERT INTO `movimentacoes` (`tipo`, `valor_unitario`) VALUES ('entrada', '12.45');
# INSERT INTO `movimentacoes` (`tipo`, `quantidade`, `valor_unitario`) VALUES ('entrada', '3', '37.43');

# SELECT * FROM `movimentacoes`;

# UPDATE `nome_da_tabela` SET `col_1`='val_1', `col_2`='val_2', `col_...`='val_...' WHERE <condições de aplicação da edição>;
# UPDATE `movimentacoes` SET `quantidade` = 2 WHERE id = 1; # AO FILTRAR PELO ID COM '=', A EXPECTATIVA É ATINGIR APENAS 1 REGISTRO

# SELECT * FROM `movimentacoes`;

# DELETE FROM `nome_da_tabela` WHERE `<condições de aplicação da exclusão>`;
# DELETE FROM `movimentacoes` WHERE id = 1;

## COMANDO DE CONSULTA DE DADOS ##

# SELECT * FROM `nome_da_tabela`;
# SELECT * FROM `movimentacoes`;

-- ----------------------------------- --

# WHERE algo = _algo
# WHERE algo > _algo
# WHERE algo >= _algo
# WHERE algo < _algo
# WHERE algo <= _algo
# WHERE algo != _algo ||  WHERE algo <> _algo #=> diferença

# WHERE algo IS NULL #-> verifica se é nulo
# WHERE algo IS NOT NULL #-> verifica se não é nulo


## && (e) AND, || (ou) OR
# WHERE id = 1 AND (nome = 'Fulano de Tal' OR data_nascimento = '2005-03-17')


# WHERE id = 1 OR id = 2 OR id = 3 OR id = 7 OR id = 41
# WHERE id IN [1, 2, 3, 7, 41]

# Jonathas Dos Santos Carneiro
# WHERE nome LIKE 'Jonathas%'  ##-> tudo que começa com 'Jonathas'
# WHERE nome LIKE '%Carneiro'  ##-> tudo que terminam com 'Carneiro'
# WHERE nome LIKE '%Santos%'   ##-> tudo que em qualquer parte cotem 'Santos'


# Consultas de datas
# intervalo de datas de 15/06/2026 até 19/06/2026
# WHERE data_nascimento BETWEEN '2026-06-15' AND '2026-06-19'


# [INNER, LEFT, RIGHT, ...] JOINs






INSERT INTO `produtos` (`nome`, `descricao`, `preco`) VALUES
('Bola Futebol', 'Bola de futebol profissional trionda original. Bola oficial da copa do mundo de 2026', '439.75'),
('Chuteira Nike', 'Cutera da nike modelo R9', '359.90'),
('kit 10 coletes dupla face', 'SMD amarelo e azul', '134.15'),
('Munhequeira', 'Adidas profissional', '32.50'),
('Faixa para Capitão', 'Elática ajustável', '47.55');

INSERT INTO `movimentacoes` (`tipo`) VALUES
('entrada'),
('saida'),
('saida'),
('entrada'),
('saida');

INSERT INTO `movimentacoes_produtos` (`id_produto`, `id_movimentacao`, `quantidade`, `valor_unitario`) VALUES
('1', '1', '100', '439.75'),
('2', '1', '100', '359.90'),
('3', '1', '100', '134.15'),
('4', '1', '100', '32.50'),
('5', '1', '100', '47.55'),
('3', '2', '2', '134.15'),
('1', '2', '30', '439.75'),
('4', '3', '45', '32.50'),
('1', '3', '3', '439.75'),
('3', '4', '7', '134.15'),
('1', '5', '6', '439.75'),
('4', '3', '2', '32.50'),
('1', '4', '9', '439.75');