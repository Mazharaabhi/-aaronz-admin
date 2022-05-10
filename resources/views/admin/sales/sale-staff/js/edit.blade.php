<script>
    //TODO: Copy Redirect Url
function CopyLink() {
var $temp = $("<input>");
$("body").append($temp);
$temp.val($('#Link').html()).select();
document.execCommand("copy");
$temp.remove();
console.log($temp);
alert('Link Copied!');
}
$(document).ready(function(){
   @include('messages.jquery-messages')
   MakeMenuActive('#customers', '#manage_customer', '#service_anchor');

     //TODO: Getting States of the Country
     $.ajax({
                url:"{{ route('get.states') }}",
                method:"POST",
                data:{country:"{{ $customer->country }}", _token},
                success:function(res)
                {
                    var data = JSON.parse(res);
                    var html = `<option value="">-- State  --</option>`;
                    $('#state_count').val(data.state_count);
                    if(data.state_count > 0)
                    {
                        for(var i=0; i < data.state_count; i++)
                        {
                            html += `<option value="${data.states[i]['val']}">${data.states[i]['text']}</option>`;
                        }
                    }
                    $('#state').html(html);
                    $('#state').val("{{ $customer->state }}");
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
    });


    $('#country').change(function()
    {
        const country = $(this).val();

        if(!country)
        {
            $('#state').html('<option value="">-- State  --</option>');
        }
        else
        {
            //TODO: Getting States of the Country
            $.ajax({
                url:"{{ route('get.states') }}",
                method:"POST",
                data:{country, _token},
                success:function(res)
                {
                    var data = JSON.parse(res);
                    var html = `<option value="">-- State  --</option>`;
                    $('#state_count').val(data.state_count);
                    if(data.state_count > 0)
                    {
                        for(var i=0; i < data.state_count; i++)
                        {
                            html += `<option value="${data.states[i]['val']}">${data.states[i]['text']}</option>`;
                        }
                    }
                    $('#state').html(html);
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        }
    });

   //TODO: Creating new navbar menu
   $('#save').click(function()
   {
       const name = $('#name').val();
       const customer_email = $('#customer_email').val();
       const phone = $('#phone').val();
       const street = $('#street').val();
       const city = $('#city').val();
       const country = $('#country').val();
       const state = $('#state').val();
       const zip = $('#zip').val();
       const state_count = $('#state_count').val();

       //TODO: Regular Expression For Email
       var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       const checkEmail = emailReg.test( customer_email );

       //TODO: Applying Validations Here
       if(!name || !$.trim(name).length)
       {
           $('#name_error').html("@lang('translation.name_is_required')");
           return $('#name').focus();
       }
       else if(name.length <= 2)
       {
           $('#name_error').html("@lang('translation.name_length_error')");
           return $('#name').focus();
       }
       else if(!customer_email)
       {
           $('#name_error').html("");
           $('#email_error').html("@lang('translation.email_is_required')");
           return $('#customer_email').focus();
       }
       else if(checkEmail == false)
       {
           $('#name_error').html("");
           $('#email_error').html("@lang('translation.email_format_is_not_valid')");
           return $('#customer_email').focus();
       }
       else if(!phone)
       {
           $('#name_error').html("");
           $('#email_error').html("");
           $('#phone_error').html("@lang('translation.phone_required')");
           return $('#phone').focus();
       }
       else if(!street || !$.trim(street).length)
       {
           $('#name_error').html("");
           $('#email_error').html("");
           $('#phone_error').html("");
           $('#amount_error').html("");
           $('#street_error').html("@lang('translation.street_required')");
           return $('#street').focus();
       }
       else if(street.length < 3)
       {
           $('#amount_error').html("");
           $('#name_error').html("");
           $('#email_error').html("");
           $('#phone_error').html("");
           $('#street_error').html("@lang('translation.street_length')");
           return $('#street').focus();
       }
       else if(!city || !$.trim(city).length)
       {
           $('#name_error').html("");
           $('#email_error').html("");
           $('#phone_error').html("");
           $('#amount_error').html("");
           $('#street_error').html("");
           $('#city_error').html("@lang('translation.city_required')");
           return $('#city').focus();
       }
       else if(city.length < 3)
       {
           $('#name_error').html("");
           $('#email_error').html("");
           $('#phone_error').html("");
           $('#amount_error').html("");
           $('#street_error').html("");
           $('#city_error').html("@lang('translation.city_length')");
           return $('#city').focus();
       }
    //    else if(zip < 3)
    //    {
    //        $('#name_error').html("");
    //        $('#email_error').html("");
    //        $('#phone_error').html("");
    //        $('#amount_error').html("");
    //        $('#street_error').html("");
    //        $('#zip_error').html("@lang('translation.zip_required')");
    //        return $('#zip').focus();
    //    }
       else if(!country)
       {
           $('#name_error').html("");
           $('#email_error').html("");
           $('#phone_error').html("");
           $('#amount_error').html("");
           $('#street_error').html("");
           $('#zip_error').html("");
           $('#city_error').html("");
           return $('#country_error').html("@lang('translation.country_required')");
       }
       else if(state_count > 0 && !state)
       {
           $('#name_error').html("");
           $('#email_error').html("");
           $('#phone_error').html("");
           $('#amount_error').html("");
           $('#street_error').html("");
           $('#city_error').html("");
           $('#country_error').html("");
           $('#zip_error').html("");
           $('#state_error').html("@lang('translation.state_required')");
           return $('#state').focus();
       }
       else
       {
           $('#name_error').html("");
           $('#email_error').html("");
           $('#phone_error').html("");
           $('#zip_error').html("");
           $('#amount_error').html("");
           $('#street_error').html("");
           $('#city_error').html("");
           $('#country_error').html("");
           $('#state_error').html("");

           //TODO: Initializing Form Data Object
           const formData = new FormData;
           formData.append('id', "{{ $customer->id }}");
           formData.append('name', name);
           formData.append('email', customer_email);
           formData.append('phone', phone);
           formData.append('city', city);
           formData.append('zip', zip);
           formData.append('country', country);
           formData.append('state', state);
           formData.append('address', street);
           formData.append('_token', _token);

           //TODO: Seding Ajax Requrest for creating navbar menu
           $.ajax({
               url:"{{ route('admin.customers.manage-customer.update') }}",
               method:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:false,
               beforeSend:function()
               {
                   $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                   $('#save').attr('class',`btn btn-danger btn-block  ${spinner}`);
                   $('#save').attr('disabled',true);
               },
               complete:function()
               {
                   $('#save').html(`${save_icon} @lang('translation.save')`);
                   $('#save').attr('class',`btn btn-danger btn-block`);
                   $('#save').removeAttr('disabled');
               },
               success:function(res)
               {
                   if(res == "Cyber")
                   {
                       ToastError("warning", "@lang('translation.cyber_message')");
                   }
                   else if(res == "email")
                   {
                       $('#email_error').html("@lang('translation.email_already_taken')");
                       return $('#email').focus();
                   }
                   else if(res == "phone")
                   {
                       $('#phone_error').html("@lang('translation.phone_already_taken')");
                       return $('#phone').focus();
                   }else{
                       ToastSuccess("@lang('translation.customer_updated_successfully')");
                   }
               },error:function(xhr)
               {
                   console.log(xhr.responseText);
               }
           });
       }
   });

   //TODO: Getting Data and opening the update model to update the data
   var id = '';
   $('body').delegate('#edit', 'click', function()
   {
       id = $(this).parent().find('input[name="id"]').val();
       const db_title_english = $(this).parent().find('input[name="title_english"]').val();
       const db_title_arabic = $(this).parent().find('input[name="title_arabic"]').val();

       //TODO: Assigning values to update fields
       $('#edit_title_english').val(db_title_english);
       $('#title_arabic').val(db_title_arabic);
       //TODO: Open edit model here
       $('#edit_Menu_Modal').modal('show');
       $('#english-tab').trigger('click');

   });


});
</script>
