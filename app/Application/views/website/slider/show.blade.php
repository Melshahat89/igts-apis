@extends(layoutExtend('website'))

@section('title')
    {{ trans('slider.slider') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('slider') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("slider.title") }}</th>
					<td>{{ nl2br($item->title_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("slider.description") }}</th>
					<td>{{ nl2br($item->description_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("slider.image_m_ar") }}</th>
					<td>
					<img src="{{ small($item->image_m_ar) }}" width="100" />
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("slider.image_m_en") }}</th>
					<td>
					<img src="{{ small($item->image_m_en) }}" width="100" />
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("slider.image_d_ar") }}</th>
					<td>
					<img src="{{ small($item->image_d_ar) }}" width="100" />
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("slider.image_d_en") }}</th>
					<td>
					<img src="{{ small($item->image_d_en) }}" width="100" />
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("slider.status") }}</th>
					<td>
				{{ $item->status == 1 ? trans("slider.Yes") : trans("slider.No")  }}
					</td>
				</tr>
		</table>

        @include('website.slider.buttons.delete' , ['id' => $item->id])
        @include('website.slider.buttons.edit' , ['id' => $item->id])
</div>
@endsection
