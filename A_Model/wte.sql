-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 02:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wte`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE `attachment` (
  `post_id` int(11) NOT NULL,
  `attachment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attachment`
--

INSERT INTO `attachment` (`post_id`, `attachment`) VALUES
(14, '../images/upload/Screenshot (2)1748350717png'),
(15, '../images/upload/Screenshot (11)1748350726png'),
(15, '../images/upload/Screenshot (12)1748350727png'),
(15, '../images/upload/Screenshot (13)1748350728png');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `user_id` int(11) NOT NULL,
  `id_follow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`user_id`, `id_follow`) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 3),
(2, 4),
(3, 2),
(3, 4),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(7, 2),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `forum_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`forum_id`, `name`, `date_created`) VALUES
(1, 'Album Discussions', '2025-05-06 21:19:09'),
(2, 'Concert Memories', '2025-05-06 21:19:09'),
(3, 'Fan Art & Covers', '2025-05-06 21:19:09'),
(4, 'Comments for Single: wave', '2025-05-27 17:46:18'),
(5, 'Comments for Single: light', '2025-05-27 17:46:18'),
(6, 'Comments for Single: surf.', '2025-05-27 17:46:18'),
(7, 'Comments for Single: pueblo', '2025-05-27 17:46:18'),
(8, 'Comments for Single: daisy.', '2025-05-27 17:46:18'),
(9, 'Comments for Single: nouvelle vague', '2025-05-27 17:46:18'),
(10, 'Comments for Single: calla', '2025-05-27 17:46:18'),
(11, 'Comments for Single: dried flower', '2025-05-27 17:46:18'),
(12, 'Comments for EP: wave 0.01', '2025-05-27 17:46:18'),
(13, 'Comments for EP: summer flows 0.02', '2025-05-27 17:46:18'),
(14, 'Comments for Album: 0.1 flaws and all.', '2025-05-27 17:46:18'),
(15, 'Comments for Album: play with earth! 0.03', '2025-05-27 17:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `forum_follow`
--

CREATE TABLE `forum_follow` (
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_follow` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_follow`
--

INSERT INTO `forum_follow` (`forum_id`, `user_id`, `date_follow`) VALUES
(1, 1, '2025-05-06 21:19:09'),
(1, 2, '2025-05-06 21:19:09'),
(1, 6, '2025-05-30 19:50:35'),
(2, 1, '2025-05-06 21:19:09'),
(2, 7, '2025-05-30 19:50:35'),
(3, 3, '2025-05-06 21:19:09'),
(3, 8, '2025-05-30 19:50:35'),
(4, 3, '2025-05-11 10:01:00'),
(14, 2, '2025-05-10 09:00:00'),
(14, 3, '2025-05-11 10:00:00'),
(15, 2, '2025-05-10 09:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `forum_posting`
--

CREATE TABLE `forum_posting` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_posting`
--

