var $connection, $buoys;
var selection = false;
var filter = false;
var lastURL = "";
var map_showing;
var selected_buoy = "";
var surf_day = "";
var surf_month = "";
var options = '<option value="" disabled selected>Select Column</option>\
          <option value="wind_dir">wind_dir</option>\
          <option value="wind_spd">wind_spd</option>\
          <option value="gust">gust</option>\
          <option value="wave_height">wave_height</option>\
          <option value="dpd">dpd</option>\
          <option value="apd">apd</option>\
          <option value="mwd">mwd</option>\
          <option value="pressure">pressure</option>\
          <option value="airtemp">airtemp</option>\
          <option value="wtmp">wtmp</option>\
          <option value="dewp">dewp</option>\
          <option value="vis">vis</option>\
          <option value="tide">tide</option>';
  var tables = '<li name="44017_2016"><a href="44017_2016">Montauk Point</a></li><br />\
                <li name="44018_2016"><a href="44018_2016">Cape Cod</a></li><br />\
                <li name="44025_2016"><a href="44025_2016">Long Island</a></li><br />\
                <li name="44065_2016"><a href="44065_2016">New York Harbor</a></li><br />\
                <li name="44097_2016"><a href="44097_2016">Block Island</a></li>\
                <li name="44008_2016"><a href="44008_2016">Nantucket</a></li>';
  var months = '          <option value="" disabled selected>Select Month</option>\
            <option value="01">January</option>\
            <option value="02">February</option>\
            <option value="03">March</option>\
            <option value="04">April</option>\
            <option value="05">May</option>\
            <option value="06">June</option>\
            <option value="07">July</option>\
            <option value="08">August</option>\
            <option value="09">September</option>\
            <option value="10">October</option>\
            <option value="11">November</option>\
            <option value="12">December</option>';

  var fields = [];
  var day_selected = false;
  var month_selected = false;


$(function(){

  google.charts.load('current', {
    packages: ['controls', 'corechart', 'table']
});

  $.ajax({url : "./php/connection.php", async : "true"})
    .fail(function(response){
      $('#connection').append(response);
    })
    .always(function(response){
      console.log(response);
    })
    .done(function(response){
      $('#connection').append('<span id="connection_success"><b>Connected</b></span>');
      $('#connection_success').css({
        'color': 'green'
      });
    });

    $.ajax({url : "./pages/key.php", async : "true"})
      .fail(function(response){

      })
      .always(function(response){

      })
      .done(function(response){
        $('#key').append(response);
      });

    $('#dropdown_content').append(tables);
    $('#dropdown_content').hide();
    $('body').append('<script src="./js/menu.js"></script>');

      $('#filter_select1').append(options);
      $('#filter_select2').append(options);
      $('#filter_select3').append(options);
      $('#month_picker').append(months);

      load_page('#default');
      $('#map_container').hide();
      $('#map_canvas').hide();
      setInterval("check_url()", 250);
});

/* event listeners for mouseover animations */

$('#nav_top a').on('mouseenter', function(event){
  mouse_over($(this));
});

$('#nav_top a').on('mouseleave', function(event){
  if (!selection){
    mouse_leave($(this));
  }
});

$('#nav_top a').on('click', function(event){
  check_url(this.hash);
});

$('#center_logo').on('mouseenter', function(event){
  mouse_over($(this));
});

$('#center_logo').on('mouseleave', function(event){
  mouse_leave($(this));
});

$('#data_button').on('click', function(event){
  event.preventDefault();
  selection = true;
  $(this).css({
    'background-color': '#9AFDE2'
  });
  $('#dropdown_content').show();
});

$('#key_button').on('click', function(){
  console.log('key');
  $('#page_content').hide();
  $('#key').show();
});

$('#key').on('click', function(){
  $('#key').hide();
  $('#page_content').show();
});

$('#data').on('mouseleave', function(event){
  mouse_leave($('#data_button'));
  $('#dropdown_content').hide();
  selection = false;
});

