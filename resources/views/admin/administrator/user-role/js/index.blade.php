<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#administrator', '#user-role', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
                dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.administrator.user-role.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'name' },
            { data: 'is_default' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });

        //TODO: For opening add menu modal
        $('#OpenAddModel').click(function()
        {
            $('#Add_Menu_Modal').modal('show');
            $('#rol_name').val("");
            $('#rol_name_error').html("");
        });

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const name = $('#role_name').val();
            //TODO: Applying Validations Here
            if(!$.trim(name).length)
            {
                $('#role_name_error').html("The role name field is required.");
                return $('#role_name').focus();
            }
            else
            {
                $('#role_name_error').html("");
                //TODO: Seding Ajax Requrest for creating paytabs config
                $.ajax({
                    url:"{{ route('admin.administrator.user-role.create') }}",
                    method:"POST",
                    data:{name ,_token},
                    beforeSend:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#save').attr('class',`${btn_primary }  ${spinner}`);
                        $('#save').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.save')`);
                        $('#save').attr('class',`${btn_primary }`);
                        $('#save').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("Role Name Created Successfully");
                            DataTable.ajax.reload();
                            $('#role_name').val('');
                            $('#role_name').focus();

                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "name")
                        {
                            $('#role_name_error').html('This role name is already exist.')
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
            const name = $(this).parent().find('input[name="name"]').val();

            // //TODO: Assigning values to update fields
            $('#u_role_name').val(name);
            //TODO: Open edit model here
            $('#Update_Menu_Modal').modal('show');

        });

        $('#update').click(function()
        {
            const name = $('#u_role_name').val();

            //TODO: Applying Validations Here
            if(!$.trim(name).length)
            {
                $('#u_role_name_error').html("The role name is required.");
                return $('#u_role_name').focus();
            }
            else
            {
                $('#u_role_name_error').html("");
                //TODO: Seding Ajax Requrest for creating paytabs config
                to_currency = 'AED';
                $.ajax({
                    url:"{{ route('admin.administrator.user-role.edit') }}",
                    method:"POST",
                    data:{id, name, _token},
                    beforeSend:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#save').attr('class',`${btn_primary }  ${spinner}`);
                        $('#save').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.save')`);
                        $('#save').attr('class',`${btn_primary }`);
                        $('#save').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("User role Updated Successfully");
                            DataTable.ajax.reload();
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "name")
                        {
                            $('#u_role_name_error').html('This role name is already exist.')
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }
        });


        //TODO: Deleting the company
        $('body').delegate('#delete', 'click', function()
        {
            var id = $(this).parent().find('input[name="id"]').val();
            //Delete Confirmation
            $.confirm({
                    title: 'Confirm!',
                    content: 'Deleting this role may affect the users added to this role.',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('admin.administrator.user-role.delete') }}",
                                    method:"POST",
                                    data:{id, _token},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('Role Deleted Successfully');
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
