
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
         MakeMenuActive('#c_settings', '#prices', '#cms_anchor');


         $("#amount").keyup(function() {
            var $this = $(this);
            if($this.val() != "")
            {
                $('#decimal_amount').val(parseFloat($this.val().replace(/[^\d.]/g, '')).toFixed(2));
            }
            $('#compact_amount').val($(this).val()
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            );

            const vl = $('#compact_amount') * 2;

            console.log(vl);
        });

         $('#add_language').click(function(){
            // return alert('hello');
            const type_id = $('#price_type').val();
            const amount = $('#amount').val();
            const decimal_amount = $('#decimal_amount').val();
            const compact_amount = $('#compact_amount').val();
           // return console.log(language_direction);
            //applying validations here
            if(!amount){
                $('#amount_error').html("Price should be greater than 0.");
                return $('#amount').focus();
            }
            else{
                $('#amount_error').html("");
                var formData = new FormData();
                formData.append('type_id',type_id);
                formData.append('amount',amount);
                formData.append('decimal_amount',decimal_amount);
                formData.append('compact_amount',compact_amount);
                formData.append('_token',"{{ csrf_token() }}");
                 $.ajax({
                     url:"{{ route('admin.settings.prices.create-process') }}",
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
                         $('#amount').val("");
                         $('#decimal_amount').val("");
                         $('#compact_amount').val("");
                         $('#amount').focus();
                         ToastSuccess("Price Created Successfully");
                       }else{
                        ToastError("warning", "Price Already Exists.");
                        $('#amount').focus();
                       }
                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });
            }
        });

    });
</script>
