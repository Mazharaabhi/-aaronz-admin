
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#export-portal');
         GrandMenuActive('#portals');
         $('#icon').change(function(){
            $('#show_icon').attr('class', `${$(this).val()} text-primary ml-5`);
         });


         //for add new staff
        $('#add_portal').click(function(){
            const title_english = $(`#title`).val();
            const xml_link = $(`#xml_link`).val();
            const description = $('#description').val();
            const time_duration = $('#time_duration').val();
            const image = document.getElementById('fileupload-btn-one').files[0];
            //applying validations here
            if(!title_english || !$.trim(title_english).length){
                 $('#title_error').html("The name field is required.");
                 return $('#title').focus()
            }else if(title_english.length < 3){
                return $('#title_error').html("The name field must be at least 3 character.");
            }else{
                $('#title_error').html("");

                var formData = new FormData();
                formData.append('title',title_english);
                formData.append('xml_link',xml_link);
                formData.append('description',description);
                formData.append('time_duration',time_duration);
                formData.append('image',image);
                formData.append('_token',_token);

                 $.ajax({
                     url:"{{ route('manage-properties.export.portals.create-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#add_portal').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#add_portal').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#add_portal').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add_portal').html(`${save_icon} @lang('translation.save')`);
                        $('#add_portal').attr('class',`${btn_cherwell } btn-block`);
                        $('#add_portal').removeAttr('disabled');
                    },
                     success:function(res){
                        //return console.log(res);
                       if(res == "true"){
                         $(`#title`).val("");
                         $(`#xml_link`).val("");
                         $('#description').val("");
                        ToastSuccess("Portal Created Successfully");
                       }else if(res == 'title'){
                        $('#title_error').html("This Portal name is already exist.");
                        $('#title').focus();
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
