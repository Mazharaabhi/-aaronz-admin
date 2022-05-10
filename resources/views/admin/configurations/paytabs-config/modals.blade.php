<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Add_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Paytabs Info:</legend>
                    <div class="row">
                       <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="type">@lang('translation.account_type') </label>
                            <select name="type" id="type" class="form-control">
                                <option value="">---select account type---</option>
                                <option value="1">Live</option>
                                <option value="2">Sandbox</option>
                            </select>
                            <span class="form-text text-danger" id="type_error"></span>
                       </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="profile_id">@lang('translation.profile_id') </label>
                          <input type="number" class="form-control" name="profile_id" id="profile_id" placeholder="@lang('translation.enter_profile_id')" />
                          <span class="form-text text-danger" id="profile_id_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="server_key">@lang('translation.server_key') </label>
                          <input type="text" class="form-control" name="server_key" id="server_key" placeholder="@lang('translation.enter_server_key')" />
                          <span class="form-text text-danger" id="server_key_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="company_prefix" style="display:block">@lang('translation.company_prefix')
                              <button class="btn btn-success btn-sm" id="generate_company_prefix" style="padding: 2px 12px 2px 12px !important"><span class="fa fa-plus"></span> Generate</button>
                          </label>
                          <input type="text" name="company_prefix" id="company_prefix" placeholder="maximum 3 characters" onkeypress="return /[a-z]/i.test(event.key)" class="form-control" style="width: 48%;display:inline-block" maxlength="3">
                          <input type="text" name="cart_number" id="cart_number" class="form-control" value="-{{ $cart_number }}" style="width: 48%;display:inline-block" disabled>
                          <span class="form-text text-danger" id="company_prefix_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="currency">@lang('translation.currency') </label>
                          <select name="currency" id="currency" class="form-control">
                              @foreach ($currencies as $item)
                                  <option value="{{ $item->from_currency }}" {{ $item->from_currency == 'AED' ? 'selected' : '' }}>{{ $item->from_currency }}</option>
                              @endforeach
                          </select>
                          <span class="form-text text-danger" id="currency_error"></span>
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
                    <legend>Edit Paytabs Info:</legend>
                    <div class="row">
                       <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="edit_type">@lang('translation.account_type') </label>
                            <select name="edit_type" id="edit_type" class="form-control" disabled>
                                <option value="">---select account type---</option>
                                <option value="1">Live</option>
                                <option value="2">Sandbox</option>
                            </select>
                            <span class="form-text text-danger" id="type_error"></span>
                       </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="edit_profile_id">@lang('translation.profile_id') </label>
                          <input type="number" class="form-control" name="edit_profile_id" id="edit_profile_id" placeholder="@lang('translation.enter_profile_id')" />
                          <span class="form-text text-danger" id="edit_profile_id_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="edit_server_key">@lang('translation.server_key') </label>
                          <input type="text" class="form-control" name="edit_server_key" id="edit_server_key" placeholder="@lang('translation.enter_server_key')" />
                          <span class="form-text text-danger" id="edit_server_key_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="company_prefix" style="display:block">@lang('translation.company_prefix')</label>
                          <input type="text" name="edit_cart_id" id="edit_cart_id" class="form-control" disabled>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="edit_currency">@lang('translation.currency') </label>
                          <select name="edit_currency" id="edit_currency" class="form-control">
                            @foreach ($currencies as $item)
                            <option value="{{ $item->from_currency }}">{{ $item->from_currency }}</option>
                            @endforeach
                          </select>
                          <span class="form-text text-danger" id="edit_currency_error"></span>
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

