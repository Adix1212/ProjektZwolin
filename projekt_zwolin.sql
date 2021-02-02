-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Lut 2021, 02:15
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt_zwolin`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone` int(9) NOT NULL,
  `reward` int(11) NOT NULL,
  `position` varchar(45) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `employees`
--

INSERT INTO `employees` (`id`, `name`, `last_name`, `phone`, `reward`, `position`, `loginid`) VALUES
(8, 'Adrian', 'Niklewicz', 789789789, 9000, 'Szef', 1),
(9, 'Dominik', 'Korwalski', 456456456, 3250, 'Export', 4),
(10, 'pracownik', 'pacownik', 789456123, 3000, 'Import', 19),
(11, 'Dariusz', 'Cichociemny', 987789879, 3500, 'Export', 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `login`
--

INSERT INTO `login` (`id`, `login`, `password`, `email`) VALUES
(1, 'adix12', '$2y$10$FeVwqJOGX18ZjNPwN6kLcOtOU7Hie7JyZwR5UpBHSX8WbpzkZ7/Cu', 'adix12@gmail.com'),
(2, 'Mati123', '$2y$10$FeVwqJOGX18ZjNPwN6kLcOtOU7Hie7JyZwR5UpBHSX8WbpzkZ7/Cu', 'mati1223@gmail.com'),
(3, 'dawid321', '$2y$10$FeVwqJOGX18ZjNPwN6kLcOtOU7Hie7JyZwR5UpBHSX8WbpzkZ7/Cu', 'dawid321@gmail.com'),
(4, 'Dominik420', '$2y$10$FeVwqJOGX18ZjNPwN6kLcOtOU7Hie7JyZwR5UpBHSX8WbpzkZ7/Cu', 'dobryskun420@gmail.com'),
(18, 'grzesal123', '$2y$10$38h5Wa3sIv5lJQILLqEr3OBd0fmS458tvVbU8j9XKbJADwEiEibPO', 'grzesal123@wp.pl'),
(19, 'pracownik', '$2y$10$FeVwqJOGX18ZjNPwN6kLcOtOU7Hie7JyZwR5UpBHSX8WbpzkZ7/Cu', 'pracownik@wp.pl'),
(20, 'Darek321', '$2y$10$mF0A79dnXqAyyPOZKLVg/u5pgHWa4k/5HKuaCp1Vps9YJSW5ZBh9e', 'darek321@wp.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `number` int(11) NOT NULL,
  `info` text NOT NULL,
  `userid` int(11) NOT NULL,
  `employeesid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `name`, `number`, `info`, `userid`, `employeesid`) VALUES
(1, 'Świadectwo', 100001, 'Świadectwo zdania szkoły ', 1, 8),
(2, 'Monitor', 100002, 'Monitor marki BENQ 144 hz eloo', 2, 9),
(3, 'PS5', 100003, 'konstola marki sony do gier elooo', 1, 9),
(4, 'Elo', 100004, 'elo', 1, 10),
(5, 'pies', 100005, 'dalmatynczyk', 1, 10),
(6, 'Komputer', 100006, 'Komputer gamingiwy z ledami ua wypasionyfest rtX10k20050 jD super editon max power eloo', 2, 10),
(7, 'laptop', 100007, 'marka dell ', 2, 10),
(8, 'Karta Graficza', 100008, 'Karta Graficzna marki gforce gtx 3090TI', 2, 9),
(9, 'Elo', 100009, 'ad', 1, 9),
(10, 'Ork', 100010, 'Tak zwany Dis norbert Gierczak ', 1, 9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `date_admission` date DEFAULT NULL,
  `date_shipment` date DEFAULT NULL,
  `orderid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `status`
--

INSERT INTO `status` (`id`, `status`, `date_admission`, `date_shipment`, `orderid`) VALUES
(1, 'Przyjęte', '2021-01-01', NULL, 1),
(2, 'Wysłane', '2021-01-03', '2021-01-06', 3),
(3, 'Wysłane', '2021-01-04', '2021-01-07', 2),
(4, 'Oczekiwanie na przyjęcie', NULL, NULL, 4),
(5, 'Oczekiwanie na przyjęcie', NULL, NULL, 5),
(6, 'Oczekiwanie na przyjęcie', NULL, NULL, 6),
(7, 'Oczekiwanie na przyjęcie', NULL, NULL, 7),
(8, 'Oczekiwanie na przyjęcie', NULL, NULL, 8),
(9, 'Oczekiwanie na przyjęcie', NULL, NULL, 9),
(10, 'Oczekiwanie na przyjęcie', NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone` varchar(9) NOT NULL,
  `position` varchar(45) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `phone`, `position`, `loginid`) VALUES
(1, 'Mateusz', 'Rolnik', '458526547', 'Kupujący', 2),
(2, 'Dawid', 'Wariacik', '654987321', 'Sprzedawca', 3),
(11, 'Grzegurz', 'Salata', '123456789', 'Sprzedawca', 18);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginid` (`loginid`);

--
-- Indeksy dla tabeli `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `employeesid` (`employeesid`);

--
-- Indeksy dla tabeli `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orderid` (`orderid`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginid` (`loginid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`loginid`) REFERENCES `login` (`id`);

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`employeesid`) REFERENCES `employees` (`id`);

--
-- Ograniczenia dla tabeli `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`loginid`) REFERENCES `login` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
