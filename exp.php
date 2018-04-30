<!DOCTYPE html>
<html>
  <head>
    <title>Image Reprojection</title>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.4/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.6.4/build/ol.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.4.4/proj4.js"></script>
    <style>
      .fullscreen:-moz-full-screen {
        height: 100%;
      }
      .fullscreen:-webkit-full-screen {
        height: 100%;
      }
      .fullscreen:-ms-fullscreen {
        height: 100%;
      }

      .fullscreen:fullscreen {
        height: 100%;
      }

      .fullscreen {
        margin-bottom: 10px;
        width: 100%;
        height: 800px;
      }
      .ol-rotate {
        top: 3em;
      }
      .map {
        width: 80%;
        height: 100%;
        float: left;
      }
      .sidepanel {
        background: #01597A;
        width: 20%;
        height: 100%;
        float: left;
      }

      .sidepanel-title {
        width: 100%;
        font-size: 3em;
        color: #ffffff;
        display: block;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div id="fullscreen" class="fullscreen">
      <div id="map" class="map"></div>
      <div class="sidepanel">
        <span class="sidepanel-title">PGRD</span>
        <form class="form-inline">
          <p style="text-align: center;"><span style="color: #ffffff;"><strong><label>SELECCIONAR CAPA</label></strong></span></p>
            <select id="type">
              <option value="LineString">INUNCACIONES</option>
              <option value="Polygon">DESLIZAMIENTOS</option>
              <option value="Circle">LIDAR</option>
              <option value="None">INUNCACIONES</option>
            </select>
        </form>
      </div>
    </div>
    <script>
      var raster = new ol.layer.Tile({
        source: new ol.source.OSM()
      });

      var source = new ol.source.Vector({wrapX: false});

      var vector = new ol.layer.Vector({
        source: source
      });


      var typeSelect = document.getElementById('type');

      var draw; // global so we can remove it later
      function addInteraction() {
        var value = typeSelect.value;
        if (value !== 'None') {
          draw = new ol.interaction.Draw({
            source: source,
            type: typeSelect.value,
            freehand: true
          });
          map.addInteraction(draw);
        }
      }

      proj4.defs('EPSG:27700', '+proj=tmerc +lat_0=14.743 +lon_0=-88.775 +k=0.9996012717 ' +
          '+towgs84=147.050,-869.018,147.050,0.15,0.247,0.842,-869.018 ' +
          '+units=m +no_defs');
      var imageExtent = [0000, 0000, 170000, 137100];

      var map = new ol.Map({
        layers:
        [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          }),
          new ol.layer.Image({
            source: new ol.source.ImageStatic({
              url: 'http://localhost/Github/demo_pgrd/images/3.png',
              crossOrigin: '',
              projection: 'EPSG:27700',
              imageExtent: imageExtent
            })
          })
        ],
        target: 'map',
        view: new ol.View({
          center: ol.proj.transform(
              ol.extent.getCenter(imageExtent), 'EPSG:27700', 'EPSG:3857'),
          zoom: 12
        }),
      });

      console.log(map.N.view.C.zoom);
      /**
       * Handle change event.
       */
      typeSelect.onchange = function() {
        map.removeInteraction(draw);
        console.log(map.N.view.C.zoom);
        console.log(typeSelect.value);
        addInteraction();

      };

      addInteraction();
    </script>
  </body>
</html>
