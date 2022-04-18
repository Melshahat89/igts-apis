<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('categories') }}</h2>
<hr>
@php $sidebarCategories = \App\Application\Model\Categories::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCategories) > 0)
			@foreach ($sidebarCategories as $d)
				 <div>
					<a href="{{ url("categories/".$d->id."/view") }}" ><p>{{ str_limit($d->name_lang , 20) }}</a></p > 
					<p><a href="{{ url("categories/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			