
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#cms', '#cms_life_at_aaronz');
         //for add new staff
        $('#add_video_url').click(function(){
            const video_url = $(`#video_url`).val();
            //applying validations here
             if(!video_url || !$.trim(video_url).length){
                 $('#video_url_error').html("The Video URL field is required.");
                 return $('#video_url').focus()
            }else{
                $('#video_url_error').html("");
                var formData = new FormData();
                formData.append('video_url',video_url);
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('cms.life-at-aaronz.create-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#add_video_url').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#add_video_url').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#add_video_url').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add_video_url').html(`${save_icon} @lang('translation.save')`);
                        $('#add_video_url').attr('class',`${btn_cherwell } btn-block`);
                        $('#add_video_url').removeAttr('disabled');
                    },
                     success:function(res){
                        //return console.log(res);
                       if(res == "true"){
                        $('#video_url').val('');
                        ToastSuccess("Video URL Created Successfully");
                       }else if(res == 'title'){
                        $('#video_url_error').html("Video URL is already exist.");
                        $('#video_url').focus();
                       }
                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });


            }
        });

    });
</script>
