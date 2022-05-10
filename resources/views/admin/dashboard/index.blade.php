@extends('layouts.master')
@section('title', "Dashboard")
@section('first', "Dashboard")
@section('class_second', "d-none")
@section('class_third', "d-none")
@section('class_fourth', "d-none")
@section('content')
<br>
<style>
    svg path {
    fill: #05c7b8;
}
</style>
<div class="container-fluid">
    <div class="tab-content mt-3" id="myTabContent2">
        <div class="tab-pane fade active show" id="home-2" role="tabpanel" aria-labelledby="home-tab-2">
            <div class="content d-flex flex-column flex-column-fluid  p-0" id="kt_content">
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <!--begin::Dashboard-->
@if (CheckUseRole() == 1 || CheckUseRole() == 2 || CheckUseRole() == 3)
                              <!--begin::Row-->
    <div class="row mb-4 mr-2 addjustpad">
                    @if(Auth::user()->user_role ==1)
                            <div class="col-lg-3">
                              <!--begin::Callout-->
                                <div class="card card-custom mb-8 mb-lg-0">
                                    <div class="card-body icon-dashbo">
                                        <div class="align-items-center">
                                         <!--begin::Icon-->
                                            <div class="mr-6 icon-container">

<svg xmlns="http://www.w3.org/2000/svg" width="55.845" height="52.095" viewBox="0 0 55.845 52.095">
    <g id="office-building" transform="translate(0 -17.188)">
      <g id="Group_4" data-name="Group 4" transform="translate(0 17.188)">
        <g id="Group_3" data-name="Group 3">
          <path id="Path_7" data-name="Path 7" d="M53.118,63.83h-.692V50.321a.818.818,0,1,0-1.636,0V63.83H33.436V41.593H50.121a.669.669,0,0,1,.669.669v4.206a.818.818,0,1,0,1.636,0V42.261a2.307,2.307,0,0,0-2.3-2.3H33.436V25.091a2.316,2.316,0,0,0-2.111-2.3V21.154a2.316,2.316,0,0,0-2.125-2.3L8.014,17.2a2.306,2.306,0,0,0-2.485,2.3V20.8a2.305,2.305,0,0,0-2.111,2.3V63.83H2.727a2.727,2.727,0,0,0,0,5.454H53.118a2.727,2.727,0,1,0,0-5.454ZM7.166,19.493a.668.668,0,0,1,.721-.667l21.186,1.66a.672.672,0,0,1,.616.667v1.512L7.166,20.9V19.493ZM5.055,23.1a.668.668,0,0,1,.721-.667l25.408,1.991a.672.672,0,0,1,.616.667V63.83H29.514V52.118a1.352,1.352,0,0,0-1.35-1.35h-7.6a1.352,1.352,0,0,0-1.35,1.35v5.307a.818.818,0,0,0,1.636,0V52.4h7.028V63.83H20.85V61.249a.818.818,0,0,0-1.636,0V63.83H5.055ZM53.118,67.648H2.727a1.091,1.091,0,0,1,0-2.181H53.118a1.091,1.091,0,0,1,0,2.181Z" transform="translate(0 -17.188)" fill="#c1bfcc"/>
          <path id="Path_8" data-name="Path 8" d="M64.375,119.073h3.311a1.413,1.413,0,0,0,1.412-1.412v-2.548a1.413,1.413,0,0,0-1.412-1.412H64.375a1.413,1.413,0,0,0-1.412,1.412v2.548A1.413,1.413,0,0,0,64.375,119.073Zm.224-3.735h2.862v2.1H64.6Z" transform="translate(-56.095 -103.175)" fill="#c1bfcc"/>
          <path id="Path_9" data-name="Path 9" d="M140.069,119.073h3.311a1.413,1.413,0,0,0,1.412-1.412v-2.548a1.413,1.413,0,0,0-1.412-1.412h-3.311a1.413,1.413,0,0,0-1.412,1.412v2.548A1.413,1.413,0,0,0,140.069,119.073Zm.224-3.735h2.862v2.1h-2.862Z" transform="translate(-123.533 -103.175)" fill="#c1bfcc"/>
          <path id="Path_10" data-name="Path 10" d="M215.762,119.073h3.311a1.413,1.413,0,0,0,1.412-1.412v-2.548a1.413,1.413,0,0,0-1.412-1.412h-3.311a1.413,1.413,0,0,0-1.412,1.412v2.548A1.413,1.413,0,0,0,215.762,119.073Zm.224-3.735h2.862v2.1h-2.862Z" transform="translate(-190.97 -103.175)" fill="#c1bfcc"/>
          <path id="Path_11" data-name="Path 11" d="M64.375,186.509h3.311A1.413,1.413,0,0,0,69.1,185.1V182.55a1.413,1.413,0,0,0-1.412-1.412H64.375a1.413,1.413,0,0,0-1.412,1.412V185.1A1.413,1.413,0,0,0,64.375,186.509Zm.224-3.735h2.862v2.1H64.6Z" transform="translate(-56.095 -163.256)" fill="#c1bfcc"/>
          <path id="Path_12" data-name="Path 12" d="M140.069,186.509h3.311a1.413,1.413,0,0,0,1.412-1.412V182.55a1.413,1.413,0,0,0-1.412-1.412h-3.311a1.413,1.413,0,0,0-1.412,1.412V185.1A1.413,1.413,0,0,0,140.069,186.509Zm.224-3.735h2.862v2.1h-2.862Z" transform="translate(-123.533 -163.256)" fill="#c1bfcc"/>
          <path id="Path_13" data-name="Path 13" d="M215.762,186.509h3.311a1.413,1.413,0,0,0,1.412-1.412V182.55a1.413,1.413,0,0,0-1.412-1.412h-3.311a1.413,1.413,0,0,0-1.412,1.412V185.1A1.413,1.413,0,0,0,215.762,186.509Zm.224-3.735h2.862v2.1h-2.862Z" transform="translate(-190.97 -163.256)" fill="#c1bfcc"/>
          <path id="Path_14" data-name="Path 14" d="M64.375,253.946h3.311a1.413,1.413,0,0,0,1.412-1.412v-2.548a1.413,1.413,0,0,0-1.412-1.412H64.375a1.413,1.413,0,0,0-1.412,1.412v2.548A1.413,1.413,0,0,0,64.375,253.946Zm.224-3.735h2.862v2.1H64.6Z" transform="translate(-56.095 -223.337)" fill="#c1bfcc"/>
          <path id="Path_15" data-name="Path 15" d="M71.862,325.052H64.534a1.572,1.572,0,0,0-1.571,1.571v2.23a1.572,1.572,0,0,0,1.571,1.571h7.328a1.572,1.572,0,0,0,1.571-1.571v-2.23A1.572,1.572,0,0,0,71.862,325.052Zm-.065,3.735H64.6v-2.1h7.2Z" transform="translate(-56.095 -291.473)" fill="#c1bfcc"/>
          <path id="Path_16" data-name="Path 16" d="M140.069,253.946h3.311a1.413,1.413,0,0,0,1.412-1.412v-2.548a1.413,1.413,0,0,0-1.412-1.412h-3.311a1.413,1.413,0,0,0-1.412,1.412v2.548A1.413,1.413,0,0,0,140.069,253.946Zm.224-3.735h2.862v2.1h-2.862Z" transform="translate(-123.533 -223.337)" fill="#c1bfcc"/>
          <path id="Path_17" data-name="Path 17" d="M215.762,253.946h3.311a1.413,1.413,0,0,0,1.412-1.412v-2.548a1.413,1.413,0,0,0-1.412-1.412h-3.311a1.413,1.413,0,0,0-1.412,1.412v2.548A1.413,1.413,0,0,0,215.762,253.946Zm.224-3.735h2.862v2.1h-2.862Z" transform="translate(-190.97 -223.337)" fill="#c1bfcc"/>
          <path id="Path_18" data-name="Path 18" d="M328.7,279a1.507,1.507,0,0,0-1.5-1.5h-3.341a1.507,1.507,0,0,0-1.5,1.5v2.65a1.507,1.507,0,0,0,1.5,1.5H327.2a1.507,1.507,0,0,0,1.5-1.5Zm-1.636,2.519h-3.078v-2.387h3.078Z" transform="translate(-287.191 -249.107)" fill="#c1bfcc"/>
          <path id="Path_19" data-name="Path 19" d="M327.2,346.717h-3.341a1.507,1.507,0,0,0-1.5,1.5v2.65a1.507,1.507,0,0,0,1.5,1.5H327.2a1.507,1.507,0,0,0,1.5-1.5v-2.65A1.507,1.507,0,0,0,327.2,346.717Zm-.131,4.023h-3.078v-2.387h3.078Z" transform="translate(-287.191 -310.775)" fill="#c1bfcc"/>
          <path id="Path_20" data-name="Path 20" d="M398.462,279a1.507,1.507,0,0,0-1.5-1.5h-3.341a1.507,1.507,0,0,0-1.5,1.5v2.65a1.507,1.507,0,0,0,1.5,1.5h3.341a1.507,1.507,0,0,0,1.5-1.5Zm-1.636,2.519h-3.078v-2.387h3.078Z" transform="translate(-349.343 -249.107)" fill="#c1bfcc"/>
          <path id="Path_21" data-name="Path 21" d="M396.957,346.717h-3.341a1.507,1.507,0,0,0-1.5,1.5v2.65a1.507,1.507,0,0,0,1.5,1.5h3.341a1.507,1.507,0,0,0,1.5-1.5v-2.65A1.507,1.507,0,0,0,396.957,346.717Zm-.131,4.023h-3.078v-2.387h3.078Z" transform="translate(-349.343 -310.775)" fill="#c1bfcc"/>
        </g>
      </g>
    </g>
  </svg>

                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                                <span class='currncy-am'></span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3">{{ $sale }}</a>
                                                <div class="text-dark-75">Sales</div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Callout-->
                            </div>
                            @endif
                            <div class="col-lg-3">
                               <!--begin::Callout-->
                                <div class="card card-custom mb-8 mb-lg-0">
                                    <div class="card-body icon-dashbo typo-2">
                                        <div class="align-items-center">
                                            <!--begin::Icon-->
                                            <div class="mr-6 icon-container">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="57.206" height="52.448" viewBox="0 0 57.206 52.448">
                                                    <g id="house" transform="translate(0.1 -21.209)">
                                                    <g id="Group_5" data-name="Group 5" transform="translate(0 21.461)">
                                                        <path id="Path_22" data-name="Path 22" d="M56.257,54.387a3.515,3.515,0,0,0-4.854-.939L44.146,58.3l-.021-15.116,2.521,2.362a2.87,2.87,0,0,0,1.969.778h0a2.892,2.892,0,0,0,2.1-.911,2.881,2.881,0,0,0-.133-4.072l-4.779-4.477a.812.812,0,0,0-1.11,1.185l4.779,4.477a1.258,1.258,0,0,1-.858,2.175h0a1.252,1.252,0,0,1-.859-.34h0L28.778,26.587a.812.812,0,0,0-1.111,0L8.738,44.42a1.258,1.258,0,0,1-1.725-1.831L27.357,23.425a1.26,1.26,0,0,1,1.722,0l11.9,11.149a.812.812,0,1,0,1.11-1.185l-11.9-11.149a2.886,2.886,0,0,0-3.945.005l-6.512,6.135,0-1.094a1.291,1.291,0,0,0-1.291-1.289h0L13.778,26a1.291,1.291,0,0,0-1.289,1.293l.013,7.895L5.9,41.407A2.881,2.881,0,0,0,7.79,46.384h.088A2.86,2.86,0,0,0,9.851,45.6l2.515-2.37.01,7.14a17.1,17.1,0,0,0-2.464-.181H8.523V49.7A2.966,2.966,0,0,0,5.56,46.741h-2.6A2.966,2.966,0,0,0,0,49.7V62.423a.812.812,0,0,0,1.623,0V49.7a1.341,1.341,0,0,1,1.34-1.34h2.6A1.341,1.341,0,0,1,6.9,49.7v19.22a1.341,1.341,0,0,1-1.34,1.34h-2.6a1.341,1.341,0,0,1-1.34-1.34V67.5A.812.812,0,1,0,0,67.5v1.42a2.966,2.966,0,0,0,2.963,2.963h2.6a2.966,2.966,0,0,0,2.963-2.963v-.11l11.886,4.5q.033.012.067.022a5.669,5.669,0,0,0,1.543.219,5.253,5.253,0,0,0,.821-.064l17.467-2.518.012,0a8.551,8.551,0,0,0,4.051-1.815l.03-.026L55.686,58.982A3.515,3.515,0,0,0,56.257,54.387ZM18.107,27.618l0,2.287-3.988,3.757-.01-6.038Zm10.118.675L42.5,41.666l.025,17.724-2.3,1.538-2.433-.136-.064-.646A5.14,5.14,0,0,0,33.6,55.6l-.015-10.544a1.471,1.471,0,0,0-1.469-1.467h0l-7.736.011a1.469,1.469,0,0,0-1.467,1.471l.013,9.194a15.425,15.425,0,0,1-4.363-1.729q-.256-.15-.517-.29c-.068-.037-.137-.071-.2-.107-.106-.055-.211-.111-.318-.164-.085-.042-.171-.082-.257-.123s-.182-.087-.273-.128-.187-.083-.281-.123-.172-.074-.258-.11-.194-.078-.291-.116l-.259-.1q-.144-.054-.29-.1l-.274-.094-.279-.091c-.1-.031-.2-.061-.3-.091l-.259-.075c-.113-.031-.226-.061-.34-.09L14,50.687,13.988,41.7Zm3.752,27.1-6.788-.782-.64-.074-.013-9.319,7.427-.01ZM54.6,57.772,43.331,67.911a6.926,6.926,0,0,1-3.261,1.457L22.61,71.885l-.011,0-.012,0a3.87,3.87,0,0,1-1.637-.1L8.523,67.078V51.814H9.912a15.5,15.5,0,0,1,3.5.4l.127.03c.14.034.281.069.42.107l.037.01q.21.057.418.121l.075.023q.222.068.441.143l.045.016q.457.158.9.344l.049.02q.223.094.443.194l.012.006q.213.1.422.2l.049.024q.2.1.407.211l.076.041c.136.074.271.15.4.228a17.05,17.05,0,0,0,6.249,2.175l.021,0,9.094,1.047q.075.011.15.025A3.52,3.52,0,0,1,36,59.715a3.566,3.566,0,0,1,.11.591l.036.363L19.107,59.175a.812.812,0,0,0-.142,1.617l18.018,1.579h.025l3.4.191h.045c.016,0,.032,0,.048,0l.054,0c.024,0,.048-.008.072-.014s.034-.007.051-.011a.789.789,0,0,0,.076-.028c.014-.005.028-.01.041-.016a.8.8,0,0,0,.11-.061l2.884-1.93h0l8.518-5.7a1.884,1.884,0,0,1,2.3,2.975Z" transform="translate(0 -21.461)" fill="#c1bfcc" stroke="#c1bfcc" stroke-width="0.2"/>
                                                    </g>
                                                    </g>
                                                </svg>

                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                            <span class='currncy-am'></span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3" id="salesToday">{{ $rent }}</a>
                                                <div class="text-dark-75 ">Rent</div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <!--begin::Callout-->
                               <div class="card card-custom mb-8 mb-lg-0">
                                    <div class="card-body icon-dashbo">
                                        <div class="align-items-center">
                                            <!--begin::Icon-->
                                            <div class="mr-6 icon-container">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="52.096" height="52.095" viewBox="0 0 52.096 52.095">
                                                    <g id="technical-support" transform="translate(0 0)">
                                                    <path id="Path_23" data-name="Path 23" d="M9.162,40.287a4.248,4.248,0,0,0-2.052.524,24.024,24.024,0,0,1,23.72-38.3,1.018,1.018,0,0,0,.4-1.995A26.241,26.241,0,0,0,26.047,0,26.048,26.048,0,0,0,5.6,42.19a4.275,4.275,0,1,0,3.557-1.9Zm1.583,5.856A2.238,2.238,0,1,1,11.4,44.56,2.223,2.223,0,0,1,10.745,46.143Zm0,0" fill="#c1bfcc"/>
                                                    <path id="Path_24" data-name="Path 24" d="M223.879,38.693a4.265,4.265,0,1,0-1.5,1.38A24.023,24.023,0,0,1,198.7,78.383a1.018,1.018,0,0,0-.4,2,26.26,26.26,0,0,0,5.136.506,26.048,26.048,0,0,0,20.442-42.192Zm-5.139-.786a2.239,2.239,0,1,1,1.583.655A2.224,2.224,0,0,1,218.74,37.907Zm0,0" transform="translate(-177.39 -28.79)" fill="#c1bfcc"/>
                                                    <path id="Path_25" data-name="Path 25" d="M88.305,110.019a1.018,1.018,0,0,0,1.017,1.017h6.362a1.017,1.017,0,0,0,1.017-1.017v-1.973a15.934,15.934,0,0,0,3.819-1.583l1.393,1.393a1.017,1.017,0,0,0,1.439,0l4.5-4.5a1.018,1.018,0,0,0,0-1.439l-1.391-1.391a15.933,15.933,0,0,0,1.583-3.819h1.965a1.017,1.017,0,0,0,1.017-1.017V89.328a1.017,1.017,0,0,0-1.017-1.017h-1.965a15.936,15.936,0,0,0-1.582-3.818l1.384-1.384a1.018,1.018,0,0,0,0-1.44l-4.5-4.5a1.017,1.017,0,0,0-1.439,0l-1.382,1.382A15.934,15.934,0,0,0,96.7,76.972V75.017A1.017,1.017,0,0,0,95.685,74H89.323a1.018,1.018,0,0,0-1.017,1.017v1.955a15.92,15.92,0,0,0-3.818,1.582L83.1,77.172a1.018,1.018,0,0,0-1.439,0l-4.5,4.5a1.017,1.017,0,0,0,0,1.439l1.384,1.384a15.931,15.931,0,0,0-1.583,3.818H75.005a1.017,1.017,0,0,0-1.017,1.017l0,6.362A1.017,1.017,0,0,0,75,96.707h1.965a15.933,15.933,0,0,0,1.583,3.819l-1.391,1.391a1.017,1.017,0,0,0,0,1.439l4.5,4.5a1.018,1.018,0,0,0,.719.3h0a1.017,1.017,0,0,0,.719-.3l1.392-1.393a15.947,15.947,0,0,0,3.819,1.583Zm-3.42-5.7a1.018,1.018,0,0,0-1.272.135L82.375,105.7l-3.058-3.061,1.238-1.238a1.017,1.017,0,0,0,.135-1.271,13.927,13.927,0,0,1-1.927-4.651,1.018,1.018,0,0,0-.995-.8H76.019l0-4.327h1.745a1.017,1.017,0,0,0,.995-.8,13.928,13.928,0,0,1,1.927-4.651,1.017,1.017,0,0,0-.135-1.271l-1.23-1.23,3.061-3.058,1.229,1.229a1.018,1.018,0,0,0,1.272.135,13.921,13.921,0,0,1,4.651-1.927,1.018,1.018,0,0,0,.8-.995V76.035h4.327v1.737a1.017,1.017,0,0,0,.8.995,13.933,13.933,0,0,1,4.651,1.927,1.017,1.017,0,0,0,1.271-.135l1.229-1.229,3.061,3.058-1.23,1.23a1.017,1.017,0,0,0-.135,1.272,13.937,13.937,0,0,1,1.927,4.651,1.017,1.017,0,0,0,.995.8h1.748v4.327H107.24a1.018,1.018,0,0,0-.995.8,13.925,13.925,0,0,1-1.927,4.651,1.018,1.018,0,0,0,.135,1.272l1.238,1.238-3.058,3.061-1.239-1.238a1.017,1.017,0,0,0-1.272-.135,13.937,13.937,0,0,1-4.651,1.927,1.017,1.017,0,0,0-.8.995V109H90.34v-1.756a1.018,1.018,0,0,0-.8-.995,13.928,13.928,0,0,1-4.651-1.927Zm0,0" transform="translate(-66.457 -66.471)" fill="#c1bfcc"/>
                                                    <path id="Path_26" data-name="Path 26" d="M190.186,181.778a8.407,8.407,0,1,0-8.407,8.407A8.417,8.417,0,0,0,190.186,181.778Zm-14.78,0a6.372,6.372,0,1,1,6.372,6.372A6.379,6.379,0,0,1,175.406,181.778Zm0,0" transform="translate(-155.731 -155.731)" fill="#c1bfcc"/>
                                                    <path id="Path_27" data-name="Path 27" d="M339.1,19.845a1.018,1.018,0,1,0-.719-.3A1.025,1.025,0,0,0,339.1,19.845Zm0,0" transform="translate(-303.679 -15.997)" fill="#c1bfcc"/>
                                                    <path id="Path_28" data-name="Path 28" d="M155.376,474.359a1.018,1.018,0,1,0,.719.3A1.025,1.025,0,0,0,155.376,474.359Zm0,0" transform="translate(-138.654 -426.094)" fill="#c1bfcc"/>
                                                    </g>
                                                </svg>

                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                            <span class='currncy-am'></span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3" id="salesMonth">{{ $off_plans }}</a>
                                                <div class="text-dark-75 ">Off Plan</div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                    </div>
                                </div>
                              <!--end::Callout-->
                            </div>
                            <div class="col-lg-3">
                                <!--begin::Callout-->
                                  <div class="card card-custom mb-8 mb-lg-0">
                                    <div class="card-body icon-dashbo typo-2">
                                        <div class="align-items-center">
                                            <!--begin::Icon-->
                                        <div class="mr-6 icon-container">

                                            <svg id="analytics" xmlns="http://www.w3.org/2000/svg" width="52.095" height="52.095" viewBox="0 0 52.095 52.095">
                                            <g id="Group_7" data-name="Group 7" transform="translate(0 49.925)">
                                                <g id="Group_6" data-name="Group 6">
                                                <path id="Path_29" data-name="Path 29" d="M51.01,490.667H1.085a1.085,1.085,0,1,0,0,2.171H51.01a1.085,1.085,0,1,0,0-2.171Z" transform="translate(0 -490.667)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_9" data-name="Group 9" transform="translate(2.171 36.901)">
                                                <g id="Group_8" data-name="Group 8">
                                                <path id="Path_30" data-name="Path 30" d="M28.93,362.667H22.418a1.086,1.086,0,0,0-1.085,1.085v13.024a1.086,1.086,0,0,0,1.085,1.085H28.93a1.086,1.086,0,0,0,1.085-1.085V363.752A1.086,1.086,0,0,0,28.93,362.667Zm-1.085,13.024H23.5V364.838h4.341v10.853Z" transform="translate(-21.333 -362.667)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_11" data-name="Group 11" transform="translate(15.194 26.048)">
                                                <g id="Group_10" data-name="Group 10">
                                                <path id="Path_31" data-name="Path 31" d="M156.93,256h-6.512a1.086,1.086,0,0,0-1.085,1.085v23.877a1.086,1.086,0,0,0,1.085,1.085h6.512a1.086,1.086,0,0,0,1.085-1.085V257.085A1.086,1.086,0,0,0,156.93,256Zm-1.085,23.877H151.5V258.171h4.341v21.706Z" transform="translate(-149.333 -256)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_13" data-name="Group 13" transform="translate(28.218 30.389)">
                                                <g id="Group_12" data-name="Group 12">
                                                <path id="Path_32" data-name="Path 32" d="M284.93,298.667h-6.512a1.086,1.086,0,0,0-1.085,1.085v19.536a1.086,1.086,0,0,0,1.085,1.085h6.512a1.086,1.086,0,0,0,1.085-1.085V299.752A1.086,1.086,0,0,0,284.93,298.667ZM283.845,318.2H279.5V300.838h4.341Z" transform="translate(-277.333 -298.667)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_15" data-name="Group 15" transform="translate(41.242 17.365)">
                                                <g id="Group_14" data-name="Group 14">
                                                <path id="Path_33" data-name="Path 33" d="M412.93,170.667h-6.512a1.086,1.086,0,0,0-1.085,1.085v32.559a1.086,1.086,0,0,0,1.085,1.085h6.512a1.086,1.086,0,0,0,1.085-1.085V171.752A1.086,1.086,0,0,0,412.93,170.667Zm-1.085,32.559H407.5V172.838h4.341Z" transform="translate(-405.333 -170.667)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_17" data-name="Group 17" transform="translate(2.171 19.536)">
                                                <g id="Group_16" data-name="Group 16">
                                                <path id="Path_34" data-name="Path 34" d="M25.674,192a4.341,4.341,0,1,0,4.341,4.341A4.346,4.346,0,0,0,25.674,192Zm0,6.512a2.171,2.171,0,1,1,2.171-2.171A2.173,2.173,0,0,1,25.674,198.512Z" transform="translate(-21.333 -192)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_19" data-name="Group 19" transform="translate(15.194 8.682)">
                                                <g id="Group_18" data-name="Group 18">
                                                <path id="Path_35" data-name="Path 35" d="M153.674,85.333a4.341,4.341,0,1,0,4.341,4.341A4.346,4.346,0,0,0,153.674,85.333Zm0,6.512a2.171,2.171,0,1,1,2.171-2.171A2.173,2.173,0,0,1,153.674,91.845Z" transform="translate(-149.333 -85.333)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_21" data-name="Group 21" transform="translate(28.218 13.024)">
                                                <g id="Group_20" data-name="Group 20">
                                                <path id="Path_36" data-name="Path 36" d="M281.674,128a4.341,4.341,0,1,0,4.341,4.341A4.346,4.346,0,0,0,281.674,128Zm0,6.512a2.171,2.171,0,1,1,2.171-2.171A2.173,2.173,0,0,1,281.674,134.512Z" transform="translate(-277.333 -128)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_23" data-name="Group 23" transform="translate(41.242)">
                                                <g id="Group_22" data-name="Group 22">
                                                <path id="Path_37" data-name="Path 37" d="M409.674,0a4.341,4.341,0,1,0,4.341,4.341A4.346,4.346,0,0,0,409.674,0Zm0,6.512a2.171,2.171,0,1,1,2.171-2.171A2.173,2.173,0,0,1,409.674,6.512Z" transform="translate(-405.333)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_25" data-name="Group 25" transform="translate(33.777 5.556)">
                                                <g id="Group_24" data-name="Group 24">
                                                <path id="Path_38" data-name="Path 38" d="M342.237,54.925a1.086,1.086,0,0,0-1.535,0l-8.422,8.422a1.085,1.085,0,0,0,1.535,1.535l8.422-8.422A1.086,1.086,0,0,0,342.237,54.925Z" transform="translate(-331.963 -54.608)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_27" data-name="Group 27" transform="translate(21.582 12.828)">
                                                <g id="Group_26" data-name="Group 26">
                                                <path id="Path_39" data-name="Path 39" d="M220.462,128.11l-6.972-1.988a1.086,1.086,0,0,0-.595,2.088l6.972,1.988a1.086,1.086,0,0,0,.595-2.088Z" transform="translate(-212.108 -126.078)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            <g id="Group_29" data-name="Group 29" transform="translate(7.726 13.967)">
                                                <g id="Group_28" data-name="Group 28">
                                                <path id="Path_40" data-name="Path 40" d="M86.051,137.682a1.086,1.086,0,0,0-1.524-.174l-8.183,6.525a1.085,1.085,0,0,0,.677,1.934,1.1,1.1,0,0,0,.675-.234l8.183-6.525A1.084,1.084,0,0,0,86.051,137.682Z" transform="translate(-75.935 -137.273)" fill="#c1bfcc"/>
                                                </g>
                                            </g>
                                            </svg>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                            <span class='currncy-am'></span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3">{{ $new_leads  }}</a>
                                                <div class="text-dark-75">Leads</div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Callout-->
                            </div>
                        </div>
                        <!--end::Row-->

                        <!--- New Row On Dashboard -->
                        {{-- <div class="row mb-4 mr-2 addjustpad">
                            @if(Auth::user()->user_role ==1)
                                    <div class="col-lg-3">
                                      <!--begin::Callout-->
                                        <div class="card card-custom mb-8 mb-lg-0"  style="background-color: #05c7b8">
                                            <div class="card-body icon-dashbo">
                                                <div class="align-items-center">
                                                    <!--end::Icon-->
                                                    <!--begin::Content-->
                                                    <div class="icon-content">
                                                        <span class='currncy-am'></span>
                                                        <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-6">{{ $total_companies }}</a>
                                                        <div class="text-dark-75">Signature</div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Callout-->
                                    </div>
                                    @endif
                                </div> --}}
                        @endif
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            @if (auth()->user()->role_id == 1)
                   <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="example-preview">
                        <ul class="nav nav-pills" id="myTab1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab-1" data-toggle="tab" href="#home-1">
                                    <span class="nav-icon">
                                        <i class="flaticon2-chat-1"></i>
                                    </span>
                                    <span class="nav-text">Properties</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mt-5" id="myTabContent1">
                            <div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab-1">
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 my-2 my-md-0">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                                                <!--begin::Button-->
                                                <h3 class="mr-3"><b>Latest Properties For Approval</b></h3>
                                                <!--end::Button-->

                                        </div>
                                    </div>
                                </div>
                                <!--end::Search Form-->
                                    <table id="users-table" class="table">
                                        <thead>
                                            <tr>
                                                <th width="5%">Id</th>
                                                <th>Title</th>
                                                <th>Expiry Data</th>
                                                <th>Cities</th>
                                                <th>Verify</th>
                                                <th>Feature</th>
                                                <th>Boost</th>
                                                <th>Status</th>
                                                <th class="text-center" width="10%">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                            </div>
                            <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 my-2 my-md-0">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                                                <!--begin::Button-->
                                                <h3 class="mr-3"><b>Latest Services For Approval</b></h3>
                                                <!--end::Button-->

                                        </div>
                                    </div>
                                </div>
                                <!--end::Search Form-->
                                <table id="services-table" class="table">
                                    <thead>
                                        <tr>
                                            <th width="5%">Id</th>
                                            <th>Company</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Daily Price</th>
                                            <th>Hourly Price</th>
                                            <th>Status</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                </table>

                            <!--end: Datatable-->
                            </div>
                            <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab-1">Tab content 3</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
      @elseif (auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                   <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                            <!--begin::Search Form-->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 my-2 my-md-0">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                                            <!--begin::Button-->
                                            <h3 class="mr-3"><b>Your Properties</b></h3>
                                            <!--end::Button-->

                                    </div>
                                </div>
                            </div>
                            <!--end::Search Form-->
                            <!--begin: Datatable-->
                            <div>
                                <table id="users-table" class="table">
                                    <thead>
                                        <tr>
                                            <th width="5%">Id</th>
                                            <th>Title</th>
                                            <th>Expiry Data</th>
                                            <th>Cities</th>
                                            <th>Status</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--end: Datatable-->

                    <!--end::Card-->

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
            @elseif(auth()->user()->role_id == 5)
            <div class="row mb-4 mr-2 addjustpad">


                <div class="col-lg-6">
                    <!--begin::Callout-->
                   <div class="card card-custom mb-8 mb-lg-0">
                        <div class="card-body icon-dashbo">
                            <div class="align-items-center">
                                <!--begin::Icon-->
                                <div class="mr-6 icon-container">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="52.096" height="52.095" viewBox="0 0 52.096 52.095">
                                        <g id="technical-support" transform="translate(0 0)">
                                        <path id="Path_23" data-name="Path 23" d="M9.162,40.287a4.248,4.248,0,0,0-2.052.524,24.024,24.024,0,0,1,23.72-38.3,1.018,1.018,0,0,0,.4-1.995A26.241,26.241,0,0,0,26.047,0,26.048,26.048,0,0,0,5.6,42.19a4.275,4.275,0,1,0,3.557-1.9Zm1.583,5.856A2.238,2.238,0,1,1,11.4,44.56,2.223,2.223,0,0,1,10.745,46.143Zm0,0" fill="#c1bfcc"/>
                                        <path id="Path_24" data-name="Path 24" d="M223.879,38.693a4.265,4.265,0,1,0-1.5,1.38A24.023,24.023,0,0,1,198.7,78.383a1.018,1.018,0,0,0-.4,2,26.26,26.26,0,0,0,5.136.506,26.048,26.048,0,0,0,20.442-42.192Zm-5.139-.786a2.239,2.239,0,1,1,1.583.655A2.224,2.224,0,0,1,218.74,37.907Zm0,0" transform="translate(-177.39 -28.79)" fill="#c1bfcc"/>
                                        <path id="Path_25" data-name="Path 25" d="M88.305,110.019a1.018,1.018,0,0,0,1.017,1.017h6.362a1.017,1.017,0,0,0,1.017-1.017v-1.973a15.934,15.934,0,0,0,3.819-1.583l1.393,1.393a1.017,1.017,0,0,0,1.439,0l4.5-4.5a1.018,1.018,0,0,0,0-1.439l-1.391-1.391a15.933,15.933,0,0,0,1.583-3.819h1.965a1.017,1.017,0,0,0,1.017-1.017V89.328a1.017,1.017,0,0,0-1.017-1.017h-1.965a15.936,15.936,0,0,0-1.582-3.818l1.384-1.384a1.018,1.018,0,0,0,0-1.44l-4.5-4.5a1.017,1.017,0,0,0-1.439,0l-1.382,1.382A15.934,15.934,0,0,0,96.7,76.972V75.017A1.017,1.017,0,0,0,95.685,74H89.323a1.018,1.018,0,0,0-1.017,1.017v1.955a15.92,15.92,0,0,0-3.818,1.582L83.1,77.172a1.018,1.018,0,0,0-1.439,0l-4.5,4.5a1.017,1.017,0,0,0,0,1.439l1.384,1.384a15.931,15.931,0,0,0-1.583,3.818H75.005a1.017,1.017,0,0,0-1.017,1.017l0,6.362A1.017,1.017,0,0,0,75,96.707h1.965a15.933,15.933,0,0,0,1.583,3.819l-1.391,1.391a1.017,1.017,0,0,0,0,1.439l4.5,4.5a1.018,1.018,0,0,0,.719.3h0a1.017,1.017,0,0,0,.719-.3l1.392-1.393a15.947,15.947,0,0,0,3.819,1.583Zm-3.42-5.7a1.018,1.018,0,0,0-1.272.135L82.375,105.7l-3.058-3.061,1.238-1.238a1.017,1.017,0,0,0,.135-1.271,13.927,13.927,0,0,1-1.927-4.651,1.018,1.018,0,0,0-.995-.8H76.019l0-4.327h1.745a1.017,1.017,0,0,0,.995-.8,13.928,13.928,0,0,1,1.927-4.651,1.017,1.017,0,0,0-.135-1.271l-1.23-1.23,3.061-3.058,1.229,1.229a1.018,1.018,0,0,0,1.272.135,13.921,13.921,0,0,1,4.651-1.927,1.018,1.018,0,0,0,.8-.995V76.035h4.327v1.737a1.017,1.017,0,0,0,.8.995,13.933,13.933,0,0,1,4.651,1.927,1.017,1.017,0,0,0,1.271-.135l1.229-1.229,3.061,3.058-1.23,1.23a1.017,1.017,0,0,0-.135,1.272,13.937,13.937,0,0,1,1.927,4.651,1.017,1.017,0,0,0,.995.8h1.748v4.327H107.24a1.018,1.018,0,0,0-.995.8,13.925,13.925,0,0,1-1.927,4.651,1.018,1.018,0,0,0,.135,1.272l1.238,1.238-3.058,3.061-1.239-1.238a1.017,1.017,0,0,0-1.272-.135,13.937,13.937,0,0,1-4.651,1.927,1.017,1.017,0,0,0-.8.995V109H90.34v-1.756a1.018,1.018,0,0,0-.8-.995,13.928,13.928,0,0,1-4.651-1.927Zm0,0" transform="translate(-66.457 -66.471)" fill="#c1bfcc"/>
                                        <path id="Path_26" data-name="Path 26" d="M190.186,181.778a8.407,8.407,0,1,0-8.407,8.407A8.417,8.417,0,0,0,190.186,181.778Zm-14.78,0a6.372,6.372,0,1,1,6.372,6.372A6.379,6.379,0,0,1,175.406,181.778Zm0,0" transform="translate(-155.731 -155.731)" fill="#c1bfcc"/>
                                        <path id="Path_27" data-name="Path 27" d="M339.1,19.845a1.018,1.018,0,1,0-.719-.3A1.025,1.025,0,0,0,339.1,19.845Zm0,0" transform="translate(-303.679 -15.997)" fill="#c1bfcc"/>
                                        <path id="Path_28" data-name="Path 28" d="M155.376,474.359a1.018,1.018,0,1,0,.719.3A1.025,1.025,0,0,0,155.376,474.359Zm0,0" transform="translate(-138.654 -426.094)" fill="#c1bfcc"/>
                                        </g>
                                    </svg>

                                </div>
                                <!--end::Icon-->
                                <!--begin::Content-->
                                <div class="icon-content">
                                <span class='currncy-am'></span>
                                    <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3" id="salesMonth">{{ $total_services }}</a>
                                    <div class="text-dark-75 ">Total Services</div>
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>
                    </div>
                  <!--end::Callout-->
                </div>
                <div class="col-lg-6">
                    <!--begin::Callout-->
                      <div class="card card-custom mb-8 mb-lg-0">
                        <div class="card-body icon-dashbo typo-2">
                            <div class="align-items-center">
                                <!--begin::Icon-->
                                <div class="mr-6 icon-container">

<svg id="analytics" xmlns="http://www.w3.org/2000/svg" width="52.095" height="52.095" viewBox="0 0 52.095 52.095">
<g id="Group_7" data-name="Group 7" transform="translate(0 49.925)">
<g id="Group_6" data-name="Group 6">
<path id="Path_29" data-name="Path 29" d="M51.01,490.667H1.085a1.085,1.085,0,1,0,0,2.171H51.01a1.085,1.085,0,1,0,0-2.171Z" transform="translate(0 -490.667)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_9" data-name="Group 9" transform="translate(2.171 36.901)">
<g id="Group_8" data-name="Group 8">
<path id="Path_30" data-name="Path 30" d="M28.93,362.667H22.418a1.086,1.086,0,0,0-1.085,1.085v13.024a1.086,1.086,0,0,0,1.085,1.085H28.93a1.086,1.086,0,0,0,1.085-1.085V363.752A1.086,1.086,0,0,0,28.93,362.667Zm-1.085,13.024H23.5V364.838h4.341v10.853Z" transform="translate(-21.333 -362.667)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_11" data-name="Group 11" transform="translate(15.194 26.048)">
<g id="Group_10" data-name="Group 10">
<path id="Path_31" data-name="Path 31" d="M156.93,256h-6.512a1.086,1.086,0,0,0-1.085,1.085v23.877a1.086,1.086,0,0,0,1.085,1.085h6.512a1.086,1.086,0,0,0,1.085-1.085V257.085A1.086,1.086,0,0,0,156.93,256Zm-1.085,23.877H151.5V258.171h4.341v21.706Z" transform="translate(-149.333 -256)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_13" data-name="Group 13" transform="translate(28.218 30.389)">
<g id="Group_12" data-name="Group 12">
<path id="Path_32" data-name="Path 32" d="M284.93,298.667h-6.512a1.086,1.086,0,0,0-1.085,1.085v19.536a1.086,1.086,0,0,0,1.085,1.085h6.512a1.086,1.086,0,0,0,1.085-1.085V299.752A1.086,1.086,0,0,0,284.93,298.667ZM283.845,318.2H279.5V300.838h4.341Z" transform="translate(-277.333 -298.667)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_15" data-name="Group 15" transform="translate(41.242 17.365)">
<g id="Group_14" data-name="Group 14">
<path id="Path_33" data-name="Path 33" d="M412.93,170.667h-6.512a1.086,1.086,0,0,0-1.085,1.085v32.559a1.086,1.086,0,0,0,1.085,1.085h6.512a1.086,1.086,0,0,0,1.085-1.085V171.752A1.086,1.086,0,0,0,412.93,170.667Zm-1.085,32.559H407.5V172.838h4.341Z" transform="translate(-405.333 -170.667)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_17" data-name="Group 17" transform="translate(2.171 19.536)">
<g id="Group_16" data-name="Group 16">
<path id="Path_34" data-name="Path 34" d="M25.674,192a4.341,4.341,0,1,0,4.341,4.341A4.346,4.346,0,0,0,25.674,192Zm0,6.512a2.171,2.171,0,1,1,2.171-2.171A2.173,2.173,0,0,1,25.674,198.512Z" transform="translate(-21.333 -192)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_19" data-name="Group 19" transform="translate(15.194 8.682)">
<g id="Group_18" data-name="Group 18">
<path id="Path_35" data-name="Path 35" d="M153.674,85.333a4.341,4.341,0,1,0,4.341,4.341A4.346,4.346,0,0,0,153.674,85.333Zm0,6.512a2.171,2.171,0,1,1,2.171-2.171A2.173,2.173,0,0,1,153.674,91.845Z" transform="translate(-149.333 -85.333)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_21" data-name="Group 21" transform="translate(28.218 13.024)">
<g id="Group_20" data-name="Group 20">
<path id="Path_36" data-name="Path 36" d="M281.674,128a4.341,4.341,0,1,0,4.341,4.341A4.346,4.346,0,0,0,281.674,128Zm0,6.512a2.171,2.171,0,1,1,2.171-2.171A2.173,2.173,0,0,1,281.674,134.512Z" transform="translate(-277.333 -128)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_23" data-name="Group 23" transform="translate(41.242)">
<g id="Group_22" data-name="Group 22">
<path id="Path_37" data-name="Path 37" d="M409.674,0a4.341,4.341,0,1,0,4.341,4.341A4.346,4.346,0,0,0,409.674,0Zm0,6.512a2.171,2.171,0,1,1,2.171-2.171A2.173,2.173,0,0,1,409.674,6.512Z" transform="translate(-405.333)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_25" data-name="Group 25" transform="translate(33.777 5.556)">
<g id="Group_24" data-name="Group 24">
<path id="Path_38" data-name="Path 38" d="M342.237,54.925a1.086,1.086,0,0,0-1.535,0l-8.422,8.422a1.085,1.085,0,0,0,1.535,1.535l8.422-8.422A1.086,1.086,0,0,0,342.237,54.925Z" transform="translate(-331.963 -54.608)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_27" data-name="Group 27" transform="translate(21.582 12.828)">
<g id="Group_26" data-name="Group 26">
<path id="Path_39" data-name="Path 39" d="M220.462,128.11l-6.972-1.988a1.086,1.086,0,0,0-.595,2.088l6.972,1.988a1.086,1.086,0,0,0,.595-2.088Z" transform="translate(-212.108 -126.078)" fill="#c1bfcc"/>
</g>
</g>
<g id="Group_29" data-name="Group 29" transform="translate(7.726 13.967)">
<g id="Group_28" data-name="Group 28">
<path id="Path_40" data-name="Path 40" d="M86.051,137.682a1.086,1.086,0,0,0-1.524-.174l-8.183,6.525a1.085,1.085,0,0,0,.677,1.934,1.1,1.1,0,0,0,.675-.234l8.183-6.525A1.084,1.084,0,0,0,86.051,137.682Z" transform="translate(-75.935 -137.273)" fill="#c1bfcc"/>
</g>
</g>
</svg>

                                </div>
                                <!--end::Icon-->
                                <!--begin::Content-->
                                <div class="icon-content">
                                <span class='currncy-am'></span>
                                    <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3">{{ $total_lead }}</a>
                                    <div class="text-dark-75">Leads</div>
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>
                    </div>
                    <!--end::Callout-->
                </div>
            </div>
            <!--end::Row-->
             <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                            <!--begin::Search Form-->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 my-2 my-md-0">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                                            <!--begin::Button-->
                                            <h3 class="mr-3"><b>Your Services</b></h3>
                                            <!--end::Button-->

                                    </div>
                                </div>
                            </div>
                            <!--end::Search Form-->
                            <!--begin: Datatable-->
                            <div>
                                <table id="services-table" class="table">
                                    <thead>
                                        <tr>
                                            <th width="5%">Id</th>
                                            <th>Company</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Daily Price</th>
                                            <th>Hourly Price</th>
                                            <th>Status</th>
                                            <th>Live Status</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--end: Datatable-->

                    <!--end::Card-->

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
            @endif
        </div>

@include('admin.dashboard.js.index')
@endsection
