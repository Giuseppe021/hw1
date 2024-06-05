-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 05, 2024 alle 23:43
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`) VALUES
(1, 'Iphone 11 64 GB', 'La perfetta quantità di tutto:\nUn nuovo sistema a doppia fotocamera, per inquadrare più cose intorno a te. Il chip per smart­phone più veloce che ci sia, insieme a una batteria che ti dà una giornata intera di libertà, per fare più cose ancora più a lungo. E la più alta qualità video mai raggiunta da uno smart­phone, per ricordi più belli che mai.\n\nFare una brutta foto sta diventando impossibile:\nUn sistema a doppia fotocamera tutto nuovo. Passa dal grandangolo all’ultra-grandangolo e trova l’inquadratura perfetta per tutte le tue foto. L’interfaccia ridisegnata sfrutta la nuova fotocamera ultra-grandangolare per mostrarti quello che succede al di fuori dell’inquadratura e permetterti, se vuoi, di includerlo nello scatto.', 720.00, 'https://clickatenea.it/shop/120-home_default/iphone-11-64-gb.jpg'),
(2, 'IPHONE 11 PRO 64 GB', 'Un rivoluzionario sistema a tripla fotocamera con tantissime funzioni in più e la stessa facilità d’uso di sempre. Un passo avanti senza precedenti in fatto di autonomia. E un chip straordinario, che sfrutta ancora di più l’apprendimento automatico per ridefinire i limiti di ciò che uno smart­phone può fare. È nato il primo iPhone così potente da meritarsi il nome Pro.', 920.00, 'https://clickatenea.it/shop/121-home_default/iphone-11-pro-64-gb.jpg'),
(3, 'IPHONE 11 PRO 256 GB', 'Un rivoluzionario sistema a tripla fotocamera con tantissime funzioni in più e la stessa facilità d’uso di sempre. Un passo avanti senza precedenti in fatto di autonomia. E un chip straordinario, che sfrutta ancora di più l’apprendimento automatico per ridefinire i limiti di ciò che uno smart­phone può fare. È nato il primo iPhone così potente da meritarsi il nome Pro.', 1.10, 'https://clickatenea.it/shop/121-home_default/iphone-11-pro-64-gb.jpg'),
(4, 'IPHONE 11 128 GB', 'Un nuovo sistema a doppia fotocamera, per inquadrare più cose intorno a te. Il chip per smart­phone più veloce che ci sia, insieme a una batteria che ti dà una giornata intera di libertà, per fare più cose ancora più a lungo. E la più alta qualità video mai raggiunta da uno smart­phone, per ricordi più belli che mai.', 800.00, 'https://clickatenea.it/shop/120-home_default/iphone-11-64-gb.jpg'),
(5, 'IPHONE 13 128 GB', 'Un nuovo sistema a doppia fotocamera, per inquadrare più cose intorno a te. Il chip per smart­phone più veloce che ci sia.', 900.00, 'https://clickatenea.it/shop/120-home_default/iphone-11-64-gb.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `repairs`
--

CREATE TABLE `repairs` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `estimated_completion` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `repairs`
--

INSERT INTO `repairs` (`id`, `description`, `status`, `start_date`, `estimated_completion`, `user_id`) VALUES
(1, 'Iphone 11 problema batteria', 'In riparazione', '2024-06-04', NULL, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Cognome` varchar(255) NOT NULL,
  `NomeUtente` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`ID`, `Nome`, `Cognome`, `NomeUtente`, `Email`, `Password`) VALUES
(1, 'peppe', 'peppe', 'peppe', 'peppe@gmail.com', '$2y$10$71k47reEKaaUUpbNVmCSduxDNJCXdtuAVuY7WaHWIaM.Ovo514cFi'),
(2, 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$7ghKFo/mSLQKDwFCauGk7eVQeIMG2A1FW7JLsDXzRslj17DIzuIyO');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indici per le tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Limiti per la tabella `repairs`
--
ALTER TABLE `repairs`
  ADD CONSTRAINT `repairs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
