@extends(layoutExtend('website'))
 @section('title')
    {{ trans('masterrequest.masterrequest') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('masterrequest') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('masterrequest/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.masterrequest.relation.courses.edit")
            @include("website.masterrequest.relation.user.edit")
                <div class="form-group {{ $errors->has("qualification") ? "has-error" : "" }}" > 
                  <label for="qualification">{{ trans("masterrequest.qualification")}}</label>
                  @if(isset($item) && $item->qualification != "")
                  <br>
                  <img src="{{ small($item->qualification) }}" class="thumbnail" alt="" width="200">
                  <br>
                  @endif
                <input type="file" name="qualification" >
              </div>
              @if ($errors->has("qualification"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("qualification") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("collage_name") ? "has-error" : "" }}" > 
              <label for="collage_name">{{ trans("masterrequest.collage_name")}}</label>
                <input type="text" name="collage_name" class="form-control" id="collage_name" value="{{ isset($item->collage_name) ? $item->collage_name : old("collage_name") }}"  placeholder="{{ trans("masterrequest.collage_name")}}">
              </div>
              @if ($errors->has("collage_name"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("collage_name") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("section") ? "has-error" : "" }}" > 
              <label for="section">{{ trans("masterrequest.section")}}</label>
                <input type="text" name="section" class="form-control" id="section" value="{{ isset($item->section) ? $item->section : old("section") }}"  placeholder="{{ trans("masterrequest.section")}}">
              </div>
              @if ($errors->has("section"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("section") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("g_year") ? "has-error" : "" }}" > 
              <label for="g_year">{{ trans("masterrequest.g_year")}}</label>
                <input type="text" name="g_year" class="form-control" id="g_year" value="{{ isset($item->g_year) ? $item->g_year : old("g_year") }}"  placeholder="{{ trans("masterrequest.g_year")}}">
              </div>
              @if ($errors->has("g_year"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("g_year") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("address") ? "has-error" : "" }}" > 
              <label for="address">{{ trans("masterrequest.address")}}</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ isset($item->address) ? $item->address : old("address") }}"  placeholder="{{ trans("masterrequest.address")}}">
              </div>
              @if ($errors->has("address"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("address") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("documentation[]") ? "has-error" : "" }}" > 
              <label for="documentation">{{ trans("masterrequest.documentation")}}</label>
                <div id="laraflat-documentation">
                @isset($item)
                  @if(json_decode($item->documentation))
                  <input type="hidden" name="oldFiles_documentation" value="{{ $item->documentation }}">
                  @php $files = returnFilesImages($item , "documentation"); @endphp
                  <div class="row text-center">
                  @foreach($files["image"] as $jsonimage )
                    <div class="col-lg-2 text-center"><img src="{{ small($jsonimage) }}" class="img-responsive" /><br>
                    <a class="btn btn-danger" onclick="deleteThisItem(this)" data-link="{{ url("deleteFile/masterrequest/".$item->id."?name=".$jsonimage."&filed_name=documentation") }}"><i class="fa fa-trash"></i></a></div>
                  @endforeach
                  </div>
                  <div class="row text-center">
                  @foreach($files["file"] as $jsonimage )
                    <div class="col-lg-2 text-center"><a href="{{ url(env("UPLOAD_PATH")."/".$jsonimage) }}" ><i class="fa fa-file"></i></a>
                    <span  onclick="deleteThisItem(this)" data-link="{{ url("deleteFile/masterrequest/".$item->id."?name=".$jsonimage."&filed_name=documentation") }}"><i class="fa fa-trash"></i> {{ $jsonimage }} </span></div>
                  @endforeach
                </div>
                  @endif
                @endisset
                  <input name="documentation[]"  type="file" multiple >
                </div>
              </div>
              @if ($errors->has("documentation[]"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("documentation[]") }}</strong>
                </span>
                </div>
              @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.masterrequest') }}
                </button>
            </div>
        </form>
</div>
@endsection
