<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <nav class="blue-grey darken-4">
        <div class="nav-wrapper">
          <a href="#" class="brand-logo center">Lost Bytes</a>
        </div>
      </nav>
      
      <div class="container">
        <div class="row">
          <div class="card-panel col s12 m6 l6 center">
            <h5>Gas</h5>
            <h1 id="gas-val"></h1>
            <a style="margin-bottom:25px;" class="waves-effect waves-light btn">Full Data</a>
          </div>
          <div class="card-panel col s12 m6 l6 center">
            <h5>Energy Efficient</h5>
            <h1 id="energy-val"></h1>
            <a style="margin-bottom:25px;" class="waves-effect waves-light btn">Full Data</a>
          </div>
        </div>
        <div class="row">
          <div class="card-panel col s12 m6 l6 center">
            <h5>Temperature</h5>
            <h1 id="temp-val"></h1>
            <a style="margin-bottom:25px;" class="waves-effect waves-light btn">Full Data</a>
          </div>
          <div class="card-panel col s12 m6 l6 center">
            <h5>pH Level</h5>
            <h1 id="ph-val"></h1>
            <a style="margin-bottom:25px;" class="waves-effect waves-light btn">Full Data</a>
          </div>
        </div>
        <div class="row">
          <div class="card-panel col s12 m6 l6 center">
            <h5>Humidity</h5>
            <h1 id="humidity-val"></h1>
            <a style="margin-bottom:25px;" class="waves-effect waves-light btn">Full Data</a>
          </div>
          <div class="card-panel col s12 m6 l6 center">
            <h5>Weight</h5>
            <h1 id="weight-val"></h1>
            <a style="margin-bottom:25px;" class="waves-effect waves-light btn">Full Data</a>
          </div>
        </div>
      </div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
      <script>
        document.addEventListener("DOMContentLoaded", init)
        function init(event) {
          var req = new XMLHttpRequest()
          req.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
              var data = this.responseText;
              var dataPieces = data.split('|')
              document.getElementById('temp-val').textContent = dataPieces[0]
              document.getElementById('ph-val').textContent = dataPieces[1]
              document.getElementById('weight-val').textContent = dataPieces[2]
              document.getElementById('gas-val').textContent = dataPieces[3] || 'No'
              document.getElementById('humidity-val').textContent = dataPieces[4]
              document.getElementById('energy-val').textContent = dataPieces[5] || 'No'
            }
          }  
          req.open('GET', './getData.php', true)
          req.send()        
          setInterval(function() {
            req.open('GET', './getData.php', true)
            req.send()
          }, 1500)

        }
      </script>
    </body>
  </html>