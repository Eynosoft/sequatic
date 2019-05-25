/*
Navicat MySQL Data Transfer

Source Server         : ubuntu
Source Server Version : 50529
Source Host           : ubuntu:3306
Source Database       : seaquatic_db

Target Server Type    : MYSQL
Target Server Version : 50529
File Encoding         : 65001

Date: 2017-06-29 15:06:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for directory_files
-- ----------------------------
DROP TABLE IF EXISTS `directory_files`;
CREATE TABLE `directory_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `directory_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_title` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of directory_files
-- ----------------------------
INSERT INTO `directory_files` VALUES ('1', '7', '/images/5/test/96720.jpg', '96720.jpg', '2017-06-29 07:34:57', '2017-06-29 07:34:57');
INSERT INTO `directory_files` VALUES ('2', '11', '/images/5/upload-file/66286.jpg', '66286.jpg', '2017-06-29 07:35:16', '2017-06-29 07:35:16');

-- ----------------------------
-- Table structure for inquiries
-- ----------------------------
DROP TABLE IF EXISTS `inquiries`;
CREATE TABLE `inquiries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inquiry_type` enum('General','Quotation') COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive','deleted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `lead_value` enum('Hot','Warm','Medium','Cold') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `quote_inquiry_status` enum('Pending','Submitted','Estimating','Won','Lost') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `general_inquiry_status` enum('Pending','Escalated','Solved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inquiries_country_id_foreign` (`country_id`),
  CONSTRAINT `inquiries_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `master_countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of inquiries
-- ----------------------------
INSERT INTO `inquiries` VALUES ('1', 'Mahi', 'GG', 'xhodkiewicz@example.net1', '1118057941', '1075251381', '654680', 'http://www.weber.net/recusandae-iure-quos-molestiae-est1', 'Medhurst Group1', 'General', '41', 'NYK1bh', '7081 Ewell Hollow\r\nNorth Keshaunfort, WA 06049', 'active', 'Hot', '63098', 'Vitae facere architecto dignissimos. Labore ut repellendus deleniti consequuntur. Tempore quis beatae ut nam eum sed.Quod enim maiores maiores. Autem commodi cumque culpa culpa dolor.', 'Pending', 'Solved', '2017-06-20 12:43:20', '2017-06-27 11:42:08');
INSERT INTO `inquiries` VALUES ('2', 'Kaylee', 'Grady', 'mhansen@example.org', '1374256388', '1065073634', '765824', 'http://www.casper.com/', 'Jones Ltd', 'General', '12', '', '65905 Justus Extension\nLake Jenniferview, NC 27207-2531', 'active', null, '02161-5237', 'Explicabo ipsam tenetur labore deleniti exercitationem quia delectus. Quisquam ullam autem a in.', 'Pending', 'Solved', '2017-06-20 12:43:27', '2017-06-26 10:05:42');
INSERT INTO `inquiries` VALUES ('5', 'Malika', 'Cruickshank', 'buster.mante@example.com', '1055533101', '1083135561', '563084', 'http://www.ratke.net/velit-illo-et-laboriosam-aliquam-officiis-libero.html', 'Fadel LLC', 'Quotation', '17', '', '57587 Macejkovic Plains\nEast Abbymouth, MO 11914', 'active', null, '47258', 'Consequuntur molestiae illum consequatur. Et aut molestiae nihil culpa quae autem. Quas vero necessitatibus ipsa nihil nobis.', 'Pending', '', '2017-06-20 12:43:27', '2017-06-21 11:17:27');
INSERT INTO `inquiries` VALUES ('7', 'Christelle', 'Gleichner', 'amber93@example.com', '1375201319', '1009190449', '806861', 'https://www.fritsch.info/culpa-at-aut-incidunt-enim-asperiores-est-qui', 'Mertz and Sons', 'General', '20', '', '49284 Stroman Extension\nFabianchester, WI 50211', 'active', null, '82649', 'Recusandae laborum aut non architecto quia doloremque voluptas amet. Sed saepe molestias autem iste non et eum. Fugiat consequatur explicabo perferendis in. Eos accusamus consectetur eum laboriosam.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-26 10:05:55');
INSERT INTO `inquiries` VALUES ('8', 'Major', 'Hoppe', 'hazle.okuneva@example.com', '1133828505', '1205337786', '178748', 'http://www.wilkinson.com/veritatis-aut-consequatur-nobis-officia-id', 'Kuhlman, Rippin and Dooley', 'General', '27', '', '51453 Ciara Ports Suite 547\nNew Deven, PA 21236-9887', 'deleted', null, '06366', 'Aut fugit non hic nihil atque. Consectetur dolor voluptas rerum quis temporibus culpa. Dolorem officiis consequatur quas sit minima aut molestiae.', 'Pending', 'Solved', '2017-06-20 12:43:27', '2017-06-21 12:49:49');
INSERT INTO `inquiries` VALUES ('9', 'Olen', 'Padberg', 'mjast@example.com', '1209858944', '1320124327', '759220', 'http://www.koelpin.com/exercitationem-voluptatem-accusamus-quos-dolorem-perspiciatis-maiores-sint', 'Raynor PLC', 'General', '46', '', '2268 Alford Port Suite 142\nWisokyshire, DC 44795', 'deleted', null, '15949-6367', 'Libero rerum maxime earum quaerat culpa vero. Vel commodi fuga et ad veniam. Consequuntur qui velit enim doloribus natus.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-21 12:58:29');
INSERT INTO `inquiries` VALUES ('10', 'Krista', 'Kohler', 'charlie.toy@example.org', '1208905239', '1360014993', '794127', 'https://www.douglas.com/provident-nihil-dolorum-voluptatem-ut-iure-accusantium-vero', 'Block, Walsh and Ziemann', 'General', '7', '', '735 Drew Estates\nRoobland, WV 59908', 'active', null, '40645', 'Ducimus eligendi consequatur aut cupiditate sunt ipsum accusantium. Minus quibusdam autem ad est. Eaque reprehenderit quia dolore molestiae corporis.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-20 12:43:27');
INSERT INTO `inquiries` VALUES ('11', 'Brionna', 'Medhurst', 'herta04@example.net', '1351429740', '1044580049', '357510', 'http://www.casper.net/architecto-debitis-sit-quis-ut-sit-iste-quidem', 'Moore, Ondricka and Schuppe', 'General', '21', '', '4716 Barrows Overpass Suite 648\nNew Aidan, CA 68320-6713', 'active', null, '21837-7472', 'Nulla consequatur debitis impedit blanditiis. Mollitia ea perferendis incidunt. Numquam reprehenderit labore id quos officia quibusdam ut.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-20 12:43:27');
INSERT INTO `inquiries` VALUES ('12', 'Adelia', 'Kessler', 'karelle89@example.org', '1371630436', '1229347263', '159827', 'http://www.abshire.com/', 'Rath Group', 'General', '27', '', '32341 Weldon Spring\nWest Vena, GA 12774-7594', 'active', null, '97737-0497', 'Sed ut aperiam labore fugit blanditiis modi. Voluptatibus fuga veritatis eos doloremque animi ad. Maiores iste voluptatem qui perferendis eius cupiditate distinctio.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-20 12:43:27');
INSERT INTO `inquiries` VALUES ('13', 'Isom', 'Johnston', 'floy.bailey@example.com', '1191159684', '1185446107', '458986', 'https://ferry.info/ad-nihil-praesentium-et-beatae-quia-minima.html', 'Lehner PLC', 'General', '3', '', '6251 Hudson Mount Suite 480\nLake Carrollstad, TX 58101', 'active', null, '74969', 'Voluptates et qui consequatur maxime et exercitationem. Laborum voluptatibus sunt odit nulla tempora. Ut est id atque qui rem sed ducimus.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-20 12:43:27');
INSERT INTO `inquiries` VALUES ('14', 'Jasen', 'Block', 'felipe61@example.net', '1093970313', '1302500205', '731966', 'https://herman.org/consectetur-voluptatem-consectetur-est-et-rerum.html', 'Shanahan, Quitzon and Grady', 'General', '25', '', '67980 Emmie Tunnel\nSouth Kennyshire, NM 54421', 'active', null, '44027-9499', 'Aut rerum aliquam qui et. Repudiandae id facere est. Cumque laborum ipsa aut neque. Sunt fugit dolores dolore veritatis.', 'Pending', 'Solved', '2017-06-20 12:43:27', '2017-06-21 12:48:54');
INSERT INTO `inquiries` VALUES ('15', 'Rubye', 'Cremin', 'nturcotte@example.net', '1024977600', '1083399987', '783121', 'http://www.strosin.com/', 'Morar-Keeling', 'General', '16', '', '3863 Smith Plains\nCristside, UT 54726', 'active', null, '36931', 'Enim quaerat alias explicabo et impedit est nam ducimus. Expedita rerum eum vero quia optio et tempore. Magni enim asperiores ratione nulla enim assumenda.', 'Pending', 'Solved', '2017-06-20 12:43:27', '2017-06-21 12:48:31');
INSERT INTO `inquiries` VALUES ('16', 'Rosalind', 'Kulas', 'khermann@example.com', '1118750056', '1109134383', '480195', 'https://www.gutkowski.com/reprehenderit-qui-et-et-qui-eius-autem-reiciendis', 'Hagenes-Bosco', 'General', '37', '', '7205 Catherine Course Suite 751\nSyblemouth, NJ 41399', 'active', null, '90118', 'Perspiciatis rerum dicta doloribus. Velit soluta et a consectetur non quod. Ut eos neque qui in voluptatum. Dolores dolor ut harum et hic totam.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-20 12:43:27');
INSERT INTO `inquiries` VALUES ('17', 'Dianna', 'Bednar', 'lempi.wisoky@example.org', '1342777905', '1214950311', '305360', 'http://farrell.com/et-et-id-ullam.html', 'Wyman-Mann', 'General', '26', '', '8378 Hintz Green Apt. 618\nNorth Luellachester, NJ 23785', 'active', null, '80881-6770', 'Ut a modi totam beatae mollitia. Adipisci ex deserunt dolorum possimus aut nesciunt et. Numquam laudantium et nobis modi aut labore blanditiis. Ipsam eaque qui rerum pariatur repellendus laborum.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-20 12:43:27');
INSERT INTO `inquiries` VALUES ('18', 'Noah', 'Grant', 'jast.ellie@example.net', '1377042798', '1031763927', '568626', 'http://watsica.com/distinctio-aut-et-amet-qui-dolores-totam', 'Leffler Group', 'General', '49', '', '55665 Kacey Mall Apt. 862\nNorth Cassidy, OR 84151', 'active', null, '88750', 'Quos necessitatibus dolorum dolore praesentium. Tempore dolores consequuntur accusamus ab commodi. Aperiam aut quis cupiditate a non.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-20 12:43:27');
INSERT INTO `inquiries` VALUES ('19', 'Adrianna', 'Fay', 'pagac.willie@example.com', '1223133165', '1022654766', '975569', 'http://bartell.org/nihil-itaque-voluptatem-non-sit-qui-molestias-excepturi', 'Shields LLC', 'General', '42', '', '6536 Adams Circle Suite 014\nSauermouth, KY 74420', 'active', null, '26142', 'Mollitia est fuga molestiae molestiae exercitationem. Est adipisci magnam aut molestiae enim ut est.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-20 12:43:27');
INSERT INTO `inquiries` VALUES ('20', 'Stephania', 'Marquardt', 'letitia.ondricka@example.com', '1379754417', '1035297676', '788785', 'http://www.stoltenberg.info/quo-ex-ipsam-explicabo-enim-facilis-esse-voluptatem-qui.html', 'Breitenberg, Senger and Legros', 'General', '9', '', '981 Mertz Valleys\nLaviniatown, MD 98546-7600', 'active', null, '93672-1859', 'Dolorum magni odit nisi. Tempore suscipit et fugit minus. Voluptas ratione voluptatibus praesentium dolores quis. Esse optio omnis quia animi ad.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-21 10:12:09');
INSERT INTO `inquiries` VALUES ('21', 'Mya', 'Ratke', 'yglover@example.org', '1278218588', '1407725445', '284926', 'http://emmerich.com/dolorum-recusandae-aliquam-ut-molestias-dignissimos-atque', 'Murphy PLC', 'General', '33', '', '7709 Glenna Overpass\nEmardport, ME 78454', 'active', null, '03119', 'Nostrum natus quo aspernatur asperiores. Eligendi sit odio quia. Assumenda ducimus saepe est corrupti.', 'Pending', 'Pending', '2017-06-20 12:43:27', '2017-06-21 10:11:29');
INSERT INTO `inquiries` VALUES ('22', 'demo inquiry', 'vbnbvnbv', 'marrybieber9@gmail.com', '7869933990', '7869933990', null, null, null, 'General', '2', '', 'bvnbvnbv', 'active', null, 'bvnbvnvb', null, 'Pending', 'Pending', '2017-06-21 07:58:37', '2017-06-21 10:10:45');
INSERT INTO `inquiries` VALUES ('23', 'demo', 'vbnbvnbv', 'mahendrag@neuronsolutions.com', '7869933990', '7869933990', null, null, null, 'General', '4', '', 'bvnbvnbv', 'deleted', null, 'bvnbvnvb', null, 'Pending', 'Pending', '2017-06-21 08:02:41', '2017-06-21 10:15:14');
INSERT INTO `inquiries` VALUES ('24', 'demo 1', 'vbnbvnbv', 'mahendrag@neuronsolutions.com', '7869933990', '7869933990', null, null, null, 'General', '3', '', 'bvnbvnbv', 'active', null, 'bvnbvnvb', null, 'Pending', 'Solved', '2017-06-21 08:11:52', '2017-06-21 11:18:44');
INSERT INTO `inquiries` VALUES ('25', 'mahi test', 'vbnbvnbv', 'mahendrag@neuronsolutions.com', '7869933990', '7869933990', null, null, null, 'General', '2', '', 'bvnbvnbv', 'deleted', null, 'bvnbvnvb', null, 'Pending', 'Pending', '2017-06-21 08:13:03', '2017-06-21 10:41:24');
INSERT INTO `inquiries` VALUES ('26', 'MGenesis', 'Meet', 'mahendrag@mailinator.com', '1118057945', '1075251381', null, null, null, 'General', '6', 'IL', 'ssss ssss', 'active', null, 'bvnbvnvb', 'dummy', 'Pending', 'Pending', '2017-06-26 09:40:16', '2017-06-26 09:40:16');
INSERT INTO `inquiries` VALUES ('27', 'jack', 'janish', 'jack@mailinator.com', '1234567890', '7894561230', 'fax', null, 'test', 'General', '5', 'test state', 'bhopal', 'active', null, '254125', 'test comment', 'Pending', 'Pending', '2017-06-26 11:04:20', '2017-06-26 11:04:20');

-- ----------------------------
-- Table structure for master_countries
-- ----------------------------
DROP TABLE IF EXISTS `master_countries`;
CREATE TABLE `master_countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of master_countries
-- ----------------------------
INSERT INTO `master_countries` VALUES ('1', 'Italy', 'CD', 'USA', '2017-06-20 12:31:43', '2017-06-20 12:31:43');
INSERT INTO `master_countries` VALUES ('2', 'Sao Tome and Principe', 'CU', 'CYM', '2017-06-20 12:31:52', '2017-06-20 12:31:52');
INSERT INTO `master_countries` VALUES ('3', 'Zimbabwe', 'PR', 'VEN', '2017-06-20 12:31:52', '2017-06-20 12:31:52');
INSERT INTO `master_countries` VALUES ('4', 'Canada', 'MS', 'MAR', '2017-06-20 12:31:52', '2017-06-20 12:31:52');
INSERT INTO `master_countries` VALUES ('5', 'Mexico', 'BN', 'CAN', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('6', 'French Southern Territories', 'GP', 'COK', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('7', 'Sri Lanka', 'BF', 'JAM', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('8', 'Iraq', 'DK', 'TGO', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('9', 'Greece', 'BW', 'ETH', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('10', 'Costa Rica', 'MF', 'TWN', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('11', 'Oman', 'LR', 'SYR', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('12', 'Guinea-Bissau', 'JO', 'DEU', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('13', 'Jamaica', 'GM', 'GBR', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('14', 'Trinidad and Tobago', 'CO', 'LVA', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('15', 'Philippines', 'CK', 'MMR', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('16', 'Cuba', 'AZ', 'MLI', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('17', 'Vietnam', 'GW', 'MNE', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('18', 'Macedonia', 'BI', 'AFG', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('19', 'Turkey', 'HM', 'CYM', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('20', 'Paraguay', 'ST', 'MNE', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('21', 'Rwanda', 'ET', 'KEN', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('22', 'Malawi', 'NU', 'ASM', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('23', 'Uganda', 'NF', 'TTO', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('24', 'Fiji', 'JE', 'MDV', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('25', 'Cambodia', 'SR', 'ZMB', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('26', 'Monaco', 'CY', 'URY', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('27', 'Tunisia', 'PR', 'HRV', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('28', 'Trinidad and Tobago', 'IR', 'BVT', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('29', 'Chile', 'SB', 'ZMB', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('30', 'Bosnia and Herzegovina', 'PN', 'BEN', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('31', 'Netherlands Antilles', 'BS', 'GBR', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('32', 'Svalbard & Jan Mayen Islands', 'CU', 'LKA', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('33', 'Oman', 'ST', 'BHR', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('34', 'Egypt', 'AI', 'BDI', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('35', 'Bahrain', 'EG', 'CZE', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('36', 'Lithuania', 'MY', 'AUS', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('37', 'Guam', 'PY', 'LAO', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('38', 'Palestinian Territory', 'KH', 'GRL', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('39', 'Vietnam', 'IO', 'CYM', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('40', 'Faroe Islands', 'KM', 'ZMB', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('41', 'Guatemala', 'SR', 'CUW', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('42', 'Swaziland', 'AZ', 'BLZ', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('43', 'Mauritania', 'JM', 'TCA', '2017-06-20 12:31:53', '2017-06-20 12:31:53');
INSERT INTO `master_countries` VALUES ('44', 'Venezuela', 'RU', 'NAM', '2017-06-20 12:31:54', '2017-06-20 12:31:54');
INSERT INTO `master_countries` VALUES ('45', 'Lithuania', 'MV', 'TGO', '2017-06-20 12:31:54', '2017-06-20 12:31:54');
INSERT INTO `master_countries` VALUES ('46', 'Chad', 'BO', 'FIN', '2017-06-20 12:31:54', '2017-06-20 12:31:54');
INSERT INTO `master_countries` VALUES ('47', 'Cape Verde', 'AE', 'MAR', '2017-06-20 12:31:54', '2017-06-20 12:31:54');
INSERT INTO `master_countries` VALUES ('48', 'Uruguay', 'KN', 'TGO', '2017-06-20 12:31:54', '2017-06-20 12:31:54');
INSERT INTO `master_countries` VALUES ('49', 'Malawi', 'KH', 'NAM', '2017-06-20 12:31:54', '2017-06-20 12:31:54');
INSERT INTO `master_countries` VALUES ('50', 'Western Sahara', 'CW', 'CUW', '2017-06-20 12:31:54', '2017-06-20 12:31:54');
INSERT INTO `master_countries` VALUES ('51', 'Saint Helena', 'MR', 'BWA', '2017-06-20 12:31:54', '2017-06-20 12:31:54');

-- ----------------------------
-- Table structure for master_fields
-- ----------------------------
DROP TABLE IF EXISTS `master_fields`;
CREATE TABLE `master_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_fields
-- ----------------------------
INSERT INTO `master_fields` VALUES ('1', 'viewing_length', 'active', '2017-06-28 19:11:42', '0000-00-00 00:00:00');
INSERT INTO `master_fields` VALUES ('2', 'viewing_width', 'active', '2017-06-28 19:12:08', '2017-06-28 19:17:10');
INSERT INTO `master_fields` VALUES ('3', 'viewing_width_1', 'active', '2017-06-28 19:42:07', '2017-06-29 12:38:59');
INSERT INTO `master_fields` VALUES ('4', 'viewing_width_2', 'active', '2017-06-28 19:42:16', '2017-06-29 12:38:56');
INSERT INTO `master_fields` VALUES ('5', 'viewing_arc_length', 'active', '2017-06-28 19:40:12', '2017-06-29 12:41:06');
INSERT INTO `master_fields` VALUES ('6', 'viewing_height', 'active', '2017-06-28 19:12:08', '2017-06-29 12:41:04');
INSERT INTO `master_fields` VALUES ('7', 'visible_diameter', 'active', '2017-06-28 19:40:41', '2017-06-28 19:34:34');
INSERT INTO `master_fields` VALUES ('8', 'waterline_height', 'active', '2017-06-28 19:12:24', '0000-00-00 00:00:00');
INSERT INTO `master_fields` VALUES ('9', 'interior_radius', 'active', '2017-06-28 19:38:31', '0000-00-00 00:00:00');
INSERT INTO `master_fields` VALUES ('10', 'exterior_radius', 'active', '2017-06-28 19:39:08', '0000-00-00 00:00:00');
INSERT INTO `master_fields` VALUES ('11', 'engineering_stamp', 'active', '2017-06-28 19:13:24', '0000-00-00 00:00:00');
INSERT INTO `master_fields` VALUES ('12', 'wind_mitigation', 'active', '2017-06-28 19:13:37', '0000-00-00 00:00:00');
INSERT INTO `master_fields` VALUES ('13', 'manufacture_quantity', 'active', '2017-06-28 19:12:40', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('18', '2017_06_15_141407_create_master_countries_table', '1');
INSERT INTO `migrations` VALUES ('19', '2017_06_15_141508_create_inquiries_table', '1');
INSERT INTO `migrations` VALUES ('20', '2017_06_19_123549_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('21', '2017_06_19_124945_create_users_table', '1');
INSERT INTO `migrations` VALUES ('22', '2017_06_24_062908_create_upload_directories_table', '2');

-- ----------------------------
-- Table structure for panel_fields
-- ----------------------------
DROP TABLE IF EXISTS `panel_fields`;
CREATE TABLE `panel_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panel_id` int(11) NOT NULL,
  `panel_fields` varchar(255) NOT NULL,
  `is_visible` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `panel_id` (`panel_id`),
  CONSTRAINT `panel_fields_ibfk_1` FOREIGN KEY (`panel_id`) REFERENCES `panels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of panel_fields
-- ----------------------------
INSERT INTO `panel_fields` VALUES ('1', '1', '[1,6,8,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 12:44:23');
INSERT INTO `panel_fields` VALUES ('2', '2', '[1,2,6,8,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 12:46:28');
INSERT INTO `panel_fields` VALUES ('3', '3', '[1,3,4,6,8,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 12:53:36');
INSERT INTO `panel_fields` VALUES ('4', '4', '[1,6,8,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 12:56:52');
INSERT INTO `panel_fields` VALUES ('5', '5', '[1,2,6,8,11,12,13]', '1', null, '2017-06-29 12:50:38');
INSERT INTO `panel_fields` VALUES ('6', '6', '[1,3,4,6,8,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 13:04:57');
INSERT INTO `panel_fields` VALUES ('7', '7', '[1,2,6,8,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 13:05:01');
INSERT INTO `panel_fields` VALUES ('8', '8', '[8,7,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 13:25:47');
INSERT INTO `panel_fields` VALUES ('9', '9', '[8,7,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 13:31:52');
INSERT INTO `panel_fields` VALUES ('10', '10', '[5,10,6,8,11,12,13]', '1', null, '2017-06-29 13:40:52');
INSERT INTO `panel_fields` VALUES ('11', '11', '[5,9,6,8,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 13:41:59');
INSERT INTO `panel_fields` VALUES ('12', '12', '[5,6,8,10,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 14:50:28');
INSERT INTO `panel_fields` VALUES ('13', '13', '[5,6,8,9,11,12,13]', '1', '2017-06-28 15:54:11', '2017-06-29 14:51:22');

-- ----------------------------
-- Table structure for panel_images
-- ----------------------------
DROP TABLE IF EXISTS `panel_images`;
CREATE TABLE `panel_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panel_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `panel_id` (`panel_id`),
  CONSTRAINT `panel_images_ibfk_1` FOREIGN KEY (`panel_id`) REFERENCES `panels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of panel_images
-- ----------------------------
INSERT INTO `panel_images` VALUES ('1', '1', 'panel-3-01.png', '2017-06-28 15:50:28', null);
INSERT INTO `panel_images` VALUES ('2', '1', 'panel-3-02.png', '2017-06-28 15:51:13', null);
INSERT INTO `panel_images` VALUES ('3', '1', 'panel-3-03.png', '2017-06-28 15:51:13', null);
INSERT INTO `panel_images` VALUES ('4', '1', 'panel-3-04.png', '2017-06-28 15:51:13', null);
INSERT INTO `panel_images` VALUES ('5', '2', 'panel-3L-1.png', '2017-06-28 19:25:39', '2017-06-28 19:19:25');
INSERT INTO `panel_images` VALUES ('7', '2', 'panel-3L-2.png', '2017-06-28 19:27:46', '2017-06-28 19:21:31');
INSERT INTO `panel_images` VALUES ('9', '2', 'panel-3L-3.png', '2017-06-28 19:27:44', '2017-06-28 19:21:29');
INSERT INTO `panel_images` VALUES ('10', '2', 'panel-3L-4.png', '2017-06-28 19:27:35', '2017-06-28 19:27:39');
INSERT INTO `panel_images` VALUES ('11', '3', 'panel-3U-1.jpg', '2017-06-29 12:58:17', null);
INSERT INTO `panel_images` VALUES ('12', '3', 'panel-3U-2.jpg', '2017-06-29 12:58:17', '2017-06-29 12:52:35');
INSERT INTO `panel_images` VALUES ('13', '3', 'panel-3U-3.jpg', '2017-06-29 12:58:17', '2017-06-29 12:52:38');
INSERT INTO `panel_images` VALUES ('14', '3', 'panel-3U-4.jpg', '2017-06-29 12:58:17', '2017-06-29 12:52:42');
INSERT INTO `panel_images` VALUES ('15', '4', 'panel-4-1.jpg', '2017-06-29 13:03:34', null);
INSERT INTO `panel_images` VALUES ('16', '4', 'panel-4-2.jpg', '2017-06-29 13:03:34', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('17', '4', 'panel-4-3.jpg', '2017-06-29 13:03:34', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('18', '4', 'panel-4-4.jpg', '2017-06-29 13:03:34', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('19', '5', 'panel-4L-1.jpg', '2017-06-29 13:07:02', '2017-06-29 13:00:54');
INSERT INTO `panel_images` VALUES ('20', '5', 'panel-4L-2.jpg', '2017-06-29 13:07:02', '2017-06-29 13:00:54');
INSERT INTO `panel_images` VALUES ('21', '5', 'panel-4L-3.jpg', '2017-06-29 13:07:02', '2017-06-29 13:00:54');
INSERT INTO `panel_images` VALUES ('22', '5', 'panel-4L-4.jpg', '2017-06-29 13:07:02', '2017-06-29 13:00:54');
INSERT INTO `panel_images` VALUES ('23', '6', 'panel-4U-1.jpg', '2017-06-29 13:09:32', null);
INSERT INTO `panel_images` VALUES ('24', '6', 'panel-4U-2.jpg', '2017-06-29 13:09:32', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('25', '6', 'panel-4U-3.jpg', '2017-06-29 13:09:32', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('26', '6', 'panel-4U-4.jpg', '2017-06-29 13:09:32', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('27', '7', 'panel-4sideflat-1.jpg', '2017-06-29 13:12:29', null);
INSERT INTO `panel_images` VALUES ('28', '7', 'panel-4sideflat-2.jpg', '2017-06-29 13:12:29', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('29', '7', 'panel-4sideflat-3.jpg', '2017-06-29 13:12:29', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('30', '8', 'circle-horizontal-panel-1.jpg', '2017-06-29 13:28:33', '2017-06-29 13:22:43');
INSERT INTO `panel_images` VALUES ('31', '8', 'circle-horizontal-panel-2.jpg', '2017-06-29 13:28:45', '2017-06-29 13:22:48');
INSERT INTO `panel_images` VALUES ('32', '8', 'circle-horizontal-panel-3.jpg', '2017-06-29 13:29:09', null);
INSERT INTO `panel_images` VALUES ('33', '9', 'circle-verticle-panel-1.jpg', '2017-06-29 13:38:28', null);
INSERT INTO `panel_images` VALUES ('34', '9', 'circle-verticle-panel-2.jpg', '2017-06-29 13:38:28', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('35', '9', 'circle-verticle-panel-3.jpg', '2017-06-29 13:38:28', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('36', '9', 'circle-verticle-panel-4.jpg', '2017-06-29 13:38:28', '0000-00-00 00:00:00');
INSERT INTO `panel_images` VALUES ('37', '10', '3d-convex-1.jpg', '2017-06-29 13:40:42', '2017-06-29 13:40:04');
INSERT INTO `panel_images` VALUES ('38', '10', '3d-convex-2.jpg', '2017-06-29 13:40:42', '2017-06-29 13:40:07');
INSERT INTO `panel_images` VALUES ('39', '10', '3d-convex-3.jpg', '2017-06-29 13:40:42', '2017-06-29 13:40:09');
INSERT INTO `panel_images` VALUES ('40', '10', '3d-convex-4.jpg', '2017-06-29 13:40:42', '2017-06-29 13:40:11');
INSERT INTO `panel_images` VALUES ('41', '11', '3d-concav-1.jpg', '2017-06-29 13:40:42', '2017-06-29 14:48:08');
INSERT INTO `panel_images` VALUES ('42', '11', '3d-concav-2.jpg', '2017-06-29 13:40:42', '2017-06-29 14:48:10');
INSERT INTO `panel_images` VALUES ('43', '11', '3d-concav-3.jpg', '2017-06-29 13:40:42', '2017-06-29 14:48:11');
INSERT INTO `panel_images` VALUES ('44', '11', '3d-concav-4.jpg', '2017-06-29 13:40:42', '2017-06-29 14:48:12');
INSERT INTO `panel_images` VALUES ('45', '12', '4d-convex-1.jpg', '2017-06-29 14:55:04', '2017-06-29 14:58:24');
INSERT INTO `panel_images` VALUES ('46', '12', '4d-convex-2.jpg', '2017-06-29 14:55:04', '2017-06-29 14:58:35');
INSERT INTO `panel_images` VALUES ('47', '12', '4d-convex-3.jpg', '2017-06-29 14:55:04', '2017-06-29 14:58:39');
INSERT INTO `panel_images` VALUES ('48', '12', '4d-convex-4.jpg', '2017-06-29 14:55:04', '2017-06-29 14:58:41');
INSERT INTO `panel_images` VALUES ('49', '13', '4d-concav-1.jpg', '2017-06-29 14:55:04', '2017-06-29 14:58:57');
INSERT INTO `panel_images` VALUES ('50', '13', '4d-concav-2.jpg', '2017-06-29 14:55:04', '2017-06-29 14:58:59');
INSERT INTO `panel_images` VALUES ('51', '13', '4d-concav-3.jpg', '2017-06-29 14:55:04', '2017-06-29 14:58:59');
INSERT INTO `panel_images` VALUES ('52', '13', '4d-concav-4.jpg', '2017-06-29 14:55:04', '2017-06-29 14:58:59');

-- ----------------------------
-- Table structure for panels
-- ----------------------------
DROP TABLE IF EXISTS `panels`;
CREATE TABLE `panels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panel_title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` enum('deleted','inactive','active') DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of panels
-- ----------------------------
INSERT INTO `panels` VALUES ('1', '3 Side Support Panel', 'Flat Acrylic Panel W/3 Sided Support Perspective View', 'choose-panel-1.jpg', 'active', '2017-06-26 15:42:22', '2017-06-28 15:57:07');
INSERT INTO `panels` VALUES ('2', '3 Sided L Shape Panel', '3 Sided (L-Shaped) Acryliv Panel Wi Bonded Corner Perspective', 'choose-panel-2.jpg', 'active', '2017-06-28 11:43:43', '2017-06-28 19:18:24');
INSERT INTO `panels` VALUES ('3', '3 Sided U Shape Panel', '3 Sided (U-Shaped) Acryliv Panel Wi Bonded Corner Perspective', 'choose-panel-3.jpg', 'active', '2017-06-28 11:43:45', '2017-06-28 19:30:29');
INSERT INTO `panels` VALUES ('4', '4 Side Support Panel', 'Flat Acrylic Panel W/4 Sided Support Perspective View', 'choose-panel-4.jpg', 'active', '2017-06-28 11:43:48', '2017-06-28 19:30:37');
INSERT INTO `panels` VALUES ('5', '4 Sided L Shape panel', '4 Sided (L-Shaped) Acryliv Panel Wi Bonded Corner Perspective', 'choose-panel-5.jpg', 'active', '2017-06-28 11:43:50', '2017-06-28 19:30:49');
INSERT INTO `panels` VALUES ('6', '4 Sided U Shape panel', '4 Sided (U-Shaped) Acryliv Panel Wi Bonded Corner Perspective', 'choose-panel-6.jpg', 'active', '2017-06-28 11:43:52', '2017-06-28 19:30:55');
INSERT INTO `panels` VALUES ('7', '4 side support floor panel', 'Horizontal Acrylic Panel W/4 Sided Support Perspective View', 'choose-panel-7.jpg', 'active', '2017-06-28 11:43:55', '2017-06-28 19:31:04');
INSERT INTO `panels` VALUES ('8', 'Circle Horizontal Panel', 'Flat Acrylic Circular Panel Horizontal Position Perspective View', 'choose-panel-8.jpg', 'active', '2017-06-28 11:43:57', '2017-06-28 19:31:11');
INSERT INTO `panels` VALUES ('9', 'Circle Vertical Panel', 'Flat Acrylic Circular Panel Vertical Position Perspective View', 'choose-panel-9.jpg', 'active', '2017-06-28 11:43:59', '2017-06-28 19:31:17');
INSERT INTO `panels` VALUES ('10', '3 Side Convex Panel', 'Convex Acrylic Panel W/3 Sided Support Perspective View', 'choose-panel-10.jpg', 'active', '2017-06-28 11:44:03', '2017-06-28 19:31:24');
INSERT INTO `panels` VALUES ('11', '3 Side Concave Panel', 'Concav Acrylic Panel W/3 Sided Support Perspective View', 'choose-panel-11.jpg', 'active', '2017-06-28 11:44:05', '2017-06-28 19:31:40');
INSERT INTO `panels` VALUES ('12', '4 Side Convex Panel', 'Convex Acrylic Panel W/4 Sided Support Perspective View', 'choose-panel-12.jpg', 'active', '2017-06-28 11:44:08', '2017-06-28 19:31:47');
INSERT INTO `panels` VALUES ('13', '4 Side Concav Panel', 'Concave Acrylic Panel W/4 Sided Support Perspective View', 'choose-panel-13.jpg', 'active', '2017-06-28 11:44:10', '2017-06-28 19:31:56');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'admin', 'active', '2017-06-20 18:00:45', '2017-06-20 18:00:48');

-- ----------------------------
-- Table structure for upload_directories
-- ----------------------------
DROP TABLE IF EXISTS `upload_directories`;
CREATE TABLE `upload_directories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `directory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inquiry_id` int(10) unsigned NOT NULL,
  `status` enum('active','inactive','deleted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_directories_inquiry_id_foreign` (`inquiry_id`),
  CONSTRAINT `upload_directories_inquiry_id_foreign` FOREIGN KEY (`inquiry_id`) REFERENCES `inquiries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of upload_directories
-- ----------------------------
INSERT INTO `upload_directories` VALUES ('1', 'dmmu', '5', 'active', '2017-06-24 09:01:36', '2017-06-24 09:01:36');
INSERT INTO `upload_directories` VALUES ('2', 'Sketch', '5', 'active', '2017-06-24 09:05:20', '2017-06-24 09:05:20');
INSERT INTO `upload_directories` VALUES ('3', 'Images', '5', 'active', '2017-06-24 09:06:30', '2017-06-24 09:06:30');
INSERT INTO `upload_directories` VALUES ('4', 'Docs', '5', 'active', '2017-06-24 09:35:16', '2017-06-24 09:35:16');
INSERT INTO `upload_directories` VALUES ('5', 'Docs', '5', 'active', '2017-06-24 09:38:14', '2017-06-24 09:38:14');
INSERT INTO `upload_directories` VALUES ('6', 'fgfdgff', '5', 'active', '2017-06-24 09:39:20', '2017-06-24 09:39:20');
INSERT INTO `upload_directories` VALUES ('7', 'test', '5', 'active', '2017-06-26 06:57:06', '2017-06-26 06:57:06');
INSERT INTO `upload_directories` VALUES ('8', 'test1', '5', 'active', '2017-06-26 13:01:16', '2017-06-26 13:01:16');
INSERT INTO `upload_directories` VALUES ('9', 'new-folder', '5', 'active', '2017-06-27 06:19:03', '2017-06-27 06:19:03');
INSERT INTO `upload_directories` VALUES ('10', 'testuploading-file', '5', 'active', '2017-06-27 06:24:56', '2017-06-27 06:24:56');
INSERT INTO `upload_directories` VALUES ('11', 'upload-file', '5', 'active', '2017-06-27 06:35:47', '2017-06-27 06:35:47');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive','deleted') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', 'Keenan', 'Beier', 'test@mailinator.com', '$2y$10$2I4F3rjUhPjVUCtI5IXZY.N2kpk9yDWyEleFDlFOwE9SsbwoLaHbi', 'active', '1', '595SZHLOQT9R89Mx6sPi6zEfMbjvqCwTY4JTIA3pPdq0GL9vBR8meF71HQfc', '2017-06-20 12:30:53', '2017-06-20 12:30:53');
