-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 1 月 20 日 02:49
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_kadai04`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `image_table`
--

CREATE TABLE `image_table` (
  `id` int(12) NOT NULL,
  `uid` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `img_file_name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `image_table`
--

INSERT INTO `image_table` (`id`, `uid`, `created_at`, `update_at`, `img_file_name`) VALUES
(6, 1, '2023-01-09 20:28:25', '2023-01-16 14:14:14', '20230116061414_image.jpeg'),
(7, 2, '2023-01-09 20:29:22', NULL, '20230109122922_image.jpeg'),
(8, 2, '2023-01-10 18:52:48', NULL, '20230110105248_image.jpeg');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE `user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'テスト１管理者', 'test1', '$2y$10$xMMQFApvVWaqiXkPHsYtdeam49KwNtsXgowOT/qUCYIKe1IJFdRd.', 1, 0),
(2, 'テスト2一般', 'test2', '$2y$10$Xoi16qk3Nk0GoE4lnT/wvOWpsIDo4ORYi8bNXRbLI0GGYeQo4Fu76', 0, 0),
(3, 'テスト３', 'test3', '$2y$10$76Xf9wKdjEC91ir7tyMHderGywgksFG75P5wCgt.86RVO3Epgr4MS', 0, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `image_table`
--
ALTER TABLE `image_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `image_table`
--
ALTER TABLE `image_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
