@if (auth()->user()->role_id == 1)
 <script>
    $(document).ready(function(){
        @include('messages.jquery-messages');

        MakeMenuActive('#dashboard_menu','');

          //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('admin.dashboard.admin_get_properties')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'title' },
            { data: 'expire_date' },
            { data: 'state.name' },
            { data: 'is_verified' },
            { data: 'is_featured' },
            { data: 'is_boost' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });

          //TODO: Getting Data and passing into yajra datatables
          var DataTablee = $('#services-table').DataTable({
        processing: true,
        serverSide: true,
        dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('admin.dashboard.admin_get_services')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'company.company_name' },
            { data: 'title' },
            { data: 'image' },
            { data: 'daily_charges' },
            { data: 'hourly_charges' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });


        $('body').delegate('#is_featured', 'click', function(){
            const id = $(this).parent().find('input[name="id"]').val();
            const is_verified = $(this).attr('data-id');
            const _token = "{{ csrf_token() }}";

            $.ajax({
                url:"{{ route('admin.dashboard.change_is_featured') }}",
                method:"POST",
                data:{id, is_verified, _token},
                success:function(res){
                    DataTable.ajax.reload();
                },error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        });

        $('body').delegate('#is_verified', 'click', function(){
            const id = $(this).parent().find('input[name="id"]').val();
            const is_verified = $(this).attr('data-id');
            const _token = "{{ csrf_token() }}";

            $.ajax({
                url:"{{ route('admin.dashboard.change_is_verified') }}",
                method:"POST",
                data:{id, is_verified, _token},
                success:function(res){
                    DataTable.ajax.reload();
                },error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        });

        $('body').delegate('#is_featured', 'click', function(){
            const id = $(this).parent().find('input[name="id"]').val();
            const is_featured = $(this).attr('data-id');
            const _token = "{{ csrf_token() }}";

            $.ajax({
                url:"{{ route('admin.dashboard.change_is_featured') }}",
                method:"POST",
                data:{id, is_featured, _token},
                success:function(res){
                    DataTable.ajax.reload();
                },error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        });

        $('body').delegate('#is_boost', 'click', function(){
            const id = $(this).parent().find('input[name="id"]').val();
            const is_boost = $(this).attr('data-id');
            const _token = "{{ csrf_token() }}";

            $.ajax({
                url:"{{ route('admin.dashboard.change_is_boost') }}",
                method:"POST",
                data:{id, is_boost, _token},
                success:function(res){
                    DataTable.ajax.reload();
                },error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        });

        //change delete status here
           $('body').delegate('#property_status','change',function(){
              const id = $(this).parent().find('input[name="id"]').val();
              const status = $(this).val();
              $.ajax({
                  url:"{{ route('admin.dashboard.change_property_status') }}",
                  method:"POST",
                  data : {"_token":"{{ csrf_token() }}",id, status},
                  success:function(res){
                    DataTable.ajax.reload();
                  },error:function(xhr){

                      console.log(xhr.responseText);
                  }
              });

           });

           $('body').delegate('#service_status','change',function(){
              const id = $(this).parent().find('input[name="id"]').val();
              const status = $(this).val();
              $.ajax({
                  url:"{{ route('admin.dashboard.change_service_status') }}",
                  method:"POST",
                  data : {"_token":"{{ csrf_token() }}",id, status},
                  success:function(res){
                    DataTablee.ajax.reload();
                  },error:function(xhr){

                      console.log(xhr.responseText);
                  }
              });

           });

    });
</script>
@elseif(auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
<script>
    $(document).ready(function(){
        @include('messages.jquery-messages');

        MakeMenuActive('#dashboard_menu','');

          //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,

                   dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('admin.dashboard.get_properties')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'title' },
            { data: 'expire_date' },
            { data: 'developer.name' },
            { data: 'state.name' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });

    });
</script>
@elseif(auth()->user()->role_id == 5)
<script>
    $(document).ready(function(){
        @include('messages.jquery-messages');
        MakeMenuActive('#dashboard_menu','');

        //TODO: Getting Data and passing into yajra datatables
        var DataTablee = $('#services-table').DataTable({
        processing: true,
        serverSide: true,
        dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('admin.dashboard.admin_get_services')  }}",
        columns: [
        { data: 'DT_RowIndex' },
        { data: 'company.company_name' },
        { data: 'title' },
        { data: 'image' },
        { data: 'daily_charges' },
        { data: 'hourly_charges' },
        { data: 'status' },
        { data: 'live_status' },
        { data: 'action', orderable: false, searchable: false}
        ]
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
                    DataTablee.ajax.reload();
                  },error:function(xhr){

                      console.log(xhr.responseText);
                  }
              });

           });

    })
</script>
@endif

