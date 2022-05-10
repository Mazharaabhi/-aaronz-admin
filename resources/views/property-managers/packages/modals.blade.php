<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Add_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Add Package Details:</legend>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="package_name" class="d-block">@lang('translation.package_name') </label>
                          <input type="text" name="package_name" id="package_name" placeholder="@lang('translation.enter_package_name')" class="form-control" autofocus/>
                          <span class="form-text text-danger" id="package_name_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="sales_limit" class="d-block">@lang('translation.transaction_sale_amount_limit_per_month') </label>
                        <input type="text" name="sales_limit" id="sales_limit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="@lang('translation.enter_sales_limit')" class="form-control">
                        <span class="form-text text-danger" id="sales_limit_error"></span>
                    </div>
                    <div class="col-md-12 col-lg-12 mb-4 ">
                        <label for=""><u>Transaction Charges In %</u></label>
                    </div>   
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="tax" class="d-block">Visa and Master card</label>
                        <input type="text" name="tax" id="tax" placeholder="Enter Visa/Master Charges" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  class="form-control">
                        <span class="form-text text-danger" id="tax_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="american_tax" class="d-block">American Express</label>
                        <input type="text" name="american_tax" id="american_tax" placeholder="Enter american express charges" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control">
                        <span class="form-text text-danger" id="american_tax_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="extra_charge" class="d-block">@lang('translation.extra_charge')</label>
                        <input type="text" name="extra_charge" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  id="extra_charge" placeholder="@lang('translation.enter_extra_charge')" class="form-control">
                        <span class="form-text text-danger" id="extra_charge_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="withdrawal_charges" class="d-block">Widthdraw Charges</label>
                        <input type="text" name="withdrawal_charges" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  id="withdrawal_charges" placeholder="Enter withdraw charges" class="form-control">
                        <span class="form-text text-danger" id="withdrawal_charges_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 d-none">
                        <label for="type" class="d-block">@lang('translation.type')</label>
                        <select name="type" id="type" class="form-control">
                        <option value="0">Default</option>    
                        <option value="0">Custom</option>    
                        </select>   
                        <span class="form-text text-danger" id="type_error"></span>
                    </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
            </div>
        </div>
    </div>
</div>
<!-- Update Navbar Menu Modal-->
<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Edit_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Edit Package Details:</legend>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="u_package_name" class="d-block">@lang('translation.package_name') </label>
                          <input type="text" name="u_package_name" id="u_package_name" placeholder="@lang('translation.enter_package_name')" class="form-control" autofocus/>
                          <span class="form-text text-danger" id="u_package_name_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="u_sales_limit" class="d-block">@lang('translation.transaction_sale_amount_limit_per_month') </label>
                        <input type="text" name="u_sales_limit" id="u_sales_limit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="@lang('translation.enter_sales_limit')" class="form-control">
                        <span class="form-text text-danger" id="u_sales_limit_error"></span>
                    </div>
                    <div class="col-md-12 col-lg-12 mb-4 ">
                        <label for=""><u>Transaction Charges In %</u></label>
                    </div>   
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="u_tax" class="d-block">Visa and Master card</label>
                        <input type="text" name="u_tax" id="u_tax" placeholder="Enter Visa/Master Charges" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  class="form-control">
                        <span class="form-text text-danger" id="u_tax_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="u_american_tax" class="d-block">American Express</label>
                        <input type="text" name="u_american_tax" id="u_american_tax" placeholder="Enter american express charges" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control">
                        <span class="form-text text-danger" id="u_american_tax_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="u_extra_charge" class="d-block">@lang('translation.extra_charge')</label>
                        <input type="text" id="u_extra_charge" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  id="extra_charge" placeholder="@lang('translation.enter_extra_charge')" class="form-control">
                        <span class="form-text text-danger" id="u_extra_charge_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="u_withdrawal_charges" class="d-block">Widthdraw Charges</label>
                        <input type="text" name="u_withdrawal_charges" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  id="u_withdrawal_charges" placeholder="Enter withdraw charges" class="form-control">
                        <span class="form-text text-danger" id="withdrawal_charges_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 d-none">
                        <label for="u_type" class="d-block">@lang('translation.type')</label>
                        <select name="u_type" id="u_type" class="form-control">
                        <option value="0">Default</option>    
                        <option value="1">Custom</option>    
                        </select>   
                        <span class="form-text text-danger" id="type_error"></span>
                    </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="update"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
            </div>
        </div>
    </div>
</div>

