-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Des 2019 pada 10.19
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_news`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `last_signin` int(11) DEFAULT NULL,
  `created_date` int(11) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `verification_key` varchar(255) NOT NULL,
  `admin_group` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `last_signin`, `created_date`, `ip`, `verification_key`, `admin_group`, `name`, `address`, `address2`, `city`, `state`, `zip`) VALUES
(1, 'admin', 'a1fa99a1724242d0931d4f9c62dd56a6', 'support@lenapo.com', 2147483647, 123132121, '::1', 'dfasdfa3a33a', 1, 'Joseph Opanel', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_groups`
--

CREATE TABLE `admin_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin_groups`
--

INSERT INTO `admin_groups` (`id`, `name`) VALUES
(1, 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `imageUrl` varchar(255) DEFAULT NULL,
  `createAt` int(11) NOT NULL DEFAULT current_timestamp(),
  `removeAt` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `category`, `imageUrl`, `createAt`, `removeAt`) VALUES
(1, 'World', NULL, 1575355549, 0),
(2, 'Entertainment', NULL, 1575355614, 0),
(3, 'Top News', NULL, 1575355620, 0),
(4, 'Sports', NULL, 1575355628, 0),
(5, 'Travel', NULL, 1575355634, 0),
(6, 'Health', NULL, 1575355645, 0),
(7, 'Technology', NULL, 1575355657, 0),
(8, 'Business', NULL, 1575355667, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text DEFAULT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `comment_count` int(11) DEFAULT 0,
  `views_count` int(11) DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `contents` text DEFAULT NULL,
  `createAt` int(11) DEFAULT current_timestamp(),
  `removeAt` int(11) DEFAULT 0,
  `imageUrl` varchar(255) DEFAULT NULL,
  `videoUrl` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `category_id`, `comment_count`, `views_count`, `title`, `contents`, `createAt`, `removeAt`, `imageUrl`, `videoUrl`, `type`) VALUES
