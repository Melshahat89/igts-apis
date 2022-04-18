<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('faq') }}</h2>
<hr>
@php $sidebarFaq = \App\Application\Model\Faq::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarFaq) > 0)
			@foreach ($sidebarFaq as $d)
				 <div>
					<p><a href="{{ url("faq/".$d->id."/view") }}">{{ str_limit($d->group_id , 20) }}</a></p > 
					<p><a href="{{ url("faq/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			