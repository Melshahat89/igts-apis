@extends(layoutBusiness())
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.Groups') }}
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
            <h3 class="panel-title">Edit Input Field</h3>
        </div>
        <div class="panel-body">
            <form action="{{ concatenateLangToUrl('business/updateInputField/' . $inputField->id) }}" method="post" enctype="multipart/form-data">
            
                {{ csrf_field() }}
                <ul class="list-unstyled activity-timeline">
                    
                    <li>
                        <span class="activity-icon">1</span>
                        <div>
                            <h4>Field Name</h4>
                            <input type="text" name="name" class="form-control" placeholder="General Group" value="{{ $inputField->field_name }}">
                        </div>
                    </li>

                    <li>
										<span class="activity-icon">2</span>
										<div>
                                            <h4>Make Mandatory?</h4>


                                            <div class="checkbox">
          <label>
              <input id="mandatory" name="mandatory" type="checkbox" {{ ($inputField->mandatory == 1)?'checked':'' }} data-toggle="toggle" data-width="105" data-height="50">
          </label>
          </div>
                                            

											<div class="clear"></div>
										</div>
									</li>

                </ul>

                <input type="hidden" name="inputfield_id" value="{{$inputField->id}}">

                <div class="flexRight mt-40">
                    <button type="submit" class="btn btn-primary btn-lg">{{ trans('website.Finish') }}</button>
                </div>
            </form>



        </div>
    </div>

@endsection
