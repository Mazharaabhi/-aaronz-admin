{{-- Function Load Property Categories --}}
function loadPropertyCategories(){
    const property_type_id = $('#type_id :selected').val();
    $.ajax({
        url:"{{ route('manage-properties.property-parameters.get-property-categories') }}",
        method:"GET",
        data:{property_type_id},
        success:function(res)
        {
            $('#category_id').html(res);
        },
        error:function(xhr)
        {
            console.log(xhr.responseText);
        }
    });
}
{{-- /End Function Load Property Categories --}}

{{-- Function Load Property Parent Categories --}}
function loadPropertyParentCategories(){
    const property_type_id = $('#type_id :selected').val();
    $.ajax({
        url:"{{ route('manage-properties.property-parameters.get-property-parent-categories') }}",
        method:"GET",
        data:{property_type_id},
        success:function(res)
        {
            $('#prop_parent_id').html(res);
        },
        error:function(xhr)
        {
            console.log(xhr.responseText);
        }
    });
}
{{-- /End Function Load Property Parent Categories --}}

{{-- Function Load Property Status --}}
function loadPropertyStatus(){
    const property_type_id = $('#type_id :selected').val();
    $.ajax({
        url:"{{ route('manage-properties.property-parameters.get-property-status') }}",
        method:"GET",
        data:{property_type_id},
        success:function(res)
        {
            $('#property_status_id').html(res);
        },
        error:function(xhr)
        {
            console.log(xhr.responseText);
        }
    });
}
{{-- /End Function Load Property Status --}}

{{-- Function Load Property Status --}}
function loadPropertyViews(){
    $.ajax({
        url:"{{ route('manage-properties.property-parameters.get-property-views') }}",
        method:"GET",
        success:function(res)
        {
            $('#view_id').html(res);
            console.log(res);
        },
        error:function(xhr)
        {
            console.log(xhr.responseText);
        }
    });
}
{{-- /End Function Load Property Status --}}

{{-- Function Load Property Developers --}}
function loadPropertyDevelopers(){
    $.ajax({
        url:"{{ route('manage-properties.property-parameters.get-property-developers') }}",
        method:"GET",
        success:function(res)
        {
            $('#developer_id').html(res);
        },
        error:function(xhr)
        {
            console.log(xhr.responseText);
        }
    });
}
{{-- /End Function Load Property Developers --}}

{{-- Function Load Property Agents --}}
function loadPropertyAgents(){
    $.ajax({
        url:"{{ route('manage-properties.property-parameters.get-property-agents') }}",
        method:"GET",
        success:function(res)
        {
            $('#agent_id').html(res);
        },
        error:function(xhr)
        {
            console.log(xhr.responseText);
        }
    });
}
{{-- /End Function Load Property Agents --}}

