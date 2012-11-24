CREATE USER 'upfit'@'localhost' IDENTIFIED BY 'upfit';

GRANT USAGE ON * . * TO 'upfit'@'localhost' IDENTIFIED BY 'upfit' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

CREATE DATABASE IF NOT EXISTS `upfit` ;

GRANT ALL PRIVILEGES ON `upfit` . * TO 'upfit'@'localhost';

CREATE DATABASE IF NOT EXISTS `upfit_dev` ;
GRANT ALL PRIVILEGES ON `upfit_dev` . * TO 'upfit'@'localhost';
CREATE DATABASE IF NOT EXISTS `upfit_test` ;
GRANT ALL PRIVILEGES ON `upfit_test` . * TO 'upfit'@'localhost';