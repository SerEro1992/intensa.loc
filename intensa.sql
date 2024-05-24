-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: mysql-8.2
-- Время создания: Май 24 2024 г., 21:45
-- Версия сервера: 8.2.0
-- Версия PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `intensa`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` smallint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `city` enum('Москва','Санкт-Петербург','Тула') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `city`) VALUES
(1, 'Ella Calderon', 'kecaz@mailinator.com', '15346149453', 'Москва'),
(2, 'Quincy Chang', 'tivora@mailinator.com', '74777597148', 'Тула'),
(3, 'Quincy Chang', 'tivora@mailinator.com', '74777597148', 'Тула'),
(4, 'Lila Huffman', 'gogevyfev@mailinator.com', '71769682545', 'Санкт-Петербург'),
(5, 'Yolanda Davenport', 'hahigoxyti@mailinator.com', '78876693225', 'Москва'),
(6, 'Nita Torres', 'byjananyh@mailinator.com', '75352088875', 'Тула'),
(7, 'Iola Kline', 'zopebywaru@mailinator.com', '79462146662', 'Тула'),
(8, 'Сергей Тест', 'pyla@mailinator.com', '73026812326', 'Санкт-Петербург'),
(9, 'Elijah Schultz', 'vefej@mailinator.com', '76552385459', 'Санкт-Петербург'),
(10, 'Justina Chambers', 'lutegu@mailinator.com', '74518033677', 'Санкт-Петербург'),
(11, 'Keaton Snider', 'doroxeboni@mailinator.com', '73726577022', 'Тула'),
(12, 'Kyle Stuart', 'zuvakyg@mailinator.com', '74689085033', 'Москва'),
(13, 'Ainsley Downs', 'sykiri@mailinator.com', '76054642251', 'Тула'),
(14, 'Alexa Knight', 'wibopil@mailinator.com', '76953653554', 'Тула'),
(15, 'Lamar Tanner', 'kytax@mailinator.com', '74474652437', 'Москва'),
(16, 'Серхио Рамос', 'kywareme@mailinator.com', '75196935491', 'Санкт-Петербург'),
(17, 'Dora Byers', 'xadyd@mailinator.com', '75419352785', 'Санкт-Петербург'),
(18, 'Julie Crosby', 'nelyhypolo@mailinator.com', '79418121066', 'Санкт-Петербург'),
(19, 'Abdul Schultz', 'tyxelohe@mailinator.com', '77779278344', 'Санкт-Петербург'),
(20, 'Ocean Anthony', 'vywyjuny@mailinator.com', '76117297364', 'Тула'),
(21, 'Shelley Payne', 'cofoj@mailinator.com', '71963029178', 'Москва'),
(22, 'Azalia Estrada', 'rikynovag@mailinator.com', '75068457511', 'Тула'),
(23, 'Freya Austin', 'bogoxaworu@mailinator.com', '73525064913', 'Тула'),
(24, 'Stacey Maldonado', 'qaqeti@mailinator.com', '74087678585', 'Тула'),
(25, 'Damian Gallegos', 'ryzuje@mailinator.com', '79987351328', 'Москва'),
(26, 'Benjamin Shaffer', 'jijevo@mailinator.com', '75952368058', 'Санкт-Петербург'),
(27, 'Idona Potter', 'wykiliqy@mailinator.com', '77824377979', 'Москва'),
(28, 'Duncan Santana', 'tirus@mailinator.com', '72877212914', 'Тула'),
(29, 'Kaye Moss', 'jevimu@mailinator.com', '74837899572', 'Тула'),
(30, 'Iona Rodgers', 'picytuqo@mailinator.com', '78888497693', 'Санкт-Петербург'),
(31, 'Dylan Justice1', 'muxowuniwu@mailinator.com', '74616066717', 'Санкт-Петербург'),
(32, 'Mira Goodman', 'nahelav@mailinator.com', '74165365574', 'Тула'),
(33, 'Colin Potts', 'zonifiriqi@mailinator.com', '77411568897', 'Санкт-Петербург'),
(34, 'Lisandra Newton', 'runezedot@mailinator.com', '71741399263', 'Санкт-Петербург'),
(35, 'Scott Mclean', 'bevycatija@mailinator.com', '73215669853', 'Тула'),
(36, 'Neil Odom', 'wuwuluquhy@mailinator.com', '78372713348', 'Санкт-Петербург'),
(37, 'Kenneth Strickland', 'niqezisune@mailinator.com', '75242517695', 'Тула'),
(38, 'Jerome Vaughn', 'rezewylyly@mailinator.com', '78572576881', 'Тула'),
(39, 'Xander Lopez', 'gobi@mailinator.com', '71062515662', 'Санкт-Петербург'),
(40, 'Allistair Reeves', 'sigetin@mailinator.com', '77179763974', 'Тула'),
(41, 'Brock Chang', 'xyqehi@mailinator.com', '72939469612', 'Санкт-Петербург'),
(42, 'Xander Burke', 'syxekeki@mailinator.com', '77596461822', 'Санкт-Петербург'),
(43, 'Gavin Atkins', 'givejesiw@mailinator.com', '73826728817', 'Санкт-Петербург'),
(44, 'Xaviera Albert', 'kona@mailinator.com', '76582185596', 'Москва'),
(45, 'Signe Decker', 'rowe@mailinator.com', '78237912809', 'Москва'),
(46, 'Cedric Webb', 'duvuma@mailinator.com', '72021045545', 'Москва'),
(47, 'Amber Rosales', 'meguwahif@mailinator.com', '79456241827', 'Санкт-Петербург'),
(48, 'Maite Houston', 'sihosasah@mailinator.com', '71045351866', 'Москва'),
(49, 'Jenette Head', 'gyfipeh@mailinator.com', '79393672045', 'Санкт-Петербург'),
(50, 'Jayme Marquez', 'syguzan@mailinator.com', '71695464691', 'Тула'),
(51, 'Wesley Gay', 'buvyhy@mailinator.com', '71567441463', 'Москва'),
(52, 'Yoshio West', 'bymicy@mailinator.com', '73393645856', 'Санкт-Петербург'),
(53, 'Kaden Buckner', 'xyhuxaki@mailinator.com', '72627238274', 'Москва'),
(54, 'Karyn Battle', 'zywanac@mailinator.com', '72571037007', 'Тула'),
(55, 'Quin Lott', 'jazyhiru@mailinator.com', '75297612212', 'Москва'),
(56, 'Gabriel Nielsen', 'nani@mailinator.com', '73499996975', 'Москва'),
(57, 'Kendall Witt', 'rovedir@mailinator.com', '74664061723', 'Тула'),
(58, 'Quail Cain', 'doqy@mailinator.com', '73492793612', 'Тула'),
(59, 'Jaquelyn Mcconnell', 'kuxa@mailinator.com', '77484419533', 'Москва'),
(60, 'Claire Lester', 'robozutady@mailinator.com', '74823188618', 'Тула'),
(61, 'Finn Beck', 'doxedeqyse@mailinator.com', '74956869974', 'Санкт-Петербург'),
(62, 'Moses Beard', 'zodypilaq@mailinator.com', '78067283524', 'Москва'),
(63, 'Keane Gardner', 'xexob@mailinator.com', '73245648448', 'Москва'),
(64, 'Karyn Foley', 'nocowo@mailinator.com', '78876234701', 'Санкт-Петербург'),
(65, 'Mira Spence', 'kuxajo@mailinator.com', '75475529365', 'Тула'),
(66, 'Xaviera Hopper', 'buxej@mailinator.com', '75214313391', 'Москва'),
(67, 'Miriam Morgan', 'lavyruqun@mailinator.com', '79454564114', 'Санкт-Петербург'),
(68, 'Francis Mcmahon', 'ryneweke@mailinator.com', '74986226988', 'Москва'),
(69, 'Ivy Davenport', 'wyfoqo@mailinator.com', '72374098727', 'Санкт-Петербург'),
(70, 'Callum Delgado', 'hokoki@mailinator.com', '79624465321', 'Санкт-Петербург'),
(71, 'Halla Cook', 'wogazyh@mailinator.com', '73135371632', 'Санкт-Петербург'),
(72, 'Hadassah Allison', 'kywob@mailinator.com', '72425021206', 'Санкт-Петербург'),
(73, 'Seth Frank', 'wuwecuq@mailinator.com', '75596699937', 'Тула'),
(74, 'Whitney Callahan', 'guvyrituva@mailinator.com', '78335938176', 'Тула'),
(75, 'Cooper Stephenson', 'zaserafe@mailinator.com', '74545881409', 'Санкт-Петербург'),
(76, 'Imogene Berg', 'gihohyxuj@mailinator.com', '75295371775', 'Санкт-Петербург'),
(77, 'Zelda Copeland', 'malavoniru@mailinator.com', '77651774856', 'Москва'),
(78, 'Indira Eaton', 'ruqesusu@mailinator.com', '72737955737', 'Москва'),
(79, 'Jayme Moon', 'qopi@mailinator.com', '75782621238', 'Тула'),
(80, 'Kellie Kirk', 'fazap@mailinator.com', '76419759536', 'Санкт-Петербург'),
(81, 'Arsenio Baker', 'gepovemi@mailinator.com', '78158822465', 'Санкт-Петербург'),
(82, 'Moana Workman', 'rureda@mailinator.com', '75831976918', 'Санкт-Петербург'),
(83, 'Linda Moss', 'tunoby@mailinator.com', '78953569506', 'Москва'),
(84, 'Vielka Ewing', 'rapy@mailinator.com', '78876222629', 'Тула'),
(85, 'Candace Holloway', 'huniwydis@mailinator.com', '72984057087', 'Москва'),
(86, 'Dillon Knapp', 'jorefugi@mailinator.com', '78747989054', 'Москва');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