{{-- Creating Slug here for Add Categories --}}
{{-- //making slug/url here --}}
$(`#prop_cat_name`).keyup(function(e){
    var menu = $(this).val();
    //replaceing the string to lowercase
    var val = menu.toLowerCase();
    $('#slug').val(`/${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
});
{{-- //TODO: Checkbox handling here --}}
        $('body').delegate('.chk-col-green', 'click', function(){
            if($(this).val() == 0)
            {
                $(this).val(1);
            }
            else
            {
                $(this).val(0);
            }
        });
{{-- /End Careting Slug for Add Categories --}}
{{-- Hide Showing Divs For Add Property Categry --}}
$('#prop_level').change(function(){
    if($(this).val() == 1)
    {
        $('#prop_parent_div').attr('class', 'col-md-12 col-lg-12 col-sm-12 mb-5 w-100 d-none');
        $('#prop_includes_div').attr('class', 'col-md-12 mb-3 d-none');
    }
    else
    {
        $('#prop_parent_div').attr('class', 'col-md-12 col-lg-12 col-sm-12 mb-5 w-100');
        $('#prop_includes_div').attr('class', 'col-md-12 mb-3');
    }
});
{{-- Function For Creating Properties --}}
$('#save_property_category').click(function(){
    const property_type_id = $('#type_id :selected').val();
    const name = $('#prop_cat_name').val();
    const slug = $('#slug').val();
    const prop_level = $('#prop_level :selected').val();
    const property_category_id = $('#prop_parent_id').val();
    const has_bed = $("input[name='bedroom']").val();
    const has_bath = $("input[name='washroom']").val();

    {{-- Applying Validation Here --}}
    if(!$.trim(name).length)
    {
        $('#prop_cat_name_error').html('The category name field is required.');
        return $('#prop_cat_name').focus();
    }
    else if(name.length < 3)
    {
        $('#prop_cat_name_error').html('The category name length should be atleast 3 characters.');
        return $('#prop_cat_name').focus();
    }
    else if(prop_level == 2 && property_category_id == "")
    {
        $('#prop_cat_name_error').html('');
        return $('#prop_parent_id_error').html('Please select category id.');
    }
    else
    {
        $('#prop_cat_name_error').html('');
        $('#prop_parent_id_error').html('');

        $.ajax({
            url:"{{ route('manage-properties.property-parameters.create-property-categories') }}",
            method:"POST",
            data:{property_type_id, slug ,name, has_bed, has_bath ,prop_level, property_category_id, _token},
            beforeSend:function()
            {
                $('#save_property_category').html(`${save_icon} @lang('translation.please_wait')`);
                $('#save_property_category').attr('class',`btn btn-cherwell font-weight-bold  ${spinner}`);
                $('#save_property_category').attr('disabled',true);
            },
            complete:function()
            {
                $('#save_property_category').html(`${save_icon} Save Changes`);
                $('#save_property_category').attr('class',`btn btn-cherwell font-weight-bold`);
                $('#save_property_category').removeAttr('disabled');
            },
            success:function(res)
            {
                if(res == "true"){
                    $('#slug').val("");
                    $(`#prop_cat_name`).val('');
                    $(`#prop_cat_name`).focus();
                    ToastSuccess("Category Created Successfully");
                    loadPropertyCategories();
                    loadPropertyParentCategories();
                   }else if(res == 'title'){
                    $('#prop_cat_name_error').html("This category name is already exist.");
                    $('#prop_cat_name').focus();
                   }
            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });

    }
});
{{-- /End Function For Creating Properties --}}

