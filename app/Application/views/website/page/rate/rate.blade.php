		@isset($item->id) 
		@php 
			 $rates = \App\Application\Model\PageRate::where("page_id" ,$item->id )->with("user")->get(); 
			 $rateBefore = \App\Application\Model\PageRate::where("page_id" ,$item->id )->where("user_id" , auth()->user()->id)->count(); 
			$countRate = $rates->count() ;
			$sumRate = $rates->sum("rate") ;
		 @endphp
			<h3>{{ trans( "admin.Rates") }} ({{ $countRate }})</h3>
		 @if($rateBefore == 0)
			<form method="post" action="{{ concatenateLangToUrl("page/add/rate/".$item->id) }}" > {{ csrf_field() }}
			<div class="form-group" > 
				<label for="rate" > {{ trans("admin.Rate") }}</label > 
				<select id="rate" name="rate">
				<option value="1"> 1</option> 
				<option value="2"> 2</option> 
				<option value="3"> 3</option> 
				<option value="4"> 4</option> 
				<option value="5"> 5</option> 
				</select> 
			</div> 
			</form> 
			@else
                        
				@for($i = 1 ; $i <= 5 ;$i++)
						{!! $i <= ($sumRate / $countRate) ? "<i class='fa fa-star active'></i>"  : "<i class='fa fa-star '></i>" !!}
				@endfor
		@endif
		@endisset
