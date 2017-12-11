function initialize() {

    if (Modernizr.geolocation){
      console.log("got location");
      navigator.geolocation.getCurrentPosition(success, fail);
    }else{
      initMap(0,0);
    }

    function success(position){
      initMap(position.coords.latitude, position.coords.longitude);
    }

    function fail(){
      initMap(0,0);
    }

}

function initMap(lat, long) {
  // Create a map object and specify the DOM element for display.
  var pinLocation = new google.maps.LatLng(Number(lat), Number(long));
  var nyHarbor = new google.maps.LatLng(40.369, -73.703);

  var mapOptions = {
    center: pinLocation,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoom: 8,

    panControl: false,
    zoomControl: true,
    zoomControlOptions:{
      style: google.maps.ZoomControlStyle.SMALL,
      position: google.maps.ControlPosition.TOP_RIGHT
    },
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
      position: google.maps.ControlPosition.TOP_LEFT
    },
    scaleControl: true,
    scaleControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER
    },
    streetViewControl: false,
    overviewMapControl: false,
    styles: [
      {
        stylers: [
          { hue: "#00ff6f" },
          { saturation: -50 }
        ]
      },{
        featureType: "road",
        elementType: "geometry",
        stylers: [
          { lightness: 100 },
          { visibility: "simplified" }
        ]
      },{
        featureType: "transit",
        elementType: "geometry",
        stylers: [
          { hue: "#ff6600"},
          { saturation: +80 }
        ]
      }, {
        featureType: "transit",
        elementType: "labels",
        stylers: [
          { hue: "#ffffff" },
          { saturation: +80 }
        ]
      }
    ]
  };

  var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
  console.log("Is the map appearing??");

  var waveImage = './img/waveImage.png';
  var homeImage = './img/homeImage.png';

  var waves = [
    {
      position: {lat: 40.369, lng: -73.703},
      title: '44065_2016'
    },
    {
      position: {lat: 40.694, lng: -72.048},
      title: '44017_2016'
    },
    {
      position: {lat: 42.119, lng: -69.700},
      title: '44018_2016'
    },
    {
      position: {lat: 40.251, lng: -73.164},
      title: '44025_2016'
    },
    {
      position: {lat: 40.969, lng: -71.127},
      title: '44097_2016'
    },
    {
      position: {lat: 40.504, lng: -69.248},
      title: '44008_2016'
    },
    {
      position: {lat: 39.568, lng: -72.586},
      title: '44066_2016'
    }
  ];

  var home = new google.maps.Marker({
      position: pinLocation,
      map: map,
      icon: homeImage,
      title: 'Home'
    });



  waves.forEach(function(wave){
    var marker = new google.maps.Marker({
      position: wave.position,
      icon: waveImage,
      map: map
      });

      console.log(wave.title);

      marker.addListener('click', function(marker) {
        console.log(wave.title);
        var wave_title = wave.title;
        selected_buoy = wave_title;
        if (map_showing){
          $('#map_canvas').hide();
          $('#map_container').hide();
          $('#page_content').show();
        }

        load_page("#choose_day");
    });
  });
}
