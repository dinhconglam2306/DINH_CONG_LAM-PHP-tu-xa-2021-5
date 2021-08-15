-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-08-15 05:09:28
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `bookstore`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_acp` tinyint(1) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT 10,
  `privilege_id` text NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `privilege_id`, `picture`) VALUES
(1, 'Admin', 0, '2021-07-25 13:47:37', 'admin', '2021-08-12 18:04:51', '10', 'active', 4, '', ''),
(2, 'Manager', 0, '2021-07-25 13:47:37', 'admin', '2021-07-28 13:47:37', 'admin', 'active', 5, '', ''),
(3, 'Founder', 1, '2021-07-25 13:47:37', 'admin', '2021-07-28 13:47:37', 'admin', 'active', 4, '', ''),
(4, 'Register', 1, '2021-07-25 13:47:37', 'admin', '2021-07-28 13:47:37', 'admin', 'active', 10, '', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `fullname`, `email`, `group_id`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(2, 'nguyenvanb', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn BC', 'nguyenvanb@gmail.com', 3, NULL, NULL, '2021-08-12 18:08:51', '10', 'active', 10),
(3, 'nguyenvanc', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn C', 'nguyenvanc@gmail.com', 4, NULL, NULL, '2021-08-15 12:02:49', '10', 'inactive', 10),
(4, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'admin@gmail.com', 3, NULL, NULL, '2021-08-15 12:02:27', '10', 'inactive', 10);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
