-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2022 at 05:30 AM
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

--
-- Dumping data for table `ban_words`
--

INSERT INTO `ban_words` (`id`, `ban_word_english`, `ban_word_myanmar`, `ban_word_myanglish`, `created_at`, `updated_at`) VALUES
(1, 'hhhh', 'mmmm', 'fgfgfgf', NULL, NULL),
(2, 'hhhh', 'mmmm', 'fgfgfgf', NULL, NULL),
(5, 'hhhh', 'mmmm', 'ooogf', NULL, '2022-11-02 05:06:54'),
(8, 'Hello', 'Hi', 'k', '2022-11-02 06:50:15', '2022-11-02 06:51:37');

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
(1, 'Free', '0', 0, 4, '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(2, 'Platinum', '1', 5000, 5, '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(3, 'Gold', '1', 20000, 6, '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(4, 'Diamond', '1', 40000, 7, '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(5, 'Ruby', '1', 100000, 8, '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(6, 'Ruby Premium', '1', 200000, 9, '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(7, 'Gym Member', '1', 40000, 11, '2022-10-27 08:04:02', '2022-10-27 08:04:02');

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
(1, 3, 4, 'beginner', NULL, '2022-10-27 08:06:50', '2022-10-27 08:06:50'),
(2, 4, 4, 'beginner', NULL, '2022-10-27 08:18:16', '2022-10-27 08:18:16'),
(3, 5, 3, 'beginner', NULL, '2022-10-28 04:14:11', '2022-10-28 04:14:11'),
(4, 7, 7, 'advanced', NULL, '2022-10-28 07:07:56', '2022-10-28 07:07:56'),
(5, 8, 5, 'beginner', NULL, '2022-10-28 09:23:21', '2022-10-28 09:23:21'),
(6, 8, 5, 'beginner', NULL, '2022-10-29 09:30:31', '2022-10-29 09:30:31'),
(7, 8, 5, 'beginner', NULL, '2022-10-29 09:31:13', '2022-10-29 09:31:13'),
(8, 8, 5, 'beginner', NULL, '2022-10-29 09:32:01', '2022-10-29 09:32:01'),
(14, 8, 5, 'beginner', NULL, '2022-11-01 07:17:16', '2022-11-01 07:17:16'),
(17, 16, 1, 'beginner', NULL, '2022-11-08 04:22:17', '2022-11-08 04:22:17'),
(18, 16, 2, 'beginner', NULL, '2022-11-08 04:22:39', '2022-11-08 04:22:39');

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
(1, 3, 'hello', NULL, '2022-10-28 08:19:59', '2022-10-28 08:19:59'),
(2, 3, NULL, '635b90c4c08ca_sample6s.mp4', '2022-10-28 08:20:20', '2022-10-28 08:20:20'),
(3, 3, 'I am me', NULL, '2022-10-28 08:33:09', '2022-10-28 08:33:09'),
(4, 3, 'You are you', NULL, '2022-10-28 08:33:26', '2022-10-28 08:33:26'),
(5, 3, 'We are not same', NULL, '2022-10-28 08:33:39', '2022-10-28 08:33:39'),
(7, 0, 'hi', NULL, '2022-10-29 05:02:12', '2022-10-29 05:02:12'),
(8, 3, 'hi', NULL, '2022-10-29 05:02:31', '2022-10-29 05:02:31'),
(9, 3, 'yes', NULL, '2022-10-29 05:02:45', '2022-10-29 05:02:45'),
(10, 5, NULL, '635ccf3c56809_635364750d9ea_sample.mp4', '2022-10-29 06:59:08', '2022-10-29 06:59:08'),
(11, 3, NULL, '635cd04a75e28_OIP.jpg', '2022-10-29 07:03:38', '2022-10-29 07:03:38');

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
(16, '2022_10_05_063842_create_messages_table', 1),
(217, '2014_10_12_000000_create_users_table', 2),
(218, '2014_10_12_100000_create_password_resets_table', 2),
(219, '2019_08_19_000000_create_failed_jobs_table', 2),
(220, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(221, '2022_10_03_083913_create_members_table', 2),
(222, '2022_10_03_085136_create_meals_table', 2),
(223, '2022_10_03_085159_create_meal_plans_table', 2),
(224, '2022_10_03_085228_create_workouts_table', 2),
(225, '2022_10_03_085238_create_workout_plans_table', 2),
(226, '2022_10_04_043623_create_permission_tables', 2),
(227, '2022_10_05_030727_create_trainers_table', 2),
(228, '2022_10_05_050953_create_shop_posts_table', 2),
(229, '2022_10_05_051014_create_shop_comments_table', 2),
(230, '2022_10_05_051036_create_shop_members_table', 2),
(231, '2022_10_05_052602_create_shop_reacts_table', 2),
(232, '2022_10_05_063858_create_chats_table', 2),
(233, '2022_10_05_065206_create_friends_table', 2),
(234, '2022_10_05_065216_create_profiles_table', 2),
(235, '2022_10_05_065224_create_comments_table', 2),
(236, '2022_10_05_065253_create_reacts_table', 2),
(237, '2022_10_05_065302_create_posts_table', 2),
(238, '2022_10_05_065327_create_ban_words_table', 2),
(239, '2022_10_06_083238_create_member_users_table', 2),
(240, '2022_10_06_083718_create_training_centers_table', 2),
(241, '2022_10_07_025346_create_payments_table', 2),
(242, '2022_10_07_031443_create_personal_reports_table', 2),
(243, '2022_10_07_032525_create_member_histories_table', 2),
(244, '2022_10_07_080616_create_banking_infos_table', 2),
(245, '2022_10_18_051530_create_training_users_table', 2),
(246, '2022_10_18_051544_create_training_groups_table', 2),
(247, '2022_10_18_070020_create_messages_table', 2),
(248, '2022_10_26_030535_create_personal_meal_infos_table', 2),
(249, '2022_10_27_104328_create_personal_work_out_infos_table', 2),
(250, '2022_10_28_143320_create_water_trackeds_table', 3),
(251, '2022_11_03_155133_create_weight_histories_table', 4);

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
(4, 'App\\Models\\User', 9),
(4, 'App\\Models\\User', 10),
(4, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 12),
(4, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 15),
(5, 'App\\Models\\User', 16),
(6, 'App\\Models\\User', 5),
(7, 'App\\Models\\User', 3),
(7, 'App\\Models\\User', 4),
(8, 'App\\Models\\User', 8),
(10, 'App\\Models\\User', 2),
(11, 'App\\Models\\User', 7);

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
(1, 4, 3, 5, '2022-11-03', '2022-11-03 07:33:42', '2022-11-03 07:33:42'),
(2, 4, 3, 5, '2022-11-03', '2022-11-03 08:14:12', '2022-11-03 08:14:12'),
(3, 4, 3, 4, '2022-11-03', '2022-11-03 08:38:02', '2022-11-03 08:38:02');

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
  `complete_status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_work_out_infos`
--

INSERT INTO `personal_work_out_infos` (`id`, `workout_id`, `user_id`, `complete_status`, `created_at`, `updated_at`, `date`) VALUES
(26, 4, 3, 0, '2022-11-04 09:18:18', '2022-11-04 09:18:18', '2022-11-04');

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
(1, 'King', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(2, 'Queen', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(3, 'System_Admin', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(4, 'Free', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(5, 'Platinum', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(6, 'Gold', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(7, 'Diamond', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(8, 'Ruby', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(9, 'Ruby Premium', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(10, 'Trainer', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02'),
(11, 'Gym Member', 'web', '2022-10-27 08:04:02', '2022-10-27 08:04:02');

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
(3, 2, 'Gold', 'Adena Bradley', 'weight gain', 'beginner', 'female', '2022-10-28 06:35:20', '2022-10-28 06:35:20'),
(5, 2, 'Gold', 'Burke Dunn', 'weight gain', 'beginner', 'female', '2022-10-29 06:37:16', '2022-10-29 06:37:16'),
(6, 2, 'Ruby', 'Adena Bradley', 'weight gain', 'beginner', 'male', '2022-11-01 07:26:35', '2022-11-01 07:26:35'),
(7, 2, 'Ruby Premium', 'Nelle Wilkins', 'weight gain', 'advanced', 'male', '2022-11-01 07:26:47', '2022-11-01 07:26:47');

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
(73, 5, 3, '2022-10-29 06:49:18', '2022-10-29 06:49:18'),
(75, 8, 6, '2022-11-03 02:34:30', '2022-11-03 02:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  `request_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `email`, `member_type`, `membertype_level`, `member_code`, `ingroup`, `height`, `weight`, `ideal_weight`, `bad_habits`, `most_attention_areas`, `average_night`, `physical_activity`, `diet_type`, `daily_life`, `energy_level`, `body_type`, `physical_limitation`, `age`, `goal`, `activities`, `bmi`, `bmr`, `bfp`, `gender`, `from_date`, `to_date`, `active_status`, `neck`, `waist`, `hip`, `shoulders`, `password`, `hydration`, `training_type`, `profile_id`, `chat_id`, `message_id`, `remember_token`, `created_at`, `updated_at`, `request_type`) VALUES
(1, 'user', '0912345678', NULL, 'user@gmail.com', '', '', NULL, 0, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, '$2y$10$.knuLj/WUn0tF3BiJm3CGuRXojTSG7ZHmvXbcY1duVCzW9xsaRboK', NULL, NULL, 0, 0, 0, NULL, '2022-10-27 08:04:02', '2022-10-27 08:04:02', 0),
(2, 'trainer', '09123456789', NULL, 'trainer@gmail.com', '', '', NULL, 0, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, '$2y$10$ZNWfdduU.enX/xl0lliwceUQCzY.7tCXD64OsQ/4tlklgQSVdstSC', NULL, NULL, 0, 0, 0, NULL, '2022-10-27 08:04:02', '2022-10-27 08:04:02', 0),
(3, 'Diamond User', '09100100100', 'Ipsum sint eligend', 'fiveno@mailinator.com', 'Diamond', 'beginner', NULL, 0, 61, 110.00, 160.00, '[\"late night snacks\"]', '[\"butt\",\"legs\"]', 'sleep hero', 'not much', 'lactose free', 'walking daily', 'a nap after meals', 'Mesomorph', '[\"limited mobility\"]', '22', 'keep fit', 'walking', 20.80, 1196.64, 27.28, 'female', '2022-10-05', '2022-12-05', 2, 12.00, 28.00, 36.00, 20.00, '$2y$10$Z0l6J0.GSCGEQT1V9.ntjuyHzq8WzwTPYbViAnXJUzZNp0G7EjpZS', 'more than 6 glasses', NULL, 0, 0, 0, NULL, '2022-10-27 08:06:50', '2022-11-08 03:54:19', 0),
(4, 'Yen Yates', '09200200200', 'Ut mollitia in volup', 'xoxusih@mailinator.com', 'Free', '', NULL, 0, 81, 105.00, 110.00, '[\"late night snacks\"]', '[\"legs\"]', 'sleep hero', '5 - 7 times a week', 'vegan', 'working physically', 'a nap after meals', 'Mesomorph', '[\"limited mobility\"]', '30', 'keep fit', 'walking', 11.30, 1617.56, -10.90, 'male', '2022-10-05', '2022-11-05', 0, 10.00, 20.00, 0.00, 12.00, '$2y$10$VBIARD4LwPAd9vlu/iCzW.o30MX3No93FYnz7XaaNjTFEJicjCSme', 'more than 6 glasses', NULL, 0, 0, 0, NULL, '2022-10-27 08:18:16', '2022-11-05 10:11:07', 0),
(5, 'Gold user', '0911111111', 'Nesciunt culpa bla', 'mabaji@mailinator.com', 'Free', '', NULL, 1, 76, 89.00, 110.00, '[\"late night snacks\"]', '[\"legs\"]', 'minimal', '5 - 7 times a week', 'pescatarian', 'walking daily', 'a nap after meals', 'Mesomorph', '[\"knee pain\"]', '50', 'keep fit', 'walking', 10.83, 1199.58, -23.44, 'female', '2022-11-01', '2022-11-02', 0, 10.00, 19.00, 20.00, 15.00, '$2y$10$bacW2Y3soM.V8KuNi4UxtOep6S/Fx96hAghLfPFR0R.jVaXnlVhIK', 'more than 6 glasses', NULL, 0, 0, 0, NULL, '2022-10-28 04:14:11', '2022-10-29 10:20:08', 0),
(6, 'Gold user11', '0911211111', 'Nesciunt culpa bla', 'mabaj8@mailinator.com', 'Gold', 'beginner', NULL, 0, 76, 89.00, 110.00, '[\"late night snacks\"]', '[\"legs\"]', 'minimal', '5 - 7 times a week', 'pescatarian', 'walking daily', 'a nap after meals', 'Mesomorph', '[\"knee pain\"]', '50', 'keep fit', 'walking', 10.83, 1199.58, -23.44, 'female', '2022-10-28', '2022-11-28', 2, 10.00, 19.00, 20.00, 15.00, '$2y$10$bacW2Y3soM.V8KuNi4UxtOep6S/Fx96hAghLfPFR0R.jVaXnlVhIK', 'more than 6 glasses', NULL, 0, 0, 0, NULL, '2022-10-28 04:14:11', '2022-11-03 02:35:04', 0),
(7, 'Gym Member', '09400400400', 'Temporibus id omnis', '4567@gmail.com', 'Gym Member', 'advanced', NULL, 0, 72, 110.00, 100.00, '[\"late night snacks\"]', '[\"legs\"]', 'sleep hero', '5 - 7 times a week', 'lactose free', 'at the office', 'a nap after meals', 'Mesomorph', '[\"none\"]', '22', 'keep fit', 'walking', 14.92, 1371.32, 16.03, 'female', '2022-10-28', '2022-11-28', 2, 12.00, 25.00, 36.00, 20.00, '$2y$10$djItHPGPdUT0Iafb3d/Al.cIyRMtM915TzVilcNY2FcNuCuTMrPL.', 'more than 6 glasses', NULL, 0, 0, 0, NULL, '2022-10-28 07:07:56', '2022-10-28 07:08:43', 0),
(8, 'Ruby User', '0944444444', 'Labore sunt sunt con', 'gujin@mailinator.com', 'Ruby', 'beginner', NULL, 1, 66, 110.00, 100.00, '[\"late night snacks\"]', '[\"legs\"]', 'sleep hero', '5 - 7 times a week', 'pescatarian', 'working physically', 'a nap after meals', 'Mesomorph', '[\"back pain\"]', '22', 'keep fit', 'walking', 17.75, 1442.00, 39.92, 'male', '2022-10-28', '2022-11-28', 2, 9.00, 42.00, 0.00, 19.00, '$2y$10$HDzitAhYc0gWsda098vppugDeYwLNgwi60rKVqJ9jS0xIRDOwCJiO', 'only coffee', NULL, 0, 0, 0, NULL, '2022-10-28 09:23:21', '2022-11-03 02:34:30', 0),
(16, 'Platinum User', '09300300300', 'Accusamus aliquam re', 'nodoly@mailinator.com', 'Platinum', 'beginner', NULL, 0, 72, 160.00, 110.00, '[\"late night snacks\"]', '[\"butt\",\"legs\"]', 'sleep hero', '3 - 5 times a week', 'lactose free', 'walking daily', 'a nap after meals', 'Mesomorph', '[\"none\"]', '30', 'keep fit', 'walking', 21.70, 1724.12, 12.50, 'male', '2022-11-08', '2022-12-08', 2, 12.00, 29.00, 0.00, 18.00, '$2y$10$h9bt5MfmFxfIVfzsMFxL4.2RLamS.XktxD4tGVix2IjfxHstKG7Wq', 'more than 6 glasses', NULL, 0, 0, 0, NULL, '2022-11-08 04:22:17', '2022-11-08 04:22:39', 2);

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
(1, 4, 3000, '2022-10-29', '2022-10-29 05:14:17', '2022-10-29 05:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `weight_histories`
--

CREATE TABLE `weight_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `weight` double(8,2) NOT NULL DEFAULT 0.00,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weight_histories`
--

INSERT INTO `weight_histories` (`id`, `user_id`, `weight`, `date`, `created_at`, `updated_at`) VALUES
(1, 16, 160.00, '2022-10-09', '2022-11-08 04:22:17', '2022-11-08 04:22:17'),
(2, 3, 160.00, '2022-10-08', '2022-11-08 04:22:17', '2022-11-08 04:22:17');

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
  `calories` int(255) NOT NULL,
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
(1, 'weight loss', 'Diamond', 'Testing', 2, 'female', 50, 'beginner', '0', 'gym', 'saturday', '635a3bb5dafcc_photo-1453728013993-6d66e9c9123a.jpg', '635a3bb5d96e1_sample2s.mp4', '2022-10-27 08:05:09', '2022-10-27 08:05:09'),
(2, 'weight gain', 'Diamond', 'Testing2', 90, 'female', 100, 'beginner', '0', 'home', 'saturday', '635a3d967ff33_tree-736885__480.jpg', '635a3d967ea64_sample6s.mp4', '2022-10-27 08:13:10', '2022-10-27 08:13:10'),
(3, 'weight gain', 'Diamond', 'Testing3', 30, 'female', 60, 'beginner', '0', 'gym', 'saturday', '635a52f9f11cc_kk.jpg', '635a52f9ef2bf_sample2s.mp4', '2022-10-27 09:44:25', '2022-10-27 09:44:25'),
(4, 'weight loss', 'Diamond', 'diamond beginner', 6, 'female', 100, 'beginner', '0', 'home', 'Friday', '636481378dc44_IMG_6451.JPG', '6364813767430_sample6s.mp4', '2022-11-04 03:04:23', '2022-11-04 03:04:23');

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
-- Indexes for table `weight_histories`
--
ALTER TABLE `weight_histories`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `member_users`
--
ALTER TABLE `member_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_reports`
--
ALTER TABLE `personal_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_work_out_infos`
--
ALTER TABLE `personal_work_out_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `training_users`
--
ALTER TABLE `training_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `water_trackeds`
--
ALTER TABLE `water_trackeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `weight_histories`
--
ALTER TABLE `weight_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
