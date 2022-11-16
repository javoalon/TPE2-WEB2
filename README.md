# TPE2-WEB2
Segundo trabajo practico especial para la materia de WEB 2, TUDAI.


END POINTS:

GET || /api/players 
Devuelve a todos los jugadores.
Si le pasamos en el parámetro order, "asc"(ascendente) o "desc"(descendente), va a ordenar por nombre.
Por ej: /api/players?order=asc ordena a los jugadores en orden alfabetico por su nombre.

GET || /api/players/:ID
Devuelve el jugador con la id dada si es que existe uno.

DELETE || /api/players/:ID
Elimina al jugador con la id dada si es que existe uno.

POST || /api/players
Agrega a un jugador con la información dada en formato JSON dentro del body del request.
