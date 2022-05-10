<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Add_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Bank Details:</legend>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="bank_name" class="d-block">@lang('translation.bank_name') </label>
                          <input type="text" name="bank_name" id="bank_name" placeholder="@lang('translation.enter_bank_name')" class="form-control">
                          <span class="form-text text-danger" id="bank_name_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="bic" class="d-block">@lang('translation.bic') </label>
                        <input type="text" name="bic" id="bic" placeholder="@lang('translation.enter_bic')" class="form-control">
                        <span class="form-text text-danger" id="bic_error"></span>
                    </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="account_name" class="d-block">@lang('translation.account_name') </label>
                        <input type="text" name="account_name" id="account_name" placeholder="@lang('translation.enter_account_name')" class="form-control">
                        <span class="form-text text-danger" id="account_name_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="iban" class="d-block">@lang('translation.iban') @lang('translation.unique')</label>
                        <input type="text" name="iban" id="iban" placeholder="@lang('translation.enter_iban')" class="form-control">
                        <span class="form-text text-danger" id="iban_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                      <label for="account_no" class="d-block">@lang('translation.account_no') @lang('translation.unique')</label>
                      <input type="text" name="account_no" id="account_no" placeholder="@lang('translation.enter_account_no')" class="form-control">
                      <span class="form-text text-danger" id="account_no_error"></span>
                  </div>
                  <div class="col-md-6 col-lg-6 mb-4 ">
                    <label for="currency">@lang('translation.currency') </label>
                    <select name="b_currency" id="b_currency" class="form-control">
                        <option value="AED">AED</option>
                        <option value="USD">USD</option>
                    </select>
                    <span class="form-text text-danger" id="b_currency_error"></span>
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
<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Edit_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Edit Bank Details:</legend>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="edit_bank_name" class="d-block">@lang('translation.bank_name') </label>
                          <input type="text" name="edit_bank_name" id="edit_bank_name" placeholder="@lang('translation.enter_bank_name')" class="form-control">
                          <span class="form-text text-danger" id="edit_bank_name_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="edit_bic" class="d-block">@lang('translation.bic') </label>
                        <input type="text" name="edit_bic" id="edit_bic" placeholder="@lang('translation.enter_bic')" class="form-control">
                        <span class="form-text text-danger" id="edit_bic_error"></span>
                    </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="edit_account_name" class="d-block">@lang('translation.account_name') </label>
                        <input type="text" name="edit_account_name" id="edit_account_name" placeholder="@lang('translation.enter_account_name')" class="form-control">
                        <span class="form-text text-danger" id="edit_account_name_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="edit_iban" class="d-block">@lang('translation.iban') @lang('translation.unique')</label>
                        <input type="text" name="edit_iban" id="edit_iban" placeholder="@lang('translation.enter_iban')" class="form-control">
                        <span class="form-text text-danger" id="edit_iban_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                      <label for="edit_account_no" class="d-block">@lang('translation.account_no') @lang('translation.unique')</label>
                      <input type="text" name="edit_account_no" id="edit_account_no" placeholder="@lang('translation.enter_account_no')" class="form-control">
                      <span class="form-text text-danger" id="edit_account_no_error"></span>
                  </div>
                  <div class="col-md-6 col-lg-6 mb-4 ">
                    <label for="currency">@lang('translation.currency') </label>
                    <select name="edit_b_currency" id="edit_b_currency" class="form-control">
                        <option value="AED">AED</option>
                        <option value="USD">USD</option>
                    </select>
                    <span class="form-text text-danger" id="b_currency_error"></span>
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

