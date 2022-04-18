@extends(layoutExtend('website'))
@section('title')
    {{  trans('home.HomeTitle') }} - {{ trans('website.My Cart') }}
@endsection
@section('description')
    {{ trans('website.Footer IGTS') }}
@endsection
@section('keywords')
    
@endsection

@section('content')


<main class="main_content">
    <section class="sec sec_pad_top sec_pad_bottom">
        <div class="wrapper">

            <section class="title mblg">
                <h2 class="text_primary text_capitalize">{{trans('home.instructors')}}</h2>
            </section>
        
            <div tag_id="instructorsList" class="list-view">
                <div class="trainers_list trainers_list_small">

                    @foreach($Instructors as $key => $data)
                        @include('website.instructorsListView')
                    @endforeach

                </div>
            </div>
            
        </div>

        <div class="global-pagenation flexBetween">
        {{ $Instructors->links('pagination::meduo-pagination') }}
    </div>
    </section>

</main>

@endsection
