@extends(layoutBusiness())
@section('title')
  {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.Settings') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')
<div class="panel panel-headline">
  <div class="panel-heading">
    <h3 class="panel-title">{{ trans('businessdata.Verify Your Business Domain') }}</h3>
  </div>
  <div class="panel-body">
    <form action="{{ concatenateLangToUrl('business/addDomian') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="input-group">
        <span class="input-group-addon">@</span>
        <input class="form-control" type="text" name="domainname">
        
      </div>
      @if ($errors->has("domainname"))
          <div class="alert alert-danger">
          <span class='help-block'>
            <strong>{{ $errors->first("domainname") }}</strong>
          </span>
          </div>
        @endif
      <br>
      <div class="flexRight">
        <button type="submit" class="btn btn-primary btn-lg">{{ trans('website.Submit') }}</button>
      </div>
    </form>
    <span class="dividar-grey mt-30 mb-30"></span>
    <div>
      <h3>{{ trans('businessdata.Allow Your Domain Users To Automatically Receive A License After Registration') }}</h3>
      <div class="flexRight">
        <div class="checkbox">
          <label>
            <form id="toggle" action="{{ concatenateLangToUrl('business/settings') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input id="automatically_license" name="automatically_license" type="checkbox" {{ ($businessdata->automatically_license == 1)?'checked':'' }}   data-toggle="toggle" data-width="105" data-height="50">
            </form>
          </label>
          </div>
      </div>
    </div>

    <span class="dividar-grey mt-30 mb-30"></span>

    <p>{{ trans('businessdata.verify-hint') }}</p>
    <div class="panel-heading">
      <h3 class="panel-title m-0">{{ trans('businessdata.Domains') }}</h3>
    </div>

    <span class="dividar-grey"></span>
							<div class="table-res-scroll">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>ID</th>
											<th valign="center">{{ trans('businessdata.Domain Name') }}</th>
											<th>Verify</th>
											<th class="flexRight"></th>
										</tr>
									</thead>
									<tbody>
                    @isset($domains)
                      @foreach($domains as $key => $domain)
                      <tr>
                        <td>
                          <label class="fancy-checkbox">
                            <span>{{ $key }}</span>
                          </label>
                        </td>
                        <td>{{ $domain->domainname }}</td>
                        <td class="">
                          @if($domain->status == 1)
                          <a type="button" href="{{ url('businessdomains/'.$domain->id.'/delete') }}" class="btn btn-success mr-15">{{ trans('businessdata.Verified') }}</a>
                          @else
                          <a type="button" href="{{ url('businessdomains/'.$domain->id.'/verify') }}" class="btn btn-warning mr-15">{{ trans('businessdata.Unverified') }}</a>
                          @endif
                        </td>
                        <td class="flexRight">
                          <a type="button" href="{{ url('businessdomains/'.$domain->id.'/delete') }}" class="btn btn-danger mr-15"><i class="lnr lnr-trash"></i></a>
                        </td>
                      </tr>
                      @endforeach
                      
                    @endisset
										
									</tbody>
						    </table>
              </div>
              <span class="dividar-grey mt-30 mb-30"></span>

              <div class="panel-heading">
                <h3 class="panel-title m-0">{{ trans('courses.courses') }}</h3>
              </div>
          
              <span class="dividar-grey"></span>
                        <div class="table-res-scroll">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th valign="center">{{ trans('businessdata.Course Name') }}</th>
                                
                                
                              </tr>
                            </thead>
                            <tbody>
                              @isset($businesscourses)
                                @foreach($businesscourses as $key => $course)
                                <tr>
                                  <td>
                                    <label class="fancy-checkbox">
                                    
                                      <span>{{ $key }}</span>
                                    </label>
                                  </td>
                                  <td>{{ $course->courses['title_lang'] }}</td>
                                  
                                </tr>
                                @endforeach
                                
                              @endisset
                              
                            </tbody>
                          </table>
                        </div>


  </div>
  </div>




  <div class="panel panel-headline">
  <div class="panel-heading">
    <h3 class="panel-title">{{ trans('businessdata.Customize Your Users Information') }}</h3>
  </div>
  <div class="panel-body">

  <form action="{{ concatenateLangToUrl('business/inputs') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul class="list-unstyled activity-timeline">
                    <li>
                        <span class="activity-icon">1</span>
                        <div>
                            <h4>{{ trans('businessdata.Input Field Name') }}</h4>
                            <input type="text" name="fieldName" class="form-control" placeholder="General Group">


                        </div>
                    </li>
                    

                    <li>
										<span class="activity-icon">2</span>
										<div>
                                            <h4>{{ trans('businessdata.Make Mandatory') }}</h4>


                                            <div class="checkbox">
          <label>
              <input id="mandatory" name="mandatory" type="checkbox" data-toggle="toggle" data-width="105" data-height="50">
          </label>
          </div>

          <input type="hidden" name="businessdata_id" value="{{$businessdata->id}}">
                                            

											<div class="clear"></div>
										</div>
									</li>

                </ul>

                <div class="flexRight mt-40">
                    <button type="submit" class="btn btn-primary btn-lg">{{ trans('businessdata.add') }}</button>
                </div>
            </form>


            <span class="dividar-grey mt-30 mb-30"></span>