INSERT INTO `forum_posting` (`post_id`, `user_id`, `forum_id`, `content`, `date_posted`) VALUES
(1, 1, 1, 'What do you all think of the \"0.1 Flaws and All\" album?', '2025-05-06 21:19:09'),
(2, 2, 2, 'Seoul 2023 show was incredible! Who else was there?', '2025-05-06 21:19:09'),
(4, 1, 4, 'dsa', '2025-05-27 17:46:34'),
(5, 1, 4, 'dsadsa', '2025-05-27 17:46:36'),
(6, 1, 4, 'dadasda', '2025-05-27 18:21:28'),
(7, 1, 4, 'dsafsadsad', '2025-05-27 18:21:30'),
(8, 1, 11, 'dsadsad', '2025-05-27 18:21:34'),
(9, 1, 10, 'dsadsa', '2025-05-27 18:21:44'),
(10, 1, 4, 'dsadasad', '2025-05-27 18:23:01'),
(11, 4, 5, 'dsa', '2025-05-27 19:34:54'),
(13, 4, 1, 'dasdsadsa', '2025-05-27 19:58:27'),
(14, 4, 1, 'dsadsa', '2025-05-27 19:58:33'),
(15, 4, 1, 'sdadasdasdasad', '2025-05-27 19:58:41'),
(16, 4, 15, 'dsa', '2025-05-27 22:02:50'),
(17, 5, 4, 'dsadsa', '2025-05-27 22:30:59'),
(18, 5, 3, 'dsadsadsa', '2025-05-27 22:31:10'),
(20, 6, 1, 'Buy cheap merchandise here! [spam link]', '2025-05-15 10:00:00'),
(21, 7, 2, 'This concert was terrible! Everyone who liked it is stupid!', '2025-05-16 11:30:00'),
(22, 8, 3, 'Check out these deals! [spam link]', '2025-05-17 09:15:00'),
(23, 2, 1, 'The production quality on \"0.1 Flaws and All\" is incredible! Especially the bass lines.', '2025-05-10 14:30:00'),
(24, 2, 3, 'Just finished my cover of \"wave\" - what do you think?', '2025-05-12 16:45:00'),
(25, 2, 14, 'The bridge section in track 3 is pure genius!', '2025-05-15 09:20:00'),
(26, 3, 2, 'The Tokyo concert was mind-blowing! That light show during \"surf.\" was amazing!', '2025-05-08 20:15:00'),
(27, 3, 15, 'This album really shows their growth as artists.', '2025-05-11 11:30:00'),
(28, 3, 4, 'wave is definitely their best single so far.', '2025-05-13 13:25:00'),
(29, 5, 1, 'Check out these fake concert tickets! [removed]', '2025-05-07 08:00:00'),
(30, 5, 2, 'This band is terrible! Everyone here has bad taste! [toxic comment]', '2025-05-09 10:15:00'),
(31, 2, 1, 'The production on \"pueblo\" in the new album is incredible! The way they mixed traditional instruments with electronic elements is genius.', '2025-05-15 13:45:00'),
(32, 3, 1, 'Anyone notice the callback to \"wave\" in track 5? Such a nice touch!', '2025-05-15 14:20:00'),
(33, 4, 1, 'The lyrics in \"0.1 Flaws and All\" are so much more personal than their previous works.', '2025-05-16 09:30:00'),
(34, 2, 2, 'That moment when they performed \"surf.\" with the water effects was breathtaking!', '2025-05-17 20:15:00'),
(35, 3, 2, 'London show was amazing! The acoustic version of \"dried flower\" had me in tears.', '2025-05-18 11:45:00'),
(36, 1, 2, 'Just got back from the NYC concert. The energy during \"nouvelle vague\" was unreal!', '2025-05-19 03:30:00'),
(37, 2, 3, 'Here\'s my piano cover of \"light\" - tried to give it a jazzy twist!', '2025-05-20 16:20:00'),
(38, 3, 3, 'Drew some fanart inspired by the \"daisy.\" music video - hope you like it!', '2025-05-21 14:10:00'),
(39, 4, 3, 'Made an orchestral arrangement of \"calla\" - took me a month to complete!', '2025-05-22 17:45:00'),
(40, 1, 4, 'The bridge section in \"wave\" hits different after seeing it live.', '2025-05-23 12:30:00'),
(41, 2, 5, '\"light\" has become their most streamed song! Well deserved!', '2025-05-24 09:15:00'),
(42, 3, 6, 'The choreography in \"surf.\" video must have been so challenging.', '2025-05-25 15:40:00'),
(43, 1, 14, 'Track listing for \"0.1 Flaws and All\" is perfect - the flow between songs is seamless.', '2025-05-26 11:20:00'),
(44, 2, 14, 'The hidden track after \"calla\" caught me by surprise! Such a beautiful outro.', '2025-05-26 13:45:00'),
(45, 3, 15, '\"play with earth! 0.03\" shows how much they\'ve grown as artists.', '2025-05-27 10:30:00'),
(46, 4, 15, 'The environmental message in this album is so important and well-executed.', '2025-05-27 14:15:00'),
(47, 1, 12, 'wave 0.01 was such a strong debut EP. You could already hear their signature sound.', '2025-05-28 16:50:00'),
(48, 2, 13, 'summer flows 0.02 perfectly captures that beach sunset vibe.', '2025-05-29 18:25:00'),
(49, 3, 13, 'The remix tracks on this EP are fire! Especially the nouvelle vague remix!', '2025-05-30 12:10:00'),
(50, 5, 1, 'CHEAP CONCERT TICKETS HERE! [spam link removed]', '2025-05-15 08:00:00'),
(51, 5, 2, 'This band is overrated! Everyone who likes them has no taste! [toxic comment]', '2025-05-16 09:15:00'),
(52, 5, 4, 'Buy followers and likes! Guaranteed real! [spam link removed]', '2025-05-17 10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profilepic` varchar(255) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `remember_token` varchar(64) DEFAULT NULL,
  `remember_token_expires` datetime DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `profilepic`, `role`, `remember_token`, `remember_token_expires`, `bio`) VALUES
