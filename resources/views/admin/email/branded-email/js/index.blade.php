<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#email', '#branded_email', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.email.branded-email.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'title' },
            { data: 'email' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });


        //TODO: For opening add menu modal
        $('#OpenAddModel').click(function()
        {
            $('#Add_Menu_Modal').modal('show');
            $('#brand_email').val("");
            $('#title').val("");
            $('#email_error').html("");
            $('#title_error').html("");
        });

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const title = $('#title').val();
            const email = $('#brand_email').val();

            //TODO: Regular Expression For Email
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            const checkEmail = emailReg.test( email );

            //TODO: Applying Validations Here
            if(!title || !$.trim(title).length)
            {
                $('#title_error').html("@lang('translation.email_title_is_required')");
                return $('#title').focus();
            }
            else if(title.length < 5)
            {
                $('#title_error').html("@lang('translation.email_title_length')");
                return $('#title').focus();
            }
            else if(!email)
            {
                $('#title_error').html("");
                $('#email_error').html("@lang('translation.email_is_required')");
                return $('#brand_email').focus();
            }
            else if(checkEmail == false)
            {
                $('#title_error').html("");
                $('#email_error').html("@lang('translation.email_format_is_not_valid')");
                return $('#brand_email').focus();
            }
            else
            {
                $('#title_error').html("");
                $('#email_error').html("");
                const company_id = "{{ Auth::user()->id }}";
                //TODO: Seding Ajax Requrest for creating paytabs config
                $.ajax({
                    url:"{{ route('admin.email.branded-email.create') }}",
                    method:"POST",
                    data:{title, email, company_id,_token},
                    beforeSend:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#save').attr('class',`btn btn-danger font-weight-bold  ${spinner}`);
                        $('#save').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.save')`);
                        $('#save').attr('class',`btn btn-danger font-weight-bold`);
                        $('#save').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("Branded Email Created Successfully!");
                            Redirect('', '');
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "title")
                        {
                            $('#title_error').html("This email title is already exist.");
                            return $('#title').focus();
                        }
                        else if(res == "email")
                        {
                            $('#email_error').html("This email is already exist.");
                            return $('#brand_email').focus();
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
            const db_title = $(this).parent().find('input[name="title"]').val();
            const db_email = $(this).parent().find('input[name="email"]').val();

            // //TODO: Assigning values to update fields
            $('#u_title').val(db_title);
            $('#u_brand_email').val(db_email);
            //TODO: Open edit model here
            $('#Edit_Menu_Modal').modal('show');

        });


        //TODO: Creating new navbar menu
        $('#update').click(function()
        {
            const title = $('#u_title').val();
            const email = $('#u_brand_email').val();

            //TODO: Regular Expression For Email
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            const checkEmail = emailReg.test( email );

            //TODO: Applying Validations Here
            if(!title || !$.trim(title).length)
            {
                $('#u_title_error').html("@lang('translation.email_title_is_required')");
                return $('#u_title').focus();
            }
            else if(title.length < 5)
            {
                $('#u_title_error').html("@lang('translation.email_title_length')");
                return $('#u_title').focus();
            }
            else if(!email)
            {
                $('#u_title_error').html("");
                $('#u_email_error').html("@lang('translation.email_is_required')");
                return $('#u_brand_email').focus();
            }
            else if(checkEmail == false)
            {
                $('#u_title_error').html("");
                $('#u_email_error').html("@lang('translation.email_format_is_not_valid')");
                return $('#u_brand_email').focus();
            }
            else
            {
                $('#u_title_error').html("");
                $('#u_email_error').html("");
                const company_id = "{{ Auth::user()->id }}";
                //TODO: Seding Ajax Requrest for creating paytabs config
                $.ajax({
                    url:"{{ route('admin.email.branded-email.update') }}",
                    method:"POST",
                    data:{id ,title, email, company_id,_token},
                    beforeSend:function()
                    {
                        $('#update').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#update').attr('class',`btn btn-danger font-weight-bold  ${spinner}`);
                        $('#update').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#update').html(`${save_icon} @lang('translation.update')`);
                        $('#update').attr('class',`btn btn-danger font-weight-bold`);
                        $('#update').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("Branded Email Updated Successfully!");
                            DataTable.ajax.reload();
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "title")
                        {
                            $('#u_title_error').html("This email title is already exist.");
                            return $('#u_title').focus();
                        }
                        else if(res == "email")
                        {
                            $('#u_email_error').html("This email is already exist.");
                            return $('#u_brand_email').focus();
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
