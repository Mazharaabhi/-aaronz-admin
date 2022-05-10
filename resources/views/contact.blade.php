@extends('layouts.app')

@section('content')
	<!-- Our Contact -->
	<section class="our-contact pb0 bgc-f7">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-xl-8">
					<div class="form_grid">
						<h4 class="mb5">Send Us An Email</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida quis libero eleifend ornare. Maecenas mattis enim at arcu feugiat, sit amet blandit nisl iaculis. Donec lacus odio, malesuada eu libero sit amet, congue aliquam leo. In hac habitasse platea dictumst.</p>
			            <form class="contact_form" id="contact_form" name="contact_form" action="#" method="post" novalidate="novalidate">
							<div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
										<input id="form_name" name="form_name" class="form-control" required="required" type="text" placeholder="Name">
									</div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                    	<input id="form_email" name="form_email" class="form-control required email" required="required" type="email" placeholder="Email">
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                    	<input id="form_phone" name="form_phone" class="form-control required phone" required="required" type="phone" placeholder="Phone">
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
					                    <input id="form_subject" name="form_subject" class="form-control required" required="required" type="text" placeholder="Subject">
									</div>
				                </div>
				                <div class="col-sm-12">
		                            <div class="form-group">
		                                <textarea id="form_message" name="form_message" class="form-control required" rows="8" required="required" placeholder="Your Message"></textarea>
		                            </div>
				                    <div class="form-group mb0">
					                    <button type="submit" class="btn btn-lg btn-thm">Send Message</button>
				                    </div>
				                </div>
			                </div>
			            </form>
					</div>
				</div>
				<div class="col-lg-5 col-xl-4">
					<div class="contact_localtion">
						<h4>Contact Us</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida quis libero eleifend ornare. habitasse platea dictumst.</p>
						<div class="content_list">
							<h5>Address</h5>
							<p>{{ $header_footer->address }}</p>
						</div>
						<div class="content_list">
							<h5>Phone</h5>
							<p>{{ $header_footer->phone }}</p>
						</div>
						<div class="content_list">
							<h5>Mail</h5>
							<p>{{ $header_footer->email }}</p>
						</div>
						<h5>Follow Us</h5>
						<ul class="contact_form_social_area">
							<li class="list-inline-item"><a href="{{ $header_footer->fb }}"><i class="fa fa-facebook"></i></a></li>
							<li class="list-inline-item"><a href="{{ $header_footer->twitter }}"><i class="fa fa-twitter"></i></a></li>
							{{-- <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li> --}}
							<li class="list-inline-item"><a href="{{ $header_footer->google }}"><i class="fa fa-google"></i></a></li>
							<li class="list-inline-item"><a href="{{ $header_footer->youtube }}"><i class="fa fa-youtube"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid p0 mt50">
			<div class="row">
				<div class="col-lg-12">
					<div class="h600" id="map-canvas"></div>
				</div>
			</div>
		</div>
	</section>
<script>
    $(document).ready(function(){
        $('#contact_form').validate({
            rules:{
                form_name:{
                    required:true,
                    minlength:3,
                },
                form_email:{
                    required:true,
                    email:true,
                },
                form_phone:{
                    required:true,
                },
                form_subject:{
                    required:true,
                    minlength:3,
                },
                form_message:{
                    required:true,
                    minlength:10,
                },
            },
            messages:{
                form_name:{
                    required:"The name field is required"
                },
                form_email:{
                    required:"The email field is required"
                },
                form_phone:{
                    required:"The phone field is required"
                },
                form_subject:{
                    required:"The subject field is required"
                },
                form_message:{
                    required:"The message field is required"
                },
            },
            submitHandler: function(form) {
            $.ajax({
                url: "{{ route('save_contact') }}",
                type: "POST",
                data: $('#contact_form').serialize(),
                beforeSend:function(){
                    $('#contact_form button[type="submit"]').attr('disabled');
                    $('#contact_form button[type="submit"]').html('Processing...');
                },
                success: function(res) {
                    console.log(res)
                    $('#contact_form button[type="submit"]').removeAttr('disabled');
                    $('#contact_form button[type="submit"]').html('Request Info');
                    if(res == 'true')
                    {
                        $('#contact_form')[0].reset();
                        swal('Success', 'Your message has been sent succesfully!', 'success');
                    }
                },error:function(xhr){
                    console.log(xhr.responseText);
                   }
                });
             }
        });
    })
</script>
@endsection
