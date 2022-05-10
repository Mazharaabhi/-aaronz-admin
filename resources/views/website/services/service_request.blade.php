@extends('layouts.app')

@section('content')
<style>
     .lead-field {
                width: 100% !important;
                margin: 10px 0px 0px;
                padding: 8px;
                outline: none;
                border-radius: 12px;
                border: 2px solid #42cfd7;
                margin-bottom: 20px;
                color: #adadad;}
     .radio-group{
    width: 48%;
    background: #fff;
    border: 1.4px solid #d0d0d0;
    display: inline-block;
    float: left;
    padding: 12px 8px;
    margin: 10px 5px;
    border-radius: 50px;
    text-indent: 15px;
}
h3 {
    margin: 20px 0px 0px;
}
textarea.form-control {
    height: auto;
    border-radius: 8px;
}
.select2-container--default .select2-selection--multiple {
      line-height: 40px;
}
label[for="exampleInputEmail"]{
    position: relative;
    margin-bottom: -26px;
    top: -38px;
    left: 10px;
    display: block;
}
h4.modal-title.w-100 {
    color: #30ccd3;
    font-size: 28px;
    font-weight: 800;
    text-shadow: 0px 1px 2px #000000bf;
}
#mysuccModal .icon-box {
    transform: translate(-45px, 0px);
    position: absolute;
    top: -3px;
    background: #30ccd3;
    color: #fff;
    font-size: 40px;
    padding: 22px;
    border-radius: 50%;
    top: -45px;
    left: 50%;
    /* right: 0; */
}
.question-group {
    display: block;
    width: 100%;
    clear: both;
}
#mysuccModal i.material-icons.fa.fa-check {
        text-shadow: 1px 3px 2px #636362;
    }

</style>
<section class="p0">
    <div class="container">
        <div class="row listing_single_row">
            <div class="col-sm-6 col-lg-7 col-xl-8">
                <div class="single_property_title">
                    <a href="images/property/ls1.jpg" class="upload_btn popup-img"><span class="flaticon-photo-camera"></span> View Photos</a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-5 col-xl-4">
                <div class="single_property_social_share">
                    <div class="spss style2 mt10 text-right tal-400">
                        <ul class="mb0">
                            <li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="flaticon-share"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="flaticon-printer"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="prop-detail-page">
    <div class="container">
       <div class="row p-3">
          <div class="col-md-4">
             <div class="col-md-12 d-flex property_gen">
                <div class="property-dtl-price">
                   <small>AED</small><span>  {{ $list_service->daily_charges }} </span><small> / Day</small>
                </div>
             </div>
             <div class="col-md-12">
                <div class="details">
                   <div class="tc_content">
                      <h4 class="text-muted mt-0">{{ $list_service->title }}</h4>
                   </div>
                </div>
             </div>
                <div class="col-md-12 mt-2 p-0">
                   <h3 class="prop-detail-overview">Details</h3>
                   <p class="mb0"></p>
                   <p class="gpara second_para  mt10 mb10"> {{ $list_service->description  }}</p>

                   <p class="overlay_close">
                      <a class="text-thm fz14" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Show More <span class="flaticon-download-1 fz12"></span>
                      </a>
                   </p>
                </div>
                   </div>
                 <div class="col-md-5">
                    <div class="company-logo"><img loading="lazy" src="{{ asset('storage/'.$list_service->image) }}"></div>
                 </div>
                   <div class="col-md-3">
                    <div class="company-details">
                        <div class="company-logo"><img loading="lazy" src="{{ asset('storage/'.$list_service->company->avatar) }}"></div>
                        <div class="comapny-title">{{ $list_service->company->company_name }}</div>
                        <div class="row detialsdes">
                           <div class="col-lg-12">
                              <table>
                                 <tbody>
                                    <tr>
                                       <td><strong>RERA#</strong></td>
                                       <td>{{ $list_service->company->rera_no }}</td>
                                    </tr>
                                    <tr>
                                       <td><strong>DTCM#</strong></td>
                                       <td>{{ $list_service->company->dtcm_no }}</td>
                                    </tr>
                                    <tr>
                                       <td><strong>Permit#</strong></td>
                                       <td class="service-area-con">
                                          0517016410
                                       </td>
                                    </tr>
                                    <tr>
                                       <td><strong>Properties:</strong></td>
                                       <td>{{ $list_service->company->properties_count }}</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <hr>
                        </div>
                     </div>
                 </div>
                </div>
             </div>
       {{-- <div id="map-canvas"></div> --}}
 </section>
    <section>
        <div class="container">
            <div class="row">
                @if ($questions->count())
                <div class="col-md-2 mb-5"></div>
                        <div class="col-md-8 mb-5 sidebar_listing_list p-5 service-lead">
                            <input type="hidden" value="{{ $list_service->company->id }}" id="company_id" />
                            <input type="hidden" value="{{ $list_service->id }}" id="service_id" />
                        @foreach ($questions as $key => $item)
                        <div class="question-group">
                        <input type="hidden" value="{{ $item->id }}" name="questions[]" id="questions">
                        <input type="hidden" value="{{ $item->name }}" name="question_names[]" id="question_names">
                           <h3>{{ ++$key }}. {{ $item->name }}</h3>
                            <p>{{ $item->question_options }}</p>
                            @if ($item->question_type == 2)
                                @foreach ($item->QuestionOptions as $qs)
                                        <label class="radio-group"><input type="radio" name="answer_{{ $item->id }}" id="answer_{{ $item->id }}" value="{{ $qs->title }}"/> {{ $qs->title }}</label>
                                @endforeach
                            @elseif($item->question_type == 1)
                                <div class="mb-6">{{ $item->name }}
                                    <div>
                                        <input type="number" min="0" style="width: 100% !important; margin:10px 0px 0px;" id="answer_{{ $item->id }}" name="answer_{{ $item->id  }}" value="0" />
                                  </div>
                            @else
                            <div class="mb-6">{{ $item->name }}
                                <div>
                                    <input type="date" style="width: 100% !important; margin:10px 0px 0px;" name="answer_{{ $item->id  }}" class="lead-field" />
                                </div>
                            </div>
                            @endif
                        </div>
                    @endforeach
                            <div class="question-group">
                            <h3>Location? (type and select the area)</h3>
                            <div class="form-group">
                                <select name="l" id="l" class="form-control select2_el" multiple required></select>
                                <label for="l"><span class="flaticon-maps-and-flags"></span></label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <input type="number" name="phone-number" class="form-control" id="phone-number" placeholder="Enter your phone number">
                            </div>
                            <div class="form-group">
                                <textarea name="deatils" id="deatils" cols="30" rows="3" class="form-control" placeholder="Some details for your job"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="button" id="send-lead-request" class="btn btn-block btn-thm" value="Send Request">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-2 mb-5"></div>
                @endif
            </div>
        </div>
    </section>
    <div id="mysuccModal" class="modal fade">
        <div class="modal-dialog modal-confirm modal-sm">
            <div class="modal-content">
                <div class="modal-header pb-0" style="border:none;">
                    <div class="icon-box">
                        <i class="material-icons fa fa-check"></i>
                    </div>
                    <h4 class="modal-title w-100 text-center pt-4">Thank You!</h4>
                </div>
                <div class="modal-body pt-1">
                    <p class="text-center" id="pop-message" style='margin-bottom:0;'>Service Request Sent Successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal" style="color: #fff;background-color: #30ccd3;border-color: #f3f3f3;
                    ">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('website.services.js.service_request')
