CREATE DATABASE IF NOT EXISTS asd_work_assistant;

CREATE USER IF NOT EXISTS 'asd_user'@'%'
IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES
ON asd_work_assistant.*
TO 'asd_user'@'%';

FLUSH PRIVILEGES;