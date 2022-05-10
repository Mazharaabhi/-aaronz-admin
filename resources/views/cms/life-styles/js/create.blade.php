
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#cms', '#cms_lifestyle');
            //TODO: Creating slug for navbar menu
        $(`#title`).keyup(function(e)
        {
            CreateSlug($(this).val(), "#slug");
        });

        function CreateSlug(menu,slug)
        {
            //TODO: Converting Menu's String to lowercase
            var val = menu.toLowerCase();
           // console.log(val);
                $(slug).val(`/${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
        }
         //for add new staff
        $('#add_lifestyle').click(function(){
            const image = document.getElementById('fileupload-btn-one').files[0];
            const title = $('#title').val();
            const sub_title = $('#sub_title').val();
            const lifestyle_desc = $('#lifestyle_desc').val();
            const button_link = $('#button_link').val();
            const areas = $('#type_id').val();
            const slug = $('#slug').val();
            const meta_title = $('#meta_title').val();
            const meta_description = $('#meta_description').val();
         //  return console.log(areas);
            //applying validations here
            if(!title){
                $('#title_error').html("slider title required*");
              return  $('#title').focus();
            }
            else if(!sub_title){
                $('#title_error').html("");
                $('#slider_heading_error').html("slider Headeing required*");
              return  $('#sub_title').focus();
            }
           else if(!lifestyle_desc){
                $('#title_error').html("");
                $('#slider_heading_error').html("");
                $('#lifestyle_desc_error').html("slider Description required*");
              return  $('#lifestyle_desc').focus();
            }
            else if(image == ""){
                $('#title_error').html("");
                $('#slider_heading_error').html("");
                $('#lifestyle_desc_error').html("");
                $('#image_one_error').html("Please select slider image*");
            }else{
                $('#image_one_error').html("");
                $('#title_error').html("");
                $('#slider_heading_error').html("");
                $('#lifestyle_desc_error').html("");
                var formData = new FormData();
                formData.append('title',title);
                formData.append('sub_title',sub_title);
                formData.append('lifestyle_desc',lifestyle_desc);
                formData.append('button_link',button_link);
                formData.append('image',image);
                formData.append('meta_title',meta_title);
                formData.append('slug',slug);
                formData.append('meta_description',meta_description);
                formData.append('_token',_token);
                for(var count = 0; count<areas.length; count++){
                    formData.append("areas[]", areas[count]);
                }
                 $.ajax({
                     url:"{{ route('cms.life-styles.create-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#add_lifestyle').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#add_lifestyle').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#add_lifestyle').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add_lifestyle').html(`${save_icon} @lang('translation.save')`);
                        $('#add_lifestyle').attr('class',`${btn_cherwell } btn-block`);
                        $('#add_lifestyle').removeAttr('disabled');
                    },
                     success:function(res){
                       //  return console.log(res);
                       if(res == "true"){
                        $('#title').val('');
                        $('#sub_title').val('');
                        $('#lifestyle_desc').val('');
                        $('#type_id').val('');
                        $('#meta_title').val('');
                        $('#meta_description').val('');
                        $('#fileupload-btn-one').val('');
                        $('#blah-one').attr('src', '');
                        $('#blah-one').attr('class','d-none');
                        ToastSuccess("Lifestyle Created Successfully");
                       }else if(res == 'slug'){
                        $('#slug_error').html("This Slug already taken.");
                        $(`#slug`).focus();
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
