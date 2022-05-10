<script>
    //TODO: Copy Redirect Url
function CopyLink() {
var $temp = $("<input>");
$("body").append($temp);
$temp.val($('#Link').html()).select();
document.execCommand("copy");
$temp.remove();
console.log($temp);
alert('Link Copied!');
}
$(document).ready(function(){
   @include('messages.jquery-messages')
   MakeMenuActive('#administrator', '#manage_users', '#service_anchor');

        //TODO: Generating Random Passowrd
        $('#generate_password').click(function(){
        var randomstring = Math.random().toString(36).slice(-8);
        $('#password').val(randomstring);
        $('#confirm_password').val(randomstring);
    });

     //TODO: Getting States of the Country
     $.ajax({
                url:"{{ route('get.states') }}",
                method:"POST",
                data:{country:"{{ $customer->country }}", _token},
                success:function(res)
                {
                    var data = JSON.parse(res);
                    var html = `<option value="">-- State  --</option>`;
                    $('#state_count').val(data.state_count);
                    if(data.state_count > 0)
                    {
                        for(var i=0; i < data.state_count; i++)
                        {
                            html += `<option value="${data.states[i]['val']}">${data.states[i]['text']}</option>`;
                        }
                    }
                    $('#state').html(html);
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
    });


    $('#country').change(function()
    {
        const country = $(this).val();

        if(!country)
        {
            $('#state').html('<option value="">-- State  --</option>');
        }
        else
        {
            //TODO: Getting States of the Country
            $.ajax({
                url:"{{ route('get.states') }}",
                method:"POST",
                data:{country, _token},
                success:function(res)
                {
                    var data = JSON.parse(res);
                    var html = `<option value="">-- State  --</option>`;
                    $('#state_count').val(data.state_count);
                    if(data.state_count > 0)
                    {
                        for(var i=0; i < data.state_count; i++)
                        {
                            html += `<option value="${data.states[i]['val']}">${data.states[i]['text']}</option>`;
                        }
                    }
                    $('#state').html(html);
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        }
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
       const role_id = $('#role_id').val();
       const phone = $('#phone').val();
       const street = $('#street').val();
       const city = $('#city').val();
       const country = $('#country').val();
       const state = $('#state').val();
       const zip = $('#zip').val();
       const state_count = $('#state_count').val();

       //TODO: Regular Expression For Email
       var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       const checkEmail = emailReg.test( customer_email );

       //TODO: Applying Validations Here
       if(!name || !$.trim(name).length)
       {
           $('#name_error').html("@lang('translation.name_is_required')");
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
       else if(checkEmail == false)
       {
           $('#name_error').html("");
           $('#email_error').html("@lang('translation.email_format_is_not_valid')");
           return $('#customer_email').focus();
       }
        else if(!role_id)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("");
            return $('#role_error').html("The User Role field is required.");
        }
       else
       {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#email_error').html("");
            $('#new_email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("");
            $('#role_error').html("");

           //TODO: Initializing Form Data Object
           const formData = new FormData;
           formData.append('id', "{{ $customer->id }}");
           formData.append('name', name);
           formData.append('email', customer_email);
           formData.append('role_id', role_id);
           formData.append('phone', phone);
           formData.append('city', city);
           formData.append('zip', zip);
           formData.append('country', country);
           formData.append('state', state);
           formData.append('address', street);
           formData.append('_token', _token);

           //TODO: Seding Ajax Requrest for creating navbar menu
           $.ajax({
               url:"{{ route('admin.administrator.manage-users.update') }}",
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
                       ToastSuccess("User Updated Successfully!");
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
