/*Sukuria lentele*/
CREATE TABLE user(
    user_id INT AUTO_INCREMENT,
    user_name VARCHAR(20) NOT NULL,
    password VARCHAR(20) UNIQUE,
    activity VARCHAR(20) DEFAULT 'nepasirinkta',
    PRIMARY KEY(user_id)
);

/*Apibudina lentele*/
DESCRIBE user;

/* Istrina lentele*/
DROP TABLE user;

/* Prideda stulpeli i lentele*/
ALTER TABLE user ADD display_name VARCHAR(20);
/*Istrina stulpeli is lenteles*/
ALTER TABLE user DROP COLUMN display_name;

/* I lentele idedama informacija*/
INSERT INTO user(user_name, password, activity) VALUES('TauKuk', 'bandymas123', 'ADMIN');
INSERT INTO user(user_name, password) VALUES('Petras', 'PetrasKietas!');
INSERT INTO user(user_name, password, activity) VALUES('Jonas', 'AsJonas321', 'krepsinis');
INSERT INTO user(user_name, password, activity) VALUES('Andrius', 'Andrius995', 'krepsinis');
INSERT INTO user(user_id, user_name, password) VALUES(9, 'Kristupas', 'Kris159');

/* Pasirenkamos visos eiles ir isvedama informaacija apie duomenis. * - pasirinkti visus */
SELECT * FROM user;

/* Updatina lenteles duomenis: 
SET - ka pakeicia
WHERE - tas pats kas if (galima naudoti operatorius OR, AND t.t.) (NOT (!= C++) yra <>)
Jei nera WHERE, pasirenkamos visos eiles
*/
UPDATE user
SET activity = 'futbolas'
WHERE activity = 'krepsinis';

/*Istrina duomenis is lenteles*/
DELETE FROM user
WHERE activity = 'nepasirinkta';

/* Isveda visus user_id ir password. Galima naudoti ir user.user_id, user.password */
SELECT user_id, password FROM user;

/* Isveda visus user_name ir activity, surikiavus password mazejimo tvarka (Jei norima didejimo tvarka nereikia DESC)*/
SELECT user_name, activity 
FROM user 
ORDER BY password DESC;

/* Isveda tik 2 pirmus, surikiuotus pagal activity, elementus*/
SELECT user_name, activity 
FROM user
ORDER BY activity 
LIMIT 2;

/* Isveda tik elementus, kuriu activity ADMIN arba futbolas*/
SELECT *
FROM user
WHERE activity = 'futbolas' OR activity = 'ADMIN';

/* Isveda tik elementus , kuriu vardai TauKuk arba Andrius */
SELECT *
FROM user
WHERE user_name IN ('TauKuk', 'Andrius');

/* Isveda tik unikalius activity */
SELECT DISTINCT activity
FROM user;

/* Isveda kiek elementu yra lenteleje
Taip pat galima ir AVG (vidurki),
SUM (suma)
*/
SELECT COUNT(user_id)
FROM user;

/* Isveda kiek zmoniu vykdo kiekviena veikla */ 
SELECT COUNT(user_id), activity
FROM user
GROUP BY activity;