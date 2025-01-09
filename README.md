SITE WEB D'AFFICHAGE DE STATISTIQUES EN TEMPS RÉEL SELON API SYSTEME DE RECHERCHES SELON CRITERES ET VIA CARTE

Page d'acceuil :
	- Données récoltées :
		- Classe : Type d'infraction
		- Année : Année concerné (ici de 2016 à 2023)
		- Département (code) : id du département (lien avec l'autre API pour le nom)
		- Région (code) : id de la région (lien avec l'autre API pour le nom)
		- Unité de compte : L'unité de mesure utilisée (avec faits)
		- millPOP : ?
		- millLOG: ?
		- Faits : Nombre de fois que l'infraction a déjà eu lieu dans l'année
		- POP : Population du département où a eu lieu le crime
		- LOG : Nombre de logement dans le département où a eu lieu le crime
		- Taux pour mille : Taux de l'infraction pour mille habitants (exprimé en notation scientifique)
	- Exemple de données possibles : Top 5 Région les plus sûres (le moins d'infraction), Top 5 des régions

Page de la carte :
	- Carte de France avec région, lors du clic sur une région, zoom sur la région et outline des départements, affichage sur la droite d'une case donnant les détails de la région, lors du clic sur un département, zoom sur le département, affichage sur la droite d'une case donnant les détails du département

Sites inspirations :
	- https://www.data.gouv.fr/fr/datasets/bases-statistiques-communale-departementale-et-regionale-de-la-delinquance-enregistree-par-la-police-et-la-gendarmerie-nationales/#/community-reuses
	- https://statsio.fr/securestats/
	- https://data31tech.com/webapps/45-4K1Explorer_2/
	- https://leafletjs.com/examples/choropleth/example.html

APIs : 
	- Données : https://tabular-api.data.gouv.fr/api/resources/acc332f6-92be-42af-9721-f3609bea8cfc/data/
		(Paramètres ?page pour afficher d'autres pages et page_size pour afficher plus d'enregistrement)
	- Départements : https://geo.api.gouv.fr/departements/
					 https://geo.api.gouv.fr/departements/{code}
	- Régions : https://geo.api.gouv.fr/regions/
		    	https://geo.api.gouv.fr/regions/{code}
		    	https://geo.api.gouv.fr/regions/{code}/departements

Créations non utilisée :
	- Carte interactive en react (Choix de leaflet, apparemment plus simple, react à étudier)

Améliorations possibles :
	- Ajout de la recherche (tableau avec zone de recherche sur département, type de délits, etc) et de l'onglet statistiques (camembert, evolutions, etc)
	- Développement pour le mobile plus poussé
	- Carte : Couleur des régions et départements selon la dangerosité
	- Statistiques : Recherches de région et départements  (camembert, crime les plus présents), recherches de crimes précis (le département avec le plus de ce crime, camembert)