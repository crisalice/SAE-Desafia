-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.37-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para sae
CREATE DATABASE IF NOT EXISTS `sae` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sae`;

-- Copiando estrutura para tabela sae.espetaculo
CREATE TABLE IF NOT EXISTS `espetaculo` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id do espetaculo',
  `nome` varchar(50) NOT NULL COMMENT 'nome do espetaculo',
  `data` date NOT NULL COMMENT 'data do espetaculo',
  `hora` time NOT NULL COMMENT 'hora do espetaculo',
  `status` varchar(1) NOT NULL COMMENT 'status do espetaculo',
  `qtde_lugares` int(10) NOT NULL COMMENT 'quantidade de lugares ',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data da criacao',
  `alterado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data da alteracao',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela de espetaculo';

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela sae.poltrona
CREATE TABLE IF NOT EXISTS `poltrona` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id da tabela',
  `id_espetaculo` int(10) NOT NULL DEFAULT '0' COMMENT 'id do espetaculo',
  `nome_reserva` varchar(50) NOT NULL DEFAULT '0' COMMENT 'nome da pessoa da reserva',
  `status` varchar(1) NOT NULL COMMENT 'status da poltrona',
  `valor` decimal(10,2) NOT NULL DEFAULT '23.76' COMMENT 'valor da poltrona',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data da criação da reserva',
  `alterado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'data da alteração',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_poltrona_tbl_espetaculo` (`id_espetaculo`),
  CONSTRAINT `FK_tbl_poltrona_tbl_espetaculo` FOREIGN KEY (`id_espetaculo`) REFERENCES `espetaculo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela de poltronas do espetáculo';

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
