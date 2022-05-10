@extends('layouts.master', ['linke' => route('admin.administrator.manage-users.index')])
@section('title', 'Tenancy Contract')
@section('first', 'Tenancy Contract')
@section('second', 'Contracts')
@section('third', 'Tenancy Contract')
@section('fourth', 'Create')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                 <h3 class="card-title">
                    Tenancy Contract
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('property-contracts.index') }}" class="btn btn-danger float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <fieldset>
                      <legend>Property Details</legend>
                      <div class="row">
                        <div class="col-lg-5">
                            <h3><b>Lead Info</b></h3>
                            <div class="row">
                                <div class="col-12">
                                    <label for=""><b>Name:</b></label>
                                    {{ $lead->name }}
                                </div>
                                <div class="col-12">
                                    <label for=""><b>Email:</b></label>
                                    {{ $lead->email }}
                                </div>
                                <div class="col-12">
                                    <label for=""><b>Phone:</b></label>
                                    {{ $lead->phone }}
                                </div>
                                <div class="col-6">
                                    <label for="" class="d-block"><b>Emirate ID Front:</b></label>
                                    <img src="{{ $lead->requester ? asset('storage/'.$lead->requester->id_front) : '' }}" alt="Emirate ID Fron" class="rounded" width="200px" width="50px">
                                </div>
                                <div class="col-6">
                                    <label for="" class="d-block"><b>Emirate ID Back:</b></label>
                                    <img src="{{ $lead->requester ? asset('storage/'.$lead->requester->id_back) : '' }}" alt="Emirate ID Fron" class="rounded" width="200px" width="50px">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-7">
                            <h3><b>Property Info</b></h3>
                            <a href="Mortgage.html">
                               <div class="feat_property list">
                                  <div class="thumb">
                                     {{--  <img loading="lazy" class="img-whp" src="@if($property->images !='') {{ $property->images[0]->image }} @endif" alt="fp1.jpg">  --}}
                                  </div>
                                  <div class="details">
                                     <div class="tc_content">
                            <a class="fp_price" href="#">AED <span>{{ number_format($property->month_rent) }}/mon</span> </a>
                            <a class="fp_tag" href="#">Signature</a>
                            <h4>{{ $property->title }}</h4>
                            <div class="text-thm">
                            <div class=" thmb_cntnt">
                            <ul class="tag mb0">
                            <li class="list-inline-item"><a href="#">For {{ $property->type->name }}</a></li>
                            <li class="list-inline-item"><a href="#">{{ $property->category->name }}</a></li>
                            </ul>
                            </div>
                            </div>
                            <p class="property_desc">Exclusive! Furnished 2BR | High Floor | Canal View...</p>
                            <ul class="prop_details mb0">
                            <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="31.409" height="22.29" viewBox="0 0 31.409 22.29">
                            <path id="bed" d="M38.9,96.718H38.4V92.665a2.029,2.029,0,0,0-2.026-2.026V82.026A2.029,2.029,0,0,0,34.343,80H13.066a2.029,2.029,0,0,0-2.026,2.026v8.612a2.029,2.029,0,0,0-2.026,2.026v4.053H8.507A.507.507,0,0,0,8,97.224v2.026a.507.507,0,0,0,.507.507h.507v2.026a.507.507,0,0,0,.507.507h1.52a.506.506,0,0,0,.5-.407l.426-2.126H35.447l.426,2.126a.506.506,0,0,0,.5.407h1.52a.507.507,0,0,0,.507-.507V99.757H38.9a.507.507,0,0,0,.507-.507V97.224A.507.507,0,0,0,38.9,96.718ZM12.053,82.026a1.015,1.015,0,0,1,1.013-1.013H34.343a1.015,1.015,0,0,1,1.013,1.013v8.612H34.343V88.612a2.029,2.029,0,0,0-2.026-2.026H26.237a2.029,2.029,0,0,0-2.026,2.026v2.026H23.2V88.612a2.029,2.029,0,0,0-2.026-2.026H15.092a2.029,2.029,0,0,0-2.026,2.026v2.026H12.053ZM33.33,88.612v2.026H25.224V88.612A1.015,1.015,0,0,1,26.237,87.6h6.079A1.015,1.015,0,0,1,33.33,88.612Zm-11.145,0v2.026H14.079V88.612A1.015,1.015,0,0,1,15.092,87.6h6.079A1.015,1.015,0,0,1,22.185,88.612ZM10.026,92.665a1.015,1.015,0,0,1,1.013-1.013h25.33a1.015,1.015,0,0,1,1.013,1.013v4.053H10.026Zm.6,8.612h-.6v-1.52h.9Zm26.758,0h-.6l-.3-1.52h.9ZM38.4,98.744H9.013V97.731H38.4Z" transform="translate(-8 -80)" fill="#30ccd3"></path>
                            </svg> Beds: {{ $property->bed_no }}</a></li>
                            <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="31.509" height="27.963" viewBox="0 0 31.509 27.963">
                            <g id="bathing" transform="translate(-7.95 -39.95)">
                            <path id="Path_1787" data-name="Path 1787" d="M38.9,55.2H34.343v-1.52a.507.507,0,0,0-.507-.507H27.757a.507.507,0,0,0-.507.507V55.2H13.066V43.546a2.533,2.533,0,1,1,5.066,0V44.6a3.044,3.044,0,0,0-2.533,3v.507a.507.507,0,0,0,.507.507h5.066a.507.507,0,0,0,.507-.507V47.6a3.044,3.044,0,0,0-2.533-3V43.546a3.546,3.546,0,0,0-7.092,0V55.2H8.507A.507.507,0,0,0,8,55.7v1.52a.507.507,0,0,0,.507.507h1.52v3.546a5.582,5.582,0,0,0,4.053,5.362v.717a.507.507,0,0,0,1.013,0v-.53c.167.015.336.023.507.023H31.81c.171,0,.339-.008.507-.023v.53a.507.507,0,0,0,1.013,0v-.717a5.582,5.582,0,0,0,4.053-5.362V57.731H38.9a.507.507,0,0,0,.507-.507V55.7A.507.507,0,0,0,38.9,55.2ZM20.665,47.6H16.612a2.026,2.026,0,0,1,4.053,0Zm7.6,6.586H33.33V62.8H28.264ZM9.013,56.718v-.507H27.251v.507Zm27.356,4.559a4.565,4.565,0,0,1-4.559,4.559H15.6a4.565,4.565,0,0,1-4.559-4.559V57.731H27.251V63.3a.507.507,0,0,0,.507.507h6.079a.507.507,0,0,0,.507-.507V57.731h2.026ZM38.4,56.718H34.343v-.507H38.4Z" transform="translate(0 0)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                            <path id="Path_1788" data-name="Path 1788" d="M78.079,336H72.507a.507.507,0,0,0,0,1.013h5.573a.507.507,0,0,0,0-1.013Z" transform="translate(-59.947 -277.256)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                            <path id="Path_1789" data-name="Path 1789" d="M185.52,336h-1.013a.507.507,0,0,0,0,1.013h1.013a.507.507,0,0,0,0-1.013Z" transform="translate(-164.855 -277.256)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                            <path id="Path_1790" data-name="Path 1790" d="M257.52,171.04a1.52,1.52,0,1,0-1.52-1.52A1.52,1.52,0,0,0,257.52,171.04Zm0-2.026a.507.507,0,1,1-.507.507A.507.507,0,0,1,257.52,169.013Z" transform="translate(-232.296 -119.894)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                            <path id="Path_1791" data-name="Path 1791" d="M298.533,93.066A2.533,2.533,0,1,0,296,90.533,2.533,2.533,0,0,0,298.533,93.066Zm0-4.053a1.52,1.52,0,1,1-1.52,1.52A1.52,1.52,0,0,1,298.533,89.013Z" transform="translate(-269.763 -44.96)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                            <path id="Path_1792" data-name="Path 1792" d="M360,162.026A2.026,2.026,0,1,0,362.026,160,2.026,2.026,0,0,0,360,162.026Zm2.026-1.013a1.013,1.013,0,1,1-1.013,1.013A1.013,1.013,0,0,1,362.026,161.013Z" transform="translate(-329.71 -112.401)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                            </g>
                            </svg> Baths: {{ $property->bath_no }}</a></li>
                            <li class="list-inline-item"><a href="#"><svg id="selection" xmlns="http://www.w3.org/2000/svg" width="31.409" height="31.409" viewBox="0 0 31.409 31.409">
                            <g id="Group_990" data-name="Group 990">
                            <path id="Path_1802" data-name="Path 1802" d="M30.6,6.443a.805.805,0,0,0,.805-.805V.805A.805.805,0,0,0,30.6,0H25.771a.805.805,0,0,0-.805.805V2.416H6.443V.805A.805.805,0,0,0,5.637,0H.805A.805.805,0,0,0,0,.805V5.637a.805.805,0,0,0,.805.805H2.416V24.966H.805A.805.805,0,0,0,0,25.771V30.6a.805.805,0,0,0,.805.805H5.637a.805.805,0,0,0,.805-.805V28.993H24.966V30.6a.805.805,0,0,0,.805.805H30.6a.805.805,0,0,0,.805-.805V25.771a.805.805,0,0,0-.805-.805H28.993V6.443ZM27.382,24.966H25.771a.805.805,0,0,0-.805.805v1.611H6.443V25.771a.805.805,0,0,0-.805-.805H4.027V6.443H5.637a.805.805,0,0,0,.805-.805V4.027H24.966V5.637a.805.805,0,0,0,.805.805h1.611V24.966Z" fill="#30ccd3"></path>
                            </g>
                            </svg>
                            Sq Ft: {{ number_format($property->size_sqft) }}</a></li>
                            </ul>
                            </div>
                            <div class="fp_footer">
                            <div class="btn-group d-none">
                            <a class="call-btn-1 raise" href="#call">Call <i class="fa fa-phone"></i></a> <a class="call-btn-2 raise" href="#mail">Email <i class="fa fa-envelope-o"></i></a>
                            </div>
                            <img loading="lazy" class="developer-logo" src="images/property/vanguard.jfif">
                            </div>
                            </div>
                            </div>
                            </a>
                         </div>
                    </div>
                  </fieldset>
                  <fieldset>
                      <legend>Contract Details</legend>
                      <div class="row mb-2">
                        <div class="col-md-4 col-lg-4 mb-4">
                            <label for="name">Contract Start Date:</label>
                            <input type="date" class="form-control" name="start_date" id="start_date"/>
                            <span class="form-text text-danger" id="start_date_error"></span>
                        </div>
                        <div class="col-md-4 col-lg-4 mb-4">
                            <label for="name">Contract End Date:</label>
                            <input type="date" class="form-control" name="end_date" id="end_date" readonly/>
                            <span class="form-text text-danger" id="end_date_error"></span>
                        </div>
                        <div class="col-md-4 col-lg-4 mb-4">
                            <label for="name">Check Generate Date:</label>
                            <input type="date" class="form-control" name="check_date" id="check_date"/>
                            <span class="form-text text-danger" id="check_date_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="name">Yearly Rent:</label>
                            <input type="text" class="form-control" name="year_rent" id="year_rent" value="{{ $property->year_rent }}" disabled autofocus/>
                            <span class="form-text text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="name">No of Checks: </label>
                            <select name="check_no" id="check_no" class="form-control">
                                <option value="">--select check nos.---</option>
                                <option value="12">12</option>
                                <option value="6">6</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                            <span class="form-text text-danger" id="check_no_error"></span>
                        </div>
                        <div class="col-md-12 col-lg-12 mb-4" id="vouchers_div">
                        </div>
                      </div>
                  </fieldset>
                  <fieldset>
                    <legend>Tenant Document Section:</legend>
                    <div class="form-group" id="wiget-desc">
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="name">Document File:</label>
                            <input type="file" class="form-control" accept="image/*"  id="header_image_1">
                             <span id="image_1_error" class="text-danger"></span>
                             <div class="d-none" id="widget-one-div">
                                 <hr>
                                 <p id="ImageToUpdate" style="margin: 0px"></p>
                             </div>
                            </div>
                            <div class="col-md-6 mb-3"><label for="name">Document Type</label>
                              <select name="document_type_id" id="document_type_id" class="form-control">
                                  <option value=""></option>
                                  @if ($document_types->count())
                                      @foreach ($document_types as $item)
                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                      @endforeach
                                  @endif
                              </select>
                              <span id="document_type_id_1_error" class="text-danger"></span>
                            </div>
                          <div class="col-md-12 mb-3">
                            <button class="btn btn-primary btn-lg btn-block" id="add-button-english">Add Document</button>
                          </div>
                        </div>
                    </div><!-- /.form-group -->
                    <div class="row ">
                        <div class="col-md-12">
                          <span id="widget_1_error" class="text-danger"></span>
                          <table class="table table-bordered table-sm" id="wiget_data">
                            <thead class="bg-success text-white">
                              <tr>
                                 <th width="7%">ID</th>
                                 <th width="23%">Document File</th>
                                  <th width="50%">Document Type</th>
                                  <th width="20%" class="text-center">Action</th>
                              </tr>
                          </thead>
                          </table>
                        </div>
                      </div>
                </fieldset>
                <fieldset>
                    <legend>Owner Document Section:</legend>
                    <div class="form-group" id="wiget-desce">
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="name">Document File:</label>
                            <input type="file" class="form-control" accept="image/*"  id="header_image_1e">
                             <span id="image_1_errore" class="text-danger"></span>
                             <div class="d-none" id="widget-one-dive">
                                 <hr>
                                 <p id="ImageToUpdatee" style="margin: 0px"></p>
                             </div>
                            </div>
                            <div class="col-md-6 mb-3"><label for="name">Document Type</label>
                              <select name="document_type_ide" id="document_type_ide" class="form-control">
                                  <option value=""></option>
                                  @if ($document_types->count())
                                      @foreach ($document_types as $item)
                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                      @endforeach
                                  @endif
                              </select>
                              <span id="document_type_id_1_errore" class="text-danger"></span>
                            </div>
                          <div class="col-md-12 mb-3">
                            <button class="btn btn-primary btn-lg btn-block" id="add-button-englishe">Add Document</button>
                          </div>
                        </div>
                    </div><!-- /.form-group -->
                    <div class="row ">
                        <div class="col-md-12">
                          <span id="widget_1_errore" class="text-danger"></span>
                          <table class="table table-bordered table-sm" id="wiget_datae">
                            <thead class="bg-success text-white">
                              <tr>
                                 <th width="7%">ID</th>
                                 <th width="23%">Document File</th>
                                  <th width="50%">Document Type</th>
                                  <th width="20%" class="text-center">Action</th>
                              </tr>
                          </thead>
                          </table>
                        </div>
                      </div>
                </fieldset>
                  <div class="row mb-6">
                    <div class="col-md-12 col-lg-12 mb-6">
                        <button class="btn btn-danger btn-block" style="font-size:16px;" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
                    </div>
                  </div>
                 </div>
                <!--end::Form-->
               </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@include('admin.contracts.property-contracts.js.create')
@endsection
