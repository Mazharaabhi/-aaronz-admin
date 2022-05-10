
<script>
    $(document).ready(function(){
         //for add new feature
         MakeMenuActive('#cms', '#pages');
         @include('messages.jquery-messages')
         var input_id = "{{ $languages[0]->id }}";

        //TODO: Creating slug for navbar menu
        $(`#title_${input_id}`).keyup(function(e)
        {
            CreateSlug($(this).val(), "#slug");
        });

        function CreateSlug(menu,slug)
        {
            //TODO: Converting Menu's String to lowercase
            var val = menu.toLowerCase();
           // console.log(val);
                $(slug).val(`/${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
        }

        $('body').delegate('#btn_lang','click',function()
        {
            var id = $(this).attr('data-id');
            hideInputs();
            $(`#div_title_${id}`).attr('class', 'col-md-4 mb-3');
            $(`#div_${id}`).attr('class', 'col-md-4 mb-3');
            $(`#div_review_${id}`).attr('class', 'col-md-12 mb-3');
            $(this).attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');

        });

        function hideInputs()
        {

            $('input[name="title[]"]').map(function(){
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



         //for add new staff
        $('#add_aronz_page').click(function(){
            const title_eng = $(`#title_${input_id}`).val();
            const description_eng = $(`#descriptions_${input_id}`).val();
            var image = $(`#fileupload-btn-one`).val();
            var bg_image = $(`#bg-image-fileupload`).val();
            const slug = $(`#slug`).val();
            const type_id = $(`#type_id`).val();
            const facebook = $(`#facebook`).val();
            const Instagram = $(`#Instagram`).val();
            const twitter = $(`#twitter`).val();
            const whatsapp = $(`#whatsapp`).val();
            const meta_title = $(`#meta_title`).val();
            const meta_description = $(`#meta_description`).val();
            const meta_keywords = $(`#meta_keywords`).val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            // var descriptions = $("textarea[name='descriptions[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title[]']").map(function(){return $(this).val();}).get();
          // console.log(languages);

          //***MAKING ARRAY OF DESC START HERE****//
            var descriptions=[];
            var desc_id="";
            for(var i=0;i<languages.length;i++){
                var desc_id = "descriptions_"+languages[i];
                data = CKEDITOR.instances[desc_id].getData();
                descriptions.push(data);
            }
          //  console.log(descriptions);
          //***MAKING ARRAY OF DESC START HERE****//
            //applying validations here
            if(!type_id){
                $('#type_id_error').html("Property Type required*");
              return  $(`#type_id`).focus();
            }else if(!title_eng){
                $('#title_error').html("Page Title required*");
              return  $(`#title_${input_id}`).focus();
            }else if(!image){
                $('#title_error').html("");
                $('#image_error').html("Page Logo required*");
              return  $('#fileupload-btn-one').focus();
            } else if(!bg_image){
                $('#title_error').html("");
                $('#image_error').html("");
                $('#bg_image_error').html("Page Background Image required*");
              return  $('#bg-image-fileupload').focus();
            } else {
                $('#bg_image_error').html("");
                $('#title_error').html("");
                $('#image_error').html("");
                 image = document.getElementById('fileupload-btn-one').files[0];
                 bg_image = document.getElementById('bg-image-fileupload').files[0];
                var formData = new FormData();
                formData.append('title_eng',title_eng);
                formData.append('slug',slug);
                formData.append('type_id',type_id);
                formData.append('meta_title',meta_title);
                formData.append('meta_description',meta_description);
                formData.append('meta_keywords',meta_keywords);
                formData.append('titles',titles);
                formData.append('image',image);
                formData.append('bg_image',bg_image);
                formData.append('facebook',facebook);
                formData.append('Instagram',Instagram);
                formData.append('twitter',twitter);
                formData.append('whatsapp',whatsapp);
                formData.append('languages',languages);
                formData.append('_token',_token);
                for(var count = 0; count<descriptions.length; count++){
                    formData.append("descriptions[]", descriptions[count]);
                }
                 $.ajax({
                     url:"{{ route('cms.pages.create-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#add_aronz_page').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#add_aronz_page').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#add_aronz_page').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add_aronz_page').html(`${save_icon} @lang('translation.save')`);
                        $('#add_aronz_page').attr('class',`${btn_cherwell } btn-block`);
                        $('#add_aronz_page').removeAttr('disabled');
                    },
                     success:function(res){
                     console.log(res);
                       if(res == "true"){
                        ToastSuccess("Aaronz Page Created Successfully");
                       }else if(res == 'type'){
                        $('#type_id_error').html("Already Page created against this type.");
                        $(`#type_id`).focus();
                       }else if(res == 'title'){
                        $('#title_error').html("This Page name is already exist.");
                        $(`#title_${input_id}`).focus();
                       }else if(res == 'slug'){
                        $('#slug_error').html("This Slug already taken.");
                        $(`#slug`).focus();
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

         //for BG-image preview
         function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#blah-two').attr('src', e.target.result);
            $('#blah-two').attr('class','d-block')
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }
        $("#bg-image-fileupload").change(function() {
        readURL1(this);
        });


    });
</script>
