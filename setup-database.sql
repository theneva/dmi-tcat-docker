CREATE DATABASE IF NOT EXISTS twittercapture DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
CREATE USER 'dmi'@'localhost' IDENTIFIED BY 'tcat';
GRANT ALL PRIVILEGES ON *.* TO 'dmi'@'localhost';
FLUSH PRIVILEGES;
