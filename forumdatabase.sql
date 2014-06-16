--
-- Table structure for table `forum_main`
--

CREATE TABLE `forum_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastpost` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT 'n/a',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forum_main`
--

INSERT INTO `forum_main` VALUES(1, 'Forum 1', 'description for forum 1', '');
INSERT INTO `forum_main` VALUES(2, 'Forum 2', 'description for forum 2', '');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topicid` int(11) NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `message` text COLLATE latin1_general_ci NOT NULL,
  `forum` int(11) NOT NULL,
  `created` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=19 ;


--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `starter` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastpost` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `forum` int(11) NOT NULL,
  `message` text COLLATE latin1_general_ci NOT NULL,
  `created` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `sticky` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;
