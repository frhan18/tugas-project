-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2022 pada 03.00
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_akademik2022`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(50) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `id_dosen` varchar(20) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dosen`
--

INSERT INTO `tb_dosen` (`id_dosen`, `nip`, `nama`, `email`, `jenis_kelamin`) VALUES
('1001', '300522001', 'Andri Basuki', 'andribasuki@gmail.com', 'L'),
('1003', '300522002', 'zulfikar', 'dosen@email.com', 'L'),
('1102', '300522004', 'Annisa Fitria', 'annniza@yyyy.com', 'P'),
('1103', '070622001', 'Putri', NULL, 'P');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(11) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id`, `kode_kelas`, `nama_kelas`) VALUES
(18, 'FNG1', 'Regular A'),
(22, 'FNG2', 'Regular B'),
(23, 'FNG3', 'Regular C'),
(24, 'FNG4', 'Regular D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_krs`
--

CREATE TABLE `tb_krs` (
  `id` int(11) NOT NULL,
  `id_mata_kuliah` varchar(10) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `sks` int(3) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `semester` int(3) NOT NULL,
  `kode_prodi` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id_user` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tempat_tanggal_lahir` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `tahun_masuk` varchar(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kode_kelas` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`id_user`, `nim`, `nama`, `email`, `tempat_tanggal_lahir`, `jenis_kelamin`, `agama`, `tahun_masuk`, `alamat`, `kode_kelas`) VALUES
(2, '15200212', 'Farhan ', 'farhan18apr02@gmail.com', 'Jakarta, 18 april 2002', 'L', 'Islam', '2020', 'Bekasi', 'FNG1'),
(3, '15200051', 'Ananda Putra Apriadi', NULL, 'Jakarta, 03 mei 2000', 'L', 'Islam', '2020', 'Bekasi', 'FNG1'),
(4, '15200333', 'Aqshal Farhan Maulana', NULL, 'Jakarta, 03 mei 2000', 'L', 'Islam', '2020', 'Bekasi', 'FNG1'),
(5, '15200316', 'Arya Ibnu Safar', NULL, 'Jakarta, 03 mei 2000', 'L', 'Islam', '2020', 'Bekasi', 'FNG1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mata_kuliah`
--

CREATE TABLE `tb_mata_kuliah` (
  `id_mata_kuliah` varchar(10) NOT NULL,
  `nama_mata_kuliah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_mata_kuliah`
--

INSERT INTO `tb_mata_kuliah` (`id_mata_kuliah`, `nama_mata_kuliah`) VALUES
('MK001', 'Sistem basis data'),
('MK002', 'Pemograman Berorientasi Objek'),
('MK003', 'Bahasa Inggris'),
('MK004', 'Algoritma Pemograman'),
('MK005', 'Web programming 2'),
('MK006', 'Dasar pemrograman'),
('MK008', 'Mobile programming'),
('MK009', 'Pemrograman berbasis objek'),
('MK011', 'Interaksi manusia komputer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `nim` varchar(15) DEFAULT NULL,
  `id_mata_kuliah` varchar(10) DEFAULT NULL,
  `id_dosen` varchar(20) DEFAULT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perkuliahan`
--

CREATE TABLE `tb_perkuliahan` (
  `id` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `kode_kelas` varchar(15) NOT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `hari` varchar(50) NOT NULL,
  `id_mata_kuliah` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `kode_prodi` varchar(11) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_prodi`
--

INSERT INTO `tb_prodi` (`kode_prodi`, `nama_prodi`) VALUES
('BI', 'Bahasa inggris'),
('IK', 'Ilmu komunikasi'),
('IKOM', 'Ilmu komputer'),
('SI', 'Sistem informasi'),
('SIA', 'Sistem informasi akuntansi'),
('TI', 'Teknik informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(150) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `password_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `image`, `role_id`, `is_active`, `date_created`, `updated_at`, `password_update`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$Mz/DqIgwImRqDjuT8Jes5uyxJ6DasV6F2onudBFdbLpQc6TBDFLoi', 'defaul.svg', 1, 1, 1653429150, 0, 0),
(2, 'Farhan', '15200212@gmail.com', '$2y$10$40ZV4zexzSpYvEL0ks6wTevwRSP8txr7ocybrSts2oa1r.FHjaHai', 'default.svg', 2, 1, 1654347949, 0, 1654362671),
(3, 'Ananda Putra Apriadi', '15200051@gmail.com', '$2y$10$.opx3ukEE3L1IZJcWk50/e/veD3mMwfcb1o6vnOvIuOO2gWNIa7uO', 'default.svg', 2, 1, 1654354681, 0, 1654354681),
(4, 'Aqshal Farhan Maulana', '15200333@gmail.com', '$2y$10$uSedEa3/srfF28XGTRLaz.7z/UC91wYuSSWYDVx7mJqpZWzpeLd1S', 'default.svg', 2, 1, 1654355295, 0, 1654355295),
(5, 'Arya Ibnu Safar', '15200316@gmail.com', '$2y$10$wNMpHLUP8z7Fl0VA6Hp4o.EMZP12K.9PvKy9CxMWqpvPXw/Xsyp9e', 'default.svg', 2, 1, 1654355476, 0, 1654355476),
(6, 'Bait Almaqdis', '15200313@gmail.com', '$2y$10$SOX7/MItIm1WpQZfiVxp/u6cj0oEgMuomh7.ZydOaqLVyDc.jJeWG', 'default.svg', 2, 1, 1654355626, 0, 1654355626),
(7, 'Barkah Herdiyanto Sejati', '15200065@gmail.com', '$2y$10$b6DTOFw6z0h7aq5HhXtEvOnp7HDH9HCedgeXiw6DuhtLRk9WIEIcy', 'default.svg', 2, 1, 1654356012, 0, 1654356012),
(8, 'Chandra Halim', '15200221@gmail.com', '$2y$10$bTZg9hlvOaKX5QNMJNUN8eBtdhrNtgSUY9tpJrEnz5G3FZF1b7QgG', 'default.svg', 2, 1, 1654356038, 0, 1654356038),
(9, 'Diana Aulia', '15200066@gmail.com', '$2y$10$KsDoV1NYeCeLYkG2c554UO7ZDw/5b34hPTf7MgX3sTwNcv5RlibEW', 'default.svg', 2, 1, 1654356057, 0, 1654356057),
(10, 'Dimas Miftakhul Fakri', '15200304@gmail.com', '$2y$10$1R0L5CApxxdd0wuOJ9JXTePkjdzIn7SKX7YlQ5r/shUXE8Df5A5TG', 'default.svg', 2, 1, 1654356072, 0, 1654356072),
(11, 'Dyah Suryaningtyas', '15200380@gmail.com', '$2y$10$G1B1X2tYiuTp7f/fuDnnr.w/gyVDTITx1ErFbvX0BgMLLOGokFUGW', 'default.svg', 2, 1, 1654356090, 0, 1654356090),
(12, 'Evan Ananda Putra', '15200127@gmail.com', '$2y$10$jUU.yEw1zkxeNK4E4DyWnecBg6FUvQinL80T.IZIjVa053vDd8Q5a', 'default.svg', 2, 1, 1654356106, 0, 1654356106),
(13, 'Fajar Rahman', '15200285@gmail.com', '$2y$10$lhFybwdzGXWfzzWhfHX1se.M1GHQNw3K8AkmPe/E1K44wg85abTPO', 'default.svg', 2, 1, 1654356126, 0, 1654356126),
(14, 'Farhanul Ibaad', '15200010@gmail.com', '$2y$10$P9giHVDpN96OmY7yB2GS3uIwWNdBoFCTkd/QFY4uivDAjW01agu4W', 'default.svg', 2, 1, 1654356148, 0, 1654356148),
(15, 'Fiqri Alamsyah Siregar', '15200145@gmail.com', '$2y$10$kY48rKHnGYz.Nsk5gbtbzexZIbOmoYjzaINeyK63g5SCAUMJ62MOO', 'default.svg', 2, 1, 1654356168, 0, 1654356168),
(16, 'Firda Putri Azzahra', '15200181@gmail.com', '$2y$10$/T9W3z63ylWOg4..Fc1uJeNP64ah0uaM5tVV4lSkOFXLiRaiWFC8W', 'default.svg', 2, 1, 1654356196, 0, 1654356196),
(17, 'Giery Bagas Maylando', '15200363@gmail.com', '$2y$10$XSljBt7R9/.nDjjFe/UVUu5oekNktwmJNNeSQmxNEpb3JjEHa0LN6', 'default.svg', 2, 1, 1654356214, 0, 1654356214),
(18, 'Lingga Aryadi', '15200001@gmail.com', '$2y$10$nUrW5ilwaRt56PMB6zPcCeWguPj79K84q4JcrLkdZIYUZPf/JfTF6', 'default.svg', 2, 1, 1654356241, 0, 1654356241),
(19, 'Muhammad Fauzan', '15200187@gmail.com', '$2y$10$iS/Y.bpqyZlVNW3ltQo8ue0FxVk/Z0gKg/rGMfgeC2ZsP/9bYkIQK', 'default.svg', 2, 1, 1654356259, 0, 1654356259),
(20, 'Muhammad Rizqy Abdullah Isnaini', '15200355@gmail.com', '$2y$10$d1/oLb6A4P7BH.f8mCJp1.XSFW13ZHwkg3mqgmw9d5hBE7.Gb5gn2', 'default.svg', 2, 1, 1654356278, 0, 1654356278),
(21, 'Raudhatus Sa\'adah', '15200109@gmail.com', '$2y$10$DZKqeJbe3AFRv5c/zOTzVuGseXfneGeXXbxUQ2ltMU2MUlq/z.zVi', 'default.svg', 2, 1, 1654356297, 0, 1654356297),
(22, 'Renaldi', '15200100@gmail.com', '$2y$10$7qQDjr1E2YxqKWWqtbrBoe69vWl6vYspYuHbQu./g9cla0GBlhxDu', 'default.svg', 2, 1, 1654356323, 0, 1654356323),
(23, 'Rika Natalia', '15200283@gmail.com', '$2y$10$nU1Cfz8w.HqJaBlwAuyKludkAHr6goy0OZv6o2VEOEYjksFuEMIGy', 'default.svg', 2, 1, 1654356340, 0, 1654356340),
(24, 'Rizka Rosalinda Pratiwi', '15200021@gmail.com', '$2y$10$6oP9PZPD8yAFLfpQPDn7L.uHwo7oO5newy.K/JH/PH2qe/Fm5ASgG', 'default.svg', 2, 1, 1654356367, 0, 1654356367),
(25, 'Rozan Sanura Albary', '15200372@gmail.com', '$2y$10$AhAaYjCwi85vMb6Gju/SueSpaxZsdk5C7gZAHnBg0p1PdKZOMalhC', 'default.svg', 2, 1, 1654356382, 0, 1654356382),
(26, 'Ryanto Alfa Mario Siki', '15200326@gmail.com', '$2y$10$i06WjuvkqeqgHOoT0gT3sOU1fhmiCoZBaKj8cnM8tF9voDenjYpHW', 'default.svg', 2, 1, 1654356397, 0, 1654356397),
(27, 'Satria Hadinugraha Mulya', '15200156@gmail.com', '$2y$10$sS24AfCarFn3MEry8kOpCOV/0Q1D535Tf7qslElb5zay5AUVeI4ki', 'default.svg', 2, 1, 1654356411, 0, 1654356411),
(28, 'Tony Pradana', '15200112@gmail.com', '$2y$10$ofYTFDXuPy.qmnSs.OIhwOvoB.rWks0XsESEyX1ACSdmxJEPpi/si', 'default.svg', 2, 1, 1654356427, 0, 1654356427);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 1, 3),
(4, 2, 2),
(5, 2, 5),
(6, 1, 6),
(8, 6, 1),
(9, 6, 3),
(10, 6, 4),
(11, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Administrator'),
(2, 'User menu'),
(3, 'Data master'),
(4, 'Management Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 4, 'Menu management', 'menu/index', 'fas fa-fw fa-folder', 1),
(2, 4, 'Submenu management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(3, 4, 'Access menu', 'menu/access', 'fas fa-fw fa-key', 1),
(4, 1, 'Dashboard', 'dashboard', 'fas fa-fw fa-tachometer-alt', 0),
(5, 3, 'Data Mahasiswa', 'mahasiswa/list', 'fas fa-fw fa-user-graduate', 1),
(6, 3, 'Data Dosen', 'dosen/list', 'fas  fa-fw fa-chalkboard-teacher', 1),
(7, 3, 'Data Matakuliah', 'matakuliah/list', 'fas fa-fw fa-book', 1),
(8, 3, 'Data Kelas', 'kelas/list', 'fas fa-fw fa-building', 1),
(9, 3, 'Data Krs', 'krs/list', 'fas fa-fw fa-bookmark', 1),
(10, 4, 'Role access', 'menu/role_access', 'fas fa-fw fa-universal-access', 1),
(11, 2, 'Home', 'users/index', 'fas fa-fw fa-home', 1),
(13, 5, 'Krs', 'users/krs', 'fas fa-fw fa-bookmark', 1),
(15, 5, 'Jadwal kuliah ', 'users/jadwal_kuliah', 'fas fa-fw fa-calendar-check', 1),
(16, 3, 'Data Prodi', 'prodi/list', 'fas fa-fw fa-book-open', 1),
(18, 2, 'Profile', 'users/profile', 'fas fa-fw fa-user', 1),
(21, 3, 'Data Perkuliahan', 'perkuliahan/list', 'fas fa-fw fa-graduation-cap', 1),
(22, 1, 'Profile', 'setting-profile', 'fas fa-fw fa-user', 1),
(24, 1, 'Blog', 'post', 'fas fa-fw fa-blog', 1),
(25, 1, 'User account', 'user-account', 'fas fa-fw fa-users', 1),
(26, 0, '', '', '', 1),
(27, 2, 'Jadwal perkuliahan', 'users/perkuliahan', 'fas fa-fw fa-calendar-check', 1),
(28, 2, 'Data KRS', 'users/krs', 'fas fa-fw fa-bookmark', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_krs`
--
ALTER TABLE `tb_krs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tb_mata_kuliah`
--
ALTER TABLE `tb_mata_kuliah`
  ADD PRIMARY KEY (`id_mata_kuliah`);

--
-- Indeks untuk tabel `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `tb_perkuliahan`
--
ALTER TABLE `tb_perkuliahan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`kode_prodi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_krs`
--
ALTER TABLE `tb_krs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_perkuliahan`
--
ALTER TABLE `tb_perkuliahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
