<script>
    //TODO: Copy Redirect Url
    function copyToClipboard(element) {
    var $temp = $("<input>");
    element = "#"+element;
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    }
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#accounts', '#invoices', '#service_anchor');
        // TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#links-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.invoices.invoice.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'tran_ref' },
            { data: 'users.name' },
            { data: 'tran_type' },
            { data: 'payment_method' },
            { data: 'currency' },
            { data: 'cart_amount' },
            { data: 'payment_date' },
            { data: 'tran_time' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });

        var id = '';
        var token = '';
        var tran_ref = '';
        var charge_form_email = '';
        var transaction_type = '';
        var transaction_cart_amount = '';
        var transaction_currency = '';
        var transaction_cart_id = '';
        //TODO: Getting id and other data for charge payment form
        $('body').delegate('#charge', 'click', function()
        {
            id = $(this).find('input[name="id"]').val();
            token = $(this).find('input[name="token"]').val();
            tran_ref = $(this).find('input[name="tran_ref"]').val();
            var name = $(this).find('input[name="name"]').val();
            charge_form_email = $(this).find('input[name="email"]').val();
            var phone = $(this).find('input[name="phone"]').val();
            transaction_type = $(this).find('input[name="tran_type"]').val();
            transaction_cart_amount = $(this).find('input[name="cart_amount"]').val();
            transaction_currency = $(this).find('input[name="currency"]').val();
            tran_count = $(this).find('input[name="tran_count"]').val();
            $('#c_name').val(name);
            $('#phone').val(phone);
            $('#amount').val('');
            $('#description').val('');
            if(transaction_type == 'auth')
            {
                $('#amount').val(tran_count);
                $('#note').html(`One Time Charge Max Amount ${tran_count}`);
            }
            else
            {
                $('#note').html(``);
            }
            $('#charg_form').modal('show');


        });

        //TODO: Getting id and other data for voided payment form
        $('body').delegate('#void', 'click', function()
        {
            id = $(this).parent().find('input[name="id"]').val();
            token = $(this).parent().find('input[name="token"]').val();
            tran_ref = $(this).parent().find('input[name="tran_ref"]').val();
            var name = $(this).parent().find('input[name="name"]').val();
            charge_form_email = $(this).parent().find('input[name="email"]').val();
            var phone = $(this).parent().find('input[name="phone"]').val();
            transaction_type = $(this).parent().find('input[name="tran_type"]').val();
            transaction_cart_amount = $(this).parent().find('input[name="cart_amount"]').val();
            tran_count = $(this).parent().find('input[name="tran_count"]').val();
            transaction_cart_id = $(this).parent().find('input[name="cart_id"]').val();
            transaction_currency = $(this).parent().find('input[name="currency"]').val();
            $('#v_name').val(name);
            $('#v_phone').val(phone);
            $('#v_amount').val(transaction_cart_amount);
            $('#v_description').val('');
            $('#void_form').modal('show');
        });

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const amount = $('#amount').val();
            const description = $('#description').val();

            //TODO: Applying Validations Here
            if(!amount)
            {
                $('#amount_error').html("@lang('translation.amount_required')");
                return $('#amount').focus();
            }
            else if(amount <= 0)
            {
                $('#amount_error').html("@lang('translation.amount_length')");
                return $('#amount').focus();
            }
            else if(transaction_type === 'auth' && parseFloat(amount) > parseFloat(tran_count))
            {
                    $('#amount_error').html(`Amount must be less than or equal to ${tran_count}`);
                    return $('#amount').focus();

            }
            else if(!description || !$.trim(description).length)
            {
                $('#amount_error').html("");
                $('#description_error').html("@lang('translation.reason_required')");
                return $('#description').focus();
            }
            else if(description.length < 3)
            {
                $('#amount_error').html("");
                $('#description_error').html("@lang('translation.reason_length')");
                return $('#description').focus();
            }
            else
            {
                const new_tran_count = tran_count - amount;
                $('#amount_error').html("");
                $('#description_error').html("");
                //TODO: Initializing Form Data Object
                const formData = new FormData;
                formData.append('id', id);
                formData.append('amount', amount);
                formData.append('type', transaction_type);
                formData.append('tran_count', new_tran_count);
                formData.append('description', description);
                formData.append('currency', transaction_currency);
                formData.append('token', token);
                formData.append('email', charge_form_email);
                formData.append('tran_ref', tran_ref);
                formData.append('_token', _token);

                //TODO: Seding Ajax Requrest for creating navbar menu
                $.ajax({
                    url:"{{ route('admin.invoices.invoice.charge-payment') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
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
                        if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "api_error")
                        {
                            Message('Violation', 'Invalid MyridePay Account Configurations', 'red');
                        }
                        else{
                            ToastSuccess("@lang('translation.charge_created_successfully')");
                            $("#charg_form").modal('hide');
                            DataTable.ajax.reload();
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        //TODO: Creating new navbar menu
        $('#voided').click(function()
        {
            const amount = $('#v_amount').val();
            const description = $('#v_description').val();

            //TODO: Applying Validations Here
            if(!description || !$.trim(description).length)
            {
                $('#v_description_error').html("@lang('translation.reason_required')");
                return $('#v_description').focus();
            }
            else if(description.length < 3)
            {
                $('#v_description_error').html("@lang('translation.reason_length')");
                return $('#v_description').focus();
            }
            else
            {
                $('#v_description_error').html("");
                //TODO: Initializing Form Data Object
                const formData = new FormData;
                formData.append('id', id);
                formData.append('amount', amount);
                formData.append('description', description);
                formData.append('tran_ref', tran_ref);
                formData.append('cart_id', transaction_cart_id);
                formData.append('email', charge_form_email);
                formData.append('currency', transaction_currency);
                formData.append('_token', _token);

                //TODO: Seding Ajax Requrest for creating navbar menu
                $.ajax({
                    url:"{{ route('admin.invoices.invoice.voided-payment') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    beforeSend:function()
                    {
                        $('#voided').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#voided').attr('class',`${btn_primary }  ${spinner}`);
                        $('#voided').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#voided').html(`${save_icon} Void`);
                        $('#voided').attr('class',`${btn_primary }`);
                        $('#voided').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        console.log(res);
                        if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "api_error")
                        {
                            Message('Violation', 'Invalid MyridePay Account Configurations', 'red');
                        }
                        else{
                            ToastSuccess("Payment Voided Successfully!");
                            $("#void_form").modal('hide');
                            DataTable.ajax.reload();
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        //TODO: Getting id and other data for Capture payment form
        $('body').delegate('#capture-payment', 'click', function()
        {
            id = $(this).parent().find('input[name="id"]').val();
            token = $(this).parent().find('input[name="token"]').val();
            tran_ref = $(this).parent().find('input[name="tran_ref"]').val();
            var name = $(this).parent().find('input[name="name"]').val();
            charge_form_email = $(this).parent().find('input[name="email"]').val();
            var phone = $(this).parent().find('input[name="phone"]').val();
            transaction_type = $(this).parent().find('input[name="tran_type"]').val();
            transaction_cart_amount = $(this).parent().find('input[name="cart_amount"]').val();
            transaction_currency = $(this).parent().find('input[name="currency"]').val();
            tran_count = $(this).parent().find('input[name="tran_count"]').val();
            transaction_cart_id = $(this).parent().find('input[name="cart_id"]').val();
            $('#capture_name').val(name);
            $('#capture_phone').val(phone);
            $('#capture_amount').val(transaction_cart_amount);
            $('#capture_form').modal('show');
        });
//TODO: Creating new navbar menu
        $('#capture').click(function()
        {
            const amount = $('#capture_amount').val();

                //TODO: Initializing Form Data Object
                const formData = new FormData;
                formData.append('id', id);
                formData.append('amount', amount);
                formData.append('tran_ref', tran_ref);
                formData.append('cart_id', transaction_cart_id);
                formData.append('email', charge_form_email);
                formData.append('currency', transaction_currency);
                formData.append('_token', _token);
                //TODO: Seding Ajax Requrest for creating navbar menu
                $.ajax({
                    url:"{{ route('admin.invoices.invoice.capture-payment') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    beforeSend:function()
                    {
                        $('#capture').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#capture').attr('class',`${btn_primary }  ${spinner}`);
                        $('#capture').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#capture').html(`${save_icon} Capture`);
                        $('#capture').attr('class',`${btn_primary }`);
                        $('#capture').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        console.log(res);
                        if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "api_error")
                        {
                            Message('Violation', 'Invalid MyridePay Account Configurations', 'red');
                        }
                        else{
                            ToastSuccess("Payment Captured Successfully!");
                            $("#capture_form").modal('hide');
                            DataTable.ajax.reload();
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });

        });

        //TODO: Send Link in Message
        $('body').delegate('#send_email', 'click', function(){
            const id = $(this).parent().find('input[name="id"]').val();
            const email = $(this).parent().find('input[name="email"]').val();
            const name = $(this).parent().find('input[name="name"]').val();
            const link = $(this).parent().find('input[name="link"]').val();

            $.ajax({
                url:"{{ route('admin.invoices.invoice.send-email') }}",
                method:"POST",
                data:{id, email, name, link, _token},
                beforeSend:function()
                {
                    Message('Processing', "Sending email please wait...", 'red');
                },
                success:function(res)
                {
                    if(res == "true")
                    {
                        Message('Success', "Email Send Successfully!", 'green');
                    }
                    else if(res == "email_template")
                    {
                        Message('Violation', "Email Template not found for Generate Payment Link Please Create One!", 'red');
                    }
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        });

        //TODO: Send Link in Message
        $('body').delegate('#message', 'click', function(){
            const id = $(this).parent().find('input[name="id"]').val();
            const email = $(this).parent().find('input[name="email"]').val();
            const name = $(this).parent().find('input[name="name"]').val();
            const phone = $(this).parent().find('input[name="phone"]').val();
            const link = $(this).parent().find('input[name="link"]').val();

            $.ajax({
                url:"{{ route('admin.invoices.invoice.send-message') }}",
                method:"POST",
                data:{id, email, name, link, phone, _token},
                success:function(res)
                {
                    console.log(res);
                    if(res == "true")
                    {
                        Message('Success', "Message Send Successfully!", 'green');
                    }
                    else
                    {
                        Message('Violation', "Error in Message Sending", 'red');
                    }
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        });


        //TODO: Deleting the company
        $('body').delegate('#delete', 'click', function()
        {
            var id = $(this).parent().find('input[name="id"]').val();
            //Delete Confirmation
            $.confirm({
                    title: '@lang("translation.confirm")',
                    content: '@lang("translation.are_you_sure_you_want_to_delete_this_link")',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('admin.invoices.invoice.delete') }}",
                                    method:"POST",
                                    data:{id, _token},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('@lang("translation.link_deleted_successfully")');
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

        //TODO: SHOWING INOICE DETAILS HERE
        $('body').delegate('#invoice_descriptions', 'click', function()
        {
            $('#refund_p').attr('class', 'd-none');
            const id = $(this).parent().find('input[name="id"]').val();
            const tran_type = $(this).parent().find('input[name="tran_type"]').val();
            const phone = $(this).parent().find('input[name="phone"]').val();
            const tran_ref = $(this).parent().find('input[name="tran_ref"]').val();
            const resp_msg = $(this).parent().find('input[name="resp_msg"]').val();
            const status = $(this).parent().find('input[name="status"]').val();
            const tran_id = $(this).parent().find('input[name="tran_id"]').val();
            const cart_id = $(this).parent().find('input[name="cart_id"]').val();
            const cart_amount = $(this).parent().find('input[name="cart_amount"]').val();
            const currency = $(this).parent().find('input[name="currency"]').val();
            const description = $(this).parent().find('input[name="description"]').val();
            const type = $(this).parent().find('input[name="type"]').val();
            const customer_ref = $(this).parent().find('input[name="customer_ref"]').val();
            const invoice_ref = $(this).parent().find('input[name="invoice_ref"]').val();
            const invoice_id = $(this).parent().find('input[name="invoice_id"]').val();
            const resp_code = $(this).parent().find('input[name="resp_code"]').val();
            const name = $(this).parent().find('input[name="name"]').val();
            const email = $(this).parent().find('input[name="email"]').val();
            const address = $(this).parent().find('input[name="address"]').val();
            const country = $(this).parent().find('input[name="country"]').val();
            const state = $(this).parent().find('input[name="state"]').val();
            const created_at = $(this).parent().find('input[name="created_at"]').val();
            const transactions_count = $(this).parent().find('input[name="transactions_count"]').val();
            const refund_resp = $(this).parent().find('input[name="refund_resp"]').val();
            transaction_currency = $(this).parent().find('input[name="currency"]').val();

            $('#hidden_cart_id').val(cart_id);
            $('#hidden_cart_amount').val(cart_amount);
            $('#hidden_tran_ref').val(tran_ref);
            $('#hidden_id').val(id);
            $('#hidden_email').val(email);
            $('#hidden_name').val(name);
            $('#hidden_phone').val(phone);
            $('#hidden_currency').val(transaction_currency);

            $('#name').html(name);
            $('#c_email').html(email);
            $('#address').html(address);
            $('#c_country').html(country);
            $('#c_state').html(state);
            $('#transaction_date').html(created_at);
            $('#transaction_type').html(tran_type);
            $('#transaction_referance').html(tran_ref);
            $('#transaction_id').html(tran_id);
            $('#status_label').html(resp_msg);
            $('#cart_amount_currency').html(`${currency} ${cart_amount}`);
            $('#transaction_status').html(status);
            $('#transaction_resp_msg').html(`${resp_code} - ${resp_msg}`);
            $('#transaction_cart_id').html(cart_id);
            $('#transaction_description').html(description);

                if(status == 'A')
                {
                    $('#status_label').attr('class', 'label label-lg label-light-success label-inline');
                }
                else if(status == 'H')
                {
                    $('#status_label').attr('class', 'label label-lg label-light-warning label-inline');
                }
                else if(status == 'V')
                {
                    $('#status_label').attr('class', 'label label-lg label-light-primary label-inline');
                }
                else if(status == 'E')
                {
                    $('#status_label').attr('class', 'label label-lg label-light-danger label-inline');
                }
                else if(status == 'D')
                {
                    $('#status_label').attr('class', 'label label-lg label-light-danger label-inline');
                }
                else if(status == '')
                {
                    $('#status_label').attr('class', 'label label-lg label-light-danger label-inline');
                }

                if(tran_type == 'auth' || tran_type == 'Void' || tran_type == 'Refund' || tran_type == 'sale' && status != 'A' || status == 'H')
                {
                    $('#refund_p').attr('class', 'd-none');
                }
                else if(refund_resp != 'A')
                {
                    $('#refund_p').attr('class', '');
                }

                //TODO: Getting Invoice and Invoice Item Details
                if(type == 3 || type == 5)
                {
                    $('#customer_ref_li').attr('class', 'list-group-item');
                    $('#invoice_ref_li').attr('class', 'list-group-item ');
                    $('#invoice_li').attr('class', 'row');
                    $('#transaction_customer_ref').html(customer_ref);
                    $('#transaction_invoice_ref').html(invoice_ref);
                    $('#table_row').attr('class', 'row');
                    $('#list_to_hide').attr('class', 'row');
                    $('#legend').attr('class', 'mr-1 ml-1');
                    $.ajax({
                        url:"{{ route('admin.invoices.invoice.inoivce-details') }}",
                        method:"GET",
                        data:{invoice_id},
                        success:function(res)
                        {
                            var data = JSON.parse(res);
                            $('#customer_inovice_li').attr('class', 'list-group-item');
                            $('#sub_total').html(data.sub_total);
                            $('#extra_charges').html(data.extra_charges);
                            $('#discount').html(data.extra_discount);
                            $('#shipping_charges').html(data.shipping_charges);
                            $('#grand_total').html(data.total);
                            $('#transaction_invoice_no').html(data.invoice_id);
                            var invoice_items = data.invoice_items;
                            var html = ``;
                            for(var i = 0; i < invoice_items.length; i++)
                            {
                                html += `
                                <tr>
                                    <td>${invoice_items[i].sku}</td>
                                    <td>${invoice_items[i].description}</td>
                                    <td>${invoice_items[i].unit_cost}</td>
                                    <td>${invoice_items[i].quantity}</td>
                                    <td>${invoice_items[i].discount_rate}</td>
                                    <td>${invoice_items[i].tax_rate}</td>
                                    <td>${invoice_items[i].total}</td>
                                </tr>
                                `;
                            }

                            $('#tbody').html(html);
                        },
                        error:function(xhr)
                        {
                            console.log(xhr.responseText);
                        }
                    });
                }
                else
                {
                    $('#customer_ref_li').attr('class', 'd-none');
                    $('#invoice_ref_li').attr('class', 'd-none');
                    $('#transaction_customer_ref').html('');
                    $('#transaction_invoice_ref').html('');
                    $('#customer_inovice_li').attr('class', 'd-none');
                    $('#tbody').html('');
                    $('#table_row').attr('class', 'd-none');
                    $('#list_to_hide').attr('class', 'd-none');
                    $('#invoice_li').attr('class', 'd-none');
                    $('#legend').attr('class', 'd-none');

                }

            $('#invoice_details').modal('show');
        });
        //TODO: For Shwoing Refund Modal Here
        $('body').delegate('#refund_btn', 'click', function()
        {
            $('#r_name').val($(this).find('#hidden_name').val());
            $('#r_phone').val($(this).find('#hidden_phone').val());
            $('#r_amount').val($(this).find('#hidden_cart_amount').val());
            $('#refund_form').modal('show');
        });

        $('#refund').click(function()
        {
            var cart_id = $('#hidden_cart_id').val();
            var amount = $('#hidden_cart_amount').val();
            var tran_ref = $('#hidden_tran_ref').val();
            const id = $('#hidden_id').val();
            var email = $('#hidden_email').val();
            var currency = $('#hidden_currency').val();
            var description = $('#r_description').val();
            if(!description || !$.trim(description).length)
            {
                $('#r_description_error').html('The reason filed is required');
                return $('#description').focus();
            }
            else if(description.length < 5)
            {
                $('#r_description_error').html('The reason must be atleast 5 characters.');
                return $('#description').focus();
            }
            else
            {
                $('#r_description_error').html("");
                $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Confirm Refund This Transaction Amount?',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('admin.invoices.invoice.refund-payment') }}",
                                    method:"POST",
                                    data:{id, amount, cart_id,tran_ref, description, currency, email, _token},
                                    beforeSend:function()
                                    {
                                        $('#refund').html(`${save_icon} @lang('translation.please_wait')`);
                                        $('#refund').attr('class',`${btn_primary }  ${spinner}`);
                                        $('#refund').attr('disabled',true);
                                    },
                                    complete:function()
                                    {
                                        $('#refund').html(`${save_icon} Refund`);
                                        $('#refund').attr('class',`${btn_primary }`);
                                        $('#refund').removeAttr('disabled');
                                    },
                                    success:function(res)
                                    {
                                        if(res == "Cyber")
                                        {
                                            ToastError("warning", "@lang('translation.cyber_message')");
                                        }
                                        else if(res == "api_error")
                                        {
                                            Message('Violation', 'Invalid MyridePay Account Configurations', 'red');
                                        }
                                        else{
                                            $("#refund_form").modal('hide');
                                            $('#invoice_details').modal('hide');
                                            $.alert('Payment Refunded Successfully!');
                                            DataTable.ajax.reload();
                                        }
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
            }

        });
});
</script>
