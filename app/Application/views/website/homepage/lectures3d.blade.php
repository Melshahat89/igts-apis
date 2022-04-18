<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('lectures3d') }}</h2>
<hr>
@php $sidebarLectures3d = \App\Application\Model\Lectures3d::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarLectures3d) > 0)
			@foreach ($sidebarLectures3d as $d)
				 <div>
					<h2 > {{ str_limit($d->title , 50) }}</h2 > 
					<p> {{ str_limit($d->link , 300) }}</p > 
					 <p><a href="{{ url("lectures3d/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			