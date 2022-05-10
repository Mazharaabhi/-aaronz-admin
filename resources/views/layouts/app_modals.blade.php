   <!-- Modal HTML -->
   <input type="hidden" name="auth_user_id" id="auth_user_id" value="@auth {{ auth()->user()->id }} @endauth">
   <div id="myModal" class="modal fade confirm-modal ">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <h4 class="modal-title w-100">Thank You!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Your Message is on its way</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
 <!-- Modal -->
 <div class="sign_up_modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body container pb20">
                  <div class="row">
                      <div class="col-lg-12">
                        <ul class="sign_up_tab nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
                              </li>
                        </ul>
                      </div>
                  </div>
                <div class="tab-content container" id="myTabContent">
                      <div class="row mt25 mb25 tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                          <div class="col-lg-6 col-xl-6">
                              <div class="login_thumb">
                                  <img loading="lazy" class="img-fluid w100" src="{{asset('website')}}/images/resource/login.jpg" alt="login.jpg">
                              </div>
                          </div>
                          <div class="col-lg-6 col-xl-6">
                            <div class="login_form">
                                <form id="loginForm" onsubmit="return false">
                                    @csrf
                                    <div class="heading">
                                        <h4>Login</h4>
                                    </div>
                                    {{-- <div class="row mt25">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-fb btn-block"><i class="fa fa-facebook float-left mt5"></i> Login with Facebook</button>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-googl btn-block"><i class="fa fa-google float-left mt5"></i> Login with Google</button>
                                        </div>
                                    </div>
                                    <hr> --}}
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control" name="login_email" id="inlineFormInputGroupUsername2" placeholder="Email">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="flaticon-user"></i></div>
                                        </div>
                                    </div>
                                    <div class="input-group form-group">
                                        <input type="password" class="form-control" name="login_password" id="exampleInputPassword1" placeholder="Password">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="flaticon-password"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">Remember me</label>
                                        <a class="btn-fpswd float-right" href="#">Lost your password?</a>
                                    </div>
                                    <span class="login_error" class="text-danger"></span>
                                    <button type="submit" class="btn btn-log btn-block btn-thm">Log In</button>
                                    <p class="text-center">Don't have an account? <a class="text-thm" href="#">Register</a></p>
                                </form>
                            </div>
                          </div>
                      </div>
                      <div class="row mt25 mb25 tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                          <div class="col-lg-6 col-xl-6">
                              <div class="regstr_thumb">
                                  <img loading="lazy" class="img-fluid w100" src="{{asset('website')}}/images/resource/regstr.jpg" alt="regstr.jpg">
                              </div>
                          </div>
                          <div class="col-lg-6 col-xl-6">
                            <div class="sign_up_form">
                                <form method='post' id='verify-phone' class="d-none" onsubmit="return false">
                                    @csrf
                                    <h3>Please enter the 4-digit verification code we sent via SMS:</h3>
                                    <span>(we want to make sure it's you before we contact our movers)</span>
                                    <input type="hidden" name="verification_phone" id="verification_phone">
                                    <div id="form">
                                    <input type="text" maxLength="1" name="vc_1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                    <input type="text" maxLength="1" name="vc_2" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                    <input type="text" maxLength="1" name="vc_3" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                    <input type="text" class='last-one' name="vc_4" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                    <span class="text-danger d-block" id="verification_code_error"></span>
                                    <span class="text-success d-block" id="verification_code_success"></span>
                                    <button type="submit" class="btn btn-primary btn-embossed" id="verify_code">Verify</button>
                                    </div>

                                    <div>
                                    Didn't receive the code? <a href="#" id="resend_verification_code">Send code again</a>
                                    </div>
                                    <div class="heading">
                                        <h4 id="change_phone_number">Change Phone Number?</h4>

                                        {{-- <form action="" onsubmit="return false" id="change_phone_number_div">
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="tel" name="change_phone" id="change_phone" class="form-control mb-2" placeholder="">
                                            <button type="submit" class="btn btn-block btn-fb">Change Number</button>
                                        </div>
                                        </form> --}}
                                        {{-- <form method="post" id="change-phone" class="d-none" onsubmit="return false">
                                            <input type="hidden" name="_token" value="QqDCydvczsX1Yzw1dLSlfSVixotbkc4Qni6XJJHl">
                                            <div class="form-group input-group">
                                                  <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone" autocomplete="off" data-intl-tel-input-id="0" style="padding-left: 87px;"><input type="hidden" name="full_phone">
                                            </div>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                            </div>
                                                 <span class="text-danger" id="phone_error"></span>

                                         <button type="submit" class="btn btn-primary btn-embossed" id="change_num">Change</button>
                                        </form> --}}
                                    </div>
                            </form>
                                     <style>

                                           #verify-phone h3 {
                                            margin: 0 0 10px;
                                            padding: 0;
                                            line-height: 1.25;
                                            }
                                            #verify-phone span {
                                            font-size: 90%;
                                            }
                                            #verify-phone #form {
                                            max-width: 550px;
                                            margin: 25px auto 0;
                                            }
                                            #verify-phone #form input {
                                            margin: 0 5px;
                                            text-align: center;
                                            line-height: 80px;
                                            font-size: 50px;
                                            border: solid 1px #ccc;
                                            box-shadow: 0 0 5px #ccc inset;
                                            outline: none;
                                            width: 18%;
                                            transition: all 0.2s ease-in-out;
                                            border-radius: 3px;
                                            }
                                            #verify-phone #form input:focus {
                                            border-color: #30ccd3;
                                            box-shadow: 0 0 5px #30ccd3 inset;
                                            }
                                            #verify-phone #form input::-moz-selection {
                                            background: transparent;
                                            }
                                            #verify-phone #form input::selection {
                                            background: transparent;
                                            }
                                            #verify-phone #form button {
                                            margin: 30px 0 50px;
                                            width: 87%;
                                            padding: 6px;
                                            background-color: #30ccd3;
                                            border: none;
                                            text-transform: uppercase;
                                            }
                                            #verify-phone button.close {
                                            border: solid 2px;
                                            border-radius: 30px;
                                            line-height: 19px;
                                            font-size: 120%;
                                            width: 22px;
                                            position: absolute;
                                            right: 5px;
                                            top: 5px;
                                            }
                                            #verify-phone div {
                                            position: relative;
                                            z-index: 1;
                                            }

                                     </style>



                                <form method="POST" onsubmit="return false" id="sinupForm">
                                    @csrf
                                    {{-- <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-block btn-fb"><i class="fa fa-facebook float-left mt5"></i> Login with Facebook</button>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-block btn-googl"><i class="fa fa-google float-left mt5"></i> Login with Google</button>
                                        </div>
                                    </div> --}}
                                    {{-- <hr> --}}
                                    <div class="form-group input-group">
                                        <input type="text" class="form-control" name="username" id="exampleInputName" placeholder="Full Name">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="flaticon-user"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="email" class="form-control" name="email" id="exampleInputEmail2" placeholder="Email">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
                                        </div>
                                        <span class="text-danger" id="email_error"></span>
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                        </div>
                                        <span class="text-danger" id="phone_error"></span>
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control" name="password" id="exampleInputPassword2" placeholder="Password">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="flaticon-password"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control" name="password_confirm" id="exampleInputPassword3" placeholder="Re-enter password">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="flaticon-password"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group ui_kit_select_search mb0">
                                        <select name="role_id" class="selectpicker" data-live-search="true" data-width="100%">
                                            <option value="7">Customer</option>
                                            <option value="2">Property Manager/Owner</option>
                                            <option value="5">Service Provider</option>
                                            <option value="4">Bank</option>
                                            <option value="6">Insurance</option>
                                        </select>
                                    </div>
                                    <div class="form-group custom-control custom-checkbox">
                                        <input type="checkbox" name="termsConditions" class="custom-control-input" id="exampleCheck2">
                                        <label class="custom-control-label" for="exampleCheck2">I have read and accept the Terms and Privacy Policy?</label>
                                    </div>
                                    <button type="submit" class="btn btn-log btn-block btn-thm">Sign Up</button>
                                    <p class="text-center">Already have an account? <a class="text-thm" href="#">Log In</a></p>
                                </form>
                            </div>
                          </div>
                      </div>
                </div>
              </div>
        </div>
    </div>
</div>
