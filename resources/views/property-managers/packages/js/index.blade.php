<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#companies', '#packages', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.companies.packages.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'name' },
            { data: 'sales_limit' },
            { data: 'tax' },
            { data: 'american_tax' },
            { data: 'charge' },
            { data: 'withdraw_charges' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });


        //TODO: For opening add menu modal
        $('#OpenAddModel').click(function()
        {
            $('#Add_Menu_Modal').modal('show');
            $('#package_name').val("");
            $('#sales_limit').val("");
            $('#tax').val("");
            $('#american_tax').val("");
            $('#extra_charge').val("");
            $('#withdraw_charges').val("");
            $('#package_name_error').html("");
            $('#sales_limit_error').html("");
            $('#tax_error').html("");
            $('#extra_charge_error').html("");
            $('#withdraw_charges_error').html("");
        });

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const name = $('#package_name').val();
            const sales_limit = $('#sales_limit').val();
            const tax = $('#tax').val();
            const charge = $('#extra_charge').val();
            const type = $('#type').val();
            const american_tax = $('#american_tax').val();
            const withdraw_charges = $('#withdrawal_charges').val();
            //TODO: Applying Validations Here
            if(!name)
            {
                $('#package_name_error').html("@lang('translation.package_name_required')");
                return $('#package_name').focus();
            }
            if(!name || !$.trim(name).length)
            {
                $('#package_name_error').html("@lang('translation.package_name_required')");
                return $('#package_name').focus();
            }
            else if(name.length < 5)
            {
                $('#package_name_error').html("@lang('translation.package_name_lengt')");
                return $('#package_name').focus();
            }
            else if(!sales_limit || !$.trim(sales_limit).length)
            {
                $('#package_name_error').html("");
                $('#sales_limit_error').html("@lang('translation.sales_limit_required')");
                return $('#sales_limit').focus();
            }
            else if(sales_limit.length <= 0)
            {
                $('#package_name_error').html("");
                $('#sales_limit_error').html("@lang('translation.sales_limit_required')");
                return $('#sales_limit').focus();
            }
            else
            {
                $('#package_name_error').html("");
                $('#sales_limit_error').html("");
                //TODO: Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"{{ route('admin.companies.packages.create') }}",
                    method:"POST",
                    data:{name, sales_limit, tax, charge, type, american_tax, withdraw_charges,_token},
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
                            ToastSuccess("Package Created Successfully!");
                            $('#package_name').val("");
                            $('#sales_limit').val("");
                            $('#tax').val("");
                            $('#extra_charge').val("");
                            $('#american_tax').val("");
                            DataTable.ajax.reload();
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "package_name")
                        {
                            $('#package_name_error').html("This package name is already exist.");
                            return $('#package_name').focus();
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
            const db_name = $(this).parent().find('input[name="name"]').val();
            const db_sales_limit = $(this).parent().find('input[name="sales_limit"]').val();
            const db_tax = $(this).parent().find('input[name="tax"]').val();
            const db_charge = $(this).parent().find('input[name="charge"]').val();
            const db_type = $(this).parent().find('input[name="type"]').val();
            const db_american_tax = $(this).parent().find('input[name="american_tax"]').val();
            const db_withdraw_charges = $(this).parent().find('input[name="withdraw_charges"]').val();

            // //TODO: Assigning values to update fields
            $('#u_package_name').val(db_name);
            $('#u_sales_limit').val(db_sales_limit);
            $('#u_tax').val(db_tax);
            $('#u_extra_charge').val(db_charge);
            $('#u_type').val(db_type);
            $('#u_american_tax').val(db_american_tax);
            $('#u_withdrawal_charges').val(db_withdraw_charges);
            $('#u_package_name_error').html("");
            $('#u_sales_limit_error').html("");
            $('#u_tax_error').html("");
            $('#u_extra_charge_error').html("");
            $('#u_withdrawal_charges_error').html("");
            $('#Edit_Menu_Modal').modal('show');

        });


        //TODO: Creating new navbar menu
        $('#update').click(function()
        {
            const name = $('#u_package_name').val();
            const sales_limit = $('#u_sales_limit').val();
            const tax = $('#u_tax').val();
            const charge = $('#u_extra_charge').val();
            const type = $('#u_type').val();
            const american_tax = $('#u_american_tax').val();
            const withdraw_charges = $('#u_withdrawal_charges').val();
            //TODO: Applying Validations Here
            if(!name)
            {
                $('#package_name_error').html("@lang('translation.package_name_required')");
                return $('#package_name').focus();
            }
            if(!name || !$.trim(name).length)
            {
                $('#package_name_error').html("@lang('translation.package_name_required')");
                return $('#package_name').focus();
            }
            else if(name.length < 5)
            {
                $('#package_name_error').html("@lang('translation.package_name_lengt')");
                return $('#package_name').focus();
            }
            else if(!sales_limit || !$.trim(sales_limit).length)
            {
                $('#package_name_error').html("");
                $('#sales_limit_error').html("@lang('translation.sales_limit_required')");
                return $('#sales_limit').focus();
            }
            else if(sales_limit.length <= 0)
            {
                $('#package_name_error').html("");
                $('#sales_limit_error').html("@lang('translation.sales_limit_required')");
                return $('#sales_limit').focus();
            }
            else
            {
                $('#package_name_error').html("");
                $('#sales_limit_error').html("");

                //TODO: Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"{{ route('admin.companies.packages.update') }}",
                    method:"POST",
                    data:{id, name, sales_limit, tax, charge, american_tax, withdraw_charges, type, _token},
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
                            ToastSuccess("Package Updated Successfully!");
                            $('#package_name').val("");
                            $('#sales_limit').val("");
                            $('#tax').val("");
                            $('#extra_charge').val("");
                            $('#iban').val("");
                            DataTable.ajax.reload();
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "package_name")
                        {
                            $('#package_name_error').html("This package name is already exist.");
                            return $('#package_name').focus();
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
