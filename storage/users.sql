CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    firstname VARCHAR(50), 
    lastname VARCHAR(50),
    email VARCHAR(50),
    admin TINYINT(1)
);