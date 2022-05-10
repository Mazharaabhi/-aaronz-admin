@extends('layouts.master')
@section('title', "Dashboard")
@section('first', "Dashboard")
@section('class_second', "d-none")
@section('class_third', "d-none")
@section('class_fourth', "d-none")
@section('content')
<br>
<div class="container-fluid">
    <ul class="nav nav-success nav-pills" id="myTab2" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab-2" data-toggle="tab" href="#home-2">
                <span class="nav-icon">
                    <i class="fa fa-money"></i>
                </span>
                <span class="nav-text">My Company</span>
            </a>
        </li>
        @if (CheckUseRole() == 1 || CheckUseRole() == 2 || CheckUseRole() == 3)
        <li class="nav-item">
            <a class="nav-link" id="profile-tab-2" data-toggle="tab" href="#profile-2" aria-controls="profile">
                <span class="nav-icon">
                    <i class="fa fa-money"></i>
                </span>
                <span class="nav-text">Other Companies</span>
            </a>
        </li>
        @endif


    </ul>
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
                            <div class="col-lg-3">
                              <!--begin::Callout-->
                                <div class="card card-custom mb-8 mb-lg-0">
                                    <div class="card-body icon-dashbo">
                                        <div class="align-items-center">
                                         <!--begin::Icon-->
                                            <div class="mr-6 icon-container">
                                                <span class="svg-icon svg-icon-cherwell svg-icon-4x">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
                                                    <svg id="Group_9804" data-name="Group 9804" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
  <path id="Path_52" data-name="Path 52" d="M34.1,16.2H32.9V6.6a.6.6,0,0,0-.6-.6H28.666l-1.193-3.78a.6.6,0,0,0-.786-.38L21.8,3.7,19.605.278a.6.6,0,0,0-.38-.263A.586.586,0,0,0,18.771.1L9.763,6H4.7A4.2,4.2,0,0,0,.5,10.2V31.8A4.205,4.205,0,0,0,4.7,36H32.3a.6.6,0,0,0,.6-.6V28.2h1.2a2.4,2.4,0,0,0,2.4-2.4V18.6A2.4,2.4,0,0,0,34.1,16.2Zm0,1.2a1.2,1.2,0,1,1,0,2.4H32.9V17.4ZM31.7,7.2v6h-.76l-1.895-6Zm-2.018,6H27.933l-1.663-4.99A.6.6,0,0,0,25.7,7.8a2.281,2.281,0,0,1-1.624-.672l-.352-.352a.6.6,0,0,0-.632-.139L5.34,13.2H4.7a2.991,2.991,0,0,1-2.129-.89L26.52,3.191Zm-3.014,0H8.8L23.148,7.9l.079.08a3.468,3.468,0,0,0,2.031,1ZM18.92,1.436l1.732,2.705L6.658,9.47ZM4.7,7.2H7.931L1.875,11.169A2.96,2.96,0,0,1,1.7,10.2,3,3,0,0,1,4.7,7.2Zm27,27.6H4.7a3,3,0,0,1-3-3V13.141l.017.016c.047.047.1.09.145.134s.1.1.154.14.105.08.158.12.109.085.167.125.113.07.17.1.117.074.18.108.123.06.185.091.12.06.184.089.136.051.2.076.12.048.183.067.153.041.231.06c.06.014.115.033.174.045.088.018.18.029.27.042.05.007.1.017.15.023.142.014.285.021.429.021h.78l.009.023.064-.023H31.7v5.4H25.1a4.2,4.2,0,1,0,0,8.4h6.6Zm3.6-9A1.2,1.2,0,0,1,34.1,27h-9a3,3,0,0,1,0-6h9a2.382,2.382,0,0,0,.431-.044c.034-.006.068-.013.1-.021a2.4,2.4,0,0,0,.4-.123l.02-.01a2.38,2.38,0,0,0,.25-.125Zm0,0" transform="translate(-0.5 0)" fill="red"/>
  <path id="Path_53" data-name="Path 53" d="M336.656,420.766H339.1v1.222h-2.444Zm0,0" transform="translate(-321.89 -404.576)" fill="red"/>
  <path id="Path_54" data-name="Path 54" d="M212,420.766h2.444v1.222H212Zm0,0" transform="translate(-202.027 -404.576)" fill="red"/>
  <path id="Path_55" data-name="Path 55" d="M710.648,420.766h2.094v1.222h-2.094Zm0,0" transform="translate(-681.519 -404.576)" fill="red"/>
  <path id="Path_56" data-name="Path 56" d="M585.988,420.766h2.444v1.222h-2.444Zm0,0" transform="translate(-561.634 -404.576)" fill="red"/>
  <path id="Path_57" data-name="Path 57" d="M84.184,418.582l-.286,1.185a4.352,4.352,0,0,0,1.007.122h1.572v-1.222H84.905A3.146,3.146,0,0,1,84.184,418.582Zm0,0" transform="translate(-78.779 -402.477)" fill="red"/>
  <path id="Path_58" data-name="Path 58" d="M461.32,420.766h2.444v1.222H461.32Zm0,0" transform="translate(-441.76 -404.576)" fill="red"/>
  <path id="Path_59" data-name="Path 59" d="M84.184,823.734l-.286,1.185a4.339,4.339,0,0,0,1.007.122h1.572V823.82H84.905A3.121,3.121,0,0,1,84.184,823.734Zm0,0" transform="translate(-78.779 -792.097)" fill="red"/>
  <path id="Path_60" data-name="Path 60" d="M710.648,825.918h2.094v1.222h-2.094Zm0,0" transform="translate(-681.519 -794.196)" fill="red"/>
  <path id="Path_61" data-name="Path 61" d="M336.656,825.918H339.1v1.222h-2.444Zm0,0" transform="translate(-321.89 -794.196)" fill="red"/>
  <path id="Path_62" data-name="Path 62" d="M585.988,825.918h2.444v1.222h-2.444Zm0,0" transform="translate(-561.634 -794.196)" fill="red"/>
  <path id="Path_63" data-name="Path 63" d="M212,825.918h2.444v1.222H212Zm0,0" transform="translate(-202.027 -794.196)" fill="red"/>
  <path id="Path_64" data-name="Path 64" d="M461.32,825.918h2.444v1.222H461.32Zm0,0" transform="translate(-441.76 -794.196)" fill="red"/>
  <path id="Path_65" data-name="Path 65" d="M594.481,576.594a1.833,1.833,0,1,0,1.833,1.833A1.833,1.833,0,0,0,594.481,576.594Zm0,2.444a.611.611,0,1,1,.611-.611A.611.611,0,0,1,594.481,579.038Zm0,0" transform="translate(-568.055 -554.439)" fill="red"/>
