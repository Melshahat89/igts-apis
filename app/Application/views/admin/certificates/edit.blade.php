@extends(layoutExtend())

@section('title')
    {{ trans('certificates.certificates') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('certificates.certificates') , 'model' => 'certificates' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/certificates/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}">
                <label for="title">{{ trans("certificates.title")}}</label>
                {!! extractFiled(isset($item) ? $item : null ,"title" , isset($item->title) ? $item->title : old("title") , "text" , "certificates") !!}
            </div>

            @if ($errors->has("title.en"))
                <div class="alert alert-danger">
                            <span class='help-block'>
                                <strong>{{ $errors->first("title.en") }}</strong>
                             </span>
                </div>
            @endif
            @if ($errors->has("title.ar"))
                <div class="alert alert-danger">
                            <span class='help-block'>
                                <strong>{{ $errors->first("title.ar") }}</strong>
                            </span>
                </div>
            @endif

            <div class="form-group {{ $errors->has("visible") ? "has-error" : "" }}" >
                <label for="visible">{{ trans("certificates.visible")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="visible" {{ isset($item->visible) && $item->visible == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("user.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="visible" {{ isset($item->visible) && $item->visible == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("user.Yes")}}
                    </label>
                </div>
                @if ($errors->has("visible"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("visible") }}</strong>
                 </span>
                    </div>
                @endif
            </div>

            <div class="form-group {{ $errors->has("price_egp") ? "has-error" : "" }}" >
                <label for="price_egp">{{ trans("certificates.price_egp")}}</label>
                <input type="text" name="price_egp" class="form-control" id="price_egp" value="{{ isset($item->price_egp) ? $item->price_egp : old("price_egp") }}"  placeholder="{{ trans("certificates.price_egp")}}">
            </div>
            @if ($errors->has("price_egp"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("price_egp") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("price_usd") ? "has-error" : "" }}" >
                <label for="price_usd">{{ trans("certificates.price_usd")}}</label>
                <input type="text" name="price_usd" class="form-control" id="price_usd" value="{{ isset($item->price_usd) ? $item->price_usd : old("price_usd") }}"  placeholder="{{ trans("certificates.price_usd")}}">
            </div>
            @if ($errors->has("price_usd"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("price_usd") }}</strong>
     </span>
                </div>
            @endif

            <div class="form-group">
                <div class="">
                    <label for="">Related Courses</label>


                    @php $courserelated = isset($data['Allcourserelated']) ? $data['Allcourserelated']->pluck('id')->all() : null 
                    @endphp
<?php //dd($courserelated);  ?>
<a class="btn btn_primary" id="select-all">Select All</a>
<a class="btn btn_primary" id="deselect-all">Deselect All</a>

                    {!! Form::select('certificatesrelatedcourses[]' , json_decode($data['allCourses'], true) ,$courserelated , ['multiple' => true  , 'id' => 'certificatesrelatedcourses' ] ) !!}


                    </div>
            </div>


            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('certificates.certificates') }}
                </button>
            </div>

            
        </form>
    @endcomponent
@endsection

@section('script')
@include(layoutPath('layout.helpers.tynic'))


<script src="{{ url('/public/admin/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ url('/public/admin/js/search.js') }}"></script>
<script>

    $('#certificatesrelatedcourses').multiSelect(search("Related Courses"));

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

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("instructor_id");
        filter = input.value.toUpperCase();
      
        for (i = 0; i < a.length; i++) {
          txtValue = a[i].textContent || a[i].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
           
          } else {
            
          }
        }
      }
</script>

<script>

      $('#select-all').on('click', function(){
        $('#certificatesrelatedcourses').multiSelect('select_all');
      });

      $('#deselect-all').on('click', function(){
        $('#certificatesrelatedcourses').multiSelect('deselect_all');
      });
</script>
@endsection
