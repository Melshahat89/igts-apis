@extends(layoutExtend('website'))
@section('title')
    {{ trans('institution.Institution Dashboard') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection



@section('content')

    <div class="bread-crumb">
        <div class="container">
            <a href="/"> {{ trans('website.home') }} </a> > <span>{{ trans('institution.Institution Dashboard') }}</span>
        </div>
    </div>

    <div class="page-title general-gred">
        <div class="container">
            <h1>{{ trans('institution.Institution Dashboard') }}</h1>
            <p class="mt-15">
            </p>

        </div>
    </div>

    <i class="divid"></i>
    <div class="container">
      <div class="pull-{{ getDirection() }} col-lg-12">
          <table class="table table-bordered  table-striped">
              <tr>
                  <th width="200">{{ trans('masterrequest.qualification') }}</th>
                  <td>
                      <img src="{{ small($item->qualification) }}" width="100" />
                  </td>
              </tr>
              <tr>
                  <th width="200">{{ trans('masterrequest.collage_name') }}</th>
                  <td>{{ nl2br($item->collage_name) }}</td>
              </tr>
              <tr>
                  <th width="200">{{ trans('masterrequest.section') }}</th>
                  <td>{{ nl2br($item->section) }}</td>
              </tr>
              <tr>
                  <th width="200">{{ trans('masterrequest.g_year') }}</th>
                  <td>{{ nl2br($item->g_year) }}</td>
              </tr>
              <tr>
                  <th width="200">{{ trans('masterrequest.address') }}</th>
                  <td>{{ nl2br($item->address) }}</td>
              </tr>
              <tr>
                  <th width="200">{{ trans('masterrequest.documentation') }}</th>
                  <td>
                      @isset($item)
                          @if (json_decode($item->documentation))
                              <input type="hidden" name="oldFiles_documentation" value="{{ $item->documentation }}">
                              @php $files = returnFilesImages($item , "documentation"); @endphp
                              <div class="row text-center">
                                  @foreach ($files['image'] as $jsonimage)
                                      <div class="col-lg-2 text-center"><img src="{{ small($jsonimage) }}" width="100" /><br>
                                         
                                      </div>
                                  @endforeach
                              </div>
                              <div class="row text-center">
                                  @foreach ($files['file'] as $jsonimage)
                                      <div class="col-lg-2 text-center"><a
                                              href="{{ url(env('UPLOAD_PATH') . '/' . $jsonimage) }}"><i
                                                  class="fa fa-file"></i></a>
                                          
                                      </div>
                                  @endforeach
                              </div>
                          @endif
                      @endisset
                  </td>
              </tr>
          </table>
          <form action="{{ concatenateLangToUrl('masterrequest/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
              <label for="status">{{ trans("masterrequest.status")}}</label>
                <div class="form-check">
               <label class="form-check-label">
               <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
               {{ trans("masterrequest.no")}}
               </label > 
               <label class="form-check-label">
               <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
                {{ trans("masterrequest.yes")}}
               </label> 
                </div> 		
             </div>
              @if ($errors->has("status"))
               <div class="alert alert-danger">
                <span class='help-block'>
                 <strong>{{ $errors->first("status") }}</strong>
                </span>
               </div>
              @endif
            <div class="form-group">
              <button type="submit" name="submit" class="btn btn-success" >
                  <i class="fa fa-save"></i>
                  {{ trans('website.Update') }}  {{ trans('website.masterrequest') }}
              </button>
          </div>
      </form>
      </div>
  </div>
@endsection
