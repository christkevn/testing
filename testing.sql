SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `testing` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `testing`;

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` varchar(50) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
('123', 'sad'),
('halo', 'askndl');

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `harga` int(50) NOT NULL,
  `kategori_id` varchar(50) NOT NULL,
  `status_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `kategori_id`, `status_id`) VALUES
('apa kabar', 'baik', 123444, 'mboh', 'helloworld'),
('hell', 'qwel', 1231231, 'hell gendes', 'abc'),
('qweqe', 'asdasd', 123123, 'dasda', 'asdad'),
('qwewqe', 'qweqe', 12313, 'asdad', 'asdada'),
('testing', 'gatau', 899, 'jasdk', 'bukan hello');

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id_status` varchar(50) NOT NULL,
  `nama_status` varchar(200) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `status` (`id_status`, `nama_status`) VALUES
('hello', 'asda'),
('helloworld', 'bisa dijual');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
