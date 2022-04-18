@extends(layoutExtend())

@section('title')
    {{ trans('partners.partners') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('partners.partners') , 'model' => 'partners' , 'action' => trans('home.view')  ])
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("partners.title") }}</th>
					<td>{{ nl2br($item->title_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("partners.description") }}</th>
					<td>{{ nl2br($item->description_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("partners.logo") }}</th>
					<td>
					<img src="{{ small($item->logo) }}" width="100" />
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("partners.seo_desc") }}</th>
					<td><span class="label label-default">{!! json_decode($item->seo_desc) ? implode("</span> <br> <span class='label label-default'>" , json_decode($item->seo_desc)) : "" !!}</span></td> 
								</tr>
				<tr>
				<th width="200">{{ trans("partners.seo_keys") }}</th>
					<td><span class="label label-default">{!! json_decode($item->seo_keys) ? implode("</span> <br> <span class='label label-default'>" , json_decode($item->seo_keys)) : "" !!}</span></td> 
								</tr>
				<tr>
				<th width="200">{{ trans("partners.search_keys") }}</th>
					<td><span class="label label-default">{!! json_decode($item->search_keys) ? implode("</span> <br> <span class='label label-default'>" , json_decode($item->search_keys)) : "" !!}</span></td> 
								</tr>
		</table>

        @include('admin.partners.buttons.delete' , ['id' => $item->id])
        @include('admin.partners.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
