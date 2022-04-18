<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('businessgroups') }}</h2>
<hr>
@php $sidebarBusinessgroups = \App\Application\Model\Businessgroups::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarBusinessgroups) > 0)
			@foreach ($sidebarBusinessgroups as $d)
				 <div>
					<h2 > {{ str_limit($d->name , 50) }}</h2 > 
					<p> {{ str_limit($d->parent_id , 300) }}</p > 
					 <p><a href="{{ url("businessgroups/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			