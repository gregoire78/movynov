DELETE FROM movynov.films;
DELETE FROM movynov.series;
#DELETE FROM movynov.actors;
ALTER TABLE movynov.films AUTO_INCREMENT = 1;
ALTER TABLE movynov.castings AUTO_INCREMENT = 1;
ALTER TABLE movynov.series AUTO_INCREMENT = 1;
#ALTER TABLE movynov.actors AUTO_INCREMENT = 1;