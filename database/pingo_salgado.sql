-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/02/2025 às 15:51
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pingo salgado`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id_fornecedor` int(11) NOT NULL,
  `nome_fornecedor` varchar(20) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `local_fornecedor` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id_fornecedor`, `nome_fornecedor`, `id_produto`, `local_fornecedor`) VALUES
(1, 'Coca Nova', 1, 'Algarve'),
(2, 'Frescos do Norte', 2, 'Porto'),
(3, 'Horta Beirã', 3, 'Coimbra'),
(4, 'Frutas e Companhia', 4, 'Braga'),
(5, 'Mercearia do Alentej', 5, 'Évora'),
(6, 'Delícias da Madeira', 6, 'Funchal'),
(7, 'Sabores dos Açores', 7, 'Ponta Delga'),
(8, 'Queijaria da Serra', 8, 'Viseu'),
(9, 'Peixaria Atlântico', 9, 'Setúbal'),
(10, 'Padaria Artesanal', 10, 'Leiria'),
(11, 'Charcutaria Nacional', 11, 'Guimarães'),
(12, 'Café do Brasil', 12, 'Faro'),
(13, 'Legumes do Oeste', 13, 'Aveiro'),
(14, 'Carnes Beirãs', 14, 'Castelo Bra'),
(15, 'Vinhos e Sabores', 15, 'Santarém'),
(16, 'Doces e Tradições', 16, 'Viana do Ca'),
(17, 'Enchidos Transmontan', 17, 'Bragança'),
(18, 'Produtos do Campo', 18, 'Beja'),
(19, 'O Mel e a Serra', 19, 'Guarda'),
(20, 'Temperos e Especiari', 20, 'Covilhã'),
(21, 'Pão Quente', 21, 'Torres Vedr'),
(22, 'Frutos Secos & Compa', 22, 'Ovar'),
(23, 'Lacticínios do Minho', 23, 'Barcelos'),
(24, 'Farinhas e Massas', 24, 'Chaves'),
(25, 'Azeites da Terra', 25, 'Loulé'),
(26, 'Produtos Biológicos', 26, 'Penafiel'),
(27, 'Bebidas Naturais', 27, 'Fátima'),
(28, 'Conservas Tradiciona', 28, 'Tomar'),
(29, 'Sabores de Sintra', 29, 'Sintra'),
(30, 'Mercearia do Bairro', 30, 'Cascais'),
(31, 'Queijos e Companhia', 31, 'Loures'),
(32, 'Armazém das Especiar', 32, 'Almada'),
(33, 'Fumeiro do Douro', 33, 'Seixal'),
(34, 'Produtos Gourmet', 34, 'Montijo'),
(35, 'Delícias do Ribatejo', 35, 'Sesimbra'),
(36, 'Salgados e Petiscos', 36, 'Palmela'),
(37, 'Chocolate & Cia', 37, 'Mafra'),
(38, 'Pescados do Dia', 38, 'Vila Franca'),
(39, 'Biscoitos e Doces', 39, 'Azambuja'),
(40, 'Cervejaria Artesanal', 40, 'Abrantes'),
(41, 'Chás e Infusões', 41, 'Benavente'),
(42, 'Fruta Tropical', 42, 'Almeirim'),
(43, 'Alimentos Saudáveis', 43, 'Coruche'),
(44, 'Mercearia do Centro', 44, 'Estremoz'),
(45, 'Peixaria Fresca', 45, 'Lagos'),
(46, 'Legumes da Estação', 46, 'Castro Verd'),
(47, 'Queijaria Artesanal', 47, 'Vila Real'),
(48, 'Doçaria Regional', 48, 'Peso da Rég'),
(49, 'Adega do Sul', 49, 'Portalegre'),
(50, 'Produtos Caseiros', 50, 'Évora');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `id_seccao` int(11) NOT NULL,
  `data_validade` date NOT NULL,
  `preco` float NOT NULL,
  `nome_produto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `marca`, `id_seccao`, `data_validade`, `preco`, `nome_produto`) VALUES
