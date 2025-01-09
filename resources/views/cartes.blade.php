<x-main-layout>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.js"></script>
    
    <style>
      #map {
        width: 100%;
        height: 90vh;
      }
      .info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255,255,255,0.8); box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px; } 
      .info h4 { margin: 0 0 5px; color: #777; }
    </style>

    <div id="map">
        <div class="leaflet-control-container">
            <!-- Bouton de zoom in/zoom out -->
            <div class="leaflet-top leaflet-left">
                <div class="leaflet-control-zoom leaflet-bar leaflet-control">
                    <a class="leaflet-control-zoom-in" href="#" title="Zoom in" role="button" aria-label="Zoom in" aria-disabled="false">
                        <span aria-hidden="true">+</span>
                    </a>
                    <a class="leaflet-control-zoom-out" href="#" title="Zoom out" role="button" aria-label="Zoom out" aria-disabled="false">
                        <span aria-hidden="true">−</span>
                    </a>
                </div>
            </div>

            <!-- Box d'informations -->
            <div class="leaflet-top leaflet-right">
                <div class="info leaflet-control">
                    <h4>Cliquer sur un département</h4>
                </div>
            </div>  
        </div>
    </div>

    <script type="text/javascript">
    var map;
    var geojson;

    function InitialiserCarte() {
        map = L.map('map').setView([
        46.8, 2.33629344655
        ], 6);

        var tuileUrl = 'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png';

        var osm = L.tileLayer(tuileUrl, {
        minZoom: 0,
        maxZoom: 17
        });

        osm.addTo(map);

        //Récupération et affichage des informations du département cliquer
        function updateInfo(props) {
            document.querySelector('.info').innerHTML = props ? 
                `<h4><b>${props.nom}</b></h4>
                <p>Code: ${props.code}<br>` :
                '<h4>Cliquer sur un département</h4>';
        }

        //Mettre un contour au département
        function highlightFeature(e) {
            const layer = e.target;
            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.4
            });
            layer.bringToFront();
        }

        //Réinitialiser le contour du département
        function resetHighlight(e) {
		    geojson.resetStyle(e.target);
	    }

        //Zoomer sur le département
        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
            updateInfo(e.target.feature.properties);
        }

        //Gestion des actions sur les départements
        function onEachFeature(feature, layer) {
            layer.on({
			    mouseover: highlightFeature,
                click: zoomToFeature,
                mouseout: resetHighlight,
            });
        }

        geojson = new L.GeoJSON.AJAX(["https://raw.githubusercontent.com/gregoiredavid/france-geojson/master/departements-avec-outre-mer.geojson"], {
            onEachFeature:onEachFeature
        }).addTo(map);
    }

    $(document).ready(function () {
        InitialiserCarte();
    });
    </script>
</x-main-layout>