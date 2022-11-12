-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2022 at 06:17 AM
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
  `pros` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cons` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_type`, `duration`, `price`, `pros`, `cons`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Platinum', '1', 5000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 4, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(2, 'Gold', '1', 20000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 5, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(3, 'Diamond', '1', 40000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 6, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(4, 'Ruby', '1', 100000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 7, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(5, 'Ruby Premium', '1', 200000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 8, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(6, 'Gym Member', '1', 40000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 10, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(7, 'Platinum', '3', 12000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 4, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(8, 'Gold', '3', 50000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 5, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(9, 'Diamond', '3', 100000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 6, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(10, 'Ruby', '3', 250000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 7, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(11, 'Ruby Premium', '3', 500000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 8, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(12, 'Gym Member', '3', 100000, 'adipisicing elit, Dolore fugit hic,ullam cumque', 'sequi est, quod', 10, '2022-11-12 04:43:14', '2022-11-12 04:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `member_histories`
--

CREATE TABLE `member_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `from_member_id` int(11) DEFAULT NULL,
  `to_member_id` int(11) DEFAULT NULL,
  `member_type_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_histories`
--

INSERT INTO `member_histories` (`id`, `user_id`, `member_id`, `from_member_id`, `to_member_id`, `member_type_level`, `date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 3, NULL, 3, 'beginner', '0000-00-00', NULL, '2022-11-12 04:49:27', '2022-11-12 04:49:27'),
(2, 4, 2, NULL, 2, 'beginner', '0000-00-00', NULL, '2022-11-12 05:01:05', '2022-11-12 05:01:05');

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
(1, 1, 'Hello Gold Members', NULL, '2022-11-12 05:16:09', '2022-11-12 05:16:09');

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
(35, '2014_10_12_000000_create_users_table', 1),
(36, '2014_10_12_100000_create_password_resets_table', 1),
(37, '2019_08_19_000000_create_failed_jobs_table', 1),
(38, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(39, '2022_10_03_083913_create_members_table', 1),
(40, '2022_10_03_085136_create_meals_table', 1),
(41, '2022_10_03_085159_create_meal_plans_table', 1),
(42, '2022_10_03_085228_create_workouts_table', 1),
(43, '2022_10_03_085238_create_workout_plans_table', 1),
(44, '2022_10_04_043623_create_permission_tables', 1),
(45, '2022_10_05_030727_create_trainers_table', 1),
(46, '2022_10_05_050953_create_shop_posts_table', 1),
(47, '2022_10_05_051014_create_shop_comments_table', 1),
(48, '2022_10_05_051036_create_shop_members_table', 1),
(49, '2022_10_05_052602_create_shop_reacts_table', 1),
(50, '2022_10_05_063858_create_chats_table', 1),
(51, '2022_10_05_065206_create_friends_table', 1),
(52, '2022_10_05_065216_create_profiles_table', 1),
(53, '2022_10_05_065224_create_comments_table', 1),
(54, '2022_10_05_065253_create_reacts_table', 1),
(55, '2022_10_05_065302_create_posts_table', 1),
(56, '2022_10_05_065327_create_ban_words_table', 1),
(57, '2022_10_06_083718_create_training_centers_table', 1),
(58, '2022_10_07_025346_create_payments_table', 1),
(59, '2022_10_07_031443_create_personal_reports_table', 1),
(60, '2022_10_07_032525_create_member_histories_table', 1),
(61, '2022_10_07_080616_create_banking_infos_table', 1),
(62, '2022_10_18_051530_create_training_users_table', 1),
(63, '2022_10_18_051544_create_training_groups_table', 1),
(64, '2022_10_18_070020_create_messages_table', 1),
(65, '2022_10_26_030535_create_personal_meal_infos_table', 1),
(66, '2022_10_27_104328_create_personal_work_out_infos_table', 1),
(67, '2022_10_28_143320_create_water_trackeds_table', 1),
(68, '2022_11_03_155133_create_weight_histories_table', 1);

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
(5, 'App\\Models\\User', 4),
(6, 'App\\Models\\User', 3),
(9, 'App\\Models\\User', 2);

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
(1, 3, 'ewallet', NULL, NULL, 'tdt', 'KBZ Pay', '0978531627', 40000, '636f25c779eaa_ttt.webp', '2022-11-12 04:49:11', '2022-11-12 04:49:11'),
(2, 4, 'ewallet', NULL, NULL, 'Haviva Roy', 'CB Pay', '0912345678', 20000, '636f28855d99b_kk.jpg', '2022-11-12 05:00:53', '2022-11-12 05:00:53');

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
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'King', 'web', '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(2, 'Queen', 'web', '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(3, 'System_Admin', 'web', '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(4, 'Platinum', 'web', '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(5, 'Gold', 'web', '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(6, 'Diamond', 'web', '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(7, 'Ruby', 'web', '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(8, 'Ruby Premium', 'web', '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(9, 'Trainer', 'web', '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(10, 'Gym Member', 'web', '2022-11-12 04:43:14', '2022-11-12 04:43:14');

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
(1, 2, 'Gold', 'Beauty Gold', 'body beauty', 'beginner', 'male', '2022-11-12 05:15:52', '2022-11-12 05:15:52');

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
(1, 4, 1, '2022-11-12 05:16:15', '2022-11-12 05:16:15');

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
  `request_type` int(11) NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `email`, `member_type`, `request_type`, `membertype_level`, `member_code`, `ingroup`, `height`, `weight`, `ideal_weight`, `bad_habits`, `most_attention_areas`, `average_night`, `physical_activity`, `diet_type`, `daily_life`, `energy_level`, `body_type`, `physical_limitation`, `age`, `goal`, `activities`, `bmi`, `bmr`, `bfp`, `gender`, `from_date`, `to_date`, `active_status`, `neck`, `waist`, `hip`, `shoulders`, `password`, `hydration`, `training_type`, `profile_id`, `chat_id`, `message_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', '0912345678', NULL, 'user@gmail.com', '', 0, '', NULL, 0, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, '$2y$10$gHlMIOAlFi4R.i4kI8n7kuL9ajwH9Bord5uF98qgNF36o8IJxqK4a', NULL, NULL, 0, 0, 0, NULL, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(2, 'trainer', '09123456789', NULL, 'trainer@gmail.com', '', 0, '', NULL, 0, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, '$2y$10$qmeFSWXiA51qbUzTfsdFjOcfXMFGSXIRuXdphjD3xGlr1O8GwyhCO', NULL, NULL, 0, 0, 0, NULL, '2022-11-12 04:43:14', '2022-11-12 04:43:14'),
(3, 'Diamond User', '09100100100', 'Temporibus non exped', 'diamond@gmail.com', 'Diamond', 3, 'beginner', 'yc-e852a825', 0, 66, 100.00, 110.00, '[\"late night snacks\"]', '[\"belly\",\"butt\"]', 'good', 'not much', 'lactose free', 'mostly at home', 'a nap after meals', 'Ectomorph', '[\"limited mobility\"]', '22', 'keep fit', 'walking', 16.10, 1230.68, 19.72, 'female', '2022-11-12', '2022-12-12', 2, 12.00, 25.00, 36.00, 18.00, '$2y$10$sXeCJb.QUvpfw8GWgmaL8u9hSAiUzkst/6PlRaPsPXeEG2RTyoLwi', 'more than 6 glasses', NULL, 0, 0, 0, NULL, '2022-11-12 04:45:02', '2022-11-12 04:50:29'),
(4, 'Gold User', '09200200200', 'Mandalay', 'gold@gmail.com', 'Gold', 2, 'beginner', 'yc-dda5d8ea', 1, 70, 160.00, 130.00, '[\"late night snacks\"]', '[\"legs\"]', 'good', '5 - 7 times a week', 'lactose free', 'mostly at home', 'a nap after meals', 'Mesomorph', '[\"other\"]', '30', 'keep fit', 'walking', 22.96, 1692.36, 11.09, 'male', '2022-11-12', '2022-12-12', 2, 12.00, 28.00, 0.00, 19.00, '$2y$10$3yV6XjdR9hiOysnKbLskIOk8K6BzpRdZZb9mgiN0S1gJvj7XqhVue', 'more than 6 glasses', NULL, 0, 0, 0, NULL, '2022-11-12 04:51:11', '2022-11-12 05:16:15');

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
(1, 3, 106.00, '2022-11-12', '2022-11-12 04:48:50', '2022-11-12 04:48:50'),
(2, 3, 103.00, '2022-11-12', '2022-11-12 04:50:20', '2022-11-12 04:50:20'),
(3, 3, 100.00, '2022-11-12', '2022-11-12 04:50:29', '2022-11-12 04:50:29'),
(4, 4, 160.00, '2022-11-12', '2022-11-12 05:00:43', '2022-11-12 05:00:43');

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
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meal_plans`
--
ALTER TABLE `meal_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `member_histories`
--
ALTER TABLE `member_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_reports`
--
ALTER TABLE `personal_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_work_out_infos`
--
ALTER TABLE `personal_work_out_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_users`
--
ALTER TABLE `training_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `water_trackeds`
--
ALTER TABLE `water_trackeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weight_histories`
--
ALTER TABLE `weight_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
