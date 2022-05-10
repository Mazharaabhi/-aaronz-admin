@extends('layouts.master')
@section('title', 'Liabilities')
@section('first', 'Liabilities')
@section('second', 'Accounts')
@section('third', 'Liabilities')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                            <!--begin::Search Form-->
                            <div class="mb-4">
                                <div class="row mb-4 mr-2 addjustpad">
                                    <div class="col-lg-3">
                                      <!--begin::Callout-->
                                        <div class="card card-custom mb-8 mb-lg-0">
                                            <div class="card-body icon-dashbo">
                                                <div class="align-items-center">
                                                 <!--begin::Icon-->
                                                    <div class="mr-6 icon-container">
                                                        <span class="svg-icon svg-icon-danger svg-icon-4x">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
                                                            <svg id="Group_9804" data-name="Group 9804" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
          <path id="Path_52" data-name="Path 52" d="M34.1,16.2H32.9V6.6a.6.6,0,0,0-.6-.6H28.666l-1.193-3.78a.6.6,0,0,0-.786-.38L21.8,3.7,19.605.278a.6.6,0,0,0-.38-.263A.586.586,0,0,0,18.771.1L9.763,6H4.7A4.2,4.2,0,0,0,.5,10.2V31.8A4.205,4.205,0,0,0,4.7,36H32.3a.6.6,0,0,0,.6-.6V28.2h1.2a2.4,2.4,0,0,0,2.4-2.4V18.6A2.4,2.4,0,0,0,34.1,16.2Zm0,1.2a1.2,1.2,0,1,1,0,2.4H32.9V17.4ZM31.7,7.2v6h-.76l-1.895-6Zm-2.018,6H27.933l-1.663-4.99A.6.6,0,0,0,25.7,7.8a2.281,2.281,0,0,1-1.624-.672l-.352-.352a.6.6,0,0,0-.632-.139L5.34,13.2H4.7a2.991,2.991,0,0,1-2.129-.89L26.52,3.191Zm-3.014,0H8.8L23.148,7.9l.079.08a3.468,3.468,0,0,0,2.031,1ZM18.92,1.436l1.732,2.705L6.658,9.47ZM4.7,7.2H7.931L1.875,11.169A2.96,2.96,0,0,1,1.7,10.2,3,3,0,0,1,4.7,7.2Zm27,27.6H4.7a3,3,0,0,1-3-3V13.141l.017.016c.047.047.1.09.145.134s.1.1.154.14.105.08.158.12.109.085.167.125.113.07.17.1.117.074.18.108.123.06.185.091.12.06.184.089.136.051.2.076.12.048.183.067.153.041.231.06c.06.014.115.033.174.045.088.018.18.029.27.042.05.007.1.017.15.023.142.014.285.021.429.021h.78l.009.023.064-.023H31.7v5.4H25.1a4.2,4.2,0,1,0,0,8.4h6.6Zm3.6-9A1.2,1.2,0,0,1,34.1,27h-9a3,3,0,0,1,0-6h9a2.382,2.382,0,0,0,.431-.044c.034-.006.068-.013.1-.021a2.4,2.4,0,0,0,.4-.123l.02-.01a2.38,2.38,0,0,0,.25-.125Zm0,0" transform="translate(-0.5 0)" fill="red"></path>
          <path id="Path_53" data-name="Path 53" d="M336.656,420.766H339.1v1.222h-2.444Zm0,0" transform="translate(-321.89 -404.576)" fill="red"></path>
          <path id="Path_54" data-name="Path 54" d="M212,420.766h2.444v1.222H212Zm0,0" transform="translate(-202.027 -404.576)" fill="red"></path>
          <path id="Path_55" data-name="Path 55" d="M710.648,420.766h2.094v1.222h-2.094Zm0,0" transform="translate(-681.519 -404.576)" fill="red"></path>
          <path id="Path_56" data-name="Path 56" d="M585.988,420.766h2.444v1.222h-2.444Zm0,0" transform="translate(-561.634 -404.576)" fill="red"></path>
          <path id="Path_57" data-name="Path 57" d="M84.184,418.582l-.286,1.185a4.352,4.352,0,0,0,1.007.122h1.572v-1.222H84.905A3.146,3.146,0,0,1,84.184,418.582Zm0,0" transform="translate(-78.779 -402.477)" fill="red"></path>
          <path id="Path_58" data-name="Path 58" d="M461.32,420.766h2.444v1.222H461.32Zm0,0" transform="translate(-441.76 -404.576)" fill="red"></path>
          <path id="Path_59" data-name="Path 59" d="M84.184,823.734l-.286,1.185a4.339,4.339,0,0,0,1.007.122h1.572V823.82H84.905A3.121,3.121,0,0,1,84.184,823.734Zm0,0" transform="translate(-78.779 -792.097)" fill="red"></path>
          <path id="Path_60" data-name="Path 60" d="M710.648,825.918h2.094v1.222h-2.094Zm0,0" transform="translate(-681.519 -794.196)" fill="red"></path>
          <path id="Path_61" data-name="Path 61" d="M336.656,825.918H339.1v1.222h-2.444Zm0,0" transform="translate(-321.89 -794.196)" fill="red"></path>
          <path id="Path_62" data-name="Path 62" d="M585.988,825.918h2.444v1.222h-2.444Zm0,0" transform="translate(-561.634 -794.196)" fill="red"></path>
          <path id="Path_63" data-name="Path 63" d="M212,825.918h2.444v1.222H212Zm0,0" transform="translate(-202.027 -794.196)" fill="red"></path>
          <path id="Path_64" data-name="Path 64" d="M461.32,825.918h2.444v1.222H461.32Zm0,0" transform="translate(-441.76 -794.196)" fill="red"></path>
          <path id="Path_65" data-name="Path 65" d="M594.481,576.594a1.833,1.833,0,1,0,1.833,1.833A1.833,1.833,0,0,0,594.481,576.594Zm0,2.444a.611.611,0,1,1,.611-.611A.611.611,0,0,1,594.481,579.038Zm0,0" transform="translate(-568.055 -554.439)" fill="red"></path>
        </svg>

                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Content-->
                                                    <div class="icon-content">
                                                        <span class="currncy-am">AED</span>
                                                        <a href="#" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">{{ $lib_due }}</a>
                                                        <div class="text-dark-75">Pending Liabilities</div>
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
                                                        <span class="svg-icon svg-icon-danger svg-icon-4x">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
                                                            <svg id="money_1_" data-name="money (1)" xmlns="http://www.w3.org/2000/svg" width="36.427" height="36" viewBox="0 0 36.427 36">
          <g id="Group_7260" data-name="Group 7260" transform="translate(21.341 18.014)">
            <g id="Group_7259" data-name="Group 7259">
              <path id="Path_82" data-name="Path 82" d="M302.942,261.335a1.369,1.369,0,1,1,1.565-1.355.711.711,0,1,0,1.423,0,2.831,2.831,0,0,0-2.277-2.7v-.37a.711.711,0,0,0-1.423,0v.37a2.831,2.831,0,0,0-2.277,2.7,2.892,2.892,0,0,0,2.988,2.778,1.369,1.369,0,1,1-1.565,1.355.711.711,0,0,0-1.423,0,2.831,2.831,0,0,0,2.277,2.7v.307a.711.711,0,1,0,1.423,0v-.307a2.831,2.831,0,0,0,2.277-2.7A2.892,2.892,0,0,0,302.942,261.335Z" transform="translate(-299.954 -256.201)" fill="red"></path>
            </g>
          </g>
          <g id="Group_7262" data-name="Group 7262" transform="translate(27.315 15.495)">
            <g id="Group_7261" data-name="Group 7261" transform="translate(0 0)">
              <path id="Path_83" data-name="Path 83" d="M388.731,224.206a9.27,9.27,0,0,0-3.787-3.351.711.711,0,1,0-.617,1.282,7.833,7.833,0,0,1,3.528,10.728.711.711,0,1,0,1.256.668,9.26,9.26,0,0,0-.381-9.328Z" transform="translate(-383.924 -220.785)" fill="red"></path>
            </g>
          </g>
          <g id="Group_7264" data-name="Group 7264" transform="translate(24.688 14.656)">
            <g id="Group_7263" data-name="Group 7263">
              <path id="Path_84" data-name="Path 84" d="M347.759,209h-.048a.711.711,0,1,0,0,1.423h.045a.711.711,0,0,0,0-1.423Z" transform="translate(-347 -209.001)" fill="red"></path>
            </g>
          </g>
          <g id="Group_7266" data-name="Group 7266" transform="translate(15.083 19.189)">
            <g id="Group_7265" data-name="Group 7265">
              <path id="Path_85" data-name="Path 85" d="M217.865,284.485a7.833,7.833,0,0,1-3.528-10.728.711.711,0,1,0-1.256-.668,9.253,9.253,0,0,0,4.167,12.679.711.711,0,1,0,.616-1.282Z" transform="translate(-212.002 -272.711)" fill="red"></path>
            </g>
          </g>
          <g id="Group_7268" data-name="Group 7268" transform="translate(22.509 31.731)">
            <g id="Group_7267" data-name="Group 7267">
              <path id="Path_86" data-name="Path 86" d="M317.134,449h-.041a.711.711,0,0,0-.006,1.423h.048a.711.711,0,1,0,0-1.423Z" transform="translate(-316.378 -448.999)" fill="red"></path>
            </g>
          </g>
          <g id="Group_7270" data-name="Group 7270" transform="translate(0 0)">
            <g id="Group_7269" data-name="Group 7269">
              <path id="Path_87" data-name="Path 87" d="M27.563,15.249a3.266,3.266,0,0,0-.316-.581H29.1a3.273,3.273,0,1,0,0-6.545H23.4A3.271,3.271,0,0,0,20.7,3H3.273a3.273,3.273,0,1,0,0,6.545h5.7a3.264,3.264,0,0,0,0,3.7H7.115a3.271,3.271,0,0,0-2.034,5.834,3.267,3.267,0,0,0,0,5.123,3.267,3.267,0,0,0,0,5.123,3.271,3.271,0,0,0,2.034,5.834H15.5A12.092,12.092,0,1,0,27.563,15.249Zm1.536-5.7a1.85,1.85,0,0,1,0,3.7H11.668a1.85,1.85,0,0,1,0-3.7ZM3.273,8.123a1.85,1.85,0,1,1,0-3.7H20.7a1.85,1.85,0,1,1,0,3.7Zm3.842,6.545H24.545a1.849,1.849,0,0,1,.807.186c-.337-.028-.677-.043-1.021-.043a12.057,12.057,0,0,0-8.559,3.557H7.115a1.85,1.85,0,1,1,0-3.7Zm0,5.123h7.443a12.06,12.06,0,0,0-1.829,3.7H7.115a1.85,1.85,0,1,1,0-3.7Zm0,5.123H12.4a12.1,12.1,0,0,0-.044,3.7H7.115a1.85,1.85,0,1,1,0-3.7Zm0,8.822a1.85,1.85,0,1,1,0-3.7h5.534a12.047,12.047,0,0,0,1.707,3.7Zm17.217,3.842A10.672,10.672,0,1,1,35,26.905,10.684,10.684,0,0,1,24.332,37.577Z" transform="translate(0 -3)" fill="red"></path>
            </g>
          </g>
        </svg>

                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Content-->
                                                    <div class="icon-content">
                                                    <span class="currncy-am">AED</span>
                                                        <a href="#" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">{{ $lib_paid }}</a>
                                                        <div class="text-dark-75 ">Paid Liabilitiesy</div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <!--end::Callout-->
                                    </div>
                                </div>

                            </div>
                            <!--end::Search Form-->
                            <!--begin: Datatable-->
                            <div>
                                <fieldset>
                                    <legend>Paid Liabilities</legend>
                                    <table id="users-table" class="table">
                                        <thead>
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th>Date & Time</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </fieldset>
                            </div>
                            <!--end: Datatable-->

                    <!--end::Card-->

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.accounts.liabilities.modals');
@include('admin.accounts.liabilities.js.index');
@endsection
