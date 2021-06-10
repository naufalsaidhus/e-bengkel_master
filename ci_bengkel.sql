-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2021 pada 09.28
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_bengkel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL,
  `noser` varchar(255) NOT NULL,
  `loklat` varchar(255) DEFAULT NULL,
  `namlat` varchar(255) DEFAULT NULL,
  `konlat` varchar(255) DEFAULT NULL,
  `jenlat` varchar(255) DEFAULT NULL,
  `jumlat` int(255) DEFAULT NULL,
  `ketlat` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `id_peminjaman_alat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`id_alat`, `noser`, `loklat`, `namlat`, `konlat`, `jenlat`, `jumlat`, `ketlat`, `image`, `status`, `id_peminjaman_alat`) VALUES
(21, 'SE123', 'Di Atas Rak', 'Kabel Jumper', 'Baik', 'Tidak Sekali Pakai', 2, '', 'jumper.jpg', 'Tersedia', 0),
(22, 'SE124', 'Di Atas Rak', 'Arduino Uno', 'Baik', 'Tidak Sekali Pakai', 2, '', 'Arduino_uno.jpg', 'Dipinjam', 0),
(23, 'SE125', 'Di Atas Rak', 'Baterai', 'Baik', 'Sekali Pakai', 2, 'Baterai ABC', 'baterai.png', 'Tersedia', 0),
(24, 'SE129', 'Di Atas Rak', 'Nodemcu', 'Baik', 'Sekali Pakai', 2, 'Node Mcu', 'nodemcu.png', 'Tersedia', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `alat_id` int(11) NOT NULL,
  `jumlah_pinjam` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_keranjang` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `alat_id`, `jumlah_pinjam`, `user_id`, `status_keranjang`) VALUES
(3, 22, 0, 20, 'Dipinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_alat_laporan` int(11) NOT NULL,
  `id_user_laporan` int(11) NOT NULL,
  `tanggal_laporan_pinjam` varchar(128) NOT NULL,
  `tanggal_pengembalian` varchar(128) NOT NULL,
  `status_laporan_guru` varchar(128) NOT NULL,
  `status_laporan_siswa` varchar(128) NOT NULL,
  `status_laporan_aspiran` varchar(128) NOT NULL,
  `status_laporan_kapbeng` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_alat_peminjaman` int(11) NOT NULL,
  `jumlah_alat` int(11) NOT NULL,
  `tanggal_peminjaman` varchar(128) NOT NULL,
  `tanggal_pengembalian` varchar(128) NOT NULL,
  `status_peminjaman` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `images` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `images`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(15, 'Aspiran', 'aspiransmk09@gmail.com', 'default.jpg', '$2y$10$EO0qMXDfZoXVYyleaOL77O/vcueS/xZg03xZL4XevKMEcMYv/RJPq', 2, 1, 1589103188),
(16, 'Kepala Bengkel', 'kapbengsmk09@gmail.com', 'default.jpg', '$2y$10$Mo.hP2JdT82x2N01jTV3aObNUmMKScD6ciI3tPip0J.eu6LNWKOa6', 1, 1, 1589103268),
(17, 'Guru', 'gurusmk09@gmail.com', 'default.jpg', '$2y$10$HGsq4OC3PjCmRo7v//cH6uGVi4CkgnbUwxsYOX4lyYvpwE43D/ItC', 3, 1, 1622175443),
(20, 'Naufal Saidhus', 'naufalsaidhus09@gmail.com', 'default.jpg', '$2y$10$0o60GrxJX2uLRHXqt/WzMOKVSQssjn6P9D8Mx2HfIAh1Si292LdSu', 4, 1, 1622176508);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Kapbeng'),
(2, 'Aspiran'),
(3, 'Guru'),
(4, 'Siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'gurusmk09@gmail.com', 'Jx6mOAZqFQ/rCPJCl5PnAIT0x8NElSJsuwT86RDgQiE=', 1622165718),
(2, 'gurusmk09@gmail.com', 'DsusM/6tBunN8Jc+liTJVJubkhGrpz0YSmxEpRbUc+g=', 1622172256),
(3, 'kapbengsmk09@gmail.com', '08S/7pXBTStEskTKek+NTYcZq9Q7oVp/ZDXU1Sc99Pc=', 1622172293),
(4, 'kapbengsmk09@gmail.com', 'kyd+lJEt/P1iZM9cTgdVPpzXqIwwikSn21Vbkrr0IzU=', 1622172297),
(5, 'aspiransmk09@gmail.com', 'BKx4kBxf4Knfij6ZKRiDG6KmDagIWpFBe+TxhdT2wt8=', 1622173780),
(6, 'gurusmk09@gmail.com', 'tcVIxaAI9SCZCYUrMV0XbgcT/x6JJO1n9GVuyIMTNXY=', 1622174119),
(7, 'gurusmk09@gmail.com', 'zJJg0ILqi1uL8IvteC4ei54AVwLzy6QeRTOfMN6ZQK8=', 1622174323),
(8, 'gurusmk09@gmail.com', 'sCt/K7pZKlOS7iZIAXAIspOuhkgG7PON/qsmXee/7lI=', 1622174931),
(9, 'gurusmk09@gmail.com', 'N6GiN7CKp5Ci1/6YmRNwI+2v6gwH41aHZ7669q33pKY=', 1622175015),
(10, 'gurusmk09@gmail.com', 'GgXjomXOSJEEShUTFD2GNAhCVftZSsEtatMSOZUyKrk=', 1622175136),
(11, 'gurusmk09@gmail.com', 'wb0fISUdPia3jk2o1HofluCXicPUc6AwaoWihMffOPc=', 1622175389),
(12, 'gurusmk09@gmail.com', 'fIH55fYDoG4aPiJnrA9yqZ13QRO4gU48p3NSgHZvf40=', 1622175443),
(15, 'aspiransmk09@gmail.com', 'vu/iCiOn5NeF/qpEYd9XZlRvEdV4zcGsp6uv/oT4HKU=', 1622175819),
(16, 'aspiransmk09@gmail.com', '1lMTXpr+lkBDskVHEpRs51VY0+L3XQ0p+8jNbuSTfxk=', 1622176133);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