</svg>

                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                                <span class='currncy-am'>AED</span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3">{{ $all }}</a>
                                                <div class="text-dark-75">Transactions Today</div>
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
                                                <span class="svg-icon svg-icon-cherwell svg-icon-4x">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
                                                    <svg id="money_1_" data-name="money (1)" xmlns="http://www.w3.org/2000/svg" width="36.427" height="36" viewBox="0 0 36.427 36">
  <g id="Group_7260" data-name="Group 7260" transform="translate(21.341 18.014)">
    <g id="Group_7259" data-name="Group 7259">
      <path id="Path_82" data-name="Path 82" d="M302.942,261.335a1.369,1.369,0,1,1,1.565-1.355.711.711,0,1,0,1.423,0,2.831,2.831,0,0,0-2.277-2.7v-.37a.711.711,0,0,0-1.423,0v.37a2.831,2.831,0,0,0-2.277,2.7,2.892,2.892,0,0,0,2.988,2.778,1.369,1.369,0,1,1-1.565,1.355.711.711,0,0,0-1.423,0,2.831,2.831,0,0,0,2.277,2.7v.307a.711.711,0,1,0,1.423,0v-.307a2.831,2.831,0,0,0,2.277-2.7A2.892,2.892,0,0,0,302.942,261.335Z" transform="translate(-299.954 -256.201)" fill="red"/>
    </g>
  </g>
  <g id="Group_7262" data-name="Group 7262" transform="translate(27.315 15.495)">
    <g id="Group_7261" data-name="Group 7261" transform="translate(0 0)">
      <path id="Path_83" data-name="Path 83" d="M388.731,224.206a9.27,9.27,0,0,0-3.787-3.351.711.711,0,1,0-.617,1.282,7.833,7.833,0,0,1,3.528,10.728.711.711,0,1,0,1.256.668,9.26,9.26,0,0,0-.381-9.328Z" transform="translate(-383.924 -220.785)" fill="red"/>
    </g>
  </g>
  <g id="Group_7264" data-name="Group 7264" transform="translate(24.688 14.656)">
    <g id="Group_7263" data-name="Group 7263">
      <path id="Path_84" data-name="Path 84" d="M347.759,209h-.048a.711.711,0,1,0,0,1.423h.045a.711.711,0,0,0,0-1.423Z" transform="translate(-347 -209.001)" fill="red"/>
    </g>
  </g>
  <g id="Group_7266" data-name="Group 7266" transform="translate(15.083 19.189)">
    <g id="Group_7265" data-name="Group 7265">
      <path id="Path_85" data-name="Path 85" d="M217.865,284.485a7.833,7.833,0,0,1-3.528-10.728.711.711,0,1,0-1.256-.668,9.253,9.253,0,0,0,4.167,12.679.711.711,0,1,0,.616-1.282Z" transform="translate(-212.002 -272.711)" fill="red"/>
    </g>
  </g>
  <g id="Group_7268" data-name="Group 7268" transform="translate(22.509 31.731)">
    <g id="Group_7267" data-name="Group 7267">
      <path id="Path_86" data-name="Path 86" d="M317.134,449h-.041a.711.711,0,0,0-.006,1.423h.048a.711.711,0,1,0,0-1.423Z" transform="translate(-316.378 -448.999)" fill="red"/>
    </g>
  </g>
  <g id="Group_7270" data-name="Group 7270" transform="translate(0 0)">
    <g id="Group_7269" data-name="Group 7269">
      <path id="Path_87" data-name="Path 87" d="M27.563,15.249a3.266,3.266,0,0,0-.316-.581H29.1a3.273,3.273,0,1,0,0-6.545H23.4A3.271,3.271,0,0,0,20.7,3H3.273a3.273,3.273,0,1,0,0,6.545h5.7a3.264,3.264,0,0,0,0,3.7H7.115a3.271,3.271,0,0,0-2.034,5.834,3.267,3.267,0,0,0,0,5.123,3.267,3.267,0,0,0,0,5.123,3.271,3.271,0,0,0,2.034,5.834H15.5A12.092,12.092,0,1,0,27.563,15.249Zm1.536-5.7a1.85,1.85,0,0,1,0,3.7H11.668a1.85,1.85,0,0,1,0-3.7ZM3.273,8.123a1.85,1.85,0,1,1,0-3.7H20.7a1.85,1.85,0,1,1,0,3.7Zm3.842,6.545H24.545a1.849,1.849,0,0,1,.807.186c-.337-.028-.677-.043-1.021-.043a12.057,12.057,0,0,0-8.559,3.557H7.115a1.85,1.85,0,1,1,0-3.7Zm0,5.123h7.443a12.06,12.06,0,0,0-1.829,3.7H7.115a1.85,1.85,0,1,1,0-3.7Zm0,5.123H12.4a12.1,12.1,0,0,0-.044,3.7H7.115a1.85,1.85,0,1,1,0-3.7Zm0,8.822a1.85,1.85,0,1,1,0-3.7h5.534a12.047,12.047,0,0,0,1.707,3.7Zm17.217,3.842A10.672,10.672,0,1,1,35,26.905,10.684,10.684,0,0,1,24.332,37.577Z" transform="translate(0 -3)" fill="red"/>
    </g>
  </g>
