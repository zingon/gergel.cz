-- phpMyAdmin SQL Dump
-- version 4.2.0
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 29. pro 2014, 02:24
-- Verze serveru: 5.6.15-log
-- Verze PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `190_orbcomm`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `admin_preferences`
--

CREATE TABLE IF NOT EXISTS `admin_preferences` (
  `id` int(10) unsigned NOT NULL,
  `kod` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `nazev` varchar(20) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `admin_settings`
--

CREATE TABLE IF NOT EXISTS `admin_settings` (
`id` int(11) NOT NULL,
  `nazev_dodavatele` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `email_podpora_dodavatele` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `logo_dodavatele` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `kohana_debug_mode` tinyint(4) NOT NULL DEFAULT '0',
  `smarty_console` tinyint(4) NOT NULL DEFAULT '0',
  `shutdown` tinyint(4) NOT NULL DEFAULT '0',
  `disable_login` int(11) NOT NULL DEFAULT '0',
  `interni_poznamka` text COLLATE utf8_czech_ci
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `nazev_dodavatele`, `email_podpora_dodavatele`, `logo_dodavatele`, `kohana_debug_mode`, `smarty_console`, `shutdown`, `disable_login`, `interni_poznamka`) VALUES
(1, 'jkhjkj', '', NULL, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `admin_structure`
--

CREATE TABLE IF NOT EXISTS `admin_structure` (
`id` int(11) unsigned NOT NULL,
  `module_code` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `submodule_code` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `module_controller` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `admin_menu_section_id` int(11) NOT NULL,
  `poradi` int(10) unsigned NOT NULL,
  `parent_id` int(11) NOT NULL,
  `zobrazit` tinyint(4) NOT NULL DEFAULT '1',
  `global_access_level` tinyint(4) NOT NULL,
  `available_languages` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=47 ;

--
-- Vypisuji data pro tabulku `admin_structure`
--

INSERT INTO `admin_structure` (`id`, `module_code`, `submodule_code`, `module_controller`, `admin_menu_section_id`, `poradi`, `parent_id`, `zobrazit`, `global_access_level`, `available_languages`) VALUES
(1, 'environment', 'module', 'default', 1, 1, 0, 1, 0, 5),
(2, 'environment', 'setting', 'edit/1/1', 3, 15, 1, 1, 0, 5),
(3, 'environment', 'samodules', 'list', 3, 4, 1, 1, 0, 5),
(4, 'environment', 'salanguages', 'list', 3, 14, 1, 0, 0, 1),
(5, 'environment', 'routes', 'list', 3, 6, 1, 1, 3, 1),
(6, 'environment', 'mainsetup', 'edit/1/1', 3, 1, 1, 1, 3, 1),
(7, 'environment', 'inmodules', 'list', 3, 2, 1, 0, 3, 1),
(8, 'environment', 'registry', 'list', 3, 5, 1, 1, 3, 1),
(9, 'page', 'item', 'list', 1, 2, 0, 1, 0, 1),
(10, 'page', 'item', 'list', 3, 1, 9, 1, 0, 1),
(11, 'page', 'unrelated', 'list', 3, 2, 9, 1, 0, 1),
(12, 'static', 'item', 'list', 3, 3, 9, 1, 0, 1),
(13, 'user', 'item', 'list', 1, 9, 0, 1, 0, 1),
(14, 'article', 'item', 'list', 1, 3, 0, 1, 0, 1),
(15, 'product', 'item', 'list', 1, 5, 0, 0, 0, 1),
(16, 'product', 'item', 'list', 2, 2, 15, 1, 0, 1),
(17, 'product', 'category', 'list', 2, 3, 15, 1, 0, 1),
(18, 'product', 'manufacturer', 'list', 2, 5, 15, 0, 0, 1),
(19, 'product', 'order', 'list', 2, 1, 15, 1, 0, 1),
(20, 'product', 'shipping', 'list', 2, 6, 15, 1, 0, 1),
(21, 'product', 'payment', 'list', 2, 7, 15, 1, 0, 1),
(22, 'product', 'price', 'list', 2, 8, 15, 1, 0, 1),
(23, 'product', 'tax', 'list', 2, 9, 15, 1, 0, 1),
(24, 'page', 'system', 'list', 3, 4, 9, 1, 3, 1),
(25, 'email', 'queue', 'list', 1, 10, 0, 1, 0, 1),
(26, 'email', 'queue', 'list', 3, 1, 25, 1, 0, 1),
(27, 'email', 'type', 'list', 3, 2, 25, 1, 0, 1),
(28, 'email', 'receiver', 'list', 3, 3, 25, 1, 0, 1),
(29, 'email', 'smtp', 'edit/1/1', 3, 4, 25, 1, 0, 1),
(30, 'product', 'shopper', 'list', 2, 4, 15, 1, 0, 1),
(31, 'product', 'orderstates', 'list', 2, 10, 15, 1, 0, 1),
(32, 'product', 'eshopsettings', 'edit/1/1', 2, 11, 15, 1, 0, 1),
(33, 'product', 'voucher', 'list', 2, 12, 15, 1, 0, 1),
(34, 'environment', 'langstrings', 'list', 3, 16, 1, 1, 1, 1),
(35, 'newsletter', 'item', 'list', 1, 15, 0, 0, 0, 1),
(36, 'newsletter', 'item', 'list', 3, 1, 35, 1, 0, 1),
(37, 'newsletter', 'recipient', 'list', 3, 2, 35, 1, 0, 1),
(38, 'comments', 'item', 'list', 1, 11, 0, 0, 0, 1),
(39, 'banner', 'item', 'list', 1, 5, 0, 0, 0, 1),
(40, 'giftbox', 'item', 'list', 2, 13, 15, 0, 0, 1),
(41, 'catalog', 'item', 'list', 1, 4, 0, 1, 0, 1),
(42, 'catalog', 'category', 'list', 2, 1, 41, 0, 0, 1),
(43, 'faq', 'item', 'list', 1, 6, 0, 1, 0, 1),
(44, 'gallery', 'item', 'list', 1, 8, 0, 1, 0, 1),
(45, 'download', 'item', 'list', 1, 7, 0, 1, 0, 1),
(46, 'download', 'category', 'list', 2, 1, 45, 1, 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `admin_structure_data`
--

CREATE TABLE IF NOT EXISTS `admin_structure_data` (
`id` int(11) NOT NULL,
  `admin_structure_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `nadpis` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `popis` text COLLATE utf8_czech_ci
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=50 ;

--
-- Vypisuji data pro tabulku `admin_structure_data`
--

INSERT INTO `admin_structure_data` (`id`, `admin_structure_id`, `language_id`, `nazev`, `nadpis`, `title`, `description`, `keywords`, `popis`) VALUES
(1, 1, 1, 'Základní', 'Základní', 'Základní', '', '', NULL),
(6, 6, 1, 'Nastavení projektu', 'Základní nastavení', 'Základní nastavení', '', '', NULL),
(3, 3, 1, 'Struktura administrace', 'Struktura administrace', 'Struktura administrace', '', '', NULL),
(7, 7, 1, 'Instalátor modulů', 'Instalátor modulů', 'Instalátor modulů', '', '', NULL),
(8, 8, 1, 'Registry modulů', 'Registry modulů', 'Registry modulů', '', '', NULL),
(5, 5, 1, 'Záznamy rout', 'Záznamy rout', 'Záznamy rout', '', '', NULL),
(4, 4, 1, 'Nastavení jazyků', 'Nastavení jazyků', 'Nastavení jazyků', '', '', NULL),
(2, 2, 1, 'Obecné nastavení', 'Obecné nastavení', 'Obecné nastavení', '', '', NULL),
(9, 9, 1, 'Stránky', 'Stránky', 'Stránky', '', '', NULL),
(10, 10, 1, 'Stránky ve struktuře menu', 'Stránky ve struktuře menu', 'Stránky ve struktuře menu', '', '', NULL),
(11, 11, 1, 'Nezařazené stránky', 'Nezařazené stránky', 'Nezařazené stránky', '', '', NULL),
(12, 12, 1, 'Statický obsah', 'Statický obsah', 'Statický obsah', '', '', NULL),
(13, 13, 1, 'Uživatelé', 'Uživatelé', 'Uživatelé', '', '', NULL),
(14, 14, 1, 'Novinky', 'Novinky', 'Novinky', '', NULL, NULL),
(15, 15, 1, 'E-shop', 'E-shop', 'E-shop', '', NULL, NULL),
(16, 16, 1, 'Seznam produktů', 'Seznam produktů', 'Seznam produktů', '', NULL, NULL),
(17, 17, 1, 'Kategorie produktů', 'Kategorie produktů', 'Kategorie produktů', '', NULL, NULL),
(18, 18, 1, 'Výrobci', 'Výrobci', 'Výrobci', '', NULL, NULL),
(19, 19, 1, 'Objednávky', 'Objednávky', 'Objednávky', '', NULL, NULL),
(20, 20, 1, 'Doprava', 'Doprava', 'Doprava', '', NULL, NULL),
(21, 21, 1, 'Platba', 'Platba', 'Platba', '', NULL, NULL),
(22, 22, 1, 'Cenové skupiny', 'Cenové skupiny', 'Cenové skupiny', '', NULL, NULL),
(23, 23, 1, 'DPH', 'DPH', 'DPH', '', NULL, NULL),
(24, 24, 1, 'Systémové stránky', 'Systémové stránky', 'Systémové stránky', '', NULL, NULL),
(25, 25, 1, 'Email', 'Email', 'Email', '', NULL, NULL),
(26, 26, 1, 'Fronta emailů', 'Fronta emailů', 'Fronta emailů', '', NULL, NULL),
(27, 27, 1, 'Typy emailů', 'Typy emailů', 'Typy emailů', '', NULL, NULL),
(28, 28, 1, 'Příjemci emailů', 'Příjemci emailů', 'Příjemci emailů', '', NULL, NULL),
(29, 29, 1, 'Nastavení SMTP', 'Nastavení SMTP', 'Nastavení SMTP', '', NULL, NULL),
(30, 30, 1, 'Uživatelé', 'Uživatelé', 'Uživatelé', '', NULL, NULL),
(31, 31, 1, 'Stavy objednávek', 'Stavy objednávek', 'Stavy objednávek', '', NULL, NULL),
(32, 32, 1, 'Nastavení eshopu', 'Nastavení eshopu', 'Nastavení eshopu', '', NULL, NULL),
(33, 33, 1, 'Slevové kupóny', 'Slevové kupóny', 'Slevové kupóny', '', NULL, NULL),
(34, 34, 1, 'Statické překlady', 'Statické překlady', 'Statické překlady', '', NULL, NULL),
(35, 35, 1, 'Newsletter', 'Newsletter', 'Newsletter', '', NULL, NULL),
(36, 36, 1, 'Newsletter', 'Newsletter', 'Newsletter', '', NULL, NULL),
(37, 37, 1, 'Newsletter - příjemci', 'Newsletter - příjemci', 'Newsletter - příjemci', '', NULL, NULL),
(38, 38, 1, 'Poradna', 'Poradna', 'Poradna', '', NULL, NULL),
(39, 39, 1, 'bannery', 'bannery', 'bannery', '', NULL, NULL),
(40, 40, 1, 'Dárkové balení', 'Dárkové balení', 'Dárkové balení', '', NULL, NULL),
(41, 41, 1, 'Katalog', 'Katalog', 'Katalog', '', NULL, NULL),
(42, 42, 1, 'Kategorie', 'Kategorie', 'Kategorie', '', NULL, NULL),
(43, 43, 1, 'Poradna', 'Poradna', 'Poradna', '', NULL, NULL),
(44, 44, 1, 'Galerie', 'Galerie', 'Galerie', '', NULL, NULL),
(45, 45, 1, 'Ke stažení', 'Ke stažení', 'Ke stažení', '', NULL, NULL),
(46, 46, 1, 'Kategorie', 'Kategorie', 'Kategorie', '', NULL, NULL),
(47, 1, 4, 'Defaults', 'Defaults', 'Defaults', '', NULL, NULL),
(48, 3, 4, 'Administration structure', 'Samodules', 'Samodules', '', NULL, NULL),
(49, 2, 4, 'Default setting', 'Default setting', 'Default setting', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `poradi` int(11) NOT NULL,
  `article_category_id` int(11) NOT NULL,
  `photo_src` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `available_languages` int(11) NOT NULL DEFAULT '1',
  `gallery_id` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=8 ;

--
-- Vypisuji data pro tabulku `articles`
--

INSERT INTO `articles` (`id`, `date`, `poradi`, `article_category_id`, `photo_src`, `available_languages`, `gallery_id`) VALUES
(1, '2014-10-29', 1, 0, 'testovaci-novinky', 1, 0),
(2, '2014-11-02', 2, 0, 'testovaci-novinka-2', 1, NULL),
(3, '2014-11-02', 3, 0, '', 1, NULL),
(4, '2014-11-02', 4, 0, '', 1, NULL),
(6, '2014-11-02', 6, 0, '', 1, NULL),
(7, '2014-11-02', 7, 0, '', 1, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `article_data`
--

CREATE TABLE IF NOT EXISTS `article_data` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `nadpis` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `autor` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `uvodni_popis` text COLLATE utf8_czech_ci,
  `popis` text COLLATE utf8_czech_ci,
  `article_category_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=8 ;

--
-- Vypisuji data pro tabulku `article_data`
--

INSERT INTO `article_data` (`id`, `language_id`, `article_id`, `route_id`, `nazev`, `nadpis`, `autor`, `email`, `uvodni_popis`, `popis`, `article_category_id`) VALUES
(1, 1, 1, 17, 'Testovací novinky', 'Testovací novinky', '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing eli&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing eliLorem ipsum dolor sit amet, consectetur adipiscing eli&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing eli</p>\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan facilisis purus, et maximus ipsum rutrum at. In porta, nisl a suscipit aliquet, erat ipsum pellentesque lectus, at pulvinar enim dolor eget neque. Duis vulputate ipsum nec urna condimentum pharetra. In sed posuere metus. Nullam in nisl aliquet, euismod ex in, mollis odio. Praesent et neque eget neque tempus posuere. Mauris vitae rutrum nunc, quis porttitor libero. Phasellus turpis neque, mattis nec augue bibendum, venenatis vulputate purus. Ut eleifend aliquam diam, a hendrerit sem fringilla et. Quisque aliquam felis quis felis consectetur, vitae tristique leo convallis. Etiam semper volutpat volutpat.</p>\n\n<p>Morbi vulputate luctus egestas. Integer odio tortor, laoreet ac quam nec, sodales finibus leo. Mauris sollicitudin turpis eros, scelerisque ornare quam dignissim nec. Sed justo massa, maximus id mattis nec, iaculis congue nunc. Suspendisse auctor dictum elit sit amet tempor. Vestibulum eu blandit nulla, in facilisis magna. Integer eget libero sed est hendrerit dignissim non vel metus.</p>\n', 0),
(2, 1, 2, 43, 'Testovací novinka 2', 'Testovací novinka 2', '', '', '<p style="text-align: justify;"><span style="line-height: 20.7999992370605px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span><span style="line-height: 20.7999992370605px; text-align: justify;">Lorem ipsum dolor sit amet.&nbsp;</span></p>\n', '<p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pulvinar, tellus eget efficitur viverra, lacus mauris rhoncus velit, sit amet congue ex purus sit amet elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in feugiat lacus. Pellentesque dapibus libero semper faucibus commodo. Praesent mi ex, viverra nec finibus vel, bibendum a ante. Vivamus ultrices felis turpis, non ornare est rutrum nec. Etiam in mi eu dolor tincidunt dapibus. Cras feugiat nulla semper, condimentum est vel, sollicitudin enim.</p>\n\n<p style="text-align: justify;">Nam id pretium est. Vivamus ac elit efficitur, bibendum mi in, laoreet neque. Donec maximus interdum tellus, vitae sagittis sapien aliquam finibus. Fusce vel sem nec augue ornare placerat in sed dolor. Cras auctor nisi ac sodales pretium. Aenean dui libero, mollis elementum sem at, fermentum porta justo. Sed hendrerit placerat metus, mattis condimentum magna. Integer varius diam condimentum tristique ullamcorper. Donec varius mauris et nunc semper, nec egestas massa ullamcorper. Vestibulum pharetra mauris a volutpat tincidunt. Pellentesque at massa ante. Donec eu mollis libero. Duis imperdiet urna nec odio auctor feugiat.</p>\n\n<p style="text-align: justify;">Nam non auctor dolor. Etiam pretium velit quis condimentum dictum. Cras diam lorem, mattis ut efficitur scelerisque, interdum sed mauris. Nullam vel egestas metus. Pellentesque orci libero, sagittis eu congue ut, tempor quis ligula. Donec nec tellus erat. Aliquam nec urna et nulla pellentesque accumsan eget non magna. Duis sit amet ante enim. Duis quis vulputate enim, vel ornare nisl.</p>\n', 0),
(3, 1, 3, 44, 'Testovací novinka 3', 'Testovací novinka 3', '', '', NULL, NULL, 0),
(4, 1, 4, 45, 'Testovací novinka 4', 'Testovací novinka 4', '', '', NULL, NULL, 0),
(6, 1, 6, 47, 'Testovací novinka 6', 'Testovací novinka 6', '', '', NULL, NULL, 0),
(7, 1, 7, 48, 'Testovací novinka 7', 'Testovací novinka 7', '', '', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `article_downloads_articles`
--

CREATE TABLE IF NOT EXISTS `article_downloads_articles` (
`id` bigint(20) unsigned NOT NULL,
  `article_id` int(11) NOT NULL,
  `download_id` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Vypisuji data pro tabulku `article_downloads_articles`
--

INSERT INTO `article_downloads_articles` (`id`, `article_id`, `download_id`) VALUES
(1, 1, 7),
(5, 5, 5),
(3, 2, 5),
(4, 2, 7),
(6, 5, 6),
(7, 5, 7),
(8, 5, 8);

-- --------------------------------------------------------

--
-- Struktura tabulky `article_photos`
--

CREATE TABLE IF NOT EXISTS `article_photos` (
`id` int(11) NOT NULL,
  `poradi` int(11) NOT NULL,
  `zobrazit` tinyint(4) NOT NULL DEFAULT '1',
  `photo_src` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `ext` char(4) COLLATE utf8_czech_ci NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=21 ;

--
-- Vypisuji data pro tabulku `article_photos`
--

INSERT INTO `article_photos` (`id`, `poradi`, `zobrazit`, `photo_src`, `ext`, `article_id`) VALUES
(1, 1, 1, 'nature', 'jpg', 2),
(2, 2, 1, 'edm-stage-design-tomorrowland-2013-daytime', 'jpg', 2),
(3, 3, 1, 'hkj9d5f', 'jpg', 2),
(4, 4, 1, 'tomorrowland10_youredm', 'jpg', 2),
(5, 5, 1, 'nature_1', 'jpg', 2),
(6, 6, 1, 'edm-stage-design-tomorrowland-2013-daytime_1', 'jpg', 2),
(7, 7, 1, 'hkj9d5f_1', 'jpg', 2),
(8, 8, 1, 'tomorrowland10_youredm_1', 'jpg', 2),
(9, 9, 1, 'nature_2', 'jpg', 2),
(10, 10, 1, 'edm-stage-design-tomorrowland-2013-daytime_2', 'jpg', 2),
(11, 11, 1, 'hkj9d5f_2', 'jpg', 2),
(12, 12, 1, 'tomorrowland10_youredm_2', 'jpg', 2),
(13, 13, 1, 'nature_3', 'jpg', 2),
(14, 14, 1, 'edm-stage-design-tomorrowland-2013-daytime_3', 'jpg', 2),
(15, 15, 1, 'hkj9d5f_3', 'jpg', 2),
(16, 16, 1, 'tomorrowland10_youredm_3', 'jpg', 2),
(17, 17, 1, 'nature_4', 'jpg', 2),
(18, 18, 1, 'edm-stage-design-tomorrowland-2013-daytime_4', 'jpg', 2),
(19, 19, 1, 'hkj9d5f_4', 'jpg', 2),
(20, 20, 1, 'tomorrowland10_youredm_4', 'jpg', 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `article_photo_data`
--

CREATE TABLE IF NOT EXISTS `article_photo_data` (
`id` int(11) NOT NULL,
  `article_photo_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=21 ;

--
-- Vypisuji data pro tabulku `article_photo_data`
--

INSERT INTO `article_photo_data` (`id`, `article_photo_id`, `language_id`, `nazev`, `popis`) VALUES
(1, 1, 0, 'Nature', ''),
(2, 2, 0, 'EDM-stage-design-Tomorrowland-2013-daytime', ''),
(3, 3, 0, 'HKJ9d5f', ''),
(4, 4, 0, 'tomorrowland10_youredm', ''),
(5, 5, 0, 'Nature', ''),
(6, 6, 0, 'EDM-stage-design-Tomorrowland-2013-daytime', ''),
(7, 7, 0, 'HKJ9d5f', ''),
(8, 8, 0, 'tomorrowland10_youredm', ''),
(9, 9, 0, 'Nature', ''),
(10, 10, 0, 'EDM-stage-design-Tomorrowland-2013-daytime', ''),
(11, 11, 0, 'HKJ9d5f', ''),
(12, 12, 0, 'tomorrowland10_youredm', ''),
(13, 13, 0, 'Nature', ''),
(14, 14, 0, 'EDM-stage-design-Tomorrowland-2013-daytime', ''),
(15, 15, 0, 'HKJ9d5f', ''),
(16, 16, 0, 'tomorrowland10_youredm', ''),
(17, 17, 0, 'Nature', ''),
(18, 18, 0, 'EDM-stage-design-Tomorrowland-2013-daytime', ''),
(19, 19, 0, 'HKJ9d5f', ''),
(20, 20, 0, 'tomorrowland10_youredm', '');

-- --------------------------------------------------------

--
-- Struktura tabulky `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
`id` int(11) NOT NULL,
  `poradi` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=21 ;

--
-- Vypisuji data pro tabulku `banners`
--

INSERT INTO `banners` (`id`, `poradi`) VALUES
(16, 3),
(15, 2),
(14, 1),
(20, 4);

-- --------------------------------------------------------

--
-- Struktura tabulky `banners_old`
--

CREATE TABLE IF NOT EXISTS `banners_old` (
`id` int(11) NOT NULL,
  `poradi` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `photo_src` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `zobrazit` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=9 ;

--
-- Vypisuji data pro tabulku `banners_old`
--

INSERT INTO `banners_old` (`id`, `poradi`, `url`, `photo_src`, `zobrazit`) VALUES
(1, 3, '', 'banner', 1),
(2, 4, '', 'banner', 1),
(3, 5, '/omega-3-max--3020', 'banner', 1),
(4, 6, '/ostrovidky-neo', 'banner', 1),
(5, 7, '/rakytnikovy-olej-vitamin-d', 'banner', 1),
(6, 8, '/stimodin', 'banner', 1),
(7, 2, '/darkove-poukazy', 'banner', 1),
(8, 1, '/darkove-krabicky', 'banner', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `banner_data`
--

CREATE TABLE IF NOT EXISTS `banner_data` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `banner_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `photo_src` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `zobrazit` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=58 ;

--
-- Vypisuji data pro tabulku `banner_data`
--

INSERT INTO `banner_data` (`id`, `language_id`, `banner_id`, `url`, `photo_src`, `zobrazit`) VALUES
(48, 0, 0, '/led-zarovky', 'banner-', 1),
(50, 0, 0, '', 'banner-', 1),
(43, 0, 0, 'http://seznam.cz', 'banner-', 1),
(35, 0, 0, 'stmivac', 'banner-', 1),
(42, 0, 0, 'http://seznam.cz', 'banner-', 1),
(32, 0, 0, 'zarovka', 'banner-', 1),
(33, 0, 0, 'zarovka', 'banner-', 1),
(10, 0, 0, '', 'banner-', 0),
(47, 0, 0, '', 'banner-', 1),
(12, 0, 0, '', 'banner-', 1),
(13, 0, 0, '', 'banner-', 1),
(14, 0, 0, '', 'banner-', 1),
(15, 0, 0, '', 'banner-', 1),
(16, 0, 0, '', 'banner-', 1),
(17, 0, 0, '', 'banner-', 1),
(18, 0, 0, '', 'banner-', 1),
(19, 0, 0, '', 'banner-', 1),
(46, 1, 16, '/index', 'banner-1', 1),
(45, 1, 15, '/led-pasky', 'banner-1', 1),
(44, 0, 0, '', 'banner-', 0),
(37, 0, 0, '/index', 'banner-', 1),
(41, 1, 14, '/led-zarovky', 'banner-1', 1),
(40, 0, 0, '/index', 'banner-', 1),
(30, 0, 0, 'led ovladac', 'banner-', 1),
(49, 0, 0, '/index', 'banner-', 1),
(51, 0, 0, '', 'banner-', 1),
(52, 0, 0, '', 'banner-', 1),
(54, 0, 0, '/led-sety', 'banner-', 1),
(56, 0, 0, '', 'banner-', 1),
(57, 1, 20, '/led-sety', 'banner-1', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `text_question` text COLLATE utf8_czech_ci,
  `text_response` text COLLATE utf8_czech_ci,
  `authorized` tinyint(4) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
`id` bigint(20) unsigned NOT NULL,
  `available_languages` int(11) NOT NULL DEFAULT '1',
  `download_category_id` int(11) NOT NULL,
  `poradi` int(11) NOT NULL,
  `product_category_id` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Vypisuji data pro tabulku `downloads`
--

INSERT INTO `downloads` (`id`, `available_languages`, `download_category_id`, `poradi`, `product_category_id`) VALUES
(11, 1, 3, 6, 14),
(6, 1, 1, 2, 16),
(5, 5, 1, 1, 16),
(8, 1, 0, 0, NULL),
(9, 1, 1, 4, 9),
(10, 1, 2, 5, 14),
(12, 1, 3, 7, 14),
(13, 1, 3, 8, 14),
(14, 1, 3, 9, 14),
(15, 1, 3, 10, 14),
(16, 1, 3, 11, 14),
(17, 1, 1, 12, 14),
(18, 1, 2, 13, 19);

-- --------------------------------------------------------

--
-- Struktura tabulky `download_categories`
--

CREATE TABLE IF NOT EXISTS `download_categories` (
`id` bigint(20) unsigned NOT NULL,
  `available_languages` int(11) NOT NULL DEFAULT '1',
  `poradi` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Vypisuji data pro tabulku `download_categories`
--

INSERT INTO `download_categories` (`id`, `available_languages`, `poradi`) VALUES
(1, 5, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4);

-- --------------------------------------------------------

--
-- Struktura tabulky `download_category_data`
--

CREATE TABLE IF NOT EXISTS `download_category_data` (
`id` bigint(20) unsigned NOT NULL,
  `download_category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `nazev` varchar(255) NOT NULL,
  `nadpis` varchar(255) NOT NULL,
  `popis` text,
  `uvodni_popis` text,
  `zobrazit` tinyint(1) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `download_category_data`
--

INSERT INTO `download_category_data` (`id`, `download_category_id`, `language_id`, `nazev`, `nadpis`, `popis`, `uvodni_popis`, `zobrazit`) VALUES
(1, 1, 1, 'Produktové listy', 'Produktové listy', NULL, '<p>Produktové a katlogové listy<br />\n&nbsp;</p>\n', 1),
(2, 2, 1, 'Pracovní postupy', 'Pracovní postupy', NULL, '<p>Návody jak pracovat s materiály...</p>\n', 1),
(3, 1, 4, 'Lorem-en', 'Lorem', '<p>asdasdasd</p>\n', NULL, 1),
(4, 3, 1, 'Certifikáty', 'Certifikáty', NULL, '<p>ALU-BOND A2, DEBOND, PVC,...</p>\n', 1),
(5, 4, 1, 'Pomocníci', 'Pomocníci', '<p>Výpočet hmotnosti tabulových materiálů:</p>\n\n<p>Váhy jednotlivých materiálů na 1m<sup>2</sup> zjistíte pomocí tohoto výpočtu:<br />\nváha 1m<sup>2</sup> = &nbsp;koef. &nbsp;x &nbsp;tloušťka v mm</p>\n\n<p>Zde jsou přibližné koeficienty jednotlivých materiálů:<br />\n<strong>PMMA (plexisklo) = 1,2</strong><br />\n<strong>PVC = 0,6</strong><br />\n<strong>Al plech = 2,7</strong><br />\n<strong>PET G = 1,27</strong><br />\n<br />\n<strong style="line-height: 1.6;">DEBOND - hmotnost /m2/: &nbsp;&nbsp;</strong><br />\n<strong style="line-height: 1.6;">Al 0,12 / 3 mm = 3,4 kg/m2&nbsp;</strong><br />\n<strong style="line-height: 1.6;">Al 0,18 / 3 mm = 3,54 kg/m2&nbsp;</strong><br />\n<strong style="line-height: 1.6;">Al 0,21 / 2 mm=- 2,5 kg/m2&nbsp;</strong><br />\n<strong style="line-height: 1.6;">Al 0.21 / 3 mm = 3,6 kg/m2&nbsp;</strong><br />\n<strong style="line-height: 1.6;">Al 0,3 / 3 mm = 3,85 kg/m2&nbsp;</strong><br />\n<strong style="line-height: 1.6;">Al 0,3 / 4 mm = 4,8 kg/m2&nbsp;</strong><br />\n<strong style="line-height: 1.6;">Al 0,5 / 4 mm = 5,5 kg/m2</strong></p>\n', '<p>Hmotnostní koeficienty</p>\n', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `download_data`
--

CREATE TABLE IF NOT EXISTS `download_data` (
`id` bigint(20) unsigned NOT NULL,
  `download_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `nazev` varchar(255) NOT NULL,
  `file_src` varchar(255) DEFAULT NULL,
  `zobrazit` tinyint(1) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Vypisuji data pro tabulku `download_data`
--

INSERT INTO `download_data` (`id`, `download_id`, `language_id`, `nazev`, `file_src`, `zobrazit`) VALUES
(22, 11, 1, 'ALU-BOND A2', 'alu-bond-a2-1.pdf', 1),
(11, 6, 1, 'lehčené PVC PALIGHT', 'lehcene-pvc-palight-1.pdf', 1),
(9, 5, 1, 'lehčené PVC PALFOAM', 'lehcene-pvc-palfoam-1.pdf', 1),
(19, 8, 1, '', NULL, 0),
(18, 5, 4, 'Testing download item', NULL, 1),
(20, 9, 1, 'DENCOP SoundProtect', 'dencop-soundprotect-1.pdf', 1),
(21, 10, 1, 'DEBOND zpracování', 'debond-zpracovani-1.pdf', 1),
(23, 12, 1, 'ALU-BOND A2 reakce na oheň', 'alu-bond-a2-reakce-na-ohen-1.pdf', 1),
(24, 13, 1, 'ACP/DEBOND kazety', 'acpdebond-kazety-1.pdf', 1),
(25, 14, 1, 'DEBOND reakce na oheň', 'debond-reakce-na-ohen-1.pdf', 1),
(26, 15, 1, 'DEBOND 2014', 'debond-2014-1.pdf', 1),
(27, 16, 1, 'ACP BOND2000 reakce na oheň', 'acp-bond2000-reakce-na-ohen-1.pdf', 1),
(28, 17, 1, 'ALU-BOND A2 + DEBOND', 'alu-bond-a2--debond-1.pdf', 1),
(29, 18, 1, 'Pravidla pro přípravu dat pro frézování', 'pravidla-pro-pripravu-dat-pro-frezovani-1.pdf', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `email_queue`
--

CREATE TABLE IF NOT EXISTS `email_queue` (
`id` bigint(20) NOT NULL,
  `queue_to_email` varchar(255) NOT NULL,
  `queue_to_name` varchar(255) DEFAULT NULL,
  `queue_cc_email` varchar(255) DEFAULT NULL,
  `queue_cc_name` varchar(255) DEFAULT NULL,
  `email_queue_body_id` int(11) NOT NULL,
  `queue_sent` tinyint(4) NOT NULL DEFAULT '0',
  `queue_sent_date` datetime DEFAULT NULL,
  `queue_priority` int(11) NOT NULL DEFAULT '0',
  `queue_date_to_be_send` datetime DEFAULT NULL,
  `queue_create_date` datetime NOT NULL,
  `queue_errors_count` tinyint(4) NOT NULL DEFAULT '0',
  `queue_error` text
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Vypisuji data pro tabulku `email_queue`
--

INSERT INTO `email_queue` (`id`, `queue_to_email`, `queue_to_name`, `queue_cc_email`, `queue_cc_name`, `email_queue_body_id`, `queue_sent`, `queue_sent_date`, `queue_priority`, `queue_date_to_be_send`, `queue_create_date`, `queue_errors_count`, `queue_error`) VALUES
(1, 'tom.barborik@dgstudio.cz', 'tom.barborik@dgstudio.cz / developer', NULL, NULL, 1, 1, '2014-11-02 18:17:01', 2, '2014-11-02 18:17:01', '2014-11-02 18:17:01', 0, NULL),
(2, 'tom.barborik@dgstudio.cz', 'tom.barborik@dgstudio.cz / developer', NULL, NULL, 2, 1, '2014-11-02 18:18:39', 2, '2014-11-02 18:18:39', '2014-11-02 18:18:39', 0, NULL),
(3, 'tom.barborik@dgstudio.cz', 'tom.barborik@dgstudio.cz / developer', NULL, NULL, 3, 1, '2014-11-02 18:21:37', 2, '2014-11-02 18:21:37', '2014-11-02 18:21:37', 0, NULL),
(4, 'tom.barborik@dgstudio.cz', 'tom.barborik@dgstudio.cz / developer', NULL, NULL, 4, 1, '2014-11-02 18:22:34', 2, '2014-11-02 18:22:34', '2014-11-02 18:22:34', 0, NULL),
(5, 'tom.barborik@dgstudio.cz', 'tom.barborik@dgstudio.cz / developer', NULL, NULL, 5, 1, '2014-11-02 18:25:37', 2, '2014-11-02 18:25:37', '2014-11-02 18:25:37', 0, NULL),
(6, 'tom.barborik@dgstudio.cz', 'tom.barborik@dgstudio.cz / developer', NULL, NULL, 6, 1, '2014-11-28 16:18:51', 2, '2014-11-28 16:18:50', '2014-11-28 16:18:50', 0, NULL),
(7, 'tom.barborik@dgstudio.cz', 'tom.barborik@dgstudio.cz / developer', NULL, NULL, 7, 1, '2014-12-01 13:22:52', 2, '2014-12-01 13:22:52', '2014-12-01 13:22:52', 0, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `email_queue_bodies`
--

CREATE TABLE IF NOT EXISTS `email_queue_bodies` (
`id` bigint(20) NOT NULL,
  `queue_subject` varchar(255) DEFAULT NULL,
  `queue_from_email` varchar(255) NOT NULL,
  `queue_from_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `queue_body` text NOT NULL,
  `queue_attached_file` varchar(255) DEFAULT NULL,
  `queue_newsletter_id` int(11) DEFAULT NULL,
  `queue_shopper_id` bigint(20) DEFAULT NULL,
  `queue_branch_id` bigint(20) DEFAULT NULL,
  `queue_order_id` bigint(20) DEFAULT NULL,
  `queue_user_id` bigint(20) DEFAULT NULL,
  `queue_email_type_id` int(11) DEFAULT NULL,
  `queue_send_by_cron` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Vypisuji data pro tabulku `email_queue_bodies`
--

INSERT INTO `email_queue_bodies` (`id`, `queue_subject`, `queue_from_email`, `queue_from_name`, `queue_body`, `queue_attached_file`, `queue_newsletter_id`, `queue_shopper_id`, `queue_branch_id`, `queue_order_id`, `queue_user_id`, `queue_email_type_id`, `queue_send_by_cron`) VALUES
(1, 'Poptávkový formulář z dencop.cz', 'barborik.tom25@gmail.com', 'Tom Barbořík', '<!DOCTYPE html>\r\n<html lang="cs">\r\n    <head>\r\n    </head>\r\n    <body>\r\n    <h2>Základní informace:</h2>\r\n        <table border="0">\r\n            <tr>\r\n                <td style="padding-right: 15px"><strong>Jméno:</strong> </td>\r\n                <td> Tom Barbořík</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Email:</strong> </td>\r\n                <td> barborik.tom25@gmail.com</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Telefon:</strong> </td>\r\n                <td> 777616838</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Přeje si kontaktovat: </strong> </td>\r\n                <td> telefonicky a emailem</td>\r\n            </tr>\r\n                            <tr>\r\n                    <td><strong>K formuláři přišel z kategorie: </strong> </td>\r\n                    <td> Produktová řešení</td>\r\n                </tr>\r\n                    </table>\r\n            <h2>Má zájem o:</h2>\r\n        <ul>\r\n                            <li>Ukázková kategorie</li>\r\n                            <li>Odvětratelné fasády</li>\r\n                            <li>Prosklené fasády</li>\r\n                            <li>Opláštení cerpacích stanic</li>\r\n                            <li>Opláštění modulární stavby - obytné a sanitární kontejnery</li>\r\n                            <li>Výplně balkónů</li>\r\n                            <li>Protihlukové stěny</li>\r\n                            <li>Obklady a dekorace</li>\r\n                            <li>3D design objekty</li>\r\n                            <li>Opláštění strojů a zařízení</li>\r\n                            <li>Městské mobiliáře a zastávkové přístřešky</li>\r\n                    </ul>\r\n                <h2>Dotaz / připomínka:</h2>\r\n        <p>\r\n            asdasd\r\n        </p>\r\n        </body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 'Poptávkový formulář z dencop.cz', 'barborik.tom25@gmail.com', 'Tom Barbořík', '<!DOCTYPE html>\r\n<html lang="cs">\r\n    <head>\r\n    </head>\r\n    <body>\r\n    <h2>Základní informace:</h2>\r\n        <table border="0">\r\n            <tr>\r\n                <td style="padding-right: 15px"><strong>Jméno:</strong> </td>\r\n                <td> Tom Barbořík</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Email:</strong> </td>\r\n                <td> barborik.tom25@gmail.com</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Telefon:</strong> </td>\r\n                <td> 777616838</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Přeje si kontaktovat: </strong> </td>\r\n                <td> telefonicky a emailem</td>\r\n            </tr>\r\n                            <tr>\r\n                    <td><strong>K formuláři přišel z kategorie: </strong> </td>\r\n                    <td> Produktová řešení</td>\r\n                </tr>\r\n                    </table>\r\n            <h2>Má zájem o:</h2>\r\n        <ul>\r\n                            <li>Ukázková kategorie</li>\r\n                            <li>Odvětratelné fasády</li>\r\n                            <li>Prosklené fasády</li>\r\n                            <li>Opláštení cerpacích stanic</li>\r\n                            <li>Opláštění modulární stavby - obytné a sanitární kontejnery</li>\r\n                            <li>Výplně balkónů</li>\r\n                            <li>Protihlukové stěny</li>\r\n                            <li>Obklady a dekorace</li>\r\n                            <li>3D design objekty</li>\r\n                            <li>Opláštění strojů a zařízení</li>\r\n                            <li>Městské mobiliáře a zastávkové přístřešky</li>\r\n                    </ul>\r\n                <h2>Dotaz / připomínka:</h2>\r\n        <p>\r\n            asdasd\r\n        </p>\r\n        </body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 'Poptávkový formulář z dencop.cz', 'barborik.tom25@gmail.com', 'Tom Barbořík', '<!DOCTYPE html>\r\n<html lang="cs">\r\n    <head>\r\n    </head>\r\n    <body>\r\n    <h2>Základní informace:</h2>\r\n        <table border="0">\r\n            <tr>\r\n                <td style="padding-right: 15px"><strong>Jméno:</strong> </td>\r\n                <td> Tom Barbořík</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Email:</strong> </td>\r\n                <td> barborik.tom25@gmail.com</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Telefon:</strong> </td>\r\n                <td> 777616838</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Přeje si kontaktovat: </strong> </td>\r\n                <td> telefonicky a emailem</td>\r\n            </tr>\r\n                    </table>\r\n            <h2>Má zájem o:</h2>\r\n        <ul>\r\n                            <li>Ukázková kategorie</li>\r\n                            <li>Odvětratelné fasády</li>\r\n                            <li>Prosklené fasády</li>\r\n                            <li>Opláštení cerpacích stanic</li>\r\n                            <li>Opláštění modulární stavby - obytné a sanitární kontejnery</li>\r\n                            <li>Výplně balkónů</li>\r\n                            <li>Protihlukové stěny</li>\r\n                            <li>Obklady a dekorace</li>\r\n                            <li>3D design objekty</li>\r\n                            <li>Opláštění strojů a zařízení</li>\r\n                            <li>Městské mobiliáře a zastávkové přístřešky</li>\r\n                    </ul>\r\n                <h2>Dotaz / připomínka:</h2>\r\n        <p>\r\n            asdasd\r\n        </p>\r\n        </body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 'Poptávkový formulář z dencop.cz', 'barborik.tom25@gmail.com', 'Tom Barbořík', '<!DOCTYPE html>\r\n<html lang="cs">\r\n    <head>\r\n    </head>\r\n    <body>\r\n    <h2>Základní informace:</h2>\r\n        <table border="0">\r\n            <tr>\r\n                <td style="padding-right: 15px"><strong>Jméno:</strong> </td>\r\n                <td> Tom Barbořík</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Email:</strong> </td>\r\n                <td> barborik.tom25@gmail.com</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Telefon:</strong> </td>\r\n                <td> 777616838</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Přeje si kontaktovat: </strong> </td>\r\n                <td>   emailem</td>\r\n            </tr>\r\n                    </table>\r\n            <h2>Má zájem o:</h2>\r\n        <ul>\r\n                            <li>Opláštení cerpacích stanic</li>\r\n                            <li>Výplně balkónů</li>\r\n                            <li>Obklady a dekorace</li>\r\n                            <li>Opláštění strojů a zařízení</li>\r\n                            <li>Městské mobiliáře a zastávkové přístřešky</li>\r\n                            <li>PMMA (plexisklo)</li>\r\n                            <li>LED technologie</li>\r\n                    </ul>\r\n                <h2>Dotaz / připomínka:</h2>\r\n        <p>\r\n            asdasd\r\n        </p>\r\n        </body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(5, 'Kontaktní formulář z dencop.cz', 'barborik.tom25@gmail.com', 'Tom Demo', '\r\n<br /><br />\r\n<table cellpadding="5" style="border: none; border-collapse: collapse;">\r\n  <tr>\r\n    <td><strong>Zpráva z kontaktního formuláře www stránek</strong></td>\r\n    <td>Alubond</td>\r\n  </tr>\r\n  <tr>\r\n    <td><strong>Název stránky</strong></td>\r\n    <td>Kontakt</td>\r\n  </tr>\r\n  <tr>\r\n    <td><strong>URL</strong></td>\r\n    <td>http://dencop.dgsbeta.cz/kontakt</td>\r\n  </tr>\r\n  \r\n  <tr>\r\n    <td><strong>Jméno odesílatele</strong></td>\r\n    <td>Tom Demo</td>\r\n  </tr>\r\n   <tr>\r\n    <td><strong>E-mail odesílatele</strong></td>\r\n    <td>barborik.tom25@gmail.com</td>\r\n  </tr>\r\n  \r\n   \r\n\r\n  <tr>\r\n    <td colspan="2">&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan="2">Text dotazu:</td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan="2"> dsadsad</td>\r\n  </tr>\r\n  <tr>\r\n</table>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(6, 'Kontaktní formulář z dencop.cz', 'marketing@dencop.cz', 'ivana', '\r\n<br /><br />\r\n<table cellpadding="5" style="border: none; border-collapse: collapse;">\r\n  <tr>\r\n    <td><strong>Zpráva z kontaktního formuláře www stránek</strong></td>\r\n    <td>Alubond</td>\r\n  </tr>\r\n  <tr>\r\n    <td><strong>Název stránky</strong></td>\r\n    <td>Kontakt</td>\r\n  </tr>\r\n  <tr>\r\n    <td><strong>URL</strong></td>\r\n    <td>http://dencop.dgsbeta.cz/kontakt</td>\r\n  </tr>\r\n  \r\n  <tr>\r\n    <td><strong>Jméno odesílatele</strong></td>\r\n    <td>ivana</td>\r\n  </tr>\r\n   <tr>\r\n    <td><strong>E-mail odesílatele</strong></td>\r\n    <td>marketing@dencop.cz</td>\r\n  </tr>\r\n  \r\n   \r\n\r\n  <tr>\r\n    <td colspan="2">&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan="2">Text dotazu:</td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan="2"> pokus</td>\r\n  </tr>\r\n  <tr>\r\n</table>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(7, 'Poptávkový formulář z dencop.cz', 'yfanna@seznam.cz', 'ivana f', '<!DOCTYPE html>\r\n<html lang="cs">\r\n    <head>\r\n    </head>\r\n    <body>\r\n    <h2>Základní informace:</h2>\r\n        <table border="0">\r\n            <tr>\r\n                <td style="padding-right: 15px"><strong>Jméno:</strong> </td>\r\n                <td> ivana f</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Email:</strong> </td>\r\n                <td> yfanna@seznam.cz</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Telefon:</strong> </td>\r\n                <td> 777777777</td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>Přeje si kontaktovat: </strong> </td>\r\n                <td> telefonicky a emailem</td>\r\n            </tr>\r\n                    </table>\r\n            <h2>Má zájem o:</h2>\r\n        <ul>\r\n                            <li>Ukázková kategorie</li>\r\n                            <li>Výplně balkónů</li>\r\n                            <li>Opláštění strojů a zařízení</li>\r\n                            <li>Lehčené PVC</li>\r\n                    </ul>\r\n                <h2>Dotaz / připomínka:</h2>\r\n        <p>\r\n            mám dotaz\r\n        </p>\r\n        </body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `email_receivers`
--

CREATE TABLE IF NOT EXISTS `email_receivers` (
`id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=3 ;

--
-- Vypisuji data pro tabulku `email_receivers`
--

INSERT INTO `email_receivers` (`id`, `nazev`, `email`, `user_id`) VALUES
(1, 'tom.barborik@dgstudio.cz / developer', 'tom.barborik@dgstudio.cz', 0),
(2, 'Dencop / marketing', 'marketing@dencop.cz', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `email_settings`
--

CREATE TABLE IF NOT EXISTS `email_settings` (
  `id` int(11) NOT NULL,
  `mailer` varchar(16) NOT NULL DEFAULT 'mail',
  `host` varchar(32) NOT NULL DEFAULT 'localhost',
  `port` int(11) NOT NULL DEFAULT '25',
  `SMTPSecure` varchar(32) DEFAULT NULL,
  `SMTPAuth` tinyint(4) NOT NULL DEFAULT '0',
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `SMTPDebug` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `email_settings`
--

INSERT INTO `email_settings` (`id`, `mailer`, `host`, `port`, `SMTPSecure`, `SMTPAuth`, `username`, `password`, `SMTPDebug`) VALUES
(1, 'smtp', 'mail.dghost.cz', 25, '', 1, 'smtp@dghost.cz', 'smtpmageror', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `email_types`
--

CREATE TABLE IF NOT EXISTS `email_types` (
`id` int(11) NOT NULL,
  `nazev` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `template` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `from_nazev` varchar(255) DEFAULT '',
  `from_email` varchar(255) DEFAULT '',
  `use_email_queue` tinyint(4) NOT NULL DEFAULT '0',
  `send_by_cron` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Vypisuji data pro tabulku `email_types`
--

INSERT INTO `email_types` (`id`, `nazev`, `code`, `template`, `subject`, `from_nazev`, `from_email`, `use_email_queue`, `send_by_cron`) VALUES
(1, 'Kontaktní formulář', 'form_contact', '', 'Kontaktní formulář z dencop.cz', '', '', 1, 0),
(2, 'Poptávkový formulář', 'form_demand', '', 'Poptávkový formulář z dencop.cz', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `email_types_receivers`
--

CREATE TABLE IF NOT EXISTS `email_types_receivers` (
`id` int(11) NOT NULL,
  `email_type_id` int(11) NOT NULL,
  `email_receiver_id` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Vypisuji data pro tabulku `email_types_receivers`
--

INSERT INTO `email_types_receivers` (`id`, `email_type_id`, `email_receiver_id`) VALUES
(3, 1, 2),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `eshop_settings`
--

CREATE TABLE IF NOT EXISTS `eshop_settings` (
  `id` int(11) NOT NULL,
  `billing_data_nazev` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_email` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_ulice` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_mesto` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_psc` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_ic` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_dic` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_telefon` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_fax` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_banka` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_iban` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_cislo_uctu` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_konst_s` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_spec_s` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `billing_data_swift` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `present_enabled` tinyint(4) NOT NULL,
  `present_price_threshold` decimal(10,0) NOT NULL,
  `billing_data_due_date` int(11) DEFAULT NULL,
  `shipping_free_threshold` decimal(6,0) DEFAULT NULL,
  `first_purchase_discount` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `eshop_settings`
--

INSERT INTO `eshop_settings` (`id`, `billing_data_nazev`, `billing_data_email`, `billing_data_ulice`, `billing_data_mesto`, `billing_data_psc`, `billing_data_ic`, `billing_data_dic`, `billing_data_telefon`, `billing_data_fax`, `billing_data_banka`, `billing_data_iban`, `billing_data_cislo_uctu`, `billing_data_konst_s`, `billing_data_spec_s`, `billing_data_swift`, `present_enabled`, `present_price_threshold`, `billing_data_due_date`, `shipping_free_threshold`, `first_purchase_discount`) VALUES
(1, 'dgstudio.cz, s.r.o.', 'info@ledmarket.cz', 'U Zimního stadionu 1095', 'Zlín', '760 01', '03127281', 'CZ03127281', '725 809 909', '', 'FIO', '', '2300618928/2010', '', '', '', 0, '400', 14, '2500', '0');

-- --------------------------------------------------------

--
-- Struktura tabulky `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
`id` bigint(20) unsigned NOT NULL,
  `available_languages` int(11) NOT NULL DEFAULT '1',
  `poradi` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Vypisuji data pro tabulku `faqs`
--

INSERT INTO `faqs` (`id`, `available_languages`, `poradi`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `faq_data`
--

CREATE TABLE IF NOT EXISTS `faq_data` (
`id` bigint(20) unsigned NOT NULL,
  `faq_id` int(11) NOT NULL,
  `language_id` tinyint(1) NOT NULL,
  `otazka` varchar(255) NOT NULL,
  `odpoved` text NOT NULL,
  `zobrazit` tinyint(1) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Vypisuji data pro tabulku `faq_data`
--

INSERT INTO `faq_data` (`id`, `faq_id`, `language_id`, `otazka`, `odpoved`, `zobrazit`) VALUES
(1, 1, 1, 'Jaké lepidla doporučujete při spojování alu-bondů?', '<p>Připravujeme...</p>\n', 1),
(2, 2, 1, 'Jaké jsou nejvhodnější frézky pro frézování hliníkových sendvičových materiálů typu bond?', '<p><span style="line-height: 20.7999992370605px;">Připravujeme...</span></p>\n', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
`id` bigint(20) unsigned NOT NULL,
  `available_languages` int(11) NOT NULL DEFAULT '1',
  `poradi` int(11) NOT NULL,
  `realizace` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Vypisuji data pro tabulku `galleries`
--

INSERT INTO `galleries` (`id`, `available_languages`, `poradi`, `realizace`) VALUES
(1, 5, 4, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `gallery_data`
--

CREATE TABLE IF NOT EXISTS `gallery_data` (
`id` bigint(20) unsigned NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `nazev` varchar(255) NOT NULL,
  `nadpis` varchar(255) DEFAULT NULL,
  `uvodni_popis` text,
  `popis` text
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `gallery_data`
--

INSERT INTO `gallery_data` (`id`, `gallery_id`, `language_id`, `route_id`, `nazev`, `nadpis`, `uvodni_popis`, `popis`) VALUES
(1, 1, 1, 7, 'Renovace obytných domů', 'Renovace obytných domů', '<p>Opláštění balkónových výplní</p>\n', '<p><span style="line-height: 20.7999992370605px;">Opláštění balkónových výplní</span></p>\n'),
(2, 1, 4, 10, 'Hejhout', 'Hejhout', NULL, NULL),
(3, 2, 1, 54, 'Prosklené fasády', 'Prosklené fasády', '<p>Systém celoskleněných stěn NOframe4&nbsp;</p>\n', '<p><span style="line-height: 20.7999992370605px;">Systém celoskleněných stěn NOframe4</span></p>\n'),
(4, 3, 1, 55, 'DENCOP SoundProtect', 'DENCOP SoundProtect', '<p><span style="line-height: 20.7999992370605px;">Protihlukové stěny z plexiskla</span></p>\n', '<p><span style="line-height: 20.7999992370605px;">Protihlukové stěny z plexiskla</span></p>\n'),
(5, 4, 1, 56, 'Odvětratelné fasády', 'Odvětratelné fasády', '<p>Opláštění budov sendvičovým materiálem typu bond (ACP - Aluminium Composite Panel)</p>\n', '<p><span style="line-height: 20.7999992370605px;">Opláštění budov sendvičovým materiálem typu bond (ACP - Aluminium Composite Panel)</span></p>\n');

-- --------------------------------------------------------

--
-- Struktura tabulky `gallery_photos`
--

CREATE TABLE IF NOT EXISTS `gallery_photos` (
`id` bigint(20) unsigned NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `photo_src` varchar(255) NOT NULL,
  `ext` varchar(255) NOT NULL,
  `poradi` int(11) NOT NULL,
  `zobrazit` tinyint(1) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Vypisuji data pro tabulku `gallery_photos`
--

INSERT INTO `gallery_photos` (`id`, `gallery_id`, `photo_src`, `ext`, `poradi`, `zobrazit`) VALUES
(46, 3, 'nbt_laermschutz-stans', 'jpg', 5, 1),
(37, 2, '1-copy-opr', 'jpg', 2, 1),
(38, 2, 'dum-praha', 'jpg', 3, 1),
(39, 2, 'dum2-praha', 'jpg', 4, 1),
(40, 2, 'oc-cerny-most-praha', 'jpg', 5, 1),
(41, 2, 'design-hotel-miura-1', 'jpg', 6, 1),
(42, 2, 'design-hotel-beskydy-cz3', 'jpg', 7, 1),
(43, 2, 'bmw-praha2', 'jpg', 8, 1),
(44, 2, 'letiste-bratislava', 'jpg', 9, 1),
(45, 2, 'cerny-most', 'jpg', 10, 1),
(47, 3, 'nbt_laermschutz-glis-carres', 'jpg', 4, 1),
(48, 3, 'bbb', 'jpg', 3, 1),
(49, 3, 'mm', 'jpg', 1, 1),
(50, 3, '148990', 'jpg', 2, 1),
(28, 1, 'malenovice01', 'jpg', 13, 1),
(29, 1, 'malenovice02', 'jpg', 14, 1),
(30, 1, 'balkony-oplasteni', 'jpg', 15, 1),
(31, 1, 'balkon-vyplne', 'jpg', 16, 1),
(32, 1, 'balkony-otrokovice', 'jpg', 17, 1),
(33, 1, 'zlin02', 'jpg', 18, 1),
(34, 1, 'zlin01', 'jpg', 19, 1),
(35, 1, 'zlin03', 'jpg', 20, 1),
(57, 4, 'aluminum-house-0902', 'jpg', 2, 1),
(58, 4, 'paneli-iz-alyuminiya-dlya-fasadov', 'jpg', 3, 1),
(56, 4, '1401570', 'jpg', 1, 1),
(59, 4, 'aafwb1vr', 'jpg', 4, 1),
(60, 4, '4', 'jpg', 5, 1),
(61, 4, '1', 'jpg', 6, 1),
(62, 4, 'lubava_debond', 'jpg', 7, 1),
(64, 4, '200-1', 'jpg', 9, 1),
(65, 4, 'facade-1', 'jpg', 10, 1),
(66, 4, 'a2', 'jpg', 11, 1),
(67, 4, 'b1', 'jpg', 12, 1),
(68, 4, 'obrazek3', 'jpg', 13, 1),
(69, 4, 'zlin', 'jpg', 14, 1),
(70, 4, 'noname', 'jpg', 15, 1),
(71, 4, 'oc-galerie-harfa-2', 'jpg', 16, 1),
(72, 4, 'dsc_3910', 'jpg', 17, 1),
(73, 4, 'img_20131227_142306', 'jpg', 18, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `gallery_photo_data`
--

CREATE TABLE IF NOT EXISTS `gallery_photo_data` (
`id` bigint(20) unsigned NOT NULL,
  `gallery_photo_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `nazev` varchar(255) NOT NULL,
  `popis` text
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Vypisuji data pro tabulku `gallery_photo_data`
--

INSERT INTO `gallery_photo_data` (`id`, `gallery_photo_id`, `language_id`, `nazev`, `popis`) VALUES
(48, 46, 0, 'nbt_laermschutz-stans', ''),
(39, 37, 0, '1 copy opr', ''),
(40, 38, 0, 'dum Praha', ''),
(41, 39, 0, 'dum2 Praha', ''),
(42, 40, 0, 'OC cerny most praha', ''),
(43, 41, 0, 'design hotel Miura 1', ''),
(44, 42, 0, 'design hotel Beskydy CZ3', ''),
(45, 43, 0, 'BMW Praha2', ''),
(46, 44, 0, 'letiste Bratislava', ''),
(47, 45, 0, 'cerny most', ''),
(49, 47, 0, 'nbt_laermschutz-glis-carres', ''),
(50, 48, 0, 'bbb', ''),
(51, 49, 0, 'mm', ''),
(52, 50, 0, '148990', ''),
(30, 28, 0, 'malenovice01', ''),
(31, 29, 0, 'malenovice02', ''),
(32, 30, 0, 'balkony oplasteni', ''),
(33, 31, 0, 'balkon vyplne', ''),
(34, 32, 0, 'balkony otrokovice', ''),
(35, 33, 0, 'zlin02', ''),
(36, 34, 0, 'zlin01', ''),
(37, 35, 0, 'zlin03', ''),
(59, 57, 0, 'Aluminum-House-0902', ''),
(60, 58, 0, 'Paneli-iz-alyuminiya-dlya-fasadov', ''),
(58, 56, 0, '1401570', ''),
(61, 59, 0, 'AaFWB1VR', ''),
(62, 60, 0, '4', ''),
(63, 61, 0, '1', ''),
(64, 62, 0, 'lubava_debond', ''),
(66, 64, 0, '200-1', ''),
(67, 65, 0, 'Facade-1', ''),
(68, 66, 0, 'A2', ''),
(69, 67, 0, 'B1', ''),
(70, 68, 0, 'Obrázek3', ''),
(71, 69, 0, 'zlin', ''),
(72, 70, 0, 'noname', ''),
(73, 71, 0, 'oc-galerie-harfa-2', ''),
(74, 72, 0, 'DSC_3910', ''),
(75, 73, 0, 'IMG_20131227_142306', '');

-- --------------------------------------------------------

--
-- Struktura tabulky `gift_boxes`
--

CREATE TABLE IF NOT EXISTS `gift_boxes` (
`id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `photo_src` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `zobrazit` tinyint(4) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `invoice_settings`
--

CREATE TABLE IF NOT EXISTS `invoice_settings` (
  `id` int(11) NOT NULL,
  `next_invoice_code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `language_strings`
--

CREATE TABLE IF NOT EXISTS `language_strings` (
`id` int(10) unsigned NOT NULL,
  `read_only` tinyint(4) NOT NULL DEFAULT '0',
  `zobrazit` tinyint(4) NOT NULL DEFAULT '0',
  `available_languages` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=18 ;

--
-- Vypisuji data pro tabulku `language_strings`
--

INSERT INTO `language_strings` (`id`, `read_only`, `zobrazit`, `available_languages`) VALUES
(1, 0, 0, 37),
(2, 0, 0, 37),
(3, 0, 0, 37),
(9, 0, 0, 37),
(5, 0, 0, 37),
(6, 0, 0, 37),
(7, 0, 0, 37),
(10, 0, 0, 37),
(11, 0, 0, 37),
(12, 0, 0, 37),
(13, 0, 0, 33),
(14, 0, 0, 33),
(15, 0, 0, 33),
(16, 0, 0, 33),
(17, 0, 0, 33);

-- --------------------------------------------------------

--
-- Struktura tabulky `language_string_data`
--

CREATE TABLE IF NOT EXISTS `language_string_data` (
`id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `language_string_id` int(11) NOT NULL,
  `string` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=44 ;

--
-- Vypisuji data pro tabulku `language_string_data`
--

INSERT INTO `language_string_data` (`id`, `language_id`, `language_string_id`, `string`) VALUES
(1, 1, 1, 'Jméno'),
(2, 4, 1, 'Name'),
(3, 32, 1, 'Name-ru'),
(4, 1, 2, 'Potvrzuji, že jsem specialista'),
(5, 4, 2, 'Confirm I am a specialist'),
(6, 32, 2, 'Подтверждаю, что я специалист'),
(7, 1, 3, 'více informací'),
(8, 4, 3, 'More information'),
(18, 1, 9, 'Zasílání novinek na můj e-mail'),
(11, 1, 5, 'noventis-se-predstavuje'),
(12, 4, 5, 'about-us'),
(13, 1, 6, 'Všechny novinky'),
(14, 4, 6, 'All news'),
(15, 1, 7, 'odeslat'),
(16, 4, 7, 'Dispatch'),
(19, 4, 9, 'Receive news on my email'),
(20, 1, 10, 'Rychlé odkazy'),
(21, 4, 10, 'Links'),
(22, 1, 11, 'Zaujaly vás informace na této stránce? Potřebujete znát více informací? Zašlete nám Váš dotaz.'),
(23, 4, 11, 'Are information interesting for you on this website? Do you need more information? Don''t hesitate to contact us'),
(24, 1, 12, 'novinky'),
(25, 4, 12, 'news'),
(26, 32, 12, 'Новости'),
(27, 32, 7, 'Отправить'),
(28, 32, 6, 'Весь новости'),
(29, 32, 3, 'Больше информацией'),
(30, 32, 9, 'Отправление новостей на мой емайл'),
(31, 32, 11, 'Интересуетесь информациями на етот сайте? Нужно Вам больше информацией? Отправте нам Ваш вопрос'),
(32, 32, 10, 'Быстрие ссылки'),
(33, 1, 13, 'Nejžádanější produkty'),
(34, 32, 13, 'Самые ходовые продукты'),
(35, 1, 14, 'Úvodní stránka'),
(36, 1, 15, 'Pro firmy'),
(37, 1, 16, 'Doplňky'),
(38, 1, 17, 'Kosmetika'),
(39, 32, 14, 'О компании'),
(40, 32, 15, 'Фирмам'),
(41, 32, 5, 'noventis-se-predstavuje'),
(42, 32, 16, 'БАДы'),
(43, 32, 17, 'косметика');

-- --------------------------------------------------------

--
-- Struktura tabulky `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
`id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci DEFAULT '',
  `photo` varchar(255) COLLATE utf8_czech_ci DEFAULT '',
  `poradi` int(11) NOT NULL,
  `available_languages` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `manufacturer_data`
--

CREATE TABLE IF NOT EXISTS `manufacturer_data` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `uvodni_popis` text COLLATE utf8_czech_ci,
  `popis` text COLLATE utf8_czech_ci,
  `zobrazit` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
`id` int(10) unsigned NOT NULL,
  `kod` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `verze` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `autor` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `popis` text COLLATE utf8_czech_ci,
  `poznamka` text COLLATE utf8_czech_ci,
  `poradi` int(11) NOT NULL DEFAULT '0',
  `admin_zobrazit` tinyint(4) NOT NULL DEFAULT '0',
  `available` tinyint(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=17 ;

--
-- Vypisuji data pro tabulku `modules`
--

INSERT INTO `modules` (`id`, `kod`, `nazev`, `verze`, `datum`, `autor`, `url`, `email`, `popis`, `poznamka`, `poradi`, `admin_zobrazit`, `available`) VALUES
(1, 'page', 'Stránky', '1', NULL, 'Pavel Herink', NULL, NULL, 'Modul zobrazující klasický statický obsah ve stránkách.', NULL, 1, 1, 1),
(2, 'link', 'Odkazy', '1', NULL, 'Pavel Herink', NULL, NULL, 'Odkaz na externí stránku.', NULL, 2, 1, 1),
(3, 'article', 'Články', '1', NULL, 'Pavel Herink', NULL, NULL, 'Modul článků a novinek.', NULL, 3, 1, 1),
(4, 'contact', 'Kontaktní formulář', '1', NULL, 'Pavel Herink', NULL, NULL, 'Modul kontaktního formuláře.', NULL, 4, 1, 1),
(5, 'photo', 'Fotogalerie', '1', NULL, 'Pavel Herink', NULL, NULL, 'Modul fotogalerie.', NULL, 5, 1, 1),
(6, 'catalog', 'Katalog', '1', NULL, 'Pavel Herink', NULL, NULL, 'Modul produktů.', NULL, 6, 1, 1),
(7, 'shoppingcart', 'Košík', '1', NULL, 'Pavel Herink', NULL, NULL, 'Modul objednávky a košíku.', NULL, 7, 0, 1),
(8, 'user', 'Zákazník', '1', NULL, 'Pavel Herink', NULL, NULL, 'Modul zákaznického účtu.', NULL, 8, 0, 1),
(9, 'order', 'Objednávka', '1', NULL, 'Pavel Herink', NULL, NULL, NULL, NULL, 9, 0, 1),
(10, 'search', 'Vyhledávání', '1', NULL, 'Pavel Herink', NULL, NULL, NULL, NULL, 10, 1, 0),
(11, 'newsletter', 'Newsletter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 0, 1),
(12, 'faq', 'Poradna', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1, 1),
(13, 'download', 'Ke stažení', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 1, 1),
(14, 'gallery', 'Galerie', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 1, 1),
(15, 'demand', 'Poptávkový formulář', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 1, 0),
(16, 'sitemap', 'Mapa stránek', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `module_actions`
--

CREATE TABLE IF NOT EXISTS `module_actions` (
`id` int(10) unsigned NOT NULL,
  `module_id` int(11) NOT NULL,
  `kod` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `nazev` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `povoleno` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `available_languages` int(11) NOT NULL DEFAULT '1',
  `zobrazit` tinyint(4) NOT NULL DEFAULT '0',
  `generovan` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `newsletter_data`
--

CREATE TABLE IF NOT EXISTS `newsletter_data` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `newsletter_id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `autor` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `popis` text COLLATE utf8_czech_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `newsletter_recipients`
--

CREATE TABLE IF NOT EXISTS `newsletter_recipients` (
`id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `allowed` tinyint(3) unsigned NOT NULL,
  `shopper_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` bigint(20) NOT NULL,
  `order_code` char(13) NOT NULL,
  `order_code_invoice` varchar(12) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `order_date_finished` date DEFAULT NULL,
  `order_delivery_date` datetime DEFAULT NULL,
  `order_date_tax` datetime DEFAULT NULL,
  `order_date_payment` datetime DEFAULT NULL,
  `order_payment_id` tinyint(4) NOT NULL DEFAULT '0',
  `order_shipping_id` tinyint(4) NOT NULL,
  `order_const_symbol` varchar(4) NOT NULL DEFAULT '0',
  `order_state_id` tinyint(4) NOT NULL DEFAULT '0',
  `order_price_no_vat` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_price_lower_vat` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_price_higher_vat` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_no_vat_rate` int(11) NOT NULL DEFAULT '0',
  `order_lower_vat_rate` int(11) NOT NULL DEFAULT '10',
  `order_higher_vat_rate` int(11) NOT NULL DEFAULT '20',
  `order_lower_vat` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_higher_vat` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_total_without_vat` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_total_with_vat` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_shipping_price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `order_payment_price` decimal(6,2) NOT NULL,
  `order_total` decimal(9,2) NOT NULL,
  `order_voucher_id` int(11) DEFAULT NULL,
  `order_voucher_discount` decimal(10,2) DEFAULT NULL,
  `order_discount` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_correction` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_total_CZK` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_weight` decimal(9,2) NOT NULL DEFAULT '0.00',
  `order_shopper_id` int(11) DEFAULT '0',
  `order_shopper_branch` int(11) DEFAULT '0',
  `order_shopper_name` varchar(255) NOT NULL,
  `order_shopper_code` char(6) DEFAULT NULL,
  `order_shopper_email` varchar(100) NOT NULL,
  `order_shopper_phone` varchar(20) NOT NULL,
  `order_shopper_ic` varchar(64) DEFAULT NULL,
  `order_shopper_dic` varchar(20) DEFAULT NULL,
  `order_shopper_street` varchar(50) DEFAULT NULL,
  `order_shopper_city` varchar(50) DEFAULT NULL,
  `order_shopper_zip` varchar(10) DEFAULT NULL,
  `order_shopper_note` text NOT NULL,
  `order_branch_name` varchar(255) DEFAULT NULL,
  `order_branch_code` char(6) DEFAULT NULL,
  `order_branch_street` varchar(50) DEFAULT NULL,
  `order_branch_city` varchar(50) DEFAULT NULL,
  `order_branch_zip` varchar(50) DEFAULT NULL,
  `order_branch_phone` varchar(20) DEFAULT NULL,
  `order_branch_email` varchar(100) DEFAULT NULL,
  `export` tinyint(4) NOT NULL DEFAULT '0',
  `last_modified` datetime NOT NULL,
  `order_shopper_custommer_code` varchar(255) DEFAULT NULL,
  `post_track_trace_code` varchar(255) DEFAULT NULL,
  `is_payu` tinyint(4) NOT NULL DEFAULT '0',
  `payu_session_code` varchar(255) DEFAULT NULL,
  `payu_status_code` varchar(255) DEFAULT NULL,
  `payu_status_message` varchar(255) DEFAULT NULL,
  `payu_error_message` varchar(255) DEFAULT NULL,
  `gift_box_code` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
`id` bigint(20) NOT NULL,
  `code` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `varianta_popis` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `varianta_id` int(11) NOT NULL,
  `jednotka` char(2) COLLATE utf8_czech_ci NOT NULL,
  `hmotnost` decimal(5,2) NOT NULL,
  `pocet_na_sklade` decimal(6,2) NOT NULL,
  `min_order_quantity` decimal(3,2) DEFAULT NULL,
  `tax_code` varchar(25) CHARACTER SET utf8 NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `units` decimal(6,2) NOT NULL,
  `price_without_tax` decimal(10,2) NOT NULL,
  `price_with_tax` decimal(10,2) NOT NULL,
  `total_price_with_tax` decimal(10,2) NOT NULL,
  `item_change` tinyint(4) DEFAULT '0',
  `total_weight` decimal(6,2) NOT NULL DEFAULT '0.00',
  `gift` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_item_changes`
--

CREATE TABLE IF NOT EXISTS `order_item_changes` (
`id` bigint(20) NOT NULL,
  `change_order` bigint(20) NOT NULL,
  `change_item` bigint(20) NOT NULL DEFAULT '0',
  `change_date` datetime DEFAULT NULL,
  `change_units_from` decimal(6,2) NOT NULL DEFAULT '0.00',
  `change_units_to` decimal(6,2) NOT NULL DEFAULT '0.00',
  `change_type` varchar(10) NOT NULL DEFAULT 'internal',
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_states`
--

CREATE TABLE IF NOT EXISTS `order_states` (
`id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `order_state_type_id` int(11) NOT NULL,
  `send_mail` tinyint(4) NOT NULL DEFAULT '0',
  `readonly` tinyint(4) NOT NULL DEFAULT '0',
  `poradi` tinyint(4) NOT NULL,
  `smazano` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_state_data`
--

CREATE TABLE IF NOT EXISTS `order_state_data` (
`id` int(11) NOT NULL,
  `order_state_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email_text` text COLLATE utf8_czech_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_state_types`
--

CREATE TABLE IF NOT EXISTS `order_state_types` (
`id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `poradi` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `owner_data`
--

CREATE TABLE IF NOT EXISTS `owner_data` (
`id` int(11) NOT NULL,
  `default_title` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `default_description` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `default_keywords` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `firma` varchar(128) COLLATE utf8_czech_ci DEFAULT NULL,
  `ulice` varchar(128) COLLATE utf8_czech_ci DEFAULT NULL,
  `mesto` varchar(128) COLLATE utf8_czech_ci DEFAULT NULL,
  `psc` varchar(16) COLLATE utf8_czech_ci DEFAULT NULL,
  `stat` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `copyright` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `ic` varchar(16) COLLATE utf8_czech_ci DEFAULT NULL,
  `dic` varchar(16) COLLATE utf8_czech_ci DEFAULT NULL,
  `tel` varchar(16) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_czech_ci DEFAULT NULL,
  `www` varchar(128) COLLATE utf8_czech_ci DEFAULT NULL,
  `ga_script` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `owner_data`
--

INSERT INTO `owner_data` (`id`, `default_title`, `default_description`, `default_keywords`, `firma`, `ulice`, `mesto`, `psc`, `stat`, `copyright`, `ic`, `dic`, `tel`, `email`, `www`, `ga_script`) VALUES
(1, 'Orbcomm', '', '', '', '', '', '', NULL, '2014', NULL, NULL, '', 'tom.barborik@dgstudio.cz', NULL, '');

-- --------------------------------------------------------

--
-- Struktura tabulky `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) unsigned NOT NULL,
  `page_category_id` int(11) NOT NULL,
  `poradi` int(10) unsigned NOT NULL,
  `parent_id` int(11) NOT NULL,
  `indexpage` tinyint(4) NOT NULL,
  `new_window` tinyint(4) NOT NULL DEFAULT '0',
  `show_in_menu` tinyint(4) DEFAULT '1',
  `direct_to_sublink` tinyint(4) NOT NULL DEFAULT '0',
  `show_in_submenu` tinyint(4) NOT NULL DEFAULT '0',
  `available_languages` int(11) NOT NULL DEFAULT '1',
  `nav_class` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `show_contactform` tinyint(4) NOT NULL DEFAULT '0',
  `show_child_pages_index` tinyint(4) NOT NULL DEFAULT '0',
  `protected` tinyint(4) NOT NULL DEFAULT '0',
  `photo_src` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `show_photo_detail` tinyint(4) NOT NULL DEFAULT '0',
  `show_visitform` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=16 ;

--
-- Vypisuji data pro tabulku `pages`
--

INSERT INTO `pages` (`id`, `page_category_id`, `poradi`, `parent_id`, `indexpage`, `new_window`, `show_in_menu`, `direct_to_sublink`, `show_in_submenu`, `available_languages`, `nav_class`, `show_contactform`, `show_child_pages_index`, `protected`, `photo_src`, `show_photo_detail`, `show_visitform`) VALUES
(1, 3, 1, 0, 0, 0, 1, 0, 0, 5, '', 0, 1, 0, 'index', 0, 0),
(2, 3, 5, 0, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, 'o-nas', 0, 0),
(3, 3, 14, 0, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, NULL, 0, 0),
(4, 3, 2, 0, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, NULL, 0, 0),
(5, 3, 4, 0, 0, 0, 1, 0, 0, 5, '', 0, 0, 0, NULL, 0, 0),
(6, 3, 11, 0, 0, 0, 1, 0, 0, 5, '', 0, 0, 0, NULL, 0, 0),
(7, 3, 3, 0, 0, 0, 1, 0, 0, 5, '', 0, 0, 0, NULL, 0, 0),
(8, 2, 6, 0, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, NULL, 0, 0),
(9, 3, 1, 2, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, NULL, 0, 0),
(10, 2, 7, 0, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, NULL, 0, 0),
(11, 2, 8, 0, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, NULL, 0, 0),
(12, 2, 9, 0, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, NULL, 0, 0),
(13, 3, 10, 0, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, NULL, 0, 0),
(14, 3, 12, 0, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, NULL, 0, 0),
(15, 3, 13, 0, 0, 0, 1, 0, 0, 1, '', 0, 0, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `page_categories`
--

CREATE TABLE IF NOT EXISTS `page_categories` (
`id` int(10) unsigned NOT NULL,
  `code` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `nazev` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `poradi` int(10) unsigned NOT NULL,
  `admin_zobrazit` tinyint(3) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `page_categories`
--

INSERT INTO `page_categories` (`id`, `code`, `nazev`, `poradi`, `admin_zobrazit`) VALUES
(1, 'system', 'Systémové stránky', 1, 1),
(2, 'unrelated', 'Nezařazené stránky', 2, 1),
(3, 'nav', 'Stránky v hlavní navigaci', 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `page_data`
--

CREATE TABLE IF NOT EXISTS `page_data` (
`id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `nadpis` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `uvodni_popis` text COLLATE utf8_czech_ci,
  `popis` text COLLATE utf8_czech_ci,
  `url` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `akce_text` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=20 ;

--
-- Vypisuji data pro tabulku `page_data`
--

INSERT INTO `page_data` (`id`, `page_id`, `language_id`, `route_id`, `nazev`, `nadpis`, `uvodni_popis`, `popis`, `url`, `akce_text`) VALUES
(1, 1, 1, 1, 'Home', 'Úvodní strana', '', '<p>Nunc vitae enim ac elit mollis placerat. Vivamus a efficitur odio. Ut maximus imperdiet risus, tristique mollis velit. Vestibulum mattis metus ut diam egestas mattis.&nbsp;</p>\n\n<ul>\n	<li>Lorem</li>\n	<li>Maecenas</li>\n	<li>Aliquam</li>\n</ul>\n', '', ''),
(2, 2, 1, 2, 'Kdo jsme', 'O nás', '', '<p style="margin-top: 0px; margin-bottom: 20px; color: rgb(64, 64, 64); font-family: ''Open Sans'', sans-serif; font-size: 12.222222328186px; line-height: normal; background-color: rgba(238, 240, 245, 0.611765);">PROFIL SPOLEČNOSTI</p>\n\n<p style="margin-top: 0px; margin-bottom: 20px; color: rgb(64, 64, 64); font-family: ''Open Sans'', sans-serif; font-size: 12.222222328186px; line-height: normal; background-color: rgba(238, 240, 245, 0.611765);">Naše společnosti DENCOP s.r.o. patří</p>\n\n<p style="margin-top: 0px; margin-bottom: 20px; color: rgb(64, 64, 64); font-family: ''Open Sans'', sans-serif; font-size: 12.222222328186px; line-height: normal; text-align: justify; background-color: rgba(238, 240, 245, 0.611765);">Disponujeme bezkonkurenčně nejširší nabídkou produktů na trhu a náš sortiment dále průběžně doplňujeme o modernější a výkonnější technologie jako jsou např. napěťové zdroje&nbsp;<strong>MEAN WELL</strong>, LED reflektory, světelné LED klap rámy pro prezentaci tiskovin ve formátech od A3 až A0, apod. Značnou část komponentů dovážíme od nejvýznamnějších světových výrobců. Rozvíjíme aktivity v rámci působení na zahraničních trzích, kde čerpáme informace o nových trendech. Účastníme se jako návštěvníci i vystavovatelé mezinárodních výstav v ČR i v zahraničí. Na základě poptávky našich zákazníků vznikají nové produkty&nbsp; na jejichž&nbsp; vývoji se aktivně podílíme. Pro řadu z nich vlastníme průmyslové vzory a kvalitu výroby dozorujeme přímo u výrobce.</p>\n\n<p style="margin-top: 0px; margin-bottom: 20px; color: rgb(64, 64, 64); font-family: ''Open Sans'', sans-serif; font-size: 12.222222328186px; line-height: normal; text-align: justify; background-color: rgba(238, 240, 245, 0.611765);">NÁŠ CÍL</p>\n\n<p style="margin-top: 0px; margin-bottom: 20px; color: rgb(64, 64, 64); font-family: ''Open Sans'', sans-serif; font-size: 12.222222328186px; line-height: normal; text-align: justify; background-color: rgba(238, 240, 245, 0.611765);">Jsme obchodní společnost a je pro nás samozřejmostí poskytovat našim zákazníkům kromě širokého sortimentu produktů také technické poradenství. V našem týmu máme zkušené kolegy, kteří se materiálům pro signmaking a LED technologiím věnují a pracují s nimi dlouhodobě. Jsou schopni Vám navrhnout řešení na míru včetně doporučení efektního výsledku i rychlé instalace.</p>\n\n<p style="margin-top: 0px; margin-bottom: 20px; color: rgb(64, 64, 64); font-family: ''Open Sans'', sans-serif; font-size: 12.222222328186px; line-height: normal; text-align: justify; background-color: rgba(238, 240, 245, 0.611765);">NAŠI LIDÉ</p>\n', '', ''),
(10, 1, 4, 40, 'Homepage', 'Homepage', '', NULL, '', ''),
(11, 6, 4, 41, 'Material and Services', 'Material and Services', '', NULL, '', ''),
(12, 8, 1, 42, 'Aktuální novinky', 'Aktuální novinky', '', NULL, '', ''),
(13, 9, 1, 49, 'Rozvozový plán', 'Rozvozový plán', '', '<div class="category-info">\n    		<script type="text/javascript">\n    $(document).ready(function(){\n        \n        function preload(images) {\n            if (document.images) {\n                var i = 0;\n                var imageArray = new Array();\n                imageArray = images.split('','');\n                var imageObj = new Image();\n                for(i=0; i<=imageArray.length-1; i++) {\n                    imageObj.src=images[i];\n                }\n            }\n        }\n\n        preload(''http://www.dencop.cz/image/data/inforadce/rozvoz/1.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/2.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/3.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/4.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/5.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/6.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/7.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/8.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/9.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/10.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/11.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/12.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/13.gif,http://www.dencop.cz/image/data/inforadce/rozvoz/14.gif'');\n\n\n        $(".polymap")\n                .click(function(e){\n                    e.preventDefault();\n                })\n                .hover(function(){\n                    var polyId = $(this).data("poly");\n\n                    $("#mapa").attr(''src'', ''http://www.dencop.cz/image/data/inforadce/rozvoz/''+polyId+''.gif'');\n                    $("#rozvozinfo"+polyId).show();\n                })\n                .mouseleave(function(){\n                    $("#mapa").attr(''src'', ''http://www.dencop.cz/image/data/inforadce/rozvoz/mapa_cr.gif'');\n                    $(".rozvozinfo").hide();\n                });\n    });\n</script>\n<style type="text/css">.rozvozinfo {display: none;}\n    .mapWrap {height: 600px}\n</style>\n<p><map id="mapa_cr_rozvozcesty_Map" name="mapa_cr_rozvozcesty_Map"><area alt="polymap14" class="polymap" coords="329,67, 330,72, 332,74, 331,76, 329,77, 323,80, 324,83, 332,88, 333,92, 341,97, 347,91, 347,90, 352,90, 353,94, 356,96, 362,97, 365,101, 367,100, 374,101, 376,102, 382,103, 382,112, 386,118, 393,122, 396,124, 398,135, 397,138, 381,139, 380,141, 379,145, 375,148, 371,147, 365,140, 357,139, 356,138, 354,139, 346,138, 344,137, 342,134, 341,134, 337,129, 334,127, 332,124, 330,123, 329,120, 324,118, 313,117, 309,114, 306,113, 304,112, 302,111, 298,107, 299,102, 300,101, 298,96, 301,88, 304,80, 313,74, 313,71, 324,70" data-poly="14" href="#polymap14" id="polymap14" shape="poly"> <area alt="polymap13" class="polymap" coords="366,142, 374,149, 373,153, 368,157, 361,160, 358,164, 357,170, 356,172, 355,180, 352,183, 346,184, 343,188, 342,193, 337,194, 334,199, 328,198, 326,195, 323,194, 321,191, 314,190, 312,189, 311,189, 310,186, 305,185, 304,183, 303,180, 302,179, 300,180, 297,180, 298,177, 302,174, 299,170, 298,166, 301,162, 303,161, 307,160, 310,156, 310,151, 313,152, 318,154, 322,151, 326,150, 328,147, 328,146, 332,147, 333,148, 336,144, 337,141, 348,139, 354,140, 361,141, 363,142" data-poly="13" href="#polymap13" id="polymap13" shape="poly"> <area alt="polymap12" class="polymap" coords="288,58, 290,59, 299,63, 303,66, 308,68, 310,71, 312,72, 311,75, 301,83, 300,89, 299,93, 297,98, 298,100, 297,108, 300,110, 301,110, 303,113, 307,114, 309,115, 312,116, 313,118, 317,119, 329,120, 330,125, 333,125, 336,130, 339,131, 340,134, 342,136, 343,138, 342,139, 338,140, 335,144, 334,146, 331,145, 330,144, 327,146, 326,150, 321,151, 318,153, 310,151, 309,153, 308,159, 299,160, 296,156, 293,156, 292,151, 289,147, 285,142, 282,143, 283,150, 281,152, 277,146, 279,140, 276,138, 275,138, 276,134, 280,123, 278,121, 277,119, 274,111, 275,107, 273,98, 274,96, 278,93, 277,91, 278,85, 281,79, 282,77, 284,76, 288,75, 289,73, 285,68, 284,68, 283,64, 279,59, 280,57" data-poly="12" href="#polymap12" id="polymap12" shape="poly"> <area alt="polymap11" class="polymap" coords="274,133, 275,139, 277,140, 276,145, 278,148, 279,153, 282,153, 285,149, 282,145, 283,143, 287,144, 288,146, 289,149, 292,153, 293,157, 295,158, 298,159, 299,172, 301,174, 297,180, 299,182, 301,181, 303,182, 304,185, 309,187, 310,187, 311,190, 316,191, 318,192, 322,193, 329,199, 329,202, 325,203, 320,202, 319,201, 316,203, 311,202, 305,199, 301,200, 297,204, 296,208, 292,213, 290,220, 289,221, 287,220, 285,215, 281,214, 275,213, 273,212, 271,211, 270,209, 260,206, 257,208, 252,213, 246,212, 242,211, 232,210, 226,205, 219,201, 215,202, 210,201, 206,198, 204,197, 205,195, 213,194, 226,186, 239,185, 246,178, 245,176, 245,173, 247,172, 245,169, 246,163, 247,160, 253,156, 253,147, 254,142, 255,141, 253,138, 254,136, 260,135, 264,132" data-poly="11" href="#polymap11" id="polymap11" shape="poly"> <area alt="polymap10" class="polymap" coords="279,79, 278,85, 277,87, 276,91, 277,93, 274,96, 272,97, 273,104, 274,106, 275,115, 276,119, 279,125, 278,129, 276,132, 275,133, 270,131, 263,132, 260,134, 251,134, 239,127, 237,126, 230,122, 227,124, 226,126, 221,124, 220,121, 214,118, 208,115, 203,114, 201,112, 200,100, 198,99, 197,97, 192,95, 193,92, 196,90, 202,87, 204,86, 210,87, 215,83, 217,84, 218,86, 221,85, 226,83, 229,84, 230,88, 232,89, 237,92, 240,94, 249,93, 250,89, 254,86, 257,85, 259,84, 268,87, 270,88, 276,81, 277,79" data-poly="10" href="#polymap10" id="polymap10" shape="poly"> <area alt="polymap9" class="polymap" coords="201,113, 207,116, 212,117, 221,125, 226,127, 228,125, 229,123, 235,126, 237,127, 244,130, 248,133, 252,136, 253,142, 252,144, 252,153, 251,157, 245,162, 244,174, 245,179, 238,185, 234,186, 230,185, 224,186, 212,193, 206,194, 203,193, 201,190, 202,185, 204,184, 206,182, 202,177, 192,176, 191,171, 188,169, 178,169, 175,165, 171,164, 167,163, 166,159, 167,136, 169,135, 183,134, 185,130, 181,126, 182,123, 185,121, 195,116, 198,112" data-poly="9" href="#polymap9" id="polymap9" shape="poly"> <area alt="polymap8" class="polymap" coords="159,135, 162,137, 165,143, 165,158, 166,162, 170,165, 172,164, 177,168, 179,171, 181,170, 190,170, 191,175, 195,178, 204,179, 205,181, 204,183, 201,185, 200,189, 199,190, 203,195, 202,197, 194,192, 190,191, 187,192, 185,193, 181,194, 179,193, 178,190, 170,188, 168,193, 167,211, 159,210, 158,212, 153,220, 152,227, 148,226, 146,225, 140,224, 138,223, 136,224, 130,230, 119,226, 113,225, 112,223, 111,219, 99,210, 98,210, 97,207, 93,200, 90,199, 88,196, 84,191, 83,191, 83,186, 86,183, 87,176, 90,175, 93,171, 94,161, 96,159, 97,155, 96,151, 97,143, 109,142, 112,140, 122,141, 125,139, 129,140, 131,141, 137,140, 141,141, 147,142, 149,143, 154,138, 153,136, 154,134" data-poly="8" href="#polymap8" id="polymap8" shape="poly"> <area alt="polymap7" class="polymap" coords="206,28, 212,31, 218,30, 219,34, 223,37, 225,36, 228,37, 229,42, 234,38, 240,39, 242,38, 250,39, 253,43, 251,50, 248,51, 240,58, 244,63, 249,63, 250,67, 255,69, 256,72, 261,76, 261,83, 256,84, 252,87, 248,90, 248,93, 237,92, 231,87, 230,87, 229,84, 226,82, 223,83, 218,85, 217,82, 216,81, 212,84, 211,85, 202,86, 198,89, 195,88, 194,85, 192,83, 193,77, 190,71, 186,72, 184,71, 179,65, 177,64, 179,59, 179,52, 186,51, 191,52, 193,55, 196,54, 197,52, 198,50, 205,50, 207,49, 204,45, 204,27" data-poly="7" href="#polymap7" id="polymap7" shape="poly"> <area alt="polymap6" class="polymap" coords="135,105, 139,101, 144,98, 149,98, 151,93, 154,93, 149,88, 141,80, 135,85, 132,85, 127,88, 125,90, 126,93, 130,100, 131,105" data-poly="6" href="#polymap6" id="polymap6" shape="poly"> <area alt="polymap5" class="polymap" coords="126,138, 122,141, 116,141, 115,138, 109,141, 97,141, 96,133, 93,128, 95,125, 100,122, 100,113, 102,107, 100,103, 91,98, 87,97, 84,94, 77,94, 77,90, 82,86, 83,82, 89,80, 97,78, 107,74, 110,72, 111,68, 113,67, 123,69, 135,66, 135,61, 140,56, 140,53, 146,53, 147,56, 149,56, 156,52, 157,49, 160,49, 166,43, 174,47, 177,51, 178,61, 176,64, 178,65, 180,67, 184,73, 188,74, 191,72, 192,80, 191,84, 194,88, 193,91, 192,93, 201,103, 199,111, 197,112, 195,117, 187,119, 184,120, 180,125, 180,128, 184,131, 183,134, 176,135, 170,134, 167,136, 165,141, 161,135, 155,132, 152,135, 151,141, 149,143, 145,141, 135,139, 131,141" data-poly="5" href="#polymap5" id="polymap5" shape="poly"> <area alt="polymap4" class="polymap" coords="33,105, 34,105, 35,105, 36,105, 38,103, 46,105, 49,105, 52,100, 58,95, 64,97, 67,95, 72,88, 75,91, 77,95, 82,95, 86,99, 90,99, 100,105, 100,110, 98,111, 98,122, 92,125, 94,133, 96,154, 97,156, 94,161, 92,173, 86,176, 85,180, 85,185, 82,186, 80,194, 75,190, 75,185, 68,177, 63,177, 54,163, 54,161, 49,156, 41,156, 31,146, 31,138, 27,137, 27,132, 24,129, 23,124, 17,119, 21,116, 22,111, 24,107, 27,106, 31,105, 32,105" data-poly="4" href="#polymap4" id="polymap4" shape="poly"> <area alt="polymap3" class="polymap" coords="148,54, 147,54, 147,54, 149,54, 156,50, 156,47, 161,47, 165,42, 173,45, 183,52, 186,50, 195,56, 197,52, 197,49, 199,49, 203,51, 206,49, 203,45, 202,28, 197,25, 194,28, 192,26, 192,23, 186,16, 186,14, 186,10, 183,7, 179,7, 173,5, 169,7, 172,10, 170,20, 161,20, 158,24, 149,21, 146,25, 141,25, 138,28, 135,34, 135,42, 136,45, 141,52, 146,52, 147,54, 149,54" data-poly="3" href="#polymap3" id="polymap3" shape="poly"> <area alt="polymap2" class="polymap" coords="57,51, 66,51, 68,44, 69,44, 72,46, 74,44, 75,40, 76,39, 81,43, 85,39, 86,33, 91,33, 92,32, 94,33, 99,31, 105,32, 108,29, 108,26, 111,24, 115,25, 120,22, 125,22, 127,19, 130,18, 133,18, 135,17, 136,13, 132,10, 131,8, 128,7, 131,2, 136,5, 142,3, 146,8, 146,12, 145,15, 149,14, 148,20, 145,24, 140,24, 138,26, 135,32, 133,38, 134,45, 139,52, 138,56, 134,60, 132,65, 124,67, 115,67, 114,65, 110,67, 110,71, 103,74, 100,75, 97,77, 92,77, 88,79, 85,79, 82,82, 80,86, 76,88, 72,88, 70,87, 67,85, 70,82, 69,80, 67,76, 66,69, 69,66, 61,63, 54,61, 52,59, 55,55" data-poly="2" href="#polymap1" id="polymap2" shape="poly"> <area alt="polymap1" class="polymap" coords="3,66, 5,66, 6,70, 8,71, 9,72, 10,79, 13,81, 14,75, 18,71, 18,68, 26,61, 27,59, 34,59, 36,61, 41,57, 44,56, 51,61, 58,63, 62,65, 66,66, 65,68, 66,75, 68,80, 68,83, 66,85, 70,89, 64,96, 61,94, 58,94, 51,99, 49,103, 46,103, 40,102, 38,101, 34,105, 31,104, 30,103, 27,105, 25,104, 23,101, 22,97, 13,92, 8,88, 6,85, 6,78, 2,74, 2,69, 2,66" data-poly="1" href="#polymap1" id="polymap1" shape="poly"></map></p>\n\n<div class="mapWrap"><img alt="Mapa" height="232" id="mapa" src="http://www.dencop.cz/image/data/inforadce/rozvoz/mapa_cr.gif" usemap="#mapa_cr_rozvozcesty_Map" width="400">\n<div class="rozvozinfo" id="rozvozinfo1" style="display: none;">\n<h3>Karlovarský kraj</h3>\n\n<div>Po -<br>\nÚt -<br>\nSt -<br>\nČt -<br>\nPá - <span>Zaváží sklad Praha dle dohody<br>\n1x za měsíc</span></div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo2" style="display: none;">\n<h3>Ústecký kraj</h3>\n\n<div>Po -<br>\nÚt -<br>\nSt -<br>\nČt -<br>\nPá - <span>Zaváží sklad Praha dle dohody<br>\n1x za měsíc</span></div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo3" style="display: none;">\n<h3>Liberecký kraj</h3>\n\n<div>Po -<br>\nÚt -<br>\nSt -<br>\nČt -<br>\nPá - <span>Zaváží sklad Praha dle dohody<br>\n1x za měsíc</span></div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo4" style="display: none;">\n<h3>Plzeňský kraj</h3>\n\n<div>Po -<br>\nÚt -<br>\nSt -<br>\nČt -<br>\nPá - <span>Zaváží sklad Praha<br>\ndle poptávky 1x za týden</span></div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo5" style="display: none;">\n<h3>Středočeský kraj</h3>\n\n<div>Po -<br>\nÚt -<br>\nSt -<br>\nČt -<br>\nPá - <span>Zaváží sklad Praha dle dohody</span></div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo6" style="display: none;">\n<h3>Praha</h3>\n\n<div>Po - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nÚt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nSt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nČt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nPá - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"></div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo7" style="display: none;">\n<h3>Královéhradecký kraj</h3>\n\n<div>Po -<br>\nÚt -<br>\nSt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nČt -<br>\nPá -</div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo8" style="display: none;">\n<h3>Jihočeský kraj</h3>\n\n<div>Po -<br>\nÚt -<br>\nSt -<br>\nČt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nPá -</div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo9" style="display: none;">\n<h3>Vysočina</h3>\n\n<div>Po -<br>\nÚt -<br>\nSt -<br>\nČt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nPá -</div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo10" style="display: none;">\n<h3>Pardubický kraj</h3>\n\n<div>Po -<br>\nÚt -<br>\nSt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nČt -<br>\nPá -</div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo11" style="display: none;">\n<h3>Jihomoravský kraj</h3>\n\n<div>Po - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nÚt -<br>\nSt -<br>\nČt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nPá -<span>Rozvozové dny platí pro region Brno a blízké okolí, zbytek dle dohody.</span></div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo12" style="display: none;">\n<h3>Olomoucký kraj</h3>\n\n<div>Po -<br>\nÚt -<br>\nSt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nČt -<br>\nPá -</div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo13" style="display: none;">\n<h3>Zlínský kraj</h3>\n\n<div>Po -<br>\nÚt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nSt -<br>\nČt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nPá -&nbsp;</div>\n\n<div><span style="color: rgb(0, 0, 128);">Možnost individuální dohody rozvozu dle konkrétních objednávek i v jiné dny než rozvozové.</span></div>\n\n<div>&nbsp;</div>\n</div>\n\n<div class="rozvozinfo" id="rozvozinfo14" style="display: none;">\n<h3>Moravskoslezský kraj</h3>\n\n<div>Po -<br>\nÚt - <img alt="" border="0" src="http://www.dencop.cz/image/data/inforadce/rozvoz/ok.gif"><br>\nSt -<br>\nČt -<br>\nPá -</div>\n\n<div>&nbsp;</div>\n\n<div>&nbsp;</div>\n</div>\n</div>\n  </div>', '', ''),
(3, 3, 1, 3, 'Kontakt', 'Kontaktní údaje', '', '<p>DENCOP s.r.o.<br />\n<span style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 18px;">Tečovská 29<br />\nZlín - Malenovice<br />\n76302<br />\n<br />\nIČO:&nbsp;</span><span style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 18px; white-space: nowrap;">469</span><span style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 18px; white-space: nowrap;">90101<br />\nDIČ: CZ469</span><span style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 18px; white-space: nowrap;">90101<br />\nSpisová značka C 8410 vedená u Krajského soudu v Brně</span></p>\n\n<p>&nbsp;</p>\n\n<p><span style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 18px; white-space: nowrap;">Tel: +420 577 158 744, 577 104 509<br />\nMobil: +420 737 259 819<br />\nE-mail: stavebnictvi@dencop.cz</span><br />\n<br />\n&nbsp;</p>\n\n<p>&nbsp;</p>\n', '', ''),
(4, 4, 1, 4, 'Poradna', 'Poradna', '', '<p>Jako dodavatelé jsme schopni zákazníkovi&nbsp;poskytnout nejen<strong> záruky a certifikace ale také vlastní know-how</strong> o zpracování a využití materiálů ve stavebnictví.&nbsp;V areálu centrálního skladu ve Zlíně-Malenovicích Vám můžeme nabídnout:</p>\n\n<p><span style="line-height: 1.6;">&bull; <strong>řezání a formátování&nbsp;</strong></span><span style="line-height: 20.7999992370605px;">deskových materiálů,&nbsp;</span><span style="line-height: 1.6;">hliníkových a plastových profilů</span><br />\n<span style="line-height: 20.7999992370605px;">&bull;&nbsp;</span><span style="line-height: 1.6;"><strong>frézování fasádních</strong> bondových kazet na CNC&nbsp;</span><span style="line-height: 20.7999992370605px;">frézce AXYZ 6014</span><br />\n<span style="line-height: 20.7999992370605px;">&bull;&nbsp;</span><span style="line-height: 1.6;"><strong>rozvoz</strong> zboží vlastní dopravou nebo smluvními dopravci</span></p>\n', '', ''),
(5, 5, 1, 5, 'Ke stažení', 'Ke stažení', '', NULL, '', ''),
(6, 6, 1, 6, 'Naše produkty', 'Materiály a služby', '', '<p>adsasdasd</p>\n', '', ''),
(7, 7, 1, 8, 'Ukázky realizací', 'Ukázky realizací', '', NULL, '', ''),
(8, 7, 4, 9, 'Realizations', 'Realizations', '', NULL, '', ''),
(9, 5, 4, 13, 'Ke stažení', 'Ke stažení', '', NULL, '', ''),
(14, 10, 1, 50, 'Poptávkový formulář', 'Poptávkový formulář', '', NULL, '', ''),
(15, 11, 1, 51, 'Mapa stránek', 'Mapa stránek', '', NULL, '', ''),
(16, 12, 1, 52, 'Vyhledávání', 'Vyhledávání', '', NULL, '', ''),
(17, 13, 1, 58, 'Co děláme', 'Co děláme', '', NULL, '', ''),
(18, 14, 1, 59, 'Výhody spolupráce s námi', 'Výhody spolupráce s námi', '', NULL, '', ''),
(19, 15, 1, 60, 'Reference', 'Reference', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Struktura tabulky `page_photos`
--

CREATE TABLE IF NOT EXISTS `page_photos` (
`id` int(11) NOT NULL,
  `poradi` int(11) NOT NULL,
  `zobrazit` tinyint(4) NOT NULL DEFAULT '1',
  `photo_src` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `ext` char(4) COLLATE utf8_czech_ci NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `page_photo_data`
--

CREATE TABLE IF NOT EXISTS `page_photo_data` (
`id` int(11) NOT NULL,
  `page_photo_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
`id` int(11) NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  `typ` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `poradi` int(11) NOT NULL,
  `predem` tinyint(4) NOT NULL DEFAULT '0',
  `payu` tinyint(4) NOT NULL DEFAULT '0',
  `icon` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=8 ;

--
-- Vypisuji data pro tabulku `payments`
--

INSERT INTO `payments` (`id`, `cena`, `typ`, `poradi`, `predem`, `payu`, `icon`) VALUES
(3, '-10.00', '1', 2, 1, 0, 'ico_prevod'),
(4, '0.00', '1', 7, 1, 0, 'ico_hotove'),
(5, '0.00', '1', 3, 0, 1, 'ico_payu'),
(6, '30.00', '1', 5, 0, 0, 'ico_dobirka'),
(7, '60.00', '1', 6, 0, 0, 'ico_dobirka');

-- --------------------------------------------------------

--
-- Struktura tabulky `payments_shippings`
--

CREATE TABLE IF NOT EXISTS `payments_shippings` (
`id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=35 ;

--
-- Vypisuji data pro tabulku `payments_shippings`
--

INSERT INTO `payments_shippings` (`id`, `shipping_id`, `payment_id`) VALUES
(23, 3, 7),
(2, 2, 2),
(21, 2, 3),
(4, 2, 1),
(24, 6, 3),
(8, 3, 1),
(20, 1, 6),
(12, 6, 4),
(29, 6, 5),
(30, 2, 6),
(25, 3, 3),
(19, 1, 3),
(31, 7, 3),
(32, 7, 6),
(33, 8, 3),
(34, 8, 7);

-- --------------------------------------------------------

--
-- Struktura tabulky `payment_data`
--

CREATE TABLE IF NOT EXISTS `payment_data` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `zobrazit` tinyint(4) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=8 ;

--
-- Vypisuji data pro tabulku `payment_data`
--

INSERT INTO `payment_data` (`id`, `language_id`, `payment_id`, `nazev`, `popis`, `zobrazit`) VALUES
(3, 1, 3, 'Platba předem', '', 1),
(4, 1, 4, 'Hotově při převzetí', '', 1),
(5, 1, 5, 'Platba kartou nebo rychlým on-line bankovním převodem', '', 0),
(6, 1, 6, 'Dobírka', '', 1),
(7, 1, 7, 'Dobírka', '', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `price_categories`
--

CREATE TABLE IF NOT EXISTS `price_categories` (
`id` int(11) NOT NULL,
  `kod` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `price_type_id` int(11) NOT NULL,
  `hodnota` tinyint(4) NOT NULL COMMENT 'pripadna procentni hodnota',
  `zaradit_zakaznika_od` decimal(8,0) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=5 ;

--
-- Vypisuji data pro tabulku `price_categories`
--

INSERT INTO `price_categories` (`id`, `kod`, `popis`, `price_type_id`, `hodnota`, `zaradit_zakaznika_od`) VALUES
(1, 'D0', 'výchozí cenová skupina', 1, 0, NULL),
(2, 'sleva-3-procenta', 'sleva-3-procenta', 3, 3, '2500'),
(3, 'sleva-5-procent', 'sleva-5-procent', 3, 5, '5000'),
(4, 'sleva-6-procent', 'sleva-6-procent', 3, 6, '10000');

-- --------------------------------------------------------

--
-- Struktura tabulky `price_categories_products`
--

CREATE TABLE IF NOT EXISTS `price_categories_products` (
`id` int(11) NOT NULL,
  `price_category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cena` decimal(12,2) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=289 ;

--
-- Vypisuji data pro tabulku `price_categories_products`
--

INSERT INTO `price_categories_products` (`id`, `price_category_id`, `product_id`, `cena`) VALUES
(1, 1, 1, '83.00'),
(2, 1, 2, '82.68'),
(3, 1, 3, '0.00'),
(4, 1, 4, '152.00'),
(5, 1, 5, '60.00'),
(6, 1, 6, '82.68'),
(7, 1, 7, '59.00'),
(8, 1, 8, '76.00'),
(9, 1, 9, '48.00'),
(10, 1, 10, '71.00'),
(11, 1, 11, '88.00'),
(12, 1, 12, '100.00'),
(13, 1, 13, '322.00'),
(14, 1, 14, '81.71'),
(15, 1, 15, '85.00'),
(16, 1, 16, '144.00'),
(17, 1, 17, '132.00'),
(18, 1, 18, '99.00'),
(19, 1, 19, '163.00'),
(20, 1, 20, '231.92'),
(21, 1, 21, '216.79'),
(22, 1, 22, '183.52'),
(23, 1, 23, '130.08'),
(24, 1, 24, '227.00'),
(25, 4, 4, '6.00'),
(26, 4, 1, '6.00'),
(27, 4, 11, '6.00'),
(28, 4, 12, '6.00'),
(29, 4, 17, '6.00'),
(30, 4, 13, '0.00'),
(31, 1, 26, '0.00'),
(32, 1, 25, '0.00'),
(33, 1, 27, '0.00'),
(34, 1, 28, '0.00'),
(35, 1, 30, '100.00'),
(36, 1, 31, '299.00'),
(37, 1, 29, '0.00'),
(38, 1, 32, '129.00'),
(39, 1, 33, '1.00'),
(40, 1, 34, '1.00'),
(41, 1, 35, '1.00'),
(42, 1, 36, '1.00'),
(43, 1, 37, '500.00'),
(44, 1, 38, '1000.00'),
(45, 1, 39, '150.00'),
(46, 1, 40, '550.00'),
(47, 1, 41, '250.00'),
(48, 1, 42, '230.00'),
(49, 1, 43, '1799.00'),
(50, 1, 44, '4799.00'),
(51, 1, 45, '7299.00'),
(52, 1, 46, '949.00'),
(53, 1, 47, '1499.00'),
(54, 1, 48, '849.00'),
(55, 1, 49, '949.00'),
(56, 1, 50, '1499.00'),
(57, 1, 51, '1699.00'),
(58, 1, 52, '699.00'),
(59, 1, 53, '1749.00'),
(60, 1, 54, '749.00'),
(61, 1, 55, '649.00'),
(62, 1, 56, '899.00'),
(63, 1, 57, '365.00'),
(64, 1, 58, '285.00'),
(65, 1, 59, '299.00'),
(66, 1, 60, '52.00'),
(67, 1, 61, '299.00'),
(68, 1, 62, '52.00'),
(69, 1, 63, '52.00'),
(70, 1, 64, '299.00'),
(71, 1, 65, '299.00'),
(72, 1, 66, '299.00'),
(73, 1, 67, '290.00'),
(74, 1, 68, '299.00'),
(75, 1, 69, '52.00'),
(76, 1, 70, '299.00'),
(77, 1, 71, '299.00'),
(78, 1, 72, '299.00'),
(79, 1, 73, '54.00'),
(80, 1, 74, '54.00'),
(81, 1, 75, '54.00'),
(82, 1, 76, '54.00'),
(83, 1, 77, '54.00'),
(84, 1, 78, '54.00'),
(85, 1, 79, '290.00'),
(86, 1, 80, '60.00'),
(87, 1, 81, '290.00'),
(88, 1, 82, '69.00'),
(89, 1, 83, '78.00'),
(90, 1, 84, '290.00'),
(91, 1, 85, '85.00'),
(92, 1, 86, '85.00'),
(93, 1, 87, '89.00'),
(94, 1, 88, '93.00'),
(95, 1, 89, '95.00'),
(96, 1, 90, '95.00'),
(97, 1, 93, '95.00'),
(98, 1, 94, '699.00'),
(99, 1, 95, '849.00'),
(100, 1, 96, '189.00'),
(101, 1, 97, '419.00'),
(102, 1, 98, '749.00'),
(103, 1, 99, '799.00'),
(104, 1, 100, '9.00'),
(105, 1, 101, '10.00'),
(106, 1, 102, '17.00'),
(107, 1, 103, '2499.00'),
(108, 1, 104, '2099.00'),
(109, 1, 105, '3099.00'),
(110, 1, 106, '3659.00'),
(111, 1, 107, '3499.00'),
(112, 1, 108, '169.00'),
(113, 1, 109, '185.00'),
(114, 1, 91, '95.00'),
(115, 1, 110, '99.00'),
(116, 1, 111, '99.00'),
(117, 1, 112, '99.00'),
(118, 1, 113, '104.00'),
(119, 1, 114, '113.00'),
(120, 1, 115, '113.00'),
(121, 1, 116, '120.00'),
(122, 1, 117, '117.00'),
(123, 1, 118, '119.00'),
(124, 1, 119, '123.00'),
(125, 1, 120, '126.00'),
(126, 1, 121, '126.00'),
(127, 1, 122, '128.00'),
(128, 1, 123, '128.00'),
(129, 1, 124, '130.00'),
(130, 1, 125, '132.00'),
(131, 1, 126, '135.00'),
(132, 1, 127, '138.00'),
(133, 1, 128, '141.00'),
(134, 1, 129, '143.00'),
(135, 1, 130, '154.00'),
(136, 1, 131, '154.00'),
(137, 1, 132, '154.00'),
(138, 1, 133, '154.00'),
(139, 1, 134, '154.00'),
(140, 1, 135, '154.00'),
(141, 1, 136, '154.00'),
(142, 1, 137, '159.00'),
(143, 1, 138, '190.00'),
(144, 1, 139, '167.00'),
(145, 1, 140, '171.00'),
(146, 1, 141, '171.00'),
(147, 1, 142, '210.00'),
(148, 1, 143, '171.00'),
(149, 1, 144, '178.00'),
(150, 1, 145, '178.00'),
(151, 1, 146, '184.00'),
(152, 1, 147, '189.00'),
(153, 1, 148, '189.00'),
(154, 1, 149, '189.00'),
(155, 1, 150, '191.00'),
(156, 1, 151, '208.00'),
(157, 1, 152, '208.00'),
(158, 1, 153, '299.00'),
(159, 1, 154, '279.00'),
(160, 1, 155, '199.00'),
(161, 1, 156, '199.00'),
(162, 1, 157, '175.00'),
(163, 1, 158, '175.00'),
(164, 1, 159, '175.00'),
(165, 1, 160, '175.00'),
(166, 1, 161, '175.00'),
(167, 1, 162, '175.00'),
(168, 1, 163, '199.00'),
(169, 1, 164, '279.00'),
(170, 1, 165, '279.00'),
(171, 1, 166, '399.00'),
(172, 1, 167, '359.00'),
(173, 1, 168, '359.00'),
(174, 1, 169, '359.00'),
(175, 1, 170, '359.00'),
(176, 1, 171, '359.00'),
(177, 1, 172, '299.00'),
(178, 1, 173, '312.00'),
(179, 1, 174, '699.00'),
(180, 1, 175, '699.00'),
(181, 1, 176, '1399.00'),
(182, 1, 177, '10600.00'),
(183, 1, 178, '199.00'),
(184, 1, 179, '199.00'),
(185, 1, 180, '199.00'),
(186, 1, 181, '199.00'),
(187, 1, 182, '299.00'),
(188, 1, 183, '399.00'),
(189, 1, 184, '399.00'),
(190, 1, 185, '399.00'),
(191, 1, 186, '399.00'),
(192, 1, 187, '399.00'),
(193, 1, 188, '399.00'),
(194, 1, 189, '129.00'),
(195, 1, 190, '719.00'),
(196, 1, 191, '719.00'),
(197, 1, 192, '389.00'),
(198, 1, 193, '215.00'),
(199, 1, 194, '224.00'),
(200, 1, 195, '230.00'),
(201, 1, 196, '232.00'),
(202, 1, 197, '237.00'),
(203, 1, 198, '241.00'),
(204, 1, 199, '230.00'),
(205, 1, 200, '249.00'),
(206, 1, 201, '258.00'),
(207, 1, 202, '263.00'),
(208, 1, 203, '265.00'),
(209, 1, 204, '265.00'),
(210, 1, 205, '265.00'),
(211, 1, 206, '265.00'),
(212, 1, 207, '49.00'),
(213, 1, 208, '55.00'),
(214, 1, 209, '9.00'),
(215, 1, 210, '24.00'),
(216, 1, 211, '969.00'),
(217, 1, 212, '9999.00'),
(218, 1, 213, '3999.00'),
(219, 1, 214, '2599.00'),
(220, 1, 215, '4999.00'),
(221, 1, 216, '267.00'),
(222, 1, 217, '267.00'),
(223, 1, 218, '276.00'),
(224, 1, 219, '291.00'),
(225, 1, 220, '294.00'),
(226, 1, 221, '294.00'),
(227, 1, 222, '309.00'),
(228, 1, 223, '311.00'),
(229, 1, 224, '339.00'),
(230, 1, 225, '363.00'),
(231, 1, 226, '380.00'),
(232, 1, 227, '599.00'),
(233, 1, 228, '3499.00'),
(234, 1, 229, '5778.00'),
(235, 1, 230, '0.00'),
(236, 1, 231, '349.00'),
(237, 1, 232, '299.00'),
(238, 1, 233, '99.00'),
(239, 1, 234, '159.00'),
(240, 1, 235, '179.00'),
(241, 1, 236, '179.00'),
(242, 1, 237, '179.00'),
(243, 1, 238, '119.00'),
(244, 1, 239, '169.00'),
(245, 1, 240, '189.00'),
(246, 1, 241, '189.00'),
(247, 1, 242, '189.00'),
(248, 1, 243, '149.00'),
(249, 1, 244, '549.00'),
(250, 1, 245, '229.00'),
(251, 1, 246, '229.00'),
(252, 1, 247, '229.00'),
(253, 1, 248, '89.00'),
(254, 1, 249, '119.00'),
(255, 1, 250, '129.00'),
(256, 1, 251, '129.00'),
(257, 1, 252, '129.00'),
(258, 1, 253, '149.00'),
(259, 1, 254, '239.00'),
(260, 1, 255, '269.00'),
(261, 1, 256, '269.00'),
(262, 1, 257, '269.00'),
(263, 1, 258, '99.00'),
(264, 1, 259, '159.00'),
(265, 1, 260, '179.00'),
(266, 1, 261, '179.00'),
(267, 1, 262, '179.00'),
(268, 1, 263, '49.00'),
(269, 1, 264, '49.00'),
(270, 1, 265, '49.00'),
(271, 1, 266, '49.00'),
(272, 1, 267, '49.00'),
(273, 1, 268, '49.00'),
(274, 1, 269, '49.00'),
(275, 1, 270, '49.00'),
(276, 1, 271, '49.00'),
(277, 1, 272, '49.00'),
(278, 1, 273, '49.00'),
(279, 1, 274, '49.00'),
(280, 1, 275, '49.00'),
(281, 1, 276, '49.00'),
(282, 1, 277, '49.00'),
(283, 1, 278, '969.00'),
(284, 1, 279, '479.00'),
(285, 1, 280, '479.00'),
(286, 1, 281, '1449.00'),
(287, 1, 282, '479.00'),
(288, 1, 283, '779.00');

-- --------------------------------------------------------

--
-- Struktura tabulky `price_types`
--

CREATE TABLE IF NOT EXISTS `price_types` (
`id` int(11) NOT NULL,
  `kod` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `kratky_popis` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `price_types`
--

INSERT INTO `price_types` (`id`, `kod`, `popis`, `kratky_popis`) VALUES
(1, 'hodnota_s_dph', 'Zadání hodnotou s DPH', 's DPH'),
(2, 'hodnota_bez_dph', 'Zadání hodnotou bez DPH', 'bez DPH'),
(3, 'sleva_procentem', 'Zadání procentní slevou z D0', 'sleva %');

-- --------------------------------------------------------

--
-- Struktura tabulky `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `code` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  `jednotka` varchar(4) COLLATE utf8_czech_ci DEFAULT 'ks',
  `availability` varchar(90) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `rok_vyroby` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `hmotnost` decimal(6,3) DEFAULT '0.000',
  `pocet_na_sklade` varchar(64) COLLATE utf8_czech_ci NOT NULL DEFAULT '0',
  `min_order_quantity` decimal(3,2) DEFAULT NULL,
  `puvodni_cena` decimal(10,2) NOT NULL,
  `poradi` int(11) NOT NULL,
  `smazano` tinyint(4) NOT NULL DEFAULT '0',
  `top` tinyint(4) NOT NULL DEFAULT '0',
  `tax_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL DEFAULT '0',
  `photo_src` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `available_languages` int(11) NOT NULL DEFAULT '1',
  `import_type` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `original` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `product_expedition_id` int(11) DEFAULT NULL,
  `guarantee` int(11) DEFAULT NULL,
  `in_stock` tinyint(4) NOT NULL DEFAULT '0',
  `percentage_discount` decimal(4,2) NOT NULL DEFAULT '0.00',
  `ignore_discount` tinyint(4) NOT NULL DEFAULT '0',
  `new_imported` tinyint(4) NOT NULL DEFAULT '0',
  `imported` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `gift` tinyint(4) NOT NULL DEFAULT '0',
  `gift_threshold_price` decimal(8,0) DEFAULT NULL,
  `product_action_type` tinyint(4) NOT NULL DEFAULT '0',
  `new` tinyint(4) NOT NULL DEFAULT '0',
  `sale_off` tinyint(4) NOT NULL DEFAULT '0',
  `producer_sale_off` tinyint(4) NOT NULL DEFAULT '0',
  `youtube_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `stroj_id` int(11) NOT NULL,
  `prefered` tinyint(4) DEFAULT NULL,
  `action` tinyint(4) DEFAULT '0',
  `homepage` tinyint(1) NOT NULL DEFAULT '0',
  `sec_src` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `products`
--

INSERT INTO `products` (`id`, `code`, `jednotka`, `availability`, `rok_vyroby`, `hmotnost`, `pocet_na_sklade`, `min_order_quantity`, `puvodni_cena`, `poradi`, `smazano`, `top`, `tax_id`, `manufacturer_id`, `photo_src`, `available_languages`, `import_type`, `original`, `product_expedition_id`, `guarantee`, `in_stock`, `percentage_discount`, `ignore_discount`, `new_imported`, `imported`, `updated`, `gift`, `gift_threshold_price`, `product_action_type`, `new`, `sale_off`, `producer_sale_off`, `youtube_code`, `stroj_id`, `prefered`, `action`, `homepage`, `sec_src`) VALUES
(1, '', 'ks', '', '', '0.000', '0', NULL, '0.00', 1, 0, 0, 0, 0, 'alu-bond_white', 1, '', '', NULL, NULL, 0, '0.00', 0, 0, NULL, NULL, 0, NULL, 0, 0, 0, 0, '', 0, NULL, 0, 1, 'alu-bond_red');

-- --------------------------------------------------------

--
-- Struktura tabulky `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
`id` int(11) NOT NULL,
  `poradi` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `photo_src_left` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `photo_src_right` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `priorita` tinyint(4) NOT NULL DEFAULT '0',
  `special_code` varchar(16) COLLATE utf8_czech_ci NOT NULL COMMENT 'specialni kategorie (novinky, akce, apod.)',
  `class` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `photo_src` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `available_languages` int(11) NOT NULL DEFAULT '1',
  `photo_nav_src` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `template` tinyint(1) NOT NULL DEFAULT '0',
  `show_prod` tinyint(1) NOT NULL DEFAULT '0',
  `gallery_id` int(11) DEFAULT NULL,
  `homepage` tinyint(1) NOT NULL DEFAULT '0',
  `home_image_src` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `homepage_text` tinyint(1) NOT NULL DEFAULT '0',
  `demand` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=26 ;

--
-- Vypisuji data pro tabulku `product_categories`
--

INSERT INTO `product_categories` (`id`, `poradi`, `photo`, `photo_src_left`, `photo_src_right`, `priorita`, `special_code`, `class`, `photo_src`, `parent_id`, `available_languages`, `photo_nav_src`, `template`, `show_prod`, `gallery_id`, `homepage`, `home_image_src`, `homepage_text`, `demand`) VALUES
(1, 1, '', NULL, '', 0, '', '', 'produktova-reseni', 0, 5, '', 1, 0, 0, 1, 'home_image', 0, 1),
(2, 2, '', NULL, '', 1, '', '', '', 1, 5, '', 0, 0, 0, 0, NULL, 0, 0),
(3, 2, '', NULL, '', 0, '', '', '', 0, 1, '', 0, 0, 0, 1, 'home_image', 0, 1),
(4, 3, '', NULL, '', 0, '', '', '', 0, 1, '', 0, 0, 0, 1, 'home_image', 1, 0),
(5, 3, '', NULL, '', 1, '', '', '', 1, 1, '', 0, 0, 0, 0, NULL, 0, 0),
(6, 4, '', NULL, '', 1, '', '', '', 1, 1, '', 0, 0, NULL, 0, NULL, 0, 0),
(7, 5, '', NULL, '', 1, '', '', '', 1, 1, '', 0, 0, NULL, 0, NULL, 0, 0),
(8, 6, '', NULL, '', 1, '', '', '', 1, 1, '', 0, 0, NULL, 0, NULL, 0, 0),
(9, 7, '', NULL, '', 1, '', '', '', 1, 1, '', 0, 0, NULL, 0, NULL, 0, 0),
(10, 8, '', NULL, '', 1, '', '', '', 1, 1, '', 0, 0, NULL, 0, NULL, 0, 0),
(11, 9, '', NULL, '', 1, '', '', '', 1, 1, '', 0, 0, NULL, 0, NULL, 0, 0),
(12, 10, '', NULL, '', 1, '', '', '', 1, 1, '', 0, 0, NULL, 0, NULL, 0, 0),
(13, 11, '', NULL, '', 1, '', '', '', 1, 1, '', 0, 0, NULL, 0, NULL, 0, 0),
(14, 1, '', NULL, '', 1, '', '', 'sendvicove-desky-typu-bond', 3, 1, '', 0, 0, 0, 0, NULL, 0, 0),
(15, 2, '', NULL, '', 1, '', '', 'pmma-plexisklo', 3, 1, '', 0, 0, 0, 0, NULL, 0, 0),
(16, 3, '', NULL, '', 1, '', '', 'lehcene-pvc', 3, 1, '', 0, 0, 0, 0, NULL, 0, 0),
(17, 4, '', NULL, '', 1, '', '', '', 3, 1, '', 0, 0, 0, 0, NULL, 0, 0),
(18, 6, '', NULL, '', 1, '', '', 'led-technologie', 3, 1, '', 0, 0, 0, 0, NULL, 0, 0),
(19, 1, '', NULL, '', 1, '', '', '', 4, 1, '', 0, 0, 0, 0, NULL, 0, 0),
(20, 4, '', NULL, '', 0, '', '', '', 0, 1, '', 0, 0, 0, 0, '', 0, 0),
(23, 1, '', NULL, '', 1, '', NULL, 'ukazkova-kategorie', 1, 5, '', 0, 0, 1, 0, NULL, 0, 0),
(24, 5, '', NULL, '', 1, '', NULL, 'lexan', 3, 1, '', 0, 0, 0, 1, NULL, 1, 0),
(25, 1, '', NULL, '', 1, '', NULL, '', 20, 1, '', 0, 0, 0, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `product_categories_products`
--

CREATE TABLE IF NOT EXISTS `product_categories_products` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `product_categories_products`
--

INSERT INTO `product_categories_products` (`id`, `product_id`, `product_category_id`) VALUES
(3, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `product_category_data`
--

CREATE TABLE IF NOT EXISTS `product_category_data` (
`id` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `nazev_full` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `nazev_jedno` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `nazev_menu` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `nazev_paticka` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `uvodni_popis` text COLLATE utf8_czech_ci,
  `uvodni_popis_levy` text COLLATE utf8_czech_ci,
  `uvodni_popis_pravy` text COLLATE utf8_czech_ci,
  `popis` text COLLATE utf8_czech_ci,
  `zobrazit` tinyint(4) NOT NULL DEFAULT '1',
  `zobrazit_carousel` tinyint(4) NOT NULL DEFAULT '1',
  `price_from` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `no_show_products` tinyint(4) NOT NULL DEFAULT '0',
  `header` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=29 ;

--
-- Vypisuji data pro tabulku `product_category_data`
--

INSERT INTO `product_category_data` (`id`, `product_category_id`, `language_id`, `route_id`, `title`, `description`, `keywords`, `nazev`, `nazev_full`, `nazev_jedno`, `nazev_menu`, `nazev_paticka`, `uvodni_popis`, `uvodni_popis_levy`, `uvodni_popis_pravy`, `popis`, `zobrazit`, `zobrazit_carousel`, `price_from`, `no_show_products`, `header`) VALUES
(1, 1, 1, 11, 'Produktová řešení', '', '', 'Produktová řešení', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 1),
(2, 2, 1, 12, 'Odvětratelné fasády', '', '', 'Odvětratelné fasády', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(3, 2, 4, 14, 'Alubond', '', '', 'Asss', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(4, 1, 4, 15, 'Materiál', '', '', 'Material', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 1),
(5, 3, 1, 18, 'Materiál', '', '', 'Materiál', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 1),
(6, 4, 1, 19, 'Frézování kazet', '', '', 'Frézování kazet', '', '', '', '', '<p>DENCOP LIGHTING zastupuje kanadskou společnost AXYZ v prodeji frézek pro Českou a Slovenskou republiku.</p>\n', '', '', '<p>Fasádní kazety a tvarové díly se zpracovávají za pomoci <strong>vyfrézovaných drážek &ndash; pravoúhlých nebo ve tvaru V na rubové straně materiálu</strong>. Lícová hliníková deska (o síle 0,5 mm) a část jádra (o síle 0,3 mm) zústává neporušena. Oslabená tloušťka materiálu umožňuje snadné ruční obýhání bez nutnosti použití ohýbacích strojů.</p>\n', 1, 0, '', 0, 1),
(7, 5, 1, 20, 'Prosklené fasády', '', '', 'Prosklené fasády', '', '', '', '', NULL, '', '', '<p>yyy</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<table border="0" cellpadding="1" cellspacing="1">\n	<thead>\n		<tr>\n			<th scope="col">Lorem ipsum lorem</th>\n			<th scope="col">Lorem ipsum</th>\n			<th scope="col">Lorem</th>\n			<th scope="col">Ipsum</th>\n		</tr>\n	</thead>\n	<tbody>\n		<tr>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n		</tr>\n		<tr>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n		</tr>\n		<tr>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n		</tr>\n		<tr>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n		</tr>\n	</tbody>\n</table>\n', 1, 0, '', 0, 0),
(8, 6, 1, 21, 'Opláštení cerpacích stanic', '', '', 'Opláštení cerpacích stanic', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(9, 7, 1, 22, 'Opláštění modulární stavby - obytné a sanitární kontejnery', '', '', 'Opláštění modulární stavby - obytné a sanitární kontejnery', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(10, 8, 1, 23, 'Výplně balkónů', '', '', 'Výplně balkónů', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(11, 9, 1, 24, 'Protihlukové stěny', '', '', 'Protihlukové stěny', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(12, 10, 1, 25, 'Obklady a dekorace', '', '', 'Obklady a dekorace', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(13, 11, 1, 26, '3D design objekty', '', '', '3D design objekty', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(14, 12, 1, 27, 'Opláštění strojů a zařízení', '', '', 'Opláštění strojů a zařízení', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(15, 13, 1, 28, 'Městské mobiliáře a zastávkové přístřešky', '', '', 'Městské mobiliáře a zastávkové přístřešky', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(16, 14, 1, 29, 'Sendvičové desky typu bond', '', '', 'Sendvičové desky typu bond', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(17, 15, 1, 30, 'PMMA (plexisklo)', '', '', 'PMMA (plexisklo)', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(18, 16, 1, 31, 'Lehčené PVC', '', '', 'Lehčené PVC', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(19, 17, 1, 32, 'Polykarbonát', '', '', 'Polykarbonát', '', '', '', '', NULL, '', '', NULL, 0, 0, '', 0, 0),
(20, 18, 1, 33, 'LED technologie', '', '', 'LED technologie', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(21, 19, 1, 34, 'Frézování kazet CNC frézkou', '', '', 'Frézování kazet CNC frézkou', '', '', '', '', NULL, '', '', '<p><span style="line-height: 1.6;">​</span><span style="line-height: 20.7999992370605px;">Sendvičové desky ALU&ndash;BOND a DEBOND jsou snadno opracovatelné nástroji na dřevo a kov. Zpracovávají se řezáním, stříháním, vrtáním, zkružováním na válcích, frézováním, vysekáváním, ohýbáním a spojují lepením, nýtováním, svařováním a šroubováním.&nbsp;</span></p>\n\n<p>Fasádní kazety a tvarové díly se zpracovávají za pomoci vyfrézovaných <a href="http://dencop.dgsbeta.cz/media/files/download/item/files-10/debond-zpracovani-1.pdf" target="_blank"><strong>drážek &ndash; pravoúhlých nebo ve tvaru V na rubové straně materiálu</strong></a>. Lícová hliníková deska (o síle 0,5 mm) a část jádra (o síle 0,3 mm) zústává neporušena. Oslabená tloušťka materiálu umožňuje snadné ruční obýhání bez nutnosti použití ohýbacích strojů.</p>\n\n<p>Existuje několik způsobů připevnění fasádních bondových kazet:<br />\n<span style="line-height: 1.6;"><strong>Kazety pro vertikální členění fasády</strong> &ndash; zavěšené na nerez čepy</span><br />\n<span style="line-height: 1.6;"><strong>Kazety SZ20 pro horizontální členění fasády</strong> &ndash; systém pero&ndash;drážka</span><br />\n<span style="line-height: 1.6;"><strong>Kazety pro vertikální/horizontální členění fasády</strong> &ndash; nýtování nebo šroubování na nosnou konstrukci</span></p>\n\n<p>&nbsp;</p>\n\n<p>My máme technologii, materiály a Vy máte své projekty.&nbsp;Frézujete u nás a my jsme za to rádi.&nbsp;Aby byl Vámi požadovaný výsledek správný,&nbsp;musí být správná i data od Vás.&nbsp;<span style="line-height: 1.6;">Jak na to?</span><br />\n<span style="line-height: 1.6;">Naleznete zde:&nbsp;</span><strong><a href="/media/admin/js/fileman/Uploads/produkt listy/frezka - priprava dat.pdf" style="line-height: 1.6;" target="_blank"><span style="line-height: 1.6;">Pravidla pro přípravu dat pro frézku</span></a></strong></p>\n\n<p>&nbsp;</p>\n', 1, 0, '', 0, 0),
(22, 20, 1, 35, 'Služby', '', '', 'Služby', '', '', '', '', NULL, '', '', '<p><span style="color: rgb(89, 89, 89); font-family: ''Open Sans'', sans-serif; font-size: 14px; line-height: 22.3999996185303px;">Jako dodavatelé jsme schopni zákazníkovi&nbsp;poskytnout nejen</span><strong style="box-sizing: border-box; line-height: 22.3999996185303px; color: rgb(89, 89, 89); font-family: ''Open Sans'', sans-serif; font-size: 14px;">&nbsp;záruky a certifikace ale také vlastní know-how</strong><span style="color: rgb(89, 89, 89); font-family: ''Open Sans'', sans-serif; font-size: 14px; line-height: 22.3999996185303px;">&nbsp;o zpracování a využití materiálů ve stavebnictví.&nbsp;</span></p>\n\n<p><strong>Zlín - Praha - Bratislava - Košice</strong></p>\n\n<p>V areálu centrálního skladu ve Zlíně-Malenovicích Vám můžeme nabídnout:</p>\n\n<p>&bull;<strong>&nbsp;technické poradenství</strong><br />\n<span style="line-height: 20.7999992370605px;">&bull;</span><strong style="line-height: 20.7999992370605px;">&nbsp;</strong><strong style="line-height: 1.6;">řezání a formátování</strong><span style="line-height: 1.6;"> deskových materiálů, hliníkových a plastových profilů</span><br />\n<span style="line-height: 1.6;">&bull; </span><strong style="line-height: 1.6;">frézování fasádních</strong><span style="line-height: 1.6;"> bondových kazet na CNC frézce AXYZ 6014</span><br />\n<span style="line-height: 20.7999992370605px;">&bull;&nbsp;</span><strong style="line-height: 20.7999992370605px;">drážkování</strong><span style="line-height: 20.7999992370605px;"> hliníkových sendvičových materiálů</span><br />\n<span style="line-height: 20.7999992370605px;">&bull;&nbsp;</span><strong style="line-height: 20.7999992370605px;">gravírování </strong><span style="line-height: 20.7999992370605px;">grafiky do kovů a plastů</span><br />\n<span style="line-height: 1.6;">&bull; </span><strong style="line-height: 1.6;">rozvoz&nbsp;</strong><span style="line-height: 1.6;">zboží vlastní dopravou nebo smluvními dopravci</span><br />\n<strong style="line-height: 20.7999992370605px;">Maximální rozměr materiálu: 2,1 m x neomezeně</strong><br />\n<strong style="line-height: 20.7999992370605px;">Kusové zakázky běžně frézujeme do 2 pracovních dní.</strong></p>\n\n<p>&nbsp;</p>\n\n<p><strong style="line-height: 1.6;">Velkoplošná CNC frézka AXYZ 6014</strong></p>\n\n<p><span style="line-height: 1.6;">Rozměr pracovní plochy:</span><strong style="line-height: 1.6;"> 2165 x 4200mm</strong><br />\n<span style="line-height: 1.6;">Frézovací vřeteno HSD s rozsahem otáček </span><strong style="line-height: 1.6;">až do 24.000 ot/min.</strong><br />\n<span style="line-height: 1.6;">Posuvy se servomotory a tzv. </span><strong style="line-height: 1.6;">Helical Rackem</strong><span style="line-height: 1.6;"> - tj. šikmým ozubením na pastorcích a ozubených hřebenech posuvů</span><br />\n<span style="line-height: 1.6;">Software: </span><strong style="line-height: 1.6;">ArtCam Insignia</strong></p>\n\n<p><span style="line-height: 1.6;">Parametry AXYZ 6014 jsou předpokladem pro velmi vysokou přesnost obrábění s minimálními vibracemi, čímž se dosahuje i <strong>vynikající kvality obráběného řezu a to zejména u hran plexiskla.</strong> Standardně frézujeme deskový materiál <strong>plexi (PMMA), PVC, hliníkový sendvičový materiál typu bond, hliníkový plech, polystyren</strong>. Nabízíme frézování také<strong> běžných nábytkářských materiálů</strong>. Zašlete nám výkres a obratem Vám výrobu naceníme.&nbsp;</span></p>\n\n<p>&nbsp;</p>\n\n<p><strong>Frézky AXYZ patří mezi nejmodernější frézovací stroje a společnost DENCOP LIGHTING má výhradní zastoupení prodeje pro Českou a Slovenskou republiku.</strong><br />\nPro informace o instalacích CNC zařízení a zpracování Vašich zakázek kontaktujte <a href="mailto:obchod@dencop.cz?subject=Dotaz%20na%20fr%C3%A9zov%C3%A1n%C3%AD">obchod@dencop.cz</a></p>\n', 1, 0, '', 0, 0),
(25, 23, 1, 38, 'Ukázková kategorie', '', '', 'Ukázková kategorie', '', '', '', '', NULL, '', '', '<p><span style="color:#3c95b3;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam posuere felis sem. Nunc maximus scelerisque accumsan.</span></p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>List item1</li>\n	<li>List item2</li>\n	<li>List item3</li>\n</ul>\n\n<table border="0" cellpadding="1" cellspacing="1">\n	<thead>\n		<tr>\n			<th scope="col">Lorem ipsum lorem</th>\n			<th scope="col">Lorem ipsum</th>\n			<th scope="col">Lorem</th>\n			<th scope="col">Ipsum</th>\n		</tr>\n	</thead>\n	<tbody>\n		<tr>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n		</tr>\n		<tr>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n		</tr>\n		<tr>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n		</tr>\n		<tr>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem ipsum 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n			<td><span style="line-height: 20.7999992370605px;">Lorem 123</span></td>\n		</tr>\n	</tbody>\n</table>\n', 0, 0, '', 0, 0),
(26, 23, 4, 39, 'Presentation category', '', '', 'Presentation category', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0),
(27, 24, 1, 53, 'LEXAN - komorové, tepelně izolační stabilní desky s UV ochranou', '', '', 'LEXAN', '', '', '', '', '<p>Polykarbonátové desky LEXAN - komorové desky<br />\n&nbsp;</p>\n\n<p>&nbsp;</p>\n', '', '', '<p><span style="line-height: 20.7999992370605px;">Polykarbonátové desky LEXAN - komorové desky</span></p>\n\n<p>Tepelně izolační stabilní desky s UV ochranou, vyráběné z vysoce kvalitního termoplastického materiálu - polykarbonátu LexanTM. Polykarbonáty patří mezi termoplastické polymery (termoplasty).<br />\nPolykarbonát slučuje několik vlastností, které se v té míře nevyskytují u žádného jiného materiálu. &nbsp;Nabízejí optimální bezpečnost a ochranu - jsou jedničkou v nerozbitné zasklívání.&nbsp;<br />\n<br />\nDesky z polykarbonátu LexanTM jsou transparentní a zároveň mimořádně odolné vůči nárazům ( rázová houževnatost) &nbsp;v teplotním rozmezí od - 40&deg;C do +120&deg;C. Ve srovnání se sklem je tato hodnota u polykarbonátu vyšší až 200x, vůči PVC vyšší 4x a oproti PMMA vyšší 10x.&nbsp;<br />\n<br />\nDále materiál charakterizuje nízká specifická hmotnost, vysoká propustnost světla (přes 80% - závisí na typu a tloušce desky) a výborná odolnost vůči povětrnostním vlivům. Ve spojení s jedno- nebo oboustranně koextrudovanou vrstvou UV filtru vykazuje vysokou odolnost proti stárnutí a zajišťuje zachování optických i mechanických vlastností.<br />\n<br />\nDesky menších tlouštěk (8 a 10 mm) mají dvoustěnou strukturu, vyšší tloušťky mají strukturu vícestěnnou (3, 4, 5, 7), s křížovými (X) výztuhami nebo tzv. strukturou medové plástve (honeycomb). Lze je instalovat jako rovné nebo ohnuté za studena. Pokud poloměr ohybu polykarbonátu není menší než minimální doporučený poloměr, nemá ohyb negativní vliv na mechanické vlastnosti desek, ale naopak se díky vzniklé klenbě zvyšuje únosnost.&nbsp;<br />\n<br />\nVzhledem k výše uvedeným vlastnostem a vysoké esterické hodnotě nahrazují polykarbonátové desky sklo při různých typech zasklívání jak v exteriéru, tak v interiéru. Patří sem veškeré ploché i obloukové zasklívání - zastřešení teras, prosklení oken a dveří, světlíků a světelných pásů, zimních zahrad a skleníků, pergol, bazénů, výplní, dělící stěny &nbsp;a paravany, reklamní panely a poutače, prvky městského mobiliáře, protihlukové stěny, ale i velkoplošná zastřešení a opláštění (sportovní stadiony apod.).<br />\n<br />\nKomorové, tepelně izolační stabilní desky s UV ochranou, vyráběné z vysoce kvalitního termoplastického materiálu - polykarbonátu LexanTM, optimálně řeší problémy ve stavebnictví, zemědělství a v jiných oblastech, kde je potřeba oddělit dvojí prostředí při zachování vysoké propustnosti světla a bez potřeby přímého výhledu.<br />\n<br />\nDeskový materiál LEXAN dodáváme na objednávku.</p>\n\n<p>&nbsp;</p>\n', 1, 0, '', 0, 1),
(28, 25, 1, 57, 'Frez', '', '', 'Frez', '', '', '', '', NULL, '', '', NULL, 1, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `product_category_downloads_categories`
--

CREATE TABLE IF NOT EXISTS `product_category_downloads_categories` (
`id` bigint(20) unsigned NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `download_id` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Vypisuji data pro tabulku `product_category_downloads_categories`
--

INSERT INTO `product_category_downloads_categories` (`id`, `product_category_id`, `download_id`) VALUES
(3, 22, 5),
(4, 22, 7),
(6, 20, 7),
(7, 19, 6),
(8, 19, 8),
(9, 19, 9),
(10, 4, 12),
(23, 23, 11),
(22, 23, 10),
(21, 23, 9);

-- --------------------------------------------------------

--
-- Struktura tabulky `product_data`
--

CREATE TABLE IF NOT EXISTS `product_data` (
`id` int(11) NOT NULL,
  `zobrazit_carousel` tinyint(4) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `nazev_doplnek` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `uvodni_popis` text COLLATE utf8_czech_ci,
  `popis` text COLLATE utf8_czech_ci,
  `odborne_informace` text COLLATE utf8_czech_ci,
  `baleni` text COLLATE utf8_czech_ci,
  `akce_text` text COLLATE utf8_czech_ci,
  `zobrazit` tinyint(4) NOT NULL DEFAULT '1',
  `k_prodeji` tinyint(4) NOT NULL DEFAULT '1',
  `vykon` float unsigned DEFAULT NULL,
  `header` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `product_data`
--

INSERT INTO `product_data` (`id`, `zobrazit_carousel`, `product_id`, `language_id`, `route_id`, `title`, `description`, `keywords`, `nazev`, `nazev_doplnek`, `uvodni_popis`, `popis`, `odborne_informace`, `baleni`, `akce_text`, `zobrazit`, `k_prodeji`, `vykon`, `header`) VALUES
(1, 0, 1, 1, 16, 'Náklaďák', '', '', 'Náklaďák', '', '', NULL, '', '', '', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `product_downloads_products`
--

CREATE TABLE IF NOT EXISTS `product_downloads_products` (
`id` bigint(20) unsigned NOT NULL,
  `product_id` int(11) NOT NULL,
  `download_id` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `product_downloads_products`
--

INSERT INTO `product_downloads_products` (`id`, `product_id`, `download_id`) VALUES
(5, 1, 6);

-- --------------------------------------------------------

--
-- Struktura tabulky `product_photos`
--

CREATE TABLE IF NOT EXISTS `product_photos` (
`id` int(11) NOT NULL,
  `poradi` int(11) NOT NULL,
  `zobrazit` tinyint(4) NOT NULL DEFAULT '1',
  `photo_src` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `ext` char(4) COLLATE utf8_czech_ci NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `product_photo_data`
--

CREATE TABLE IF NOT EXISTS `product_photo_data` (
`id` int(11) NOT NULL,
  `product_photo_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.'),
(3, 'global_admin', 'Global administrator.');

-- --------------------------------------------------------

--
-- Struktura tabulky `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(2, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(2, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(5, 3),
(12, 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
`id` int(11) NOT NULL,
  `nazev_seo` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `module_id` int(11) NOT NULL,
  `module_action` varchar(64) COLLATE utf8_czech_ci NOT NULL DEFAULT 'index',
  `param_id1` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `baselang_route_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `read_only` tinyint(4) NOT NULL DEFAULT '0',
  `internal` tinyint(4) NOT NULL DEFAULT '0',
  `searcheable` tinyint(4) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `nazev_seo_old` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `zobrazit` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=61 ;

--
-- Vypisuji data pro tabulku `routes`
--

INSERT INTO `routes` (`id`, `nazev_seo`, `module_id`, `module_action`, `param_id1`, `language_id`, `baselang_route_id`, `title`, `description`, `keywords`, `read_only`, `internal`, `searcheable`, `deleted`, `nazev_seo_old`, `created_date`, `updated_date`, `deleted_date`, `zobrazit`) VALUES
(1, 'index', 1, 'detail', NULL, 1, 0, 'Úvodní strana', '', '', 0, 0, 1, 0, NULL, '2014-10-25 00:04:11', '2014-12-13 23:33:11', NULL, 1),
(2, 'o-nas', 1, 'detail', NULL, 1, 0, 'O nás', '', '', 0, 0, 1, 0, NULL, '2014-10-25 20:59:47', '2014-12-13 18:25:27', NULL, 1),
(3, 'kontakt', 4, 'index', NULL, 1, 0, 'Kontakt', '', '', 0, 0, 1, 0, NULL, '2014-10-25 23:51:41', '2014-10-29 11:03:35', NULL, 1),
(4, 'poradna', 12, 'index', NULL, 1, 0, 'Poradna', '', '', 0, 0, 1, 0, NULL, '2014-10-26 13:36:11', '2014-12-13 18:24:58', NULL, 0),
(5, 'ke-stazeni', 13, 'index', NULL, 1, 0, 'Ke stažení', '', '', 0, 0, 1, 0, NULL, '2014-10-27 00:15:40', '2014-12-13 18:25:16', NULL, 0),
(6, 'materialy-a-sluzby', 6, 'index', NULL, 1, 0, 'Materiály a služby', '', '', 0, 0, 1, 0, NULL, '2014-10-27 12:12:10', '2014-12-13 18:24:49', NULL, 1),
(7, 'renovace-obytne-domy', 14, 'detail', NULL, 1, 0, 'Renovace obytných domů', '', '', 0, 0, 1, 0, NULL, '2014-10-28 00:37:40', '2014-11-13 14:09:26', NULL, 1),
(8, 'ukazky-realizaci', 14, 'index', NULL, 1, 0, 'Ukázky realizací', '', '', 0, 0, 1, 0, NULL, '2014-10-28 01:01:07', '2014-12-13 18:25:06', NULL, 0),
(9, 'realizations', 14, 'index', NULL, 4, 8, 'Realizations', '', '', 0, 0, 1, 0, NULL, '2014-10-28 12:03:04', '2014-10-28 12:03:12', NULL, 1),
(10, 'hejhout-en', 14, 'detail', NULL, 4, 7, 'Hejhout', '', '', 0, 0, 1, 0, NULL, '2014-10-28 12:04:00', '2014-10-31 23:11:14', NULL, 1),
(11, 'produktova-reseni', 6, 'category', NULL, 1, 0, 'Produktová řešení', '', '', 0, 0, 1, 0, NULL, '2014-10-28 23:34:35', '2014-11-02 14:43:48', NULL, 1),
(12, 'odvetratelne-fasady', 6, 'category', NULL, 1, 0, 'Odvětratelné fasády', '', '', 0, 0, 1, 0, NULL, '2014-10-28 23:36:27', '2014-11-01 01:18:45', NULL, 1),
(13, 'download', 13, 'index', NULL, 4, 5, 'Ke stažení', '', '', 0, 0, 1, 0, NULL, '2014-10-28 23:47:21', NULL, NULL, 1),
(14, 'alubond-en', 6, 'category', NULL, 4, 12, 'Alubond', '', '', 0, 0, 1, 0, NULL, '2014-10-28 23:51:49', '2014-10-31 23:06:37', NULL, 1),
(15, 'material-en', 6, 'category', NULL, 4, 11, 'Materiál', '', '', 0, 0, 1, 0, NULL, '2014-10-28 23:52:04', '2014-10-29 12:45:30', NULL, 1),
(16, 'alu-bond', 6, 'detail', NULL, 1, 0, 'Náklaďák', '', '', 0, 0, 1, 0, NULL, '2014-10-29 00:07:28', '2014-12-14 11:12:38', NULL, 1),
(17, 'testovaci-novinky', 3, 'detail', NULL, 1, 0, 'Testovací novinky', '', '', 0, 0, 1, 0, NULL, '2014-10-29 12:25:39', '2014-12-14 00:36:40', NULL, 1),
(18, 'material', 6, 'category', NULL, 1, 0, 'Materiál', '', '', 0, 0, 1, 0, NULL, '2014-10-29 14:35:27', '2014-11-02 14:44:34', NULL, 1),
(19, 'frezovani-kazet', 6, 'category', NULL, 1, 0, 'Frézování kazet', '', '', 0, 0, 1, 0, NULL, '2014-10-29 14:35:36', '2014-12-01 17:15:12', NULL, 1),
(20, 'prosklene-fasady', 6, 'category', NULL, 1, 0, 'Prosklené fasády', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:30:57', '2014-12-04 09:54:53', NULL, 1),
(21, 'oplasteni-cerpacich-stanic', 6, 'category', NULL, 1, 0, 'Opláštení cerpacích stanic', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:31:13', NULL, NULL, 1),
(22, 'oplasteni-modularni-stavby-obytne-a-sanitarni-kontejnery', 6, 'category', NULL, 1, 0, 'Opláštění modulární stavby - obytné a sanitární kontejnery', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:31:27', '2014-10-29 23:32:27', NULL, 1),
(23, 'výplne-balkonu', 6, 'category', NULL, 1, 0, 'Výplně balkónů', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:31:52', NULL, NULL, 1),
(24, 'protihlukove-steny', 6, 'category', NULL, 1, 0, 'Protihlukové stěny', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:32:48', NULL, NULL, 1),
(25, 'obklady-a-dekorace', 6, 'category', NULL, 1, 0, 'Obklady a dekorace', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:33:07', NULL, NULL, 1),
(26, '3d-design-objekty', 6, 'category', NULL, 1, 0, '3D design objekty', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:33:22', NULL, NULL, 1),
(27, 'oplasteni-stroju-a-zarizeni', 6, 'category', NULL, 1, 0, 'Opláštění strojů a zařízení', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:33:43', NULL, NULL, 1),
(28, 'mestske-mobiliare-a-zastavkove-pristresky', 6, 'category', NULL, 1, 0, 'Městské mobiliáře a zastávkové přístřešky', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:34:11', NULL, NULL, 1),
(29, 'sendvicove-desky-typu-bond', 6, 'category', NULL, 1, 0, 'Sendvičové desky typu bond', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:34:26', '2014-11-18 17:14:43', NULL, 1),
(30, 'pmma-plexisklo', 6, 'category', NULL, 1, 0, 'PMMA (plexisklo)', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:35:04', '2014-11-18 17:13:49', NULL, 1),
(31, 'lehcene-pvc', 6, 'category', NULL, 1, 0, 'Lehčené PVC', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:35:20', '2014-11-18 17:09:39', NULL, 1),
(32, 'polykarbonat', 6, 'category', NULL, 1, 0, 'Polykarbonát', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:35:32', '2014-11-18 17:10:19', NULL, 0),
(33, 'led-technologie', 6, 'category', NULL, 1, 0, 'LED technologie', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:35:46', '2014-11-18 17:17:53', NULL, 1),
(34, 'frezovani-kazet-cnc-frezkou', 6, 'category', NULL, 1, 0, 'Frézování kazet CNC frézkou', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:36:05', '2014-12-01 17:13:44', NULL, 1),
(35, 'sluzby', 6, 'category', NULL, 1, 0, 'Služby', '', '', 0, 0, 1, 0, NULL, '2014-10-29 23:36:16', '2014-12-04 09:42:47', NULL, 1),
(36, 'podtest1-deleted-01-11-2014(01:20:08)', 6, 'category', NULL, 1, 0, 'Podtest1', '', '', 0, 0, 1, 1, 'podtest1', '2014-10-31 23:21:43', '2014-10-31 23:25:37', '2014-11-01 01:20:08', 0),
(37, 'podlest2-deleted-01-11-2014(01:20:00)', 6, 'category', NULL, 1, 0, 'Podlest2', '', '', 0, 0, 1, 1, 'podlest2', '2014-10-31 23:24:08', NULL, '2014-11-01 01:20:00', 0),
(38, 'ukazkova-kategorie', 6, 'category', NULL, 1, 0, 'Ukázková kategorie', '', '', 0, 0, 1, 0, NULL, '2014-11-01 01:19:27', '2014-12-04 09:55:19', NULL, 0),
(39, 'presentation-category', 6, 'category', NULL, 4, 38, 'Presentation category', '', '', 0, 0, 1, 0, NULL, '2014-11-01 01:39:26', '2014-11-01 14:37:47', NULL, 1),
(40, 'homepage', 1, 'index', NULL, 4, 1, 'Homepage', '', '', 0, 0, 1, 0, NULL, '2014-11-01 14:35:43', '2014-11-01 14:35:59', NULL, 1),
(41, 'material-and-services', 6, 'index', NULL, 4, 6, 'Material and Services', '', '', 0, 0, 1, 0, NULL, '2014-11-01 14:38:19', NULL, NULL, 1),
(42, 'aktualni-novinky', 3, 'index', NULL, 1, 0, 'Aktuální novinky', '', '', 0, 0, 1, 0, NULL, '2014-11-02 00:31:39', '2014-12-14 00:03:53', NULL, 1),
(43, 'testovaci-novinka-2', 3, 'detail', NULL, 1, 0, 'Testovací novinka 2', '', '', 0, 0, 1, 0, NULL, '2014-11-02 00:42:08', '2014-12-14 00:34:46', NULL, 1),
(44, 'testovaci-novinka-3', 3, 'detail', NULL, 1, 0, 'Testovací novinka 3', '', '', 0, 0, 1, 0, NULL, '2014-11-02 00:42:24', NULL, NULL, 0),
(45, 'testovaci-novinka-4', 3, 'detail', NULL, 1, 0, 'Testovací novinka 4', '', '', 0, 0, 1, 0, NULL, '2014-11-02 00:42:36', NULL, NULL, 0),
(46, 'plexisklo_dencop-deleted-14-12-2014(00:23:21)', 3, 'detail', NULL, 1, 0, 'Plexisklo z DENCOP', '', 'plexisklo, PMMA, plexi, polymethylmethakrylát,  akrylátové sklo, organické sklo, crystal, perspex', 0, 0, 1, 1, 'plexisklo_dencop', '2014-11-02 00:42:50', '2014-12-01 13:30:02', '2014-12-14 00:23:21', 0),
(47, 'testovaci-novinka-6', 3, 'detail', NULL, 1, 0, 'Testovací novinka 6', '', '', 0, 0, 1, 0, NULL, '2014-11-02 00:42:58', NULL, NULL, 0),
(48, 'testovaci-novinka-7', 3, 'detail', NULL, 1, 0, 'Testovací novinka 7', '', '', 0, 0, 1, 0, NULL, '2014-11-02 00:44:53', NULL, NULL, 0),
(49, 'rozvozovy-plan', 1, 'detail', NULL, 1, 0, 'Rozvozový plán', '', '', 0, 0, 1, 0, NULL, '2014-11-02 02:21:55', '2014-11-02 02:31:17', NULL, 1),
(50, 'poptavkovy-formular', 15, 'index', NULL, 1, 0, 'Poptávkový formulář', '', '', 0, 0, 1, 0, NULL, '2014-11-02 12:43:05', NULL, NULL, 1),
(51, 'mapa-stranek', 1, 'sitemap', NULL, 1, 0, 'Mapa stránek', '', '', 0, 0, 1, 0, NULL, '2014-11-02 21:30:57', NULL, NULL, 1),
(52, 'vyhledavani', 10, 'index', NULL, 1, 0, 'Vyhledávání', '', '', 0, 0, 1, 0, NULL, '2014-11-02 21:31:08', NULL, NULL, 1),
(53, 'lexan', 6, 'category', NULL, 1, 0, 'LEXAN - komorové, tepelně izolační stabilní desky s UV ochranou', '', '', 0, 0, 1, 0, NULL, '2014-11-14 11:46:41', '2014-11-18 17:05:32', NULL, 1),
(54, 'celosklenene-steny', 14, 'detail', NULL, 1, 0, 'Prosklené fasády', '', '', 0, 0, 1, 0, NULL, '2014-11-14 11:59:20', NULL, NULL, 1),
(55, 'dencop-sound-protect', 14, 'detail', NULL, 1, 0, 'DENCOP SoundProtect', '', '', 0, 0, 1, 0, NULL, '2014-12-01 16:15:57', '2014-12-01 16:22:07', NULL, 1),
(56, 'oplasteni-budov-odvetratelne-fasady', 14, 'detail', NULL, 1, 0, 'Odvětratelné fasády', '', '', 0, 0, 1, 0, NULL, '2014-12-01 16:27:01', '2014-12-01 16:36:41', NULL, 1),
(57, 'frez', 6, 'category', NULL, 1, 0, 'Frez', '', '', 0, 0, 1, 0, NULL, '2014-12-04 09:36:59', NULL, NULL, 1),
(58, 'co-delame', 1, 'detail', NULL, 1, 0, 'Co děláme', '', '', 0, 0, 1, 0, NULL, '2014-12-13 18:25:38', NULL, NULL, 1),
(59, 'vyhody-spoluprace-s-nami', 1, 'detail', NULL, 1, 0, 'Výhody spolupráce s námi', '', '', 0, 0, 1, 0, NULL, '2014-12-13 18:26:04', NULL, NULL, 1),
(60, 'reference', 1, 'detail', NULL, 1, 0, 'Reference', '', '', 0, 0, 1, 0, NULL, '2014-12-13 18:26:23', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `module_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `submodule_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `value_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `value_subcode_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `value_subcode_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `poradi` int(11) NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=7 ;

--
-- Vypisuji data pro tabulku `settings`
--

INSERT INTO `settings` (`id`, `module_code`, `submodule_code`, `value_code`, `value_subcode_1`, `value_subcode_2`, `poradi`, `value`, `description`) VALUES
(1, 'page', 'item', 'photo', 't1', 'resize', 1, '600,336,Image::INVERSE', NULL),
(2, 'page', 'item', 'photo', 't1', 'crop', 2, '600,336', NULL),
(3, 'catalog', 'item', 'photo', 't1', 'resize', 1, '82,63,Image::WIDTH', NULL),
(4, 'catalog', 'item', 'photo', 't2', 'resize', 1, '158,120,Image::WIDTH', NULL),
(5, 'catalog', 'item', 'photo', 't1', 'ext', 2, 'png', NULL),
(6, 'catalog', 'item', 'photo', 't2', 'ext', 2, 'png', NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `shippings`
--

CREATE TABLE IF NOT EXISTS `shippings` (
`id` int(11) NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  `poradi` int(11) NOT NULL,
  `cenove_hladiny` tinyint(4) NOT NULL DEFAULT '0',
  `icon` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=9 ;

--
-- Vypisuji data pro tabulku `shippings`
--

INSERT INTO `shippings` (`id`, `cena`, `poradi`, `cenove_hladiny`, `icon`, `class`) VALUES
(1, '0.00', 1, 1, 'ico_ceska_posta', 'cz'),
(2, '0.00', 2, 1, 'ico_ppl', 'cz'),
(3, '0.00', 3, 1, 'ico_ppl', 'sk'),
(4, '0.00', 4, 1, 'ico_ceska_posta', 'cz'),
(5, '0.00', 5, 1, 'ico_ceska_posta', 'cz'),
(6, '0.00', 7, 0, 'ico_osobni_odber', 'cz'),
(7, '0.00', 6, 1, 'ico_geis', 'cz'),
(8, '0.00', 8, 1, 'ico_geis', 'sk');

-- --------------------------------------------------------

--
-- Struktura tabulky `shipping_data`
--

CREATE TABLE IF NOT EXISTS `shipping_data` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `zobrazit` tinyint(4) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=9 ;

--
-- Vypisuji data pro tabulku `shipping_data`
--

INSERT INTO `shipping_data` (`id`, `language_id`, `shipping_id`, `nazev`, `popis`, `zobrazit`) VALUES
(1, 1, 1, 'ČR - Česká pošta', '', 1),
(2, 1, 2, 'ČR - PPL', '', 1),
(3, 1, 3, 'SR - PPL', '', 1),
(4, 1, 4, 'ČR - Česká pošta - platba předem', '', 0),
(5, 1, 5, 'ČR - PPL - dobírka - platba předem', '', 0),
(6, 1, 6, 'Osobní odběr', '', 1),
(7, 1, 7, 'ČR - Geis', '', 1),
(8, 1, 8, 'SR - Geis', '', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `shipping_pricelevels`
--

CREATE TABLE IF NOT EXISTS `shipping_pricelevels` (
`id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `level` decimal(8,0) NOT NULL,
  `value` decimal(8,0) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Vypisuji data pro tabulku `shipping_pricelevels`
--

INSERT INTO `shipping_pricelevels` (`id`, `shipping_id`, `level`, `value`) VALUES
(28, 3, '3500', '220'),
(24, 5, '899', '90'),
(30, 7, '2500', '90'),
(27, 2, '2500', '105'),
(26, 1, '2500', '110'),
(29, 4, '2500', '105'),
(31, 8, '3500', '180');

-- --------------------------------------------------------

--
-- Struktura tabulky `shoppers`
--

CREATE TABLE IF NOT EXISTS `shoppers` (
`id` int(11) NOT NULL,
  `kod` varchar(64) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `nazev` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `telefon` varchar(32) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `ulice` varchar(64) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `mesto` varchar(64) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `psc` char(5) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `ic` varchar(64) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `dic` varchar(64) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `datum_registrace` datetime DEFAULT NULL,
  `price_category_id` int(11) NOT NULL,
  `order_total` decimal(12,2) NOT NULL,
  `logins` int(10) NOT NULL DEFAULT '0',
  `last_login` int(10) DEFAULT NULL,
  `newsletter` tinyint(4) NOT NULL DEFAULT '0',
  `firma` tinyint(4) NOT NULL DEFAULT '0',
  `smazano` tinyint(4) DEFAULT '0',
  `action_first_purchase` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=176 ;

--
-- Vypisuji data pro tabulku `shoppers`
--

INSERT INTO `shoppers` (`id`, `kod`, `username`, `password`, `nazev`, `email`, `telefon`, `ulice`, `mesto`, `psc`, `ic`, `dic`, `datum_registrace`, `price_category_id`, `order_total`, `logins`, `last_login`, `newsletter`, `firma`, `smazano`, `action_first_purchase`) VALUES
(8, '000008', 'pawel.herink@gmail.com', '2bab74cf93b7ead57e1c32e9593ea27302f600b9c7948d5d61', 'DG - tester', 'pawel.herink@gmail.com', '123456789', 'tester', 'tester', '50000', '', '', NULL, 4, '1926.06', 24, 1384244526, 0, 0, 1, 0),
(9, '000009', '', 'a2a2dd45d4b42702dfef921d90fadd5bc72e7d62b42548f941', 'tester', 'tester2@tester.cz', '123456', 'Jungmannova 1398', 'Hradec Králové', '50002', NULL, NULL, NULL, 0, '0.00', 2, 1384190333, 0, 0, 1, 0),
(10, '000010', '', '9e3d50f4b5bce2bf7b064cac3838026a46208305fb64c35458', 'tester', 'tester3@tester.cz', '123456', 'jun', 'pardubice', '12346', NULL, NULL, NULL, 0, '0.00', 1, 1349872573, 0, 0, 1, 0),
(11, '000011', '', 'b025e9278498fc09a98c861f7953a726c356cc6ae22f9a89ea', 'tester 3', 'tester4@tester.cz', '986352147', 'ulice 2', 'Pardubice', '12345', NULL, NULL, NULL, 0, '0.00', 1, 1350499719, 0, 0, 1, 0),
(12, '000012', '', '30dd6d7faa7ee8c85c622aed7cc2a9183f7238d412a4762dc7', 'tester 2', 'tester2@tester2.cz', '123968574', 'testovací', 'Hradec Králové', '45698', NULL, NULL, NULL, 0, '0.00', 2, 1350562647, 0, 0, 1, 0),
(13, '000013', '', 'b6f31b8965cb8d6bd33ea5f8b31bdb658096efea85d3de5536', 'Tomáš Hečko', 'tomas@hecko.cz', '608143363', 'Bydlim 12', 'Zlín', '760 0', NULL, NULL, NULL, 0, '0.00', 2, 1354223602, 0, 0, 1, 0),
(14, '000014', 'daniel.gregurek@dgstudio.cz', '2aef0c2729aa2ecca257d1e9d6e934602749c26a88abf2fe6c', 'Daniel Gregůrek', 'daniel.gregurek@dgstudio.cz', '608270128', 'Nova 1091', 'Zlín', '76001', '', '', NULL, 2, '1125.00', 9, 1387292369, 0, 0, 1, 0),
(15, '000015', '', '83987a60611e581021d4894707f338291dd36b609936abbfb2', 'Testovací registrace', 'test@test.cz', '123456456', 'Test 12345', 'Hradec Králové', '12345', '', '', NULL, 1, '940.00', 3, 1379834702, 0, 0, 1, 0),
(16, '000016', '', '921bb76de6e70a09a27171c99c48fe0fbf998fcb94adf8d543', 'Eva Mikšovičová', 'eva.miksovicova@seznam.cz', '60270600', 'filmová 174', 'Zlín', '76001', '', '', NULL, 4, '35178.12', 5, 1355775253, 0, 0, 1, 0),
(18, '000018', '', 'c11c208770898aa4a66df0df8443dfb50a93509090f76cddf1', 'Eva Mikšovičová', 'ad@ad.cz', '60205', 'sf 26', 'zlín', '76001', '', '', NULL, 0, '0.00', 1, 1355432932, 0, 0, 1, 0),
(19, '000019', '', '95a54955aa5bac10c47e037e8b62fee0ace5a5373c3013f4c5', 'Eva Mikšovičová', 'ferlinga@seznam.cz', '60205', 'filmová 174', 'zlín', '76001', '', '', NULL, 0, '0.00', 1, 1355433149, 0, 0, 1, 0),
(20, '000020', '', '90c5be75f799d6dc377f817b5cca1429cd0872fea2a6c7fc90', 'Petr Jonáš', 'info@dgstudio.cz', '608270127', 'nova1090', 'Zlín', '76789', '', '', NULL, 0, '0.00', 1, 1355439859, 0, 0, 1, 0),
(28, '000028', '', 'a3ccf5c5ec0cb276a216752d96b42d0db8f1ffa5c0d8957b54', 'Iveta Reisingerová', 'ivetrei@seznam.cz', '776332117', 'Drážďanská 136', 'Děčín XVII', '40502', '', '', NULL, 0, '1204.00', 1, 1355775364, 0, 0, 1, 0),
(26, '000026', '', '4d39ff79f2b7c1c4c722ab01467fba24d93d57bdaf5ed36b20', 'zkusebni uzivatel', 'jan.vanasek@dgstudio.cz', '123456789', 'u zimniho stadionu 1095', 'zlín', '76001', '', '', NULL, 0, '0.00', 2, 1355603396, 0, 0, 1, 0),
(27, '000027', '', '9505c334aefddc0d14bd46dc6a5f0bd5c19c8e5d23fade50e4', 'dgstudio', 'vanasek@dgstudio.cz', '775375060', 'u zimniho stadionu 1095', 'zlín', '76001', '', '', NULL, 0, '0.00', 1, 1355604135, 0, 0, 1, 0),
(29, '000029', '', '3b3e4d6a81171d49de1050ea483c07627ecffd9db756e0b0cf', 'Věra Řezníčková', 'VReznickova@seznam.cz', '577056327', 'Filmová 174', 'Zlín', '76001', '', '', NULL, 0, '0.00', 1, 1355812732, 0, 0, 1, 0),
(30, '000030', '', 'c55cb0f15919253ccb612b3650acc1aeab6a44c85724b933c8', 'Monika Wildnerová', 'jovena@jovena.cz', '608332045', 'Provaznická 1646', 'Šenov', '73934', '73961370', '', NULL, 0, '822.00', 1, 1355907679, 0, 0, 1, 0),
(31, '000031', '', '3189908b017e025a677345d56e9e52f7ba50cee3e957fd204f', 'Marie Jůnová', 'juna.pe@post.cz', '608955544', 'Růžová 39', 'Pelhřimov', '39301', '', '', NULL, 0, '461.00', 2, 1356863725, 0, 0, 1, 0),
(32, '000032', '', '7dde23bb4c5ebb7dfc295028714932667c79a6c5ec7cab977a', 'Táňa Roztomilá', 'pav.mon@seznam.cz', '603746446', 'J.Opletala968', 'Frýdek-Místek', '73801', '', '', NULL, 0, '0.00', 1, 1357667785, 0, 0, 1, 0),
(33, '000033', '', 'a65c6ed8889e9a77379fa3ad81d26c9c41c1d3acc48dc1b55d', 'Lenka Matušková', 'obchod@ciob.cz', '606713739', 'Pavlovova 2626', 'Ostrava', '70030', '25860348', 'CZ25860348', NULL, 0, '0.00', 1, 1357821117, 0, 0, 1, 0),
(34, '000034', '', 'e1ed745cab3b9c6c0277d45d28b1d8a6cec92dc8db3abaa23f', 'Jana Lisá', 'jana.lisa@seznam.cz', '608850218', 'Růžová 5220', 'Chomutov', '43004', '', '', NULL, 0, '1081.40', 1, 1358244522, 0, 0, 1, 0),
(35, '000035', '', '4ba43f9bcf8b93ad6193a798862d6f4d7d4fa1a4145f67d0f7', 'Jarmila Papežová', 'jar.papezova@seznam.cz', '737872500', 'Dukelska 21', 'As', '35201', '', '', NULL, 0, '0.00', 1, 1358327867, 0, 0, 1, 0),
(36, '000036', '', 'f49e18a33f7f987f42ad6d6c4254a625b0376c143020b61ecb', 'Ing. Petr Milek', 'vapez@volny.cz', '608 814 289', 'Akátová 1073', 'Rychvald', '73532', '', '', NULL, 0, '1203.46', 1, 1358713556, 0, 0, 1, 0),
(37, '000037', '', '5d674976f9431dc03d2f0d63f5936211f5484343e954503d49', 'Alice Pražáková', 'prazakovaalice@seznam.cz', '312246339, 776810783', 'Ctiborova 407', 'Kladno ', '27201', '', '', NULL, 0, '1470.72', 1, 1359104693, 0, 0, 1, 0),
(38, '000038', '', 'ab9f9cdb4ed87ed9cf87f0a1111fe1b668b3d46c4d14edf26d', 'Michaela Abrahamova', 'misaabr@seznam.cz', '608870913', 'Na Sidlisti 366', 'Libice nad Cidlinou', '28907', '', '', NULL, 0, '297.59', 1, 1360191164, 0, 0, 1, 0),
(39, '000039', '', 'c0d34d30b307ff5757896acb12941a3d72926858160268197d', 'Dagmar Novakova', 'dagmar-nina@seznam.cz', '776007283', 'Vsechlapy 78', 'Nymburk', '28802', '', '', NULL, 0, '0.00', 1, 1360191527, 0, 0, 1, 0),
(40, '000040', '', '3c8adabcc863e492c0ffd3735d2f3641275cededd9af73100c', 'Štěpánka Červenková', 'stepanka.cervenkova@gmail.com', '602861694', 'Hyacintová 117', 'Průhonice', '25243', '', '', NULL, 2, '4876.06', 6, 1388564181, 0, 0, 1, 0),
(41, '000041', '', 'e10b67f50bcb640a1542908f2fb8e6ae0bae7b08f1b7367b86', 'Josef Janicek', 'skolnickovi@seznam.cz', '737834766', 'Zakladni skola Sychrov 97', 'Vsetin', '75501', '', '', NULL, 0, '2016.63', 2, 1382032994, 0, 0, 1, 0),
(42, '000042', 'm.hejlkova@seznam.cz', 'bb585a02dccaad5a27e40b6d41cef8c2702e5e9d722a99c99e', 'Michaela Hejlková MVDr.', 'm.hejlkova@seznam.cz', '+420604360319', 'Hliníky 4398/7a', 'Prostějov', '79601', '70553424', '', NULL, 0, '576.00', 3, 1360920591, 0, 0, 1, 0),
(43, '000043', '', 'd329fc32c148701d38c971737c05cced02559f7d2c9c211b78', 'Ilona Vinklerová', 'ilonavinklerova@seznam.cz', '607112152', 'Klimentovská 230', 'Velká Hleďsebe', '354 7', '', '', NULL, 0, '1162.08', 1, 1362155633, 0, 0, 1, 0),
(44, '000044', '', '454d339b33a4370d1ae9553ff6b7b0068e4eaf2fbd9bb6e8ce', 'Monika Korotvičková', 'monika.kkkk@seznam.cz', '608880119', 'U nákladového nádraží 6', 'Praha', '13000', '', '', NULL, 0, '1536.35', 2, 1363342504, 0, 0, 1, 0),
(45, '000045', '', '0ea0ae9084f0ff60cb7e546edd5f7926ef6c9daf221462473c', 'Barbora Hejtmánková', 'bhejtman@gmail.com', '731351227', 'Podlesí IV 534 ', 'Zlín', '760 0', '', '', NULL, 0, '0.00', 2, 1370421394, 0, 0, 1, 0),
(46, '000046', '', 'aac5d2d2036cdbfe35ea97cfd63605db5895c0c4a9ff6c760d', 'Bohuslava Minaříková', 's.min@seznam.cz', '603351220', 'Velenice 122', 'Dymokury', '28901', '', '', NULL, 0, '494.29', 1, 1364652631, 0, 0, 1, 0),
(47, '000047', '', '77119e4f730030fcc05fbc2faa02ac873d66eda34b9218eb41', 'Miriam Straubová', 'ekonomkomerc@gmail.com', '602134713', 'Zárybská 665', 'Praha 9', '190 0', '', '', NULL, 0, '2087.16', 1, 1364756538, 0, 0, 1, 0),
(48, '000048', '', '754bd64032bb0df2ba598b396306c1db6e80476ce48f33a985', 'Milan Babáček', 'standup@centrum.cz', '604 192 638', 'Na Podlesí 1414', 'Kadaň', '43201', '', '', NULL, 0, '413.60', 2, 1366836699, 0, 0, 1, 0),
(49, '000049', '', 'e3173095a2502bdf220718f32d8ff14345e3edaea11972bd4d', 'Vanda Kubienova', 'vanda.kubienova@seznam.cz', '774237884', 'Jaselská 1 ', 'Havířov-město', '73601', '73899976', '', NULL, 2, '2882.81', 1, 1366548639, 0, 0, 1, 0),
(50, '000050', '', '0d888d1082e4b1c885b9ab621ac565c6a3c872f70869e8528a', 'Sergey Medvedev', 'dolni8888@seznam.cz', '+420773646988', 'Chlupacova1176/12,apart.411', 'Praha 5 Hlubocepy', '15200', '', '', NULL, 0, '610.30', 1, 1366868749, 0, 0, 1, 0),
(51, '000051', '', 'c8ce039f01714e3e04662b87eb7fa976e79380e6780aaf8fb2', 'Monika Wildnerová', 'monikawi@seznam.cz', '608332045', 'Provaznická 1646', 'Šenov', '73934', '73961370', '', NULL, 2, '3274.12', 4, 1385832024, 0, 0, 1, 0),
(52, '000052', 'e.sajdlerova@seznam.cz', 'ce033cf1ab06e1f6012363f0137efece3c724dfb9e4336c9d4', 'Eva Sajdlerová', 'e.sajdlerova@seznam.cz', '731 119 245', 'Důl Libušín 654', 'Libušín', '273 0', '', '', NULL, 0, '410.00', 1, 1368432899, 0, 0, 1, 0),
(53, '000053', '', 'bb93bfb147ff59e86e8eed5451035b750e9a6ce06e134123e3', 'Barbora Hejtmánková', 'hejtmankova@noventis.cz', '731 351 227', 'Podlesí IV 5349', 'Zlín', '760 0', '', '', NULL, 0, '0.00', 1, 1368434885, 0, 0, 1, 0),
(54, '000054', 'f1308631@rmqkr.net', '6ba681499ddbdedcacf26a5366c804d771939602f208796e17', 'Tester Testovič', 'f1308631@rmqkr.net', '603111222', 'Testov 123', 'Testov nad Lužnicí', '12300', '', '', NULL, 0, '0.00', 1, 1369773553, 0, 0, 1, 0),
(55, '000055', '', '80a4e082bdc250ccfa9bfe1aa8666510b7b5bd657f0460424f', 'Blanka Křižáková', 'blanka.krizak@email.cz', '724538201', 'Bří. Čapků 25', 'Hodonín', '69501', '', '', NULL, 0, '2120.00', 3, 1381752448, 0, 0, 1, 0),
(56, '000056', '', '3cc04da3244b5a47cf431318f688013347e0ebc983736b4fdc', 'Naděžda Procházková', 'NaduleNada@seznam.cz', '732166142', 'Zaříčany 34', 'Čáslav', '28601', '', '', NULL, 0, '0.00', 2, 1370233810, 0, 0, 1, 0),
(57, '000057', '', 'bccf58d7dbfbb70e3fd4cfff451e6f70e931beab19dd45e47b', 'Naďa Zbořilová', 'nadka.mamka@seznam.cz', '554714437', 'Miloticen/op159', 'Bruntál', '79201', '', '', NULL, 0, '0.00', 1, 1373089187, 0, 0, 1, 0),
(58, '000058', 'horvathovaanezka33@azet.sk', '6dd483105d5dbf3fac624170b06ce4cc1304adf4fa7469b1b9', 'Anežka Horváthová', 'horvathovaanezka33@azet.sk', '0940822510', 'bratislavská36/33', 'Blatné', '90082', '', '', NULL, 0, '0.00', 1, 1374148917, 0, 0, 1, 0),
(59, '000059', '', '0a5aee109f0e3359599dd6bee082936e652414cf8aced81233', 'Vlasta Kerplová', 'vlasta.drechselova@centrum.cz', '725 716 693', 'Libuň 173', 'LIBUŇ', '507 1', '', '', NULL, 0, '0.00', 1, 1374699525, 0, 0, 1, 0),
(60, '000060', '', '106fe8f4f683f0a9417e42bb18be157369f543c151af34f58b', 'Ivana Micková', 'ivamic@seznam.cz', '607509828', 'Na Výhledech 346', 'Jesenice', '25242', '', '', NULL, 0, '1242.00', 1, 1375457659, 0, 0, 1, 0),
(61, '000061', '', '5459205dd9f8843b9bdf0127c47d828cc7e69b20a0b155c5ed', 'Ivana Verešová', 'valinavalina@seznam.cz', '775199830', 'J.z Poděbrad 2589', 'Pardubice', '53002', '', '', NULL, 0, '454.00', 1, 1376329867, 0, 0, 1, 0),
(62, '000062', '', 'a424293321b45301ba871740812e6fbc17e572afbf2da3b9d2', 'Marcela Helísková', 'heliskovamarcela@seznam.cz', '775145765', 'Sv.Čecha  20', 'Hodonín', '69501', '', '', NULL, 0, '144.00', 1, 1376389662, 0, 0, 1, 0),
(63, '000063', '', '8c61794c6f23f659f1a11b9ef3e18ee2741d8fd3eec57b0980', 'vlastimil louma', 'loumavl@seznam.cz', '605115273', 'ohnišov', 'ohnišov', '51784', '', '', NULL, 0, '1484.00', 5, 1386704026, 0, 0, 1, 0),
(64, '000064', '', '84e9a36a5b5803f1ae16ad78b86bca71afd697e2dccc229e7b', 'Romana Spolková', 'procanis@seznam.cz', '775948531', 'Rooseveltova 333/34', 'Říčany', '251 0', '71135201', 'CZ6462151333', NULL, 0, '1148.00', 1, 1377679641, 0, 0, 1, 0),
(65, '000065', '', 'a5cb76dbae51421f5994bbcc8d3465c2e4c1b43508b226b39f', 'dgstudio', 'daitko@seznam.cz', '608025589', 'nova 1090', 'Zlín', '47600', '', '', NULL, 1, '0.00', 6, 1389002411, 0, 0, 1, 0),
(66, '000066', '', '84c6320178c2c459e125cd4a5db69cd8028f17712029cbe417', 'test', 'spam@vzak.cz', '123456769', 'test', 'test', '50000', '', '', NULL, 0, '0.00', 3, 1380010688, 0, 0, 1, 0),
(67, '000067', '', '8c7ad03c925177d9efd8d1f6942f10a33e42ba572ac6d62b1c', 'Ilona Prášilová', 'prasilova.ilona@seznam.cz', '731173042', 'Malá Úpa 104', 'Malá Úpa', '54227', '', '', NULL, 0, '678.00', 1, 1380099513, 0, 0, 1, 0),
(68, '000068', 'valousek@gmail.com', 'a81c3929d397f0e1013fbc0b63110c9d36acee7f6ef412fac4', 'Jiri Valousek', 'valousek@gmail.com', '602601020', 'Slatiny 397', 'Zlin', '76302', '', '', NULL, 0, '0.00', 13, 1389707312, 0, 0, 1, 0),
(69, '000069', '', '49a63941c871f56abc6f9288a696e9ab19c0c260ac70b2172f', 'Ladislav Červinka', 'ladislav.cervinka@upol.cz', '608084007', 'Rožňavská 673/18', 'Olomouc', '779 0', '', '', NULL, 0, '923.00', 1, 1380795728, 0, 0, 1, 0),
(70, '000070', '', '5150633e72ddf055f22af8540b4dd0c4a74df482e7c86b8078', 'Světla Marešová', 'maresova@benatky.cz', '739418434', 'Kochánky 74', 'Kochánky', '29474', '', '', NULL, 0, '0.00', 1, 1380801506, 0, 0, 1, 0),
(71, '000071', 'eleonnora@seznam.cz', 'fe0736f5c95f198d8169d8f6d263a647c14761fbef9251c25e', '720253827', 'eleonnora@seznam.cz', '720253827', 'Slejharova 36', 'Nova Paka', '50901', '', '', NULL, 0, '297.00', 2, 1381002924, 0, 0, 1, 0),
(72, '000072', '', '31d0accd0d857138274e9bc6a8a9e8bd60482b217dc888e0c1', 'Lada Vaněčková', 'vaneckova@monza.cz', '606723573', 'U Vrby 662', 'Slušovice', '763 1', '', '', NULL, 0, '1013.00', 1, 1381138364, 0, 0, 1, 0),
(73, '000073', '', '6e1aa063256f6fa9fe72a3e7193534a0f21d8a144f946e042c', 'Eva Pařilová', 'e.kozlov@seznam.cz', '775116124', 'Kozlov 128', 'Velký Beranov', '58821', '', '', NULL, 0, '432.00', 1, 1381388356, 0, 0, 1, 0),
(74, '000074', '', '23f629cb34ad24ba493ad0cb0e28c63987670854ed7853f247', 'Marcela feketeová', 'feketeova@flaga.cz', '607809245', 'Gen. Peřiny 31', 'Hustopeče', '69301', '', '', NULL, 0, '227.00', 1, 1381479463, 0, 0, 1, 0),
(75, '000075', '', '32595d2e3e5b8ed98ff11291bda0629327909cc882efb727ee', 'Marcela Mundil', 'marcela.hyncicova@email.cz', '739045572', 'Jungmannova 672', 'Hranice', '753 0', '', '', NULL, 0, '1325.00', 1, 1381483514, 0, 0, 1, 0),
(76, '000076', '', '8c9ded28ff560502fd58d509d9e83e0300ed65426370108c41', 'Jaroslava Labuťová', 'jaroslava.labutova@centrum.cz', '728856944', 'Červeného kříže 2431', 'Česká Lípa', '47006', '', '', NULL, 0, '1101.12', 1, 1381563510, 0, 0, 1, 0),
(77, '000077', '', '24502bab2c44d6c886a27b4d1876bfab4b8898850135109011', 'Martina Orságová', 'orsago@seznam.cz', '603979972', 'Kúty 4076', 'Zlín', '76001', '', '', NULL, 0, '0.00', 2, 1383658685, 0, 0, 1, 0),
(78, '000078', '', '5000feba93edf2e49e8402eecaf91a87f0f37511e76fe5f48c', 'Martin Krajča ', 'objednavky@noventis.cz', '737903698', '2', 'Sušice', '687 0', '', '', NULL, 0, '176.00', 1, 1382351128, 0, 0, 1, 0),
(79, '000079', '', '59b0144fb4a1a17f700903545be599a22fe4d3e773489f114c', 'Jana Novotná', 'iweb@seznam.cz', '602601020', 'Testovaci 123', 'Ostrava', '12345', '', '', NULL, 0, '0.00', 1, 1382448903, 0, 0, 1, 0),
(80, '000080', '', 'bbe884129e6a36e06c13b327bef08075bd7ff434fe286c0696', 'Pavel Černý', 'fake_user@cubio.cz', '602602601', 'Testovaci 123', 'Testov', '12345', '123456', '', NULL, 1, '0.00', 1, 1382449274, 0, 0, 1, 0),
(81, '000081', '', '040cb1e73c1fa8e15479a50b711647ab94be5da5af3c0b83d6', 'Jiri Valousek', 'v.alou.sek@gmail.com', '602601020', 'test', 'testov', '12345', '', '', NULL, 0, '0.00', 2, 1382529974, 0, 0, 1, 0),
(82, '000082', '', '5e2f3aea9f89b22d8118f15e51ae7c967fa68beace20fbfcec', 'Ivana Nováková-jednotka 48 HI-TEC', 'ivanovka@seznam.cz', '604586478', 'Zamenhofova 440-Fashion Arena ', 'Praha 10 - Štěrboholy', '108 0', '', '', NULL, 0, '227.00', 1, 1382700632, 0, 0, 1, 0),
(83, '000083', '', '3734ba2a537001dc7d87a8390ab66cb1ff0a4ec1c08c5ac199', 'Věra Sedláková', 'sed.se@seznam.cz', '739088862', 'Pod Mlejnkem 202', 'Čelákovice, Sedlčánky', '25088', '', '', NULL, 0, '0.00', 2, 1382708691, 0, 0, 1, 0),
(84, '000084', '', '36338262ed16e62ccb998c74815222779358e7801f45f20247', 'bohuslav smejkal', 'bohous.smejkal@seznam.cz', '777285021', 'dolni trebonin 213', 'dolni trebonin', '38201', '', '', NULL, 0, '144.00', 1, 1382896299, 0, 0, 1, 0),
(85, '000085', '', '369c3518e52d1b95c562539b9097a40c8c46772975558adc65', 'Kurt Schoniger', 'kurtschoniger@seznam.cz', '774121137', 'Konečná 2', 'Karlovy Vary', '36005', '', '', NULL, 0, '966.00', 2, 1383661893, 0, 0, 1, 0),
(86, '000086', '', '2fd9e41ffc03d30c8ae70288812c8b435728d58955eef70483', 'Milan Hradecký', 'milan.hradecky@email.cz', '725 779 742', 'Zápy 244', 'Zápy', '250 0', '', '', NULL, 0, '0.00', 1, 1383131773, 0, 0, 1, 0),
(87, '000087', '', '4387ab9977e0b84f0fcf5de5ad897bf64c43f9a24875d4a555', 'jiri.loda@quick.cz', 'jiri.loda@quick.cz', '+420603413497', 'Masarykova 526', 'Zeleneč', '25091', '', '', NULL, 0, '550.56', 1, 1383602329, 0, 0, 1, 0),
(88, '000088', '', '237e3be13a828d6f8cda609ac9593172b2abe0b14adedf244b', 'Marta Doleželova', 'martadolezelova@email.cz', '605299070', 'SNP 1178', 'Otrokovice', '76502', '', '', NULL, 0, '0.00', 1, 1384198230, 0, 0, 1, 0),
(89, '000089', '', '694ce93c11239b28f45a0609c520e7f3fb98c51a1da6ce38ff', 'Doleželová Marta', 'hejtmankova1@noventis.cz', '605299070', 'SNP 1178', 'Otrokovice', '76502', '', '', NULL, 0, '454.00', 1, 1384352221, 0, 0, 1, 0),
(90, '000090', '', '6692c9a1586676f6fccfa0ecd59f986894d1791fe9ae72dd70', 'Alice Michková', 'alice.michkova@seznam.cz', '604425356', 'Pavla Beneše 742/18', 'Praha', '19900', '', '', NULL, 0, '0.00', 1, 1384370751, 0, 0, 1, 0),
(91, '000091', '', 'c4dfa91c5c90c8279f6178750fe23649ba604f2290fd3306be', 'Anna Tomanová', 'a.tomanova@tsrcr.cz', '606 096 604', 'Květná 71', 'Plzeň', '326 0', '', '', NULL, 0, '920.00', 2, 1385017624, 0, 0, 1, 0),
(92, '000092', '', 'c349644299169c2852af3900a785187ecbab2364ef3a1c42fe', 'Petra Myšková', 'MyskovaPet@seznam.cz', '732459477', 'Vodní 105', 'Zlín', '76001', '72437359', '', NULL, 0, '903.23', 2, 1386220490, 0, 0, 1, 0),
(93, '000093', '', 'c5fe3f145fee7e206624c6cc13c2cb107dc381cd4f5d1e3703', 'Jan Brhel', 'brhel@atlas.cz', '+420604513403', 'Valachův žleb 4889', 'Zlín', '76005', '', '', NULL, 0, '0.00', 1, 1384951474, 0, 0, 1, 0),
(94, '000094', '', 'eb8ab6ffdc519b5c49632010c2b94c12b1bfe8cee7712edec0', 'tester', 'pherink@seznam.cz', '123456789', 'testovaci 1234', 'hk', '12345', '', '', NULL, 0, '0.00', 4, 1386405630, 0, 0, 1, 1),
(95, '000095', '', 'dc4366de11bf49ea14e1c2b200d7d1e65cc14241eb8b2f63ff', 'Daniel Greugrek', 'daniel.gregurek@gmail.com', '608270127', 'Nova', 'ZLIN', '76001', '', '', NULL, 0, '0.00', 1, 1385669352, 0, 0, 1, 0),
(174, '000174', '', '7bdfee2729faf86a034bad6fd23e3563d8513df0e0c25d36b0', 'Ondřej Brabec', 'ondrej.brabec@dgstudio.cz', '731826584', 'Purkyňova 326', 'Hlinsko', '53901', '', '', NULL, 0, '0.00', 1, 1403534566, 0, 0, 0, 0),
(97, '000097', '', '3db589ed51cc89086b12079bd44cac8b2bed20c37e1751a04e', 'Petr Okruhlica', 'Petr.Okruhlica@seznam.cz', '607787760', 'U vršovického nádraží 873/2', 'Praha 10', '10100', '', '', NULL, 0, '1049.00', 2, 1385894987, 0, 0, 1, 0),
(98, '000098', '', 'b109cea4db145ee0631257d7b9b34aa45f149982d67b817487', 'Jiri Valousek', 'val.ousek@gmail.com', '602601020', 'Testovaci 123', 'Zlin', '12345', '', '', NULL, 0, '0.00', 1, 1386071280, 0, 0, 1, 1),
(99, '000099', '', 'b03afa06e81028fcab17afcf285fb960263f352b9e4987cdf7', 'asdfa sdf', 'valousek@cubio.cz', '123456789', 'asdfg', 'asdg', 'adsg', '', '', NULL, 0, '0.00', 2, 1387378198, 0, 0, 1, 1),
(100, '000100', '', '7a0360da835285e4357cbfe26dff15d5089b4cfdbb48b8157e', 'test', 'v.alousek@gmail.com', '123456789', 'asdf', 'adg', 'dfads', 'a', '', NULL, 0, '0.00', 1, 1386147458, 0, 0, 1, 1),
(101, '000101', '', 'c3dd09ce025c2dbe705451a139c44360aaa3013f6832d5d76e', 'Václav Krsek ml.', 'vaclav_k@seznam.cz', '603310604', 'Hlavní 7', 'Příšovice', '46346', '', '', NULL, 0, '590.00', 2, 1386799276, 0, 0, 1, 0),
(102, '000102', '', 'ed6e17a9b8e75875b91252e5714b62791487ef1018f6a59486', 'tester', 'masnylukas@gmail.com', '60827012327', 'Test', 'Test', '76005', '', '', NULL, 0, '0.00', 1, 1386583181, 0, 0, 1, 0),
(103, '000103', '', 'f963bf95732ce650b3bf306902581cf895491286ea10edd510', 'tester', 'tester81@dgstudio.cz', '123456789', 'dfsdf', 'test', '12345', '', '', NULL, 0, '0.00', 1, 1386590908, 0, 0, 1, 1),
(104, '000104', '', 'e5d2fa658aba4113e4ce74acdbfd6ecab7d100954c7200c3ae', 'Pavlína Lacinová', 'p.888@centrum.cz', '777340033', 'Denisova 10', 'Přerov', '75002', '', '', NULL, 0, '0.00', 1, 1386667964, 0, 0, 1, 1),
(105, '000105', '', '48f76a028151600353b63b27d873f8abb11f056ef1aaa7d6eb', 'Jiri Valousek', 'valousek@textemo.com', '602601020', 'test', 'testov', '76302', '', '', NULL, 0, '0.00', 1, 1386672204, 0, 0, 1, 1),
(106, '000106', '', '300e934c948b560098ced615bfcf1c77e9ef12bc155fde8896', 'Martina Hanušová', 'martina.hanuska@seznam.cz', '721899295', 'Pražská 644', 'Kostelec nad Černými lesy ', '28163', '', '', NULL, 0, '0.00', 1, 1386739777, 0, 0, 1, 1),
(107, '000107', '', '74bcc2f26ef1034cc3c54f77f4ece15d3ca0d84ec4f46447c7', 'Michaela Hejlková MVDr.', 'pvet@centrum.cz', '+420604360319', 'Hliníky 4398/7a', 'Prostějov', '79601', '70553424', '', NULL, 0, '0.00', 1, 1386754673, 0, 0, 1, 1),
(108, '000108', '', '951599d40c67976bd8ba20d13a4c6e2f8405f01d231d70d6fa', 'Hana Pinkavová', 'hana.pinkavova@seznam.cz', '605705829', 'Filmová 299', 'Zlín', '76001', '40426203', 'CZ505805003', NULL, 0, '132.00', 1, 1386783235, 0, 0, 1, 0),
(109, '000109', '', '4853d07ecd5dd266cc8725f8a112394c6977a3c0786f5dfcab', 'Jana Eretová', 'eret@volny.cz', '724396714', 'Úherecká 376', 'Líně', '330 2', '', '', NULL, 0, '0.00', 1, 1386860042, 0, 0, 1, 1),
(110, '', '', '086dde22638ba28025f0a5abd2c08ccb7f120e9eecea84a65f', 'frantisek cepcek', 'cepcek.f@mramax.sk', '+421903448222', 'za kasarnou 1', 'bratislava', '83103', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(111, '000111', '', 'e6cd5265f9c3319054dfcfd25e67cd87cd4f2b25cf23495593', 'Vladimír Flegel', 'V.flegel@seznam.cz', '608471470', 'Rožňavská 13', 'Olomouc', '77900', '70041482', 'CZ801112', NULL, 0, '966.00', 1, 1387126704, 0, 0, 1, 0),
(112, '000112', '', '1e4e57313c0ca75ea1a3f9db37ab84a2ba96c6e5801de0f2d7', 'jiri bim', 'jiri.bim@dgstudio.cz', '666999999', 'Slovensko', 'Nitra', '78515', '', '', NULL, 0, '0.00', 1, 1387201653, 0, 0, 1, 1),
(113, '000113', '', 'cb0100d724ab403dfa361b1df7130d50fc47066b72613d4ee8', 'ANDREA ŠÍLOVÁ', 'silova.andrea@seznam.cz', '731453672', 'AXMANOVA 3761', 'KROMĚŘÍŽ', '76701', '', '', NULL, 0, '0.00', 1, 1387312344, 0, 0, 1, 0),
(114, '000114', '', '720f32f91b7c5022f8cb85f732d79445aa71597b4917596f9a', 'Veronika Komornikova', 'princeznickav@gmail.com', '+421903431928', 'Havelkova 8', 'Bratislava, Slovenska republika', '84103', '', '', NULL, 2, '3243.00', 1, 1387361073, 0, 0, 1, 0),
(115, '000115', '', '1653ee6e3f8df085881bca026626a254d68d1c8415b544f293', 'Marian Mittaš', 'marian_mittas@stonline.sk', '421905740438', 'J.Žirku 176/3', 'Prievidza', '97101', '', '', NULL, 0, '0.00', 1, 1387441610, 0, 0, 1, 0),
(116, '000116', '', 'a0d30621ecec79fc853033781e0c0845a40920ece1feae8f87', 'františek Křenek', 'frantisek.krenek@centrum.cz', '775407332', 'Březina 57', 'Březina u Moravské Třebové', '56923', '', '', NULL, 0, '393.00', 1, 1387815572, 0, 0, 1, 0),
(117, '000117', '', 'dc44f6fbc703da762ee77bad4287cf1156e3880092c9185138', 'Daniel Dunovský', 'danieldunovsky@email.cz', '736681914', 'Dr. Jiřího Fifky 871', 'Strakonice', '38601', '', '', NULL, 0, '180.00', 2, 1388066394, 0, 0, 1, 0),
(118, '000118', '', '2f39ce05014594f940b3cbe9aeced645c86fab0eb5cd182571', 'Gita Krajčová', 'Marketa747@seznam.cz', '603581757', 'Luční 8', 'Karlovy Vary', '360 1', '', '', NULL, 0, '0.00', 1, 1388134376, 0, 0, 1, 1),
(119, '000119', '', '4db8657ccfa171462f5f95eb3a14ecdeec048cee3635c791b2', 'Libor opavsky', 'liio@seznam.cz', '777707961', 'Školní 1300', 'Otrokovice', '76502', '', '', NULL, 0, '0.00', 1, 1388184380, 0, 0, 1, 1),
(120, '000120', '', '44b3255ff9d7dcff5c4edf8fb7d459d46448e6f8287673a4ac', 'Jana Halabalová', 'friendly.goldens@gmail.com', '775083890', 'kounicova 40', 'Brno', '60200', '', '', NULL, 0, '322.00', 1, 1388393991, 0, 0, 1, 0),
(121, '000121', '', 'b1ea30bbf29188bd16f2d7807cf3104423a961361595f51255', 'Edward McWilliam', 'edmcw@gtsi.sk', '00421903236371', 'Mostova 1/b', 'Bernolákovo', '900 2', '', '', NULL, 0, '0.00', 1, 1388426327, 0, 0, 1, 1),
(122, '000122', '', '5975c9b33db8170bf747763e98d27c11e9f842c43ea8a39978', 'Ilona Müllerová', 'imullerova@email.cz', '736763294', 'Kvítková 5279', 'Zlín', '76001', '63464390', 'CZ6953104158', NULL, 0, '0.00', 1, 1388435137, 0, 0, 1, 1),
(123, '000123', '', 'a198c570fc78a780f15851ee36293879126d80f0d9cf574493', 'Jiří  Hájek', 'hajek244@seznam.cz', '776667063', 'bratří Čapků 2818/31', 'Jihlava', '586 0', 'nemám', 'nemám', NULL, 0, '0.00', 1, 1388758692, 0, 0, 1, 1),
(124, '000124', '', '6b05a3fd42085f73dfc2b5986b7ed16b08c602f94b0f6d83a8', 'Jaroslava Stöcklová', 'fragolas@seznam.cz', '777043406', 'Řečička 772/III', 'Jindřichův Hradec', '377 0', '', '', NULL, 0, '0.00', 1, 1389086360, 0, 0, 1, 1),
(125, '000125', '', '47c6beed82a63ea74fda5898632b11633fe1a739f815f33ea1', 'Monika Okálová', 'monikacholastova@seznam.cz', '604616706', '1006', 'Zlín', '76001', '', '', NULL, 0, '0.00', 1, 1389172427, 0, 0, 1, 1),
(126, '000126', '', 'ac75c83e8604f3d948e04e395458cdc27e93dc410a2cb589e2', 'Jindřich Vízdal', 'jindrich@vizdal.net', '777767999', 'Čs.armády 4001/7', 'Kroměříž', '76701', '', '', NULL, 0, '166.00', 1, 1389374108, 0, 0, 1, 0),
(127, '000127', '', '1804f0c7964964e6e6b8cf2e1417607a9fc0fca14f6317945e', 'Jana Bultasová', 'jana.bultasova@seznam.cz', '736619075', 'F.X.Nohy 962', 'Dobřany', '33441', '', '', NULL, 0, '299.00', 1, 1389765988, 0, 0, 1, 0),
(128, '000128', '', 'ef47d725ff4f411395eb37c3c8d053734ead93bed29c85439d', 'Břetislav Staněk', 'breta.stanek@seznam.cz', '731718858', 'Bosákova 15', 'Ostrava', '72400', '', '', NULL, 0, '966.00', 2, 1389788230, 0, 0, 1, 0),
(129, '', '', 'a5db5764a3fe1b600823071829e96ef6086783e12b0f800734', 'Lukáš Neškoda', 'lukas.neskoda@seznam.cz', '603803503', 'Teplicka 346', 'Děčín', '40505', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(130, '000130', '62.alena@seznam.cz', '61ddde75d10deb636b542a61626315f569f7cde0be9ba14d5c', 'Alena Velecká', '62.alena@seznam.cz', '608748314', 'Halenkovice 401', 'Halenkovice', '76363', '', '', NULL, 0, '972.00', 1, 1389968437, 0, 0, 1, 0),
(131, '', '', 'e8151342e36e2584b8b2e6d3128937bafc1755bec6da3ef812', 'Lucie Sedláčková ', 'sedlackovalu@gmail.com', '602269764', 'Dukelská 417 ', 'Dvůr Králové n.L.', '54401', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(132, '', '', 'bec9b3c29212aa00c37b9d5dde53f9d65345c9e2c1e9800cce', 'Test', 'sedlackovalu@juta.cz', '444777888', 'Nova 1091', 'Zlín', '76002', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(133, '000133', '', '32a538d410930a4f2d9a5271265ec4d908ea918fc29e939388', 'Leona Brázdilová', 'lea.brazdilova@centrum.cz', '604749279', 'SNP 1172', 'Otrokovice', '76502', '', '', NULL, 0, '955.00', 1, 1390342446, 0, 0, 1, 0),
(134, '000134', '', '21dc90ea2f08eb54139ba12c6b926b8ef7fb22b92d16de3484', 'Jitka Kuchařová', 'j.kucharo@seznam.cz', '6O54O7764', 'SNP 1172', 'Otrokovice', '765 O', '', '', NULL, 0, '0.00', 1, 1390399336, 0, 0, 1, 1),
(135, '', '', 'a7808a9d9593ab979785df2e2db87b189d12105d11f0797e11', 'Martina Janoušková', 'marcejka.janouskovav@seznam.cz', '607274259', 'Čistá 179 ', 'Mladá Boleslav', '29423', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(136, '000136', '', '912809f49626b73f88c5b42c347bc1974460f8fa0487f844d7', 'Jarmila Polášková', 'jarmilajarmila@seznam.cz', '605012482', '21', 'Chropyně', '76811', '', '', NULL, 0, '1928.00', 1, 1390471263, 0, 0, 1, 0),
(137, '000137', '', '2e1877132c98248550bcba4d6e5268a2c75b91a971770642f3', 'Žaneta Kolouchová', 'zanet.n@seznam.cz', '603957708', 'Slezská 4766', 'Zlín', '76005', '', '', NULL, 0, '0.00', 1, 1390476391, 0, 0, 1, 1),
(138, '000138', 'marie.siarova@seznam.cz', '2148047628e602507b0269dc1f34477cfabd15ad2389cd3eeb', 'Marie Sitařová', 'marie.siarova@seznam.cz', '723663489', 'Hrusická 2514', 'Praha 4', '14100', '', '', NULL, 0, '171.00', 1, 1390825964, 0, 0, 1, 0),
(139, '000139', '', '1fa2f30e12c08667a6a1a30d1c9a4d3683e10c1661fa84bbf6', 'Viera Klimovska', 'vklimo@azet.sk', '0905850327', 'Nerudova 10/412', 'Nov=a Dubnica', '01851', '', '', NULL, 0, '428.00', 1, 1390976622, 0, 0, 1, 0),
(140, '000140', 'ifu@orangemail.sk', '7e1562eeff510afce77feefb6e2c2293351a2f5aa50b02a883', 'Ivan Fulajtar', 'ifu@orangemail.sk', '+421 905 524 527', 'Šandorova 8', 'Bratislava', '82103', '', '', NULL, 0, '0.00', 1, 1390987769, 0, 0, 1, 0),
(141, '', '', 'd7d775f01312892e75d3275b9a9343ad6608f0fed48c8968dd', 'Jana Hricova', 'hricovajana02@gmail.com', '0944010300', 'Karadzicova 16 - CBC V', 'Bratislava', '81109', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(142, '000142', '', '31b4bf7a7f5c2652e7a7ae6c23958029d5310cf78a85583d46', 'Šimon Klazar', 'simon.klazar@gmail.com', '723640400', 'Vajdova 931', 'Kutná Hora', '28401', '', '', NULL, 0, '0.00', 1, 1391269423, 0, 0, 1, 1),
(143, '000143', '', '80a8aa9bffeb1cce6bcd78e22996cf43079a3a185d9562f1a1', 'Lucie -Seidlová', 'lseidlova@gmail.com', '721659067', 'Zálešná 2/3402', 'Zlín', '76001', '', '', NULL, 0, '0.00', 1, 1391348328, 0, 0, 1, 1),
(144, '000144', '', '1582e7f8c97ba1133da01c366ed9255622454fb312ad7070f0', 'denisa zazvorkova', 'denicek88@seznam.cz', '733727050', 'svatojirska 43', 'libusin', '27306', '', '', NULL, 0, '400.31', 1, 1391425319, 0, 0, 1, 0),
(145, '', '', 'f04988ef0775c2cd9491f4499d497aa0ada52e3d571449e2f1', 'Martina Sojakova', 'cernucha@email.cz', '604808522', 'Dunovskeho 15', 'Praha 4', '14900', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(146, '', '', 'fa5b43428e3026dad8296092da54f363df8e165e7ce7e228c1', 'Eva Rybářová', 'rybarovae@seznam.cz', '723361759', 'Brněnská 13', 'Plzeň', '323 0', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(147, '000147', '', '375148bbb63b1f2b70ca1a34515120a7332829046bf388c3da', 'Jaroslav Švehla', 'j.svehla@ceska-muzika.cz', '773977207', 'M.Chlajna 3', 'České Budějovice', '37005', '', '', NULL, 0, '322.00', 1, 1391770743, 0, 0, 1, 0),
(148, '000148', '', '23c0537212f68007be7edec3fe92ed9a1197653180737163f9', 'EVA KOŘÁNOVÁ', 'koranova.e@seznam.cz', '608965099', 'Josefa Ševčíka 705/856', 'Most', '434 0', '42143101', 'CZ5960060524', NULL, 0, '1047.67', 1, 1391787728, 0, 0, 1, 0),
(149, '', '', '28e9312764dbbd1bbec102043c0a7a011266a8c1e958df495c', 'Lubomír Krejcar', 'lubomirkrejcar@seznam.cz', '773282828', 'Stavební 5', 'Brno', '60200', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(150, '000150', '', 'ff99591fd3743a666b7bf0c16726042e84361af035c9673860', 'Věra Jankovská', 'vera.jankovska@seznam.cz', '737921092', 'Pod Vodojemem 1245', 'Sušice', '34201', '', '', NULL, 0, '0.00', 1, 1391867175, 0, 0, 1, 1),
(151, '000151', '', 'e5a080f21009edecaa956bc9e72eb2cb312f172155033c9541', 'Magda Bednaříková', 'bednarikovamagda@seznam.cz', '723146295', 'Jabloňová 276', 'Hvozdná', '76310', '', '', NULL, 0, '568.00', 1, 1391967721, 0, 0, 1, 0),
(152, '000152', '', 'db4327b6fdad57b50d7b9ed7efd055d43e73cb144da0546712', 'antoni hornacek', 'hortonin@seznam.cz', '605547615', 'mirova 769', 'paskov', '73921', '', '', NULL, 0, '0.00', 1, 1392157782, 0, 0, 1, 1),
(153, '000153', '', '3c7a17c286e86062f531f337229e642ac7fa1c197633b10e9e', 'Miluška Vokrojová', 'milusev@centrum.cz', '604116373', 'Pnovice 72', 'Rožmitál pod Třemšínem', '26242', '', '', NULL, 0, '921.00', 1, 1392194124, 0, 0, 1, 0),
(154, '000154', '', 'e835f1be94876a64b31e7f10d376688a5d13171de993cf5354', 'Jiří Šebela', 'seboun@centrum.cz', '723505400', 'Kosmonautů 13', 'Jindřichův Hradec', '37705', '', '', NULL, 0, '163.00', 1, 1392487007, 0, 0, 1, 0),
(155, '000155', '', '3ec71a88fad570188b2fc91006399fe10319638a2cd3d9da51', 'Andrea Volfová', 'arsinoeprima@gmail.com', '603888261', 'Bojetická 272', 'Praha 9', '197 0', '', '', NULL, 0, '1428.00', 1, 1392492054, 0, 0, 1, 0),
(156, '000156', '', '646794f8d4bf569af3765e70e1816d132f84c479e58c5ec866', 'Zbyněk Jonáš', 'zbynekjonas@centrum.cz', '606830101', 'Staroměstské nám. 87', 'Mladá Boleslav', '29301', '', '', NULL, 0, '0.00', 1, 1392550628, 0, 0, 1, 1),
(157, '000157', '', 'd7b40614fd1d597014c5906fe87487cd70d9d317a607e4a97e', 'Radomir Weis', 'weisradomir1@gmail.com', '773177958', 'Lozibky 7', 'Brno', '61400', '', '', NULL, 0, '0.00', 1, 1392565266, 0, 0, 1, 1),
(158, '', '', 'd27a707c60a35b09b31cc3f62becdf89c51464c0bd8b31786a', 'Jaromír Háněl ', 'haneljaromir@seznam.cz', '487522331', 'Moskevská 688', 'Česká Lípa', '47001', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(159, '000159', '', '86da6f9fe6fd3e33fa3be971ccce657a9842909ab60504e603', 'dfs fdgsd', 'fdg@dsdfz.com', '555555555', 's gss 54', 'fdgfdsg', '88802', '', '', NULL, 0, '0.00', 1, 1394832297, 0, 0, 1, 1),
(160, '', '', '48fb318c120e2b8a68bfba138967bb3c511f4db63d36887993', 'DASD ASDASDSA', 'ASDFADSA@SDfaf.AAASFD', '544454541', 'ASFDASDASF 515 1', 'hAJDSNAJK', '53416', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(161, '', '', '31161108c329e17f7776dc5ea378d73c63b67356e0a026e6c1', 'DASD ASDASDSA', 'ASDFADSA@SDfaf.AAASFD', '544454541', 'ASFDASDASF 515 1', 'hAJDSNAJK', '53416', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(162, '000162', '', '18f5524e555bf14403a222a8c2102b5ca3f596c94dd7095ce1', 'Ondřej Brabec', 'kaktus.ob@gmail.com', '731826584', 'purkyňova 326', 'Hlinsko', '53901', '', '', NULL, 0, '0.00', 6, 1403550524, 0, 0, 1, 1),
(173, '000173', '', '486648cf6e65c14218c0bcdc8abf558f901e32954204a92b89', 'Lukáš Masný', 'lukas.masny@dgstudio.cz', '725809909', 'Nad Ovčírnou IV/344', 'Zlín', '76001', '', '', NULL, 1, '0.00', 17, 1408950526, 0, 0, 0, 0),
(164, '', '', '049e79e5694e01175073c0b0528f9a20d9da944f693c652e8c', 'Test', 'lukas.masny@gmail.com', '123456789', 'test', 'test', '12345', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 1, 0),
(165, '', '', 'f50334fb144d99646a25cf6abde4804871a587d6e54135acec', 'Test Test', 'Test@test.cz', '788999989', 'Test', 'Test', '44788', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 0, 0),
(166, '', '', 'a3d0ce35eb50e83e874874fb354d712de0156f5cf37ec6698d', 'Test Test', 'Test@test.cz', '788999989', 'Test', 'Test', '44788', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 0, 0),
(167, '', '', '8f88ee7de4eca076ea1dfb707b9454f1b6eff1c98f6d83f24f', 'Test Test', 'Test@test.cz', '788999989', 'Test', 'Test', '44788', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 0, 0),
(168, '', '', 'ba8c213bb29279208f642154766f35c801ce0623f56ec782a9', 'Test Test', 'Test@test.cz', '788999989', 'Test', 'Test', '44788', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 0, 0),
(169, '', '', '3f262b3087fdce797298b9191b083f4cd1e736091833303b16', 'Test Test', 'Test@test.cz', '788999989', 'Test', 'Test', '44788', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 0, 0),
(170, '', '', 'f86c3415d2ebc20983c911be3d95bcbe78dffe9151a6c028b3', 'Test Test', 'Test@test.cz', '788999989', 'Test', 'Test', '44788', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 0, 0),
(171, '', '', 'c0d50112291225828fd1b86b65c06cc3a3d582f5f4a4fae306', 'Test Test', 'kaktus.ob@gmail.com', '788999989', 'Test', 'Test', '44788', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 0, 0),
(172, '', '', 'df659018d22796d04e10b4afb6807ea1312783ce90fd5a2047', 'Test Test', 'kaktus.ob@gmail.com', '788999989', 'Test', 'Test', '44788', '', '', '0000-00-00 00:00:00', 0, '0.00', 0, 0, 0, 0, 0, 0),
(175, '000175', '', '9cad98fd1fb7447855f22f71b26f2c436292f01db53c01d7ca', 'Testovací test', 'masnylukas@seznam.cz', '123456789', 'grggevwtbnt', 'wrbttb', '12345', '', '', NULL, 0, '0.00', 1, 1404733872, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `shopper_branches`
--

CREATE TABLE IF NOT EXISTS `shopper_branches` (
`id` int(11) NOT NULL,
  `kod` varchar(64) COLLATE utf8_czech_ci NOT NULL DEFAULT '0',
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `telefon` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
  `ulice` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `mesto` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `psc` char(5) COLLATE utf8_czech_ci NOT NULL,
  `shopper_id` int(11) NOT NULL,
  `smazano` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=22 ;

--
-- Vypisuji data pro tabulku `shopper_branches`
--

INSERT INTO `shopper_branches` (`id`, `kod`, `nazev`, `email`, `telefon`, `ulice`, `mesto`, `psc`, `shopper_id`, `smazano`) VALUES
(1, '0', 'První pobočka', 'testpobocka1@tester.cz', '321654987', 'Jungmannova 1398', 'Hradec Králové', '50002', 8, 1),
(2, '0', 'První pobočka', 'pavel@pavel.cz', '123987654', 'Jungmannova 1398', 'Hradec Králové', '50002', 8, 0),
(3, '0', 'Druhá pobočka 2', 'pavel@pavel.cz', '321654987', 'Jungmannova 1398', 'Hradec Králové', '50002', 8, 1),
(4, '0', 'Druhá pobočka', 'pavel@pavel.cz', '321654987', 'Kašparova 35', 'Hradec Králové', '50002', 8, 0),
(5, '0', 'Třetí doručovací adresa', 'testpobocka1@tester.cz', '', 'Jeronýmova 12', 'fgdfg', '12345', 8, 0),
(6, '0', 'První pobočka edit 2', 'pavel@pavel.cz', '123987654', 'Jungmannova 1398', 'Hradec Králové', '50002', 8, 1),
(7, '0', 'Čtvrtá dodací adresa', 'testpobocka1@tester.cz', '123987654', 'Nějaké číslo popisné', 'Hradec Králové', '50002', 8, 0),
(8, '0', 'fdgdsfg', 'dfsgf@sdfgdsf.cz', '', 'dsfgsdfg', 'hradec králové', '45464', 15, 0),
(9, '0', 'Jovena', 'jovena@jovena.cz', '608332045', 'Novinářská 3', 'Ostrava', '709 0', 30, 0),
(10, '0', 'ESHOP', 'obchod@ciob.cz', '606713739', 'Na Výspě 12', 'Ostrava', '70030', 33, 0),
(11, '0', 'Tax Services Kladno s.r.o.', 'prazakovaalice@seznam.cz', '312246339', 'Ctiborova 407', 'Kladno', '27201', 37, 0),
(12, '0', 'Bylinářství', 'vanda.kubienova@seznam.cz', '774237884', 'Jaselská 1', 'Havířov-město', '73601', 49, 0),
(13, '0', 'Lenka Sajdlerová', 'e.sajdlerova@seznam.cz', '731 119 245', 'Smetanova 463', 'Libušín', '27306', 52, 0),
(14, '0', 'ohnišov', 'loumavl@seznam.cz', '605115273', 'ohnišov 199', 'ohnišov', '51784', 63, 0),
(15, '0', 'Hana Šlapová', 'marcela.hyncicova@email.cz', '', 'Rolavská 1225', 'Nejdek', '362 2', 75, 0),
(16, '0', 'Profi', 'milan.hradecky@email.cz', '725 779 742', 'Vosmíkových 16', 'Praha 8', '181 0', 86, 0),
(17, '0', 'Alice Michková (Weil)', 'alice.michkova@seznam.cz', '', 'Křižovnické nám. 193/2', 'Praha 1', '11000', 90, 0),
(18, '0', 'TSR Czech Republic', 'a.tomanova@tsrcr.cz', '606 096 604', 'Jateční 49', 'Plzeň', '30100', 91, 0),
(19, '0', 'Základní škola Dobřany', 'jana.bultasova@seznam.cz', '736619075', 'tř.1.máje 618', 'Dobřany', '33441', 127, 0),
(20, '0', 'Leona Brázdilová / HP TRONIC', 'lea.brazdilova@centrum.cz', '604749279', 'Prštné, Kútíky 637', 'Zlín ', '76001', 133, 0),
(21, '0', 'Jaroslav Švehla - Česká Muzika', 'j.svehla@ceska-muzika.cz', '773977207', 'Dubné 158', 'Dubné', '37384', 147, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `static_content`
--

CREATE TABLE IF NOT EXISTS `static_content` (
`id` int(11) NOT NULL,
  `kod` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `available_languages` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=3 ;

--
-- Vypisuji data pro tabulku `static_content`
--

INSERT INTO `static_content` (`id`, `kod`, `available_languages`) VALUES
(1, 'homepage-box', 1),
(2, 'homepage-contact', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `static_content_data`
--

CREATE TABLE IF NOT EXISTS `static_content_data` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `static_content_id` int(11) NOT NULL,
  `popis` text COLLATE utf8_czech_ci
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=3 ;

--
-- Vypisuji data pro tabulku `static_content_data`
--

INSERT INTO `static_content_data` (`id`, `language_id`, `static_content_id`, `popis`) VALUES
(1, 1, 1, '<h5>Chcete ušetřit až 30% PHM?</h5>\n\n<p>Praesent sit amet posuere magna. Phasellus accumsan libero sit amet neque vulputate, porta mollis nisl molestie. <a href="#header">Odkaz</a>.</p>\n\n<ul>\n	<li>Cras a vulputate sapien, duis quis suscipit sem.</li>\n	<li>Praesent id tincidunt tortor, consequat semper lectus.</li>\n</ul>\n'),
(2, 1, 2, '<h5>ORBCOMM CZECH REPUBLIC, s.r.o.</h5>\n\n<p>Kvítková 3642<br />\n760 01 Zlín</p>\n\n<p>&nbsp;</p>\n\n<p>IČ: 25574124</p>\n\n<p>&nbsp;</p>\n\n<ul class="small-block-grid-2">\n	<li class="tel">+420 123 456 789 &nbsp;</li>\n	<li class="fax">+420 123 456 789</li>\n	<li class="mobil">+420 123 456 789</li>\n	<li class="mail">info@orbcomm.cz</li>\n</ul>\n');

-- --------------------------------------------------------

--
-- Struktura tabulky `taxes`
--

CREATE TABLE IF NOT EXISTS `taxes` (
`id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `code` varchar(25) CHARACTER SET utf8 NOT NULL,
  `hodnota` tinyint(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `taxes`
--

INSERT INTO `taxes` (`id`, `nazev`, `code`, `hodnota`) VALUES
(1, 'žádná', 'no_vat', 0),
(2, 'nizší', 'lower_vat', 15),
(3, 'vyšší', 'higher_vat', 21);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(50) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`, `created_by`) VALUES
(5, 'info.vzak@gmail.com', 'hana', 'e67fcbdb1f94a7645d31ff55cbdcee5925b5ef1381e5b6f2e4', 305, 1391531214, 5),
(7, 'info@dgstudio.cz', 'dgstudio', '69142eb7316a41f4f72bba0eb52aeb748be1ed742669f98907', 397, 1418562605, 7),
(8, 'test@test.cz', 'tester', '11e1c076ca3f47fc3e066fcffa4ce12034c4790d0dcd89f3cf', 10, 1357536938, 5),
(9, 'uzivatel@mailserv.cz', 'uzivatel', '641e174c6b75d2ea06da2afe7db0c26311ee79a9ddf44fc044', 1, 1351685582, 8),
(12, 'antonin.hackenberg@gmail.com', 'tonda', '60cfee45f2b4d0a7ec136108300e1a9de4299a65e427c0d3e4', 6, 1407411476, NULL),
(13, 'marketing@dencop.cz', 'dencop', 'f3e884ab9b963e7882d1e187cf5bb82336733d33bed2091a2b', 11, 1417795442, 7);

-- --------------------------------------------------------

--
-- Struktura tabulky `user_admin_prefernces`
--

CREATE TABLE IF NOT EXISTS `user_admin_prefernces` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_preference_id` int(11) DEFAULT NULL,
  `value` varchar(10) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `user_log`
--

CREATE TABLE IF NOT EXISTS `user_log` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime_start` datetime NOT NULL,
  `datetime_end` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `user_rights`
--

CREATE TABLE IF NOT EXISTS `user_rights` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_name` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `permission` tinyint(11) NOT NULL DEFAULT '0',
  `readonly` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `user_tokens`
--

CREATE TABLE IF NOT EXISTS `user_tokens` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `vouchers`
--

CREATE TABLE IF NOT EXISTS `vouchers` (
`id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `discount_value` decimal(2,0) NOT NULL COMMENT 'sleva % z D0',
  `one_off` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'jednorazovy kupon',
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `used` int(11) NOT NULL DEFAULT '0' COMMENT 'pocet pouziti',
  `lifetime` date DEFAULT NULL,
  `shopper_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `discount_value`, `one_off`, `enabled`, `used`, `lifetime`, `shopper_id`) VALUES
(1, 'ghfjfgh64451bdfghgf', '10', 0, 1, 1, '2012-11-21', 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `admin_preferences`
--
ALTER TABLE `admin_preferences`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `admin_settings`
--
ALTER TABLE `admin_settings`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `admin_structure`
--
ALTER TABLE `admin_structure`
 ADD PRIMARY KEY (`id`), ADD KEY `parent_id` (`parent_id`) USING BTREE;

--
-- Klíče pro tabulku `admin_structure_data`
--
ALTER TABLE `admin_structure_data`
 ADD PRIMARY KEY (`id`), ADD KEY `language_id` (`language_id`) USING BTREE, ADD KEY `admin_module_id` (`admin_structure_id`) USING BTREE;

--
-- Klíče pro tabulku `articles`
--
ALTER TABLE `articles`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `article_data`
--
ALTER TABLE `article_data`
 ADD PRIMARY KEY (`id`), ADD KEY `language_id` (`language_id`,`article_id`) USING BTREE, ADD KEY `article_id` (`article_id`) USING BTREE, ADD KEY `route_id` (`route_id`) USING BTREE;

--
-- Klíče pro tabulku `article_downloads_articles`
--
ALTER TABLE `article_downloads_articles`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `article_photos`
--
ALTER TABLE `article_photos`
 ADD PRIMARY KEY (`id`), ADD KEY `zobrazit` (`zobrazit`) USING BTREE, ADD KEY `article_id` (`article_id`) USING BTREE;

--
-- Klíče pro tabulku `article_photo_data`
--
ALTER TABLE `article_photo_data`
 ADD PRIMARY KEY (`id`), ADD KEY `article_photo_id` (`article_photo_id`) USING BTREE, ADD KEY `language_id` (`language_id`) USING BTREE;

--
-- Klíče pro tabulku `banners`
--
ALTER TABLE `banners`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `banners_old`
--
ALTER TABLE `banners_old`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `banner_data`
--
ALTER TABLE `banner_data`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `parent_id` (`product_id`,`authorized`) USING BTREE;

--
-- Klíče pro tabulku `downloads`
--
ALTER TABLE `downloads`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `download_categories`
--
ALTER TABLE `download_categories`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `download_category_data`
--
ALTER TABLE `download_category_data`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `download_data`
--
ALTER TABLE `download_data`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `email_queue`
--
ALTER TABLE `email_queue`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `email_queue_bodies`
--
ALTER TABLE `email_queue_bodies`
 ADD PRIMARY KEY (`id`), ADD KEY `email_type_id` (`queue_email_type_id`) USING BTREE;

--
-- Klíče pro tabulku `email_receivers`
--
ALTER TABLE `email_receivers`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Klíče pro tabulku `email_settings`
--
ALTER TABLE `email_settings`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `email_types`
--
ALTER TABLE `email_types`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `email_types_receivers`
--
ALTER TABLE `email_types_receivers`
 ADD PRIMARY KEY (`id`), ADD KEY `email_type_id` (`email_type_id`,`email_receiver_id`) USING BTREE;

--
-- Klíče pro tabulku `eshop_settings`
--
ALTER TABLE `eshop_settings`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `faqs`
--
ALTER TABLE `faqs`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `faq_data`
--
ALTER TABLE `faq_data`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `galleries`
--
ALTER TABLE `galleries`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `gallery_data`
--
ALTER TABLE `gallery_data`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `gallery_photos`
--
ALTER TABLE `gallery_photos`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `gallery_photo_data`
--
ALTER TABLE `gallery_photo_data`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `gift_boxes`
--
ALTER TABLE `gift_boxes`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `invoice_settings`
--
ALTER TABLE `invoice_settings`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `language_strings`
--
ALTER TABLE `language_strings`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `language_string_data`
--
ALTER TABLE `language_string_data`
 ADD PRIMARY KEY (`id`), ADD KEY `language_id` (`language_string_id`) USING BTREE, ADD KEY `language_id_2` (`language_id`) USING BTREE;

--
-- Klíče pro tabulku `manufacturers`
--
ALTER TABLE `manufacturers`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `manufacturer_data`
--
ALTER TABLE `manufacturer_data`
 ADD PRIMARY KEY (`id`), ADD KEY `zobrazit` (`zobrazit`) USING BTREE, ADD KEY `manufacturer_id` (`manufacturer_id`) USING BTREE, ADD KEY `language_id` (`language_id`) USING BTREE, ADD KEY `route_id` (`route_id`) USING BTREE;

--
-- Klíče pro tabulku `modules`
--
ALTER TABLE `modules`
 ADD PRIMARY KEY (`id`), ADD KEY `kod` (`kod`) USING BTREE;

--
-- Klíče pro tabulku `module_actions`
--
ALTER TABLE `module_actions`
 ADD PRIMARY KEY (`id`), ADD KEY `module_id` (`module_id`,`povoleno`) USING BTREE;

--
-- Klíče pro tabulku `newsletters`
--
ALTER TABLE `newsletters`
 ADD PRIMARY KEY (`id`), ADD KEY `zobrazit` (`zobrazit`) USING BTREE;

--
-- Klíče pro tabulku `newsletter_data`
--
ALTER TABLE `newsletter_data`
 ADD PRIMARY KEY (`id`), ADD KEY `language_id` (`language_id`,`newsletter_id`) USING BTREE, ADD KEY `newsletter_id` (`newsletter_id`) USING BTREE;

--
-- Klíče pro tabulku `newsletter_recipients`
--
ALTER TABLE `newsletter_recipients`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`) USING BTREE, ADD KEY `shopper_id` (`shopper_id`) USING BTREE, ADD KEY `allowed` (`allowed`) USING BTREE;

--
-- Klíče pro tabulku `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `order_items`
--
ALTER TABLE `order_items`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `order_item_changes`
--
ALTER TABLE `order_item_changes`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `order_states`
--
ALTER TABLE `order_states`
 ADD PRIMARY KEY (`id`), ADD KEY `order_state_type_id` (`order_state_type_id`) USING BTREE;

--
-- Klíče pro tabulku `order_state_data`
--
ALTER TABLE `order_state_data`
 ADD PRIMARY KEY (`id`), ADD KEY `order_state_id` (`order_state_id`,`language_id`) USING BTREE;

--
-- Klíče pro tabulku `order_state_types`
--
ALTER TABLE `order_state_types`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `owner_data`
--
ALTER TABLE `owner_data`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`), ADD KEY `parent_id` (`parent_id`) USING BTREE, ADD KEY `page_category_id` (`page_category_id`) USING BTREE, ADD KEY `show_in_menu` (`show_in_menu`) USING BTREE;

--
-- Klíče pro tabulku `page_categories`
--
ALTER TABLE `page_categories`
 ADD PRIMARY KEY (`id`), ADD KEY `code` (`code`) USING BTREE;

--
-- Klíče pro tabulku `page_data`
--
ALTER TABLE `page_data`
 ADD PRIMARY KEY (`id`), ADD KEY `language_id` (`language_id`) USING BTREE, ADD KEY `page_id` (`page_id`) USING BTREE, ADD KEY `route_id` (`route_id`) USING BTREE;

--
-- Klíče pro tabulku `page_photos`
--
ALTER TABLE `page_photos`
 ADD PRIMARY KEY (`id`), ADD KEY `zobrazit` (`zobrazit`) USING BTREE, ADD KEY `page_id` (`page_id`) USING BTREE;

--
-- Klíče pro tabulku `page_photo_data`
--
ALTER TABLE `page_photo_data`
 ADD PRIMARY KEY (`id`), ADD KEY `page_photo_id` (`page_photo_id`) USING BTREE, ADD KEY `language_id` (`language_id`) USING BTREE;

--
-- Klíče pro tabulku `payments`
--
ALTER TABLE `payments`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `payments_shippings`
--
ALTER TABLE `payments_shippings`
 ADD PRIMARY KEY (`id`), ADD KEY `shipping_id` (`shipping_id`,`payment_id`) USING BTREE;

--
-- Klíče pro tabulku `payment_data`
--
ALTER TABLE `payment_data`
 ADD PRIMARY KEY (`id`), ADD KEY `payment_id` (`payment_id`) USING BTREE, ADD KEY `language_id` (`language_id`) USING BTREE;

--
-- Klíče pro tabulku `price_categories`
--
ALTER TABLE `price_categories`
 ADD PRIMARY KEY (`id`), ADD KEY `price_type_id` (`price_type_id`) USING BTREE;

--
-- Klíče pro tabulku `price_categories_products`
--
ALTER TABLE `price_categories_products`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`) USING BTREE, ADD KEY `price_category_id` (`price_category_id`) USING BTREE;

--
-- Klíče pro tabulku `price_types`
--
ALTER TABLE `price_types`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`), ADD KEY `manufacturer_id` (`manufacturer_id`) USING BTREE, ADD KEY `smazano` (`smazano`) USING BTREE, ADD KEY `tax_id` (`tax_id`) USING BTREE, ADD KEY `import_type` (`import_type`) USING BTREE, ADD KEY `original` (`original`) USING BTREE;

--
-- Klíče pro tabulku `product_categories`
--
ALTER TABLE `product_categories`
 ADD PRIMARY KEY (`id`), ADD KEY `parent_id` (`parent_id`) USING BTREE;

--
-- Klíče pro tabulku `product_categories_products`
--
ALTER TABLE `product_categories_products`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`) USING BTREE, ADD KEY `product_category_id` (`product_category_id`) USING BTREE;

--
-- Klíče pro tabulku `product_category_data`
--
ALTER TABLE `product_category_data`
 ADD PRIMARY KEY (`id`), ADD KEY `zobrazit` (`zobrazit`) USING BTREE, ADD KEY `product_category_id` (`product_category_id`) USING BTREE, ADD KEY `language_id` (`language_id`) USING BTREE, ADD KEY `route_id` (`route_id`) USING BTREE;

--
-- Klíče pro tabulku `product_category_downloads_categories`
--
ALTER TABLE `product_category_downloads_categories`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `product_data`
--
ALTER TABLE `product_data`
 ADD PRIMARY KEY (`id`), ADD KEY `zobrazit` (`zobrazit`) USING BTREE, ADD KEY `product_id` (`product_id`) USING BTREE, ADD KEY `language_id` (`language_id`) USING BTREE, ADD KEY `route_id` (`route_id`) USING BTREE;

--
-- Klíče pro tabulku `product_downloads_products`
--
ALTER TABLE `product_downloads_products`
 ADD UNIQUE KEY `id` (`id`);

--
-- Klíče pro tabulku `product_photos`
--
ALTER TABLE `product_photos`
 ADD PRIMARY KEY (`id`), ADD KEY `zobrazit` (`zobrazit`) USING BTREE, ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Klíče pro tabulku `product_photo_data`
--
ALTER TABLE `product_photo_data`
 ADD PRIMARY KEY (`id`), ADD KEY `product_photo_id` (`product_photo_id`) USING BTREE, ADD KEY `language_id` (`language_id`) USING BTREE;

--
-- Klíče pro tabulku `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uniq_name` (`name`) USING BTREE;

--
-- Klíče pro tabulku `roles_users`
--
ALTER TABLE `roles_users`
 ADD PRIMARY KEY (`user_id`,`role_id`), ADD KEY `fk_role_id` (`role_id`) USING BTREE;

--
-- Klíče pro tabulku `routes`
--
ALTER TABLE `routes`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nazev_seo` (`nazev_seo`) USING BTREE, ADD KEY `page_type_id` (`module_id`) USING BTREE, ADD KEY `zobrazit` (`zobrazit`) USING BTREE, ADD KEY `baselang_route_id` (`baselang_route_id`) USING BTREE;

--
-- Klíče pro tabulku `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`), ADD KEY `module_code` (`module_code`) USING BTREE, ADD KEY `submodule_code` (`submodule_code`) USING BTREE, ADD KEY `value_code` (`value_code`) USING BTREE;

--
-- Klíče pro tabulku `shippings`
--
ALTER TABLE `shippings`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `shipping_data`
--
ALTER TABLE `shipping_data`
 ADD PRIMARY KEY (`id`), ADD KEY `shipping_id` (`shipping_id`) USING BTREE, ADD KEY `language_id` (`language_id`) USING BTREE;

--
-- Klíče pro tabulku `shipping_pricelevels`
--
ALTER TABLE `shipping_pricelevels`
 ADD PRIMARY KEY (`id`), ADD KEY `shipping_id` (`shipping_id`) USING BTREE;

--
-- Klíče pro tabulku `shoppers`
--
ALTER TABLE `shoppers`
 ADD PRIMARY KEY (`id`), ADD KEY `price_category_id` (`price_category_id`,`smazano`) USING BTREE;

--
-- Klíče pro tabulku `shopper_branches`
--
ALTER TABLE `shopper_branches`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `static_content`
--
ALTER TABLE `static_content`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `static_content_data`
--
ALTER TABLE `static_content_data`
 ADD PRIMARY KEY (`id`), ADD KEY `static_page_id` (`static_content_id`) USING BTREE;

--
-- Klíče pro tabulku `taxes`
--
ALTER TABLE `taxes`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uniq_username` (`username`) USING BTREE, ADD UNIQUE KEY `uniq_email` (`email`) USING BTREE;

--
-- Klíče pro tabulku `user_admin_prefernces`
--
ALTER TABLE `user_admin_prefernces`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `user_log`
--
ALTER TABLE `user_log`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Klíče pro tabulku `user_rights`
--
ALTER TABLE `user_rights`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`) USING BTREE, ADD KEY `module_name` (`module_name`) USING BTREE;

--
-- Klíče pro tabulku `user_tokens`
--
ALTER TABLE `user_tokens`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uniq_token` (`token`) USING BTREE, ADD KEY `fk_user_id` (`user_id`) USING BTREE;

--
-- Klíče pro tabulku `vouchers`
--
ALTER TABLE `vouchers`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code` (`code`) USING BTREE;

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `admin_settings`
--
ALTER TABLE `admin_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pro tabulku `admin_structure`
--
ALTER TABLE `admin_structure`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT pro tabulku `admin_structure_data`
--
ALTER TABLE `admin_structure_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT pro tabulku `articles`
--
ALTER TABLE `articles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pro tabulku `article_data`
--
ALTER TABLE `article_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pro tabulku `article_downloads_articles`
--
ALTER TABLE `article_downloads_articles`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pro tabulku `article_photos`
--
ALTER TABLE `article_photos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pro tabulku `article_photo_data`
--
ALTER TABLE `article_photo_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pro tabulku `banners`
--
ALTER TABLE `banners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pro tabulku `banners_old`
--
ALTER TABLE `banners_old`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pro tabulku `banner_data`
--
ALTER TABLE `banner_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT pro tabulku `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pro tabulku `downloads`
--
ALTER TABLE `downloads`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pro tabulku `download_categories`
--
ALTER TABLE `download_categories`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pro tabulku `download_category_data`
--
ALTER TABLE `download_category_data`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pro tabulku `download_data`
--
ALTER TABLE `download_data`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pro tabulku `email_queue`
--
ALTER TABLE `email_queue`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pro tabulku `email_queue_bodies`
--
ALTER TABLE `email_queue_bodies`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pro tabulku `email_receivers`
--
ALTER TABLE `email_receivers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pro tabulku `email_types`
--
ALTER TABLE `email_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pro tabulku `email_types_receivers`
--
ALTER TABLE `email_types_receivers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pro tabulku `faqs`
--
ALTER TABLE `faqs`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pro tabulku `faq_data`
--
ALTER TABLE `faq_data`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pro tabulku `galleries`
--
ALTER TABLE `galleries`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pro tabulku `gallery_data`
--
ALTER TABLE `gallery_data`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pro tabulku `gallery_photos`
--
ALTER TABLE `gallery_photos`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT pro tabulku `gallery_photo_data`
--
ALTER TABLE `gallery_photo_data`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT pro tabulku `gift_boxes`
--
ALTER TABLE `gift_boxes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pro tabulku `language_strings`
--
ALTER TABLE `language_strings`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pro tabulku `language_string_data`
--
ALTER TABLE `language_string_data`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT pro tabulku `manufacturers`
--
ALTER TABLE `manufacturers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `manufacturer_data`
--
ALTER TABLE `manufacturer_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `modules`
--
ALTER TABLE `modules`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pro tabulku `module_actions`
--
ALTER TABLE `module_actions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `newsletters`
--
ALTER TABLE `newsletters`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `newsletter_data`
--
ALTER TABLE `newsletter_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `newsletter_recipients`
--
ALTER TABLE `newsletter_recipients`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `orders`
--
ALTER TABLE `orders`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `order_items`
--
ALTER TABLE `order_items`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `order_item_changes`
--
ALTER TABLE `order_item_changes`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `order_states`
--
ALTER TABLE `order_states`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `order_state_data`
--
ALTER TABLE `order_state_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `order_state_types`
--
ALTER TABLE `order_state_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `owner_data`
--
ALTER TABLE `owner_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pro tabulku `pages`
--
ALTER TABLE `pages`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pro tabulku `page_categories`
--
ALTER TABLE `page_categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `page_data`
--
ALTER TABLE `page_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pro tabulku `page_photos`
--
ALTER TABLE `page_photos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `page_photo_data`
--
ALTER TABLE `page_photo_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `payments`
--
ALTER TABLE `payments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pro tabulku `payments_shippings`
--
ALTER TABLE `payments_shippings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pro tabulku `payment_data`
--
ALTER TABLE `payment_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pro tabulku `price_categories`
--
ALTER TABLE `price_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pro tabulku `price_categories_products`
--
ALTER TABLE `price_categories_products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=289;
--
-- AUTO_INCREMENT pro tabulku `price_types`
--
ALTER TABLE `price_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pro tabulku `product_categories`
--
ALTER TABLE `product_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pro tabulku `product_categories_products`
--
ALTER TABLE `product_categories_products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `product_category_data`
--
ALTER TABLE `product_category_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pro tabulku `product_category_downloads_categories`
--
ALTER TABLE `product_category_downloads_categories`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pro tabulku `product_data`
--
ALTER TABLE `product_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pro tabulku `product_downloads_products`
--
ALTER TABLE `product_downloads_products`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pro tabulku `product_photos`
--
ALTER TABLE `product_photos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `product_photo_data`
--
ALTER TABLE `product_photo_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT pro tabulku `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `routes`
--
ALTER TABLE `routes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT pro tabulku `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pro tabulku `shippings`
--
ALTER TABLE `shippings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pro tabulku `shipping_data`
--
ALTER TABLE `shipping_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pro tabulku `shipping_pricelevels`
--
ALTER TABLE `shipping_pricelevels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pro tabulku `shoppers`
--
ALTER TABLE `shoppers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=176;
--
-- AUTO_INCREMENT pro tabulku `shopper_branches`
--
ALTER TABLE `shopper_branches`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pro tabulku `static_content`
--
ALTER TABLE `static_content`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pro tabulku `static_content_data`
--
ALTER TABLE `static_content_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pro tabulku `taxes`
--
ALTER TABLE `taxes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pro tabulku `user_admin_prefernces`
--
ALTER TABLE `user_admin_prefernces`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `user_log`
--
ALTER TABLE `user_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `user_rights`
--
ALTER TABLE `user_rights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `user_tokens`
--
ALTER TABLE `user_tokens`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `vouchers`
--
ALTER TABLE `vouchers`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `user_tokens`
--
ALTER TABLE `user_tokens`
ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
