<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('categories') }}</h2>
<hr>
@php $sidebarCategories = \App\Application\Model\Categories::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCategories) > 0)
			@foreach ($sidebarCategories as $d)
				 <div>
					<h2 > {{ str_limit($d->name_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->slug , 300) }}</p > 
					<p> {{ str_limit($d->desc_lang , 300) }}</p > 
					 <p><a href="{{ url("categories/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			