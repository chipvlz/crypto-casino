CREATE USER 'casino'@'%' IDENTIFIED BY '123qweQWE!@#';

CREATE DATABASE IF NOT EXISTS `casino` COLLATE 'utf8mb4_unicode_ci';
GRANT ALL ON casino.* TO 'casino'@'%';

FLUSH PRIVILEGES;