</svg>

                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                            <span class='currncy-am'>AED</span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3" id="salesToday">0</a>
                                                <div class="text-dark-75 ">Sales Today</div>
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
                                                <span class="svg-icon svg-icon-cherwell svg-icon-4x">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
<svg xmlns="http://www.w3.org/2000/svg" width="35.879" height="36" viewBox="0 0 35.879 36">
  <g id="Group_9816" data-name="Group 9816" transform="translate(-978.472 -1564.688)">
    <g id="Group_7257" data-name="Group 7257" transform="translate(978.472 1564.688)">
      <path id="Path_74" data-name="Path 74" d="M.116,1.655-.242.82H-2l-.358.834h-.839l1.732-3.77h.668L.94,1.655ZM-1.723.189H-.515l-.6-1.412ZM1.255,1.655v-3.77h2.6v.647H2.068v.882H3.747V.061H2.068v.946H3.854v.647Zm3.171-3.77H5.891a2.32,2.32,0,0,1,1.059.225,1.568,1.568,0,0,1,.679.647A2.046,2.046,0,0,1,7.864-.233,2.081,2.081,0,0,1,7.631.78a1.548,1.548,0,0,1-.676.65,2.333,2.333,0,0,1-1.064.225H4.426ZM5.832.981a1.068,1.068,0,0,0,1.2-1.214,1.066,1.066,0,0,0-1.2-1.208H5.26V.981Z" transform="translate(6.324 27.158)" fill="red"/>
      <path id="XMLID_884_" d="M32.936,2.812H29.945V2.25a2.242,2.242,0,1,0-4.485,0v.562H15.789V2.25a2.242,2.242,0,1,0-4.485,0v.562H8.313A2.952,2.952,0,0,0,5.37,5.766V19.459A8.572,8.572,0,1,0,16.347,30.937H32.936a2.952,2.952,0,0,0,2.943-2.953V5.766A2.952,2.952,0,0,0,32.936,2.812ZM26.861,2.25a.841.841,0,1,1,1.682,0V4.781a.841.841,0,1,1-1.682,0Zm-14.155,0a.841.841,0,1,1,1.682,0V4.781a.841.841,0,1,1-1.682,0ZM8.313,4.219H11.3v.562a2.242,2.242,0,1,0,4.485,0V4.219H25.46v.562a2.242,2.242,0,1,0,4.485,0V4.219h2.991a1.546,1.546,0,0,1,1.542,1.547V9.984H6.771V5.766A1.546,1.546,0,0,1,8.313,4.219Zm.236,30.375A7.172,7.172,0,1,1,15.7,27.422a7.168,7.168,0,0,1-7.148,7.172Zm24.387-5.062h-16.1a8.556,8.556,0,0,0-10.066-10.5v-7.64H34.478V27.984A1.546,1.546,0,0,1,32.936,29.531Z" transform="translate(0)" fill="red"/>
      <circle id="XMLID_907_" cx="2.32" cy="2.32" r="2.32" transform="translate(25.774 13.44)" fill="red"/>
      <circle id="XMLID_908_" cx="2.32" cy="2.32" r="2.32" transform="translate(18.291 13.44)" fill="red"/>
      <circle id="XMLID_909_" cx="2.32" cy="2.32" r="2.32" transform="translate(10.621 13.44)" fill="red"/>
      <circle id="XMLID_910_" cx="2.32" cy="2.32" r="2.32" transform="translate(25.774 21.14)" fill="red"/>
      <circle id="XMLID_911_" cx="2.32" cy="2.32" r="2.32" transform="translate(18.291 21.14)" fill="red"/>
    </g>
  </g>
