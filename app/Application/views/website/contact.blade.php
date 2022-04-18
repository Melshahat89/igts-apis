@extends(layoutExtend('website'))
@section('title')
    {{ trans('website.Contact Us') }}
@endsection
@section('description')
    {{ trans('home.HomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.HomeKeywords') }}
@endsection
@section('content')


@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('website.Contact Us')]) 

    <section class="contact-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-20">
                    <p>
                        {{ trans('website.Footer IGTS') }}
                    </p>

                    <div class="contact-info mt-20">

                        <p>
                            <strong>
                                {{ trans('website.Address') }} : </strong>
                            {{ trans('website.Address Text') }}
                        </p>
                    </div>

                    <div class="social contact-social flexLeft mt-20">
                        <a href="{{ getSetting('facebook') }}" target="_blank"><i class="facebook"></i></a>
                        <a href="{{ getSetting('twitter') }}" target="_blank"><i class="twitter"></i></a>
                        <a href="{{ getSetting('linkedin') }}" target="_blank"><i class="linkedin"></i></a>
                        <a href="{{ getSetting('instagram') }}" target="_blank"><i class="instagram"></i></a>
                        <a href="{{ getSetting('youtube') }}" target="_blank"><i class="youtube"></i></a>
                    </div>


                </div>
                <div class="col-md-6 form-container">
                    <h3>{{ trans('website.Keep in touch') }}</h3>

                    <form class="form-content" action="{{ concatenateLangToUrl('contact') }}" name="contactform"
                        method="post">
                        {{ csrf_field() }}



                        <div class="input-group">

                            <input type="text" name="name" id="name" class="form-control input-item"
                                placeholder="{{ trans('website.Name') }}" aria-label="Name"
                                value="{{ auth()->check() ? auth()->user()->fullname_lang : old('name') ?? '' }}" required>                        
                        </div>

                        @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            </div>
                        @endif

                        <div class="input-group">
                            <input type="text" name="email" id="email" class="form-control input-item"
                                placeholder="{{ trans('website.Email') }}" aria-label="email" required 
                                value="{{ auth()->check() ? auth()->user()->email : old('email') ?? '' }}">                          
                        </div>
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            </div>
                        @endif

                        <div class="input-group">
                            <input type="tel" name="phone" id="phone" class="form-control input-item" aria-label="Tel"
                                placeholder="{{ trans('website.Phone') }}" value="{{ old('phone') ?? '' }}">
                        </div>
                        @if ($errors->has('phone'))
                            <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            </div>
                        @endif

                        <div class="input-group">
                            <input type="text" name="subject" id="subject" class="form-control input-item"
                                aria-label="subject" placeholder="{{ trans('website.Subject') }}" required
                                value="{{ old('subject') ?? '' }}">     
                        </div>
                        @if ($errors->has('subject'))
                            <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            </div>
                        @endif

                        <div class="input-group">
                            <textarea class="form-control" name="message" id="comments" cols="30" rows="10"
                                aria-label="message" placeholder="{{ trans('website.Message Below') }}"
                                required>{{ old('message') ?? '' }}</textarea>
                        </div>

                        @if ($errors->has('message'))
                            <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            </div>
                        @endif

                        @if(config('services.recaptcha.key'))
                            <div class="g-recaptcha"
                                data-sitekey="{{config('services.recaptcha.key')}}">
                            </div>
                        @endif
                        @if ($errors->has('g-recaptcha-response'))
                            <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            </div>
                        @endif

                        <div class="text-right">

                            <button type="submit" class="add-to-cart">
                                {{ trans('website.send now') }}
                                </button>

                            </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="map">
        <!--    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.6021126828646!2d30.925649284550143!3d29.962121429411074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14585658dadd554d%3A0xe605c53acb644f23!2z2KfZhNmF2KzZhdmI2LnYqSDYp9mE2K_ZiNmE2YrYqSDZhNiu2K_Zhdin2Kog2KfZhNiq2K_YsdmK2KggSUdUUw!5e0!3m2!1sar!2seg!4v1576696481993!5m2!1sar!2seg&language=en" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9776.78607576382!2d30.918811347941414!3d29.96172595964548!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe605c53acb644f23!2sIGTS!5e0!3m2!1sen!2seg!4v1583146635380!5m2!1sen!2seg" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
        <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
