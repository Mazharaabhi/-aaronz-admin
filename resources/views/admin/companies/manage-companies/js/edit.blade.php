<script>
$(document).ready(function(){
   @include('messages.jquery-messages')
   MakeMenuActive('#companies', '#manage_companies', '#service_anchor');

    $('#b_status').click(function()
    {
        if($(this).val() == 2)
        {
            $('#reason_div').attr('class', 'col-md-6 col-lg-6 mb-4');
        }
        else
        {
            $('#reason_div').attr('class', 'd-none');
        }
    });

    $('#account_type').change(function(){
        if($(this).val() == 5){
            $('#services_div').attr('class', 'col-md-6 col-lg-6 mb-4');
        }else{
            $('#services_div').attr('class', 'col-md-6 col-lg-6 mb-4 d-none');
        }
    });

    //TODO: Getting States As Per Countries
    $('#country').change(function(){
            const country = $(this).val();
            getStates(country);
    });

    getStates("{{ $company->country }}");
    function getStates(country){
        if(!country)
        {
            $('#state').html('<option value="">-- State  --</option>');
        }
        else
        {
            //TODO: Getting States of the Country
            $.ajax({
                url:"{{ route('get.states') }}",
                method:"POST",
                data:{country, _token},
                success:function(res)
                {
                    var data = JSON.parse(res);
                    var html = `<option value="">-- State  --</option>`;
                    if(data.state_count > 0)
                    {
                        for(var i=0; i < data.state_count; i++)
                        {
                            html += `<option value="${data.states[i]['id']}">${data.states[i]['name']}</option>`;
                        }
                    }
                    $('#state').html(html);
                    $('#state').val("{{$company->state}}");
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        }
    }

   //TODO: Create Bank Dynamic Crud
   $('#add').click(function(){
            const bank_name = $('#bank_name').val();
            const bic = $('#bic').val();
            const account_name = $('#account_name').val();
            const iban = $('#iban').val();
            const account_no = $('#account_no').val();
            const currency = $('select[name="b_currency"]').val();
            const status = $('#b_status').val();
            //TODO: Applying Validations Here
            if(!bank_name || !$.trim(bank_name).length)
            {

                $('#bank_name_error').html("@lang('translation.bank_field_required')");
                return $('#bank_name').focus();
            }
            else if(bank_name.length < 5)
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
            else if(iban < 16)
            {
                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("@lang('translation.iban_lentgh')");
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
            else if(account_no.length < 10)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("@lang('translation.account_no_lentgh')");
                return $('#account_no').focus();
            }
            else
            {

                //TODO: Checking IBAN with Dynamic Created Array
                if($("input[name='d_iban[]']") !== undefined){
                   var d_iban = $("input[name='d_iban[]']").map(function(){
                        return $(this).val();
                    }).get();
                    if(d_iban.length > 0)
                    {
                        for(var j=0; j < d_iban.length; j++)
                        {
                            if(iban === d_iban[j])
                            {
                                $('#iban_error').html("This IBAN is already added to table");
                                return $('#iban').focus();
                            }
                        }
                    }
                }

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("");
                const company_id = "{{ $company->id }}";
                //TODO: Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"{{ route('admin.companies.manage-companies.create-bank') }}",
                    method:"POST",
                    data:{company_id ,bank_name, bic, account_name, iban, account_no, currency, status,_token},
                    beforeSend:function()
                    {
                        $('#add').attr('disabled',true);
                        $('#add').html('Please wait');
                    },
                    complete:function()
                    {
                        $('#add').removeAttr('disabled');
                        $('#add').html('<span class="fa fa-plus"></span> Add Bank');
                    },
                    success:function(res)
                    {

                        if(res == "Cyber")
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
                        else
                        {
                            $('#company_id').val("");
                            $('#bank_name').val("");
                            $('#bic').val("");
                            $('#account_name').val("");
                            $('#iban').val("");
                            $('#account_no').val("");
                            $('#b_status').val('0');
                            var tbody = `
                            <tr id="row_${res}">
                                <td>${res} <input type="hidden" name="d_id[]" value="${res}"></td>
                                <td>${bank_name} <input type="hidden" name="d_bank_name[]" value="${bank_name}"></td>
                                <td>${bic} <input type="hidden" name="d_bic[]" value="${bic}"></td>
                                <td>${account_name} <input type="hidden" name="d_account_name[]" value="${account_name}"></td>
                                <td>${account_no} <input type="hidden" name="d_account_no[]" value="${account_no}"></td>
                                <td>${iban} <input type="hidden" name="d_iban[]" value="${iban}"></td>
                                <td>${currency} <input type="hidden" name="d_currency[]" value="${currency}"></td>
                                <td>
                                    `;
                                    if(status == 0)
                                    {
                                        tbody += `<label class="label label-lg label-light-warning label-inline">Under Review</label>`;
                                    }
                                    else if(status == 1)
                                    {
                                        tbody += `<label class="label label-lg label-light-success label-inline">Approved</label>`;
                                    }
                                    else
                                    {
                                        tbody += `<label class="label label-lg label-light-danger label-inline">Rejected</label>`;
                                    }
                                tbody += ` <input type="hidden" name="d_status[]" value="${status}"></td>
                                <td>
                                    <input type="hidden" name="e_id" value="${res}"/>
                                    <input type="hidden" name="e_bank_name" value="${bank_name}"/>
                                    <input type="hidden" name="e_bic" value="${bic}"/>
                                    <input type="hidden" name="e_account_no" value="${account_no}"/>
                                    <input type="hidden" name="e_account_name" value="${account_name}"/>
                                    <input type="hidden" name="e_iban" value="${iban}"/>
                                    <input type="hidden" name="e_currency" value="${currency}"/>
                                    <input type="hidden" name="e_status" value="${status}"/>
                                    <a id="edit" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        </g>
                                        </svg>
                                    </span>
                                    </a>
                                    <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                <span class="svg-icon svg-icon-md svg-icon-danger">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                    </g>
                </svg>
                </span>
                </a>
                                </td>
                            </tr>
                            `;
                            $('#tbody').append(tbody);
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }
    });

    //TODO: Deleting the company
    $('body').delegate('#delete', 'click', function()
        {
            var obj = $(this);
            var id = $(this).parent().find('input[name="e_id"]').val();
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
                                    url:"{{ route('admin.companies.manage-companies.delete-bank') }}",
                                    method:"POST",
                                    data:{id, _token},
                                    success:function(res)
                                    {
                                        obj.parent().parent().remove();
                                        $.alert('@lang("translation.company_deleted_successfully")');
                                    }
                                });
                            }
                        }
                    }
                });


        });

        //TODO: Getting Values For Edit Bank
        var row_id = '';
        $('body').delegate('#edit', 'click', function()
        {
            row_id = $(this).parent().find('input[name="e_id"]').val();
            const bank_name = $(this).parent().find('input[name="e_bank_name"]').val();
            const bic = $(this).parent().find('input[name="e_bic"]').val();
            const account_name = $(this).parent().find('input[name="e_account_name"]').val();
            const iban = $(this).parent().find('input[name="e_iban"]').val();
            const account_no = $(this).parent().find('input[name="e_account_no"]').val();
            const curreny = $(this).parent().find('input[name="e_currency"]').val();
            const status = $(this).parent().find('input[name="e_status"]').val();
            const reason = $(this).parent().find('input[name="e_reason"]').val();

            if(status == 2)
            {
                $('#reason_div').attr('class', 'col-md-6 col-lg-6 mb-4');
            }
            else
            {
                $('#reason_div').attr('class', 'd-none');
            }

            $('#b_reason').val(reason);
            $('#rejected_id').attr('class', '');

            $('#add').attr('class', 'd-none');
            $('#edit_btn').attr('class', 'btn btn-warning btn-sm mt-7');

            $('#bank_name').val(bank_name);
            $('#bic').val(bic);
            $('#account_name').val(account_name);
            $('#iban').val(iban);
            $('#account_no').val(account_no);
            $('#b_currency').val(curreny);
            $('#b_status').val(status);
        });

        //TODO: Create Bank Dynamic Crud
        $('#edit_btn').click(function(){
            const bank_name = $('#bank_name').val();
            const bic = $('#bic').val();
            const account_name = $('#account_name').val();
            const iban = $('#iban').val();
            const account_no = $('#account_no').val();
            const currency = $('select[name="b_currency"]').val();
            const status = $('#b_status').val();
            const reason = $('#b_reason').val();
            //TODO: Applying Validations Here
            if(!bank_name || !$.trim(bank_name).length)
            {

                $('#bank_name_error').html("@lang('translation.bank_field_required')");
                return $('#bank_name').focus();
            }
            else if(bank_name.length < 5)
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
            else if(iban < 16)
            {
                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("@lang('translation.iban_lentgh')");
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
            else if(account_no.length < 10)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("@lang('translation.account_no_lentgh')");
                return $('#account_no').focus();
            }
            else if(status == 2 && !$.trim(reason).length)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("");
                $('#b_reason_error').html("The reason field is required");
                return $('#b_reason_no').focus();
            }
            else
            {

                //TODO: Checking IBAN with Dynamic Created Array
                if($("input[name='d_iban[]']") !== undefined){
                   var d_iban = $("input[name='d_iban[]']").map(function(){
                        return $(this).val();
                    }).get();
                    var d_id = $("input[name='d_id[]']").map(function(){
                        return $(this).val();
                    }).get();
                    if(d_iban.length > 0)
                    {
                        for(var j=0; j < d_iban.length; j++)
                        {
                            if(iban === d_iban[j] && row_id != d_id[j])
                            {
                                $('#iban_error').html("This IBAN is already added to table");
                                return $('#iban').focus();
                            }
                        }
                    }
                }

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("");
                $('#b_reason_error').html("");
                const company_id = "{{ $company->id }}";
                //TODO: Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"{{ route('admin.companies.manage-companies.update-bank') }}",
                    method:"POST",
                    data:{id:row_id, company_id, bank_name, bic, account_name, iban, account_no, currency, status, reason,_token},
                    beforeSend:function()
                    {
                        $('#edit_btn').attr('disabled',true);
                        $('#edit_btn').html('Please wait');
                    },
                    complete:function()
                    {
                        $('#edit_btn').removeAttr('disabled');
                        $('#edit_btn').html('<span class="fa fa-plus"></span> Edit Bank');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            $('#edit_btn').attr('class', 'd-none');
                            $('#add').attr('class', 'btn btn-warning btn-sm mt-7');
                            $('#company_id').val("");
                            $('#bank_name').val("");
                            $('#bic').val("");
                            $('#account_name').val("");
                            $('#iban').val("");
                            $('#account_no').val("");
                            $('#b_reason').val('');
                            $('#rejected_id').attr('class', 'd-none');
                            $('#reason_div').attr('class', 'd-none');
                            $('#b_status').val('0');
                            var tbody = `
                                <td>${row_id} <input type="hidden" name="d_id[]" value="${row_id}"></td>
                                <td>${bank_name} <input type="hidden" name="d_bank_name[]" value="${bank_name}"></td>
                                <td>${bic} <input type="hidden" name="d_bic[]" value="${bic}"></td>
                                <td>${account_name} <input type="hidden" name="d_account_name[]" value="${account_name}"></td>
                                <td>${account_no} <input type="hidden" name="d_account_no[]" value="${account_no}"></td>
                                <td>${iban} <input type="hidden" name="d_iban[]" value="${iban}"></td>
                                <td>${currency} <input type="hidden" name="d_currency[]" value="${currency}"></td>
                                <td>
                                    `;
                                    if(status == 0)
                                    {
                                        tbody += `<label class="label label-lg label-light-warning label-inline">Under Review</label>`;
                                    }
                                    else if(status == 1)
                                    {
                                        tbody += `<label class="label label-lg label-light-success label-inline">Accepted</label>`;
                                    }
                                    else
                                    {
                                        tbody += `<label class="label label-lg label-light-danger label-inline">Rejected</label>`;
                                    }
                                tbody += ` <input type="hidden" name="d_status[]" value="${status}"></td>
                                <td>
                                    <input type="hidden" name="e_id" value="${row_id}"/>
                                    <input type="hidden" name="e_bank_name" value="${bank_name}"/>
                                    <input type="hidden" name="e_bic" value="${bic}"/>
                                    <input type="hidden" name="e_account_no" value="${account_no}"/>
                                    <input type="hidden" name="e_account_name" value="${account_name}"/>
                                    <input type="hidden" name="e_iban" value="${iban}"/>
                                    <input type="hidden" name="e_currency" value="${currency}"/>
                                    <input type="hidden" name="e_status" value="${status}"/>
                                    <input type="hidden" name="e_reason" value="${reason}"/>
                                    <a id="edit" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        </g>
                                        </svg>
                                    </span>
                                    </a>
                                    <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                <span class="svg-icon svg-icon-md svg-icon-danger">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                    </g>
                </svg>
                </span>
                </a>
                                </td>
                            `;
                            $(`#row_${row_id}`).html(tbody);
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

    //TODO: Creating new navbar menu


   $('#save').click(function(){
       const name = $('#name').val();
       const designation = $('#designation').val();
       const company_name = $('#company_name').val();
       const new_email = $('#new_email').val();
       const phone = $('#phone').val();
       const account_type = $('#account_type').val();
       const mobile = $('#mobile').val();
       const country = $('#country').val();
       const state = $('#state').val();
       const address = $('#address').val();
       const po_box = $('#po_box').val();
       const description = $('#description').val();
       const rera_no = $('#rera_no').val();
       const rera_exp_date = $('#rera_exp_date').val();
       const dtcm_no = $('#dtcm_no').val();
       const dtcm_exp_date = $('#dtcm_exp_date').val();
       const license_authority = $('#license_authority').val();
       const image = $('input[name="avatar"]').val();
       var services = [];
        $.each($("input[name='services']:checked"), function(){
            services.push($(this).val());
        });
       //TODO: Regular Expression For Email
       var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       const checkEmail = emailReg.test( new_email );


       //TODO: Applying Validations Here
       if(!name || !$.trim(name).length)
       {
           $('#name_error').html("@lang('translation.name_is_required')");
           return $('#name').focus();
       }
       else if(name.length <= 2)
       {
           $('#name_error').html("@lang('translation.name_length_error')");
           return $('#name').focus();
       }
       else if(!designation || !$.trim(designation).length)
       {
           $('#name_error').html("");
           $('#designation_error').html("@lang('translation.designation_required')");
           return $('#designation').focus();
       }
       else if(designation.length <= 2)
       {
           $('#name_error').html("");
           $('#designation_error').html("@lang('translation.designation_required')");
           return $('#designation').focus();
       }
       else if(!company_name || !$.trim(company_name).length)
       {
            $('#name_error').html("");
            $('#designation_error').html("");
           $('#company_name_error').html("@lang('translation.company_name_is_required')");
           return $('#company_name').focus();
       }
       else if(company_name.length <= 2)
       {
            $('#name_error').html("");
            $('#designation_error').html("");
           $('#company_name_error').html("@lang('translation.company_name_length_error')");
           return $('#company_name').focus();
       }
       else if(new_email == "")
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("@lang('translation.email_is_required')");
           return $('#new_email').focus();
       }
       else if(checkEmail == false)
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email').html("@lang('translation.email_format_is_not_valid')");
           return $('#new_email').focus();
       }
        else if(!phone)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("");
            $('#phone_error').html("The phone field is required");
            return $('#phone').focus();
        }
        else if(!account_type)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("");
            $('#phone_error').html("");
            return $('#account_type_error').html("Please select account type.");
        }
       else
       {
            const avatar = document.getElementById('fileupload-btn-one').files[0];

            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("");
            $('#phone_error').html("");
            $('#account_type_error').html("");
            $('#image_one_error').html("");

           //TODO: Initializing Form Data Object
           const formData = new FormData;
           formData.append('id', "{{ $company->id }}");
           formData.append('name', name);
           formData.append('designation', designation);
           formData.append('company_name', company_name);
           formData.append('email', new_email);
           formData.append('phone', phone);
           formData.append('role_id', account_type);
           formData.append('avatar', avatar);
           formData.append('mobile', mobile);
           formData.append('country', country);
           formData.append('state', state);
           formData.append('address', address);
           formData.append('services', services);
           formData.append('po_box', po_box);
           formData.append('description', description);
           formData.append('rera_no', rera_no);
           formData.append('rera_exp_date', rera_exp_date);
           formData.append('dtcm_no', dtcm_no);
           formData.append('dtcm_exp_date', dtcm_exp_date);
           formData.append('license_authority', license_authority);
           formData.append('_token', _token);

           //TODO: Seding Ajax Requrest for creating navbar menu
           $.ajax({
               url:"{{ route('admin.companies.manage-companies.update-process') }}",
               method:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:false,
               beforeSend:function()
               {
                   $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                   $('#save').attr('class',`btn btn-danger btn-block  ${spinner}`);
                   $('#save').attr('disabled',true);
               },
               complete:function()
               {
                   $('#save').html(`${save_icon} @lang('translation.edit_company')`);
                   $('#save').attr('class',`btn btn-danger btn-block`);
                   $('#save').removeAttr('disabled');
               },
               success:function(res)
               {
                   console.log(res);
                   if(res == "true"){
                       ToastSuccess("@lang('translation.company_updated_sucessfully')");
                   }
                   else if(res == "Cyber")
                   {
                       ToastError("warning", "@lang('translation.cyber_message')");
                   }
                   else if(res == "email")
                   {
                       $('#new_email_error').html("@lang('translation.email_already_taken')");
                       return $('#new_email').focus();
                   }
                   else if(res == "phone")
                   {
                       $('#phone_error').html("This Phone number is already taken.");
                       return $('#phone').focus();
                   }
                   else if(res == "email_template")
                   {
                    Message('Violation', "Email Template not found for Register Company Please Create One!", 'red');
                   }
               },error:function(xhr)
               {
                   console.log(xhr.responseText);
               }
           });
       }
   });



   //for image preview
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#blah-one').attr('src', e.target.result);
            $('#blah-one').attr('class','d-block')
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }
        $("#fileupload-btn-one").change(function() {
        readURL(this);
    });



    var RowIDToUpdate = '';
    //TODO: Getting row data and putting up into form
    $('body').delegate('#row-to-update','click', function(){
        $('#ImageToUpdate').attr('class','');
        RowIDToUpdate = $(this).parent().parent().find('input[name="id"]').val();
        var name = $(this).parent().parent().find('input[name="name"]').val();
        var type_name = $(this).parent().parent().find('input[name="type_name"]').val();
        var type_id = $(this).parent().parent().find('input[name="type_id"]').val();
        $('#ImageToUpdate').html(name);
        $('#document_type_id').val(type_id).trigger('change');
        $('#widget-one-div').attr('class','');
        $('#add-button-english').html("@lang('translation.update')");
    });

    $('#add-button-english').click(function(){
                $('#add-button-english').html("@lang('translation.add')");
                // $('#row1_'+RowIDToUpdate).removeAttr('style');
                let document_type_id= $('#document_type_id').val()
                let document_type= $('select[id="document_type_id"] :selected').text()
                let image= $('#header_image_1').val().split('\\').pop();
                if(RowIDToUpdate)
                {
                    if(document_type_id != ""){
                        $('#image_1_error').html("")
                        $('#document_type_id_1_error').html("@lang('translation.document_type_id_error')");
                        return $('#document_type_id').focus();
                    }
                    else
                    {
                        $('#image_1_error').html("");
                        $('#document_type_id_1_error').html("");
                        $("#document_type_id").val('').trigger('change')
                        $('#header_image_1').val("");
                        var property = document.getElementById('header_image_1').files[0];
                        formData = new FormData;
                            formData.append('widget_id',RowIDToUpdate);
                            formData.append('document_type_id',document_type_id);
                            formData.append('document_type',document_type);
                            formData.append('image',property);
                            formData.append('file_name',image);
                            formData.append('_token',"{{ csrf_token() }}");
                            $.ajax({
                                url:"",
                                method:"POST",
                                data:formData,
                                contentType:false,
                                processData:false,
                                cache:false,
                                success:function(res)
                                {
                                     console.log(res);
                                    $(`#WidgetRow_${RowIDToUpdate}`).html(res);
                                    $('#ImageToUpdate').attr('class','d-none');
                                },
                                error:function(xhr)
                                {
                                    return console.log(xhr.responseText);
                                }
                            });
                            RowIDToUpdate='';
                      }
                   }
                else
                {
                    if(!image  != "")
                    {
                        $('#image_1_error').html("@lang('translation.image_error')");
                        return $('#header_image_1').focus();
                    }
                    else if(!title_english != "" || !$.trim(title_english).length)
                    {
                        $('#image_1_error').html("")
                        $('#title_1_error').html("@lang('translation.title_error')");
                        return $('#wiget-title').focus();
                   }
                   else
                   {
                    $('#image_1_error').html("");
                    $('#title_1_error').html("");
                    $('#title_arabic_1_error').html("");
                    $('#wiget-title').val("")
                    $('#wiget-title-arabic').val("")
                    $('#header_image_1').val("");
                        formData = new FormData;
                            formData.append('template_id',template_id);
                            formData.append('service_id',service_id);
                            formData.append('level',level);
                            formData.append('image',image);
                            formData.append('title_english',title_english);
                            formData.append('title_arabic',title_arabic);
                            formData.append('_token',"{{ csrf_token() }}");
                            $.ajax({
                                url:"",
                                method:"POST",
                                data:formData,
                                contentType:false,
                                processData:false,
                                cache:false,
                                success:function(res)
                                {
                                    console.log(res);
                                   $('#wiget_data').append(res);
                                },
                                error:function(xhr)
                                {
                                    return console.log(xhr.responseText);
                                }
                            });
                    }
                 }
            });

});
</script>
