CREATE TABLE migrations(

    user_id INT AUTO_INCREMENT,
    
    user_name VARCHAR(20) UNIQUE NOT NULL,
    user_email VARCHAR(40) UNIQUE NOT NULL,
    password VARCHAR(20) NOT NULL,
    role VARCHAR(10) NOT NULL,

    PRIMARY KEY(user_id)
);

DROP TABLE migrations;
ALTER TABLE user DROP COLUMN user_id;

INSERT INTO user VALUES(1, 'TauKuk', 'tautvydas.kuk@gmail.com', 'tau123', 'ADMIN');

DELETE FROM user 
WHERE user_id = ''

SELECT * FROM user;

SELECT * FROM user 
WHERE user_name = "";

SELECT * FROM user
WHERE user_email = "";

SELECT * FROM user
WHERE user_email = '' AND password = '';

SELECT * FROM user
WHERE user_name = '' AND password = '';

UPDATE user
SET password = ''
WHERE user_id = '';