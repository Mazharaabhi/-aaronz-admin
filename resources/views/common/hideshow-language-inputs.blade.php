var input_id = "{{ $languages[0]->id }}";

$('body').delegate('#btn_lang','click',function()
{
    var id = $(this).attr('data-id');

    hideInputs();
    $(`#div_header_title_${id}`).attr('class', 'col-md-12 mb-3');
    $(`#description_div_${id}`).attr('class', 'col-md-12 mb-3');
    $(`#div_header_title_${id} input`).focus();
    $(`#div_header_short_title_${id}`).attr('class', 'col-md-12 mb-3');
    $(`#div_header_short_title_${id} input`).focus();
    $(`#div_${id}`).attr('class', 'col-md-6 mb-3');
    $(`#div_${id} input`).focus();
    $(`#div_description_${id}`).attr('class', 'col-md-12 mb-3');
    $(`#div_news_letter_description_${id}`).attr('class', 'col-md-12 mb-3');
    $(`#div_follow_up_description_${id}`).attr('class', 'col-md-12 mb-3');
    $(`#div_news_letter_description_${id} input`).focus();
    $(`#div_follow_up_description_${id} input`).focus();
    $(`#div_description_${id} input`).focus();
    $(this).attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');

});

function hideInputs()
{
    $('input[name="title_english[]"]').map(function(){
        $(this).parent().attr('class', 'd-none');
    });

    $('input[name="header_title[]"]').map(function(){
        $(this).parent().attr('class', 'd-none');
    });


    $('input[name="header_short_title[]"]').map(function(){
        $(this).parent().attr('class', 'd-none');
    });

    $('textarea[name="descriptions_1"]').map(function(){
        $(this).parent().attr('class', 'd-none');
    });

    $('textarea[name="descriptions_2"]').map(function(){
        $(this).parent().attr('class', 'd-none');
    });

    $('textarea[name="follow_up_desc[]"]').map(function(){
        $(this).parent().parent().attr('class', 'd-none');
    });

    $('textarea[name="news_letter_desc[]"]').map(function(){
        $(this).parent().parent().attr('class', 'd-none');
    });

    $('.btn_lang').map(function(){
        $(this).attr('class', 'btn btn_lang mt-3');
    });
}
