
<script>
    $(document).ready(function(){
        @include('messages.jquery-messages');

        // TODO: Login Process
        $('#submit').click(function()
        {
            const password = $('#password').val();
            const confirm_password = $('#confirm_password').val();
            const id = "{{ $user->id }}";

            //TODO: Applying Validations here
            if(!password || !$.trim(password).length)
            {
                $('#password_error').html("@lang('translation.password_is_required')");
                return $('#password').focus();
            }
            else if(password.length <= 5)
            {
                $('#password_error').html("@lang('translation.password_length_error')");
                return $('#password').focus();
            }
            else if(!confirm_password)
            {
                $('#password_error').html("");
                $('#confirm_password_error').html("@lang('translation.confirm_password_is_required')");
                return $('#confirm_password').focus();
            }
            else if(confirm_password != password)
            {
                $('#password_error').html("");
                $('#confirm_password_error').html("@lang('translation.password_are_not_matched')");
                return $('#confirm_password').focus();
            }
            else
            {
                $('#confirm_password_error').html("");
                $('#password_error').html("");

                //TODO: Seding Ajax Requrest for login the user
                $.ajax({
                    url:"{{ route('admin.auth.reset-password-process') }}",
                    method:"PUT",
                    data:{id,password,_token},
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
                        if(res == "true")
                        {
                            Message("@lang('translation.success')", "@lang('translation.password_reset_successfully')", "green");
                            Redirect(1, "{{ route('admin.auth.index') }}");
                        }
                        else if(res == "Cyber")
                        {
                            Message("@lang('translation.violation')", "@lang('translation.cyber_message')", "red");
                        }
                    },error:function(xhr)
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



    });
</script>
