
<script>
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

        return true;
    }
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         MakeMenuActive('#c_settings', '#sizes', '#cms_anchor');


         $("#size").keyup(function() {
            var $this = $(this);
            if($this.val() != "")
            {
                $('#decimal_size').val(parseFloat($this.val().replace(/[^\d.]/g, '')).toFixed(2));
            }
            $('#compact_size').val($(this).val()
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            );

            const vl = $('#compact_size') * 2;

            console.log(vl);
        });

         $('#add_language').click(function(){
            // return alert('hello');
            const size = $('#size').val();
            const decimal_size = $('#decimal_size').val();
            const compact_size = $('#compact_size').val();
           // return console.log(language_direction);
            //applying validations here
            if(!size || size <= 0){
                $('#size_error').html("Size should be greater than 0.");
                return $('#size').focus();
            }
            else{
                $('#size_error').html("");
                var formData = new FormData();
                formData.append('size',size);
                formData.append('decimal_size',decimal_size);
                formData.append('compact_size',compact_size);
                formData.append('_token',"{{ csrf_token() }}");
                 $.ajax({
                     url:"{{ route('admin.settings.sizes.create-process') }}",
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
                         $('#size').val("");
                         $('#decimal_size').val("");
                         $('#compact_size').val("");
                         $('#size').focus();
                         ToastSuccess("Size Created Successfully");
                       }else{
                        ToastError("warning", "Size Already Exists.");
                        $('#size').focus();
                       }
                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });
            }
        });

    });
</script>
