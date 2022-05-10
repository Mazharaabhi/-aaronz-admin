<script>
    //TODO: Copy Redirect Url
    function copyToClipboard(element) {
    var $temp = $("<input>");
    element = "#"+element;
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    alert('Link Copied!');
    }
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#pay_links', '#charge_payment', '#service_anchor');
        // TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#links-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.paylinks.transactions.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'tran_ref' },
            { data: 'users.name' },
            { data: 'tran_type' },
            { data: 'payment_method' },
            { data: 'currency' },
            { data: 'cart_amount' },
            // { data: 'account_type' },
            { data: 'payment_date' },
            { data: 'tran_time' },
            { data: 'status' },
            ]
        });

        var id = '';
        var token = '';
        var tran_ref = '';
        //TODO: Getting id and other data for charge payment form
        $('body').delegate('#charge', 'click', function()
        {
            id = $(this).find('input[name="id"]').val();
            token = $(this).find('input[name="token"]').val();
            tran_ref = $(this).find('input[name="tran_ref"]').val();
            var name = $(this).find('input[name="name"]').val();
            var phone = $(this).find('input[name="phone"]').val();
            $('#name').val(name);
            $('#phone').val(phone);
            $('#amount').val('');
            $('#description').val('');
            $('#charg_form').modal('show');
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
            else if(!description || !$.trim(description).length)
            {
                $('#amount_error').html("");
                $('#description_error').html("@lang('translation.description_required')");
                return $('#description').focus();
            }
            else if(description.length < 3)
            {
                $('#amount_error').html("");
                $('#description_error').html("@lang('translation.description_length')");
                return $('#description').focus();
            }
            else
            {
                $('#amount_error').html("");
                $('#description_error').html("");

                //TODO: Initializing Form Data Object
                const formData = new FormData;
                formData.append('id', id);
                formData.append('amount', amount);
                formData.append('description', description);
                formData.append('token', token);
                formData.append('tran_ref', tran_ref);
                formData.append('_token', _token);

                //TODO: Seding Ajax Requrest for creating navbar menu
                $.ajax({
                    url:"{{ route('admin.paylinks.generate-payment-link.charge-payment') }}",
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
                        else{
                            ToastSuccess("@lang('translation.payment_link_created_successfully')");
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
});
</script>
