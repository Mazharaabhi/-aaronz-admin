<script>
    $(document).ready(function()
    {
        @include('messages.jquery-messages');

        //TODO: Removing the spaces from the password and from confirm_password here
        $('#uPassword').keypress(function(event)
            {
                var key = event.keyCode;
                if (key === 32) {
                event.preventDefault();
            }
        });

        $('#conPassword').keypress(function(event)
            {
                var key = event.keyCode;
                if (key === 32) {
                event.preventDefault();
            }
        });

        //TODO: For User Sign up
        $('#Register').click(function()
        {
            const name = $('#uName').val();
            const email = $('#uEmail').val();
            const password = $('#uPassword').val();
            const cpassword = $('#conPassword').val();
            const phone = $('#phoneNumb').val();
            const address = $('#address').val();
            //TODO: Regular Expression For Email
             var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            const checkEmail = emailReg.test( email );

            //Applying validation to each input field
            $('#uName').keypress(function()
            {
                $('#uName_error').html("");
            });

            $('#uEmail').keypress(function()
            {
                $('#uEmail_error').html("");
            });

            $('#uPassword').keypress(function()
            {
                $('#uPassword_error').html("");
            });

            $('#conPassword').keypress(function()
            {
                $('#conPassword_error').html("");
            });

            $('#phoneNumb').keypress(function()
            {
                $('#phoneNumb_error').html("");
            });

            $('#address').keypress(function()
            {
                $('#address_error').html("");
            });


            //TODO Applying validation here
            //TODO: Name Validations
            if(!name || !$.trim(name).length)
            {
                $('#uName_error').html("@lang('translation.name_is_required')");
            }
            else if(name.length <= 2)
            {
                $('#uName_error').html("@lang('translation.name_length_error')");
            }
            else
            {
                $('#uName_error').html("");
            }

            //TODO: Email Validations
            if(!email || !$.trim(email).length)
            {
                $('#uEmail_error').html("@lang('translation.email_is_required')");
            }
            else if(checkEmail == false)
            {
                $('#uEmail_error').html("@lang('translation.email_format_is_not_valid')");
            }
            else
            {
                $('#uEmail_error').html("");
            }

            //TODO: Password Validations
            if(!password || !$.trim(password).length)
            {
                $('#uPassword_error').html("@lang('translation.password_is_required')");
            }
            else if(password.length <= 5)
            {
                $('#uPassword_error').html("@lang('translation.password_length_error')");
            }
            else
            {
                $('#uPassword_error').html("");
            }

            //TODO: Confirm Password Validations
            if(!cpassword)
            {
                $('#conPassword_error').html("@lang('translation.confirm_password_is_required')");
            }
            else if(password != cpassword)
            {
                $('#conPassword_error').html("@lang('translation.password_are_not_matched')");
            }
            else
            {
                $('#conPassword_error').html("");
            }

            //TODO: Confirm Password Validations
            if(!phone || !$.trim(phone).length)
            {
                $('#phoneNumb_error').html("@lang('translation.phone_number_is_required')");
            }
            else if(phone.length < 9)
            {
                $('#phoneNumb_error').html("@lang('translation.phone_number_is_required_length')");
            }
            else
            {
                $('#phoneNumb_error').html("");
            }

            //TODO: Address Validations
            if(!address || !$.trim(address).length)
            {
                $('#address_error').html("@lang('translation.address_required')");
            }
            else if(address.length < 10)
            {
                $('#address_error').html("@lang('translation.address_length_error')");
            }
            else
            {
                $('#address_error').html("");
            }

            //TODO: Validating the
            if(
            !$('#uName_error').html() &&
            !$('#uEmail_error').html() &&
            !$('#uPassword_error').html() &&
            !$('#phoneNumb_error').html() &&
            !$('#address_error').html()
            )
            {
            //TODO: Creating formData instance her
            var formData = new FormData;
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('phone', phone);
            formData.append('address', address);
            formData.append('_token', _token);

            //TODO: Seding Ajax Requrest for Sign up the user
            $.ajax({
                    url:"{{ route('website.auth.sign-up') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    beforeSend:function()
                    {
                        $('#Register').val("@lang('translation.please_wait')");
                        $('#Register').attr('class',"btn btn-primary btn-lg spinner spinner-right spinner-white pr-15");
                        $('#Register').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#Register').val("@lang('translation.register')");
                        $('#Register').attr('class',"btn btn-primary btn-lg");
                        $('#Register').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            //TODO: Showing the verfication div
                            $('#verification-row').attr('class', 'row row-eq-height');
                            $('#login-row').attr('class', 'row row-eq-height d-none');
                            $('#login-tab').trigger('click');
                            $('#number').html(phone);

                            $('#uName').val('');
                            $('#uEmail').val('');
                            $('#uPassword').val('');
                            $('#conPassword').val('');
                            $('#phoneNumb').val('');
                            $('#address').val('');
                        }
                        else if(res == "Cyber")
                        {
                            // ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "email")
                        {
                            $('#uEmail_error').html("@lang('translation.email_already_taken')");
                        }
                        else if(res == "phone")
                        {
                            $('#phoneNumb_error').html("@lang('translation.phon_number_already_taken')");
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }


            });
    });
</script>
