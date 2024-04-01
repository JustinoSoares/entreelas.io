-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Nov-2023 às 15:19
-- Versão do servidor: 8.0.35
-- versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `entreelas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id` bigint UNSIGNED NOT NULL,
  `caminho` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint UNSIGNED NOT NULL,
  `tema` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conteudo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagemUrl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `tema`, `conteudo`, `imagemUrl`, `created_at`, `updated_at`) VALUES
(1, 'Abuso sexual', 'jdjddjsdjd', 'dsdsdsd', '2023-11-21 18:59:38', NULL),
(2, 'Cancro da mama', 'Muito mais do que a minha razão', 'Nuce que ', '2023-11-21 22:35:03', NULL),
(3, 'Cabelo', 'jgdhsdjgds', 'sdhbsvdjjd', '2023-11-21 22:35:54', NULL),
(4, 'Independência Financeira', 'Historicamente, as mulheres enfrentaram desafios significativos em termos de igualdade financeira. Em muitas culturas, as mulheres eram limitadas em suas opções de carreira, recebiam salários mais baixos que os homens pelo mesmo trabalho e tinham menos acesso a oportunidades educacionais e financeiras. Além disso, o tradicional papel de cuidadoras muitas vezes relegou as mulheres a posições de dependência financeira.', 'erere', '2023-11-23 12:06:23', NULL),
(5, 'Educação Sexual', 'A educação sexual para mulheres é uma parte crucial do desenvolvimento pessoal e da saúde geral. Uma educação sexual abrangente visa capacitar as mulheres com informações e habilidades para tomar decisões informadas sobre sua sexualidade, promover relacionamentos saudáveis e cuidar da saúde sexual.', 'ere', '2023-11-23 12:06:23', NULL),
(6, 'Saúde da Mulher', 'A abordagem holística da saúde da mulher reconhece a interconexão desses diferentes aspectos e destaca a importância de cuidados preventivos, promoção da conscientização e equidade de gênero para melhorar o bem-estar geral das mulheres.\r\n', 'erer', '2023-11-23 12:08:43', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `conversas`
--

CREATE TABLE `conversas` (
  `id` bigint UNSIGNED NOT NULL,
  `categoria_id` bigint UNSIGNED NOT NULL,
  `mensagemLida` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `conversas`
--

INSERT INTO `conversas` (`id`, `categoria_id`, `mensagemLida`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2023-11-21 19:00:35', NULL),
(2, 2, 0, '2023-11-21 22:36:07', NULL),
(3, 3, 0, '2023-11-21 22:36:07', NULL),
(4, 4, 0, '2023-11-23 12:12:21', NULL),
(5, 5, 0, '2023-11-23 12:13:00', NULL),
(6, 6, 0, '2023-11-23 12:13:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagems`
--

CREATE TABLE `mensagems` (
  `id` bigint UNSIGNED NOT NULL,
  `conteudo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `show` tinyint NOT NULL DEFAULT '1',
  `tipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `user_id` bigint UNSIGNED NOT NULL,
  `conversa_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `mensagems`
--

INSERT INTO `mensagems` (`id`, `conteudo`, `show`, `tipo`, `user_id`, `conversa_id`, `created_at`) VALUES
(3, 'Está tudo bem', 1, 'text', 9, 1, '2023-11-21 19:17:43'),
(4, 'Nunca se viu isso', 1, 'text', 1, 1, '2023-11-21 19:17:54'),
(5, 'fdfdf', 1, 'text', 9, 1, '2023-11-21 19:17:58'),
(6, 'asas', 1, 'text', 1, 1, '2023-11-21 19:18:01'),
(8, '', 1, 'text', 1, 1, '2023-11-21 19:18:07'),
(9, 'sdsd', 1, 'text', 9, 1, '2023-11-21 19:18:13'),
(10, 'sdsd', 1, 'text', 1, 1, '2023-11-21 19:18:15'),
(11, 'Vamos abordar hoje sobre o tema', 1, 'text', 3, 1, '2023-11-21 22:46:01'),
(12, 'Sou a clara', 1, 'text', 3, 2, '2023-11-21 22:48:12'),
(13, 'sou seu', 1, 'text', 3, 2, '2023-11-21 22:59:20'),
(14, 'Aye?', 1, 'text', 3, 2, '2023-11-21 23:01:51'),
(15, 'Olá', 1, 'text', 3, 2, '2023-11-21 23:12:42'),
(16, 'Estas assustado?', 1, 'text', 9, 2, '2023-11-21 23:21:41'),
(17, 'bebes?', 1, 'text', 3, 2, '2023-11-21 23:27:12'),
(18, 'Justino Soares', 1, 'text', 9, 2, '2023-11-22 06:14:40'),
(19, 'olá', 1, 'text', 3, 3, '2023-11-22 06:16:21'),
(20, 'OLa´', 1, 'text', 7, 3, '2023-11-22 06:43:26'),
(21, 'Conversa 1', 1, 'text', 3, 1, '2023-11-22 07:58:13'),
(22, 'Nunca mais chefe', 1, 'text', 3, 1, '2023-11-22 07:59:32'),
(23, 'Olá', 1, 'text', 3, 1, '2023-11-22 08:19:14'),
(24, 'Olá', 1, 'text', 3, 1, '2023-11-22 08:58:19'),
(25, 'dsd', 1, 'text', 9, 1, '2023-11-22 08:58:36'),
(26, 'Nunca mais?', 1, 'text', 3, 3, '2023-11-22 08:59:05'),
(27, '', 1, 'text', 3, 3, '2023-11-22 10:56:12'),
(28, 'as', 1, 'text', 7, 2, '2023-11-22 11:02:28'),
(29, 'sdsd', 1, 'text', 7, 2, '2023-11-22 11:03:53'),
(30, '', 1, 'text', 7, 2, '2023-11-22 11:03:55'),
(31, '', 1, 'text', 7, 2, '2023-11-22 11:04:06'),
(32, 'hggh', 1, 'text', 7, 2, '2023-11-22 11:33:00'),
(33, 'Parace que sim', 1, 'text', 9, 2, '2023-11-22 12:30:37'),
(34, 'as', 1, 'text', 9, 1, '2023-11-22 14:45:33'),
(35, 'olá', 1, 'text', 1, 2, '2023-11-23 08:22:34'),
(36, 'sim pai', 1, 'text', 1, 2, '2023-11-23 08:41:39'),
(37, 'Olá', 1, 'text', 1, 5, '2023-11-23 12:42:07'),
(38, 'é muito bom', 1, 'text', 7, 5, '2023-11-23 13:10:50'),
(39, 'Não', 1, 'text', 14, 1, '2023-11-23 14:06:39'),
(40, 'yh', 1, 'text', 1, 1, '2023-11-23 14:10:00'),
(41, 'yh', 1, 'text', 1, 1, '2023-11-23 14:11:43'),
(42, 'sd', 1, 'text', 14, 1, '2023-11-23 14:12:32'),
(43, 'Justino soares', 1, 'text', 1, 1, '2023-11-23 14:14:12'),
(44, 'ja', 1, 'text', 14, 1, '2023-11-23 14:15:03'),
(45, 'yh', 1, 'text', 1, 1, '2023-11-23 14:15:42'),
(46, 'ola', 1, 'text', 1, 1, '2023-11-23 14:16:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_14_021014_create_sessions_table', 1),
(7, '2023_11_14_181623_create_categorias_table', 1),
(8, '2023_11_14_181624_create_conversas_table', 1),
(9, '2023_11_14_181625_create_mensagems_table', 1),
(10, '2023_11_14_181656_create_arquivos_table', 1),
(11, '2023_11_14_181724_create_respostas_table', 1),
(12, '2023_11_14_181802_create_sugestoes_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `respostas`
--

CREATE TABLE `respostas` (
  `id` bigint UNSIGNED NOT NULL,
  `conteudo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sugestoes`
--

CREATE TABLE `sugestoes` (
  `id` bigint UNSIGNED NOT NULL,
  `assunto` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conteudo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `primeiroNome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apelido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show` tinyint NOT NULL DEFAULT '0',
  `dataNasc` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `primeiroNome`, `apelido`, `show`, `dataNasc`, `email`, `password`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'Justino', 'Soares', 0, '2023-11-21', 'justino@gmail.com', '$2y$10$8abtpCfLFT3SmmoATyBgfORVfx/LnOAr541X4Gi5lOIZZj3mYcqVe', 'user', '2023-11-21 18:04:42', NULL),
(3, 'Clara', 'Assis', 0, '2023-11-21', 'clara@gmail.com', '$2y$10$/E6TqWShQcWrRrJ.nm.n6.xuvqzuSjvUrtEPM8lRnCOr/XrK4MrDu', 'user', '2023-11-21 18:12:09', NULL),
(5, 'Gildo', 'Cabeto', 0, '2023-11-21', 'gildo@gmail.com', '$2y$10$S4tRCZ24p15fAdIYMp9bTOQFiI36w9wfmksJum481a35h97..ZwBW', 'user', '2023-11-21 18:15:45', NULL),
(7, 'Gilberto', 'Carlos', 0, '2023-11-21', 'gilberto@gmail.com', '$2y$10$C/si8sAbgCltT52opN/GHu.NFWW.dEC87ZmzWUe5.PV4MPW8k7sEq', 'user', '2023-11-21 18:21:57', NULL),
(9, 'Mário', 'Salembe', 0, '2023-11-21', 'mariolino@gmail.com', '$2y$10$10bo9IVn//fxISxrvaHabeXJVvm5Gfr7PIXimbdiliNwOmj4PIO0m', 'user', '2023-11-21 18:44:10', NULL),
(11, 'Ana', 'Natanaela', 0, '2023-11-21', 'ana@gmail.com', '$2y$10$clpcdpHvjX9HUx5kcCW3sunWtwYZQ/Eim9NdH/u2k6gtGyOXz6PRe', 'user', '2023-11-21 18:54:13', NULL),
(13, 'Carlos', 'De Almeida', 0, '2023-11-23', 'carlos123@gmail.com', '$2y$10$t6RT7mp8RB//gsndsFRIN.A8B44mvYAcpodwf3X/LS08qOKRDULfG', 'user', '2023-11-23 11:55:41', NULL),
(14, 'Boares', 'Gunza', 0, '2023-11-23', 'boares@gmail.com', '$2y$10$rYJ9V8QQOwneTw7uxdDHiuQKp4rT7buPKGVg2sefVn6Yejx.XXO4q', 'user', '2023-11-23 14:03:05', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arquivos_mensagem_id_foreign` (`mensagem_id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `conversas`
--
ALTER TABLE `conversas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversas_categoria_id_foreign` (`categoria_id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `mensagems`
--
ALTER TABLE `mensagems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mensagems_user_id_foreign` (`user_id`),
  ADD KEY `mensagems_conversa_id_foreign` (`conversa_id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `respostas`
--
ALTER TABLE `respostas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respostas_mensagem_id_foreign` (`mensagem_id`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices para tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sugestoes_user_id_foreign` (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `conversas`
--
ALTER TABLE `conversas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagems`
--
ALTER TABLE `mensagems`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `respostas`
--
ALTER TABLE `respostas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD CONSTRAINT `arquivos_mensagem_id_foreign` FOREIGN KEY (`mensagem_id`) REFERENCES `mensagems` (`id`);

--
-- Limitadores para a tabela `conversas`
--
ALTER TABLE `conversas`
  ADD CONSTRAINT `conversas_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Limitadores para a tabela `mensagems`
--
ALTER TABLE `mensagems`
  ADD CONSTRAINT `mensagems_conversa_id_foreign` FOREIGN KEY (`conversa_id`) REFERENCES `conversas` (`id`),
  ADD CONSTRAINT `mensagems_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `respostas`
--
ALTER TABLE `respostas`
  ADD CONSTRAINT `respostas_mensagem_id_foreign` FOREIGN KEY (`mensagem_id`) REFERENCES `mensagems` (`id`);

--
-- Limitadores para a tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  ADD CONSTRAINT `sugestoes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
