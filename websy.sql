-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 05:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websy`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `has_taken_quiz` tinyint(1) DEFAULT 0,
  `birthday` date DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `has_taken_quiz`, `birthday`, `first_name`, `last_name`, `profile_pic`) VALUES
(15, 'user1', 'user1@example.com', '$2y$10$S29frWYzFD.hE90p11CIyeTGluHLpk.U7idwWp283JGP2aeteiUtO', NULL, '2000-01-01', 'Student1', 'Doe', NULL),
(16, 'user2', 'user2@example.com', '$2y$10$xOv1YrHsXPmP71xMEpoLk.PwNkr.PZYXXWMegk4/rzMauVMsJzugm', NULL, '2000-01-01', 'Student2', 'Doe', NULL),
(17, 'user3', 'user3@example.com', '$2y$10$dObsRSpJjLjTCBBGUoDkh.kUvx27naHWHJlnSxHtKdKHo3ohs91aq', NULL, '2000-01-01', 'Student3', 'Doe', NULL),
(18, 'user4', 'user4@example.com', '$2y$10$1ded2SMIBDyagR832kH9teDj7FKin3XManEVUb9QMSodz5CgnzWZK', NULL, '2000-01-01', 'Student4', 'Doe', NULL),
(19, 'user5', 'user5@example.com', '$2y$10$MUX3BgV9a5BH6Yfea6OZ0.GCuPDMKArQSx.4ZHiV1njts05wdat4S', NULL, '2000-01-01', 'Student5', 'Doe', NULL),
(20, 'user6', 'user6@example.com', '$2y$10$cZpo6TbmE4VgYUZOdbRv/uZJi/PUHOlbq2Tkgtq/mqo0XT/EA.4.q', NULL, '2000-01-01', 'Student6', 'Doe', NULL),
(21, 'user7', 'user7@example.com', '$2y$10$N3A3z/oaPKjgf0ZxT3ep5OuiuA5wF6Cb/rGdwH.l0yOAUPSCTSj7i', NULL, '2000-01-01', 'Student7', 'Doe', NULL),
(22, 'user8', 'user8@example.com', '$2y$10$0PA9ZDKnuYuQgZ4.e5iI2OtuHkanNrQFhaXILBV3ptLwQPK9eyXsO', NULL, '2000-01-01', 'Student8', 'Doe', NULL),
(23, 'user9', 'user9@example.com', '$2y$10$J24fzZWgxhfd.nimgFwaUeTrmLexK.Czv2XOiUsEbPEHCLlfxjNmi', NULL, '2000-01-01', 'Student9', 'Doe', NULL),
(24, 'user10', 'user10@example.com', '$2y$10$XngaT/OtCTQnYmcm6YnAx.Gi7B.2f8iMeDSQTL1QKpFKyaMDvNUn6', NULL, '2000-01-01', 'Student10', 'Doe', NULL),
(25, 'user11', 'user11@example.com', '$2y$10$N1LYynrOEhPLGs8eUpsqIuyLwgf3VMqhsSRMUoq6NPUKPcKlbTqe6', NULL, '2000-01-01', 'Student11', 'Doe', NULL),
(26, 'user12', 'user12@example.com', '$2y$10$BZQrM1t.P8/K2OGatFI2ruJtgRst9SjRSgzozJgQiuGr6vSPA8gGy', NULL, '2000-01-01', 'Student12', 'Doe', NULL),
(27, 'user13', 'user13@example.com', '$2y$10$Y7h45HxYivQDs3GtxPr48uR4wAZ4BjEcANAn7bCpxmS1ook5iKWhG', NULL, '2000-01-01', 'Student13', 'Doe', NULL),
(28, 'user14', 'user14@example.com', '$2y$10$EnnjM20WboARYSDtbhw/.u1fCXdY53mQg0OOjGETKcZqJQ2KGgyxC', NULL, '2000-01-01', 'Student14', 'Doe', NULL),
(29, 'user15', 'user15@example.com', '$2y$10$5j8etUJA07D6nXpKI1eGreibWr.IvQCnlKL.knp8mF9uSFC/F15wu', NULL, '2000-01-01', 'Student15', 'Doe', NULL),
(30, 'user16', 'user16@example.com', '$2y$10$rGkBbtFiRvbfb8dl2yT2VuH5DW49O6oXYhPVOHaiO2BNK5n.hZQaG', NULL, '2000-01-01', 'Student16', 'Doe', NULL),
(31, 'user17', 'user17@example.com', '$2y$10$vbny9YXy9I12cXjymSkV0.CF5372Lg/ikQMGuEzXwqgO0lZ3eK9Ma', NULL, '2000-01-01', 'Student17', 'Doe', NULL),
(32, 'user18', 'user18@example.com', '$2y$10$B4iBNzsmaSd8jHkbnxmHXeERBS9pMhbCDg5MGILooh2n2BCCRuINu', NULL, '2000-01-01', 'Student18', 'Doe', NULL),
(33, 'user19', 'user19@example.com', '$2y$10$j/h3c4/J9ygavehUqWzB/u2Cikw2vclMUUI8aIelXc6mAsSIbmqv6', NULL, '2000-01-01', 'Student19', 'Doe', NULL),
(34, 'user20', 'user20@example.com', '$2y$10$6fq4ML548Xo1qJBAj/3.Y.0khoWwTGtgQ8fOaGrJt9GnFFSx6esLi', NULL, '2000-01-01', 'Student20', 'Doe', NULL),
(35, 'user1', 'user1@example.com', '$2y$10$Hq/hPUODE4RW0GPaDnTntOA5xx9MbsCnF8l2YJFScNbggO/deAqtm', NULL, '2000-01-01', 'Student1', 'Doe', NULL),
(36, 'user2', 'user2@example.com', '$2y$10$lykF3MQC/BLzogj1Ce/45OmD0pzi/Tp8ypPBs.jDkC2puOFLS2ypK', NULL, '2000-01-01', 'Student2', 'Doe', NULL),
(37, 'user3', 'user3@example.com', '$2y$10$NQPx9mRvYjGKjIgCyoUeFu9xc7opdfZtLQuga2pc6doNqoxlgeOCe', NULL, '2000-01-01', 'Student3', 'Doe', NULL),
(38, 'user4', 'user4@example.com', '$2y$10$J8fDTWepKQOCAi0S9DZkqOJ791dLKamXEIWzA7B1kJ/VYcPpRJgD2', NULL, '2000-01-01', 'Student4', 'Doe', NULL),
(39, 'user5', 'user5@example.com', '$2y$10$AhYCHjumF/jbJa4/JxJhu.T/UHr5qhjDFXqpdTomvXxA2GQcTVBMC', NULL, '2000-01-01', 'Student5', 'Doe', NULL),
(40, 'user6', 'user6@example.com', '$2y$10$p982gZnPGFhI9.uAv7VAo.82Tt3idJ.BCbeZDhGUud1ryWBckpG5K', NULL, '2000-01-01', 'Student6', 'Doe', NULL),
(41, 'user7', 'user7@example.com', '$2y$10$9Z9qHkj1wt9u4fZGr5QSjOl5MU/wrwnNx7EK50qpc/IoTvhXcTNSC', NULL, '2000-01-01', 'Student7', 'Doe', NULL),
(42, 'user8', 'user8@example.com', '$2y$10$Pu6w4nOoSXqmlAetRu7MWeuztxY2MaP/hWxs1VhMY4wagM/4ZBWC6', NULL, '2000-01-01', 'Student8', 'Doe', NULL),
(43, 'user9', 'user9@example.com', '$2y$10$ZJMZSIr7LfV1nZaW4fMq6OF/LicXukDzCNhoPQRWfJu9NTI2lwvkK', NULL, '2000-01-01', 'Student9', 'Doe', NULL),
(44, 'user10', 'user10@example.com', '$2y$10$RqCbeqJgsA8CNV2A8kdJOOyevtPGmHxsV18zsdbnGlMcVX7NlFAVq', NULL, '2000-01-01', 'Student10', 'Doe', NULL),
(45, 'user11', 'user11@example.com', '$2y$10$RZPV/G7bzX7NT4VKUTirY.hlaDH0BZMYn8Ya3gOXRwJkMlIPY/3Q6', NULL, '2000-01-01', 'Student11', 'Doe', NULL),
(46, 'user12', 'user12@example.com', '$2y$10$ndPxTpaY.c93NlIMIqy3q.RlOWkI9FySSuueSHzjaYvTLlNTgU7Ve', NULL, '2000-01-01', 'Student12', 'Doe', NULL),
(47, 'user13', 'user13@example.com', '$2y$10$/XkiKuPw71tNhdi8NLUL6.ppKPhdULamcSVoLn6jBwntiMdxfxzlS', NULL, '2000-01-01', 'Student13', 'Doe', NULL),
(48, 'user14', 'user14@example.com', '$2y$10$/wCefDz16LEoEAVaP2nwXO6yu9ekEFBcdydnHskwZ4UYVxaEMokTC', NULL, '2000-01-01', 'Student14', 'Doe', NULL),
(49, 'user15', 'user15@example.com', '$2y$10$odwiz7lGNpc4EkiX9ffkgeYQcf1Wnb2G0XZov5U3qDLD8dYSpMCzm', NULL, '2000-01-01', 'Student15', 'Doe', NULL),
(50, 'user16', 'user16@example.com', '$2y$10$hnzBoKHRjI2vvny36HUXo.g6uLWJek9ylXMfeVcMm/.fDYltog9ze', NULL, '2000-01-01', 'Student16', 'Doe', NULL),
(51, 'user17', 'user17@example.com', '$2y$10$13v0mHpQiu0YKYliXz4ua.5WRf1wAzxhqVnBKxaGYR0O5kLSG2H9u', NULL, '2000-01-01', 'Student17', 'Doe', NULL),
(52, 'user18', 'user18@example.com', '$2y$10$OlayY4pOXP9FXTFJer11x.VxnDCYJLoVsk3sDug27C4rVCEWIltQC', NULL, '2000-01-01', 'Student18', 'Doe', NULL),
(53, 'user19', 'user19@example.com', '$2y$10$Sfkc.e10t3Dm1uT0.eifY.QIq0ju3/LLavUJxeh/C1Psdzhy1T9Ou', NULL, '2000-01-01', 'Student19', 'Doe', NULL),
(54, 'user20', 'user20@example.com', '$2y$10$JpYMjH1H.loAdLMC4.pGN.2knA21JcRAf7c1FwSUybD9LamQ3jRxC', NULL, '2000-01-01', 'Student20', 'Doe', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
