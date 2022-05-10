@extends('layouts.app')

@section('content')
<style>
    /***
    User Profile Sidebar by @keenthemes
    A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
    Licensed under MIT
    ***/

    body {
      background: #F1F3FA;
    }

    /* Profile container */
    .profile {
      margin: 20px 0;
    }

    /* Profile sidebar */
    .profile-sidebar {
      padding: 20px 0 10px 0;
      background: #fff;
    }

    .profile-userpic img {
      float: none;
      margin: 0 auto;
      display:block;
      width: 50%;
      height: 50%;
      -webkit-border-radius: 50% !important;
      -moz-border-radius: 50% !important;
      border-radius: 50% !important;
    }
    .profile-usermenu .nav {
        display: block;
        }

    .profile-usertitle {
      text-align: center;
      margin-top: 20px;
    }

    .profile-usertitle-name {
      color: #5a7391;
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 7px;
    }

    .profile-usertitle-job {
      text-transform: uppercase;
      color: #5b9bd1;
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .profile-userbuttons {
      text-align: center;
      margin-top: 10px;
    }

    .profile-userbuttons .btn {
      text-transform: uppercase;
      font-size: 11px;
      font-weight: 600;
      padding: 6px 15px;
      margin-right: 5px;
    }

    .profile-userbuttons .btn:last-child {
      margin-right: 0px;
    }

    .profile-usermenu {
      margin-top: 30px;
    }

    .profile-usermenu ul li {
      border-bottom: 1px solid #f0f4f7;
    }

    .profile-usermenu ul li:last-child {
      border-bottom: none;
    }

    .profile-usermenu ul li a {
      color: #93a3b5;
      font-size: 14px;
      font-weight: 400;
    }

    .profile-usermenu ul li a i {
      margin-right: 8px;
      font-size: 14px;
    }

    .profile-usermenu ul li a:hover {
      background-color: #fafcfd;
      color: #5b9bd1;
    }

    .profile-usermenu ul li a.active {
      border-bottom: none;
    }
    .profile-usermenu ul li a.active {
        border-left: 2px solid #30ccd3!important;
        border: none;
        }
    .profile-usermenu ul li a.active {
      color: #5b9bd1;
      background-color: #f6f9fb;
      margin-left: -2px;
    }

    /* Profile Content */
    .profile-content {
      padding: 20px;
      background: #fff;
      min-height: 460px;
    }
    legend{
        display: inline-block !important;
        width: auto !important;
        font-size: 16px !important;
        margin-bottom: 8px !important;
        padding: 0px 10px !important;
    }
    fieldset{
        border: 1px solid black !important;
        padding: 10px;
    }
    </style>
<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img loading="lazy" src="{{ asset(auth()->user()->avatar) }}" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{ auth()->user()->name }}
					</div>
					<div class="profile-usertitle-job">
						{{-- Developer --}}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				{{-- <div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
				</div> --}}
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a href="#overview" class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview">
							<i class="glyphicon glyphicon-home"></i>
							Overview </a>
						</li>
						<li class="nav-item">
							<a href="#account_settings" class="nav-link " data-toggle="tab" href="#account_settings" role="tab" aria-controls="account_settings">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
						<li class="nav-item">
							<a href="#tasks" class="nav-link " data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks">
							<i class="glyphicon glyphicon-ok"></i>
							My Properties </a>
						</li>
						<li class="nav-item">
							<a href="#help" class="nav-link " data-toggle="tab" href="#help" role="tab" aria-controls="help">
							<i class="glyphicon glyphicon-flag"></i>
							Help </a>
						</li class="nav-item">
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="tab-content">
				<div class="tab-pane active profile-content" id="overview" role="tabpanel">
                    <h2>User Profile</h2>
                    <h4>Contact Details</h4>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <fieldset>
                                <legend>Full Name</legend>
                                <p>{{ auth()->user()->name }}</p>
                            </fieldset>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <fieldset>
                                <legend>Email</legend>
                                <p>{{ auth()->user()->email }}</p>
                            </fieldset>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <fieldset>
                                <legend>Phone</legend>
                                <p>{{ auth()->user()->phone }}</p>
                            </fieldset>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <fieldset>
                                <legend>Residential Status</legend>
                                <p>Resident</p>
                            </fieldset>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                            <fieldset>
                                <legend>Residential Address</legend>
                                <p>{{ auth()->user()->address }}</p>
                            </fieldset>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                            <fieldset>
                                <legend>Nation Identity</legend>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6 my-3">
                                        <label for="">Emirate ID Front</label>
                                        <img loading="lazy" src="{{ asset('/storage/'.auth()->user()->id_front) }}" alt="">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6 my-3">
                                        <label for="">Emirate ID Back</label>
                                        <img loading="lazy" src="{{ asset('/storage/'.auth()->user()->id_back) }}" alt="">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
				<div class="tab-pane profile-content" id="account_settings" role="tabpanel">
                    <fieldset>
                        <legend><h3>Account Settings</h3></legend>
                        <form method="POST" id="ProfileForm" onsubmit="return false">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" name="full_name" id="full_name" value="{{ auth()->user()->name }}" placeholder="Enter Full Name" class="form-control">
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <label>Email</label>
                                    <input type="email" name="profile_email" id="profile_email" value="{{ auth()->user()->email }}" placeholder="Enter Your Email" class="form-control">
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <label>Phone Number</label>
                                    <input type="tel" name="profile_phone" id="profile_phone" value="{{ auth()->user()->phone }}" placeholder="Enter Your Phone" class="form-control">
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <label>Residential Status</label>
                                    <select name="residential_status" id="residential_status" class="form-control">
                                        <option value="0" selected="">Resident</option>
                                        <option value="1">Non-Resident</option>
                                    </select>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                    <label>Residential Address</label>
                                    <input type="text" name="address" id="residential_address" value="Sorry we don't have ID " class="form-control"  placeholder="Enter a location" autocomplete="off">
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                    <label>Emirates ID Front</label>
                                    <input id="id_front" name="id_front" type="file" value="" class="form-control">
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                    <label>Emirates ID Back</label>
                                    <input id="id_back" name="id_back" type="file" value="" class="form-control">
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                    <div class="field">
                                        <label>Profile Image</label>
                                        <input id="avatar" name="avatar" type="file" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                    <button type="submit" class="btn btn-log btn-block btn-thm">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
				<div class="tab-pane profile-content" id="tasks" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <fieldset>
                                <legend>Tenanacy Properties</legend>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>sr #</th>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                </table>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset>
                                <legend>Buy Properties</legend>
                            </fieldset>
                        </div>
                    </div>
                </div>
				<div class="tab-pane profile-content" id="help" role="tabpanel">4</div>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){

        $("#ProfileForm").validate({
        rules: {
            full_name : {
                required: true,
                minlength: 3
            },
            profile_email: {
                required: true,
                email: true
            },
			profile_phone: {
                required: true,
                minlength: 9
            }
        },
        messages:{
            full_name:{
                required: "The username field is required.",
                minlength: "Username length should be atleast 3 characters."
            },
            profile_email:{
                required: "The email field is required.",
            },
			profile_phone:{
                required: "The phone field is required.",
                minlength: "Phone length must be atleast 9 digits."
            }
        },
            submitHandler: function(form) {
            const full_name = $('#full_name').val();
            const profile_email = $('#profile_email').val();
            const profile_phone = $('#profile_phone').val();
            const residential_status = $('#residential_status').val();
            const residential_address = $('#residential_address').val();
            const id_front = document.getElementById('id_front').files[0];
            const id_back = document.getElementById('id_back').files[0];
            const avatar = document.getElementById('avatar').files[0];
            const _token = "{{ csrf_token() }}";
            const _method = "PUT";

            const formData = new FormData;
            formData.append('full_name', full_name);
            formData.append('profile_email', profile_email);
            formData.append('profile_phone', profile_phone);
            formData.append('residential_status', residential_status);
            formData.append('residential_address', residential_address);
            formData.append('id_front', id_front);
            formData.append('id_back', id_back);
            formData.append('avatar', avatar);
            formData.append('_token', _token);
            formData.append('_method', _method);
            $.ajax({
                url: "{{ route('profile.update', Auth::user()->id) }}",
                method: "POST",
                data: formData,
                contentType:false,
                processData:false,
                cache:false,
                beforeSend:function(){
                    $('#ProfileForm button[type="submit"]').attr('disabled');
                    $('#ProfileForm button[type="submit"]').html('Processing...');
                },
                success: function(res) {
                    $('#ProfileForm button[type="submit"]').removeAttr('disabled');
                    $('#ProfileForm button[type="submit"]').html('Update Profile');
                    // return console.log(res);
                    swal('Success!', 'Profile Updated Successfully!', 'success');
                    window.location.reload();
                    if(res === "email")
                    {
                        $('#email_error').html('Email already taken.');
                        return $('input[name="email"]').focus();
                    }
                    else if(res == "phone"){
                        $('#email_error').html('Phone already taken.');
                        return $('input[name="phone"]').focus();
                    }else{
                        $('#verify-phone').removeAttr('class');
                        $('#sinupForm').attr('class', 'd-none');
                        $('#verification_phone').val(res);
                        $('#sinupForm')[0].reset();
                    }
                },error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }
        });

    });
</script>
@endsection
