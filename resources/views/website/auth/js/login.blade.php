<script>
    $(document).ready(function()
    {
        @include('messages.jquery-messages');

        //TODO: Removing the spaces from the password and from confirm_password here
        $('#password').keypress(function(event)
            {
                var key = event.keyCode;
                if (key === 32) {
                event.preventDefault();
            }
        });
        //TODO: For User Sign up
        $('#Login').click(function()
        {
            const phone = $('#phone').val();
            const password = $('#password').val();

            //TODO Applying validation here
            if(!phone || !$.trim(phone).length)
            {
                $('#login_error').html("@lang('translation.phone_number_is_required')");
            }
            else if(!password || !$.trim(password).length)
            {
                $('#login_error').html("@lang('translation.password_is_required')");
            }
            else
            {
                $('#login_error').html("");

                //TODO: Creating formData instance her
                var formData = new FormData;
                formData.append('phone', phone);
                formData.append('password', password);
                formData.append('_token', _token);

            //TODO: Seding Ajax Requrest for Sign up the user
            $.ajax({
                    url:"{{ route('website.auth.login') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    beforeSend:function()
                    {
                        $('#Register').val("@lang('translation.please_wait')");
                        $('#Register').attr('class',"btn btn-primary btn-lg");
                        $('#Register').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#Register').val("@lang('translation.login')");
                        $('#Register').attr('class',"btn btn-primary btn-lg");
                        $('#Register').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "verify")
                        {
                            //TODO: Showing the verfication div
                            $('#verification-row').attr('class', 'row row-eq-height');
                            $('#login-row').attr('class', 'row row-eq-height d-none');
                            $('#login-tab').trigger('click');
                            $('#number').html(phone);
                        }
                        else if(res == "Cyber")
                        {
                            // ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "false")
                        {
                            $('#logon_error').html("@lang('translation.invalid_phone_or_password')");
                        }
                        else{
                            window.location.reload();
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
