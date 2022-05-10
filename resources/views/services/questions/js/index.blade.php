

<script>

    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#services', '#service-questions', '#service_anchor');
        GrandMenuActive('#services');
        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
                dom: '<"top"><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('manage-services.question.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'name' },
            { data: 'service_sub_category.name' },
            { data: 'service_category.name' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });
        $(`#category`).change(function(){
            const service_category_id = $(this).val();
            getServiceSubCategories(service_category_id)
        });

        function getServiceSubCategories(service_category_id){
            $.ajax({
                url:"{{ route('manage-services.list-service.get_sub_services') }}",
                method:"POST",
                data:{service_category_id,_token},
                success:function(res){
                    $(`#sub_category_id`).html(res);
                },error:function(xhr){
                    console.log(xhr.responseText)
                }
            });
        }

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
                                    url:"{{ route('manage-services.question.delete') }}",
                                    method:"POST",
                                    data : {"_token":"{{ csrf_token() }}",id},
                                    success:function(res)
                                    {
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
                  url:"{{ route('manage-services.question.status') }}",
                  method:"POST",
                  data : {"_token":"{{ csrf_token() }}",id},
                  success:function(res){
                    DataTable.ajax.reload();
                  },error:function(xhr){

                      console.log(xhr.responseText);
                  }
              });

           });

           ///search//
           $('#search').on('click',function(){
            const category_id = $('#category').val();
            const sub_category_id = $('#sub_category_id').val();
            if(!category_id)
            {
                $('#category_id_error').html('Category Required*')
            }else if(!sub_category_id){
                $('#sub_category_id_error').html('Sub Category Required*')
            }else{
                $.ajax({
                    url:"{{ route('search-category-questions') }}",
                    method:"POST",
                    data:{category_id,sub_category_id,_token},
                    success:function(res){
                     $('#users-table').html(res)
                   // return console.log(res);
                    },error:function(xhr){
                        console.log(xhr.responseText)
                    }
                });
              }
           });

        });
</script>
