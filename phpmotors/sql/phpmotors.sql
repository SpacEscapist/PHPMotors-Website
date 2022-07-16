-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2022 at 07:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
--
-- Database: `phpmotors`
--
-- --------------------------------------------------------
--
-- Table structure for table `carclassification`
--
CREATE TABLE `carclassification` (
    `classificationId` int(11) NOT NULL,
    `classificationName` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `carclassification`
--
INSERT INTO `carclassification` (`classificationId`, `classificationName`)
VALUES (1, 'SUV'),
    (2, 'Classic'),
    (3, 'Sports'),
    (4, 'Trucks'),
    (5, 'Used');
-- --------------------------------------------------------
--
-- Table structure for table `clients`
--
CREATE TABLE `clients` (
    `clientId` int(10) UNSIGNED NOT NULL,
    `clientFirstname` varchar(15) NOT NULL,
    `clientLastname` varchar(25) NOT NULL,
    `clientEmail` varchar(40) NOT NULL,
    `clientPassword` varchar(255) NOT NULL,
    `clientLevel` enum('1', '2', '3') NOT NULL DEFAULT '1',
    `comment` text DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `clients`
--
INSERT INTO `clients` (
        `clientId`,
        `clientFirstname`,
        `clientLastname`,
        `clientEmail`,
        `clientPassword`,
        `clientLevel`,
        `comment`
    )
VALUES (
        18,
        'test-first',
        'test-last',
        'test@test.com',
        '$2y$10$Ya9klI.CCeGNjNs3AsKiVuIqKgedp.z1qUDhImEoHGYDBFYbW2NXW',
        '1',
        NULL
    ),
    (
        19,
        'Billy',
        'Bob',
        'billybob@hillbilly.com',
        '$2y$10$K6TJaPiWElbppCbmR4UM2ugGFo44JoyE6YhFubAYka3c.JOWPa6tC',
        '1',
        NULL
    ),
    (
        20,
        'Darth',
        'Vader',
        'vader@deathstar.net',
        '$2y$10$ttZjJRHzytDCfbNMAk3SK.sM72TZKTQ39cqN4C4fgs1OA8ciYUXr6',
        '1',
        NULL
    ),
    (
        21,
        'Admin',
        'User',
        'admin@admin.com',
        '$2y$10$2tzruASTsEC9U8Uh3oxTdeecvc4BSyGTp3tC5PuNjNssZf3cRnliq',
        '3',
        NULL
    ),
    (
        22,
        'Test1',
        'Test2',
        'abc@123.com',
        '$2y$10$GRWFkYomeiSo7CBS6HdrxOKsI2Bktx7wfQcZXD0EKS5ABG5MEXkFO',
        '1',
        NULL
    );
-- --------------------------------------------------------
--
-- Table structure for table `images`
--
CREATE TABLE `images` (
    `imgId` int(11) NOT NULL,
    `invId` int(10) UNSIGNED NOT NULL,
    `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
    `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
    `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
    `imgPrimary` tinyint(4) NOT NULL DEFAULT 0
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `images`
--
INSERT INTO `images` (
        `imgId`,
        `invId`,
        `imgName`,
        `imgPath`,
        `imgDate`,
        `imgPrimary`
    )
VALUES (
        31,
        1,
        'wrangler.jpg',
        '/phpmotors/images/vehicles/wrangler.jpg',
        '2022-06-30 22:56:03',
        1
    ),
    (
        32,
        1,
        'wrangler-tn.jpg',
        '/phpmotors/images/vehicles/wrangler-tn.jpg',
        '2022-06-30 22:56:03',
        1
    ),
    (
        33,
        2,
        'ford-modelt.jpg',
        '/phpmotors/images/vehicles/ford-modelt.jpg',
        '2022-06-30 22:56:30',
        1
    ),
    (
        34,
        2,
        'ford-modelt-tn.jpg',
        '/phpmotors/images/vehicles/ford-modelt-tn.jpg',
        '2022-06-30 22:56:30',
        1
    ),
    (
        35,
        3,
        'lambo-Adve.jpg',
        '/phpmotors/images/vehicles/lambo-Adve.jpg',
        '2022-06-30 22:56:48',
        1
    ),
    (
        36,
        3,
        'lambo-Adve-tn.jpg',
        '/phpmotors/images/vehicles/lambo-Adve-tn.jpg',
        '2022-06-30 22:56:48',
        1
    ),
    (
        37,
        4,
        'monster.jpg',
        '/phpmotors/images/vehicles/monster.jpg',
        '2022-06-30 22:56:56',
        1
    ),
    (
        38,
        4,
        'monster-tn.jpg',
        '/phpmotors/images/vehicles/monster-tn.jpg',
        '2022-06-30 22:56:56',
        1
    ),
    (
        39,
        5,
        'ms.jpg',
        '/phpmotors/images/vehicles/ms.jpg',
        '2022-06-30 22:57:06',
        1
    ),
    (
        40,
        5,
        'ms-tn.jpg',
        '/phpmotors/images/vehicles/ms-tn.jpg',
        '2022-06-30 22:57:06',
        1
    ),
    (
        41,
        6,
        'bat.jpg',
        '/phpmotors/images/vehicles/bat.jpg',
        '2022-06-30 22:57:25',
        1
    ),
    (
        42,
        6,
        'bat-tn.jpg',
        '/phpmotors/images/vehicles/bat-tn.jpg',
        '2022-06-30 22:57:25',
        1
    ),
    (
        43,
        7,
        'mm.jpg',
        '/phpmotors/images/vehicles/mm.jpg',
        '2022-06-30 22:57:33',
        1
    ),
    (
        44,
        7,
        'mm-tn.jpg',
        '/phpmotors/images/vehicles/mm-tn.jpg',
        '2022-06-30 22:57:33',
        1
    ),
    (
        45,
        8,
        'fire-truck.jpg',
        '/phpmotors/images/vehicles/fire-truck.jpg',
        '2022-06-30 22:57:41',
        1
    ),
    (
        46,
        8,
        'fire-truck-tn.jpg',
        '/phpmotors/images/vehicles/fire-truck-tn.jpg',
        '2022-06-30 22:57:41',
        1
    ),
    (
        47,
        9,
        'crown-vic.jpg',
        '/phpmotors/images/vehicles/crown-vic.jpg',
        '2022-06-30 22:57:51',
        1
    ),
    (
        48,
        9,
        'crown-vic-tn.jpg',
        '/phpmotors/images/vehicles/crown-vic-tn.jpg',
        '2022-06-30 22:57:51',
        1
    ),
    (
        49,
        10,
        'camaro.jpg',
        '/phpmotors/images/vehicles/camaro.jpg',
        '2022-06-30 22:58:00',
        1
    ),
    (
        50,
        10,
        'camaro-tn.jpg',
        '/phpmotors/images/vehicles/camaro-tn.jpg',
        '2022-06-30 22:58:00',
        1
    ),
    (
        51,
        11,
        'escalade.jpg',
        '/phpmotors/images/vehicles/escalade.jpg',
        '2022-06-30 22:58:09',
        1
    ),
    (
        52,
        11,
        'escalade-tn.jpg',
        '/phpmotors/images/vehicles/escalade-tn.jpg',
        '2022-06-30 22:58:09',
        1
    ),
    (
        53,
        12,
        'hummer.jpg',
        '/phpmotors/images/vehicles/hummer.jpg',
        '2022-06-30 22:58:17',
        1
    ),
    (
        54,
        12,
        'hummer-tn.jpg',
        '/phpmotors/images/vehicles/hummer-tn.jpg',
        '2022-06-30 22:58:17',
        1
    ),
    (
        55,
        13,
        'aerocar.jpg',
        '/phpmotors/images/vehicles/aerocar.jpg',
        '2022-06-30 22:58:27',
        1
    ),
    (
        56,
        13,
        'aerocar-tn.jpg',
        '/phpmotors/images/vehicles/aerocar-tn.jpg',
        '2022-06-30 22:58:27',
        1
    ),
    (
        57,
        14,
        'fbi.jpg',
        '/phpmotors/images/vehicles/fbi.jpg',
        '2022-06-30 22:58:41',
        1
    ),
    (
        58,
        14,
        'fbi-tn.jpg',
        '/phpmotors/images/vehicles/fbi-tn.jpg',
        '2022-06-30 22:58:41',
        1
    ),
    (
        59,
        15,
        'no-image.png',
        '/phpmotors/images/vehicles/no-image.png',
        '2022-06-30 22:59:41',
        1
    ),
    (
        60,
        15,
        'no-image-tn.png',
        '/phpmotors/images/vehicles/no-image-tn.png',
        '2022-06-30 22:59:41',
        1
    ),
    (
        61,
        33,
        'delorean.jpg',
        '/phpmotors/images/vehicles/delorean.jpg',
        '2022-06-30 23:10:02',
        1
    ),
    (
        62,
        33,
        'delorean-tn.jpg',
        '/phpmotors/images/vehicles/delorean-tn.jpg',
        '2022-06-30 23:10:02',
        1
    ),
    (
        63,
        1,
        'wrangler2.jpg',
        '/phpmotors/images/vehicles/wrangler2.jpg',
        '2022-07-01 00:24:08',
        0
    ),
    (
        64,
        1,
        'wrangler2-tn.jpg',
        '/phpmotors/images/vehicles/wrangler2-tn.jpg',
        '2022-07-01 00:24:08',
        0
    ),
    (
        65,
        5,
        'ms2.jpg',
        '/phpmotors/images/vehicles/ms2.jpg',
        '2022-07-01 00:25:48',
        0
    ),
    (
        66,
        5,
        'ms2-tn.jpg',
        '/phpmotors/images/vehicles/ms2-tn.jpg',
        '2022-07-01 00:25:48',
        0
    ),
    (
        67,
        4,
        'monster2.jpg',
        '/phpmotors/images/vehicles/monster2.jpg',
        '2022-07-01 00:26:04',
        0
    ),
    (
        68,
        4,
        'monster2-tn.jpg',
        '/phpmotors/images/vehicles/monster2-tn.jpg',
        '2022-07-01 00:26:04',
        0
    );
-- --------------------------------------------------------
--
-- Table structure for table `inventory`
--
CREATE TABLE `inventory` (
    `invId` int(10) UNSIGNED NOT NULL,
    `invMake` varchar(30) NOT NULL,
    `invModel` varchar(30) NOT NULL,
    `invDescription` text NOT NULL,
    `invImage` varchar(50) NOT NULL,
    `invThumbnail` varchar(50) NOT NULL,
    `invPrice` decimal(10, 0) NOT NULL,
    `invStock` smallint(6) NOT NULL,
    `invColor` varchar(20) NOT NULL,
    `classificationId` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `inventory`
--
INSERT INTO `inventory` (
        `invId`,
        `invMake`,
        `invModel`,
        `invDescription`,
        `invImage`,
        `invThumbnail`,
        `invPrice`,
        `invStock`,
        `invColor`,
        `classificationId`
    )
VALUES (
        1,
        'Jeep ',
        'Wrangler',
        'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!',
        '/phpmotors/images/vehicles/wrangler.jpg',
        '/phpmotors/images/vehicles/wrangler-tn.jpg',
        '28045',
        4,
        'Orange',
        1
    ),
    (
        2,
        'Ford',
        'Model T',
        'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.',
        '/phpmotors/images/vehicles/ford-modelt.jpg',
        '/phpmotors/images/vehicles/ford-modelt-tn.jpg',
        '30000',
        2,
        'Black',
        2
    ),
    (
        3,
        'Lamborghini',
        'Adventador',
        'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.',
        '/phpmotors/images/vehicles/lambo-Adve.jpg',
        '/phpmotors/images/vehicles/lambo-Adve-tn.jpg',
        '417650',
        1,
        'Blue',
        3
    ),
    (
        4,
        'Monster',
        'Truck',
        'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.',
        '/phpmotors/images/vehicles/monster.jpg',
        '/phpmotors/images/vehicles/monster-tn.jpg',
        '150000',
        3,
        'purple',
        4
    ),
    (
        5,
        'Mechanic',
        'Special',
        'Not sure where this car came from. However, with a little tender loving care it will run as good a new.',
        '/phpmotors/images/vehicles/ms.jpg',
        '/phpmotors/images/vehicles/ms-tn.jpg',
        '100',
        1,
        'Rust',
        5
    ),
    (
        6,
        'Batmobile',
        'Custom',
        'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.',
        '/phpmotors/images/vehicles/bat.jpg',
        '/phpmotors/images/vehicles/bat-tn.jpg',
        '65000',
        1,
        'Black',
        3
    ),
    (
        7,
        'Mystery',
        'Machine',
        'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.',
        '/phpmotors/images/vehicles/mm.jpg',
        '/phpmotors/images/vehicles/mm-tn.jpg',
        '10000',
        12,
        'Green',
        1
    ),
    (
        8,
        'Spartan',
        'Fire Truck',
        'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.',
        '/phpmotors/images/vehicles/fire-truck.jpg',
        '/phpmotors/images/vehicles/fire-truck-tn.jpg',
        '50000',
        1,
        'Red',
        4
    ),
    (
        9,
        'Ford',
        'Crown Victoria',
        'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.',
        '/phpmotors/images/vehicles/crown-vic.jpg',
        '/phpmotors/images/vehicles/crown-vic-tn.jpg',
        '10000',
        5,
        'White',
        5
    ),
    (
        10,
        'Chevy',
        'Camaro',
        'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!',
        '/phpmotors/images/vehicles/camaro.jpg',
        '/phpmotors/images/vehicles/camaro-tn.jpg',
        '22000',
        10,
        'Silver',
        3
    ),
    (
        11,
        'Cadillac',
        'Escalade',
        'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.',
        '/phpmotors/images/vehicles/escalade.jpg',
        '/phpmotors/images/vehicles/escalade-tn.jpg',
        '75195',
        4,
        'Black',
        1
    ),
    (
        12,
        'GM',
        'Hummer',
        'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.',
        '/phpmotors/images/vehicles/hummer.jpg',
        '/phpmotors/images/vehicles/hummer-tn.jpg',
        '58800',
        5,
        'Yellow',
        5
    ),
    (
        13,
        'Aerocar International',
        'Aerocar',
        'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!',
        '/phpmotors/images/vehicles/aerocar.jpg',
        '/phpmotors/images/vehicles/aerocar-tn.jpg',
        '1000000',
        1,
        'Red',
        2
    ),
    (
        14,
        'FBI',
        'Surveillance Van',
        'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ',
        '/phpmotors/images/vehicles/fbi.jpg',
        '/phpmotors/images/vehicles/fbi-tn.jpg',
        '20000',
        1,
        'Green',
        1
    ),
    (
        15,
        'Dog ',
        'Car',
        'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.',
        '/phpmotors/images/vehicles/no-image.png',
        '/phpmotors/images/vehicles/no-image-tn.png',
        '35000',
        1,
        'Brown',
        2
    ),
    (
        33,
        'DMC',
        'DeLorean',
        'So fast, it&#039;s almost like traveling through time!',
        '/phpmotors/images/vehicles/delorean.jpg',
        '/phpmotors/images/vehicles/delorean-tn.jpg',
        '85000',
        1,
        'Silver',
        2
    );
-- --------------------------------------------------------
--
-- Table structure for table `reviews`
--
CREATE TABLE `reviews` (
    `reviewId` int(10) UNSIGNED NOT NULL,
    `reviewText` text CHARACTER SET latin1 NOT NULL,
    `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
    `invId` int(10) UNSIGNED NOT NULL,
    `clientId` int(10) UNSIGNED NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `reviews`
--
INSERT INTO `reviews` (
        `reviewId`,
        `reviewText`,
        `reviewDate`,
        `invId`,
        `clientId`
    )
VALUES (
        2,
        'This car can really fly!',
        '2022-07-11 01:22:53',
        33,
        21
    ),
    (
        14,
        'Vader&#039;s Mystery Machine review',
        '2022-07-11 00:22:52',
        7,
        20
    ),
    (16, 'test', '2022-07-11 18:24:24', 6, 20),
    (17, 'Another test', '2022-07-11 19:49:52', 7, 20),
    (
        18,
        'Batmobile Review here!',
        '2022-07-11 20:02:59',
        6,
        20
    ),
    (
        19,
        'Admin review of Batmobile',
        '2022-07-11 23:07:04',
        6,
        21
    ),
    (
        20,
        'A new review! I think...',
        '2022-07-12 16:12:53',
        6,
        21
    ),
    (
        21,
        'THIS IS A TEAM REVIEW!!',
        '2022-07-15 20:17:00',
        6,
        21
    );
--
-- Indexes for dumped tables
--
--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
ADD PRIMARY KEY (`classificationId`);
--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
ADD PRIMARY KEY (`clientId`),
    ADD UNIQUE KEY `clientEmail` (`clientEmail`);
--
-- Indexes for table `images`
--
ALTER TABLE `images`
ADD PRIMARY KEY (`imgId`),
    ADD KEY `invId` (`invId`);
--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
ADD PRIMARY KEY (`invId`),
    ADD KEY `classificationId` (`classificationId`);
--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
ADD PRIMARY KEY (`reviewId`),
    ADD KEY `invId` (`invId`),
    ADD KEY `clientId` (`clientId`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 54;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 23;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 75;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 35;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 22;
--
-- Constraints for dumped tables
--
--
-- Constraints for table `images`
--
ALTER TABLE `images`
ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);
--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;