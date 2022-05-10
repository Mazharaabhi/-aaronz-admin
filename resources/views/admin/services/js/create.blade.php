<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#services_section', '#service_menu', '#service_anchor');

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const title_english = $('#title_english').val();
            const short_title_english = $('#short_title_english').val();
            const image = document.getElementById('image').files[0];

            //TODO: Applying Validations Here
            if(!title_english || !$.trim(title_english).length)
            {
                $('#title_english_error').html("@lang('translation.title_english_is_required')");
                return $('#title_english').focus();
            }
            else if(title_english.length <= 2)
            {
                $('#title_english_error').html("@lang('translation.title_english_length_error')");
                return $('#title_english').focus();
            }
            else if(!short_title_english || !$.trim(short_title_english).length)
            {
                $('#title_english_error').html("");
                $('#short_title_english_error').html("@lang('translation.short_title_english_is_required')");
                return $('#short_title_english').focus();
            }
            else if(short_title_english.length <= 2)
            {
                $('#title_english_error').html("");
                $('#short_title_english_error').html("@lang('translation.short_title_english_length_error')");
                return $('#short_title_english').focus();
            }
            else if(!image || !$.trim(image).length)
            {
                $('#title_english_error').html("");
                $('#short_title_english_error').html("");
                $('#image_error').html("@lang('translation.image_required')");
                return $('#image').focus();
            }
            else
            {
                $('#title_english_error').html("");
                $('#short_title_english_error').html("");
                $('#image_error').html("");

                //TODO: Initializing Form Data Object
                const formData = new FormData;
                formData.append('title_english', title_english);
                formData.append('title_arabic', title_english);
                formData.append('image', image);
                formData.append('short_title_english', short_title_english);
                formData.append('short_title_arabic', short_title_english);
                formData.append('_token', _token);

                //TODO: Seding Ajax Requrest for creating navbar menu
                $.ajax({
                    url:"{{ route('admin.services.create') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
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
                            ToastSuccess("@lang('translation.navbar_menu_created_successfully')");
                            DataTable.ajax.reload();
                            $('#title_english').val('');
                            $('#short_title_english').val('');
                            $('#title_english').focus();
                            $('#description').summernote('code', '<p><br></p>');
                            $("#image").val(null);
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "title")
                        {
                            $('#title_english_error').html("@lang('translation.title_english_already_taken')");
                            return $('#title_english').focus();
                        }
                        else if(res == "short-title")
                        {
                            $('#short_title_english_error').html("@lang('translation.short_title_english_already_taken')");
                            return $('#short_title_english').focus();
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

        //TODO: Creating new navbar menu
        $('#update').click(function()
        {
            const title_english = $('#edit_title_english').val();
            const title_arabic = $('#title_arabic').val();


            //TODO: Applying Validations Here
            if(!title_english || !$.trim(title_english).length)
            {
                $('#edit_title_english_error').html("@lang('translation.title_english_is_required')");
                return $('#edit_title_english').focus();
            }
            else if(title_english.length <= 2)
            {
                $('#edit_title_english_error').html("@lang('translation.title_english_length_error')");
                return $('#edit_title_english').focus();
            }
            else
            {
                $('#edit_title_english_error').html("");
                $('#title_arabic_error').html("");
                //TODO: Seding Ajax Requrest for creating navbar menu
                $.ajax({
                    url:"{{ route('admin.cms.manage-navbar.update') }}",
                    method:"POST",
                    data:{id,title_english,title_arabic,_token},
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
                            ToastSuccess("@lang('translation.navbar_menu_updated_successfully')");
                            $("#edit_Menu_Modal").modal('hide');
                             DataTable.ajax.reload();
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }
                        else if(res == "title")
                        {
                            $('#edit_title_english_error').html("@lang('translation.title_english_already_taken')");
                            $('#english-tab').trigger('click');
                            return $('#edit_title_english').focus();
                        }
                        else if(res == "title-arabic")
                        {
                            $('#title_arabic_error').html("@lang('translation.title_arabic_already_taken')");
                            $('#arabic-tab').trigger('click');
                            return $('#title_arabic').focus();
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        //  TODO: Deleteing Records here
        $('body').delegate('#delete', 'click', function()
        {
            const id = $(this).parent().find('input[name="id"]').val();

            //TODO: Open Confirm Delete model
            $('.modal-confirm-delete').modal('show');

            //TODO: Delete record
            $('.delete-crud-entry').click(function()
            {
                //TODO: Seding Ajax Requrest for deleteing navbar menu
                $.ajax({
                    url:"{{ route('admin.cms.manage-navbar.delete') }}",
                    method:"POST",
                    data:{id,_token},
                    beforeSend:function()
                    {
                        $('.delete-crud-entry').html(`@lang('translation.deleting')`);
                        $('.delete-crud-entry').attr('class',`float-right btn btn-danger delete-crud-entry  ${spinner}`);
                        $('.delete-crud-entry').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('.delete-crud-entry').html(`@lang('translation.delete')`);
                        $('.delete-crud-entry').attr('class',`float-right btn btn-danger delete-crud-entry`);
                        $('.delete-crud-entry').removeAttr('disabled',true);
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("@lang('translation.record_delete_successfully')");
                            $(".modal-confirm-delete").modal('hide');
                             DataTable.ajax.reload();
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "@lang('translation.cyber_message')");
                        }

                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

});
</script>
