-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-08-24 13:36:18
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
(1, 'Admin', 1, '2021-07-25 13:47:37', 'admin', '2021-08-24 19:40:47', 'admin', 'inactive', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,15,16,17', ''),
(2, 'Manager', 1, '2021-07-25 13:47:37', 'admin', '2021-08-24 11:16:57', 'admin', 'active', 2, '1,2,3,4,6,7,8,9,10,15,16,17,13', ''),
(3, 'Member', 0, '2021-07-25 13:47:37', 'admin', '2021-07-28 13:47:37', 'admin', 'active', 3, '', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `privilege`
--

CREATE TABLE `privilege` (
  `id` int(10) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `module` varchar(45) DEFAULT NULL,
  `controller` varchar(45) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `module`, `controller`, `action`) VALUES
(1, 'Hiển thị danh sách người dùng', 'backend', 'user', 'index'),
(2, 'Thay đổi status người dùng', 'backend', 'user', 'status'),
(3, 'Cập nhật thông tin người dùng', 'backend', 'user', 'form'),
(4, 'Thay đổi status của người dùng sử dụng Ajax', 'backend', 'user', 'changeStatus'),
(5, 'Xóa một  người dùng', 'backend', 'user', 'delete'),
(6, 'Thay đổi vị trị hiển thị của người dùng', 'backend', 'user', 'ordering'),
(7, 'Truy cập menu Admin Control Panel', 'backend', 'index', 'index'),
(8, 'Đăng nhập Admin Control Panel', 'backend', 'index', 'login'),
(9, 'Đăng xuất Admin Control Panel', 'backend', 'index', 'logout'),
(10, 'Cập nhật thông tin tài khoản quản trị', 'backend', 'index', 'profile'),
(11, 'Truy cập vào quản lý Group', 'backend', 'group', 'index'),
(12, 'Cập nhật thông tin Group', 'backend', 'group', 'form'),
(13, 'Thay đổi group của người dùng sử dụng Ajax', 'backend', 'user', 'changeGroup'),
(15, 'Xóa nhiều người dùng', 'backend', 'user', 'multiDelete'),
(16, 'Thay đổi status sang Active của nhiều người dùng', 'backend', 'user', 'multiActive'),
(17, 'Thay đổi status sang Inactive của nhiều người dùng', 'backend', 'user', 'multiInactive');

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
(2, 'nguyenvanb', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn BC', 'nguyenvanb@gmail.com', 3, NULL, NULL, '2021-08-24 20:34:33', 'admin', '0000-00-00 00:00:00', 'active', 10),
(3, 'nguyenvanc', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn C', 'nguyenvanc@gmail.com', 2, NULL, NULL, '2021-08-24 20:24:51', '10', '0000-00-00 00:00:00', 'active', 10),
(4, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'admin@gmail.com', 1, NULL, NULL, '2021-08-24 20:24:31', '10', '0000-00-00 00:00:00', 'active', 10);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `privilege`
--
ALTER TABLE `privilege`
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
-- テーブルの AUTO_INCREMENT `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
