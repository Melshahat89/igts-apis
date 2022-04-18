@extends(layoutExtend('website'))
  @section('title')
    {{ trans('courses.courses') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('courses') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("courses.title") }}</th>
     <td>{{ nl2br($item->title_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.slug") }}</th>
     <td>{{ nl2br($item->slug) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.description") }}</th>
     <td>{{ nl2br($item->description_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.welcome_message") }}</th>
     <td>{{ nl2br($item->welcome_message_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.congratulation_message") }}</th>
     <td>{{ nl2br($item->congratulation_message_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.type") }}</th>
     <td>{{ nl2br($item->type) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.skill_level") }}</th>
     <td>{{ nl2br($item->skill_level) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.language_id") }}</th>
     <td>{{ nl2br($item->language_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.has_captions") }}</th>
     <td>
    {{ $item->has_captions == 1 ? trans("courses.Yes") : trans("courses.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.has_certificate") }}</th>
     <td>
    {{ $item->has_certificate == 1 ? trans("courses.Yes") : trans("courses.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.length") }}</th>
     <td>{{ nl2br($item->length) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.price") }}</th>
     <td>{{ nl2br($item->price) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.price_in_dollar") }}</th>
     <td>{{ nl2br($item->price_in_dollar) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.affiliate1_per") }}</th>
     <td>{{ nl2br($item->affiliate1_per) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.affiliate2_per") }}</th>
     <td>{{ nl2br($item->affiliate2_per) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.affiliate3_per") }}</th>
     <td>{{ nl2br($item->affiliate3_per) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.affiliate4_per") }}</th>
     <td>{{ nl2br($item->affiliate4_per) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.instructor_per") }}</th>
     <td>{{ nl2br($item->instructor_per) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.discount_egp") }}</th>
     <td>{{ nl2br($item->discount_egp) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.discount_usd") }}</th>
     <td>{{ nl2br($item->discount_usd) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.featured") }}</th>
     <td>
    {{ $item->featured == 1 ? trans("courses.Yes") : trans("courses.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.image") }}</th>
     <td>
     <img src="{{ small($item->image) }}" width="100" />
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.promo_video") }}</th>
     <td>{{ nl2br($item->promo_video) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.visits") }}</th>
     <td>{{ nl2br($item->visits) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.published") }}</th>
     <td>
    {{ $item->published == 1 ? trans("courses.Yes") : trans("courses.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.position") }}</th>
     <td>{{ nl2br($item->position) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.sort") }}</th>
     <td>{{ nl2br($item->sort) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.doctor_name") }}</th>
     <td>{{ nl2br($item->doctor_name_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.full_access") }}</th>
     <td>
    {{ $item->full_access == 1 ? trans("courses.Yes") : trans("courses.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.access_time") }}</th>
     <td>{{ nl2br($item->access_time) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.soon") }}</th>
     <td>
    {{ $item->soon == 1 ? trans("courses.Yes") : trans("courses.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("courses.seo_desc") }}</th>
     <td><span class="label label-default">{!! json_decode($item->seo_desc) ? implode("</span> <br> <span class='label label-default'>" , json_decode($item->seo_desc)) : "" !!}</span></td> 
        </tr>
    <tr>
    <th width="200">{{ trans("courses.seo_keys") }}</th>
     <td><span class="label label-default">{!! json_decode($item->seo_keys) ? implode("</span> <br> <span class='label label-default'>" , json_decode($item->seo_keys)) : "" !!}</span></td> 
        </tr>
    <tr>
    <th width="200">{{ trans("courses.search_keys") }}</th>
     <td><span class="label label-default">{!! json_decode($item->search_keys) ? implode("</span> <br> <span class='label label-default'>" , json_decode($item->search_keys)) : "" !!}</span></td> 
        </tr>
    <tr>
    <th width="200">{{ trans("courses.poster") }}</th>
     <td>
     <img src="{{ small($item->poster) }}" width="100" />
     </td>
    </tr>
  </table>
          @include('website.courses.buttons.delete' , ['id' => $item->id])
        @include('website.courses.buttons.edit' , ['id' => $item->id])
</div>
@endsection
