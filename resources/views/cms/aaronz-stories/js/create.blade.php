
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#cms', '#aaron-story');
         $('#icon').change(function(){
            $('#show_icon').attr('class', `${$(this).val()} text-primary ml-5`);
         });


         //for add new staff
        $('#add_aronz_story').click(function(){
            var image = $('#fileupload-btn-one').val();
            const story_title = $('#story_title').val();
            const story_heading = $('#story_heading').val();
            const story_desc  = CKEDITOR.instances['descriptions'].getData();
            const button_link = $('#button_link').val();
            //applying validations here
            if(!story_title){
                $('#story_title_error').html("Aaronz Story Sell With Us Title required*");
              return  $('#story_title').focus();
            }
            else if(!story_heading){
                $('#story_title_error').html("");
                $('#story_heading_error').html("Aaronz Story Sell With Us Headeing required*");
              return  $('#story_heading').focus();
            }
           else if(!story_desc){
                $('#story_title_error').html("");
                $('#story_heading_error').html("");
                $('#story_desc_error').html("Aaronz Story Sell With Us Description required*");
              return  $('#story_desc').focus();
            }
            else if(image == ""){
                $('#story_title_error').html("");
                $('#story_heading_error').html("");
                $('#story_desc_error').html("");
               return $('#image_one_error').html("Please select Aaronz Story Sell With Us image*");
            }else{
                $('#image_one_error').html("");
                $('#story_title_error').html("");
                $('#story_heading_error').html("");
                $('#story_desc_error').html("");
                image = document.getElementById('fileupload-btn-one').files[0];
                var formData = new FormData();
                formData.append('story_title',story_title);
                formData.append('story_heading',story_heading);
                formData.append('story_desc',story_desc);
                formData.append('button_link',button_link);
                formData.append('image',image);
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('cms.aronz-story.create-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#add_aronz_story').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#add_aronz_story').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#add_aronz_story').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add_aronz_story').html(`${save_icon} @lang('translation.save')`);
                        $('#add_aronz_story').attr('class',`${btn_cherwell } btn-block`);
                        $('#add_aronz_story').removeAttr('disabled');
                    },
                     success:function(res){
                        // return console.log(res);
                       if(res == "true"){
                        $('#fileupload-btn-one').val('');
                        $('#story_title').val('');
                        $('#story_heading').val('');
                        $('#story_desc').val('');
                        $('#button_link').val('');
                        $('#blah-one').attr('src', '');
                        $('#blah-one').attr('class','d-none');
                        ToastSuccess("Aaronz Success Story Sell With Us Created Successfully");
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
