/*
 Navicat Premium Data Transfer

 Source Server         : LocalHost [Root]
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : app_pass

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 29/07/2022 09:30:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
                              `id` bigint NOT NULL AUTO_INCREMENT,
                              `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
                              `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
                              PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPRESSED;

INSERT INTO `categories` VALUES (null, 'Redes Sociales', 'text-warning');
INSERT INTO `categories` VALUES (null, 'Paginas Webs', 'text-primary');
INSERT INTO `categories` VALUES (100, 'Default', 'text-white');

-- ----------------------------
-- Table structure for platforms
-- ----------------------------
DROP TABLE IF EXISTS `platforms`;
CREATE TABLE `platforms`  (
                          `id` bigint NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
                          `categoryid` bigint NOT NULL DEFAULT 100,
                          `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'www.google.es',
                          `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '/img/google.png',
                          PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPRESSED;

INSERT INTO `platforms` VALUES (null, 'linkedin', 2, 'https://www.linkedin.com/login/', '/img/linkedin.png');
INSERT INTO `platforms` VALUES (null, 'github', 2, 'https://github.com/login/', '/img/github.png');
INSERT INTO `platforms` VALUES (null, 'twitch', 2, 'https://www.twitch.tv/login/', '/img/twitch.png');
INSERT INTO `platforms` VALUES (null, 'spotify', 2, 'https://accounts.spotify.com/es-ES/login/', '/img/spotify.png');
INSERT INTO `platforms` VALUES (null, 'discord', 2, 'https://discord.com/login', '/img/discord.png');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
                          `id` bigint NOT NULL AUTO_INCREMENT,
                          `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
                          `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'localhost@localhost',
                          `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                          `timecreated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
                          `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
                          PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPRESSED;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (3, 'Chema', 'josemaria.chauchina@gmail.com', '0dc369c832cf7af54379d24fae7543dd', '25-07-22 21:30:45', '{MD5}b3cbfd5b4cf1646970f7392b78ec0379_#_0dc369c832cf7af54379d24fae7543dd');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users_platforms`;
CREATE TABLE `users_platforms`  (
                          `id` bigint NOT NULL AUTO_INCREMENT,
                          `userid` bigint NOT NULL DEFAULT 0,
                          `platformid` bigint NOT NULL DEFAULT 0,
                          `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                          `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
                          PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPRESSED;

INSERT INTO `users_platforms` VALUES (null, 3, 1, '0dc369c832cf7af54379d24fae7543dd', '{MD5}b3cbfd5b4cf1646970f7392b78ec0379_#_0dc369c832cf7af54379d24fae7543dd');
INSERT INTO `users_platforms` VALUES (null, 3, 2, '0dc369c832cf7af54379d24fae7543dd', '{MD5}b3cbfd5b4cf1646970f7392b78ec0379_#_0dc369c832cf7af54379d24fae7543dd');
INSERT INTO `users_platforms` VALUES (null, 3, 3, '0dc369c832cf7af54379d24fae7543dd', '{MD5}b3cbfd5b4cf1646970f7392b78ec0379_#_0dc369c832cf7af54379d24fae7543dd');
INSERT INTO `users_platforms` VALUES (null, 3, 4, '0dc369c832cf7af54379d24fae7543dd', '{MD5}b3cbfd5b4cf1646970f7392b78ec0379_#_0dc369c832cf7af54379d24fae7543dd');
INSERT INTO `users_platforms` VALUES (null, 3, 5, '0dc369c832cf7af54379d24fae7543dd', '{MD5}b3cbfd5b4cf1646970f7392b78ec0379_#_0dc369c832cf7af54379d24fae7543dd');
INSERT INTO `users_platforms` VALUES (null, 3, 6, '0dc369c832cf7af54379d24fae7543dd', '{MD5}b3cbfd5b4cf1646970f7392b78ec0379_#_0dc369c832cf7af54379d24fae7543dd');

SET FOREIGN_KEY_CHECKS = 1;