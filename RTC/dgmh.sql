-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 16, 2018 lúc 07:27 PM
-- Phiên bản máy phục vụ: 10.1.35-MariaDB
-- Phiên bản PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dgmh`
--
CREATE DATABASE IF NOT EXISTS `dgmh` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `dgmh`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `usr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `usr`, `pwd`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `teacher_id`) VALUES
(10, 'Phát triển ứng dụng Web INT3306 1', 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `mssv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`id`, `mssv`, `pwd`, `name`, `email`) VALUES
(1, ' 15020881', '7c222fb2927d828af22f592134e8932480637c0d', ' Triệu Hoàng An', '15020881@vnu.edu.vn'),
(2, ' 15021394', '7c222fb2927d828af22f592134e8932480637c0d', ' Bùi Châu Anh', ' 15021394@vnu.edu.vn'),
(3, ' 15021606', '7c222fb2927d828af22f592134e8932480637c0d', ' Lưu Việt Anh', ' 15021606@vnu.edu.vn'),
(4, ' 15021976', '7c222fb2927d828af22f592134e8932480637c0d', ' Nguyễn Đức Anh', ' 15021976@vnu.edu.vn'),
(5, ' 15021483', '7c222fb2927d828af22f592134e8932480637c0d', ' Nguyễn Quang Anh', ' 15021483@vnu.edu.vn'),
(6, ' 15022841', '7c222fb2927d828af22f592134e8932480637c0d', ' Nguyễn Thị Phương Anh', ' 15022841@vnu.edu.vn'),
(7, ' 15021332', '7c222fb2927d828af22f592134e8932480637c0d', ' Nguyễn Thị Vân Anh', ' 15021332@vnu.edu.vn'),
(8, ' 15021849', '7c222fb2927d828af22f592134e8932480637c0d', ' Nguyễn Tuấn Anh', ' 15021849@vnu.edu.vn'),
(9, ' 15021469', '7c222fb2927d828af22f592134e8932480637c0d', ' Nguyễn Chu Chiến', ' 15021469@vnu.edu.vn'),
(10, ' 15021359', '7c222fb2927d828af22f592134e8932480637c0d', ' Trần Minh Chiến', ' 15021359@vnu.edu.vn'),
(11, '16020839', '7c222fb2927d828af22f592134e8932480637c0d', 'Phạm Công Anh', '16020839@vnu.edu.vn'),
(12, '16021554', '7c222fb2927d828af22f592134e8932480637c0d', 'Phạm Tuấn Anh', '16021554@vnu.edu.vn'),
(13, '16020855', '7c222fb2927d828af22f592134e8932480637c0d', 'Hoàng Văn Chính', '16020855@vnu.edu.vn'),
(14, '16021369', '7c222fb2927d828af22f592134e8932480637c0d', 'Đinh Thị Thùy Dung', '16021369@vnu.edu.vn'),
(15, '16020897', '7c222fb2927d828af22f592134e8932480637c0d', 'Đậu Trọng Dũng', '16020897@vnu.edu.vn'),
(16, '16020898', '7c222fb2927d828af22f592134e8932480637c0d', 'Đỗ Đức Dũng', '16020898@vnu.edu.vn'),
(17, '16021276', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Khánh Duy', '16021276@vnu.edu.vn'),
(18, '16022363', '7c222fb2927d828af22f592134e8932480637c0d', 'Phạm Văn Duy', '16022363@vnu.edu.vn'),
(19, '16020913', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Bình Dương', '16020913@vnu.edu.vn'),
(20, '16020077', '7c222fb2927d828af22f592134e8932480637c0d', 'Hoàng Văn Đại', '16020077@vnu.edu.vn'),
(21, '16020869', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Thành Đại', '16020869@vnu.edu.vn'),
(22, '16020875', '7c222fb2927d828af22f592134e8932480637c0d', 'Lê Quang Đạo', '16020875@vnu.edu.vn'),
(23, '16021824', '7c222fb2927d828af22f592134e8932480637c0d', 'Đỗ Thành Đạt', '16021824@vnu.edu.vn'),
(24, '16020030', '7c222fb2927d828af22f592134e8932480637c0d', 'Kiều Quốc Đạt', '16020030@vnu.edu.vn'),
(25, '16022164', '7c222fb2927d828af22f592134e8932480637c0d', 'Lê Quang Đạt', '16022164@vnu.edu.vn'),
(26, '16022069', '7c222fb2927d828af22f592134e8932480637c0d', 'Phan Minh Đức', '16022069@vnu.edu.vn'),
(27, '16020074', '7c222fb2927d828af22f592134e8932480637c0d', 'Trương Hà Anh Đức', '16020074@vnu.edu.vn'),
(28, '16020934', '7c222fb2927d828af22f592134e8932480637c0d', 'Dương Thanh Hải', '16020934@vnu.edu.vn'),
(29, '16020936', '7c222fb2927d828af22f592134e8932480637c0d', 'Lê Viết Hải', '16020936@vnu.edu.vn'),
(30, '16022075', '7c222fb2927d828af22f592134e8932480637c0d', 'Đoàn Trung Hiếu', '16022075@vnu.edu.vn'),
(31, '16021577', '7c222fb2927d828af22f592134e8932480637c0d', 'Đỗ Minh Hiếu', '16021577@vnu.edu.vn'),
(32, '16020948', '7c222fb2927d828af22f592134e8932480637c0d', 'Hà Minh Hiếu', '16020948@vnu.edu.vn'),
(33, '16020950', '7c222fb2927d828af22f592134e8932480637c0d', 'Hoàng Minh Hiếu', '16020950@vnu.edu.vn'),
(34, '16020952', '7c222fb2927d828af22f592134e8932480637c0d', 'Lê Trung Hiếu', '16020952@vnu.edu.vn'),
(35, '16020973', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Đức Hoàng', '16020973@vnu.edu.vn'),
(36, '16020974', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Minh Hoàng', '16020974@vnu.edu.vn'),
(37, '13020176', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Xuân Hoàng', '13020176@vnu.edu.vn'),
(38, '16020978', '7c222fb2927d828af22f592134e8932480637c0d', 'Vũ Huy Hoàng', '16020978@vnu.edu.vn'),
(39, '16020980', '7c222fb2927d828af22f592134e8932480637c0d', 'Trần Đức Học', '16020980@vnu.edu.vn'),
(40, '16021292', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Thị Hợp', '16021292@vnu.edu.vn'),
(41, '16021388', '7c222fb2927d828af22f592134e8932480637c0d', 'Cao Đức Huân', '16021388@vnu.edu.vn'),
(42, '16022374', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Mậu Đức Huy', '16022374@vnu.edu.vn'),
(43, '16021000', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Quang Huy', '16021000@vnu.edu.vn'),
(44, '16020999', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Quang Huy', '16020999@vnu.edu.vn'),
(45, '15021490', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Văn Huy', '15021490@vnu.edu.vn'),
(46, '16022440', '7c222fb2927d828af22f592134e8932480637c0d', 'Trịnh Ngọc Huy', '16022440@vnu.edu.vn'),
(47, '15021135', '7c222fb2927d828af22f592134e8932480637c0d', 'Lê Duy Hưng', '15021135@vnu.edu.vn'),
(48, '16021591', '7c222fb2927d828af22f592134e8932480637c0d', 'Lê Duy Hưng', '16021591@vnu.edu.vn'),
(49, '15021437', '7c222fb2927d828af22f592134e8932480637c0d', 'Vũ Văn Hưng', '15021437@vnu.edu.vn'),
(50, '16021006', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Văn Khải', '16021006@vnu.edu.vn'),
(51, '16021008', '7c222fb2927d828af22f592134e8932480637c0d', 'Lê Duy Khánh', '16021008@vnu.edu.vn'),
(52, '16022193', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Ngọc Lâm', '16022193@vnu.edu.vn'),
(53, '16022492', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Văn Lâm', '16022492@vnu.edu.vn'),
(54, '16021020', '7c222fb2927d828af22f592134e8932480637c0d', 'Bùi Quang Linh', '16021020@vnu.edu.vn'),
(55, '15022848', '7c222fb2927d828af22f592134e8932480637c0d', 'Bùi Thị Diệu Linh', '15022848@vnu.edu.vn'),
(56, '16021024', '7c222fb2927d828af22f592134e8932480637c0d', 'Lê Quang Linh', '16021024@vnu.edu.vn'),
(57, '16021042', '7c222fb2927d828af22f592134e8932480637c0d', 'Cao Đức Mạnh', '16021042@vnu.edu.vn'),
(58, '16021043', '7c222fb2927d828af22f592134e8932480637c0d', 'Đào Tiến Mạnh', '16021043@vnu.edu.vn'),
(59, '16021057', '7c222fb2927d828af22f592134e8932480637c0d', 'Lê Hà My', '16021057@vnu.edu.vn'),
(60, '16022443', '7c222fb2927d828af22f592134e8932480637c0d', 'Kiều Thanh Nam', '16022443@vnu.edu.vn'),
(61, '16020057', '7c222fb2927d828af22f592134e8932480637c0d', 'Phạm Thị Oanh', '16020057@vnu.edu.vn'),
(62, '16021087', '7c222fb2927d828af22f592134e8932480637c0d', 'Phạm Văn Oánh', '16021087@vnu.edu.vn'),
(63, '16021090', '7c222fb2927d828af22f592134e8932480637c0d', 'Hoàng Văn Phú', '16021090@vnu.edu.vn'),
(64, '14020602', '7c222fb2927d828af22f592134e8932480637c0d', 'Phan Văn Phước', '14020602@vnu.edu.vn'),
(65, '16021409', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Anh Phương', '16021409@vnu.edu.vn'),
(66, '15021973', '7c222fb2927d828af22f592134e8932480637c0d', 'Phạm Ngọc Quang', '15021973@vnu.edu.vn'),
(67, '16021102', '7c222fb2927d828af22f592134e8932480637c0d', 'Ngô Hồng Quân', '16021102@vnu.edu.vn'),
(68, '16021103', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Hồng Quân', '16021103@vnu.edu.vn'),
(69, '16021121', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Thái San', '16021121@vnu.edu.vn'),
(70, '16021125', '7c222fb2927d828af22f592134e8932480637c0d', 'Đinh Quang Sơn', '16021125@vnu.edu.vn'),
(71, '16021138', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Thị Thanh Tân', '16021138@vnu.edu.vn'),
(72, '16021139', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Hoàng Thạch', '16021139@vnu.edu.vn'),
(73, '17020039', '7c222fb2927d828af22f592134e8932480637c0d', 'Vương Hải Thanh', '17020039@vnu.edu.vn'),
(74, '16022450', '7c222fb2927d828af22f592134e8932480637c0d', 'Tưởng Công Thành', '16022450@vnu.edu.vn'),
(75, '16021145', '7c222fb2927d828af22f592134e8932480637c0d', 'Đỗ Việt Thắng', '16021145@vnu.edu.vn'),
(76, '16021163', '7c222fb2927d828af22f592134e8932480637c0d', 'Đỗ Mạnh Thế', '16021163@vnu.edu.vn'),
(77, '16020078', '7c222fb2927d828af22f592134e8932480637c0d', 'Hoàng Vĩnh Thịnh', '16020078@vnu.edu.vn'),
(78, '16021424', '7c222fb2927d828af22f592134e8932480637c0d', 'Bùi Thị Hoài Thu', '16021424@vnu.edu.vn'),
(79, '16021175', '7c222fb2927d828af22f592134e8932480637c0d', 'Lê Thị Thúy', '16021175@vnu.edu.vn'),
(80, '16021182', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Đức Tiến', '16021182@vnu.edu.vn'),
(81, '15022850', '7c222fb2927d828af22f592134e8932480637c0d', 'Đỗ Xuân Toàn', '15022850@vnu.edu.vn'),
(82, '15021318', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Thị Thu Trang', '15021318@vnu.edu.vn'),
(83, '16021199', '7c222fb2927d828af22f592134e8932480637c0d', 'Hà Công Trung', '16021199@vnu.edu.vn'),
(84, '16021201', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Duy Trường', '16021201@vnu.edu.vn'),
(85, '16021204', '7c222fb2927d828af22f592134e8932480637c0d', 'Hà Văn Tú', '16021204@vnu.edu.vn'),
(86, '16021205', '7c222fb2927d828af22f592134e8932480637c0d', 'Nghiêm Anh Tú', '16021205@vnu.edu.vn'),
(87, '16021209', '7c222fb2927d828af22f592134e8932480637c0d', 'Đỗ Quốc Tuấn', '16021209@vnu.edu.vn'),
(88, '15021366', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Văn Tùng', '15021366@vnu.edu.vn'),
(89, '16021229', '7c222fb2927d828af22f592134e8932480637c0d', 'Đặng Thị Tuyết', '16021229@vnu.edu.vn'),
(90, '16021235', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Tiến Việt', '16021235@vnu.edu.vn'),
(91, '14020774', '7c222fb2927d828af22f592134e8932480637c0d', 'Đỗ Quốc Vương', '14020774@vnu.edu.vn'),
(92, '14020797', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Đức Vượng', '14020797@vnu.edu.vn'),
(93, '15021834', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Tuấn Vượng', '15021834@vnu.edu.vn'),
(94, '16020028', '7c222fb2927d828af22f592134e8932480637c0d', 'Nguyễn Tiến Xuân', '16020028@vnu.edu.vn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_class`
--

CREATE TABLE `student_class` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_class`
--

INSERT INTO `student_class` (`id`, `student_id`, `class_id`, `active`) VALUES
(1, 11, 10, 1),
(2, 12, 10, 1),
(3, 13, 10, 1),
(4, 14, 10, 1),
(5, 15, 10, 1),
(6, 16, 10, 1),
(7, 17, 10, 1),
(8, 18, 10, 1),
(9, 19, 10, 1),
(10, 20, 10, 1),
(11, 21, 10, 1),
(12, 22, 10, 1),
(13, 23, 10, 1),
(14, 24, 10, 1),
(15, 25, 10, 1),
(16, 26, 10, 1),
(17, 27, 10, 1),
(18, 28, 10, 1),
(19, 29, 10, 1),
(20, 30, 10, 1),
(21, 31, 10, 1),
(22, 32, 10, 1),
(23, 33, 10, 1),
(24, 34, 10, 1),
(25, 35, 10, 1),
(26, 36, 10, 1),
(27, 37, 10, 1),
(28, 38, 10, 1),
(29, 39, 10, 1),
(30, 40, 10, 1),
(31, 41, 10, 1),
(32, 42, 10, 1),
(33, 43, 10, 1),
(34, 44, 10, 1),
(35, 45, 10, 1),
(36, 46, 10, 1),
(37, 47, 10, 1),
(38, 48, 10, 1),
(39, 49, 10, 1),
(40, 50, 10, 1),
(41, 51, 10, 1),
(42, 52, 10, 1),
(43, 53, 10, 1),
(44, 54, 10, 1),
(45, 55, 10, 1),
(46, 56, 10, 1),
(47, 57, 10, 1),
(48, 58, 10, 1),
(49, 59, 10, 1),
(50, 60, 10, 1),
(51, 61, 10, 1),
(52, 62, 10, 1),
(53, 63, 10, 1),
(54, 64, 10, 1),
(55, 65, 10, 1),
(56, 66, 10, 1),
(57, 67, 10, 1),
(58, 68, 10, 1),
(59, 69, 10, 1),
(60, 70, 10, 1),
(61, 71, 10, 1),
(62, 72, 10, 1),
(63, 73, 10, 1),
(64, 74, 10, 1),
(65, 75, 10, 1),
(66, 76, 10, 1),
(67, 77, 10, 1),
(68, 78, 10, 1),
(69, 79, 10, 1),
(70, 80, 10, 1),
(71, 81, 10, 1),
(72, 82, 10, 1),
(73, 83, 10, 1),
(74, 84, 10, 1),
(75, 85, 10, 1),
(76, 86, 10, 1),
(77, 87, 10, 1),
(78, 88, 10, 1),
(79, 89, 10, 1),
(80, 90, 10, 1),
(81, 91, 10, 1),
(82, 92, 10, 1),
(83, 93, 10, 1),
(84, 94, 10, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `surveys`
--

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL,
  `schema_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `surveys`
--

INSERT INTO `surveys` (`id`, `schema_id`, `class_id`) VALUES
(2, 1, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `survey_results`
--

CREATE TABLE `survey_results` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `result` text COLLATE utf8_unicode_ci NOT NULL,
  `survey_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `survey_results`
--

INSERT INTO `survey_results` (`id`, `student_id`, `result`, `survey_id`) VALUES
(1, 57, '{\"r\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"4\",\"3\",\"2\",\"1\",\"2\"]}', 1),
(3, 43, '{\"r\":[\"5\",\"5\",\"4\",\"5\",\"5\",\"4\",\"5\",\"5\",\"5\",\"5\"]}', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `survey_schemas`
--

CREATE TABLE `survey_schemas` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'untitled survey',
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `survey_schemas`
--

INSERT INTO `survey_schemas` (`id`, `title`, `body`, `active`) VALUES
(1, 'Mẫu khảo sát chung', '{\"content\":[{\"title\":\"Cơ sở vật chất\",\"questions\":[\"Giảng đường đáp ứng yêu cầu của môn học\",\"Các trang thiết bị tại giảng đường đáp ứng yêu cầu giảng dạy và học tập\"]},{\"title\":\"Môn học\",\"questions\":[\"Bạn được hỗ trợ kịp thời trong quá trình học môn này\",\"Mục tiêu của môn học nêu rõ kiến thức và kỹ năng người học cần đạt được\",\"Thời lượng môn học được phân bổ hợp lý cho các hình thức học tập\",\"Các tài liệu phục vụ môn học được cập nhật\",\"Môn học góp phần trang bị kiến thức kỹ năng nghề nghiệp cho bạn\"]},{\"title\":\"Hoạt động giảng dạy của giáo viên\",\"questions\":[\"Giáo viên có mặt đúng giờ\",\"Giáo viên giảng bài dễ hiểu\",\"Giáo viên trợ giúp bạn khi bạn cần\"]}]}', 1),
(2, 'Mẫu khảo sát 2', '{\"content\":[{\"title\":\"Category thứ 1\",\"questions\":[\"Câu hỏi thứ 1\"]},{\"title\":\"Category thứ 2\",\"questions\":[\"Câu hỏi thứ 2.1\",\"Câu hỏi thứ 2.2\"]}]}', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `usr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teachers`
--

INSERT INTO `teachers` (`id`, `usr`, `pwd`, `email`, `name`) VALUES
(13, 'thanhld', '7c222fb2927d828af22f592134e8932480637c0d', 'thanhld@vnu.edu.vn', 'Lê Đình Thanh'),
(14, 'tunghx', '7c222fb2927d828af22f592134e8932480637c0d', 'tunghx@vnu.edu.vn', ' Hoàng Xuân Tùng'),
(15, 'sonnh', '7c222fb2927d828af22f592134e8932480637c0d', 'sonnh@vnu.edu.vn', 'Nguyễn Hoài Sơn'),
(16, 'thudm', '7c222fb2927d828af22f592134e8932480637c0d', 'thudm@vnu.edu.vn', 'Đào Minh Thư'),
(17, 'maitt', '7c222fb2927d828af22f592134e8932480637c0d', 'maitt@vnu.edu.vn', 'Trần Trúc Mai');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mssv` (`mssv`);

--
-- Chỉ mục cho bảng `student_class`
--
ALTER TABLE `student_class`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `survey_results`
--
ALTER TABLE `survey_results`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `survey_schemas`
--
ALTER TABLE `survey_schemas`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usr` (`usr`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT cho bảng `student_class`
--
ALTER TABLE `student_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `survey_results`
--
ALTER TABLE `survey_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `survey_schemas`
--
ALTER TABLE `survey_schemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
