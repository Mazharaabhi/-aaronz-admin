<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#configurations','#profile_settings');

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const sender_id_by_number = $('#sender_id_by_number').val();
            const sender_id_by_name = $('#sender_id_by_name').val();
            const api_key = $('#api_key').val();
            const active_sms_id = $('input[name="active_sms_id"]:checked').val();
            //TODO: Applying Validations Here
            if(!sender_id_by_number)
            {

                $('#sender_id_by_number_error').html("The sender id by number field is required.");
                return $('#sender_id_by_number').focus();
            }
            else if(!sender_id_by_name || !$.trim(sender_id_by_name).length)
            {

                $('#sender_id_by_number_error').html("");
                $('#sender_id_by_name_error').html("The sender id by name field is required.");
                return $('#sender_id_by_name').focus();
            }
            else if(!api_key || !$.trim('api_key').length)
            {

                $('#sender_id_by_number_error').html("");
                $('#sender_id_by_name_error').html("");
                $('#api_key_error').html("The api key field is required.");
                return $('#api_key').focus();
            }
            else
            {
                $('#sender_id_by_number_error').html("");
                $('#sender_id_by_name_error').html("");
                $('#api_key_error').html("");
                //TODO: Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"{{ route('admin.sms-api.update') }}",
                    method:"POST",
                    data:{sender_id_by_number, sender_id_by_name, active_sms_id, api_key ,_token},
                    beforeSend:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#save').attr('class',`btn btn-block btn-danger  ${spinner}`);
                        $('#save').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.save')`);
                        $('#save').attr('class',`btn btn-block btn-danger`);
                        $('#save').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("The sms api updated successfully!");
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "iban")
                        {
                            $('#iban_error').html("@lang('translation.iban_exists')");
                            return $('#iban').focus();
                        }
                        else if(res == "account_no")
                        {
                            $('#account_no_error').html("@lang('translation.account_no_exists')");
                            return $('#account_no').focus();
                        }
                        else if(res == "sender_id_by_number")
                        {
                            $('#sender_id_by_number_error').html("This Center Id by number is already taken.");
                            return $('#sender_id_by_number').focus();
                        }
                        else if(res == "sender_id_by_name")
                        {
                            $('#sender_id_by_name_error').html("This Center Id by name is already taken.");
                            return $('#sender_id_by_name').focus();
                        }
                        else if(res == "secrate_key")
                        {
                            $('#secrate_key_error').html("This Secrate Key is already taken.");
                            return $('#secrate_key').focus();
                        }
                        else if(res == "api_key")
                        {
                            $('#api_key_error').html("This api Key is already taken.");
                            return $('#api_key').focus();
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