<div class="panel-heading">
    <h3 class="panel-title m-0">{{ trans('businessdata.Custom Input Fields') }}</h3>
</div>

<span class="dividar-grey"></span>

@isset($inputFields)
    <div class="table-res-scroll">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th valign="center">Field Name</th>
                    <th>Mandatory</th>

                    <th class="flexRight">

                        <!-- <button type="button" class="btn btn-danger mr-15"><i class="lnr lnr-trash"></i></button> -->

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inputFields as $input)
                    <tr>
                        <td>
                            <label class="fancy-checkbox">

                                <span>{{ $input->id }}</span>
                            </label>
                        </td>
                        <td>{{ $input->field_name }}</td>
                        <td>
                        {{ ($input->mandatory == 0) ? 'No' : 'Yes' }}
                        </td>

                        <td class="flexRight">
                            <a type="button" href="{{ url('business/deleteinputfield/' . $input->id) }}"
                                class="btn btn-danger mr-15"><i class="lnr lnr-trash"></i></a>
                                <a type="button" href="{{ url('business/editinputfield/' . $input->id) }}"
                                class="btn btn-success mr-15"><i class="lnr lnr-pencil"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endisset


  </div>
  </div>

  <div class="panel panel-headline">
  <div class="panel-heading">
    <h3 class="panel-title">{{ trans('businessdata.Brand your courses page') }}</h3>
  </div>
  <div class="panel-body">

  <form action="{{ concatenateLangToUrl('businessdata/' . $businessdata->id . '/update') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul class="list-unstyled activity-timeline">
                    <li>
                        <span class="activity-icon">1</span>
                        <div>
                            <h4>Upload your banner: Recommended Resolution is (1100px * 370px)</h4>
                            <span class="control-fileupload">
                                <label for="banner">Choose your banner</label>
                                <input name="banner" type="file" id="banner" accept=".png,.jpg,.jpeg, .webp">
                            </span>

                            <img src="{{ url(env('UPLOAD_PATH') . '/' . $businessdata->banner) }}" style="padding-top: 20px; width: 100%;">

                        </div>

                    </li>
                    

            

                </ul>


                <div class="flexRight mt-40">
                    <button type="submit" class="btn btn-primary btn-lg">{{ trans('businessdata.add') }}</button>
                </div>
            </form>




  </div>
  </div>



@endsection
@push('js')
<script>
  $(document).ready(
    function()
    {
        $("#automatically_license").change(
            function()
            {
             $("#toggle").submit();
            }
        )
    }
);
</script>

@endpush