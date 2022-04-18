	
@if(isset($item))
<div class="form-group {{ $errors->has("courses") ? "has-error" : "" }}">
	<label for="courses">{{ trans( "courses.courses") }}</label>
	@php $courses = App\Application\Model\Courses::pluck("title" ,"id")->all()  @endphp
	@php  $courses_id = isset($item) ? $item->courses_id : null @endphp
	<select name="courses_id"  class="form-control" >
	@foreach( $courses as $key => $relatedItem)
	<option value="{{ $key }}"  {{ $key == $courses_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
	@endforeach
	</select>
	@if ($errors->has("courses"))
		<div class="alert alert-danger">
			<span class="help-block">
				<strong>{{ $errors->first("courses") }}</strong>
			</span>
		</div>
	@endif
	</div>


@else

<div class="form-group {{ $errors->has("courses") ? "has-error" : "" }}">
	<label for="courses">{{ trans( "courses.courses") }}</label>
	@php $courses = App\Application\Model\Courses::pluck("title" ,"id")->all()  @endphp
	@php  $courses_id = isset($item) ? $item->courses_id : null @endphp
	<select id="courses_id" name="courses_id[]"  class="form-control" multiple>
	@foreach( $courses as $key => $relatedItem)
	<option value="{{ $key }}"  {{ $key == $courses_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
	@endforeach
	</select>
	@if ($errors->has("courses"))
		<div class="alert alert-danger">
			<span class="help-block">
				<strong>{{ $errors->first("courses") }}</strong>
			</span>
		</div>
	@endif
	</div>

@endif
	
	

			@section('script')
@include(layoutPath('layout.helpers.tynic'))

    <script src="{{ url('/public/admin/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ url('/public/admin/js/search.js') }}"></script>
    <script>

        $('#courses_id').multiSelect(search("{{ trans('courses.courses') }}"));
        function search(name){
            return {
                selectableHeader: "<input type='text' class='form-control' autocomplete='off'  placeholder='"+name+"'>",
                selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='"+name+"'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function(e){
                            if (e.which === 40){
                                that.$selectableUl.focus();
                                return false;
                            }
                        });
                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function(e){
                            if (e.which == 40){
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
                },
                afterSelect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                },
                afterDeselect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                }
            }
        }
    </script>
@endsection
