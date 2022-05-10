<!-- Add Property Category Modal-->
<div class="modal fade" id="propertyCategoryModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Property Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_cat_name">Property Category</label>
                        <input type="text" name="prop_cat_name" id="prop_cat_name" class="form-control" placeholder="Enter Category Name">
                        <span class="text-danger" id="prop_cat_name_error"></span>
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" placeholder="" class="form-control">
                      </div>
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_cat_id">Property Category Level</label>
                        <select name="prop_level" id="prop_level" class="form-control">
                            <option value="1">Parent</option>
                            <option value="2">Child</option>
                        </select>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5 w-100 d-none" id="prop_parent_div">
                        <label for="prop_parent_id">Select Parent</label>
                        <select name="prop_parent_id" id="prop_parent_id" class="form-control">
                            <option value="">---select parent---</option>
                            @if ($categories->count())
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endif
                        </select>
                        <span class="text-danger" id="prop_parent_id_error"></span>
                    </div>
                    <div class="col-md-12 mb-3 d-none" id="prop_includes_div">
                        <label for=""><b>Includes:</b></label><br>
                        <div class="mt-3" id="amenitesData">
                            <div style="display: block;" class="demo-checkbox col-md-12">
                                    <input name="bedroom" value="1" checked style="cursor: pointer;" type="checkbox" id="bedroom" class="chk-col-green">
                                    <label for="bedroom" style="min-width:150px;cursor: pointer;">Bedrooms</label>
                                    <input name="washroom" value="1" checked style="cursor: pointer;" type="checkbox" id="washroom" class="chk-col-green">
                                    <label for="washroom" style="min-width:150px;cursor: pointer;">Washrooms</label>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-cherwell font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-cherwell font-weight-bold" id="save_property_category">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Add Property Category Modal-->

