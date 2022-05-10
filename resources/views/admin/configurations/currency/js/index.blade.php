<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#c_settings', '#currencies', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.settings.currency.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'symbol' },
            { data: 'from_currency' },
            { data: 'to_currency' },
            { data: 'rate' },
            { data: 'status', orderable: false, searchable: false},
            { data: 'action', orderable: false, searchable: false}
            ]
        });

        //Specifying the currency rate
        $('#from_currency').keyup(function()
        {
            if(!$.trim($(this).val()).length)
            {
                $('#rate_specify').html(``);
            }
            else
            {
                $('#rate_specify').html(`(1 ${$(this).val()} to 1 AED)`);
            }
        });

        //Specifying the currency rate
        $('#u_from_currency').keyup(function()
        {
            if(!$.trim($(this).val()).length)
            {
                $('#u_rate_specify').html(``);
            }
            else
            {
                $('#u_rate_specify').html(`(1 ${$(this).val()} to 1 AED)`);
            }
        });

        //TODO: For opening add menu modal
        $('#OpenAddModel').click(function()
        {
            $('#Add_Menu_Modal').modal('show');
            $('#type').val("");
            $('#from_currency').val("");
            $('#symbol').val("");
            $('#rate').val("");
            $('#type_error').html("");
            $('#from_currency_error').html("");
            $('#symbol_error').html("");
            $('#rate_error').html("");
        });

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const from_currency = $('#from_currency').val();
            var to_currency = $('#to_currency').val();
            const symbol = $('#symbol').val();
            const rate = $('#rate').val();

            //TODO: Applying Validations Here
            if(!$.trim(from_currency).length)
            {
                $('#from_currency_error').html("@lang('translation.from_currency_required')");
                return $('#from_currency').focus();
            }
            else if(!symbol || !$.trim(symbol).length)
            {
                $('#from_currency_error').html("");
                $('#symbol_error').html("@lang('translation.symbol_required')");
                return $('#symbol').focus();
            }
            else if(!rate)
            {
                $('#from_currency_error').html("");
                $('#symbol_error').html("");
                $('#rate_error').html("@lang('translation.rate_required')");
                return $('#rate').focus();
            }
            else
            {
                $('#from_currency_error').html("");
                $('#symbol_error').html("");
                $('#rate_error').html("");
                //TODO: Seding Ajax Requrest for creating paytabs config
                to_currency = 'AED';
                $.ajax({
                    url:"{{ route('admin.settings.currency.create') }}",
                    method:"POST",
                    data:{from_currency, to_currency, symbol,rate ,_token},
                    beforeSend:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#save').attr('class',`${btn_cherwell }  ${spinner}`);
                        $('#save').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.save')`);
                        $('#save').attr('class',`${btn_cherwell }`);
                        $('#save').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("Currency Created Successfully");
                            DataTable.ajax.reload();
                            $('#from_currency').val('');
                            $('#symbol').val('');
                            $('#rate').val('');
                            $('#from_currency').focus();

                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "currency")
                        {
                            $('#from_currency_error').html('This from currency is already exist.')
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
            const db_from_currency = $(this).parent().find('input[name="from_currency"]').val();
            const db_to_currency = $(this).parent().find('input[name="to_currency"]').val();
            const db_symbol = $(this).parent().find('input[name="symbol"]').val();
            const db_rate = $(this).parent().find('input[name="rate"]').val();

            // //TODO: Assigning values to update fields
            $('#u_from_currency').val(db_from_currency);
            $('#u_to_currency').val(db_to_currency);
            $('#u_symbol').val(db_symbol);
            $('#u_rate').val(db_rate);
            $('#u_rate_specify').html(`(1 ${db_from_currency} to 1 AED)`);
            //TODO: Open edit model here
            $('#Update_Menu_Modal').modal('show');

        });

        $('#update').click(function()
        {
            const from_currency = $('#u_from_currency').val();
            var to_currency = $('#u_to_currency').val();
            const symbol = $('#u_symbol').val();
            const rate = $('#u_rate').val();

            //TODO: Applying Validations Here
            if(!$.trim(from_currency).length)
            {
                $('#u_from_currency_error').html("@lang('translation.from_currency_required')");
                return $('#u_from_currency').focus();
            }
            else if(!symbol || !$.trim(symbol).length)
            {
                $('#u_from_currency_error').html("");
                $('#u_symbol_error').html("@lang('translation.symbol_required')");
                return $('#u_symbol').focus();
            }
            else if(!rate)
            {
                $('#u_from_currency_error').html("");
                $('#u_symbol_error').html("");
                $('#u_rate_error').html("@lang('translation.rate_required')");
                return $('#u_rate').focus();
            }
            else
            {
                $('#u_from_currency_error').html("");
                $('#u_symbol_error').html("");
                $('#u_rate_error').html("");
                //TODO: Seding Ajax Requrest for creating paytabs config
                to_currency = 'AED';
                $.ajax({
                    url:"{{ route('admin.settings.currency.update') }}",
                    method:"POST",
                    data:{id, from_currency, to_currency, symbol,rate ,_token},
                    beforeSend:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#save').attr('class',`${btn_cherwell }  ${spinner}`);
                        $('#save').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.save')`);
                        $('#save').attr('class',`${btn_cherwell }`);
                        $('#save').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("Currency Updated Successfully");
                            DataTable.ajax.reload();
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "currency")
                        {
                            $('#u_from_currency_error').html('This from currency is already exist.')
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
            var active = $(this).parent().find('input[name="active"]').val();

            //Change Status Confirmation
                $.ajax({
                    url:"{{ route('admin.settings.currency.status') }}",
                    method:"POST",
                    data:{id, active, _token},
                    success:function(res)
                    {
                        DataTable.ajax.reload();
                        $.alert('Status updated successfully!');
                    },
                    error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
        });

});
</script>
