/*
 Navicat Premium Data Transfer

 Source Server         : 10.194.41.7_CHAT MONIQA
 Source Server Type    : MySQL
 Source Server Version : 50560
 Source Host           : 10.194.41.7:3306
 Source Schema         : checklist

 Target Server Type    : MySQL
 Target Server Version : 50560
 File Encoding         : 65001

 Date: 28/02/2024 20:04:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for apar
-- ----------------------------
DROP TABLE IF EXISTS `apar`;
CREATE TABLE `apar`  (
  `id_apar` int(11) NOT NULL AUTO_INCREMENT,
  `bulan_tahun` date NULL DEFAULT NULL,
  `jenis` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_apar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for check_cctv
-- ----------------------------
DROP TABLE IF EXISTS `check_cctv`;
CREATE TABLE `check_cctv`  (
  `id_check_cctv` int(11) NOT NULL AUTO_INCREMENT,
  `id_ruangan` int(11) NOT NULL,
  `shift` enum('pagi','sore','malam') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal` date NOT NULL,
  `tgl01` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl02` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl03` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl04` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl05` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl06` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl07` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl08` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl09` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl10` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl11` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl12` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl13` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl14` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl15` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl16` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl17` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl18` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl19` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl20` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl21` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl22` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl23` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl24` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl25` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl26` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl27` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl28` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl29` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl30` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl31` enum('baik','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_check_cctv`) USING BTREE,
  INDEX `id_ruangan`(`id_ruangan`) USING BTREE,
  CONSTRAINT `check_cctv_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4416 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for checklisk_kebersihan_ruangan
-- ----------------------------
DROP TABLE IF EXISTS `checklisk_kebersihan_ruangan`;
CREATE TABLE `checklisk_kebersihan_ruangan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NULL DEFAULT NULL,
  `periode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ruangan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pintu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dinding_kaca` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `meja_ws` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tirai` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `wall` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kaca_blok` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kursi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `plafon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pilar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pabx` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sampah` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `karpet` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `petugas` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `paraf_petugas` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for checklist_ac
-- ----------------------------
DROP TABLE IF EXISTS `checklist_ac`;
CREATE TABLE `checklist_ac`  (
  `id_checklist_ac` int(11) NOT NULL AUTO_INCREMENT,
  `id_ruangan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `sts_ac_pagi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `temp_pagi` int(5) NOT NULL,
  `pic_pagi` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_pagi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sts_ac_malam` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `temp_malam` int(5) NOT NULL,
  `pic_malam` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_malam` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_checklist_ac`) USING BTREE,
  INDEX `id_ruangan`(`id_ruangan`) USING BTREE,
  CONSTRAINT `checklist_ac_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2248 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for checklist_kebersihan
-- ----------------------------
DROP TABLE IF EXISTS `checklist_kebersihan`;
CREATE TABLE `checklist_kebersihan`  (
  `id_check_kebersihan` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `jam` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lantai_operasional` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_ruangan` int(11) NULL DEFAULT NULL,
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lantai` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dinding` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `list` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kaca` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `plafon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `furniture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ws` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ac` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telephone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `aksesoris` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kap_lampu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tempat_sampah` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kursi_staff` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `meja_staff` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `insfected` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tl_spv` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ttd_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id_check_kebersihan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for checklist_kebersihan_loby
-- ----------------------------
DROP TABLE IF EXISTS `checklist_kebersihan_loby`;
CREATE TABLE `checklist_kebersihan_loby`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NULL DEFAULT NULL,
  `ruangan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tombol_lift` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pintu_lift` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lantai_koridor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rak_sepatu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `wall` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `loker` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kursi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `meja_makan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pintu_darurat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `hydrant` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `apar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `plafon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `petugas` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `paraf_petugas` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for checklist_pc
-- ----------------------------
DROP TABLE IF EXISTS `checklist_pc`;
CREATE TABLE `checklist_pc`  (
  `id_checklist_pc` int(11) NOT NULL AUTO_INCREMENT,
  `pc_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal` date NOT NULL,
  `shift` enum('pagi','malam') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_petugas` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `M1` enum('cek','kosong') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `M2` enum('cek','kosong') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CPU` enum('cek','kosong') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int(10) NOT NULL,
  `TL` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IT` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_checklist_pc`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1527 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for checklist_ups
-- ----------------------------
DROP TABLE IF EXISTS `checklist_ups`;
CREATE TABLE `checklist_ups`  (
  `id_checklist_ups` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `lokasi` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `merk` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `input` int(11) NOT NULL,
  `output` int(11) NOT NULL,
  `baterai_time` int(11) NOT NULL,
  `petugas` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_checklist_ups`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3225 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for fap
-- ----------------------------
DROP TABLE IF EXISTS `fap`;
CREATE TABLE `fap`  (
  `id_fap` int(11) NOT NULL AUTO_INCREMENT,
  `bulan_tahun` date NULL DEFAULT NULL,
  `jenis` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_fap`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for genset
-- ----------------------------
DROP TABLE IF EXISTS `genset`;
CREATE TABLE `genset`  (
  `id_genset` int(11) NOT NULL AUTO_INCREMENT,
  `bulan_tahun` date NULL DEFAULT NULL,
  `jenis` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_genset`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hydrant
-- ----------------------------
DROP TABLE IF EXISTS `hydrant`;
CREATE TABLE `hydrant`  (
  `id_hydrant` int(11) NOT NULL AUTO_INCREMENT,
  `bulan_tahun` date NULL DEFAULT NULL,
  `jenis` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_hydrant`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for lift
-- ----------------------------
DROP TABLE IF EXISTS `lift`;
CREATE TABLE `lift`  (
  `id_lift` int(11) NOT NULL AUTO_INCREMENT,
  `bulan_tahun` date NULL DEFAULT NULL,
  `jenis` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_lift`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login`  (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jabatan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `paraf` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_login`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 69 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for me_vendor
-- ----------------------------
DROP TABLE IF EXISTS `me_vendor`;
CREATE TABLE `me_vendor`  (
  `id_me_vendor` int(11) NOT NULL AUTO_INCREMENT,
  `bulan_tahun` date NULL DEFAULT NULL,
  `jenis` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_me_vendor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for penilaian_vendor
-- ----------------------------
DROP TABLE IF EXISTS `penilaian_vendor`;
CREATE TABLE `penilaian_vendor`  (
  `id_penilaian_vendor` int(11) NOT NULL AUTO_INCREMENT,
  `bulan_tahun` date NULL DEFAULT NULL,
  `jenis` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_penilaian_vendor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for petugas
-- ----------------------------
DROP TABLE IF EXISTS `petugas`;
CREATE TABLE `petugas`  (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_petugas` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_petugas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ruangan
-- ----------------------------
DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE `ruangan`  (
  `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lantai` int(11) NOT NULL,
  `bagian` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_ruangan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
