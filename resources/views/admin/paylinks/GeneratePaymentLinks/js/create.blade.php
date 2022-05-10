<script>
         //TODO: Copy Redirect Url
    function CopyLink() {
    const link = document.querySelector('#Link');
    const range = document.createRange();
    range.selectNode(link);
    const selection = window.getSelection();
    selection.removeAllRanges();
    selection.addRange(range);
    const successful = document.execCommand('copy');
    }
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#pay_links', '#generate_link', '#service_anchor');

         //TODO: Getting States As Per Countries
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
            const link_email = $('#link_email').val();
            const phone = $('#phone').val();
            const street = $('#street').val();
            const amount = $('#amount').val();
            const city = $('#city').val();
            const country = $('#country').val();
            const state = $('#state').val();
            const zip = $('#zip').val();
            const description = $('#description').val();
            const state_count = $('#state_count').val();
            //TODO: Regular Expression For Email
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            const checkEmail = emailReg.test( link_email );

            //TODO: Applying Validations Here
            if(!amount)
            {
                $('#amount_error').html("@lang('translation.amount_required')");
                return $('#amount').focus();
            }
            else if(amount <= 0)
            {
                $('#amount_error').html("@lang('translation.amount_length')");
                return $('#amount').focus();
            }
            else if(!description || !$.trim(description).length)
            {
                $('#amount_error').html("");
                $('#description_error').html("@lang('translation.description_required')");
                return $('#description').focus();
            }
            else if(description.length < 10)
            {
                $('#amount_error').html("");
                $('#description_error').html("@lang('translation.description_length_error')");
                return $('#description').focus();
            }
            else if(!name || !$.trim(name).length)
            {
                $('#amount_error').html("");
                $('#description_error').html("");
                $('#name_error').html("@lang('translation.full_name_is_required')");
                return $('#name').focus();
            }
            else if (name.split(' ').length < 2)
            {
                $('#amount_error').html("");
                $('#description_error').html("");
                $('#name_error').html("@lang('translation.fill_name_format')");
                return $('#name').focus();
            }
            else if(name.length <= 2)
            {
                $('#amount_error').html("");
                $('#description_error').html("");
                $('#name_error').html("@lang('translation.full_name_length_error')");
                return $('#name').focus();
            }
            else if(!link_email)
            {
                $('#amount_error').html("");
                $('#description_error').html("");
                $('#name_error').html("");
                $('#email_error').html("@lang('translation.email_is_required')");
                return $('#link_email').focus();
            }
            else if(checkEmail == false)
            {
                $('#amount_error').html("");
                $('#description_error').html("");
                $('#name_error').html("");
                $('#email_error').html("@lang('translation.email_format_is_not_valid')");
                return $('#link_email').focus();
            }
            else if(!phone)
            {
                $('#amount_error').html("");
                $('#description_error').html("");
                $('#name_error').html("");
                $('#email_error').html("");
                $('#phone_error').html("@lang('translation.phone_required')");
                return $('#phone').focus();
            }
            else if(!street || !$.trim(street).length)
            {
                $('#amount_error').html("");
                $('#description_error').html("");
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
                $('#description_error').html("");
                $('#amount_error').html("");
                $('#name_error').html("");
                $('#email_error').html("");
                $('#phone_error').html("");
                $('#street_error').html("@lang('translation.street_length')");
                return $('#street').focus();
            }
            else if(!city || !$.trim(city).length)
            {
                $('#amount_error').html("");
                $('#description_error').html("");
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
                $('#amount_error').html("");
                $('#description_error').html("");
                $('#name_error').html("");
                $('#email_error').html("");
                $('#phone_error').html("");
                $('#amount_error').html("");
                $('#street_error').html("");
                $('#city_error').html("@lang('translation.city_length')");
                return $('#city').focus();
            }
            // else if(zip < 3)
            // {
            //     $('#name_error').html("");
            //     $('#email_error').html("");
            //     $('#phone_error').html("");
            //     $('#amount_error').html("");
            //     $('#street_error').html("");
            //     $('#zip_error').html("@lang('translation.zip_required')");
            //     return $('#zip').focus();
            // }
            else if(!country)
            {
                $('#amount_error').html("");
                $('#description_error').html("");
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
                $('#amount_error').html("");
                $('#description_error').html("");
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
                $('#description_error').html("");
                //TODO: Initializing Form Data Object
                const formData = new FormData;
                formData.append('name', name);
                formData.append('email', link_email);
                formData.append('phone', phone);
                formData.append('amount', amount);
                formData.append('description', description);
                formData.append('city', city);
                formData.append('zip', zip);
                formData.append('country', country);
                formData.append('state', state);
                formData.append('street1', street);
                formData.append('_token', _token);

                //TODO: Seding Ajax Requrest for creating navbar menu
                $.ajax({
                    url:"{{ route('admin.paylinks.generate-payment-link.create-payment-link') }}",
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
                        $('#save').html(`${save_icon} @lang('translation.generate_link')`);
                        $('#save').attr('class',`btn btn-danger btn-block`);
                        $('#save').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "api_error")
                        {
                            Message('Violation', 'Authentication failed. Check profile ID and Server Key of your Account ', 'red');
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
                            ToastSuccess("@lang('translation.payment_link_created_successfully')");
                            $("#Show_Link_For_COPY").modal('show');
                            $("#Link").html(res);
                            $('#whastapp_link').attr('href', `https://wa.me/${phone}?text=${res}`);
                            $('#browser').attr('href', `${res}`);
                            $('#name').val('');
                            $('#link_email').val('');
                            $('#phone').val('');
                            $('#street').val('');
                            $('#amount').val('');
                            $('#city').val('');
                            $('#country').val('');
                            $('#state').val('');
                            $('#zip').val('');
                            $('#description').val('');

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
