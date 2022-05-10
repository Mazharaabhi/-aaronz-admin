<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#cms', '#cms_life_at_aaronz');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
                dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('cms.life-at-aaronz.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'video_url' },
            { data: 'sort_order' },
            { data: 'status', orderable: false, searchable: false},
            { data: 'action', orderable: false, searchable: false}
            ]
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
                url:"{{ route('cms.navbar-menu.sort') }}",
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


           //change delete status here
           $('body').delegate('#change_status','click',function(){
              const id = $(this).attr('data-id');
              const option = $(this);
              $.ajax({
                  url:"{{ route('cms.life-at-aaronz.status') }}",
                  method:"POST",
                  data : {"_token":"{{ csrf_token() }}",id},
                  success:function(res){
                    DataTable.ajax.reload();
                  },error:function(xhr){
                      console.log(xhr.responseText);
                  }
                });
            });

        //delete Life at Aaronz here
         $('body').delegate('#delete_life_at_aaronz','click',function(){
            // return console.log('hello');
              const id = $(this).attr('data-id');
              $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Are You Sure you want to delete this Video URL? ',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('cms.life-at-aaronz.delete') }}",
                                    method:"POST",
                                    data : {"_token":"{{ csrf_token() }}",id},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('Video URL Deleted Successfully!');;
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
                url:"{{ route('cms-life-at-aaronz.sort.order') }}",
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
