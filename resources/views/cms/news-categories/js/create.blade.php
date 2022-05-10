
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#cms', '#news_categories', '#cms_anchor');

        //making slug/url here
        $(`#title_english_${input_id}`).keyup(function(e){
            var menu = $(this).val();
            //replaceing the string to lowercase
            var val = menu.toLowerCase();
            $('#slug').val(`${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
        });


         //for add new staff
        $('#add_language').click(function(){
            const title_english = $(`#title_english_${input_id}`).val();
            const slug = $('#slug').val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();

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
            }else if(!slug || !$.trim(slug).length){
                $('#title_english_error').html("");
                return $('#slug_error').html("The slug field is required.");
            }else{
                $('#type_id_error').html("");
                $('#title_english_error').html("");

                var formData = new FormData();
                formData.append('title_english',title_english);
                formData.append('slug',slug);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('_token',_token);


                 $.ajax({
                     url:"{{ route('cms.news-categories.create-process') }}",
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
                       if(res == "true"){
                        $('#slug').val("");
                         $('input[name="title_english[]"]').map(function(){
                            $(this).val('');
                        });
                        $(`#title_english_${input_id}`).focus();
                        ToastSuccess("News Category Created Successfully");
                       }else if(res == 'title'){
                        $('#title_english_error').html("This category name is already exist.");
                        $(`#title_english_${input_id}`).focus();
                       }

                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });


            }
        });

    });
</script>
