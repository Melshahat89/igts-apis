@extends(layoutExtend('website'))
@section('title')
    {{  ($homesettings->seo_title_lang) ? $homesettings->seo_title_lang : trans('home.HomeTitle') }}
@endsection
@section('description')
    {{ ($homesettings->seo_desc_lang) ? $homesettings->seo_desc_lang : trans('website.Footer IGTS') }}
@endsection
@section('keywords')
    {{ ($homesettings->seo_keys) ? extractSeoKeys($homesettings->seo_keys) : '' }}
@endsection

@push('js')
<script src="{{ asset('public/old') }}/js/front/social.js"></script>
@endpush
  @section('content')
  <div class="bread-crumb">
    <div class="wrapper">
        <a href="/">{{trans('home.home')}}</a> > <span><?=  ($category) ? $category->name_lang : '' ?> </span>
    </div>
</div>
  @include('website.categories.assets.tabs-container', ['active' => 'bundles', 'tabsWidth' => $tabsWidth])


  <main class="main_content">
    <?php if ($mostViewedPerCategory && !($key)) { ?> 
        <section class="sec sec_pad_top sec_pad_bottom d-none">
            <div class="wrapper">

                <section class="title mblg">
                    <h2 class="text_primary text_capitalize">{{trans('categories.most viewed')}}</h2>
                </section>

                <div id="mostViewed">
                    <div class="courses_cards owl-carousel owl-theme mostViewed">
                        <?php foreach ($mostViewedPerCategory as $data) { ?>
                            @include('website.courses.assets.mostViewedItem', ['data' => $data]) 
                        <?php } ?>

                    </div>
                </div>

            </div>
        </section>
    <?php } ?>


@if($Bundles)

    @include('website.courses.assets.bundlesPerCategory', ['items' => $Bundles, 'headTitle' => trans('home.bundles')])

@endif


</main>
@endsection