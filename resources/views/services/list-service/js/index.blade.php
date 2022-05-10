

<script>

    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#services', '#list_service', '#services_anchor');
        GrandMenuActive('#services');
        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
                dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('manage-services.list-service.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'title' },
            { data: 'sub_service.name' },
            { data: 'service.name' },
            { data: 'image' },
            { data: 'status' },
            { data: 'live_status' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });

         //delete zone here
         $('body').delegate('#delete_language','click',function(){
            // return console.log('hello');
              const id = $(this).attr('data-id');
              $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Are You Sure you want to delete this Category? ',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('manage-services.list-service.delete') }}",
                                    method:"POST",
                                    data : {"_token":"{{ csrf_token() }}",id},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('Category Deleted Successfully!');;
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
           $('body').delegate('#no_live_status','click',function(){
                alert('Live status can only be set for Published Services By Admin');
           });

           //change delete status here
           $('body').delegate('#live_status','click',function(){
              const id = $(this).parent().find('input[name="id"]').val();
              const live_status = $(this).parent().find('input[name="live_status"]').val();
              $.ajax({
                  url:"{{ route('manage-services.list-service.live_status') }}",
                  method:"POST",
                  data : {"_token":"{{ csrf_token() }}",id, live_status},
                  success:function(res){
                    DataTable.ajax.reload();
                  },error:function(xhr){

                      console.log(xhr.responseText);
                  }
              });

           });

        });
</script>
