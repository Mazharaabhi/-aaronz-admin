
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#c_settings', '#c_languages', '#cms_anchor');
         $('#add_language').click(function(){
            // return alert('hello');
            const title_english = $('#title_english').val();
            const language_direction = $('#language_direction').val();
            var image = $('input[name="file-one"]').val();
           // return console.log(language_direction);
            //applying validations here
            if(!title_english || !$.trim(title_english).length){
                $('#title_english_error').html("");
                $('#title_english_error').html("The language title field is required.");
                return $('#title_english').focus();
            }else if(!language_direction || !$.trim(language_direction).length){
                $('#title_english_error').html("");
                $('#language_direction_error').html("");
                 return $('#language_direction_error').html("@lang('translation.language_direction_required')");
            }else if(!image){
                $('#image_one_error').html("");
                $('#title_english_error').html("");
                $('#language_direction_error').html("");
                return $('#image_one_error').html("The flag image field is required.");
            }
            else{
                $('#image_one_error').html("");
                $('#title_english_error').html("");
                $('#language_direction_error').html("");
                flag_image = document.getElementById('fileupload-btn-one').files[0];
                var formData = new FormData();
                formData.append('title_english',title_english);
                formData.append('language_direction',language_direction);
                formData.append('flag_image',flag_image);
                formData.append('_token',"{{ csrf_token() }}");
                 $.ajax({
                     url:"{{ route('admin.settings.languages.create-process') }}",
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
                         $('#title_english').val("");
                         $('#language_direction').val("");
                         $('input[name="file-one"]').val("");
                         $('#blah-one').attr('src', '');
                         $('#blah-one').attr('class','d-none');
                         $('#title_english').focus();
                         ToastSuccess("Language Created Successfully");
                       }else{
                        ToastError("warning", "Language Already Exists.");
                        $('#title_english').focus();
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
