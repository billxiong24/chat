-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2016 at 01:26 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `timestamp`) VALUES
('369', '2016-12-29 03:34:55'),
('20', '2016-12-29 04:33:46'),
('654', '2016-12-29 04:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `chat_lines`
--

CREATE TABLE `chat_lines` (
  `chat_id` bigint(11) NOT NULL,
  `chat_name` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `line_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_lines`
--

INSERT INTO `chat_lines` (`chat_id`, `chat_name`, `username`, `text`, `timestamp`, `line_id`) VALUES
(369, 'name', 'wwx', 'hey there', '2016-12-27 18:37:36', 141),
(369, 'name', 'jw56', 'why doesnt anyhing work :(', '2016-12-27 18:37:46', 142),
(369, 'name', 'wwx', 'idk lmao', '2016-12-27 18:37:49', 143),
(369, 'name', 'wwx', 'did ud eelte uh oh', '2016-12-27 18:45:16', 148),
(369, 'name', 'wwx', 'heh', '2016-12-27 18:52:43', 158),
(369, 'name', 'wwx', 'i havent looked at try again yet', '2016-12-27 18:52:49', 159),
(369, 'name', 'jw56', 'ok jstu refresh', '2016-12-27 18:52:55', 160),
(369, 'name', 'wwx', 'we need to make this faster lol', '2016-12-27 18:59:58', 164),
(369, 'name', 'wwx', 'this is soooo slow', '2016-12-27 19:00:02', 165),
(369, 'name', 'jw56', 'this is acctually so slow', '2016-12-27 19:00:17', 169),
(369, 'name', 'jw56', 'lol', '2016-12-27 19:00:19', 170),
(369, 'name', 'jw56', 'like seriosuly', '2016-12-27 19:00:22', 171),
(369, 'name', 'wwx', 'its not even instantaenousl right now', '2016-12-27 19:00:28', 172),
(369, 'name', 'wwx', 'haha', '2016-12-27 19:00:32', 173),
(369, 'name', 'wwx', 'like seriously its not even and i know that this message bar is so low', '2016-12-27 19:00:42', 174),
(369, 'name', 'jw56', 'this chat is laggy aff', '2016-12-27 19:00:51', 175),
(369, 'name', 'jw56', 'lol', '2016-12-27 19:00:53', 176),
(369, 'name', 'jw56', 'lololololololol', '2016-12-27 19:00:57', 177),
(369, 'name', 'wwx', 'facebook chat is so fast', '2016-12-27 19:02:05', 178),
(369, 'name', 'jw56', 'ikr', '2016-12-27 19:02:11', 179),
(369, 'name', 'jw56', 'its sooo fast', '2016-12-27 19:02:17', 180),
(369, 'name', 'wwx', 'lol because we are bad hahaha', '2016-12-27 19:02:29', 181),
(369, 'name', 'jw56', 'we are actually bad', '2016-12-27 19:02:34', 182),
(369, 'name', 'jw56', 'ikr its actually slow', '2016-12-27 19:07:50', 184),
(369, 'name', 'jw56', 'wait wrong chat aagain', '2016-12-27 19:07:52', 185),
(369, 'name', 'wwx', 'stfu nerd', '2016-12-27 19:17:52', 228),
(369, 'name', 'wwx', 'stuf nerd', '2016-12-27 19:17:57', 229),
(369, 'name', 'wwx', 'hello world', '2016-12-27 19:25:58', 230),
(369, 'name', 'wwx', 'please dont duplicate', '2016-12-27 19:26:01', 231),
(369, 'name', 'wwx', 'i jsut added u hw12', '2016-12-27 19:26:14', 232),
(369, 'name', 'hw12', 'why hello there :)', '2016-12-27 19:26:22', 233),
(369, 'name', 'wwx', 'go away', '2016-12-27 19:26:41', 235),
(20, 'name', 'wwx', 'recently', '2016-12-27 19:54:21', 236),
(369, 'name', 'wwx', 'test group should be recent', '2016-12-27 19:54:28', 237),
(20, 'name', 'wwx', 'HOWDY', '2016-12-27 19:56:27', 239),
(369, 'name', 'hw12', 'i will make test group on top', '2016-12-27 19:59:49', 241),
(369, 'name', 'hw12', 'wtf why so slow', '2016-12-27 19:59:53', 242),
(369, 'name', 'wwx', 'wtfff you are sooo slow lmao', '2016-12-27 20:00:02', 243),
(369, 'name', 'hw12', 'this is actually so slow', '2016-12-27 20:00:07', 244),
(369, 'name', 'hw12', 'siooioo slow', '2016-12-27 20:00:13', 245),
(369, 'name', 'hw12', 'lol', '2016-12-27 20:00:14', 246),
(369, 'name', 'hw12', 'now its ok', '2016-12-27 20:00:16', 247),
(369, 'name', 'hw12', 'this is slow', '2016-12-27 20:00:19', 248),
(20, 'name', 'wwx', 'howdy recent', '2016-12-27 20:00:25', 249),
(369, 'name', 'wwx', 'test group is top', '2016-12-27 20:16:27', 250),
(369, 'name', 'hw12', 'hi', '2016-12-27 20:48:45', 255),
(369, 'name', 'hw12', 'shut up', '2016-12-27 20:48:51', 256),
(369, 'name', 'hw12', 'wtf', '2016-12-27 20:48:51', 257),
(369, 'name', 'wwx', 'shut up', '2016-12-27 20:49:40', 258),
(369, 'name', 'wwx', 'haha', '2016-12-27 20:49:42', 259),
(369, 'name', 'wwx', 'haha', '2016-12-27 20:49:44', 260),
(369, 'name', 'wwx', 'im jk', '2016-12-27 20:49:46', 261),
(369, 'name', 'wwx', 'need multipolt threads', '2016-12-27 21:46:06', 262),
(369, 'name', 'hw12', 'lol', '2016-12-27 22:01:44', 267),
(369, 'name', 'wwx', 'stfu', '2016-12-27 22:01:50', 268),
(369, 'name', 'wwx', 'lmao', '2016-12-27 22:09:57', 269),
(369, 'name', 'wwx', 'pls respond', '2016-12-27 22:49:13', 270),
(369, 'name', 'wwx', 'wow', '2016-12-27 22:49:42', 271),
(369, 'name', 'wwx', 'please', '2016-12-27 22:50:58', 272),
(369, 'name', 'wwx', 'hmm wat', '2016-12-27 22:51:02', 273),
(369, 'name', 'hw12', 'THIS IS THE CONTROL GROUP', '2016-12-27 22:51:13', 274),
(369, 'name', 'wwx', 'stfu', '2016-12-27 22:51:20', 275),
(369, 'name', 'hw12', 'lol', '2016-12-27 22:51:23', 276),
(369, 'name', 'hw12', 'wtf this is so slow', '2016-12-27 22:51:31', 277),
(369, 'name', 'hw12', 'lol', '2016-12-27 22:51:34', 278),
(369, 'name', 'hw12', 'wat', '2016-12-27 22:51:36', 279),
(369, 'name', 'hw12', 'tis is so slow', '2016-12-27 22:51:40', 280),
(369, 'name', 'hw12', 'hahaha', '2016-12-27 22:51:43', 281),
(369, 'name', 'wwx', 'facebook is so fast', '2016-12-27 22:51:47', 282),
(369, 'name', 'wwx', 'wtf', '2016-12-27 22:51:49', 283),
(369, 'name', 'wwx', 'lol', '2016-12-27 22:51:51', 284),
(369, 'name', 'wwx', 'wtf', '2016-12-27 22:51:53', 285),
(369, 'name', 'wwx', 'hello world', '2016-12-27 22:51:56', 286),
(369, 'name', 'wwx', 'we the kings', '2016-12-27 22:52:04', 287),
(369, 'name', 'hw12', 'you are a mess', '2016-12-27 22:52:07', 288),
(369, 'name', 'hw12', 'stfu', '2016-12-27 22:52:09', 289),
(369, 'name', 'hw12', 'lol', '2016-12-27 22:52:10', 290),
(369, 'name', 'hw12', 'wtf', '2016-12-27 22:52:11', 291),
(369, 'name', 'hw12', 'there is a log', '2016-12-27 22:52:14', 292),
(369, 'name', 'hw12', 'wat', '2016-12-27 22:52:16', 293),
(369, 'name', 'hw12', 'wat', '2016-12-27 22:52:18', 294),
(369, 'name', 'hw12', 'hello world', '2016-12-27 22:52:20', 295),
(369, 'name', 'hw12', 'u are first', '2016-12-27 22:52:24', 296),
(369, 'name', 'wwx', 'sooo slow', '2016-12-27 22:52:28', 297),
(369, 'name', 'wwx', 'try', '2016-12-27 22:53:02', 298),
(369, 'name', 'hw12', 'TRY ME', '2016-12-27 22:53:19', 299),
(369, 'name', 'wwx', 'without you i feel', '2016-12-27 22:53:24', 300),
(369, 'name', 'wwx', 'lmao', '2016-12-27 22:53:27', 301),
(369, 'name', 'wwx', 'holy we need to fix scroll its not susatinable', '2016-12-27 22:54:25', 302),
(369, 'name', 'wwx', 'this is so slow holy lol', '2016-12-27 22:54:34', 303),
(369, 'name', 'wwx', 'lmao', '2016-12-27 22:54:37', 304),
(369, 'name', 'wwx', 'actually tho its so so slow', '2016-12-27 22:54:41', 305),
(369, 'name', 'hw12', 'stfu', '2016-12-27 22:54:50', 306),
(369, 'name', 'hw12', 'lol ik its so slow', '2016-12-27 22:54:54', 307),
(20, 'name', 'wwx', 'this is so unsusatinable', '2016-12-27 22:55:05', 308),
(20, 'name', 'wwx', 'hahahahaha', '2016-12-27 22:55:08', 309),
(20, 'name', 'wwx', 'this is so gay', '2016-12-27 22:56:09', 310),
(369, 'name', 'wwx', 'why so slow tho', '2016-12-27 22:57:13', 311),
(369, 'name', 'hw12', 'wtf actually tho', '2016-12-27 22:57:23', 312),
(369, 'name', 'wwx', 'wait this is so slow', '2016-12-27 22:57:52', 313),
(369, 'name', 'hw12', 'hmm idk why tho', '2016-12-27 22:57:56', 314),
(369, 'name', 'wwx', 'why dis so slow', '2016-12-27 22:58:08', 315),
(369, 'name', 'hw12', 'now its faster', '2016-12-27 22:58:12', 316),
(369, 'name', 'hw12', 'i think its the refresh notifications', '2016-12-27 22:58:18', 317),
(369, 'name', 'wwx', 'hmmmm u might be right', '2016-12-27 22:58:23', 318),
(369, 'name', 'wwx', 'lololol so slow wtf', '2016-12-27 22:58:28', 319),
(20, 'name', 'wwx', 'actually so slow', '2016-12-27 22:58:43', 320),
(20, 'name', 'hw12', 'you added me lmao', '2016-12-27 22:59:02', 321),
(20, 'name', 'wwx', 'this is actually retarded af', '2016-12-27 22:59:07', 322),
(20, 'name', 'wwx', 'we need to take a class on operating sys', '2016-12-27 22:59:39', 323),
(20, 'name', 'hw12', 'actually tho', '2016-12-27 22:59:42', 324),
(20, 'name', 'hw12', 'lol', '2016-12-27 22:59:43', 325),
(20, 'name', 'hw12', 'distrubted', '2016-12-27 22:59:46', 326),
(20, 'name', 'wwx', 'haha ya', '2016-12-27 22:59:49', 327),
(369, 'name', 'wwx', 'actually slow', '2016-12-27 22:59:57', 328),
(369, 'name', 'hw12', 'cant load all messages at once', '2016-12-27 23:00:08', 329),
(369, 'name', 'wwx', 'hmmm u right lol', '2016-12-27 23:03:29', 330),
(369, 'name', 'hw12', 'TESTING', '2016-12-27 23:03:35', 331),
(369, 'name', 'wwx', 'MALIK MONK', '2016-12-27 23:14:46', 332),
(369, 'name', 'wwx', 'stfu', '2016-12-27 23:14:49', 333),
(369, 'name', 'hw12', 'i have no friends', '2016-12-27 23:14:57', 334),
(369, 'name', 'wwx', ':( crie', '2016-12-27 23:28:20', 335),
(369, 'name', 'hw12', 'lmao knees', '2016-12-27 23:28:25', 336),
(369, 'name', 'wwx', 'ay lmao', '2016-12-28 00:35:14', 337),
(369, 'name', 'hw12', 'hello world', '2016-12-28 00:35:22', 338),
(369, 'name', 'wwx', 'heyyy', '2016-12-28 16:37:38', 339),
(369, 'name', 'wwx', 'stfu', '2016-12-28 16:37:42', 340),
(369, 'name', 'wwx', 'y is this so lsow', '2016-12-28 16:37:49', 341),
(369, 'name', 'hw12', 'idk bro', '2016-12-28 16:38:18', 342),
(369, 'name', 'hw12', 'its seems alright', '2016-12-28 16:38:22', 343),
(369, 'name', 'wwx', 'hmm maybe iu am just slow', '2016-12-28 16:38:28', 344),
(20, 'name', 'wwx', 'howdy', '2016-12-28 16:38:31', 345),
(369, 'name', 'hw12', 'howdyyyy', '2016-12-28 16:38:35', 346),
(369, 'name', 'hw12', 'o wait wrong', '2016-12-28 16:38:38', 347),
(20, 'name', 'hw12', 'tahis is recent', '2016-12-28 16:38:42', 348),
(20, 'name', 'wwx', 'hi', '2016-12-28 16:54:17', 349),
(20, 'name', 'wwx', 'test r', '2016-12-28 17:05:40', 350),
(20, 'name', 'wwx', 'reee', '2016-12-28 17:06:52', 351),
(20, 'name', 'wwx', 'TR', '2016-12-28 17:07:14', 352),
(20, 'name', 'wwx', 'asdf', '2016-12-28 17:07:26', 353),
(20, 'name', 'wwx', 'dd', '2016-12-28 17:08:54', 354),
(20, 'name', 'wwx', 'aaa', '2016-12-28 17:09:10', 355),
(20, 'name', 'wwx', 'g', '2016-12-28 17:09:59', 356),
(20, 'name', 'wwx', 'test', '2016-12-28 17:10:16', 357),
(20, 'name', 'wwx', 'wwww', '2016-12-28 17:12:26', 358),
(20, 'name', 'wwx', 'wwwred', '2016-12-28 17:19:02', 359),
(369, 'name', 'wwx', 'wat', '2016-12-28 17:19:32', 360),
(369, 'name', 'wwx', 'test me', '2016-12-28 17:21:05', 361),
(369, 'name', 'wwx', 'trust me', '2016-12-28 17:21:33', 362),
(369, 'name', 'wwx', 'TRUST', '2016-12-28 17:22:31', 363),
(369, 'name', 'wwx', 'TRUST', '2016-12-28 17:22:34', 364),
(369, 'name', 'wwx', 'TRUST ME', '2016-12-28 17:24:32', 365),
(369, 'name', 'wwx', 'test', '2016-12-28 17:24:58', 366),
(369, 'name', 'wwx', 'test again', '2016-12-28 17:25:40', 367),
(369, 'name', 'wwx', 'try', '2016-12-28 17:25:55', 368),
(369, 'name', 'wwx', 'again', '2016-12-28 17:26:06', 369),
(369, 'name', 'wwx', 'lamo', '2016-12-28 17:26:15', 370),
(369, 'name', 'wwx', 'aa', '2016-12-28 17:27:14', 371),
(369, 'name', 'wwx', 'ee', '2016-12-28 17:28:13', 372),
(369, 'name', 'wwx', 'erer', '2016-12-28 17:28:25', 373),
(369, 'name', 'wwx', 'eeee', '2016-12-28 17:29:36', 374),
(369, 'name', 'wwx', 'eeeee', '2016-12-28 17:29:40', 375),
(20, 'name', 'wwx', 'test', '2016-12-28 17:29:50', 376),
(20, 'name', 'wwx', 'test me', '2016-12-28 17:31:17', 377),
(20, 'name', 'wwx', 'test', '2016-12-28 17:33:43', 378),
(20, 'name', 'wwx', 'another one', '2016-12-28 17:33:59', 379),
(20, 'name', 'hw12', 'ANOTHER', '2016-12-28 17:34:12', 380),
(20, 'name', 'wwx', 'wat', '2016-12-28 17:34:19', 381),
(20, 'name', 'wwx', 'wot', '2016-12-28 17:34:40', 382),
(20, 'name', 'wwx', 'try again', '2016-12-28 17:34:53', 383),
(20, 'name', 'hw12', 'here is a notif', '2016-12-28 17:35:20', 384),
(20, 'name', 'hw12', 'wtf it didnt work', '2016-12-28 17:35:49', 385),
(20, 'name', 'wwx', 'it will now', '2016-12-28 17:36:02', 386),
(20, 'name', 'hw12', 'hmmm lets try it', '2016-12-28 17:37:00', 387),
(369, 'name', 'wwx', 'REEEEE', '2016-12-28 20:11:06', 388),
(369, 'name', 'wwx', 'hello', '2016-12-28 20:14:32', 389),
(369, 'name', 'wwx', 'hi', '2016-12-28 20:25:25', 390),
(20, 'name', 'wwx', 'wat', '2016-12-28 20:25:40', 391),
(20, 'name', 'wwx', 'hmm', '2016-12-28 21:54:27', 392),
(20, 'name', 'wwx', 'HMMMM', '2016-12-28 22:18:51', 393),
(20, 'name', 'hw12', 'hi', '2016-12-28 22:19:26', 394),
(20, 'name', 'hw12', 'LMAO', '2016-12-28 22:19:30', 395),
(369, 'name', 'hw12', 'hello world', '2016-12-28 22:19:35', 396),
(369, 'name', 'wwx', 'LMALMALMALMA', '2016-12-28 22:19:41', 397),
(369, 'name', 'hw12', 'hi', '2016-12-28 22:21:46', 398),
(369, 'name', 'hw12', 'tehee', '2016-12-28 22:21:50', 399),
(369, 'name', 'hw12', 'hi', '2016-12-28 22:26:02', 400),
(369, 'name', 'hw12', 'herdy', '2016-12-28 22:26:50', 401),
(20, 'name', 'hw12', 'moar notifs', '2016-12-28 22:27:04', 402),
(369, 'name', 'hw12', 'lmao', '2016-12-28 22:27:09', 403),
(369, 'name', 'hw12', 'more notifs', '2016-12-28 22:34:55', 404),
(20, 'name', 'hw12', 'more', '2016-12-28 22:36:38', 405),
(20, 'name', 'hw12', '5th one', '2016-12-28 22:36:48', 406),
(20, 'name', 'wwx', 'stfu', '2016-12-28 22:36:57', 407),
(20, 'name', 'hw12', 'hi', '2016-12-28 22:59:20', 408),
(20, 'name', 'hw12', 'test', '2016-12-28 23:00:24', 409),
(20, 'name', 'hw12', 'another one', '2016-12-28 23:01:59', 410),
(20, 'name', 'hw12', 'hey', '2016-12-28 23:02:15', 411),
(654, 'name', 'hw12', 'teehee', '2016-12-28 23:02:38', 412),
(654, 'name', 'wwx', 'stfu nerd', '2016-12-28 23:02:48', 413),
(654, 'name', 'hw12', 'hello world', '2016-12-28 23:04:42', 414),
(654, 'name', 'hw12', 'hi', '2016-12-28 23:06:18', 415),
(654, 'name', 'hw12', 'hey', '2016-12-28 23:06:57', 416),
(654, 'name', 'wwx', 'stfu', '2016-12-28 23:07:01', 417),
(654, 'name', 'wwx', 'wtf', '2016-12-28 23:07:04', 418),
(654, 'name', 'hw12', 'pray', '2016-12-28 23:08:21', 419),
(654, 'name', 'hw12', 'pay', '2016-12-28 23:08:53', 420),
(654, 'name', 'hw12', 'test', '2016-12-28 23:10:19', 421),
(654, 'name', 'hw12', 'prese', '2016-12-28 23:12:07', 422),
(654, 'name', 'hw12', 'test', '2016-12-28 23:12:59', 423),
(654, 'name', 'hw12', 'asdf', '2016-12-28 23:14:21', 424),
(654, 'name', 'hw12', 'hello', '2016-12-28 23:14:37', 425),
(654, 'name', 'hw12', 'plase', '2016-12-28 23:15:06', 426),
(654, 'name', 'wwx', 'shut the fuck up', '2016-12-28 23:15:15', 427),
(654, 'name', 'wwx', 'wawt \\', '2016-12-28 23:15:18', 428),
(654, 'name', 'hw12', 'did prevent sql', '2016-12-28 23:15:27', 429),
(654, 'name', 'hw12', 'asdf', '2016-12-28 23:16:33', 430),
(654, 'name', 'hw12', 'stfu', '2016-12-28 23:16:50', 431),
(654, 'name', 'hw12', 'try again', '2016-12-28 23:17:46', 432),
(654, 'name', 'hw12', 'test', '2016-12-28 23:26:17', 433),
(654, 'name', 'hw12', 'atat', '2016-12-28 23:29:01', 434),
(654, 'name', 'hw12', 'tre', '2016-12-28 23:31:07', 435),
(654, 'name', 'hw12', 'teehee', '2016-12-28 23:32:02', 436),
(20, 'name', 'hw12', 'HELP ME', '2016-12-28 23:32:07', 437),
(20, 'name', 'wwx', 'stfu', '2016-12-28 23:32:16', 438),
(20, 'name', 'wwx', 'NERD', '2016-12-28 23:32:21', 439),
(20, 'name', 'wwx', 'literally kys', '2016-12-28 23:33:21', 440),
(20, 'name', 'wwx', 'lmaozeondg', '2016-12-28 23:33:28', 441),
(20, 'name', 'wwx', 'this is so slow', '2016-12-28 23:33:31', 442),
(20, 'name', 'wwx', 'why is this so slow', '2016-12-28 23:33:34', 443),
(20, 'name', 'wwx', 'lol', '2016-12-28 23:33:37', 444),
(20, 'name', 'hw12', 'holy stfu', '2016-12-28 23:33:43', 445),
(20, 'name', 'hw12', 'stop giving me notifs', '2016-12-28 23:33:45', 446);

-- --------------------------------------------------------

--
-- Table structure for table `chat_updates`
--

CREATE TABLE `chat_updates` (
  `id` varchar(50) NOT NULL,
  `users` varchar(1000) NOT NULL,
  `name` varchar(100) NOT NULL,
  `notifications` int(4) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `incr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_updates`
--

INSERT INTO `chat_updates` (`id`, `users`, `name`, `notifications`, `date`, `incr`) VALUES
('369', 'wwx', 'test group', 7, '2016-12-27 23:37:17', 42),
('369', 'jw56', 'test group', 11, '2016-12-27 23:37:17', 43),
('369', 'hw12', 'test group', 4, '2016-12-28 00:26:09', 61),
('20', 'wwx', 'recent', 13, '2016-12-28 00:54:16', 62),
('20', 'jw56', 'recent', 27, '2016-12-28 00:54:16', 63),
('20', 'hw12', 'recent', 14, '2016-12-28 03:58:53', 64),
('654', 'wwx', 'notif test', 20, '2016-12-29 04:02:27', 65),
('654', 'hw12', 'notif test', 5, '2016-12-29 04:02:27', 66);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first` varchar(60) NOT NULL,
  `last` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first`, `last`) VALUES
(19, 'wwx', 'password', 'bill', 'xiong'),
(20, 'hw12', 'pass', 'harry', 'wang'),
(21, 'jw56', 'john', 'john', 'wang'),
(22, 'greg', 'greg123', 'greg', 'jones'),
(23, 'Will', 'willwang', 'will', 'wang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_lines`
--
ALTER TABLE `chat_lines`
  ADD PRIMARY KEY (`line_id`);

--
-- Indexes for table `chat_updates`
--
ALTER TABLE `chat_updates`
  ADD PRIMARY KEY (`incr`),
  ADD UNIQUE KEY `incr` (`incr`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_lines`
--
ALTER TABLE `chat_lines`
  MODIFY `line_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;
--
-- AUTO_INCREMENT for table `chat_updates`
--
ALTER TABLE `chat_updates`
  MODIFY `incr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
