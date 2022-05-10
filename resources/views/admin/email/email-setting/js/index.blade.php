<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#email', '#email_settings', '#cms_anchor');



        //TODO: Creating new Email Category
        $('#save').click(function()
        {
            const bg_color = $('#head_color').val();
            const text_color = $('#head_text_color').val();
            const header_logo = document.getElementById('header_logo').files[0];
            const header_logo_width = $('#header_logo_width_style').val();
            const header_logo_height = $('#header_logo_height_style').val();
            const banner = document.getElementById('banner_image').files[0];
            const banner_image_width = $('#banner_image_width_style').val();
            const banner_image_height = $('#banner_image_height_style').val();
            const footer_logo = document.getElementById('footer_logo').files[0];
            const footer_logo_width = $('#footer_logo_width_style').val();
            const footer_logo_height = $('#footer_logo_height_style').val();
            const company_name = $('#company_name').val();
            const email = $('#company_email').val();
            const company_mobile = $('#company_mobile').val();
            const address = $('#address').val();
            const term_link = $('#term_link').val();
            const policy_link = $('#privacy_link').val();
            const fb = $('#fb').val();
            const youtube = $('#youtube').val();
            const linked_in = $('#linked_in').val();
            const twitter = $('#twitter').val();
            const instagram = $('#instagram').val();
            const google_my_business = $('#google').val();
            const footer_color = $('#footer_color').val();
            const footer_text_color = $('#footer_text_color').val();
            const footer_link_color = $('#footer_link_color').val();

                var formData = new FormData;
                formData.append('id',"{{ $settings->id }}");
                formData.append('footer_color',footer_color);
                formData.append('footer_text_color',footer_text_color);
                formData.append('footer_link_color',footer_link_color);
                formData.append('bg_color',bg_color);
                formData.append('text_color',text_color);
                formData.append('header_logo',header_logo);
                formData.append('header_logo_width',header_logo_width);
                formData.append('header_logo_height',header_logo_height);
                formData.append('banner',banner);
                formData.append('banner_image_width',banner_image_width);
                formData.append('banner_image_height',banner_image_height);
                formData.append('footer_logo',footer_logo);
                formData.append('footer_logo_width',footer_logo_width);
                formData.append('footer_logo_height',footer_logo_height);
                formData.append('company_name',company_name);
                formData.append('email',email);
                formData.append('mobile',company_mobile);
                formData.append('address',address);
                formData.append('term_link',term_link);
                formData.append('policy_link',policy_link);
                formData.append('fb',fb);
                formData.append('youtube',youtube);
                formData.append('linked_in',linked_in);
                formData.append('twitter',twitter);
                formData.append('instagram',instagram);
                formData.append('google_my_business',google_my_business);
                formData.append('_token',_token);

                //TODO: Seding Ajax Requrest for creating email category
                $.ajax({
                    url:"{{ route('admin.email.email-setting.update') }}",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    beforeSend:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#save').attr('class',`btn btn-danger btn-block  ${spinner}`);
                        $('#save').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#save').html(`${save_icon} @lang('translation.save_settings')`);
                        $('#save').attr('class',`btn btn-danger btn-block`);
                        $('#save').removeAttr('disabled');
                    },
                    success:function(res)
                    {
                        console.log(res);
                        if(res == "true")
                        {
                            ToastSuccess("@lang('translation.email_setting_saved_successfully')");
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });

        });


    //TODO: Email Template Edit Section
    $('#head_color').change(function(){
        var style = $(this).val();
        $('#header_background').css({'background-color': style});
    });

    $('#footer_color').change(function()
    {
        var style = $(this).val();
        $('#footer_background').css({'background-color': style});
    })

    $('#head_text_color').change(function(){
        var style = $(this).val();
        $('#header_background').css({'color': style});
        $('#footer_background').css({'color': style});
    });

    $('#footer_text_color').change(function(){
        var style = $(this).val();
        $('#footer_background').css({'color': style});
    });

    $('#footer_link_color').change(function(){
        var style = $(this).val();
        $('#terms_anchor').css({'color': style});
        $('#privacy_anchor').css({'color': style});
        $('#google_biz').css({'color': style});
    });

    //TODO: Header Logo
    $('#header_logo').change(function(){
            var input = this;
            if (input.files && input.files[0])
            {
                // Getting Avatar Image for uploading
                avatar = input.files[0];
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    //Appending the user avatar to avatar div
                    $('#header_logo_image').attr('src', `${e.target.result}`);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
    });

    $('#header_logo_width_style').keyup(function(){
        $('#header_logo_image').css({'width': `${$(this).val()}px`});

    });

    $('#header_logo_height_style').keyup(function(){
        $('#header_logo_image').css({'height': `${$(this).val()}px`});

    });

    //TODO: Header Logo
    $('#banner_image').change(function(){
            var input = this;
            if (input.files && input.files[0])
            {
                // Getting Avatar Image for uploading
                avatar = input.files[0];
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    //Appending the user avatar to avatar div
                    $('#banner_image_div').attr('src', `${e.target.result}`);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
    });

    $('#banner_image_width_style').keyup(function(){
        $('#banner_image_div').css({'width': `${$(this).val()}%`});

    });

    $('#banner_image_height_style').keyup(function(){
        $('#banner_image_div').css({'height': `${$(this).val()}%`});

    });

    //TODO: Showing Company Name
    $('#company_name').keyup(function(){
        $('#company_name_header').html($(this).val());
    });

    //TODO: Header Logo
    $('#footer_logo').change(function(){
            var input = this;
            if (input.files && input.files[0])
            {
                // Getting Avatar Image for uploading
                avatar = input.files[0];
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    //Appending the user avatar to avatar div
                    $('#footer_logo_image').attr('src', `${e.target.result}`);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
    });

    $('#footer_logo_width_style').keyup(function(){
        $('#footer_logo_image').css({'width': `${$(this).val()}px`});

    });

    $('#footer_logo_height_style').keyup(function(){
        $('#footer_logo_image').css({'height': `${$(this).val()}px`});

    });

    //Privacy and Terms Anchor Link
    $('#term_link').keyup(function(){
        $('#terms_anchor').attr('href', $(this).val());
        $('#terms_anchor').attr('class', '');
    });

    $('#privacy_link').keyup(function(){
        $('#privacy_anchor').attr('href', $(this).val());
        $('#privacy_anchor').attr('class', '');
    });

    //TODO: Social Links Work
    $('#fb').keyup(function(){
        $('#facebook_image').attr('href', $(this).val());
        $('#facebook_image').attr('class', '');
    });

    $('#twitter').keyup(function(){
        $('#twitter_image').attr('href', $(this).val());
        $('#twitter_image').attr('class', '');
    });

    $('#youtube').keyup(function(){
        $('#youtube_image').attr('href', $(this).val());
        $('#youtube_image').attr('class', '');
    });

    $('#instagram').keyup(function(){
        $('#instagram_image').attr('href', $(this).val());
        $('#instagram_image').attr('class', '');
    });

    $('#linked_in').keyup(function(){
        $('#linkedin_image').attr('href', $(this).val());
        $('#linkedin_image').attr('class', '');
    });

    $('#google').keyup(function(){
        $('#google_biz').attr('href', $(this).val());
        $('#google_biz').attr('class', '');
    });

    //TOODO: Company Address
    $('#company_email').keyup(function(){
        $('#email_span').html($(this).val());
        $('#email_span').attr('class', '');
    });

    $('#company_mobile').keyup(function(){
        $('#phone_span').html($(this).val());
    });

    $('#address').keyup(function(){
        $('#address_span').html($(this).val());
    });

    $('#sort_desc').keyup(function(){
        $('#short_desc_span').html($(this).val());
    });


});
</script>
