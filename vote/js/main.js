// To send OTP 
// url: "include/sendotp.php",url: "no_use/fake1.php",
$(document).ready(function() {
  var delay = 1000;
  $('#btn').click(function(e){
    e.preventDefault();
    var num = $('#num').val();
      if(num == ''){
        $('.message_box').html(
          '<span style="color:black;">Enter Your Enrollment!</span>'
        );
        $('#num').focus();
        return false;
      }

    var number = $('#number').val();
      if(number == ''){
        $('.message_box').html(
          '<span style="color:black;">Enter Mobilie Number!</span>'
        );
        $('#number').focus();
        return false;
      }

      $.ajax({
            type: "POST",
            url: "include/sendotp.php",
            data: "num="+num+"&number="+number,
       beforeSend: function() {
       $('#load').html(
       '<img style="margin-top:-20px" src="img/343.gif" width="30" height="30"/>'
       );
       },
            success: function(data)
       {
              setTimeout(function() {
                  $('.message_box').html(data);
                  $('#btn').css({'display': 'none'});
                  $('#form').css({'display': 'none'});
                  $('#verify').css({'display': 'block'});
              }, delay);
            }
       });
  });

});


// To verify OTP
// url: "include/verify.php", url: "no_use/fake1.php",
$(document).ready(function() {
  var delay = 1000;
  $('#verifyOtp').click(function(e){
    e.preventDefault();
    var verifyotp = $('#verifyotp').val();
        if(verifyotp == ''){
      $('.message_box').html(
      '<span style="color:black;">Enter a 5-digit OTP</span>'
      );
      $('#verifyotp').focus();
            return false;
      }

      $.ajax
      ({
            type: "POST",
            url: "include/verify.php",
            data: "verifyotp="+verifyotp,
       beforeSend: function() {
       $('#load1').html(
       '<img src="img/load1.gif" width="25" height="25"/>'
       );
       },
       success: function(data)
       {
         setTimeout(function() {
                    $('.message_box').html(data);
                }, delay);
             }
       });
  });


  // Fetch Colleges on login page
  $.ajax({
    type: "POST",
    url: "edmin/scripts/colleges.php",
    success: function(data) {
    var obj = $.parseJSON(data); 
    // var name = data['name'];
    var result = "<select class='form-control custom-select' style='width:172%' name='college'><option value='college'>Select College of the Candidate for the Court Member</option>"

    $.each(obj, function() {
        result = result + "<option value='"+this['college_id']+"'>"+this['colleges']+"</option>";
    });
    result = result + "</select>"
    $(".colleges_list").html(result);
    }

  });

});




// script for submittion of vote

$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
    });
});

function getVote(){
  if (window.XMLHttpRequest){
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
    } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
  var radioButtons = document.getElementsByName("vote");

  for(var i = 0; i < radioButtons.length; i++){
    if(radioButtons[i].checked == true){
      if(confirm("Your vote is for "+radioButtons[i].value)){  
        var int = radioButtons[i].value;
        var pos = document.getElementById("str").value;
        var id = document.getElementById("hidden").value;
        xmlhttp.open("GET","save.php?vote="+int+"&user_id="+id+"&position="+pos,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function(){
          if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
          //  alert("dfdfd");
            document.getElementById("error").innerHTML=xmlhttp.responseText;
          }
        }
  // window.location.reload();
  // setTimeout(location.reload.bind(location), 2000);
      }else{  }
    }
  }   
}

// js code to load preloader
function preLoader(){
  $('#preloader').addClass('displayHide');
  $('#loading').show();             
}


