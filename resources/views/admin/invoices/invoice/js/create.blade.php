<script>

//TODO: Restrict TO Add Only Decimal Values
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
    && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function CopyLink() {
    const link = document.querySelector('#Link');
    const range = document.createRange();
    range.selectNode(link);
    const selection = window.getSelection();
    selection.removeAllRanges();
    selection.addRange(range);
    const successful = document.execCommand('copy');
    }

$(document).ready(function(){
   @include('messages.jquery-messages')
   MakeMenuActive('#accounts', '#invoices', '#service_anchor');

//TODO: Calculations For Invoice Items
//TODO: SKU
$('body').delegate('#sku', 'keyup', function()
{
    $(this).css({'border-color':'#E4E6EF'});
})
//TODO: Description
$('body').delegate('#description', 'keyup', function()
{
    $(this).css({'border-color':'#E4E6EF'});
})
//TODO: UNIT PRICE INPUT CALCULATIONS
$('body').delegate('#unit_price', 'keyup', function()
{
    $(this).css({'border-color':'#E4E6EF'});
    var unit_price = $(this).val();
    var quantity =  $(this).parent().parent().find('#quantity').val();
    var discount = $(this).parent().parent().find('#discount').val();
    var tax = $(this).parent().parent().find('#tax').val();
    var current_value = $(this).parent().parent().find('input[name="current_value"]').val();

    calculation($(this), unit_price, quantity, discount, tax, current_value);
});
//TODO: QUANTITY INPUT CALCULATIONS
$('body').delegate('#quantity', 'keyup', function()
{
    $(this).css({'border-color':'#E4E6EF'});
    var quantity = $(this).val();
    var unit_price =  $(this).parent().parent().find('#unit_price').val();
    var discount = $(this).parent().parent().find('#discount').val();
    var tax = $(this).parent().parent().find('#tax').val();
    var current_value = $(this).parent().parent().find('input[name="current_value"]').val();

    calculation($(this), unit_price, quantity, discount, tax, current_value);
});
//TODO: DISCOUNT INPUT CALCULATIONS
$('body').delegate('#discount', 'keyup', function()
{
    $(this).css({'border-color':'#E4E6EF'});
    var discount = parseFloat(this.value).toFixed(2);
    var unit_price =  $(this).parent().parent().find('#unit_price').val();
    var quantity = $(this).parent().parent().find('#quantity').val();
    var tax = $(this).parent().parent().find('#tax').val();
    var current_value = $(this).parent().parent().find('input[name="current_value"]').val();

    calculation($(this), unit_price, quantity, discount, tax, current_value);
});
//TODO: DISCOUNT INPUT CALCULATIONS
$('body').delegate('#tax', 'keyup', function()
{
    $(this).css({'border-color':'#E4E6EF'});
    var tax = parseFloat(this.value).toFixed(2);
    var unit_price =  $(this).parent().parent().find('#unit_price').val();
    var quantity = $(this).parent().parent().find('#quantity').val();
    var discount = $(this).parent().parent().find('#discount').val();
    var current_value = $(this).parent().parent().find('input[name="current_value"]').val();

    calculation($(this), unit_price, quantity, discount, tax, current_value);
});
//TODO: CALCULATION FUNCTION
function calculation(obj, unit_price, quantity, discount, tax, current_value)
{

    //TODO: CHECKING IF QUANTITU IS NOT EMPTY OR NOT EUQAL TO 0 THEN MULTIPLY BOTH AND SAVEN THEIR VALUE TO CURRENT_VALUE VARTIABLE
    if(quantity != "" && quantity > 0)
    {
        current_value = unit_price * quantity;
    }
    else
    {
        current_value = unit_price;
    }
    //TODO: CALCULATING DISCOUNT HERE
    var calculatedDiscount = 0;
    if(discount != "" && discount > 0)
    {
         calculatedDiscount = current_value / 100 * discount;
        //  console.log(calculatedDiscount + ' ' + current_value);
    }
    obj.parent().parent().find('#discount_amount').val(calculatedDiscount);

    //TODO: CALCULATING TAX HERE
    var calculatedTax = 0;
    if(tax != "" && tax > 0)
    {
        discount_to_calculate = current_value - calculatedDiscount;
        calculatedTax = discount_to_calculate  / 100 * tax;
        // console.log('Current Value After Minus Discount' + current_value);
    }
    obj.parent().parent().find('#tax_total').val(calculatedTax);
    //TODO: GETTING TOTAL VALUE HERE BY DEDUCTING DISCOUNT AND ADDING TAX
    var total = current_value - calculatedDiscount;
    total = total + calculatedTax;
    obj.parent().parent().find('input[name="current_value"]').val(current_value);
    obj.parent().parent().find('#total').val(total.toFixed(2));
    //TODO: GETTING TOTAL FIELDS SUM TO CALCULATE SUB TOTAL
    var sub_total_to_calculate = $('input[name="total[]"]').map(function(){
        return  $(this).val();
    }).get();

    var sub_total = 0;
    for(var i = 0; i < sub_total_to_calculate.length ; i++)
    {
        if(sub_total_to_calculate[i] > 0)
        {
            sub_total += parseFloat(sub_total_to_calculate[i]);
        }
    }

        $('#sub_total').val(sub_total.toFixed(2));
        $('#total_amount').val(sub_total.toFixed(2));


        var extra_discount = $('#extra_discount').val();
        var extra_charge = $('#extra_charge').val();
        var shipping_charges = $('#shipping_charges').val();

        var extra_discount_to_calculate = 0;
        if(extra_discount != "" && extra_discount > 0)
        {
            extra_discount_to_calculate = extra_discount;
        }



        var extra_charge_to_calculate = 0;
        if(extra_charge != "" && extra_charge > 0)
        {
            extra_charge_to_calculate =  extra_charge;
        }

        var shipping_charges_to_calculate = 0;
        if(shipping_charges != "" && shipping_charges > 0)
        {
            shipping_charges_to_calculate =  shipping_charges;
        }

        // console.log(sub_total +' '+ extra_discount_to_calculate +' '+ extra_charge);

        var total_amount = sub_total - extra_discount_to_calculate;
        total_amount = parseFloat(total_amount) + parseFloat(extra_charge_to_calculate);
        total_amount = parseFloat(total_amount) + parseFloat(shipping_charges_to_calculate);

        $('#total_amount').val(total_amount.toFixed(2));
}
//TODO: CHARGING EXTRA DISCOUNT HERE
$('#extra_discount').keyup(function(){
        var sub_total = $('#sub_total').val();
        if(sub_total != "" && sub_total > 0)
        {
            var extra_discount = $(this).val();
        var extra_charge = $('#extra_charge').val();

        var extra_discount_to_calculate = 0;
        if(extra_discount != "" && extra_discount > 0)
        {
            extra_discount_to_calculate = extra_discount;
        }

        var extra_charge_to_calculate = 0;
        if(extra_charge != "" && extra_charge > 0)
        {
            extra_charge_to_calculate =  extra_charge;
        }

        // console.log(sub_total +' '+ extra_discount_to_calculate +' '+ extra_charge);

        var total_amount = sub_total - extra_discount_to_calculate;
        total_amount = parseFloat(total_amount) + parseFloat(extra_charge_to_calculate);

        $('#total_amount').val(total_amount.toFixed(2));
        }
});
//TODO: CHARGING EXTRA CHARGE HERE
$('#extra_charge').keyup(function(){
        var sub_total = $('#sub_total').val();
        if(sub_total != "" && sub_total > 0)
        {
            var extra_discount = $('#extra_discount').val();
        var extra_charge = $(this).val();

        var extra_discount_to_calculate = 0;
        if(extra_discount != "" && extra_discount > 0)
        {
            extra_discount_to_calculate = extra_discount;
        }

        var extra_charge_to_calculate = 0;
        if(extra_charge != "" && extra_charge > 0)
        {
            extra_charge_to_calculate =  extra_charge;
        }

        // console.log(sub_total +' '+ extra_discount_to_calculate +' '+ extra_charge);

        var total_amount = sub_total - extra_discount_to_calculate;
        total_amount = parseFloat(total_amount) + parseFloat(extra_charge_to_calculate);

        $('#total_amount').val(total_amount.toFixed(2));
        }
});
//TODO: CHARGING EXTRA CHARGE HERE
$('#shipping_charges').keyup(function(){
        var sub_total = $('#sub_total').val();
        if(sub_total != "" && sub_total > 0)
        {
        var extra_discount = $('#extra_discount').val();
        var extra_charge = $('#extra_charge').val();
        var shipping_charges = $(this).val();

        var extra_discount_to_calculate = 0;
        if(extra_discount != "" && extra_discount > 0)
        {
            extra_discount_to_calculate = extra_discount;
        }

        var extra_charge_to_calculate = 0;
        if(extra_charge != "" && extra_charge > 0)
        {
            extra_charge_to_calculate =  extra_charge;
        }

        var shipping_charges_to_calculate = 0;
        if(shipping_charges != "" && shipping_charges > 0)
        {
            shipping_charges_to_calculate =  shipping_charges;
        }


        var total_amount = sub_total - extra_discount_to_calculate;
        total_amount = parseFloat(total_amount) + parseFloat(extra_charge_to_calculate);
        total_amount = parseFloat(total_amount) + parseFloat(shipping_charges_to_calculate);

        $('#total_amount').val(total_amount.toFixed(2));
        }
});


//TODO: DELETING THE PRODUCT
$('body').delegate('#delete', 'click', function(){
        var total = $(this).parent().parent().find('#total').val();

        var sub_total = $('#sub_total').val();
        var total_amount = $('#total_amount').val();
        var obj = $(this);
        //Delete Confirmation
        $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Confirm delete this entery?',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.alert('Entery deleted successfully!');
                                obj.parent().parent().remove();
                                if(total != "" && total > 0)
                                {
                                    $('#sub_total').val(sub_total - total);
                                    var current_sub_total = sub_total - total;
                                    console.log(current_sub_total);
                                    $('#total_amount').val(total_amount - total);
                                    if(current_sub_total <= 0 || current_sub_total == "")
                                    {
                                    $('#total_amount').val('');
                                    }
                                }
                            }
                        }
                    }
                });
});
var flag_one = 1;
var flag_two = 1;
var flag_three = 1;
var flag_four = 1;
var flag_five = 1;
var flag_six = 1;
var flag_seven = 1;
//TODO: ERRORS FUNCTION
function Errors()
{
      //TODO: Sku Error
      if($("input[name='sku[]']") !== undefined){
        $("input[name='sku[]']").map(function(){
            if($(this).val() == "" || !$.trim($(this).val()).length){
                 $(this).focus();
                 $(this).css({'border-color':'red'});
                 flag_one = 0;
            }else{
                flag_one = 1;
                $(this).css({'border-color':'#E4E6EF'});
            }
        });
    }

    //TODO: Description Error
    if($("input[name='description[]']") !== undefined){
        $("input[name='description[]']").map(function(){
            if($(this).val() == "" || !$.trim($(this).val()).length){
                 $(this).css({'border-color':'red'});
                 flag_two = 0;
            }else{
                $(this).css({'border-color':'#E4E6EF'});
                flag_two = 1;
            }
        });
    }

     //TODO: Unit Price Error
     if($("input[name='unit_price[]']") !== undefined){
        $("input[name='unit_price[]']").map(function(){
            if($(this).val() == "" || $(this).val() <= 0){
                 $(this).focus();
                 $(this).css({'border-color':'red'});
                 flag_three = 0;
            }else{
                $(this).css({'border-color':'#E4E6EF'});
                flag_three = 1;
            }
        });
    }

    //TODO: quantity Error
    if($("input[name='quantity[]']") !== undefined){
        $("input[name='quantity[]']").map(function(){
            if($(this).val() == "" || $(this).val() <= 0){
                 $(this).focus();
                 $(this).css({'border-color':'red'});
                 flag_four = 0;
            }else{
                $(this).css({'border-color':'#E4E6EF'});
                flag_four = 1;
            }
        });
    }

    //TODO: discount Error
    if($("input[name='discount[]']") !== undefined){
        $("input[name='discount[]']").map(function(){
            if($(this).val() == "" || $(this).val() < 0){
                 $(this).focus();
                 $(this).css({'border-color':'red'});
                 flag_five = 0;
            }else{
                $(this).css({'border-color':'#E4E6EF'});
                flag_five = 1;
            }
        });
    }

    //TODO: tax Error
    if($("input[name='tax[]']") !== undefined){
        $("input[name='tax[]']").map(function(){
            if($(this).val() == "" || $(this).val() < 0){
                 $(this).focus();
                 $(this).css({'border-color':'red'});
                 flag_six = 0;
            }else{
                $(this).css({'border-color':'#E4E6EF'});
                flag_six = 1;
            }
        });
    }

    //TODO: total Error
    if($("input[name='total[]']") !== undefined){
        $("input[name='total[]']").map(function(){
            if($(this).val() == "" || $(this).val() <= 0){
                 flag_seven = 0;
            }else{
                flag_seven = 1;
            }
        });
    }


    if(flag_one == 0 || flag_two == 0 || flag_three == 0 || flag_four == 0 || flag_five == 0 || flag_six == 0 || flag_seven == 0)
    {
        return false;
    }


}
//TODO: Adding Dynamic Row To Table
$('#add-row').click(function(){
   addRow();
});
addRow();
function addRow()
{
    total = 0;
    var tr = `
    <tr>
        <input type="hidden" name="current_value" value="0"/>
        <input type="hidden" name="discount_amount[]" value="0" id="discount_amount"/>
        <input type="hidden" name="tax_total[]" value="0" id="tax_total"/>
        <td><input type="text" name="sku[]" id="sku"  class="form-control text-uppercase"></td>
        <td><input type="text" name="description[]" id="description" class="form-control"></td>
        <td><input type="number" name="unit_price[]"  id="unit_price" onkeypress="return isNumberKey(event)" class="form-control"></td>
        <td><input type="number" name="quantity[]" id="quantity" value="1" onkeypress="return isNumberKey(event)" class="form-control"></td>
        <td><input type="number" name="discount[]" id="discount" value="0" onkeypress="return isNumberKey(event)"  class="form-control"></td>
        <td><input type="number" name="tax[]" id="tax" value="0" min="0"  onkeypress="return isNumberKey(event)"  class="form-control"></td>
        <td><input type="number" name="total[]" id="total" value="0" min="0" onkeypress="return isNumberKey(event)"  disabled value="0" style="font-weight:bold" class="form-control"></td>
        <td>
        <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
            <span class="svg-icon svg-icon-md svg-icon-danger">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                    <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                </g>
            </svg>
            </span>
            </a>
        </td>
    </tr>
    `;
    Errors();
    if(flag_one != 0 && flag_two != 0 && flag_three != 0 && flag_four != 0 && flag_five != 0 && flag_six != 0 && flag_seven != 0)
    {
        $('#tbody').append(tr);
    }
}

