@extends(layoutExtend('website'))
@section('title')
    {{ trans('website.My Certificates') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection

@section('content')


@include('website.account.profileBrief', ['page' => "myCertificates"])    


<section class="sec sec_pad_top sec_pad_bottom bg_lightgray " id="">
    <div class="wrapper">
        <section class="title mblg">
            <h2 class="text_primary text_capitalize">{{trans('home.my certificates')}}</h2>
        </section>

        <div class="certificate_list">
        @if (count($certificates) > 0)
            @foreach ($certificates as $certificate)
                <div class="item">
                    <div>
                        <span class="item_icon text_primary"><i class="fas fa-certificate"></i></span>
                        <h5 class="item_name">{{ $certificate->quiz->title_lang }}</h5>
                        <div class="text_muted">{{ $certificate->created_at }}</div>
                    </div>
                    <div>
                        <a href="{{ url(env("CERTIFICATE_PATH_1")."/".$certificate->certificate) }}" class="button button_link" target="_blank"><i class="far fa-eye"></i></a>
                        <a href="{{ url(env("CERTIFICATE_PATH_1")."/".$certificate->certificate) }}" class="button button_link" target="_blank"><i class="fas fa-cloud-download-alt"></i></a>
                    </div>
                </div>
            @endforeach
            <div class="global-pagenation flexBetween">

                @if($certificates instanceof \Illuminate\Pagination\LengthAwarePaginator )
                    {{$certificates->appends(request()->input())->links('pagination::meduo-pagination') }}
                @endif

            </div>
        @else
            <div clsass="certificate_list">
                <h1> {{ trans('website.You have no certificates now') }} </h1>
            </div>
        @endif


    </div>

</div>
</section>
@endsection