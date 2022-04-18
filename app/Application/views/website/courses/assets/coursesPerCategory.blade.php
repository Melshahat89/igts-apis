@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => $headTitle]) 


    <section class="sec sec_pad_top sec_pad_bottom bg_lightgray">
    <div class="wrapper">

        <div class="with_aside_flex aside_sm">
        
                
                <div tag id="categoryList" class="list-view">
                    <div class="course_card_list">
                        <div class="row">

                    <!-- START FILTERING DIV -->

                        @include('website.categories.assets.filters-container', ['talks' => false, 'events' => false])

                    <!-- END FILTERING DIV -->

                        <div class="{{ (count($items) < 1) ? 'col-12' : 'col-md-9' }}">
                            @foreach($items as $item)
                                

                                    @include('website.courses.assets.courseCardList', ['data' => $item]) 

                                
                            @endforeach
                            </div>


                    <div class="global-pagenation flexBetween">


                        @if($items instanceof \Illuminate\Pagination\LengthAwarePaginator )

                        {{$items->appends(request()->input())->links('pagination::meduo-pagination') }}


                        @endif

                    </div>
                </div>
            
                   
            </div>

        </div>

    </div>
</section>