@include('properties.list-properties.js.edit-map-new-file')
<script>
    $(document).ready(function() {

        //for add new feature
        @include('messages.jquery-messages')
        @include('properties.list-properties.js.parameters')
        $('#property_status_id').change(function (){
            if($(this).val() == 13){
                $('#offplan_info').attr('class','d-block')
            }else{
                $('#offplan_info').attr('class','d-none')
            }
        });
        $("#file-1").fileinput({
            theme: 'fas',
            uploadUrl: '#', // you must set a valid URL here else you will get an error
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg', 'PNG', 'webp'],
            overwriteInitial: false,
            maxFilesNum: 10,
            //allowedFileTypes: ['image', 'video', 'flash'],
            slugCallback: function(filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });

        //Getting Base Language(Englihs) id
        var input_id = "{{ $languages[0]->id }}";

        //** Signature Sale and Rent according to property type **//
        $('#type_id').change(function (){
            if($(this).val() == 1) {
                $('#signature_type').html(`Signature Sale`);
            }else if($(this).val() == 3){
                $('#signature_type').html(`Signature Rent`);
            }
        });

        //for image preview
        function readURL3D(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah-3d').attr('src', e.target.result);
                    $('#blah-3d').attr('class', 'd-block')
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#fileupload-3d").change(function() {
            readURL3D(this);
        });

        //for image preview
        function readURL2D(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah-2d').attr('src', e.target.result);
                    $('#blah-2d').attr('class', 'd-block')
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#fileupload-2d").change(function() {
            readURL2D(this);
        });

        //for image preview SECTION TWO
        function signatureImageSectionTWo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah_signature_section_two_image').attr('src', e.target.result);
                    $('#blah_signature_section_two_image').attr('class', 'd-block')
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#signature_section_two_image").change(function() {
            signatureImageSectionTWo(this);
        });

        //for image preview SECTION THREE
        function signatureImageSectionThree(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah_signature_section_three_image').attr('src', e.target.result);
                    $('#blah_signature_section_three_image').attr('class', 'd-block')
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#signature_section_three_image").change(function() {
            signatureImageSectionThree(this);
        });

        //Function for fetch Amenities Data
        fetchAmenities();

        function fetchAmenities() {
            $.ajax({
                url: "{{ route('property.fetch-amenities') }}",
                method: "GET",
                success: function(res) {
                    $('#amenitesDataDiv').html(res);
                    const amenities = @json($property_amenities);
                    $('input[name="amenities"]').map(function() {
                        for (var i = 0; i < amenities.length; i++) {
                            if ($(this).val() == amenities[i]) {
                                $(this).attr('checked', true);
                            }
                        }
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        //Getting Features Data
        fetchFeatures();

        function fetchFeatures() {
            $.ajax({
                url: "{{ route('property.fetch-features') }}",
                method: "GET",
                success: function(res) {
                    $('#featuresDataDiv').html(res);
                    const features = @json($property_features);
                    $('input[name="features"]').map(function() {
                        for (var i = 0; i < features.length; i++) {
                            if ($(this).val() == features[i]) {
                                $(this).attr('checked', true);
                            }
                        }
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }


        //Showing Multi Languages Div As Per Language Change Button Clicked
        $('body').delegate('#btn_lang', 'click', function() {
            var id = $(this).attr('data-id');
            $(this).attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
            hideInputs();

            $(`#div_${id}`).attr('class', 'col-md-8 mb-3');
            $(`#div_${id} input`).focus();
            $(`#description_div_${id}`).attr('class', 'col-md-12 col-lg-12 col-sm-12 mb-3');
            $(`#description_div_${id} input`).focus();
            if (id != 1) {
                $(`#address_div_${id}`).attr('class', 'col-md-8 col-lg-8 col-sm-12 mb-3');
                $('#mapbox_search_div').attr('class', 'col-md-8 col-lg-8 col-sm-12 mb-3 d-none');
            } else {
                $('#mapbox_search_div').attr('class', 'col-md-8 col-lg-8 col-sm-12 mb-3');
                $(`#address_div_${id}`).attr('class', 'col-md-8 col-lg-8 col-sm-12 mb-3 d-none');

            }


            $(this).attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');

        });

        //Hiding all the multi languages Inputs & textareas
        function hideInputs() {
            $('input[name="title_english[]"]').map(function() {
                $(this).parent().attr('class', 'd-none');
            });

            $('input[name="addresses[]"]').map(function() {
                $(this).parent().attr('class', 'd-none');
            });

            $('textarea[name="descriptions_1"]').map(function() {
                $(this).parent().attr('class', 'd-none');
            });

            $('textarea[name="descriptions_2"]').map(function() {
                $(this).parent().attr('class', 'd-none');
            });

            $('.btn_lang').map(function() {
                $(this).attr('class', 'btn btn_lang mt-3');
            });

        }

        MakeMenuActive('#c_properties_1', '#amenities', '#cms_anchor');

        const prop_type = "{{ $propertyData[0]->property_type_id }}";
        if (prop_type == 3) {
            // $('#frequent').attr('class', 'col-md-4 col-lg-4 col-sm-12 mb-3');
            $('#sale_price_div').attr('class', 'd-none');
            $('#rent_price_div').attr('class', 'row');
            $('#property_status_div').attr('class', 'col-md-4 col-lg-4 col-sm-12 mb-3 d-none');
        } else {
            // $('#frequent').attr('class', 'col-md-4 col-lg-4 col-sm-12 mb-3 d-none');
            $('#sale_price_div').attr('class', 'row');
            $('#rent_price_div').attr('class', 'd-none');
            $('#property_status_div').attr('class', 'col-md-4 col-lg-4 col-sm-12 mb-3');
        }


        //TODO: Showing Rent Frequency
        $('#type_id').change(function() {
            const type = $('#type_id :selected').text();
            const id = $('#type_id :selected').val();

            if (type == "Rent" || type == "rent") {
                // $('#frequent').attr('class', 'col-md-4 col-lg-4 col-sm-12 mb-3');
                $('#sale_price_div').attr('class', 'd-none');
                $('#rent_price_div').attr('class', 'row');
                $('#property_status_div').attr('class', 'col-md-4 col-lg-4 col-sm-12 mb-3 d-none');
            } else {
                // $('#frequent').attr('class', 'col-md-4 col-lg-4 col-sm-12 mb-3 d-none');
                $('#sale_price_div').attr('class', 'row');
                $('#rent_price_div').attr('class', 'd-none');
                $('#property_status_div').attr('class', 'col-md-4 col-lg-4 col-sm-12 mb-3');
            }

            $('#bed_div').attr('class', 'col-md-4 col-lg-4 col-sm-12 mb-3');
            $('#bath_div').attr('class', 'col-md-4 col-lg-4 col-sm-12 mb-3');

        });
        let has_bed = '';
        let has_bath = '';
        $.ajax({
            url: "{{ route('get.category-data') }}",
            method: "POST",
            data: {
                id: "{{ $propertyData[0]->property_category_id }}",
                _token
            },
            success: function(res) {
                const array = [1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14];
                res.map((item, index) => {
                    if (item === array[index]) {
                        $(`#include_${item}`).attr('class',
                            'col-md-4 col-lg-4 col-sm-12 mb-3');
                    } else if (item != array[index]) {
                        $(`#include_${array[index]}`).attr('class',
                            'col-md-4 col-lg-4 col-sm-12 mb-3 d-none');
                    }
                });

            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
        //TODO: Getting Category Data
        $('#category_id').change(function() {
            const id = $(this).val();

            $.ajax({
                url: "{{ route('get.category-data') }}",
                method: "POST",
                data: {
                    id,
                    _token
                },
                success: function(res) {
                    const array = [1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14];
                    res.map((item, index) => {
                        if (item === array[index]) {
                            $(`#include_${item}`).attr('class',
                                'col-md-4 col-lg-4 col-sm-12 mb-3');
                        } else if (item != array[index]) {
                            $(`#include_${array[index]}`).attr('class',
                                'col-md-4 col-lg-4 col-sm-12 mb-3 d-none');
                        }
                    });

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });

        });
        //Creating New Property
        $('#create_property').click(function() {
           //  console.log('Hello');
            //TODO: Intializing Variable
            const title_english = $(`#title_english_${input_id}`).val();
            const languages = $("input[name='languages[]']").map(function() {
                return $(this).val();
            }).get();
            const titles = $("input[name='title_english[]']").map(function() {
                return $(this).val();
            }).get();
            const is_commercial = $('#is_commercial').val();
            const furnished_type = $('#furnished_type').val();
            const renovation_type = $('#renovation_type').val();
            const build_year = $('#build_year').val();
            const parking_no = $('#parking_no').val();
            const plot_no = $('#plot_no').val();
            const build_up_area = $('#build_up_area').val();
            const building_floor = $('#building_floor').val();
            const floor_no = $('#floor_no').val();
            const meta_title = $(`#meta_title`).val();
            const meta_description = $(`#meta_description`).val();
            const property_tenure = $('#property_tenure').val();
            const occupacy_id = $('#occupacy_id').val();
            const availablity = $('#availablity_id').val();
            const layout_type = $('#layout_type').val();
            const dewa_no = $('#dewa_no').val();
            const price_on_application = $("input[name='price_on_application']:checked").val();
            let is_verified = $("input[name='is_verified']:checked").val();
            is_verified = is_verified === undefined ? 0 : 1;
            let is_boost = $("input[name='is_boost']:checked").val();
            is_boost = is_boost === undefined ? 0 : 1;
            let is_featured = $("input[name='is_featured']:checked").val();
            is_featured = is_featured === undefined ? 0 : 1;

            let is_hot = $("input[name='is_hot']:checked").val();
            is_hot = is_hot === undefined ? 0 : 1;
            let is_signature = $("input[name='is_signature']:checked").val();
            is_signature = is_signature === undefined ? 0 : 1;
            let is_basic = $("input[name='is_signature']:checked").val();
            is_basic = is_basic === undefined ? 0 : 1;

            const service_charges = $('#service_charges').val();
            const financial_status = $('#financial_status').val();
            const permit_no = $(`#permit_no`).val();
            const property_type_id = $(`#type_id`).val();
            const property_category_id = $(`#category_id`).val();
            let property_status_id = $(`#property_status_id`).val();
            // console.log(property_status_id)
            property_status_id = property_status_id != null ? property_status_id : 0;
            //console.log(property_status_id)

            const price = $(`#price`).val();
            const year_price = $(`#year_price`).val();
            const month_price = $(`#month_price`).val();
            const day_price = $(`#day_price`).val();
            const week_price = $(`#week_price`).val();
            const size_sqft = $(`#size`).val();
            const bed_no = $(`#bed_no`).val();
            const bath_no = $(`#bath_no`).val();
            const view_id = $(`#view_id`).val();
            const xml_portal = $(`#xml_portal`).val();
            const garage = $(`#garage`).val();
            const garage_size = $(`#garage_size`).val();
            const developer_id = $(`#developer_id`).val();
            const agent_id = $(`#agent_id`).val();
            const expire_after = $(`#expire_after`).val();
            // *** off plan information **//
            const off_plan_heading = $(`#off_plan_heading`).val();
            const off_plan_description = $(`#off_plan_description`).val();
            const off_plan_overview = $(`#off_plan_overview`).val();
            const off_plan_title_one = $(`#off_plan_title_one`).val();
            const off_plan_title_two = $(`#off_plan_title_two`).val();
            const off_plan_omniyat_desc = $(`#off_plan_omniyat_desc`).val();
            const off_plan_request_more_heading = $(`#off_plan_request_more_heading`).val();
            const one_bed = $(`#one_bed`).val();
            const two_bed = $(`#two_bed`).val();
            const three_bed = $(`#three_bed`).val();
            const four_bed = $(`#four_bed`).val();
            const studio = $(`#studio`).val();
            const down_payment = $(`#down_payment`).val();
            const during_construction = $(`#during_construction`).val();
            const post_handover  = $(`#post_handover`).val();
            var amenities = [];
            $.each($("input[name='amenities']:checked"), function() {
                amenities.push($(this).val());
            });
            var features = [];
            $.each($("input[name='features']:checked"), function() {
                features.push($(this).val());
            });
            // const description = $(`#description_${input_id}`).val();
            // const descriptions = $("textarea[name='descriptions[]']").map(function(){return $(this).val();}).get();
            const project_name = $(`#project_name`).val();
            const street_name = $(`#street_name`).val();
            const street_no = $(`#street_no`).val();
            const unit_no = $(`#unit_no`).val();
            const image = $(`#file-1`)[0].files[0];
            // const images = $(`#file-1`)[0].files;
            const images = $('#file-1').fileinput('getFileList');
            const youtube_link = $('#youtube_link').val();
            const video_link = $('#video_link').val();
            const address_id = $('select[id="location_id"] :selected').val();
            const signature_title = $('#signature_title').val();
            const signature_desc = $('#signature_desc').val();
            const signature_section_two_title = $('#signature_section_two_title').val();
            const signature_section_two_desc = $('#signature_section_two_desc').val();
            const signature_section_three_title = $('#signature_section_three_title').val();
            const signature_section_three_desc = $('#signature_section_three_desc').val();
            //applying validations here
            if (property_category_id == "") {
                $('#category_id').focus();
                return $('#category_id_error').html("Please select a property category.");
            } else if (size_sqft == "") {
                $('#category_id_error').html("");
                $('#size').focus();
                return $('#size_sqft_error').html("Please select property size in sqft.");
            } else if (property_tenure == "") {
                $('#category_id_error').html("");
                $('#size_sqft_error').html("");
                $('#property_tenure').focus();
                return $('#property_tenure_error').html("Please select property tenure.");
            } else if (occupacy_id == "") {
                $('#category_id_error').html("");
                $('#size_sqft_error').html("");
                $('#property_tenure_error').html("");
                $('#occupacy_id').focus();
                return $('#occupacy_id_error').html("Please select property occupacy.");
            } else if (availablity == "") {
                $('#category_id_error').html("");
                $('#size_sqft_error').html("");
                $('#property_tenure_error').html("");
                $('#occupacy_id_error').html("");
                $('#availablity_id').focus();
                return $('#availablity_id_error').html("Please select property availability.");
            }
            // else if(view_id == ""){
            //      $('#category_id_error').html("");
            //      $('#size_sqft_error').html("");
            //      $('#property_tenure_error').html("");
            //      $('#occupacy_id_error').html("");
            //      $('#availablity_id_error').html("");
            //      return $('#view_id_error').html("Please select views.");
            // }
            // else if(developer_id == ""){
            //      $('#category_id_error').html("");
            //      $('#size_sqft_error').html("");
            //      $('#property_tenure_error').html("");
            //      $('#occupacy_id_error').html("");
            //      $('#availablity_id_error').html("");
            //      $('#view_id_error').html("");
            //      return $('#developer_id_error').html("Please select developer.");
            // }
            else if (agent_id == "") {
                $('#category_id_error').html("");
                $('#size_sqft_error').html("");
                $('#property_tenure_error').html("");
                $('#occupacy_id_error').html("");
                $('#availablity_id_error').html("");
                $('#view_id_error').html("");
                $('#developer_id_error').html("");
                $('#agent_id_error').html("Please select agent.");
                return $('#agent_id').focus();
            } else if (property_type_id == 1 && price == "" || property_type_id == 1 && price <= 0) {
                $('#category_id_error').html("");
                $('#size_sqft_error').html("");
                $('#property_tenure_error').html("");
                $('#occupacy_id_error').html("");
                $('#availablity_id_error').html("");
                $('#view_id_error').html("");
                $('#developer_id_error').html("");
                $('#agent_id_error').html("");
                $('#price_error').html("The price field is reuqired.");
                return $(`#price`).focus();
            } else if (property_type_id == 3 && year_price == "" || property_type_id == 3 &&
                year_price <= 0) {
                $('#category_id_error').html("");
                $('#size_sqft_error').html("");
                $('#property_tenure_error').html("");
                $('#occupacy_id_error').html("");
                $('#availablity_id_error').html("");
                $('#view_id_error').html("");
                $('#developer_id_error').html("");
                $('#agent_id_error').html("");
                $('#price_error').html("");
                $('#year_price_error').html("The year price field is reuqired.");
                return $(`#year_price`).focus();
            } else if (property_type_id == 3 && month_price == "" || property_type_id == 3 &&
                month_price <= 0) {
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
                $('#month_price_error').html("The month price field is reuqired.");
                return $(`#month_price`).focus();
            } else if (property_type_id == 3 && week_price == "" || property_type_id == 3 &&
                week_price <= 0) {
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
                $('#week_price_error').html("The week price field is reuqired.");
                return $(`#week_price`).focus();
            } else if (property_type_id == 3 && day_price == "" || property_type_id == 3 && day_price <=
                0) {
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
                $('#day_price_error').html("The day price field is reuqired.");
                return $(`#day_price`).focus();
            } else if (!$.trim(title_english).length) {
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
            } else if (title_english.length < 5) {
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
                $('#title_english_error').html(
                "The property title field must be at least 5 character.");
                return $(`#title_english_${input_id}`).focus();
            } else if (address_id == "") {
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
            } else {
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
                var descriptions = [];
                var desc_id = "";
                for (var i = 0; i < languages.length; i++) {
                    var desc_id = "descriptions_" + languages[i];
                    data = CKEDITOR.instances[desc_id].getData();
                    descriptions.push(data);
                }
                //***MAKING ARRAY OF DESC START HERE****//
                const two_d = document.getElementById('fileupload-2d').files[0];
                const three_d = document.getElementById('fileupload-3d').files[0];
                const signature_image = document.getElementById('signature-image').files[0];
                const signature_section_two_image = document.getElementById(
                    'signature_section_two_image').files[0];
                const signature_section_three_image = document.getElementById(
                    'signature_section_three_image').files[0];
                var broucher = document.getElementById('fileupload-broucher').files[0];
                var formData = new FormData();
                formData.append('id', "{{ $propertyData[0]->id }}");
                formData.append('title_english', title_english);
                formData.append('titles', titles);
                formData.append('languages_names', languages);
                formData.append('permit_no', permit_no);
                formData.append('two_d', two_d);
                formData.append('three_d', three_d);
                formData.append('broucher', broucher);
                formData.append('is_commercial', is_commercial);
                formData.append('furnished_type', furnished_type);
                formData.append('renovation_type', renovation_type);
                formData.append('build_year', build_year);
                formData.append('parking_no', parking_no);
                formData.append('property_status_id', property_status_id);
                formData.append('plot_no', plot_no);
                formData.append('build_up_area', build_up_area);
                formData.append('building_floor', building_floor);
                formData.append('floor_no', floor_no);
                formData.append('property_tenure', property_tenure);
                formData.append('occupacy_id', occupacy_id);
                formData.append('availablity', availablity);
                formData.append('layout_type', layout_type);
                formData.append('dewa_no', dewa_no);
                formData.append('is_from_map', is_from_map);
                formData.append('is_featured', is_featured);
                formData.append('is_verified', is_verified);
                formData.append('is_boost', is_boost);
                formData.append('is_hot', is_hot);
                formData.append('is_signature', is_signature);
                formData.append('signature_image', signature_image);
                formData.append('signature_title', signature_title);
                formData.append('signature_desc', signature_desc);
                formData.append('signature_section_two_image', signature_section_two_image);
                formData.append('signature_section_two_title', signature_section_two_title);
                formData.append('signature_section_two_desc', signature_section_two_desc);
                formData.append('signature_section_three_image', signature_section_three_image);
                formData.append('signature_section_three_title', signature_section_three_title);
                formData.append('signature_section_three_desc', signature_section_three_desc);
                //Off Plan SECTIONS START HERE//
                formData.append('off_plan_heading', off_plan_heading);
                formData.append('off_plan_desc', off_plan_description);
                formData.append('off_plan_overview', off_plan_overview);
                formData.append('off_plan_title_one', off_plan_title_one);
                formData.append('off_plan_title_two', off_plan_title_two);
                formData.append('off_plan_request_more_desc', off_plan_omniyat_desc);
                formData.append('off_plan_request_more_heading', off_plan_request_more_heading);
                formData.append('one_bed_floor_plan', one_bed);
                formData.append('two_bed_floor_plan', two_bed);
                formData.append('three_bed_floor_plan', three_bed);
                formData.append('four_bed_floor_plan', four_bed);
                formData.append('studio_floor_plan', studio);
                formData.append('off_plan_down_payment', down_payment);
                formData.append('off_plan_during_consurtion', during_construction);
                formData.append('off_plan_post_handover', post_handover);
                //Off Plan SECTIONS END HERE//
                formData.append('is_basic', is_basic);
                formData.append('address_id', address_id);
                formData.append('price_on_application', price_on_application);
                formData.append('service_charges', service_charges);
                formData.append('financial_status', financial_status);
                formData.append('property_type_id', property_type_id);
                formData.append('property_category_id', property_category_id);
                formData.append('garage', garage);
                formData.append('garage_size', garage_size);
                formData.append('price', price);
                formData.append('year_price', year_price);
                formData.append('month_price', month_price);
                formData.append('week_price', week_price);
                formData.append('day_price', day_price);
                formData.append('project_name', project_name);
                formData.append('street_name', street_name);
                formData.append('street_no', street_no);
                formData.append('unit_no', unit_no);
                formData.append('lat', g_lat);
                formData.append('lng', g_lng);
                formData.append('meta_title', meta_title);
                formData.append('meta_description', meta_description);
                formData.append('size_sqft', size_sqft);
                formData.append('views', view_id);
                formData.append('portals', xml_portal);
                formData.append('developer_id', developer_id);
                formData.append('agent_id', agent_id);
                formData.append('amenities', amenities);
                formData.append('features', features);
                formData.append('bed_no', bed_no);
                formData.append('bath_no', bath_no);
                // formData.append('description',description);
                // formData.append('descriptions',descriptions);
                formData.append('expire_after', expire_after);
                formData.append('youtube_link', youtube_link);
                formData.append('video_link', video_link);
                for (var count = 0; count < images.length; count++) {
                    formData.append("images[]", images[count]);
                }
                for (var count = 0; count < descriptions.length; count++) {
                    formData.append("descriptions[]", descriptions[count]);
                }
                formData.append('_token', _token);
                $.ajax({
                    url: "{{ route('manage-properties.property.edit-process') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend: function() {
                        $('#create_property').html(
                            `${save_icon} @lang('translation.please_wait')`);
                        $('#create_property').attr('class',
                            `${btn_cherwell } btn-block  ${spinner}`);
                        $('#create_property').attr('disabled', true);
                    },
                    complete: function() {
                        $('#create_property').html(`${save_icon} Update Property`);
                        $('#create_property').attr('class', `${btn_cherwell } btn-block`);
                        $('#create_property').removeAttr('disabled');
                    },
                    success: function(res) {
                           console.log(res);
                        if (res == "true") {
                            ToastSuccess("Property List Updated Successfully");
                        }

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });


            }
        });

        // TODO: Getting Widget Image URL
        var widget_one_image_src = '';
        $("#header_image_1").change(function() {
            var input = this;
            var filename = $(this).val().split('\\').pop()
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // console.log(filename)
                    // widget_one_image_src = e.target.result;
                    widget_one_image_src = filename;
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        });
        // TODO: Step 3 Widget Section Start
        var RowIDToUpdate = '';
        //TODO: Getting row data and putting up into form
        $('body').delegate('#row-to-update', 'click', function() {
            RowIDToUpdate = $(this).parent().parent().find('input[name="id"]').val();
            var image = $(this).parent().parent().find('input[name="image"]').val();
            var document_type_id = $(this).parent().parent().find('input[name="document_type_id"]')
            .val();
            console.log(document_type_id)
            $('#document_type_id').val(document_type_id).trigger('change');
            $('#widget-one-div').attr('class', '');
            $('#ImageToUpdate').html(image);
            $('#row1_' + RowIDToUpdate).css({
                backgroundColor: '#dfdcdc'
            });
            $('#add-button-english').html("@lang('translation.update')");
        });
        var id = 1;
        var index = 0;
        var document_files = [];
        var file_names = [];
        var document_type_ids = [];
        $('#add-button-english').click(function() {
            $('#add-button-english').html("Add Document");
            $('#row1_' + RowIDToUpdate).removeAttr('style');
            let document_type_id = $('#document_type_id').val()
            let document_type = $('select[id="document_type_id"] :selected').text()
            let image = $('#header_image_1').val().split('\\').pop();
            if (RowIDToUpdate) {
                if (!document_type_id != "" || !$.trim(document_type_id).length) {
                    $('#image_1_error').html("")
                    $('#document_type_id_1_error').html("@lang('translation.document_type_id_error')");
                    return $('#document_type_id').focus();
                } else {
                    var property = document.getElementById('header_image_1').files[0];
                    document_files.push(property);
                    document_type_ids.push(document_type_id);
                    file_names.push(image);
                    $('#image_1_error').html("");
                    $('#document_type_id_1_error').html("");
                    $("#document_type_id").val('').trigger('change')
                    $('#header_image_1').val("");
                    let rowData =
                        `<td class="justify-content-center">${RowIDToUpdate}</td>
                        <td class="justify-content-center">${widget_one_image_src}
                            </td>
                        <td class="justify-content-center">
                            ${document_type}
                        </td>
                        <td class="text-center justify-content-center">
                            <input type="hidden" name="index" value="${index}"/>
                            <input type="hidden" name="id" value="${RowIDToUpdate}"/>
                            <input type="hidden" name="image" value="${widget_one_image_src}"/>
                            <input type="hidden" name="document_type_id" value="${document_type_id}"/>
                            <a href="javascript:;" id="row-to-update" class="btn btn-sm btn-icon btn-secondary">
                            <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                            </a>
                            <a href="javascript:;" id="remove-w-1" class="btn btn-sm btn-icon btn-secondary">
                            <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                            </a>
                        </td>`;
                    $('body').find('#row1_' + RowIDToUpdate).html(rowData);
                    RowIDToUpdate = '';
                }
                id++;
                index++;
            } else {
                if (!image != "") {
                    $('#image_1_error').html("Please select a document file");
                    return $('#header_image_1').focus();
                } else if (!document_type_id != "" || !$.trim(document_type_id).length) {
                    $('#image_1_error').html("")
                    $('#document_type_id_1_error').html("Please select document type.");
                    return $('#document_type_id').focus();
                } else {
                    var property = document.getElementById('header_image_1').files[0];
                    document_files.push(property);
                    document_type_ids.push(document_type_id);
                    file_names.push(image);
                    $('#image_1_error').html("");
                    $('#document_type_id_1_error').html("");
                    $("#document_type_id").val('').trigger('change')
                    $('#header_image_1').val("");
                    let rowData =
                        `<tr id="row1_${id}">
                        <td class="justify-content-center">${id}</td>
                        <td class="justify-content-center">
                            ${widget_one_image_src}
                            </td>
                        <td class="justify-content-center">
                            ${document_type}
                        </td>
                        <td class="text-center justify-content-center">
                            <input type="hidden" name="index" value="${index}"/>
                            <input type="hidden" name="id" value="${id}"/>
                            <input type="hidden" name="image" value="${widget_one_image_src}"/>
                            <input type="hidden" name="document_type_id" value="${document_type_id}"/>
                            <a href="javascript:;" id="row-to-update" class="btn btn-sm btn-icon btn-secondary">
                            <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                            </a>
                            <a href="javascript:;" id="remove-w-1" class="btn btn-sm btn-icon btn-secondary">
                            <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                            </a>
                        </td>
                        </tr>`;
                    $('#wiget_data').append(rowData);
                }
                id++;
                index++;
            }
            $('#widget-one-div').attr('class', 'd-none');
            $('#ImageToUpdate').html(image);
        });
        //To Remove Widget 1 Row//
        $('body').delegate('#remove-w-1', 'click', function() {
            var index = $(this).parent().parent().find('input[name="index"]').val();
            var obj = $(this);
            $.confirm({
                title: 'Confirm',
                content: 'Delete this document?',
                boxWidth: '20%',
                buttons: {
                    cancel: function() {},
                    confirm: {
                        text: 'Confirm',
                        btnClass: 'btn-red',
                        action: function() {
                            console.log(document_files);
                            if (document_type_ids.length == 1) {
                                document_files = [];
                                document_type_ids = [];
                            }
                            document_files.splice(index, 1);
                            document_type_ids.splice(index, 1);
                            console.log(document_files);
                            obj.parent().parent().remove();
                            $.alert('Document Deleted Successfully!');
                        }
                    }
                }
            });
        });
        // End
        //for image preview
        function signatureImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah-signature').attr('src', e.target.result);
                    $('#blah-signature').attr('class', 'd-block')
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#signature-image").change(function() {
            signatureImage(this);
        });
        //SHOW HIDE SIGNATURE BOX START HERE//
        $('#is_signature').change(function() {
            if (($(this).is(':checked'))) {
                $('#signature-box').attr('class', 'd-block');
            } else {
                $('#signature-box').attr('class', 'd-none');
            }
        });
        //SHOW HIDE SIGNATURE BOX END HERE//
    });
</script>
