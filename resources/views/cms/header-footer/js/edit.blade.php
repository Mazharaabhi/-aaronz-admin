
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#cms', '#header_footer', '#cms_anchor');
         $('#icon').change(function(){
            $('#show_icon').attr('class', `${$(this).val()} text-primary ml-5`);
         });


         //for add new staff
        $('#add_language').click(function(){
            const header_logo = document.getElementById('fileupload-btn-one').files[0];
            const footer_logo = document.getElementById('fileupload-btn-two').files[0];
            const favicon = document.getElementById('fileupload-btn-three').files[0];
            const meta_image = document.getElementById('meta-file').files[0];
            const title_english = $(`#title_english_${input_id}`).val();
            const desc_english = $(`#description_english_${input_id}`).val();
            const follow_up_desc_english = $(`#follow_up_desc_${input_id}`).val();
            const news_letter_desc_english = $(`#news_letter_desc_${input_id}`).val();
            const email = $('#new_one_email').val();
            var phone = $('#phone').val();
            const meta_title = $('#meta_title').val();
            const meta_descriptions = $('#meta_description').val();
            var follow_up_descriptions = $("textarea[name='follow_up_desc[]']").map(function(){return $(this).val();}).get();
            var news_letter_descriptions = $("textarea[name='news_letter_desc[]']").map(function(){return $(this).val();}).get();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            var descriptions = $("textarea[name='description_english[]']").map(function(){return $(this).val();}).get();
            const fb = $('#fb').val();
            const instagram = $('#instagram').val();
            const linkedin = $('#linkedin').val();
            const twitter = $('#twitter').val();
            const google = $('#google').val();
            const youtube = $('#youtube').val();
          //  return console.log(linkedin);
            //applying validations here
            if(!title_english || !$.trim(title_english).length){
                $('#image_one_error').html('');
                $('#title_english_error').html("The address field is required.");
                hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $(`#div_description_${input_id}`).attr('class', 'col-md-12 mb-3');
                return $('#title_english_1').focus();
            }else if(title_english.length < 10){
                $('#image_one_error').html('');
                hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $(`#div_description_${input_id}`).attr('class', 'col-md-12 mb-3');
                $('#title_english_error').html("The title field must be at least 10 character.");
                return $('#title_english_1').focus();
            }else if(email == ""){
                $('#image_one_error').html('');
                $('#title_english_error').html("");
                $('#email_error').html("The email field is required.");
                return $('#email').focus();
            }else if(phone == ""){
                $('#image_one_error').html('');
                $('#title_english_error').html("");
                $('#email_error').html("");
                $('#phone_error').html("The phone field is required.");
                return $('#phone').focus();
            }else{
                $('#image_one_error').html("");
                $('#title_english_error').html("");
                $('#email_error').html("");
                $('#phone_error').html("");
                $('#image_two_error').html("");
               phone = $('.iti__selected-dial-code').text()+$('#phone').val();
                var formData = new FormData();
                formData.append('id', "{{ $storedData[0]->id }}");
                formData.append('header_logo',header_logo);
                formData.append('footer_logo',footer_logo);
                formData.append('favicon',favicon);
                formData.append('title_english',title_english);
                formData.append('desc_english',desc_english);
                formData.append('meta_title',meta_title);
                formData.append('meta_descriptions',meta_descriptions);
                formData.append('email',email);
                formData.append('meta_image',meta_image);
                formData.append('news_letter_desc_english',news_letter_desc_english);
                formData.append('follow_up_desc_english',follow_up_desc_english);
                formData.append('descriptions',descriptions);
                formData.append('languages_names',languages);
                formData.append('follow_up_descriptions',follow_up_descriptions);
                formData.append('news_letter_descriptions',news_letter_descriptions);
                formData.append('titles',titles);
                formData.append('email',email);
                formData.append('phone',phone);
                formData.append('fb',fb);
                formData.append('twitter',twitter);
                formData.append('instagram',instagram);
                formData.append('linkedin',linkedin);
                formData.append('google',google);
                formData.append('youtube',youtube);
                formData.append('_token',_token);

                 $.ajax({
                     url:"{{ route('cms.header-footer.edit-process') }}",
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
                        /// return console.log(res)
                       if(res == "true"){
                        ToastSuccess("Header Footer Updated Successfully");
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
        $("#fileupload-btn-two").change(function() {
            readURLTwo(this);
        });

        function readURLMetaFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#blah-meta-file').attr('src', e.target.result);
            $('#blah-meta-file').attr('class','d-block')
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
           }
        }
        $("#meta-file").change(function() {
            readURLMetaFile(this);
        });
    });
</script>
