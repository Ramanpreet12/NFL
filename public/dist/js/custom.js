$(".alert_messages").fadeOut('slow');

$('#admin_profile_form').validate({

    rules: {
        name: {  required: true,},
        phone_number: {  required: true,  number: true },
    },
    messages: {
        name: {     required: "Name is required",  },
        phone_number: {  required: "Phone number is required", },
    }
});

   //validate admin password page
   $('#admin_password_form').validate({

        rules: {
            current_password: {  required: true},
            new_password: {  required: true, },
            confirm_password: {  required: true,},
        },
        messages: {
            current_password: {     required: "jquery Current Password is required",  },
            new_password: {  required: "New  Password is required", },
            confirm_password: {  required: "Confirm Password is required", },
        }

    });
    //password and confirm password matching
    $('#confirm_password').on('keyup' , function(){
        var password = $('#new_password').val();
        var confirm_password = $(this).val();
      //  alert(password);
      if (confirm_password != '') {
        if (password != confirm_password) {
            $('#check_password_match').html('Confirm password is not matched with password !').css("color" , "red");
          } else {
            $('#check_password_match').html('Confirm password is matched').css("color" , "green");
          }
      }
      else{
        $('#check_password_match').html('');
      }


    })
