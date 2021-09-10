-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-09-10 09:43:34
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
-- テーブルの構造 `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `special` tinyint(1) DEFAULT 0,
  `sale_off` int(3) DEFAULT 0,
  `picture` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `book`
--

INSERT INTO `book` (`id`, `name`, `description`, `price`, `special`, `sale_off`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `category_id`) VALUES
(1, 'Bảy viên ngọc rồng tập 1', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '250000', 1, 10, 'p2o6h3t7m.jpg', NULL, NULL, '2021-09-07 01:07:05', 'admin', 'active', 2, 1),
(12, 'Bảy viên ngọc rồng tập 2', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '250000', 1, 10, '4bjp7yktu.jpg', '2021-09-06 19:37:32', 'admin', NULL, NULL, 'active', 2, 1),
(13, 'Bảy viên ngọc rồng tập 3', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '250000', 1, 10, 'baujkl2i1.jpg', '2021-09-06 19:38:01', 'admin', NULL, NULL, 'active', 3, 1),
(14, 'Bảy viên ngọc rồng tập 4', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '250000', 1, 10, 'fdpqn5ye2.jpg', '2021-09-06 19:38:26', 'admin', NULL, NULL, 'active', 4, 1),
(15, 'Bảy viên ngọc rồng tập 5', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '200000', 0, 20, 'eqr5afvtm.jpg', '2021-09-06 19:38:55', 'admin', '2021-09-07 00:08:27', 'admin', 'active', 5, 1),
(16, 'Bảy viên ngọc rồng tập 6', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '250000', 0, 10, '6ed5psk9g.jpg', '2021-09-06 19:39:31', 'admin', '2021-09-07 00:08:28', 'admin', 'active', 6, 1),
(17, 'Bảy viên ngọc rồng tập 7', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '250000', 0, 10, '8rvw6b5ix.jpg', '2021-09-06 19:39:54', 'admin', '2021-09-07 00:08:30', 'admin', 'active', 7, 1),
(18, 'Bảy viên ngọc rồng tập 8', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '250000', 0, 10, '8h23okj9s.jpg', '2021-09-06 19:40:19', 'admin', '2021-09-07 00:08:31', 'admin', 'active', 8, 1),
(19, 'Bảy viên ngọc rồng tập 9', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '200000', 1, 10, 'mwiqv9g37.jpg', '2021-09-06 19:40:48', 'admin', NULL, NULL, 'active', 9, 1),
(20, 'Bảy viên ngọc rồng tập 10', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '260000', 1, 14, 'cit58nmq3.jpg', '2021-09-06 19:41:20', 'admin', NULL, NULL, 'active', 10, 1),
(21, 'Bảy viên ngọc rồng tập 11', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '220000', 1, 16, 'mlk1cg3zo.jpg', '2021-09-06 19:41:39', 'admin', NULL, NULL, 'active', 11, 1),
(22, 'Bảy viên ngọc rồng tập 12', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '300000', 1, 20, 'wl51ayds0.jpg', '2021-09-06 19:42:04', 'admin', '2021-09-10 00:31:29', 'admin', 'active', 5, 1),
(23, 'Đời sống xã hội', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.', '100000', 1, 20, 'zcmnfh3l1.jpg', '2021-09-07 12:14:24', 'admin', '2021-09-10 00:31:21', 'admin', 'active', 2, 11),
(24, 'Giáo dục công dân', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, unde eum nisi vero animi architecto quod aut natus distinctio maxime. Laborum debitis quos ea sequi accusantium nisi eum voluptatibus reiciendis.\r\n', '20000', 1, 20, 'fm4qz5ijc.jpg', '2021-09-09 15:33:32', 'admin', '2021-09-10 00:31:14', 'admin', 'active', 2, 15);

-- --------------------------------------------------------

--
-- テーブルの構造 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `picture` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(40) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` varchar(40) NOT NULL,
  `is_home` tinyint(1) DEFAULT 0,
  `status` varchar(40) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `is_home`, `status`, `ordering`) VALUES
(1, 'Bảy viên ngọc rồng', 'fnu5s9cdq.jpg', '2021-09-02 23:56:35', 'admin', '2021-09-10 04:38:14', 'admin', 1, 'active', 2),
(9, 'Thiếu nhi', 'ifxs3jrlu.jpg', '2021-09-02 23:53:48', 'admin', '2021-09-10 16:37:15', 'admin', 0, 'active', 12),
(10, 'Văn hóa nghệ thuật', 'unhx2wrca.jpg', '2021-09-02 23:54:06', 'admin', '2021-09-10 16:42:56', 'admin', 0, 'active', 7),
(11, 'Đời sống xã hội', 'oz83i7v24.jpg', '2021-09-02 23:54:33', 'admin', '2021-09-10 04:02:57', 'admin', 1, 'active', 5),
(15, 'Giáo dục học đường', '4d6ak0g1q.jpg', '2021-09-09 15:32:54', 'admin', '0000-00-00 00:00:00', '', 1, 'active', 1);

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
(1, 'Admin', 1, '2021-07-25 13:47:37', 'admin', '2021-08-24 19:40:47', 'admin', 'active', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,15,16,17', ''),
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
  `register_ip` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `email`, `group_id`, `created`, `created_by`, `modified`, `modified_by`, `register_date`, `register_ip`, `status`, `ordering`) VALUES
(2, 'nguyenvanb', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn BC', 'nguyenvanb@gmail.com', 3, NULL, NULL, '2021-09-07 23:50:36', 'admin', '0000-00-00 00:00:00', NULL, 'active', 10),
(3, 'nguyenvanc', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn C', 'nguyenvanc@gmail.com', 3, NULL, NULL, '2021-09-05 16:27:06', 'admin', '0000-00-00 00:00:00', NULL, 'inactive', 10),
(4, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'admin@gmail.com', 1, NULL, NULL, '2021-09-03 20:19:39', 'admin', '0000-00-00 00:00:00', NULL, 'active', 10),
(26, 'dinhconglam', '933ce801b6ad1086ea92b57a97bcaa50', 'Đinh Công Lâm', 'dinhconglam@gmail.com', 3, '2021-09-02 16:09:12', NULL, '2021-09-03 20:19:42', 'admin', '2021-09-02 16:09:12', NULL, 'active', 10),
(27, 'admin1', '933ce801b6ad1086ea92b57a97bcaa50', 'Đinh Công Lâm', 'dinhconglam1@gmail.com', 0, '2021-09-02 16:09:14', NULL, NULL, NULL, '2021-09-02 16:09:14', '::1', 'inactive', 10);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

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
-- テーブルの AUTO_INCREMENT `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルの AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
