

<script>

    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#services', '#questions-sub-type', '#service_anchor');
        GrandMenuActive('#services');
        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
                dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('manage-services.question-sub-type.index')  }}",
        bAutoWidth: false,
        aoColumns : [
            { sWidth: '50%' },
            { sWidth: '15%' },
            { sWidth: '15%' },
            { sWidth: '15%' },
        ],
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'name' , sWidth:'5%'},
            { data: 'category_name' },
            { data: 'value' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });

         //delete zone here
         $('body').delegate('#delete_language','click',function(){
            // return console.log('hello');
              const id = $(this).attr('data-id');
              $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Are You Sure you want to delete this Question? ',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('manage-services.question-sub-type.delete') }}",
                                    method:"POST",
                                    data : {"_token":"{{ csrf_token() }}",id},
                                    success:function(res)
                                    {
                                        //return console.log(res);
                                        DataTable.ajax.reload();
                                        $.alert('Question Deleted Successfully!');;
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


           //change delete status here
           $('body').delegate('#change_status','click',function(){
              const id = $(this).attr('data-id');
              $.ajax({
                  url:"{{ route('manage-services.question-sub-type.status') }}",
                  method:"POST",
                  data : {"_token":"{{ csrf_token() }}",id},
                  success:function(res){
                    DataTable.ajax.reload();
                  },error:function(xhr){

                      console.log(xhr.responseText);
                  }
              });

           });

        });
</script>