</svg>
            <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                            <span class='currncy-am'>AED</span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3" id="salesMonth">0</a>
                                                <div class="text-dark-75 ">Sales This Month</div>
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
                                                <span class="svg-icon svg-icon-cherwell svg-icon-4x">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="37.685" height="34.797" viewBox="0 0 37.685 34.797">
  <g id="Group_9815" data-name="Group 9815" transform="translate(-1110.537 -1567.837)">
    <g id="credit-card" transform="translate(1110.537 1567.837)">
      <g id="Group_7238" data-name="Group 7238" transform="translate(27.133 27.038)">
        <g id="Group_7237" data-name="Group 7237" transform="translate(0 0)">
          <path id="Path_75" data-name="Path 75" d="M372.391,383.572a.756.756,0,0,0-1.053.191,8.555,8.555,0,0,1-.777.962,9.218,9.218,0,0,1-.74.7.756.756,0,0,0,.981,1.152,10.6,10.6,0,0,0,.866-.816,10.058,10.058,0,0,0,.914-1.132A.756.756,0,0,0,372.391,383.572Z" transform="translate(-369.556 -383.437)" fill="red"/>
        </g>
      </g>
      <g id="Group_7240" data-name="Group 7240" transform="translate(25.282 30.13)">
        <g id="Group_7239" data-name="Group 7239">
          <path id="Path_76" data-name="Path 76" d="M345.377,424.738a.756.756,0,0,0-1.006-.364l-.024.011a.756.756,0,1,0,.611,1.384l.055-.025A.757.757,0,0,0,345.377,424.738Z" transform="translate(-343.896 -424.302)" fill="red"/>
        </g>
      </g>
      <g id="Group_7242" data-name="Group 7242" transform="translate(0 0)">
        <g id="Group_7241" data-name="Group 7241">
          <path id="Path_77" data-name="Path 77" d="M35.486,26H2.2A2.233,2.233,0,0,0,0,28.261v21.2a2.232,2.232,0,0,0,2.2,2.26H17.7A12.723,12.723,0,0,0,21.14,57.9c1.9,1.892,4.068,2.9,4.908,2.9s3.012-1.008,4.908-2.9A12.723,12.723,0,0,0,34.4,51.72h1.089a2.233,2.233,0,0,0,2.2-2.26v-21.2A2.233,2.233,0,0,0,35.486,26ZM33.268,48.62a11.312,11.312,0,0,1-3.292,8.145,9.166,9.166,0,0,1-3.929,2.519,9.165,9.165,0,0,1-3.929-2.519,11.313,11.313,0,0,1-3.292-8.145V44.9a32.469,32.469,0,0,0,7.221-3.139,33.594,33.594,0,0,0,7.22,3.138Zm2.944.84a.738.738,0,0,1-.727.747h-.833a14.34,14.34,0,0,0,.087-1.587v-4.3a.753.753,0,0,0-.543-.73A32,32,0,0,1,26.42,40.23a.719.719,0,0,0-.744,0A31.122,31.122,0,0,1,17.9,43.592a.754.754,0,0,0-.543.73v4.3a14.322,14.322,0,0,0,.087,1.587H2.2a.738.738,0,0,1-.727-.747V36.591H36.213Zm0-14.382H1.472V32.053H36.213Zm0-4.539H1.472V28.261a.738.738,0,0,1,.727-.747H35.486a.738.738,0,0,1,.727.747Z" transform="translate(0 -26.001)" fill="red"/>
        </g>
      </g>
      <g id="Group_7244" data-name="Group 7244" transform="translate(3.026 15.886)">
        <g id="Group_7243" data-name="Group 7243">
          <path id="Path_78" data-name="Path 78" d="M46.052,236a3.407,3.407,0,0,0-1.323.268,3.4,3.4,0,1,0,0,6.272A3.4,3.4,0,1,0,46.052,236ZM43.405,241.3a1.891,1.891,0,1,1,1.891-1.891A1.893,1.893,0,0,1,43.405,241.3Zm2.835-.009a3.4,3.4,0,0,0,0-3.764,1.891,1.891,0,0,1,0,3.764Z" transform="translate(-40.001 -236.003)" fill="red"/>
        </g>
      </g>
      <g id="Group_7246" data-name="Group 7246" transform="translate(3.026 12.481)">
        <g id="Group_7245" data-name="Group 7245" transform="translate(0 0)">
          <path id="Path_79" data-name="Path 79" d="M44.646,191H40.755a.756.756,0,1,0,0,1.513h3.891a.756.756,0,1,0,0-1.513Z" transform="translate(-39.999 -191.001)" fill="red"/>
        </g>
      </g>
      <g id="Group_7248" data-name="Group 7248" transform="translate(8.86 12.481)">
        <g id="Group_7247" data-name="Group 7247" transform="translate(0 0)">
          <path id="Path_80" data-name="Path 80" d="M121.314,191h-.036a.756.756,0,0,0,0,1.513h.036a.756.756,0,1,0,0-1.513Z" transform="translate(-120.522 -191.001)" fill="red"/>
        </g>
      </g>
      <g id="Group_7250" data-name="Group 7250" transform="translate(21.616 20.658)">
        <g id="Group_7249" data-name="Group 7249" transform="translate(0 0)">
          <path id="Path_81" data-name="Path 81" d="M304.6,299.319a.757.757,0,0,0-1.07,0l-4.045,4.045-2.12-2.12a.757.757,0,1,0-1.07,1.07l2.655,2.655a.756.756,0,0,0,1.07,0l4.58-4.58A.757.757,0,0,0,304.6,299.319Z" transform="translate(-296.077 -299.098)" fill="red"/>
        </g>
      </g>
    </g>
  </g>
