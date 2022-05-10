

<script>

    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#c_settings', '#c_languages', '#cms_anchor');
        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
                dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('admin.settings.languages.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'name' },
            { data: 'direction' },
            { data: 'flag_image' },
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
                    content: 'Are You Sure you want to delete this Language? ',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('admin.settings.languages.delete') }}",
                                    method:"POST",
                                    data : {"_token":"{{ csrf_token() }}",id},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('Language Deleted Successfully!');;
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
                  url:"{{ route('admin.settings.units.status') }}",
                  method:"POST",
                  data : {"_token":"{{ csrf_token() }}",id},
                  success:function(res){
                    if(res == 0){
                        option.attr('checked',false);
                    }else{
                        option.attr('checked',true);
                    }
                  },error:function(xhr){

                      console.log(xhr.responseText);
                  }
              });

           });

        });
</script>
