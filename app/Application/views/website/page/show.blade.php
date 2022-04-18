@extends(layoutExtend('website'))
@section('title')
    {{ getDefaultValueKey(nl2br($item->title)) }}
@endsection
@section('description')
    {{ trans('home.HomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.HomeKeywords') }}
@endsection
@section('content')


<main class="main_content">

    <!-- parallax -->
    <!-- parallax -->
	<!-- <div class="bg_gradient">
		<div class="parallax parallax-section">
			<div class="parallax-image" data-parallax="parallax" data-parallax-bg-image="/images/front/parallax/join-us-hero.png" data-parallax-speed="0.6" data-parallax-direction="up"></div>
			<div class="parallax-content parallax-xpad">
				<div class="wrapper">
					<section class="title mblg">
						<h2 class="text_white text_capitalize">{{ getDefaultValueKey(nl2br($item->title)) }}</h2>
					</section>
				</div>
			</div>
		</div>
	</div> -->
	@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => getDefaultValueKey(nl2br($item->title))]) 


    {!! getDefaultValueKey(nl2br($item->body))  !!}

<!--////////////////////////////////////////////-->
</main>

@endsection