</svg>

                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                            <span class='currncy-am'>AED</span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3">{{ $lib_due }}</a>
                                                <div class="text-dark-75">Liabilities</div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Callout-->
                            </div>
                        </div>
                        <!--end::Row-->
                        @endif
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
        </div>
    <div class="tab-pane fade" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
            <div class="content d-flex flex-column flex-column-fluid  p-0" id="kt_content">
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <!--begin::Dashboard-->
                        <!--begin::Row-->
                        <div class="row mb-3">
                            <div class="col-lg-3">

                                <!--begin::Callout-->
                                <div class="card card-custom mb-8 mb-lg-0">
                                    <div class="card-body icon-dashbo">
                                        <div class="align-items-center">
                                            <!--begin::Icon-->
                                            <div class="mr-6 icon-container">
                                                <span class="svg-icon svg-icon-cherwell svg-icon-4x">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
                                                    <svg id="Group_9804" data-name="Group 9804" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
  <path id="Path_52" data-name="Path 52" d="M34.1,16.2H32.9V6.6a.6.6,0,0,0-.6-.6H28.666l-1.193-3.78a.6.6,0,0,0-.786-.38L21.8,3.7,19.605.278a.6.6,0,0,0-.38-.263A.586.586,0,0,0,18.771.1L9.763,6H4.7A4.2,4.2,0,0,0,.5,10.2V31.8A4.205,4.205,0,0,0,4.7,36H32.3a.6.6,0,0,0,.6-.6V28.2h1.2a2.4,2.4,0,0,0,2.4-2.4V18.6A2.4,2.4,0,0,0,34.1,16.2Zm0,1.2a1.2,1.2,0,1,1,0,2.4H32.9V17.4ZM31.7,7.2v6h-.76l-1.895-6Zm-2.018,6H27.933l-1.663-4.99A.6.6,0,0,0,25.7,7.8a2.281,2.281,0,0,1-1.624-.672l-.352-.352a.6.6,0,0,0-.632-.139L5.34,13.2H4.7a2.991,2.991,0,0,1-2.129-.89L26.52,3.191Zm-3.014,0H8.8L23.148,7.9l.079.08a3.468,3.468,0,0,0,2.031,1ZM18.92,1.436l1.732,2.705L6.658,9.47ZM4.7,7.2H7.931L1.875,11.169A2.96,2.96,0,0,1,1.7,10.2,3,3,0,0,1,4.7,7.2Zm27,27.6H4.7a3,3,0,0,1-3-3V13.141l.017.016c.047.047.1.09.145.134s.1.1.154.14.105.08.158.12.109.085.167.125.113.07.17.1.117.074.18.108.123.06.185.091.12.06.184.089.136.051.2.076.12.048.183.067.153.041.231.06c.06.014.115.033.174.045.088.018.18.029.27.042.05.007.1.017.15.023.142.014.285.021.429.021h.78l.009.023.064-.023H31.7v5.4H25.1a4.2,4.2,0,1,0,0,8.4h6.6Zm3.6-9A1.2,1.2,0,0,1,34.1,27h-9a3,3,0,0,1,0-6h9a2.382,2.382,0,0,0,.431-.044c.034-.006.068-.013.1-.021a2.4,2.4,0,0,0,.4-.123l.02-.01a2.38,2.38,0,0,0,.25-.125Zm0,0" transform="translate(-0.5 0)" fill="red"/>
  <path id="Path_53" data-name="Path 53" d="M336.656,420.766H339.1v1.222h-2.444Zm0,0" transform="translate(-321.89 -404.576)" fill="red"/>
  <path id="Path_54" data-name="Path 54" d="M212,420.766h2.444v1.222H212Zm0,0" transform="translate(-202.027 -404.576)" fill="red"/>
  <path id="Path_55" data-name="Path 55" d="M710.648,420.766h2.094v1.222h-2.094Zm0,0" transform="translate(-681.519 -404.576)" fill="red"/>
  <path id="Path_56" data-name="Path 56" d="M585.988,420.766h2.444v1.222h-2.444Zm0,0" transform="translate(-561.634 -404.576)" fill="red"/>
  <path id="Path_57" data-name="Path 57" d="M84.184,418.582l-.286,1.185a4.352,4.352,0,0,0,1.007.122h1.572v-1.222H84.905A3.146,3.146,0,0,1,84.184,418.582Zm0,0" transform="translate(-78.779 -402.477)" fill="red"/>
  <path id="Path_58" data-name="Path 58" d="M461.32,420.766h2.444v1.222H461.32Zm0,0" transform="translate(-441.76 -404.576)" fill="red"/>
  <path id="Path_59" data-name="Path 59" d="M84.184,823.734l-.286,1.185a4.339,4.339,0,0,0,1.007.122h1.572V823.82H84.905A3.121,3.121,0,0,1,84.184,823.734Zm0,0" transform="translate(-78.779 -792.097)" fill="red"/>
  <path id="Path_60" data-name="Path 60" d="M710.648,825.918h2.094v1.222h-2.094Zm0,0" transform="translate(-681.519 -794.196)" fill="red"/>
  <path id="Path_61" data-name="Path 61" d="M336.656,825.918H339.1v1.222h-2.444Zm0,0" transform="translate(-321.89 -794.196)" fill="red"/>
  <path id="Path_62" data-name="Path 62" d="M585.988,825.918h2.444v1.222h-2.444Zm0,0" transform="translate(-561.634 -794.196)" fill="red"/>
  <path id="Path_63" data-name="Path 63" d="M212,825.918h2.444v1.222H212Zm0,0" transform="translate(-202.027 -794.196)" fill="red"/>
  <path id="Path_64" data-name="Path 64" d="M461.32,825.918h2.444v1.222H461.32Zm0,0" transform="translate(-441.76 -794.196)" fill="red"/>
  <path id="Path_65" data-name="Path 65" d="M594.481,576.594a1.833,1.833,0,1,0,1.833,1.833A1.833,1.833,0,0,0,594.481,576.594Zm0,2.444a.611.611,0,1,1,.611-.611A.611.611,0,0,1,594.481,579.038Zm0,0" transform="translate(-568.055 -554.439)" fill="red"/>
