<!-- Create Navbar Menu Modal-->
<div class="modal fade" id="Add_Menu_Modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('translation.add_email_category')</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>@lang('translation.category_name')</label>
                    <input type="email" class="form-control" id="category_name" autofocus/>
                    <span class="form-text text-danger" id="category_name_error"></span>
                </div>
                <div class="form-group">
                    <label>@lang('translation.email_subject')</label>
                    <input type="email" class="form-control" id="email_subject" />
                    <span class="form-text text-danger" id="email_subject_error"></span>
                </div>
                <div class="form-group">
                    <label for="tags">@lang('translation.email_tags')</label>
                    <div class="row">
                    @if (count($tags) > 0)
                        @foreach ($tags as $item)
                            <div class="col-md-3">
                                <label class="checkbox checkbox-danger mb-1">
                                    <input type="checkbox" name="tags[]" id="tags" value="{{ $item->tag }}">
                                <span class="mx-1"></span>{{ $item->tag }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-danger font-weight-bold" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
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
                                        <span class="nav-text">@lang('translation.edit_category')</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                                <div class="form-group">
                                    <label>@lang('translation.category_name')</label>
                                    <input type="email" class="form-control" id="edit_category_name" autofocus/>
                                    <span class="form-text text-danger" id="edit_category_name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label>@lang('translation.email_subject')</label>
                                    <input type="email" class="form-control" id="edit_email_subject" autofocus/>
                                    <span class="form-text text-danger" id="edit_email_subject_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="tags">@lang('translation.email_tags')</label>
                                    <div class="row">
                                    @if (count($tags) > 0)
                                        @foreach ($tags as $eedit_item)
                                            <div class="col-md-3">
                                                <label class="checkbox checkbox-danger mb-1">
                                                    <input type="checkbox" name="edit_tags[]" id="edit_tags" value="{{ $eedit_item->tag }}">
                                                <span class="mx-1"></span>{{ $eedit_item->tag }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                </div>
                            </div>
                        </div>
                     </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-danger font-weight-bold" id="update"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
            </div>
        </div>
    </div>
</div>
