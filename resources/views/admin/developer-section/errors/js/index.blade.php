<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#developer_section', '#errors', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.developer-section.errors.index')  }}",
        columns: [
            { data: 'id' },
            { data: 'company_name' },
            { data: 'action', orderable: false, searchable: false},
            ]
        });


        //Loading View Json View
        $('body').delegate('#view', 'click', function(){
            var data = $(this).parent().find('textarea[id="error"]').html();
            $('#show_json').html(`<pre>${data}</pre>`);
            $('#Add_Menu_Modal').modal('show');

        });

        var html = '';
        //Sending Response In Email
        $('body').delegate('#send_email', 'click', function(){
            var data = $(this).parent().find('textarea[id="error"]').html();
            html = `<pre>${data}</pre>`;
            $('#Email_Menu_Modal').modal('show');
        });

        //Send Email here
        $('#email_buton').click(function(){
            var email = $('#email_to_send').val();

            //TODO: Regular Expression For Email
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            const checkEmail = emailReg.test( email );
            if(!$.trim(email).length)
            {
                $('#email_to_send_error').html('The email field is required');
                return $('#email_to_send').focus();
            }
            else if(checkEmail == false)
            {
                $('#email_to_send_error').html("@lang('translation.email_format_is_not_valid')");
                return $('#email_to_send').focus();
            }
            else
            {
                $('#email_to_send_error').html("");

                //TODO: Seding Ajax Requrest for login the user
                $.ajax({
                    url:"{{ route('admin.developer-section.erros.send-email') }}",
                    method:"POST",
                    data:{email,html,_token},
                    beforeSend:function()
                    {
                        $('#email_buton').html("@lang('translation.please_wait')");
                        $('#email_buton').attr('class',`btn btn-danger font-weight-bold  ${spinner}`);
                        $('#email_buton').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#email_buton').html('<span class="svg-icon svg-icon-md fa fa-envelope"></span> Send Emails');
                        $('#email_buton').attr('class',`btn btn-danger font-weight-bold`);
                        $('#email_buton').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {
                            Message('Sucess', 'Email Sent Successfulluy!', 'success');
                            $('#email_to_send').val('');
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
