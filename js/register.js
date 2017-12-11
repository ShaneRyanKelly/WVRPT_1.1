$('#registration_form').on('submit', function(event){
  event.preventDefault();
  var data = getFormData($('#registration_form'));
  console.log(data);
  console.log(data.first_name);

  $.ajax({
  method: "POST",
  url: './php/create_user.php',
  data: data
  })
  .done(function() {
    $('#page_content').html("<h1>Welcome to WVRPT!!</h1>");
  })
  .fail(function() {
    console.log( "error" );
    $('#page_content').html("<h1>Registration ERROR!</h1>");
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

//check username code
var elUserName = document.getElementById('username');
var elMsg = document.getElementById('feedback');

function checkUsername(minLength){
  if (elUserName.value.length < minLength){
    elMsg.textContent = 'Username must be ' + minLength + ' characters or more';
  } else {
    elMsg.innerHTML = '';
  }
}

elUserName.addEventListener('input', function(){
  checkUsername(5);
});

//check password code
var elPassword = document.getElementById('password');
var elpwMsg = document.getElementById('pwFeedback');
var regPw = new RegExp(/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/);

function checkPassword(minLength){
  if (elPassword.value.length < minLength || !(regPw.test(elPassword.value))){
    elpwMsg.textContent = 'Password must be at least ' + minLength + ' characters in length and include upper and lowercase letters, numbers, and special characters';
  } else {
    elpwMsg.innerHTML = '';
  }
}

elPassword.addEventListener('input', function(){
  checkPassword(8);
});
