
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#c_settings', '#units', '#cms_anchor');
         $('#add_language').click(function(){
            // return alert('hello');
            const title_english = $('#title_english').val();
            const language_direction = $('#language_direction').val();
           // return console.log(language_direction);
            //applying validations here
            if(!title_english || !$.trim(title_english).length){
                $('#title_english_error').html("");
                $('#title_english_error').html("The unit name field is required.");
                return $('#title_english').focus();
            }
            else{
                $('#title_english_error').html("");
                var formData = new FormData();
                formData.append('title_english',title_english);
                formData.append('_token',"{{ csrf_token() }}");
                 $.ajax({
                     url:"{{ route('admin.settings.units.create-process') }}",
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
                       // return console.log(res);
                       if(res == "true"){
                         $('#title_english').val("");
                         $('#title_english').focus();
                         ToastSuccess("Unit Created Successfully");
                       }else{
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
