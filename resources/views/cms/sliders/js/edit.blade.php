
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
               var formData = new FormData();
                formData.append('id',"{{ $slider->id }}");
                formData.append('image',image);
                formData.append('slider_title',slider_title);
                formData.append('slider_heading',slider_heading);
                formData.append('slider_desc',slider_desc);
                formData.append('button_link',button_link);
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('cms.sliders.edit-process') }}",
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
                        $('#add_language').html(`${save_icon} @lang('translation.update')`);
                        $('#add_language').attr('class',`${btn_cherwell } btn-block`);
                        $('#add_language').removeAttr('disabled');
                    },
                     success:function(res){
                        // return console.log(res);
                       if(res == "true"){
                        ToastSuccess("Slider Updated Successfully");
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
