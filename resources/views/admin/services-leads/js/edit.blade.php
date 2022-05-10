<script>
    $(document).ready(function(){
       @include('messages.jquery-messages')
       MakeMenuActive('#manage_customer', '#all_customer', '#service_anchor');
       //TODO: Creating new navbar menu
       $('#save').click(function()
       {
           const name = $('#name').val();
           const customer_email = $('#customer_email').val();
           const phone = $('#phone').val();

           //TODO: Regular Expression For Email
           var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
           const checkEmail = emailReg.test( customer_email );

           //TODO: Applying Validations Here
           if(!name || !$.trim(name).length)
           {
               $('#name_error').html("The full name field is required.");
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
           else if(phone == "")
           {
               $('#email_error').html("");
               $('#name_error').html("");
               $('#phone_error').html("The Phone filed is required.");
               return $('#phone').focus();
           }
           else if(checkEmail == false)
           {
               $('#name_error').html("");
               $('#phone_error').html("");
               $('#email_error').html("@lang('translation.email_format_is_not_valid')");
               return $('#customer_email').focus();
           }
           else
           {
                $('#name_error').html("");
                $('#designation_error').html("");
                $('#company_name_error').html("");
                $('#email_error').html("");
                $('#phone_error').html("");
                $('#new_email_error').html("");
                $('#password_error').html("");
                $('#confirm_password_error').html("");
                $('#role_error').html("");

               //TODO: Initializing Form Data Object
               const formData = new FormData;
               formData.append('id', "{{ $lead->id }}");
               formData.append('name', name);
               formData.append('email', customer_email);
               formData.append('phone', phone);
               formData.append('_token', _token);

               //TODO: Seding Ajax Requrest for creating navbar menu
               $.ajax({
                   url:"{{ route('manage-service-leads.update-lead') }}",
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
                        console.log(res);
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
                           ToastSuccess("Lead Updated Successfully!");
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


       $('#add_comment').click(function(){
            const description = $('#comment').val();
            const lead_id = "{{ $lead->id }}";

            if(!$.trim(description).length){
                return $('#comment_error').html(`The comment field is required`);
            }

            $('#comment_error').html('');
            $.ajax({
                url:"{{ route('manage-service-leads.add-comment') }}",
                method:"POST",
                data:{description, lead_id, _token},
                success:function(res){
                    // return console.log(res)
                    ToastSuccess("Comment Added Successfully!");
                    window.location.reload();

                },error:function(xhr){
                    console.log(xhr.responseText)
                }
            });

       });

       $('#lead_for').change(function(){
        const role_id = $(this).val();
        const obj = $(this);
        if(role_id != "")
        {
            $.ajax({
                url:"{{ route('manage-service-leads.get-companies') }}",
                method:"GET",
                data:{role_id},
                success:function(res){
                    $('select[name="company_id"]').html(res);
                },error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }

    });


    $('#company_id').change(function(){
        const company_id = $(this).val();
        const lead_id = "{{ $lead->id }}";
        const status = "{{ $lead->status }}";

        if(company_id != ""){

            $.confirm({
                    title: 'Confirm!',
                    content: 'Service Assign Lead To This Company|Agent ?.',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('manage-service-leads.assign-lead') }}",
                                    method:"POST",
                                    data:{company_id, lead_id, status, _token},
                                    success:function(res)
                                    {
                                        console.log(res)
                                        window.location.reload();
                                        $.alert('Service Lead Assigned Successfully');
                                    },
                                    error:function(xhr)
                                    {
                                        console.log(xhr.responseText);
                                    }
                                });
                            }
                        }
                    }
        });

        }


    });


    $('#show_hide').click(function(){
        const flag = $('#hide_div').attr('data-id');

        if(flag == 0){
            $('#hide_div').attr('data-id', 1);
            $('#hide_div').attr('class', '');
            $(this).attr('class', 'fa fa-close text-danger');
        }else{
            $('#hide_div').attr('data-id', 0);
            $('#hide_div').attr('class', 'd-none');
            $(this).attr('class', 'fa fa-edit text-primary');
        }

    });

    /**Changing Property Status*/
    $('#lead_status').change(function(){
        const status = $(this).val();
        const lead_id = "{{ $lead->id }}";
       // return console.log(`status: ${status}, lead_id ${lead_id}`)
    /**Chaning Lead Status*/
        $.ajax({
            url:"{{ route('manage-service-leads.update-lead-status') }}",
            method:"POST",
            data:{lead_id, status, _token},
            success:function(res){
                $.alert('Service Lead Status Updated Successfully');
                window.location.reload();
            },error:function(xhr){
                console.log(xhr.responseText);
            }
        });

    });

    });
    </script>
