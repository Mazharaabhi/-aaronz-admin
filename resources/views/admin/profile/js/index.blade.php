<script>
    $(document).ready(function(){
        @include('messages.jquery-messages');
        MakeMenuActive('#configurations','#profile_settings');


         //TODO: Getting States of the Country
     $.ajax({
                url:"{{ route('get.states') }}",
                method:"POST",
                data:{country:"{{ $company->country }}", _token},
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
                    $('#state').val("{{ $company->state }}");
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

        //TODO: Getting the avatar in the canavas on change
        $('#profile_avatar').change(function(){
            var input = this;
            if (input.files && input.files[0])
            {
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    //Appending the user avatar to avatar div
                    $('.image-input-wrapper').attr('style', `background-image: url(${e.target.result})`);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        });

        //TODO: Removing the avatar
        $('.remove-avatar').click(function(){
            $('.image-input-wrapper').removeAttr('style');
            avatar = '';
        });

        //TODO: Creating new navbar menu
   $('#save').click(function()
   {
       const name = $('#name').val();
       const designation = $('#designation').val();
       const company_name = $('#company_name').val();
       const new_email = $('#new_email').val();
       const phone = $('#phone').val();
       const mobile = $('#mobile').val();
       const address = $('#address').val();
       const city = $('#city').val();
       const zip = $('#zip').val();
       const country = $('#country').val();
       const state = $('#state').val();
       //TODO: Regular Expression For Email

        // console.log(`${name} ${designation} ${company_name} ${new_email} ${phone} ${mobile} ${profile_id} ${server_key} ${currency} ${address} ${city} ${zip} ${country} ${state}
        //  ${company_prefix} ${cart_number} ${paytab_id} ${company_profile} ${account_type} ${branded_pay_page} ${branded_email} ${withdraw_limit}`);

       var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       const checkEmail = emailReg.test( new_email );

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
       else if(!designation || !$.trim(designation).length)
       {
           $('#name_error').html("");
           $('#designation_error').html("@lang('translation.designation_required')");
           return $('#designation').focus();
       }
       else if(designation.length <= 2)
       {
           $('#name_error').html("");
           $('#designation_error').html("@lang('translation.designation_required')");
           return $('#designation').focus();
       }
       else if(!company_name || !$.trim(company_name).length)
       {
            $('#name_error').html("");
            $('#designation_error').html("");
           $('#company_name_error').html("@lang('translation.company_name_is_required')");
           return $('#company_name').focus();
       }
       else if(company_name.length <= 2)
       {
            $('#name_error').html("");
            $('#designation_error').html("");
           $('#company_name_error').html("@lang('translation.company_name_length_error')");
           return $('#company_name').focus();
       }
       else if(new_email == "")
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("@lang('translation.email_is_required')");
           return $('#new_email').focus();
       }
       else if(checkEmail == false)
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email').html("@lang('translation.email_format_is_not_valid')");
           return $('#new_email').focus();
       }

        else
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#new_email_error').html("");
           $('#company_name_error').html("");
           $('#password_error').html("");
           $('#confirm_password_error').html("");
           $('#company_prefix_error').html("");
           //TODO: Initializing Form Data Object

           const image = document.getElementById('profile_avatar').files[0];

           const formData = new FormData;
           formData.append('name', name);
           formData.append('avatar', image);
           formData.append('designation', designation);
           formData.append('company_name', company_name);
           formData.append('email', new_email);
           formData.append('phone', phone);
           formData.append('mobile', mobile);
           formData.append('address', address);
        //    formData.append('city', city);
        //    formData.append('zip', zip);
        //    formData.append('country', country);
        //    formData.append('state', state);
           formData.append('_token', _token);
           //TODO: Seding Ajax Requrest for creating navbar menu
           $.ajax({
               url:"{{ route('admin.profile.update') }}",
               method:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:false,
               beforeSend:function()
               {
                   $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                   $('#save').attr('class',`btn btn-info btn-block  ${spinner}`);
                   $('#save').attr('disabled',true);
               },
               complete:function()
               {
                   $('#save').html(`${save_icon} @lang('translation.edit_company')`);
                   $('#save').attr('class',`btn btn-info btn-block`);
                   $('#save').removeAttr('disabled');
               },
               success:function(res)
               {
                   console.log(res);
                   if(res == "true"){
                       ToastSuccess("@lang('translation.company_updated_sucessfully')");
                   }
                   else if(res == "Cyber")
                   {
                       ToastError("warning", "@lang('translation.cyber_message')");
                   }
                   else if(res == "email")
                   {
                       $('#new_email_error').html("@lang('translation.email_already_taken')");
                       return $('#new_email').focus();
                   }
                   else if(res == "email_template")
                   {
                    Message('Violation', "Email Template not found for Register Company Please Create One!", 'red');
                   }
               },error:function(xhr)
               {
                   console.log(xhr.responseText);
               }
           });
       }
   });
    });
</script>
