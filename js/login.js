$('#login_form').on('submit', function(event){
  event.preventDefault();
  var data = getFormData($('#login_form'));
  console.log(data);

  $.ajax({
  method: "POST",
  url: './php/login.php',
  data: data
  })
  .done(function(response) {
    $('#page_content').html(response);
  })
  .fail(function(response) {
    console.log( response );
    window.alert('login unsuccessful!');
  })
  .always(function() {
    console.log( "complete" );
  });
});

function getFormData($form){
  var unindexed_array = $form.serializeArray();
  var indexed_array = {};

  $.map(unindexed_array, function(n, i){
    indexed_array[n['name']] = n['value'];
  });

  return indexed_array;
}
