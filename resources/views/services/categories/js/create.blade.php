
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#services', '#service', '#services_anchor');
         GrandMenuActive('#services');

        //making slug/url here
        $(`#title_english_${input_id}`).keyup(function(e){
            var menu = $(this).val();
            //replaceing the string to lowercase
            var val = menu.toLowerCase();
            $('#slug').val(`${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
        });

        //TODO: Checkbox handling here
        $('body').delegate('.chk-col-green', 'click', function(){
            if($(this).val() == 0)
            {
                $(this).val(1);
            }
            else
            {
                $(this).val(0);
            }
        });

         //for add new staff
        $('#add_language').click(function(){
            const title_english = $(`#title_english_${input_id}`).val();
            const slug = $('#slug').val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            var image = $('input[name="file-one"]').val();
            var question_val = $("input[name='question']:checked").val();

            //applying validations here
             if(!title_english || !$.trim(title_english).length){
                $('#type_id_error').html("");
                 $('#title_english_error').html("The name field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $(`#title_english_${input_id}`).focus();
            }else if(title_english.length < 3){
                hideInputs();
                $('#type_id_error').html("");
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $('#title_english_error').html("The name field must be at least 3 character.");
                return $(`#title_english_${input_id}`).focus();
            }else if(!image){
                $('#image_one_error').html("");
                return $('#image_one_error').html("The Image field is required.");
            }else{
                $('#type_id_error').html("");
                $('#title_english_error').html("");
                image = document.getElementById('fileupload-btn-one').files[0];
                var formData = new FormData();
                formData.append('title_english',title_english);
                formData.append('slug',slug);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('image',image);
                formData.append('question_val',question_val);
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('manage-services.categories.create-process') }}",
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
                        $('#slug').val("");
                        $('input[name="file-one"]').val("");
                        $('#blah-one').attr('class','d-none')
                         $('input[name="title_english[]"]').map(function(){
                            $(this).val('');
                        });
                        $(`#title_english_${input_id}`).focus();
                        ToastSuccess("Category Created Successfully");
                       }else if(res == 'title'){
                        $('#title_english_error').html("This category name is already exist.");
                        $(`#title_english_${input_id}`).focus();
                       }else if(res == 'slug'){
                        $('#slug_error').html("This slug already taken.");
                        $('#slug').focus();
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
