
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#c_properties_1', '#cms_insta');

         //for add new Instagram feed
        $('#edit_instagram_feed').click(function(){
               const image = document.getElementById('fileupload-btn-one').files[0];
               const instagram_feed_title = $('#instagram_feed_title').val();
               const button_link = $('#button_link').val();
               var formData = new FormData();
                formData.append('id',"{{ $instagram_feed->id }}");
                formData.append('image',image);
                formData.append('instagram_feed_title',instagram_feed_title);
                formData.append('button_link',button_link);
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('cms.instagram-feed.edit-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#edit_instagram_feed').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#edit_instagram_feed').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#edit_instagram_feed').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#edit_instagram_feed').html(`${save_icon} @lang('translation.update')`);
                        $('#edit_instagram_feed').attr('class',`${btn_cherwell } btn-block`);
                        $('#edit_instagram_feed').removeAttr('disabled');
                    },
                     success:function(res){
                        // return console.log(res);
                       if(res == "true"){
                        ToastSuccess("Instagram Feed Updated Successfully!");
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
