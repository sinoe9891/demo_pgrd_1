
<html lang="en-US"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="./resources/prism/prism.css" type="text/css">
    <link rel="stylesheet" href="./css/ol.css" type="text/css">
    <link rel="stylesheet" href="./resources/layout.css" type="text/css">


    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=fetch,requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="./resources/zeroclipboard/ZeroClipboard.min.js"></script>
    <title>Bing Maps</title>
  </head>
  <body>

    <header class="navbar" role="navigation">
      <div class="container">

          <a class="navbar-brand" href="#"><img src="./resources/logo-70x70.png">&nbsp;Creative Productions Honduras</a>
        <!-- menu items that get hidden below 768px width -->
      </div>
    </header>

    <div class="container-fluid">
      <div id="latest-check" class="alert alert-warning alert-dismissible" role="alert" style="display:none">
        <button id="latest-dismiss" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        This example uses OpenLayers v<span>4.6.5</span>. The <a id="latest-link" href="#" class="alert-link">latest</a> is v<span id="latest-version">4.6.5</span>.
      </div>

      <div class="row-fluid">
        <div class="span12">
          <h4 id="title">PGRD COPECO</h4>
           <div id="map" class="map"></div>

               <select id="layer-select">
                 <option value="Aerial">INUNDACIONES</option>
                 <option value="AerialWithLabels" selected="">DESLIZAMIENTOS</option>
                 <option value="Road">LIDAR</option>
                 <option value="RoadOnDemand">Road (dynamic)</option>
                 <option value="ordnanceSurvey">Ordnance Survey</option>
               </select>

        </div>
      </div>

      <div class="row-fluid">
        <div class="span12">
          <div id="docs">
          </div>
        </div>
      </div>

      <div class="row-fluid">
        <div id="source-controls">
        </div>


      </div>
    </div>

    <script src="./resources/common.js"></script>
    <script src="./resources/prism/prism.min.js"></script>
    <script src="./resources/loader.js?id=bing-maps"></script>
    <script>
      var packageUrl = './resources/package.json';
      fetch(packageUrl).then(function(response) {
        return response.json();
      }).then(function(json) {
        var latestVersion = json.version;
        document.getElementById('latest-version').innerHTML = latestVersion;
        var url = window.location.href;
        var branchSearch = url.match(/\/([^\/]*)\/examples\//);
        var cookieText = 'dismissed=-' + latestVersion + '-';
        var dismissed = document.cookie.indexOf(cookieText) != -1;
        if (!dismissed && /^v[0-9\.]*$/.test(branchSearch[1]) && '4.6.5' != latestVersion) {
          var link = url.replace(branchSearch[0], '/latest/examples/');
          fetch(link, {method: 'head'}).then(function(response) {
            var a = document.getElementById('latest-link');
            a.href = response.status == 200 ? link : '../../latest/examples/';
          });
          var latestCheck = document.getElementById('latest-check');
          latestCheck.style.display = '';
          document.getElementById('latest-dismiss').onclick = function() {
            latestCheck.style.display = 'none';
            document.cookie = cookieText;
          }
        }
      });
    </script>

  </body>
</html>
