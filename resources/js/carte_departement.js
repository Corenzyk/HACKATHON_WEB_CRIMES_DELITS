function InitialiserCarte() {
    var map = L.map('map').setView([
      48.8626304852, 2.33629344655
    ], 8);

    var tuileUrl = 'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png';

    var osm = L.tileLayer(tuileUrl, {
      minZoom: 0,
      maxZoom: 17
    });

    osm.addTo(map);

    var departement = new L.GeoJSON.AJAX(["https://raw.githubusercontent.com/gregoiredavid/france-geojson/master/departements-version-simplifiee.geojson"], {
      style: function (feature) {
        switch (feature.properties.code) {
          case '16':
          case '22':
          case '29':
          case '35':
          case '37':
          case '44':
          case '49':
          case '56':
          case '79':
          case '85':
          case '86':
            return { color: "#ffed00" };

          case '02':
          case '14':
          case '27':
          case '28':
          case '50':
          case '53':
          case '59':
          case '60':
          case '61':
          case '62':
          case '72':
          case '76':
          case '78':
          case '80':
            return { color: "#ef8200" };
        }
      }
    }).addTo(map);
  }

  $(document).ready(function () {
    InitialiserCarte();
  });