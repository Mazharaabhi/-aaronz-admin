<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Add_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('translation.create_navbar_menu')</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>@lang('translation.title_english')</label>
                    <input type="email" class="form-control" id="title_english" autofocus/>
                    <span class="form-text text-danger" id="title_english_error"></span>
                </div>
                <div class="form-group">
                    <label>@lang('translation.slug')</label>
                    <input type="email" class="form-control" id="slug"/>
                    <span class="form-text text-danger" id="slug_error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
            </div>
        </div>
    </div>
</div>
<!-- Update Navbar Menu Modal-->
<div class="modal fade" id="edit_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" id="english-tab" href="#kt_tab_pane_1_4">
                                        <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                                        <span class="nav-text">@lang('translation.english')</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" id="arabic-tab" href="#kt_tab_pane_2_4">
                                        <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                                        <span class="nav-text">@lang('translation.arabic')</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                                <div class="form-group">
                                    <label>@lang('translation.title_english')</label>
                                    <input type="email" class="form-control" id="edit_title_english" autofocus/>
                                    <span class="form-text text-danger" id="edit_title_english_error"></span>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                                <div class="form-group">
                                    <label>@lang('translation.title_arabic')</label>
                                    <input type="email" class="form-control" id="title_arabic" dir="rtl" autofocus/>
                                    <span class="form-text text-danger" id="title_arabic_error"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>@lang('translation.slug')</label>
                                <input type="email" class="form-control" id="edit_slug"/>
                                <span class="form-text text-danger" id="edit_slug_error"></span>
                            </div>
                        </div>
                     </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="update"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Navbar Menu Modal-->
<div class="modal fade modal-confirm-delete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title"><i class="til_img"></i><strong>@lang('translation.confirm_delete')</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body with-padding">
                <div>@lang('translation.really_want_to_delete')</div>
            </div>

            <div class="modal-footer">
                <button class="float-left btn btn-warning" data-dismiss="modal">@lang('translation.cancel')</button>
                <button class="float-right btn btn-danger delete-crud-entry">@lang('translation.delete')</button>
            </div>
        </div>
    </div>
</div>
