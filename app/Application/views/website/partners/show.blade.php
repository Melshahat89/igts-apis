@extends(layoutExtend('website'))

@section('title')
    {{ trans('partners.partners') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('partners') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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

        @include('website.partners.buttons.delete' , ['id' => $item->id])
        @include('website.partners.buttons.edit' , ['id' => $item->id])
</div>
@endsection
