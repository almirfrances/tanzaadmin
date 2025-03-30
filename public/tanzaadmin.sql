-- phpMyAdmin SQL Dump
-- version 5.2.2deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2025 at 11:27 AM
-- Server version: 11.8.1-MariaDB-2
-- PHP Version: 8.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tanzaadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `phone`, `email`, `email_verified_at`, `status`, `password`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'TanzaAdmin', 'admin', '1234567890', 'masakafrances0@gmail.com', NULL, 'active', '$2y$12$GEBpGLYkRWlwFvnARy7yHOpMeMq4RWr8yJbEOoTAqewZbPVZxEjt2', '2024-12-24 16:16:25', '2025-01-15 10:42:47', 'hc3UnY7FvT7SNJSdMhpmYwxZ45nnTThGE6L9H4FMlhZLOGk46hAodXoZKhZP');

-- --------------------------------------------------------

--
-- Table structure for table `admin_modules`
--

CREATE TABLE `admin_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `author_url` varchar(255) DEFAULT NULL,
  `version` varchar(255) NOT NULL DEFAULT '1.0.0',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_modules`
--

INSERT INTO `admin_modules` (`id`, `name`, `description`, `author`, `author_url`, `version`, `status`, `created_at`, `updated_at`) VALUES
(17, 'Settings', 'This module provides advanced settings management for the application.', 'Almir Frances', 'https://almirfrances.com', '1.0.0', 1, '2025-01-05 22:12:08', '2025-01-06 13:21:24'),
(18, 'Email', 'This module provides advanced settings for email and notifications.', 'Almir Frances', 'https://almirfrances.com', '1.0.0', 1, '2025-01-06 15:10:58', '2025-01-08 21:42:21'),
(20, 'Users', 'This module handles user registration, login, forgot password, and social login functionality.', 'Almir Frances', 'https://almirfrances.com', '1.0.0', 1, '2025-01-14 14:16:46', '2025-01-14 14:16:51'),
(21, 'Ticket', 'A module for managing support tickets.', 'Almir Frances', 'https://almirfrances.com', '1.0.0', 1, '2025-01-16 19:17:36', '2025-01-21 09:52:16'),
(22, 'Blog', 'A module for managing blog posts and content.', 'Almir Frances', 'https://almirfrances.com', '1.0.0', 1, '2025-01-26 09:28:47', '2025-01-26 09:28:56'),
(23, 'Page', 'A module for managing the page builder functionality, including creating pages and managing sections.', 'Almir Frances', 'https://almirfrances.com', '1.0.0', 1, '2025-03-25 15:47:34', '2025-03-25 15:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('settings', 'a:31:{s:9:\"site_name\";s:10:\"TanzaAdmin\";s:10:\"site_email\";s:23:\"almirfrances1@gmail.com\";s:10:\"site_phone\";s:13:\"+255742552286\";s:8:\"timezone\";s:20:\"Africa/Dar_es_Salaam\";s:12:\"facebook_url\";s:20:\"https://facebook.com\";s:11:\"twitter_url\";s:19:\"https://twitter.com\";s:13:\"instagram_url\";s:21:\"https://instagram.com\";s:11:\"youtube_url\";s:19:\"https://youtube.com\";s:12:\"telegram_url\";s:20:\"https://telegram.org\";s:13:\"pinterest_url\";s:21:\"https://pinterest.com\";s:12:\"linkedin_url\";s:20:\"https://linkedin.com\";s:10:\"github_url\";s:18:\"https://github.com\";s:11:\"force_https\";s:1:\"0\";s:11:\"tinymce_api\";s:48:\"bkb8e1wsvymekbkgwejx1p64bq2id5ahvygrtbjsuiz4jlh1\";s:23:\"allow_user_registration\";s:1:\"1\";s:26:\"require_email_confirmation\";s:1:\"1\";s:21:\"notify_admin_on_login\";s:1:\"1\";s:26:\"notify_admin_on_login_fail\";s:1:\"1\";s:25:\"allow_email_notifications\";s:1:\"1\";s:10:\"logo_light\";s:58:\"uploads/logos/AJm6MUhuD4nqsVhsBlimm7LV6jjd7CmTPSKPDNHu.png\";s:9:\"logo_dark\";s:58:\"uploads/logos/A5MvWLxwtM46BX00pzlWEOY8j6AhV9SHW0CTAVqn.png\";s:7:\"favicon\";s:58:\"uploads/logos/jEXIkMzybTDJp9DHIXZw6wSfaUkhvrSvy3ENj04H.png\";s:11:\"header_code\";s:8:\"//header\";s:11:\"footer_code\";s:8:\"//footer\";s:10:\"button_url\";s:16:\"https://test.com\";s:11:\"button_text\";s:12:\"Back to Home\";s:11:\"access_code\";s:4:\"2000\";s:10:\"image_path\";s:64:\"uploads/maintenance/Zx61lsLjh9nQKSbOy5hpGDBsxyNHHFJTP2oyeec2.png\";s:16:\"maintenance_mode\";s:1:\"0\";s:20:\"enable_register_form\";s:1:\"1\";s:17:\"enable_login_form\";s:1:\"1\";}', 1742931135);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(255) NOT NULL,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`settings`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `provider`, `settings`, `created_at`, `updated_at`) VALUES
(1, 'smtp', '{\"email\":\"support@tanzahost.com\",\"host\":\"relay.mailbaby.net\",\"port\":\"2525\",\"encryption\":\"tls\",\"username\":\"example\",\"password\":\"example\"}', '2025-01-06 17:36:47', '2025-03-25 22:07:52'),
(2, 'smtp', '{\"email\":\"admin@example.com\",\"host\":\"smtp.example.com\",\"port\":587,\"encryption\":\"tls\",\"username\":\"admin@example.com\",\"password\":\"password123\"}', '2025-01-07 11:59:05', '2025-01-07 11:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(37, '5eaee7ad-320a-413a-8a1e-aa53fe1acf3a', 'database', 'default', '{\"uuid\":\"5eaee7ad-320a-413a-8a1e-aa53fe1acf3a\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:25:\\\"Verify Your Email Address\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:14:\\\"Nshoma Frances\\\";s:8:\\\"username\\\";s:6:\\\"nshoma\\\";s:4:\\\"code\\\";i:203667;s:9:\\\"site_name\\\";s:10:\\\"TanzaAdmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"451\", with message \"451 You\'ve exceeded your messaging limits\". in /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:342\nStack trace:\n#0 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(198): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode()\n#1 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#2 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(234): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#4 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#5 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#6 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#7 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call()\n#10 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#11 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#12 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#29 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#30 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#36 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#37 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#38 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#40 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#43 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#44 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#45 {main}', '2025-01-15 13:24:29'),
(38, 'd720e0e4-4139-4c51-b7b5-2a81d5141ac8', 'database', 'default', '{\"uuid\":\"d720e0e4-4139-4c51-b7b5-2a81d5141ac8\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:25:\\\"Verify Your Email Address\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:14:\\\"Nshoma Frances\\\";s:8:\\\"username\\\";s:6:\\\"nshoma\\\";s:4:\\\"code\\\";i:471364;s:9:\\\"site_name\\\";s:10:\\\"TanzaAdmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Failed to authenticate on SMTP server with username \"apikey\" using the following authenticators: \"LOGIN\", \"PLAIN\". Authenticator \"LOGIN\" returned \"Expected response code \"235\" but got code \"451\", with message \"451 Authentication failed: Maximum credits exceeded\".\". Authenticator \"PLAIN\" returned \"Expected response code \"235\" but got empty code.\". in /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php:247\nStack trace:\n#0 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(177): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->handleAuth()\n#1 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->doEhloCommand()\n#2 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(255): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(281): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doHeloCommand()\n#4 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(210): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#5 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#6 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#7 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send()\n#10 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html()\n#11 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call()\n#12 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#27 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#30 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#31 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#36 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#37 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#38 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#39 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#40 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#41 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#42 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#43 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#44 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#45 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#46 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#47 {main}', '2025-01-15 13:28:03'),
(39, '787524d5-c1e6-4cf0-b8ed-ac37213be100', 'database', 'default', '{\"uuid\":\"787524d5-c1e6-4cf0-b8ed-ac37213be100\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:25:\\\"Verify Your Email Address\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:14:\\\"Nshoma Frances\\\";s:8:\\\"username\\\";s:6:\\\"nshoma\\\";s:4:\\\"code\\\";i:631319;s:9:\\\"site_name\\\";s:10:\\\"TanzaAdmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Failed to authenticate on SMTP server with username \"apikey\" using the following authenticators: \"LOGIN\", \"PLAIN\". Authenticator \"LOGIN\" returned \"Expected response code \"235\" but got code \"451\", with message \"451 Authentication failed: Maximum credits exceeded\".\". Authenticator \"PLAIN\" returned \"Expected response code \"235\" but got empty code.\". in /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php:247\nStack trace:\n#0 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(177): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->handleAuth()\n#1 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->doEhloCommand()\n#2 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(255): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(281): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doHeloCommand()\n#4 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(210): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#5 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#6 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#7 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send()\n#10 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html()\n#11 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call()\n#12 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#27 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#30 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#31 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#36 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#37 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#38 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#39 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#40 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#41 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#42 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#43 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#44 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#45 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#46 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#47 {main}', '2025-01-15 13:29:47'),
(40, '5f8bcae1-e2af-4d40-8098-cf39dc567a1a', 'database', 'default', '{\"uuid\":\"5f8bcae1-e2af-4d40-8098-cf39dc567a1a\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:25:\\\"Verify Your Email Address\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:14:\\\"Nshoma Frances\\\";s:8:\\\"username\\\";s:6:\\\"nshoma\\\";s:4:\\\"code\\\";i:406843;s:9:\\\"site_name\\\";s:10:\\\"TanzaAdmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Failed to authenticate on SMTP server with username \"apikey\" using the following authenticators: \"LOGIN\", \"PLAIN\". Authenticator \"LOGIN\" returned \"Expected response code \"235\" but got code \"451\", with message \"451 Authentication failed: Maximum credits exceeded\".\". Authenticator \"PLAIN\" returned \"Expected response code \"235\" but got empty code.\". in /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php:247\nStack trace:\n#0 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(177): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->handleAuth()\n#1 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->doEhloCommand()\n#2 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(255): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(281): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doHeloCommand()\n#4 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(210): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#5 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#6 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#7 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send()\n#10 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html()\n#11 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call()\n#12 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#27 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#30 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#31 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#36 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#37 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#38 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#39 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#40 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#41 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#42 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#43 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#44 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#45 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#46 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#47 {main}', '2025-01-15 13:32:15'),
(41, '5a34651b-a9ac-4b94-a291-b05aff95d53b', 'database', 'default', '{\"uuid\":\"5a34651b-a9ac-4b94-a291-b05aff95d53b\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:10:\\\"Test Email\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:10:\\\"TanzaAdmin\\\";s:8:\\\"username\\\";s:10:\\\"tanzaadmin\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";s:7:\\\"message\\\";s:55:\\\"This is a test email to verify the email configuration.\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Failed to authenticate on SMTP server with username \"apikey\" using the following authenticators: \"LOGIN\", \"PLAIN\". Authenticator \"LOGIN\" returned \"Expected response code \"235\" but got code \"451\", with message \"451 Authentication failed: Maximum credits exceeded\".\". Authenticator \"PLAIN\" returned \"Expected response code \"235\" but got empty code.\". in /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php:247\nStack trace:\n#0 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(177): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->handleAuth()\n#1 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->doEhloCommand()\n#2 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(255): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(281): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doHeloCommand()\n#4 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(210): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#5 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#6 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#7 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send()\n#10 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html()\n#11 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call()\n#12 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#27 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#30 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#31 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#36 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#37 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#38 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#39 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#40 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#41 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#42 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#43 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#44 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#45 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#46 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#47 {main}', '2025-01-15 14:40:29');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(42, '977b85f5-66c3-48f2-8b99-73017266f947', 'database', 'default', '{\"uuid\":\"977b85f5-66c3-48f2-8b99-73017266f947\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:10:\\\"Test Email\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:10:\\\"TanzaAdmin\\\";s:8:\\\"username\\\";s:10:\\\"tanzaadmin\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";s:7:\\\"message\\\";s:55:\\\"This is a test email to verify the email configuration.\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Failed to authenticate on SMTP server with username \"apikey\" using the following authenticators: \"LOGIN\", \"PLAIN\". Authenticator \"LOGIN\" returned \"Expected response code \"235\" but got code \"451\", with message \"451 Authentication failed: Maximum credits exceeded\".\". Authenticator \"PLAIN\" returned \"Expected response code \"235\" but got empty code.\". in /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php:247\nStack trace:\n#0 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(177): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->handleAuth()\n#1 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->doEhloCommand()\n#2 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(255): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#3 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(281): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doHeloCommand()\n#4 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(210): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#5 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#6 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#7 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send()\n#10 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html()\n#11 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call()\n#12 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#27 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#30 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#31 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#36 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#37 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#38 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#39 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#40 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#41 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#42 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#43 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#44 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#45 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#46 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#47 {main}', '2025-01-15 14:41:51'),
(43, '92b01bb4-f09b-4377-b2df-9bf35a1d19a1', 'database', 'default', '{\"uuid\":\"92b01bb4-f09b-4377-b2df-9bf35a1d19a1\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:25:\\\"Verify Your Email Address\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:14:\\\"Nshoma Frances\\\";s:8:\\\"username\\\";s:6:\\\"nshoma\\\";s:4:\\\"code\\\";i:851771;s:9:\\\"site_name\\\";s:10:\\\"TanzaAdmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Connection could not be established with host \"ssl://panel.tanzahost.com:465\": stream_socket_client(): php_network_getaddresses: getaddrinfo for panel.tanzahost.com failed: Temporary failure in name resolution in /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/Stream/SocketStream.php:154\nStack trace:\n#0 [internal function]: Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\SocketStream->Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\{closure}()\n#1 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/Stream/SocketStream.php(157): stream_socket_client()\n#2 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(279): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\SocketStream->initialize()\n#3 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(210): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#4 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html()\n#10 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call()\n#11 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#12 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#27 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#29 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#30 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#31 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#34 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#35 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#36 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#37 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#38 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#39 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#40 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#41 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#42 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#43 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#44 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#46 {main}', '2025-01-15 16:04:18'),
(44, '994df308-7091-4fd0-b45e-d67c9b770f1d', 'database', 'default', '{\"uuid\":\"994df308-7091-4fd0-b45e-d67c9b770f1d\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:25:\\\"Verify Your Email Address\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:14:\\\"Nshoma Frances\\\";s:8:\\\"username\\\";s:6:\\\"nshoma\\\";s:4:\\\"code\\\";i:949173;s:9:\\\"site_name\\\";s:10:\\\"TanzaAdmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Connection could not be established with host \"ssl://panel.tanzahost.com:465\": stream_socket_client(): Unable to connect to ssl://panel.tanzahost.com:465 (Connection timed out) in /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/Stream/SocketStream.php:154\nStack trace:\n#0 [internal function]: Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\SocketStream->Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\{closure}()\n#1 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/Stream/SocketStream.php(157): stream_socket_client()\n#2 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(279): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\SocketStream->initialize()\n#3 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(210): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#4 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#5 /home/almir/Desktop/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#6 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#7 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html()\n#10 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call()\n#11 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#12 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#27 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#29 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#30 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#31 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#34 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#35 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#36 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#37 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#38 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#39 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#40 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#41 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#42 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#43 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#44 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#46 {main}', '2025-01-15 16:06:18'),
(45, 'cd202cae-14f1-45f1-878c-0ff2d176f5b6', 'database', 'default', '{\"uuid\":\"cd202cae-14f1-45f1-878c-0ff2d176f5b6\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:16:\\\"New Ticket Alert\\\";s:4:\\\"data\\\";a:10:{s:5:\\\"email\\\";s:10:\\\"Tanzaadmin\\\";s:8:\\\"username\\\";s:10:\\\"Tanzaadmin\\\";s:4:\\\"name\\\";s:10:\\\"Tanzaadmin\\\";s:14:\\\"ticket_subject\\\";s:9:\\\"hello sir\\\";s:15:\\\"ticket_category\\\";s:15:\\\"General Support\\\";s:15:\\\"ticket_priority\\\";s:3:\\\"Low\\\";s:18:\\\"ticket_description\\\";s:14:\\\"jfqeeqljfejjjf\\\";s:9:\\\"user_name\\\";s:14:\\\"Masaka Frances\\\";s:10:\\\"user_email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";}}\"}}', 'Symfony\\Component\\Mime\\Exception\\RfcComplianceException: Email \"Tanzaadmin\" does not comply with addr-spec of RFC 2822. in /home/almir/Desktop/tanzaadmin/vendor/symfony/mime/Address.php:54\nStack trace:\n#0 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Message.php(247): Symfony\\Component\\Mime\\Address->__construct()\n#1 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Message.php(111): Illuminate\\Mail\\Message->addAddresses()\n#2 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(65): Illuminate\\Mail\\Message->to()\n#3 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(316): Modules\\Email\\Jobs\\SendEmail->Modules\\Email\\Jobs\\{closure}()\n#4 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send()\n#5 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html()\n#6 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call()\n#7 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#10 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#11 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#12 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#27 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#29 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#30 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#31 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#34 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#35 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#36 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#37 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#38 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#39 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#40 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#41 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#42 {main}', '2025-01-21 11:57:31'),
(46, 'ce828c97-394c-4281-a7c5-0aed22748d70', 'database', 'default', '{\"uuid\":\"ce828c97-394c-4281-a7c5-0aed22748d70\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:26:\\\"Ticket Closed Notification\\\";s:4:\\\"data\\\";a:9:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:14:\\\"Masaka Frances\\\";s:8:\\\"username\\\";s:6:\\\"nshoma\\\";s:14:\\\"ticket_subject\\\";s:23:\\\"System Backup errorjhbj\\\";s:9:\\\"ticket_id\\\";i:7;s:15:\\\"ticket_category\\\";s:15:\\\"General Support\\\";s:15:\\\"ticket_priority\\\";s:3:\\\"Low\\\";s:18:\\\"ticket_description\\\";s:34:\\\"jdqejdheqd iugdiwgdwd idgwidgwid w\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [Modules\\Email\\Models\\NotificationTemplate]. in /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:639\nStack trace:\n#0 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(49): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#2 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#4 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#5 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#6 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#7 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#10 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#11 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#12 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#27 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#29 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#30 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#31 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#34 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#35 {main}', '2025-01-21 17:57:12'),
(47, 'd0a7e204-4458-4fde-90ca-b739b9bf23c0', 'database', 'default', '{\"uuid\":\"d0a7e204-4458-4fde-90ca-b739b9bf23c0\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:26:\\\"Ticket Closed Notification\\\";s:4:\\\"data\\\";a:9:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:14:\\\"Masaka Frances\\\";s:8:\\\"username\\\";s:6:\\\"nshoma\\\";s:14:\\\"ticket_subject\\\";s:23:\\\"System Backup errorjhbj\\\";s:9:\\\"ticket_id\\\";i:7;s:15:\\\"ticket_category\\\";s:15:\\\"General Support\\\";s:15:\\\"ticket_priority\\\";s:3:\\\"Low\\\";s:18:\\\"ticket_description\\\";s:34:\\\"jdqejdheqd iugdiwgdwd idgwidgwid w\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [Modules\\Email\\Models\\NotificationTemplate]. in /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:639\nStack trace:\n#0 /home/almir/Desktop/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(49): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#2 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#4 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#5 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#6 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call()\n#7 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#8 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#9 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then()\n#10 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#11 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#12 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#13 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Pipeline\\Pipeline->then()\n#14 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(71): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#15 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#16 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#18 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob()\n#19 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon()\n#20 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#21 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure()\n#24 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#25 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(694): Illuminate\\Container\\BoundMethod::call()\n#26 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call()\n#27 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#28 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run()\n#29 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#30 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#31 /home/almir/Desktop/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#32 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#33 /home/almir/Desktop/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1205): Illuminate\\Foundation\\Console\\Kernel->handle()\n#34 /home/almir/Desktop/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand()\n#35 {main}', '2025-01-21 18:00:21');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(48, '8ec0391b-26b0-4b1e-b8d7-46b233c5ed20', 'database', 'default', '{\"uuid\":\"8ec0391b-26b0-4b1e-b8d7-46b233c5ed20\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:18:\\\"New Ticket Created\\\";s:4:\\\"data\\\";a:8:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:13:\\\"Almir Frances\\\";s:8:\\\"username\\\";s:12:\\\"almirfrances\\\";s:14:\\\"ticket_subject\\\";s:16:\\\"Hello Tanzaadmin\\\";s:15:\\\"ticket_category\\\";s:17:\\\"Technical Support\\\";s:15:\\\"ticket_priority\\\";s:6:\\\"Medium\\\";s:18:\\\"ticket_description\\\";s:92:\\\"Hello support please i need help with the admin panel i purchased from you guys few days ago\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 domain is not configured with ORIGIN IP IN SPF see mail.baby/spf log https://mail.outboundspamprotection.com/mailinfo?id=195ce96bac60004c3d&user=mb75246\". in /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:342\nStack trace:\n#0 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(198): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode(\'550 domain is n...\', Array)\n#1 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#2 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(234): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#3 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send(Object(Illuminate\\Support\\HtmlString), Array, Object(Closure))\n#8 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html(\'<table border=\"...\', Object(Closure))\n#9 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call(\'html\', Array)\n#10 /home/almir/Desktop/projects/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic(\'html\', Array)\n#11 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#12 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#13 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call(Array)\n#17 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():123}(Object(Modules\\Email\\Jobs\\SendEmail))\n#18 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#19 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Modules\\Email\\Jobs\\SendEmail), false)\n#21 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():121}(Object(Modules\\Email\\Jobs\\SendEmail))\n#22 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#23 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(121): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Modules\\Email\\Jobs\\SendEmail))\n#25 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(442): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(392): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#33 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call(Array)\n#37 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/almir/Desktop/projects/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-03-25 22:35:41'),
(49, '08b46d1e-b958-41ac-afb3-56ffefd02130', 'database', 'default', '{\"uuid\":\"08b46d1e-b958-41ac-afb3-56ffefd02130\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:16:\\\"New Ticket Alert\\\";s:4:\\\"data\\\";a:10:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:8:\\\"username\\\";s:10:\\\"TanzaAdmin\\\";s:4:\\\"name\\\";s:10:\\\"TanzaAdmin\\\";s:14:\\\"ticket_subject\\\";s:16:\\\"Hello Tanzaadmin\\\";s:15:\\\"ticket_category\\\";s:17:\\\"Technical Support\\\";s:15:\\\"ticket_priority\\\";s:6:\\\"Medium\\\";s:18:\\\"ticket_description\\\";s:92:\\\"Hello support please i need help with the admin panel i purchased from you guys few days ago\\\";s:9:\\\"user_name\\\";s:13:\\\"Almir Frances\\\";s:10:\\\"user_email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 domain is not configured with ORIGIN IP IN SPF see mail.baby/spf log https://mail.outboundspamprotection.com/mailinfo?id=195ce96c4c60004c3d&user=mb75246\". in /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:342\nStack trace:\n#0 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(198): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode(\'550 domain is n...\', Array)\n#1 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#2 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(234): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#3 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send(Object(Illuminate\\Support\\HtmlString), Array, Object(Closure))\n#8 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html(\'<table border=\"...\', Object(Closure))\n#9 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call(\'html\', Array)\n#10 /home/almir/Desktop/projects/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic(\'html\', Array)\n#11 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#12 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#13 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call(Array)\n#17 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():123}(Object(Modules\\Email\\Jobs\\SendEmail))\n#18 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#19 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Modules\\Email\\Jobs\\SendEmail), false)\n#21 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():121}(Object(Modules\\Email\\Jobs\\SendEmail))\n#22 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#23 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(121): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Modules\\Email\\Jobs\\SendEmail))\n#25 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(442): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(392): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#33 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call(Array)\n#37 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/almir/Desktop/projects/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-03-25 22:35:44'),
(50, '957502eb-b4f7-4f65-aadd-ec8064cd5b0f', 'database', 'default', '{\"uuid\":\"957502eb-b4f7-4f65-aadd-ec8064cd5b0f\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:18:\\\"Admin Ticket Reply\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:13:\\\"Almir Frances\\\";s:8:\\\"username\\\";s:12:\\\"almirfrances\\\";s:14:\\\"ticket_subject\\\";s:16:\\\"Hello Tanzaadmin\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 domain is not configured with ORIGIN IP IN SPF see mail.baby/spf log https://mail.outboundspamprotection.com/mailinfo?id=195ce98bc0e000cd49&user=mb75246\". in /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:342\nStack trace:\n#0 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(198): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode(\'550 domain is n...\', Array)\n#1 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#2 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(234): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#3 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send(Object(Illuminate\\Support\\HtmlString), Array, Object(Closure))\n#8 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html(\'<table border=\"...\', Object(Closure))\n#9 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call(\'html\', Array)\n#10 /home/almir/Desktop/projects/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic(\'html\', Array)\n#11 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#12 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#13 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call(Array)\n#17 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():123}(Object(Modules\\Email\\Jobs\\SendEmail))\n#18 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#19 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Modules\\Email\\Jobs\\SendEmail), false)\n#21 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():121}(Object(Modules\\Email\\Jobs\\SendEmail))\n#22 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#23 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(121): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Modules\\Email\\Jobs\\SendEmail))\n#25 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(442): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(392): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#33 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call(Array)\n#37 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/almir/Desktop/projects/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-03-25 22:37:53'),
(51, '35e6005e-2a9e-4fe3-aef9-3ea0e4aa2418', 'database', 'default', '{\"uuid\":\"35e6005e-2a9e-4fe3-aef9-3ea0e4aa2418\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:28:\\\"New Reply Notification Admin\\\";s:4:\\\"data\\\";a:10:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:8:\\\"username\\\";s:10:\\\"TanzaAdmin\\\";s:4:\\\"name\\\";s:10:\\\"TanzaAdmin\\\";s:14:\\\"ticket_subject\\\";s:16:\\\"Hello Tanzaadmin\\\";s:15:\\\"ticket_category\\\";s:17:\\\"Technical Support\\\";s:15:\\\"ticket_priority\\\";s:6:\\\"Medium\\\";s:18:\\\"ticket_description\\\";s:92:\\\"Hello support please i need help with the admin panel i purchased from you guys few days ago\\\";s:9:\\\"user_name\\\";s:13:\\\"Almir Frances\\\";s:10:\\\"user_email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 domain is not configured with ORIGIN IP IN SPF see mail.baby/spf log https://mail.outboundspamprotection.com/mailinfo?id=195ce99993b0002bb5&user=mb75246\". in /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:342\nStack trace:\n#0 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(198): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode(\'550 domain is n...\', Array)\n#1 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#2 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(234): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#3 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send(Object(Illuminate\\Support\\HtmlString), Array, Object(Closure))\n#8 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html(\'<table border=\"...\', Object(Closure))\n#9 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call(\'html\', Array)\n#10 /home/almir/Desktop/projects/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic(\'html\', Array)\n#11 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#12 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#13 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call(Array)\n#17 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():123}(Object(Modules\\Email\\Jobs\\SendEmail))\n#18 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#19 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Modules\\Email\\Jobs\\SendEmail), false)\n#21 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():121}(Object(Modules\\Email\\Jobs\\SendEmail))\n#22 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#23 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(121): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Modules\\Email\\Jobs\\SendEmail))\n#25 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(442): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(392): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#33 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call(Array)\n#37 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/almir/Desktop/projects/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-03-25 22:38:49');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(52, '57bfda77-52eb-4aff-be45-05cf91d3024e', 'database', 'default', '{\"uuid\":\"57bfda77-52eb-4aff-be45-05cf91d3024e\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:18:\\\"Admin Ticket Reply\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:13:\\\"Almir Frances\\\";s:8:\\\"username\\\";s:12:\\\"almirfrances\\\";s:14:\\\"ticket_subject\\\";s:16:\\\"Hello Tanzaadmin\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 domain is not configured with ORIGIN IP IN SPF see mail.baby/spf log https://mail.outboundspamprotection.com/mailinfo?id=195ce9abc9f000cad9&user=mb75246\". in /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:342\nStack trace:\n#0 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(198): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode(\'550 domain is n...\', Array)\n#1 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#2 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(234): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#3 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send(Object(Illuminate\\Support\\HtmlString), Array, Object(Closure))\n#8 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html(\'<table border=\"...\', Object(Closure))\n#9 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call(\'html\', Array)\n#10 /home/almir/Desktop/projects/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic(\'html\', Array)\n#11 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#12 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#13 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call(Array)\n#17 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():123}(Object(Modules\\Email\\Jobs\\SendEmail))\n#18 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#19 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Modules\\Email\\Jobs\\SendEmail), false)\n#21 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():121}(Object(Modules\\Email\\Jobs\\SendEmail))\n#22 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#23 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(121): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Modules\\Email\\Jobs\\SendEmail))\n#25 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(442): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(392): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#33 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call(Array)\n#37 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/almir/Desktop/projects/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-03-25 22:40:17'),
(53, '11beac03-35de-4ed1-bc9f-bbfbb703a0c4', 'database', 'default', '{\"uuid\":\"11beac03-35de-4ed1-bc9f-bbfbb703a0c4\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:26:\\\"Ticket Closed Notification\\\";s:4:\\\"data\\\";a:9:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:13:\\\"Almir Frances\\\";s:8:\\\"username\\\";s:12:\\\"almirfrances\\\";s:14:\\\"ticket_subject\\\";s:16:\\\"Hello Tanzaadmin\\\";s:9:\\\"ticket_id\\\";i:9;s:15:\\\"ticket_category\\\";s:17:\\\"Technical Support\\\";s:15:\\\"ticket_priority\\\";s:6:\\\"Medium\\\";s:18:\\\"ticket_description\\\";s:92:\\\"Hello support please i need help with the admin panel i purchased from you guys few days ago\\\";s:9:\\\"site_name\\\";s:10:\\\"Tanzaadmin\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 domain is not configured with ORIGIN IP IN SPF see mail.baby/spf log https://mail.outboundspamprotection.com/mailinfo?id=195ce9b6171000cad9&user=mb75246\". in /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:342\nStack trace:\n#0 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(198): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode(\'550 domain is n...\', Array)\n#1 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#2 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(234): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#3 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send(Object(Illuminate\\Support\\HtmlString), Array, Object(Closure))\n#8 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html(\'<table border=\"...\', Object(Closure))\n#9 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call(\'html\', Array)\n#10 /home/almir/Desktop/projects/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic(\'html\', Array)\n#11 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#12 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#13 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call(Array)\n#17 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():123}(Object(Modules\\Email\\Jobs\\SendEmail))\n#18 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#19 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Modules\\Email\\Jobs\\SendEmail), false)\n#21 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():121}(Object(Modules\\Email\\Jobs\\SendEmail))\n#22 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#23 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(121): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Modules\\Email\\Jobs\\SendEmail))\n#25 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(442): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(392): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#33 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call(Array)\n#37 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/almir/Desktop/projects/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-03-25 22:40:56'),
(54, 'aa1b5867-c1ac-446e-99d9-4c3dadee12a5', 'database', 'default', '{\"uuid\":\"aa1b5867-c1ac-446e-99d9-4c3dadee12a5\",\"displayName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Modules\\\\Email\\\\Jobs\\\\SendEmail\",\"command\":\"O:28:\\\"Modules\\\\Email\\\\Jobs\\\\SendEmail\\\":2:{s:12:\\\"templateName\\\";s:22:\\\"Successful Admin Login\\\";s:4:\\\"data\\\";a:5:{s:5:\\\"email\\\";s:23:\\\"almirfrances1@gmail.com\\\";s:4:\\\"name\\\";s:10:\\\"TanzaAdmin\\\";s:8:\\\"username\\\";s:5:\\\"admin\\\";s:9:\\\"site_name\\\";s:10:\\\"TanzaAdmin\\\";s:7:\\\"message\\\";s:47:\\\"A successful login to the admin panel was made.\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"250\" but got code \"550\", with message \"550 domain is not configured with ORIGIN IP IN SPF see mail.baby/spf log https://mail.outboundspamprotection.com/mailinfo?id=195e64cc2c5000b7fc&user=mb75246\". in /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php:342\nStack trace:\n#0 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(198): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode(\'550 domain is n...\', Array)\n#1 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(134): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#2 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(234): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand(\'\\r\\n.\\r\\n\', Array)\n#3 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(585): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(332): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(212): Illuminate\\Mail\\Mailer->send(Object(Illuminate\\Support\\HtmlString), Array, Object(Closure))\n#8 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(622): Illuminate\\Mail\\Mailer->html(\'<table border=\"...\', Object(Closure))\n#9 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(361): Illuminate\\Mail\\MailManager->__call(\'html\', Array)\n#10 /home/almir/Desktop/projects/tanzaadmin/Modules/Email/app/Jobs/SendEmail.php(64): Illuminate\\Support\\Facades\\Facade::__callStatic(\'html\', Array)\n#11 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Modules\\Email\\Jobs\\SendEmail->handle()\n#12 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#13 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(126): Illuminate\\Container\\Container->call(Array)\n#17 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Bus\\Dispatcher->{closure:Illuminate\\Bus\\Dispatcher::dispatchNow():123}(Object(Modules\\Email\\Jobs\\SendEmail))\n#18 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#19 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(130): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Modules\\Email\\Jobs\\SendEmail), false)\n#21 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(170): Illuminate\\Queue\\CallQueuedHandler->{closure:Illuminate\\Queue\\CallQueuedHandler::dispatchThroughMiddleware():121}(Object(Modules\\Email\\Jobs\\SendEmail))\n#22 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():168}(Object(Modules\\Email\\Jobs\\SendEmail))\n#23 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(121): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Modules\\Email\\Jobs\\SendEmail))\n#25 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(442): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(392): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(178): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(149): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(132): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#33 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(95): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Container/Container.php(696): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(213): Illuminate\\Container\\Container->call(Array)\n#37 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Console/Command.php(182): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/almir/Desktop/projects/tanzaadmin/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/almir/Desktop/projects/tanzaadmin/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/almir/Desktop/projects/tanzaadmin/artisan(13): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-03-30 13:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `parent_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Logo', 'logo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `global_templates`
--

CREATE TABLE `global_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Global Template',
  `subject` varchar(255) DEFAULT NULL,
  `html_template` longtext NOT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `shortcodes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`shortcodes`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `global_templates`
--

INSERT INTO `global_templates` (`id`, `name`, `subject`, `html_template`, `from_name`, `from_email`, `shortcodes`, `created_at`, `updated_at`) VALUES
(1, 'Global Email Template', 'Your Notification from {{site_name}}', '<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#f3f4f6\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 30px 20px;\" align=\"center\"><!-- Container -->\r\n<table style=\"background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); overflow: hidden;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\"><!-- Header -->\r\n<tbody>\r\n<tr>\r\n<td style=\"background: linear-gradient(135deg, #6b73ff, #000dff); padding: 20px;\" align=\"center\"><img style=\"display: block;\" src=\"https://tanzahost.com/assets/images/logoIcon/dark_logo.png\" alt=\"{{site_name}} Logo\" width=\"150\"></td>\r\n</tr>\r\n<!-- Greeting -->\r\n<tr>\r\n<td style=\"padding: 20px 30px; font-family: Arial,sans-serif; color: #333333;\" align=\"center\">\r\n<h1 style=\"margin: 0; font-size: 22px; font-weight: 600;\">Hello {{name}} ({{username}}),</h1>\r\n<p style=\"margin: 10px 0 0; font-size: 16px; color: #555555; line-height: 1.6;\">{{message}}</p>\r\n</td>\r\n</tr>\r\n<!-- Regards -->\r\n<tr>\r\n<td style=\"padding: 20px 30px; font-family: Arial,sans-serif; color: #555555; font-size: 16px; line-height: 1.6;\" align=\"left\">\r\n<p style=\"margin: 0;\">Regards,</p>\r\n<p style=\"margin: 5px 0 0; font-weight: 600;\">{{site_name}} Support Team</p>\r\n</td>\r\n</tr>\r\n<!-- Divider -->\r\n<tr>\r\n<td style=\"padding: 10px 30px;\" align=\"center\"><hr style=\"border: none; height: 1px; background-color: #eeeeee;\"></td>\r\n</tr>\r\n<!-- Footer -->\r\n<tr>\r\n<td style=\"padding: 20px 30px; background-color: #f9fafc; font-family: Arial,sans-serif; color: #777777; font-size: 14px;\" align=\"center\">\r\n<p style=\"margin: 0;\">&copy; <span id=\"currentYear\">2025&nbsp;</span> {{site_name}}. All Rights Reserved.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'TanzaAdmin Supports', 'support@tanzahost.com', NULL, '2025-01-06 17:52:31', '2025-03-25 22:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
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
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '0001_01_01_000001_create_cache_table', 1),
(11, '0001_01_01_000002_create_jobs_table', 1),
(12, '2024_12_24_104538_create_admins_table', 1),
(14, '2024_12_26_092015_create_owners_table', 2),
(15, '2024_12_26_111117_add_deleted_at_to_owners_table', 3),
(16, '2024_12_26_222237_create_hotels_table', 4),
(17, '2024_12_26_225328_add_deleted_at_to_hotels_table', 5),
(18, '2024_12_27_084944_create_floors_table', 6),
(19, '2024_12_27_104226_add_soft_deletes_and_status_to_floors_table', 7),
(20, '2024_12_27_161620_create_rooms_table', 8),
(21, '2024_12_27_184251_create_cameras_table', 9),
(22, '2024_12_27_184736_create_camera_room_table', 9),
(23, '2024_12_27_200720_create_zones_table', 10),
(24, '2024_12_27_201539_add_protocol_to_cameras_table', 11),
(25, '2025_01_01_122430_create_personal_access_tokens_table', 12),
(26, '2025_01_01_122527_create_oauth_auth_codes_table', 13),
(27, '2025_01_01_122528_create_oauth_access_tokens_table', 13),
(28, '2025_01_01_122529_create_oauth_refresh_tokens_table', 13),
(29, '2025_01_01_122530_create_oauth_clients_table', 13),
(30, '2025_01_01_122531_create_oauth_personal_access_clients_table', 13),
(31, '2025_01_01_220512_create_admin_modules_table', 14),
(41, '2025_01_06_145047_create_settings_table', 15),
(42, '2025_01_06_183339_create_email_settings_table', 16),
(44, '2025_01_06_183339_create_notification_templates_table', 16),
(45, '2025_01_06_183339_create_global_templates_table', 17),
(46, '2025_01_06_213049_add_from_name_and_from_email_to_global_templates_table', 18),
(49, '2025_01_09_140014_create_folders_table', 19),
(50, '2025_01_09_140101_create_media_table', 19),
(52, '0001_01_01_000000_create_users_table', 20),
(53, '2025_01_15_134045_create_email_verifications_table', 21),
(54, '2025_01_16_095307_create_social_logins_table', 22),
(67, '2025_01_18_130952_add_level_id_to_tickets_table', 24),
(71, '2025_01_21_102409_create_tickets_table', 25),
(72, '2025_01_21_102550_create_replies_table', 25),
(73, '2025_01_21_102559_create_ticket_settings_table', 25),
(74, '2025_01_26_124525_create_post_categories_table', 26),
(75, '2025_01_26_124545_create_posts_table', 26),
(76, '2025_01_26_124557_create_tags_table', 26),
(77, '2025_01_26_124608_create_post_tag_table', 26),
(78, '2025_03_25_123931_create_pages_table', 27),
(79, '2025_03_25_124036_create_page_seos_table', 27),
(80, '2025_03_25_124148_create_page_sections_table', 27),
(81, '2025_03_25_143438_create_sections_data_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `name`, `slug`, `subject`, `body`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Test Email', 'test-email', 'Test Email from {{site_name}}', 'Hello {{name}}, this is a test email from {{site_name}}.', 1, NULL, '2025-01-07 09:09:03'),
(12, 'Failed Admin Login Attempt', 'failed-admin-login-attempt', 'Failed Login Attempt Notification', 'Dear {{name}}, a failed login attempt was detected for the admin panel. If this wasn’t you, please take action immediately.', 1, '2025-01-07 15:00:10', '2025-01-07 15:17:04'),
(13, 'Successful Admin Login', 'successful-admin-login', 'Successful Login Notification', 'Dear {{name}}, a successful login to the admin panel has been made. If this wasn’t you, please take action immediately.', 1, '2025-01-07 15:01:04', '2025-01-07 15:01:04'),
(14, 'Successful Backup', 'successful-backup', 'System Backup Completed', 'The system backup for {{site_name}} has been successfully created.', 1, '2025-01-08 18:56:11', '2025-01-08 18:56:11'),
(15, 'Failed Backup', 'failed-backup', 'System Backup Failed', 'An error occurred while creating the system backup for {{site_name}}. \r\n \r\n\r\nPlease check the logs for further details.', 1, '2025-01-08 18:57:41', '2025-01-08 18:57:41'),
(18, 'Password Reset Code', 'password-reset-code', 'Your Password Reset Code', 'You have requested to reset your password. Your reset code is:\r\n\r\n{{code}}\r\n\r\nIf you did not request this, please ignore this email.', 1, '2025-01-13 09:32:49', '2025-01-13 09:32:49'),
(19, 'Verify Your Email Address', 'user-email-confirmation', 'Confirm Your Email Address', 'Thank you for registering at {{site_name}}.\r\n\r\nPlease confirm your email address by entering the following code:\r\n\r\n{{code}}\r\n\r\nThis code is valid for the next 15 minutes.\r\n\r\nIf you did not initiate this registration, please ignore this email.', 1, '2025-01-15 10:46:50', '2025-01-15 13:21:19'),
(20, 'Welcome Email', 'welcome-email', 'Welcome to {{site_name}}!', 'Thank you for joining {{site_name}}! We\'re excited to have you as part of our community.\r\n\r\nHere\'s what you can do as a member of {{site_name}}:\r\n- Explore our features and services designed to enhance your experience.\r\n- Manage your profile and customize your preferences.\r\n- Stay updated with the latest news and updates.\r\n\r\nIf you have any questions or need assistance, feel free to reach out to our support team. We\'re here to help!\r\n\r\nThank you for choosing {{site_name}}.', 1, '2025-01-15 19:17:36', '2025-01-15 19:20:57'),
(21, 'New Ticket Created', 'new-ticket-created', 'New Ticket Created: {{ticket_subject}}', 'Thank you for reaching out to us at {{site_name}}. Your support ticket has been successfully created with the following details:\r\n\r\nTicket Details:\r\n\r\n    Subject: {{ticket_subject}}\r\n    Category: {{ticket_category}}\r\n    Description: {{ticket_description}}\r\n\r\nOur support team will review your ticket and respond to you as soon as possible. You can track the status of your ticket by logging into your account on our platform.\r\n\r\nIf you have any additional information or documents to share, please reply to this ticket.', 1, '2025-01-21 11:50:08', '2025-01-21 12:00:01'),
(22, 'New Ticket Alert', 'new-ticket-alert', 'New Ticket Alert: {{ticket_subject}}', 'A new support ticket has been created on {{site_name}}. Below are the details of the ticket:\r\n\r\nTicket Details:\r\n\r\n    Subject: {{ticket_subject}}\r\n    Category: {{ticket_category}}\r\n    Priority: {{ticket_priority}}\r\n    Description: {{ticket_description}}\r\n\r\nUser Details:\r\n\r\n    Name: {{user_name}}\r\n    Email: {{user_email}}\r\n\r\nPlease log in to the admin panel to review and respond to this ticket at your earliest convenience.', 1, '2025-01-21 11:52:13', '2025-01-21 12:05:04'),
(23, 'New Reply Notification Admin', 'new-reply-notification-admin', 'New Ticket Reply Notification Admin', '<h1>New Reply from {{user_name}}</h1>\r\n    <p><strong>Subject:</strong> {{ticket_subject}}</p>\r\n    <hr>', 1, '2025-01-21 17:49:48', '2025-01-21 17:49:48'),
(24, 'Ticket Closed Notification', 'your-ticket-ticket-id-has-been-closed', 'Your Ticket #{{ticket_id}} has been Closed', 'This is to inform you that your ticket #{{ticket_id}} has been marked as **closed**.\r\n\r\nIf you feel your issue has not been resolved or if you need further assistance, you can reopen the ticket.\r\n\r\nThank you for allowing us to assist you.', 1, '2025-01-21 17:56:45', '2025-01-21 17:59:55'),
(25, 'Ticket Reopened Notification', 'ticket-reopened-notification', 'Your Ticket #{{ticket_id}} has been Reopened', 'Your ticket #{{ticket_id}} has been successfully reopened.\r\n\r\nOur support team will review your request and respond promptly. You can track your ticket\'s progress [here]({{ route(\'user.tickets.show\', $ticket->id) }}).\r\n\r\nThank you for your patience.', 1, '2025-01-21 18:05:22', '2025-01-21 18:05:22'),
(26, 'Admin Ticket Reply', 'admin-ticket-reply', 'Re: Your Ticket #{{ticket_subject}}', 'Thank you for reaching out to us. We’ve reviewed your ticket and have provided a response, please feel free to reply, log in to your account to view the ticket.', 1, '2025-01-25 17:14:20', '2025-01-25 17:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'UCl1kfHLileQ5UnkPZ6YLTuUh1PizyY25DA5wX4O', NULL, 'http://localhost', 1, 0, 0, '2025-01-01 09:26:12', '2025-01-01 09:26:12'),
(2, NULL, 'Laravel Password Grant Client', 'XGRb35Riq0XeXGymnLS40ZHon8aUW4dRkJFwIoA4', 'users', 'http://localhost', 0, 1, 0, '2025-01-01 09:26:12', '2025-01-01 09:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-01-01 09:26:12', '2025-01-01 09:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `is_closed`, `created_at`, `updated_at`) VALUES
(1, 'Homepage', '', 1, '2025-03-25 17:10:54', '2025-03-25 17:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `page_sections`
--

CREATE TABLE `page_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `section_key` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_sections`
--

INSERT INTO `page_sections` (`id`, `page_id`, `section_key`, `position`, `content`, `created_at`, `updated_at`) VALUES
(6, 1, 'homebanner2', 1, NULL, '2025-03-25 21:53:49', '2025-03-25 21:53:49');

-- --------------------------------------------------------

--
-- Table structure for table `page_seos`
--

CREATE TABLE `page_seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `seo_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `post_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `featured_image`, `meta_description`, `status`, `post_category_id`, `created_at`, `updated_at`) VALUES
(1, 'Hire Ethical Hackers dark web', 'hire-ethical-hackers-dark-web', 'fgdhg rggfg gdfgf gfg', 'uploads/posts/ELlLhhIn3IZ2IogaWZMfbzgka6369ErjeBv8NvSl.jpg', NULL, 'published', 2, '2025-01-28 07:27:21', '2025-01-28 07:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Software Blog postsss', 'software-blog-postsss', '2025-01-28 06:56:28', '2025-01-28 07:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `sender_type` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `ticket_id`, `user_id`, `admin_id`, `message`, `attachment`, `sender_type`, `created_at`, `updated_at`) VALUES
(1, 1, 16, NULL, 'please fix it faster', '[\"ticket_replies\\/2abeIfJW5UrNNFn2RK0Uda25INOELRC6B6Bcj5nK.png\"]', 'user', '2025-01-21 10:33:51', '2025-01-21 10:33:51'),
(2, 3, 16, NULL, 'make fast please', NULL, 'user', '2025-01-21 10:51:01', '2025-01-21 10:51:01'),
(3, 1, 16, NULL, 'admin', NULL, 'user', '2025-01-21 17:50:00', '2025-01-21 17:50:00'),
(4, 7, 16, NULL, 'okay', NULL, 'user', '2025-01-21 18:12:27', '2025-01-21 18:12:27'),
(5, 2, 16, NULL, 'check it', '[\"ticket_replies\\/9410iCzfRrnXEX6vEbZPcWGy4dLQCndH0RmIs2Ea.pdf\"]', 'user', '2025-01-24 16:03:28', '2025-01-24 16:03:28'),
(6, 1, 16, NULL, 'please sir', '[\"ticket_replies\\/nCwORP1ZdAwIpwpbMPz2toaov3X1NURqVeonnaI3.pdf\",\"ticket_replies\\/7lvk0Mzy3YQvDxjIJEPy2XzYmTohgsPNHkuL7pGj.txt\",\"ticket_replies\\/I6dXVOoLuuWDPQQgQL8ZxLJjxmgYrGr3lRW4FH9B.png\"]', 'user', '2025-01-24 16:23:28', '2025-01-24 16:23:28'),
(7, 1, NULL, 1, 'okay then, what you want?', NULL, 'admin', '2025-01-24 16:50:43', '2025-01-24 16:50:43'),
(8, 1, 16, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id nunc ullamcorper purus euismod fermentum. Ut placerat arcu feugiat nunc vestibulum, id sollicitudin orci consequat. Donec quis arcu imperdiet nisl varius sodales. Praesent porta ligula ex, non euismod lorem egestas tempor. Vestibulum luctus orci sit amet dui ornare, in auctor erat consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque dignissim et velit nec egestas. Nam viverra risus ante, ultrices gravida sem sodales non. Maecenas interdum, nunc et bibendum aliquet, orci nunc congue lorem, sollicitudin vestibulum risus magna vel quam. Praesent elit ipsum, iaculis sed nulla quis, bibendum fringilla est. Vivamus interdum lacus libero, sit amet accumsan diam ultricies vitae.', NULL, 'user', '2025-01-24 17:17:25', '2025-01-24 17:17:25'),
(9, 1, NULL, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id nunc ullamcorper purus euismod fermentum. Ut placerat arcu feugiat nunc vestibulum, id sollicitudin orci consequat. Donec quis arcu imperdiet nisl varius sodales. Praesent porta ligula ex, non euismod lorem egestas tempor. Vestibulum luctus orci sit amet dui ornare, in auctor erat consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque dignissim et velit nec egestas. Nam viverra risus ante, ultrices gravida sem sodales non. Maecenas interdum, nunc et bibendum aliquet, orci nunc congue lorem, sollicitudin vestibulum risus magna vel quam. Praesent elit ipsum, iaculis sed nulla quis, bibendum fringilla est. Vivamus interdum lacus libero, sit amet accumsan diam ultricies vitae.', '[\"ticket_replies\\/3jkstTlAKTF5a9gwezWUeubox3cPSvhLLGbVOKzp.pdf\"]', 'admin', '2025-01-24 18:54:50', '2025-01-24 18:54:50'),
(10, 1, 16, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id nunc ullamcorper purus euismod fermentum. Ut placerat arcu feugiat nunc vestibulum, id sollicitudin orci consequat. Donec quis arcu imperdiet nisl varius sodales. Praesent porta ligula ex, non euismod lorem egestas tempor. Vestibulum luctus orci sit amet dui ornare, in auctor erat consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque dignissim et velit nec egestas. Nam viverra risus ante, ultrices gravida sem sodales non. Maecenas interdum, nunc et bibendum aliquet, orci nunc congue lorem, sollicitudin vestibulum risus magna vel quam. Praesent elit ipsum, iaculis sed nulla quis, bibendum fringilla est. Vivamus interdum lacus libero, sit amet accumsan diam ultricies vitae.', NULL, 'user', '2025-01-24 18:55:13', '2025-01-24 18:55:13'),
(11, 1, NULL, 1, 'okay', NULL, 'admin', '2025-01-25 17:17:01', '2025-01-25 17:17:01'),
(12, 1, NULL, 1, 'okay', NULL, 'admin', '2025-01-25 17:17:43', '2025-01-25 17:17:43'),
(13, 8, NULL, 1, 'okay', NULL, 'admin', '2025-01-25 18:41:40', '2025-01-25 18:41:40'),
(14, 8, 16, NULL, 'yeah mate', NULL, 'user', '2025-01-25 18:42:12', '2025-01-25 18:42:12'),
(15, 8, NULL, 1, 'cool', NULL, 'admin', '2025-01-25 18:43:09', '2025-01-25 18:43:09'),
(16, 9, NULL, 1, 'mhm. can you give us more details about it?', '[\"ticket_replies\\/NCoZWSljTw4lRg5k97FD9qR41gIaybfsaeSGSXCa.png\"]', 'admin', '2025-03-25 22:37:30', '2025-03-25 22:37:30'),
(17, 9, 18, NULL, 'okay!', '[\"ticket_replies\\/Qut5eDy3H0RY0gPxgKJgOn0JS6ePOtjbiNuDZeSJ.png\"]', 'user', '2025-03-25 22:38:37', '2025-03-25 22:38:37'),
(18, 9, NULL, 1, 'so what do you mean by that', NULL, 'admin', '2025-03-25 22:39:26', '2025-03-25 22:39:26');

-- --------------------------------------------------------

--
-- Table structure for table `sections_data`
--

CREATE TABLE `sections_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_key` varchar(255) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections_data`
--

INSERT INTO `sections_data` (`id`, `section_key`, `content`, `created_at`, `updated_at`) VALUES
(1, 'about', '\"{\\\"title\\\":\\\"fdfd\\\",\\\"description\\\":\\\"fsfsf\\\"}\"', '2025-03-25 18:38:13', '2025-03-25 18:42:30'),
(2, 'homebanner2', '\"{\\\"heading\\\":\\\"Testing\\\",\\\"subheading\\\":\\\"test mate\\\",\\\"guarantee\\\":\\\"a hundred\\\",\\\"customer_name\\\":\\\"holaa\\\"}\"', '2025-03-25 18:49:04', '2025-03-25 18:49:04'),
(3, '2', '\"[]\"', '2025-03-25 20:35:26', '2025-03-25 20:35:26'),
(4, 'homebanner2', '\"{\\\"heading\\\":\\\"hjghjg\\\",\\\"subheading\\\":\\\"hghhjgh\\\",\\\"guarantee\\\":\\\"hjhjbhjb\\\",\\\"customer_name\\\":\\\"jhbhjhj\\\"}\"', '2025-03-25 21:07:58', '2025-03-25 21:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9BDgPE51eLUVm0kFiZxYVWNU0MZZtmDKwlFAYh6w', NULL, '10.244.235.25', 'Mozilla/5.0 (X11; Linux x86_64; rv:128.0) Gecko/20100101 Firefox/128.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic3lKanlRdXZYcHN6T1hlbGJGdkdGZ0xuZG5iSEtIS1I3MWpNa1ZqSSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo4NToiaHR0cDovLzEwLjI0NC4yMzUuMjU6ODAwMC9hc3NldHMvdmVuZG9yL2xpYnMvZGF0YXRhYmxlcy1iczUvZGF0YXRhYmxlcy1ib290c3RyYXA1LmNzcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1743334034),
('YVUC5brq3j8zgkDZcrnyA8yE6ip1eACNPhYK3W46', NULL, '10.244.59.126', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoielVjMzNLVThwUkthZkV5ZXdBN05KSUpmY2pyam1jaWlIdnBDc1lnYSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo4NToiaHR0cDovLzEwLjI0NC4yMzUuMjU6ODAwMC9hc3NldHMvdmVuZG9yL2xpYnMvZGF0YXRhYmxlcy1iczUvZGF0YXRhYmxlcy1ib290c3RyYXA1LmNzcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1743325401);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'TanzaAdmin', NULL, NULL),
(2, 'site_email', 'almirfrances1@gmail.com', NULL, '2025-01-07 14:47:54'),
(3, 'site_phone', '+255742552286', NULL, NULL),
(4, 'timezone', 'Africa/Dar_es_Salaam', NULL, '2025-01-06 13:21:54'),
(5, 'facebook_url', 'https://facebook.com', NULL, NULL),
(6, 'twitter_url', 'https://twitter.com', NULL, NULL),
(7, 'instagram_url', 'https://instagram.com', NULL, NULL),
(8, 'youtube_url', 'https://youtube.com', NULL, NULL),
(9, 'telegram_url', 'https://telegram.org', NULL, NULL),
(10, 'pinterest_url', 'https://pinterest.com', NULL, NULL),
(11, 'linkedin_url', 'https://linkedin.com', NULL, NULL),
(12, 'github_url', 'https://github.com', NULL, NULL),
(13, 'force_https', '0', '2025-01-06 13:37:03', '2025-01-07 13:13:03'),
(14, 'tinymce_api', 'bkb8e1wsvymekbkgwejx1p64bq2id5ahvygrtbjsuiz4jlh1', '2025-01-07 11:14:50', '2025-01-07 11:14:50'),
(15, 'allow_user_registration', '1', '2025-01-07 12:53:29', '2025-01-15 17:49:37'),
(16, 'require_email_confirmation', '1', '2025-01-07 12:59:59', '2025-01-16 09:33:13'),
(17, 'notify_admin_on_login', '1', '2025-01-07 13:02:28', '2025-03-25 22:32:15'),
(18, 'notify_admin_on_login_fail', '1', '2025-01-07 13:02:28', '2025-03-25 22:32:15'),
(19, 'allow_email_notifications', '1', '2025-01-07 13:13:09', '2025-01-07 13:13:09'),
(20, 'logo_light', 'uploads/logos/AJm6MUhuD4nqsVhsBlimm7LV6jjd7CmTPSKPDNHu.png', '2025-01-09 13:49:13', '2025-01-09 13:59:38'),
(21, 'logo_dark', 'uploads/logos/A5MvWLxwtM46BX00pzlWEOY8j6AhV9SHW0CTAVqn.png', '2025-01-09 13:49:13', '2025-01-09 13:59:38'),
(22, 'favicon', 'uploads/logos/jEXIkMzybTDJp9DHIXZw6wSfaUkhvrSvy3ENj04H.png', '2025-01-09 13:49:13', '2025-01-09 14:10:36'),
(23, 'header_code', '//header', '2025-01-10 08:41:03', '2025-01-10 08:41:03'),
(24, 'footer_code', '//footer', '2025-01-10 08:41:03', '2025-01-10 08:41:03'),
(25, 'button_url', 'https://test.com', '2025-01-10 11:05:59', '2025-01-10 11:05:59'),
(26, 'button_text', 'Back to Home', '2025-01-10 11:05:59', '2025-01-10 11:05:59'),
(27, 'access_code', '2000', '2025-01-10 11:05:59', '2025-01-10 11:05:59'),
(28, 'image_path', 'uploads/maintenance/Zx61lsLjh9nQKSbOy5hpGDBsxyNHHFJTP2oyeec2.png', '2025-01-10 11:05:59', '2025-01-10 11:38:56'),
(29, 'maintenance_mode', '0', '2025-01-10 11:06:06', '2025-01-10 11:38:56'),
(30, 'enable_register_form', '1', '2025-01-16 13:43:06', '2025-03-25 22:32:06'),
(31, 'enable_login_form', '1', '2025-01-16 13:43:06', '2025-03-25 22:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `social_logins`
--

CREATE TABLE `social_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  `redirect_url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_logins`
--

INSERT INTO `social_logins` (`id`, `provider`, `client_id`, `client_secret`, `redirect_url`, `status`, `created_at`, `updated_at`) VALUES
(5, 'google', 'your-google-client-id', 'your-google-secret', 'http://10.244.235.25:8000/social-login/google/callback', 1, '2025-01-16 07:29:44', '2025-03-30 15:27:14'),
(6, 'facebook', 'your-facebook-client-id', 'your-facebook-client-secret', 'http://10.244.235.25:8000/social-login/facebook/callback', 1, '2025-01-16 07:29:44', '2025-03-30 15:27:14'),
(7, 'github', 'your-github-client-id', 'your-github-client-secret', 'http://10.244.235.25:8000/social-login/github/callback', 1, '2025-01-16 07:29:44', '2025-03-30 15:27:14'),
(8, 'twitter', 'your-twitter-client-id', 'your-twitter-client-secret', 'http://10.244.235.25:8000/social-login/twitter/callback', 1, '2025-01-16 07:29:44', '2025-03-30 15:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'tech', 'tech', '2025-01-28 07:27:21', '2025-01-28 07:27:21'),
(2, 'blog', 'blog', '2025-01-28 07:27:21', '2025-01-28 07:27:21'),
(3, 'maisha', 'maisha', '2025-01-28 07:37:39', '2025-01-28 07:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `attachment` varchar(255) DEFAULT NULL,
  `auto_close_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `subject`, `description`, `category`, `priority`, `status`, `attachment`, `auto_close_at`, `created_at`, `updated_at`) VALUES
(9, 18, 'Hello Tanzaadmin', 'Hello support please i need help with the admin panel i purchased from you guys few days ago', 'Technical Support', 'Medium', 'closed', NULL, '2025-04-01 22:35:06', '2025-03-25 22:35:06', '2025-03-25 22:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_settings`
--

CREATE TABLE `ticket_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_settings`
--

INSERT INTO `ticket_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'auto_close_open_days', '7', '2025-01-25 17:36:42', '2025-01-25 17:36:42'),
(2, 'auto_close_answered_days', '3', '2025-01-25 17:36:42', '2025-01-25 17:36:42'),
(3, 'auto_close_pending_days', '5', '2025-01-25 17:36:42', '2025-01-25 17:36:42'),
(4, 'allow_ticket_attachments', '1', '2025-01-25 17:37:06', '2025-03-25 22:35:52'),
(5, 'auto_delete_days', '1', '2025-01-25 17:41:10', '2025-01-25 18:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `phone`, `email`, `email_verified_at`, `status`, `password`, `created_at`, `updated_at`, `remember_token`) VALUES
(18, 'Almir Frances', 'almirfrances', '0742552286', 'almirfrances1@gmail.com', '2025-03-25 22:34:15', 'active', '$2y$12$G5Z2Qo5yspSzwBOJs8bx9ushRyrFQJE/KyZbOchv2uXfVXb/.GqNG', '2025-03-25 22:33:23', '2025-03-25 22:34:15', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_modules`
--
ALTER TABLE `admin_modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_modules_name_unique` (`name`);

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
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_verifications_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folders_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `global_templates`
--
ALTER TABLE `global_templates`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notification_templates_slug_unique` (`slug`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `page_sections`
--
ALTER TABLE `page_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_sections_page_id_foreign` (`page_id`);

--
-- Indexes for table `page_seos`
--
ALTER TABLE `page_seos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_seos_page_id_unique` (`page_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_post_category_id_foreign` (`post_category_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_categories_slug_unique` (`slug`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_post_id_foreign` (`post_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections_data`
--
ALTER TABLE `sections_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_settings`
--
ALTER TABLE `ticket_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_modules`
--
ALTER TABLE `admin_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `global_templates`
--
ALTER TABLE `global_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `page_sections`
--
ALTER TABLE `page_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `page_seos`
--
ALTER TABLE `page_seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sections_data`
--
ALTER TABLE `sections_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket_settings`
--
ALTER TABLE `ticket_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_sections`
--
ALTER TABLE `page_sections`
  ADD CONSTRAINT `page_sections_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_seos`
--
ALTER TABLE `page_seos`
  ADD CONSTRAINT `page_seos_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_post_category_id_foreign` FOREIGN KEY (`post_category_id`) REFERENCES `post_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
