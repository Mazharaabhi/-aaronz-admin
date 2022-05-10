<style>
    .list-group-item.active {
    z-index: 2;
    color: #ffffff;
    background-color: #f6243b !important;
    border-color: #f6243b !important;
}
</style>
 <!-- Capture Model-->
 <div class="modal fade" id="capture_form" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Capture Payment Form</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="capture_name" id="capture_name" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="capture_phone" id="capture_phone" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="amount">@lang('translation.amount') <small style="font-size: 13px" class="text-danger"></small></label>
                        <input type="number" class="form-control" name="capture_amount" id="capture_amount" disabled placeholder="@lang('translation.enter_amount')" />
                        <span class="form-text text-danger" id="capture_amount_error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="capture"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> Capture</button>
            </div>
        </div>
    </div>
</div>
<!-- View Invoice Modal-->
<div class="modal fade" id="invoice_details" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h5 class="modal-title" id="exampleModalLabel"><label for="" id="status_label"></label> <span id="transaction_type"></span> <span id="transaction_referance"></span>
                </h5>
                <span class="btn btn-light-danger font-weight-bold float-right fa fa-close" data-dismiss="modal"></span>
            </div>
            <div class="modal-body" style="padding: 0px;">
                <ul class="list-group" style="border-radius: 0px">
                    <li class="list-group-item active" style="font-size: 15px; font-weight:bold">#<span id="transaction_id"></span> : {{ config('app.name') }}</li>
                </ul>
                <div class="row">
                    <div class="col-md-8 col-lg-8">
                        <ul class="list-group" style="border-radius: 0px">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Amount</strong></div>
                                            <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="cart_amount_currency"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Cart Id</strong></div>
                                            <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_cart_id"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item d-none" id="customer_inovice_li">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Status</strong></div>
                                            <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_status"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Response Code</strong></div>
                                            <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_resp_msg"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Date:</strong></div>
                                            <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_date"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="row" id="invoice_li">
                                            <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice #</strong></div>
                                            <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoice_no"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item d-none" id="invoice_ref_li">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice Ref</strong></div>
                                            <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoice_ref"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Customer Ref</strong></div>
                                            <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_customer_ref"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3"><strong for="">Description</strong></div>
                                    <div class="col-md-7 col-lg-7"><span for="" id="transaction_description"></span></div>
                                </div>
                            </li>
                          </ul>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h3 class="mt-5 mb-1"><b>Bill TO</b></h3>
                        <p id="name" class="m-0"></p>
                        <p id="c_email" class="m-0"></p>
                        <p id="address" class="m-0"></p>
                        <p id="c_country" class="m-0"></p>
                        <p id="c_state" class="m-0"></p>
                        <br/>
                        <p id="refund_p" class="d-none"><b>Refund:</b>
                            <button class="btn btn-danger btn-sm" id="refund_btn"> <i class="fa fa-minus-square"></i>
                            <input type="hidden" id="hidden_cart_id">
                            <input type="hidden" id="hidden_cart_amount">
                            <input type="hidden" id="hidden_tran_ref">
                            <input type="hidden" id="hidden_id">
                            <input type="hidden" id="hidden_email">
                            <input type="hidden" id="hidden_name">
                            <input type="hidden" id="hidden_phone">
                            <input type="hidden" id="hidden_currency">
                            </button>
                        </p>
                    </div>
                </div>
                <fieldset class="mr-1 ml-1 d-none" id="legend">
                    <legend>Invoice Items:</legend>
                    <div class="row d-none" id="table_row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                          <th width="15%">SKU</th>
                                          <th width="30%">Description</th>
                                          <th width="10%">Unit Price</th>
                                          <th width="10%">Quantity</th>
                                          <th width="10%">Discount</th>
                                          <th width="10%">Tax</th>
                                          <th width="10%">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="row d-none" id="list_to_hide">
                            <div class="col-md-5 col-lg-5 col-sm-12"></div>
                            <div class="col-md-7 col-lg-7 col-sm-12">
                              <ul class="list-group" style="border-radius: 0px">
                                  <li class="list-group-item">
                                      <div class="row">
                                          <div class="col-md-3 col-lg-3 col-sm-3"><strong for="">Sub Total</strong></div>
                                          <div class="col-md-9 col-lg-9 col-sm-9"><span for="" id="sub_total"></span></div>
                                      </div>
                                  </li>
                                  <li class="list-group-item">
                                      <div class="row">
                                          <div class="col-md-3 col-lg-3 col-sm-3"><strong for="">Discount</strong></div>
                                          <div class="col-md-9 col-lg-9 col-sm-9"><span for="" id="discount"></span></div>
                                      </div>
                                  </li>
                                  <li class="list-group-item">
                                          <div class="row">
                                              <div class="col-md-3 col-lg-3 col-sm-3"><strong for="">Extra Charges</strong></div>
                                              <div class="col-md-9 col-lg-9 col-sm-9"><span for="" id="extra_charges"></span></div>
                                          </div>
                                  </li>
                                  <li class="list-group-item">
                                      <div class="row">
                                          <div class="col-md-3 col-lg-3 col-sm-3"><strong for="">Shipping Charges</strong></div>
                                          <div class="col-md-9 col-lg-9 col-sm-9"><span for="" id="shipping_charges"></span></div>
                                      </div>
                                  </li>
                                  <li class="list-group-item">
                                      <div class="row">
                                          <div class="col-md-3 col-lg-3 col-sm-3"><strong for="">Grand Total</strong></div>
                                          <div class="col-md-9 col-lg-9 col-sm-9"><span for="" id="grand_total"></span></div>
                                      </div>
                                  </li>
                                </ul>
                          </div>
                        </div>
                      </div>
                    </div>

                </fieldset>
            </div>
        </div>
    </div>