</svg>

                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                            <span class='currncy-am'>AED</span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3" id="company_today_transactions"></a>
                                                <div class="text-dark-75 ">Transactions Today</div>
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
                                                <span class="svg-icon svg-icon-cherwell svg-icon-4x">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
                                                    <svg id="money_1_" data-name="money (1)" xmlns="http://www.w3.org/2000/svg" width="36.427" height="36" viewBox="0 0 36.427 36">
  <g id="Group_7260" data-name="Group 7260" transform="translate(21.341 18.014)">
    <g id="Group_7259" data-name="Group 7259">
      <path id="Path_82" data-name="Path 82" d="M302.942,261.335a1.369,1.369,0,1,1,1.565-1.355.711.711,0,1,0,1.423,0,2.831,2.831,0,0,0-2.277-2.7v-.37a.711.711,0,0,0-1.423,0v.37a2.831,2.831,0,0,0-2.277,2.7,2.892,2.892,0,0,0,2.988,2.778,1.369,1.369,0,1,1-1.565,1.355.711.711,0,0,0-1.423,0,2.831,2.831,0,0,0,2.277,2.7v.307a.711.711,0,1,0,1.423,0v-.307a2.831,2.831,0,0,0,2.277-2.7A2.892,2.892,0,0,0,302.942,261.335Z" transform="translate(-299.954 -256.201)" fill="red"/>
    </g>
  </g>
  <g id="Group_7262" data-name="Group 7262" transform="translate(27.315 15.495)">
    <g id="Group_7261" data-name="Group 7261" transform="translate(0 0)">
      <path id="Path_83" data-name="Path 83" d="M388.731,224.206a9.27,9.27,0,0,0-3.787-3.351.711.711,0,1,0-.617,1.282,7.833,7.833,0,0,1,3.528,10.728.711.711,0,1,0,1.256.668,9.26,9.26,0,0,0-.381-9.328Z" transform="translate(-383.924 -220.785)" fill="red"/>
    </g>
  </g>
  <g id="Group_7264" data-name="Group 7264" transform="translate(24.688 14.656)">
    <g id="Group_7263" data-name="Group 7263">
      <path id="Path_84" data-name="Path 84" d="M347.759,209h-.048a.711.711,0,1,0,0,1.423h.045a.711.711,0,0,0,0-1.423Z" transform="translate(-347 -209.001)" fill="red"/>
    </g>
  </g>
  <g id="Group_7266" data-name="Group 7266" transform="translate(15.083 19.189)">
    <g id="Group_7265" data-name="Group 7265">
      <path id="Path_85" data-name="Path 85" d="M217.865,284.485a7.833,7.833,0,0,1-3.528-10.728.711.711,0,1,0-1.256-.668,9.253,9.253,0,0,0,4.167,12.679.711.711,0,1,0,.616-1.282Z" transform="translate(-212.002 -272.711)" fill="red"/>
    </g>
  </g>
  <g id="Group_7268" data-name="Group 7268" transform="translate(22.509 31.731)">
    <g id="Group_7267" data-name="Group 7267">
      <path id="Path_86" data-name="Path 86" d="M317.134,449h-.041a.711.711,0,0,0-.006,1.423h.048a.711.711,0,1,0,0-1.423Z" transform="translate(-316.378 -448.999)" fill="red"/>
    </g>
  </g>
  <g id="Group_7270" data-name="Group 7270" transform="translate(0 0)">
    <g id="Group_7269" data-name="Group 7269">
      <path id="Path_87" data-name="Path 87" d="M27.563,15.249a3.266,3.266,0,0,0-.316-.581H29.1a3.273,3.273,0,1,0,0-6.545H23.4A3.271,3.271,0,0,0,20.7,3H3.273a3.273,3.273,0,1,0,0,6.545h5.7a3.264,3.264,0,0,0,0,3.7H7.115a3.271,3.271,0,0,0-2.034,5.834,3.267,3.267,0,0,0,0,5.123,3.267,3.267,0,0,0,0,5.123,3.271,3.271,0,0,0,2.034,5.834H15.5A12.092,12.092,0,1,0,27.563,15.249Zm1.536-5.7a1.85,1.85,0,0,1,0,3.7H11.668a1.85,1.85,0,0,1,0-3.7ZM3.273,8.123a1.85,1.85,0,1,1,0-3.7H20.7a1.85,1.85,0,1,1,0,3.7Zm3.842,6.545H24.545a1.849,1.849,0,0,1,.807.186c-.337-.028-.677-.043-1.021-.043a12.057,12.057,0,0,0-8.559,3.557H7.115a1.85,1.85,0,1,1,0-3.7Zm0,5.123h7.443a12.06,12.06,0,0,0-1.829,3.7H7.115a1.85,1.85,0,1,1,0-3.7Zm0,5.123H12.4a12.1,12.1,0,0,0-.044,3.7H7.115a1.85,1.85,0,1,1,0-3.7Zm0,8.822a1.85,1.85,0,1,1,0-3.7h5.534a12.047,12.047,0,0,0,1.707,3.7Zm17.217,3.842A10.672,10.672,0,1,1,35,26.905,10.684,10.684,0,0,1,24.332,37.577Z" transform="translate(0 -3)" fill="red"/>
    </g>
  </g>
