<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Add_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Add Currnecy:</legend>
                    <div class="row">
                       
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="from_currency">@lang('translation.from_currency') </label>
                          <input type="text" class="form-control" name="from_currency" id="from_currency" placeholder="@lang('translation.enter_from_currency')" />
                          <span class="form-text text-danger" id="from_currency_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="to_currency">@lang('translation.to_currency') (Default Currency)</label>
                          <input type="text" class="form-control" name="to_currency" id="to_currency" value="AED" disabled placeholder="@lang('translation.enter_to_currency')" />
                          <span class="form-text text-danger" id="to_currency_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="symbol">@lang('translation.currency_symbol') </label>
                        <input type="text" class="form-control" name="symbol" id="symbol" placeholder="@lang('translation.enter_currency_symbol')" />
                        <span class="form-text text-danger" id="symbol_error"></span>
                    </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="rate">@lang('translation.conversion_rate') <span id="rate_specify"></span></label>
                        <input type="text" class="form-control" name="rate" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="rate" placeholder="@lang('translation.conversion_rate')" />
                        <span class="form-text text-danger" id="rate_error"></span>
                    </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-danger font-weight-bold" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
            </div>
        </div>
    </div>
</div>
<!-- Update Navbar Menu Modal-->
<div class="modal fade" id="Update_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Add Currnecy:</legend>
                    <div class="row">
                       
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="from_currency">@lang('translation.from_currency') </label>
                          <input type="text" class="form-control" name="u_from_currency" id="u_from_currency" autofocus placeholder="@lang('translation.enter_from_currency')" />
                          <span class="form-text text-danger" id="u_from_currency_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="to_currency">@lang('translation.to_currency') (Default Currency)</label>
                          <input type="text" class="form-control" name="to_currency" id="to_currency" value="AED" disabled placeholder="@lang('translation.enter_to_currency')" />
                          <span class="form-text text-danger" id="to_currency_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="symbol">@lang('translation.currency_symbol') </label>
                        <input type="text" class="form-control" name="u_symbol" id="u_symbol" placeholder="@lang('translation.enter_currency_symbol')" />
                        <span class="form-text text-danger" id="u_symbol_error"></span>
                    </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="rate">@lang('translation.conversion_rate') <span id="u_rate_specify"></span></label>
                        <input type="text" class="form-control" name="u_rate" id="u_rate" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="@lang('translation.conversion_rate')" />
                        <span class="form-text text-danger" id="rate_error"></span>
                    </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-danger font-weight-bold" id="update"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
            </div>
        </div>
    </div>
</div>

