<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Show_Link_For_COPY" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Copy Link</h5>
            </div>
            <div class="modal-body">
                <h3>Link</h3>
                <p id="Link"></p>
                <p>
                    <a id="copy" onclick="CopyLink()" class="btn btn-icon btn-info btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Copy Link">
                        <span class="svg-icon svg-icon-md svg-icon-primary">
                        <i class="fas fa-copy"></i>
                        </span>
                        </a>
                        <a  id="whastapp_link" class="btn btn-icon btn-success btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Whatsapp">
                        <span class="svg-icon svg-icon-md svg-icon-success">
                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                        </span>
                        </a>
                        <a  id="browser" target="_blank" class="btn btn-icon btn-primary btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Whatsapp">
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                            </a>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
            </div>
        </div>
    </div>
</div>

    <!-- Create Navbar Menu Modal-->
<div class="modal fade" id="charg_form" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Charge Form</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="amount">@lang('translation.amount')</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="@lang('translation.enter_amount')" autofocus/>
                        <span class="form-text text-danger" id="amount_error"></span>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="description">@lang('translation.reason')</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="@lang('translation.enter_reason')" autofocus/>
                        <span class="form-text text-danger" id="description_error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
            </div>
        </div>
    </div>
