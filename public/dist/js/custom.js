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


    });

    //sweet alert

    $('.show_sweetalert').click(function(event) {
        var form =  $(this).closest("form");
       //  var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          }
        });
    });

    //sweet alert for confirm make team win

    $('.winBtn').click(function(event){
        var form =  $(this).closest("form");
         event.preventDefault();
         swal({
            title: 'Are you sure to make this team win?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            buttons: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            // confirmButtonText: 'Yes, delete it!',
            // reverseButtons: true
          }).then((result) => {
            if (result) {

              form.submit();
            }
          });
      });


      //front register form validation
      $('#register_form').validate({
        rules: {
            fname:                  {  required: true},
            birthday:               {  required: true},
            email:                  {  required: true , email: true},
            password:               {  required: true},
            password_confirmation:  {  required: true},
            phone:                  {  required: true},
            address:                  {  required: true},
            city:                  {  required: true},
            zipcode:                  {  required: true},
            id_proof:                  {  required: true},
            country:                  {  required: true},
        },
        messages: {
            fname:                  {  required: "Name is required",  },
            birthday:               {  required: "Date of birth is required",  },
            email:                  {  required: "Email is required",  },
            password:               {  required: "Password is required",  },
            password_confirmation:  {  required: "Password Confirmation is required",  },
            phone:                  {  required: "Phone is required",  },
            address:                  {  required: "Address is required",  },
            city:                  {  required: "City is required",  },
            zipcode:                  {  required: "Zipcode is required",  },
            country:                  {  required: "Country is required",  },
            id_proof:                  {  required: "ID Proof is required",  },
        }
    });

   // front reviews form validation
    $('#reviewForm').validate({
        rules: {
            username:   {  required: true},
            email:      {  required: true ,  email: true},
            comment:    {  required: true},
            rating:    {  required: true},

        },
        messages: {
            username:   {  required: "Name is required",  },
            email:      {  required: "Email is required",  },
            comment:    {  required: "Comment is required",  },
            rating:    {  required: "Rating is required",  },

        }
    });

     // front contact form validation
     $('#contactForm').validate({
        rules: {
            name:   {  required: true},
            email:      {  required: true ,  email: true},
            subject:    {  required: true},
            message:    {  required: true},

        },
        messages: {
            name:   {  required: "jqereName is required",  },
            email:      {  required: "Email is required",  },
            subject:    {  required: "Subject is required",  },
            message:    {  required: "Message is required",  },

        }
    });


