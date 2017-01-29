SELECT *
FROM
  (SELECT count(*) 'ActorsNumber'
   FROM movynov.actors) AS Actors,
  (SELECT count(*) 'FilmsNumber'
   FROM movynov.films) AS Films,
  (SELECT count(*) 'SeriesNumber'
   FROM movynov.series) AS Series,
  (SELECT count(*) 'RolesNumber'
   FROM movynov.castings) AS Roles,
  (SELECT round(count(*) / COUNT(DISTINCT castings.id_actor), 0) 'moyenne role par acteur'
   FROM castings
   WHERE castings.id_actor =
         (SELECT MAX(actors.id_actor)
          FROM actors
          WHERE (actors.id_actor = castings.id_actor))) as `cm r p a`;

#moyenne role d'un acteur
SELECT round(avg(Count),0) 'moyenne role par acteur'
FROM
  (SELECT COUNT(*) AS Count
   FROM castings
   WHERE castings.id_actor =
         (SELECT MAX(actors.id_actor)
          FROM actors
          WHERE (actors.id_actor = castings.id_actor))
   GROUP BY castings.id_actor)
    AS counts;
#ou
SELECT round(count(*) / count(DISTINCT castings.id_actor),0) 'moyenne role par acteur'
FROM castings
WHERE castings.id_actor =
      (SELECT MAX(actors.id_actor)
       FROM actors
       WHERE (actors.id_actor = castings.id_actor))