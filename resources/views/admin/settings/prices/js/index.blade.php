

<script>

    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#c_settings', '#prices', '#cms_anchor');
        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
                dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('admin.settings.prices.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'types.name' },
            { data: 'amount' },
            { data: 'decimal_amount' },
            { data: 'compact_amount' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });

         //delete zone here
         $('body').delegate('#delete_unit','click',function(){
            // return console.log('hello');
              const id = $(this).attr('data-id');
              $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Are You Sure you want to delete this Price? ',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('admin.settings.prices.delete') }}",
                                    method:"POST",
                                    data : {"_token":"{{ csrf_token() }}",id},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('Price Deleted Successfully!');;
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
              const option = $(this);

              $.ajax({
                  url:"{{ route('admin.settings.prices.status') }}",
                  method:"POST",
                  data : {"_token":"{{ csrf_token() }}",id},
                  success:function(res){
                    DataTable.ajax.reload();
                  },error:function(xhr){

                      console.log(xhr.responseText);
                  }
              });

           });

           //Make Default Language
           $('body').delegate('#make_default','click',function(){
              const id = $(this).attr('data-id');
              const option = $(this);
              $.ajax({
                  url:"{{ route('admin.settings.prices.make-default') }}",
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
