
<script>

    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#c_settings', '#c_languages', '#cms_anchor');

         //for add new feature
         $('#edit_language').click(function(){
            const title_english = $('#title_english').val();
            const language_direction = $('#language_direction').val();
           if(!title_english || !$.trim(title_english).length){
                $('#menu_id_error').html("");
                $('#title_english_error').html("");
                $('#image_one_error').html("");
                 return $('#book_title_english_error').html("The title english field is required.");
            }else{
                $('#title_english_error').html("");
                flag_image = document.getElementById('fileupload-btn-one').files[0];
                var formData = new FormData();
                formData.append('title_english',title_english);
                formData.append('language_direction',language_direction);
                formData.append('flag_image',flag_image);
                formData.append('id',"{{ $language->id }}");
                formData.append('_token',"{{ csrf_token() }}");

                 $.ajax({
                     url:"{{ route('admin.settings.languages.edit-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#edit_language').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#edit_language').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#edit_language').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#edit_language').html(`${save_icon} @lang('translation.update')`);
                        $('#edit_language').attr('class',`${btn_cherwell } btn-block`);
                        $('#edit_language').removeAttr('disabled');
                    },
                     success:function(res)
                     {
                       if(res == "true")
                       {
                        ToastSuccess("Language Updated Successfully!");
                       }
                       else
                       {
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

        //for image preview
        function readURLTwo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('#blah-two').attr('src', e.target.result);
            $('#blah-two').attr('class','d-block')
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }

        $("#fileupload-mobile-view-image").change(function() {
        readURLTwo(this);
        });
    });

</script>
