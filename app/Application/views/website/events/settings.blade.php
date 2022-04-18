@extends(layoutEvents())
@section('title')
    {{ trans('eventsdata.Events Dashboard') }} | {{ trans('eventsdata.Settings') }}
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
            <h3 class="panel-title">{{ trans('eventsdata.Settings') }}</h3>
        </div>
        <div class="panel-body">

          <form action="{{ concatenateLangToUrl('eventsdata/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

                <div class="form-group  {{  $errors->has("name.en")  &&  $errors->has("name.ar")  ? "has-error" : "" }}" >
                  <label for="name">{{ trans("eventsdata.name")}}</label>
                  {!! extractFiled(isset($item) ? $item : null , "name", isset($item->name) ? $item->name : old("name") , "text" , "eventsdata") !!}
                </div>
              @if ($errors->has("name.en"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("name.en") }}</strong>
                </span>
                </div>
              @endif
              @if ($errors->has("name.ar"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("name.ar") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("email") ? "has-error" : "" }}" > 
              <label for="email">{{ trans("eventsdata.email")}}</label>
                <input type="text" name="email" class="form-control" id="email" value="{{ isset($item->email) ? $item->email : old("email") }}"  placeholder="{{ trans("eventsdata.email")}}">
              </div>
              @if ($errors->has("email"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("email") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("logo") ? "has-error" : "" }}" > 
              <label for="logo">{{ trans("eventsdata.logo")}}</label>
                @if(isset($item) && $item->logo != "")
                <br>
                <img src="{{ small($item->logo) }}" class="thumbnail" alt="" width="200">
                <br>
                @endif
                <input type="file" name="logo" >
              </div>
              @if ($errors->has("logo"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("logo") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("website") ? "has-error" : "" }}" > 
              <label for="website">{{ trans("eventsdata.website")}}</label>
                <input type="text" name="website" class="form-control" id="website" value="{{ isset($item->website) ? $item->website : old("website") }}"  placeholder="{{ trans("eventsdata.website")}}">
              </div>
              @if ($errors->has("website"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("website") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("phone") ? "has-error" : "" }}" > 
              <label for="phone">{{ trans("eventsdata.phone")}}</label>
                <input type="number" name="phone" class="form-control" id="phone" value="{{ isset($item->phone) ? $item->phone : old("phone") }}"  placeholder="{{ trans("eventsdata.phone")}}">
              </div>
              @if ($errors->has("phone"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("phone") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group  {{  $errors->has("about.en")  &&  $errors->has("about.ar")  ? "has-error" : "" }}" >
              <label for="about">{{ trans("eventsdata.about")}}</label>
                <input type="text" name="about" class="form-control" id="about" value="{{ isset($item->about) ? $item->about : old("about") }}"  placeholder="{{ trans("eventsdata.about")}}">
              </div>
              @if ($errors->has("about.en"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("about.en") }}</strong>
                </span>
                </div>
              @endif
              @if ($errors->has("about.ar"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("about.ar") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("documentation") ? "has-error" : "" }}" > 
                <label for="documentation">{{ trans("eventsdata.documentation")}}</label>
                 @isset($item)
                        @if(json_decode($item->documentation))
                          <input type="hidden" name="oldFiles_documentation" value="{{ $item->documentation }}">
                          @php $documentation = returnFilesImages($item , "documentation"); @endphp
                          <div class="row text-center">
                            @foreach($documentation["image"] as $jsonimage )
                              <div class="col-lg-2 text-center"><img src="{{ small($jsonimage) }}" class="img-responsive" /><br>
                              <a class="btn btn-danger" onclick="deleteThisItem(this)" data-link="{{ url("deleteFile/eventsdata/".$item->id."?name=".$jsonimage."&filed_name=documentation") }}"><i class="fa fa-trash"></i></a></div>
                            @endforeach
                          </div>
                          <div class="row text-center">
                            @foreach($documentation["file"] as $jsonimage )
                              <div class="col-lg-2 text-center"><a href="{{ url(env("UPLOAD_PATH")."/".$jsonimage) }}" ><i class="fa fa-file"></i></a>
                              <span  onclick="deleteThisItem(this)" data-link="{{ url("deleteFile/eventsdata/".$item->id."?name=".$jsonimage."&filed_name=documentation") }}"><i class="fa fa-trash"></i> {{ $jsonimage }} </span></div>
                            @endforeach
                          </div>
                        @endif
                      @endisset
                 <input type="file" name="documentation[]" multiple>
              </div>
                @if ($errors->has("documentation"))
                 <div class="alert alert-danger">
                  <span class='help-block'>
                   <strong>{{ $errors->first("documentation") }}</strong>
                  </span>
                 </div>
                @endif
              
              
              
              


             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.eventsdata') }}
                </button>
            </div>
          </form>



        </div>
    </div>

@endsection