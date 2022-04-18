@extends(layoutExtend('website'))
  @section('title')
    {{ trans('talks.talks') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('talks') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("talks.title") }}</th>
     <td>{{ nl2br($item->title_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.slug") }}</th>
     <td>{{ nl2br($item->slug) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.subtitle") }}</th>
     <td>{{ nl2br($item->subtitle_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.description") }}</th>
     <td>{{ nl2br($item->description_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.language_id") }}</th>
     <td>{{ nl2br($item->language_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.length") }}</th>
     <td>{{ nl2br($item->length) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.featured") }}</th>
     <td>
    {{ $item->featured == 1 ? trans("talks.Yes") : trans("talks.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.published") }}</th>
     <td>
    {{ $item->published == 1 ? trans("talks.Yes") : trans("talks.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.visits") }}</th>
     <td>{{ nl2br($item->visits) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.video_file") }}</th>
     <td>{{ nl2br($item->video_file) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.sort") }}</th>
     <td>{{ nl2br($item->sort) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.doctor_name") }}</th>
     <td>{{ nl2br($item->doctor_name_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.seo_desc") }}</th>
     <td><span class="label label-default">{!! json_decode($item->seo_desc) ? implode("</span> <br> <span class='label label-default'>" , json_decode($item->seo_desc)) : "" !!}</span></td> 
        </tr>
    <tr>
    <th width="200">{{ trans("talks.seo_keys") }}</th>
     <td><span class="label label-default">{!! json_decode($item->seo_keys) ? implode("</span> <br> <span class='label label-default'>" , json_decode($item->seo_keys)) : "" !!}</span></td> 
        </tr>
    <tr>
    <th width="200">{{ trans("talks.search_keys") }}</th>
     <td><span class="label label-default">{!! json_decode($item->search_keys) ? implode("</span> <br> <span class='label label-default'>" , json_decode($item->search_keys)) : "" !!}</span></td> 
        </tr>
    <tr>
    <th width="200">{{ trans("talks.image") }}</th>
     <td>
     <img src="{{ small($item->image) }}" width="100" />
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.promoPoster") }}</th>
     <td>
     <img src="{{ small($item->promoPoster) }}" width="100" />
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("talks.cover") }}</th>
     <td>
     <img src="{{ small($item->cover) }}" width="100" />
     </td>
    </tr>
  </table>
          @include('website.talks.buttons.delete' , ['id' => $item->id])
        @include('website.talks.buttons.edit' , ['id' => $item->id])
</div>
@endsection
