<x-main-layout>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.js"></script>
    
    <!-- Taille de la carte -->
    <style>
      #map {
        width: 100%;
        height: 90vh;
      }
    </style>

    <div id="map">
        <!-- Bouton de zoom in/zoom out -->
        <div class="leaflet-control-container">
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
        </div>
    </div>

    <script type="text/javascript">
    var map;

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

        function highlightFeature(e) {
            const layer = e.target;
            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.4
            });
            layer.bringToFront();
            info.update(layer.feature.properties);
        }

        function resetHighlight(e) {
		    geojson.resetStyle(e.target);
	    	info.update();
	    }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            layer.on({
			    mouseover: highlightFeature,
			    mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        var departement = new L.GeoJSON.AJAX(["https://raw.githubusercontent.com/gregoiredavid/france-geojson/master/regions-version-simplifiee.geojson"], {
            onEachFeature:onEachFeature
        }).addTo(map);
    }

    $(document).ready(function () {
        InitialiserCarte();
    });
    </script>
</x-main-layout>