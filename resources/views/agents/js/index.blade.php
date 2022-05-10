<script>
    //TODO: Copy Redirect Url
    function copyToClipboard(element) {
    var $temp = $("<input>");
    element = "#"+element;
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    alert('Link Copied!');
    }
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#companies', '#manage_companies', '#service_anchor');
        // TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#links-table').DataTable({
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
        processing: true,
        serverSide: true,
        dom: '<"top"f>rt<"bottom"ilp><"clear">',
        ajax: "{{ route('manage-agents.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'name' },
            { data: 'company_name' },
            { data: 'email' },
            { data: 'phone' },
            // { data: 'city' },
            // { data: 'state' },
            { data: 'sort_order' },
            { data: 'status', orderable: false, searchable: false},
            { data: 'action', orderable: false, searchable: false}
            ]
        });

        //TODO: Doing Company Active Dective
        $('body').delegate('#status', 'click', function()
        {
            var id = $(this).parent().find('input[name="id"]').val();
            var is_active = $(this).parent().find('input[name="is_active"]').val();

            $.ajax({
                url:"{{ route('manage-agents.is_active') }}",
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

          //TODO: Send Link in Message
          $('body').delegate('#send_email', 'click', function(){
            const email = $(this).parent().find('input[name="email"]').val();
            const name = $(this).parent().find('input[name="name"]').val();
            const password = $(this).parent().find('input[name="password"]').val();

            $.ajax({
                url:"{{ route('manage-agents.send-email') }}",
                method:"POST",
                data:{email, name, password, _token},
                beforeSend:function()
                {
                    Message('Processing', "Sending email please wait...", 'red');
                },
                success:function(res)
                {
                    if(res == "true")
                    {
                        Message('Success', "Email Send Successfully!", 'green');
                    }
                    else if(res == "email_template")
                    {
                        Message('Violation', "Email Template not found for Generate Payment Link Please Create One!", 'red');
                    }
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
                    content: 'Are you sure to delete this Agent?',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('manage-agents.delete') }}",
                                    method:"POST",
                                    data:{id, _token},
                                    success:function(res)
                                    {
                                        if(res == 'false'){
                                           $.alert('You can not delete this agent, please assign his property to someone else before deleting.');
                                        }else{
                                            DataTable.ajax.reload();
                                            $.alert('Agent Deleted Successfully!');
                                        }
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


    //TODO:CHANGE SORT ORDER STRAT HERE
    $('body').delegate('#agent_sort_order', 'keyup', function()
        {
            var sort_order =  $(this).val();
            var id = $(this).attr("data-id");
         // return console.log(id);
            $.ajax({
                url:"{{ route('manage-agents.sort_order') }}",
                method:"POST",
                data:{id, sort_order, _token},
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
});
</script>
