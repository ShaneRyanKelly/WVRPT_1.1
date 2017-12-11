<!DOCTYPE HTML>
<html>
  <head>
    <title>WVRPT 1.1</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="./img/logo2.png"/>
  </head>
  <body>

    <nav id="nav_top">
      <div id="logo"><a class="nav" href="#default">WVRPT</a></div>
        <div id="menu_select">
          <a href="#contact" class="nav">Contact</a>
          <a href="#login" class="nav">Login</a>
          <a id="map_button" href="#map" class="nav">Map</a>
          <div id="data">
            <a id="data_button" href="data" class="nav">Data&#9660;</a>
              <div id="dropdown">
                <ul id="dropdown_content">

                </ul>
              </div>
          </div>
        </div>
    </nav>

    <div id="main_content">

      <div id="page_content">
      </div>
      <div id="key"></div>
      <div id="table_div"></div>
      <div id="filter_div">
        <br />
        <select id="filter_select1">
        </select>
        <select id="filter_select2">
        </select>
        <select id="filter_select3">
        </select>
        <select id="month_picker">
        </select>
        <input id="date_picker" type="date" name="surf_day" min="2016-01-01" max="2016-12-31">
        <button id="key_button">Key</button>
      </div>

      <div id="map_container" style="height:100%; width:100%;">
           <div id="map_canvas"></div>
      </div>

      <div id="connection">Connection Status: </div>

    </div>

    <nav id="nav_bottom">
        <img id="center_logo" src="./img/logo2.png" />
    </nav>

    <script src="./js/jquery-3.2.1.js"></script>
    <script src="./js/jquery.color-2.1.2.js"></script>
    <script src="./js/modernizr-custom.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHJUtZ3h6hHsVry1Z6Uv9D6NRyrniN7FA&callback=initialize"></script>
    <script src="./js/buoy_map.js"></script>
    <script src="./js/window.js"></script>



  </body>
</html>
