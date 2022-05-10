
<script>
    $(document).ready(function(){
        @include('messages.jquery-messages');
        MakeMenuActive('#configurations','#profile_settings');

        // TODO: Change Password Process
        $('#submit').click(function()
        {
            const current_password = $('#current_password').val();
            const new_password = $('#new_password').val();
            const confirm_password = $('#confirm_password').val();

            //TODO: Applying Validations here
            if(!current_password || !$.trim(current_password).length)
            {
                $('#current_password_error').html("@lang('translation.current_password_is_required')");
                return $('#current_password').focus();
            }
            if(!new_password || !$.trim(new_password).length)
            {
                $('#current_password_error').html("");
                $('#new_password_error').html("@lang('translation.new_password_is_required')");
                return $('#new_password').focus();
            }
            else if(new_password.length <= 5)
            {
                $('#current_password_error').html("");
                $('#new_password_error').html("@lang('translation.new_password_length_error')");
                return $('#new_password').focus();
            }
            else if(!confirm_password)
            {
                $('#current_password_error').html("");
                $('#new_password_error').html("");
                $('#password_error').html("");
                $('#confirm_password_error').html("@lang('translation.confirm_password_is_required')");
                return $('#confirm_password').focus();
            }
            else if(confirm_password != new_password)
            {
                $('#current_password_error').html("");
                $('#new_password_error').html("");
                $('#confirm_password_error').html("@lang('translation.password_are_not_matched')");
                return $('#confirm_password').focus();
            }
            else
            {
                $('#current_password_error').html("");
                $('#new_password_error').html("");
                $('#confirm_password_error').html("");

                //TODO: Seding Ajax Requrest for login the user
                $.ajax({
                    url:"{{ route('admin.profile.update-password') }}",
                    method:"POST",
                    data:{current_password, new_password, _token},
                    beforeSend:function()
                    {
                        $('#submit').html("@lang('translation.please_wait')");
                        $('#submit').attr('class',`${btn_success }  ${spinner}`);
                        $('#submit').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#submit').html("@lang('translation.save_changes')");
                        $('#submit').attr('class',`${btn_success }`);
                        $('#submit').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("@lang('translation.password_changed_successfully')");
                            $('#current_password').val('');
                            $('#new_password').val('');
                            $('#confirm_password').val('');
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "current_password")
                        {
                            $('#current_password_error').html("@lang('translation.current_password_is_not_correct')");
                            return $('#current_password').focus();
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }

        });


        //TODO: Removing the spaces from the password and from confirm_password here
        $('#current_password').keypress(function(event)
            {
                var key = event.keyCode;
                if (key === 32) {
                event.preventDefault();
            }
        });

        $('#new_password').keypress(function(event)
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
