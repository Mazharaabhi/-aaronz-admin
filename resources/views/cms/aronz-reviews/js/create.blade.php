
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         var input_id = "{{ $languages[0]->id }}";

        $('body').delegate('#btn_lang','click',function()
        {
            var id = $(this).attr('data-id');

            hideInputs();
            $(`#div_designation_${id}`).attr('class', 'col-md-4 mb-3');
            $(`#div_title_${id}`).attr('class', 'col-md-4 mb-3');
            $(`#div_${id}`).attr('class', 'col-md-4 mb-3');
            $(`#div_review_${id}`).attr('class', 'col-md-12 mb-3');
            $(this).attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');

        });

        function hideInputs()
        {
            $('input[name="company_name[]"]').map(function(){
                $(this).parent().attr('class', 'd-none');
            });

            $('input[name="title[]"]').map(function(){
                $(this).parent().attr('class', 'd-none');
            });

            $('input[name="designation[]"]').map(function(){
                $(this).parent().attr('class', 'd-none');
            });

            $('textarea[name="descriptions_1"]').map(function(){
                $(this).parent().attr('class', 'd-none');
            });

            $('textarea[name="descriptions_2"]').map(function(){
                $(this).parent().attr('class', 'd-none');
            });


            $('.btn_lang').map(function(){
                $(this).attr('class', 'btn btn_lang mt-3');
            });
        }

         MakeMenuActive('#cms', '#aaron-review');
         $('#icon').change(function(){
            $('#show_icon').attr('class', `${$(this).val()} text-primary ml-5`);
         });


         //for add new staff
        $('#add_aronz_review').click(function(){
            const title_eng = $(`#title_${input_id}`).val();
            const company_name_eng = $(`#company_name_${input_id}`).val();
            const designation_eng = $(`#designation_${input_id}`).val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var company_names = $("input[name='company_name[]']").map(function(){return $(this).val();}).get();
            var designations = $("input[name='designation[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title[]']").map(function(){return $(this).val();}).get();
            //applying validations here
            if(!title_eng){
                $('#title_error').html("Title required*");
              return  $(`#title_${input_id}`).focus();
            }
            else if(!designation_eng){
                $('#company_name_error').html("");
                $('#designation_error').html("Descriptions required*");
              return  $('#designation').focus();
            }else {
                $('#title_error').html("");
                $('#designation_error').html("");
                $('#review_error').html("");
                //***MAKING ARRAY OF DESC START HERE****//
                var descriptions=[];
                var desc_id="";
                for(var i=0;i<languages.length;i++){
                    var desc_id = "descriptions_"+languages[i];
                    data = CKEDITOR.instances[desc_id].getData();
                    descriptions.push(data);
                }
            //***MAKING ARRAY OF DESC START HERE****//
                var formData = new FormData();
                formData.append('company_name_eng',company_name_eng);
                formData.append('title_eng',title_eng);
                formData.append('designation_eng',designation_eng);
                formData.append('company_names',company_names);
                formData.append('designations',designations);
                formData.append('titles',titles);
                formData.append('languages',languages);
                formData.append('_token',_token);
                for(var count = 0; count<descriptions.length; count++){
                    formData.append("descriptions[]", descriptions[count]);
                }
                 $.ajax({
                     url:"{{ route('cms.aronz-reviews.create-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#add_aronz_review').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#add_aronz_review').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#add_aronz_review').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add_aronz_review').html(`${save_icon} @lang('translation.save')`);
                        $('#add_aronz_review').attr('class',`${btn_cherwell } btn-block`);
                        $('#add_aronz_review').removeAttr('disabled');
                    },
                     success:function(res){
                       console.log(res);
                       if(res == "true"){
                        $('#company_name').val('');
                        $('#designation').val('');
                        $('#review').val('');
                        $('#button_link').val('');
                        ToastSuccess("Aaronz Review Created Successfully");
                       }
                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });
            }
        });


        //for image preview
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#blah-one').attr('src', e.target.result);
            $('#blah-one').attr('class','d-block')
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }
        $("#fileupload-btn-one").change(function() {
        readURL(this);
        });


    });
</script>