/*$('#data_dropdown').on('mouseleave', function(event){
  $('#dropdown_content').hide();
});*/

$('#dropdown_content').on('mouseenter', function(event){
  $('#dropdown_content').show();

});

$('#filter_select1').change(function(event){
  event.preventDefault();
  fields = [];
  fields.push($( "#filter_select1 option:selected" ).val());
  console.log(fields);
  graph(fields);
});

$('#filter_select2').change(function(event){
  event.preventDefault();
  fields = [];
  fields.push($( "#filter_select1 option:selected" ).val());
  fields.push($( "#filter_select2 option:selected" ).val());
  console.log(fields);
  graph(fields);
});

$('#filter_select3').change(function(event){
  event.preventDefault();
  fields = [];
  fields.push($( "#filter_select1 option:selected" ).val());
  fields.push($( "#filter_select2 option:selected" ).val());
  fields.push($( "#filter_select3 option:selected" ).val());
  console.log(fields);
  graph(fields);
});

/* mouseover animation functions */
function mouse_over(element){
  element.animate({
    'background-color': jQuery.Color( '#9AFDE2' )
  }, 200);
}

function mouse_leave(element){
  element.animate({
    'background-color': jQuery.Color( '#CDF9ED' )
  }, 200);
}

function draw_chart(table_name){
  console.log('day');
  $('#filter_div').show();
  var data = $.ajax({url: "./php/google_table.php", async: false, data : { "table_name" : table_name, "day" : surf_day }, method: "POST", dataType: "json"}).responseText;

  var dataTable = new google.visualization.DataTable(data);
  var table = new google.visualization.Table(document.getElementById('page_content'));

  table.draw(dataTable);
}

function draw_chart_month(table_name, month){
  console.log(surf_month);
  $('#filter_div').show();
  var data = $.ajax({url: "./php/google_table_month.php", async: false, data : { "table_name" : table_name, "month" : surf_month }, method: "POST", dataType: "json"}).responseText;

  var dataTable = new google.visualization.DataTable(data);
  var table = new google.visualization.Table(document.getElementById('page_content'));

  table.draw(dataTable);
}

function graph(fields){
  console.log(fields + '' + selected_buoy);
  if (day_selected){
    var data = $.ajax({url: "./php/select_data.php", async: false, data : { "table_name" : selected_buoy, "fields": fields, "day": surf_day }, method: "POST", dataType: "json"}).responseText;
    var title = surf_day;
  }
  else if (month_selected){
    console.log('month selected');
    var data = $.ajax({url: "./php/select_data_month.php", async: false, data : { "table_name" : selected_buoy, "fields": fields, "month": surf_month }, method: "POST", dataType: "json"}).responseText;
    var title = surf_month;
  }
  var dataTable = new google.visualization.DataTable(data);

  //console.log(dataTable.toJSON());

  var chart = new google.visualization.LineChart(document.getElementById('page_content'));

  chart.draw(dataTable, {title: title});

}

function check_url(hash){
  if (!hash){
    hash = window.location.hash;
  }
  if (hash != lastURL)
	{
		lastURL = hash;
		load_page(hash);
	}
}

function load_page(url){
  if (filter == true){
    $('#filter_div').hide();
    filter = false;
  }

  if (url === '#map'){
    $('#page_content').hide();
    initialize();
    $('#map_container').show();
    $('#map_canvas').show();
    map_showing = true;
  } else {
    $('#map_canvas').hide();
    $('#map_container').hide();
    $('#page_content').show();
    map_showing = false;
    var datastring = url.replace('#','./pages/');

    $.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: datastring + ".php",
        async: true,
        error: function(){
          load_page('#error');
        },
        success: function(msg){
          if ( parseInt(msg) != 0 ) {
            $('#page_content').html('');
            $('#page_content').html(msg);    //load the returned html into pageConte
          }
        }
      });
  }



}
