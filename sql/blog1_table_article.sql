
-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `createdAt`, `user_id`) VALUES
(62, 'Chapitre 1 - En route vers l\'Alaska', '<p>Nam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.</p>\r\n<p>&nbsp;</p>', '2019-09-02 19:46:32', 29),
(63, 'Chapitre 2 - La \"Grande Terre\"', '<p>Nam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.</p>', '2019-09-02 20:47:47', 29),
(64, 'Chapitre 3 - Le village Cap Krusenstern', '<p>Nam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.</p>', '2019-09-02 20:51:51', 29),
(65, 'Chapitre 4 - Traite des fourrures', '<p>Nam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.</p>', '2019-09-02 20:52:29', 29),
(66, 'Chapitre 5 - Un territoire américain', '<p>Nam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.</p>', '2019-09-02 20:52:55', 29),
(67, 'Chapitre 6 - Le Rivage Alaskien', '<p>Nam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.</p>', '2019-09-02 20:53:24', 29),
(68, 'Chapitre 7 - Le Lac Illiama', '<p>Nam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.</p>', '2019-09-02 20:53:49', 29),
(70, 'Chapitre 8 - Le Mont Pavlof', '<p>Nam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.</p>', '2019-09-02 20:55:02', 29),
(71, 'Chapitre 9 - Des populations autochtones', '<p>Nam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus. lo</p>', '2019-09-02 20:55:36', 29);
