<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#email', '#email_category', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.email.email-category.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'category_name' },
            { data: 'email_subject' },
            { data: 'status', orderable: false, searchable: false},
            { data: 'action', orderable: false, searchable: false}
            ]
        });

        //TODO: For opening add menu modal
        $('#OpenAddModel').click(function()
        {
            $('#Add_Menu_Modal').modal('show');
            $('#category_name').val("");
            $('#category_name_error').html("");
        });


        //TODO: Creating new Email Category
        $('#save').click(function()
        {
            const category_name = $('#category_name').val();
            const email_subject = $('#email_subject').val();
            const tags = $("#tags:checked").map(function(){
            return $(this).val();
            }).get().join(",");

            //TODO: Applying Validations Here
            if(!category_name || !$.trim(category_name).length)
            {
                $('#category_name_error').html("@lang('translation.category_name_is_required')");
                return $('#category_name').focus();
            }
            else if(category_name.length <= 2)
            {
                $('#category_name_error').html("@lang('translation.category_name_length_error')");
                return $('#category_name').focus();
            }
            if(!email_subject || !$.trim(email_subject).length)
            {
                $('#category_name_error').html("");
                $('#email_subject_error').html("@lang('translation.email_subject_is_required')");
                return $('#email_subject').focus();
            }
            else if(email_subject.length <= 2)
            {
                $('#category_name_error').html("");
                $('#email_subject_error').html("@lang('translation.email_subject_length_error')");
                return $('#email_subject').focus();
            }
            else
            {
                $('#email_subject_error').html("");
                $('#category_name_error').html("");
                //TODO: Seding Ajax Requrest for creating email category
                $.ajax({
                    url:"{{ route('admin.email.email-category.create') }}",
                    method:"POST",
                    data:{category_name,email_subject,tags,_token},
                    beforeSend:function()
                    {
                        $('#submit').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#submit').attr('class',`${btn_primary }  ${spinner}`);
                        $('#submit').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#submit').html(`${save_icon} @lang('translation.save')`);
                        $('#submit').attr('class',`${btn_primary }`);
                        $('#submit').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("@lang('translation.email_category_created_successfully')");
                            DataTable.ajax.reload();
                            $('#category_name').val('');
                            $('#email_subject').val('');
                            $('#category_name').focus();
                            //Emptying all the attributes
                            for(var i=0 ; i < tags.length ; i++)
                            {
                                    tags[i].attr('checked', false);
                            }
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "email_category")
                        {
                            $('#category_name_error').html("@lang('translation.category_name_already_taken')");
                            return $('#category_name').focus();
                        }
                        else if(res == "email_subject")
                        {
                            $('#email_subject_error').html("@lang('translation.email_subject_already_taken')");
                            return $('#email_subject').focus();
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
            var db_tags_array = '';
            id = $(this).parent().find('input[name="id"]').val();
            var db_category_name = $(this).parent().find('input[name="category_name"]').val();
            var db_email_subject = $(this).parent().find('input[name="email_subject"]').val();
            var db_tags = $(this).parent().find('input[name="tags"]').val();
            db_tags_array = db_tags.split(',');

            var edit_tags = $("#edit_tags:not(:checked)").map(function(){
            return $(this);
            }).get();
            var checked_edit_tags = $("#edit_tags:checked").map(function(){
            return $(this);
            }).get();
            //Emptying all the attributes
            for(var i=0 ; i < checked_edit_tags.length ; i++)
            {
                    checked_edit_tags[i].attr('checked', false);
            }
            for(var i=0 ; i < edit_tags.length ; i++)
            {
                for(var j=0; j < db_tags_array.length; j++){
                    if(db_tags_array[j] == edit_tags[i].val())
                {
                    edit_tags[i].attr('checked', true);
                }
                }
            }

            //TODO: Assigning values to update fields
            $('#edit_category_name').val(db_category_name);
            $('#edit_email_subject').val(db_email_subject);
            //TODO: Open edit model here
            $('#edit_Menu_Modal').modal('show');

        });

        //TODO: Creating new Email Category
        $('#update').click(function()
        {
            const category_name = $('#edit_category_name').val();
            const email_subject = $('#edit_email_subject').val();
            const tags = $("#edit_tags:checked").map(function(){
            return $(this).val();
            }).get().join(",");

            //TODO: Applying Validations Here
            if(!category_name || !$.trim(category_name).length)
            {
                $('#edit_category_name_error').html("@lang('translation.category_name_is_required')");
                return $('#edit_category_name').focus();
            }
            else if(category_name.length <= 2)
            {
                $('#edit_category_name_error').html("@lang('translation.category_name_length_error')");
                return $('#edit_category_name').focus();
            }
            if(!email_subject || !$.trim(email_subject).length)
            {
                $('#edit_email_subject_error').html("@lang('translation.email_subject_is_required')");
                return $('#edit_email_subject').focus();
            }
            else if(email_subject.length <= 2)
            {
                $('#edit_email_subject_error').html("@lang('translation.email_subject_length_error')");
                return $('#edit_email_subject').focus();
            }
            else
            {
                $('#edit_category_name_error').html("");
                $('#edit_email_subject_error').html("");
                //TODO: Seding Ajax Requrest for creating Email Category
                $.ajax({
                    url:"{{ route('admin.email.email-category.update') }}",
                    method:"POST",
                    data:{id,category_name,email_subject,tags,_token},
                    beforeSend:function()
                    {
                        $('#submit').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#submit').attr('class',`${btn_primary }  ${spinner}`);
                        $('#submit').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#submit').html(`${save_icon} @lang('translation.save')`);
                        $('#submit').attr('class',`${btn_primary }`);
                        $('#submit').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("@lang('translation.email_category_updated_successfully')");
                            $("#edit_Menu_Modal").modal('hide');
                             DataTable.ajax.reload();
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "category_name")
                        {
                            $('#edit_category_name_error').html("@lang('translation.category_name_already_taken')");
                            return $('#edit_category_name').focus();
                        }
                        else if(res == "email_subject")
                        {
                            $('#edit_email_subject_error').html("@lang('translation.email_subject_already_taken')");
                            return $('#edit_email_subject').focus();
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        //TODO: Doing Company Active Dective
        $('body').delegate('#status', 'click', function()
        {
            var id = $(this).parent().find('input[name="id"]').val();
            var is_active = $(this).parent().find('input[name="is_active"]').val();

            $.ajax({
                url:"{{ route('admin.email.email-category.is_active') }}",
                method:"POST",
                data:{id, is_active, _token},
                success:function(res)
                {
                    DataTable.ajax.reload();
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });

        });

        //TODO: Deleting the company
        $('body').delegate('#delete', 'click', function()
        {
            var id = $(this).parent().find('input[name="id"]').val();
            //Delete Confirmation
            $.confirm({
                    title: '@lang("translation.confirm")',
                    content: '@lang("translation.are_you_sure_you_want_to_delete_this_category")',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('admin.email.email-category.delete') }}",
                                    method:"POST",
                                    data:{id, _token},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('@lang("translation.category_deleted_successfully")');
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


        });

});
</script>
