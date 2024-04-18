-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2024 pada 10.48
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sertifikat_online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `full_name`, `email`, `created_at`) VALUES
(1, 'kakeru', '$2y$10$aPGtAv0sYTBQ11iKzyJeQerayTJM9aptTUMOoSS.Q4dQG55.7./UG', 'kakeru niimi', 'ka@gmail.com', '2024-04-16 02:49:12'),
(2, 'renya', '$2y$10$3DuGce7pD8TNnJFuMUL.lOtX/wPlU8fACiQD26ihdnJNtDH6VYzBK', 'takamine renya', 'renya@mail.com', '2024-04-16 06:47:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `certificates`
--

CREATE TABLE `certificates` (
  `certificate_id` int(11) NOT NULL,
  `participant_name` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `certificate_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `certificate_assignments`
--

CREATE TABLE `certificate_assignments` (
  `assignment_id` int(11) NOT NULL,
  `certificate_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `certificate_assignments2`
--

CREATE TABLE `certificate_assignments2` (
  `assignment_id` int(11) NOT NULL,
  `certificate_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Indeks untuk tabel `certificate_assignments`
--
ALTER TABLE `certificate_assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `certificate_id` (`certificate_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indeks untuk tabel `certificate_assignments2`
--
ALTER TABLE `certificate_assignments2`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `certificate_id` (`certificate_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `certificate_assignments`
--
ALTER TABLE `certificate_assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `certificate_assignments2`
--
ALTER TABLE `certificate_assignments2`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `certificate_assignments`
--
ALTER TABLE `certificate_assignments`
  ADD CONSTRAINT `certificate_assignments_ibfk_1` FOREIGN KEY (`certificate_id`) REFERENCES `certificates` (`certificate_id`),
  ADD CONSTRAINT `certificate_assignments_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`),
  ADD CONSTRAINT `certificate_assignments_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Ketidakleluasaan untuk tabel `certificate_assignments2`
--
ALTER TABLE `certificate_assignments2`
  ADD CONSTRAINT `certificate_assignments2_ibfk_1` FOREIGN KEY (`certificate_id`) REFERENCES `certificates` (`certificate_id`),
  ADD CONSTRAINT `certificate_assignments2_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `certificate_assignments2_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
