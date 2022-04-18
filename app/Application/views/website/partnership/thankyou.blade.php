@extends(layoutExtend('website'))
@section('title')
{{ trans('partnership.Partnership Registration') }} | {{ trans('partnership.partnership') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection

@section('content')
    <div class="bread-crumb">
        <div class="container">
            <a href="#">{{ trans('website.home') }}</a> > <span>{{ trans('partnership.Partnership Registration') }}</span>
        </div>
    </div>

    <div class="page-title general-gred">
        <div class="container">
            <h1 class="mt-20 mb-20">{{ trans('partnership.Partnership Registration') }}</h1>
        </div>
    </div>

    
<section class="mt-80 mb-80">
    <div class="container text-center thanks">
      <img src="{{ asset('public/partnership') }}/images/new/thank_you.png" alt="...">
      <br>
      <h1><strong class="successfully">{{ trans('partnership.You have successfully registered!') }}</strong></h1>
      <h4>{{ trans('partnership.and your account is waiting for approval, expect a call from us soon') }}</h4>
    </div>
  </section>
  

@endsection
