-- =====================================================
-- Database Schema for PT Samudraina Pertiwi
-- Target: MySQL 8.0+
-- Generated from Laravel Migrations
-- =====================================================

CREATE DATABASE IF NOT EXISTS `samudraina` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `samudraina`;

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `email_verified_at` TIMESTAMP NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` VARCHAR(255) NOT NULL DEFAULT 'abk',
    `status_akun` VARCHAR(255) NOT NULL DEFAULT 'aktif',
    `remember_token` VARCHAR(100) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `password_reset_tokens`
-- -----------------------------------------------------
CREATE TABLE `password_reset_tokens` (
    `email` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `sessions`
-- -----------------------------------------------------
CREATE TABLE `sessions` (
    `id` VARCHAR(255) NOT NULL,
    `user_id` BIGINT UNSIGNED NULL,
    `ip_address` VARCHAR(45) NULL,
    `user_agent` TEXT NULL,
    `payload` LONGTEXT NOT NULL,
    `last_activity` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `sessions_user_id_index` (`user_id`),
    INDEX `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `cache`
-- -----------------------------------------------------
CREATE TABLE `cache` (
    `key` VARCHAR(255) NOT NULL,
    `value` MEDIUMTEXT NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY (`key`),
    INDEX `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `cache_locks`
-- -----------------------------------------------------
CREATE TABLE `cache_locks` (
    `key` VARCHAR(255) NOT NULL,
    `owner` VARCHAR(255) NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY (`key`),
    INDEX `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `jobs`
-- -----------------------------------------------------
CREATE TABLE `jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `queue` VARCHAR(255) NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `attempts` TINYINT UNSIGNED NOT NULL,
    `reserved_at` INT UNSIGNED NULL,
    `available_at` INT UNSIGNED NOT NULL,
    `created_at` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `job_batches`
-- -----------------------------------------------------
CREATE TABLE `job_batches` (
    `id` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `total_jobs` INT NOT NULL,
    `pending_jobs` INT NOT NULL,
    `failed_jobs` INT NOT NULL,
    `failed_job_ids` LONGTEXT NOT NULL,
    `options` MEDIUMTEXT NULL,
    `cancelled_at` INT NULL,
    `created_at` INT NOT NULL,
    `finished_at` INT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `failed_jobs`
-- -----------------------------------------------------
CREATE TABLE `failed_jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid` VARCHAR(255) NOT NULL,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `exception` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `profil_abk`
-- -----------------------------------------------------
CREATE TABLE `profil_abk` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `nama_lengkap` VARCHAR(255) NOT NULL,
    `tempat_lahir` VARCHAR(255) NULL,
    `tanggal_lahir` DATE NULL,
    `alamat` TEXT NULL,
    `nomor_hp` VARCHAR(255) NULL,
    `pengalaman_kerja` TEXT NULL,
    `posisi_dilamar` VARCHAR(255) NULL,
    `foto_profil` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `profil_abk_user_id_foreign` (`user_id`),
    CONSTRAINT `profil_abk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `dokumen`
-- -----------------------------------------------------
CREATE TABLE `dokumen` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `jenis_dokumen` VARCHAR(255) NOT NULL COMMENT 'ktp, kartu_keluarga, skck, akta_kelahiran, ijazah',
    `file_path` VARCHAR(255) NOT NULL,
    `status` VARCHAR(255) NOT NULL DEFAULT 'Menunggu Verifikasi',
    `catatan_operator` TEXT NULL,
    `tanggal_upload` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `dokumen_user_id_foreign` (`user_id`),
    CONSTRAINT `dokumen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `medical_checkups`
-- -----------------------------------------------------
CREATE TABLE `medical_checkups` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `file_hasil_mcu` VARCHAR(255) NULL,
    `status_mcu` VARCHAR(255) NOT NULL DEFAULT 'Menunggu Upload Hasil MCU',
    `catatan_operator` TEXT NULL,
    `tanggal_upload` TIMESTAMP NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `medical_checkups_user_id_foreign` (`user_id`),
    CONSTRAINT `medical_checkups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `diklat`
-- -----------------------------------------------------
CREATE TABLE `diklat` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `batch` VARCHAR(255) NULL,
    `lokasi` VARCHAR(255) NOT NULL DEFAULT 'Pemalang',
    `tanggal_mulai` DATE NULL,
    `tanggal_selesai` DATE NULL,
    `status` VARCHAR(255) NOT NULL DEFAULT 'Menunggu Jadwal Diklat',
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `diklat_user_id_foreign` (`user_id`),
    CONSTRAINT `diklat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `dokumen_pelaut`
-- -----------------------------------------------------
CREATE TABLE `dokumen_pelaut` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `jenis_dokumen` VARCHAR(255) NOT NULL COMMENT 'paspor, bst, buku_pelaut',
    `nomor_dokumen` VARCHAR(255) NULL,
    `tanggal_terbit` DATE NULL,
    `tanggal_expired` DATE NULL,
    `file_path` VARCHAR(255) NULL,
    `status_verifikasi` VARCHAR(255) NOT NULL DEFAULT 'Menunggu Pengurusan Dokumen',
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `dokumen_pelaut_user_id_foreign` (`user_id`),
    CONSTRAINT `dokumen_pelaut_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `job_orders`
-- -----------------------------------------------------
CREATE TABLE `job_orders` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `nama_kapal` VARCHAR(255) NULL,
    `negara_tujuan` VARCHAR(255) NULL,
    `posisi` VARCHAR(255) NULL,
    `status_job` VARCHAR(255) NOT NULL DEFAULT 'Waiting List',
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `job_orders_user_id_foreign` (`user_id`),
    CONSTRAINT `job_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `keberangkatan`
-- -----------------------------------------------------
CREATE TABLE `keberangkatan` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `maskapai` VARCHAR(255) NULL,
    `nomor_penerbangan` VARCHAR(255) NULL,
    `tanggal_berangkat` DATETIME NULL,
    `negara_tujuan` VARCHAR(255) NULL,
    `status` VARCHAR(255) NOT NULL DEFAULT 'Tiket Diproses',
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `keberangkatan_user_id_foreign` (`user_id`),
    CONSTRAINT `keberangkatan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `proses_pendaftaran`
-- -----------------------------------------------------
CREATE TABLE `proses_pendaftaran` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `tahap` INT NOT NULL DEFAULT 1,
    `status` VARCHAR(255) NOT NULL DEFAULT 'Dalam Proses',
    `catatan` TEXT NULL,
    `tanggal_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `proses_pendaftaran_user_id_foreign` (`user_id`),
    CONSTRAINT `proses_pendaftaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `notifications`
-- -----------------------------------------------------
CREATE TABLE `notifications` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `judul` VARCHAR(255) NOT NULL,
    `pesan` TEXT NOT NULL,
    `status_baca` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `notifications_user_id_foreign` (`user_id`),
    CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `activity_logs`
-- -----------------------------------------------------
CREATE TABLE `activity_logs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL,
    `aktivitas` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `activity_logs_user_id_foreign` (`user_id`),
    CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `permissions` (Spatie Permission)
-- -----------------------------------------------------
CREATE TABLE `permissions` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `guard_name` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `permissions_name_guard_name_unique` (`name`, `guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `roles` (Spatie Permission)
-- -----------------------------------------------------
CREATE TABLE `roles` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `guard_name` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `roles_name_guard_name_unique` (`name`, `guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `model_has_permissions` (Spatie Permission)
-- -----------------------------------------------------
CREATE TABLE `model_has_permissions` (
    `permission_id` BIGINT UNSIGNED NOT NULL,
    `model_type` VARCHAR(255) NOT NULL,
    `model_id` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`permission_id`, `model_id`, `model_type`),
    INDEX `model_has_permissions_model_id_model_type_index` (`model_id`, `model_type`),
    CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `model_has_roles` (Spatie Permission)
-- -----------------------------------------------------
CREATE TABLE `model_has_roles` (
    `role_id` BIGINT UNSIGNED NOT NULL,
    `model_type` VARCHAR(255) NOT NULL,
    `model_id` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`role_id`, `model_id`, `model_type`),
    INDEX `model_has_roles_model_id_model_type_index` (`model_id`, `model_type`),
    CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `role_has_permissions` (Spatie Permission)
-- -----------------------------------------------------
CREATE TABLE `role_has_permissions` (
    `permission_id` BIGINT UNSIGNED NOT NULL,
    `role_id` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`permission_id`, `role_id`),
    CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
    CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Seed Data: Roles & Default Users
-- =====================================================

INSERT INTO `roles` (`name`, `guard_name`, `created_at`, `updated_at`) VALUES
('super_admin', 'web', NOW(), NOW()),
('operator', 'web', NOW(), NOW()),
('abk', 'web', NOW(), NOW());

INSERT INTO `users` (`name`, `email`, `password`, `role`, `status_akun`, `created_at`, `updated_at`) VALUES
('Super Admin', 'admin@samudra.com', '$2y$10$UFc9migL7rNGARJQqZzMmesjlnPeAZKpBu.yBknU5h8ojPvkTM02.', 'super_admin', 'aktif', NOW(), NOW()),
('Operator Samudra', 'operator@samudra.com', '$2y$10$XoxE/yrrpRaYSwNSbS4cSuPKw6SsltRI3T28FPNTJGBKiJSOnSQGm', 'operator', 'aktif', NOW(), NOW()),
('Budi Santoso', 'abk@samudra.com', '$2y$10$6Sn1AvCvFCFkViR.xPe8vuF.0PY8qgU7z1.R4aj8gJWEDa.VJSYf2', 'abk', 'aktif', NOW(), NOW());

-- Assign roles to users (assumes IDs 1,2,3 for the 3 users above)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
((SELECT `id` FROM `roles` WHERE `name` = 'super_admin'), 'App\\Models\\User', 1),
((SELECT `id` FROM `roles` WHERE `name` = 'operator'), 'App\\Models\\User', 2),
((SELECT `id` FROM `roles` WHERE `name` = 'abk'), 'App\\Models\\User', 3);

-- -----------------------------------------------------
-- Seed Data: Profil ABK for Budi Santoso
-- -----------------------------------------------------
INSERT INTO `profil_abk` (`user_id`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nomor_hp`, `pengalaman_kerja`, `posisi_dilamar`, `created_at`, `updated_at`) VALUES
(3, 'Budi Santoso', 'Pemalang', '1995-08-17', 'Jl. Merdeka No. 12, Pemalang, Jawa Tengah', '081234567890', '2 Tahun di Kapal Purshine Taiwan', 'Taiwan - Purshine', NOW(), NOW());

-- -----------------------------------------------------
-- Seed Data: Proses Pendaftaran for Budi Santoso
-- -----------------------------------------------------
INSERT INTO `proses_pendaftaran` (`user_id`, `tahap`, `status`, `catatan`, `tanggal_update`, `created_at`, `updated_at`) VALUES
(3, 1, 'Disetujui', 'Profil dan berkas administrasi telah disetujui.', NOW(), NOW(), NOW()),
(3, 2, 'Dalam Proses', 'Silakan unggah berkas Medical Check-Up (MCU).', NOW(), NOW(), NOW());