<!-- Add Property Status Modal-->
<div class="modal fade" id="propertyStatusModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Property Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_type_id">Property Type</label>
                        <select name="prop_type_id" id="prop_type_id" class="form-control">
                            @if ($property_types->count())
                            @foreach ($property_types as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @endif
                        </select>
                        <span class="text-danger" id="prop_type_id_error"></span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_status_name">Property Status Title</label>
                        <input type="text" name="prop_status_name" id="prop_status_name" class="form-control" placeholder="Enter Category Name">
                        <span class="text-danger" id="prop_status_name_error"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-cherwell font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-cherwell font-weight-bold" id="add_property_status">Save changes</button>
            </div>
          </div>
      </div>
   </div>
</div>
<!-- Add Property Status Modal-->

<!-- Add Property Status Modal-->
<div class="modal fade" id="propertyViewModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Property View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_view_name">Property View Title</label>
                        <input type="text" name="prop_view_name" id="prop_view_name" class="form-control" placeholder="Enter Category Name">
                        <span class="text-danger" id="prop_view_name_error"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-cherwell font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-cherwell font-weight-bold" id="add_property_view">Save changes</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- Add Property Status Modal-->

<!-- Add Property Status Modal-->
<div class="modal fade" id="propertyDeveloperModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Developers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- grid column -->
                    <div class="col-md-12 mb-3 " id="div_1">
                      <label for="prop_developer_name">Name</label>
                      <input type="text" name="prop_developer_name" id="prop_developer_name" class="form-control" autofocus="">
                      <small id="prop_developer_name_error" class="text-danger"></small>
                    </div><!-- /grid column -->
                    <div class="col-md-12 col-lg-12 mb-4 ">
                    <label class="mr-2">Upload Flag</label>
                    <div class="group-contain" style="
                       display: flex;
                       ">
                       <div class="btn btn-secondary fileinput-button w-100" style="line-height: 2;height: 50px;display:block">
                          <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                          <input id="fileupload-btn-one" type="file" name="file-one" accept="image/*">
                       </div>
                       <div class="form-group w-100" style="
                          display: block;
                          margin: 0 auto;
                          ">
                          <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                             <img loading="lazy" src="#" alt="Preview Image" id="blah-one" class="d-none">
                          </div>
                       </div>
                    </div>
                    <!-- /.form-group -->
                    <small id="image_one_error" class="text-danger"></small>
                 </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-cherwell font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-cherwell font-weight-bold" id="add_property_developer">Save changes</button>
            </div>
        </div>
     </div>
  </div>
</div>
<!-- Add Property Status Modal-->

<!-- Add Property Status Modal-->
<div class="modal fade" id="propertyAgentModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Agents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="name">@lang('translation.name')</label>
                            <input type="text" class="form-control" name="agent_name" id="agent_name" placeholder="@lang('translation.enter_name')" autofocus/>
                            <span class="form-text text-danger" id="agent_name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="designation">@lang('translation.designation')</label>
                            <input type="text" class="form-control" name="designation" id="designation" placeholder="@lang('translation.enter_designation')"/>
                            <span class="form-text text-danger" id="designation_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="new_email" id="new_email" placeholder="Enter Email"/>
                            <span class="form-text text-danger" id="new_email_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="@lang('translation.enter_company_phone')" />
                            <span class="form-text text-danger" id="phone_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="password">@lang('translation.password') <button class="btn btn-success btn-sm" id="generate_password" style="padding: 2px 12px 2px 12px !important"><span class="fa fa-plus"></span> Generate</button></label>
                            <input type="text" class="form-control" name="password" id="password" placeholder="@lang('translation.enter_password')" />
                            <span class="form-text text-danger" id="password_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="confirm_password">@lang('translation.confirm_password')</label>
                            <input type="text" class="form-control" name="confirm_password" id="confirm_password" placeholder="@lang('translation.enter_confirm_password')"/>
                            <span class="form-text text-danger" id="confirm_password_error"></span>
                        </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-cherwell font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-cherwell font-weight-bold" id="add_property_agent">Save changes</button>
            </div>
        </div>
     </div>
  </div>
</div>
<!-- Add Property Status Modal-->

<!-- Add Property Status Modal-->
<div class="modal fade" id="propertyStateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Cities</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_state_name">Name</label>
                        <input type="text" name="prop_state_name" id="prop_state_name" class="form-control" placeholder="Enter Category Name">
                        <span class="text-danger" id="prop_state_name_error"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-cherwell font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-cherwell font-weight-bold" id="add_property_state">Save changes</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- Add Property Status Modal-->

<!-- Add Property Status Modal-->
<div class="modal fade" id="propertyAreaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_state_id">Cities</label>
                        <select name="prop_state_id" id="prop_state_id" class="form-control">
                            <option value="">---select city ---</option>
                            @if ($cities->count())
                            @foreach ($cities as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @endif
                        </select>
                        <span class="text-danger" id="prop_state_id_error"></span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_area_name">Area Name</label>
                        <input type="text" name="prop_area_name" id="prop_area_name" class="form-control" placeholder="Enter Category Name">
                        <span class="text-danger" id="prop_area_name_error"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-cherwell font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-cherwell font-weight-bold" id="add_property_area">Save changes</button>
            </div>
          </div>
      </div>
   </div>
</div>
<!-- Add Property Status Modal-->

<!-- Add Property Status Modal-->
<div class="modal fade" id="propertyLocationModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_location_state_id">Cities</label>
                        <select name="prop_location_state_id" id="prop_location_state_id" class="form-control">
                            <option value="">---select city ---</option>
                            @if ($cities->count())
                            @foreach ($cities as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @endif
                        </select>
                        <span class="text-danger" id="prop_location_state_id_error"></span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_location_area_id">Area</label>
                        <select name="prop_location_area_id" id="prop_location_area_id" class="form-control">
                            <option value="">---select area ---</option>
                        </select>
                        <span class="text-danger" id="prop_location_area_id_error"></span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                        <label for="prop_location_name">Location Name</label>
                        <input type="text" name="prop_location_name" id="prop_location_name" class="form-control" placeholder="Enter Category Name">
                        <span class="text-danger" id="prop_location_name_error"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-cherwell font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-cherwell font-weight-bold" id="add_property_location">Save changes</button>
            </div>
          </div>
      </div>
   </div>
</div>
<!-- Add Property Status Modal-->
