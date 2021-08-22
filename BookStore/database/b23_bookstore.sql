-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-08-22 09:01:23
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
(1, 'Admin', 1, '2021-07-25 13:47:37', 'admin', '2021-08-12 18:04:51', '10', 'active', 4, '', ''),
(2, 'Manager', 1, '2021-07-25 13:47:37', 'admin', '2021-07-28 13:47:37', 'admin', 'active', 5, '', ''),
(3, 'Founder', 1, '2021-07-25 13:47:37', 'admin', '2021-07-28 13:47:37', 'admin', 'active', 4, '', ''),
(4, 'Register', 1, '2021-07-25 13:47:37', 'admin', '2021-07-28 13:47:37', 'admin', 'active', 10, '', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `email`, `group_id`, `created`, `created_by`, `modified`, `modified_by`, `register_date`, `status`, `ordering`) VALUES
(2, 'nguyenvanb', 'e9e6a1ba0636c72c6f3e6b6068b2eafd', 'Nguyễn Văn BC edit', 'nguyenvanb@gmail.com', 2, '2021-08-17 17:32:35', NULL, '2021-08-17 17:33:10', '10', NULL, 'active', 10),
(3, 'nguyenvanc', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn C', 'nguyenvanc@gmail.com', 4, '2021-08-17 17:31:04', NULL, '2021-08-17 17:33:14', '10', NULL, 'active', 10),
(4, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'admin@gmail.com', 1, '2021-08-17 17:31:07', NULL, '2021-08-17 17:33:18', '10', NULL, 'active', 10);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
