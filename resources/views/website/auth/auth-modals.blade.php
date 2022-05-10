<div id="ModalLoginForm" class="modal fade">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class='formsectlog'>
				<div id="exTab3" class="">
					<ul  class="nav nav-pills">
						<li class="active">
							<a  href="#login-f" data-toggle="tab" id="login-tab">@lang('translation.sign_In') </a>
						</li>
						<li><a href="#login-r" data-toggle="tab">@lang('translation.create_account')</a>
						</li>
					</ul>
					<div class="tab-content clearfix">
						<div class="tab-pane active" id="login-f">
							<div class='row row-eq-height' id="login-row">
								<div class='col-md-6'>
										<label for='phone'>@lang('translation.phone_number') </label>
										<span class='phone-code'>+971</span>
                                        <input type='tel' name='phone' id='phone' placeholder="@lang('translation.enter_your_phone_number')" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="9">
										<label for='password'>@lang('translation.password')</label>
                                        <input type='password' name='password' id='password' placeholder="@lang('translation.enter_your_password')">
										<input type='button' id="Login" value="@lang('translation.login')" class='btn btn-primary btn-lg'>
                                        <span class="text-danger float-left mt-1" id="login_error"></span>
                                        <a style="cursor:pointer" id="forgot-password" class='forgetPas'>@lang('translation.forgot_your_password')</a>
								</div>
								<div class='col-md-6 col-w-bg'>
									<img loading="lazy" src='{{ URL::to('/public/website') }}/images/Group5051.png' class='signside-img'>
								</div>
                            </div>
                            {{-- Div for verify authentication code --}}
                            <div class='row row-eq-height d-none' id="verification-row">
								<div class='col-md-6'>
                                        <h3 class="mb-3"><br>@lang('translation.we_have_sent_the_code_to') <br/> (+971) <span id="number"></span></br></h3>
                                        <input type="hidden" name="is_forgot" id="is_forgot" value="0">
                                        <span class='phone-code'>@lang('translation.code')</span>
                                        <input type='tel' name='code' id='code' placeholder="@lang('translation.enter_authentication_code')" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="9"/>
										<input type='button' value="@lang('translation.verify')" id="verify-code" class='btn btn-primary btn-lg btn-block'>
                                        <span class="text-danger float-left mt-1" id="code_error"></span>
                                        <br><br>
                                        <a  style="cursor:pointer;color: black;text-decoration:underline !important;font-weight:bold" id="edit_number">@lang('translation.edit_number')</a>
                                        <p class="forgetPas my-0">@lang('translation.havent_receive_the_code') <a id="resend-code" style="cursor:pointer;color: black;font-weight:bold"> @lang('translation.resend_code')</a></p>
								</div>
								<div class='col-md-6 col-w-bg'>
									<img loading="lazy" src='{{ URL::to('/public/website') }}/images/Group5051.png' class='signside-img'>
								</div>
                            </div>
                            {{-- End Div for verify authentication code --}}
                            {{-- Div for Forgot password --}}
                            <div class='row row-eq-height d-none' id="forgot-row">
								<div class='col-md-6'>
                                        <h3 class="mb-3"><br>@lang('translation.forgot_password')</br></h3>
										<span class='phone-code'>+971</span>
                                        <input type='tel' name='forgot-phone' id='forgot-phone' placeholder="@lang('translation.enter_your_phone_number')" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="9"/>
										<input type='button' value="@lang('translation.send')" id="forgot-password-btn" class='btn btn-primary btn-lg btn-block'>
                                        <span class="text-danger float-left mt-1" id="forgot_phone_error"></span>
                                        <br><br>
                                        <a style="cursor:pointer" id="forgot-password-back" class='forgetPas'>@lang('translation.back_to_login')</a>
								</div>
								<div class='col-md-6 col-w-bg'>
									<img loading="lazy" src='{{ URL::to('/public/website') }}/images/Group5051.png' class='signside-img'>
								</div>
                            </div>
                            {{-- End Div for Forgot password --}}
                            {{-- Div for reset-password password --}}
                            <div class='row row-eq-height d-none' id="reset-password-row">
								<div class='col-md-6'>
                                        <h3 class="mb-3"><br>@lang('translation.reset_your_password')</br></h3>
										<label for='password'>@lang('translation.password')</label>
                                        <input type="password" name="reset-password" id="reset-password">
                                        <span class="text-danger float-left mt-1" id="reset_password_error"></span>
										<label for='password'>@lang('translation.confirm_password')</label>
                                        <input type="password" name="confirm-reset-password" id="confirm-reset-password">
                                        <span class="text-danger float-left mt-1" id="confirm_reset_password_error"></span>
										<input type='button' value="@lang('translation.reset_password')" id="reset-password-btn" class='btn btn-primary btn-lg btn-block'>
                                        <span class="text-danger float-left mt-1" id="reset_password_error"></span>
                                        <br><br>
								</div>
								<div class='col-md-6 col-w-bg'>
									<img loading="lazy" src='{{ URL::to('/public/website') }}/images/Group5051.png' class='signside-img'>
								</div>
                            </div>
                            {{-- End Div for reset-password password --}}

						</div>
						<div class="tab-pane" id="login-r">
							<div class='row'>
								<div class='col-md-10 offset-md-1 col-sm-12'>
										<div class='row'>
											<div class='col-md-6 col-sm-12'>
												<label for='uName'>@lang('translation.name') </label>
                                                <input type='text' name='uName' id='uName'>
                                                <span class="text-danger float-left" id="uName_error"></span>
											</div>
											<div class='col-md-6 col-sm-12'>
												<label for='email'>@lang('translation.email_address')</label>
                                                <input type='email' name='uEmail' id='uEmail'>
                                                <span class="text-danger float-left" id="uEmail_error"></span>
											</div>
											<div class='col-md-6 col-sm-12'>
												<label for='uPassword'>@lang('translation.password') </label>
                                                <input type='password' name='uPassword' id='uPassword'>
                                                <span class="text-danger float-left" id="uPassword_error"></span>
											</div>
											<div class='col-md-6 col-sm-12'>
												<label for='conPassword'>@lang('translation.confirm_password')</label>
                                                <input type='password' name='conPassword' id='conPassword'>
                                                <span class="text-danger float-left" id="conPassword_error"></span>
											</div>
											<div class='col-md-6 col-sm-12'>
												<label for='phoneNumb'>@lang('translation.phone_number') </label>
												<span class='phone-code'>+971</span>
                                                <input type="tel" id='phoneNumb' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="9"/>
                                                <span class="text-danger float-left" id="phoneNumb_error"></span>
											</div>
											<div class='col-md-6 col-sm-12'>
												<label for='address'>@lang('translation.address')</label>
                                                <input type='text' name='address' id='address'>
                                                <span class="text-danger float-left" id="address_error"></span>
											</div>
										</div>
										<input type='button' value="@lang('translation.register')" id="Register" class='btn btn-primary btn-lg'>

								</div>
								<div class='col-md-12'>
									<div class='align-img-pop'>
										<img loading="lazy" src='{{ URL::to('/public/website') }}/images/Group4216.png'> <img loading="lazy" src='{{ URL::to('/public/website') }}/images/Group5233.png'> <img loading="lazy" src='{{ URL::to('/public/website') }}/images/Group5051.png'>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
@include('website.auth.js.signup')
@include('website.auth.js.login')
@include('website.auth.js.verify-code')
@include('website.auth.js.forgot-password')
@include('website.auth.js.reset-password')