(1, 'Coca Nova', 1, '2025-02-06', 2, 'Coca Sprite'),
(2, 'Nestlé', 2, '2025-06-15', 2.99, 'Leite UHT'),
(3, 'Delta', 3, '2026-01-20', 4.5, 'Café Moído'),
(4, 'Compal', 4, '2025-08-10', 1.99, 'Sumo de Laranja'),
(5, 'Gallo', 5, '2026-12-05', 6.75, 'Azeite Virgem Extra'),
(6, 'Milaneza', 6, '2025-11-30', 1.2, 'Massa Esparguete'),
(7, 'Predilecta', 7, '2025-07-25', 2.5, 'Molho de Tomate'),
(8, 'Iglo', 8, '2025-09-15', 5.99, 'Ervilhas Congeladas'),
(9, 'Pescanova', 9, '2025-12-20', 8.99, 'Filetes de Pescada'),
(10, 'Danone', 10, '2025-05-10', 3.75, 'Iogurte Natural'),
(11, 'Nestlé', 11, '2025-10-01', 4.25, 'Cereais de Chocolate'),
(12, 'Matinal', 2, '2025-06-18', 2.89, 'Leite Meio Gordo'),
(13, 'Continente', 6, '2025-04-05', 0.99, 'Farinha de Trigo'),
(14, 'Panrico', 11, '2025-03-15', 1.5, 'Pão de Forma'),
(15, 'Delta', 3, '2026-02-28', 5, 'Café em Cápsulas'),
(16, 'Sical', 3, '2025-09-25', 4.99, 'Café Moído'),
(17, 'Luso', 1, '2026-07-10', 0.89, 'Água Mineral 1.5L'),
(18, 'Vitalis', 1, '2026-06-25', 0.85, 'Água com Gás'),
(19, 'Super Bock', 1, '2025-12-31', 1.1, 'Cerveja 33cl'),
(20, 'Sagres', 1, '2025-12-31', 1.15, 'Cerveja Mini'),
(21, 'Sumol', 1, '2025-07-20', 1.99, 'Refrigerante de Anan'),
(22, 'Lipton', 3, '2025-10-15', 2.49, 'Chá Verde'),
(23, 'Nestlé', 3, '2025-08-05', 3.79, 'Chocolate em Pó'),
(24, 'Matutano', 8, '2025-05-22', 1.99, 'Batatas Fritas'),
(25, 'Lay’s', 8, '2025-07-18', 2.29, 'Batatas Fritas Cebol'),
(26, 'Oreo', 11, '2025-11-10', 2.89, 'Bolachas de Chocolat'),
(27, 'Belvita', 11, '2025-10-22', 3.25, 'Bolachas Integrais'),
(28, 'Compal', 1, '2025-06-14', 2.19, 'Néctar de Manga'),
(29, 'Nutella', 11, '2026-04-05', 4.99, 'Creme de Avelã'),
(30, 'Tulicreme', 11, '2026-02-15', 3.5, 'Creme de Chocolate'),
(31, 'Mimosa', 2, '2025-07-30', 3.49, 'Queijo Flamengo Fati'),
(32, 'Président', 1, '2025-09-05', 4.99, 'Manteiga com Sal'),
(33, 'Queijo da Serra', 2, '2025-12-20', 12.99, 'Queijo Amanteigado'),
(34, 'Gresso', 10, '2025-06-25', 1.99, 'Iogurte Grego'),
(35, 'Yoplait', 10, '2025-08-12', 3.75, 'Iogurte de Morango'),
(36, 'Iglo', 8, '2025-09-01', 6.25, 'Nuggets de Frango'),
(37, 'Pescanova', 8, '2026-01-10', 9.99, 'Camarão Cozido'),
(38, 'Bonduelle', 7, '2025-04-30', 2.49, 'Milho em Conserva'),
(39, 'Heinz', 7, '2026-05-15', 3.99, 'Ketchup'),
(40, 'Hellmann’s', 7, '2026-03-22', 4.25, 'Maionese Clássica'),
(41, 'Paladin', 7, '2026-07-18', 1.99, 'Mostarda'),
(42, 'Compal', 4, '2025-09-10', 2.49, 'Sumo de Pêssego'),
(43, 'Sumol', 4, '2025-06-30', 1.99, 'Refrigerante de Lara'),
(44, 'Coca-Cola', 4, '2026-01-01', 1.49, 'Coca-Cola Original'),
(45, 'Pepsi', 4, '2026-02-14', 1.39, 'Pepsi'),
(46, 'Red Bull', 4, '2026-04-30', 2.99, 'Bebida Energética'),
(47, 'Monster', 4, '2026-06-01', 3.25, 'Bebida Energética Ve'),
(48, 'Nestea', 3, '2025-12-20', 2.59, 'Chá Preto Limão'),
(49, 'Tropicana', 4, '2025-07-05', 3.99, 'Sumo Natural de Lara'),
(50, 'Adagio', 3, '2025-11-30', 2.75, 'Chá de Camomila'),
(51, 'antartica', 4, '2025-06-11', 2.25, 'Guarana'),
(52, 'antartica', 0, '2025-06-11', 2.25, 'Guarana');

