
    <script src="{{ asset('admin/assets/plugins/custom/tagify/custom-tagify.js') }}"></script>
<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#c_properties_1', '#list_property', '');
        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        filter: true,
        dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('offplan.property.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'prop_ref_no' },
            { data: 'title' },
            { data: 'expire_date' },
            { data: 'state.name' },
            { data: 'sort_order' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });
        //TODO:CHANGE SORT ORDER STRAT HERE
    $('body').delegate('#property_sort_order', 'keyup', function()
        {
            var sort_order =  $(this).val();
            var id = $(this).attr("data-id");
         // return console.log(id);
            $.ajax({
                url:"{{ route('manage-properties.property.sort_order') }}",
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
         //delete zone here
         $('body').delegate('#delete_language','click',function(){
            // return console.log('hello');
              const id = $(this).attr('data-id');
              $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Are You Sure you want to delete this Property? ',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('manage-properties.property.delete') }}",
                                    method:"POST",
                                    data : {"_token":"{{ csrf_token() }}",id},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('Property Deleted Successfully!');;
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

//==========================================================
$('input[name="purpose"]').click(function(){
        var purpose =  $(this).val();
        if(purpose == 1 || purpose == 13 || purpose == 11){
             $('#subsale').show()
        }else{
            $('#subsale').hide()
        }
    });


        $('#quicksearch').click(function(){
            var purpose =  $('input[name="purpose"]:checked').val();
            var location_id =  $('#location_id').val();
            var ref_id = $('#ref_id').val();
          // return alert(ref_id);
            var category_id = $('#category_id').val();
            var beds_min = $('#beds_min').val();
            var beds_max = $('#beds_max').val();
            var hot =  $('input[name="hot"]:checked').val();
            var amenities =  $('#kt_select2_3').val();

            if(hot == undefined){
                hot=0
            }

            var signature =  $('input[name="signature"]:checked').val();
            if(signature == undefined){
                signature=0
            }
            var basic =  $('input[name="basic"]:checked').val();
            if(basic == undefined){
                basic=0
            }
            var verified =  $('input[name="verified"]:checked').val();
            if(verified == undefined){
                verified=0
            }
            var featured =  $('input[name="featured"]:checked').val();
            if(featured == undefined){
                featured=0
            }
            var boostsale =  $('input[name="boostsale"]:checked').val();
            if(boostsale == undefined){
                boostsale=0
            }

            var validation_status = $('#validation_status').val();
            var assigned = $('#assigned').val();
            var formData = new FormData();
            formData.append('purpose',purpose);
            formData.append('location_id',location_id);
            formData.append('ref_id',ref_id);
            formData.append('category_id',category_id);
            formData.append('beds_min',beds_min);
            formData.append('beds_max',beds_max);
            formData.append('hot',hot);
            formData.append('signature',signature);
            formData.append('basic',basic);
            formData.append('verified',verified);
            formData.append('featured',featured);
            formData.append('boostsale',boostsale);
            formData.append('validation_status',validation_status);
            formData.append('assigned',assigned);
            formData.append('amenities',amenities);

            formData.append('_token',"{{ csrf_token() }}");

                $.ajax({
                    type:'POST',
                    url:"{{route('manage-properties.property.quicksearch')}}" ,
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(res){
                       console.log(res)
                       $('#users-table').html(res);
                       //sss DataTable.ajax.reload();
                    },
                    error: function(data){
                        console.log("error");
                        console.log(data);
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
        //// IS_SIGNNATURE//
        $('body').delegate('#is_signature', 'click', function(){
            const id = $(this).parent().find('input[name="id"]').val();
            const is_signature = $(this).attr('data-id');
            const _token = "{{ csrf_token() }}";
            $.ajax({
                url:"{{ route('admin.dashboard.change_is_signatured') }}",
                method:"POST",
                data:{id, is_signature, _token},
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
   });
</script>
