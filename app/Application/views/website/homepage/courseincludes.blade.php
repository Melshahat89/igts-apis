<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('courseincludes') }}</h2>
<hr>
@php $sidebarCourseincludes = \App\Application\Model\Courseincludes::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCourseincludes) > 0)
			@foreach ($sidebarCourseincludes as $d)
				 <div>
					<h2 > {{ str_limit($d->position , 50) }}</h2 > 
					 <p><a href="{{ url("courseincludes/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			