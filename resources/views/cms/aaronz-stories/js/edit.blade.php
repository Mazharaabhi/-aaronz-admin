
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#cms', '#aronz-story');
         $('#icon').change(function(){
            $('#show_icon').attr('class', `${$(this).val()} text-primary ml-5`);
         });


         //for add new staff
        $('#edit_aronz_story').click(function(){
               const image = document.getElementById('fileupload-btn-one').files[0];
               const story_title = $('#story_title').val();
               const story_heading = $('#story_heading').val();
               const story_desc  = CKEDITOR.instances['descriptions'].getData();;
               const button_link = $('#button_link').val();
               var formData = new FormData();
                formData.append('id',"{{ $aronz_story->id }}");
                formData.append('image',image);
                formData.append('story_title',story_title);
                formData.append('story_heading',story_heading);
                formData.append('story_desc',story_desc);
                formData.append('button_link',button_link);
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('cms.aronz-story.edit-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#edit_aronz_story').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#edit_aronz_story').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#edit_aronz_story').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#edit_aronz_story').html(`${save_icon} @lang('translation.update')`);
                        $('#edit_aronz_story').attr('class',`${btn_cherwell } btn-block`);
                        $('#edit_aronz_story').removeAttr('disabled');
                    },
                     success:function(res){
                        // return console.log(res);
                       if(res == "true"){
                        ToastSuccess("Aaronz Story Sell With Us Updated Successfully");
                       }

                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });
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
