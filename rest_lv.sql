-- phpMyAdmin SQL Dump
-- version 4.6.0deb1.trusty~ppa.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 27 2016 г., 16:54
-- Версия сервера: 5.5.49-0ubuntu0.14.04.1
-- Версия PHP: 5.5.34-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rest_lv`
--

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--

CREATE TABLE `albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `public` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `albums`
--

INSERT INTO `albums` (`id`, `name`, `description`, `public`, `user_id`, `created_at`, `updated_at`) VALUES
(142, 'Dolor blanditiis aliquid velit nulla quo id velit.', 'Eos voluptatem adipisci fuga tempore. Necessitatibus suscipit dolorem qui deserunt sit.', 1, 112, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(143, 'Voluptatem in harum deleniti illum ut.', 'Asperiores saepe animi accusamus eos tenetur nisi. Temporibus et eos ad repellat. Alias provident in quidem nihil natus. Ut commodi esse illo rerum.', 1, 109, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(144, 'Qui rem molestiae rerum assumenda itaque libero asperiores.', 'Porro laborum rem velit maxime et. Quae eaque soluta occaecati molestiae sed. Blanditiis harum ipsam odio sit accusantium est harum error.', 1, 109, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(145, 'Quo eveniet est rerum aperiam.', 'Consequatur voluptatem quaerat cum omnis corrupti dolor similique. Qui sit iure quasi quaerat aut. Placeat quia consequatur cumque.', 1, 106, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(146, 'Itaque magni et reiciendis id fuga ab recusandae.', 'Expedita in excepturi in voluptatibus porro. Consequatur repudiandae qui qui similique. In et voluptatem ducimus repudiandae est.', 0, 103, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(147, 'Et mollitia sed fuga deserunt.', 'Tempora consequuntur fuga iure quia sit ratione qui commodi. Corrupti itaque et aut. Optio sint repellat tenetur autem sint. Autem magni velit eius inventore aspernatur.', 0, 110, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(148, 'Voluptatibus rerum perferendis ut commodi minima quia.', 'Vel fuga quis omnis animi totam aperiam ea. Quod neque ducimus et maxime delectus quidem enim. Cum eos commodi dolore vel inventore inventore reiciendis. Ipsa voluptatem ut ipsam et.', 1, 112, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(149, 'Inventore voluptatem rerum voluptatem veritatis.', 'Ducimus autem ipsam possimus ipsum ex qui veritatis sunt. Enim error pariatur aliquid. Eum laborum sunt sunt qui praesentium in fugit labore.', 0, 110, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(150, 'Ad sit voluptas dolores totam alias.', 'Delectus nulla explicabo dolores facere. Beatae quis aut facere quidem voluptatem. Qui qui eaque numquam accusamus quis animi. Est ad iure occaecati odit recusandae nihil.', 0, 104, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(151, 'Quo aut dicta ut blanditiis.', 'Et et minus omnis quaerat. Eligendi aut quo qui temporibus. Ea veritatis rerum et ducimus. Illo odit sint velit culpa.', 0, 108, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(152, 'At aut modi voluptates dolor.', 'Et ut explicabo sit magni suscipit dignissimos. Est ullam temporibus quasi eum ut. Expedita id ipsum consequatur aut asperiores.', 0, 108, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(153, 'Ducimus distinctio vel eius et voluptatem sint.', 'Error iusto explicabo officia sed non eos id. Illo id totam est modi et veniam molestiae voluptates. Voluptatum expedita quia saepe asperiores laudantium et autem.', 1, 108, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(154, 'Aspernatur molestiae recusandae debitis placeat in repellat.', 'Aspernatur doloremque fuga et. Sit aspernatur nobis illum laboriosam facilis architecto iste. Ipsam magnam ipsam est ut labore sequi quia sint. Voluptatibus quos aut explicabo molestiae assumenda.', 0, 111, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(155, 'Eos ea laboriosam possimus odio.', 'Aut voluptas est dolores. Corrupti consequatur dolorem molestiae culpa omnis voluptatem. Veritatis nihil ut ut dolor sunt. Dolorem nulla neque velit vel.', 0, 109, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(156, 'Omnis dolorum temporibus voluptatem vel voluptatum omnis rerum earum.', 'Maiores in explicabo molestiae odit. Ducimus accusantium enim magnam. Minus accusantium neque quos molestiae aut quis eveniet. Pariatur autem temporibus assumenda alias aut excepturi.', 1, 105, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(157, 'Voluptatum blanditiis sed rerum consequatur corporis quod porro.', 'Voluptatem ut iusto incidunt qui illum. Molestias voluptas illo vel odio ut fugiat. Quasi ipsum unde iste modi incidunt cum aut.', 1, 103, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(158, 'Eos eaque non et laboriosam quo ut cumque.', 'Molestias deserunt commodi modi aut nisi officia. Ratione illo minus a vel consequatur. Fugiat autem non quam. Incidunt blanditiis eos error similique.', 0, 112, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(159, 'Fuga ratione dolor quaerat neque.', 'Et dolorum est id porro. Dicta nostrum enim reprehenderit mollitia qui. Incidunt quia labore reprehenderit ut ea sit. Qui similique modi et.', 1, 112, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(160, 'Quam odit libero maxime sed provident corporis.', 'At perferendis aperiam assumenda qui dolore. Autem vero reprehenderit eos soluta. Iusto adipisci accusantium aut sunt est.', 1, 111, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(161, 'Cum voluptatem quo dignissimos consequuntur et dolorum.', 'Tempore voluptas quia corporis ratione similique. Quisquam consequatur debitis praesentium aspernatur. Et ea modi odit maiores rem. Maiores quia est consequatur voluptatem.', 0, 111, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(162, 'Aut dolore voluptatem et corrupti voluptatem.', 'Atque repudiandae est et. Ad natus ipsa sed maxime totam ducimus et. Quae enim similique sunt sed quis. Repudiandae quaerat sequi voluptas accusamus autem.', 1, 111, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(163, 'Natus voluptas animi voluptas maxime molestiae voluptates amet.', 'Neque quam aut aliquam. Maxime architecto voluptatum reprehenderit.', 0, 106, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(164, 'Temporibus saepe ipsam expedita sit qui quos.', 'Beatae necessitatibus fugiat ea. Sit in officiis consequatur enim. Iure eum quia magni quas.', 1, 104, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(165, 'Facilis dolores est cum.', 'Natus dolores eos sint occaecati officiis similique ipsa. Id sed velit reiciendis vero.', 1, 107, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(166, 'Tenetur nisi sequi magni necessitatibus id sit.', 'Similique a dolorem quia non animi vel dolore. Consequatur iusto perferendis at doloremque cum. Aut corporis dolor quia impedit perspiciatis nihil. Adipisci voluptatibus quasi libero ut omnis.', 1, 110, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(167, 'Repellat et repudiandae est praesentium ea fugit.', 'Fugiat dolore ex voluptate nesciunt quia. Et vitae at amet sunt laborum aspernatur. Aut rerum corrupti quibusdam consequatur. Delectus vel mollitia et nostrum hic fugiat odio facilis.', 0, 104, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(168, 'Ea temporibus culpa nemo perferendis.', 'Labore quisquam consequatur nobis. Non et magnam sint sed consectetur labore modi. Qui minus illo reprehenderit quos odit. Incidunt doloribus enim facilis tenetur libero dolorem.', 1, 109, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(169, 'Sint laboriosam facilis labore fugit debitis.', 'Est a et esse qui saepe veniam. Harum adipisci aliquam soluta inventore nam in adipisci. Et doloremque aperiam suscipit sint ut delectus.', 0, 103, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(170, 'Rerum eaque voluptatem nam eos tempore consequatur distinctio.', 'Qui quo explicabo autem corrupti eaque sed odio. Sed qui consequuntur soluta dolores excepturi est doloremque veritatis. Quo commodi est recusandae molestiae ea fugiat deserunt quo.', 0, 110, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(171, 'Et rerum eum nulla earum.', 'Nihil ut cupiditate et id quo perspiciatis voluptate ab. Quis ut dolorum minus sed illo qui.', 1, 106, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(172, 'Quibusdam mollitia recusandae quidem nam ducimus vero maiores.', 'Porro non quis aspernatur in id. Consequuntur ut reprehenderit rem ea rem unde quam est. Doloribus itaque et id neque perspiciatis. Laudantium sint placeat aut aut sed labore non.', 0, 107, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(173, 'Necessitatibus consequatur repudiandae et rerum error iste.', 'Aspernatur voluptate ut labore nostrum cupiditate omnis. Fugit recusandae eligendi voluptatem sunt. Nemo voluptatem amet est vel et necessitatibus ab.', 1, 111, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(174, 'Sequi deserunt vitae sapiente omnis.', 'Perferendis nesciunt molestiae non unde quisquam qui. Minima sit quas ut voluptates nam architecto. Corporis nesciunt ipsam sapiente a eligendi odit.', 1, 108, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(175, 'Quis aperiam et sint et sunt.', 'Autem ducimus non ut repellendus. Soluta porro nulla qui temporibus rerum in quia. Quibusdam inventore molestiae illo provident.', 1, 106, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(176, 'Architecto et non modi ea dolor.', 'Harum eum impedit corrupti adipisci expedita. Delectus excepturi in deleniti. Et voluptatum sint sint quis molestias hic.', 1, 106, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(177, 'Sit aut minima non ipsa accusantium rerum.', 'Consequatur ullam ullam et nesciunt eos perferendis. Rerum rerum porro soluta accusantium quia deserunt. Animi vero ullam libero sit excepturi eius. Harum tenetur modi et qui amet tempore animi.', 0, 108, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(178, 'Harum occaecati sint aspernatur ut illo.', 'Ut eos sed repellat tempora iusto. Molestias optio aut nihil. Nostrum a ex autem cumque molestias ut.', 0, 109, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(179, 'Eaque officia harum a quia impedit illum.', 'Officia voluptatem sed unde officiis omnis magni nihil. Officia non ratione itaque ab magnam labore qui.', 0, 112, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(180, 'Sit vitae dolor necessitatibus dolorem iure.', 'Velit saepe consequuntur dolores magnam aut adipisci. Non molestiae qui doloremque iste blanditiis fuga incidunt fugit. Possimus non provident qui illum et consectetur.', 0, 106, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(181, 'Quos vero et est velit distinctio repudiandae dolores.', 'Ipsam facilis dicta aut eveniet. Enim eaque aut qui qui sapiente nihil. Nihil eum rerum officia quo iure.', 1, 104, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(182, 'Corrupti sit odio sed molestias facilis.', 'Tempora possimus accusamus et vero voluptatem corrupti. Dolorem nostrum sed voluptatem vero qui ut. Soluta quibusdam libero qui voluptas. Sit voluptatem odit tempora eaque.', 0, 105, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(183, 'Fuga aspernatur quos sit perspiciatis eveniet consequuntur.', 'Alias hic reprehenderit ipsum cumque fugit dolores. Odit dolores magni repudiandae cupiditate non ad. Voluptate ipsum qui blanditiis sed maxime et dolores. Debitis quisquam iste explicabo harum.', 0, 103, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(184, 'Est numquam magnam culpa veritatis non quia.', 'Perspiciatis sunt odit optio. Aliquam reprehenderit eum qui maiores itaque.', 1, 108, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(185, 'Eligendi voluptas ex qui deserunt in.', 'Quia esse esse laudantium labore itaque autem vitae. Unde laudantium delectus voluptatem doloribus vero.', 0, 110, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(186, 'Consequatur sint ipsa quia.', 'Aut vel temporibus omnis nam. Quidem deleniti fugiat corporis reiciendis magni accusantium. Consequuntur repudiandae odit sint natus. Voluptatem error dolore velit aut et.', 1, 107, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(187, 'Expedita ut qui et dolorem quas rerum.', 'Rerum aspernatur impedit est qui vitae. Voluptatem nihil architecto dolor soluta culpa. Amet ratione sit qui minima reprehenderit excepturi. Eveniet voluptate doloremque ab qui quia.', 1, 109, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(188, 'Tempora vel beatae unde.', 'Sunt omnis facilis perferendis et magnam. Qui aspernatur pariatur labore error beatae consequuntur id nisi. Ad non at sequi rerum itaque.', 0, 112, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(189, 'Molestiae blanditiis ad tempore atque quas iusto nesciunt id.', 'Ut temporibus rerum sit mollitia minima beatae. Repudiandae eligendi commodi officia sint. Aliquid magnam quam facere. Quod quisquam dolore dolor aut voluptate non.', 1, 109, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(190, 'Omnis quia repellat in est rem totam.', 'Id deserunt nulla accusamus quisquam. Quo nam accusantium quae itaque quia voluptatem vero. Quis minima est corrupti pariatur.', 1, 104, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(191, 'Maiores fuga veritatis quibusdam assumenda sed.', 'Quod rerum aut qui dicta neque qui est. Doloribus corporis dolor autem. Est tenetur autem saepe sit. Consequatur repellendus illo et temporibus non animi.', 1, 105, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(192, 'Est tempore quis veritatis ea praesentium et.', 'Delectus nisi voluptatem itaque adipisci. Autem ipsa amet et quo possimus. Vel facilis laborum quia perferendis illum. Sit aliquid voluptas sed in.', 1, 103, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(193, 'Blanditiis cumque aut atque amet.', 'Eius non sit ipsam maxime nihil suscipit minus. Occaecati sint sit cumque non occaecati. Voluptas accusantium quaerat eaque aspernatur et voluptatem.', 0, 106, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(194, 'Eaque et id enim aut rem.', 'Non qui vel et vitae. Omnis voluptatibus consequatur numquam sit dignissimos. Adipisci sint aut in aliquam officia quibusdam laudantium. Eius in ut natus asperiores dignissimos ipsam at numquam.', 1, 106, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(195, 'Voluptas molestiae in tenetur porro vel.', 'Magnam aut iure sed eaque nostrum. Ab vel exercitationem tempora fuga.', 1, 108, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(196, 'Sit neque alias quasi accusamus quis.', 'Quis et est sit eveniet. Ipsum aspernatur cupiditate numquam quos illum et provident. Sint iure debitis consequatur consequatur. Quis veniam explicabo laboriosam reprehenderit distinctio.', 0, 107, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(197, 'Sed aperiam itaque consequatur ipsam mollitia minima consequatur.', 'Soluta neque officiis sed qui aliquid dolorem. Non pariatur omnis illum. Numquam velit consequatur officiis sequi omnis laboriosam. At voluptatibus nihil recusandae.', 1, 111, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(198, 'Optio culpa rerum voluptatem qui.', 'Minima alias sint eum amet et et id. Dolorum voluptas a dolor molestiae porro quo. Sint et qui quis facilis necessitatibus deserunt.', 0, 109, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(199, 'Blanditiis cum natus fugiat quasi.', 'Dignissimos dolores aliquam ut maiores esse. Velit tempora molestias quidem ipsa qui totam occaecati. Quo atque quaerat libero eos repellendus dolorem. Consequatur non voluptas facere illum ab.', 0, 105, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(200, 'Laudantium in eum in quia magni molestiae.', 'Aperiam adipisci magnam magnam quis. Enim suscipit laboriosam est sunt earum. Quisquam voluptatem quis illo dolorum autem qui sit. Provident occaecati aut incidunt eos id.', 0, 107, '2016-04-10 10:51:21', '2016-04-10 10:51:21'),
(201, 'update_test3', 'updated3', 0, 109, '2016-04-10 10:51:21', '2016-04-11 13:59:54'),
(203, 'test2', 'test2', 0, 1, '2016-04-11 07:48:03', '2016-04-11 07:48:03'),
(204, 'test3', 'test23', 0, 1, '2016-04-11 07:59:06', '2016-04-11 07:59:06'),
(205, 'test3', 'test23', 0, 1, '2016-04-11 08:01:52', '2016-04-11 08:01:52'),
(206, 'test3', 'test23', 0, 1, '2016-04-11 10:20:08', '2016-04-11 10:20:08'),
(207, 'test3', 'test23', 0, 1, '2016-04-11 10:24:55', '2016-04-11 10:24:55'),
(208, 'update_test2', 'updated2', 1, 1, '2016-04-11 10:26:26', '2016-04-11 13:59:23'),
(209, 'update_test', 'updated', 1, 1, '2016-04-11 13:29:13', '2016-04-11 13:57:38'),
(210, 'update_test4dgfsgsdsgfs', 'updated4sgsag', 1, 103, '2016-04-11 19:34:07', '2016-04-11 19:34:07');

-- --------------------------------------------------------

--
-- Структура таблицы `album_user`
--

CREATE TABLE `album_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `album_id` int(10) UNSIGNED NOT NULL,
  `permission` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'read',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `album_user`
--

INSERT INTO `album_user` (`id`, `user_id`, `album_id`, `permission`, `created_at`, `updated_at`) VALUES
(103, 105, 184, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(104, 107, 146, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(105, 110, 189, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(106, 112, 178, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(107, 109, 150, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(108, 110, 192, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(109, 109, 172, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(110, 110, 194, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(111, 106, 185, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(112, 110, 142, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(113, 111, 142, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(114, 110, 146, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(115, 111, 172, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(116, 106, 145, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(117, 105, 191, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(118, 109, 189, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(119, 107, 143, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(120, 112, 174, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(121, 111, 195, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(122, 111, 177, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(123, 103, 185, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(124, 104, 197, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(125, 106, 149, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(126, 104, 153, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(127, 108, 161, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(128, 103, 160, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(129, 109, 196, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(130, 108, 176, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(131, 107, 198, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(132, 110, 147, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(133, 109, 177, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(134, 107, 185, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(135, 104, 157, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(136, 108, 188, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(137, 107, 146, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(138, 109, 147, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(139, 109, 150, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(140, 106, 188, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(141, 104, 171, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(142, 105, 144, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(143, 108, 157, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(144, 103, 144, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(145, 107, 158, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(146, 107, 143, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(147, 106, 199, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(148, 109, 176, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(149, 106, 196, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(150, 107, 201, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(151, 109, 193, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(152, 105, 192, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(153, 109, 181, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(154, 110, 186, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(155, 111, 180, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(156, 110, 150, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(157, 111, 175, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(158, 109, 191, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(159, 110, 201, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(160, 107, 158, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(161, 106, 161, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(162, 112, 184, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(163, 107, 197, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(164, 104, 153, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(165, 104, 164, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(166, 110, 143, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(167, 112, 199, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(168, 108, 161, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(169, 112, 192, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(170, 103, 145, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(171, 104, 166, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(172, 109, 193, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(173, 103, 160, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(174, 107, 189, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(175, 109, 144, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(176, 105, 146, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(177, 110, 181, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(178, 108, 179, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(179, 109, 168, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(180, 108, 200, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(181, 108, 177, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(182, 103, 183, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(183, 104, 199, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(184, 109, 168, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(185, 107, 189, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(186, 112, 144, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(187, 104, 201, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(188, 112, 166, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(189, 106, 149, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(190, 112, 179, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(191, 110, 148, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(192, 108, 155, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(193, 112, 170, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(194, 109, 177, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(195, 109, 182, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(196, 111, 156, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(197, 109, 150, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(198, 107, 167, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(199, 107, 182, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(200, 111, 148, 'write', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(201, 104, 201, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(202, 112, 155, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(203, 1, 203, 'read', '2016-04-11 11:01:15', '2016-04-11 11:01:15'),
(207, 1, 207, 'read', '2016-04-11 13:24:55', '2016-04-11 10:24:55'),
(208, 1, 208, 'read', '2016-04-11 10:26:26', '2016-04-11 10:26:26'),
(209, 1, 209, 'read', '2016-04-11 13:29:13', '2016-04-11 13:29:13'),
(210, 103, 210, 'write', '2016-04-11 19:34:07', '2016-04-11 19:34:07');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_04_05_120011_create_albums_table', 1),
('2016_04_05_141733_album_user', 1),
('2016_04_05_142037_add_foreign_keys_album_user', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'kreyser', 'kreytor.sergey@gmail.com', 'admin', '$2y$10$w2TVMInGyY8FqWf0s6e5JeBkxvoU1oIC5zfF2bSDJKFgoiezMtnhW', '29AlBJJmigq6AwblcDuMH0wQxqOPmFMTJSPawWbYkM6QPdekdltYzly3ikRT', '123', '2016-04-05 16:45:18', '2016-04-27 13:38:30'),
(103, 'Prof. Carole Schoen MD', 'Gibson.Angelita@example.org', 'user', '$2y$10$EF7pe2KkrN407SXr6EIX/.dsYtC/ChZbEEOml3b.hGviMyjWjINyO', 'FvzwnwFWpl', '12319', '2016-04-10 10:43:16', '2016-04-10 10:43:16'),
(104, 'Dr. Kendrick Little III', 'Gibson.Caroline@example.net', 'user', '$2y$10$Ttaw7bQlM6K8QvGGmAqf.OUdCsHKXx.VwUOCcb2MbvO3v0InLnt8S', 'eXs5SoO54w', '12312', '2016-04-10 10:43:16', '2016-04-10 10:43:16'),
(105, 'Mrs. Loren Watsica V', 'Willms.Hudson@example.com', 'user', '$2y$10$gbGFqKldtsvVg5QQ3WL6uubaGrpXwxwt4IpIPfyokUDHx1AiDDUty', 'nIxnlCu9hQ', '12329', '2016-04-10 10:43:16', '2016-04-10 10:43:16'),
(106, 'Eliza Metz V', 'iWitting@example.org', 'user', '$2y$10$cyfuT7OcndbnQyWQietK4OZDOaEKuLrj8W/rTAYDuBxhDnHy5mKdG', 'zh5EB9dT6h', '12333', '2016-04-10 10:43:16', '2016-04-10 10:43:16'),
(107, 'Heber Rohan III', 'iSchumm@example.org', 'user', '$2y$10$NqZBCMDIwnxhrkHq/RHKreZPMASXCk8e56WbYs63XSGR4GAdk87rq', 'SOPT8tDHSR', '12396', '2016-04-10 10:43:16', '2016-04-10 10:43:16'),
(108, 'Miss Amira Zieme', 'Volkman.Kurtis@example.net', 'user', '$2y$10$ZwpOj3RhS5GAUF1f56VHc.Nb385/kyYQk8sy8ZFN0s5hvW/ELVcN6', 'yUYnxaYaWV', '12361', '2016-04-10 10:43:16', '2016-04-10 10:43:16'),
(109, 'Frederik Kerluke', 'wReilly@example.org', 'user', '$2y$10$kWpXXAqlx/.EcyT09PHaAu5vxUkA/KJvI5kJsTpLelSsLHi.uI66.', 'pPduMrry7W', '12376', '2016-04-10 10:43:16', '2016-04-10 10:43:16'),
(110, 'Christina Kuvalis', 'hHackett@example.net', 'user', '$2y$10$zF7yba6O2lkBwGP5VjfibeOW1qhb3Uzf7IbTFE/posq4XKTyZViX2', 'cynwSNcljM', '12334', '2016-04-10 10:43:16', '2016-04-10 10:43:16'),
(111, 'Maxine Hintz', 'Stehr.Zoey@example.org', 'user', '$2y$10$J8/cEuJqCuwxN66I3wd0C.JafnCoejG8EnOzSCKPvKc8hm4Y8Bxf6', 'KTZZeQW77M', '12320', '2016-04-10 10:43:16', '2016-04-10 10:43:16'),
(112, 'Sigurd Williamson DVM', 'Jeanne02@example.org', 'user', '$2y$10$AxRUBVEgmtbCp1cEdyk5f.KSblWw6Bi8gJ13orzNXM1v4wGCxHyJa', 'tOhkawUS1K', '12380', '2016-04-10 10:43:16', '2016-04-10 10:43:16'),
(120, 'testRegister', 'register.test@gmail.com', 'user', '$2y$10$WwCJbZJFQ5MNFVO13w8sM.E63u4aZ.x10q/raPp49oX7LZp.NyyYq', NULL, NULL, '2016-04-14 09:45:21', '2016-04-14 09:45:21'),
(122, 'testRegisterRequest', 'update.test@2gmail.com', 'admin', '$2y$10$yAgayUdSGZASYF6ba69CT.6w3zGsEs8dPL3h0/DIia2AjuquYUlWy', NULL, NULL, '2016-04-15 14:02:01', '2016-04-25 11:36:19');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_user_id_index` (`user_id`);

--
-- Индексы таблицы `album_user`
--
ALTER TABLE `album_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_user_album_id_index` (`album_id`),
  ADD KEY `album_user_user_id_index` (`user_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `api_token_index` (`api_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
--
-- AUTO_INCREMENT для таблицы `album_user`
--
ALTER TABLE `album_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `album_user`
--
ALTER TABLE `album_user`
  ADD CONSTRAINT `album_user_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `album_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