</div>
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
                            <input type="hidden" name="m_email" id="m_email">
                            <input type="hidden" name="m_phone" id="m_phone">
                            <input type="hidden" name="m_name" id="m_name">
                            <input type="hidden" name="m_link" id="m_link">
                            <a id="m_message" class="btn btn-icon btn-primary btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="SMS">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                <i class="fas fa-sms"></i>
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
                        <input type="text" name="c_name" id="c_name" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="amount">@lang('translation.amount') <small id="note" style="font-size: 13px" class="text-danger"></small></label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="@lang('translation.enter_amount')" autofocus/>
                        <span class="form-text text-danger" id="amount_error"></span>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="description">@lang('translation.reason')</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="@lang('translation.enter_reason')" />
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
</div>
<!-- Refund Model-->
<div class="modal fade" id="refund_form" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Refund Form</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="r_name" id="r_name" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="r_phone" id="r_phone" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="amount">@lang('translation.amount') <small style="font-size: 13px" class="text-danger"></small></label>
                        <input type="number" class="form-control" name="r_amount" disabled id="r_amount" placeholder="@lang('translation.enter_amount')" />
                        <span class="form-text text-danger" id="r_amount_error"></span>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="description">@lang('translation.reason')</label>
                        <input type="text" class="form-control" name="r_description" id="r_description" placeholder="@lang('translation.enter_reason')" autofocus/>
                        <span class="form-text text-danger" id="r_description_error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="refund"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> Refund</button>
            </div>
        </div>
    </div>
</div>
<!-- Voided Model-->
<div class="modal fade" id="void_form" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Voided Form</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="v_name" id="v_name" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="v_phone" id="v_phone" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="amount">@lang('translation.amount') <small style="font-size: 13px" class="text-danger"></small></label>
                        <input type="number" class="form-control" name="v_amount" id="v_amount" disabled placeholder="@lang('translation.enter_amount')" />
                        <span class="form-text text-danger" id="v_amount_error"></span>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="description">@lang('translation.reason')</label>
                        <input type="text" class="form-control" name="v_description" id="v_description" placeholder="@lang('translation.enter_reason')" autofocus/>
                        <span class="form-text text-danger" id="v_description_error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> @lang('translation.close')</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="voided"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> Void</button>
            </div>
        </div>
    </div>
</div>