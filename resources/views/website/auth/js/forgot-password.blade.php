<script>
    $(document).ready(function()
    {
        @include('messages.jquery-messages');

        //TODO: For back to login
        $('#forgot-password-back').click(function()
        {
            //TODO: Showing the login password div
            $('#forgot-row').attr('class', 'row row-eq-height d-none');
            $('#login-row').attr('class', 'row row-eq-height');
        });

        //TODO: For Showing forgot password div
        $('#forgot-password').click(function()
        {
            //TODO: Showing the forgot password div
            $('#forgot-row').attr('class', 'row row-eq-height');
            $('#login-row').attr('class', 'row row-eq-height d-none');
        });
        //TODO: For Sending Forgot Password Code
        $('#forgot-password-btn').click(function()
        {
            const phone = $('#forgot-phone').val();

            //TODO Applying validation here
            if(!phone || !$.trim(phone).length)
            {
                $('#forgot_phone_error').html("@lang('translation.phone_number_is_required')");
            }
            else if(phone.length < 9)
            {
                $('#forgot_phone_error').html("@lang('translation.phone_number_is_required_length')");
            }
            else
            {
            $('#forgot_phone_error').html("");
            //TODO: Creating formData instance her
            var formData = new FormData;
            formData.append('phone', phone);
            formData.append('_token', _token);

            //TODO: Seding Ajax Requrest for sending forgot password code
            $.ajax({
                    url:"{{ route('website.auth.forgot-password') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    beforeSend:function()
                    {
                        $('#forgot-password-btn').val("@lang('translation.please_wait')");
                        $('#forgot-password-btn').attr('class',"btn btn-primary btn-lg btn-block");
                        $('#forgot-password-btn').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#forgot-password-btn').val("@lang('translation.send')");
                        $('#forgot-password-btn').attr('class',"btn btn-primary btn-lg btn-block");
                        $('#forgot-password-btn').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            //TODO: Showing the verfication div
                            $('#forgot-row').attr('class', 'row row-eq-height  d-none');
                            $('#verification-row').attr('class', 'row row-eq-height');
                            $('#number').html(phone);
                            $('#forgot-phone').val('');
                            $('#is_forgot').val(1);
                        }
                        else if(res == "Cyber")
                        {
                            return $('#forgot_phone_error').html("@lang('translation.cyber_message')");

                        }
                        else if(res == "false")
                        {
                           return $('#forgot_phone_error').html("@lang('translation.phone_not_exist')");
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }

        });

        //TODO: For Resend Authenticate User Code
        $('#resend-code').click(function()
        {
            const phone = $('#number').html();

            //TODO: Creating formData instance her
            var formData = new FormData;
            formData.append('phone', phone);
            formData.append('_token', _token);

            //TODO: Seding Ajax Requrest for resend verfiy code
            $.ajax({
                    url:"{{ route('website.auth.resend-code') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    success:function(res)
                    {
                        alert('Code Sent');
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
        });

        // TODO: Showing login form on clicking edit number link
        $('#edit_number').click(function()
        {
            $('#verification-row').attr('class', 'row row-eq-height  d-none');
            $('#login-row').attr('class', 'row row-eq-height');
            const phone = $('#number').html();
            $('#phone').val(phone);
            $('#phone').focus();
            $('#number').html();
        });
    });
</script>
