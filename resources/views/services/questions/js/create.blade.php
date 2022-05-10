
<script>
    $(document).ready(function(){
        // $('#radio_options').hide()
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#services', '#service-questions', '#service_anchor');
        GrandMenuActive('#services');
        //making slug/url here
        $(`#title_english_${input_id}`).keyup(function(e){
            var menu = $(this).val();
            //replaceing the string to lowercase
            var val = menu.toLowerCase();
            $('#slug').val(`/${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
        });


        $(`#service_id`).change(function(){
            const service_category_id = $(this).val();
            getServiceSubCategories(service_category_id)
        });

        function getServiceSubCategories(service_category_id){
            $.ajax({
                url:"{{ route('manage-services.list-service.get_sub_services') }}",
                method:"POST",
                data:{service_category_id,_token},
                success:function(res){
                    $(`#service_sub_category_id`).html(res);
                },error:function(xhr){
                    console.log(xhr.responseText)
                }
            });
        }

         //for add new SUb Category
        $('#add_language').click(function(){
            const title_english = $(`#title_english_${input_id}`).val();
            const service_category_id = $('#service_id').val();
            const slug = $('#slug').val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            var options = $("input[name='option_title[]']").map(function(){return $(this).val();}).get();
            var question_type = $("input[name='question']:checked").val();

            //applying validations here
             if(!service_category_id)
             {
                $('#type_id_error').html("");
                return $('#service_id_error').html("Please select a category.");
             }else if(!service_category_id)
             {
                $('#type_id_error').html("");
                $('#service_id_error').html("");
                return $('#service_sub_id_error').html("Please select service sub category.");
             }else if(!title_english || !$.trim(title_english).length){
                $('#service_id_error').html("");
                $('#service_sub_id_error').html("");
                $('#type_id_error').html("");
                 $('#title_english_error').html("The name field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $('#title_english').focus()
            }else if(title_english.length < 3){
                $('#service_id_error').html("");
                $('#service_sub_id_error').html("");
                hideInputs();
                $('#type_id_error').html("");
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                return $('#title_english_error').html("The name field must be at least 3 character.");
            }else{
                $('#service_id_error').html("");
                $('#type_id_error').html("");
                $('#title_english_error').html("");
                $('#service_sub_id_error').html("");
                $('#slug_error').html("");
                var QuestionForm = $('#QuestionForm');
                var formData = new FormData(QuestionForm[0]);
                formData.append('question_type',question_type);
                formData.append('_token',_token);
                formData.append('options',options);
                 $.ajax({
                     url:"{{ route('manage-services.question.create-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#add_language').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#add_language').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#add_language').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add_language').html(`${save_icon} @lang('translation.save')`);
                        $('#add_language').attr('class',`${btn_cherwell } btn-block`);
                        $('#add_language').removeAttr('disabled');
                    },
                     success:function(res){
                       console.log(res);
                       if(res == "true"){
                         $('input[name="title_english[]"]').map(function(){
                            $(this).val('');
                            $('#options_tbody').html("");
                        });
                        $(`#title_english_${input_id}`).focus();
                        ToastSuccess("Question Created Successfully");
                        window.location.reload();
                       }else if(res == 'title'){
                        $('#title_english_error').html("This question already exist.");
                        $(`#title_english_${input_id}`).focus();
                       }

                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });


            }
        });
        //TO UPDATE INSERED OPTIONS//
        var RowIDToUpdate = '';
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            //TODO: Getting row data and putting up into form
            $('body').delegate('#row-to-update','click', function(){
                RowIDToUpdate = $(this).parent().parent().find('input[name="id"]').val();
               /// console.log(RowIDToUpdate);
                 for(var i = 0; i < languages.length ; i++)
                   {
                     var title = $(this).parent().parent().find(`input[name="option_title_${languages[i]}[]"]`).val();
                      //console.log(title);
                      $(`#option_english_${languages[i]}`).val(title);
                   }
                $('#option_'+RowIDToUpdate).css({backgroundColor:'#dfdcdc'});
                $('#add-option').html("@lang('translation.update')");
            });
            var id = 1;
        ///TO Add Options In table//
        $('#add-option').click(function(){
            $('#add-option').html("Add");
            $('#option_'+RowIDToUpdate).removeAttr('style');
            $('#option_english_error').html("");
            let option_english= $(`input[name="option_english_${input_id}"]`).val();
            if(RowIDToUpdate)
                {
                  if(!option_english != "" || !$.trim(option_english).length)
                  {
                    $('#option_english_error').html("Service option required*.");
                    return $(`#option_english_${input_id}`).focus();
                   }
                   else{
                        let title= $(`input[name="option_english_${input_id}"]`).val();
                        let rowData=`
                          <td class="justify-content-center">${RowIDToUpdate}</td>
                            <td class="justify-content-center">
                                ${title}
                            </td>
                            <td class="text-center justify-content-center">
                            <input type="hidden" name="id" value="${RowIDToUpdate}">`;
                            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
                            for(var i = 0; i < languages.length ; i++)
                            {
                                var inputValue = $(`input[name="option_english_${languages[i]}"]`).val();
                                rowData += `<input type="hidden" name="option_title[]" value="${inputValue}">`
                            }
                          rowData +=`<a href="javascript:;" id="row-to-update" class="btn btn-sm btn-icon btn-secondary">
                            <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                            </a>
                            <a href="javascript:;" id="remove" class="btn btn-sm btn-icon btn-secondary">
                            <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                            </a>
                        </td>
                        `;
                        $('body').find(`#option_${RowIDToUpdate}`).html(rowData);
                        for(var i = 0; i < languages.length ; i++)
                        {
                         $(`#option_english_${languages[i]}`).val("");
                        }
                        RowIDToUpdate='';
                   }
                 }
             else
                {
                    if(!option_english != "" || !$.trim(option_english).length)
                    {
                        $('#option_english_error').html("Service Option Required.*");
                        return $(`#option_english_${input_id}`).focus();
                    }
                    else{

                        let title= $(`input[name="option_english_${input_id}"]`).val();
                        let rowData=`<tr id="option_${id}">
                       <td class="justify-content-center">${id}</td>
                        <td class="justify-content-center">
                            ${title}
                        </td>
                        <td class="text-center justify-content-center">
                        <input type="hidden" name="id" value="${id}">`;
                        var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
                        for(var i = 0; i < languages.length ; i++)
                            {
                                var inputValue = $(`input[name="option_english_${languages[i]}"]`).val();
                                      rowData += `<input type="hidden" name="option_title_${languages[i]}[]" value="${inputValue}">`
                            }
                 rowData +=`<a href="javascript:;" id="row-to-update" class="btn btn-sm btn-icon btn-secondary">
                            <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                            </a>
                            <a href="javascript:;" id="remove" class="btn btn-sm btn-icon btn-secondary">
                            <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                            </a>
                        </td>
                        </tr>`;
                    $('#options_tbody').append(rowData);
                    for(var i = 0; i < languages.length ; i++)
                    {
                      $(`#option_english_${languages[i]}`).val("");
                    }
                    id++;
                  }
                }
           });

           //TO DELETE OPTION FROM TABLE//
            $('body').delegate('#remove','click',function(){
                var id = $(this).parent().parent().find('input[name="id"]').val();
                $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Are You Sure you want to delete this option? ',
                    boxWidth: '20%',
                    buttons: {
                    cancel: function () {
                    },
                    confirm: {
                        text: 'Confirm',
                        btnClass: 'btn-red',
                        action: function(){

                            $('body').find(`#option_${id}`).remove();
                            $.alert('Option Deleted Successfully!');
                        }
                     }
                    }
                });
             });
             //HIDE SHOW FOR RADIO BUTTON//
             $('input[type=radio]').on('click',function(){
                if ($('#sub_type').is(':checked')){
                    $('#radio_options').show();
                }else{
                    $('#radio_options').hide()
                }
             });
             //SHOW HIDE WIDGTE//

             $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            });
    });
</script>
