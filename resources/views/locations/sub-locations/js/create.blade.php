
<script>
    let lat = '';
    let lng = '';
    function initialize() {
        var input = document.getElementById('title_english_1');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            lat = place.geometry['location'].lat();
            lng = place.geometry['location'].lng();
            console.log(place);
         });
    }
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#c_locations', '#sub_locations', '#cms_anchor');

         $('#country').change(function(){
            const location_country_id = $('#country').val();
            $.ajax({
                url:"{{ route('locations.location.get-state') }}",
                method:"GET",
                data:{location_country_id},
                success:function(res)
                {
                    $('#state').html(res);
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
         });

         $('#state').change(function(){
            const location_state_id = $('#state').val();
            $.ajax({
                url:"{{ route('locations.location.get-location') }}",
                method:"GET",
                data:{location_state_id},
                success:function(res)
                {
                    $('#location_id').html(res);
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
         });

         //for add new staff
        $('#add_language').click(function(){
            const title_english = $(`#title_english_${input_id}`).val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            const location_id = $('#location_id').val();
            const location_country_id = $('#country').val();
            const location_state_id = $('#state').val();
            //applying validations here
             if(!location_country_id){
                return $('#country_id_error').html("Please select a country.");
             }else if(!location_state_id){
                $('#country_id_error').html("");
                return $('#state_error').html("Please select a state.");
             }else if(!location_id){
                $('#country_id_error').html("");
                $('#state_error').html("");
                return $('#location_error').html("Please select a location.");
             }
             else if(!title_english || !$.trim(title_english).length){
                 $('#country_id_error').html("");
                 $('#state_error').html("");
                $('#location_error').html("");
                 $('#title_english_error').html("The amenity title field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $('#title_english').focus()
            }else if(title_english.length < 3){
                $('#country_id_error').html("");
                $('#state_error').html("");
                $('#location_error').html("");
                hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                return $('#title_english_error').html("The amenity title field must be at least 3 character.");
            }else{
                $('#title_english_error').html("");
                $('#country_id_error').html("");
                $('#state_error').html("");
                $('#location_error').html("");

                var formData = new FormData();
                formData.append('title_english',title_english);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('location_id',location_id);
                formData.append('location_country_id',location_country_id);
                formData.append('location_state_id',location_state_id);
                formData.append('lat',lat);
                formData.append('lng',lng);
                formData.append('_token',_token);



                 $.ajax({
                     url:"{{ route('locations.sub-locations.create-process') }}",
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
                        //return console.log(res);
                       if(res == "true"){
                         $('#blah-one').attr('class','d-none');
                         $('input[name="title_english[]"]').map(function(){
                            $(this).val('');
                        });
                        ToastSuccess("Sub Location Created Successfully");
                       }else if(res == 'title'){
                        $('#title_english_error').html("This sub location name is already exist.");
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
