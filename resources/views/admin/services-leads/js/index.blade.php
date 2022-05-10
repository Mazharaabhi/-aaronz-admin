<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#cms_section', '#manage_navbar', '#cms_anchor');

        const role_id = "{{ auth()->user()->role_id }}";
        if(role_id == 1){
            //TODO: Getting Data and passing into yajra datatables
            var DataTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
            ajax: "{{ route('manage-service-leads.index')  }}",
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'name' },
                { data: 'phone' },
                { data: 'email' },
                { data: 'assign_lead' },
                { data: 'type' },
                { data: 'date' },
                { data: 'status'},
                { data: 'action', orderable: false, searchable: false}
                ]
            });
        }else{
            //TODO: Getting Data and passing into yajra datatables
            var DataTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
                    dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
            ajax: "{{ route('manage-service-leads.index')  }}",
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'name' },
                { data: 'phone' },
                { data: 'email' },
                { data: 'type' },
                { data: 'date' },
                { data: 'status'},
                { data: 'action', orderable: false, searchable: false}
                ]
            });
        }




    $('body').delegate('#lead_for', 'change', function(){
        const role_id = $(this).val();
        const obj = $(this);
        if(role_id != "")
        {
            $.ajax({
                url:"{{ route('manage-service-leads.get-companies') }}",
                method:"GET",
                data:{role_id},
                success:function(res){
                    console.log(res)
                    obj.parent().find('select[name="company_id"]').html(res);
                },error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }

    });

    $('body').delegate('#company_id', 'change', function(){
        const company_id = $(this).val();
        const role_id = $(this).parent().find('select[name="lead_for"]').val();
        const lead_id = $(this).parent().find('input[name="lead_id"]').val();
        const status = $(this).parent().find('input[name="status"]').val();

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
                                    data:{company_id, role_id, lead_id, status, _token},
                                    success:function(res)
                                    {
                                        // return console.log(res)
                                        DataTable.ajax.reload();
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

    /**Show Hide Select Options*/
    $('body').delegate('#show_hide', 'click', function(){
            const hide_status = $(this).parent().parent().find('div[id="select_divs"]').attr('data-id');

            if(hide_status == 0){
                $(this).parent().parent().find('#select_divs').attr('class', '')
                $(this).parent().parent().find('#select_divs').attr('data-id', '1')
                $(this).attr('class', 'fa fa-close text-danger');
            }else{
                $(this).parent().parent().find('#select_divs').attr('class', 'd-none')
                $(this).parent().parent().find('#select_divs').attr('data-id', '0')
                $(this).attr('class', 'fa fa-edit text-primary');
            }

        });

});
</script>
