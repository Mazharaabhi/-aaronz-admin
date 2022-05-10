
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#services', '#questions-sub-type', '#service_anchor');
        GrandMenuActive('#services');

        // //making slug/url here
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
          //for add new staff
        $('#add_language').click(function(){
            const title_english = $(`#title_english_${input_id}`).val();
            const option_english = $(`#option_english_${input_id}`).val();
            const service_category_id = $('#service_id').val();
            const service_sub_category_id = $('#service_subCat_id').val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            var options = $("input[name='option_english[]']").map(function(){return $(this).val();}).get();
            //applying validations here
            if(!service_category_id)
             {
                return $('#service_id_error').html("Please select a category.");
             }else if(!service_sub_category_id)
             {
                $('#service_id_error').html("");
                return $('#service_subCat_id_error').html("Please select sub category.");
             }else if(!title_english || !$.trim(title_english).length){
                $('#service_id_error').html("");
                $('#type_id_error').html("");
                 $('#title_english_error').html("The name field is required.");
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
                return $('#title_english_error').html("The name field must be at least 3 character.");
            }else if(!option_english || !$.trim(option_english).length){
                $('#service_subCat_id_error').html("");
                $('#service_id_error').html("");
                $('#title_english_error').html("");
                 $('#option_english_error').html("The Option field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $(`#div_options_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $(`#option_english_${input_id}`).focus()
            }else{
                $('#service_id_error').html("");
                $('#service_subCat_id_error').html("");
                $('#option_english_error').html("");
                $('#title_english_error').html("");
                var formData = new FormData();
                formData.append('id',"{{ $storedData[0]->id }}");
                formData.append('service_category_id',service_category_id);
                formData.append('service_sub_category_id',service_sub_category_id);
                formData.append('title_english',title_english);
                formData.append('option_english',option_english);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('options',options);
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('manage-services.question-sub-type.edit-process') }}",
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
                     //return console.log(res);
                       if(res == "true"){
                        $(`#title_english_${input_id}`).focus();
                        ToastSuccess("Question Updated Successfully");
                       }else if(res == 'title'){
                        $('#title_english_error').html("This Service question already exist.");
                        $(`#title_english_${input_id}`).focus();
                       }
                       else if(res == 'option'){
                        $('#option_english_error').html("This option value already exist.");
                        $(`#option_english_${input_id}`).focus();
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
    });
</script>
