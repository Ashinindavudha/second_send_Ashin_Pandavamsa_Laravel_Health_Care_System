@extends('user.template.app')
@section('style')
<link rel="stylesheet" href="{{ asset('medicare2/css/jquery.dataTables.min.css') }}">
@endsection
@section('content')

<section class="features_area section_gap">
	<div class="container">
		<div class="row">
			<!-- single feature -->
			<div class="col-lg-4 col-md-6">
				<div class="single_feature">
					<div class="feature_head">
						<img src="{{ asset('medicare2/img/features/icon1.png') }}" alt="">
						<h4>Emergency Services</h4>
					</div>
					<div class="feature_content">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
						dolore magna aliqua. Ut enim ad minim veniam.</p>
						<div class="feature_btn">
							<a href="#" class="f_btn">Call Us: 215 - 3695 - 9584</a>
						</div>
					</div>
				</div>
			</div>
			<!-- single feature -->
			<div class="col-lg-4 col-md-6">
				<div class="single_feature">
					<div class="feature_head">
						<img src="{{ asset('medicare2/img/features/icon2.png') }}" alt="">
						<h4>Doctors Schedule</h4>
					</div>
					<div class="feature_content">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
						dolore magna aliqua. Ut enim ad minim veniam.</p>
						<div class="feature_btn">
							<a href="#" class="f_btn">Learn More</a>
						</div>
					</div>
				</div>
			</div>
			<!-- single feature -->
			<div class="col-lg-4 col-md-6">
				<div class="single_feature">
					<div class="feature_head">
						<img src="{{ asset('medicare2/img/features/icon3.png') }}" alt="">
						<h4>Online Appointment</h4>
					</div>
					<div class="feature_content">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
						dolore magna aliqua. Ut enim ad minim veniam.</p>
						<div class="feature_btn">
							<a href="#" class="f_btn">Get Appointment</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--================ End Features Area =================-->
<!--================ Start About Area =================-->
<section class="about_area lite_bg">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-5 col-md-5">
				<div class="about_details lite_bg">
					<h2>Welcome to Medicare Center</h2>
					<p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards
					especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach.</p>
					<ul class="list_wrap">
						<li class="about_lists">Women face higher conduct standards especially in the workplace that’s why it’s crucial
						that.</li>
						<li class="about_lists">Women face higher conduct standards especially in the workplace that’s why it’s crucial
						that.</li>
						<li class="about_lists">Women face higher conduct standards especially in the workplace that’s why it’s crucial
						that.</li>
					</ul>
				</div>
			</div>
			
			<div class="about_bg overlay"></div>
		</div>
	</section>
	<!--================ End About Area =================-->

	<div class="container mt-5">
		<div class="row">
			<table id="dt-basic-checkbox" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th></th>
						<th class="th-sm">Doctor Name
						</th>
						<th class="th-sm">Specialist
						</th>
						<th class="th-sm">Duty Day
						</th>
						<th class="th-sm">Duty Time
						</th>
						<th class="th-sm">Phone
						</th>
						<th class="th-sm">Email
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($physicians as $physician)
					<tr>
						<td></td>
						<td>{{ $physician->name }}</td>
						<td>
							@foreach($physician->diseases as $key => $item)
							<span class="badge badge-info">{{ $item->name }}</span>
							@endforeach
						</td>
						<td>{{ $physician->duty_day }}</td>
						<td>{{ $physician->duty_time }}</td>
						<td>{{ $physician->phone }}</td>
						<td>{{ $physician->email }}</td>
					</tr>
					@endforeach
				</tbody>

				<tfoot>
					<tr>
						<th>Name
						</th>
						<th class="th-sm">Doctor Name
						</th>
						<th class="th-sm">Specialist
						</th>
						<th class="th-sm">Duty Day
						</th>
						<th class="th-sm">Duty Time
						</th>
						<th class="th-sm">Phone
						</th>
						<th class="th-sm">Email
						</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!--================ Start Team Area =================-->
	<section class="section_gap team_area lite_bg">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7">
					<div class="main_title">
						<h2 class="badge badge-dark">Medicare Popular Departments</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							magna aliqua.</p>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach($post_informations as $information)
				<div class="col-lg-3 col-sm-6">
					
					<div class="single_member">
						<div class="author">
							@if($information->logo)
                            <a href="{{ $information->logo->getUrl() }}" target="_blank">
                                <img src="{{ $information->logo->getUrl('thumb') }}" width="200px" height="200px">
                            </a>
                            @endif

						</div>
						<div class="author_decs">
							<div class="social_icons">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
							</div>
							<h5>{{ $information->doctor->name }}</h5><hr>
							
							<a href="{{ route('postshows.show', $information->id) }}" class="btn btn-primary">Read More</a>
						</div>
					</div>
				</div>
					@endforeach

				
			</div>
		</div>
	</section>
	<!--================ End Team Area =================-->
	</div>
	@endsection('content')
	@section('js')
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
	<script src="{{ asset('medicare2/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript">
		$('#dt-basic-checkbox').dataTable({

			columnDefs: [{
				orderable: false,
				className: 'select-checkbox',
				targets: 0
			}],
			select: {
				style: 'os',
				selector: 'td:first-child'
			}
		});
	</script>
	@stop