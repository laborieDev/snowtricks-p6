-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mer. 10 fév. 2021 à 17:39
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `openclassrooms_p6`
--

-- --------------------------------------------------------

--
-- Structure de la table `app_group`
--

CREATE TABLE `app_group` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `app_group`
--

INSERT INTO `app_group` (`id`, `name`) VALUES
(1, 'Groupe 1'),
(2, 'Groupe 2'),
(3, 'Groupe 3');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210103121911', '2021-01-04 17:20:05', 44),
('DoctrineMigrations\\Version20210103123004', '2021-01-04 17:20:05', 112),
('DoctrineMigrations\\Version20210103125714', '2021-01-04 17:20:06', 74),
('DoctrineMigrations\\Version20210103130408', '2021-01-04 17:20:06', 88),
('DoctrineMigrations\\Version20210104172835', '2021-01-04 17:28:52', 95),
('DoctrineMigrations\\Version20210104184546', '2021-01-04 18:45:51', 329),
('DoctrineMigrations\\Version20210104190247', '2021-01-04 19:02:51', 88),
('DoctrineMigrations\\Version20210108104422', '2021-01-08 10:44:45', 441),
('DoctrineMigrations\\Version20210108105521', '2021-01-08 10:55:27', 263),
('DoctrineMigrations\\Version20210108112830', '2021-01-08 11:28:37', 156),
('DoctrineMigrations\\Version20210109152429', '2021-01-09 15:24:39', 194),
('DoctrineMigrations\\Version20210110175848', '2021-01-10 17:59:01', 171),
('DoctrineMigrations\\Version20210110180020', '2021-01-10 18:00:22', 76),
('DoctrineMigrations\\Version20210110184723', '2021-01-10 18:49:51', 80),
('DoctrineMigrations\\Version20210112175935', '2021-01-12 17:59:39', 242),
('DoctrineMigrations\\Version20210115082108', '2021-01-15 08:21:27', 472),
('DoctrineMigrations\\Version20210124104838', '2021-01-24 10:49:53', 151),
('DoctrineMigrations\\Version20210124105507', '2021-01-24 10:55:10', 354),
('DoctrineMigrations\\Version20210124114145', '2021-01-24 11:41:49', 565),
('DoctrineMigrations\\Version20210124190814', '2021-01-24 19:08:25', 282),
('DoctrineMigrations\\Version20210125183219', '2021-01-29 13:23:39', 295),
('DoctrineMigrations\\Version20210125185500', '2021-01-29 13:23:39', 86),
('DoctrineMigrations\\Version20210129142500', '2021-01-29 14:25:09', 199);

-- --------------------------------------------------------

--
-- Structure de la table `figure`
--

CREATE TABLE `figure` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `figure`
--