(1, 'geri', 'asd123', 'fan01@w2e.com', NULL, 'admin', NULL, NULL, 'dsadasdasfsadasdfsa'),
(2, 'sunnyBeats', 'hashedpw2', 'sunny@w2e.com', NULL, 'member', NULL, NULL, 'fsadasfasfqwe'),
(3, 'jazzyWave', 'hashedpw3', 'jazzy@w2e.com', NULL, 'member', NULL, NULL, 'fsadfasfasfsada'),
(4, 'garry', '$2y$10$QG9dkR/Hj.BDxUR6J.p5W.5SQZSzxsVo0EKCYFBBZAOnpTmhLrWQW', 'geri@geri.com', 'default.png', 'admin', '9e76c4f4b266a00a1af5036d056835cfafc6f54e24cdd701b90c9d8d0d55f354', '2025-05-30 15:20:35', 'dsasdasd'),
(5, 'nikoniko', '$2y$10$Pogbw8xEpfoOzd.sugLybuhG2U8lIIgWzEbvidybREC5vdCkM3cza', 'feadsadsa@dsa.csda', 'default.png', 'banned', NULL, NULL, 'dsadsa'),
(6, 'spammer123', '$2y$10$QG9dkR/Hj.BDxUR6J.p5W.5SQZSzxsVo0EKCYFBBZAOnpTmhLrWQW', 'spam@example.com', 'default.png', 'banned', NULL, NULL, 'Banned for spamming'),
(7, 'toxicFan', '$2y$10$QG9dkR/Hj.BDxUR6J.p5W.5SQZSzxsVo0EKCYFBBZAOnpTmhLrWQW', 'toxic@example.com', 'default.png', 'banned', NULL, NULL, 'Banned for toxic behavior'),
(8, 'botAccount', '$2y$10$QG9dkR/Hj.BDxUR6J.p5W.5SQZSzxsVo0EKCYFBBZAOnpTmhLrWQW', 'bot@example.com', 'default.png', 'banned', NULL, NULL, 'Automated spam account'),
(9, 'spamBot99', '$2y$10$QG9dkR/Hj.BDxUR6J.p5W.5SQZSzxsVo0EKCYFBBZAOnpTmhLrWQW', 'spam99@fake.com', 'default.png', 'member', NULL, NULL, 'Banned for automated spamming'),
(10, 'toxicTroll', '$2y$10$QG9dkR/Hj.BDxUR6J.p5W.5SQZSzxsVo0EKCYFBBZAOnpTmhLrWQW', 'troll@mail.com', 'default.png', 'banned', NULL, NULL, 'Multiple violations of community guidelines'),
(11, 'adSpammer', '$2y$10$QG9dkR/Hj.BDxUR6J.p5W.5SQZSzxsVo0EKCYFBBZAOnpTmhLrWQW', 'ads@spam.com', 'default.png', 'banned', NULL, NULL, 'Commercial spam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`post_id`,`attachment`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`user_id`,`id_follow`),
  ADD KEY `id_follow` (`id_follow`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`forum_id`);

--
-- Indexes for table `forum_follow`
--
ALTER TABLE `forum_follow`
  ADD PRIMARY KEY (`forum_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `forum_posting`
--
ALTER TABLE `forum_posting`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `remember_token` (`remember_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `forum_posting`
--
ALTER TABLE `forum_posting`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachment`
--
ALTER TABLE `attachment`
  ADD CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `forum_posting` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`id_follow`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_follow`
--
ALTER TABLE `forum_follow`
  ADD CONSTRAINT `forum_follow_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`forum_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_follow_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_posting`
--
ALTER TABLE `forum_posting`
  ADD CONSTRAINT `forum_posting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_posting_ibfk_2` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`forum_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
