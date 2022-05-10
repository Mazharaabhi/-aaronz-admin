<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#email', '#email_template', '#cms_anchor');

        //TODO: Getting Email Tags and Content
        $('#email_category_id').change(function(){
            const email_category_id = $(this).val();
            if(email_category_id)
            {
                $.ajax({
                    url:"{{ route('admin.email.email-template.get-template') }}",
                    method:"POST",
                    data:{email_category_id,_token},
                    success:function(res){
                        var data = JSON.parse(res);
                        var tags = data.tags.split(',');

                        //Looping the tags
                        var tags_html = `
                        <label for="">Tags</label>
                        <div class="row mb-3">
                        `;
                        for(var i = 0; i<tags.length ; i++)
                        {
                            tags_html += `
                            <div class="col-md-3 mb-2">
                                ${tags[i]}
                            </div>
                            `;
                        }
                        tags_html += `</div>`;
                        $('#tags_list').html(tags_html);
                        $('#field_set').attr('class', '');
                        $('#content').summernote('code', '');
                        $('#content').summernote('pasteHTML', data.content);
                    },
                    error:function(xhr){
                        console.log(xhr.responseText);
                    }
                });
            }
            else
            {
                $('#field_set').attr('class', 'd-none');
                $('#tags_list').html('');
            }

        });

        $('#view_email_content').click(function()
        {
            $('#Add_Menu_Modal').modal('show');
            $('#email_content').html($('#content').summernote('code'));
        });

        //TODO: Creating new Email Category
        $('#save').click(function()
        {

                const content = $('#content').summernote('code');
                const email_category_id = $('#email_category_id').val();

                if(!content || !$.trim(content).length)
                {
                    Message('voilation!', 'Email content is requied.', 'red');
                }
                else if(content.length < 20)
                {
                    Message('voilation!', 'Email content must be atleast 20 cahracters.', 'red');
                }
                else
                {
                    var formData = new FormData;
                    formData.append('id',"{{ $settings->id }}");
                    formData.append('content',content);
                    formData.append('email_category_id',email_category_id);
                    formData.append('_token',_token);

                //TODO: Seding Ajax Requrest for creating email category
                $.ajax({
                    url:"{{ route('admin.email.email-template.update') }}",
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
                        $('#save').html(`${save_icon} @lang('translation.save_email_content')`);
                        $('#save').attr('class',`btn btn-danger btn-block`);
                        $('#save').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            ToastSuccess("@lang('translation.email_content_saved_successfully')");
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