{{-- Function For Creating Properties Sattus --}}
$('#add_property_status').click(function(){
    const type_id = $('#prop_type_id').val();
    const name = $('#prop_status_name').val();
    {{-- Applying Validation Here --}}
    if(type_id == ""){
       return $('#prop_type_id_error').html('Please select property type.');
    }
    else if(!$.trim(name).length)
    {
        $('#prop_type_id_error').html('');
        $('#prop_status_name_error').html('The status name field is required.');
        return $('#prop_status_name').focus();
    }
    else if(name.length < 3)
    {
        $('#prop_type_id_error').html('');
        $('#prop_status_name_error').html('The status name length should be atleast 3 characters.');
        return $('#prop_status_name').focus();
    }
    else
    {
        $('#prop_type_id_error').html('');
        $('#prop_status_name_error').html('');

        $.ajax({
            url:"{{ route('manage-properties.property-parameters.create-property-status') }}",
            method:"POST",
            data:{type_id, name, _token},
            beforeSend:function()
            {
                $('#add_property_status').html(`${save_icon} @lang('translation.please_wait')`);
                $('#add_property_status').attr('class',`btn btn-cherwell font-weight-bold  ${spinner}`);
                $('#add_property_status').attr('disabled',true);
            },
            complete:function()
            {
                $('#add_property_status').html(`${save_icon} Save Changes`);
                $('#add_property_status').attr('class',`btn btn-cherwell font-weight-bold`);
                $('#add_property_status').removeAttr('disabled');
            },
            success:function(res)
            {
                if(res == "true"){
                    $(`#prop_status_name`).val('');
                    ToastSuccess("Property Status Created Successfully");
                    loadPropertyStatus();
                   }else if(res == 'title'){
                    $('#prop_status_name_error').html("This status name is already exist.");
                    $('#prop_status_name').focus();
                   }
            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });

    }
});
{{-- /End Function For Creating Properties --}}

{{-- Function For Creating Properties View --}}
$('#add_property_view').click(function(){
    const name = $('#prop_view_name').val();
    {{-- Applying Validation Here --}}
    if(!$.trim(name).length)
    {
        $('#prop_view_name_error').html('The view name field is required.');
        return $('#prop_view_name').focus();
    }
    else if(name.length < 3)
    {
        $('#prop_view_name_error').html('The view name length should be atleast 3 characters.');
        return $('#prop_view_name').focus();
    }
    else
    {
        $('#prop_view_name_error').html('');

        $.ajax({
            url:"{{ route('manage-properties.property-parameters.create-property-views') }}",
            method:"POST",
            data:{name, _token},
            beforeSend:function()
            {
                $('#add_property_view').html(`${save_icon} @lang('translation.please_wait')`);
                $('#add_property_view').attr('class',`btn btn-cherwell font-weight-bold  ${spinner}`);
                $('#add_property_view').attr('disabled',true);
            },
            complete:function()
            {
                $('#add_property_view').html(`${save_icon} Save Changes`);
                $('#add_property_view').attr('class',`btn btn-cherwell font-weight-bold`);
                $('#add_property_view').removeAttr('disabled');
            },
            success:function(res)
            {
                if(res == "true"){
                    $(`#prop_view_name`).val('');
                    ToastSuccess("Property View Created Successfully");
                    loadPropertyViews();
                   }else if(res == 'title'){
                    $('#prop_view_name_error').html("This view name is already exist.");
                    $('#prop_view_name').focus();
                   }
            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });

    }
});
{{-- /End Function For Creating Properties --}}

{{-- Image Preview For Developers --}}
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
{{-- End Image preview For Developers --}}

{{-- Function For Creating Properties View --}}
$('#add_property_developer').click(function(){
    const name = $('#prop_developer_name').val();
    const image = document.getElementById('fileupload-btn-one').files[0];
    {{-- Applying Validation Here --}}
    if(!$.trim(name).length)
    {
        $('#prop_developer_name_error').html('The developer name field is required.');
        return $('#prop_developer_name').focus();
    }
    else if(name.length < 3)
    {
        $('#prop_developer_name_error').html('The developer name length should be atleast 3 characters.');
        return $('#prop_developer_name').focus();
    }
    else
    {
        $('#prop_developer_name_error').html('');

        var formData = new FormData();
        formData.append('name',name);
        formData.append('image',image);
        formData.append('_token',_token);

        $.ajax({
            url:"{{ route('manage-properties.property-parameters.create-property-developers') }}",
            method:"POST",
            data:formData,
            contentType:false,
            processData:false,
            cache:false,
            beforeSend:function()
            {
                $('#add_property_developer').html(`${save_icon} @lang('translation.please_wait')`);
                $('#add_property_developer').attr('class',`btn btn-cherwell font-weight-bold  ${spinner}`);
                $('#add_property_developer').attr('disabled',true);
            },
            complete:function()
            {
                $('#add_property_developer').html(`${save_icon} Save Changes`);
                $('#add_property_developer').attr('class',`btn btn-cherwell font-weight-bold`);
                $('#add_property_developer').removeAttr('disabled');
            },
            success:function(res)
            {
                if(res == "true"){
                    $(`#prop_developer_name`).val('');
                    $('#blah-one').attr('src', '');
                    $('#blah-one').attr('class','d-none');
                    ToastSuccess("Property Developer Created Successfully");
                    loadPropertyDevelopers();
                   }else if(res == 'title'){
                    $('#prop_developer_name_error').html("This developer name is already exist.");
                    $('#prop_developer_name').focus();
                   }
            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });

    }
});
{{-- /End Function For Creating Properties --}}

{{-- Generating Dynamic Password Here --}}
    $('#generate_password').click(function(){
        var randomstring = Math.random().toString(36).slice(-8);
        $('#password').val(randomstring);
        $('#confirm_password').val(randomstring);
    });

    {{-- //TODO: Removing the spaces from the password and from confirm_password here --}}
    $('#password').keypress(function(event)
        {
            var key = event.keyCode;
            if (key === 32) {
            event.preventDefault();
        }
    });
{{-- Function For Creating Properties Agent --}}
$('#add_property_agent').click(function(){
        const name = $('#agent_name').val();
       const designation = $('#designation').val();
       const new_email = $('#new_email').val();
       const phone = $('#phone').val();
       const password = $('#password').val();
       const confirm_password = $('#confirm_password').val();

       //TODO: Regular Expression For Email
       var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       const checkEmail = emailReg.test( new_email );
    {{-- Applying Validation Here --}}
     //TODO: Applying Validations Here
       if(!name || !$.trim(name).length)
       {
           $('#agent_name_error').html("@lang('translation.name_is_required')");
           return $('#agent_name').focus();
       }
       else if(name.length <= 2)
       {
           $('#agent_name_error').html("@lang('translation.name_length_error')");
           return $('#name').focus();
       }
       else if(!designation || !$.trim(designation).length)
       {
           $('#agent_name_error').html("");
           $('#designation_error').html("@lang('translation.designation_required')");
           return $('#designation').focus();
       }
       else if(designation.length <= 2)
       {
           $('#agent_name_error').html("");
           $('#designation_error').html("@lang('translation.designation_required')");
           return $('#designation').focus();
       }
       else if(new_email == "")
       {
           $('#agent_name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("@lang('translation.email_is_required')");
           return $('#new_email').focus();
       }
       else if(checkEmail == false)
       {
           $('#agent_name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("@lang('translation.email_format_is_not_valid')");
           return $('#new_email').focus();
       }
       else if(!phone)
       {
           $('#agent_name_error').html("");
           $('#designation_error').html("");
           $('#company_name_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("The phone field is required");
           return $('#phone_error').focus();
       }
       else if(!password || !$.trim(password).length)
        {
           $('#agent_name_error').html("");
           $('#designation_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
            $('#password_error').html("@lang('translation.password_is_required')");
            return $('#password').focus();
        }
        else if(password.length <= 5)
        {
           $('#agent_name_error').html("");
           $('#designation_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
            $('#password_error').html("@lang('translation.password_length_error')");
            return $('#password').focus();
        }
        else if(!confirm_password)
        {
           $('#agent_name_error').html("");
           $('#designation_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#confirm_password_error').html("@lang('translation.confirm_password_is_required')");
           return $('#confirm_password').focus();
        }
        else if(confirm_password != password)
        {
           $('#agent_name_error').html("");
           $('#designation_error').html("");
           $('#new_email_error').html("");
           $('#phone_error').html("");
           $('#confirm_password_error').html("@lang('translation.password_are_not_matched')");
           return $('#confirm_password').focus();
        }
    else
    {
        $('#agent_name_error').html("");
        $('#designation_error').html("");
        $('#new_email_error').html("");
        $('#phone_error').html("");
        $('#confirm_password_error').html("");

        //TODO: Initializing Form Data Object
           const formData = new FormData;
           formData.append('name', name);
           formData.append('designation', designation);
           formData.append('email', new_email);
           formData.append('password', password);
           formData.append('real_password', password);
           formData.append('confirm_password', confirm_password);
           formData.append('phone', phone);
           formData.append('_token', _token);

        $.ajax({
            url:"{{ route('manage-properties.property-parameters.create-property-agents') }}",
            method:"POST",
            data:formData,
            contentType:false,
            processData:false,
            cache:false,
            beforeSend:function()
            {
                $('#add_property_agent').html(`${save_icon} @lang('translation.please_wait')`);
                $('#add_property_agent').attr('class',`btn btn-cherwell font-weight-bold  ${spinner}`);
                $('#add_property_agent').attr('disabled',true);
            },
            complete:function()
            {
                $('#add_property_agent').html(`${save_icon} Save Changes`);
                $('#add_property_agent').attr('class',`btn btn-cherwell font-weight-bold`);
                $('#add_property_agent').removeAttr('disabled');
            },
            success:function(res)
            {
                if(res == "true"){
                    ToastSuccess("Agent Created Successfully!");
                       $('#agent_name').val('');
                       $('#designation').val('');
                       $('#new_email').val('');
                       $('#password').val('');
                       $('#confirm_password').val('');
                       $('#phone').val('');
                       $('#agent_name').focus();
                       loadPropertyAgents();
                   }else if(res == "email")
                   {
                       $('#new_email_error').html("@lang('translation.email_already_taken')");
                       return $('#new_email').focus();
                   }
                   else if(res == "phone")
                   {
                       $('#phone_error').html("This phone number is already taken.");
                       return $('#phone').focus();
                   }
            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });

    }
});
{{-- /End Function For Creating Properties --}}


{{-- Function Load Property States --}}
loadPropertyStates();
function loadPropertyStates(){
    $.ajax({
        url:"{{ route('manage-properties.property-parameters.get-property-states') }}",
        method:"GET",
        success:function(res)
        {
            $('#state_id').html(res);
            $('#prop_state_id').html(res);
        },
        error:function(xhr)
        {
            console.log(xhr.responseText);
        }
    });
}
{{-- /End Function Load Property States --}}

{{-- Function For Creating Properties View --}}
$('#add_property_state').click(function(){
    const name = $('#prop_state_name').val();
    {{-- Applying Validation Here --}}
    if(!$.trim(name).length)
    {
        $('#prop_state_name_error').html('The view name field is required.');
        return $('#prop_state_name').focus();
    }
    else if(name.length < 3)
    {
        $('#prop_state_name_error').html('The view name length should be atleast 3 characters.');
        return $('#prop_state_name').focus();
    }
    else
    {
        $('#prop_state_name_error').html('');

        $.ajax({
            url:"{{ route('manage-properties.property-parameters.create-property-states') }}",
            method:"POST",
            data:{name, _token},
            beforeSend:function()
            {
                $('#add_property_state').html(`${save_icon} @lang('translation.please_wait')`);
                $('#add_property_state').attr('class',`btn btn-cherwell font-weight-bold  ${spinner}`);
                $('#add_property_state').attr('disabled',true);
            },
            complete:function()
            {
                $('#add_property_state').html(`${save_icon} Save Changes`);
                $('#add_property_state').attr('class',`btn btn-cherwell font-weight-bold`);
                $('#add_property_state').removeAttr('disabled');
            },
            success:function(res)
            {
                if(res == "true"){
                    $(`#prop_state_name`).val('');
                    ToastSuccess("Property Cities Created Successfully");
                    loadPropertyStates();
                   }else if(res == 'title'){
                    $('#prop_state_name_error').html("This name is already exist.");
                    $('#prop_state_name').focus();
                   }
            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });

    }
});
{{-- /End Function For Creating Properties --}}

{{-- Function Load Property Categories --}}
function loadPropertyAreas(){
    const state_id = $('#prop_state_id :selected').val();
    $.ajax({
        url:"{{ route('manage-properties.property-parameters.get-property-areas') }}",
        method:"GET",
        data:{state_id},
        success:function(res)
        {
            $('#area_id').html(res);
            $('#prop_location_area_id').val();
        },
        error:function(xhr)
        {
            console.log(xhr.responseText);
        }
    });
}
{{-- /End Function Load Property Categories --}}

{{-- Function Load Property Categories --}}
function loadPropertyLocations(){
    const area_id = $('#area_id :selected').val();
    $.ajax({
        url:"{{ route('manage-properties.property-parameters.get-property-locations') }}",
        method:"GET",
        data:{area_id},
        success:function(res)
        {
            $('#location_id').html(res);
            console.log();
        },
        error:function(xhr)
        {
            console.log(xhr.responseText);
        }
    });
}
{{-- /End Function Load Property Categories --}}

{{-- Function For Creating Properties Sattus --}}
$('#add_property_area').click(function(){
    const state_id = $('#prop_state_id').val();
    const name = $('#prop_area_name').val();
    {{-- Applying Validation Here --}}
    if(state_id == ""){
       return $('#prop_state_id_error').html('Please select property type.');
    }
    else if(!$.trim(name).length)
    {
        $('#prop_state_id_error').html('');
        $('#prop_area_name_error').html('The status name field is required.');
        return $('#prop_area_name').focus();
    }
    else if(name.length < 3)
    {
        $('#prop_state_id_error').html('');
        $('#prop_area_name_error').html('The status name length should be atleast 3 characters.');
        return $('#prop_area_name').focus();
    }
    else
    {
        $('#prop_state_id_error').html('');
        $('#prop_area_name_error').html('');

        $.ajax({
            url:"{{ route('manage-properties.property-parameters.create-property-areas') }}",
            method:"POST",
            data:{state_id, name, _token},
            beforeSend:function()
            {
                $('#add_property_area').html(`${save_icon} @lang('translation.please_wait')`);
                $('#add_property_area').attr('class',`btn btn-cherwell font-weight-bold  ${spinner}`);
                $('#add_property_area').attr('disabled',true);
            },
            complete:function()
            {
                $('#add_property_area').html(`${save_icon} Save Changes`);
                $('#add_property_area').attr('class',`btn btn-cherwell font-weight-bold`);
                $('#add_property_area').removeAttr('disabled');
            },
            success:function(res)
            {
                if(res == "true"){
                    $(`#prop_area_name`).val('');
                    ToastSuccess("Area Created Successfully");
                    loadPropertyAreas();
                   }else if(res == 'title'){
                    $('#prop_area_name_error').html("This area name is already exist.");
                    $('#prop_area_name').focus();
                   }
            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });

    }
});
{{-- /End Function For Creating Properties --}}


{{-- Function For Creating Properties Sattus --}}
$('#add_property_location').click(function(){
    const location_country_id = 1;
    const location_state_id = $('#prop_location_state_id').val();
    const location_id = $('#prop_location_area_id').val();
    const name = $('#prop_location_name').val();
    {{-- Applying Validation Here --}}
    if(location_state_id == ""){
       return $('#prop_location_state_id_error').html('Please select city.');
    }
    else if(location_id == ""){
       $('#prop_location_state_id_error').html('');
       return $('#prop_location_area_id_error').html('Please select area.');
    }
    else if(!$.trim(name).length)
    {
        $('#prop_location_state_id_error').html('');
        $('#prop_location_area_id_error').html('');
        $('#prop_location_name_error').html('The status name field is required.');
        return $('#prop_location_name').focus();
    }
    else if(name.length < 3)
    {
        $('#prop_location_state_id_error').html('');
        $('#prop_location_area_id_error').html('');
        $('#prop_location_name_error').html('The status name length should be atleast 3 characters.');
        return $('#prop_location_name').focus();
    }
    else
    {
        $('#prop_location_state_id_error').html('');
        $('#prop_location_area_id_error').html('');
        $('#prop_location_name_error').html('');

        $.ajax({
            url:"{{ route('manage-properties.property-parameters.create-property-locations') }}",
            method:"POST",
            data:{location_country_id, location_state_id, location_id, name, _token},
            beforeSend:function()
            {
                $('#add_property_location').html(`${save_icon} @lang('translation.please_wait')`);
                $('#add_property_location').attr('class',`btn btn-cherwell font-weight-bold  ${spinner}`);
                $('#add_property_location').attr('disabled',true);
            },
            complete:function()
            {
                $('#add_property_location').html(`${save_icon} Save Changes`);
                $('#add_property_location').attr('class',`btn btn-cherwell font-weight-bold`);
                $('#add_property_location').removeAttr('disabled');
            },
            success:function(res)
            {
                if(res == "true"){
                    $(`#prop_location_name`).val('');
                    ToastSuccess("Location Created Successfully");
                    $.ajax({
                    url:"{{ route('manage-properties.property-parameters.get-property-locations') }}",
                    method:"GET",
                    data:{area_id:location_id},
                    success:function(res)
                    {
                        $('#location_id').html(res);
                    },
                    error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
                   }else if(res == 'title'){
                    $('#prop_location_name_error').html("This Location name is already exist.");
                    $('#prop_location_name').focus();
                   }
            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });

    }
});
{{-- /End Function For Creating Properties --}}
