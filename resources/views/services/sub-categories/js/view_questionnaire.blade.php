<script>
    $(document).ready(function(){
        get_questionnaire("{{ $category->id }}");

        function get_questionnaire(service_sub_category_id){
            $.ajax({
                url:"{{ route('manage-services.sub-category.get_questionnaire') }}",
                method:"GET",
                data:{service_sub_category_id},
                success:function(res){
                    $('#questionnaire_div').html(res);
                },error:function(xhr){
                    console.log(xhr.responseText)
                }
            });
        }
    })
</script>
