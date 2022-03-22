/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : perpus

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 17/03/2022 10:19:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for book_school
-- ----------------------------
DROP TABLE IF EXISTS `book_school`;
CREATE TABLE `book_school`  (
  `book_id` bigint UNSIGNED NOT NULL,
  `school_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  INDEX `book_school_book_id_foreign`(`book_id`) USING BTREE,
  INDEX `book_school_school_id_foreign`(`school_id`) USING BTREE,
  CONSTRAINT `book_school_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `book_school_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of book_school
-- ----------------------------
INSERT INTO `book_school` VALUES (175, 1, '2022-03-14 10:21:36', '2022-03-14 10:21:39', '2022-03-14 10:21:41');
INSERT INTO `book_school` VALUES (175, 5, '2022-03-14 10:41:51', '2022-03-14 10:41:52', NULL);
INSERT INTO `book_school` VALUES (174, 5, '2022-03-15 10:25:16', '2022-03-15 10:25:16', NULL);

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `filetype` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `clicked_time` bigint NULL DEFAULT NULL,
  `edu_id` int NULL DEFAULT NULL,
  `grade_id` int NULL DEFAULT NULL,
  `major_id` int NULL DEFAULT NULL,
  `sub_id` int NULL DEFAULT NULL,
  `published_year` int NULL DEFAULT NULL,
  `publisher` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 180 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES (21, 'Dignissimos illo.', 'Odio sunt enim id. Odit est aut aperiam ut earum quidem quisquam. Nisi qui consectetur blanditiis quo sapiente fuga. Earum necessitatibus numquam amet inventore et est omnis. Cupiditate vel dolor nihil enim illum aut voluptatum.', 'Inventore iure officiis et sint.pdf', '', 'pdf', 904, 3, 9, 10, 2, 1933, 'Nikolaus, Vandervort and Luettgen', 'Mrs.Quigley.  Leopoldo', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (22, 'Dolores sequi pariatur.', 'Quia et illum vitae totam qui. Suscipit quam debitis et hic quia similique. Repellendus cupiditate alias sed.', 'Illum dignissimos eius qui perferendis.pdf', '', 'pdf', 6, 1, 10, 8, 26, 2013, 'Schneider, Stehr and Blanda', 'MissMuller.  Brooklyn', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (23, 'Explicabo qui minima.', 'Id dolor quas facilis deserunt rem ut. Placeat et voluptatibus sed at mollitia earum iure. Laborum molestiae illo odit nulla minus aut quis. Reprehenderit rerum corporis vero sequi in quia numquam. Et quidem ab voluptas quas nihil necessitatibus ea. Sed id est dolorum reprehenderit aliquam minus qui rerum.', 'Consequatur animi hic et.pdf', '', 'pdf', 621, 6, 8, 1, 8, 1973, 'Rath, Schulist and Ebert', 'Prof.Effertz.  Juvenal', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (24, 'Consequuntur nihil.', 'Pariatur adipisci autem pariatur illum iste architecto. Ea cumque et eveniet magnam consectetur mollitia quo. In tenetur voluptas repudiandae quasi non dolor. Laborum molestias et eos. Neque ut tempore dicta omnis.', 'In expedita quae voluptates dolorum natus fugit.pdf', '', 'pdf', 571, 15, 12, 8, 25, 1961, 'Bergstrom and Sons', 'Prof.Wyman.  Vilma', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (25, 'Aut libero occaecati.', 'Commodi velit iusto voluptate earum est repudiandae. Consequuntur quas rerum vel dolorem unde. Vel molestiae ut repellendus consequatur. Fugiat dolor illo veniam consequatur sed distinctio. Illum sit dolor animi. Veritatis modi quidem nihil.', 'Sunt temporibus beatae suscipit non officiis.pdf', '', 'pdf', 401, 3, 11, 6, 23, 1945, 'Thiel, Oberbrunner and McKenzie', 'Dr.Towne.  Jeanie', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (26, 'Quia facere.', 'Beatae modi est sequi. Tempore ut minus omnis omnis omnis. Eveniet nulla odio quidem et. Totam facilis quis ab laborum et consectetur maxime sunt. Temporibus impedit minima quos qui et provident molestiae nobis. Sequi quia nisi et accusantium hic autem.', 'Corrupti vitae esse qui ab est perferendis.pdf', '', 'pdf', 44, 6, 10, 5, 13, 2004, 'Hand PLC', 'Dr.Haley.  Leif', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (27, 'Nesciunt molestiae.', 'Suscipit debitis reprehenderit harum excepturi saepe. Praesentium quasi quibusdam asperiores facilis eum aut est. Facere deserunt maiores voluptatem consequuntur. Qui libero qui sit doloremque tempora doloremque.', 'Sit est rerum quam voluptatem corrupti.pdf', '', 'pdf', 153, 1, 2, 1, 9, 2007, 'Brekke PLC', 'Prof.Wilderman.  Jamison', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (28, 'Harum et.', 'Sed atque vel ipsum ut. Voluptas modi dicta enim mollitia enim. Debitis dolores ipsam commodi sit quia laudantium consequatur. Ipsam aliquam et ut. Laudantium sapiente vel officiis temporibus ad sit non tenetur.', 'Quis nesciunt quis veniam molestiae.pdf', '', 'pdf', 950, 1, 4, 6, 15, 1976, 'Corwin, Crooks and Hessel', 'Prof.Rippin.  Deontae', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (29, 'Adipisci perspiciatis aut.', 'Voluptas quis aut ut assumenda culpa provident. Sunt nostrum voluptatem id labore ex numquam ratione. Eum et dolorem qui voluptate incidunt molestias facere. Incidunt voluptatem natus quibusdam soluta at est. Quas sed voluptatem repellendus sed et.', 'Eligendi qui modi error nostrum voluptas.pdf', '', 'pdf', 704, 15, 1, 4, 16, 1962, 'Conn PLC', 'Dr.Goodwin.  Eloise', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (30, 'Qui similique.', 'Eius reprehenderit amet quis excepturi officia et fugit. Et eos esse dolorem unde necessitatibus incidunt ut. Qui ut recusandae dolorem rerum tempora consequatur et in. Nihil ut laboriosam deleniti quod incidunt necessitatibus quibusdam. Aliquid sint voluptatem vitae eum aut ab error. Rerum id ut doloremque voluptatibus.', 'Sequi nisi sunt ratione autem.pdf', '', 'pdf', 596, 3, 12, 2, 19, 1948, 'Lesch, Okuneva and Bins', 'Prof.Barrows.  Harry', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (31, 'Explicabo laboriosam.', 'Architecto et velit placeat. Numquam est nobis quaerat sequi itaque. Quaerat error est vitae incidunt non enim.', 'Dolores et veniam eos aut dicta.pdf', '', 'pdf', 791, 1, 7, 9, 2, 1966, 'Zemlak-Wilkinson', 'Dr.Graham.  Russ', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (32, 'Molestiae necessitatibus.', 'Velit earum eveniet ut rem earum placeat voluptas animi. Temporibus est modi id explicabo modi. Ullam ut corporis cum incidunt ut sit. In nostrum soluta et officia ratione et dignissimos quisquam. Facilis quasi minima officia harum repellendus repudiandae.', 'Eveniet optio voluptate nulla dicta quia.pdf', '', 'pdf', 685, 1, 10, 2, 18, 1958, 'Morissette-Boehm', 'Dr.Fritsch.  Chance', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (33, 'Totam rerum qui.', 'Tempore corporis cum ex qui quidem. Assumenda ut beatae et eum incidunt sint nulla accusantium. Dolorum facilis dolorum delectus.', 'Occaecati qui dicta dolore nulla autem delectus.pdf', '', 'pdf', 59, 3, 5, 5, 25, 1956, 'Volkman-Hayes', 'Prof.Willms.  Candido', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (34, 'Facere eos.', 'Nemo et quia voluptatum ea suscipit. Enim voluptate incidunt harum perspiciatis assumenda. Est quia eum accusantium est minima vel.', 'Id unde incidunt beatae qui.pdf', '', 'pdf', 357, 1, 4, 7, 14, 2013, 'Pagac, Becker and Prohaska', 'Mrs.Ebert.  Orland', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (35, 'Et et.', 'Voluptate a vel quibusdam similique non eaque est corrupti. Quod quos magnam eos ut enim fugit dignissimos. Laudantium sed quis saepe a sit eos soluta. Enim id sequi voluptates quis velit.', 'Voluptatem animi animi vel repudiandae.pdf', '', 'pdf', 744, 3, 12, 5, 12, 1934, 'Ward, Bernier and Ondricka', 'Mrs.Rutherford.  Ernestine', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (36, 'Officia autem magni.', 'Est hic temporibus consequatur consequatur totam sequi. Accusamus eaque consequatur porro quia nisi qui. Dolorum quia nemo odit voluptas debitis reiciendis ex ut. A ut voluptatem repellendus repellendus aut. Velit asperiores non et aut sunt illo facilis aliquid.', 'Ea id qui quasi non.pdf', '', 'pdf', 110, 3, 5, 1, 30, 1971, 'Harber Inc', 'Prof.Kiehn.  Eloise', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (37, 'Reprehenderit reprehenderit dignissimos.', 'Similique dolores veritatis est laborum assumenda. Deserunt tempore qui eaque provident unde. Minus sed aut soluta. Eos optio expedita est omnis laborum officia dignissimos. Veritatis reprehenderit sunt necessitatibus eligendi cupiditate illum ea. Hic omnis fugiat distinctio suscipit vel.', 'Sint possimus aut ab excepturi.pdf', '', 'pdf', 356, 3, 11, 6, 6, 1995, 'Little, Franecki and Konopelski', 'Dr.Douglas.  Madeline', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (38, 'Id adipisci accusantium.', 'Incidunt fuga et voluptatibus officia dolor quaerat modi aut. Neque qui temporibus aperiam voluptate pariatur nam. Doloremque harum sunt eligendi omnis et dicta.', 'Necessitatibus eos porro tempore ut beatae ipsa.pdf', '', 'pdf', 210, 3, 11, 6, 4, 1981, 'Batz-Hilpert', 'Dr.Carroll.  Vivian', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (39, 'Dolore omnis vel.', 'Veritatis autem aut velit laborum sed optio. Qui optio sunt quam. Minima temporibus eum et officiis ut minus. Rem sed accusantium ea culpa eveniet aperiam consequuntur saepe. Illo et nisi est aliquid adipisci. Ut et assumenda ipsam quia illum deserunt.', 'Architecto ut similique accusamus tempore quo.pdf', '', 'pdf', 729, 3, 10, 4, 30, 1958, 'McKenzie-Nader', 'Prof.Thiel.  Maud', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (40, 'Voluptatem nemo.', 'Aut ullam nisi ut sint ullam recusandae. Nesciunt dolorum ut nam eum. Et et non et optio dolore officia.', 'Asperiores et rerum voluptatem dolorum odio.pdf', '', 'pdf', 278, 3, 6, 2, 19, 1963, 'Grant, Hermiston and Botsford', 'Dr.Schinner.  Matt', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (41, 'Eos magnam deserunt.', 'Enim nam rerum sint ut magni. Nesciunt odio ut harum sequi. Magni quod tempore reprehenderit. Neque quia qui laboriosam soluta.', 'Magni cumque voluptas non.pdf', '', 'pdf', 771, 1, 10, 3, 18, 2019, 'Cartwright, Hirthe and Klein', 'MissJaskolski.  Mozell', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (42, 'Est adipisci.', 'Incidunt repudiandae explicabo quas officia molestiae incidunt. Itaque dolores molestiae illum veritatis rem dignissimos autem. Debitis aut aliquid ipsa perferendis enim cupiditate quibusdam. Provident dolores voluptas eum doloremque aliquam explicabo. Eos voluptas cum ex.', 'Facere quae quo aut ullam vero cum voluptatum.pdf', '', 'pdf', 361, 3, 3, 10, 27, 2005, 'Mertz Inc', 'Prof.O\'Conner.  Nash', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (43, 'Accusantium qui.', 'Facere sed id ipsam maiores. Occaecati natus ut officia alias modi laborum. Sequi laboriosam possimus quos inventore.', 'At vel fugit illum modi laboriosam aut.pdf', '', 'pdf', 408, 6, 2, 1, 19, 1986, 'Mayer-Emard', 'Prof.Tromp.  Cletus', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (44, 'Eum ab eum.', 'Et occaecati dolor fugit ut provident mollitia. Voluptates dolore debitis qui possimus aperiam ut. Esse blanditiis unde nulla veniam reprehenderit perferendis quo. Eaque sit harum magnam est id ut est rem.', 'Possimus omnis quod corrupti in.pdf', '', 'pdf', 282, 15, 3, 1, 24, 1975, 'Sanford-Wisoky', 'Dr.O\'Keefe.  Lexi', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (45, 'Amet iste cum.', 'Debitis aliquam assumenda fugit deserunt voluptatem ut inventore. Quis tenetur ea modi nam fugiat. Sed voluptas mollitia corporis repellat dolor. Nisi tempore magni quo nostrum autem voluptatem quae.', 'Aliquam reprehenderit ipsum ullam sed.pdf', '', 'pdf', 349, 6, 7, 3, 6, 1996, 'Reinger-Langworth', 'Dr.Aufderhar.  Rene', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (46, 'Labore necessitatibus in.', 'Est impedit pariatur molestias quasi. Deleniti dolorem consequatur sit qui. Eius et modi vel tempore voluptas. Quidem ab neque quia qui. Occaecati nobis quod velit sequi et.', 'Et nihil ipsum sed et voluptatem et.pdf', '', 'pdf', 112, 6, 1, 3, 24, 2014, 'Wolff Ltd', 'Dr.Lakin.  Madelyn', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (47, 'Illo soluta.', 'Odio maiores debitis nam magnam maxime qui ea. Quo aut repellat unde ut harum quibusdam officiis. Saepe fugit assumenda qui quo eum deserunt. Ipsa magnam eligendi facilis a quod doloribus eum. Sed ad quos reprehenderit rem pariatur.', 'Rerum qui voluptas sint quia maiores.pdf', '', 'pdf', 726, 6, 2, 4, 1, 1975, 'Carroll-Rath', 'MissPfannerstill.  Althea', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (48, 'Qui earum.', 'Excepturi maxime voluptate velit. Voluptates veritatis nisi est dolorem ea. Consequatur odio in tempore voluptas perspiciatis accusantium sint. Quo et vel nesciunt quis et voluptas blanditiis ut.', 'Dicta doloribus recusandae velit omnis autem.pdf', '', 'pdf', 626, 1, 8, 9, 17, 1974, 'Toy-Leuschke', 'Ms.Price.  Roxanne', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (49, 'Nesciunt ad et.', 'Distinctio quos ut suscipit consequuntur incidunt. Eum quia ut fugiat voluptas assumenda nihil quia. Omnis aut nulla voluptas esse soluta ipsum laudantium quisquam. Earum veritatis et et eum.', 'Fuga ut aut odit aliquam aut debitis.pdf', '', 'pdf', 273, 1, 2, 6, 12, 1996, 'Conn-Collins', 'Dr.Robel.  Uriel', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (50, 'Rerum ut molestiae.', 'Quis est rerum consequatur saepe nisi officia. Qui quo saepe aut et eius sit quaerat. In accusamus nam corrupti vel omnis eius autem. Ut qui consequatur quo non ratione repellat.', 'Similique nesciunt id eos qui.pdf', '', 'pdf', 248, 15, 9, 10, 20, 1938, 'Skiles-Jenkins', 'Mrs.Hickle.  Denis', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (51, 'Dolor dolores.', 'Laborum aspernatur molestiae fuga non consectetur et et. Sunt aut voluptate esse consequatur tempore alias. Dolor facere est corporis voluptas non est. Quod quo eius unde ex ut. Nihil et quis delectus et nesciunt. Id earum quam provident beatae corrupti possimus.', 'Id ratione facilis dolorem quo et consequatur.pdf', '', 'pdf', 372, 15, 7, 8, 6, 1980, 'Yost Group', 'Mr.Littel.  Hillary', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (52, 'Labore repellendus.', 'Consequatur consequatur harum animi in fuga laborum aliquam. Nam illum quisquam consequatur atque vero magnam totam. Inventore hic doloribus cum rerum.', 'Iste velit consectetur labore ex ullam quod.pdf', '', 'pdf', 203, 6, 12, 8, 5, 1958, 'Leannon-Cremin', 'Dr.Wiza.  Hilbert', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (53, 'Autem excepturi.', 'Commodi eos et qui sit officia perferendis. Rerum reprehenderit corrupti quia odio voluptate in. Autem est quisquam ut libero perferendis. Non facere qui deserunt molestiae praesentium blanditiis dolores.', 'Non non nostrum minima voluptates fugit vero.pdf', '', 'pdf', 255, 3, 2, 7, 28, 1978, 'Wehner-Rempel', 'Mr.Paucek.  Brad', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (54, 'Sed fugiat accusamus.', 'Ut quibusdam nisi dignissimos. Quo porro quidem ad cumque autem esse ducimus. Saepe quibusdam voluptatem culpa explicabo. Quia numquam nam ratione quam ut. Sunt iusto ipsam eaque accusamus.', 'Ut consequuntur sed eum iste.pdf', '', 'pdf', 718, 3, 9, 9, 16, 2003, 'Zboncak-Donnelly', 'Dr.Mueller.  Nicole', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (55, 'Totam et.', 'Sunt error ex omnis at. Eveniet in velit aut ut qui doloremque qui. Voluptatem unde temporibus voluptatem in deleniti. Sint incidunt molestias ratione consequuntur ut. Alias nihil dolores dignissimos voluptas et qui vel nulla.', 'Et unde a tenetur quia eius.pdf', '', 'pdf', 89, 1, 7, 7, 28, 1994, 'Schinner, Marks and Lehner', 'Dr.Stroman.  Malinda', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (56, 'Quis labore.', 'Unde veritatis autem aliquid doloremque qui. Rem mollitia ea officia id inventore. Qui atque est ratione iste sint vitae. Et id ut est modi.', 'Laborum aut occaecati doloribus nihil ullam.pdf', '', 'pdf', 715, 3, 2, 4, 28, 2005, 'Gleason, Ebert and Morar', 'MissBrekke.  Vernie', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (57, 'Quia sit corporis.', 'Omnis doloremque maxime iure quis nihil alias. Sit optio iusto saepe qui officiis blanditiis. Omnis ad sit culpa facere quos accusantium aliquid. Praesentium labore nulla facere voluptas recusandae doloremque.', 'Iste quas sed nam.pdf', '', 'pdf', 819, 3, 9, 3, 13, 1940, 'Sanford-Abbott', 'Ms.Welch.  Stefanie', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (58, 'Provident qui.', 'Incidunt ipsa aut molestiae a dolor. Officiis nesciunt perspiciatis saepe facere deleniti assumenda nam aspernatur. Minus sequi architecto qui et qui velit libero. Eius id fuga minima soluta dicta. Delectus facere praesentium consectetur ab distinctio officia.', 'Minima ipsa iusto eos ea omnis et vel quia.pdf', '', 'pdf', 430, 3, 6, 4, 1, 1970, 'Fadel-Schaden', 'Prof.Kris.  Tania', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (59, 'Aperiam alias rerum.', 'Sed deleniti ullam est quo culpa. Nobis in nemo hic a ab dolorem magni. Quaerat laborum et ipsa reprehenderit omnis et maiores.', 'Est explicabo nobis voluptatem quia odio rerum.pdf', '', 'pdf', 425, 15, 12, 5, 22, 2020, 'Weber, Pouros and Marvin', 'Mrs.Kihn.  Ansley', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (60, 'Ea sit ut.', 'Tempore unde alias natus illo delectus. Mollitia sit magni tempora ullam eveniet vitae sit blanditiis. Quidem consequatur magni cupiditate. Sed in ea fuga est sunt ad nemo earum.', 'Error est temporibus accusantium recusandae.pdf', '', 'pdf', 724, 3, 12, 8, 20, 1972, 'Carter-Hayes', 'Prof.Gerlach.  Cordelia', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (61, 'Atque blanditiis.', 'Neque hic odio dolore aut dolore quia. Nemo rerum id atque itaque ab eveniet iure. Distinctio minima aut dolorem quisquam. Tenetur enim minus quia.', 'Autem tempora sit corrupti quis quibusdam.pdf', '', 'pdf', 399, 15, 7, 4, 19, 1984, 'Boyle, Kshlerin and Bahringer', 'Prof.Olson.  Tiffany', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (62, 'Quidem velit quo.', 'Blanditiis harum qui aperiam assumenda autem optio. Aut magni ut maxime quasi numquam est. Quaerat nostrum at aut sed praesentium. Quaerat vel ducimus reprehenderit ad.', 'Eum ipsa laudantium nobis.pdf', '', 'pdf', 254, 3, 12, 2, 12, 1934, 'Jenkins-Murazik', 'Prof.Reinger.  Augustus', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (63, 'Dolores molestiae.', 'Eum architecto qui aut aspernatur qui. Amet voluptatibus voluptatem eum qui. Sunt eum ad dolores. Nostrum rerum et ipsa cupiditate.', 'Dolorem vel hic qui consectetur libero est.pdf', '', 'pdf', 363, 6, 7, 8, 11, 2015, 'Runte-Howell', 'Prof.Daniel.  Jacky', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (64, 'Velit sed enim.', 'Velit qui aliquid in nihil sint voluptate. Error cupiditate adipisci quo molestias sit. Nemo ipsam consequatur eaque qui. Amet aliquam illum quam minima et. Et cum in animi ducimus omnis recusandae. Minima sit aut quae fuga aspernatur.', 'Nobis molestias sint eveniet nihil ea.pdf', '', 'pdf', 361, 15, 10, 9, 5, 2011, 'Steuber, McGlynn and Carroll', 'Prof.Conn.  Idella', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (65, 'Dolore inventore voluptatem.', 'Qui sed illo ullam ullam dolores aliquid in non. Accusantium optio dolorem voluptatibus reprehenderit doloribus. Dignissimos quia rerum excepturi non iure facilis. Voluptates vel asperiores recusandae id nobis voluptates unde ipsa.', 'Sit et sit neque eum ea sit deleniti.pdf', '', 'pdf', 405, 6, 8, 2, 20, 1989, 'Beahan-Schowalter', 'MissGrimes.  Scot', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (66, 'Est maxime.', 'Aperiam et beatae praesentium aperiam aut vel deserunt. Placeat fuga ut et nesciunt. Omnis molestiae incidunt tempora dolorem ex consequatur possimus.', 'Quidem unde facere corrupti sed explicabo.pdf', '', 'pdf', 571, 3, 6, 3, 27, 2022, 'Sporer, Johns and West', 'Prof.Kulas.  Bobby', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (67, 'Illo tenetur enim.', 'Fugiat iusto aliquid quia nihil libero praesentium. Commodi corporis vel aut quasi. Itaque dolores eveniet quam ipsum voluptatum eos. Tempore ut nobis et nobis. Qui nam velit cumque.', 'Totam molestias possimus nostrum id ipsa qui.pdf', '', 'pdf', 933, 6, 4, 8, 20, 1936, 'Murray Ltd', 'Dr.Pouros.  Toni', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (68, 'Enim soluta veniam.', 'Reprehenderit eveniet et aut consectetur. Aspernatur id debitis sed commodi. Exercitationem atque odio repellendus repellat debitis error accusantium. A quas iste expedita quis veritatis provident possimus et. Ad minus corrupti magnam magni.', 'Ut voluptates enim illo repellat.pdf', '', 'pdf', 979, 6, 9, 2, 14, 1939, 'Haley-Kerluke', 'Prof.Block.  Dane', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (69, 'Odio dolor.', 'Eum fuga maiores voluptates quo doloribus. Et nesciunt sunt molestias iste iusto tempore. Aperiam laborum reiciendis voluptates iusto quibusdam cumque labore. Aut fugiat sed distinctio iusto corporis amet necessitatibus.', 'Qui pariatur voluptas voluptatem.pdf', '', 'pdf', 216, 6, 1, 7, 25, 1992, 'Murray Inc', 'Prof.Gleason.  Rebekah', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (70, 'Soluta tenetur voluptatem.', 'In et est illum quam aliquam. Aliquid cupiditate ut dolorem officia. Voluptas eveniet tempora necessitatibus debitis tenetur. Sunt earum sit nulla facere id aut qui.', 'At ratione officiis voluptas reiciendis dolor.pdf', '', 'pdf', 987, 3, 8, 1, 2, 2004, 'McLaughlin Group', 'Mrs.Ortiz.  Martin', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (71, 'Eveniet voluptate et.', 'Fuga voluptatem et optio voluptatibus. Est consequatur et rem eveniet distinctio accusamus. Sint quod autem et. Sed officiis autem consequatur sit.', 'Officiis et doloribus est delectus non neque.pdf', '', 'pdf', 391, 6, 10, 3, 13, 1965, 'Huel PLC', 'Prof.Powlowski.  Rodolfo', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (72, 'Porro et.', 'Nesciunt exercitationem ducimus et. Inventore in excepturi asperiores qui. Consequuntur hic voluptas est eos cum expedita. Sunt reprehenderit atque perspiciatis veniam. Sit commodi libero quis velit. Id delectus accusamus aut nisi.', 'Et vel vitae facere assumenda dolor.pdf', '', 'pdf', 506, 3, 1, 5, 18, 1960, 'Connelly Ltd', 'Dr.Anderson.  Shanel', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (73, 'Impedit alias incidunt.', 'Consequatur deleniti placeat dolores minus aut voluptatem. Nesciunt enim adipisci praesentium architecto nostrum dignissimos culpa. Recusandae repudiandae dolor sunt rem ab neque temporibus qui. Asperiores dolor et quisquam soluta. Repellendus culpa tenetur similique quam sint.', 'Omnis enim doloribus sit quidem voluptate ipsa.pdf', '', 'pdf', 523, 6, 10, 1, 29, 2011, 'Gerlach PLC', 'Prof.Boehm.  Donna', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (74, 'Ut ea.', 'Quis et harum alias esse est. Vero nam ducimus nulla. Omnis et iure adipisci qui consequatur. Ipsa provident unde dolorum expedita. Eos quam perspiciatis repudiandae nam corporis aut libero.', 'Possimus reiciendis est et iusto laudantium ad.pdf', '', 'pdf', 410, 1, 9, 8, 20, 1994, 'Hermiston, Fisher and Stanton', 'Prof.Corkery.  Bailee', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (75, 'Corporis distinctio sit.', 'Quia et nihil ut omnis vel minima non. In reiciendis qui reiciendis magni nihil. Nesciunt qui est illo ut. Non et saepe sapiente fugiat et. Non veniam similique tempora excepturi accusantium. Ullam animi commodi provident quia voluptate.', 'Expedita esse quod omnis.pdf', '', 'pdf', 699, 6, 7, 8, 15, 1944, 'Lakin-Runolfsdottir', 'Prof.Quigley.  Josh', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (76, 'Non laudantium.', 'Omnis quia ad sunt ducimus at animi saepe. Voluptatem dolores nesciunt consectetur sint. Tempora porro cupiditate amet et ea. Sunt pariatur veritatis quasi commodi eveniet quia. In alias cum itaque assumenda.', 'Est beatae assumenda iusto quia ex animi.pdf', '', 'pdf', 681, 1, 1, 7, 7, 2002, 'Zemlak, Franecki and Schowalter', 'Prof.Treutel.  Floyd', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (77, 'Dolores autem doloribus.', 'Voluptas est consectetur voluptatem molestiae facere dolorem. Quae aliquid repellat omnis quo. Ex rerum quam ea dignissimos.', 'Voluptates ea enim et perferendis et et vero.pdf', '', 'pdf', 778, 15, 6, 3, 8, 2013, 'DuBuque-Dickinson', 'Prof.Kuvalis.  Jedidiah', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (78, 'Non unde.', 'Quo distinctio quae ullam qui beatae voluptas est magnam. Quibusdam quisquam quisquam nihil enim velit. Autem enim quis sed laudantium. Molestiae est maiores est harum perspiciatis et doloremque. Consectetur totam vel eligendi et et deserunt nesciunt.', 'Pariatur nostrum quisquam est ea dicta.pdf', '', 'pdf', 412, 3, 2, 8, 23, 1993, 'Dicki-Batz', 'MissAnderson.  Jany', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (79, 'Sed iusto distinctio.', 'Hic voluptates omnis libero. Consectetur exercitationem blanditiis commodi eveniet tempore id. Velit ullam id aut earum quis magnam et. Delectus et eos dicta ut adipisci voluptatem nulla quis. Quas aspernatur totam animi et eaque.', 'At quia libero nihil molestiae laboriosam.pdf', '', 'pdf', 836, 15, 8, 2, 5, 1945, 'Keeling Inc', 'Prof.Lesch.  Oren', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (80, 'Beatae nemo.', 'Sed nihil nam laborum modi. Rerum ut perspiciatis fuga neque libero vitae. Et nesciunt deserunt fugit nemo deserunt sunt. Recusandae porro optio sed qui. Eos repudiandae repellat inventore et at natus numquam.', 'Tempore tempore inventore facere et.pdf', '', 'pdf', 764, 3, 6, 4, 20, 1967, 'Flatley, Russel and Schmitt', 'Mr.Willms.  Jordane', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (81, 'Est et iure.', 'Nulla iure voluptas consequatur qui nihil aut. Nobis molestiae sit possimus ad et et. Ut velit cupiditate sapiente velit. Enim expedita vero doloremque voluptatem explicabo.', 'Ratione aliquid et possimus porro.pdf', '', 'pdf', 0, 3, 1, 10, 19, 1971, 'Reichel LLC', 'Mr.Dickinson.  Elouise', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (82, 'Tempora aut aut.', 'Saepe corporis impedit nesciunt. Mollitia nulla quos aliquid saepe dicta. Nihil deserunt quasi expedita consequatur. Quo sit ducimus quo tempora possimus recusandae id.', 'Provident id asperiores minus vel eveniet.pdf', '', 'pdf', 383, 3, 9, 1, 5, 1947, 'Bergnaum, Kuhlman and Halvorson', 'Mrs.Shanahan.  Isabel', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (83, 'Praesentium at qui.', 'Fugiat laudantium voluptatem assumenda qui est voluptatem molestiae. Odit autem provident aut similique. Exercitationem laudantium eum recusandae nihil voluptatem omnis explicabo.', 'Placeat mollitia qui aut nisi ut esse cumque.pdf', '', 'pdf', 97, 6, 1, 8, 11, 1978, 'Leuschke, Hayes and Ward', 'Ms.O\'Reilly.  Brandi', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (84, 'Quisquam saepe quae.', 'Similique possimus quia aut non atque et ut. Reiciendis atque recusandae quia eos nobis. Velit necessitatibus tempora hic vel velit consequatur modi cupiditate.', 'Vel cupiditate optio eaque id aut voluptate.pdf', '', 'pdf', 697, 15, 1, 8, 3, 1930, 'Lehner Inc', 'Prof.Kub.  Clinton', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (85, 'Laborum fuga.', 'Quas accusamus et tenetur sint eum quia. Consectetur sint veniam quasi dignissimos ea aut ea. Recusandae error voluptatem quibusdam. Quis porro quia necessitatibus. Sed accusamus distinctio saepe ab rerum ipsam dolorem molestiae. Iure blanditiis architecto perspiciatis mollitia rerum.', 'Vero quia qui et voluptatem id quis.pdf', '', 'pdf', 936, 1, 1, 9, 30, 1983, 'Sawayn-Zulauf', 'Prof.Schinner.  Amely', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (86, 'A molestias corporis.', 'Sit beatae eum ipsam qui atque. Mollitia architecto quod perferendis rerum est sint laborum. Error aut deleniti iure dicta placeat facere amet.', 'Temporibus est quia sunt. Et in aut nihil omnis.pdf', '', 'pdf', 635, 15, 3, 11, 13, 1977, 'Terry, Wisoky and Romaguera', 'Mrs.Renner.  Kaya', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (87, 'Quod tempore.', 'Distinctio fugiat dolor velit a numquam. Unde velit labore est provident iste voluptas porro asperiores. Rem sunt cumque sed vero dolores. Numquam vitae iure sint ut. Sequi ea sint velit velit qui ad vel. Eaque perspiciatis et deleniti eum sed.', 'Odit itaque totam tenetur quo vero voluptates.pdf', '', 'pdf', 449, 15, 9, 3, 1, 1990, 'Kshlerin and Sons', 'Dr.Paucek.  Leda', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (88, 'Et eos explicabo.', 'Cupiditate rerum adipisci natus amet occaecati eaque nostrum. Corporis recusandae optio est aut. Inventore ipsam est esse maiores maxime. Aut illo dolores dicta ut quae.', 'Et eius voluptatibus non quisquam sed.pdf', '', 'pdf', 268, 15, 7, 7, 5, 1990, 'Lehner, Ferry and Stracke', 'Prof.Feest.  Earnest', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (89, 'Voluptate doloremque.', 'Aliquam ipsum ratione illum dolores commodi reiciendis pariatur enim. Laudantium eveniet nostrum ipsum corrupti nisi velit. Molestias ut et dolorem consequatur perspiciatis modi. Similique consectetur officiis laboriosam corrupti ut. Voluptates fuga facere minima harum minima. Et ipsam quo quidem maxime quas.', 'Nam et rerum nesciunt.pdf', '', 'pdf', 351, 1, 7, 10, 30, 1935, 'Kuhlman Group', 'Mrs.Ferry.  Camylle', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (90, 'In libero.', 'Distinctio exercitationem qui ducimus aut. Eum et quasi ea molestiae magnam. Porro error adipisci voluptatem quo exercitationem repudiandae itaque. Et eius et ipsa voluptate deserunt quos enim. Odit dolorem voluptatum beatae in doloremque amet ab omnis. Dolor dicta non deserunt.', 'Earum nostrum earum et voluptatem harum mollitia.pdf', '', 'pdf', 942, 15, 11, 7, 6, 2001, 'Funk PLC', 'Prof.Stehr.  Jaydon', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (91, 'Quo aut.', 'Nobis recusandae tempora fugiat in non. Voluptatem eum magni cupiditate ut alias. Est quia nobis repudiandae harum. Repudiandae pariatur consequuntur molestias ut ratione aut facere. Tenetur et sit quos blanditiis laudantium.', 'Facilis harum perferendis et cum doloribus et.pdf', '', 'pdf', 641, 6, 2, 9, 7, 1972, 'Thompson, Haley and Miller', 'Dr.Stoltenberg.  Hope', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (92, 'Impedit velit aut.', 'Et omnis iure quis quasi et a animi. Ut illum et quia voluptas. Veniam eos quisquam vel aut dolorem ex et.', 'Ut quo ut sint.pdf', '', 'pdf', 795, 1, 11, 4, 15, 1961, 'Swaniawski-Ziemann', 'Mr.Russel.  Lynn', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (93, 'Magnam delectus omnis.', 'Esse ipsam quis nisi ut laboriosam quis sunt non. Fuga hic repellendus veritatis nulla autem nihil sit. Aut omnis soluta quis sequi repudiandae numquam. Iste architecto vel minima quia animi quidem iste dolores.', 'Et dolor omnis qui dolores veritatis.pdf', '', 'pdf', 892, 3, 7, 5, 13, 1989, 'Stehr PLC', 'Ms.Effertz.  Ned', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (94, 'Velit ratione aut.', 'Odit earum labore ad enim omnis. Quisquam enim magni molestiae quo et aliquam. Quidem occaecati et eligendi omnis. Possimus et facilis est deserunt. Quas ut praesentium tenetur pariatur modi reprehenderit.', 'Beatae molestiae quaerat delectus et.pdf', '', 'pdf', 529, 3, 11, 10, 23, 2020, 'Barton, Spinka and Prosacco', 'Mr.O\'Kon.  Cristal', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (95, 'Blanditiis harum eaque.', 'Enim in provident quisquam eum hic quidem. Porro qui et molestiae omnis. Alias ut vel et nulla praesentium ipsam. Consequuntur et est numquam molestiae. Consequuntur omnis laboriosam qui pariatur. Quia nisi nisi ab et.', 'Fugit praesentium sint et temporibus et.pdf', '', 'pdf', 36, 15, 1, 8, 21, 2003, 'Kshlerin, Dach and Morissette', 'Prof.McLaughlin.  Sydney', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (96, 'Qui incidunt.', 'Doloremque veniam earum maiores est. Omnis recusandae dignissimos fuga id perspiciatis est hic. Omnis a blanditiis recusandae dignissimos cupiditate debitis.', 'Atque quis sit quas qui atque.pdf', '', 'pdf', 160, 3, 11, 9, 18, 1933, 'Terry Group', 'Dr.Spinka.  Jalon', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (97, 'Et dicta ad.', 'Ea sint illo fugit rerum quidem laudantium qui. Aliquid ut tempore sit dolorem alias rerum molestias. Dolor aut et corrupti illum et voluptatem.', 'Praesentium fugiat aut aut aut.pdf', '', 'pdf', 164, 15, 5, 7, 2, 1982, 'Donnelly-Ratke', 'Mr.Grady.  Lacy', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (98, 'Molestiae saepe maiores.', 'Et voluptas voluptatem mollitia dolores quibusdam enim ut ipsum. Dolorem occaecati vel doloribus similique expedita itaque eos consequatur. Aut adipisci assumenda atque. Et temporibus cupiditate enim eaque dolores nostrum excepturi. Quaerat qui sed dolore cumque odit sunt ut.', 'Dignissimos earum iste officia corporis.pdf', '', 'pdf', 656, 6, 9, 8, 10, 1967, 'Schumm LLC', 'Prof.Effertz.  Bethany', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (99, 'Est non consequatur.', 'Et non accusantium veniam recusandae nesciunt. Ea dolor commodi aut nemo. Ut deleniti aspernatur repellendus ex consequatur itaque. Est eos et quaerat. Incidunt deleniti blanditiis perspiciatis quis hic aut et. Eveniet sed officiis adipisci quia nesciunt.', 'Illo est quia nihil laborum qui saepe et.pdf', '', 'pdf', 374, 6, 9, 6, 20, 2002, 'Shanahan PLC', 'Dr.Quigley.  Sarah', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (100, 'Consequatur quis.', 'Eos quia aliquam consequatur at illum minima debitis autem. Fugiat cupiditate ut quasi nulla sunt qui ullam porro. Iste ut ut commodi dolore.', 'Voluptas laboriosam sit ad omnis.pdf', '', 'pdf', 302, 1, 9, 11, 8, 2015, 'Wolf Inc', 'Dr.Greenfelder.  Kristina', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (101, 'Ad cumque.', 'Illum itaque eaque alias neque officia. Et aut repudiandae harum omnis molestias. Et numquam exercitationem qui voluptatem. Optio reprehenderit optio recusandae repudiandae beatae repellat.', 'Nesciunt dolor et quae.pdf', '', 'pdf', 491, 3, 1, 4, 22, 1957, 'Douglas Inc', 'Prof.Balistreri.  Salvatore', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (102, 'Qui reprehenderit qui.', 'Libero qui id repudiandae dolore voluptatem quisquam. Consectetur et eligendi et et molestias. Dolores magni libero et quo quis. Dolor ipsa ipsa autem ratione in facilis sed consectetur. Eveniet minima atque ea.', 'Doloribus ut officiis qui facere enim esse.pdf', '', 'pdf', 786, 3, 8, 11, 3, 1985, 'Huel LLC', 'MissStamm.  Felix', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (103, 'Doloribus et et.', 'Non voluptates dolorem sed aut ea. Aspernatur deserunt dolor quia enim cupiditate porro. Enim nesciunt adipisci dolorem eveniet aut. Voluptas aut quod aut recusandae velit consequatur. Illo perferendis ipsum voluptas ducimus.', 'Deleniti nam qui atque sint.pdf', '', 'pdf', 175, 15, 7, 4, 12, 1934, 'Franecki LLC', 'Mr.Mayer.  Otto', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (104, 'Quis excepturi.', 'Natus placeat qui et sunt praesentium recusandae. Itaque et praesentium adipisci. Deleniti ut voluptate perferendis sed quas illum. Adipisci est tempore id exercitationem qui adipisci. Qui harum consequatur est autem qui minima at.', 'Nam voluptas cupiditate aspernatur amet.pdf', '', 'pdf', 579, 15, 10, 5, 5, 2002, 'Adams-Heaney', 'Prof.DuBuque.  Ashton', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (105, 'Recusandae harum ut.', 'Omnis ea et dolorem voluptas tenetur quae. Animi qui libero et assumenda vero dolorem cum. Dicta ad est expedita reiciendis aut ducimus et molestias. Nihil cumque animi id neque.', 'Magnam iste est suscipit iusto doloremque.pdf', '', 'pdf', 465, 3, 11, 3, 11, 1988, 'Goodwin-Volkman', 'MissKertzmann.  Bernadette', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (106, 'Ullam expedita.', 'Perferendis aut aut ut et. Temporibus repellendus aliquam ut nam assumenda. Animi dolorum nobis voluptas quas harum odio voluptas. Est repellendus aliquid ut aliquid maxime vel non. Quasi cumque ea in magni adipisci corrupti. Sit et quos reiciendis.', 'Id quibusdam placeat culpa.pdf', '', 'pdf', 663, 15, 1, 5, 7, 1943, 'Kessler, Macejkovic and Hermann', 'Prof.Turcotte.  Columbus', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (107, 'Autem quis.', 'Cumque optio expedita nihil aut. Praesentium cupiditate provident qui excepturi. Aliquam delectus consequatur qui quo rem minima impedit. Enim distinctio libero eaque. Amet qui consequuntur debitis facilis. Et dolorum quaerat iste sed earum.', 'Ut id voluptatem est incidunt molestiae dicta in.pdf', '', 'pdf', 153, 1, 11, 6, 6, 1968, 'Wilkinson LLC', 'Mr.Donnelly.  Hal', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (108, 'Aut qui.', 'Corrupti sit quia distinctio animi non laboriosam aspernatur. Quaerat aut omnis commodi consequuntur numquam aut. Et modi earum pariatur esse rem nemo quidem quisquam. Assumenda expedita vitae ut eligendi quaerat. Aut consequatur corrupti voluptas numquam. Qui pariatur quo praesentium explicabo.', 'Sed ducimus distinctio aut.pdf', '', 'pdf', 708, 15, 10, 5, 17, 2002, 'Stark-Lockman', 'Dr.Kerluke.  Grayson', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (109, 'Excepturi et.', 'Eos libero excepturi ex omnis. Eveniet corrupti voluptas nesciunt architecto praesentium suscipit animi. Et facilis laboriosam dolores saepe perferendis sit. Consequatur velit molestiae neque beatae. Distinctio amet facere impedit et aliquid. Sint reprehenderit magnam harum et.', 'Qui quos ut ab et repudiandae facilis voluptas.pdf', '', 'pdf', 847, 3, 9, 9, 27, 1949, 'Bruen-Bartoletti', 'Prof.Bogan.  Lura', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (110, 'Reprehenderit natus.', 'Nesciunt qui placeat sed corrupti reprehenderit. Veritatis ipsum consequatur eos dolore illo. Nam est deleniti eum. Et voluptas aut corrupti quia ea vel.', 'Libero adipisci omnis maxime odit.pdf', '', 'pdf', 532, 1, 4, 5, 13, 1981, 'Ebert Ltd', 'Prof.Monahan.  Harry', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (111, 'Occaecati maiores quos.', 'Voluptas blanditiis porro voluptas culpa recusandae. Facilis et mollitia dolore quaerat autem voluptate repellat. Rerum qui voluptatem voluptatem ipsa. Consequatur saepe blanditiis rerum totam. Distinctio ea debitis adipisci in sit ullam.', 'Labore vel sapiente voluptatem alias.pdf', '', 'pdf', 887, 1, 10, 4, 1, 2016, 'Heathcote-Schiller', 'Prof.Anderson.  Aaron', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (112, 'Laborum sunt.', 'Libero facilis ut incidunt illo rerum. Et amet et doloremque quis dolor provident. Consequatur rerum velit maiores ipsam aperiam et commodi fuga. Soluta repellat molestiae est veritatis doloribus laudantium sed.', 'At qui est atque voluptatem neque.pdf', '', 'pdf', 833, 3, 12, 4, 21, 2013, 'Heaney-VonRueden', 'Prof.Bogan.  Laverna', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (113, 'Molestiae aut.', 'Facere perspiciatis ipsam aut nesciunt aut. Dicta magnam et reprehenderit error ut. Rerum eum possimus harum aut porro accusamus. Et aut dolorem tempore.', 'Ad laudantium commodi nisi id architecto.pdf', '', 'pdf', 217, 3, 4, 9, 4, 1937, 'Gleichner-Koelpin', 'Dr.Johns.  Betty', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (114, 'Amet perspiciatis ut.', 'Pariatur minima quam quisquam. Velit illo deserunt assumenda non laudantium magni. Ut consequuntur nesciunt sequi nihil voluptatibus et exercitationem. Debitis reprehenderit aperiam eius architecto ullam. Qui qui ab fuga minus culpa aut ab. Corrupti eos doloribus architecto ipsam voluptas.', 'Exercitationem ea omnis qui.pdf', '', 'pdf', 907, 15, 5, 4, 13, 2019, 'Fisher Group', 'Mrs.Goldner.  Lavern', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (115, 'Aut consequatur.', 'Totam eos dolore vero qui. Qui dicta repudiandae incidunt aut. Nihil est qui pariatur in explicabo dolor maiores. Ducimus molestias impedit nobis in.', 'Sit quibusdam consequuntur illum et ducimus.pdf', '', 'pdf', 283, 6, 11, 4, 3, 1941, 'Gislason and Sons', 'Dr.Reichert.  Clemens', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (116, 'Enim praesentium.', 'Omnis qui voluptatem quia exercitationem. Nesciunt ratione ducimus labore quas veniam maxime minus aut. Sequi dolore pariatur numquam voluptates voluptatem et. Itaque at laboriosam ut omnis ipsam et qui. Iusto quasi reiciendis aut quis aut. Eum quia ipsum nostrum maiores.', 'Quibusdam consequatur cumque id.pdf', '', 'pdf', 640, 1, 7, 7, 8, 1952, 'Jacobson and Sons', 'Ms.Marvin.  Martin', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (117, 'Quis quia.', 'Pariatur et quia aut assumenda nemo sunt molestiae. Occaecati aut similique eum reiciendis quis consequatur consequuntur in. Optio et sapiente dolor non.', 'Quo voluptatem doloremque non ad at.pdf', '', 'pdf', 162, 6, 4, 3, 4, 2000, 'Barrows-Ryan', 'Prof.Jenkins.  Carrie', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (118, 'Error doloribus quas.', 'Praesentium doloremque ut enim omnis voluptatem fugiat quia. Ratione magnam occaecati nobis rem. Omnis commodi quae doloremque impedit corrupti omnis commodi.', 'Consequatur ut laborum quis magni.pdf', '', 'pdf', 314, 6, 7, 4, 3, 1946, 'Windler-Bernhard', 'Mr.Graham.  Annie', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (119, 'Nam cumque.', 'Aut dolores voluptas unde est eos iste nihil eius. Quia dolores quasi beatae optio. Suscipit eius et ut qui reprehenderit.', 'Consequatur voluptatem odit aut in aut dolorem.pdf', '', 'pdf', 138, 6, 3, 7, 20, 2007, 'Schamberger-Larson', 'Prof.O\'Kon.  Broderick', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (120, 'Dignissimos voluptate dignissimos.', 'Ab sapiente ut voluptas inventore qui provident quia. Fugit ut consequuntur dolores unde labore. Officia ducimus soluta nihil eveniet occaecati. Dolorem recusandae aliquid rerum consequatur quis nihil. Dignissimos eum voluptatem deserunt aliquid.', 'Sit quibusdam sit magnam.pdf', '', 'pdf', 754, 3, 4, 5, 20, 2012, 'Runte-Mills', 'MissHeaney.  Kimberly', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (121, 'Fugiat itaque quo.', 'Doloremque molestiae amet sit id debitis tempora. Rem voluptatem iste et et. Voluptas mollitia expedita enim excepturi incidunt alias nesciunt. Autem quidem fuga in assumenda voluptatibus.', 'Ut sit dolores pariatur culpa atque.pdf', '', 'pdf', 930, 6, 5, 5, 7, 1948, 'Mosciski, Kris and Rempel', 'Dr.Bergstrom.  Mozelle', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (122, 'Perferendis rem ipsa.', 'Quae ad illum magnam commodi sint iure inventore. Aut doloribus nulla velit sapiente non repellat consequatur. Illo perferendis eos qui natus. Aut qui fugiat nobis.', 'Quaerat odio ut consectetur quae.pdf', '', 'pdf', 291, 3, 9, 1, 4, 2009, 'Pfannerstill, Haley and Gerlach', 'Dr.Waelchi.  Nayeli', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (123, 'Et nobis.', 'Placeat ut ipsam incidunt quos alias. Sunt odit id eum sapiente eligendi. Atque facilis sed impedit officia delectus quam.', 'Sint perspiciatis est unde deserunt.pdf', '', 'pdf', 290, 1, 12, 7, 15, 2014, 'Stroman-Schaden', 'Prof.Kshlerin.  Daniela', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (124, 'Ea in.', 'Architecto repudiandae molestiae excepturi molestiae. Ab neque aliquam in nihil aut ut veniam dolores. Ipsum neque nisi temporibus expedita.', 'Laborum in quod magni repudiandae dolores sunt.pdf', '', 'pdf', 41, 15, 1, 3, 17, 1934, 'Pfeffer and Sons', 'Mr.West.  Delaney', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (125, 'Fugiat veritatis ex.', 'Cumque qui qui molestiae. Soluta illum molestiae officia saepe sed. Velit et corporis deserunt delectus et enim. Reprehenderit provident deserunt nulla veniam sed facilis voluptas.', 'Ad ut et blanditiis qui.pdf', '', 'pdf', 747, 15, 11, 11, 5, 1983, 'Muller and Sons', 'Dr.Anderson.  Mose', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (126, 'Facere cum.', 'Sunt laborum harum consequatur voluptatum nesciunt vitae. Sunt expedita vitae et distinctio et dolor laborum. Eius sit similique soluta nemo. Ut illum aliquam debitis cupiditate et quia quo.', 'Repudiandae esse autem doloribus.pdf', '', 'pdf', 49, 15, 3, 3, 11, 1981, 'O\'Keefe, Little and Reynolds', 'Dr.Runte.  Yazmin', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (127, 'Mollitia in qui.', 'Odio qui tempora eaque ad. Quas est quo quos. Et possimus commodi possimus exercitationem adipisci hic ea. Cumque sint consectetur odit. Deleniti ducimus quas possimus quam suscipit veniam.', 'Consectetur consequuntur possimus fugit illo.pdf', '', 'pdf', 915, 3, 2, 9, 2, 1986, 'Anderson Group', 'Dr.Beier.  Freddie', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (128, 'Laudantium eaque non.', 'Deleniti doloribus ducimus recusandae. Sapiente eius vel sint dolorem aliquam amet. Aut mollitia enim sapiente sunt accusamus. Quasi iusto quia accusamus. Nihil voluptates dolor voluptate quam molestias.', 'Id est dolorum impedit placeat eligendi.pdf', '', 'pdf', 163, 3, 8, 8, 17, 1973, 'DuBuque-Reichert', 'Mr.Treutel.  Abdul', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (129, 'Optio laboriosam.', 'Tenetur quis ad doloribus reiciendis animi iste illum. Placeat est dolorum voluptatem ipsum. Sed dolorem nostrum tempore dolores doloribus voluptate magni. Soluta ullam dignissimos dicta ipsa. Id nisi officia quidem reiciendis nulla aut.', 'Aspernatur ducimus asperiores non rem.pdf', '', 'pdf', 49, 6, 6, 7, 13, 2010, 'Dicki, Block and Ryan', 'Prof.Labadie.  Rosalind', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (130, 'Occaecati itaque.', 'Earum necessitatibus animi eos commodi est at libero. Laudantium voluptatem nemo qui omnis et. Eum aspernatur vero consequatur voluptatem dolor et atque. Velit ex totam nam earum.', 'Ipsa odit repellat molestiae.pdf', '', 'pdf', 721, 15, 11, 7, 19, 1949, 'Bogan Group', 'Prof.Reichel.  Amina', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (131, 'Tempora quia.', 'Ipsum ipsa ut distinctio perspiciatis et id. Aperiam numquam dolores nesciunt nemo sint pariatur excepturi. Pariatur voluptatum est consequatur velit minus id nulla. Voluptas autem adipisci necessitatibus nihil voluptatem quidem. Qui saepe dolorem expedita sint dolores quidem quia aperiam. Inventore voluptatem sunt recusandae non.', 'Eaque nisi in ut repellat.pdf', '', 'pdf', 750, 6, 1, 2, 14, 2015, 'Graham-Romaguera', 'Mrs.Donnelly.  Jolie', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (132, 'Pariatur voluptatum neque.', 'Corporis mollitia vel delectus et pariatur consequuntur voluptatem. Eligendi et molestiae rerum quia consequuntur distinctio ex. Ut quas pariatur exercitationem veniam reiciendis eum. Vel sunt optio illo molestiae est consequatur. Iure aliquid cum quia.', 'Voluptatem nemo veniam qui sed.pdf', '', 'pdf', 687, 1, 11, 1, 19, 2017, 'Hane-Gusikowski', 'Ms.Monahan.  Princess', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (133, 'Similique corrupti accusamus.', 'Itaque ad reprehenderit ipsum aliquid ut alias. Suscipit consequatur debitis facere qui quae deserunt ut. Quisquam id voluptatem quia voluptatem qui explicabo nesciunt voluptatum.', 'Deserunt et aut sit officia adipisci ea.pdf', '', 'pdf', 44, 3, 4, 3, 28, 1939, 'Heidenreich-Cummings', 'Mr.Runte.  Virgie', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (134, 'Quia fuga in.', 'Esse nihil consequuntur nulla omnis doloribus cupiditate ut. Perspiciatis earum quaerat at. Harum esse mollitia quae ea non. Doloremque voluptatum est aperiam et earum.', 'Quasi suscipit qui nobis ut qui rerum eius.pdf', '', 'pdf', 382, 3, 4, 4, 26, 2006, 'Wunsch Inc', 'Dr.Lebsack.  Parker', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (135, 'Nihil velit velit.', 'Ipsum minus vel ut. Odio nam rerum odit voluptates est perferendis fugit. Sed hic aliquam corrupti ea. Esse doloribus repudiandae asperiores rerum qui aliquid doloribus. Modi soluta et esse praesentium enim.', 'Vel nulla alias voluptate suscipit maxime.pdf', '', 'pdf', 864, 1, 7, 9, 10, 1993, 'Cronin Group', 'Dr.Breitenberg.  Jean', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (136, 'Eius quam.', 'Qui nihil quidem modi quas. Doloribus id eum ipsam. Qui iste repellat est est ut voluptatem totam. Dolor velit veritatis ipsa voluptas consequatur ut.', 'Debitis non sapiente hic illo.pdf', '', 'pdf', 187, 3, 11, 10, 24, 1948, 'Runolfsson, Anderson and Bins', 'Dr.O\'Reilly.  Stacy', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (137, 'Natus amet.', 'Vel ut rerum eveniet sunt doloribus quia quas. Incidunt officiis facilis nostrum omnis. Nihil ducimus porro molestiae enim nihil. Ut doloremque totam iure et. Nemo at ut quas minus excepturi. Et nobis aspernatur autem enim reiciendis a non.', 'Exercitationem sed voluptates nihil sunt libero.pdf', '', 'pdf', 627, 3, 6, 8, 17, 1943, 'Waelchi and Sons', 'Mr.Kuphal.  Aubrey', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (138, 'Fugit harum.', 'Et libero vel laborum laborum quia. Maxime et autem amet quaerat quo distinctio. Distinctio dolorem quo qui voluptate excepturi hic. Qui hic tempore qui recusandae sit.', 'Eius ea aut atque nesciunt repellendus est.pdf', '', 'pdf', 738, 3, 11, 8, 9, 1976, 'White LLC', 'Mrs.Kiehn.  Shaniya', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (139, 'Sed aut.', 'Sit numquam velit voluptatum voluptatum voluptas nemo sed. Ab voluptatum assumenda doloribus quod necessitatibus. Est beatae reprehenderit voluptates saepe minus totam. Mollitia et nulla accusantium perferendis libero tenetur ut. Provident sint non fugiat praesentium.', 'Iste accusamus inventore aspernatur ut.pdf', '', 'pdf', 936, 6, 11, 3, 10, 1988, 'Nikolaus, Abbott and Hermiston', 'Dr.Turcotte.  Leora', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (140, 'Consequatur nemo.', 'Aut minus velit rerum voluptas quae placeat aliquid. Error laborum velit et. Necessitatibus nemo id voluptatem fugiat deleniti. Cum sed voluptas illo debitis sed ea. Impedit libero quo dolore recusandae et vel perferendis.', 'Aut hic dolores ex officia nesciunt.pdf', '', 'pdf', 84, 3, 9, 4, 21, 1947, 'Dooley, Heller and Stanton', 'Prof.Stoltenberg.  Taryn', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (141, 'In consectetur aspernatur.', 'Non ipsa excepturi aspernatur pariatur eius. Illum nulla dolor vitae. Totam distinctio repudiandae est voluptate delectus nihil delectus.', 'Quasi in et earum ea.pdf', '', 'pdf', 56, 6, 7, 3, 1, 1953, 'Torphy, Fahey and Blanda', 'Dr.Schmeler.  Ismael', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (142, 'Assumenda molestiae illo.', 'Delectus velit possimus alias commodi eius incidunt. Cupiditate ullam officia nam vitae. At incidunt quia aut quidem consectetur. A qui id sunt sed amet et.', 'Ut nam necessitatibus porro recusandae ut sed.pdf', '', 'pdf', 380, 1, 3, 10, 18, 1949, 'Bernier and Sons', 'Ms.Streich.  Columbus', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (143, 'Excepturi aut.', 'Beatae aut ut laudantium iure totam voluptatibus. Et officia assumenda accusantium commodi asperiores rem rerum fugit. Consequuntur perferendis eum quidem iure quis rerum.', 'Non veniam nam quia numquam.pdf', '', 'pdf', 129, 3, 8, 4, 27, 2000, 'Kunde Inc', 'Prof.Bauch.  Claire', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (144, 'Asperiores sequi.', 'Eaque laborum unde tempora officia dolorum. Illo aut omnis quas itaque quas tempore quia. Vero libero eum sit beatae mollitia. Eum distinctio neque iusto sunt.', 'Quam dolore ipsa optio ut similique qui amet.pdf', '', 'pdf', 916, 3, 6, 3, 8, 1943, 'Streich-Hauck', 'Prof.Hettinger.  Syble', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (145, 'Quidem eaque.', 'Velit aut occaecati quaerat veritatis eum quo. Inventore veritatis est id nulla non rerum. Sequi dolor voluptatum iusto. Voluptatibus laudantium hic ea aut omnis veniam.', 'Eum rerum voluptas praesentium et error.pdf', '', 'pdf', 522, 1, 11, 3, 23, 1955, 'Reichel, Rutherford and Weimann', 'Prof.Larkin.  Jaydon', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (146, 'Culpa sunt et.', 'Corrupti rerum velit cupiditate ab et ex. Et quidem doloribus excepturi et. Voluptatem asperiores sit quisquam aut quo dolores. Impedit nisi deserunt sed aut reiciendis sit tempora.', 'Est ut eos tenetur occaecati nulla.pdf', '', 'pdf', 686, 15, 1, 7, 26, 1945, 'Bauch and Sons', 'Mr.Reinger.  Xander', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (147, 'Eligendi libero.', 'Quae doloremque sit et est neque commodi et. Et voluptate dicta natus quis et dolorem. Aut ut et modi magni eos et consectetur. Architecto dolores ex ut ullam facere.', 'Non et ut molestiae dolore omnis.pdf', '', 'pdf', 242, 15, 5, 11, 14, 1952, 'Jacobson, Stoltenberg and Fisher', 'Prof.Parisian.  Gina', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (148, 'Dolores et consequatur.', 'Excepturi sed voluptatibus ad molestiae inventore laudantium mollitia porro. Molestias aliquid eos harum excepturi eligendi neque. Consequatur dolore expedita non. Dolorem aliquam sunt qui ut molestiae voluptatibus. Consequatur minus quia eos.', 'Rerum cumque et culpa praesentium.pdf', '', 'pdf', 769, 3, 9, 6, 17, 1963, 'Willms Group', 'Dr.Kutch.  Ashley', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (149, 'Est placeat explicabo.', 'Harum fuga dolor maiores dolores libero ducimus. Qui id placeat officiis nihil eos. Ipsa sunt quidem fuga ipsa. Officiis assumenda libero accusantium incidunt nobis eos eum sint. Tempora exercitationem et ducimus sit dolorem quis. Consequuntur odio eius corporis placeat ipsam.', 'Rerum sed et dolorum.pdf', '', 'pdf', 570, 3, 11, 2, 21, 1977, 'Fay-Stamm', 'Prof.Kunze.  Korbin', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (150, 'Impedit consequuntur.', 'Tempora saepe et excepturi quia aliquam eaque. Alias possimus provident ex. Dolores consequuntur facere aperiam sit ducimus nihil totam ab. Voluptatum vel pariatur praesentium tempora. Eos aliquid harum id ab. Laboriosam qui consequatur est nam sed vero dolorem.', 'Non fugiat qui sint.pdf', '', 'pdf', 965, 6, 10, 10, 24, 1963, 'Skiles, Murray and Gutkowski', 'Mr.Wiza.  Peggie', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (151, 'Tempore autem veniam.', 'Inventore tenetur ullam excepturi facilis et. Ut doloribus odit nihil cupiditate. Et ut qui accusantium commodi. Quisquam sint sed labore consequatur fuga expedita.', 'Dolorem autem quod adipisci ad non impedit.pdf', '', 'pdf', 995, 3, 1, 9, 18, 1947, 'Johnson-Cruickshank', 'Prof.Mertz.  Arvid', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (152, 'Iste consequatur.', 'Aperiam voluptatem dolor dolores. Quis fugit magni maxime et autem. Vero ex et impedit commodi. Facilis qui necessitatibus quis molestiae eius repellat.', 'Laudantium omnis id provident similique qui.pdf', '', 'pdf', 675, 3, 3, 4, 25, 1965, 'Konopelski Group', 'Ms.Heller.  Rafaela', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (153, 'Voluptatem veniam necessitatibus.', 'Deleniti fugiat voluptatem maxime asperiores. Sunt ratione optio porro voluptate vel beatae sit at. Consequatur sunt ipsam ut minima. Ipsum id et voluptatem repellendus et aut nisi. Excepturi assumenda blanditiis sit eum eos quos.', 'Porro porro voluptatum laborum ipsa eos sint.pdf', '', 'pdf', 79, 6, 9, 3, 25, 2013, 'Mraz, Stroman and Kutch', 'Dr.Buckridge.  Grover', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (154, 'Explicabo ipsam reprehenderit.', 'Molestiae ipsam eos laborum aliquam ea enim et. Nesciunt in blanditiis consequuntur beatae. Impedit omnis quod in aut deserunt. Officiis omnis rem rerum pariatur magni dolor et.', 'Qui odit similique reiciendis sed ad est.pdf', '', 'pdf', 25, 3, 2, 5, 21, 1944, 'Hermann-Eichmann', 'Dr.Klocko.  Chaya', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (155, 'Libero earum et.', 'Optio voluptas assumenda voluptas maxime veritatis. Optio totam libero eius tempora nostrum ipsam. Suscipit voluptatibus enim et consequatur. Dolorum saepe vel voluptate quam.', 'Et corrupti nisi dolorem possimus deserunt porro.pdf', '', 'pdf', 255, 1, 2, 7, 1, 1981, 'Wisozk PLC', 'Dr.Stroman.  Gaetano', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (156, 'Aut officiis.', 'Cum laudantium optio repudiandae maiores quis. Sed est nostrum illum delectus. Neque aut voluptate est. Reiciendis aut facere quam molestiae.', 'Inventore quia dolores ullam.pdf', '', 'pdf', 751, 1, 3, 11, 17, 2012, 'Murphy-Schaden', 'Prof.Senger.  Kassandra', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (157, 'Aliquid sed.', 'Voluptas est error est quo ut ullam. Veniam quasi assumenda eius molestias quod nesciunt. Unde autem nihil et ut sunt recusandae qui est. Magnam dolor qui odit et quis fugit. Dolorum velit et ab est.', 'Ad molestiae optio odit dolorum maiores est.pdf', '', 'pdf', 901, 1, 2, 5, 10, 1950, 'Stehr-Mayert', 'Mr.Marquardt.  Triston', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (158, 'Fuga aperiam numquam.', 'Rerum qui voluptas dolore. Distinctio voluptates magni quis adipisci. Recusandae et asperiores quidem impedit nihil. Eligendi facilis alias non doloremque. Tempora ut reprehenderit mollitia iusto.', 'Voluptas consequatur veritatis voluptas possimus.pdf', '', 'pdf', 82, 15, 4, 5, 7, 1960, 'Huel, Barrows and Bernhard', 'MissSchuppe.  Erick', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (159, 'Dolor distinctio ex.', 'Autem repudiandae enim non quaerat voluptatem accusantium. Voluptatem est quasi perferendis voluptatem libero voluptas velit. Accusantium ipsa eos consequatur ex nihil.', 'Provident nisi laboriosam consequatur illum.pdf', '', 'pdf', 787, 3, 7, 8, 27, 1943, 'Hills, Bailey and Heller', 'Dr.Robel.  Abdul', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (160, 'Qui porro aliquam.', 'Dicta nesciunt quasi debitis ex itaque ut. Omnis culpa perspiciatis ut est sit. Placeat deserunt corrupti est corrupti temporibus dolorum natus rem.', 'Quam nisi sed eligendi laudantium a.pdf', '', 'pdf', 191, 1, 1, 5, 23, 2012, 'Satterfield-Schumm', 'MissLemke.  Rahsaan', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (161, 'Id voluptas.', 'Ut iste expedita est aut est aut qui. Laborum distinctio distinctio aperiam nihil in sint. Aperiam totam est vel consectetur. Officia voluptatum cumque eaque molestias molestias qui voluptates atque. Non iste eius et at dolorem dolore. Aspernatur neque minima quas corporis et architecto.', 'Et aperiam veniam ipsa aliquid.pdf', '', 'pdf', 205, 3, 6, 8, 4, 1956, 'Collier Inc', 'Prof.Kohler.  Lavada', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (162, 'Impedit numquam.', 'Odit repellendus deleniti vitae expedita. Totam placeat non quia beatae minima. Ex id non blanditiis voluptatum eos aut natus exercitationem.', 'Laboriosam nulla dolores dolores.pdf', '', 'pdf', 288, 3, 8, 9, 13, 1980, 'Stroman, Funk and Hansen', 'Prof.Crona.  Taylor', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (163, 'Id accusamus.', 'Ut consectetur iste laborum rem facilis eveniet officia. Non unde odit consequatur consectetur illo incidunt ullam. Optio ad quam fuga vel rerum explicabo. A aut quia nesciunt provident.', 'Assumenda dolorum voluptatem quo.pdf', '', 'pdf', 117, 6, 8, 11, 26, 1939, 'Jakubowski, Rowe and Balistreri', 'Mr.O\'Conner.  Lyla', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (164, 'Inventore aliquid.', 'Ullam ea laudantium iusto dolor omnis illum quisquam. Porro et necessitatibus ipsa. Maiores eos unde eos omnis voluptatem quidem. Sit aspernatur placeat totam qui.', 'Perspiciatis voluptatem molestiae nemo id non.pdf', '', 'pdf', 776, 6, 2, 5, 29, 1986, 'Bechtelar-Balistreri', 'Prof.Rice.  Steve', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (165, 'Error earum aut.', 'Vel nihil neque ipsa sed. Aliquid saepe aut enim nulla nulla dolores. Odit alias quia harum consequatur sit odio. Ut laudantium quia consequatur saepe illum. Eius accusamus aut quos magni necessitatibus illo voluptas.', 'Dolores voluptatem aut praesentium.pdf', '', 'pdf', 155, 3, 10, 7, 30, 1986, 'Herzog-Abernathy', 'Mr.Hauck.  Dallas', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (166, 'Esse recusandae.', 'Natus mollitia ipsam laboriosam. Dolores neque et deserunt harum. Eos totam deserunt voluptate debitis aut eius expedita. Quasi similique voluptatibus quo aperiam.', 'Harum totam molestiae doloribus blanditiis.pdf', '', 'pdf', 114, 3, 2, 5, 15, 1988, 'Rohan-Koch', 'Dr.Hayes.  Bulah', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (167, 'Quisquam et inventore.', 'Non sed dolores assumenda est odio et quia. Et quasi placeat ut adipisci voluptas nobis sint. Libero vitae in aut impedit animi quae. Sapiente officiis molestias quia est aut et. Eum et eligendi sequi voluptate.', 'Nobis enim qui omnis aut quae impedit itaque.pdf', '', 'pdf', 489, 1, 10, 11, 7, 2003, 'Lind, Lesch and Leuschke', 'Dr.Runolfsdottir.  Johnny', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (168, 'Nam animi saepe.', 'Incidunt dolor sint quia laborum. Fuga qui debitis molestias officiis incidunt dolores. Explicabo quia dicta quos tenetur. Dolore beatae quo et distinctio blanditiis velit. Deleniti sit et nostrum. Dicta eum sequi tenetur voluptatem iusto nam.', 'Quo quo nesciunt aut nihil illum aliquam.pdf', '', 'pdf', 586, 6, 4, 11, 14, 1962, 'McGlynn and Sons', 'MissKonopelski.  Chyna', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (169, 'Esse voluptatem.', 'Sed facilis facilis suscipit tempora ad. Quasi debitis aut nesciunt occaecati. Et commodi voluptas placeat corporis.', 'Reprehenderit architecto et eum ea.pdf', '', 'pdf', 863, 6, 6, 5, 16, 1996, 'Cole, Hettinger and Terry', 'Prof.Leffler.  Karolann', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (170, 'Provident nulla.', 'Qui quaerat harum nobis commodi quidem enim consequatur quasi. Dolor perferendis laboriosam sit facilis. Aspernatur qui nam sed unde alias sunt. Non excepturi tempore ullam corporis. Consequatur dolores quae porro voluptas. Eum magnam ipsa est aut.', 'Et assumenda quam possimus modi possimus.pdf', '', 'pdf', 164, 6, 3, 11, 5, 2010, 'Morar, Donnelly and Hane', 'Dr.Parisian.  Dale', '2022-01-21 10:18:43', '2022-01-21 10:18:43', NULL);
INSERT INTO `books` VALUES (174, 'Belajar Bahasa untuk Kelas 1 SD', 'Buku pembelajaran bahasa indonesia untuk kelas 1 SD', 'belajar-bahasa-untuk-kelas-1-sd-kadir-abdul-2019.pdf', '', 'pdf', 0, 1, 1, 1, 1, 2019, 'Gramedia Indonesia', 'Kadir, Abdul', '2022-02-07 17:30:10', '2022-02-07 17:30:10', NULL);
INSERT INTO `books` VALUES (175, 'English for Teen', NULL, 'english-for-teen-jaelani-putra-2019.pdf', '', 'pdf', 5, 3, 7, 1, 2, 2019, 'Gramedia Indonesia', 'Jaelani, Putra', '2022-02-08 14:17:15', '2022-02-11 09:25:51', NULL);
INSERT INTO `books` VALUES (176, 'Matematika Wajib', NULL, 'matematika-wajib-fero-wagiyo-2019.pdf', '', 'pdf', 0, 6, 10, 1, 3, 2019, 'Gramedia Indonesia', 'Fero, Wagiyo', '2022-02-08 14:28:58', '2022-02-08 14:28:58', NULL);
INSERT INTO `books` VALUES (177, 'Matematika Pilihan', 'zxcasdqwe123', 'matematika-pilihan-hari-sudibyo-2017.pdf', '', 'pdf', 0, 3, 7, 1, 3, 2017, 'Mega Bintang Indo', 'Hari, Sudibyo', '2022-02-11 15:18:33', '2022-02-11 15:18:33', NULL);
INSERT INTO `books` VALUES (178, 'Belajar Bahasa untuk Kelas 1 SD', '8q766wujn', 'belajar-bahasa-untuk-kelas-1-sd-asd-sdf-2121.pdf', '', 'pdf', 1, 1, 1, 1, 1, 2121, 'Mega Bintang Indo', 'asd, sdf', '2022-02-15 13:18:55', '2022-03-15 14:26:31', NULL);

-- ----------------------------
-- Table structure for counters
-- ----------------------------
DROP TABLE IF EXISTS `counters`;
CREATE TABLE `counters`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `edu_id` int NULL DEFAULT NULL,
  `grade_id` int NULL DEFAULT NULL,
  `maj_id` int NULL DEFAULT NULL,
  `sub_id` int NULL DEFAULT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of counters
-- ----------------------------

-- ----------------------------
-- Table structure for education
-- ----------------------------
DROP TABLE IF EXISTS `education`;
CREATE TABLE `education`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `edu_name` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of education
-- ----------------------------
INSERT INTO `education` VALUES (1, 'SD', '2022-01-20 08:17:37', '2022-01-20 09:47:14', NULL);
INSERT INTO `education` VALUES (3, 'SMP', '2022-01-20 16:17:05', '2022-01-21 09:19:22', NULL);
INSERT INTO `education` VALUES (6, 'SMA', '2022-01-21 09:23:24', '2022-01-21 09:23:24', NULL);
INSERT INTO `education` VALUES (15, 'SMK', '2022-01-27 13:15:12', '2022-01-27 13:15:12', NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for grades
-- ----------------------------
DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grades
-- ----------------------------
INSERT INTO `grades` VALUES (1, '1', '2022-01-24 10:19:52', '2022-01-24 10:19:52', NULL);
INSERT INTO `grades` VALUES (2, '2', '2022-01-25 10:17:17', '2022-01-25 10:17:17', NULL);
INSERT INTO `grades` VALUES (3, '3', '2022-01-25 10:35:00', '2022-01-25 10:35:00', NULL);
INSERT INTO `grades` VALUES (4, '4', '2022-01-25 10:38:11', '2022-01-25 10:38:11', NULL);
INSERT INTO `grades` VALUES (5, '7', '2022-01-25 10:38:38', '2022-01-25 10:38:38', NULL);
INSERT INTO `grades` VALUES (6, '5', '2022-01-25 10:42:04', '2022-01-25 10:42:04', NULL);
INSERT INTO `grades` VALUES (7, '6', '2022-01-25 10:51:24', '2022-01-25 10:51:24', NULL);
INSERT INTO `grades` VALUES (8, '8', '2022-01-25 10:54:45', '2022-01-25 10:54:45', NULL);
INSERT INTO `grades` VALUES (9, '9', '2022-01-25 10:54:58', '2022-01-25 10:54:58', NULL);
INSERT INTO `grades` VALUES (10, '10', '2022-01-25 11:07:40', '2022-01-25 11:07:40', NULL);
INSERT INTO `grades` VALUES (11, '11', '2022-01-25 11:09:28', '2022-01-25 11:09:28', NULL);
INSERT INTO `grades` VALUES (12, '12', '2022-01-25 11:17:07', '2022-01-26 10:29:36', NULL);

-- ----------------------------
-- Table structure for histories
-- ----------------------------
DROP TABLE IF EXISTS `histories`;
CREATE TABLE `histories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userid` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_id` int NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of histories
-- ----------------------------

-- ----------------------------
-- Table structure for majors
-- ----------------------------
DROP TABLE IF EXISTS `majors`;
CREATE TABLE `majors`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `maj_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of majors
-- ----------------------------
INSERT INTO `majors` VALUES (1, 'Umum', '2022-01-26 09:23:26', '2022-01-26 10:06:03', NULL);
INSERT INTO `majors` VALUES (2, 'Teknik Kendaraan Ringan', '2022-01-26 10:06:22', '2022-01-26 10:08:34', NULL);
INSERT INTO `majors` VALUES (3, 'Teknik Komputer Jaringan', '2022-01-26 10:08:20', '2022-01-26 10:08:20', NULL);
INSERT INTO `majors` VALUES (4, 'qcasdwafsdfgdrt', '2022-01-26 11:15:58', '2022-01-27 08:50:22', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2021_12_23_022011_create_videos_table', 1);
INSERT INTO `migrations` VALUES (6, '2021_12_23_022615_create_books_table', 1);
INSERT INTO `migrations` VALUES (7, '2021_12_29_014920_create_schools_table', 1);
INSERT INTO `migrations` VALUES (8, '2021_12_29_030008_create_majors_table', 1);
INSERT INTO `migrations` VALUES (9, '2021_12_31_022418_create_education_table', 1);
INSERT INTO `migrations` VALUES (10, '2021_12_31_034319_create_grades_table', 1);
INSERT INTO `migrations` VALUES (11, '2021_12_31_034611_create_subjects_table', 1);
INSERT INTO `migrations` VALUES (12, '2021_12_31_034844_create_histories_table', 1);
INSERT INTO `migrations` VALUES (13, '2022_01_03_042530_create_counters_table', 1);
INSERT INTO `migrations` VALUES (14, '2022_01_25_140514_remove_grade_parents', 2);
INSERT INTO `migrations` VALUES (15, '2022_01_25_140827_remove_major_parents', 2);
INSERT INTO `migrations` VALUES (31, '2022_01_28_110345_add_softdeletes_user', 3);
INSERT INTO `migrations` VALUES (32, '2022_02_10_153854_remove_book_school_add_thumb', 3);
INSERT INTO `migrations` VALUES (35, '2022_03_08_092939_book_school', 4);
INSERT INTO `migrations` VALUES (36, '2022_03_08_094311_school_video', 4);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('andaaree@gmail.com', '$2y$10$K9ouiX9h7Gzk.9zXH9tOSePUCwt1eHvmCCHDF.FktmK68N4ZcoJrq', '2022-02-14 11:37:06');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for school_video
-- ----------------------------
DROP TABLE IF EXISTS `school_video`;
CREATE TABLE `school_video`  (
  `video_id` bigint UNSIGNED NOT NULL,
  `school_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  INDEX `school_video_video_id_foreign`(`video_id`) USING BTREE,
  INDEX `school_video_school_id_foreign`(`school_id`) USING BTREE,
  CONSTRAINT `school_video_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `school_video_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of school_video
-- ----------------------------
INSERT INTO `school_video` VALUES (4, 5, '2022-03-15 09:53:45', '2022-03-15 09:53:48', NULL);
INSERT INTO `school_video` VALUES (2, 1, '2022-03-15 10:36:33', '2022-03-15 10:36:33', NULL);
INSERT INTO `school_video` VALUES (4, 1, '2022-03-16 13:59:18', '2022-03-16 13:59:18', NULL);

-- ----------------------------
-- Table structure for schools
-- ----------------------------
DROP TABLE IF EXISTS `schools`;
CREATE TABLE `schools`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `edu_id` int NOT NULL,
  `sch_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of schools
-- ----------------------------
INSERT INTO `schools` VALUES (1, 6, 'SMAN 76 Jakarta', 'Jl Lombok Villa Bintaro Indah Bl G-III/AA, Dki Jakarta', '02137649898', '2022-01-25 09:34:34', '2022-01-25 09:34:34', NULL);
INSERT INTO `schools` VALUES (5, 3, 'SMPN 22 Jakarta', 'Jl Pegangsaan 2 Km 3 5, Dki Jakarta', '0218005720', '2022-01-26 09:43:21', '2022-01-26 09:43:21', NULL);

-- ----------------------------
-- Table structure for subjects
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `sbj_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subjects
-- ----------------------------
INSERT INTO `subjects` VALUES (1, 1, 'Bahasa Indonesia', '2022-02-02 09:58:42', '2022-02-02 09:58:42', NULL);
INSERT INTO `subjects` VALUES (2, 1, 'Bahasa Inggris', '2022-02-02 09:59:23', '2022-02-02 09:59:23', NULL);
INSERT INTO `subjects` VALUES (3, 1, 'Matematika', '2022-02-02 10:14:39', '2022-02-02 13:35:55', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint NOT NULL,
  `school_id` int NULL DEFAULT NULL,
  `grade_id` int NULL DEFAULT NULL,
  `major_id` int NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('A00001', 'Super Admin', 'supadmin', 'super@admin.id', 0, NULL, NULL, NULL, NULL, '$2y$10$6Xbqj15d1Idu5WwRjl4Tt.294.WXhW0Xiju2mO6Ec5r7zUFK9oEZ2', NULL, '2022-01-20 07:05:48', '2022-01-20 07:05:48', NULL);
INSERT INTO `users` VALUES ('U00002', 'Rama', '15467824', 'ygsfkjbf@supersave.net', 3, 5, 7, 2, NULL, '$2y$10$hfyT/I/nFA.IfO9mPxOMV.qM8RGMhB5FDpJEyWcMLhz3eRPvcUW2y', NULL, '2022-02-25 14:32:11', '2022-02-25 14:32:11', NULL);

-- ----------------------------
-- Table structure for videos
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'NULL',
  `filename` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `filetype` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `thumb` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `clicked_time` bigint NOT NULL,
  `edu_id` int NOT NULL,
  `grade_id` int NOT NULL,
  `major_id` int NOT NULL,
  `sub_id` int NULL DEFAULT NULL,
  `creator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of videos
-- ----------------------------
INSERT INTO `videos` VALUES (2, 'Logika Dasar Matematika', 'Dasar dasar logika matematika - oleh Darto', NULL, 'mp4', NULL, 0, 6, 11, 3, 3, 'Darto', '2022-02-25 15:52:32', '2022-03-04 10:02:01', NULL);
INSERT INTO `videos` VALUES (4, 'Penyelarasan Bahasa Indo', NULL, 'penyelarasan-bahasa-indo-frey-2022-03-14', 'mp4', 'penyelarasan-bahasa-indo-frey-2022-03-14.jpg', 0, 15, 10, 2, 1, 'Frey', '2022-03-14 17:11:22', '2022-03-14 17:23:22', NULL);

SET FOREIGN_KEY_CHECKS = 1;
