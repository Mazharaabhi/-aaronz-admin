<script>
    $(document).ready(function(){
        @include('messages.jquery-messages');

        // TODO: Forgot Password Process
        $('#submit').click(function()
        {
            const email = $('#email').val();
            //TODO: Regular Expression For Email
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            const checkEmail = emailReg.test( email );

            //TODO: Applying Validations here
            if(!email || !$.trim(email).length)
            {
                $('#email_error').html("@lang('translation.email_is_required')");
                return $('#email').focus();
            }
            else if(checkEmail == false)
            {
                $('#email_error').html("@lang('translation.email_format_is_not_valid')");
                return $('#email').focus();
            }
            else
            {
                $('#email_error').html("");

                //TODO: Seding Ajax Requrest for login the user
                $.ajax({
                    url:"{{ route('admin.auth.forgot-password-process') }}",
                    method:"PUT",
                    data:{email,_token},
                    beforeSend:function()
                    {
                        $('#submit').html("@lang('translation.please_wait')");
                        $('#submit').attr('class',`${btn_cherwell }  ${spinner}`);
                        $('#submit').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#submit').html("@lang('translation.submit')");
                        $('#submit').attr('class',`${btn_cherwell }`);
                        $('#submit').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            Message("@lang('translation.success')", "@lang('translation.forgot_password_mail_message')", "green");
                            $('#email').val('');
                        }
                        else if(res == "Cyber")
                        {
                            Message("@lang('translation.violation')", "@lang('translation.cyber_message')", "red");
                        }
                        else
                        {
                            Message("@lang('translation.encountered_an_error')", "@lang('translation.email_not_exist')", "red");
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
