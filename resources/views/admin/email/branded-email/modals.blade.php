<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Add_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Branded Email Info:</legend>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="title">@lang('translation.email_title') </label>
                          <input type="text" class="form-control" name="title" id="title" placeholder="@lang('translation.enter_email_title')" autofocus/>
                          <span class="form-text text-danger" id="title_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="email">@lang('translation.email') </label>
                          <input type="text" class="form-control" name="brand_email" id="brand_email" placeholder="@lang('translation.enter_email')" />
                          <span class="form-text text-danger" id="email_error"></span>
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
                    <legend>Branded Email Info:</legend>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="title">@lang('translation.email_title') </label>
                          <input type="text" class="form-control" name="u_title" id="u_title" placeholder="@lang('translation.enter_email_title')" autofocus/>
                          <span class="form-text text-danger" id="u_title_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="email">@lang('translation.email') </label>
                          <input type="text" class="form-control" name="u_brand_email" id="u_brand_email" placeholder="@lang('translation.enter_email')" />
                          <span class="form-text text-danger" id="u_email_error"></span>
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

