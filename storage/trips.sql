DROP TABLE IF EXISTS trips;
CREATE TABLE IF NOT EXISTS trips
(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    userID INT NOT NULL,
    attractions VARCHAR(10000),
    tripname VARCHAR(100)
);
