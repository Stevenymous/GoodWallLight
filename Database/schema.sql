-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
--
--              Structure
--
-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

-- -----------------------------------------------------
-- `person` table structure
-- -----------------------------------------------------
DROP TABLE IF EXISTS `person`;

CREATE TABLE IF NOT EXISTS `person` (
  `per_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,  
  `per_last_name` VARCHAR(50) NOT NULL,
  `per_first_name` VARCHAR(50) NOT NULL,
  `per_birth_date` DATETIME NOT NULL,
  `per_gender` TINYINT(1) UNSIGNED NULL DEFAULT NULL COMMENT '0 : female / 1 : male',
  `per_location` VARCHAR(150) NOT NULL,
  `per_about` VARCHAR(255) NULL DEFAULT NULL,
  `per_email` VARCHAR(50) NOT NULL,
  `per_password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`per_id`),
  UNIQUE `id_unique_email` (`per_email`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

-- -----------------------------------------------------
-- `school` table structure
-- -----------------------------------------------------
DROP TABLE IF EXISTS `school`;

CREATE TABLE IF NOT EXISTS `school` (
  `scl_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,  
  `scl_name` VARCHAR(150) NOT NULL,
  `scl_students_number` INT(10) UNSIGNED NULL DEFAULT NULL,
  `scl_teachers_number` INT(10) UNSIGNED NULL DEFAULT NULL,
  `scl_location` VARCHAR(150) NOT NULL,
  `scl_about` VARCHAR(255) NULL DEFAULT NULL,
  `scl_creation_date` DATETIME NOT NULL,
  `scl_director_fk_per_id` INT(10) UNSIGNED NOT NULL COMMENT 'ref to a person id',
  PRIMARY KEY (`scl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

-- -----------------------------------------------------
-- `company` table structure
-- -----------------------------------------------------
DROP TABLE IF EXISTS `company`;

CREATE TABLE IF NOT EXISTS `company` (
  `cny_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cny_name` VARCHAR(150) NOT NULL,
  `cny_location` VARCHAR(150) NOT NULL,
  `cny_creation_date` DATETIME NOT NULL,
  `cny_about` VARCHAR(255) NULL DEFAULT NULL,
  `cny_industry_sector` VARCHAR(255) NULL DEFAULT NULL,
  `cny_company_owner` VARCHAR(150) NOT NULL,
  `cny_fk_per_id` INT(10) UNSIGNED NOT NULL COMMENT 'ref the creator of this company',
  PRIMARY KEY (`cny_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

-- -----------------------------------------------------
-- `post` table structure
-- -----------------------------------------------------
DROP TABLE IF EXISTS `post`;

CREATE TABLE IF NOT EXISTS `post` (
  `post_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_date` DATETIME NOT NULL,
  `post_title` VARCHAR(150) NOT NULL,
  `post_content` VARCHAR(250) NOT NULL,
  `post_fk_per_id` INT(10) UNSIGNED NOT NULL COMMENT 'ref to a person id',
  PRIMARY KEY (`post_id`)
) ENGINE=INNODB AUTO_INCREMENT=1;

-- -----------------------------------------------------
-- `comment` table structure
-- ----------------------------------------------------
DROP TABLE IF EXISTS `comment`;

CREATE TABLE IF NOT EXISTS `comment` (
  `com_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `com_date` DATETIME NOT NULL,
  `com_author` VARCHAR(150) NOT NULL,
  `com_content` VARCHAR(140) NOT NULL COMMENT 'same as twitter!',
  `com_fk_post_id` INT(10) UNSIGNED NOT NULL COMMENT 'ref to a post id',
  `com_fk_per_id` INT(10) UNSIGNED NOT NULL COMMENT 'ref to a person id',
  PRIMARY KEY (`com_id`)
) ENGINE=INNODB AUTO_INCREMENT=1;

-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
--
--             Constraints
--
-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

--
-- `school` table constraint
--
ALTER TABLE `school`
  ADD CONSTRAINT `fk_school_person_director` FOREIGN KEY (`scl_director_fk_per_id`) REFERENCES `person` (`per_id`) ON UPDATE CASCADE;

--
-- `company` table constraint
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk_company_person_creator` FOREIGN KEY (`cny_fk_per_id`) REFERENCES `person` (`per_id`) ON UPDATE CASCADE;

--
-- `post` table constraint
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_per` FOREIGN KEY (`post_fk_per_id`) REFERENCES `person` (`per_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- `comment` table constraint
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_com_post` FOREIGN KEY (`com_fk_post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_com_per` FOREIGN KEY (`com_fk_per_id`) REFERENCES `person` (`per_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
--
--             Insert
--
-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

INSERT INTO `person` (`per_id`, `per_last_name`, `per_first_name`, `per_birth_date`, `per_gender`, `per_location`, `per_about`, `per_email`, `per_password`) VALUES
(1, 'GWL', 'Administrator', '2015-08-02 19:46:00', 1, 'Genève', 'Administrator', 'admin@goodwall.com', 'strongPassWordPlease!!'),
(2, 'Steven', 'MARTINS', '2015-08-02 19:46:00', 1, 'Clermont-Ferrand', 'Interest about new technologies, I want a career development that fully satisfy me', 'steven@live.com', 'bn:)'),
(3, 'Vador', 'DarkHanounoa', '1992-08-22 00:00:00', 0, 'Space', 'I''m a bad guy !', 'darkVador@space.com', '123');

INSERT INTO `school` (`scl_id`, `scl_name`, `scl_students_number`, `scl_teachers_number`, `scl_location`, `scl_about`, `scl_creation_date`, `scl_director_fk_per_id`) VALUES
(1, 'GW-L Developer School', 11, 10, 'Genève', 'Rated as one of the top schools in Switzerland, Goodwall helps everyone build their personal skills and developer career.', '2014-02-01 00:00:00', 2),
(2, 'Imperial Academy', 37550, 10000, 'Galactic Empire', 'The Imperial Academy was a military training program managed by the Galactic Empire which evolved from the Galactic Republic''s own Academy system.\r\nBy the end of the Clone Wars, the Academy was an elite educational institution that trained youths.', '1953-11-06 00:00:00', 3);

INSERT INTO `company` (`cny_id`, `cny_name`, `cny_location`, `cny_creation_date`, `cny_about`, `cny_industry_sector`, `cny_company_owner`, `cny_fk_per_id`) VALUES
(1, 'V''Jar Technologies ', 'Goroth Prime', '1951-01-19 00:00:00', 'Located in the Trans-Nebular Zone of the Trans-Nebular sector, Goroth was far away from regular, short or safe hyperspace routes, a fact which left the planet hidden from the rest of the galaxy for a long time.', 'Aerospace, defence, security ', 'V''Jar ', 3),
(2, 'Grand Imperial', 'Kaal', '1990-01-20 00:00:00', 'The Grand Imperial was a casino and hotel.Tirgee Benyalle owned it, and used it to host the meeting between Utoxx Prentioch, Kermen, Talon Karrde, and New Republic representatives to discuss export rights for Kaal''s aquaculture industry.', 'Entertainment, media', 'Tirgee Benyalle', 3);

INSERT INTO `post` (post_date, post_title, post_content, post_fk_per_id)
VALUES (NOW(), 'My first Post!', 'Hey everbody! Today I\'m registered in Good Wall Lite, the famous new application!', 2);

INSERT INTO `comment` (com_date, com_author, com_content, com_fk_post_id, com_fk_per_id)
VALUES (NOW(), 'GWL admin', 'Hello Steven :) What do you think of our application?', 1, 1);