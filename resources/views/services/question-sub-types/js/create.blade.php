
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#services', '#questions-sub-type', '#service_anchor');
        GrandMenuActive('#services');
        //making slug/url here
        $(`#title_english_${input_id}`).keyup(function(e){
            var menu = $(this).val();
            //replaceing the string to lowercase
            var val = menu.toLowerCase();
            $('#slug').val(`/${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
        });

        $('#service_id').change(function(){
            const service_category_id = $(this).val();

            if(service_category_id != "")
            {
                $.ajax({
                    url:"{{ route('manage-properties.question-sub-type.get-categories') }}",
                    method:"GET",
                    data:{service_category_id},
                    success:function(res){
                        $('#service_subCat_id').html(res);
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
         //for add new SUb Category
        $('#add_language').click(function(){
            const title_english = $(`#title_english_${input_id}`).val();
            const option_english = $(`#option_english_${input_id}`).val();
            const service_category_id = $('#service_id').val();
            const service_sub_category_id = $('#service_subCat_id').val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            var options = $("input[name='option_title[]']").map(function(){return $(this).val();}).get();
            //applying validations here
             if(!service_category_id)
             {
                return $('#service_id_error').html("Please select a category.");
             }else if(!service_sub_category_id)
             {
                $('#service_id_error').html("");
                return $('#service_subCat_id_error').html("Please select sub category.");
             }else if(!title_english || !$.trim(title_english).length){
                $('#service_subCat_id_error').html("");
                $('#service_id_error').html("");
                $('#type_id_error').html("");
                 $('#title_english_error').html("The question name field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $(`#div_options_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $('#title_english').focus()
            }else if(title_english.length < 3){
                $('#service_id_error').html("");
                hideInputs();
                $('#type_id_error').html("");
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $(`#div_options_${input_id}`).attr('class', 'col-md-6 mb-3');
                return $('#title_english_error').html("The question name field must be at least 3 character.");
            }else if(!option_english || !$.trim(option_english).length){
                $('#service_subCat_id_error').html("");
                $('#service_id_error').html("");
                $('#type_id_error').html("");
                 $('#option_english_error').html("The Option field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $(`#div_options_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $(`#option_english_${input_id}`).focus()
            }else{
                $('#service_id_error').html("");
                $('#service_subCat_id_error').html("");
                $('#title_english_error').html("");
                var QuestionForm = $('#QuestionForm');
                var formData = new FormData(QuestionForm[0]);
                formData.append('_token',_token);
                formData.append('options',options);
                 $.ajax({
                     url:"{{ route('manage-services.question-sub-type.create-process') }}",
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
                         $('input[name="option_english[]"]').map(function(){
                            $(this).val('');
                        });
                        $(`#option_english_${input_id}`).focus();
                        ToastSuccess("Question Sub Type Created Successfully");
                       }else if(res == 'title'){
                        $('#service_subCat_id_error').html("This category record already exist.");
                        $(`#service_subCat_id`).focus();
                       }
                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });
            }
        });

    });
</script>
