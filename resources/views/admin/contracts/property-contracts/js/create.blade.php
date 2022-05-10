<script>
    document.getElementById('start_date').value = new Date().toISOString().slice(0, 10);
    document.getElementById('check_date').value = new Date().toISOString().slice(0, 10);
$(document).ready(function(){
   @include('messages.jquery-messages')
   MakeMenuActive('#manage_customer', '#all_customer', '#service_anchor');

    OneyearDate($('#start_date').val());
    $('#start_date').change(function(){
        OneyearDate($(this).val());
    });

    function OneyearDate(start_date){
        var date = start_date.split('-')
        var day = date[2]
        var month = date[1]
        var year = parseInt(date[0]) + 1;
        end_date = `${year}-${month}-${day}`;
        $('#end_date').val(end_date)
    }

    /**Genrate Voucher Functionality*/
    $('#check_no').change(function(){
        const divideByNo = $('#check_no').val();
        const check_nos = $('#check_no').val();
        const check_generate_date = $('#check_date').val();
        const total_amount = "{{ $property->year_rent }}";
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        getChecks(divideByNo, check_nos, start_date, end_date, check_generate_date, total_amount);
    });

    /**Genrate Voucher Functionality*/
    $('#check_date').change(function(){
        const divideByNo = $('#check_no').val();
        const check_nos = $('#check_no').val();
        const check_generate_date = $('#check_date').val();
        const total_amount = "{{ $property->year_rent }}";
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        getChecks(divideByNo, check_nos, start_date, end_date, check_generate_date, total_amount);
    });

    /**Genrate Voucher Functionality*/
    $('#start_date').change(function(){
        const divideByNo = $('#check_no').val();
        const check_nos = $('#check_no').val();
        const check_generate_date = $('#check_date').val();
        const total_amount = "{{ $property->year_rent }}";
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        getChecks(divideByNo, check_nos, start_date, end_date, check_generate_date, total_amount);
    });


    function getChecks(divideByNo, check_nos, start_date, end_date, check_generate_date, total_amount){
        if(divideByNo != ""){
            $.ajax({
            url:"{{ route('property-contracts.get-checks') }}",
            method:"GET",
            data:{divideByNo, check_nos, start_date, end_date, check_generate_date, total_amount, _token},
            success:function(res){
                // console.log(res);
                $('#vouchers_div').html(res);
            },error:function(xhr){
                console.log(xhr.responseText);
            }
            });
        }
    }

    var widget_one_image_src = '';
    var filename = '';
    $("#header_image_1").change(function() {
        var input = this;
        var filename = $(this).val().split('\\').pop()
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            widget_one_image_src = e.target.result;
            filename = filename;
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
                            <a href="${widget_one_image_src}" target="_blank">${widget_one_image_src}</a>
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
                            ${image}
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


    var widget_one_image_srce = '';
    var filenamee = '';
    $("#header_image_1").change(function() {
        var input = this;
        var filenamee = $(this).val().split('\\').pop()
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            widget_one_image_srcc = e.target.result;
            filenamee = filename;
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    });


        // TODO: Step 3 Widget Section Start
        var RowIDToUpdatee = '';
        //TODO: Getting row data and putting up into form
        $('body').delegate('#row-to-updatee','click', function(){
            RowIDToUpdatee = $(this).parent().parent().find('input[name="id"]').val();
            var image = $(this).parent().parent().find('input[name="image"]').val();
            var document_type_id = $(this).parent().parent().find('input[name="document_type_id"]').val();
            console.log(document_type_id)
            $('#document_type_ide').val(document_type_id).trigger('change');
            $('#widget-one-dive').attr('class','');
            $('#ImageToUpdatee').html(image);
            $('#rowe1_'+RowIDToUpdatee).css({backgroundColor:'#dfdcdc'});
            $('#add-button-englishe').html("@lang('translation.update')");
        });
            var ide=1;
            var indexe = 0;
            var document_filese = [];
            var file_namese = [];
            var document_type_idse = [];
            $('#add-button-englishe').click(function(){
                $('#add-button-englishe').html("Add Document");
                $('#row1_'+RowIDToUpdatee).removeAttr('style');
                let document_type_ide= $('#document_type_ide').val()
                let document_typee= $('select[id="document_type_ide"] :selected').text()
                let imagee= $('#header_image_1e').val().split('\\').pop();
                if(RowIDToUpdatee)
                {
                if(!document_type_ide != "" || !$.trim(document_type_ide).length){
                    $('#image_1_errore').html("")
                    $('#document_type_id_1_errore').html("@lang('translation.document_type_id_error')");
                    return $('#document_type_ide').focus();
                }else{
                    var propertye = document.getElementById('header_image_1e').files[0];
                    document_files.push(propertye);
                    document_type_idse.push(document_type_ide);
                    file_namese.push(imagee);
                    $('#image_1_errore').html("");
                    $('#document_type_id_1_errore').html("");
                    $("#document_type_ide").val('').trigger('change')
                    $('#header_image_1e').val("");
                    let rowDatae=
                       `<td class="justify-content-center">${RowIDToUpdatee}</td>
                        <td class="justify-content-center">${widget_two_image_srce}
                            </td>
                        <td class="justify-content-center">
                            <a href="${widget_two_image_srce}" target="_blank">${widget_two_image_srce}</a>
                        </td>
                        <td class="text-center justify-content-center">
                            <input type="hidden" name="indexe" value="${indexe}"/>
                            <input type="hidden" name="ide" value="${RowIDToUpdatee}"/>
                            <input type="hidden" name="imagee" value="${widget_two_image_srce}"/>
                            <input type="hidden" name="document_type_ide" value="${document_type_ide}"/>
                            <a href="javascript:;" id="row-to-updatee" class="btn btn-sm btn-icon btn-secondary">
                            <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                            </a>
                            <a href="javascript:;" id="remove-w-1e" class="btn btn-sm btn-icon btn-secondary">
                            <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                            </a>
                        </td>`;
                    $('body').find('#row1e_'+RowIDToUpdatee).html(rowDatae);
                    RowIDToUpdate = '';
                }
                ide++;
                indexe++;
                }
                else
                {
                    if(!imagee  != "")
                    {
                        $('#image_1_errore').html("Please select a document file");
                        return $('#header_image_1e').focus();
                    }
                    else if(!document_type_ide != "" || !$.trim(document_type_ide).length){
                        $('#image_1_errore').html("")
                        $('#document_type_id_1_errore').html("Please select document type.");
                        return $('#document_type_ide').focus();
                   }
                   else
                   {
                        var propertye = document.getElementById('header_image_1e').files[0];
                        document_filese.push(propertye);
                        document_type_idse.push(document_type_ide);
                        file_namese.push(imagee);
                        $('#image_1_errore').html("");
                        $('#document_type_id_1_errore').html("");
                        $("#document_type_ide").val('').trigger('change')
                        $('#header_image_1e').val("");
                        let rowDatae=
                    `<tr id="rowe1_${ide}">
                        <td class="justify-content-center">${ide}</td>
                        <td class="justify-content-center">
                            ${imagee}
                            </td>
                        <td class="justify-content-center">
                            ${document_typee}
                        </td>
                        <td class="text-center justify-content-center">
                            <input type="hidden" name="indexe" value="${indexe}"/>
                            <input type="hidden" name="ide" value="${ide}"/>
                            <input type="hidden" name="imagee" value="${widget_two_image_srce}"/>
                            <input type="hidden" name="document_type_ide" value="${document_type_ide}"/>
                            <a href="javascript:;" id="row-to-updatee" class="btn btn-sm btn-icon btn-secondary">
                            <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                            </a>
                            <a href="javascript:;" id="remove-w-1e" class="btn btn-sm btn-icon btn-secondary">
                            <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                            </a>
                        </td>
                        </tr>`;
                    $('#wiget_datae').append(rowDatae);
                  }
                 ide++;
                 indexe++;
                }
                $('#widget-one-dive').attr('class','d-none');
                $('#ImageToUpdatee').html(imagee);
            });
            //To Remove Widget 1 Row//
            $('body').delegate('#remove-w-1e','click',function(){
                var indexe = $(this).parent().parent().find('input[name="indexe"]').val();
                var obje = $(this);
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
                                console.log(document_filese);
                                if(document_type_idse.length == 1){
                                    document_filese = [];
                                    document_type_idse = [];
                                }
                                document_files.splice(indexe, 1);
                                document_type_ids.splice(indexe, 1);
                                console.log(document_filese);
                                obje.parent().parent().remove();
                                $.alert('Document Deleted Successfully!');
                            }
                        }
                    }
                });




            });
        // End

        $('#save').click(function(){
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        const check_date = $('#check_date').val();
        const year_rent = $('#year_rent').val();
        const lead_id = "{{ $lead->id }}";
        const user_id = "{{ $lead->user_id }}";
        const property_id = "{{ $lead->property_id }}";
        const assigned_to = "{{ $lead->assigned_to->assigned_to }}";
        const check_no = $('#check_no').val();
        var amount = $("input[name='amount[]']")
              .map(function(){return $(this).val();}).get();
        var due_date = $("input[name='due_data[]']")
              .map(function(){return $(this).val();}).get();
        // return console.log(due_date)
        if(start_date == ""){
            return $('#start_date_error').html('The start date field is required');
        }else if(end_date == ""){
            $('#start_date_error').html('');
            return $('#end_date_error').html('The end date field is required');
        }else if(check_date == ""){
            $('#start_date_error').html('');
            $('#end_date_error').html('');
            return $('#check_date_error').html('The end date field is required');
        }else if(check_no == ""){
            $('#start_date_error').html('');
            $('#end_date_error').html('');
            $('#check_date_error').html('');
            return $('#check_no_error').html('The check no field is required');
        }else {
            $('#start_date_error').html('');
            $('#end_date_error').html('');
            $('#check_date_error').html('');
            $('#check_no_error').html('');

            const formData = new FormData;
            formData.append('start_date',start_date);
            formData.append('end_date',end_date);
            formData.append('check_date',check_date);
            formData.append('total_amount',year_rent);
            formData.append('check_no',check_no);
            formData.append('lead_id',lead_id);
            formData.append('user_id',user_id);
            formData.append('amount',amount);
            formData.append('due_date',due_date);
            formData.append('assigned_to',assigned_to);
            for(var count = 0; count<document_type_ids.length; count++){ formData.append("document_type_ids[]", document_type_ids[count]); }
            for(var count = 0; count<document_files.length; count++){ formData.append("document_files[]", document_files[count]); }
            for(var count = 0; count<file_names.length; count++){ formData.append("file_names[]", file_names[count]); }
            for(var count = 0; count<document_type_idse.length; count++){ formData.append("document_type_idse[]", document_type_idse[count]); }
            for(var count = 0; count<document_filese.length; count++){ formData.append("document_filese[]", document_filese[count]); }
            for(var count = 0; count<file_namese.length; count++){ formData.append("file_namese[]", file_namese[count]); }
            formData.append('_token',_token);

            $.ajax({
            url:"{{ route('property-contracts.create-tenancy-contract') }}",
            method:"POST",
            data:formData,
            contentType:false,
            processData:false,
            cache:false,
            success:function(res){
                ToastSuccess("Tenancy Contract Created Successfully!");
                window.location.reload();
            },error:function(xhr){
                console.log(xhr.responseText);
            }
            });


        }


    });



});
</script>
