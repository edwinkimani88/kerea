-- ============================================================
-- KEREA Corporate Website — cPanel MySQL Import Script
-- Version: 1.0.0
-- Compatible: MySQL 5.7+ / MariaDB 10.3+
--
-- HOW TO USE IN cPANEL:
-- 1. Log in to cPanel → MySQL Databases
-- 2. Create a new database  e.g.  yourusername_kerea
-- 3. Create a new MySQL user with a strong password
-- 4. Add the user to the database — grant ALL PRIVILEGES
-- 5. Go to cPanel → phpMyAdmin
-- 6. Click on your new database in the left sidebar
-- 7. Click "Import" tab → Choose File → select this file → Go
--
-- NOTE: Do NOT include CREATE DATABASE / USE statements here.
--       cPanel phpMyAdmin already has your database selected.
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ────────────────────────────────────────────────────────────
-- 1. ROLES
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
-- 2. USERS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `users` (
    `id`                BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `role_id`           TINYINT UNSIGNED NOT NULL DEFAULT 4 COMMENT 'FK roles.id',
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
-- 3. USER SESSIONS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `user_sessions` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`    BIGINT UNSIGNED NOT NULL,
    `token`      VARCHAR(128)    NOT NULL UNIQUE,
    `ip_address` VARCHAR(45)     NULL,
    `user_agent` VARCHAR(512)    NULL,
    `expires_at` DATETIME        NOT NULL,
    `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_sessions_token`   (`token`),
    KEY `idx_sessions_user_id` (`user_id`),
    CONSTRAINT `fk_sessions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 4. PASSWORD RESETS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `password_resets` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`    BIGINT UNSIGNED NOT NULL,
    `token`      VARCHAR(128)    NOT NULL UNIQUE,
    `expires_at` DATETIME        NOT NULL,
    `used`       TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_resets_token`   (`token`),
    KEY `idx_resets_user_id` (`user_id`),
    CONSTRAINT `fk_resets_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 5. SITE SETTINGS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `site_settings` (
    `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `setting_key` VARCHAR(100) NOT NULL UNIQUE,
    `setting_val` TEXT         NULL,
    `setting_type` ENUM('text','color','boolean','image','textarea','select') NOT NULL DEFAULT 'text',
    `label`       VARCHAR(200) NULL,
    `group_name`  VARCHAR(100) NOT NULL DEFAULT 'general',
    `sort_order`  SMALLINT     NOT NULL DEFAULT 0,
    `updated_at`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_settings_key`   (`setting_key`),
    KEY `idx_settings_group` (`group_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 6. MEDIA LIBRARY
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `media_library` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uploaded_by`  BIGINT UNSIGNED NULL,
    `filename`     VARCHAR(500)    NOT NULL,
    `original_name`VARCHAR(500)    NOT NULL,
    `file_path`    VARCHAR(1000)   NOT NULL,
    `file_url`     VARCHAR(1000)   NOT NULL,
    `mime_type`    VARCHAR(100)    NOT NULL,
    `file_size`    BIGINT UNSIGNED NOT NULL DEFAULT 0,
    `alt_text`     VARCHAR(500)    NULL,
    `caption`      TEXT            NULL,
    `width`        SMALLINT UNSIGNED NULL,
    `height`       SMALLINT UNSIGNED NULL,
    `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_media_uploader` (`uploaded_by`),
    CONSTRAINT `fk_media_uploader` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 7. PAGES (CMS-managed static pages)
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `pages` (
    `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `slug`         VARCHAR(200)    NOT NULL UNIQUE,
    `title`        VARCHAR(500)    NOT NULL,
    `meta_desc`    VARCHAR(500)    NULL,
    `meta_keywords`VARCHAR(500)    NULL,
    `content`      LONGTEXT        NULL,
    `hero_image_id`BIGINT UNSIGNED NULL,
    `status`       ENUM('published','draft','archived') NOT NULL DEFAULT 'draft',
    `created_by`   BIGINT UNSIGNED NULL,
    `updated_by`   BIGINT UNSIGNED NULL,
    `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_pages_slug`   (`slug`),
    KEY `idx_pages_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 8. HERO SLIDES (homepage slider)
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `hero_slides` (
    `id`          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `title`       VARCHAR(500)    NOT NULL,
    `subtitle`    TEXT            NULL,
    `cta_text`    VARCHAR(200)    NULL,
    `cta_url`     VARCHAR(1000)   NULL,
    `image_id`    BIGINT UNSIGNED NULL,
    `bg_color`    VARCHAR(20)     NULL DEFAULT '#000000',
    `sort_order`  SMALLINT        NOT NULL DEFAULT 0,
    `is_active`   TINYINT(1)      NOT NULL DEFAULT 1,
    `created_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_hero_active` (`is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 9. NEWS ARTICLES
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `news_articles` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `author_id`    BIGINT UNSIGNED NULL,
    `image_id`     BIGINT UNSIGNED NULL,
    `title`        VARCHAR(500)    NOT NULL,
    `slug`         VARCHAR(500)    NOT NULL UNIQUE,
    `excerpt`      TEXT            NULL,
    `content`      LONGTEXT        NULL,
    `category`     VARCHAR(100)    NOT NULL DEFAULT 'general',
    `tags`         VARCHAR(500)    NULL,
    `status`       ENUM('published','draft','archived') NOT NULL DEFAULT 'draft',
    `visibility`   ENUM('public','members_only') NOT NULL DEFAULT 'public',
    `views`        INT UNSIGNED    NOT NULL DEFAULT 0,
    `featured`     TINYINT(1)      NOT NULL DEFAULT 0,
    `published_at` DATETIME        NULL,
    `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_news_slug`   (`slug`),
    KEY `idx_news_status` (`status`),
    KEY `idx_news_cat`    (`category`),
    CONSTRAINT `fk_news_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 10. BLOG POSTS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `blog_posts` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `author_id`    BIGINT UNSIGNED NULL,
    `image_id`     BIGINT UNSIGNED NULL,
    `title`        VARCHAR(500)    NOT NULL,
    `slug`         VARCHAR(500)    NOT NULL UNIQUE,
    `excerpt`      TEXT            NULL,
    `content`      LONGTEXT        NULL,
    `category`     VARCHAR(100)    NOT NULL DEFAULT 'general',
    `tags`         VARCHAR(500)    NULL,
    `status`       ENUM('published','draft','archived') NOT NULL DEFAULT 'draft',
    `visibility`   ENUM('public','members_only') NOT NULL DEFAULT 'public',
    `views`        INT UNSIGNED    NOT NULL DEFAULT 0,
    `featured`     TINYINT(1)      NOT NULL DEFAULT 0,
    `published_at` DATETIME        NULL,
    `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_blog_slug`   (`slug`),
    KEY `idx_blog_status` (`status`),
    CONSTRAINT `fk_blog_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 11. PUBLICATIONS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `publications` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `image_id`     BIGINT UNSIGNED NULL,
    `file_id`      BIGINT UNSIGNED NULL,
    `title`        VARCHAR(500)    NOT NULL,
    `slug`         VARCHAR(500)    NOT NULL UNIQUE,
    `description`  TEXT            NULL,
    `category`     VARCHAR(100)    NOT NULL DEFAULT 'report',
    `year`         YEAR            NULL,
    `authors`      VARCHAR(500)    NULL,
    `visibility`   ENUM('public','members_only') NOT NULL DEFAULT 'public',
    `downloads`    INT UNSIGNED    NOT NULL DEFAULT 0,
    `status`       ENUM('published','draft') NOT NULL DEFAULT 'draft',
    `featured`     TINYINT(1)      NOT NULL DEFAULT 0,
    `published_at` DATETIME        NULL,
    `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_pub_slug`   (`slug`),
    KEY `idx_pub_status` (`status`),
    KEY `idx_pub_cat`    (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 12. KNOWLEDGE HUB
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `knowledge_hub` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `image_id`     BIGINT UNSIGNED NULL,
    `file_id`      BIGINT UNSIGNED NULL,
    `title`        VARCHAR(500)    NOT NULL,
    `slug`         VARCHAR(500)    NOT NULL UNIQUE,
    `description`  TEXT            NULL,
    `content`      LONGTEXT        NULL,
    `category`     VARCHAR(100)    NOT NULL DEFAULT 'resource',
    `tags`         VARCHAR(500)    NULL,
    `visibility`   ENUM('public','members_only') NOT NULL DEFAULT 'public',
    `downloads`    INT UNSIGNED    NOT NULL DEFAULT 0,
    `status`       ENUM('published','draft') NOT NULL DEFAULT 'draft',
    `featured`     TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_kh_slug`   (`slug`),
    KEY `idx_kh_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 13. DOWNLOADS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `downloads` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `file_id`    BIGINT UNSIGNED NULL,
    `title`      VARCHAR(500)    NOT NULL,
    `description`TEXT            NULL,
    `category`   VARCHAR(100)    NOT NULL DEFAULT 'general',
    `visibility` ENUM('public','members_only') NOT NULL DEFAULT 'public',
    `downloads`  INT UNSIGNED    NOT NULL DEFAULT 0,
    `status`     ENUM('active','inactive') NOT NULL DEFAULT 'active',
    `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_dl_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 14. EVENTS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `events` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `image_id`     BIGINT UNSIGNED NULL,
    `title`        VARCHAR(500)    NOT NULL,
    `slug`         VARCHAR(500)    NOT NULL UNIQUE,
    `description`  TEXT            NULL,
    `content`      LONGTEXT        NULL,
    `event_type`   VARCHAR(100)    NOT NULL DEFAULT 'conference',
    `venue`        VARCHAR(500)    NULL,
    `location`     VARCHAR(500)    NULL,
    `start_date`   DATE            NOT NULL,
    `end_date`     DATE            NULL,
    `start_time`   TIME            NULL,
    `end_time`     TIME            NULL,
    `registration_url` VARCHAR(1000) NULL,
    `capacity`     INT UNSIGNED    NULL,
    `status`       ENUM('upcoming','ongoing','completed','cancelled') NOT NULL DEFAULT 'upcoming',
    `visibility`   ENUM('public','members_only') NOT NULL DEFAULT 'public',
    `featured`     TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_event_slug`   (`slug`),
    KEY `idx_event_status` (`status`),
    KEY `idx_event_date`   (`start_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 15. WORKSHOPS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `workshops` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `image_id`     BIGINT UNSIGNED NULL,
    `title`        VARCHAR(500)    NOT NULL,
    `slug`         VARCHAR(500)    NOT NULL UNIQUE,
    `description`  TEXT            NULL,
    `content`      LONGTEXT        NULL,
    `facilitator`  VARCHAR(300)    NULL,
    `venue`        VARCHAR(500)    NULL,
    `start_date`   DATE            NOT NULL,
    `end_date`     DATE            NULL,
    `fee`          DECIMAL(10,2)   NULL DEFAULT 0.00,
    `capacity`     INT UNSIGNED    NULL,
    `status`       ENUM('upcoming','ongoing','completed','cancelled') NOT NULL DEFAULT 'upcoming',
    `visibility`   ENUM('public','members_only') NOT NULL DEFAULT 'public',
    `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_ws_slug`   (`slug`),
    KEY `idx_ws_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 16. TRAINING PROGRAMMES
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `training_programmes` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `image_id`     BIGINT UNSIGNED NULL,
    `title`        VARCHAR(500)    NOT NULL,
    `slug`         VARCHAR(500)    NOT NULL UNIQUE,
    `description`  TEXT            NULL,
    `content`      LONGTEXT        NULL,
    `duration`     VARCHAR(200)    NULL,
    `delivery_mode`VARCHAR(100)    NULL,
    `level`        VARCHAR(100)    NULL,
    `fee`          DECIMAL(10,2)   NULL DEFAULT 0.00,
    `status`       ENUM('active','draft','archived') NOT NULL DEFAULT 'draft',
    `featured`     TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_tp_slug`   (`slug`),
    KEY `idx_tp_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 17. PARTNERS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `partners` (
    `id`          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `image_id`    BIGINT UNSIGNED NULL,
    `name`        VARCHAR(300)    NOT NULL,
    `description` TEXT            NULL,
    `website_url` VARCHAR(1000)   NULL,
    `partner_type`VARCHAR(100)    NOT NULL DEFAULT 'strategic',
    `country`     VARCHAR(100)    NULL DEFAULT 'Kenya',
    `sort_order`  SMALLINT        NOT NULL DEFAULT 0,
    `is_active`   TINYINT(1)      NOT NULL DEFAULT 1,
    `featured`    TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_partner_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 18. TEAM MEMBERS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `team_members` (
    `id`          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `image_id`    BIGINT UNSIGNED NULL,
    `name`        VARCHAR(300)    NOT NULL,
    `title`       VARCHAR(300)    NULL,
    `bio`         TEXT            NULL,
    `email`       VARCHAR(255)    NULL,
    `phone`       VARCHAR(50)     NULL,
    `linkedin_url`VARCHAR(1000)   NULL,
    `department`  VARCHAR(200)    NULL,
    `sort_order`  SMALLINT        NOT NULL DEFAULT 0,
    `is_active`   TINYINT(1)      NOT NULL DEFAULT 1,
    `is_board`    TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_team_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 19. FAQS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `faqs` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `question`   TEXT         NOT NULL,
    `answer`     LONGTEXT     NOT NULL,
    `category`   VARCHAR(100) NOT NULL DEFAULT 'general',
    `sort_order` SMALLINT     NOT NULL DEFAULT 0,
    `is_active`  TINYINT(1)   NOT NULL DEFAULT 1,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_faq_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 20. TESTIMONIALS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `testimonials` (
    `id`          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `image_id`    BIGINT UNSIGNED NULL,
    `name`        VARCHAR(300)    NOT NULL,
    `title`       VARCHAR(300)    NULL,
    `organisation`VARCHAR(300)    NULL,
    `quote`       TEXT            NOT NULL,
    `rating`      TINYINT UNSIGNED NULL,
    `sort_order`  SMALLINT        NOT NULL DEFAULT 0,
    `is_active`   TINYINT(1)      NOT NULL DEFAULT 1,
    `featured`    TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_test_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 21. SUCCESS STORIES
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `success_stories` (
    `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `image_id`    BIGINT UNSIGNED NULL,
    `title`       VARCHAR(500)    NOT NULL,
    `slug`        VARCHAR(500)    NOT NULL UNIQUE,
    `excerpt`     TEXT            NULL,
    `content`     LONGTEXT        NULL,
    `organisation`VARCHAR(300)    NULL,
    `location`    VARCHAR(300)    NULL,
    `impact`      VARCHAR(500)    NULL,
    `status`      ENUM('published','draft') NOT NULL DEFAULT 'draft',
    `featured`    TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_ss_slug`   (`slug`),
    KEY `idx_ss_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 22. MENUS
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `menus` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(200) NOT NULL,
    `location`   VARCHAR(100) NOT NULL UNIQUE,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `menu_items` (
    `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `menu_id`     INT UNSIGNED NOT NULL,
    `parent_id`   INT UNSIGNED NULL,
    `label`       VARCHAR(300) NOT NULL,
    `url`         VARCHAR(1000)NOT NULL,
    `target`      VARCHAR(20)  NOT NULL DEFAULT '_self',
    `icon`        VARCHAR(100) NULL,
    `sort_order`  SMALLINT     NOT NULL DEFAULT 0,
    `is_active`   TINYINT(1)   NOT NULL DEFAULT 1,
    `created_at`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_mitems_menu`   (`menu_id`),
    KEY `idx_mitems_parent` (`parent_id`),
    CONSTRAINT `fk_mitems_menu`   FOREIGN KEY (`menu_id`)   REFERENCES `menus` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_mitems_parent` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 23. CONTACT MESSAGES
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(300)    NOT NULL,
    `email`      VARCHAR(255)    NOT NULL,
    `phone`      VARCHAR(50)     NULL,
    `subject`    VARCHAR(500)    NULL,
    `message`    TEXT            NOT NULL,
    `ip_address` VARCHAR(45)     NULL,
    `status`     ENUM('unread','read','replied','archived') NOT NULL DEFAULT 'unread',
    `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_contact_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ────────────────────────────────────────────────────────────
-- 24. ACTIVITY LOG
-- ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `activity_log` (
    `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`     BIGINT UNSIGNED NULL,
    `action`      VARCHAR(200)    NOT NULL,
    `entity_type` VARCHAR(100)    NULL,
    `entity_id`   BIGINT UNSIGNED NULL,
    `description` TEXT            NULL,
    `ip_address`  VARCHAR(45)     NULL,
    `created_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_log_user`   (`user_id`),
    KEY `idx_log_action` (`action`),
    KEY `idx_log_date`   (`created_at`),
    CONSTRAINT `fk_log_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- SEED DATA  (INSERT IGNORE = safe to re-run)
-- ============================================================

-- Roles
INSERT IGNORE INTO `roles` (`id`, `name`, `label`, `permissions`) VALUES
(1, 'super_admin',     'Super Administrator', '["*"]'),
(2, 'admin',           'Administrator',       '["users","content","settings","events","media","menus"]'),
(3, 'content_manager', 'Content Manager',     '["content","events","media"]'),
(4, 'member',          'Member',              '["profile","portal"]');

-- Super Admin (default password: Admin@KEREA2026)
-- IMPORTANT: Run setup_admin.php after import to set a proper bcrypt hash!
INSERT IGNORE INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `password_hash`, `status`, `email_verified`) VALUES
(1, 1, 'KEREA', 'Administrator', 'admin@kerea.org',
 '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uHV/SiU.',
 'active', 1);

-- Site Settings
INSERT IGNORE INTO `site_settings` (`setting_key`, `setting_val`, `setting_type`, `label`, `group_name`, `sort_order`) VALUES
('site_name',        'KEREA',                      'text',    'Site Name',             'general', 1),
('site_tagline',     'Kenya Renewable Energy Association', 'text', 'Site Tagline',      'general', 2),
('primary_color',    '#39DE4F',                    'color',   'Primary Color',         'theme',   1),
('accent_color',     '#F59E0B',                    'color',   'Accent Color',          'theme',   2),
('footer_bg_color',  '#0a0a0a',                    'color',   'Footer Background',     'theme',   3),
('font_family',      'Inter',                      'text',    'Font Family',           'theme',   4),
('nav_style',        'static',                     'select',  'Navigation Style',      'theme',   5),
('logo_main',        '/assets/kerea-logo-main.png','image',   'Main Logo',             'branding',1),
('logo_load',        '/assets/logo-load.png',      'image',   'Loading Logo',          'branding',2),
('announcement_text','Kerea Guaranteed Compliance', 'text',   'Announcement Bar Text', 'general', 3),
('header_email',     'info@kerea.org',             'text',    'Header Email',          'contact', 1),
('header_phone',     '(+254) 740 541 896',         'text',    'Header Phone',          'contact', 2),
('contact_email',    'info@kerea.org',             'text',    'Contact Email',         'contact', 3),
('contact_phone',    '(+254) 740 541 896',         'text',    'Contact Phone',         'contact', 4),
('contact_address',  'Keri Road, Nairobi West, Nairobi', 'textarea','Contact Address', 'contact', 5),
('social_facebook',  'https://www.facebook.com/KEREAKENYA/',   'text','Facebook URL',  'social',  1),
('social_twitter',   'https://x.com/KereaInfo',               'text','Twitter/X URL', 'social',  2),
('social_linkedin',  'https://www.linkedin.com/company/kenya-renewable-energy-association/?originalSubdomain=ke','text','LinkedIn URL','social',3),
('social_youtube',   '#',                          'text',    'YouTube URL',           'social',  4),
('footer_text',      'The primary representative body for all sustainable energy practitioners and corporate stakeholders across East Africa.', 'textarea', 'Footer Description', 'general', 6),
('hero_title',       'Leading the Renewable Energy Transition in East Africa', 'text', 'Hero Title', 'homepage', 1),
('hero_subtitle',    'KEREA is the peak industry body championing sustainable energy standards, policy advocacy, and member empowerment across the region.', 'textarea', 'Hero Subtitle', 'homepage', 2),
('hero_cta_text',    'Join KEREA Today',           'text',    'Hero CTA Button Text',  'homepage', 3),
('hero_cta_url',     '/membership/',               'text',    'Hero CTA Button URL',   'homepage', 4),
('marketplace_url',  'https://marketplace.kerea.org/', 'text','Marketplace External URL', 'general', 10),
('show_market_counter','1',                        'boolean', 'Show Market Counter',   'homepage', 5),
('meta_description', 'KEREA - Kenya Renewable Energy Association. The peak industry body for renewable energy in East Africa.', 'textarea', 'Default Meta Description', 'seo', 1),
('google_analytics', '',                           'text',    'Google Analytics ID',   'seo',     2),
('smtp_host',        '',                           'text',    'SMTP Host',             'email',   1),
('smtp_port',        '587',                        'text',    'SMTP Port',             'email',   2),
('smtp_user',        '',                           'text',    'SMTP Username',         'email',   3),
('smtp_pass',        '',                           'text',    'SMTP Password',         'email',   4),
('smtp_from',        'no-reply@kerea.org',         'text',    'From Email',            'email',   5),
('smtp_from_name',   'KEREA',                      'text',    'From Name',             'email',   6);

-- Hero Slides
INSERT IGNORE INTO `hero_slides` (`title`, `subtitle`, `cta_text`, `cta_url`, `bg_color`, `sort_order`, `is_active`) VALUES
('Leading the Renewable Energy Transition',
 'KEREA is the peak industry body championing sustainable energy standards, policy advocacy, and member empowerment across East Africa.',
 'Join KEREA Today', '/membership/', '#000000', 1, 1),
('Policy. Standards. Impact.',
 'Driving evidence-based policy reforms and technical standards that shape the future of clean energy in Kenya and East Africa.',
 'View Policy Briefs', '/policy-advocacy/', '#0d1117', 2, 1),
('Knowledge Hub - Research That Matters',
 'Access our curated library of research reports, technical guides, and sector publications to stay ahead in the renewable energy space.',
 'Explore Knowledge Hub', '/knowledge-hub/', '#0a0f1e', 3, 1);

-- Sample News Articles
INSERT IGNORE INTO `news_articles` (`author_id`, `title`, `slug`, `excerpt`, `category`, `status`, `visibility`, `featured`, `published_at`) VALUES
(1, 'KEREA Launches 2026 Bio-Ethanol Certification Framework',
 'kerea-launches-2026-bio-ethanol-certification-framework',
 'KEREA has officially launched the 2026 Bio-Ethanol Fuel Certification Framework, setting new standards for quality and safety across Kenya.',
 'Press Release', 'published', 'public', 1, NOW()),
(1, 'East Africa Solar Sector Report 2025 Now Available',
 'east-africa-solar-sector-report-2025',
 'Our comprehensive annual report tracks the growth, challenges, and opportunities across the East African solar sector.',
 'Industry News', 'published', 'public', 1, NOW());

-- Sample Events
INSERT IGNORE INTO `events` (`title`, `slug`, `description`, `event_type`, `venue`, `location`, `start_date`, `end_date`, `status`, `visibility`, `featured`) VALUES
('Solar Tech Expo 2026',
 'solar-tech-expo-2026',
 'East Africas premier renewable energy exhibition bringing together industry leaders, innovators, and policymakers.',
 'expo', 'KICC, Hall 4', 'Nairobi, Kenya', '2026-08-24', '2026-08-26', 'upcoming', 'public', 1),
('Biomass Policy Summit',
 'biomass-policy-summit-2026',
 'A focused policy dialogue on sustainable biomass energy standards and regulatory frameworks for East Africa.',
 'summit', 'Mombasa Trade Center', 'Mombasa, Kenya', '2026-09-12', '2026-09-13', 'upcoming', 'public', 1);

-- Sample Partners
INSERT IGNORE INTO `partners` (`name`, `description`, `website_url`, `partner_type`, `sort_order`, `is_active`, `featured`) VALUES
('Government of Kenya - EPRA', 'Energy and Petroleum Regulatory Authority', 'https://epra.go.ke', 'strategic', 1, 1, 1),
('UNEP', 'United Nations Environment Programme', 'https://unep.org', 'implementing', 2, 1, 1),
('Kenya Power', 'Kenya Power and Lighting Company', 'https://kplc.co.ke', 'technical', 3, 1, 0),
('GIZ Kenya', 'Deutsche Gesellschaft fur Internationale Zusammenarbeit', 'https://giz.de', 'donor', 4, 1, 1);

-- Sample FAQs
INSERT IGNORE INTO `faqs` (`question`, `answer`, `category`, `sort_order`, `is_active`) VALUES
('What is KEREA?',
 'KEREA (Kenya Renewable Energy Association) is the primary representative body for all sustainable energy practitioners and corporate stakeholders across East Africa.',
 'general', 1, 1),
('How do I become a KEREA member?',
 'You can apply for membership through our online registration form at /membership/register.php. Once submitted, our team reviews your application and responds within 5 business days.',
 'membership', 2, 1),
('What are the membership tiers?',
 'KEREA offers Corporate, Associate, and Individual membership tiers, each with specific benefits tailored to your organisations needs and size.',
 'membership', 3, 1),
('What technical standards does KEREA enforce?',
 'KEREA develops and enforces technical standards for solar PV systems, induction cookstoves, bio-ethanol fuel, and industrial energy storage across Kenya and East Africa.',
 'standards', 4, 1);

-- Sample Testimonials
INSERT IGNORE INTO `testimonials` (`name`, `title`, `organisation`, `quote`, `rating`, `sort_order`, `is_active`, `featured`) VALUES
('Dr. Amina Hassan', 'CEO', 'SolarLink Technologies',
 'KEREAs certification process gave us the credibility we needed to win major government contracts. Their standards are world-class.',
 5, 1, 1, 1),
('James Mwangi', 'Director', 'EcoStove Kenya',
 'The policy advocacy work KEREA does is transforming the regulatory landscape for clean cooking solutions. We are proud members.',
 5, 2, 1, 1);

-- Default Menus
INSERT IGNORE INTO `menus` (`id`, `name`, `location`) VALUES
(1, 'Header Navigation',          'header'),
(2, 'Footer - KEREA Connect',     'footer_connect'),
(3, 'Footer - Sector Governance', 'footer_governance');

-- Header Menu Items
INSERT IGNORE INTO `menu_items` (`menu_id`, `label`, `url`, `target`, `sort_order`, `is_active`) VALUES
(1, 'Home',         '/',                              '_self',  1, 1),
(1, 'About Us',     '/about/',                        '_self',  2, 1),
(1, 'Membership',   '/membership/',                   '_self',  3, 1),
(1, 'Policy Briefs','/policy-advocacy/',              '_self',  4, 1),
(1, 'Marketplace',  'https://marketplace.kerea.org/', '_blank', 5, 1),
(1, 'Contact',      '/contact/',                      '_self',  6, 1);

-- Footer - KEREA Connect
INSERT IGNORE INTO `menu_items` (`menu_id`, `label`, `url`, `target`, `sort_order`, `is_active`) VALUES
(2, 'About KEREA',     '/about/',                         '_self',  1, 1),
(2, 'Marketplace',     'https://marketplace.kerea.org/',  '_blank', 2, 1),
(2, 'Member Directory','/member-directory/',              '_self',  3, 1),
(2, 'Press Releases',  '/news/',                          '_self',  4, 1);

-- Footer - Sector Governance
INSERT IGNORE INTO `menu_items` (`menu_id`, `label`, `url`, `target`, `sort_order`, `is_active`) VALUES
(3, 'Policy and Advocacy',  '/policy-advocacy/', '_self', 1, 1),
(3, 'Technical Standards',  '/standards/',       '_self', 2, 1),
(3, 'Reports and Research', '/publications/',    '_self', 3, 1),
(3, 'Knowledge Hub',        '/knowledge-hub/',   '_self', 4, 1);

-- ============================================================
-- END OF SCRIPT
-- ============================================================
