<script>
    $(document).ready(function()
    {
        @include('messages.jquery-messages');

        //TODO: Removing the spaces from the password and from confirm_password here
        $('#reset-password').keypress(function(event)
            {
                var key = event.keyCode;
                if (key === 32) {
                event.preventDefault();
            }
        });

        $('#confirm-reset-password').keypress(function(event)
            {
                var key = event.keyCode;
                if (key === 32) {
                event.preventDefault();
            }
        });

        //TODO: For User Sign up
        $('#reset-password-btn').click(function()
        {
            const password = $('#reset-password').val();
            const cpassword = $('#confirm-reset-password').val();
            const phone = $('#number').html();

            //TODO Applying validation here
            if(!password || !$.trim(password).length)
            {
                $('#reset_password_error').html("@lang('translation.password_is_required')");
            }
            else if(password.length <= 5)
            {
                $('#reset_password_error').html("@lang('translation.password_length_error')");
            }
            else
            {
                $('#reset_password_error').html("");
            }

            //TODO: Confirm Password Validations
            if(!cpassword)
            {
                $('#confirm_reset_password_error').html("@lang('translation.confirm_password_is_required')");
            }
            else if(password != cpassword)
            {
                $('#confirm_reset_password_error').html("@lang('translation.password_are_not_matched')");
            }
            else
            {
                $('#confirm_reset_password_error').html("");
            }

            //TODO: Validating the
            if(
            !$('#reset_password_error').html() &&
            !$('#confirm_reset_password_error').html()
            )
            {
            //TODO: Creating formData instance her
            var formData = new FormData;
            formData.append('password', password);
            formData.append('phone', phone);
            formData.append('_token', _token);

            //TODO: Seding Ajax Requrest for Sign up the user
            $.ajax({
                    url:"{{ route('website.auth.reset-password') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    beforeSend:function()
                    {
                        $('#reset-password-btn').val("@lang('translation.please_wait')");
                        $('#reset-password-btn').attr('class',"btn btn-primary btn-lg");
                        $('#reset-password-btn').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#reset-password-btn').val("@lang('translation.reset_password')");
                        $('#reset-password-btn').attr('class',"btn btn-primary btn-lg");
                        $('#reset-password-btn').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            $('#reset-password-row').attr('class', 'row row-eq-height  d-none');
                            $('#login-row').attr('class', 'row row-eq-height');
                            $('#number').html('');
                            $('#phone').val(phone);
                            $('#phone').focus();
                            $('#reset-password').val('');
                            $('#confirm-reset-password').val('');
                        }
                        else if(res == "Cyber")
                        {
                            // ToastError("warning", "@lang('translation.cyber_message')");
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
