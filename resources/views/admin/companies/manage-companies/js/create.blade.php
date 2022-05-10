<script>
$(document).ready(function(){
   @include('messages.jquery-messages')
   MakeMenuActive('#companies', '#manage_companies', '#service_anchor');


    //TODO: Getting States As Per Countries
    $('#country').change(function()
    {
        const country = $(this).val();
        getStates(country);
    });


    $('#account_type').change(function(){
        if($(this).val() == 5){
            $('#services_div').attr('class', 'col-md-6 col-lg-6 mb-4');
        }else{
            $('#services_div').attr('class', 'col-md-6 col-lg-6 mb-4 d-none');
        }
    });

    getStates($('#country').val());
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
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        }
    }

    //TODO: Generating Random Passowrd
    $('#generate_password').click(function(){
        var randomstring = Math.random().toString(36).slice(-8);
        $('#password').val(randomstring);
        $('#confirm_password').val(randomstring);
    });

    //TODO: Removing the spaces from the password and from confirm_password here
    $('#password').keypress(function(event)
        {
            var key = event.keyCode;
            if (key === 32) {
            event.preventDefault();
        }
    });

    $('#confirm_password').keypress(function(event)
        {
            var key = event.keyCode;
            if (key === 32) {
            event.preventDefault();
        }
    });

    var i = 1;

     //TODO: Deleting the company
    $('body').delegate('#delete', 'click', function()
    {
        var obj = $(this);
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
                            obj.parent().parent().remove();
                            $.alert('@lang("translation.company_deleted_successfully")');
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
                //TODO: Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"{{ route('admin.companies.manage-companies.check-unique-bank-numbers') }}",
                    method:"POST",
                    data:{bank_name, bic, account_name, iban, account_no, currency, status,_token},
                    beforeSend:function()
                    {
                        $('#add').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            $('#company_id').val("");
                            $('#bank_name').val("");
                            $('#bic').val("");
                            $('#account_name').val("");
                            $('#iban').val("");
                            $('#account_no').val("");

                            var tbody = `
                            <tr id="row_${i}">
                                <td>${i} <input type="hidden" name="d_id[]" value="${i}"></td>
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
                                        tbody += `<label class="label label-lg label-light-warning label-inline">Pending</label>`;
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
                                    <input type="hidden" name="e_id" value="${i}"/>
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
                            i++;
                            $('#tbody').append(tbody);
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

    //TODO: Create Bank Dynamic Crud
    $('#edit_btn').click(function(){
            const bank_name = $('#bank_name').val();
            const bic = $('#bic').val();
            const account_name = $('#account_name').val();
            const iban = $('#iban').val();
            const account_no = $('#account_no').val();
            const currency = $('#b_currency').val();
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

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("");


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

                //TODO: Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"{{ route('admin.companies.manage-companies.check-unique-bank-numbers') }}",
                    method:"POST",
                    data:{bank_name, bic, account_name, iban, account_no, currency, status,_token},
                    beforeSend:function()
                    {
                        $('#add').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add').removeAttr('disabled');
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
                                        tbody += `<label class="label label-lg label-light-warning label-inline">Pending</label>`;
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



    // TODO: Getting Widget Image URL
    var widget_one_image_src = '';
        $("#header_image_1").change(function() {
            var input = this;
            var filename = $(this).val().split('\\').pop()
            if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // console.log(filename)
                // widget_one_image_src = e.target.result;
                widget_one_image_src = filename;
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        });
        // TODO: Step 3 Widget Section Start
            var RowIDToUpdate = '';
            //TODO: Getting row data and putting up into form
            $('body').delegate('#row-to-update','click', function(){
                RowIDToUpdate = $(this).parent().parent().find('input[name="id"]').val();
                var image = $(this).parent().parent().find('input[name="image"]').val();
                var document_type_id = $(this).parent().parent().find('input[name="document_type_id"]').val();
                console.log(document_type_id)
                $('#document_type_id').val(document_type_id).trigger('change');
                $('#widget-one-div').attr('class','');
                $('#ImageToUpdate').html(image);
                $('#row1_'+RowIDToUpdate).css({backgroundColor:'#dfdcdc'});
                $('#add-button-english').html("@lang('translation.update')");
            });
            var id=1;
            var index = 0;
            var document_files = [];
            var file_names = [];
            var document_type_ids = [];
            $('#add-button-english').click(function(){
                $('#add-button-english').html("Add Document");
                $('#row1_'+RowIDToUpdate).removeAttr('style');
                let document_type_id= $('#document_type_id').val()
                let document_type= $('select[id="document_type_id"] :selected').text()
                let image= $('#header_image_1').val().split('\\').pop();
                if(RowIDToUpdate)
                {
                if(!document_type_id != "" || !$.trim(document_type_id).length){
                    $('#image_1_error').html("")
                    $('#document_type_id_1_error').html("@lang('translation.document_type_id_error')");
                    return $('#document_type_id').focus();
                }else{
                    var property = document.getElementById('header_image_1').files[0];
                    document_files.push(property);
                    document_type_ids.push(document_type_id);
                    file_names.push(image);
                    $('#image_1_error').html("");
                    $('#document_type_id_1_error').html("");
                    $("#document_type_id").val('').trigger('change')
                    $('#header_image_1').val("");
                    let rowData=
                       `<td class="justify-content-center">${RowIDToUpdate}</td>
                        <td class="justify-content-center">${widget_one_image_src}
                            </td>
                        <td class="justify-content-center">
                            ${document_type}
                        </td>
                        <td class="text-center justify-content-center">
                            <input type="hidden" name="index" value="${index}"/>
                            <input type="hidden" name="id" value="${RowIDToUpdate}"/>
                            <input type="hidden" name="image" value="${widget_one_image_src}"/>
                            <input type="hidden" name="document_type_id" value="${document_type_id}"/>
                            <a href="javascript:;" id="row-to-update" class="btn btn-sm btn-icon btn-secondary">
                            <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                            </a>
                            <a href="javascript:;" id="remove-w-1" class="btn btn-sm btn-icon btn-secondary">
                            <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                            </a>
                        </td>`;
                    $('body').find('#row1_'+RowIDToUpdate).html(rowData);
                    RowIDToUpdate = '';
                }
                id++;
                index++;
                }
                else
                {
                    if(!image  != "")
                    {
                        $('#image_1_error').html("Please select a document file");
                        return $('#header_image_1').focus();
                    }
                    else if(!document_type_id != "" || !$.trim(document_type_id).length){
                        $('#image_1_error').html("")
                        $('#document_type_id_1_error').html("Please select document type.");
                        return $('#document_type_id').focus();
                   }
                   else
                   {
                        var property = document.getElementById('header_image_1').files[0];
                        document_files.push(property);
                        document_type_ids.push(document_type_id);
                        file_names.push(image);
                        $('#image_1_error').html("");
                        $('#document_type_id_1_error').html("");
                        $("#document_type_id").val('').trigger('change')
                        $('#header_image_1').val("");
                        let rowData=
                    `<tr id="row1_${id}">
                        <td class="justify-content-center">${id}</td>
                        <td class="justify-content-center">
                            ${widget_one_image_src}
                            </td>
                        <td class="justify-content-center">
                            ${document_type}
                        </td>
                        <td class="text-center justify-content-center">
                            <input type="hidden" name="index" value="${index}"/>
                            <input type="hidden" name="id" value="${id}"/>
                            <input type="hidden" name="image" value="${widget_one_image_src}"/>
                            <input type="hidden" name="document_type_id" value="${document_type_id}"/>
                            <a href="javascript:;" id="row-to-update" class="btn btn-sm btn-icon btn-secondary">
                            <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                            </a>
                            <a href="javascript:;" id="remove-w-1" class="btn btn-sm btn-icon btn-secondary">
                            <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                            </a>
                        </td>
                        </tr>`;
                    $('#wiget_data').append(rowData);
                  }
                 id++;
                 index++;
                }
                $('#widget-one-div').attr('class','d-none');
                $('#ImageToUpdate').html(image);
            });
            //To Remove Widget 1 Row//
            $('body').delegate('#remove-w-1','click',function(){
                var index = $(this).parent().parent().find('input[name="index"]').val();
                var obj = $(this);
                $.confirm({
                    title: 'Confirm',
                    content: 'Delete this document?',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                console.log(document_files);
                                if(document_type_ids.length == 1){
                                    document_files = [];
                                    document_type_ids = [];
                                }
                                document_files.splice(index, 1);
                                document_type_ids.splice(index, 1);
                                console.log(document_files);
                                obj.parent().parent().remove();
                                $.alert('Document Deleted Successfully!');
                            }
                        }
                    }
                });




            });
        // End


   //TODO: Creating new navbar menu
   $('#save').click(function()
   {
       const name = $('#name').val();
       const designation = $('#designation').val();
       const company_name = $('#company_name').val();
       const company_profile = $('input[name="company_profile"]:checked').val();
       const new_email = $('#new_email').val();
       const password = $('#password').val();
       const confirm_password = $('#confirm_password').val();
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
       else if(!password || !$.trim(password).length)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#password_error').html("@lang('translation.password_is_required')");
            return $('#password').focus();
        }
        else if(password.length <= 5)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#password_error').html("@lang('translation.password_length_error')");
            return $('#password').focus();
        }
        else if(!confirm_password)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("@lang('translation.confirm_password_is_required')");
            return $('#confirm_password').focus();
        }
        else if(confirm_password != password)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("@lang('translation.password_are_not_matched')");
            return $('#confirm_password').focus();
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
        else if(!image)
        {
            $('#name_error').html("");
            $('#designation_error').html("");
            $('#company_name_error').html("");
            $('#new_email_error').html("");
            $('#password_error').html("");
            $('#confirm_password_error').html("");
            $('#phone_error').html("");
            $('#account_type_error').html("");
            return $('#image_one_error').html("Please select image.");
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

            //TODO: GETTING BANK NAME ARRAY VALUES
           var bank_name = [];
           if($("input[name='d_bank_name[]']") !== undefined){
                    bank_name = $("input[name='d_bank_name[]']").map(function(){
                        return $(this).val();
                    }).get();
            }

            //TODO: GETTING BIC ARRAY VALUES
           var bic = [];
           if($("input[name='d_bic[]']") !== undefined){
                    bic = $("input[name='d_bic[]']").map(function(){
                        return $(this).val();
                    }).get();
            }

            //TODO: GETTING ACCOUNT NAME ARRAY VALUES
           var account_name = [];
           if($("input[name='d_account_name[]']") !== undefined){
                    account_name = $("input[name='d_account_name[]']").map(function(){
                        return $(this).val();
                    }).get();
            }

            //TODO: GETTING IBAN NUMBER ARRAY VALUES
           var iban = [];
           if($("input[name='d_iban[]']") !== undefined){
                    iban = $("input[name='d_iban[]']").map(function(){
                        return $(this).val();
                    }).get();
            }

            //TODO: GETTING ACCOUNT NUMBER ARRAY VALUES
           var account_no = [];
           if($("input[name='d_account_no[]']") !== undefined){
                    account_no = $("input[name='d_account_no[]']").map(function(){
                        return $(this).val();
                    }).get();
            }

             //TODO: GETTING ACCOUNT NUMBER ARRAY VALUES
           var b_currency = [];
           if($("input[name='d_currency[]']") !== undefined){
            b_currency = $("input[name='d_currency[]']").map(function(){
                        return $(this).val();
                    }).get();
            }

             //TODO: GETTING ACCOUNT NUMBER ARRAY VALUES
           var status = [];
           if($("input[name='d_status[]']") !== undefined){
                    status = $("input[name='d_status[]']").map(function(){
                        return $(this).val();
                    }).get();
            }


           //TODO: Initializing Form Data Object
           const formData = new FormData;
           formData.append('name', name);
           formData.append('company_profile', company_profile);
           formData.append('designation', designation);
           formData.append('company_name', company_name);
           formData.append('email', new_email);
           formData.append('password', password);
           formData.append('real_password', password);
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
           formData.append('bank_name', bank_name);
           formData.append('bic', bic);
           formData.append('account_name', account_name);
           formData.append('iban', iban);
           formData.append('account_no', account_no);
           formData.append('b_currency', b_currency);
           for(var count = 0; count<document_type_ids.length; count++){ formData.append("document_type_ids[]", document_type_ids[count]); }
           for(var count = 0; count<document_files.length; count++){ formData.append("document_files[]", document_files[count]); }
           for(var count = 0; count<file_names.length; count++){ formData.append("file_names[]", file_names[count]); }
           formData.append('status', status);
           formData.append('_token', _token);

           //TODO: Seding Ajax Requrest for creating navbar menu
           $.ajax({
               url:"{{ route('admin.companies.manage-companies.create-process') }}",
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
                   $('#save').html(`${save_icon} @lang('translation.add_company')`);
                   $('#save').attr('class',`btn btn-danger btn-block`);
                   $('#save').removeAttr('disabled');
               },
               success:function(res)
               {
                   console.log(res);
                   if(res == "true"){
                       ToastSuccess("@lang('translation.company_created_sucessfully')");
                       $('#name').val('');
                       $('#designation').val('');
                       $('#company_name').val('');
                       $('#new_email').val('');
                       $('#password').val('');
                       $('#confirm_password').val('');
                       $('#phone').val('');
                       $('#mobile').val('');
                       $('#profile_id').val('');
                       $('#server_key').val('');
                       $('#currency').val('');
                       $('#address').val('');
                       $('#city').val('');
                       $('#zip').val('');
                       $('#country').val('');
                       $('#state').val('');
                       $('#banke_name').val('');
                       $('#bic').val('');
                       $('#account_name').val('');
                       $('#iban').val('');
                       $('#account_no').val('');
                       $('#currency').val('');
                       $('#status').val('');
                       $('#tbody').html("");
                       $('#dynamic_fields').html('');
                       $('#package_id').val('');
                       $('#sender_id_by_number').val('');
                       $('#sender_id_by_name').val('');
                       $('#secrate_key').val('');
                       $('#api_key').val('');
                       $('#sms_limit').val('');
                       $('#name').focus();
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

});

</script>
