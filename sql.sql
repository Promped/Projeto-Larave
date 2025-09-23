-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema laravel
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema laravel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `laravel` DEFAULT CHARACTER SET utf8mb4 ;
USE `laravel` ;

-- -----------------------------------------------------
-- Table `laravel`.`funcoes_visitantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`funcoes_visitantes` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `laravel`.`visitantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`visitantes` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `documento` VARCHAR(50) NOT NULL,
  `empresa` VARCHAR(255) NULL DEFAULT NULL,
  `funcao_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_visitante_funcao` (`funcao_id` ASC),
  CONSTRAINT `fk_visitante_funcao`
    FOREIGN KEY (`funcao_id`)
    REFERENCES `laravel`.`funcoes_visitantes` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `laravel`.`acessos_visitantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`acessos_visitantes` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `visitante_id` BIGINT(20) UNSIGNED NOT NULL,
  `motivo_visita` VARCHAR(255) NULL DEFAULT NULL,
  `responsavel_interno` VARCHAR(255) NULL DEFAULT NULL,
  `data_hora_entrada` DATETIME NOT NULL,
  `data_hora_saida` DATETIME NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_acesso_visitante` (`visitante_id` ASC),
  CONSTRAINT `fk_acesso_visitante`
    FOREIGN KEY (`visitante_id`)
    REFERENCES `laravel`.`visitantes` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `laravel`.`areas_patio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`areas_patio` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NOT NULL,
  `capacidade_vagas` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `laravel`.`cache`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT(11) NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel`.`cache_locks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT(11) NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel`.`motoristas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`motoristas` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cpf` VARCHAR(20) NOT NULL,
  `telefone` VARCHAR(20) NULL DEFAULT NULL,
  `email` VARCHAR(100) NULL DEFAULT NULL,
  `endereco` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf` (`cpf` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `laravel`.`transportadoras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`transportadoras` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `razao_social` VARCHAR(255) NOT NULL,
  `cnpj` VARCHAR(20) NOT NULL,
  `telefone` VARCHAR(20) NULL DEFAULT NULL,
  `endereco` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cnpj` (`cnpj` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `laravel`.`veiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`veiculos` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `placa` VARCHAR(20) NOT NULL,
  `tipo` VARCHAR(100) NULL DEFAULT NULL,
  `modelo` VARCHAR(100) NULL DEFAULT NULL,
  `status_acesso` ENUM('AUTORIZADO', 'BLOQUEADO', 'AGUARDANDO') NULL DEFAULT 'AGUARDANDO',
  `transportadora_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `placa` (`placa` ASC),
  INDEX `fk_veiculo_transportadora` (`transportadora_id` ASC),
  CONSTRAINT `fk_veiculo_transportadora`
    FOREIGN KEY (`transportadora_id`)
    REFERENCES `laravel`.`transportadoras` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `laravel`.`cargas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`cargas` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(100) NULL DEFAULT NULL,
  `peso` DECIMAL(10,2) NULL DEFAULT NULL,
  `volume` DECIMAL(10,2) NULL DEFAULT NULL,
  `origem` VARCHAR(255) NULL DEFAULT NULL,
  `destino` VARCHAR(255) NULL DEFAULT NULL,
  `veiculo_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `motorista_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_carga_veiculo` (`veiculo_id` ASC),
  INDEX `fk_carga_motorista` (`motorista_id` ASC),
  CONSTRAINT `fk_carga_motorista`
    FOREIGN KEY (`motorista_id`)
    REFERENCES `laravel`.`motoristas` (`id`),
  CONSTRAINT `fk_carga_veiculo`
    FOREIGN KEY (`veiculo_id`)
    REFERENCES `laravel`.`veiculos` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `laravel`.`failed_jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`failed_jobs` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel`.`fornecedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`fornecedores` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `razao_social` VARCHAR(255) NOT NULL,
  `cnpj` VARCHAR(20) NOT NULL,
  `responsavel` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cnpj` (`cnpj` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `laravel`.`job_batches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT(11) NOT NULL,
  `pending_jobs` INT(11) NOT NULL,
  `failed_jobs` INT(11) NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT NULL DEFAULT NULL,
  `cancelled_at` INT(11) NULL DEFAULT NULL,
  `created_at` INT(11) NOT NULL,
  `finished_at` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel`.`jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`jobs` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT(3) UNSIGNED NOT NULL,
  `reserved_at` INT(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` INT(10) UNSIGNED NOT NULL,
  `created_at` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `jobs_queue_index` (`queue` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel`.`motorista_veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`motorista_veiculo` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `motorista_id` BIGINT(20) UNSIGNED NOT NULL,
  `veiculo_id` BIGINT(20) UNSIGNED NOT NULL,
  `data_associacao` DATE NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_mv_motorista` (`motorista_id` ASC),
  INDEX `fk_mv_veiculo` (`veiculo_id` ASC),
  CONSTRAINT `fk_mv_motorista`
    FOREIGN KEY (`motorista_id`)
    REFERENCES `laravel`.`motoristas` (`id`),
  CONSTRAINT `fk_mv_veiculo`
    FOREIGN KEY (`veiculo_id`)
    REFERENCES `laravel`.`veiculos` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `laravel`.`password_reset_tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel`.`sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` TEXT NULL DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `sessions_user_id_index` (`user_id` ASC),
  INDEX `sessions_last_activity_index` (`last_activity` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel`.`veiculo_area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel`.`veiculo_area` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `veiculo_id` BIGINT(20) UNSIGNED NOT NULL,
  `area_id` BIGINT(20) UNSIGNED NOT NULL,
  `data_hora_ocupacao` DATETIME NOT NULL,
  `data_hora_saida` DATETIME NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_va_veiculo` (`veiculo_id` ASC),
  INDEX `fk_va_area` (`area_id` ASC),
  CONSTRAINT `fk_va_area`
    FOREIGN KEY (`area_id`)
    REFERENCES `laravel`.`areas_patio` (`id`),
  CONSTRAINT `fk_va_veiculo`
    FOREIGN KEY (`veiculo_id`)
    REFERENCES `laravel`.`veiculos` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
