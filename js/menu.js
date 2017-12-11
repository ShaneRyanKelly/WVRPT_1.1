var start_index = 0, last_index = 20;
$(function(){

});

$('#dropdown_content li a').on('mouseenter', function(event){
  mouse_over($(this));
});

$('#dropdown_content li a').on('mouseleave', function(event){
  mouse_leave($(this));
});

$('#dropdown_content li a').on('click', function(event){
  event.preventDefault();
  console.log($(this).attr('href'));
  selected_buoy = $(this).attr('href');

  if (map_showing){
    $('#map_canvas').hide();
    $('#map_container').hide();
    $('#page_content').show();
  }

  load_page("#choose_day");
  //$('#page_content').html('<input id="date_picker" type="date" name="surf_day" min="2016-01-01" max="2016-12-31"><br>');



});

$('#page_content').on('change', '#date_picker', function(event){
  day_selected = true;
  month_selected = false;
  filter = true;

  surf_day = this.value;
  console.log(surf_day);
  draw_chart(selected_buoy, surf_day);
});

$('#page_content').on('change', '#month_picker', function(event){
  month_selected = true;
  day_selected = false;
  filter = true;

  surf_month = this.value;
  console.log(surf_month);
  draw_chart_month(selected_buoy, surf_month);
});

$('#month_picker').on('change', function(){
  month_selected = true;
  day_selected = false;
  filter = true;

  surf_month = this.value;
  console.log(surf_month);
  draw_chart_month(selected_buoy, surf_month);
});

$('#date_picker').on('change', function(){
  day_selected = true;
  month_selected = false;
  filter = true;

  surf_day = this.value;
  console.log(surf_day);
  draw_chart(selected_buoy, surf_day);
});
