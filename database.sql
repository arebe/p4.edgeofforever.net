-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2013 at 10:35 PM
-- Server version: 5.1.70-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `edgeoffo_p4_edgeofforever_net`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `post_id` int(11) NOT NULL COMMENT 'fk',
  `user_id` int(11) NOT NULL COMMENT 'fk',
  `content` text NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `created`, `post_id`, `user_id`, `content`) VALUES
(32, 1387168634, 10, 15, 'boots and cats aint got nuthin on it'),
(33, 1387214225, 10, 16, '<script>alert(\\''Injected!\\'');</script> '),
(34, 1387341733, 17, 15, 'figment 2011 SB stage hehehehehehehhhhh');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'fk',
  `content` text NOT NULL,
  `photo_url` text NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `created`, `modified`, `user_id`, `content`, `photo_url`) VALUES
(10, 1387168612, 1387168612, 15, 'the best of all possible worlds', 'http://www.alittlebeat.com/wp-content/uploads/2013/11/skweee-620x310.jpg'),
(11, 1387253026, 1387253026, 17, 'large', 'http://upload.wikimedia.org/wikipedia/commons/c/c2/Space_Needle_panorama_large.jpg'),
(12, 1387340817, 1387340817, 15, 'old skool derp #1: concert hands', 'https://dl.dropboxusercontent.com/u/7024127/hands-3404.jpg'),
(13, 1387340927, 1387340927, 15, 'old skool derp #2: roadside collection', 'https://dl.dropboxusercontent.com/u/7024127/_MG_1305-20071215.jpg'),
(14, 1387341048, 1387341048, 15, 'old skool derp #3: abandoned amusements', 'https://dl.dropboxusercontent.com/u/7024127/IMG_172720071215.jpg'),
(15, 1387341127, 1387341127, 15, 'old skool derp #4: spring rites', 'https://dl.dropboxusercontent.com/u/7024127/arbor-6862.jpg'),
(16, 1387341184, 1387341184, 15, 'old skool derp #5: duck duck goose', 'https://dl.dropboxusercontent.com/u/7024127/bm11-2274.jpg'),
(17, 1387341646, 1387341646, 15, 'old skool bonus derp: nick + nick + sub', 'https://dl.dropboxusercontent.com/u/7024127/fig11-7119.jpg'),
(18, 1387766419, 1387766419, 20, 'subway marks', 'http://www.scaredycatfilms.com/photos/gallery/subway/subway2b_med.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `timezone` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_pic` text NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created`, `modified`, `token`, `password`, `last_login`, `timezone`, `first_name`, `last_name`, `email`, `profile_pic`) VALUES
(11, 1383675836, 1383675836, '849cd8cd01a99d778b3d886cbe2c90401ed34cf6', '8e2ff26b717127ca2c4fe2c0638ad5c106f7c439', 0, 0, 'nyan', 'cat', 'nyan', '/uploads/avatars/example.gif'),
(12, 1387144208, 1387144208, '1b367e2527cc56e4cd0a87f895f688e67ce10e02', '427e33251818f1c43c04ae0ee7be32406ae8de82', 0, 0, 'mike', 'mike', 'mike@mike.com', '/uploads/avatars/example.gif'),
(15, 1387168553, 1387168553, '11526ecf8303007e4aff0cee06a1536323c4e15f', '1864f2e9c85ae4d31cf44c4018ebb65172202c72', 0, 0, 'Sticky', 'Step', 'skweee@com.com', '/uploads/avatars/profile-15.jpg'),
(16, 1387214167, 1387214167, 'fae2f9a43ad2ba22e02fefb2008f3593cf2f4b10', '1864f2e9c85ae4d31cf44c4018ebb65172202c72', 0, 0, 'R', 'B', 'rb@rb.com', '/uploads/avatars/example.gif'),
(17, 1387252924, 1387252924, '9863ad830fe55058b4c68b871af213b8dd3fb48b', 'b624f89662f5e1a4bf8650bde9bb4d46f19a344c', 0, 0, 'zip', 'lock', 'm4xst3r@gmail.com', '/uploads/avatars/profile-17.jpg'),
(18, 1387560566, 1387560566, '2b6f3d2ebf97173fbf68e797585f245b1ef8e643', '39916feb3697a373c2b845e7bf10a717b7a021ac', 0, 0, 'test', 'test', 'test@test.com', '/uploads/avatars/example.gif'),
(19, 1387600925, 1387600925, '15745c8016638cf6e400deeef66bd05af08967ae', '4c12bbf8840d8f09f864790c3e7e180385533748', 0, 0, 'gf', 'gdf', 'gdfgd@fff.com', '/uploads/avatars/profile-19'),
(20, 1387744415, 1387744415, '9a80c4c609cefe83d2ddda0bfe9f808fc509a8a5', '1864f2e9c85ae4d31cf44c4018ebb65172202c72', 0, 0, 'Spook', '', 'spookeriffic@gmail.com', '/uploads/avatars/profile-20.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users_users`
--

CREATE TABLE IF NOT EXISTS `users_users` (
  `user_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'FK follower',
  `user_id_followed` int(11) NOT NULL COMMENT 'followed',
  PRIMARY KEY (`user_user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `users_users`
--

INSERT INTO `users_users` (`user_user_id`, `created`, `user_id`, `user_id_followed`) VALUES
(2, 1383693996, 11, 11),
(4, 1383693998, 11, 6),
(5, 1383693999, 11, 5),
(6, 1383694003, 11, 7),
(7, 1383694113, 11, 1),
(8, 1387144275, 12, 11),
(9, 1387144276, 12, 9),
(10, 1387144277, 12, 8),
(11, 1387144279, 12, 7),
(12, 1387144281, 12, 6),
(13, 1387144283, 12, 5),
(14, 1387144284, 12, 4),
(15, 1387144286, 12, 12),
(16, 1387169203, 15, 15),
(17, 1387214191, 16, 15),
(18, 1387214192, 16, 12),
(19, 1387214194, 16, 8),
(20, 1387214195, 16, 6),
(21, 1387253071, 17, 4),
(22, 1387253071, 17, 5),
(23, 1387253071, 17, 6),
(24, 1387253072, 17, 7),
(25, 1387253073, 17, 8),
(26, 1387253075, 17, 11),
(27, 1387253077, 17, 13),
(28, 1387253078, 17, 15),
(29, 1387253079, 17, 16),
(30, 1387253082, 17, 14),
(31, 1387253086, 17, 17),
(32, 1387253090, 17, 9),
(33, 1387253095, 17, 12),
(34, 1387341251, 15, 17),
(35, 1387341253, 15, 12),
(36, 1387341255, 15, 9),
(37, 1387341256, 15, 7),
(38, 1387560566, 18, 18),
(39, 1387560587, 18, 11),
(40, 1387560599, 18, 9),
(41, 1387560600, 18, 7),
(42, 1387560602, 18, 5),
(43, 1387600926, 19, 19),
(44, 1387744415, 20, 20),
(45, 1387744430, 20, 15),
(46, 1387761359, 17, 18),
(47, 1387761361, 17, 19),
(48, 1387761363, 17, 20);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_users`
--
ALTER TABLE `users_users`
  ADD CONSTRAINT `users_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
