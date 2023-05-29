
//user Registration Form validation
$('#register_form').validate({

    rules: {
        fname: {  required: true},

           },
    messages: {
        fname: {     required: "name is required",  },


    }

    });
