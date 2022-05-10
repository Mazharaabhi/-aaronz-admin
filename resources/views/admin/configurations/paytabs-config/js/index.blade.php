<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#configurations', '#paytabs_config', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.configurations.paytabs-config.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'type' },
            { data: 'profile_id' },
            { data: 'cart_id' },
            { data: 'currency' },
            { data: 'status', orderable: false, searchable: false},
            { data: 'action', orderable: false, searchable: false}
            ]
        });

         //TODO: Generating Random Passowrd
     $('#generate_company_prefix').click(function(){
        var characters = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";

              //specify the length for the new string
        var lenString = 3;
        var randomstring = '';

        //loop to select a new character in each iteration
        for (var i=0; i<lenString; i++) {
          var rnum = Math.floor(Math.random() * characters.length);
          randomstring += characters.substring(rnum, rnum+1);
        }

        //display the generated string
        $('#company_prefix').val(randomstring.toUpperCase());
    });

     //TODO: Generating uppser case value
     $('#company_prefix').keyup(function()
    {
        $(this).val($(this).val().toUpperCase());
    });

        //TODO: For opening add menu modal
        $('#OpenAddModel').click(function()
        {
            $('#Add_Menu_Modal').modal('show');
            $('#type').val("");
            $('#profile_id').val("");
            $('#server_key').val("");
            $('#company_prefix').val("");
            $('#type_error').html("");
            $('#profile_id_error').html("");
            $('#server_key_error').html("");
            $('#company_prefix_error').html("");
            $('#currency_error').html("");
        });

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const type = $('#type').val();
            const profile_id = $('#profile_id').val();
            const server_key = $('#server_key').val();
            const company_prefix = $('#company_prefix').val();
            const currency = $('select[name="currency"]').val();

            //TODO: Applying Validations Here
            if(!type)
            {
                $('#type_error').html("@lang('translation.account_type_is_required')");
                return $('#type').focus();
            }
            else if(!profile_id)
            {
                $('#type_error').html("");
                $('#profile_id_error').html("@lang('translation.profile_id_required')");
                return $('#profile_id').focus();
            }
            else if(!server_key || !$.trim(server_key).length)
            {
                $('#type_error').html("");
                $('#profile_id_error').html("");
                $('#server_key_error').html("@lang('translation.server_key_is_required')");
                return $('#server_key').focus();
            }
            else if(!company_prefix || !$.trim('company_prefix').length)
            {
                $('#type_error').html("");
                $('#profile_id_error').html("");
                $('#server_key_error').html("");
                $('#company_prefix_error').html("@lang('translation.company_prefix_required')");
                return $('#company_prefix').focus();
            }
            else if(company_prefix.length < 3 || company_prefix.length > 3)
            {
                $('#type_error').html("");
                $('#profile_id_error').html("");
                $('#server_key_error').html("");
                $('#company_prefix_error').html("@lang('translation.company_prefix_length')");
                return $('#company_prefix').focus();
            }
            else if(!currency)
            {
                $('#type_error').html("");
                $('#profile_id_error').html("");
                $('#server_key_error').html("");
                $('#company_prefix_error').html("");
                $('#currency_error').html("@lang('translation.currency_required')");
                return $('#currency').focus();
            }
            else
            {
                $('#type_error').html("");
                $('#profile_id_error').html("");
                $('#server_key_error').html("");
                $('#company_prefix_error').html("");
                $('#currency_error').html("");
                const cart_number = "{{ $cart_number }}";
                //TODO: Seding Ajax Requrest for creating paytabs config
                $.ajax({
                    url:"{{ route('admin.configurations.paytabs-config.create') }}",
                    method:"POST",
                    data:{type, profile_id, server_key, company_prefix, cart_number, currency,_token},
                    beforeSend:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#save').attr('class',`${btn_primary }  ${spinner}`);
                        $('#save').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.save')`);
                        $('#save').attr('class',`${btn_primary }`);
                        $('#save').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                         console.log(res);
                        if(res == "true")
                        {
                            ToastSuccess("@lang('translation.account_created_successfully')");
                            Redirect('', '');
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "merchant")
                        {
                            Message('Violation', 'Your merchant account is already exist', 'red');
                        }
                        else if(res == "sandbox")
                        {
                            Message('Violation', 'Your sandbox account is already exist', 'red');
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        //TODO: Getting Data and opening the update model to update the data
        var id = '';
        $('body').delegate('#edit', 'click', function()
        {
            id = $(this).parent().find('input[name="id"]').val();
            const db_profile_id = $(this).parent().find('input[name="profile_id"]').val();
            const db_server_key = $(this).parent().find('input[name="server_key"]').val();
            const db_cart_id = $(this).parent().find('input[name="cart_id"]').val();
            const db_type = $(this).parent().find('input[name="type"]').val();
            const db_currency = $(this).parent().find('input[name="currency"]').val();

            // //TODO: Assigning values to update fields
            $('#edit_profile_id').val(db_profile_id);
            $('#edit_server_key').val(db_server_key);
            $('#edit_cart_id').val(db_cart_id);
            $('#edit_type').val(db_type);
            $('#edit_currency').val(db_currency);
            //TODO: Open edit model here
            $('#Edit_Menu_Modal').modal('show');

        });


        //TODO: Creating new navbar menu
        $('#update').click(function()
        {
            const profile_id = $('#edit_profile_id').val();
            const server_key = $('#edit_server_key').val();
            const currency = $('select[name="edit_currency"]').val();
            //TODO: Applying Validations Here
            if(!profile_id)
            {
                $('#edit_profile_id_error').html("@lang('translation.profile_id_required')");
                return $('#edit_profile_id').focus();
            }
            else if(!server_key || !$.trim(server_key).length)
            {
                $('#edit_profile_id_error').html("");
                $('#edit_server_key_error').html("@lang('translation.server_key_is_required')");
                return $('#edit_server_key').focus();
            }
            else if(!currency)
            {
                $('#edit_profile_id_error').html("");
                $('#edit_server_key_error').html("");
                $('#edit_currency_error').html("@lang('translation.currency_required')");
                return $('#edit_currency').focus();
            }
            else
            {
                $('#edit_profile_id_error').html("");
                $('#edit_server_key_error').html("");
                $('#edit_currency_error').html("");
                //TODO: Seding Ajax Requrest for creating paytabs config
                $.ajax({
                    url:"{{ route('admin.configurations.paytabs-config.update') }}",
                    method:"POST",
                    data:{id, profile_id, server_key, currency,_token},
                    beforeSend:function()
                    {
                        $('#update').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#update').attr('class',`${btn_primary }  ${spinner}`);
                        $('#update').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#update').html(`${save_icon} @lang('translation.save')`);
                        $('#update').attr('class',`${btn_primary }`);
                        $('#update').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                         console.log(res);
                        if(res == "true")
                        {
                            ToastSuccess("@lang('translation.account_updated_successfully')");
                            $('#Edit_Menu_Modal').modal('hide');
                            DataTable.ajax.reload();
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        //TODO: Change Status
        $('body').delegate('#status', 'click', function(){
            var id = $(this).parent().find('input[name="id"]').val();
            //Delete Confirmation
            $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Confirm active this account?',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('admin.configurations.paytabs-config.status') }}",
                                    method:"POST",
                                    data:{id, _token},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('Account activated successfully!');
                                        Redirect('','');
                                    },
                                    error:function(xhr)
                                    {
                                        console.log(xhr.responseText);
                                    }
                                });
                            }
                        }
                    }
                });
        });

});
</script>
