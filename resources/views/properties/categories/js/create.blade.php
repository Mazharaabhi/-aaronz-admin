<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#c_properties', '#p_categories', '#cms_anchor');
         GrandMenuActive('#c_properties_1');

        //making slug/url here
        $(`#title_english_${input_id}`).keyup(function(e){
            var menu = $(this).val();
            //replaceing the string to lowercase
            var val = menu.toLowerCase();
            $('#slug').val(`${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
        });


         //for add new staff
        $('#add_language').click(function(){
            const property_includes = $("input[name='property_includes[]']").map(function(){
                if($(this).prop("checked") == true){
                return $(this).val();
                }else
                {
                    return 0;
                }
            }).get();
            const title_english = $(`#title_english_${input_id}`).val();
            const property_type_id = $('#type_id').val();
            const slug = $('#slug').val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();



            //applying validations here
             if(!property_type_id)
             {
                return $('#type_id_error').html("Please select a property type.");
             }else if(!title_english || !$.trim(title_english).length){
                $('#type_id_error').html("");
                 $('#title_english_error').html("The name field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $('#title_english').focus()
            }else if(title_english.length < 3){
                hideInputs();
                $('#type_id_error').html("");
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                return $('#title_english_error').html("The name field must be at least 3 character.");
            }else{
                $('#type_id_error').html("");
                $('#title_english_error').html("");

                var formData = new FormData();
                formData.append('property_type_id',property_type_id);
                formData.append('property_category_type',property_type_id);
                formData.append('title_english',title_english);
                formData.append('slug',slug);
                formData.append('property_includes',property_includes);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('_token',_token);


                 $.ajax({
                     url:"{{ route('manage-properties.property-settings.categories.create-process') }}",
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
                        ToastSuccess("Category Created Successfully");
                       }else if(res == 'title'){
                        $('#title_english_error').html("This category name is already exist.");
                        $('#title_english').focus();
                       }

                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });


            }
        });

    });
</script>
