<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#companies', '#company_banks', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        dom: '<"top"i>rt<"bottom"flp><"clear">',
        ajax: "{{ route('admin.companies.companies-banks.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'company_name' },
            { data: 'bank_name' },
            { data: 'bic' },
            { data: 'account_no' },
            { data: 'iban' },
            { data: 'status' },
            { data: 'active' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });


        //TODO: For opening add menu modal
        $('#OpenAddModel').click(function()
        {
            $('#Add_Menu_Modal').modal('show');
            $('#bank_name').val("");
            $('#company_id').val("");
            $('#bic').val("");
            $('#account_name').val("");
            $('#iban').val("");
            $('#account_no').val("");
            $('#bank_name_error').html("");
            $('#bic_error').html("");
            $('#account_name_error').html("");
            $('#iban_error').html("");
            $('#account_no_error').html("");
            $('#account_no_error').html("");
        });

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const bank_name = $('#bank_name').val();
            const company_id = $('#company_id').val();
            const bic = $('#bic').val();
            const account_name = $('#account_name').val();
            const iban = $('#iban').val();
            const account_no = $('#account_no').val();
            const currency = $('#b_currency').val();
            const status = $('#b_status').val();
            //TODO: Applying Validations Here
            if(!company_id)
            {
                return $('#company_id_error').html("@lang('translation.company_required')");
            }
            if(!bank_name || !$.trim(bank_name).length)
            {
                $('#company_id_error').html("");
                $('#bank_name_error').html("@lang('translation.bank_field_required')");
                return $('#bank_name').focus();
            }
            else if(bank_name.length < 5)
            {
                $('#company_id_error').html("");
                $('#bank_name_error').html("@lang('translation.bank_field_lengt')");
                return $('#bank_name').focus();
            }
            else if(!bic || !$.trim(bic).length)
            {
                $('#company_id_error').html("");
                $('#bank_name_error').html("");
                $('#bic_error').html("@lang('translation.bic_required')");
                return $('#bic').focus();
            }
            else if(!account_name || !$.trim('account_name').length)
            {
                $('#company_id_error').html("");
                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("@lang('translation.account_name_field_required')");
                return $('#account_name').focus();
            }
            else if(account_name.length < 5)
            {
                $('#company_id_error').html("");
                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("@lang('translation.account_name_field_lengt')");
                return $('#account_name').focus();
            }
            else if(!iban || !$.trim(iban).length)
            {
                $('#company_id_error').html("");
                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("@lang('translation.iban_field_required')");
                return $('#iban').focus();
            }
            else if(!account_no || !$.trim(account_no).length)
            {
                $('#company_id_error').html("");
                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("@lang('translation.account_no_field_required')");
                return $('#account_no').focus();
            }
            else
            {
                $('#company_id_error').html("");
                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("");
                //TODO: Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"{{ route('admin.companies.companies-banks.create') }}",
                    method:"POST",
                    data:{company_id, bank_name, bic, account_name, iban, account_no, currency, status,_token},
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
                        if(res == "true")
                        {
                            ToastSuccess("@lang('translation.bank_created_successfully')");
                            $('#company_id').val("");
                            $('#bank_name').val("");
                            $('#bic').val("");
                            $('#account_name').val("");
                            $('#iban').val("");
                            $('#account_no').val("");
                            DataTable.ajax.reload();
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
            const currency = $('#edit_currency').val();

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
