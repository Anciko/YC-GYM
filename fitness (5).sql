-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2022 at 10:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `banking_infos`
--

CREATE TABLE `banking_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ban_words`
--

CREATE TABLE `ban_words` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ban_word_english` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ban_word_myanmar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ban_word_myanglish` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message_id` int(11) NOT NULL,
  `chat_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `ban_word_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `friends` int(11) NOT NULL DEFAULT 0,
  `request_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calories` double(8,2) NOT NULL DEFAULT 0.00,
  `protein` double(8,2) NOT NULL DEFAULT 0.00,
  `carbohydrates` double(8,2) NOT NULL DEFAULT 0.00,
  `fat` double(8,2) NOT NULL DEFAULT 0.00,
  `meal_plan_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `name`, `calories`, `protein`, `carbohydrates`, `fat`, `meal_plan_type`, `created_at`, `updated_at`) VALUES
(1, 'နွားနို့', 100.00, 100.00, 200.00, 100.00, 'Breakfast', '2022-10-29 07:13:00', '2022-10-29 07:13:00'),
(2, 'ထမင်းကြော်', 1000.00, 100.00, 100.00, 500.00, 'Breakfast', '2022-10-29 07:13:33', '2022-10-29 07:13:33'),
(3, 'တရုတ်ထမင်းကြော်', 3000.00, 9000.00, 100.00, 1000.00, 'Lunch', '2022-10-29 07:14:20', '2022-10-29 07:14:20'),
(4, 'ချောကလတ်', 2000.00, 0.00, 100.00, 100.00, 'Snack', '2022-10-29 07:25:14', '2022-10-29 07:25:14'),
(5, 'ကြက်ဥပြုတ်', 200.00, 500.00, 100.00, 0.00, 'Dinner', '2022-10-29 07:26:14', '2022-10-29 07:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `meal_plans`
--

CREATE TABLE `meal_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT 0,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_type`, `duration`, `price`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Free', '0', 0, 4, '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(2, 'Platinum', '1', 5000, 5, '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(3, 'Gold', '1', 20000, 6, '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(4, 'Diamond', '1', 40000, 7, '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(5, 'Ruby', '1', 100000, 8, '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(6, 'Ruby Premium', '1', 200000, 9, '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(7, 'Gym Member', '1', 40000, 11, '2022-10-29 03:18:20', '2022-10-29 03:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `member_histories`
--

CREATE TABLE `member_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `member_type_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_histories`
--

INSERT INTO `member_histories` (`id`, `user_id`, `member_id`, `member_type_level`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 'beginner', NULL, '2022-10-29 03:20:42', '2022-10-29 03:20:42'),
(2, 10, 4, 'beginner', NULL, '2022-10-29 07:30:06', '2022-10-29 07:30:06'),
(3, 11, 4, 'beginner', NULL, '2022-10-29 07:33:39', '2022-10-29 07:33:39'),
(4, 12, 5, 'beginner', NULL, '2022-10-29 07:45:33', '2022-10-29 07:45:33'),
(5, 14, 7, 'beginner', NULL, '2022-10-29 07:54:39', '2022-10-29 07:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `member_users`
--

CREATE TABLE `member_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `member_type_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `training_group_id` int(11) NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `training_group_id`, `text`, `media`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '635cbac96822f_4825112.png', '2022-10-29 05:31:53', '2022-10-29 05:31:53'),
(2, 1, 'hello testing', NULL, '2022-10-29 05:32:15', '2022-10-29 05:32:15'),
(3, 1, NULL, '635cbaeb1c364_video.mp4', '2022-10-29 05:32:27', '2022-10-29 05:32:27'),
(4, 1, 'hello ttttttttttt', NULL, '2022-10-29 06:55:19', '2022-10-29 06:55:19'),
(5, 1, NULL, '635cce5e95514_download.png', '2022-10-29 06:55:26', '2022-10-29 06:55:26'),
(6, 3, 'hello Ruby members', NULL, '2022-10-29 07:49:02', '2022-10-29 07:49:02'),
(7, 3, 'Hello All', NULL, '2022-10-29 07:49:15', '2022-10-29 07:49:15'),
(8, 3, '😁', NULL, '2022-10-29 07:49:40', '2022-10-29 07:49:40'),
(9, 3, NULL, '635cdb1dee4ce_4825112.png', '2022-10-29 07:49:49', '2022-10-29 07:49:49'),
(10, 3, NULL, '635cdb27af439_normal video 1.mp4', '2022-10-29 07:49:59', '2022-10-29 07:49:59');

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
(191, '2014_10_12_000000_create_users_table', 1),
(192, '2014_10_12_100000_create_password_resets_table', 1),
(193, '2019_08_19_000000_create_failed_jobs_table', 1),
(194, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(195, '2022_10_03_083913_create_members_table', 1),
(196, '2022_10_03_085136_create_meals_table', 1),
(197, '2022_10_03_085159_create_meal_plans_table', 1),
(198, '2022_10_03_085228_create_workouts_table', 1),
(199, '2022_10_03_085238_create_workout_plans_table', 1),
(200, '2022_10_04_043623_create_permission_tables', 1),
(201, '2022_10_05_030727_create_trainers_table', 1),
(202, '2022_10_05_050953_create_shop_posts_table', 1),
(203, '2022_10_05_051014_create_shop_comments_table', 1),
(204, '2022_10_05_051036_create_shop_members_table', 1),
(205, '2022_10_05_052602_create_shop_reacts_table', 1),
(206, '2022_10_05_063858_create_chats_table', 1),
(207, '2022_10_05_065206_create_friends_table', 1),
(208, '2022_10_05_065216_create_profiles_table', 1),
(209, '2022_10_05_065224_create_comments_table', 1),
(210, '2022_10_05_065253_create_reacts_table', 1),
(211, '2022_10_05_065302_create_posts_table', 1),
(212, '2022_10_05_065327_create_ban_words_table', 1),
(213, '2022_10_06_083238_create_member_users_table', 1),
(214, '2022_10_06_083718_create_training_centers_table', 1),
(215, '2022_10_07_025346_create_payments_table', 1),
(216, '2022_10_07_031443_create_personal_reports_table', 1),
(217, '2022_10_07_032525_create_member_histories_table', 1),
(218, '2022_10_07_080616_create_banking_infos_table', 1),
(219, '2022_10_18_051530_create_training_users_table', 1),
(220, '2022_10_18_051544_create_training_groups_table', 1),
(221, '2022_10_18_070020_create_messages_table', 1),
(222, '2022_10_26_030535_create_personal_meal_infos_table', 1),
(223, '2022_10_27_104328_create_personal_work_out_infos_table', 1),
(224, '2022_10_28_143320_create_water_trackeds_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 3),
(7, 'App\\Models\\User', 10),
(7, 'App\\Models\\User', 11),
(8, 'App\\Models\\User', 12),
(10, 'App\\Models\\User', 2),
(10, 'App\\Models\\User', 4),
(10, 'App\\Models\\User', 9),
(10, 'App\\Models\\User', 13),
(11, 'App\\Models\\User', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` bigint(20) NOT NULL DEFAULT 0,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `payment_type`, `bank_account_number`, `bank_account_holder`, `account_name`, `payment_name`, `phone`, `amount`, `photo`, `created_at`, `updated_at`) VALUES
(1, 3, 'ewallet', NULL, NULL, 'Test Kpay', 'KBZ Pay', '0912345678', 2000, '635c9c15dbc46_IMG_0667.PNG.JPG', '2022-10-29 03:20:54', '2022-10-29 03:20:54'),
(2, 3, 'ewallet', NULL, NULL, 'Test Kpay', 'KBZ Pay', '0912345678', 2000, '635c9c168127b_IMG_0667.PNG.JPG', '2022-10-29 03:20:54', '2022-10-29 03:20:54'),
(3, 10, 'ewallet', NULL, NULL, 'Kptest', 'KBZ Pay', '0988776655', 20000, '635cd6ab1371f_IMG_0667.PNG.JPG', '2022-10-29 07:30:51', '2022-10-29 07:30:51'),
(4, 11, 'bank', '1233333333333333', 'Testing AYA', NULL, NULL, NULL, 30000, '635cd7826e9fa_download (1).png', '2022-10-29 07:34:26', '2022-10-29 07:34:26'),
(5, 12, 'ewallet', NULL, NULL, 'Wtest', 'Wave Pay', '09543219876', 20000, '635cda3907890_IMG_0546.JPG.JPG', '2022-10-29 07:46:01', '2022-10-29 07:46:01'),
(6, 14, 'bank', '09123123213133', 'Testing', NULL, NULL, NULL, 40000, '635cdc61e678d_IMG_0667.PNG.JPG', '2022-10-29 07:55:13', '2022-10-29 07:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_meal_infos`
--

CREATE TABLE `personal_meal_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meal_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `serving` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_meal_infos`
--

INSERT INTO `personal_meal_infos` (`id`, `meal_id`, `client_id`, `serving`, `date`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 2, '2022-10-29', '2022-10-29 07:15:01', '2022-10-29 07:15:01'),
(2, 4, 10, 1, '2022-10-29', '2022-10-29 07:39:17', '2022-10-29 07:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `personal_reports`
--

CREATE TABLE `personal_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `workout_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_work_out_infos`
--

CREATE TABLE `personal_work_out_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `workout_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_work_out_infos`
--

INSERT INTO `personal_work_out_infos` (`id`, `workout_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 10, '2022-10-29 07:38:17', '2022-10-29 07:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `ban_word_id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favourite_status` tinyint(1) NOT NULL,
  `viewers` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reacts`
--

CREATE TABLE `reacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `react_status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'King', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(2, 'Queen', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(3, 'System_Admin', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(4, 'Free', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(5, 'Platinum', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(6, 'Gold', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(7, 'Diamond', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(8, 'Ruby', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(9, 'Ruby Premium', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(10, 'Trainer', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(11, 'Gym Member', 'web', '2022-10-29 03:18:20', '2022-10-29 03:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_comments`
--

CREATE TABLE `shop_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_post_id` int(11) NOT NULL,
  `shop_member_id` int(11) NOT NULL,
  `ban_word_id` int(11) NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_members`
--

CREATE TABLE `shop_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_posts`
--

CREATE TABLE `shop_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_member_id` int(11) NOT NULL,
  `ban_word_id` int(11) NOT NULL,
  `caption` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewers` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_reacts`
--

CREATE TABLE `shop_reacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_post_id` int(11) NOT NULL,
  `shop_member_id` int(11) NOT NULL,
  `react_status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_centers`
--

CREATE TABLE `training_centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meal_plan_id` int(11) NOT NULL,
  `workout_plan_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `training_group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_groups`
--

CREATE TABLE `training_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `member_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_type_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_groups`
--

INSERT INTO `training_groups` (`id`, `trainer_id`, `member_type`, `group_name`, `group_type`, `member_type_level`, `gender`, `created_at`, `updated_at`) VALUES
(1, 2, 'Gold', 'Weight Loss GP', 'weight gain', 'beginner', 'male', '2022-10-29 05:30:39', '2022-10-29 05:30:39'),
(2, 4, 'Ruby', 'Weight Loss Ruby', 'weight loss', 'beginner', 'male', '2022-10-29 07:43:32', '2022-10-29 07:43:32'),
(3, 13, 'Ruby', 'Body Beauty', 'body beauty', 'beginner', 'male', '2022-10-29 07:48:30', '2022-10-29 07:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `training_users`
--

CREATE TABLE `training_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `training_group_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_users`
--

INSERT INTO `training_users` (`id`, `user_id`, `training_group_id`, `created_at`, `updated_at`) VALUES
(1, 12, 3, '2022-10-29 07:48:41', '2022-10-29 07:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membertype_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ingroup` tinyint(1) NOT NULL DEFAULT 0,
  `height` int(11) NOT NULL DEFAULT 0,
  `weight` double(8,2) NOT NULL DEFAULT 0.00,
  `ideal_weight` double(8,2) NOT NULL DEFAULT 0.00,
  `bad_habits` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `most_attention_areas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `average_night` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physical_activity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diet_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daily_life` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `energy_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physical_limitation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `goal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activities` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bmi` double(8,2) NOT NULL DEFAULT 0.00,
  `bmr` double(8,2) NOT NULL DEFAULT 0.00,
  `bfp` double(8,2) NOT NULL DEFAULT 0.00,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `active_status` tinyint(1) DEFAULT NULL,
  `neck` double(8,2) NOT NULL DEFAULT 0.00,
  `waist` double(8,2) NOT NULL DEFAULT 0.00,
  `hip` double(8,2) NOT NULL DEFAULT 0.00,
  `shoulders` double(8,2) NOT NULL DEFAULT 0.00,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hydration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_id` int(11) NOT NULL DEFAULT 0,
  `chat_id` int(11) NOT NULL DEFAULT 0,
  `message_id` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `email`, `member_type`, `membertype_level`, `member_code`, `ingroup`, `height`, `weight`, `ideal_weight`, `bad_habits`, `most_attention_areas`, `average_night`, `physical_activity`, `diet_type`, `daily_life`, `energy_level`, `body_type`, `physical_limitation`, `age`, `goal`, `activities`, `bmi`, `bmr`, `bfp`, `gender`, `from_date`, `to_date`, `active_status`, `neck`, `waist`, `hip`, `shoulders`, `password`, `hydration`, `training_type`, `profile_id`, `chat_id`, `message_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', '0912345678', NULL, 'user@gmail.com', '', '', NULL, 0, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, '$2y$10$HX.uU2N3nme0UwJmnuoFretkka6qKmvKWvYpCqHZj/uCsMO9nY/.y', NULL, NULL, 0, 0, 0, NULL, '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(2, 'trainer', '09123456789', NULL, 'trainer@gmail.com', '', '', NULL, 0, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, '$2y$10$i7kRmAcdn/omm.VSrAEMr.bbAbyxaHRdPdGgoQKRmZw3tUaRps5Da', NULL, NULL, 0, 0, 0, NULL, '2022-10-29 03:18:20', '2022-10-29 03:18:20'),
(3, 'Diamond', '09987654321', 'Mandalay', 'diamond@gmail.com', 'Diamond', 'beginner', NULL, 0, 50, 120.00, 100.00, '[\"too much soda\"]', '[\"back\",\"arms\",\"butt\"]', 'average', '1 - 2 times a week', 'pescatarian', 'walking daily', 'a dip in energy around lunch time', 'Mesomorph', '[\"knee pain\"]', '8', 'keep fit', 'running', 33.74, 1137.32, -96.96, 'female', '2022-10-29', '2022-11-29', 2, 68.00, 44.00, 32.00, 49.00, '$2y$10$uy.GOkZmtiMXoNSoLwpJ4.j7oaou8XEpg5TJUi3zo75HuisVkdJiG', '2 to 6 glasses', NULL, 0, 0, 0, NULL, '2022-10-29 03:20:42', '2022-10-29 03:21:30'),
(4, 'Trainer One', '09123456788', 'MDY', '', '', '', NULL, 0, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, '$2y$10$JPbz53GHrlMKNxcMDyWKBec3k0vpnOkipEGAikLOWIpT1G7MDfmBO', NULL, 'weight_gain', 0, 0, 0, NULL, '2022-10-29 07:19:49', '2022-10-29 07:19:49'),
(9, 'Trainer Two', '0912345677', 'MDY', NULL, '', '', NULL, 0, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, '$2y$10$jfAg7QYKLshXuC2nzv6G5.G0HqCHRh/Z3giDEaWN5x9ufqNPNGSca', NULL, 'weight_loss', 0, 0, 0, NULL, '2022-10-29 07:24:08', '2022-10-29 07:24:08'),
(10, 'Diamond User', '0988776655', 'MDY', 'dd@gmail.com', 'Diamond', 'beginner', NULL, 0, 64, 150.00, 120.00, '[\"late night snacks\"]', '[\"legs\"]', 'sleep hero', '1 - 2 times a week', 'vegan', 'walking daily', 'a nap after meals', 'Mesomorph', '[\"back pain\"]', '22', 'keep fit', 'walking', 25.74, 1591.72, 3.07, 'male', '2022-10-29', '2022-11-29', 2, 12.00, 24.00, 0.00, 27.00, '$2y$10$LBBCe/ojBnomxiPS1fFcau/LmLsp5cAlkmhfMEGSyyuWjfQgBoNqu', 'more than 6 glasses', NULL, 0, 0, 0, NULL, '2022-10-29 07:30:06', '2022-10-29 07:35:08'),
(11, 'Diamond User 2', '0911223344', 'MDYY', 'dd2@gmail.com', 'Diamond', 'beginner', NULL, 0, 61, 120.00, 150.00, '[\"sweet tooth\"]', '[\"back\",\"butt\"]', 'minimal', '1 - 2 times a week', 'vagetarian', 'at the office', 'even throughout the day', 'Ectomorph', '[\"back pain\"]', '18', 'lose weight', 'walking', 22.67, 1428.00, -47.25, 'male', '2022-10-29', '2022-11-29', 2, 20.00, 23.00, 0.00, 23.00, '$2y$10$xorgLmionuUBw9.ispYrAOs4WG7/5h8VlnQf.Xq3ZLPtq/o0Caify', 'about 2 glasses', NULL, 0, 0, 0, NULL, '2022-10-29 07:33:39', '2022-10-29 07:35:09'),
(12, 'Rubyy', '09543219876', 'MDY', 'rr@gmail.com', 'Ruby', 'beginner', NULL, 1, 70, 130.00, 100.00, '[\"sweet tooth\"]', '[\"chest\",\"belly\",\"butt\"]', 'minimal', '3 - 5 times a week', 'vagetarian', 'walking daily', 'even throughout the day', 'Endomorph', '[\"knee pain\"]', '18', 'lose weight', 'running', 18.65, 1616.28, -32.35, 'male', '2022-10-29', '2022-11-29', 2, 22.00, 27.00, 0.00, 23.00, '$2y$10$gXmmTX80U3CVoW5616LJ6eStjnpG7C6Mzt8KjKSow9VJKuxO79cO6', '2 to 6 glasses', NULL, 0, 0, 0, NULL, '2022-10-29 07:45:33', '2022-10-29 07:48:41'),
(13, 'Body Beauty Trainer', '09887654321', 'MDY', NULL, '', '', NULL, 0, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, '$2y$10$GQh3p4WrV2PkYqHLFV9KY.b7eG04hwgYDz07wSre/I4lA57u5WCxu', NULL, 'body_beauty', 0, 0, 0, NULL, '2022-10-29 07:47:57', '2022-10-29 07:47:57'),
(14, 'GYM Member', '09123123123', 'MDY', 'gym@gmail.com', 'Gym Member', 'beginner', NULL, 0, 61, 130.00, 120.00, '[\"sweet tooth\"]', '[\"back\",\"arms\",\"butt\"]', 'minimal', '3 - 5 times a week', 'traditional', 'mostly at home', 'a nap after meals', 'Ectomorph', '[\"limited mobility\"]', '23', 'build muscles', 'running', 24.56, 1448.36, -21.36, 'male', '2022-10-29', '2022-11-29', 2, 22.00, 28.00, 0.00, 12.00, '$2y$10$QPCZJAqgYtonwB6ssewHXO17GYVqLFnk54DVsU762pzngY8qMWoHm', 'more than 6 glasses', NULL, 0, 0, 0, NULL, '2022-10-29 07:54:39', '2022-10-29 07:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `water_trackeds`
--

CREATE TABLE `water_trackeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `update_water` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `water_trackeds`
--

INSERT INTO `water_trackeds` (`id`, `user_id`, `update_water`, `date`, `created_at`, `updated_at`) VALUES
(1, 10, 3000, '2022-10-29', '2022-10-29 07:39:33', '2022-10-29 07:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `workouts`
--

CREATE TABLE `workouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `workout_plan_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workout_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `gender_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calories` double(8,2) NOT NULL,
  `workout_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workout_periods` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workouts`
--

INSERT INTO `workouts` (`id`, `workout_plan_type`, `member_type`, `workout_name`, `time`, `gender_type`, `calories`, `workout_level`, `workout_periods`, `place`, `day`, `image`, `video`, `created_at`, `updated_at`) VALUES
(1, 'weight loss', 'Diamond', 'WL', 18, 'male', 200.00, 'beginner', '0', 'gym', 'Saturday', '635cd5d56a9c2_IMG_0667.PNG.JPG', '635cd5d568317_normal video 2.mp4', '2022-10-29 07:27:17', '2022-10-29 07:27:17'),
(2, 'weight gain', 'Diamond', 'WG', 6, 'male', 100.00, 'beginner', '0', 'gym', 'Saturday', '635cd600a47a1_e3789741779d070921769a47ef1d9d17.jpg', '635cd600a328f_normal video 1.mp4', '2022-10-29 07:28:00', '2022-10-29 07:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `workout_plans`
--

CREATE TABLE `workout_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banking_infos`
--
ALTER TABLE `banking_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ban_words`
--
ALTER TABLE `ban_words`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meal_plans`
--
ALTER TABLE `meal_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_histories`
--
ALTER TABLE `member_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_histories_user_id_foreign` (`user_id`),
  ADD KEY `member_histories_member_id_foreign` (`member_id`);

--
-- Indexes for table `member_users`
--
ALTER TABLE `member_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_users_user_id_foreign` (`user_id`),
  ADD KEY `member_users_member_id_foreign` (`member_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `personal_meal_infos`
--
ALTER TABLE `personal_meal_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_reports`
--
ALTER TABLE `personal_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_work_out_infos`
--
ALTER TABLE `personal_work_out_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reacts`
--
ALTER TABLE `reacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `shop_comments`
--
ALTER TABLE `shop_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_members`
--
ALTER TABLE `shop_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_posts`
--
ALTER TABLE `shop_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_reacts`
--
ALTER TABLE `shop_reacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_centers`
--
ALTER TABLE `training_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_groups`
--
ALTER TABLE `training_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_users`
--
ALTER TABLE `training_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `water_trackeds`
--
ALTER TABLE `water_trackeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banking_infos`
--
ALTER TABLE `banking_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ban_words`
--
ALTER TABLE `ban_words`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meal_plans`
--
ALTER TABLE `meal_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `member_histories`
--
ALTER TABLE `member_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member_users`
--
ALTER TABLE `member_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_meal_infos`
--
ALTER TABLE `personal_meal_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_reports`
--
ALTER TABLE `personal_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_work_out_infos`
--
ALTER TABLE `personal_work_out_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reacts`
--
ALTER TABLE `reacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shop_comments`
--
ALTER TABLE `shop_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_members`
--
ALTER TABLE `shop_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_posts`
--
ALTER TABLE `shop_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_reacts`
--
ALTER TABLE `shop_reacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_centers`
--
ALTER TABLE `training_centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_groups`
--
ALTER TABLE `training_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `training_users`
--
ALTER TABLE `training_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `water_trackeds`
--
ALTER TABLE `water_trackeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workout_plans`
--
ALTER TABLE `workout_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `member_histories`
--
ALTER TABLE `member_histories`
  ADD CONSTRAINT `member_histories_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `member_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_users`
--
ALTER TABLE `member_users`
  ADD CONSTRAINT `member_users_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `member_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
