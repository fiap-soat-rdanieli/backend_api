CREATE DATABASE soat;
USE soat;

CREATE TABLE `cliente` (
  `cpf` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cpf`)
);

CREATE TABLE `produto` (
  `id` char(36) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `categoria` varchar(16) NOT NULL,
  `valor` float NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `pedido` (
  `id` char(36) NOT NULL,
  `ref_id` int NOT NULL,
  `cliente_cpf` int DEFAULT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'Criado',
  `timestamp_criado` int NOT NULL,
  `timestamp_checkout` int DEFAULT NULL,
  `timestamp_finalizado` int NOT NULL,
  `valor` float NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `pedido_produtos` (
  `pedido_id` char(36) NOT NULL,
  `produto_id` char(36) NOT NULL,
  `quantidade` int DEFAULT '1',
  `observacao` text,
  UNIQUE KEY `ped_prod` (`pedido_id`,`produto_id`)
)
