<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Add_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Api Json Response</legend>
                    <div id="show_json"></div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
            </div>
        </div>
    </div>
</div>

<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Email_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Share Api Response Via Email</legend>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email_to_send" id="email_to_send" class="form-control" placeholder="Enter email">
                        <span id="email_to_send_error" class="text-danger"></span>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-danger font-weight-bold" id="email_buton"><span class="svg-icon svg-icon-md fa fa-envelope"></span> Send Emails</button>
            </div>
        </div>
    </div>
</div>