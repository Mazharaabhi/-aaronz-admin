
<script>
    $(document).ready(function(){
        //for add new feature
        @include('messages.jquery-messages')
        @include('common.hideshow-language-inputs')
        MakeMenuActive('#services', '#list_service', '#services_anchor');
        GrandMenuActive('#services');

        $(`#service_category_id`).change(function(){
            const service_category_id = $(this).val();
            getServiceSubCategories(service_category_id)
        });

        function getServiceSubCategories(service_category_id){
            $.ajax({
                url:"{{ route('manage-services.list-service.get_sub_services') }}",
                method:"POST",
                data:{service_category_id,_token},
                success:function(res){
                    console.log(res)
                    $(`#service_sub_category_id`).html(res);
                },error:function(xhr){
                    console.log(xhr.responseText)
                }
            });
        }


         //for add new staff
        $('#add_language').click(function(){
            const service_category_id = $(`#service_category_id`).val();
            const service_sub_category_id = $(`#service_sub_category_id`).val();
            const title_english = $(`#title_english_${input_id}`).val();
            const desc_english = $(`#description_english_${input_id}`).val();
            const hourly_charges = $(`#hourly_charges`).val();
            const daily_charges = $(`#daily_charges`).val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            var descriptions = $("textarea[name='descriptions[]']").map(function(){return $(this).val();}).get();
            var image = $('input[name="file-one"]').val();
            var question_val = $("input[name='question']:checked").val();
            const location_id = $(`#location_id`).val();

            //applying validations here
            if(service_category_id == ""){
                return $('#service_category_id_error').html('Please select service category');
            }else if(service_sub_category_id == ""){
                $('#service_category_id_error').html('');
                return $('#service_sub_category_id_error').html('Please select service sub category');
            }else if(!title_english || !$.trim(title_english).length){
                $('#type_id_error').html("");
                $('#service_category_id_error').html('');
                $('#service_sub_category_id_error').html('');
                $('#title_english_error').html("The name field is required.");
                hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $(`#title_english_${input_id}`).focus();
            }else if(title_english.length < 3){
                hideInputs();
                $('#type_id_error').html("");
                $('#service_category_id_error').html('');
                $('#service_sub_category_id_error').html('');
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                $('#title_english_error').html("The name field must be at least 3 character.");
                return $(`#title_english_${input_id}`).focus();
            }else if(daily_charges == "" || daily_charges <= 0){
                $('#type_id_error').html("");
                $('#service_category_id_error').html('');
                $('#service_sub_category_id_error').html('');
                $('#title_english_error').html("");
                return $('#daily_charges_error').html('Daily Charges Should be greater than 0');
            }else if(hourly_charges == "" || hourly_charges <= 0){
                $('#type_id_error').html("");
                $('#service_category_id_error').html('');
                $('#service_sub_category_id_error').html('');
                $('#daily_charges_error').html('');
                $('#title_english_error').html("");
                return $('#hourly_charges_error').html('Hourly Charges Should be greater than 0');
            }else if(location_id == ""){
                $('#type_id_error').html("");
                $('#service_category_id_error').html('');
                $('#service_sub_category_id_error').html('');
                $('#daily_charges_error').html('');
                $('#title_english_error').html("");
                $('#hourly_charges_error').html('');
                return $('#location_id_error').html('Please select location.');
            }else if(!image){
                $('#type_id_error').html("");
                $('#location_id_error').html("");
                $('#service_category_id_error').html('');
                $('#service_sub_category_id_error').html('');
                $('#daily_charges_error').html('');
                $('#hourly_charges_error').html('');
                $('#title_english_error').html("");
                return $('#image_one_error').html("The Image field is required.");
            }else{
                $('#location_id_error').html("");
                $('#service_category_id_error').html('');
                $('#service_sub_category_id_error').html('');
                $('#daily_charges_error').html('');
                $('#hourly_charges_error').html('');
                $('#title_english_error').html("");
                image = document.getElementById('fileupload-btn-one').files[0];
                var formData = new FormData();
                formData.append('service_category_id',service_category_id);
                formData.append('service_sub_category_id',service_sub_category_id);
                formData.append('title_english',title_english);
                formData.append('daily_charges',daily_charges);
                formData.append('hourly_charges',hourly_charges);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('location_id',location_id);
                formData.append('desc_english',desc_english);
                formData.append('descriptions',descriptions);
                formData.append('image',image);
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('manage-services.list-service.create-process') }}",
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
                            ToastSuccess("Service Listed Successfully");
                            window.location.reload();
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
