
-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`, `mail`, `createdAt`, `role_id`) VALUES
(29, 'Jean Forteroche', '$2y$10$iB/e6iTaix8U9csWJZxc7.y4toh7wY4pTMUwJJo6n3qUCcYibNw0i', 'sierad@hotmail.fr', '2019-07-23', 1);
