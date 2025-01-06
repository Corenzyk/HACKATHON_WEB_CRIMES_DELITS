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
	- Exemple de données possibles : Camembert des 3 départements les plus sûrs (le moins d'infractions recensées), Camembert des 3 régions les plus sûres de l'année (le moins d'infractions recensées).

Sites inspirations :
	- https://www.data.gouv.fr/fr/datasets/bases-statistiques-communale-departementale-et-regionale-de-la-delinquance-enregistree-par-la-police-et-la-gendarmerie-nationales/#/community-reuses
	- https://statsio.fr/securestats/ville/69123
	- https://data31tech.com/webapps/45-4K1Explorer_2/

APIs : 
	- Données : https://tabular-api.data.gouv.fr/api/resources/acc332f6-92be-42af-9721-f3609bea8cfc/data
	- Départements : https://geo.api.gouv.fr/departements/
			 https://geo.api.gouv.fr/departements/{code}
	- Régions : https://geo.api.gouv.fr/regions/
		    https://geo.api.gouv.fr/regions/{code}
		    https://geo.api.gouv.fr/regions/{code}/departements