INSERT INTO `figure` (`id`, `name`, `description`, `slug`, `featured_image_id`, `group_id`, `user_id`, `created_at`, `updated_at`) VALUES
(75, 'Skate Skills', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut pharetra metus. Quisque justo justo, sodales eu ultricies non, pulvinar et augue. Curabitur ut ex ex. Praesent elementum nisl ut quam tincidunt blandit vel ut justo. Sed congue sodales sapien, in faucibus nisi. Curabitur porttitor lacinia lacus, a blandit arcu tincidunt ut. Donec varius mauris vel iaculis vehicula. Proin malesuada tellus sit amet consectetur tempor. Aliquam accumsan aliquet neque non egestas. Vivamus varius dolor ac tortor varius convallis a ut neque. Integer malesuada vel sem et consequat. Essai Modification', 'Skate_Skills', 285, 2, 1, '2021-01-23 11:09:48', '2021-02-10 17:34:37'),
(76, 'Backside Air', 'Aliquam erat volutpat. Ut sed laoreet orci. Pellentesque fringilla lectus sed vehicula egestas. Mauris condimentum molestie placerat. Proin viverra vestibulum orci, at porta nisi. Duis convallis ut metus maximus scelerisque. Nam nunc tellus, viverra nec suscipit at, volutpat ut diam. Integer egestas non lectus vel dictum.\r\n\r\nSed vitae ultricies est. Suspendisse commodo placerat diam, suscipit dapibus massa suscipit sit amet. Quisque ullamcorper ligula et lectus efficitur molestie. Donec eu elementum orci, nec dapibus magna. Quisque non metus purus. Nunc turpis libero, cursus et malesuada id, blandit accumsan orci. Suspendisse hendrerit faucibus nibh vel tempor. Morbi sodales dui vitae porttitor hendrerit. Praesent erat metus, dignissim sed eleifend vel, euismod eu arcu.', 'Backside_Air', 229, 1, 1, '2021-01-24 13:45:10', '2021-02-10 17:32:08'),
(81, 'One Foot Tricks', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel mattis ante, eget euismod lectus. In eget sagittis mauris, vitae mollis nibh. Ut ultrices, ante in faucibus vehicula, lectus nulla volutpat arcu, vel pharetra erat est ut orci. Nam vel suscipit sem. Maecenas risus ante, mollis a mi et, iaculis euismod quam. Aenean scelerisque sapien at viverra fringilla. Nam nec velit quis enim volutpat cursus. Quisque pulvinar sed ante ornare fringilla. Pellentesque vitae velit in nunc mollis auctor. Morbi eget lacus sit amet erat dignissim ultricies sed sed augue. Praesent eget dictum orci. Etiam quis erat vitae arcu finibus fringilla maximus pellentesque nunc. Aliquam erat volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\r\n\r\nPellentesque gravida felis vestibulum ex pellentesque, at blandit nisi aliquam. Duis vitae sapien lacinia, fermentum metus ut, cursus dolor. Proin sed est tristique sem rutrum semper id dignissim risus. Praesent pulvinar metus sit amet ultrices sagittis. Nunc vitae laoreet massa. Nullam rutrum, augue eget dapibus placerat, nunc nibh tempus nisi, ac rutrum libero libero consectetur orci. Quisque eget tempus lorem. Vivamus ac nisl varius, sagittis eros eget, sagittis lorem.\r\n\r\nIn cursus leo et quam laoreet bibendum. Praesent tempor semper elit, vel elementum odio consectetur id. Pellentesque gravida vitae eros ut maximus. Duis quis ante in eros varius auctor. Duis nec faucibus neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam facilisis, odio eu blandit varius, purus urna ullamcorper ipsum, ut rutrum massa ipsum eget sapien. Cras laoreet porta viverra. Sed ac metus eget orci commodo viverra vel et ante. Praesent tortor turpis, mattis quis pretium quis, cursus eget justo.', 'One_Foot_Tricks', 272, 1, 1, '2021-01-24 19:13:55', '2021-02-10 17:32:28'),
(82, 'Bode Merrill', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lorem, congue ac nisi scelerisque, consequat rhoncus sapien. Sed ligula purus, sagittis sit amet lacinia tincidunt, mollis sed nunc. Mauris at augue dolor. Duis scelerisque, ligula ac tempor mattis, sem nibh maximus nibh, in rhoncus nulla quam non neque. In eros felis, pellentesque eget urna id, pellentesque ornare sem. Etiam molestie viverra laoreet. Maecenas eget turpis ut metus cursus facilisis. Sed eu arcu malesuada, faucibus lectus a, efficitur mi. Nulla egestas felis ultricies, porta nulla vel, accumsan arcu. Curabitur id ullamcorper diam.', 'Bode_Merrill', 295, 1, 3, '2021-02-04 18:27:11', '2021-02-10 17:32:41'),
(83, 'Switch Backside', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lorem, congue ac nisi scelerisque, consequat rhoncus sapien. Sed ligula purus, sagittis sit amet lacinia tincidunt, mollis sed nunc. Mauris at augue dolor. Duis scelerisque, ligula ac tempor mattis, sem nibh maximus nibh, in rhoncus nulla quam non neque. In eros felis, pellentesque eget urna id, pellentesque ornare sem. Etiam molestie viverra laoreet. Maecenas eget turpis ut metus cursus facilisis. Sed eu arcu malesuada, faucibus lectus a, efficitur mi. Nulla egestas felis ultricies, porta nulla vel, accumsan arcu. Curabitur id ullamcorper diam.', 'Switch_Backside', 296, 3, 3, '2021-02-04 18:27:44', '2021-02-10 17:34:22'),
(84, 'Christian Haller', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lorem, congue ac nisi scelerisque, consequat rhoncus sapien. Sed ligula purus, sagittis sit amet lacinia tincidunt, mollis sed nunc. Mauris at augue dolor. Duis scelerisque, ligula ac tempor mattis, sem nibh maximus nibh, in rhoncus nulla quam non neque. In eros felis, pellentesque eget urna id, pellentesque ornare sem. Etiam molestie viverra laoreet. Maecenas eget turpis ut metus cursus facilisis. Sed eu arcu malesuada, faucibus lectus a, efficitur mi. Nulla egestas felis ultricies, porta nulla vel, accumsan arcu. Curabitur id ullamcorper diam.', 'Christian_Haller', 299, 2, 3, '2021-02-04 18:28:12', '2021-02-10 17:33:35'),
(85, 'BS 540 Seatbelt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lorem, congue ac nisi scelerisque, consequat rhoncus sapien. Sed ligula purus, sagittis sit amet lacinia tincidunt, mollis sed nunc. Mauris at augue dolor. Duis scelerisque, ligula ac tempor mattis, sem nibh maximus nibh, in rhoncus nulla quam non neque. In eros felis, pellentesque eget urna id, pellentesque ornare sem. Etiam molestie viverra laoreet. Maecenas eget turpis ut metus cursus facilisis. Sed eu arcu malesuada, faucibus lectus a, efficitur mi. Nulla egestas felis ultricies, porta nulla vel, accumsan arcu. Curabitur id ullamcorper diam.', 'Bs_540_Seatbelt', 298, 2, 3, '2021-02-04 18:28:45', '2021-02-10 17:34:04');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `figure_id` int(11) DEFAULT NULL,
  `is_image` tinyint(1) DEFAULT NULL,
  `img_src` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `name`, `url`, `figure_id`, `is_image`, `img_src`) VALUES
(226, 'Coronavirus', NULL, NULL, 1, 'uploads/images/first-600d557c4d0e4.jpeg'),
(228, 'People 1', NULL, 75, 1, 'uploads/images/agl_company-6014261bd1e5d.png'),
(229, 'AGL Company', NULL, NULL, 1, 'uploads/images/agl_company-600d79e6eb19d.jpeg'),
(272, 'Image principal', NULL, NULL, 1, 'uploads/images/image_principal-600dc6f333cc6.jpeg'),
(273, 'Présentation Vidéo', 'https://www.youtube.com/embed/OYDDChgbDyQ', 81, 0, NULL),
(274, 'Image 1', NULL, 81, 1, 'uploads/images/image_1-600dc6f33bd3d.png'),
(275, 'Image 2', NULL, 81, 1, 'uploads/images/image_2-600dc6f33f334.jpeg'),
(276, 'Image 3', NULL, 81, 1, 'uploads/images/image_3-600dc6f33fa20.png'),
(277, 'Image 4', NULL, 81, 1, 'uploads/images/image_4-600dc6f3401ae.jpeg'),
(278, 'Michel_BROLUE_profil', '', NULL, 1, 'uploads/images/michel_brolue_profil-60140c659ad78.png'),
(279, 'People1', '', NULL, 1, 'uploads/images/john_doe_profil-600f14521193b.png'),
(284, 'People', NULL, NULL, 1, 'uploads/images/coronavirus-6014243d9236b.jpeg'),
(285, 'People', NULL, NULL, 1, 'uploads/images/people-6014260c17c30.png'),
(286, 'LABORIE', NULL, 75, 1, 'uploads/images/laborie-6016df8c6f6bd.png'),
(287, 'AGL Company', NULL, NULL, NULL, NULL),
(288, 'YouTube', 'https://www.youtube.com/embed/L4bIunv8fHM?list=PLGERIDbPqtLvyPUHaqnLSkizFoQnvpTeN', 75, 0, NULL),
(292, NULL, NULL, 75, 1, 'uploads/images/code-6016ea43eb030.png'),
(293, NULL, NULL, 75, 1, 'uploads/images/mairie-beaulieu-6016ea43f356f.jpeg'),
(294, NULL, NULL, 75, 1, 'uploads/images/securite-informatique-6016ea4411fcb.jpeg'),
(295, 'Numero 678 Img', NULL, NULL, 1, 'uploads/images/numero_678_img-601c3c7f85e52.png'),
(296, 'assasa', NULL, NULL, 1, 'uploads/images/assasa-601c3ca0e3a12.jpeg'),
(297, 'essai', NULL, NULL, 1, 'uploads/images/essai-601c3cbcd4f40.jpeg'),
(298, 'regul', NULL, NULL, 1, 'uploads/images/regul-601c3cdd2eb3a.jpeg'),
(299, 'essai', NULL, NULL, 1, 'uploads/images/essai-602418ef496b5.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_at` date NOT NULL,
  `figure_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `user_id`, `content`, `add_at`, `figure_id`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut pharetra metus. Quisque justo justo, sodales eu ultricies non, pulvinar et augue. Curabitur ut ex ex. Praesent elementum nisl ut quam tincidunt blandit vel ut justo. Sed congue sodales sapien, in faucibus nisi. Curabitur porttitor lacinia lacus, a blandit arcu tincidunt ut. Donec varius mauris vel iaculis vehicula. Proin malesuada tellus sit amet consectetur tempor. Aliquam accumsan aliquet neque non egestas. Vivamus varius dolor ac tortor varius convallis a ut neque. Integer malesuada vel sem et consequat.', '2021-01-24', 75),
(2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut pharetra metus. Quisque justo justo, sodales eu ultricies non, pulvinar et augue. Curabitur ut ex ex. Praesent elementum nisl ut quam tincidunt blandit vel ut justo. Sed congue sodales sapien, in faucibus nisi. Curabitur porttitor lacinia lacus, a blandit arcu tincidunt ut. Donec varius mauris vel iaculis vehicula. Proin malesuada tellus sit amet consectetur tempor. Aliquam accumsan aliquet neque non egestas.', '2021-01-24', 75),
(3, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut pharetra metus. Quisque justo justo, sodales eu ultricies non, pulvinar et augue. Curabitur ut ex ex. Praesent elementum nisl ut quam tincidunt blandit vel ut justo. Sed congue sodales sapien, in faucibus nisi. Curabitur porttitor lacinia lacus, a blandit arcu tincidunt ut. Donec varius mauris vel iaculis vehicula. Proin malesuada tellus sit amet consectetur tempor. Aliquam accumsan aliquet neque non egestas. Vivamus varius dolor ac tortor varius convallis a ut neque. Integer malesuada vel sem et consequat.', '2021-01-24', 75),
(4, 1, 'Nulla ut pharetra metus. Quisque justo justo, sodales eu ultricies non, pulvinar et augue. Curabitur ut ex ex. Praesent elementum nisl ut quam tincidunt blandit vel ut justo. Sed congue sodales sapien, in faucibus nisi. Curabitur porttitor lacinia lacus, a blandit arcu tincidunt ut. Donec varius mauris vel iaculis vehicula. Proin malesuada tellus sit amet consectetur tempor. Aliquam accumsan aliquet neque non egestas. Vivamus varius dolor ac tortor varius convallis a ut neque. Integer malesuada vel sem et consequat.', '2021-01-24', 75),
(5, 1, 'Quisque justo justo, sodales eu ultricies non, pulvinar et augue. Curabitur ut ex ex. Praesent elementum nisl ut quam tincidunt blandit vel ut justo. Sed congue sodales sapien, in faucibus nisi. Curabitur porttitor lacinia lacus, a blandit arcu tincidunt ut. Donec varius mauris vel iaculis vehicula. Proin malesuada tellus sit amet consectetur tempor. Aliquam accumsan aliquet neque non egestas. Vivamus varius dolor ac tortor varius convallis a ut neque. Integer malesuada vel sem et consequat.', '2021-01-24', 75),
(6, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut pharetra metus. Quisque justo justo, sodales eu ultricies non, pulvinar et augue. Curabitur ut ex ex. Praesent elementum nisl ut quam tincidunt blandit vel ut justo. Sed congue sodales sapien, in faucibus nisi. Curabitur porttitor lacinia lacus, a blandit arcu tincidunt ut. Donec varius mauris vel iaculis vehicula. Proin malesuada tellus sit amet consectetur tempor. Aliquam accumsan aliquet neque non egestas. Vivamus varius dolor ac tortor varius convallis a ut neque. Integer malesuada vel sem et consequat.', '2021-01-24', 75),
(7, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut pharetra metus. Quisque justo justo, sodales eu ultricies non, pulvinar et augue. Curabitur ut ex ex. Praesent elementum nisl ut quam tincidunt blandit vel ut justo. Sed congue sodales sapien, in faucibus nisi. Curabitur porttitor lacinia lacus, a blandit arcu tincidunt ut. Donec varius mauris vel iaculis vehicula. Proin malesuada tellus sit amet consectetur tempor. Aliquam accumsan aliquet neque non egestas. Vivamus varius dolor ac tortor varius convallis a ut neque. Integer malesuada vel sem et consequat.', '2021-01-24', 75),
(8, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut pharetra metus. Quisque justo justo, sodales eu ultricies non, pulvinar et augue. Curabitur ut ex ex. Praesent elementum nisl ut quam tincidunt blandit vel ut justo. Sed congue sodales sapien, in faucibus nisi. Curabitur porttitor lacinia lacus, a blandit arcu tincidunt ut. Donec varius mauris vel iaculis vehicula. Proin malesuada tellus sit amet consectetur tempor. Aliquam accumsan aliquet neque non egestas. Vivamus varius dolor ac tortor varius convallis a ut neque. Integer malesuada vel sem et consequat.', '2021-01-24', 75),
(9, 1, 'Aliquam erat volutpat. Ut sed laoreet orci. Pellentesque fringilla lectus sed vehicula egestas. Mauris condimentum molestie placerat. Proin viverra vestibulum orci, at porta nisi. Duis convallis ut metus maximus scelerisque. Nam nunc tellus, viverra nec suscipit at, volutpat ut diam. Integer egestas non lectus vel dictum.\r\n\r\nSed vitae ultricies est. Suspendisse commodo placerat diam, suscipit dapibus massa suscipit sit amet. Quisque ullamcorper ligula et lectus efficitur molestie. Donec eu elementum orci, nec dapibus magna. Quisque non metus purus. Nunc turpis libero, cursus et malesuada id, blandit accumsan orci. Suspendisse hendrerit faucibus nibh vel tempor. Morbi sodales dui vitae porttitor hendrerit. Praesent erat metus, dignissim sed eleifend vel, euismod eu arcu.', '2021-01-24', 76),
(10, 1, 'Aliquam erat volutpat. Ut sed laoreet orci. Pellentesque fringilla lectus sed vehicula egestas. Mauris condimentum molestie placerat. Proin viverra vestibulum orci, at porta nisi. Duis convallis ut metus maximus scelerisque. Nam nunc tellus, viverra nec suscipit at, volutpat ut diam. Integer egestas non lectus vel dictum.\r\n\r\nSed vitae ultricies est. Suspendisse commodo placerat diam, suscipit dapibus massa suscipit sit amet. Quisque ullamcorper ligula et lectus efficitur molestie. Donec eu elementum orci, nec dapibus magna. Quisque non metus purus. Nunc turpis libero, cursus et malesuada id, blandit accumsan orci. Suspendisse hendrerit faucibus nibh vel tempor. Morbi sodales dui vitae porttitor hendrerit. Praesent erat metus, dignissim sed eleifend vel, euismod eu arcu.', '2021-01-24', 76),
(11, 1, 'Lorem', '2021-01-24', 75),
(13, 1, 'Essai espace commentaire', '2021-01-24', 76),
(17, 3, 'Hello World', '2021-01-29', 75),
(18, 3, 'Essai 234', '2021-02-04', 75);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `last_name`, `first_name`, `email`, `password`, `roles`, `image_id`) VALUES
(1, 'LABORIE', 'ANTHONY', 'acs.agl46@gmail.com', '$2y$13$XbWiCeaKqxj9ZaRgSB33QeMFMH0Cr1QeI9epGV.uOeCh9h4jpxaBS', '[\"ROLE_USER\"]', 279),
(2, 'LABORIE', 'ANTHONY', 'acs.agl@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$nyDkHkIuOCWXdEra84Ab+A$Fh2XTlXjy1rKTkFeyc8WWN7LN1Jc7NtRNSzgVFySsXs', '[\"ROLE_USER\"]', 279),
(3, 'Michel', 'BROLUE', 'admin@me.fr', '$argon2id$v=19$m=65536,t=4,p=1$l7iV2o5sxahFhwCHDFutIg$mK9ssx4mFzejMdvtTjZtsmr+bdIBsw9CteKkGV2sNP0', '[\"ROLE_USER\"]', 278);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `app_group`
--
ALTER TABLE `app_group`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `figure`
--
ALTER TABLE `figure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2F57B37A989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_2F57B37A3569D950` (`featured_image_id`),
  ADD KEY `IDX_2F57B37AFE54D947` (`group_id`),
  ADD KEY `IDX_2F57B37AA76ED395` (`user_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6A2CA10C5C011B5` (`figure_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6BD307FA76ED395` (`user_id`),
  ADD KEY `IDX_B6BD307F5C011B5` (`figure_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D6493DA5256D` (`image_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `app_group`
--
ALTER TABLE `app_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `figure`
--
ALTER TABLE `figure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `figure`
--
ALTER TABLE `figure`
  ADD CONSTRAINT `FK_2F57B37A3569D950` FOREIGN KEY (`featured_image_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `FK_2F57B37AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2F57B37AFE54D947` FOREIGN KEY (`group_id`) REFERENCES `app_group` (`id`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_6A2CA10C5C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figure` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307F5C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figure` (`id`),
  ADD CONSTRAINT `FK_B6BD307FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6493DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media` (`id`);
