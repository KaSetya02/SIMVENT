-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Feb 2023 pada 19.47
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_inventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `lokasi` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_stok_keluar` BEFORE INSERT ON `barang_keluar` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` - NEW.jumlah_keluar WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` char(16) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_masuk` BEFORE INSERT ON `barang_masuk` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + NEW.jumlah_masuk WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hapus`
--

CREATE TABLE `hapus` (
  `id_hapus` int(11) NOT NULL,
  `id_aset` char(8) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `alasan` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hapus`
--

INSERT INTO `hapus` (`id_hapus`, `id_aset`, `tgl_pengajuan`, `alasan`, `id_user`) VALUES
(3, 'AS000003', '2022-07-23', 'Rusak', 1),
(4, 'AS000002', '2022-07-21', 'Tidak Layak Pakai', 4),
(5, 'AS000001', '2022-07-28', 'Tidak Layak Pakai', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `induk_inventaris`
--

CREATE TABLE `induk_inventaris` (
  `id_aset` char(8) NOT NULL,
  `nama_aset` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `klasifikasi_barang` varchar(20) NOT NULL,
  `keterangan` enum('Sedang Dipinjam','Tersedia','Baik','Rusak','Rusak Berat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `induk_inventaris`
--

INSERT INTO `induk_inventaris` (`id_aset`, `nama_aset`, `merk`, `tipe`, `klasifikasi_barang`, `keterangan`) VALUES
('AS000001', 'Kursi Belajar', 'Powder Coating dan PVC Vinyl', 'Chitose', 'KLS000001', 'Tersedia'),
('AS000002', 'Meja Belajar', 'Pesona Meja', 'Meja', 'KLS000002', 'Tersedia'),
('AS000003', 'InFocus', 'EPSON', '2 cm DLP x 1', 'KLS000003', 'Tersedia'),
('AS000004', 'Komputer', 'ASUS', 'Quantum', 'KLS000005', 'Tersedia'),
('AS000005', 'Kursi Lipat', 'Chitose', 'Chitose', 'KLS000001', 'Tersedia'),
('AS000006', 'Laptop', 'ASUS 456ur', 'VivoBook', 'KLS000007', 'Tersedia'),
('AS000007', 'TV', 'LG 82UP8000PTB', 'LED', 'KLS000008', 'Tersedia'),
('AS000008', 'Wifi', 'ASUS RT-AX55 AX1800', 'IEEE 809', 'KLS000009', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris`
--

CREATE TABLE `inventaris` (
  `id_barang` int(11) NOT NULL,
  `aset_id` char(8) NOT NULL,
  `no_seri` varchar(25) NOT NULL,
  `ukuran` varchar(25) NOT NULL,
  `bahan` varchar(25) NOT NULL,
  `tgl_pemb` date NOT NULL,
  `harga_bel` varchar(25) NOT NULL,
  `sumber_dana` varchar(25) NOT NULL,
  `ruang_id` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventaris`
--

INSERT INTO `inventaris` (`id_barang`, `aset_id`, `no_seri`, `ukuran`, `bahan`, `tgl_pemb`, `harga_bel`, `sumber_dana`, `ruang_id`, `foto`) VALUES
(1, 'AS000001', 'MJ001', '449 x 527 x 807', 'Powder Coating dan PVC Vi', '2022-05-16', '480000', 'Saham', 2, 'item-220723-9339d53832.jpg'),
(2, 'AS000004', 'KM000001', '32 inc', 'Intel® Core™ i3-10105 Pro', '2022-07-23', '8400000', 'Saham', 2, 'item-220723-5251846425.jpg'),
(3, 'AS000002', 'MJ000001', '120 x 50 x 70\",75\"', 'Kayu Rimba', '2022-07-23', '800000', 'Saham', 3, 'item-220723-8d9c04631c.jpg'),
(4, 'AS000003', 'INF000001', 'XGA (1024 x 768)', 'LCD Technology', '2022-07-23', '5900000', 'Saham', 2, 'item-220723-09f05a17e4.png'),
(5, 'AS000005', 'M000003', ' 449 X 521 X 818', 'Powder Coating dan PVC Vi', '2022-03-02', '165000', 'Saham', 14, 'item-220723-9e928dcf29.jpg'),
(6, 'AS000006', 'M000004', '14 inc', 'Intel Core i5-7200U 2.80G', '2022-05-30', '4499000', 'Yayasan', 2, 'item-220723-4ae08e3c9d.jpg'),
(7, 'AS000007', 'M000005', '80 Inc', 'Dolby Atmos & Dolby Visio', '2022-04-05', '31992000', 'Yayasan', 9, 'item-220723-ed34858405.jpg'),
(8, 'AS000008', 'M000005', 'Up to 54 Mbps', 'MU-MIMO and OFDMA technol', '2022-07-23', '101086', 'Saham', 15, 'item-220723-23cce9a54a.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` char(9) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
('KLS000001', 'Kursi'),
('KLS000002', 'Meja'),
('KLS000003', 'Proyektor'),
('KLS000004', 'Lemari'),
('KLS000005', 'Komputer'),
('KLS000006', 'Kursi lipat'),
('KLS000007', 'Laptop'),
('KLS000008', 'TV'),
('KLS000009', 'Wifi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi`
--

CREATE TABLE `kondisi` (
  `id_kondisi` int(11) NOT NULL,
  `aset_id` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kondisi`
--

INSERT INTO `kondisi` (`id_kondisi`, `aset_id`) VALUES
(14, 'AS000001'),
(16, 'AS000002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_aset` char(8) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `tujuan` varchar(30) NOT NULL,
  `status` enum('0','1','2','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`id_pinjam`, `id_user`, `id_aset`, `tgl_pinjam`, `tgl_kembali`, `tujuan`, `status`) VALUES
(2, 4, 'AS000001', '2022-07-23 07:58:50', '0000-00-00 00:00:00', 'Les Private', '1'),
(3, 17, 'AS000003', '2022-07-23 12:09:15', '0000-00-00 00:00:00', 'Rapat Himpunan', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjamruang`
--

CREATE TABLE `pinjamruang` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `tujuan` varchar(30) NOT NULL,
  `status` enum('0','1','2','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pinjamruang`
--

INSERT INTO `pinjamruang` (`id_pinjam`, `id_user`, `id_ruang`, `tgl_pinjam`, `tgl_kembali`, `tujuan`, `status`) VALUES
(4, 12, 1, '2022-07-28 16:24:07', '0000-00-00 00:00:00', 'hajatan', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) NOT NULL,
  `no_ruang` char(25) NOT NULL,
  `nama_ruang` varchar(50) NOT NULL,
  `kondisi_ruang` enum('Kosong','Isi Atau Sedang Digunakan','Baik','Rusak','Rusak Berat','Dalam Perbaikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `no_ruang`, `nama_ruang`, `kondisi_ruang`) VALUES
(1, 'L4.R-01', 'Lab. Networking', 'Isi Atau Sedang Digunakan'),
(2, 'L4. R-02', 'Lab. Hardware', 'Baik'),
(3, 'L4. R-03', 'Lab multimedia', 'Baik'),
(4, 'L1. R-10', 'Lab Pemesinan', 'Baik'),
(5, 'L4. R-05', 'Lab Komputer Engineer', 'Baik'),
(6, 'L1. R-11', 'Lab Electro Dasar', 'Baik'),
(7, 'L1. R-07', 'Lab Listrik Instalasi', 'Baik'),
(8, 'L1. R-08', 'Lab Peralatan Survey', 'Baik'),
(9, 'L2. R-09', 'Lab Rekamedik', 'Baik'),
(10, 'L2. R-10', 'Lab Manual', 'Baik'),
(11, 'L2. R-11', 'Lab Komputerisasi Akutansi', 'Baik'),
(12, 'L2. R-12', 'Lab Kimia', 'Baik'),
(13, 'L1. R-13', 'Lab Bahasa inggris', 'Baik'),
(14, 'L3. R-14', 'Lab. Akuntansi', 'Isi Atau Sedang Digunakan'),
(15, 'L1. R-2', 'Ruang Seminar', 'Kosong'),
(16, 'L3. R-13', 'Ruang Teknik Informatika', 'Baik'),
(17, 'L3. R-15', 'Ruang Teknik Komputer', 'Baik'),
(18, 'L1. R-7', 'Ruang Teknik Mesin', 'Baik'),
(19, 'L1. R-8', 'Ruang Teknik Electro', 'Baik'),
(20, 'L2. R-3', 'Ruang Kesehatan', 'Baik'),
(21, 'L1. R-12', 'Ruang Teknik Sipil', 'Baik'),
(22, 'L1. R-9', 'Ruang Teknik Mesin Otomotif', 'Baik'),
(23, 'L2. R-5', 'Ruang Teknik Kimia', 'Baik'),
(24, 'L4 R-06', 'Ruang Kuliah', 'Baik'),
(25, 'L4 R-06', 'Ruang Kuliah Besar', 'Kosong'),
(26, 'L4.R-02', 'Rekamedis', 'Baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_riwayat`
--

CREATE TABLE `tbl_riwayat` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_aset` char(8) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `tujuan` varchar(30) NOT NULL,
  `status` enum('0','1','2','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_riwayat`
--

INSERT INTO `tbl_riwayat` (`id_pinjam`, `id_user`, `id_aset`, `tgl_pinjam`, `tgl_kembali`, `tujuan`, `status`) VALUES
(1, 1, 'AS000001', '2022-07-23 07:25:30', '2022-07-23 07:30:19', 'Les Private', '1'),
(4, 17, 'AS000001', '2022-07-28 16:27:22', '2022-07-28 16:32:30', 'nongkris', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_riwayat1`
--

CREATE TABLE `tbl_riwayat1` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `tujuan` varchar(30) NOT NULL,
  `status` enum('0','1','2','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_riwayat1`
--

INSERT INTO `tbl_riwayat1` (`id_pinjam`, `id_user`, `id_ruang`, `tgl_pinjam`, `tgl_kembali`, `tujuan`, `status`) VALUES
(1, 17, 25, '2022-07-23 12:08:09', '2022-07-23 12:12:49', 'Rapat Himpunan', '1'),
(2, 18, 25, '2022-07-23 12:17:29', '0000-00-00 00:00:00', 'Kerja Kelompok', '0'),
(3, 18, 25, '2022-07-23 12:19:13', '2022-07-23 12:19:41', 'Kerja Kelompok', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `no_induk` varchar(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `role` enum('sarpras','admin','akademik','prodi','mahasiswa') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `foto` text NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `no_induk`, `nama`, `username`, `email`, `no_telp`, `role`, `password`, `created_at`, `foto`, `is_active`) VALUES
(8, '19560701', 'Fahmi Ayatullah', 'admin1', 'fahmi13@gmail.com', '08765432190', 'admin', '$2y$10$KQwpDrN/PTejaotGOtQ14OWL953P6mtj5jUAhm4.W7clRAQ6OppXi', 1658543139, 'user.png', 1),
(9, '45773895', 'M Sultan Nurkholis', 'admin2', 'msultan02@gmail.com', '089658977795', 'admin', '$2y$10$YCTZbLHUEvbxAyPKUPLmnuzs0UbzSkAE64Jk7LNXkeJVKzgPn.NrS', 1658543243, 'user.png', 1),
(10, '19560604', 'Rianti', 'sarpras1', 'rianti20@gmail.com', '082134587099', 'sarpras', '$2y$10$EwSu2T1s7FaA0JdxHwAHcebyS1fFzdCW8lpxkyj63QZxWxsnKI1ke', 1658543346, 'cf36e4101302503db4d95fb9ff6f3687.jpg', 1),
(11, '19560605', 'Fajar Gunawan', 'sarpras2', 'fajargu70@gmail.com', '08789054321', 'sarpras', '$2y$10$E.uosD4NYhwwBQlNrOspJORtI9xEmmxJ4YLsWFKj/BtCiCNprMBgq', 1658543414, 'user.png', 1),
(12, '19560801', 'Syifa Azzahra', 'akademik1', 'syifazahra23@gmail.com', '08124509789', 'akademik', '$2y$10$MiRUMEFSXnqQqe4hhvEHVO84.nKKf6i20Wroqn60KIdDxIz9bktmi', 1658543523, 'user.png', 1),
(13, '19560802', 'Khalisa Khumaira', 'akademik2', 'khlisa34@gmail.com', '08976890854', 'akademik', '$2y$10$PPg6xs0YxY5Awu0RevKjz.yntdrZewWTbniOO0K7cPpEds7EwVB/2', 1658543608, 'user.png', 1),
(15, '19560501', 'Agus Fitriadi', 'kaprodi1', 'agusfi09@gmail.com', '08765439087', 'prodi', '$2y$10$WDjmhNZAJ5x1b6rBFVltCeqBi3iDyVxCyZLwVtH.AUhPlPCn9C2ia', 1658543863, 'user.png', 1),
(16, '19560502', 'Siti Fatimah', 'kaprodi2', 'sifat2002@gmail.com', '08562314509', 'prodi', '$2y$10$ZbG.zgaDLn0a2TM4ERmrLOuB7GW/txEOMlX/7ue6k2o1qXSLRSO8G', 1658543936, 'user.png', 1),
(17, 'D111611193', 'Gunawan Jaidi', 'mahasiswa1', 'gunawan12@gmail.com', '08567043212', 'mahasiswa', '$2y$10$o47zhWpZPkYaHo81sEBzPemLGOsgei8CQpyuRNqJHGlmQhWEgFOIS', 1658544050, 'user.png', 1),
(18, 'D111911168', 'Muhammad Yudha', 'mahasiswa2', 'myudha45@gmail.com', '08978065432', 'mahasiswa', '$2y$10$6KUHdhGPR0rP6SDG6/WhwuXf/8BO8HXmJyMgQuTBnHgp6iunr7HoW', 1658544119, 'user.png', 1),
(21, '123456789', 'Mamat', 'aka1', 'mamat@gmail.com', '087625514414526', 'akademik', '$2y$10$u7f6x/0qH3fTuq41Mrz4nuJYRZnqsDY3R.Zb4zKi4qYDKYn1bGIBO', 1658551500, 'user.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(7, 'arimuhamadsetiawan@gmail.com', 'qnyj3Dnb5KfKUun6CHikdMUAYG0/hjUOcGI1wlNKZ9c=', 1654794963),
(8, 'arimuhamadsetiawan@gmail.com', '3VmQi5KSz9ROpVFm53gNeHgp+gxIRviZ21WJrlG4pk4=', 1654794970),
(9, 'arimsetyawan@gmail.com', 'le2MZN4VoWcV2yu1EvQwuwy6wdmY1X1PCMdSGitZYfc=', 1654795136),
(10, 'arimuhamadsetiawan@gmail.com', 'VE2TiAc9OP+tChMbtVvCj6KIw5QfPn3UEigj6gK7V0A=', 1654799142),
(11, 'arimsetyawan@gmail.com', 'GvCNY4LZlbYjDfiOXx2gIOfqxVEenyBaEBfUN/3CQJs=', 1654799350),
(12, 'arimuhamadsetiawan@gmail.com', '1Dt5fgJl58jYEEHExC7LwmpGYGs+HmGYder3Y1qP8vM=', 1654911042),
(13, 'arimuhamadsetiawan@gmail.com', 'RY2S+SCPrgmI7VRhdk2B93XPvyIWYEbu7tDYbB8Bd4k=', 1654911148),
(14, 'arimsetyawan@gmail.com', 'GX800OIYaIEMRy8Mt27n0tMigPIRww7Z2GHYL7+mEhk=', 1654911271),
(15, 'dimassabilillah10@gmail.com', 'bKpt5edCugnNaKQe3WUNmEHw+kRCI4jFk3OMhbxOeqA=', 1656731255),
(16, 'hasni.saniah@gmail.com', 'EBsmpkAxfDHnIPcAWzI25szXxB5gkN9uQuK8OhUeYJI=', 1657858839),
(17, 'hasni.saniah@gmail.com', 'sqsfvYPSg3EaiM2dcC8ivHmXGpJZZvKE/AeSZbuqIC8=', 1657859445);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `hapus`
--
ALTER TABLE `hapus`
  ADD PRIMARY KEY (`id_hapus`);

--
-- Indeks untuk tabel `induk_inventaris`
--
ALTER TABLE `induk_inventaris`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indeks untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `ruang_id` (`ruang_id`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id_kondisi`),
  ADD KEY `aset_id` (`aset_id`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indeks untuk tabel `pinjamruang`
--
ALTER TABLE `pinjamruang`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hapus`
--
ALTER TABLE `hapus`
  MODIFY `id_hapus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pinjamruang`
--
ALTER TABLE `pinjamruang`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `inventaris_ibfk_1` FOREIGN KEY (`ruang_id`) REFERENCES `ruang` (`id_ruang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
