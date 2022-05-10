<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#cms_section', '#manage_navbar', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        dom: '<"top"i>rt<"bottom"flp><"clear">',
        ajax: "{{ route('admin.cms.manage-navbar.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'title_english' },
            { data: 'slug' },
            { data: 'status', orderable: false, searchable: false},
            { data: 'action', orderable: false, searchable: false}
            ]
        });

        //TODO: For opening add menu modal
        $('#OpenAddModel').click(function()
        {
            $('#Add_Menu_Modal').modal('show');
            $('#title_english').val("");
            $('#slug').val("");
            $('#title_english_error').html("");
            $('#slug_error').html("");
        });

        // TODO: Reordering Table Columns with drag and drop
        $( "#users-table tbody").sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer(){
            //TODO: Getting Data and Fort Sort Table Rows
            const sort = [];
            $('body').find('input[name="id"]').each(function(index,element) {
            sort.push({
              id: $(this).val(),
              position: index+1
            });

            //TODO: Send ajax to sort table rows
            $.ajax({
                url:"{{ route('admin.cms.manage-navbar.sort') }}",
                method:"POST",
                data:{sort,_token},
                success: function(res)
                {
                    DataTable.ajax.reload();
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });

          });
        }

        //TODO: Attaching Input Search with datatables
        $('.input-search').keyup(function()
        {
            DataTable.columns().search($(this).val()).draw();
            console.log(DataTable.columns());
        });

        //TODO: Creating slug for navbar menu
        $('#title_english').keyup(function(e)
        {
            CreateSlug($(this).val(), "#slug");
        });

        $('#edit_title_english').keyup(function(e)
        {
            CreateSlug($(this).val(), "#edit_slug");
        });

        function CreateSlug(menu,slug)
        {
            //TODO: Converting Menu's String to lowercase
            var val = menu.toLowerCase();
            if(val == 'home'){
                $(slug).val(``);
            }else{
                $(slug).val(`${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
            }
        }

        //TODO: Creating new navbar menu
        $('#save').click(function()
        {
            const title_english = $('#title_english').val();
            const slug = $('#slug').val();

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
            if(!slug || !$.trim(slug).length)
            {
                $('#title_english_error').html("");
                $('#slug_error').html("@lang('translation.slug_is_required')");
                return $('#slug').focus();
            }
            else
            {
                $('#title_english_error').html("");
                $('#slug_error').html("");
                const title_arabic = title_english;
                //TODO: Seding Ajax Requrest for creating navbar menu
                $.ajax({
                    url:"{{ route('admin.cms.manage-navbar.create') }}",
                    method:"POST",
                    data:{title_english,title_arabic,slug,_token},
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
                            $('#slug').val('');
                            $('#title_english').focus();
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
                        else if(res == "slug")
                        {
                            $('#slug_error').html("@lang('translation.slug_already_taken')");
                            return $('#slug').focus();
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
            const db_slug = $(this).parent().find('input[name="slug"]').val();

            //TODO: Assigning values to update fields
            $('#edit_title_english').val(db_title_english);
            $('#title_arabic').val(db_title_arabic);
            $('#edit_slug').val(db_slug);
            //TODO: Open edit model here
            $('#edit_Menu_Modal').modal('show');
            $('#english-tab').trigger('click');

        });

        //TODO: Creating new navbar menu
        $('#update').click(function()
        {
            const title_english = $('#edit_title_english').val();
            const title_arabic = $('#title_arabic').val();
            const slug = $('#edit_slug').val();

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
            else if(!slug || !$.trim(slug).length)
            {
                $('#edit_title_english_error').html("");
                $('#edit_slug_error').html("@lang('translation.slug_is_required')");
                return $('#edit_slug').focus();
            }
            else
            {
                $('#edit_title_english_error').html("");
                $('#edit_slug_error').html("");
                $('#title_arabic_error').html("");
                //TODO: Seding Ajax Requrest for creating navbar menu
                $.ajax({
                    url:"{{ route('admin.cms.manage-navbar.update') }}",
                    method:"POST",
                    data:{id,title_english,title_arabic,slug,_token},
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
                        else if(res == "slug")
                        {
                            $('#edit_slug_error').html("@lang('translation.slug_already_taken')");
                            return $('#edit_slug').focus();
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
