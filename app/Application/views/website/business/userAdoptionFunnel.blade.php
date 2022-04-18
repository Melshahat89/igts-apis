@extends(layoutBusiness())
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.User Adoption Funnel') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')



					<!-- HomePage -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title m-0">User Adoption Funnel</h3>
						</div>
						<div class="panel-body">

							<div class="row brdr-top brdr-bottom ptm-20 m-0">
								<div class="flexCenter col-md-6">
									<span class="mr-15">Filter</span>
									<select class="form-control">
										<option value="Users">All Users</option>
										<option value="Lorem1">Lorem Ipsum</option>
										<option value="Lorem2">Lorem Ipsum</option>
										<option value="Lorem3">Lorem Ipsum</option>
									</select>
								</div>
							</div>
							
							<span class="dividar-grey"></span>
							<div class="row">
								<div class="col-md-4">
									<div class="data-block mt-30 flexBetween">
										<div class="">
										<h3>{{ trans('businessdata.Enrollments') }}</h3>
										</div>
										<div class="">
										<h2>{{ $businessdata->CoutEnrollments }}</h2>
										<p>{{ trans('businessdata.enrollment') }}</p>
									</div>
										<div class="clearfix"></div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="data-block mt-30 flexBetween">
										<div class="">
										<h3>{{ trans('businessdata.Licenses') }}</h3>
										</div>
										<div class="">
										<h2>{{ $businessdata->licenses }}</h2>
                            				<p> {{ trans('businessdata.Licenses') }}</p>  
										</div>
										<div class="clearfix"></div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="data-block mt-30 flexBetween">
										<div class="">
										<h3>{{ trans('businessdata.Organization adoption') }}</h3>
										</div>
										<div class="">
										<h2> {{ ($businessdata->licenses > 0)?(($businessdata->CoutUsers/$businessdata->licenses) *100):0 }} %</h2>
                            <p>{{ trans('businessdata.Organization adoption') }}</p>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>


							<div class="mt-40">
								<div id="multiple-chart" class="ct-chart" style="display: none;"></div>
							</div>

							<div class="row">
								<div class="col-md-6 mt-30">
									<div class="card-content">
									<h3 class="color-green"><span>{{ ($businessdata->licenses - $businessdata->CoutUsers) }}</span> {{ trans('businessdata.Licenses Available') }} </h3>
										<p class="mt-15">
										</p>
									</div>
								</div>

								<div class="col-md-6 mt-30">
									<div class="card-content">
									<h3 class="color-red"><span>{{ $businessdata->CoutUsers }}</span> {{ trans('businessdata.Licenses Used') }}  </h3>
										<p class="mt-15">
										</p>
									</div>
								</div>

								<div class="col-md-6 mt-30">
									<div class="card-content">
									<h3 class="color-orange"><span>{{ ($businessdata->CountUsersCertificates) }}</span> {{ trans('businessdata.Issued Certificates') }} </h3>
										<p class="mt-15">
										</p>
									</div>
								</div>

								<div class="col-md-6 mt-30">
									<div class="card-content">
									<h3 class="color-oil"><span>{{ ($businessdata->CountUsersPassedExams) }}</span> {{ trans('businessdata.Passed Exams') }}</h3>
										<p class="mt-15">
										</p>
									</div>
								</div>
							</div>
							
							
						</div>
						</div>
					</div>
					<!-- END HomePage -->
				

    <!-- <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('businessdata.User Adoption Funnel') }}</h3>
        </div>

        <div class="panel-body">

        
            <span class="dividar-grey"></span>
            <div class="row">
                <div class="col-md-4">
                    <div class="data-block mt-30 flexBetween">
                        <div class="">
                            <h3>{{ trans('businessdata.Enrollments') }}</h3>
                        </div>
                        <div class="">
                            <h2>{{ $businessdata->CoutEnrollments }}</h2>
                            <p>{{ trans('businessdata.enrollment') }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="data-block mt-30 flexBetween">
                        <div class="">
                            <h3>{{ trans('businessdata.Licenses') }}</h3>
                        </div>
                        <div class="">
                            <h2>{{ $businessdata->licenses }}</h2>
                            <p> {{ trans('businessdata.Licenses') }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="data-block mt-30 flexBetween">
                        <div class="">
                            <h3>{{ trans('businessdata.Organization adoption') }}</h3>
                        </div>
                        <div class="">
                            <h2> {{ ($businessdata->licenses > 0)?(($businessdata->CoutUsers/$businessdata->licenses) *100):0 }} %</h2>
                            <p>{{ trans('businessdata.Organization adoption') }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <div class="mt-40">
                <div id="multiple-chart" class="ct-chart"></div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-30">
                    <div class="card-content">
                        <h3 class="color-green"><span>{{ ($businessdata->licenses - $businessdata->CoutUsers) }}</span> {{ trans('businessdata.Licenses Available') }} </h3>
                        <p class="mt-15">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mt-30">
                    <div class="card-content">
                        <h3 class="color-red"><span>{{ ($businessdata->licenses - $businessdata->CoutUsers) }}</span> Drop off  </h3>
                        <p class="mt-15">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mt-30">
                    <div class="card-content">
                        <h3 class="color-orange"><span>{{ ($businessdata->CountUsersEnrollmented) }}</span>  {{ trans('businessdata.Joined') }} </h3>
                        <p class="mt-15">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mt-30">
                    <div class="card-content">
                        <h3 class="color-oil"><span>{{ ($businessdata->licenses - $businessdata->CountUsersEnrollmented) }}</span> {{ trans('businessdata.Not Joined') }} </h3>
                        <p class="mt-15">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                        </p>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div> -->
@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{ asset('public/landing') }}/js/chartist/js/chartist.js"></script>


<script>
		$(function() {
			var options;
	
			
	
			// multiple chart
			var data = {
				labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				series: [{
					name: 'series-real',
					data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
				}, {
					name: 'series-projection',
					data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
				},{
					name: 'series-projection',
					data: [280, 300, 160, 150, 600, 850, 280, 523, 555, 600, 700, 800],
				}
				]
			};
	
			var options = {
				fullWidth: true,
				lineSmooth: false,
				height: "400px",
				low: 0,
				high: 'auto',
				series: {
					'series-projection': {
						showArea: true,
						showPoint: false,
						showLine: false
					},
				},
				axisX: {
					showGrid: false,
	
				},
				axisY: {
					showGrid: false,
					onlyInteger: true,
					offset: 0,
				},
				chartPadding: {
					left: 20,
					right: 20
				}
			};
	
			new Chartist.Line('#multiple-chart', data, options);
	
		});
		</script>