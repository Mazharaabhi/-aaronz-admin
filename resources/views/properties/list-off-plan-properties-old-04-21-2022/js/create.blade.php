
@include('properties.list-properties.js.edit-map-new-file')
<script>
    $(document).ready(function(){
        //for add new feature
         @include('messages.jquery-messages')
         @include('properties.list-properties.js.parameters');

        $("#file-1").fileinput({
        theme: 'fas',
        uploadUrl: false, // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg', 'PNG', 'webp'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
          }
        });

        //Getting Base Language(Englihs) id
        var input_id = "{{ $languages[0]->id }}";


        //Hiding all the multi languages Inputs & textareas
        function hideInputs()
        {
            $('input[name="title_english[]"]').map(function(){
                $(this).parent().attr('class', 'd-none');
            });

            $('textarea[name="descriptions_1"]').map(function(){
              $(this).parent().attr('class', 'd-none');
             });

            $('textarea[name="descriptions_2"]').map(function(){
                $(this).parent().attr('class', 'd-none');
            });

            $('.btn_lang').map(function(){
                $(this).attr('class', 'btn btn_lang mt-3');
            });

        }

        MakeMenuActive('#c_properties_1', '#amenities', '#cms_anchor');


        //Creating New Property
        $('#create_property').click(function(){
            //TODO: Intializing Variable
            const title_english = $(`#title_english_${input_id}`).val();
            const languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            const titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            const is_commercial = $('#is_commercial').val();
            const off_plan_release_time = $(`#off_plan_release_time`).val();
            const property_type_id = $(`#type_id`).val();
            const property_category_id = $(`#category_id`).val();
            const property_status_id = $(`#property_status_id`).val();
            const meta_title = $(`#meta_title`).val();
            const meta_description = $(`#meta_description`).val();
            const developer_id = $(`#developer_id`).val();
            const agent_id = $(`#agent_id`).val();
            const image = $(`#file-1`)[0].files[0];
            // const images = $(`#file-1`)[0].files;
            var images =  $('#file-1').fileinput('getFileList');
            const project_name = $(`#project_name`).val();
            const street_name = $(`#street_name`).val();
            const street_no = $(`#street_no`).val();
            const unit_no = $(`#unit_no`).val();
            const expire_date = $(`#expiry_date`).val();
            const off_plan_url = $(`#off_plan_url`).val();
            const address_id = $('select[id="location_id"] :selected').val();
            //applying validations here
            if(property_category_id == ""){
                 return $('#category_id_error').html("Please select a property category.");
            }
            else if(agent_id == ""){
                 $('#category_id_error').html("");
                 $('#size_sqft_error').html("");
                 $('#property_tenure_error').html("");
                 $('#occupacy_id_error').html("");
                 $('#availablity_id_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 return $('#agent_id_error').html("Please select agent.");
            }
            else if(!$.trim(title_english).length){
                $('#category_id_error').html("");
                 $('#size_sqft_error').html("");
                 $('#property_tenure_error').html("");
                 $('#occupacy_id_error').html("");
                 $('#availablity_id_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#agent_id_error').html("");
                 $('#price_error').html("");
                 $('#year_price_error').html("");
                 $('#month_price_error').html("");
                 $('#week_price_error').html("");
                 $('#day_price_error').html("");
                 $('#title_english_error').html("The property title field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-8 mb-3');
                 return $(`#title_english_${input_id}`).focus();
            }else if(title_english.length < 5){
                hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-8 mb-3');
                $('#category_id_error').html("");
                 $('#size_sqft_error').html("");
                 $('#property_tenure_error').html("");
                 $('#occupacy_id_error').html("");
                 $('#availablity_id_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#agent_id_error').html("");
                 $('#price_error').html("");
                 $('#year_price_error').html("");
                 $('#month_price_error').html("");
                 $('#week_price_error').html("");
                 $('#day_price_error').html("");
                $('#title_english_error').html("The property title field must be at least 5 character.");
                return $(`#title_english_${input_id}`).focus();
            }else if(address_id == ""){
                $('#category_id_error').html("");
                 $('#size_sqft_error').html("");
                 $('#property_tenure_error').html("");
                 $('#occupacy_id_error').html("");
                 $('#availablity_id_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#agent_id_error').html("");
                 $('#price_error').html("");
                 $('#year_price_error').html("");
                 $('#month_price_error').html("");
                 $('#week_price_error').html("");
                 $('#day_price_error').html("");
                 $('#title_english_error').html("");
                 $('#location_id_error').html('Please select property location');
                 return $(`#project_name`).focus();
            }
            else if(!image){
                $('#category_id_error').html("");
                 $('#size_sqft_error').html("");
                 $('#property_tenure_error').html("");
                 $('#occupacy_id_error').html("");
                 $('#availablity_id_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#agent_id_error').html("");
                 $('#price_error').html("");
                 $('#year_price_error').html("");
                 $('#month_price_error').html("");
                 $('#week_price_error').html("");
                 $('#day_price_error').html("");
                 $('#title_english_error').html("");
                 $('#location_id_error').html('');
                 return $('#base_images_error').html("The select property images.");
            }
           else{
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_error').html("");
                 $('#size_sqft_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 $('#bath_no_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#agent_id_error').html("");
                 $('#base_images_error').html("");
                 //***MAKING ARRAY OF DESC START HERE****//
                    var descriptions=[];
                    var desc_id="";
                    for(var i=0;i<languages.length;i++){
                        var desc_id = "descriptions_"+languages[i];
                        data = CKEDITOR.instances[desc_id].getData();
                        descriptions.push(data);
                    }
                //***MAKING ARRAY OF DESC START HERE****//
                var formData = new FormData();
                formData.append('title_english',title_english);
                formData.append('titles',titles);
                formData.append('languages_names',languages);
                formData.append('off_plan_release_time',off_plan_release_time);
                formData.append('property_status_id', property_status_id);
                formData.append('property_type_id',property_type_id);
                formData.append('property_category_id',property_category_id);
                formData.append('property_status_id',property_status_id);
                formData.append('project_name',project_name);
                formData.append('street_name',street_name);
                formData.append('street_no',street_no);
                formData.append('lat',lat);
                formData.append('lng',lng);
                formData.append('meta_title',meta_title);
                formData.append('meta_description',meta_description);
                formData.append('developer_id',developer_id);
                formData.append('agent_id',agent_id);
                formData.append('expire_date',expire_date);
                formData.append('off_plan_url',off_plan_url);
                formData.append('address_id',address_id);

                for(var i = 0; i<images.length; i++){
                    formData.append("images[]", images[i]);
                }
                for(var count = 0; count<descriptions.length; count++){
                    formData.append("descriptions[]", descriptions[count]);
                }
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('offplan.property.create-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#create_property').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#create_property').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#create_property').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#create_property').html(`${save_icon} List New Property`);
                        $('#create_property').attr('class',`${btn_cherwell } btn-block`);
                        $('#create_property').removeAttr('disabled');
                    },
                     success:function(res){
                         console.log(res);
                       if(res == "true"){
                        ToastSuccess("Off Plan Property Created Successfully");
                         $('input[name="title_english[]"]').map(function(){
                            $(this).val('');
                        });
                        window.location.reload();
                       }

                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });


            }
        });

        //SHOW HIDE SIGNATURE BOX START HERE//
        $('#is_signature').change(function(){
           if(($(this).is(':checked'))){
               $('#signature-box').attr('class','d-block');
           }else{
              $('#signature-box').attr('class','d-none');
           }
        });
        //SHOW HIDE SIGNATURE BOX END HERE//
    });
</script>
