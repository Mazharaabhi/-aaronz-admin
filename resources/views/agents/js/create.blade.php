<script>
$(document).ready(function(){
   @include('messages.jquery-messages')
   MakeMenuActive('#companies', '#manage_companies', '#service_anchor');


    //TODO: Generating Random Passowrd
    $('#generate_password').click(function(){
        var randomstring = Math.random().toString(36).slice(-8);
        $('#password').val(randomstring);
        $('#confirm_password').val(randomstring);
    });

    //TODO: Removing the spaces from the password and from confirm_password here
    $('#password').keypress(function(event)
        {
            var key = event.keyCode;
            if (key === 32) {
            event.preventDefault();
        }
    });

    $('#confirm_password').keypress(function(event)
        {
            var key = event.keyCode;
            if (key === 32) {
            event.preventDefault();
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

    //Getting Areas as Per City
    $('#state_id').change(function(){
        const state_id = $(this).val();

        $.ajax({
            url:"{{ route('get.areas') }}",
            method:"POST",
            data:{state_id,_token},
            success:function(res)
            {
                $('#area_id').html(res);
            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });

    });

   //TODO: Creating new navbar menu
   $('#save').click(function()
   {
       const name = $('#name').val();
       const designation = $('#designation').val();
       const new_email = $('#new_email').val();
       const brn = $('#brn').val();
       var phone = $('#phone').val();
       const key_location = $('#key_location').val();
       const state = $('#state_id').val();
       const area_id = $('#area_id').val();
       const address = $('#address').val();
       const nationality = $('#nationality').val();
       const specialities = $('#specialities').val();
       const languages = $('#langs').val();
       const rera_no = $('#rera_no').val();
       const meta_title = $(`#meta_title`).val();
       const meta_description = $(`#meta_description`).val();
       const password = $('#password').val();
       const confirm_password = $('#confirm_password').val();
       const image = document.getElementById('fileupload-btn-one').files[0];
       const about = CKEDITOR.instances['descriptions'].getData();
       var is_company_contact =  $('input[name="is_company_contact"]:checked').val();
       var is_managment =  $('input[name="is_managment"]:checked').val();
        if(is_company_contact =='on'){
            is_company_contact = 1 ;
        }else {
            is_company_contact = 0 ;
        }
        //CHECK MANAGMNET//
        if(is_managment =='on'){
            is_managment = 1 ;
        }else {
            is_managment = 0 ;
        }
       //TODO: Regular Expression For Email
       var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       const checkEmail = emailReg.test( new_email );


       //TODO: Applying Validations Here
       if(!name || !$.trim(name).length)
       {
           $('#name_error').html("@lang('translation.name_is_required')");
           return $('#name').focus();
       }
       else if(name.length <= 2)
       {
           $('#name_error').html("@lang('translation.name_length_error')");
           return $('#name').focus();
       }
       else if(!designation || !$.trim(designation).length)
       {
           $('#name_error').html("");
           $('#designation_error').html("@lang('translation.designation_required')");
           return $('#designation').focus();
       }
       else if(designation.length <= 2)
       {
           $('#name_error').html("");
           $('#designation_error').html("@lang('translation.designation_required')");
           return $('#designation').focus();
       }
       else if(new_email == "")
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("@lang('translation.email_is_required')");
           return $('#new_email').focus();
       }
       else if(checkEmail == false)
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("@lang('translation.email_format_is_not_valid')");
           return $('#new_email').focus();
       }
       else if(!phone)
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("The phone field is required");
           return $('#phone_error').focus();
       }
       else if(!state)
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           return $('#state_id_error').html("Please select a state.");
       }
       else if(area_id == "")
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#state_id_error').html("");
           return $('#area_id_error').html("Please select areas.");
       }
       else if(!$.trim(address).length)
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#state_id_error').html("");
           $('#area_id_error').html("");
           $('#address_error').html("The address field is required.");
           return $('#address').focus();
       }
       else if(!$.trim(nationality).length)
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#state_id_error').html("");
           $('#state_id_error').html("");
           $('#address_error').html("");
           $('#nationality_error').html("The nationality field is required.");
           return $('#nationality').focus();
       }
       else if(languages == "")
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#state_id_error').html("");
           $('#state_id_error').html("");
           $('#address_error').html("");
           $('#nationality_error').html("");
           return $('#languages_error').html("Please select languages.");
       }
       else if(!password || !$.trim(password).length)
        {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#state_id_error').html("");
           $('#state_id_error').html("");
           $('#address_error').html("");
           $('#nationality_error').html("");
           $('#languages_error').html("");
           $('#image_error').html("");
            $('#password_error').html("@lang('translation.password_is_required')");
            return $('#password').focus();
        }
        else if(password.length <= 5)
        {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#state_id_error').html("");
           $('#state_id_error').html("");
           $('#address_error').html("");
           $('#nationality_error').html("");
           $('#languages_error').html("");
           $('#image_error').html("");
            $('#password_error').html("@lang('translation.password_length_error')");
            return $('#password').focus();
        }
        else if(!confirm_password)
        {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#state_id_error').html("");
           $('#state_id_error').html("");
           $('#address_error').html("");
           $('#nationality_error').html("");
           $('#languages_error').html("");
           $('#password_error').html("");
           $('#image_error').html("");
           $('#confirm_password_error').html("@lang('translation.confirm_password_is_required')");
           return $('#confirm_password').focus();
        }
        else if(confirm_password != password)
        {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#state_id_error').html("");
           $('#state_id_error').html("");
           $('#address_error').html("");
           $('#nationality_error').html("");
           $('#languages_error').html("");
           $('#password_error').html("");
           $('#image_error').html("");
           $('#confirm_password_error').html("@lang('translation.password_are_not_matched')");
           return $('#confirm_password').focus();
        }
       else if(!image)
       {
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#state_id_error').html("");
           $('#state_id_error').html("");
           $('#address_error').html("");
           $('#nationality_error').html("");
           $('#languages_error').html("");
           return $('#image_error').html("The image field is required.");
       }
        else{
           $('#name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#state_id_error').html("");
           $('#state_id_error').html("");
           $('#address_error').html("");
           $('#nationality_error').html("");
           $('#languages_error').html("");
           $('#password_error').html("");
           $('#image_error').html("");
           $('#confirm_password_error').html("");
           phone = $('.iti__selected-dial-code').text()+$('#phone').val();
           //TODO: Initializing Form Data Object
           const formData = new FormData;
           formData.append('name', name);
           formData.append('nationality', nationality);
           formData.append('designation', designation);
           formData.append('email', new_email);
           formData.append('brn', brn);
           formData.append('password', password);
           formData.append('real_password', password);
           formData.append('confirm_password', confirm_password);
           formData.append('phone', phone);
           formData.append('key_location', key_location);
           formData.append('image', image);
           formData.append('address', address);
           formData.append('languages', languages);
           formData.append('specialities', specialities);
           formData.append('meta_title',meta_title);
           formData.append('meta_description',meta_description);
           formData.append('state', state);
           formData.append('about', about);
           formData.append('is_company',is_company_contact);
           formData.append('is_management',is_managment);
           formData.append('area_id', area_id);
           formData.append('_token', _token);
           //TODO: Seding Ajax Requrest for creating navbar menu
           $.ajax({
               url:"{{ route('manage-agents.create-process') }}",
               method:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:false,
               beforeSend:function()
               {
                   $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                   $('#save').attr('class',`btn btn-charwell btn-block  ${spinner}`);
                   $('#save').attr('disabled',true);
               },
               complete:function()
               {
                   $('#save').html(`${save_icon} @lang('translation.add_company')`);
                   $('#save').attr('class',`btn btn-charwell btn-block`);
                   $('#save').removeAttr('disabled');
               },
               success:function(res)
               {
                  // return console.log(res);
                   if(res == "true"){
                       ToastSuccess("Agent Created Successfully!");
                       $('#name').val('');
                       $('#designation').val('');
                       $('#brn').val('');
                       $('#new_email').val('');
                       $('#password').val('');
                       $('#confirm_password').val('');
                       $('#fileupload-btn-one').val('');
                       $('#blah-one').attr('class', 'd-none');
                       $('#blah-one').attr('src', '');
                       $('#phone').val('');
                       $('#address').val('');
                       $('#about').val('');
                       $('#area_id').val('');
                       $('#state_id').val('');
                       $('#state').val('');
                       $('#name').focus();
                   }
                   else if(res == "Cyber")
                   {
                       ToastError("warning", "@lang('translation.cyber_message')");
                   }
                   else if(res == "email")
                   {
                       $('#new_email_error').html("@lang('translation.email_already_taken')");
                       return $('#new_email').focus();
                   }
                   else if(res == "phone")
                   {
                       $('#phone_error').html("This phone number is already taken.");
                       return $('#phone').focus();
                   }
                   else if(res == "email_template")
                   {
                    Message('Violation', "Email Template not found for Register Company Please Create One!", 'red');
                   }
               },error:function(xhr)
               {
                   console.log(xhr.responseText);
               }
           });
       }
   });



});
</script>
