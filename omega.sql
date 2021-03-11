-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Mar 2021 pada 17.20
-- Versi server: 5.7.32
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connexis_siswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_achievements`
--

CREATE TABLE `omega_achievements` (
  `id` int(11) NOT NULL,
  `user_staff` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_achievements`
--

INSERT INTO `omega_achievements` (`id`, `user_staff`, `target`, `year`) VALUES
(1, '18', '100', '2021'),
(2, '18', '32', '2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_attachments`
--

CREATE TABLE `omega_attachments` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_branches`
--

CREATE TABLE `omega_branches` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_branches`
--

INSERT INTO `omega_branches` (`id`, `code`, `name`, `city`, `address`) VALUES
(1, '001', 'Jakarta', 'DKI Jakarta', ''),
(2, '002', 'Bandung', 'Bandung', ''),
(4, ' 003', 'Cinere', 'Depok', ''),
(15, ' 004', 'Medan', 'medan', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_comments`
--

CREATE TABLE `omega_comments` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `comment_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_comments`
--

INSERT INTO `omega_comments` (`id`, `username`, `comment`, `created`, `updated`, `student_id`, `comment_by`) VALUES
(107, 'counselor', 'tes', '2021-02-10 12:07:10', '2021-02-10 12:07:10', 252, 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_criteria`
--

CREATE TABLE `omega_criteria` (
  `id` int(11) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `country_university` varchar(255) NOT NULL,
  `period_of_study` varchar(50) NOT NULL,
  `univ_program_of_study` varchar(255) NOT NULL,
  `current_level_of_study` varchar(255) NOT NULL,
  `student` int(11) NOT NULL,
  `admission_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_criteria`
--

INSERT INTO `omega_criteria` (`id`, `university_name`, `country_university`, `period_of_study`, `univ_program_of_study`, `current_level_of_study`, `student`, `admission_by`) VALUES
(27, '17', 'Australia', '09-2021 - 09-2023', 'CS', 'as', 253, 19),
(28, '20', 'Australia', '09-2021 - 09-2023', 'Computer Science', 'Undergraduate', 252, 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_events`
--

CREATE TABLE `omega_events` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `event` text NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_qoutes`
--

CREATE TABLE `omega_qoutes` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_qoutes`
--

INSERT INTO `omega_qoutes` (`id`, `username`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Edmund Burke', 'The only thing necessary for the triumph of evil is for good men to do nothing', '2021-01-09 17:57:57', '2021-01-09 17:57:57'),
(3, 'Lucretius', 'The fall of dropping water wears away the Stone.', '2021-01-09 18:00:10', '2021-01-09 18:00:10'),
(4, 'Orson Welles', 'We\'re born alone, we live alone, we die alone. Only through our love and friendship can we create the illusion for the moment that we\'re not alone.', '2021-01-14 13:18:13', '2021-01-14 13:18:13'),
(5, 'Orson Welles', 'I have an unfortunate personality.', '2021-01-14 13:18:13', '2021-01-14 13:18:13'),
(7, 'Bill Gates', 'Your most unhappy customers are your greatest source of learning.', '2021-02-02 22:42:41', '2021-02-02 22:42:41'),
(8, 'Bill Gates', 'Success is a lousy teacher. It seduces smart people into thinking they can\'t lose.', '2021-02-02 22:43:44', '2021-02-02 22:43:44'),
(9, 'Indrarose', 'ahai', '2021-02-10 16:40:59', '2021-02-10 16:40:59'),
(10, 'Indrarose', 'Ok Ok ', '2021-02-10 16:43:14', '2021-02-10 16:43:14'),
(11, 'Indra', 'Yes', '2021-02-10 17:05:35', '2021-02-10 17:05:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_reports`
--

CREATE TABLE `omega_reports` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `student` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_reports`
--

INSERT INTO `omega_reports` (`id`, `date`, `user_id`, `student_id`, `student`, `status`, `comment`) VALUES
(146, '2021-02-10 12:07:09', 18, 252, 'ALEXANDRA AXELA SAHASIKA SAGE', '', 'tes'),
(147, '2021-02-11 05:43:18', 13, 253, 'FIRDAUS ARI VIANTI HAKIM', 'Goal', ''),
(148, '2021-03-07 07:25:53', 18, 0, 'ALEXANDRA AXELA SAHASIKA SAGE', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_report_calendar`
--

CREATE TABLE `omega_report_calendar` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `admission_by` int(11) NOT NULL,
  `counselor_by` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_report_calendar`
--

INSERT INTO `omega_report_calendar` (`id`, `date`, `admission_by`, `counselor_by`, `student_id`) VALUES
(1, '2021-02-23', 0, 18, 256),
(2, '2021-02-23', 0, 18, 257),
(3, '2021-02-24', 0, 18, 258),
(4, '2021-03-07', 19, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_roles`
--

CREATE TABLE `omega_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_roles`
--

INSERT INTO `omega_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admission', '2021-01-08 03:13:20', '2021-01-08 03:13:20'),
(2, 'counselor', '2021-01-08 03:13:20', '2021-01-08 03:13:20'),
(3, 'admin', '2021-01-08 03:13:20', '2021-01-08 03:13:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_schools`
--

CREATE TABLE `omega_schools` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_schools`
--

INSERT INTO `omega_schools` (`id`, `country`, `area`, `name`, `website`, `address`) VALUES
(1, 'Indonesia', 'West Jakarta', 'SMA Pah Tsung', '', 'Komp. Citypark Blok A4, Cengkareng'),
(2, 'Indonesia', 'West Jakarta', 'SMA Narada', '', 'Perum. Kosambi Baru Blok A Ext-1, Jln. Kosambi Baru No.9, Cengkareng'),
(3, 'Indonesia', 'West Jakarta', 'Mentari Intercultural School Grand Surya', '', 'Perum. Taman Surya 6, Jln. ParadiseBoulevard Utara Blok Paradise No.16, Kalideres'),
(4, 'Indonesia', 'West Jakarta', 'SMA Mahabodhi Vidya', '', 'Jln. Palem Anggur No.Kav.8, Kalideres'),
(5, 'Indonesia', 'West Jakarta', 'SMA Citra Kasih Citragarden', '', 'Perumahan Citra Garden City 5 blok H3'),
(6, 'Indonesia', 'West Jakarta', 'SMA Dian Harapan Daan Mogot', '', 'Jln. Bedugul No.8 ( Daan Mogot Baru ) Kalideres'),
(7, 'Indonesia', 'West Jakarta', 'SMA Kristen Tiara Kasih', '', 'Jln. Dharma Jaya Blok C1, Taman Semanan Indah, Kalideres'),
(8, 'Indonesia', 'West Jakarta', 'SMA Kairos Gracia', '', 'Jln. Citra 7 No.5, Kalideres ( Citra Garden Ext2 )'),
(9, 'Indonesia', 'West Jakarta', 'SMA Kanaan Global School', '', 'Jln. Taman Surya Boulevard No.3 Blok L2, Kalideres '),
(10, 'Indonesia', 'West Jakarta', 'SMA National High Jakarta School', '', 'Jln. Pos Pengumben No.41, Kembangan'),
(11, 'Indonesia', 'West Jakarta', 'SMA Kristen IPEKA Puri ', '', 'Perum. Puri Indah, Puri Indah Blok I, Kembangan '),
(12, 'Indonesia', 'West Jakarta', 'SMA Notre Dame  ', '', 'Jln. Puri Kembangan Barat Raya Blok M Puri Indah, Kembangan '),
(13, 'Indonesia', 'West Jakarta', 'SMA Raffles Christian School K.Jeruk', '', 'Jln. Meruya Llir No.89, Kembangan '),
(14, 'Indonesia', 'West Jakarta', 'SMA Ipeka Intregated Christian School ', '', 'Komp. Taman Meruya Llir, Jln. Batu Mulia Blok K'),
(15, 'Indonesia', 'West Jakarta', 'SMa Global Sevilla Puri Indah', '', 'Jln. Kembangan Raya No.1, Kembangan - Puri Indah'),
(16, 'Indonesia', 'West Jakarta', 'SMA Bukit Sion ', '', 'Perum. Corn Kebun Jeruk Blok G7, Kembangan '),
(17, 'Indonesia', 'West Jakarta', 'SMA Springfield', '', 'Jln. Pulau Tidung , Taman Permata , Kembangan'),
(18, 'Indonesia', 'West Jakarta', 'SMA Tunas Muda', '', 'Jln. Meruya Utara No.71, Kembangan '),
(19, 'Indonesia', 'West Jakarta', 'SMA Tarsisius II', '', 'Jln. Batusari Raya No.12, Kebon Jeruk'),
(20, 'Indonesia', 'West Jakarta', 'SMA Ichtus West Jakarta', '', 'Komp. Sunrise Garden Jln. Surya Mandala III Blok N II No.11'),
(21, 'Indonesia', 'West Jakarta', 'SMA Penabur 4', '', 'Komp. Sunrise Garden Jln. Surya Sarana Kedoya Utara '),
(22, 'Indonesia', 'West Jakarta', 'SMA Katolik Sang Timur', '', 'Jln. Karmel Raya No.8, Kebon Jeruk'),
(23, 'Indonesia', 'West Jakarta', 'SMA Kristen Ipeka Tomang', '', 'Jln. Green Ville Blok D, Kebon Jeruk '),
(24, 'Indonesia', 'West Jakarta', 'SMA Bina Bangsa School ', '', 'Jln. Arjuna Selatan Kav.87, Kebon Jeruk'),
(25, 'Indonesia', 'West Jakarta', 'SMA Penabur 1', '', 'Jln. Tanjung Duren Raya No.4, Grogol Pertamburan'),
(26, 'Indonesia', 'SOUTH JAKARTA', 'SMA Cita Buana', '', 'Jln. Paso No.84, Jagakarsa'),
(27, 'Indonesia', 'SOUTH JAKARTA', 'SMA Heritage School', '', 'Belezza Permata Hijau, Jln. Arteri Permata Hijau No.34, Kby.lama'),
(28, 'Indonesia', 'SOUTH JAKARTA', 'SMA Tirtamarta Penabur', '', 'Jln. Sekolah Kencana IV(Pondok Indah), Kby.lama'),
(29, 'Indonesia', 'SOUTH JAKARTA', 'SMA Bakti Mulya 400', '', 'Jln. Lingkar Selatan(Pondok Indah), Kby.lama'),
(30, 'Indonesia', 'SOUTH JAKARTA', 'SMA Raffles Christian School P.Indah', '', 'Jln. Gedung Hijau Raya I(Pondok Indah), No.1, Kby.lama'),
(31, 'Indonesia', 'SOUTH JAKARTA', 'SMA Bina Nusantara Simprug', '', 'Jln. Sultan Iskandar Muda Kav. G-8'),
(32, 'Indonesia', 'SOUTH JAKARTA', 'SMA Gonzaga', '', 'Jln. Pejaten Barat 10A, Pasar Minggu'),
(33, 'Indonesia', 'SOUTH JAKARTA', 'SMA ACG School Jakarta', '', 'Jln. Warung Jati Barat No.19, Pasar Minggu'),
(34, 'Indonesia', 'SOUTH JAKARTA', 'SMA Australia Independent School', '', 'Jln. Pejaten Barat No.69, Pasar Minggu'),
(35, 'Indonesia', 'SOUTH JAKARTA', 'SMA Ichtus South Jakarta', '', 'Jln. Caringin Barat No.1, Cilandak'),
(36, 'Indonesia', 'SOUTH JAKARTA', 'SMA Seruni Don Bosco ', '', 'Jln. Duta Indah , Cilandak'),
(37, 'Indonesia', 'SOUTH JAKARTA', 'SMA Jakarta Intercultural School', '', 'Jln. Terogong Raya No.33, Cilandak'),
(38, 'Indonesia', 'SOUTH JAKARTA', 'SMA SIS Bona Vista', '', 'Jln. Bona Vista Raya Lebak Bulus, Cilandak '),
(39, 'Indonesia', 'SOUTH JAKARTA', 'SMA High Scope', '', 'Jln. TB Simatupang No. 8, Cilandak'),
(40, 'Indonesia', 'SOUTH JAKARTA', 'SMA Tarakanita 1', '', 'Jln. Pulo Raya IV No.17, Kby.baru'),
(41, 'Indonesia', 'SOUTH JAKARTA', 'SMA Pangudi Luhur 1', '', 'Jln. Brawijaya IV No.47, Kby.baru'),
(42, 'Indonesia', 'SOUTH JAKARTA', 'SMA Charitas', '', 'Jln. Mawar Indah No.75, Cilandak'),
(43, 'Indonesia', 'SOUTH JAKARTA', 'Mentari Intercultural School Cipete', '', 'Jln. H. Jian No.2, Cipete-Kby.baru'),
(44, 'Indonesia', 'SOUTH JAKARTA', 'El Shadai Intercontinental School', '', 'Jln. Pos Pengumben No.40, Pesanggrahan'),
(45, 'Indonesia', 'SOUTH JAKARTA', 'SMA Asisi Jakarta Selatan', '', 'Jln. K.H. Ramli No.24, Tebet'),
(46, 'Indonesia', 'SOUTH JAKARTA', 'SMa Pelita Harapan International ', '', 'Jln. Pangeran Antasari No.36, Mampang prpt'),
(47, 'Indonesia', 'SOUTH JAKARTA', 'SMA IIHS', '', 'Palma One, Jln. Hr. Rasuna Said No.4th floor, Setiabudi'),
(48, 'Indonesia', 'NORTH JAKARTA', 'SMA Kristen IPEKA Sunter', '', 'Jln. Baru, Sunter Agung, Tanjung Priok '),
(49, 'Indonesia', 'NORTH JAKARTA', 'SMA Jubilee ', '', 'Jln. Kali Busa No.1, Sunter Agung, Tanjung Priok'),
(50, 'Indonesia', 'NORTH JAKARTA', 'SMA Pelangi Kasih', '', 'PIK - Taman Grisenda Blok A1 No.28, Penjaringan'),
(51, 'Indonesia', 'NORTH JAKARTA', 'SMA Saint Nicholas', '', 'PIK - Jln. Pantai Indah Utara Blok S No.8, Penjaringan '),
(52, 'Indonesia', 'NORTH JAKARTA', 'SMA SIS PIK ', '', 'PIK - Jln. Mandara Indah 4 No.6, Penjaringan '),
(53, 'Indonesia', 'NORTH JAKARTA', 'SMA Tzu Chi', '', 'PIK - Pantai Indah Kapuk Boulevard, Penjaringan'),
(54, 'Indonesia', 'NORTH JAKARTA', 'SMA Penabur 6', '', 'Jln. Muara Karang Blok 23S, Penjaringan'),
(55, 'Indonesia', 'NORTH JAKARTA', 'SMA IPEKA PLUIT', '', 'Jln. Pluit Timur Raya Blok B No.1, Penjaringan '),
(56, 'Indonesia', 'NORTH JAKARTA', 'SMA Permai ', '', 'Jln. Pluit Karang Barat Blok O-VI No. 128, Penjaringan '),
(57, 'Indonesia', 'NORTH JAKARTA', 'SMA Bina Tunas Bangsa', '', 'Jln. Pluit Timur Blok MM, Penjaringan'),
(58, 'Indonesia', 'NORTH JAKARTA', 'SMA Bina Bangsa School ', '', 'PIK - Jln. Walet Elok 8 Blok R-8 No.1, Penjaringan '),
(59, 'Indonesia', 'NORTH JAKARTA', 'SMA Beacon Academy', '', 'Jln. Pegangsaan Dua No.66, Kelapagading'),
(60, 'Indonesia', 'NORTH JAKARTA', 'SMA SIS Kelapa Gading', '', 'Jln. Pegangsaan Dua No.83, Kelapagading'),
(61, 'Indonesia', 'NORTH JAKARTA', 'SMA Don Bosco 1', '', 'Jln. Boulevard Timur No.8, Kelapagading'),
(62, 'Indonesia', 'NORTH JAKARTA', 'SMA Penabur 5', '', 'Jln. Hibrida Raya Blok QA3, Kelapagading'),
(63, 'Indonesia', 'NORTH JAKARTA', 'SMA Saint Peter', '', 'Jln. Boulevard Timur No. 8, Kelapagading'),
(64, 'Indonesia', 'NORTH JAKARTA', 'SMA Santo Yakobus', '', 'Jln. Pegangsaan Dua No.12, Kelapagading'),
(65, 'Indonesia', 'NORTH JAKARTA', 'SMA jakarta Taipei School', '', 'Jln. Raya Kelapa Hibrida, Kelapagading '),
(66, 'Indonesia', 'NORTH JAKARTA', 'SMA Universal', '', 'Jln. Boulevard Barat No.1, Kelapagading'),
(67, 'Indonesia', 'NORTH JAKARTA', 'SMA Mahatma Gading Intercultural School', '', 'Komp. Villa Gading Indah Blok Q, Jln. Boulevard BGR, Kelapagading'),
(68, 'Indonesia', 'NORTH JAKARTA', 'SMA North Jakarta Intercultural School', '', 'Jln. Boulevard Bukit Gading Raya, Kelapagading'),
(69, 'Indonesia', 'NORTH JAKARTA', 'SMA Raffles Christian School, Klpgading', '', 'Jln. Arteri Kelapa Gading No.1, Kelapagading'),
(70, 'Indonesia', 'NORTH JAKARTA', 'SMA Penabur international School', '', 'Jln. Boulevard Bukit Gading Raya A5-8, Kelapagading'),
(71, 'Indonesia', 'NORTH JAKARTA', 'SMA Bunda Mulia School', '', 'Jln. Lodan Raya No.2, Ancol'),
(72, 'Indonesia', 'NORTH JAKARTA', 'SMA Al Azhar Kelapa Gading', '', ''),
(73, 'Indonesia', 'NORTH JAKARTA', 'SMA Gandhi Ancol', '', 'Jln. Pangandaran I, Ancol'),
(74, 'Indonesia', 'CENTRAL JAKARTA', 'SMA K Calvin', '', 'Komp. RMCI (Menara Calvin), Jln. Industri Blok B14 Kav-1, Kemayoran'),
(75, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Penabur 3', '', 'Jln. Gunung Sahari Raya No.90A, Kemayoran'),
(76, 'Indonesia', 'CENTRAL JAKARTA', 'SMA GMIS', '', 'Komp. Kota Baru kemayoran Blok D6, Jln. H.B.R Motik, Kemayoran'),
(77, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Universal', '', 'Jln. Ruas D7, Blok D6, Kemayoran'),
(78, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Penabur 2', '', 'Jln. Pintu Air Raya No.11, Sawahbesar'),
(79, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Santa Ursula ', '', 'Jln. Pos 2 Pasar baru, Sawahbesar'),
(80, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Mahatma Gandhi School ', '', 'Komp. Kemayoran Blok B16 No.2, Sawahbesar'),
(81, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Kristen Ketapang 1', '', 'Jln. Kyai H. Zainul Arifin No.35-37, Gambir'),
(82, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Tarsisius I', '', 'Jln. KH. Hasyim Ashari No.26, Gambir'),
(83, 'Indonesia', 'CENTRAL JAKARTA', 'SMA PSKD 1', '', 'Jln. Pangeran Diponegoro No.80, Senen'),
(84, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Perkumpulan Mandiri', '', 'Jln. DR GSSY Ratulangi No.5&14, Menteng'),
(85, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Kanisius', '', 'Jln. Menteng Raya No.64, Menteng'),
(86, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Santo Bellarminus', '', 'Jln. Lombok No. 58, Menteng'),
(87, 'Indonesia', 'CENTRAL JAKARTA', 'SMA Santa Theresia', '', 'Jln. H. Agus Salim No.75, Menteng'),
(88, 'Indonesia', 'EAST JAKARTA', 'SMA Global Mandiri', '', 'Jln. Raya Cakung Cilincing KM.5, Cakung'),
(89, 'Indonesia', 'EAST JAKARTA', 'SMA Don Bosco 2', '', 'Jln. Pulomas Barat V Kayu Putih, Pulogadung'),
(90, 'Indonesia', 'EAST JAKARTA', 'SMA Global Sevilla Pulomas', '', 'Jln. Pulomas Jaya No.1, Pulogadung'),
(91, 'Indonesia', 'Tangerang-Serpong', 'SMA Tarsisius Vireta', '', 'Jln. Danau Singkarak Raya Vila Regensi II, Blok AE 8-9, Pasar Kemis'),
(92, 'Indonesia', 'Tangerang-Serpong', 'SMA Pahoa', '', 'Jln. Ki Hajar Dewantara, No. 1, Kelapadua'),
(93, 'Indonesia', 'Tangerang-Serpong', 'SMA Pelita Harapan Karawaci', '', 'Boulevard Palem Raya Lippo VillageNo. 2500, Kelapadua'),
(94, 'Indonesia', 'Tangerang-Serpong', 'SMA Stella Maris School', '', 'Sektor 8A, Vatican Cluster, Gading Serpong, Kelapadua'),
(95, 'Indonesia', 'Tangerang-Serpong', 'UPH College', '', 'Jln MH Thamrin Boulevard 1100 Lippo Village ,UPH Building E'),
(96, 'Indonesia', 'Tangerang-Serpong', 'SMAK Penabur Gading Serpong', '', 'Jln. Kelapa Gading Barat Raya Gading Serpong, Tangerang'),
(97, 'Indonesia', 'Tangerang-Serpong', 'SMA Tarakanita Gading Serpong', '', 'Jln. Raya Kelapa Cengkir Tengah No.1 Sektor 7 Gading Serpong, Tangerang'),
(98, 'Indonesia', 'Tangerang-Serpong', 'SMA Tunas Mulia Gading Serpong', '', 'Jln. Boulevard Rusia Block CB 6 No. 57 Sektor 1 C Gading Serpong, Tangerang'),
(99, 'Indonesia', 'Tangerang-Serpong', 'SMA Penabur Kota Tangerang', '', 'Jln.  Honoris Raya Blok J 10 Kota Modern, Tangerang'),
(100, 'Indonesia', 'Tangerang-Serpong', 'SMA RICCI 2 Tangerang', '', 'Jln. Utama II No.1-2  Pondok Karya, Pondok Aren Tangerang'),
(101, 'Indonesia', 'Tangerang-Serpong', 'SMAK Penabur Bintaro', '', 'Jln. Haji Som No.35, Pondok Aren Tangerang Selatan'),
(102, 'Indonesia', 'Tangerang-Serpong', 'SMA Plus Pembangunan Jaya', '', 'Jln. Taman Makam Bahagia ABRI Bintaro Jaya Sektor IX, Pondok Aren '),
(103, 'Indonesia', 'Tangerang-Serpong', 'British School ', '', 'Jln. Raya Jombang-Ciledug Bintaro Sektor 9, Pondok Aren'),
(104, 'Indonesia', 'Tangerang-Serpong', 'Global Jaya School', '', 'Jln. Emerald Boulevard Bintaro Jaya Sektor IX, Tangerang'),
(105, 'Indonesia', 'Tangerang-Serpong', 'Mentari Intercultural School', '', 'Jln. Perigi Baru No.7A Pondok Aren, Tangerang '),
(106, 'Indonesia', 'Tangerang-Serpong', 'Kharisma Bangsa School', '', 'Jln. Terbang Layang no.21 Pondok Cabe, Tangerang Selatan'),
(107, 'Indonesia', 'Tangerang-Serpong', 'Global Islamic School', '', 'Jln. Puspiptek Raya, Buaran, Tangerang Selatan'),
(108, 'Indonesia', 'Tangerang-Serpong', 'Anderson School', '', 'Jln. Nias Raya No.11, Rw. Mekar Jaya, Serpong'),
(109, 'Indonesia', 'Tangerang-Serpong', 'Ehipassiko School BSD', '', 'Jalan Letnan Sutopo Kav. B2 No.1-2 Sektor XIV.4 BSD City,'),
(110, 'Indonesia', 'Tangerang-Serpong', 'SMA Santa Ursula BSD', '', 'Jln. Letnan Sutopo Sektor I.2, BSD, Tangerang Selatan'),
(111, 'Indonesia', 'Tangerang-Serpong', 'St. John\'s Catholic School', '', 'Jln. Boulevard Horizon Broadway M1 No. 1-2, BSD City'),
(112, 'Indonesia', 'Tangerang-Serpong', 'Sinarmas World Academy', '', 'Jln. TM Pahlawan Seribu CBD Loy XV, BSD City'),
(113, 'Indonesia', 'Tangerang-Serpong', 'Jakarta Multicultural School', '', 'Jln. Pisangan Raya No 99 Cirendeu, Ciputat Timur'),
(114, 'Indonesia', 'Tangerang-Serpong', 'SMA Abdi Siswa Serpong', '', 'Jln. Graha Raya Bunga Kav. M9 No. 1, Pondok Jagung Timur, Serpong Utara'),
(115, 'Indonesia', 'Tangerang-Serpong', 'SMA Santa Laurensia Alam Sutera', '', 'Sutera Utama No.1, Alam Sutera, Serpong'),
(116, 'Indonesia', 'Tangerang-Serpong', 'SMA Santa Laurensia Cikupa', '', 'Jln. Suvarna Sutera, Cikupa'),
(117, 'Indonesia', 'Tangerang-Serpong', 'SMA Candle Tree', '', 'Jln. Jati Jelupang No.1, Jelupang, Kec. Serpong Utara,'),
(118, 'Indonesia', 'Tangerang-Serpong', 'Binus School Serpong', '', 'Jln. Lengkong Karya  Jelupang No. 58, Lengkong Karya, Serpong'),
(119, 'Indonesia', 'Tangerang-Serpong', 'SMA Athalia ', '', 'Regensi Melati Mas Blok B-14, Serpong Utara, Tangerang Selatan'),
(120, 'Indonesia', 'Tangerang-Serpong', 'Jaya Plus Montessori School', '', 'Jln. Mawi No.39, Graha Raya Bintaro Jaya, Pondok Jagung Timur, Serpong Utara'),
(121, 'Indonesia', 'Bogor', 'SMAK Penabur Kota Wisata', '', 'Jln. Transyogi km 6 Perumahan Kota Wisata, Gunung Putri, Bogor'),
(122, 'Indonesia', 'Bogor', 'Sekolah Kristen Ketapang 3', '', 'Perum Legenda Wisata Zona Napoleon Blok E/A, Cibubur'),
(123, 'Indonesia', 'Bogor', 'SMA Global Mandiri Cibubur', '', 'Jln. Alternatif Transyogi KM 6 , Cibubur'),
(124, 'Indonesia', 'Bogor', 'SMA Citra Berkat Cibubur', '', 'Jln. Raya Cileungsi  Jonggol Km. 23,2 - Citra Indah, Bogor'),
(125, 'Indonesia', 'Bogor', 'Sekolah Pelita Harapan Cibubur', '', 'Jln. Babakan Madang Sentul City, Bogor'),
(126, 'Indonesia', 'Bogor', 'SMA Cahaya Rancamaya Cibubur', '', 'Jln. Rancamaya No.30, Bogor Selatan'),
(127, 'Indonesia', 'Bogor', 'SMAK Penabur Bogor', '', 'Jln. Paledang No.39 Paledang, Kota Bogor'),
(128, 'Indonesia', 'Bogor', 'SMA Regina Pacis Bogor', '', 'Jln. Ir H Juanda no. 2, Bogor'),
(129, 'Indonesia', 'Bogor', 'SMA Kosgoro Bogor', '', 'Jln. Raya Pajajaran No. 217 A, Bogor'),
(130, 'Indonesia', 'Bogor', 'SMA Kesatuan Bogor', '', 'Jln. Raya Pajajaran Kompleks Pulo Armen, Baranangsiang, Bogor Timur'),
(131, 'Indonesia', 'Depok', 'Depok Montessori School', '', 'Depok Maharaja D7-1, Jalan Sawangan Raya Mampang,Depok, '),
(132, 'Indonesia', 'Depok', 'SMA Pribadi', '', 'Jln. Margonda Raya No.229, Kemiri Muka Beji, Depok'),
(133, 'Indonesia', 'Depok', 'Springfield School', '', 'Jl.n Alternatif Cibubur, Harjamukti, Kec. Cimanggis Kota Depok'),
(134, 'Indonesia', 'Depok', 'Sekolah CIta Persada', '', 'Jln. Cinere Raya No.3 Kec.Cinere, Depok'),
(135, 'Indonesia', 'Bekasi', 'Binus School Bekasi', '', 'Jln. Saraswati No.1, RT.001/RW.010, Bumiwedari Vida, Bekasi'),
(136, 'Indonesia', 'Bekasi', 'Sekolah Victory Plus Bekasi', '', 'Jl Kemang Pratama Raya AN 2 - 3, RT.004/RW.001, Bojong Rawalumbu, Bekasi'),
(137, 'Indonesia', 'Bekasi', 'Royal Wells School Bekasi', '', 'Jln. Puncak Cikunir No.25, RT.002/RW.015, Jakasampurna, Bekasi Barat'),
(138, 'Indonesia', 'Bekasi', 'Cherry Montessori Bekasi', '', 'Boulevard Harapan Indah 2 Blok RV 2 No.10, RT.10/RW.8, Pusaka Rakyat, Bekasi'),
(139, 'Indonesia', 'Bekasi', 'Unity School Bekasi', '', 'UNITY Building, Central Park, Grand Galaxy City, Kota Bekasi'),
(140, 'Indonesia', 'Bekasi', 'John\'s Paul School Bekasi', '', 'Jl. Harapan Indah Bulevar Sektor V, HArapan Indah, Bekasi'),
(141, 'Indonesia', 'Bekasi', 'Global Prestasi School Bekasi', '', 'Jln. KH. Noer Ali No.10B, RT.008/RW.002, Jakasampurna, Bekasi'),
(157, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_statuses_admission`
--

CREATE TABLE `omega_statuses_admission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_statuses_admission`
--

INSERT INTO `omega_statuses_admission` (`id`, `name`, `created`, `updated`) VALUES
(7, 'Apply', '2021-01-12 09:48:41', '2021-01-12 09:48:41'),
(8, 'CLO', '2021-01-12 09:48:41', '2021-01-12 09:48:41'),
(9, 'FLO', '2021-01-12 09:48:53', '2021-01-12 09:48:53'),
(10, 'Paid', '2021-01-12 09:48:53', '2021-01-12 09:48:53'),
(11, 'Visa', '2021-01-12 09:49:09', '2021-01-12 09:49:09'),
(12, 'Visa Rejected', '2021-01-12 09:49:09', '2021-01-12 09:49:09'),
(13, 'Goal', '2021-01-12 09:49:22', '2021-01-12 09:49:22'),
(14, 'Declined', '2021-01-12 09:49:22', '2021-01-12 09:49:22'),
(15, 'Cancelled', '2021-01-12 09:49:30', '2021-01-12 09:49:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_statuses_counselor`
--

CREATE TABLE `omega_statuses_counselor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_statuses_counselor`
--

INSERT INTO `omega_statuses_counselor` (`id`, `name`, `created`, `updated`) VALUES
(1, 'Unhandled', '2021-01-08 10:26:27', '2021-01-08 10:26:27'),
(2, 'In Progress', '2021-01-08 10:26:27', '2021-01-08 10:26:27'),
(3, 'Hot Prospect', '2021-01-08 10:26:27', '2021-01-08 10:26:27'),
(4, 'Prospect', '2021-01-08 10:26:27', '2021-01-08 10:26:27'),
(5, 'Future Prospect', '2021-01-08 10:26:27', '2021-01-08 10:26:27'),
(6, 'Not Prospect', '2021-01-12 15:20:10', '2021-01-12 15:20:10'),
(7, 'Apply', '2021-01-08 10:26:27', '2021-01-08 10:26:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_statuses_sources`
--

CREATE TABLE `omega_statuses_sources` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_statuses_sources`
--

INSERT INTO `omega_statuses_sources` (`id`, `name`, `created`, `updated`) VALUES
(1, 'System', '2021-01-18 16:55:12', '2021-01-18 16:55:12'),
(2, 'Call in', '2021-01-18 16:55:12', '2021-01-18 16:55:12'),
(3, 'Walk in', '2021-01-18 16:56:04', '2021-01-18 16:56:04'),
(4, 'Refferal family/friends', '2021-01-18 16:56:04', '2021-01-18 16:56:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_students`
--

CREATE TABLE `omega_students` (
  `id` int(11) NOT NULL,
  `msisdn` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `parents` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `flag` int(1) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `handled_by` int(11) NOT NULL,
  `admission_by` int(10) UNSIGNED NOT NULL,
  `future` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `source` int(11) DEFAULT NULL,
  `ssa_no` varchar(255) NOT NULL,
  `university_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_students`
--

INSERT INTO `omega_students` (`id`, `msisdn`, `first_name`, `last_name`, `email`, `password`, `birth_date`, `birth_place`, `address`, `city`, `postal_code`, `parents`, `status`, `flag`, `school_id`, `created`, `updated`, `handled_by`, `admission_by`, `future`, `date`, `source`, `ssa_no`, `university_id`) VALUES
(251, '082144568241', 'BENEDICTUS PATRICK GUNAWAN', '', '', '9e2f4', '2003', '', 'Street no. / Name', 'Jakarta', '', 'ERNY KARWELO', 1, 1, 1, '2021-02-07 10:44:54', '2021-02-07 10:44:54', 18, 0, NULL, NULL, 1, '001/JKT/COUNSELOR/02-21', 0),
(252, '081275359335', 'ALEXANDRA AXELA SAHASIKA SAGE', '', '', '609a0', '2003', '', 'Street no. / Name', 'Jakarta', '', 'MARIA RETNO ENDRIARTI', 7, 1, 1, '2021-02-07 10:44:54', '2021-02-07 10:44:54', 18, 19, NULL, NULL, 1, '001/JKT/COUNSELOR/02-21', 0),
(253, '081243975522', 'FIRDAUS ARI VIANTI HAKIM', '', '', '08626', '2003', '', 'Street no. / Name', 'Jakarta', '', 'TITI MUJIASTUTI', 13, 1, 1, '2021-02-07 10:44:54', '2021-02-07 10:44:54', 18, 19, NULL, NULL, 1, '001/JKT/COUNSELOR/02-21', 0),
(254, '081379481914', 'BEACTRICH CECILIA GULTOM', '', '', 'cf719', '2003', '', 'DWI WARGA TUNGGAL JAYA, RT.3, RW.3, Kec.BANJAR AGUNG, Kel.DWI WARGA TUNGGAL JAYA', 'TULANG BAWANG, LAMPUNG', '', 'YANTI DOLMA MARLINA NAINGGOLA', 1, 1, 1, '2021-02-07 10:45:08', '2021-02-07 10:45:08', 24, 0, NULL, NULL, 1, '002/BDG/GHINA/02-21', 0),
(255, '085288945548', 'RAFYOKRI SANDY', '', '', 'f2690', '2003', '', 'KP. SERPONG, RT.2, RW.1, Kec.SERPONG, Kel.SERPONG', 'KOTA TANGERANG SELATAN, BANTEN', '', 'FITRI YENI', 1, 1, 1, '2021-02-10 04:16:17', '2021-02-10 04:16:17', 18, 0, NULL, NULL, 1, '001/JKT/COUNSELOR/02-21', 0),
(256, '081216886632', 'ROBBY ZIDNIY ILMAN', '', '', '9cb15', '2003', '', 'Street no. / Name', 'Jakarta', '', 'USWATUN HASANAH DIENY, SE.', 1, 1, 1, '2021-02-23 16:52:00', '2021-02-23 16:52:00', 18, 0, NULL, NULL, 1, '001/JKT/COUNSELOR/02-21', 0),
(257, '08214454102', 'JULIANA O. ENOK', '', '', '4b04f', '2003', '', 'Street no. / Name', 'Jakarta', '', 'SOLFIANA AGUSTINA LENGGU', 1, 1, 1, '2021-02-23 16:52:01', '2021-02-23 16:52:01', 18, 0, NULL, NULL, 1, '001/JKT/COUNSELOR/02-21', 0),
(258, '081219010437', 'Terdaftar', '', '', '6f7ed', '2003', '', 'Terdaftar', 'Terdaftar', '', 'Terdaftar', 1, 1, 1, '2021-02-24 07:09:46', '2021-02-24 07:09:46', 18, 0, NULL, NULL, 1, '001/JKT/COUNSELOR/02-21', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_universities`
--

CREATE TABLE `omega_universities` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_universities`
--

INSERT INTO `omega_universities` (`id`, `country`, `area`, `name`, `website`) VALUES
(3, 'Australia', 'Sydney', 'University of Sydney', 'https://www.sydney.edu.au/'),
(4, 'Australia', 'Sydney', 'Taylors College Sydney', 'https://www.taylorssydney.edu.au/'),
(5, 'Australia', 'Sydney', 'William Blue Sydney', 'https://www.williamblue.edu.au/'),
(6, 'Australia', 'Sydney', 'University of New South Wales (UNSW)', 'https://www.unsw.edu.au/'),
(7, 'Australia', 'Sydney', 'University of New South Wales International (UNSW)', 'https://www.international.unsw.edu.au/'),
(8, 'Australia', 'Sydney', 'University of Technology Sydney', 'https://www.uts.edu.au/'),
(9, 'Australia', 'Sydney', 'Macquarie College', 'https://www.macquariecollege.nsw.edu.au/'),
(10, 'Australia', 'Sydney', 'Kaplan Business School', 'https://www.kbs.edu.au/'),
(11, 'Australia', 'Sydney', 'Macquarie University', 'https://www.mq.edu.au/'),
(12, 'Australia', 'Sydney', 'Australian Catholic University', 'https://www.acu.edu.au/'),
(13, 'Australia', 'Sydney', 'Western Sydney University', 'https://www.westernsydney.edu.au/'),
(14, 'Australia', 'Sydney', 'UTS Insearch', 'https://www.insearch.edu.au/'),
(15, 'Australia', 'Sydney', 'Blue Mountains International Hotel Management School', 'https://www.bluemountains.edu.au/'),
(16, 'Australia', 'Sydney', 'Le Cordon Bleu Australia', 'https://www.cordonbleu.edu/sydney/home/en'),
(17, 'Australia', 'Sydney', 'Billy Blue College of Design', 'https://www.billyblue.edu.au/'),
(18, 'Australia', 'Sydney', 'Charles Darwin University', 'https://www.cdu.edu.au/'),
(19, 'Australia', 'Melbourne', 'University of Melbourne', 'https://www.unimelb.edu.au/'),
(20, 'Australia', 'Melbourne', 'Monash University Melbourne', 'https://www.monash.edu/'),
(21, 'Australia', 'Melbourne', 'Monash College (Monash College City Campus)', 'https://www.monashcollege.edu.au/'),
(22, 'Australia', 'Melbourne', 'RMIT University (Royal Melbourne Institute of Technology)', 'https://www.rmit.edu.au/'),
(23, 'Australia', 'Melbourne', 'RMIT University (Royal Melbourne Institute of Technology)', 'https://www.rmit.edu.au/about/schools-colleges'),
(24, 'Australia', 'Melbourne', 'Deakin University', 'https://www.deakin.edu.au/'),
(25, 'Australia', 'Melbourne', 'Deakin College', 'https://www.deakincollege.edu.au/'),
(26, 'Australia', 'Melbourne', 'La Trobe University', 'https://www.latrobe.edu.au/'),
(27, 'Australia', 'Melbourne', 'Swinburne University of Technology', 'https://www.swinburne.edu.au/'),
(28, 'Australia', 'Melbourne', 'Trinity College Foundation Studies', 'https://www.trinity.unimelb.edu.au/'),
(29, 'Australia', 'Melbourne', 'Victoria University', 'https://www.vu.edu.au/'),
(30, 'Australia', 'Adelaide', 'Torrens University Australia', 'https://www.torrens.edu.au/'),
(31, 'Australia', 'Adelaide', 'The University of Adelaide', 'https://international.adelaide.edu.au'),
(32, 'Australia', 'Brisbane', 'The University of Queensland', 'https://www.uq.edu.au/'),
(33, 'Australia', 'Brisbane', 'Griffith University', 'https://www.griffith.edu.au/'),
(34, 'Australia', 'Brisbane', 'Griffith College, Mount Gravatt', 'https://www.griffithcollege.edu.au/'),
(35, 'Australia', 'Perth', 'The University of WA', 'https://www.uwa.edu.au/'),
(36, 'USA', 'Washington', 'Seattle Community College North Campus', 'https://northseattle.edu/'),
(37, 'USA', 'Washington', 'Bates Technical College', 'https://www.batestech.edu/'),
(38, 'USA', 'Washington', 'Clark College', 'http://www.clark.edu/'),
(39, 'USA', 'Washington', 'Highline Community College', 'https://www.highline.edu/'),
(40, 'USA', 'Washington', 'Green River Community College', 'https://www.greenriver.edu/'),
(41, 'USA', 'Washington', 'Tacoma Community College', 'https://www.tacomacc.edu/'),
(42, 'USA', 'Washington', 'Shoreline Community College', 'https://www.shoreline.edu/'),
(43, 'USA', 'Washington', 'Edmonds Community College', 'https://www.edmonds.edu/'),
(44, 'USA', 'Washington', 'Bellevue College', 'https://www.bellevuecollege.edu/'),
(45, 'USA', 'Washington', 'Everett Community College', 'https://www.everettcc.edu/'),
(46, 'USA', 'Washington', 'South Puget Sound Community College', 'https://spscc.edu/'),
(47, 'USA', 'California', 'De Anza College', 'https://www.deanza.edu/'),
(48, 'USA', 'California', 'Glendale Community College', 'https://www.glendale.edu/'),
(49, 'USA', 'California', 'Pasadena City College', 'https://pasadena.edu/'),
(50, 'USA', 'California', 'Orange Coast College', 'https://prod.orangecoastcollege.edu/'),
(51, 'USA', 'California', 'Santa Barbara City College', 'https://www.sbcc.edu/'),
(52, 'USA', 'California', 'Berkeley City College', 'https://www.berkeleycitycollege.edu/wp/'),
(53, 'USA', 'California', 'Mt. San Antonio College Library', 'https://www.mtsac.edu/'),
(54, 'USA', 'California', 'Diablo Valley College', 'https://www.dvc.edu/'),
(55, 'USA', 'California', 'Ohlone', 'https://www.ohlone.edu/'),
(56, 'USA', 'California', 'Santa Monica College', 'https://www.smc.edu/'),
(57, 'USA', 'California', 'Cuesta College', 'https://www.cuesta.edu/'),
(58, 'USA', 'Boston', 'Shorelight Education', 'https://www.shorelight.com/'),
(59, 'CHINA', 'Ningbo', 'University of Nottingham Ningbo China', 'https://www.nottingham.edu.cn/cn/'),
(60, 'CHINA', 'Suzhou', 'Blue Mountains China', 'http://www.bluemountainschina.cn/'),
(61, 'CHINA', 'Jiangsu', 'Xi\'an Jiaotong-Liverpool University', 'https://www.xjtlu.edu.cn/en/'),
(62, 'Singapore', 'Singapore', 'singapore institute of management', 'https://www.sim.edu.sg/Pages/index.aspx'),
(63, 'Singapore', 'Singapore', 'Kaplan Singapore', 'https://www.kaplan.com.sg/'),
(64, 'Singapore', 'Singapore', 'Kaplan Higher Education Academy', 'http://eduworld.co.id/study/singapore/kaplan-higher-education-academy/'),
(65, 'Singapore', 'Singapore', 'Management Development Institute of Singapore (MDIS)', 'https://www.mdis.edu.sg/'),
(66, 'Singapore', 'Singapore', 'PSB Academy', 'https://www.psb-academy.edu.sg/'),
(67, 'Singapore', 'Singapore', 'London School of Business and Finance', 'https://www.lsbf.org.uk/'),
(68, 'Singapore', 'Singapore', 'East Asia Institute of Management', 'https://www.eaim.edu.sg/en/'),
(69, 'Singapore', 'Singapore', 'TMC Academy', 'https://www.tmc.edu.sg/'),
(70, 'Singapore', 'Singapore', 'Raffles Design Institute Singapore', 'https://www.studyatraffles.com/singapore/'),
(71, 'Singapore', 'Singapore', 'LASALLE College of the Arts', 'https://www.lasalle.edu.sg/'),
(72, 'Singapore', 'Singapore', 'William Angliss Institute', 'https://www.angliss.edu.sg/'),
(73, 'Singapore', 'Singapore', 'Shatec', 'http://www.shatec.sg/'),
(74, 'Singapore', 'Singapore', 'At-Sunrice GlobalChef Academy', 'https://at-sunrice.com/'),
(75, 'Singapore', 'Singapore', 'James Cook University Singapore', 'https://www.jcu.edu.sg/'),
(76, 'Malaysia', 'Malaysia', 'Monash University Malaysia', 'https://www.monash.edu.my/'),
(77, 'Malaysia', 'Malaysia', 'University of Nottingham Malaysia', 'https://www.nottingham.edu.my/index.aspx'),
(78, 'Malaysia', 'Malaysia', 'Heriot-Watt University', 'https://www.hw.ac.uk/malaysia/'),
(79, 'Malaysia', 'Malaysia', 'Swinburne University of Technology', 'https://www.swinburne.edu.my/'),
(80, 'Malaysia', 'Malaysia', 'Taylor\'s University', 'https://taylors.edu.my/'),
(81, 'Malaysia', 'Malaysia', 'Sunway University', 'https://university.sunway.edu.my/'),
(82, 'Malaysia', 'Malaysia', 'Asia Pacific University (APU)', 'http://www.apu.edu.my/'),
(83, 'Malaysia', 'Malaysia', 'INTI International University', 'https://newinti.edu.my/'),
(84, 'Malaysia', 'Malaysia', 'SEGi University', 'https://www.segi.edu.my/'),
(85, 'Malaysia', 'Malaysia', 'UCSI University', 'https://www.ucsiuniversity.edu.my/'),
(86, 'Malaysia', 'Malaysia', 'Sunway Le Cordon Bleu- Best Culinary, Baking & Pastry School in Malaysia', 'https://lecordonbleusunway.com.my/'),
(87, 'Malaysia', 'Malaysia', 'The One Academy', 'https://www.toa.edu.my/'),
(88, 'Malaysia', 'Malaysia', 'Limkokwing University Malaysia', 'https://www.limkokwing.net/'),
(89, 'UK', 'UK', 'Bath Academy', 'https://www.bathacademy.co.uk/'),
(90, 'UK', 'UK', 'King\'s College London', 'https://www.kcl.ac.uk/'),
(91, 'UK', 'UK', 'Bell Cambridge', 'https://www.bellenglish.com/'),
(92, 'UK', 'UK', 'Kings', 'https://www.kingseducation.com/'),
(93, 'UK', 'UK', 'Bellerbys College', 'https://www.bellerbys.com/'),
(94, 'UK', 'UK', 'CATS Canterbury', 'https://www.catseducation.com/'),
(95, 'UK', 'UK', 'Cambridge School of Visual & Performing Arts', 'https://www.csvpa.com/'),
(96, 'UK', 'UK', 'Le Cordon Bleu London', 'https://www.cordonbleu.edu/london/home/en'),
(97, 'UK', 'UK', 'Kaplan International Pathways', 'https://kaplan.co.uk/'),
(98, 'Canada', 'Canada', 'Langara College', 'https://langara.ca/'),
(99, 'Canada', 'Canada', 'Douglass College', 'https://www.douglascollege.ca/'),
(100, 'Canada', 'Canada', 'Simon Fraser University', 'https://www.sfu.ca/bigpotential.html'),
(101, 'Canada', 'Canada', 'Navitas', 'https://www.navitas.com/'),
(102, 'Canada', 'Canada', 'Lasalle College', 'https://www.lasallecollege.com'),
(103, 'Canada', 'Canada', 'Le Cordon Bleu Ottawa Culinary Arts Institute', 'https://www.cordonbleu.edu/ottawa/en'),
(104, 'Canada', 'Canada', 'Columbia College', 'https://www.columbiacollege.ca/'),
(105, 'Switzerland', 'Switzerland', 'Les Roches Global Hospitality Education', 'https://lesroches.edu/'),
(106, 'Switzerland', 'Switzerland', 'Business & Hotel Management School (Bhms)', 'https://www.bhms.ch/'),
(107, 'Switzerland', 'Switzerland', 'Glion', 'https://www.glion.edu/'),
(108, 'Switzerland', 'Switzerland', 'European University Business School', 'https://www.euruni.edu/'),
(109, 'Switzerland', 'Switzerland', 'Hotel And Tourism Management Institute Switzerland (Htmi)', 'https://htmi.ch/'),
(110, 'Switzerland', 'Switzerland', 'International Management Institute', 'https://imi-luzern.com/'),
(111, 'Switzerland', 'Switzerland', 'Swiss College Of Hospitality Management', 'https://www.shms.com/en/'),
(112, 'New Zealand', 'Auckland', 'AUT New Zealand', 'https://www.aut.ac.nz/'),
(113, 'Indonesia', 'Indonesia', 'Jakarta International College', 'https://www.jic.ac.id/'),
(114, 'Indonesia', 'Indonesia', 'Unisadhuguna international College', 'http://uic-usg.com/'),
(115, 'Indonesia', 'Indonesia', 'Uniprep', 'http://uniprep-unsw.com/'),
(116, 'Indonesia', 'Indonesia', 'BII Pace', 'https://www.bii-pace.com/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omega_users`
--

CREATE TABLE `omega_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'enabled',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `omega_users`
--

INSERT INTO `omega_users` (`id`, `username`, `password`, `fullname`, `role`, `status`, `created`, `updated`, `branch_id`) VALUES
(13, 'admin', '$2y$10$aKvEtWVrbl/sGsUdKKJ7oeCL2WCXYW3g2rMFhPU5rvDRSq/u.7TUS', 'Admin', 3, 'enabled', '2021-01-12 03:12:33', NULL, 1),
(18, 'counselor', '$2y$10$.zov/yrV8ybH0VYq3PRAQ.0Z44z2MlGnbMvZ.nTpKXjn/aZ7NBoXa', 'counselor', 2, 'enabled', '2021-01-14 04:17:44', NULL, 1),
(19, 'admission', '$2y$10$Yg/59qX827iWjR.NaqckZOABwt1hIvZ3/683BRl.uuhuE08hN54pC', 'admission', 1, 'enabled', '2021-01-14 04:18:19', NULL, 1),
(24, 'Ghina', '$2y$10$fX6KhhyXIBcsAgGbeoH/HuPqdeVdVw8vSt8BEAFdAX0PasMP2uZnK', 'Ghina', 2, 'enabled', '2021-02-04 07:14:10', NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `omega_achievements`
--
ALTER TABLE `omega_achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_attachments`
--
ALTER TABLE `omega_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_branches`
--
ALTER TABLE `omega_branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `omega_comments`
--
ALTER TABLE `omega_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(191)),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `updated` (`updated`),
  ADD KEY `created` (`created`);

--
-- Indeks untuk tabel `omega_criteria`
--
ALTER TABLE `omega_criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_events`
--
ALTER TABLE `omega_events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_qoutes`
--
ALTER TABLE `omega_qoutes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_reports`
--
ALTER TABLE `omega_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_report_calendar`
--
ALTER TABLE `omega_report_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_roles`
--
ALTER TABLE `omega_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_schools`
--
ALTER TABLE `omega_schools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`(191),`country`(191),`website`(191)),
  ADD KEY `area` (`area`(191));

--
-- Indeks untuk tabel `omega_statuses_admission`
--
ALTER TABLE `omega_statuses_admission`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_statuses_counselor`
--
ALTER TABLE `omega_statuses_counselor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_statuses_sources`
--
ALTER TABLE `omega_statuses_sources`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `omega_students`
--
ALTER TABLE `omega_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `msisdn` (`msisdn`),
  ADD KEY `university_id` (`school_id`),
  ADD KEY `birth_date` (`birth_place`(191),`address`(191),`city`(191)),
  ADD KEY `created` (`created`,`updated`),
  ADD KEY `handled_by` (`handled_by`),
  ADD KEY `status` (`status`);

--
-- Indeks untuk tabel `omega_universities`
--
ALTER TABLE `omega_universities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`(191),`country`(191),`website`(191)),
  ADD KEY `area` (`area`(191));

--
-- Indeks untuk tabel `omega_users`
--
ALTER TABLE `omega_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created` (`created`),
  ADD KEY `status` (`status`(191)),
  ADD KEY `username` (`username`(191)),
  ADD KEY `role` (`role`),
  ADD KEY `branch_id` (`branch_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `omega_achievements`
--
ALTER TABLE `omega_achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `omega_attachments`
--
ALTER TABLE `omega_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `omega_branches`
--
ALTER TABLE `omega_branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `omega_comments`
--
ALTER TABLE `omega_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT untuk tabel `omega_criteria`
--
ALTER TABLE `omega_criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `omega_events`
--
ALTER TABLE `omega_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `omega_qoutes`
--
ALTER TABLE `omega_qoutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `omega_reports`
--
ALTER TABLE `omega_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT untuk tabel `omega_report_calendar`
--
ALTER TABLE `omega_report_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `omega_roles`
--
ALTER TABLE `omega_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `omega_schools`
--
ALTER TABLE `omega_schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT untuk tabel `omega_statuses_admission`
--
ALTER TABLE `omega_statuses_admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `omega_statuses_counselor`
--
ALTER TABLE `omega_statuses_counselor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `omega_statuses_sources`
--
ALTER TABLE `omega_statuses_sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `omega_students`
--
ALTER TABLE `omega_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT untuk tabel `omega_universities`
--
ALTER TABLE `omega_universities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT untuk tabel `omega_users`
--
ALTER TABLE `omega_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `omega_students`
--
ALTER TABLE `omega_students`
  ADD CONSTRAINT `omega_students_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `omega_schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `omega_users`
--
ALTER TABLE `omega_users`
  ADD CONSTRAINT `omega_users_ibfk_2` FOREIGN KEY (`role`) REFERENCES `omega_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `omega_users_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `omega_branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
