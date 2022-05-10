
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         @include('locations.states.js.gecoding')
         MakeMenuActive('#c_locations', '#city_states', '#cms_anchor');

        //TODO: Creating slug for navbar menu
        $(`#title_english_${input_id}`).keyup(function(e)
        {
            CreateSlug($(this).val(), "#slug");
        });

        function CreateSlug(menu,slug)
        {
            //TODO: Converting Menu's String to lowercase
            var val = menu.toLowerCase();
            if(val == "home"){
                $(slug).val(``);
            }else{
                $(slug).val(`${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
            }
        }
         //for add new staff
        $('#add_language').click(function(){
            const title_english = $(`#title_english_${input_id}`).val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            const location_country_id = $('#country').val();
            const slug = $('#slug').val();
            const image = document.getElementById('fileupload-btn-one').files[0];
            //applying validations here
             if(!location_country_id){
                return $('#country_id_error').html("Please select a country.");
             }else if(!title_english || !$.trim(title_english).length){
                 $('#country_id_error').html("");
                 $('#title_english_error').html("The name field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $(`#title_english_${input_id}`).focus();
            }else if(title_english.length < 3){
                hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $('#title_english_error').html("The namelength must be at least 3 character.");
                return $(`#title_english_${input_id}`).focus();
            }else if(!$.trim(slug).length){
                $('#title_english_error').html("");
                $('#slug_error').html("The slug field is required.");
                return $('#slug').focus();
            }
            else if(!image){
                $('#title_english_error').html("");
                $('#slug_error').html("");
                return $('#image_one_error').html("The image field is required.");
            }else{
                $('#title_english_error').html("");
                $('#country_id_error').html("");
                $('#image_one_error').html("");
                $('#slug_error').html("");

                var formData = new FormData();
                formData.append('title_english',title_english);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('slug',slug);
                formData.append('latitude',latitude);
                formData.append('longitude',longitude);
                formData.append('image',image);
                formData.append('location_country_id',location_country_id);
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('locations.states.create-process') }}",
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
                         console.log(res);
                       if(res == "true"){
                         $('#blah-one').attr('class','d-none');
                         $('input[name="title_english[]"]').map(function(){
                            $(this).val('');
                        });
                        $('#slug').val('');
                        $('#fileupload-btn-one').val('');
                        ToastSuccess("Cities Created Successfully");
                       }else if(res == 'title'){
                        $('#title_english_error').html("This state name is already exist.");
                        $('#title_english').focus();
                       }
                       else if(res == 'slug'){
                        $('#slug_error').html("This slug is already exist.");
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
