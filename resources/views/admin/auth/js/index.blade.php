
<script>
    $(document).ready(function(){
        @include('messages.jquery-messages');

        // TODO: Login Process
        $('#submit').click(function()
        {
            const email = $('#email').val();
            const password = $('#password').val();
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
            else if(!password)
            {
                $('#email_error').html("");
                $('#password_error').html("@lang('translation.password_is_required')");
                return $('#password').focus();
            }
            else
            {
                $('#email_error').html("");
                $('#password_error').html("");

                //TODO: Seding Ajax Requrest for login the user
                $.ajax({
                    url:"{{ route('admin.auth.login') }}",
                    method:"POST",
                    data:{email,password,_token},
                    beforeSend:function()
                    {
                        $('#submit').html("@lang('translation.please_wait')");
                        $('#submit').attr('class',`${btn_cherwell }  ${spinner}`);
                        $('#submit').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#submit').html("@lang('translation.sign_In')");
                        $('#submit').attr('class',`${btn_cherwell }`);
                        $('#submit').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "Authorized")
                        {
                            Redirect(1, "{{ route('admin.dashboard.index') }}");
                        }
                        else if(res == "Cyber")
                        {
                            Message("@lang('translation.violation')", "@lang('translation.cyber_message')", "red");
                        }
                        else
                        {
                            Message("@lang('translation.encountered_an_error')", "@lang('translation.invalid_email_or_password')", "red");
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }

        });


        //TODO: Removing the spaces from the password here
        $('#password').keypress(function(event)
            {
                var key = event.keyCode;
                if (key === 32) {
                event.preventDefault();
            }
        });



    });
</script>
