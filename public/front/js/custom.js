//user Registration Form validation
$('#register_form').validate({

    rules: {
        fname: {  required: true},
        phone: {  required: true },
        email: {  required: true },
        password: {  required: true },
        password_confirmation: {  required: true, },
        birthday: {  required: true,

        },
           },
    messages: {
        fname: {     required: "name is required",  },
        phone: {  required: "phone number is required", },
        email: {  required: "email is required", },
        password: {  required: "password is required", },
        password_confirmation: {  required: "confirm Password is required", },
        birthday: {  required: " date of birth is required"},

    }

    });