//TODO: Getting States As Per Countries
$('#country').change(function()
{
   const country = $(this).val();

   if(!country)
   {
       $('#state').html('<option value="">-- State  --</option>');
   }
   else
   {
       //TODO: Getting States of the Country
       $.ajax({
           url:"{{ route('get.states') }}",
           method:"POST",
           data:{country, _token},
           success:function(res)
           {
               var data = JSON.parse(res);
               $('#zip').val(data.zip);
               var html = `<option value="">-- State  --</option>`;
               $('#state_count').val(data.state_count);
               if(data.state_count > 0)
               {
                   for(var i=0; i < data.state_count; i++)
                   {
                       html += `<option value="${data.states[i]['val']}">${data.states[i]['text']}</option>`;
                   }
               }
               $('#state').html(html);
           },
           error:function(xhr)
           {
               console.log(xhr.responseText);
           }
       });
   }
});

//TODO: Creating new navbar menu
$('#save').click(function()
{
    const name = $('#name').val();
    const link_email = $('#link_email').val();
    const phone = $('#phone').val();
    const street = $('#address').val();
    const zip = $('#zip').val();
    const city = $('#city').val();
    const country = $('#country').val();
    const state = $('#state').val();
    const description = $('#d_description').val();
    const state_count = $('#state_count').val();
    const total_amount = $('#total_amount').val();
    const extra_charge = $('#extra_charge').val();
    const shipping_charges = $('#shipping_charges').val();
    const extra_discount = $('#extra_discount').val();
    const sub_total = $('#sub_total').val();
    const tran_type = $('#tran_type').val();
    const customer_ref = $('#customer_ref').val();
    const invoice_ref = $('#invoice_ref').val();
    const currency = $('select[name="my_currency"]').val();



    //TODO: Regular Expression For Email
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    const checkEmail = emailReg.test( link_email );

    //TODO: Applying Validations Here
    if(!name || !$.trim(name).length)
    {
        $('#amount_error').html("");
        $('#description_error').html("");
        $('#name_error').html("@lang('translation.full_name_is_required')");
        return $('#name').focus();
    }
    else if (name.split(' ').length < 2)
    {
        $('#amount_error').html("");
        $('#description_error').html("");
        $('#name_error').html("@lang('translation.fill_name_format')");
        return $('#name').focus();
    }
    else if(name.length <= 2)
    {
        $('#amount_error').html("");
        $('#description_error').html("");
        $('#name_error').html("@lang('translation.full_name_length_error')");
        return $('#name').focus();
    }
    else if(!link_email)
    {
        $('#amount_error').html("");
        $('#description_error').html("");
        $('#name_error').html("");
        $('#email_error').html("@lang('translation.email_is_required')");
        return $('#link_email').focus();
    }
    else if(checkEmail == false)
    {
        $('#amount_error').html("");
        $('#description_error').html("");
        $('#name_error').html("");
        $('#email_error').html("@lang('translation.email_format_is_not_valid')");
        return $('#link_email').focus();
    }
    else if(!tran_type)
    {
        $('#amount_error').html("");
        $('#description_error').html("");
        $('#name_error').html("");
        $('#email_error').html("");
        $('#phone_error').html("");
        $('#amount_error').html("");
        $('#street_error').html("");
        $('#city_error').html("");
        $('#country_error').html("");
        $('#zip_error').html("");
        $('#description_error').html("");
        $('#tran_type_error').html("@lang('translation.tran_type_required')");
    }
    // else if(!phone)
    // {
    //     $('#amount_error').html("");
    //     $('#description_error').html("");
    //     $('#name_error').html("");
    //     $('#email_error').html("");
    //     $('#phone_error').html("@lang('translation.phone_required')");
    //     return $('#phone').focus();
    // }
    // else if(!street || !$.trim(street).length)
    // {
    //     $('#amount_error').html("");
    //     $('#description_error').html("");
    //     $('#name_error').html("");
    //     $('#email_error').html("");
    //     $('#phone_error').html("");
    //     $('#amount_error').html("");
    //     $('#street_error').html("@lang('translation.street_required')");
    //     return $('#street').focus();
    // }
    // else if(street.length < 3)
    // {
    //     $('#amount_error').html("");
    //     $('#description_error').html("");
    //     $('#amount_error').html("");
    //     $('#name_error').html("");
    //     $('#email_error').html("");
    //     $('#phone_error').html("");
    //     $('#street_error').html("@lang('translation.street_length')");
    //     return $('#street').focus();
    // }
    // else if(!city || !$.trim(city).length)
    // {
    //     $('#amount_error').html("");
    //     $('#description_error').html("");
    //     $('#name_error').html("");
    //     $('#email_error').html("");
    //     $('#phone_error').html("");
    //     $('#amount_error').html("");
    //     $('#street_error').html("");
    //     $('#city_error').html("@lang('translation.city_required')");
    //     return $('#city').focus();
    // }
    // else if(city.length < 3)
    // {
    //     $('#amount_error').html("");
    //     $('#description_error').html("");
    //     $('#name_error').html("");
    //     $('#email_error').html("");
    //     $('#phone_error').html("");
    //     $('#amount_error').html("");
    //     $('#street_error').html("");
    //     $('#city_error').html("@lang('translation.city_length')");
    //     return $('#city').focus();
    // }
    // else if(!country)
    // {
    //     $('#amount_error').html("");
    //     $('#description_error').html("");
    //     $('#name_error').html("");
    //     $('#email_error').html("");
    //     $('#phone_error').html("");
    //     $('#amount_error').html("");
    //     $('#street_error').html("");
    //     $('#zip_error').html("");
    //     $('#city_error').html("");
    //     return $('#country_error').html("@lang('translation.country_required')");
    // }
    // else if(state_count > 0 && !state)
    // {
    //     $('#amount_error').html("");
    //     $('#description_error').html("");
    //     $('#name_error').html("");
    //     $('#email_error').html("");
    //     $('#phone_error').html("");
    //     $('#amount_error').html("");
    //     $('#street_error').html("");
    //     $('#city_error').html("");
    //     $('#country_error').html("");
    //     $('#zip_error').html("");
    //     $('#state_error').html("@lang('translation.state_required')");
    //     return $('#state').focus();
    // }
    // else if(!description || !$.trim(description).length)
    // {
    //     $('#amount_error').html("");
    //     $('#description_error').html("");
    //     $('#name_error').html("");
    //     $('#email_error').html("");
    //     $('#phone_error').html("");
    //     $('#amount_error').html("");
    //     $('#street_error').html("");
    //     $('#city_error').html("");
    //     $('#country_error').html("");
    //     $('#zip_error').html("");
    //     $('#state_error').html("");
    //     $('#description_error').html("@lang('translation.description_required')");
    //     return $('#description').focus();
    // }
    // else if(description.length < 10)
    // {
    //     $('#amount_error').html("");
    //     $('#description_error').html("");
    //     $('#name_error').html("");
    //     $('#email_error').html("");
    //     $('#phone_error').html("");
    //     $('#amount_error').html("");
    //     $('#street_error').html("");
    //     $('#city_error').html("");
    //     $('#country_error').html("");
    //     $('#zip_error').html("");
    //     $('#description_error').html("@lang('translation.description_length_error')");
    //     return $('#description').focus();
    // }
    else if(total_amount == "" || total_amount <= 0)
    {
        $('#amount_error').html("");
        $('#description_error').html("");
        $('#name_error').html("");
        $('#email_error').html("");
        $('#phone_error').html("");
        $('#amount_error').html("");
        $('#street_error').html("");
        $('#city_error').html("");
        $('#country_error').html("");
        $('#zip_error').html("");
        $('#description_error').html("");
        Message('Violation', 'Please add invoice items', 'red');
    }
    else
    {

        const response = Errors();

        if(response === false)
        {
            return;
        }

        $('#name_error').html("");
        $('#email_error').html("");
        $('#phone_error').html("");
        $('#zip_error').html("");
        $('#amount_error').html("");
        $('#street_error').html("");
        $('#city_error').html("");
        $('#country_error').html("");
        $('#state_error').html("");
        $('#description_error').html("");
        $('#tran_type_error').html("");

        //TODO: GETTING VALUES OF DYNAMIC FIELDS
        var sku = $('input[name="sku[]"]').map(function(){
        return  $(this).val();
        }).get();
        var item_description = $('input[name="description[]"]').map(function(){
        return  $(this).val();
        }).get();

        var unit_price = $('input[name="unit_price[]"]').map(function(){
        return  $(this).val();
    }   ).get();

        var discount = $('input[name="discount[]"]').map(function(){
        return  $(this).val();
        }).get();

        var quantity = $('input[name="quantity[]"]').map(function(){
        return  $(this).val();
        }).get();

        var tax = $('input[name="tax[]"]').map(function(){
        return  $(this).val();
        }).get();

        var discount_amount = $('input[name="discount_amount[]"]').map(function(){
        return  $(this).val();
        }).get();

        var tax_total = $('input[name="tax_total[]"]').map(function(){
        return  $(this).val();
        }).get();

        var total = $('input[name="total[]"]').map(function(){
        return  $(this).val();
        }).get();

        //TODO: Initializing Form Data Object
        const formData = new FormData;
        formData.append('name', name);
        formData.append('email', link_email);
        formData.append('phone', phone);
        formData.append('city', city);
        formData.append('tran_type', tran_type);
        formData.append('country', country);
        formData.append('state', state);
        formData.append('street1', street);
        formData.append('customer_ref', customer_ref);
        formData.append('invoice_ref', invoice_ref);
        formData.append('currency', currency);
        formData.append('cart_description', description);
        formData.append('sku', sku);
        formData.append('description', item_description);
        formData.append('unit_cost', unit_price);
        formData.append('quantity', quantity);
        formData.append('item_tax', tax);
        formData.append('discount_amount', discount_amount);
        formData.append('tax_total', tax_total);
        formData.append('item_total', total);
        formData.append('discount', discount);
        formData.append('zip', zip);
        formData.append('total_amount', total_amount);
        formData.append('extra_charges', extra_charge);
        formData.append('shipping_charges', shipping_charges);
        formData.append('extra_discount', extra_discount);
        formData.append('sub_total', sub_total);
        formData.append('_token', _token);

        //TODO: Seding Ajax Requrest for creating navbar menu
        $.ajax({
            url:"{{ route('admin.invoices.invoice.create-invoice') }}",
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
                $('#save').html(`${save_icon} @lang('translation.generate_link')`);
                $('#save').attr('class',`btn btn-danger btn-block`);
                $('#save').removeAttr('disabled');
            },
            success:function(res)
            {
                // return console.log(res);
                var data = JSON.parse(res);
                if(data.error == "Cyber")
                {
                    ToastError("warning", "@lang('translation.cyber_message')");
                }
                else if(data.code)
                {
                    Message('Error', data.message, 'red');
                }
                else if(data.invoice_link){
                    ToastSuccess("@lang('translation.payment_link_created_successfully')");
                    $("#Show_Link_For_COPY").modal('show');
                    $("#Link").html(data.invoice_link);
                    $('#whastapp_link').attr('href', `https://wa.me/${phone}?text=${data.invoice_link}`);
                    $('#browser').attr('href', `${data.invoice_link}`);
                    $('#m_email').val(link_email);
                    $('#m_phone').val(phone);
                    $('#m_name').val(name);
                    $('#m_link').val(data.invoice_link);
                    $('#name').val('');
                    $('#link_email').val('');
                    $('#phone').val('');
                    $('#street').val('');
                    $('#city').val('');
                    $('#country').val('');
                    $('#state').val('');
                    $('#customer_ref').val('');
                    $('#invoice_ref').val('');
                    $('#zip').val('');
                    $('#d_description').val('');
                    $('#state_count').val('');
                    $('#total_amount').val(0);
                    $('#extra_charge').val(0);
                    $('#shipping_charges').val(0);
                    $('#extra_discount').val(0);
                    $('#sub_total').val(0);
                    $('#tbody').html("");
                    addRow();

                }
            },error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });
    }
});

      //TODO: Send Link in Message
      $('body').delegate('#m_message', 'click', function(){
            const email = $(this).parent().find('input[name="m_email"]').val();
            const name = $(this).parent().find('input[name="m_name"]').val();
            const phone = $(this).parent().find('input[name="m_phone"]').val();
            const link = $(this).parent().find('input[name="m_link"]').val();

            $.ajax({
                url:"{{ route('admin.invoices.invoice.send-message') }}",
                method:"POST",
                data:{id, email, name, link, phone, _token},
                success:function(res)
                {
                    console.log(res);
                    if(res == "true")
                    {
                        Message('Success', "Message Send Successfully!", 'green');
                    }
                    else
                    {
                        Message('Violation', "Error in Message Sending", 'red');
                    }
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        });

   //TODO: Getting Data and opening the update model to update the data
   var id = '';
   $('body').delegate('#edit', 'click', function()
   {
       id = $(this).parent().find('input[name="id"]').val();
       const db_title_english = $(this).parent().find('input[name="title_english"]').val();
       const db_title_arabic = $(this).parent().find('input[name="title_arabic"]').val();

       //TODO: Assigning values to update fields
       $('#edit_title_english').val(db_title_english);
       $('#title_arabic').val(db_title_arabic);
       //TODO: Open edit model here
       $('#edit_Menu_Modal').modal('show');
       $('#english-tab').trigger('click');

   });



});
</script>
