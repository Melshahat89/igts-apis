@extends(layoutExtend())
  @section('title')
    {{ trans('masterrequest.masterrequest') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('masterrequest.masterrequest') , 'model' => 'masterrequest' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("masterrequest.qualification") }}</th>
     <td>
     <img src="{{ small($item->qualification) }}" width="100" />
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("masterrequest.collage_name") }}</th>
     <td>{{ nl2br($item->collage_name) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("masterrequest.section") }}</th>
     <td>{{ nl2br($item->section) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("masterrequest.g_year") }}</th>
     <td>{{ nl2br($item->g_year) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("masterrequest.address") }}</th>
     <td>{{ nl2br($item->address) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("masterrequest.documentation") }}</th>
     <td>
     @isset($item)
      @if(json_decode($item->documentation))
       <input type="hidden" name="oldFiles_documentation" value="{{ $item->documentation }}">
       @php $files = returnFilesImages($item , "documentation"); @endphp
       <div class="row text-center">
       @foreach($files["image"] as $jsonimage )
        <div class="col-lg-2 text-center"><img src="{{ small($jsonimage) }}" width="100"  /><br>
        <span class="btn btn-danger" onclick="deleteThisItem(this)" data-link="{{ url("deleteFile/masterrequest/".$item->id."?name=".$jsonimage."&filed_name=documentation") }}"><i class="fa fa-trash"></i></span></div>
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
     </td>
    </tr>
  </table>
          @include('admin.masterrequest.buttons.delete' , ['id' => $item->id])
        @include('admin.masterrequest.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