</svg>

                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                            <span class='currncy-am'>AED</span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3" id="company_salesToday">0</a>
                                                <div class="text-dark-75">Sales Today</div>
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
                                                <span class="svg-icon svg-icon-cherwell svg-icon-4x">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="35.879" height="36" viewBox="0 0 35.879 36">
  <g id="Group_9816" data-name="Group 9816" transform="translate(-978.472 -1564.688)">
    <g id="Group_7257" data-name="Group 7257" transform="translate(978.472 1564.688)">
      <path id="Path_74" data-name="Path 74" d="M.116,1.655-.242.82H-2l-.358.834h-.839l1.732-3.77h.668L.94,1.655ZM-1.723.189H-.515l-.6-1.412ZM1.255,1.655v-3.77h2.6v.647H2.068v.882H3.747V.061H2.068v.946H3.854v.647Zm3.171-3.77H5.891a2.32,2.32,0,0,1,1.059.225,1.568,1.568,0,0,1,.679.647A2.046,2.046,0,0,1,7.864-.233,2.081,2.081,0,0,1,7.631.78a1.548,1.548,0,0,1-.676.65,2.333,2.333,0,0,1-1.064.225H4.426ZM5.832.981a1.068,1.068,0,0,0,1.2-1.214,1.066,1.066,0,0,0-1.2-1.208H5.26V.981Z" transform="translate(6.324 27.158)" fill="red"/>
      <path id="XMLID_884_" d="M32.936,2.812H29.945V2.25a2.242,2.242,0,1,0-4.485,0v.562H15.789V2.25a2.242,2.242,0,1,0-4.485,0v.562H8.313A2.952,2.952,0,0,0,5.37,5.766V19.459A8.572,8.572,0,1,0,16.347,30.937H32.936a2.952,2.952,0,0,0,2.943-2.953V5.766A2.952,2.952,0,0,0,32.936,2.812ZM26.861,2.25a.841.841,0,1,1,1.682,0V4.781a.841.841,0,1,1-1.682,0Zm-14.155,0a.841.841,0,1,1,1.682,0V4.781a.841.841,0,1,1-1.682,0ZM8.313,4.219H11.3v.562a2.242,2.242,0,1,0,4.485,0V4.219H25.46v.562a2.242,2.242,0,1,0,4.485,0V4.219h2.991a1.546,1.546,0,0,1,1.542,1.547V9.984H6.771V5.766A1.546,1.546,0,0,1,8.313,4.219Zm.236,30.375A7.172,7.172,0,1,1,15.7,27.422a7.168,7.168,0,0,1-7.148,7.172Zm24.387-5.062h-16.1a8.556,8.556,0,0,0-10.066-10.5v-7.64H34.478V27.984A1.546,1.546,0,0,1,32.936,29.531Z" transform="translate(0)" fill="red"/>
      <circle id="XMLID_907_" cx="2.32" cy="2.32" r="2.32" transform="translate(25.774 13.44)" fill="red"/>
      <circle id="XMLID_908_" cx="2.32" cy="2.32" r="2.32" transform="translate(18.291 13.44)" fill="red"/>
      <circle id="XMLID_909_" cx="2.32" cy="2.32" r="2.32" transform="translate(10.621 13.44)" fill="red"/>
      <circle id="XMLID_910_" cx="2.32" cy="2.32" r="2.32" transform="translate(25.774 21.14)" fill="red"/>
      <circle id="XMLID_911_" cx="2.32" cy="2.32" r="2.32" transform="translate(18.291 21.14)" fill="red"/>
    </g>
  </g>
