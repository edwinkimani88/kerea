-- ============================================================
-- KEREA Member Registration & Authentication SQL Script
-- Version: 1.0.0
-- Database: kerea_db
-- Description: Table definitions and seed data for member registration
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

USE `kerea_db`;

-- ────────────────────────────────────────────────────────────
-- 1. ROLES TABLE
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `roles` (
    `id`          TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(50)      NOT NULL UNIQUE COMMENT 'super_admin|admin|content_manager|member',
    `label`       VARCHAR(100)     NOT NULL,
    `permissions` JSON             NULL     COMMENT 'JSON array of allowed actions',
    `created_at`  DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 2. USERS TABLE
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `users` (
    `id`                BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `role_id`           TINYINT UNSIGNED NOT NULL DEFAULT 4 COMMENT 'FK → roles.id',
    `first_name`        VARCHAR(100)     NOT NULL,
    `last_name`         VARCHAR(100)     NOT NULL,
    `email`             VARCHAR(255)     NOT NULL UNIQUE,
    `phone`             VARCHAR(30)      NULL,
    `password_hash`     VARCHAR(255)     NOT NULL,
    `avatar`            VARCHAR(500)     NULL,
    `organisation`      VARCHAR(255)     NULL,
    `job_title`         VARCHAR(200)     NULL,
    `bio`               TEXT             NULL,
    `status`            ENUM('active','suspended','pending') NOT NULL DEFAULT 'pending',
    `email_verified`    TINYINT(1)       NOT NULL DEFAULT 0,
    `last_login`        DATETIME         NULL,
    `login_count`       INT UNSIGNED     NOT NULL DEFAULT 0,
    `created_at`        DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`        DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_users_email`  (`email`),
    KEY `idx_users_status` (`status`),
    KEY `idx_users_role`   (`role_id`),
    CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 3. SEED ROLES
-- ────────────────────────────────────────────────────────────
INSERT INTO `roles` (`id`, `name`, `label`, `permissions`) VALUES
(1, 'super_admin',     'Super Administrator', '["*"]'),
(2, 'admin',           'Administrator',       '["users","content","settings","events","media","menus"]'),
(3, 'content_manager', 'Content Manager',     '["content","events","media"]'),
(4, 'member',          'Member',              '["profile","portal"]')
ON DUPLICATE KEY UPDATE `label` = VALUES(`label`), `permissions` = VALUES(`permissions`);

-- ────────────────────────────────────────────────────────────
-- 4. SEED INITIAL SUPER ADMIN USER (Default Pass: Admin@KEREA2026)
-- ────────────────────────────────────────────────────────────
INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `password_hash`, `status`, `email_verified`) VALUES
(1, 1, 'KEREA', 'Administrator', 'admin@kerea.org',
 '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uHV/SiU.',
 'active', 1)
ON DUPLICATE KEY UPDATE `first_name` = VALUES(`first_name`), `last_name` = VALUES(`last_name`);

-- ────────────────────────────────────────────────────────────
-- 5. SAMPLE MEMBER REGISTRATION DATA
-- ────────────────────────────────────────────────────────────
INSERT INTO `users` (`role_id`, `first_name`, `last_name`, `email`, `phone`, `password_hash`, `organisation`, `job_title`, `status`, `email_verified`) VALUES
(4, 'Jane', 'Wanjiku', 'jane.wanjiku@renewable.co.ke', '+254712345678',
 '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uHV/SiU.',
 'AfriSolar Energy Ltd', 'Project Engineer', 'active', 1),
(4, 'David', 'Ochieng', 'david.ochieng@greenpower.ke', '+254722987654',
 '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uHV/SiU.',
 'GreenPower Solutions', 'Technical Director', 'pending', 0)
ON DUPLICATE KEY UPDATE `status` = VALUES(`status`);

SET FOREIGN_KEY_CHECKS = 1;
