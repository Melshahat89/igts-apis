@extends(layoutExtend('website'))
@section('title')
  Complete Your Profile
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')
@section('content')
<?php
use App\Application\Model\Businessinputfieldsresponses;
?>

    @include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('website.complete profile'), 'subTitle' => trans('website.complete profile desc')]) 

    <section class="interest">
        <div class="container">
        <h5 class="mb-20"><strong>{{ trans('account.Personal information') }}</strong></h5>

            <form id="users-form" class="validate_form mtlg"
                action="{{ concatenateLangToUrl('account/update') }}{{ isset($item) ? '/' . $item->id : '' }}"
                method="post" enctype="multipart/form-data">
                {{ csrf_field() }}



                <div class="col-md-12 mb-4">
                <label class="m-2" style="font-weight: bold;" for="mobile">{{trans('account.mobile')}}</label>
                    <input id="mobile" type="number" value="{{ isset($item->mobile) ? $item->mobile : old('mobile') }}"
                        class="form-control input-item user-login-ico" name="mobile"
                        placeholder='* {{ trans('account.mobile') }}' aria-label="Username" value="{{ old('mobile') }}"
                        required autofocus>
                </div>
                
                <div class="col-md-12 mb-4">
                <label class="m-2" style="font-weight: bold;" for="categories">{{trans('account.speciality')}}</label>

                <select class="form-control input-item user-login-ico" id="categories" name="categories" required="required">
                    <option value="">{{trans('account.Select specialization')}}</option>
                    @foreach($categories as $key => $category)
                    <option value="{{$key}}" {{ (isset($item->categories) && $item->categories == $key) ? 'selected' : '' }}> {{$category}} </option>
                    @endforeach
                </select>

                @if ($errors->has('categories'))
                                <div class="help-block">
                                        <strong>{{ $errors->first('categories') }}</strong>
                                    </div>
                            @endif
                    </div>


                    <div class="col-md-12 mt-20 mb-20">
                        <div class="flexRight">
                            <button type="submit" class="view-more-section">
                                {{ trans('account.Save') }} <i class="flaticon-right-arrow-1"></i>
                            </button>
                        </div>
                    </div>
                    
                </div>

                
                  
                    

                        
                  
                 </div>
                </div>
            </form>
        </div>
        
    </section>

    <div class="container">
    @if(isset($businessInputFields) && count($businessInputFields) > 0)

<h5 class="mb-20" style="padding-top: 20px;"><strong>{{ trans('account.Business information') }}</strong></h5>
<p>You need to complete all the required (*) business information in order to start enrolling in courses.</p>

<form action="{{ concatenateLangToUrl('businessinputfieldsresponses') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
@foreach($businessInputFields as $businessInputField)
<div class="col-md-12 mb-4">
    <label class="m-2" style="font-weight: bold;" for="{{$businessInputField->field_name}}"> {{ ($businessInputField->mandatory) ? '*' : ''}} {{$businessInputField->field_name}}</label>
    <input id="{{$businessInputField->field_name}}" name="{{$businessInputField->field_name}}" type="text" class="form-control input-item user-login-ico" value="{{Businessinputfieldsresponses::getFieldResponseByUser($businessInputField->field_name)}}" {{ ($businessInputField->mandatory) ? 'required' : ''}}>
</div>
@endforeach

@endif

<div class="col-md-12 mt-20 mb-20">
                        <div class="flexRight">
                            <button type="submit" class="view-more-section">
                                {{ trans('account.Save') }} <i class="flaticon-right-arrow-1"></i>
                            </button>
                        </div>
                    </div>
    </div>


</form>




@endsection
