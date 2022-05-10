
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#c_properties_1', '#cms_insta');
         $('#icon').change(function(){
            $('#show_icon').attr('class', `${$(this).val()} text-primary ml-5`);
         });


         //for add new staff
        $('#add_news_feed').click(function(){
            const image = document.getElementById('fileupload-btn-one').files[0];
            const insta_feed_title = $('#insta_feed_title').val();
            const button_link = $('#button_link').val();
            //applying validations here
            if(!insta_feed_title){
                $('#insta_feed_title_error').html("Instagram Feed title required*");
              return  $('#insta_feed_title').focus();
            } else if(image == ""){
                $('#insta_feed_title_error').html("");
                $('#image_one_error').html("Please select image*");
            }else{
                $('#image_one_error').html("");
                $('#insta_feed_title_error').html("");
                var formData = new FormData();
                formData.append('intagram_feed_title',insta_feed_title);
                formData.append('button_link',button_link);
                formData.append('image',image);
                formData.append('_token',_token);

                 $.ajax({
                     url:"{{ route('cms.instagram-feed.create-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#add_news_feed').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#add_news_feed').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#add_news_feed').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add_news_feed').html(`${save_icon} @lang('translation.save')`);
                        $('#add_news_feed').attr('class',`${btn_cherwell } btn-block`);
                        $('#add_news_feed').removeAttr('disabled');
                    },
                     success:function(res){
                       if(res == "true"){
                        $('#insta_feed_title').val('');
                        $('#button_link').val('');
                        $('#fileupload-btn-one').val('');
                        $('#blah-one').attr('src', '');
                        $('#blah-one').attr('class','d-none');
                        ToastSuccess("Instagram Feed Created Successfully");
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
