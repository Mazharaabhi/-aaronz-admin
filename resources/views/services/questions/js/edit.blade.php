
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#services', '#service-questions', '#service_anchor');
        GrandMenuActive('#services');

        // //making slug/url here
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
        getServiceSubCategories("{{ $storedData[0]->service_category_id }}")

        function getServiceSubCategories(service_category_id){
            $.ajax({
                url:"{{ route('manage-services.list-service.get_sub_services') }}",
                method:"POST",
                data:{service_category_id,_token},
                success:function(res){
                    $(`#service_sub_category_id`).html(res);
                    $(`#service_sub_category_id`).val("{{ $storedData[0]->service_sub_category_id }}");
                },error:function(xhr){
                    console.log(xhr.responseText)
                }
            });
        }

        //for add new staff
        //for add new staff
        $('#add_language').click(function(){
            const title_english = $(`#title_english_${input_id}`).val();
            const service_category_id = $('#service_id').val();
            const service_sub_category_id = $('#service_sub_category_id').val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            var question_type = $("input[name='question']:checked").val();
            //applying validations here
             if(!service_category_id)
             {
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
                $('#service_sub_id_error').html("");
                $('#title_english_error').html("");
                var formData = new FormData();
                formData.append('id',"{{ $storedData[0]->id }}");
                formData.append('service_category_id',service_category_id);
                formData.append('service_sub_category_id',service_sub_category_id);
                formData.append('question_type',question_type);
                formData.append('title_english',title_english);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('manage-services.question.edit-process') }}",
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
                        // return console.log(res);
                       if(res == "true"){
                        $(`#title_english_${input_id}`).focus();
                        ToastSuccess("Question Updated Successfully");
                       }else if(res == 'title'){
                        $('#title_english_error').html("This Service questiob already exist.");
                        $(`#title_english_${input_id}`).focus();
                       }

                     },error:function(xhr){
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
         //delete Question Option here
         $('body').delegate('#remove','click',function()
         {
              const id = $(this).attr('data-id');
              // return console.log(id);
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
                                $.ajax({
                                    url:"{{ route('manage-services.option.delete') }}",
                                    method:"POST",
                                    data : {"_token":"{{ csrf_token() }}",id},
                                    success:function(res)
                                    {
                                        if(res == 'true')
                                        {
                                            $(`#option_${id}`).remove();
                                            DataTable.ajax.reload();
                                            $.alert('Option Deleted Successfully!');
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
              });
        //delete Question Option here
         let update_row_id = '';
         $('body').delegate('#row-to-update','click',function()
         {
                const id = $(this).attr('data-id');
                $('#add-option').attr('data-id',1);
                $(`#option_${id}`).css({backgroundColor:'#dfdcdc'});
                $('#add-option').html("@lang('translation.update')");
               // return console.log(id);
                $.ajax({
                    url:"{{ route('manage-services.option.edit') }}",
                    method:"POST",
                    data : {"_token":"{{ csrf_token() }}",id},
                    success:function(res)
                    {
                        // Applying For Loop to rander data
                        update_row_id = res[0].parent_id;
                        var data = res;
                        $('input[name="option_english[]"]').map((index, element) => {
                            $(`#${element.id}`).val(data[index].title);
                        });

                    },
                    error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
          });

        $('#add-option').click(function(){
            const data_id = $(this).attr('data-id');
            $('#option_english_error').html("");
            if(data_id == 1)
            {
                var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
                var options = $("input[name='option_english[]']").map(function(){return $(this).val();}).get();
                var english_option = $(`#option_english_${input_id}`).val();
                var question_parent_id = "{{ $storedData[0]->id }}";
                if(!english_option != "" || !$.trim(english_option).length)
                {
                        $('#option_english_error').html("Service option required*.");
                        return $(`#option_english_${input_id}`).focus();
                }
                else
                {
                    $.ajax({
                        url:"{{ route('manage-services.option.update-process') }}",
                        method:"POST",
                        data : {"_token":"{{ csrf_token() }}",update_row_id,options,languages,question_parent_id},
                        success:function(res)
                        {
                            $('#options_tbody').html(res)
                            $('#add-option').html("Add");
                            $(`#option_${update_row_id}`).removeAttr('style');
                            $("input[name='option_english[]']").map(function(){return $(this).val("");});
                        },
                        error:function(xhr)
                        {
                            console.log(xhr.responseText);
                        }
                    });
                }
              }
              else
              {
                //TODO: ADD  NEW OPITION START HERE//
                var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
                var options = $("input[name='option_english[]']").map(function(){return $(this).val();}).get();
                var english_option = $(`#option_english_${input_id}`).val();
                var service_category = $(`#service_id`).val();
                var question_id ="{{ $storedData[0]->id  }}"
                if(!english_option != "" || !$.trim(english_option).length){
                    $('#option_english_error').html("Service option required*.");
                     return $(`#option_english_${input_id}`).focus();
                }else if(!english_option != "" || !$.trim(english_option).length)
                {
                        $('#service_id_error').html("Service Category required*.");
                        return $(`#service_id`).focus();
                }
                else
                {
                    $.ajax({
                        url:"{{ route('manage-services.option.add') }}",
                        method:"POST",
                        data : {"_token":"{{ csrf_token() }}",question_id,options,languages,service_category},
                        success:function(res)
                        {
                           //return console.log(res)
                            $('#options_tbody').append(res)
                            $("input[name='option_english[]']").map(function(){return $(this).val("");});
                        },
                        error:function(xhr)
                        {
                            console.log(xhr.responseText);
                        }
                    });
                }
              }
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
    });
</script>
