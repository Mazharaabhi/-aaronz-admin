
<script>

    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#c_settings', '#units', '#cms_anchor');

         //for add new feature
         $('#edit_language').click(function(){
            const title_english = $('#title_english').val();
            const language_direction = $('#language_direction').val();
           if(!title_english || !$.trim(title_english).length){
                $('#menu_id_error').html("");
                $('#title_english_error').html("");
                $('#image_one_error').html("");
                 return $('#book_title_english_error').html("The title english field is required.");
            }else{
                $('#title_english_error').html("");
                var formData = new FormData();
                formData.append('title_english',title_english);
                formData.append('language_direction',language_direction);
                formData.append('id',"{{ $unit->id }}");
                formData.append('_token',"{{ csrf_token() }}");

                 $.ajax({
                     url:"{{ route('admin.settings.units.edit-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#edit_language').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#edit_language').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#edit_language').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#edit_language').html(`${save_icon} @lang('translation.update')`);
                        $('#edit_language').attr('class',`${btn_cherwell } btn-block`);
                        $('#edit_language').removeAttr('disabled');
                    },
                     success:function(res)
                     {
                       if(res == "true")
                       {
                        ToastSuccess("Unit Updated Successfully!");
                       }
                       else
                       {
                        ToastError("warning", "Unit Already Exists.");
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
