-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 16, 2020 at 08:07 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies_share`
--

-- --------------------------------------------------------

--
-- Table structure for table `categ`
--

DROP TABLE IF EXISTS `categ`;
CREATE TABLE IF NOT EXISTS `categ` (
  `categ_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(60) NOT NULL,
  PRIMARY KEY (`categ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categ`
--

INSERT INTO `categ` (`categ_id`, `genre`) VALUES
(1, 'Horror'),
(2, 'Science-Fiction'),
(3, 'Action'),
(4, 'War'),
(5, 'Drama'),
(6, 'Thriller'),
(7, 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `release_date` date NOT NULL,
  `synopsis` varchar(250) NOT NULL,
  `poster` varchar(60) NOT NULL,
  `categ_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`movie_id`),
  KEY `categ_id` (`categ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `release_date`, `synopsis`, `poster`, `categ_id`) VALUES
(9, 'Alien', '1979-06-22', 'After a space merchant vessel receives an unknown transmission as a distress call, one of the crew is attacked by a mysterious life form and they soon realize that its life cycle has merely begun.', 'alien.jpg', 1),
(10, 'Blade Runner', '1982-06-25', 'A blade runner must pursue and terminate four replicants who stole a ship in space, and have returned to Earth to find their creator.', 'blade_runner.jpg', 2),
(11, 'Prometheus', '2012-06-08', 'Following clues to the origin of mankind, a team finds a structure on a distant moon, but they soon realize they are not alone.', 'prometheus.jpg', 1),
(12, 'Black Hawk Down', '2002-06-18', '160 elite U.S. soldiers drop into Somalia to capture two top lieutenants of a renegade warlord and find themselves in a desperate battle with a large force of heavily-armed Somalis.', 'black_hawk_down.jpg', 4),
(13, 'Parasite', '2019-06-05', 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.', 'parasite.jpg', 5),
(14, 'Memories of Murder', '2003-05-02', 'In a small Korean province in 1986, two detectives struggle with the case of multiple young women being found raped and murdered by an unknown culprit.', 'memories_of_murder.jpg', 6),
(15, 'Snowpiercer', '2014-07-11', 'In a future where a failed climate-change experiment has killed all life except for the lucky few who boarded the Snowpiercer, a train that travels around the globe, a new class system emerges.', 'snowpiercer.jpg', 3),
(16, 'The Host', '2007-03-30', 'A monster emerges from Seoul\'s Han River and begins attacking people. One victim\'s loving family does what it can to rescue her from its clutches.', 'the_host.jpg', 5),
(17, 'Jurassic Park', '1993-06-11', 'A pragmatic paleontologist visiting an almost complete theme park is tasked with protecting a couple of kids after a power failure causes the park\'s cloned dinosaurs to run loose.', 'jurrassic_park.jpg', 7),
(18, 'E.T. the Extra-Terrestial', '1982-06-11', 'A troubled child summons the courage to help a friendly alien escape Earth and return to his home world.', 'e_t.jpg', 2),
(19, 'Ready Player One', '2018-03-29', 'When the creator of a virtual reality called the OASIS dies, he makes a posthumous challenge to all OASIS users to find his Easter Egg, which will give the finder his fortune and control of his world.', 'ready_player_one.jpg', 2),
(20, 'Jaws', '1975-06-20', 'When a killer shark unleashes chaos on a beach community, it\'s up to a local sheriff, a marine biologist, and an old seafarer to hunt the beast down.', 'jaws.jpg', 1),
(21, 'Avatar', '2009-12-18', 'A paraplegic Marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.', 'avatar.jpg', 2),
(22, 'Aliens', '1986-07-18', 'Ellen Ripley is rescued by a deep salvage team after being in hypersleep for 57 years. The moon that the Nostromo visited has been colonized, but contact is lost. This time, colonial marines have impressive firepower, but will that be enough?', 'aliens.jpg', 1),
(23, 'Alita : Battle Angel', '2019-02-14', 'A deactivated cyborg is revived, but cannot remember anything of her past life and goes on a quest to find out who she is.', 'battle_angel_alita.jpg', 2),
(24, 'Abyss', '1989-08-09', 'A civilian diving team is enlisted to search for a lost nuclear submarine and face danger while encountering an alien aquatic species.', 'abyss.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
CREATE TABLE IF NOT EXISTS `playlists` (
  `playlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `creation_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`playlist_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`playlist_id`, `name`, `creation_date`, `user_id`) VALUES
(3, 'myPlaylist', '2020-07-16', 4),
(4, 'test', '2020-07-16', 4),
(5, 'test', '2020-07-16', 5);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_content`
--

DROP TABLE IF EXISTS `playlist_content`;
CREATE TABLE IF NOT EXISTS `playlist_content` (
  `playlist_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  KEY `movie_id` (`movie_id`),
  KEY `playlist_id` (`playlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlist_content`
--

INSERT INTO `playlist_content` (`playlist_id`, `movie_id`) VALUES
(3, 9),
(3, 10),
(3, 24),
(4, 23),
(4, 22),
(4, 15),
(5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `admin` enum('no','yes') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `admin`) VALUES
(4, 'matthieu.barbie@gmail.com', '$2y$10$LS9Lu1vzgpB/e8XAMruwHesr30UDnjCLTEZQd763r3vY9xHe0N1Mu', 'matthieu', 'barbiÃ©', 'yes'),
(5, 'test@test.com', '$2y$10$NqIsfi8atqS6Yi3RZCaC9OqJa5MXYM8DKfU.nUQRpXTcLAFjAW1JC', 'test', 'test', 'no');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`categ_id`) REFERENCES `categ` (`categ_id`);

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `playlist_content`
--
ALTER TABLE `playlist_content`
  ADD CONSTRAINT `playlist_content_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `playlist_content_ibfk_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`playlist_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
