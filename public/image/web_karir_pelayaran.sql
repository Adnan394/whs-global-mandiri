-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2025 at 02:22 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_karir_pelayaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_lamaran_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `iteration` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `user_lamaran_id`, `user_id`, `iteration`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 0, 'saya ingin follow up terkait lamaran saya', '2025-10-11 08:51:51', '2025-10-11 08:51:51'),
(2, 1, 1, 1, 'baik sedang kami review, jadi tunggu informasi selanjutnya ya', '2025-10-12 00:56:21', '2025-10-12 00:56:21'),
(3, 2, 2, 0, 'Hallo saya tertarik dengan posisi \"Online Tutor of Roblox\" di perusahaan ini. Mohon untuk reviewnya, dan semoga menjadi kandidat yang cocok.', '2025-10-12 01:26:25', '2025-10-12 01:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `crewings`
--

CREATE TABLE `crewings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crews`
--

CREATE TABLE `crews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standby_on` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_of_competency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_of_proficiency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seaferer_medical_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curriculum_vitae` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_documents` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rank_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crews`
--

INSERT INTO `crews` (`id`, `user_id`, `fullname`, `nickname`, `phone`, `birth_place`, `birth_date`, `gender`, `religion`, `marital_status`, `address`, `current_address`, `standby_on`, `ktp`, `certificate_of_competency`, `certificate_of_proficiency`, `seaferer_medical_certificate`, `curriculum_vitae`, `additional_documents`, `rank_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'adnan ega maulana', 'adnan', '083156437871', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, '2025-10-10 12:48:53', '2025-10-10 12:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `employment_types`
--

CREATE TABLE `employment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employment_types`
--

INSERT INTO `employment_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Full Time', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(2, 'Part Time', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(3, 'Contract', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(4, 'Internship', '2025-10-09 07:05:20', '2025-10-09 07:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `experience_levels`
--

CREATE TABLE `experience_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience_levels`
--

INSERT INTO `experience_levels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Fresh Graduate', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(2, 'Junior', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(3, 'Middle', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(4, 'Senior', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(5, 'Supervisor', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(6, 'Manager', '2025-10-09 07:05:20', '2025-10-09 07:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_kerjas`
--

CREATE TABLE `lowongan_kerjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `employment_type_id` bigint(20) UNSIGNED NOT NULL,
  `experience_level_id` bigint(20) UNSIGNED NOT NULL,
  `rank_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sallary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lowongan_kerjas`
--

INSERT INTO `lowongan_kerjas` (`id`, `title`, `description`, `requirements`, `user_id`, `employment_type_id`, `experience_level_id`, `rank_id`, `status`, `image`, `slug`, `sallary`, `education`, `created_at`, `updated_at`) VALUES
(4, 'Online Tutor of Roblox', '<p>Bergabunglah dengan Kodland sebagai Guru Roblox dan Wujudkan Impianmu! 🚀</p><p>Suka Roblox dan ingin berbagi keseruannya dengan anak-anak?</p><p>Di Kodland, kami mencari guru Roblox hebat sepertimu untuk bergabung dengan komunitas global kami!</p><p>Kenapa Kodland?</p><ul><li>Kerja Fleksibel: Atur jadwalmu sendiri, kerja dari mana saja!</li><li>Penghasilan Menarik: Dapatkan penghasilan tambahan yang kompetitif!</li><li>Tingkatkan Skill: Pelatihan dan mentor siap membantumu!</li><li>Materi Lengkap: Fokus mengajar, materi sudah disediakan!</li><li>Komunitas Global: Bergabunglah dengan tim yang suportif!</li><li>Diskon Kursus: Diskon untuk teman dan keluarga!</li></ul>', '<p>Tugasmu:</p><ul><li>Buat kelas Roblox yang seru!</li><li>Tingkatkan skill mengajarmu!</li><li>Beri laporan rutin tentang siswa!</li><li>Terapkan ide-ide kreatif!</li></ul><p>Benefit:</p><ul><li>Jadwal Fleksibel</li><li>Penghasilan Kompetitif</li><li>Pelatihan &amp; Bimbingan</li><li>Materi Lengkap</li><li>Komunitas Global</li><li>Diskon Kursus</li></ul><p>Persyaratan:</p><ul><li>Jago Roblox!</li><li>Punya laptop, internet stabil, dan tempat kerja yang tenang.</li><li>Lulus tes dan tugas setelah wawancara.</li></ul><p>Yuk, bergabung dengan Kodland dan jadilah bagian dari masa depan pendidikan!</p><p>Daftar sekarang dan wujudkan potensi mengajarmu!</p>', 1, 1, 4, 3, '1', '1760064011_akaza.jpg', 'online-tutor-of-roblox', '5000000', 'S1', '2025-10-09 19:40:11', '2025-10-10 13:30:10'),
(5, 'Full Stack Developer', '<p>We are looking for a talented Full Stack Developer to join our team and focus on building and enhancing our core product on AIS. The ideal candidate is passionate about coding, eager to contribute to product development, and ready to take ownership of their work.</p>', '<p><strong>Key Responsibilities</strong></p><ul><li>Design, develop, test, and maintain high-quality software to enhance product functionality.</li><li>Collaborate closely with product and design teams to define and implement new features.</li><li>Debug and resolve product-related issues to ensure a smooth user experience.</li><li>Optimize and refactor code for performance, scalability, and maintainability.</li><li>Participate in code reviews and contribute to the architecture of new product features.</li><li>Document product features and updates.</li></ul><p><strong>Technical Skills Requirements</strong></p><ul><li>Languages: Proficiency in Python, with experience in HTML, JavaScript, JSON, and CSS.</li><li>Frameworks: Familiarity with frameworks such as Langchain, ExpressJS, VueJS.</li><li>Databases and APIs: MySQL, PostgreSQL, Redis, REST.</li><li>Tools: Git, Docker, VS Code, GitHub (repos, projects, actions).</li><li>Cloud Services: Experience with AWS (S3, RDS, Lambda, etc.)</li><li>AI experience</li><li>Has background in C# and .NET. is a plus</li><li>Experienced with AI and machine learning (Pytorch, LLM, OpenAI) is a plus.</li></ul>', 1, 1, 1, 4, '1', '1760067696_akaza2.jpg', 'full-stack-developer', '7000000', 'SMK', '2025-10-09 20:41:36', '2025-10-11 00:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_07_163429_create_ranks_table', 1),
(5, '2025_10_07_163430_create_crews_table', 1),
(6, '2025_10_07_163433_create_crewings_table', 1),
(7, '2025_10_09_085317_create_employment_types_table', 1),
(8, '2025_10_09_085351_create_experience_levels_table', 1),
(9, '2025_10_09_085400_create_lowongan_kerjas_table', 1),
(10, '2025_10_09_091732_create_pertanyaans_table', 1),
(11, '2025_10_11_073532_create_user_pertanyaans_table', 2),
(12, '2025_10_11_073538_create_user_lamarans_table', 2),
(13, '2025_10_11_153644_create_chats_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaans`
--

CREATE TABLE `pertanyaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lowongan_kerja_id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pertanyaans`
--

INSERT INTO `pertanyaans` (`id`, `lowongan_kerja_id`, `pertanyaan`, `created_at`, `updated_at`) VALUES
(4, 4, 'apa saja bahasa yang anda kuasai?', '2025-10-09 20:37:38', '2025-10-09 20:37:38'),
(6, 5, 'tech stack yang di kuasai?', '2025-10-09 20:41:36', '2025-10-09 20:41:36'),
(7, 5, 'kapan bisa join?', '2025-10-09 20:41:36', '2025-10-09 20:41:36'),
(11, 5, 'bisa onsite?', '2025-10-10 00:45:53', '2025-10-10 00:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Crewing Staff', '2', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(2, 'Crewing Superintendent', '2', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(3, 'HRD', '2', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(4, 'Master', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(5, 'Chief Officer', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(6, 'Second Officer', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(7, 'Third Officer', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(8, 'Able Seaman (AB)', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(9, 'Able Seaman (AB)', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(10, 'Chief Engineer', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(11, 'Second Engineer', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(12, 'Third Engineer', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(13, 'Oiler', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(14, 'Cook', '1', '2025-10-09 07:05:20', '2025-10-09 07:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9fPxddnP16IrBSPns7V7zW5TXLXn3AoYXpBnNPmp', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibkFuV1Fydk9OdjVzckY0bHpVUTdhWUxieExDb2RqajFDR2tzSmFhciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xhbWFyYW4iO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1760258876),
('nzRm0Gqw5nFHr3c7ZoTLVPvLiKHdmhBut6NSTZFs', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUnFXNGtzWFFqVWZiUVVtaVNwV3pKM2FUMVY1S0V4SUJydkI2YWFubiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1760617102);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('crew','crewing') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'crewing',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$7SfThT9KrwMz0uJXgOsKeuTJ991WpuVyq7th5nlSUgfs29xAnQ7RG', 'crewing', NULL, NULL, '2025-10-09 07:05:20', '2025-10-09 07:05:20'),
(2, 'adnan ega maulana', 'adnan@gmail.com', NULL, '$2y$12$pZuY.B.kYh9P7K0edYmH7O96tiErfKhhX11ukx.Hs3z3dCB0In7Mu', 'crew', NULL, NULL, '2025-10-10 12:48:52', '2025-10-10 12:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_lamarans`
--

CREATE TABLE `user_lamarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lowongan_kerja_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_lamarans`
--

INSERT INTO `user_lamarans` (`id`, `user_id`, `lowongan_kerja_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 5, '4', '2025-10-11 00:50:13', '2025-10-11 12:10:02'),
(2, 2, 4, '0', '2025-10-12 01:22:54', '2025-10-12 01:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_pertanyaans`
--

CREATE TABLE `user_pertanyaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_pertanyaans`
--

INSERT INTO `user_pertanyaans` (`id`, `user_id`, `pertanyaan_id`, `jawaban`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 'adnan', '2025-10-11 00:50:13', '2025-10-11 00:50:13'),
(2, 2, 7, 'ega', '2025-10-11 00:50:13', '2025-10-11 00:50:13'),
(3, 2, 11, 'm', '2025-10-11 00:50:13', '2025-10-11 00:50:13'),
(4, 2, 4, 'JS, PHP, Golang, Python', '2025-10-12 01:22:54', '2025-10-12 01:22:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_user_lamaran_id_foreign` (`user_lamaran_id`),
  ADD KEY `chats_user_id_foreign` (`user_id`);

--
-- Indexes for table `crewings`
--
ALTER TABLE `crewings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crewings_user_id_foreign` (`user_id`),
  ADD KEY `crewings_rank_id_foreign` (`rank_id`);

--
-- Indexes for table `crews`
--
ALTER TABLE `crews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crews_user_id_foreign` (`user_id`),
  ADD KEY `crews_rank_id_foreign` (`rank_id`);

--
-- Indexes for table `employment_types`
--
ALTER TABLE `employment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience_levels`
--
ALTER TABLE `experience_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lowongan_kerjas`
--
ALTER TABLE `lowongan_kerjas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lowongan_kerjas_user_id_foreign` (`user_id`),
  ADD KEY `lowongan_kerjas_employment_type_id_foreign` (`employment_type_id`),
  ADD KEY `lowongan_kerjas_experience_level_id_foreign` (`experience_level_id`),
  ADD KEY `lowongan_kerjas_rank_id_foreign` (`rank_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pertanyaans_lowongan_kerja_id_foreign` (`lowongan_kerja_id`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_lamarans`
--
ALTER TABLE `user_lamarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_lamarans_user_id_foreign` (`user_id`),
  ADD KEY `user_lamarans_lowongan_kerja_id_foreign` (`lowongan_kerja_id`);

--
-- Indexes for table `user_pertanyaans`
--
ALTER TABLE `user_pertanyaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_pertanyaans_user_id_foreign` (`user_id`),
  ADD KEY `user_pertanyaans_pertanyaan_id_foreign` (`pertanyaan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crewings`
--
ALTER TABLE `crewings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crews`
--
ALTER TABLE `crews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employment_types`
--
ALTER TABLE `employment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `experience_levels`
--
ALTER TABLE `experience_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lowongan_kerjas`
--
ALTER TABLE `lowongan_kerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_lamarans`
--
ALTER TABLE `user_lamarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_pertanyaans`
--
ALTER TABLE `user_pertanyaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chats_user_lamaran_id_foreign` FOREIGN KEY (`user_lamaran_id`) REFERENCES `user_lamarans` (`id`);

--
-- Constraints for table `crewings`
--
ALTER TABLE `crewings`
  ADD CONSTRAINT `crewings_rank_id_foreign` FOREIGN KEY (`rank_id`) REFERENCES `ranks` (`id`),
  ADD CONSTRAINT `crewings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `crews`
--
ALTER TABLE `crews`
  ADD CONSTRAINT `crews_rank_id_foreign` FOREIGN KEY (`rank_id`) REFERENCES `ranks` (`id`),
  ADD CONSTRAINT `crews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `lowongan_kerjas`
--
ALTER TABLE `lowongan_kerjas`
  ADD CONSTRAINT `lowongan_kerjas_employment_type_id_foreign` FOREIGN KEY (`employment_type_id`) REFERENCES `employment_types` (`id`),
  ADD CONSTRAINT `lowongan_kerjas_experience_level_id_foreign` FOREIGN KEY (`experience_level_id`) REFERENCES `experience_levels` (`id`),
  ADD CONSTRAINT `lowongan_kerjas_rank_id_foreign` FOREIGN KEY (`rank_id`) REFERENCES `ranks` (`id`),
  ADD CONSTRAINT `lowongan_kerjas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  ADD CONSTRAINT `pertanyaans_lowongan_kerja_id_foreign` FOREIGN KEY (`lowongan_kerja_id`) REFERENCES `lowongan_kerjas` (`id`);

--
-- Constraints for table `user_lamarans`
--
ALTER TABLE `user_lamarans`
  ADD CONSTRAINT `user_lamarans_lowongan_kerja_id_foreign` FOREIGN KEY (`lowongan_kerja_id`) REFERENCES `lowongan_kerjas` (`id`),
  ADD CONSTRAINT `user_lamarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_pertanyaans`
--
ALTER TABLE `user_pertanyaans`
  ADD CONSTRAINT `user_pertanyaans_pertanyaan_id_foreign` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaans` (`id`),
  ADD CONSTRAINT `user_pertanyaans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
