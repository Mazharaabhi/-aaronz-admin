
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#c_properties_1', '#cms_slider', '#cms_anchor');
         $('#icon').change(function(){
            $('#show_icon').attr('class', `${$(this).val()} text-primary ml-5`);
         });


         //for add new staff
        $('#add_language').click(function(){
            const image = document.getElementById('fileupload-btn-one').files[0];
            const slider_title = $('#slider_title').val();
            const slider_heading = $('#slider_heading').val();
            const slider_desc = $('#slider_desc').val();
            const button_link = $('#button_link').val();
            //applying validations here
            if(!slider_title){
                $('#slider_title_error').html("slider title required*");
              return  $('#slider_title').focus();
            }
            else if(!slider_heading){
                $('#slider_title_error').html("");
                $('#slider_heading_error').html("slider Headeing required*");
              return  $('#slider_heading').focus();
            }
           else if(!slider_desc){
                $('#slider_title_error').html("");
                $('#slider_heading_error').html("");
                $('#slider_desc_error').html("slider Description required*");
              return  $('#slider_desc').focus();
            }
            else if(image == ""){
                $('#slider_title_error').html("");
                $('#slider_heading_error').html("");
                $('#slider_desc_error').html("");
                $('#image_one_error').html("Please select slider image*");
            }else{
                $('#image_one_error').html("");
                $('#slider_title_error').html("");
                $('#slider_heading_error').html("");
                $('#slider_desc_error').html("");
                var formData = new FormData();
                formData.append('slider_title',slider_title);
                formData.append('slider_heading',slider_heading);
                formData.append('slider_desc',slider_desc);
                formData.append('button_link',button_link);
                formData.append('image',image);
                formData.append('_token',_token);

                 $.ajax({
                     url:"{{ route('cms.sliders.create-process') }}",
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
                        $('#fileupload-btn-one').val('');
                        $('#blah-one').attr('src', '');
                        $('#blah-one').attr('class','d-none');
                        ToastSuccess("Slider Created Successfully");
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
