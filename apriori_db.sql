-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2025 at 03:21 PM
-- Server version: 5.7.44
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apriori_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_analisis`
--

CREATE TABLE `history_analisis` (
  `id` int(11) NOT NULL,
  `min_support` float NOT NULL,
  `min_confidence` float NOT NULL,
  `min_lift` float NOT NULL,
  `hasil_analisis` json NOT NULL,
  `jumlah_aturan` int(11) NOT NULL,
  `tanggal_analisis` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_analisis`
--

INSERT INTO `history_analisis` (`id`, `min_support`, `min_confidence`, `min_lift`, `hasil_analisis`, `jumlah_aturan`, `tanggal_analisis`) VALUES
(3, 10, 60, 1.2, '[{\"lift\": 2.7472527472527473, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Jarak_Ke_Pusat_Kota_Sedang\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Fasilitas_Sekitar_Pasar\"]}, {\"lift\": 2.450980392156863, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jarak_Ke_Pusat_Kota_Dekat\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 2.2321428571428568, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Desa\"]}, {\"lift\": 1.984126984126984, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.923076923076923, \"support\": 0.16, \"antecedent\": [\"Lokasi_Kota\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Luas_Tanah_Sedang\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Dekat\"]}, {\"lift\": 1.8115942028985508, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.7361111111111112, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.709401709401709, \"support\": 0.16, \"antecedent\": [\"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.6447368421052633, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5789473684210524, \"support\": 0.12, \"antecedent\": [\"Jenis_Properti_Gudang\"], \"confidence\": 0.6, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5527950310559004, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Luas_Tanah_Besar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jenis_Properti_Apartemen\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}]', 17, '2025-08-28 14:28:02'),
(4, 10, 60, 1.2, '[{\"lift\": 2.7472527472527473, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Jarak_Ke_Pusat_Kota_Sedang\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Fasilitas_Sekitar_Pasar\"]}, {\"lift\": 2.450980392156863, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jarak_Ke_Pusat_Kota_Dekat\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 2.2321428571428568, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Desa\"]}, {\"lift\": 1.984126984126984, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.923076923076923, \"support\": 0.16, \"antecedent\": [\"Lokasi_Kota\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Luas_Tanah_Sedang\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Dekat\"]}, {\"lift\": 1.8115942028985508, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.7361111111111112, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.709401709401709, \"support\": 0.16, \"antecedent\": [\"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.6447368421052633, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5789473684210524, \"support\": 0.12, \"antecedent\": [\"Jenis_Properti_Gudang\"], \"confidence\": 0.6, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5527950310559004, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Luas_Tanah_Besar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jenis_Properti_Apartemen\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}]', 17, '2025-08-28 14:38:36'),
(5, 10, 60, 1.2, '[{\"lift\": 2.7472527472527473, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Jarak_Ke_Pusat_Kota_Sedang\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Fasilitas_Sekitar_Pasar\"]}, {\"lift\": 2.450980392156863, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jarak_Ke_Pusat_Kota_Dekat\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 2.2321428571428568, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Desa\"]}, {\"lift\": 1.984126984126984, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.923076923076923, \"support\": 0.16, \"antecedent\": [\"Lokasi_Kota\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Luas_Tanah_Sedang\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Dekat\"]}, {\"lift\": 1.8115942028985508, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.7361111111111112, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.709401709401709, \"support\": 0.16, \"antecedent\": [\"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.6447368421052633, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5789473684210524, \"support\": 0.12, \"antecedent\": [\"Jenis_Properti_Gudang\"], \"confidence\": 0.6, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5527950310559004, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Luas_Tanah_Besar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jenis_Properti_Apartemen\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}]', 17, '2025-08-28 14:41:00'),
(6, 10, 60, 1.2, '[{\"lift\": 2.7472527472527473, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Jarak_Ke_Pusat_Kota_Sedang\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Fasilitas_Sekitar_Pasar\"]}, {\"lift\": 2.450980392156863, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jarak_Ke_Pusat_Kota_Dekat\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 2.2321428571428568, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Desa\"]}, {\"lift\": 1.984126984126984, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.923076923076923, \"support\": 0.16, \"antecedent\": [\"Lokasi_Kota\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Luas_Tanah_Sedang\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Dekat\"]}, {\"lift\": 1.8115942028985508, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.7361111111111112, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.709401709401709, \"support\": 0.16, \"antecedent\": [\"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.6447368421052633, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5789473684210524, \"support\": 0.12, \"antecedent\": [\"Jenis_Properti_Gudang\"], \"confidence\": 0.6, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5527950310559004, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Luas_Tanah_Besar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jenis_Properti_Apartemen\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}]', 17, '2025-08-28 14:42:08'),
(7, 10, 60, 1.2, '[{\"lift\": 2.7472527472527473, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Jarak_Ke_Pusat_Kota_Sedang\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Fasilitas_Sekitar_Pasar\"]}, {\"lift\": 2.450980392156863, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jarak_Ke_Pusat_Kota_Dekat\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 2.2321428571428568, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Desa\"]}, {\"lift\": 1.984126984126984, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.923076923076923, \"support\": 0.16, \"antecedent\": [\"Lokasi_Kota\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Luas_Tanah_Sedang\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Dekat\"]}, {\"lift\": 1.8115942028985508, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.7361111111111112, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.709401709401709, \"support\": 0.16, \"antecedent\": [\"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.6447368421052633, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5789473684210524, \"support\": 0.12, \"antecedent\": [\"Jenis_Properti_Gudang\"], \"confidence\": 0.6, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5527950310559004, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Luas_Tanah_Besar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jenis_Properti_Apartemen\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}]', 17, '2025-08-28 14:42:50'),
(8, 10, 60, 1.2, '[{\"lift\": 2.7472527472527473, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Jarak_Ke_Pusat_Kota_Sedang\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Fasilitas_Sekitar_Pasar\"]}, {\"lift\": 2.450980392156863, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jarak_Ke_Pusat_Kota_Dekat\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 2.2321428571428568, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Desa\"]}, {\"lift\": 1.984126984126984, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.923076923076923, \"support\": 0.16, \"antecedent\": [\"Lokasi_Kota\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Luas_Tanah_Sedang\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Dekat\"]}, {\"lift\": 1.8115942028985508, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.7361111111111112, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.709401709401709, \"support\": 0.16, \"antecedent\": [\"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.6447368421052633, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5789473684210524, \"support\": 0.12, \"antecedent\": [\"Jenis_Properti_Gudang\"], \"confidence\": 0.6, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5527950310559004, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Luas_Tanah_Besar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jenis_Properti_Apartemen\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}]', 17, '2025-08-28 14:44:16'),
(13, 10, 60, 1.2, '[{\"lift\": 2.7472527472527473, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Jarak_Ke_Pusat_Kota_Sedang\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Fasilitas_Sekitar_Pasar\"]}, {\"lift\": 2.450980392156863, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jarak_Ke_Pusat_Kota_Dekat\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 2.2321428571428568, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Desa\"]}, {\"lift\": 1.984126984126984, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.923076923076923, \"support\": 0.16, \"antecedent\": [\"Lokasi_Kota\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Luas_Tanah_Sedang\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Dekat\"]}, {\"lift\": 1.8115942028985508, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.7361111111111112, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.709401709401709, \"support\": 0.16, \"antecedent\": [\"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.6447368421052633, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5789473684210524, \"support\": 0.12, \"antecedent\": [\"Jenis_Properti_Gudang\"], \"confidence\": 0.6, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5527950310559004, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Luas_Tanah_Besar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jenis_Properti_Apartemen\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}]', 17, '2025-08-28 15:12:32'),
(14, 10, 60, 1.2, '[{\"lift\": 2.7472527472527473, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Jarak_Ke_Pusat_Kota_Sedang\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Fasilitas_Sekitar_Pasar\"]}, {\"lift\": 2.450980392156863, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jarak_Ke_Pusat_Kota_Dekat\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 2.2321428571428568, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Desa\"]}, {\"lift\": 1.984126984126984, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.923076923076923, \"support\": 0.16, \"antecedent\": [\"Lokasi_Kota\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Luas_Tanah_Sedang\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Dekat\"]}, {\"lift\": 1.8115942028985508, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.7361111111111112, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.709401709401709, \"support\": 0.16, \"antecedent\": [\"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.6447368421052633, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5789473684210524, \"support\": 0.12, \"antecedent\": [\"Jenis_Properti_Gudang\"], \"confidence\": 0.6, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5527950310559004, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Luas_Tanah_Besar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jenis_Properti_Apartemen\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}]', 17, '2025-08-28 15:13:38'),
(15, 10, 60, 1.2, '[{\"lift\": 2.7472527472527473, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Jarak_Ke_Pusat_Kota_Sedang\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Fasilitas_Sekitar_Pasar\"]}, {\"lift\": 2.450980392156863, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jarak_Ke_Pusat_Kota_Dekat\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 2.2321428571428568, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Desa\"]}, {\"lift\": 1.984126984126984, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.923076923076923, \"support\": 0.16, \"antecedent\": [\"Lokasi_Kota\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Luas_Tanah_Sedang\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Dekat\"]}, {\"lift\": 1.8115942028985508, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.7361111111111112, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.709401709401709, \"support\": 0.16, \"antecedent\": [\"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.6447368421052633, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5789473684210524, \"support\": 0.12, \"antecedent\": [\"Jenis_Properti_Gudang\"], \"confidence\": 0.6, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5527950310559004, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Luas_Tanah_Besar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jenis_Properti_Apartemen\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}]', 17, '2025-08-28 15:16:14'),
(16, 10, 60, 1.2, '[{\"lift\": 2.7472527472527473, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Jarak_Ke_Pusat_Kota_Sedang\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Fasilitas_Sekitar_Pasar\"]}, {\"lift\": 2.450980392156863, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jarak_Ke_Pusat_Kota_Dekat\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 2.2321428571428568, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Desa\"]}, {\"lift\": 1.984126984126984, \"support\": 0.1, \"antecedent\": [\"Jenis_Tanah_Bebatuan\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.923076923076923, \"support\": 0.16, \"antecedent\": [\"Lokasi_Kota\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Luas_Tanah_Sedang\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Fasilitas_Sekitar_Jalan Raya\"], \"confidence\": 0.625, \"consequent\": [\"Luas_Tanah_Kecil\"]}, {\"lift\": 1.838235294117647, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Dekat\"]}, {\"lift\": 1.8115942028985508, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.8333333333333334, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.7361111111111112, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.709401709401709, \"support\": 0.16, \"antecedent\": [\"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.6153846153846154, \"consequent\": [\"Jarak_Ke_Pusat_Kota_Sedang\"]}, {\"lift\": 1.6447368421052633, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Fasilitas_Sekitar_Pasar\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5789473684210524, \"support\": 0.12, \"antecedent\": [\"Jenis_Properti_Gudang\"], \"confidence\": 0.6, \"consequent\": [\"Jenis_Tanah_Bebatuan\"]}, {\"lift\": 1.5527950310559004, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Luas_Tanah_Besar\"], \"confidence\": 0.7142857142857143, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Lokasi_Pinggiran\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.4880952380952384, \"support\": 0.1, \"antecedent\": [\"Luas_Tanah_Kecil\", \"Lokasi_Pinggiran\"], \"confidence\": 0.625, \"consequent\": [\"Jenis_Tanah_Lempung\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jarak_Ke_Pusat_Kota_Sedang\", \"Jenis_Properti_Apartemen\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}, {\"lift\": 1.358695652173913, \"support\": 0.1, \"antecedent\": [\"Jenis_Properti_Apartemen\", \"Jenis_Tanah_Lempung\"], \"confidence\": 0.625, \"consequent\": [\"Lokasi_Pinggiran\"]}]', 17, '2025-08-28 15:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kategori`, `nilai`) VALUES
(1, 'Lokasi', 'Kota'),
(2, 'Jenis_Tanah', 'Bebatuan'),
(3, 'Jenis_Properti', 'Rumah'),
(4, 'Luas_Tanah', 'Kecil'),
(5, 'Jarak_Ke_Pusat_Kota', 'Sedang'),
(6, 'Fasilitas_Sekitar', 'Pasar'),
(7, 'Lokasi', 'Pinggiran'),
(8, 'Jenis_Properti', 'Apartemen'),
(9, 'Luas_Tanah', 'Besar'),
(10, 'Jenis_Tanah', 'Lempung'),
(11, 'Luas_Tanah', 'Sedang'),
(12, 'Fasilitas_Sekitar', 'Sekolah'),
(13, 'Jenis_Tanah', 'Berpasir'),
(14, 'Jarak_Ke_Pusat_Kota', 'Dekat'),
(15, 'Fasilitas_Sekitar', 'Tanpa Fasilitas'),
(16, 'Lokasi', 'Desa'),
(17, 'Jarak_Ke_Pusat_Kota', 'Jauh'),
(18, 'Fasilitas_Sekitar', 'Jalan Raya'),
(19, 'Jenis_Properti', 'Gudang'),
(20, 'Fasilitas_Sekitar', 'Rumah Sakit'),
(21, 'Jenis_Properti', 'Ruko');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(12) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `nama_lengkap`, `email`, `foto`) VALUES
(5, 'badri', '$2y$10$ufHMCOpxBb4qWPM/DNxFp.iWNGrDq6ACJ.X3zJ1VB32M5vj8cZY1O', 'cek cekkk', 'khbadri22@gmail.com', '1753267234_9fe1376f34640f12d145.png');

