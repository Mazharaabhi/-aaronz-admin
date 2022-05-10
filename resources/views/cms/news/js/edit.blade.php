
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#cms', '#news', '#cms_anchor');
         $('#icon').change(function(){
            $('#show_icon').attr('class', `${$(this).val()} text-primary ml-5`);
         });

         //for add new staff
        $('#add_language').click(function(){
            const news_category_id = $('select[name="news_category_id"] :selected').val();
            const title_english = $(`#title_english_${input_id}`).val();
            const slug = $('#slug').val();
            const meta_title = $(`#meta_title`).val();
            const meta_description = $(`#meta_description`).val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            const image = document.getElementById('fileupload-btn-one').files[0];
            var descriptions=[];
            var desc_id="";
            for(var i=0;i<languages.length;i++){
                var desc_id = "descriptions_"+languages[i];
                data = CKEDITOR.instances[desc_id].getData();
                descriptions.push(data);
            }
          //***MAKING ARRAY OF DESC START HERE****//
            //applying validations here
            if(news_category_id == ""){
                return $('#news_category_id_error').html('Please select a new category');
            }else if(!title_english || !$.trim(title_english).length){
                $('#news_category_id_error').html('');
                $('#title_english_error').html("The title field is required.");
                hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $(`#div_description_${input_id}`).attr('class', 'col-md-12 mb-3');
                return $('#title_english_1').focus();
            }else if(title_english.length < 3){
                $('#news_category_id_error').html('');
                hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $(`#div_description_${input_id}`).attr('class', 'col-md-12 mb-3');
                $('#title_english_error').html("The title field must be at least 3 character.");
                return $('#title_english_1').focus();
            }else if(!slug || !$.trim(slug).length){
                $('#news_category_id_error').html('');
                $('#title_english_error').html("");
                return $('#slug_error').html("The slug field is required.");
            }else{
                $('#news_category_id_error').html('');
                $('#title_english_error').html("");
                $('#image_one_error').html("");
                $('#description_english_error').html("");
                $('#slug_error').html("");

                var formData = new FormData();
                formData.append('id', "{{ $storedData[0]->id }}");
                formData.append('news_category_id',news_category_id);
                formData.append('title_english',title_english);
                formData.append('slug',slug);
                formData.append('meta_title',meta_title);
                formData.append('meta_description',meta_description);
                formData.append('descriptions',descriptions);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('image',image);
                formData.append('_token',_token);
                for(var count = 0; count<descriptions.length; count++){
                    formData.append("descriptions[]", descriptions[count]);
                }
                 $.ajax({
                     url:"{{ route('cms.news.edit-process') }}",
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
                        //  return console.log(res)
                       if(res == "true"){
                        ToastSuccess("News Updated Successfully");
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