</svg>

                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                            <span class='currncy-am'>AED</span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3" id="company_salesMonth">0</a>
                                                <div class="text-dark-75">Sales This Month</div>
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
                                                <span class="svg-icon svg-icon-cherwell svg-icon-4x">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="37.685" height="34.797" viewBox="0 0 37.685 34.797">
  <g id="Group_9815" data-name="Group 9815" transform="translate(-1110.537 -1567.837)">
    <g id="credit-card" transform="translate(1110.537 1567.837)">
      <g id="Group_7238" data-name="Group 7238" transform="translate(27.133 27.038)">
        <g id="Group_7237" data-name="Group 7237" transform="translate(0 0)">
          <path id="Path_75" data-name="Path 75" d="M372.391,383.572a.756.756,0,0,0-1.053.191,8.555,8.555,0,0,1-.777.962,9.218,9.218,0,0,1-.74.7.756.756,0,0,0,.981,1.152,10.6,10.6,0,0,0,.866-.816,10.058,10.058,0,0,0,.914-1.132A.756.756,0,0,0,372.391,383.572Z" transform="translate(-369.556 -383.437)" fill="red"/>
        </g>
      </g>
      <g id="Group_7240" data-name="Group 7240" transform="translate(25.282 30.13)">
        <g id="Group_7239" data-name="Group 7239">
          <path id="Path_76" data-name="Path 76" d="M345.377,424.738a.756.756,0,0,0-1.006-.364l-.024.011a.756.756,0,1,0,.611,1.384l.055-.025A.757.757,0,0,0,345.377,424.738Z" transform="translate(-343.896 -424.302)" fill="red"/>
        </g>
      </g>
      <g id="Group_7242" data-name="Group 7242" transform="translate(0 0)">
        <g id="Group_7241" data-name="Group 7241">
          <path id="Path_77" data-name="Path 77" d="M35.486,26H2.2A2.233,2.233,0,0,0,0,28.261v21.2a2.232,2.232,0,0,0,2.2,2.26H17.7A12.723,12.723,0,0,0,21.14,57.9c1.9,1.892,4.068,2.9,4.908,2.9s3.012-1.008,4.908-2.9A12.723,12.723,0,0,0,34.4,51.72h1.089a2.233,2.233,0,0,0,2.2-2.26v-21.2A2.233,2.233,0,0,0,35.486,26ZM33.268,48.62a11.312,11.312,0,0,1-3.292,8.145,9.166,9.166,0,0,1-3.929,2.519,9.165,9.165,0,0,1-3.929-2.519,11.313,11.313,0,0,1-3.292-8.145V44.9a32.469,32.469,0,0,0,7.221-3.139,33.594,33.594,0,0,0,7.22,3.138Zm2.944.84a.738.738,0,0,1-.727.747h-.833a14.34,14.34,0,0,0,.087-1.587v-4.3a.753.753,0,0,0-.543-.73A32,32,0,0,1,26.42,40.23a.719.719,0,0,0-.744,0A31.122,31.122,0,0,1,17.9,43.592a.754.754,0,0,0-.543.73v4.3a14.322,14.322,0,0,0,.087,1.587H2.2a.738.738,0,0,1-.727-.747V36.591H36.213Zm0-14.382H1.472V32.053H36.213Zm0-4.539H1.472V28.261a.738.738,0,0,1,.727-.747H35.486a.738.738,0,0,1,.727.747Z" transform="translate(0 -26.001)" fill="red"/>
        </g>
      </g>
      <g id="Group_7244" data-name="Group 7244" transform="translate(3.026 15.886)">
        <g id="Group_7243" data-name="Group 7243">
          <path id="Path_78" data-name="Path 78" d="M46.052,236a3.407,3.407,0,0,0-1.323.268,3.4,3.4,0,1,0,0,6.272A3.4,3.4,0,1,0,46.052,236ZM43.405,241.3a1.891,1.891,0,1,1,1.891-1.891A1.893,1.893,0,0,1,43.405,241.3Zm2.835-.009a3.4,3.4,0,0,0,0-3.764,1.891,1.891,0,0,1,0,3.764Z" transform="translate(-40.001 -236.003)" fill="red"/>
        </g>
      </g>
      <g id="Group_7246" data-name="Group 7246" transform="translate(3.026 12.481)">
        <g id="Group_7245" data-name="Group 7245" transform="translate(0 0)">
          <path id="Path_79" data-name="Path 79" d="M44.646,191H40.755a.756.756,0,1,0,0,1.513h3.891a.756.756,0,1,0,0-1.513Z" transform="translate(-39.999 -191.001)" fill="red"/>
        </g>
      </g>
      <g id="Group_7248" data-name="Group 7248" transform="translate(8.86 12.481)">
        <g id="Group_7247" data-name="Group 7247" transform="translate(0 0)">
          <path id="Path_80" data-name="Path 80" d="M121.314,191h-.036a.756.756,0,0,0,0,1.513h.036a.756.756,0,1,0,0-1.513Z" transform="translate(-120.522 -191.001)" fill="red"/>
        </g>
      </g>
      <g id="Group_7250" data-name="Group 7250" transform="translate(21.616 20.658)">
        <g id="Group_7249" data-name="Group 7249" transform="translate(0 0)">
          <path id="Path_81" data-name="Path 81" d="M304.6,299.319a.757.757,0,0,0-1.07,0l-4.045,4.045-2.12-2.12a.757.757,0,1,0-1.07,1.07l2.655,2.655a.756.756,0,0,0,1.07,0l4.58-4.58A.757.757,0,0,0,304.6,299.319Z" transform="translate(-296.077 -299.098)" fill="red"/>
        </g>
      </g>
    </g>
  </g>
</svg>

                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Content-->
                                            <div class="icon-content">
                                            <span class='currncy-am'>AED</span>
                                                <a href="#" class="text-dark text-hover-cherwell font-weight-bold font-size-h4 mb-3">0</a>
                                                <div class="text-dark-75">Last Payout</div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Callout-->
                            </div>
                        </div>

                        <!--end::Dashboard-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
        </div>
    </div>
</div>
@include('admin.dashboard.js.index')
@endsection
