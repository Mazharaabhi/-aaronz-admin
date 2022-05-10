<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Add_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend>Add User Role:</legend>
                    <div class="row">

                      <div class="col-md-12 col-lg-12 mb-4 ">
                          <label for="role_name">Role Name</label>
                          <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Enter role name" />
                          <span class="form-text text-danger" id="role_name_error"></span>
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
                        <div class="col-md-12 col-lg-12 mb-4 ">
                            <label for="u_role_name">Role Name</label>
                            <input type="text" class="form-control" name="u_role_name" id="u_role_name" placeholder="Enter role name" />
                            <span class="form-text text-danger" id="u_role_name_error"></span>
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

