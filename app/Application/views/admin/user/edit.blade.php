@extends(layoutExtend())
@section('title')
    {{ trans('user.user') }} {{  isset($item) ? trans('curd.edit')  : trans('curd.add') }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('/public/admin/plugins/multi-select/css/multi-select.css') }}">
    {{ Html::style('/public/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}
@endsection
@section('content')
    @component(layoutForm() , ['title' => trans('user.user')  , 'model' => 'user' , 'action' => isset($item) ? trans('curd.edit') : trans('curd.add') ])
        @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/user/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group {{  $errors->has("name")   ? "has-error" : "" }}">
                <div class="form-line">
                    <input type="text" name="name" id="name" placeholder="{{ trans('user.name') }}" class="form-control" value="{{ isset($item) ? $item->name : old('name') }}"/>
                    @if ($errors->has("name"))
                        <div class="alert alert-danger">
                        <span class='help-block'>
                            <strong>{{ $errors->first("name") }}</strong>
                        </span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group {{  $errors->has("email")   ? "has-error" : "" }}">
                <div class="form-line">
                    <input type="email" name="email" id="email" {{ isset($item) ? '' : 'required' }} placeholder="{{ trans('user.email') }}"  class="form-control" value="{{ isset($item) ? $item->email : old('email')  }}"/>
                    @if ($errors->has("email"))
                        <div class="alert alert-danger">
                        <span class='help-block'>
                            <strong>{{ $errors->first("email") }}</strong>
                        </span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group {{  $errors->has("password")   ? "has-error" : "" }}">
                <div class="form-line">
                    <input type="password" name="password" id="password" placeholder="{{ trans('user.password') }}"    class="form-control"/>
                    @if ($errors->has("password"))
                        <div class="alert alert-danger">
                        <span class='help-block'>
                            <strong>{{ $errors->first("password") }}</strong>
                        </span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has("mobile") ? "has-error" : "" }}" >
                <label for="mobile">{{ trans("user.mobile")}}</label>
                <input type="text" name="mobile" class="form-control" id="mobile" value="{{ isset($item->mobile) ? $item->mobile : old("mobile") }}"  placeholder="{{ trans("user.mobile")}}">
                @if ($errors->has("mobile"))
                    <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("mobile") }}</strong>
                     </span>
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has("verified") ? "has-error" : "" }}" >
                <label for="verified">{{ trans("user.verified")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="verified" {{ isset($item->verified) && $item->verified == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("user.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="verified" {{ isset($item->verified) && $item->verified == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("user.Yes")}}
                    </label>
                </div>
                @if ($errors->has("verified"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("verified") }}</strong>
                 </span>
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has("activated") ? "has-error" : "" }}" >
                <label for="activated">{{ trans("user.activated")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="activated" {{ isset($item->activated) && $item->activated == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("user.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="activated" {{ isset($item->activated) && $item->activated == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("user.Yes")}}
                    </label>
                </div>
                @if ($errors->has("activated"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("activated") }}</strong>
                 </span>
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has("activation_code") ? "has-error" : "" }}" >
                <label for="activation_code">{{ trans("user.activation_code")}}</label>
                <input type="text" name="activation_code" class="form-control" id="activation_code" value="{{ isset($item->activation_code) ? $item->activation_code : old("activation_code") }}"  placeholder="{{ trans("user.activation_code")}}">
                @if ($errors->has("activation_code"))
                    <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("activation_code") }}</strong>
                     </span>
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has("activation_date") ? "has-error" : "" }}" >
                <label for="activation_date">{{ trans("user.activation_date")}}</label>
                <input type="date" name="activation_date" class="form-control" id="activation_date" value="{{ isset($item->activation_date) ? $item->activation_date : old("activation_date") }}"  placeholder="{{ trans("user.activation_date")}}">
                @if ($errors->has("activation_date"))
                    <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("activation_date") }}</strong>
                     </span>
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has("banned") ? "has-error" : "" }}" >
                <label for="banned">{{ trans("user.banned")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="banned" {{ isset($item->banned) && $item->banned == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("user.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="banned" {{ isset($item->banned) && $item->banned == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("user.Yes")}}
                    </label>
                </div>
                @if ($errors->has("banned"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("banned") }}</strong>
                 </span>
                    </div>
                @endif
            </div>

            <div class="form-group {{ $errors->has("hidden") ? "has-error" : "" }}" >
                <label for="hidden">{{ trans("user.hidden")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="hidden" {{ isset($item->hidden) && $item->hidden == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("user.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="hidden" {{ isset($item->hidden) && $item->hidden == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("user.Yes")}}
                    </label>
                </div>
                @if ($errors->has("hidden"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("hidden") }}</strong>
                 </span>
                    </div>
                @endif
            </div>



            <div class="form-group  {{  $errors->has("first_name.en")  &&  $errors->has("first_name.ar")  ? "has-error" : "" }}" >
                <label for="first_name">{{ trans("user.first_name")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "first_name", isset($item->first_name) ? $item->first_name : old("first_name") , "text" , "user") !!}


                @if ($errors->has("first_name.en"))
                    <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("first_name.en") }}</strong>
                     </span>
                    </div>
                @endif
                @if ($errors->has("first_name.ar"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("first_name.ar") }}</strong>
                 </span>
                    </div>
                @endif
            </div>
            <div class="form-group  {{  $errors->has("last_name.en")  &&  $errors->has("last_name.ar")  ? "has-error" : "" }}" >
                <label for="last_name">{{ trans("user.last_name")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "last_name", isset($item->last_name) ? $item->last_name : old("last_name") , "text" , "user") !!}


                @if ($errors->has("last_name.en"))
                    <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("last_name.en") }}</strong>
                     </span>
                    </div>
                @endif
                @if ($errors->has("last_name.ar"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("last_name.ar") }}</strong>
                 </span>
                    </div>
                @endif
            </div>

            <div class="form-group {{ $errors->has("gender") ? "has-error" : "" }}" >
                <label for="gender">{{ trans("user.gender")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="gender" {{ isset($item->gender) && $item->gender == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("user.gender_0")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="gender" {{ isset($item->gender) && $item->gender == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("user.gender_1")}}
                    </label>
                </div>
                @if ($errors->has("gender"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("gender") }}</strong>
                 </span>
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has("birthdate") ? "has-error" : "" }}" >
                <label for="birthdate">{{ trans("user.birthdate")}}</label>
                <input type="date" name="birthdate" class="form-control" id="birthdate" value="{{ isset($item->birthdate) ? $item->birthdate : old("birthdate") }}"  placeholder="{{ trans("user.birthdate")}}">
                @if ($errors->has("birthdate"))
                    <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("birthdate") }}</strong>
                     </span>
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has("is_affiliate") ? "has-error" : "" }}" >
                <label for="is_affiliate">{{ trans("user.is_affiliate")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="is_affiliate" {{ isset($item->is_affiliate) && $item->is_affiliate == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("user.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="is_affiliate" {{ isset($item->is_affiliate) && $item->is_affiliate == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("user.Yes")}}
                    </label>
                </div>
                @if ($errors->has("is_affiliate"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("is_affiliate") }}</strong>
                 </span>
                    </div>
                @endif
            </div>

            <div class="form-group {{ $errors->has("sort") ? "has-error" : "" }}" >
                <label for="sort">{{ trans("user.sort")}}</label>
                <input type="text" name="sort" class="form-control" id="sort" value="{{ isset($item->sort) ? $item->sort : old("sort") }}"  placeholder="{{ trans("user.sort")}}">

                @if ($errors->has("sort"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("sort") }}</strong>
                 </span>
                    </div>
                @endif
            </div>




            @include("admin.user.relation.affiliate.edit")

            {{-- <div class="form-group {{ $errors->has("affiliate_id") ? "has-error" : "" }}" >
                <label for="affiliate_id">{{ trans("user.affiliate_id")}}</label>
                <input type="text" name="affiliate_id" class="form-control" id="affiliate_id" value="{{ isset($item->affiliate_id) ? $item->affiliate_id : old("affiliate_id") }}"  placeholder="{{ trans("user.affiliate_id")}}">
                @if ($errors->has("affiliate_id"))
                    <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("affiliate_id") }}</strong>
                     </span>
                    </div>
                @endif
            </div> --}}
            <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
                <label for="title">{{ trans("user.title")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "user") !!}


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
            </div>
            <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
                <label for="description">{{ trans("user.description")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "textarea" , "user" , 'tinymce') !!}

                @if ($errors->has("description.en"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("description.en") }}</strong>
                 </span>
                    </div>
                @endif
                @if ($errors->has("description.ar"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("description.ar") }}</strong>
                 </span>
                    </div>
                @endif
            </div>
            <div class="form-group  {{  $errors->has("about.en")  &&  $errors->has("about.ar")  ? "has-error" : "" }}" >
                <label for="about">{{ trans("user.about")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "about", isset($item->about) ? $item->about : old("about") , "textarea" , "user", 'tinymce' ) !!}

                @if ($errors->has("about.en"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("about.en") }}</strong>
                 </span>
                    </div>
                @endif
                @if ($errors->has("about.ar"))
                    <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("about.ar") }}</strong>
                 </span>
                    </div>
                @endif
            </div>
            <!--<div class="form-group  {{  $errors->has("additional_info.en")  &&  $errors->has("additional_info.ar")  ? "has-error" : "" }}" >-->
            <!--    <label for="additional_info">{{ trans("user.additional_info")}}</label>-->
            <!--    {!! extractFiled(isset($item) ? $item : null , "additional_info", isset($item->additional_info) ? $item->additional_info : old("additional_info") , "textarea" , "user" , 'tinymce') !!}-->

            <!--    @if ($errors->has("additional_info.en"))-->
            <!--        <div class="alert alert-danger">-->
            <!--     <span class='help-block'>-->
            <!--      <strong>{{ $errors->first("additional_info.en") }}</strong>-->
            <!--     </span>-->
            <!--        </div>-->
            <!--    @endif-->
            <!--    @if ($errors->has("additional_info.ar"))-->
            <!--        <div class="alert alert-danger">-->
            <!--     <span class='help-block'>-->
            <!--      <strong>{{ $errors->first("additional_info.ar") }}</strong>-->
            <!--     </span>-->
            <!--        </div>-->
            <!--    @endif-->
            <!--</div>-->


            <div class="form-group {{ $errors->has("image") ? "has-error" : "" }}" >
                <label for="image">{{ trans("user.image")}}</label>
                @if(isset($item) && $item->image != "")
                    <br>
                    <img src="{{ small($item->image) }}" class="thumbnail" alt="" width="200">
                    <br>
                @endif
                <input type="file" name="image" >
            </div>
            @if ($errors->has("image"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("image") }}</strong>
                 </span>
                </div>
            @endif

            <div class="form-group {{ $errors->has("cover") ? "has-error" : "" }}" >
                <label for="cover">{{ trans("user.cover")}}</label>
                @if(isset($item) && $item->cover != "")
                    <br>
                    <img src="{{ small($item->cover) }}" class="thumbnail" alt="" width="200">
                    <br>
                @endif
                <input type="file" name="cover" >
            </div>
            @if ($errors->has("cover"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("cover") }}</strong>
                 </span>
                </div>
            @endif
            <div class="form-group {{  $errors->has("group_id")   ? "has-error" : "" }}">
                <div class="">
                    @php $gourp = isset($item) && $item->group_id != 0 ? $item->group_id : null @endphp
                    <label for="">{{ trans('user.group') }} </label>
                    {!! Form::select('group_id' , $data['groups'] , $gourp , ['class' => 'form-control'] ) !!}
                    @if ($errors->has("group_id"))
                        <div class="alert alert-danger">
                        <span class='help-block'>
                            <strong>{{ $errors->first("group_id") }}</strong>
                        </span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <label for="">{{ trans('user.role') }}</label>
                    @php $roles = isset($data['roles_permission']) ? $data['roles_permission']->role->pluck('id')->all() : null @endphp
                    {!! Form::select('roles[]' , $data['roles'] , $roles, ['multiple' => true  , 'id' => 'roles' ] ) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <label for="">{{ trans('user.permission') }}</label>
                    @php $permission = isset($data['roles_permission']) ? $data['roles_permission']->permission->pluck('id')->all()  : null @endphp
                    {!! Form::select('permission[]' , $data['permissions'] , $permission , ['multiple' => true , 'id' => 'permissions' ,'style' => 'overflow: revert;'] ) !!}
                </div>
            </div>
           

  

            <div class="form-group">
                <div class="">
                    <label for="">{{ trans('partnership.Enrolled Students') }}</label>

                    {!! coursesMultiSelect('usersCoursesEnrollments[]', 'usersCoursesEnrollments', isset($item) ? $item->id : null) !!}
                </div>
            </div>



            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }} {{ trans('user.user') }}
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
        $('#roles').multiSelect(search("{{ trans('user.role') }}"));
        $('#permissions').multiSelect(search("{{ trans('user.permission') }}"));
        $('#usersCoursesEnrollments').multiSelect(search("{{ trans('partnership.Enrolled Students') }}"));
        function search(name){
            return {
                selectableOptgroup: true,
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