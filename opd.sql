-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Out-2022 às 06:07
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `opd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `categorieId` int(12) NOT NULL,
  `categorieName` varchar(255) NOT NULL,
  `categorieDesc` text NOT NULL,
  `categorieCreateDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`categorieId`, `categorieName`, `categorieDesc`, `categorieCreateDate`) VALUES
(27, 'Hamburgers', 'Escolha entre nossa variedade de deliciosos hamburgers!', '2022-10-22 16:25:51'),
(28, 'Pizzas', 'Escolha entre nossa variedade de deliciosas pizzas!', '2022-10-22 16:30:26'),
(30, 'Porções', 'Escolha uma deliciosa porção para acompanhar seu pedido!', '2022-10-22 16:39:06'),
(31, 'Sobremesas', 'Escolha uma saborosa sobremesa para complementar seu pedido!', '2022-10-22 16:47:02'),
(32, 'Bebidas', 'Escolha uma bebida para acompanhar seu pedido!', '2022-10-22 16:47:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contact`
--

CREATE TABLE `contact` (
  `contactId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phoneNo` bigint(21) NOT NULL,
  `orderId` int(21) NOT NULL DEFAULT 0 COMMENT 'If problem is not related to the order then order id = 0',
  `message` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contact`
--

INSERT INTO `contact` (`contactId`, `userId`, `email`, `phoneNo`, `orderId`, `message`, `time`) VALUES
(5, 1, 'asfdasd@gmail.com', 11111111111, 28, 'Meu pedido veio errado, poderiam enviar outro?', '2022-10-22 20:17:57'),
(8, 13, 'carlos123@gmail.com', 19974119668, 0, 'Qual a demora em média da entrega dos pedidos?', '2022-10-30 23:14:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contactreply`
--

CREATE TABLE `contactreply` (
  `id` int(21) NOT NULL,
  `contactId` int(21) NOT NULL,
  `userId` int(23) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contactreply`
--

INSERT INTO `contactreply` (`id`, `contactId`, `userId`, `message`, `datetime`) VALUES
(7, 5, 1, 'Peço desculpas pelo incômodo, enviaremos outro pedido no lugar.', '2022-10-22 20:20:32'),
(10, 8, 13, 'Em média, 45 minutos.	', '2022-10-30 23:14:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `deliverydetails`
--

CREATE TABLE `deliverydetails` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `atendenteName` varchar(35) NOT NULL,
  `deliveryTime` int(200) NOT NULL COMMENT 'Time in minutes',
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `deliverydetails`
--

INSERT INTO `deliverydetails` (`id`, `orderId`, `atendenteName`, `deliveryTime`, `dateTime`) VALUES
(9, 25, 'Lucas', 12, '2022-10-26 02:55:30'),
(11, 28, 'Manuel', 24, '2022-10-22 19:23:09'),
(12, 29, 'Fernando', 20, '2022-10-22 20:15:12'),
(13, 33, 'Lucas', 5, '2022-10-31 01:52:13'),
(14, 32, 'Lucas', 1, '2022-10-31 01:52:10'),
(15, 34, 'Lucas', 35, '2022-10-31 01:52:37'),
(16, 35, 'Lucas', 40, '2022-10-31 01:52:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `produtoId` int(21) NOT NULL,
  `itemQuantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `orderitems`
--

INSERT INTO `orderitems` (`id`, `orderId`, `produtoId`, `itemQuantity`) VALUES
(49, 25, 93, 15),
(50, 25, 72, 1),
(51, 25, 73, 1),
(100, 28, 72, 3),
(101, 28, 73, 1),
(102, 28, 74, 1),
(103, 29, 93, 1),
(104, 30, 72, 1),
(105, 30, 73, 1),
(106, 30, 104, 1),
(107, 30, 81, 1),
(108, 31, 93, 1),
(109, 31, 102, 1),
(110, 31, 86, 3),
(111, 31, 87, 1),
(112, 32, 101, 1),
(113, 32, 102, 1),
(114, 32, 100, 1),
(115, 33, 106, 1),
(116, 33, 107, 1),
(117, 33, 111, 1),
(118, 34, 72, 1),
(119, 35, 93, 2),
(120, 35, 92, 1),
(121, 36, 73, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `orderId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `mesa` int(21) NOT NULL,
  `phoneNo` bigint(21) NOT NULL,
  `amount` int(200) NOT NULL,
  `paymentMode` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Pagar na hora, \r\n1=Pagar online',
  `orderStatus` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '0=Pedido Feito. 1=Pedido Confirmado. 2=Preparando seu pedido. 3=Pedido à caminho! 4=Pedido entregue. 5=Pedido Negado. 6=Pedido Cancelado.',
  `orderDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `mesa`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`) VALUES
(25, 1, 15, 19974119668, 472, '0', '3', '2022-10-22 18:47:20'),
(28, 1, 15, 11111111111, 91, '0', '4', '2022-10-22 19:23:09'),
(29, 1, 12, 11111111111, 29, '0', '5', '2022-10-22 20:13:03'),
(30, 13, 17, 19974119668, 61, '0', '6', '2022-10-30 23:25:00'),
(31, 13, 13, 19974119668, 77, '0', '5', '2022-10-30 23:27:08'),
(32, 13, 1, 19974119668, 63, '0', '4', '2022-10-30 23:27:21'),
(33, 13, 4, 19974119668, 53, '0', '3', '2022-10-30 23:27:33'),
(34, 13, 15, 19974119668, 15, '0', '2', '2022-10-31 01:43:53'),
(35, 13, 29, 19974119668, 83, '0', '1', '2022-10-31 01:44:33'),
(36, 13, 27, 19974119668, 22, '0', '0', '2022-10-31 01:53:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `produtoId` int(12) NOT NULL,
  `produtoName` varchar(255) NOT NULL,
  `produtoPrice` int(12) NOT NULL,
  `produtoDesc` text NOT NULL,
  `produtoCategorieId` int(12) NOT NULL,
  `produtoPubDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`produtoId`, `produtoName`, `produtoPrice`, `produtoDesc`, `produtoCategorieId`, `produtoPubDate`) VALUES
(72, 'X-Burger', 15, 'Hamburguer e queijo.', 27, '2022-10-22 16:41:03'),
(73, 'X-Salada', 22, 'Hamburguer, queijo, alface, tomate, cebola e maionese verde.', 27, '2022-10-22 16:43:33'),
(74, 'X-Bacon', 24, 'Hamburguer, queijo, bacon e molho especial.', 27, '2022-10-22 16:45:33'),
(75, 'X-Duplo Bacon', 32, '2 Hamburguers, queijo, bacon e molho especial.', 27, '2022-10-22 16:50:14'),
(76, 'X-Triplo Bacon', 40, '3 Hamburguers, queijo, bacon e molho especial.', 27, '2022-10-22 16:51:38'),
(77, 'Melt', 29, 'Hamburguer, molho cheddar, cebola caramelizada e bacon.\r\n\r\n', 27, '2022-10-22 16:56:14'),
(78, 'Caramel', 31, 'Hamburguer, cebola caramelizada, queijo cheddar, farofa de bacon e maionese verde.', 27, '2022-10-22 16:57:22'),
(79, 'Simples', 19, 'Hamburguer, queijo prato, alface, tomate e maionese verde.', 27, '2022-10-22 16:58:12'),
(80, 'Scweppes Citrus', 6, 'Schweppes Citrus 350ml', 32, '2022-10-22 17:01:52'),
(81, 'Água com Gás', 6, 'Água com Gás Crystal 500ml ', 32, '2022-10-22 17:03:16'),
(82, 'Água', 5, 'Água Crystal 500ml', 32, '2022-10-22 17:03:53'),
(83, 'Sprite', 6, 'Sprite 350ml', 32, '2022-10-22 17:05:40'),
(84, 'Ice Tea Pêssego', 8, 'Ice Tea Pêssego 300ml', 32, '2022-10-22 17:06:39'),
(85, 'Ice Tea Limão', 8, 'Ice Tea Limão 300ml', 32, '2022-10-22 17:08:28'),
(86, 'Fanta Guaraná', 6, 'Fanta Guaraná 350ml', 32, '2022-10-22 17:08:53'),
(87, 'Fanta Uva', 6, 'Fanta Uva 350ml', 32, '2022-10-22 17:09:21'),
(88, 'Fanta Laranja', 6, 'Fanta Laranja 350ml', 32, '2022-10-22 17:09:45'),
(89, 'Coca-Cola Zero', 6, 'Coca-Cola Zero 350ml', 32, '2022-10-22 17:12:17'),
(90, 'Coca-Cola', 6, 'Coca-Cola 350ml', 32, '2022-10-22 17:12:36'),
(91, 'Itubaína', 8, 'Itubaína 355ml', 32, '2022-10-22 17:15:16'),
(92, 'Muçarela', 25, 'Muçarela e orégano.', 28, '2022-10-22 18:31:53'),
(93, 'Marguerita', 29, 'Muçarela, tomate, orégano e manjericão.', 28, '2022-10-22 18:32:25'),
(94, 'Pepperoni', 32, 'Muçarela, orégano e pepperoni.', 28, '2022-10-22 18:32:43'),
(95, '4 Queijos', 40, 'Muçarela, requeijão, gorgonzola, orégano e parmesão ralado.', 28, '2022-10-22 18:33:33'),
(96, '3 Queijos', 35, 'Muçarela, requeijão, orégano e parmesão ralado.', 28, '2022-10-22 18:34:02'),
(97, 'Frango com Requeijão', 35, 'Frango desfiado, cebola, orégano e requeijão', 28, '2022-10-22 18:35:21'),
(98, 'Bauru', 30, 'Muçarela, presunto, requeijão, orégano e tomate.', 28, '2022-10-22 18:36:24'),
(99, 'Portuguesa', 36, 'Muçarela, presunto, ovo de codorna, azeitona preta, cebola, orégano e pimentão verde.', 28, '2022-10-22 18:37:03'),
(100, 'Fritas Tradicionais', 15, 'Batatas fritas crocantes e saborosas.', 30, '2022-10-22 18:44:07'),
(101, 'Fritas com Provolone ', 24, 'Batatas fritas com provolone e bacon.', 30, '2022-10-22 18:45:23'),
(102, 'Fritas com Cheddar', 24, 'Batatas fritas com cheddar e bacon.', 30, '2022-10-22 18:45:44'),
(103, 'Chicken Fingers', 24, 'Tirinhas de frango empanadas.', 30, '2022-10-22 18:47:47'),
(104, 'Cheesecake', 18, 'Cheesecake de caldas vermelhas acompanhado de sorvete de creme', 31, '2022-10-22 18:50:36'),
(105, 'Banana Split', 25, '3 bolas de sorvete, banana, chantily, cobertura de morango, chocolate e Ovomaltine.', 31, '2022-10-22 18:51:22'),
(106, 'Brownie', 15, 'Brownie de chocolate com castanhas acompanhado de sorvete de creme.', 31, '2022-10-22 18:51:58'),
(107, 'Hamburguer de Nutella', 20, 'Pão brioche polvilhado com açúcar de confeiteiro, Nutella e banana.', 31, '2022-10-22 18:52:45'),
(108, 'Casquinha com Nutella', 7, 'Casquinha de baunilha com Nutella.', 31, '2022-10-22 18:53:31'),
(109, 'Milk-Shake de Ovomaltine', 20, 'Milk-Shake sabor Ovomaltine de 400ml.', 31, '2022-10-22 18:54:55'),
(110, 'Milk-Shake de Nutella', 22, 'Milk-Shake sabor Nutella de 400ml.', 31, '2022-10-22 18:55:24'),
(111, 'Milk-Shake de Morango', 18, 'Milk-Shake sabor Morango de 400ml.', 31, '2022-10-22 18:56:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sitedetail`
--

CREATE TABLE `sitedetail` (
  `tempId` int(11) NOT NULL,
  `systemName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `contact1` bigint(21) NOT NULL,
  `contact2` bigint(21) DEFAULT NULL COMMENT 'Optional',
  `address` text NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sitedetail`
--

INSERT INTO `sitedetail` (`tempId`, `systemName`, `email`, `contact1`, `contact2`, `address`, `dateTime`) VALUES
(1, 'Way-Tech', 'waytechtcc@gmail.com', 0, 1111111111, 'Rua Pastor Hugo Gegembauer, 265 <br> Parque Ortolândia, Hortolândia - SP', '2022-10-22 14:41:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(21) NOT NULL,
  `username` varchar(21) NOT NULL,
  `firstName` varchar(21) NOT NULL,
  `lastName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `userType` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=user\r\n1=admin',
  `password` varchar(255) NOT NULL,
  `joinDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`, `joinDate`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@gmail.com', 11111111111, '1', '$2y$10$AAfxRFOYbl7FdN17rN3fgeiPu/xQrx6MnvRGzqjVHlGqHAM4d9T1i', '2022-10-22 11:41:03'),
(13, 'Carlos', 'Carlos', 'Eduardo', 'carlos123@gmail.com', 19974119668, '1', '$2y$10$Ohc1yCoEfVIwPGQtbp/uteEi5JhoXU74Gpers5n36JcfOofDlngUu', '2022-10-30 21:42:50'),
(14, 'Pablo', 'Pablo', 'Alberto', 'pablo123@gmail.com', 19974239586, '1', '$2y$10$S4bLjMn68AXt2okh1ld5LeWuGxTWmxpERIrAnPIvevA2bTKiSYcyK', '2022-10-30 21:43:10'),
(15, 'Alciomar', 'Alciomar', 'Hollanda', 'alciomar123@gmail.com', 22222222222, '0', '$2y$10$EzoNDJobPDjb0gF6fOzLhuB7kFoOZ.4gQK1Ids9nvsGTcP.oHKtD.', '2022-10-30 21:44:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `viewcart`
--

CREATE TABLE `viewcart` (
  `cartItemId` int(11) NOT NULL,
  `produtoId` int(11) NOT NULL,
  `itemQuantity` int(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categorieId`);
ALTER TABLE `categories` ADD FULLTEXT KEY `categorieName` (`categorieName`,`categorieDesc`);

--
-- Índices para tabela `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactId`);

--
-- Índices para tabela `contactreply`
--
ALTER TABLE `contactreply`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `deliverydetails`
--
ALTER TABLE `deliverydetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orderId` (`orderId`);

--
-- Índices para tabela `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`produtoId`);
ALTER TABLE `produto` ADD FULLTEXT KEY `pizzaName` (`produtoName`,`produtoDesc`);

--
-- Índices para tabela `sitedetail`
--
ALTER TABLE `sitedetail`
  ADD PRIMARY KEY (`tempId`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Índices para tabela `viewcart`
--
ALTER TABLE `viewcart`
  ADD PRIMARY KEY (`cartItemId`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `categorieId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2943;

--
-- AUTO_INCREMENT de tabela `contact`
--
ALTER TABLE `contact`
  MODIFY `contactId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `contactreply`
--
ALTER TABLE `contactreply`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `deliverydetails`
--
ALTER TABLE `deliverydetails`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `produtoId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT de tabela `sitedetail`
--
ALTER TABLE `sitedetail`
  MODIFY `tempId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `viewcart`
--
ALTER TABLE `viewcart`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
