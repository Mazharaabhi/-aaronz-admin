<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#developer_section', '#paytabs_json', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('admin.developer-section.index')  }}",
        columns: [
            { data: 'id' },
            { data: 'tran_ref' },
            { data: 'company_name' },
            { data: 'action', orderable: false, searchable: false},
            ]
        });


        //Loading View Json View
        $('body').delegate('#view', 'click', function(){
            var data = $(this).parent().find('textarea[id="json"]').html();
            data = JSON.parse(data);
            json = JSON.stringify(data, undefined, 2);
            $('#show_json').html(`<pre>${json}</pre>`);
            $('#Add_Menu_Modal').modal('show');

        });

        var html = '';
        var tran_ref = '';
        //Sending Response In Email
        $('body').delegate('#send_email', 'click', function(){
            var data = $(this).parent().find('textarea[id="json"]').html();
            tren_ref = $(this).parent().find('input[name="tran_ref"]').html();
            data = JSON.parse(data);
            json = JSON.stringify(data, undefined, 2);
            html = `<pre>${json}</pre>`;
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
                    url:"{{ route('admin.developer-section.send-email') }}",
                    method:"POST",
                    data:{email,html,tran_ref,_token},
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
