<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#companies', '#withdrawal_requests', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.companies.withdrawal-requests.index') }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'company_name' },
            { data: 'amount' },
            { data: 'admin_charges' },
            { data: 'request_on' },
            { data: 'last_approval_date' },
            { data: 'status' },
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


        //TODO: Getting Data and opening the update model to update the data
        var withdrawal_id = '';
        var company_id = '';
        var amount = '';
        var admin_charges = '';

        setTimeout(OpenChangeStatusModel, 1000);
        function OpenChangeStatusModel()
        {
            var object = $("#{{ $id }}");
            object.parent().parent().attr('style', 'background-color:#f88693ab !important');
            //TODO: Open edit model here
            withdrawal_id = object.parent().find('input[name="id"]').val();
            company_id = object.parent().find('input[name="company_id"]').val();
            amount = object.parent().find('input[name="amount"]').val();
            admin_charges = object.parent().find('input[name="admin_charges"]').val();
            var status = object.parent().find('input[name="status"]').val();
            var reason = object.parent().find('input[name="reason"]').val();
            if(status == 1)
            {
                $('#b_status').val(status);
                $('#reason_div').attr('class', 'col-md-12 col-lg-12 mb-4 d-none');
            }
            else if(status == 2)
            {
            //    $('#Add_Menu_Modal').modal('show');
                $('#b_status').val(status);
                $('#reason_div').attr('class', 'col-md-12 col-lg-12 mb-4');
                $('#reason').focus();
            }
            else
            {
            //    $('#Add_Menu_Modal').modal('show');
                $('#b_status').val('');
                $('#reason_div').attr('class', 'col-md-12 col-lg-12 mb-4 d-none');
            }
            $('#reason').val(reason);
            $('status_error').html('');
            $('reason_error').html('');

        }

        //TODO: Funtion For Openein Model and hight lighting the model
        $('body').delegate('#change_status', 'click', function()
        {
            //TODO: Open edit model here
            withdrawal_id = $(this).parent().find('input[name="id"]').val();
            company_id = $(this).parent().find('input[name="company_id"]').val();
            amount = $(this).parent().find('input[name="amount"]').val();
            admin_charges = $(this).parent().find('input[name="admin_charges"]').val();
            var status = $(this).parent().find('input[name="status"]').val();
            var reason = $(this).parent().find('input[name="reason"]').val();
            $('#Add_Menu_Modal').modal('show');
            if(status == 1)
            {
                $('#b_status').val(status);
                $('#reason_div').attr('class', 'col-md-12 col-lg-12 mb-4 d-none');
            }
            else if(status == 2)
            {
                $('#b_status').val(status);
                $('#reason_div').attr('class', 'col-md-12 col-lg-12 mb-4');
                $('#reason').focus();
            }
            else
            {
                $('#b_status').val('');
                $('#reason_div').attr('class', 'col-md-12 col-lg-12 mb-4 d-none');
            }
            $('#reason').val(reason);
            $('status_error').html('');
            $('reason_error').html('');
        });

        $('#b_status').change(function()
        {
            const status = $(this).val();
            if(status == 1)
            {
                $('#reason_div').attr('class', 'col-md-12 col-lg-12 mb-4 d-none');
            }
            else
            {
                $('#reason_div').attr('class', 'col-md-12 col-lg-12 mb-4');
                $('#reason').focus();
            }
        });

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const status = $('#b_status').val();
            const reason = $('#reason').val();

            //TODO: Applying Validations Here
            if(!status)
            {
               return $('#status_error').html("Please select status.");
            }
            else if(status == 2 && reason == "")
            {
                $('#status_error').html("");
                $('#reason_error').html("The reason field is required.");
                return $('#reason').focus();
            }
            else if(status == 2 && !$.trim(reason).length)
            {
                $('#status_error').html("");
                $('#reason_error').html("The reason field is required.");
                return $('#reason').focus();
            }
            else if(status == 2 && reason.length < 10)
            {
                $('#status_error').html("");
                $('#reason_error').html("The reason field length must be atleast 10 characters.");
                return $('#reason').focus();
            }

            else
            {
                $('#status_error').html("");
                $('#reason_error').html("");
                //TODO: Seding Ajax Requrest for creating paytabs config
                $.ajax({
                    url:"{{ route('admin.companies.withdrawal-requests.update-status') }}",
                    method:"POST",
                    data:{withdrawal_id, status, reason, company_id, amount,admin_charges,_token},
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
                            ToastSuccess("@lang('translation.account_updated_successfully')");
                            $('#Add_Menu_Modal').modal('hide');
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



});
</script>
