

<script>

    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#c_properties_1', '#list_property', '');
        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        dom: '<"top"i>rt<"bottom"flp><"clear">',
        ajax: "{{ route('manage-properties.property.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'title' },
            { data: 'compact_price' },
            { data: 'category.name' },
            { data: 'type.name' },
            { data: 'expire_date' },
            { data: 'developer.name' },
            { data: 'agent.name' },
            { data: 'state.name' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });

         //delete zone here
         $('body').delegate('#delete_language','click',function(){
            // return console.log('hello');
              const id = $(this).attr('data-id');
              $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Are You Sure you want to delete this Amenity? ',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('manage-properties.property-settings.amenities.delete') }}",
                                    method:"POST",
                                    data : {"_token":"{{ csrf_token() }}",id},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('Amenity Deleted Successfully!');;
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
                  url:"{{ route('manage-properties.property-settings.amenities.status') }}",
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
