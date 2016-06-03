SELECT*FROM users;

SELECT username FROM users WHERE last_name = "Chalkley";

SELECT * FROM results WHERE home_score > 12;

SELECT * FROM results WHERE away_score < 10;

SELECT * FROM products WHERE price <= 10.99;

SELECT * FROM results WHERE away_team = "Hessle" AND away_score > 18;

SELECT * FROM users WHERE last_name = "Hinkley" OR last_name = "Pettit";

SELECT * FROM results WHERE away_team = "Hessle" AND played_on >= "2015-10-01";

SELECT * FROM products WHERE price IN (7.99, 9.99, 11.99);

SELECT * FROM users WHERE username IN ("2spooky4me", "beard_man");

SELECT * FROM products WHERE price BETWEEN 10.99 AND 12.99;

SELECT * FROM results WHERE played_on BETWEEN "2015-09-01" AND "2015-09-30";

SELECT * FROM products WHERE name LIKE "%t-shirt%";

SELECT * FROM users WHERE first_name LIKE "L%";

SELECT * FROM phone_book WHERE phone IS NULL;

SELECT last_name FROM phone_book WHERE last_name IS NOT NULL;

SELECT * FROM movies WHERE id IS NULL OR title IS NULL OR year_released IS NULL OR genre IS NULL;

SELECT * FROM reviews WHERE rating < 1 OR rating > 5;

SELECT * FROM reviews WHERE rating <=3;

SELECT * FROM movies WHERE title LIKE "Alien%" ;


SELECT * FROM actors WHERE name LIKE "Will%";

SELECT * FROM actors WHERE name LIKE "%Cruise";