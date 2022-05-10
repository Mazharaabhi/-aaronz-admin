
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#c_properties', '#p_sub_categories', '#cms_anchor');
         GrandMenuActive('#c_properties_1');

        //making slug/url here
        $(`#title_english_${input_id}`).keyup(function(e){
            var menu = $(this).val();
            //replaceing the string to lowercase
            var val = menu.toLowerCase();
            $('#slug').val(`/${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
        });



        $('#type_id').change(function(){
            const property_type_id = $(this).val();

            if(property_type_id != "")
            {
                $.ajax({
                    url:"{{ route('manage-properties.property-settings.sub-categories.get-categories') }}",
                    method:"GET",
                    data:{property_type_id},
                    success:function(res){
                        $('#service_id').html(res);
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
            const property_type_id = $('#type_id').val();
            const property_category_id = $('#service_id').val();
            const slug = $('#slug').val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            //applying validations here
             if(!property_type_id)
             {
                return $('#type_id_error').html("Please select property type.");
             }
             else if(!property_category_id)
             {
                $('#type_id_error').html("");
                return $('#service_id_error').html("Please select a category.");
             }else if(!title_english || !$.trim(title_english).length){
                $('#service_id_error').html("");
                $('#type_id_error').html("");
                 $('#title_english_error').html("The name field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $('#title_english').focus()
            }else if(title_english.length < 3){
                $('#service_id_error').html("");
                hideInputs();
                $('#type_id_error').html("");
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                return $('#title_english_error').html("The name field must be at least 3 character.");
            }else{
                $('#service_id_error').html("");
                $('#type_id_error').html("");
                $('#title_english_error').html("");

                var formData = new FormData();
                formData.append('type_id',type_id);
                formData.append('property_type_id',property_type_id);
                formData.append('property_category_id',property_category_id);
                formData.append('title_english',title_english);
                formData.append('slug',slug);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('_token',_token);



                 $.ajax({
                     url:"{{ route('manage-properties.property-settings.sub-categories.create-process') }}",
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
                        ToastSuccess("Sub Category Created Successfully");
                       }else if(res == 'title'){
                        $('#title_english_error').html("This sub category name is already exist.");
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
