-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Cze 2023, 21:47
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ksiegarnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Obyczajowe'),
(2, 'Fantasy'),
(3, 'Manga'),
(4, 'Testowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`) VALUES
(1, 'klient@klient.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `idOrder`, `idProduct`, `quantity`) VALUES
(1, 1, 2, 1),
(2, 2, 2, 1),
(3, 2, 1, 1),
(4, 3, 2, 4),
(5, 4, 1, 3),
(6, 5, 2, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `idUser`, `total`, `orderDate`, `status`) VALUES
(1, 1, 25, '2023-05-22', 'Paid'),
(2, 1, 45, '2023-05-22', 'Sent'),
(3, 1, 100, '2023-05-22', 'Paid'),
(4, 3, 60, '2023-06-03', 'Sent'),
(5, 3, 25, '2023-06-03', 'Sent');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `img` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `categoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `img`, `price`, `categoryId`) VALUES
(1, 'Harry Potter i Kamień Filozoficzny', 'Harry Potter i Kamień Filozoficzny (tytuł oryginalny: Harry Potter and the Philosopher’s Stone) – powieść fantasy brytyjskiej pisarki J.K. Rowling, po raz pierwszy wydana 26 czerwca 1997 na terenie Wielkiej Brytanii nakładem wydawnictwa Bloomsbury Publishing.', 'harry1.jpg', 25, 2),
(2, 'Lalka', 'Powieść społeczno-obyczajowa Bolesława Prusa publikowana w odcinkach w latach 1887–1889 w dzienniku „Kurier Codzienny”, wydana w 1890 w Warszawie w wydawnictwie „Gebethner i Wolff”.', 'lalka.jpg', 25, 1),
(3, 'SPYxFAMILY #01', 'Wybitny szpieg o pseudonimie \"Zmierzch\" musi założyć rodzinę, by zinfiltrować pewną szkołę. Nie wie jednak, że adoptowana córka potrafi czytać w myślach, a świeżo poślubiona żona to płatna zabójczyni! Przed Wami trzymająca w napięciu komedia o wyjątkowej rodzinie z sekretami, na drodze której pojawią się rozmaite niebezpieczeństwa, takie jak na przykład egzaminy wstępne!\r\n', 'spy1.jpg', 19, 3),
(4, 'Test', 'Testowy obiekt, który zostanie dodany', 'default.png', 19, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `stars` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `reviews`
--

INSERT INTO `reviews` (`id`, `idProduct`, `idUser`, `review_text`, `stars`, `date`) VALUES
(1, 1, 1, 'Polecam', 5, '2023-05-30'),
(2, 1, 1, 'Fajne', 4, '2023-05-30');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` text NOT NULL,
  `permissions` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`) VALUES
(1, 'admin@admin.com', '$2y$10$zYWxW3jzenNIDqs6cZ2G7uc8HrgXR5nPr.voURDBhDdkLioDqqBAO', 1),
(2, 'emp@emp.com', '$2y$10$pFu7r.V.pZauxSCVg92RK.9yRlbEWTE8pusb3j2g6cvpKSs6rxEIS', 2),
(3, 'klient@klient.com', '$2y$10$QSM2eRdGY.B9J9DAk0hGBe1d3/6k2TqfiGH.oOo5P7zgjuv6DXUri', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
