<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#configurations','#profile_settings');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.bank-details.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'bank_name' },
            // { data: 'bic' },
            // { data: 'account_no' },
            { data: 'iban' },
            // { data: 'currency' },
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
            const bic = $('#bic').val();
            const account_name = $('#account_name').val();
            const iban = $('#iban').val();
            const account_no = $('#account_no').val();
            const currency = $('#b_currency').val();
            //TODO: Applying Validations Here
            if(bank_name.length < 5)
            {

                $('#bank_name_error').html("@lang('translation.bank_field_lengt')");
                return $('#bank_name').focus();
            }
            else if(!bic || !$.trim(bic).length)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("@lang('translation.bic_required')");
                return $('#bic').focus();
            }
            else if(!account_name || !$.trim('account_name').length)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("@lang('translation.account_name_field_required')");
                return $('#account_name').focus();
            }
            else if(account_name.length < 5)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("@lang('translation.account_name_field_lengt')");
                return $('#account_name').focus();
            }
            else if(!iban || !$.trim(iban).length)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("@lang('translation.iban_field_required')");
                return $('#iban').focus();
            }
            else if(!account_no || !$.trim(account_no).length)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("@lang('translation.account_no_field_required')");
                return $('#account_no').focus();
            }
            else
            {
                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("");
                //TODO: Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"{{ route('admin.bank-details.create') }}",
                    method:"POST",
                    data:{bank_name, bic, account_name, iban, account_no, currency,_token},
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
            const db_bank_name = $(this).parent().find('input[name="bank_name"]').val();
            const db_company_id = $(this).parent().find('input[name="company_id"]').val();
            const db_bic = $(this).parent().find('input[name="bic"]').val();
            const db_account_name = $(this).parent().find('input[name="account_name"]').val();
            const db_account_no = $(this).parent().find('input[name="account_no"]').val();
            const db_currency = $(this).parent().find('input[name="currency"]').val();
            const db_iban = $(this).parent().find('input[name="iban"]').val();

            // //TODO: Assigning values to update fields
            $('#edit_bank_name').val(db_bank_name);
            $('#edit_company_id').val(db_company_id);
            $('#edit_bic').val(db_bic);
            $('#edit_account_name').val(db_account_name);
            $('#edit_account_no').val(db_account_no);
            $('#edit_currency').val(db_currency);
            $('#edit_iban').val(db_iban);
            //TODO: Open edit model here
            $('#Edit_Menu_Modal').modal('show');

        });


        //TODO: Creating new navbar menu
        $('#update').click(function()
        {
            const bank_name = $('#edit_bank_name').val();
            const bic = $('#edit_bic').val();
            const account_name = $('#edit_account_name').val();
            const iban = $('#edit_iban').val();
            const account_no = $('#edit_account_no').val();
            const currency = $('#edit_b_currency').val();
            //TODO: Applying Validations Here
            if(bank_name.length < 5)
            {

                $('#edit_bank_name_error').html("@lang('translation.bank_field_lengt')");
                return $('#edit_bank_name').focus();
            }
            else if(!bic || !$.trim(bic).length)
            {

                $('#edit_bank_name_error').html("");
                $('#edit_bic_error').html("@lang('translation.bic_required')");
                return $('#edit_bic').focus();
            }
            else if(!account_name || !$.trim('account_name').length)
            {

                $('#edit_bank_name_error').html("");
                $('#edit_bic_error').html("");
                $('#edit_account_name_error').html("@lang('translation.account_name_field_required')");
                return $('#edit_account_name').focus();
            }
            else if(account_name.length < 5)
            {

                $('#edit_bank_name_error').html("");
                $('#edit_bic_error').html("");
                $('#edit_account_name_error').html("@lang('translation.account_name_field_lengt')");
                return $('#edit_account_name').focus();
            }
            else if(!iban || !$.trim(iban).length)
            {

                $('#edit_bank_name_error').html("");
                $('#edit_bic_error').html("");
                $('#edit_account_name_error').html("");
                $('#edit_iban_error').html("@lang('translation.iban_field_required')");
                return $('#edit_iban').focus();
            }
            else if(!account_no || !$.trim(account_no).length)
            {

                $('#edit_bank_name_error').html("");
                $('#edit_bic_error').html("");
                $('#edit_account_name_error').html("");
                $('#edit_iban_error').html("");
                $('#edit_account_no_error').html("@lang('translation.account_no_field_required')");
                return $('#edit_account_no').focus();
            }
            else
            {
                $('#edit_bank_name_error').html("");
                $('#edit_bic_error').html("");
                $('#edit_account_name_error').html("");
                $('#edit_iban_error').html("");
                $('#edit_account_no_error').html("");
                //TODO: Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"{{ route('admin.bank-details.update') }}",
                    method:"POST",
                    data:{id, bank_name, bic, account_name, iban, account_no, currency,_token},
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
                        if(res == "true")
                        {
                            ToastSuccess("@lang('translation.bank_updated_successfully')");
                            DataTable.ajax.reload();
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "iban")
                        {
                            $('#edit_iban_error').html("@lang('translation.iban_exists')");
                            return $('#edit_iban').focus();
                        }
                        else if(res == "account_no")
                        {
                            $('#edit_account_no_error').html("@lang('translation.account_no_exists')");
                            return $('#edit_account_no').focus();
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
            id = $(this).parent().find('input[name="id"]').val();
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
                                    url:"{{ route('admin.bank-details.status') }}",
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


          //TODO: Deleting the company
    $('body').delegate('#delete', 'click', function()
        {
            var id = $(this).parent().find('input[name="id"]').val();
            $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Confirm delete this account?',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('admin.bank-details.delete') }}",
                                    method:"POST",
                                    data:{id, _token},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('@lang("translation.company_deleted_successfully")');
                                    }
                                });
                            }
                        }
                    }
                });


        });
});
</script>