-- --------------------------------------------------------

--
-- Estrutura para tabela `seccao`
--

CREATE TABLE `seccao` (
  `id_seccao` int(11) NOT NULL,
  `nome_seccao` varchar(20) NOT NULL,
  `id_trabalhador` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `seccao`
--

INSERT INTO `seccao` (`id_seccao`, `nome_seccao`, `id_trabalhador`, `id_produto`) VALUES
(1, 'Geladeiras', 1, 1),
(2, 'Laticínios', 2, 2),
(3, 'Cafés e Chás', 3, 3),
(4, 'Sumos e Bebidas', 4, 4),
(5, 'Óleos e Azeites', 5, 5),
(6, 'Massas e Arroz', 6, 6),
(7, 'Molhos e Condimentos', 7, 7),
(8, 'Congelados', 8, 8),
(9, 'Peixaria', 9, 9),
(10, 'Iogurtes e Sobremesa', 10, 10),
(11, 'Cereais e Pequeno-al', 11, 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `trabalhadores`
--

CREATE TABLE `trabalhadores` (
  `id_trabalhador` int(11) NOT NULL,
  `nome_trabalhador` varchar(20) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `data_nascimento` date NOT NULL,
  `numero_telefone` int(10) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `trabalhadores`
--

INSERT INTO `trabalhadores` (`id_trabalhador`, `nome_trabalhador`, `genero`, `data_nascimento`, `numero_telefone`, `email`) VALUES
(1, 'João Silva', 'M', '1985-03-15', 912345678, 'joao.silva@email.com'),
(2, 'Maria Fernandes', 'F', '1990-07-22', 913456789, 'maria.fernandes@email.com'),
(3, 'Carlos Sousa', 'M', '1982-11-10', 914567890, 'carlos.sousa@email.com'),
(4, 'Ana Pereira', 'F', '1995-06-05', 915678901, 'ana.pereira@email.com'),
(5, 'Ricardo Santos', 'M', '1988-04-18', 916789012, 'ricardo.santos@email.com'),
(6, 'Sofia Gomes', 'F', '1993-09-30', 917890123, 'sofia.gomes@email.com'),
(7, 'Miguel Costa', 'M', '1980-12-25', 918901234, 'miguel.costa@email.com'),
(8, 'Patrícia Rocha', 'F', '1991-08-14', 919012345, 'patricia.rocha@email.com'),
(9, 'André Ribeiro', 'M', '1987-05-21', 920123456, 'andre.ribeiro@email.com'),
(10, 'Beatriz Almeida', 'F', '1996-03-10', 921234567, 'beatriz.almeida@email.com'),
(11, 'Fernando Lopes', 'M', '1979-11-07', 922345678, 'fernando.lopes@email.com'),
(12, 'Carolina Mendes', 'F', '1994-02-28', 923456789, 'carolina.mendes@email.com'),
(13, 'Tiago Matos', 'M', '1986-10-05', 924567890, 'tiago.matos@email.com'),
(14, 'Vanessa Nunes', 'F', '1992-07-19', 925678901, 'vanessa.nunes@email.com'),
(15, 'Rui Batista', 'M', '1984-09-12', 926789012, 'rui.batista@email.com'),
(16, 'Inês Figueiredo', 'F', '1993-01-23', 927890123, 'ines.figueiredo@email.com'),
(17, 'Pedro Carvalho', 'M', '1981-06-29', 928901234, 'pedro.carvalho@email.com'),
(18, 'Cátia Monteiro', 'F', '1997-08-08', 929012345, 'catia.monteiro@email.com'),
(19, 'Alexandre Pinto', 'M', '1989-05-11', 930123456, 'alexandre.pinto@email.com'),
(20, 'Raquel Sousa', 'F', '1998-12-24', 931234567, 'raquel.sousa@email.com'),
(21, 'Luís Fernandes', 'M', '1978-03-30', 932345678, 'luis.fernandes@email.com'),
(22, 'Cláudia Marques', 'F', '1991-09-17', 933456789, 'claudia.marques@email.com'),
(23, 'João Mendes', 'M', '1985-07-05', 934567890, 'joao.mendes@email.com'),
(24, 'Margarida Antunes', 'F', '1990-04-22', 935678901, 'margarida.antunes@email.com'),
(25, 'Bruno Teixeira', 'M', '1983-11-15', 936789012, 'bruno.teixeira@email.com'),
(26, 'Liliana Castro', 'F', '1992-06-07', 937890123, 'liliana.castro@email.com'),
(27, 'Hugo Martins', 'M', '1980-08-28', 938901234, 'hugo.martins@email.com'),
(28, 'Sandra Ribeiro', 'F', '1995-03-13', 939012345, 'sandra.ribeiro@email.com'),
(29, 'Diogo Lopes', 'M', '1987-05-27', 940123456, 'diogo.lopes@email.com'),
(30, 'Tatiana Rocha', 'F', '1996-09-09', 941234567, 'tatiana.rocha@email.com'),
(31, 'Paulo Almeida', 'M', '1979-12-31', 942345678, 'paulo.almeida@email.com'),
(32, 'Mónica Martins', 'F', '1994-01-02', 943456789, 'monica.martins@email.com'),
(33, 'Nelson Cardoso', 'M', '1986-10-19', 944567890, 'nelson.cardoso@email.com'),
(34, 'Adriana Lima', 'F', '1991-08-25', 945678901, 'adriana.lima@email.com'),
(35, 'Fábio Gonçalves', 'M', '1984-04-10', 946789012, 'fabio.goncalves@email.com'),
(36, 'Teresa Simões', 'F', '1993-05-14', 947890123, 'teresa.simoes@email.com'),
(37, 'Ricardo Nogueira', 'M', '1982-09-21', 948901234, 'ricardo.nogueira@email.com'),
(38, 'Vera Neves', 'F', '1997-11-02', 949012345, 'vera.neves@email.com'),
(39, 'Manuel Costa', 'M', '1978-07-09', 950123456, 'manuel.costa@email.com'),
(40, 'Débora Correia', 'F', '1990-02-26', 951234567, 'debora.correia@email.com'),
(41, 'Gonçalo Faria', 'M', '1985-10-30', 952345678, 'goncalo.faria@email.com'),
(42, 'Sónia Magalhães', 'F', '1992-12-15', 953456789, 'sonia.magalhaes@email.com'),
(43, 'Eduardo Tavares', 'M', '1989-06-20', 954567890, 'eduardo.tavares@email.com'),
(44, 'Carla Leite', 'F', '1995-07-04', 955678901, 'carla.leite@email.com'),
(45, 'António Barbosa', 'M', '1981-03-18', 956789012, 'antonio.barbosa@email.com'),
(46, 'Joana Mendes', 'F', '1996-05-08', 957890123, 'joana.mendes@email.com'),
(47, 'Bruno Correia', 'M', '1983-08-22', 958901234, 'bruno.correia@email.com'),
(48, 'Daniela Fonseca', 'F', '1994-09-12', 959012345, 'daniela.fonseca@email.com'),
(49, 'Francisco Lemos', 'M', '1987-11-27', 960123456, 'francisco.lemos@email.com'),
(50, 'Helena Oliveira', 'F', '1999-01-30', 961234567, 'helena.oliveira@email.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `seccao`
--
ALTER TABLE `seccao`
  ADD PRIMARY KEY (`id_seccao`);

--
-- Índices de tabela `trabalhadores`
--
ALTER TABLE `trabalhadores`
  ADD PRIMARY KEY (`id_trabalhador`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `seccao`
--
ALTER TABLE `seccao`
  MODIFY `id_seccao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `trabalhadores`
--
ALTER TABLE `trabalhadores`
  MODIFY `id_trabalhador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