(4, 1, 1, 9, 'PG&E Is Near $13.5 Billion Deal With Wildfire Victims - Yahoo Finance', '(Bloomberg) -- PG&amp;E Corp. is close to finalizing terms for a $13.5 billion payout to victims of wildfires ignited by its power lines, a key step toward resolving the biggest utility bankruptcy in U.S. history, according to people familiar with the matter.… [+2756 chars]', NULL, 0, 'https://s.yimg.com/uu/api/res/1.2/a3xPwHhS4etCdcK1F5LGlA--~B/aD02NzU7dz0xMjAwO3NtPTE7YXBwaWQ9eXRhY2h5b24-/https://media.zenfs.com/en/bloomberg_markets_842/3fb38cbdf18262284bf2df61df33832f', NULL, 0),
(5, 1, 2, 10, 'Ex-GM board member, union leader pleads guilty to accepting kickbacks - CNBC', 'DETROIT Former General Motors board member Joe Ashton, a retired United Auto Workers leader, pleaded guilty on Wednesday, as part of a deal with federal prosecutors, to criminal charges as part of an ongoing federal corruption probe into the union.\r\nAs part o… [+2062 chars]', NULL, 0, 'https://image.cnbcfm.com/api/v1/image/106092368-1566500135071gmspringhillinvestment50.jpg?v=1566500264', NULL, 0),
(6, 1, 0, 0, 'Daily Crunch: Google’s founders step back - TechCrunch', 'The Daily Crunch is TechCrunch’s roundup of our biggest and most important stories. If you’d like to get this delivered to your inbox every day at around 9am Pacific, you can subscribe here.\r\n1. Google CEO Sundar Pichai is taking over as CEO of Alphabet\r\nFoun… [+2523 chars]', NULL, 0, 'https://techcrunch.com/wp-content/uploads/2018/12/AP_18345592123866.jpg?w=620', NULL, 0),
(7, 1, 0, 0, 'The repo market is ‘broken’ and Fed injections are not a lasting solution, market pros warn - MarketWatch', 'The Federal Reserves ongoing efforts to shore up the short-term repo lending markets have begun to rattle some market experts. \r\nThe New York Federal Reserve has spent hundreds of billions of dollars to keep credit flowing through short term money markets sin… [+4641 chars]', NULL, 0, 'http://s.marketwatch.com/public/resources/MWimages/MW-HW349_Dollar_ZG_20191204125340.jpg', NULL, 0),
(8, 1, 0, 0, 'After Ominous French Fry Headlines, Some Reassurance - Newser', '(Newser)\r\nA flurry of headlines took over the internet on Tuesday: \"French fry shortage possibly looming\" was Fox News\' take. It, like countless others, reported on a dearth of potatoes in North America after crops were damaged by cold, wet weather. CNN frame… [+984 chars]', NULL, 0, 'https://img1-azrcdn.newser.com/image/1270764-12-20191204131859.jpeg', NULL, 0),
(9, 1, 0, 0, 'Peloton Stands Behind \'Sexist\' Holiday Ad Despite Backlash - TMZ', 'Peloton is standing its ground on the controversial ad pushing the bike as a great Christmas gift for wives ... even in the face of all the backlash and mockery.\r\nThe company pushed back against those ridiculing the holiday commercial -- where a wife receives… [+1256 chars]', NULL, 0, 'https://imagez.tmz.com/image/e5/16by9/2019/12/04/e52e8aec53a65f71a495d2f29c10e3ae_xl.jpg', NULL, 0),
(10, 1, 0, 0, 'Elon Musk Says “Pedo Guy” Was a Common Insult in His Youth. We Checked With His Schoolmates. - Slate', 'Elon Musk leaves the U.S. District Court for the Central District of California in Los Angeles on Tuesday.\r\n<ol><li>\r\nHow Herpes Became a Sexual Boogeyman\r\n </li><li>\r\nHow Scientific American Ended Up at the Center of a Massive Twitter War\r\n </li><li>\r\nGoogle… [+4680 chars]', NULL, 0, 'https://compote.slate.com/images/f919f828-c378-4755-98ad-b4119d47023c.jpeg?width=780&height=520&rect=4511x3007&offset=0x0', NULL, 0),
(11, 1, 0, 0, 'The best cookies you can buy in a store, ranked - CNN', NULL, NULL, 0, 'https://cdn.cnn.com/cnnnext/dam/assets/190207105023-oreo-cookies-mondelez-super-tease.jpg', NULL, 0),
(12, 1, 0, 0, 'McDonald’s and Ford team up to build car parts from coffee waste - The Takeout', 'The most exciting eco-friendly products are the ones that work even better than their more wasteful counterparts ever didand thanks to an unlikely corporate team-up, were seeing those innovations play out on a large scale. CNET reports that Ford and McDonalds… [+1310 chars]', NULL, 0, 'https://i.kinja-img.com/gawker-media/image/upload/c_fill,f_auto,fl_progressive,g_center,h_675,pg_1,q_80,w_1200/yzdhzpgbys1buuikt5hh.jpg', NULL, 0),
(13, 1, 0, 0, 'Saudi Arabia Threatens To Flood Oil Markets If OPEC Members Don\'t Cut Output - OilPrice.com', 'Three days after oil tumbled following a Bloomberg report that Saudi Arabia was angry at its (N)OPEC co-members for not complying with production quotas, and was no longer willing to compensate for excessive production by other members of the cartel, the WSJ … [+4405 chars]', NULL, 0, 'https://d32r1sh890xpii.cloudfront.net/article/718x300/29b89ec2a2a516de0b7faf148a33ec34.jpg', NULL, 0),
(14, 1, 0, 0, 'United buying 50 new Airbus jets to replace Boeing planes - KOMO News', NULL, NULL, 0, 'http://static-23.sinclairstoryline.com/resources/media/e4aba62b-182d-4e4c-98fa-345eee309906-large16x9_UNITEDAIRLINES0.png?1575482130586', NULL, 0),
(15, 1, 0, 0, 'Craft beer pioneer Ballast Point is sold to a microbrewery - Los Angeles Times', 'For the second time in four years, Ballast Point a San Diego craft beer pioneer that became one of the areass largest breweries has been sold.\r\nKings &amp; Convicts Brewing Co., a tiny Illinois firm, on Tuesday announced an agreement to buy Ballast Point from… [+4205 chars]', NULL, 0, 'https://ca-times.brightspotcdn.com/dims4/default/874147e/2147483647/strip/true/crop/2048x1075+0+38/resize/1200x630!/quality/90/?url=https%3A%2F%2Fcalifornia-times-brightspot.s3.amazonaws.com%2Ff6%2F93%2Fc26d52c4275fcb229575f1e2d7c8%2Fsd-cgusman-1483035293', NULL, 0),
(16, 1, 0, 0, 'The White House Wants You to Know That Everything Is Going Absolutely Fine in Its Trade Talks With China - Slate', 'U.S. Trade Representative Robert Lighthizer in a Cabinet meeting at the White House.\r\n<ol><li>\r\nHow Herpes Became a Sexual Boogeyman\r\n </li><li>\r\nListen, I Finally Get Pete Davidsons Appeal to Women\r\n </li><li>\r\nThe Next Impeachment Hearing Looks Like It Will… [+2500 chars]', NULL, 0, 'https://compote.slate.com/images/6cf8c6f6-4db1-4e31-9a90-37e4cd156919.jpeg?width=780&height=520&rect=6720x4480&offset=0x0', NULL, 0),
(17, 1, 0, 0, 'Dow Jones Jumps 200 Points As China News Fuels Stock Market Rally - Investor\'s Business Daily', 'The Dow Jones Industrial Average led as key indexes scored solid gains in the stock market today amid renewed optimism for a U.S.-China trade deal.\r\nXThe Dow Jones industrials rallied 0.7%, the S&amp;P 500 rose nearly 0.7% and the Nasdaq advanced 0.6%. Small … [+2570 chars]', NULL, 0, 'https://www.investors.com/wp-content/uploads/2018/07/Stock-ChinaFlagChart-01-adobe.jpg', NULL, 0),
(18, 1, 0, 0, 'Chesapeake Energy’s stock soars as debt deals buy time for troubled company - MarketWatch', 'Shares of Chesapeake Energy Corp. soared on heavy volume Wednesday, after a series of debt financing moves that were announced helped provide the struggling oil and natural gas company with additional financial flexibility.\r\nThe stock\r\nCHK, +16.86%\r\n ran up 1… [+3798 chars]', NULL, 0, 'http://s.marketwatch.com/public/resources/MWimages/MW-HR127_Chesap_MG_20190911143138.jpg', NULL, 0),
(19, 1, 0, 0, 'Expedia CEO, CFO Ousted in Clash With Barry Diller, Board - The Wall Street Journal', 'Expedia Group Inc.\r\n EXPE 6.24%\r\ns chief executive and finance chief were both forced to resign after clashing with its board of directors over the direction of the travel company.The site that helps users find hotel rooms and flights said on Wednesday that C… [+3094 chars]', NULL, 0, 'https://images.wsj.net/im-132900/social', NULL, 0),
(20, 1, 0, 0, 'The Buick Regal is getting killed in 2021, creating an all-SUV brand - Fox News', 'The Buick Regal lineup is being discontinued for 2021, leaving the brand with a lineup comprised exclusively of utility vehicles.\r\n(Buick)\r\nThe Regal name was first used in 1973 and has appeared on six generations of the model, with a few hiatuses along the w… [+939 chars]', NULL, 0, 'https://static.foxnews.com/foxnews.com/content/uploads/2019/12/regalf.jpg', NULL, 0),
(21, 1, 0, 0, 'Papa John\'s CEO says pizza recipe hasn\'t changed despite founder\'s claims - CNBC', 'Papa John\'s CEO Rob Lynch said Tuesday that the pizza chain has not changed its recipe, despite claims from its founder that it tastes different. \r\n\"We haven\'t made any changes to the way we make it or what goes into our products,\" Lynch said on CNBC\'s \"Squaw… [+1486 chars]', NULL, 0, 'https://image.cnbcfm.com/api/v1/image/106158040-1569938541337img_5472.jpg?v=1569938614', NULL, 0),
(22, 1, 0, 0, 'Air cargo industry braces for worst year since financial crisis as holidays fail to perk up demand - CNBC', 'The peak holiday season started off with a thud for cargo airlines, as demand continued to fall short of supply, amid slowing global growth and a trade war that continues to weigh on the sector.\r\nAir cargo demand fell 3.5% in October, the start of the peak se… [+1409 chars]', NULL, 0, 'https://image.cnbcfm.com/api/v1/image/106054558-1564672183240gettyimages-1052703584.jpeg?v=1564672303', NULL, 0),
(23, 1, 0, 0, 'Amazon announced its top-selling Cyber Monday 2019 deals – here are best ones you can still get - BGR', 'Earlier this week, Amazon announced that its huge Cyber Monday 2019 sale broke records to become the company’s biggest Cyber Monday sale ever. Beyond that, the Black Friday 2019 sale Amazon hosted for eight days ahead of Cyber Weekend and Cyber Monday was als… [+8744 chars]', NULL, 0, 'https://boygeniusreport.files.wordpress.com/2019/11/amazon-sign-black-friday-deals-1.jpg?quality=98&strip=all', NULL, 0),
(24, 7, 0, 0, 'Nussa Special : Nussa Bisa', '<p>The Indonesian film industry, especially in the animation genre does tend to develop slowly. Educational programs for children are also increasingly difficult to find.</p>\r\n\r\n<p>Do not want to be outdone by the animated series from neighboring countries, Indonesian animation is now starting to make a breakthrough.</p>\r\n\r\n<p>Nussa and Rara&#39;s animated web series which has released their first episode on Nussa Official Youtube channel, has become a new breath for the Indonesian animation world.</p>\r\n\r\n<p>This animation is a production from the animated house of The Little Giantz which was conceived by Mario Irwinsyah in collaboration with 4 Stripe Production.</p>\r\n\r\n<p>Received a good reception from the people of Indonesia, the inaugural episode of Nussa Official has now been witnessed by 2.2 million viewers and has more than 400 thousand subscribers. In fact, occupying the trending position 3 on YouTube Indonesia.</p>\r\n\r\n<p>From the voice-over side, Nussa&#39;s character was dubbed by Muzzaki Ramdhan and Rara&#39;s character was filled by Aysha Ocean Fajar.</p>\r\n\r\n<p>Muzakki Ramdhan is a young actor who has played in several Indonesian films, one of which is the film The Returning (2018), while Aysha Ocean is a 4-year-old little girl born in Dubai.</p>\r\n\r\n<p>Nussa&#39;s character is described as a boy dressed in a robe complete with his white skullcap.</p>\r\n\r\n<p>In fact, the character of Nussa was created as a person with a disability. This is evident in Nussa&#39;s left leg using a prosthetic foot.</p>\r\n\r\n<p>As for Rara&#39;s character, described as Nussa&#39;s 5-year-old sister by wearing a robe and veil and looking very cheerful. The voice of this Rara character, also invites a sense of exasperation from the audience.</p>\r\n\r\n<p>Through #nussabisa, the animation of this nation&#39;s children is a pride for Indonesia.</p>\r\n\r\n<p>Nussa and Rara seemed to be present as an answer to the parents&#39; anxiety over the lack of educational programs for children. The tightness of religious values ??which is neatly denied by the quality of the shows, certainly makes children interested in watching it.</p>\r\n', NULL, 0, NULL, 'https://www.youtube.com/watch?v=-5LNffQwITE', 1),
(26, 6, 0, 0, 'Dragon Ball Super Movie 2018:New Saiyan Villain Revealed!', '<p>Dragon Ball Super Movie Official TRAILER was released! Goku vs NEW Saiyan. Coming out on December 14, 2018, Worldwide at the same time! The Dragon Ball Super Movie Trailer Is finally here. The movie will feature a New Saiyan (seen in the trailer). The upcoming Dragon Ball Super movie is the 20th movie.</p>\r\n\r\n<p>It has been confirmed that we will see &ldquo;everyone&rsquo;s favorite Saiyans&rdquo; return (presumably includes Vegeta, Gohan, and rest of Z warriors). They also said &ldquo;you can&rsquo;t talk about Saiyans without talking about Frieza&rdquo; (no confirmation if Frieza is part of the cast or of flashbacks.&nbsp;<strong>The movie will be released worldwide on December 14th, 2018 across multiple countries, on the same night! &ndash; John Oppai.</strong></p>\r\n', NULL, 0, NULL, 'https://www.youtube.com/watch?v=i-lCWZR1am0', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `news_comments`
--

CREATE TABLE `news_comments` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `createAt` int(11) DEFAULT NULL,
  `removeAt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `news_favorites`
--

CREATE TABLE `news_favorites` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `createAt` int(11) DEFAULT NULL,
  `removeAt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `news_views`
--

CREATE TABLE `news_views` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `createAt` int(11) DEFAULT 0,
  `removeAt` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `imageUrl` varchar(255) DEFAULT NULL,
  `createAt` int(11) DEFAULT NULL,
  `removeAt` int(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `last_login` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `imageUrl`, `createAt`, `removeAt`, `token`, `last_login`) VALUES
(11, 'Davi Nomoeh Dani', 'davinomoehdanino1@gmail.com', '$2y$10$z45DPAHm7aJXWy69geptPOdZi2J0zZxSpCBg4z3AB4xyfS1eee0N6', NULL, 1575619197, NULL, '5f9405ac295539fc596b0f2cc9fa21dc', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin_groups`
--
ALTER TABLE `admin_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news_favorites`
--
ALTER TABLE `news_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news_views`
--
ALTER TABLE `news_views`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `admin_groups`
--
ALTER TABLE `admin_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `news_favorites`
--
ALTER TABLE `news_favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `news_views`
--
ALTER TABLE `news_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
