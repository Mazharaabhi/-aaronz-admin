<script>
$(document).ready(function(){
   @include('messages.jquery-messages')
   MakeMenuActive('#manage_customer', '#all_customer', '#service_anchor');

        //TODO: Generating Random Passowrd
        $('#generate_password').click(function(){
        var randomstring = Math.random().toString(36).slice(-8);
        $('#password').val(randomstring);
        $('#confirm_password').val(randomstring);
    });


    //TODO: Removing the spaces from the password and from confirm_password here
    $('#password').keypress(function(event)
        {
            var key = event.keyCode;
            if (key === 32) {
            event.preventDefault();
        }
    });

    $('#confirm_password').keypress(function(event)
        {
            var key = event.keyCode;
            if (key === 32) {
            event.preventDefault();
        }
    });

   //TODO: Creating new navbar menu
   $('#save').click(function()
   {
       const name = $('#name').val();
       const customer_email = $('#customer_email').val();
       const password = $('#password').val();
       const confirm_password = $('#confirm_password').val();
       const phone = $('#phone').val();

       //TODO: Regular Expression For Email
       var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       const checkEmail = emailReg.test( customer_email );

       //TODO: Applying Validations Here
       if(!name || !$.trim(name).length)
       {
           $('#name_error').html("The full name field is required.");
           return $('#name').focus();
       }
       else if(name.length <= 2)
       {
           $('#name_error').html("@lang('translation.name_length_error')");
           return $('#name').focus();
       }
       else if(!customer_email)
       {
           $('#name_error').html("");
           $('#email_error').html("@lang('translation.email_is_required')");
           return $('#customer_email').focus();
       }
       else if(phone == "")
       {
           $('#email_error').html("");
           $('#name_error').html("");
           $('#phone_error').html("The Phone filed is required.");
           return $('#phone').focus();
       }
       else if(checkEmail == false)
       {
           $('#name_error').html("");
           $('#phone_error').html("");
           $('#email_error').html("@lang('translation.email_format_is_not_valid')");
           return $('#customer_email').focus();
       }
       else if(!password || !$.trim(password).length)
        {
            $('#name_error').html("");
            $('#phone_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#email_error').html("");
            $('#password_error').html("@lang('translation.password_is_required')");
            return $('#password').focus();
        }
        else if(password.length <= 5)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#phone_error').html("");
            $('#new_email_error').html("");
            $('#email_error').html("");
            $('#password_error').html("@lang('translation.password_length_error')");
            return $('#password').focus();
        }
        else if(!confirm_password)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#phone_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("@lang('translation.confirm_password_is_required')");
            return $('#confirm_password').focus();
        }
        else if(confirm_password != password)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#phone_error').html("");
            $('#new_email_error').html("");
            $('#email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("@lang('translation.password_are_not_matched')");
            return $('#confirm_password').focus();
        }
       else
       {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#email_error').html("");
            $('#phone_error').html("");
            $('#new_email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("");
            $('#role_error').html("");

           //TODO: Initializing Form Data Object
           const formData = new FormData;
           formData.append('name', name);
           formData.append('email', customer_email);
           formData.append('password', password);
           formData.append('real_password', password);
           formData.append('role_id', 7);
           formData.append('phone', phone);
           formData.append('_token', _token);

           //TODO: Seding Ajax Requrest for creating navbar menu
           $.ajax({
               url:"{{ route('admin.customers.manage-customer.create-process') }}",
               method:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:false,
               beforeSend:function()
               {
                   $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                   $('#save').attr('class',`btn btn-danger btn-block  ${spinner}`);
                   $('#save').attr('disabled',true);
               },
               complete:function()
               {
                   $('#save').html(`${save_icon} @lang('translation.save')`);
                   $('#save').attr('class',`btn btn-danger btn-block`);
                   $('#save').removeAttr('disabled');
               },
               success:function(res)
               {
                    console.log(res);
                   if(res == "Cyber")
                   {
                       ToastError("warning", "@lang('translation.cyber_message')");
                   }
                   else if(res == "email")
                   {
                       $('#email_error').html("@lang('translation.email_already_taken')");
                       return $('#email').focus();
                   }
                   else if(res == "phone")
                   {
                       $('#phone_error').html("@lang('translation.phone_already_taken')");
                       return $('#phone').focus();
                   }else{
                       ToastSuccess("Customer Created Successfully!");
                        $('#name').val('');
                        $('#customer_email').val('');
                        $('#password').val('');
                        $('#confirm_password').val('');
                        $('#role_id').val('');
                        $('#phone').val('');
                        $('#street').val('');
                        $('#city').val('');
                        $('#country').val('');
                        $('#state').val('');
                        $('#zip').val('');
                        $('#state_count').val('');
                   }
               },error:function(xhr)
               {
                   console.log(xhr.responseText);
               }
           });
       }
   });

   //TODO: Getting Data and opening the update model to update the data
   var id = '';
   $('body').delegate('#edit', 'click', function()
   {
       id = $(this).parent().find('input[name="id"]').val();
       const db_title_english = $(this).parent().find('input[name="title_english"]').val();
       const db_title_arabic = $(this).parent().find('input[name="title_arabic"]').val();

       //TODO: Assigning values to update fields
       $('#edit_title_english').val(db_title_english);
       $('#title_arabic').val(db_title_arabic);
       //TODO: Open edit model here
       $('#edit_Menu_Modal').modal('show');
       $('#english-tab').trigger('click');

   });


});
</script>
