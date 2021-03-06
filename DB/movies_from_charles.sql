-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 15, 2020 at 10:39 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`title`, `release_date`, `synopsis`, `poster`) VALUES
('Alien', '1979-06-22', 'After a space merchant vessel receives an unknown transmission as a distress call, one of the crew is attacked by a mysterious life form and they soon realize that its life cycle has merely begun.', 'alien.jpg'),
('Blade Runner', '1982-06-25', 'A blade runner must pursue and terminate four replicants who stole a ship in space, and have returned to Earth to find their creator.', 'blade_runner.jpg'),
('Prometheus', '2012-06-08', 'Following clues to the origin of mankind, a team finds a structure on a distant moon, but they soon realize they are not alone.', 'prometheus.jpg'),
('Black Hawk Down', '2002-06-18', '160 elite U.S. soldiers drop into Somalia to capture two top lieutenants of a renegade warlord and find themselves in a desperate battle with a large force of heavily-armed Somalis.', 'black_hawk_down.jpg'),
('Parasite', '2019-06-05', 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.', 'parasite.jpg'),
('Memories of Murder', '2003-05-02', 'In a small Korean province in 1986, two detectives struggle with the case of multiple young women being found raped and murdered by an unknown culprit.', 'memories_of_murder.jpg'),
('Snowpiercer', '2014-07-11', 'In a future where a failed climate-change experiment has killed all life except for the lucky few who boarded the Snowpiercer, a train that travels around the globe, a new class system emerges.', 'snowpiercer.jpg'),
('The Host', '2007-03-30', 'A monster emerges from Seoul\'s Han River and begins attacking people. One victim\'s loving family does what it can to rescue her from its clutches.', 'the_host.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`categ_id`) REFERENCES `categ` (`categ_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
