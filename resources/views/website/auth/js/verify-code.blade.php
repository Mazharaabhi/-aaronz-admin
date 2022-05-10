<script>
    $(document).ready(function()
    {
        @include('messages.jquery-messages');

        //TODO: For Authenticate User Code
        $('#verify-code').click(function()
        {
            const code = $('#code').val();
            const is_forgot = $('#is_forgot').val();
            const phone = $('#number').html();

            //TODO Applying validation here
            if(!code || !$.trim(code).length)
            {
                $('#code_error').html("@lang('translation.code_is_required')");
            }
            else
            {
            //TODO: Creating formData instance her
            var formData = new FormData;
            formData.append('phone', phone);
            formData.append('code', code);
            formData.append('is_forgot', is_forgot);
            formData.append('_token', _token);

            //TODO: Seding Ajax Requrest for verfiy code
            $.ajax({
                    url:"{{ route('website.auth.verify-code') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    beforeSend:function()
                    {
                        $('#verify-code').val("@lang('translation.please_wait')");
                        $('#verify-code').attr('class',"btn btn-primary btn-lg btn-block");
                        $('#verify-code').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#verify-code').val("@lang('translation.verify')");
                        $('#verify-code').attr('class',"btn btn-primary btn-lg btn-block");
                        $('#verify-code').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            //TODO: Showing the verfication div
                            if(is_forgot == 1)
                            {
                                $('#verification-row').attr('class', 'row row-eq-height  d-none');
                                $('#reset-password-row').attr('class', 'row row-eq-height');
                                $('#reset-password').focus();
                                $('#is_forgot').val(0);
                                $('#number').val(phone);
                            }
                            else if(is_forgot == 0)
                            {
                                $('#verification-row').attr('class', 'row row-eq-height  d-none');
                                $('#login-row').attr('class', 'row row-eq-height');
                                $('#number').html('');
                                $('#phone').val(phone);
                                $('#phone').focus();
                            }
                        }
                        else if(res == "Cyber")
                        {
                            // ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "false")
                        {
                            $('#code_error').html("@lang('translation.verification_code_is_not_valid')");
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
