

@include('properties.list-properties.js.mapbox')

<script>
    $(document).ready(function(){
        //for add new feature
         @include('messages.jquery-messages')
         @include('properties.list-properties.js.parameters');

         $("#file-1").fileinput({
        theme: 'fas',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg', 'PNG'],
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

        //Function for fetch Amenities Data
        fetchAmenities();
        function fetchAmenities()
        {
            $.ajax({
                url:"{{ route('property.fetch-amenities') }}",
                method:"GET",
                success:function(res){
                    var amenities = ``;

                    res.map(item => {
                        amenities += `
                        <span class='col-md-4'>
                            <input name="amenities[]" value="${item.id}" style="cursor: pointer;" type="checkbox" id="${item.name}" class="chk-col-green">
                        <label for="${item.name}" style="min-width:227px;cursor: pointer;">${item.name}</label></span>
                        `;
                    });

                    $('#amenitesDataDiv').html(amenities);
                },error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        }

        //Getting Features Data
        fetchFeatures();
        function fetchFeatures()
        {
            $.ajax({
                url:"{{ route('property.fetch-features') }}",
                method:"GET",
                success:function(res){
                    var features = ``;

                    res.map(item => {
                        features += `
                        <span class='col-md-4'><input name="features[]" value="${item.id}" style="cursor: pointer;" type="checkbox" id="${item.name}_${item.id}" class="chk-col-green">
                        <label for="${item.name}_${item.id}" style="min-width:227px;cursor: pointer;">${item.name}</label></span>
                        `;
                    });

                    $('#featuresDataDiv').html(features);
                },error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        }


        //Showing Multi Languages Div As Per Language Change Button Clicked
        $('body').delegate('#btn_lang','click',function()
        {
            var id = $(this).attr('data-id');
            $(this).attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
            hideInputs();

            $(`#div_${id}`).attr('class', 'col-md-8 mb-3');
            $(`#div_${id} input`).focus();
            $(`#description_div_${id}`).attr('class', 'col-md-12 col-lg-12 col-sm-12 mb-3');
            $(`#description_div_${id} input`).focus();
            if(id != 1)
            {
                $(`#address_div_${id}`).attr('class', 'col-md-8 col-lg-8 col-sm-12 mb-3');
                $('#mapbox_search_div').attr('class', 'col-md-8 col-lg-8 col-sm-12 mb-3 d-none');
            }
            else
            {
                $('#mapbox_search_div').attr('class', 'col-md-8 col-lg-8 col-sm-12 mb-3');
                $(`#address_div_${id}`).attr('class', 'col-md-8 col-lg-8 col-sm-12 mb-3 d-none');

            }


            $(this).attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');

        });

        //Hiding all the multi languages Inputs & textareas
        function hideInputs()
        {
            $('input[name="title_english[]"]').map(function(){
                $(this).parent().attr('class', 'd-none');
            });

            $('input[name="addresses[]"]').map(function(){
                $(this).parent().attr('class', 'd-none');
            });

            $('textarea[name="description[]"]').map(function(){
                $(this).parent().attr('class', 'd-none');
            });

            $('.btn_lang').map(function(){
                $(this).attr('class', 'btn btn_lang mt-3');
            });

        }

        //Getting Areas as Per City
        $('#state_id, #prop_location_state_id').change(function(){
            const state_id = $(this).val();

            $.ajax({
                url:"{{ route('get.areas') }}",
                method:"POST",
                data:{state_id,_token},
                success:function(res)
                {
                    $('#area_id').html(res);
                    $('#prop_location_area_id').html(res);
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });

        });

        //Getting Locations by area
        $('#area_id, #prop_location_state_id').change(function(){
            loadPropertyLocations();
        });


         MakeMenuActive('#c_properties_1', '#amenities', '#cms_anchor');

        //TODO: Showing Rent Frequency
        $('#type_id').change(function(){
            const type = $('#type_id :selected').text();
            const id = $('#type_id :selected').val();

            if(type == "Rent" || type == "rent")
            {
                $('#frequent').attr('class', 'col-md-6 col-lg-6 col-sm-12 mb-3');
                $('#property_status_div').attr('class', 'col-md-3 col-lg-3 col-sm-12 mb-3');
            }
            else
            {
                $('#frequent').attr('class', 'col-md-6 col-lg-6 col-sm-12 mb-3 d-none');
                $('#property_status_div').attr('class', 'col-md-3 col-lg-3 col-sm-12 mb-3 d-none');
            }

            $('#bed_div').attr('class' , 'col-md-3 col-lg-3 col-sm-12 mb-3');
            $('#bath_div').attr('class' , 'col-md-3 col-lg-3 col-sm-12 mb-3');


            //TODO: Getting Property Categories
            loadPropertyStatus();
            loadPropertyCategories();
            loadPropertyParentCategories();
            });
        let has_bed = '';
        let has_bath = '';
        //TODO: Getting Category Data
        $('#category_id').change(function(){
            const id = $(this).val();

            $.ajax({
                url:"{{ route('get.category-data') }}",
                method:"POST",
                data:{id,_token},
                success:function(res)
                {
                    has_bed = res.has_bed;
                    has_bath = res.has_bath;

                    if(has_bed == 1)
                    {
                        $('#bed_div').attr('class' , 'col-md-3 col-lg-3 col-sm-12 mb-3');
                    }
                    else
                    {
                        $('#bed_div').attr('class' , 'col-md-3 col-lg-3 col-sm-12 mb-3 d-none');
                    }

                    if(has_bath == 1)
                    {
                        $('#bath_div').attr('class' , 'col-md-3 col-lg-3 col-sm-12 mb-3');
                    }
                    else
                    {
                        $('#bath_div').attr('class' , 'col-md-3 col-lg-3 col-sm-12 mb-3 d-none');
                    }

                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });

        });


        //Creating New Property
        $('#create_property').click(function(){
            //TODO: Intializing Variable
            const title_english = $(`#title_english_${input_id}`).val();
            const languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            const titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            const permit_no = $(`#permit_no`).val();
            const property_type_id = $(`#type_id`).val();
            const property_category_id = $(`#category_id`).val();
            const price = $(`#price`).val();
            const size_sqft = $(`#size_sqft`).val();
            const size_sqmt = $(`#size_sqmt`).val();
            const rent_frequency = $(`#rent_frequency`).val();
            const bed_no = $(`#bed_no`).val();
            const bath_no = $(`#bath_no`).val();
            const view_id = $(`#view_id`).val();
            const developer_id = $(`#developer_id`).val();
            const agent_id = $(`#agent_id`).val();
            const expire_after = $(`#expire_after`).val();
            const amenities = $(`input[name="amenities"]:checked`).map(amenity => {
                return $(this).val();
            }).get();
            const features = $(`input[name="features"]:checked`).map(feature => {
                return $(this).val();
            }).get();
            const description = $(`#description_${input_id}`).html();
            const descriptions = $("textarea[name='descriptions[]']").map(function(){return $(this).val();}).get();
            const state_id = $(`#state_id`).val();
            const area_id = $(`#area_id`).val();
            const location_id = $(`#location_id`).val();
            const address = $(`.mapboxgl-ctrl-geocoder--input`).val();
            const addresses = $(`input[name="addresses[]"]`).map(function(){return $(this).val();}).get();
            const long = longitude;
            const lat = latitude;
            const image = $(`#file-1`)[0].files[0];
            const images = $(`#file-1`)[0].files;
            const youtube_link = $('#youtube_link').val();
            const video_link = $('#video_link').val();
            return console.log(`desc: ${description}`);
            //applying validations here
             if(!$.trim(title_english).length){
                 $('#title_english_error').html("The property title field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-8 mb-3');
                 return $(`#title_english_${input_id}`).focus()
            }else if(title_english.length < 5){
                hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-8 mb-3');
                $('#title_english_error').html("The property title field must be at least 5 character.");
                return $(`#title_english_${input_id}`).focus();
            }else if(property_type_id == ""){
                 $('#title_english_error').html("");
                 return $('#type_id_error').html("Please select a property type.");
            }else if(property_category_id == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 return $('#category_id_error').html("Please select a property category.");
            }else if(price == "" || price <= 0){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 return $('#price_id_error').html("Please add a valid price.");
            }else if(size_sqft == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 return $('#size_sqft_error').html("Please select property size in sqft.");
            }else if(size_sqmt == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 return $('#size_sqmt_error').html("Please select property size in sqmt.");
            }else if(property_type_id == 2 && rent_frequeny == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 $('#size_sqmt_error').html("");
                 return $('#size_sqmt_error').html("Please select Rent Frequency.");
            }else if(has_bed == 1 && bed_no == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 return $('#bed_no_error').html("Please select bedroom no.");
            }else if(has_bath == 1 && bath_no == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 return $('#bath_no_error').html("Please select bathroom no.");
            }else if(view_id == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 $('#bath_no_error').html("");
                 return $('#view_id_error').html("Please select views.");
            }else if(developer_id == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 $('#bath_no_error').html("");
                 $('#view_id_error').html("");
                 return $('#developer_id_error').html("Please select developer.");
            }else if(agent_id == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 $('#bath_no_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 return $('#agent_id_error').html("Please select agent.");
            // }
            // else if(amenities == ""){
            //      $('#title_english_error').html("");
            //      $('#type_id_error').html("");
            //      $('#category_id_error').html("");
            //      $('#price_id_error').html("");
            //      $('#size_sqft_error').html(".");
            //      $('#size_sqmt_error').html("");
            //      $('#size_sqmt_error').html("");
            //      $('#bed_no_error').html("");
            //      $('#bath_no_error').html("");
            //      $('#view_id_error').html("");
            //      $('#developer_id_error').html("");
            //      $('#agent_id_error').html("");
            //      return Message("Violation", "Please select amenities.", "red");
            // }else if(features == ""){
            //      $('#title_english_error').html("");
            //      $('#type_id_error').html("");
            //      $('#category_id_error').html("");
            //      $('#price_id_error').html("");
            //      $('#size_sqft_error').html(".");
            //      $('#size_sqmt_error').html("");
            //      $('#size_sqmt_error').html("");
            //      $('#bed_no_error').html("");
            //      $('#bath_no_error').html("");
            //      $('#view_id_error').html("");
            //      $('#developer_id_error').html("");
            //      $('#agent_id_error').html("");
            //      return Message("Violation", "Please select features.", "red");
            }else if(state_id == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 $('#bath_no_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#agent_id_error').html("");
                 return $('#state_id_error').html("Please select a city.");
            }else if(area_id == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 $('#bath_no_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#agent_id_error').html("");
                 $('#state_id_error').html("");
                 return $('#area_id_error').html("Please select an area.");
            }else if(location_id == ""){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 $('#bath_no_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#agent_id_error').html("");
                 $('#state_id_error').html("");
                 $('#area_id_error').html("");
                 return $('#location_id_error').html("Please select a location.");
            }else if(!$.trim(address).length){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html(".");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 $('#bath_no_error').html("");
                 $('#view_id_error').html("");
                 $('#agent_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#state_id_error').html("");
                 $('#location_id_error').html("");
                 $('#address_error').html("The property map location field is required.");
                 return $(`.mapboxgl-ctrl-geocoder--input`).focus();
            }else if(!image){
                 $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 $('#bath_no_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#agent_id_error').html("");
                 $('#state_id_error').html("");
                 $('#location_id_error').html("");
                 $('#address_error').html("");
                 return $('#base_images_error').html("The select property images.");
            }else{
                $('#title_english_error').html("");
                 $('#type_id_error').html("");
                 $('#category_id_error').html("");
                 $('#price_id_error').html("");
                 $('#size_sqft_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#size_sqmt_error').html("");
                 $('#bed_no_error').html("");
                 $('#bath_no_error').html("");
                 $('#view_id_error').html("");
                 $('#developer_id_error').html("");
                 $('#agent_id_error').html("");
                 $('#state_id_error').html("");
                 $('#address_error').html("");
                 $('#base_images_error').html("");
                 $('#location_id_error').html("");

                 const compact_price = $('#price').val()
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var formData = new FormData();
                formData.append('title_english',title_english);
                formData.append('titles',titles);
                formData.append('languages_names',languages);
                formData.append('permit_no',permit_no);
                formData.append('property_type_id',property_type_id);
                formData.append('property_category_id',property_category_id);
                formData.append('price',price);
                formData.append('compact_price',compact_price);
                formData.append('size_sqft',size_sqft);
                formData.append('size_sqmt',size_sqmt);
                formData.append('rent_frequency',rent_frequency);
                formData.append('bed_no',bed_no);
                formData.append('bath_no',bath_no);
                formData.append('views',view_id);
                formData.append('developer_id',developer_id);
                formData.append('agent_id',agent_id);
                formData.append('amenities',amenities);
                formData.append('features',features);
                formData.append('description',description);
                formData.append('descriptions',descriptions);
                formData.append('state_id',state_id);
                formData.append('area_id',area_id);
                formData.append('location_id',location_id);
                formData.append('address',address);
                formData.append('addresses',addresses);
                formData.append('long',long);
                formData.append('lat',lat);
                formData.append('expire_after',expire_after);
                formData.append('youtube_link',youtube_link);
                formData.append('video_link',video_link);
                for(var count = 0; count<images.length; count++){
                    formData.append("images[]", images[count]);
                }
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('manage-properties.property.create-process') }}",
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
                       if(res == "true"){
                         $('input[name="title_english[]"]').map(function(){
                            $(this).val('');
                        });
                        $(`#permit_no`).val('');
                        $(`#type_id`).val('');
                        $(`#category_id`).val('');
                        $(`#price`).val('');
                        $(`#size_sqft`).val('');
                        $(`#size_sqmt`).val('');
                        $(`#rent_frequency`).val('');
                        $(`#bed_no`).val('');
                        $(`#bath_no`).val('');
                        $(`#view_id`).val('');
                        $(`#developer_id`).val('');
                        $(`#agent_id`).val('');
                        $(`#expire_after`).val('');
                        $(`#description_${input_id}`).val('');
                        $("textarea[name='descriptions[]']").map(function(){ $(this).val('');}).get();
                        $(`#state_id`).val('');
                        $(`#area_id`).val('');
                        $(`.mapboxgl-ctrl-geocoder--input`).val('');
                        $(`input[name="addresses[]"]`).map(function(){ $(this).val('');}).get();
                        $('#youtube_link').val('');
                        $('#video_link').val('');
                        ToastSuccess("Property Listed Successfully");
                       }

                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });


            }
        });

    });
</script>