-- --------------------------------------------------------

--
-- Table structure for table `properti`
--

CREATE TABLE `properti` (
  `id` int(11) NOT NULL,
  `nama_properti` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properti`
--

INSERT INTO `properti` (`id`, `nama_properti`, `created_at`) VALUES
(1, 'Properti 1', '2025-08-28 14:13:04'),
(2, 'Properti 2', '2025-08-28 14:13:04'),
(3, 'Properti 3', '2025-08-28 14:13:04'),
(4, 'Properti 4', '2025-08-28 14:13:04'),
(5, 'Properti 5', '2025-08-28 14:13:04'),
(6, 'Properti 6', '2025-08-28 14:13:04'),
(7, 'Properti 7', '2025-08-28 14:13:04'),
(8, 'Properti 8', '2025-08-28 14:13:04'),
(9, 'Properti 9', '2025-08-28 14:13:04'),
(10, 'Properti 10', '2025-08-28 14:13:04'),
(11, 'Properti 11', '2025-08-28 14:13:04'),
(12, 'Properti 12', '2025-08-28 14:13:04'),
(13, 'Properti 13', '2025-08-28 14:13:04'),
(14, 'Properti 14', '2025-08-28 14:13:04'),
(15, 'Properti 15', '2025-08-28 14:13:04'),
(16, 'Properti 16', '2025-08-28 14:13:04'),
(17, 'Properti 17', '2025-08-28 14:13:04'),
(18, 'Properti 18', '2025-08-28 14:13:04'),
(19, 'Properti 19', '2025-08-28 14:13:04'),
(20, 'Properti 20', '2025-08-28 14:13:04'),
(21, 'Properti 21', '2025-08-28 14:13:04'),
(22, 'Properti 22', '2025-08-28 14:13:04'),
(23, 'Properti 23', '2025-08-28 14:13:04'),
(24, 'Properti 24', '2025-08-28 14:13:04'),
(25, 'Properti 25', '2025-08-28 14:13:04'),
(26, 'Properti 26', '2025-08-28 14:13:04'),
(27, 'Properti 27', '2025-08-28 14:13:04'),
(28, 'Properti 28', '2025-08-28 14:13:04'),
(29, 'Properti 29', '2025-08-28 14:13:04'),
(30, 'Properti 30', '2025-08-28 14:13:04'),
(31, 'Properti 31', '2025-08-28 14:13:04'),
(32, 'Properti 32', '2025-08-28 14:13:04'),
(33, 'Properti 33', '2025-08-28 14:13:04'),
(34, 'Properti 34', '2025-08-28 14:13:04'),
(35, 'Properti 35', '2025-08-28 14:13:04'),
(36, 'Properti 36', '2025-08-28 14:13:04'),
(37, 'Properti 37', '2025-08-28 14:13:04'),
(38, 'Properti 38', '2025-08-28 14:13:04'),
(39, 'Properti 39', '2025-08-28 14:13:04'),
(40, 'Properti 40', '2025-08-28 14:13:04'),
(41, 'Properti 41', '2025-08-28 14:13:04'),
(42, 'Properti 42', '2025-08-28 14:13:04'),
(43, 'Properti 43', '2025-08-28 14:13:04'),
(44, 'Properti 44', '2025-08-28 14:13:04'),
(45, 'Properti 45', '2025-08-28 14:13:04'),
(46, 'Properti 46', '2025-08-28 14:13:04'),
(47, 'Properti 47', '2025-08-28 14:13:04'),
(48, 'Properti 48', '2025-08-28 14:13:04'),
(49, 'Properti 49', '2025-08-28 14:13:04'),
(50, 'Properti 50', '2025-08-28 14:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_properti`
--

CREATE TABLE `transaksi_properti` (
  `id_transaksi` int(11) NOT NULL,
  `id_properti` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_properti`
--

INSERT INTO `transaksi_properti` (`id_transaksi`, `id_properti`, `id_kriteria`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 2, 7),
(8, 2, 2),
(9, 2, 8),
(10, 2, 9),
(11, 2, 5),
(12, 2, 6),
(13, 3, 7),
(14, 3, 10),
(15, 3, 8),
(16, 3, 11),
(17, 3, 5),
(18, 3, 12),
(19, 4, 1),
(20, 4, 13),
(21, 4, 3),
(22, 4, 11),
(23, 4, 14),
(24, 4, 15),
(25, 5, 16),
(26, 5, 13),
(27, 5, 3),
(28, 5, 11),
(29, 5, 17),
(30, 5, 18),
(31, 6, 1),
(32, 6, 2),
(33, 6, 3),
(34, 6, 11),
(35, 6, 14),
(36, 6, 6),
(37, 7, 16),
(38, 7, 10),
(39, 7, 8),
(40, 7, 9),
(41, 7, 5),
(42, 7, 15),
(43, 8, 16),
(44, 8, 2),
(45, 8, 8),
(46, 8, 4),
(47, 8, 17),
(48, 8, 12),
(49, 9, 7),
(50, 9, 10),
(51, 9, 8),
(52, 9, 9),
(53, 9, 5),
(54, 9, 15),
(55, 10, 16),
(56, 10, 2),
(57, 10, 3),
(58, 10, 9),
(59, 10, 5),
(60, 10, 6),
(61, 11, 16),
(62, 11, 2),
(63, 11, 19),
(64, 11, 4),
(65, 11, 14),
(66, 11, 20),
(67, 12, 7),
(68, 12, 10),
(69, 12, 8),
(70, 12, 4),
(71, 12, 14),
(72, 12, 6),
(73, 13, 7),
(74, 13, 10),
(75, 13, 3),
(76, 13, 4),
(77, 13, 5),
(78, 13, 15),
(79, 14, 7),
(80, 14, 2),
(81, 14, 8),
(82, 14, 9),
(83, 14, 5),
(84, 14, 6),
(85, 15, 16),
(86, 15, 2),
(87, 15, 19),
(88, 15, 4),
(89, 15, 14),
(90, 15, 15),
(91, 16, 7),
(92, 16, 10),
(93, 16, 19),
(94, 16, 9),
(95, 16, 17),
(96, 16, 12),
(97, 17, 16),
(98, 17, 2),
(99, 17, 8),
(100, 17, 4),
(101, 17, 5),
(102, 17, 18),
(103, 18, 1),
(104, 18, 10),
(105, 18, 19),
(106, 18, 11),
(107, 18, 5),
(108, 18, 6),
(109, 19, 7),
(110, 19, 2),
(111, 19, 3),
(112, 19, 9),
(113, 19, 17),
(114, 19, 12),
(115, 20, 16),
(116, 20, 10),
(117, 20, 19),
(118, 20, 9),
(119, 20, 17),
(120, 20, 20),
(121, 21, 7),
(122, 21, 2),
(123, 21, 19),
(124, 21, 9),
(125, 21, 5),
(126, 21, 12),
(127, 22, 7),
(128, 22, 2),
(129, 22, 19),
(130, 22, 4),
(131, 22, 14),
(132, 22, 15),
(133, 23, 1),
(134, 23, 10),
(135, 23, 3),
(136, 23, 4),
(137, 23, 14),
(138, 23, 12),
(139, 24, 1),
(140, 24, 10),
(141, 24, 21),
(142, 24, 9),
(143, 24, 17),
(144, 24, 15),
(145, 25, 1),
(146, 25, 10),
(147, 25, 3),
(148, 25, 11),
(149, 25, 17),
(150, 25, 18),
(151, 26, 7),
(152, 26, 10),
(153, 26, 8),
(154, 26, 4),
(155, 26, 14),
(156, 26, 12),
(157, 27, 7),
(158, 27, 13),
(159, 27, 3),
(160, 27, 9),
(161, 27, 17),
(162, 27, 6),
(163, 28, 7),
(164, 28, 10),
(165, 28, 3),
(166, 28, 4),
(167, 28, 14),
(168, 28, 15),
(169, 29, 1),
(170, 29, 10),
(171, 29, 8),
(172, 29, 11),
(173, 29, 14),
(174, 29, 12),
(175, 30, 1),
(176, 30, 10),
(177, 30, 19),
(178, 30, 11),
(179, 30, 5),
(180, 30, 6),
(181, 31, 1),
(182, 31, 2),
(183, 31, 21),
(184, 31, 11),
(185, 31, 17),
(186, 31, 20),
(187, 32, 1),
(188, 32, 13),
(189, 32, 8),
(190, 32, 11),
(191, 32, 14),
(192, 32, 20),
(193, 33, 7),
(194, 33, 10),
(195, 33, 21),
(196, 33, 9),
(197, 33, 17),
(198, 33, 18),
(199, 34, 7),
(200, 34, 2),
(201, 34, 19),
(202, 34, 4),
(203, 34, 17),
(204, 34, 18),
(205, 35, 16),
(206, 35, 13),
(207, 35, 21),
(208, 35, 4),
(209, 35, 5),
(210, 35, 18),
(211, 36, 7),
(212, 36, 13),
(213, 36, 21),
(214, 36, 11),
(215, 36, 17),
(216, 36, 20),
(217, 37, 16),
(218, 37, 2),
(219, 37, 3),
(220, 37, 11),
(221, 37, 17),
(222, 37, 12),
(223, 38, 7),
(224, 38, 10),
(225, 38, 8),
(226, 38, 4),
(227, 38, 17),
(228, 38, 6),
(229, 39, 7),
(230, 39, 10),
(231, 39, 21),
(232, 39, 9),
(233, 39, 5),
(234, 39, 6),
(235, 40, 1),
(236, 40, 2),
(237, 40, 19),
(238, 40, 9),
(239, 40, 14),
(240, 40, 6),
(241, 41, 16),
(242, 41, 10),
(243, 41, 3),
(244, 41, 11),
(245, 41, 5),
(246, 41, 20),
(247, 42, 16),
(248, 42, 13),
(249, 42, 8),
(250, 42, 4),
(251, 42, 5),
(252, 42, 18),
(253, 43, 16),
(254, 43, 2),
(255, 43, 8),
(256, 43, 9),
(257, 43, 14),
(258, 43, 12),
(259, 44, 7),
(260, 44, 2),
(261, 44, 21),
(262, 44, 11),
(263, 44, 5),
(264, 44, 6),
(265, 45, 7),
(266, 45, 13),
(267, 45, 3),
(268, 45, 9),
(269, 45, 14),
(270, 45, 20),
(271, 46, 1),
(272, 46, 10),
(273, 46, 8),
(274, 46, 9),
(275, 46, 14),
(276, 46, 20),
(277, 47, 7),
(278, 47, 13),
(279, 47, 8),
(280, 47, 11),
(281, 47, 5),
(282, 47, 12),
(283, 48, 7),
(284, 48, 2),
(285, 48, 21),
(286, 48, 4),
(287, 48, 14),
(288, 48, 15),
(289, 49, 16),
(290, 49, 13),
(291, 49, 21),
(292, 49, 4),
(293, 49, 14),
(294, 49, 18),
(295, 50, 7),
(296, 50, 10),
(297, 50, 3),
(298, 50, 11),
(299, 50, 17),
(300, 50, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_analisis`
--
ALTER TABLE `history_analisis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properti`
--
ALTER TABLE `properti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_properti`
--
ALTER TABLE `transaksi_properti`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_properti` (`id_properti`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_analisis`
--
ALTER TABLE `history_analisis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `properti`
--
ALTER TABLE `properti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `transaksi_properti`
--
ALTER TABLE `transaksi_properti`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi_properti`
--
ALTER TABLE `transaksi_properti`
  ADD CONSTRAINT `transaksi_properti_ibfk_1` FOREIGN KEY (`id_properti`) REFERENCES `properti` (`id`),
  ADD CONSTRAINT `transaksi_properti_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
