<div class="list-card">
    <div class="row">
        <div class="col-md-4">
            <div class="card-img">
                {{--  <i class="flaticon-fav"></i>  --}}
                <img class="img-fit" style="width:100%;height:180px" src="{{large($data->image)}}" alt="{{ nl2br($data->title_lang) }}" >
                <h4>{{ nl2br($data->instructor['fullname_lang']) }}</h4>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-item">
                <p class="card-date">
                    {{ trans('website.Last updated') }} :  <?= $data->created_at; ?></p>

                <h6>
                    <a href="{{url('talks/view/'.$data->slug)}}">  {{ nl2br($data->title_lang) }}</a>
                </h6>
                <div class="badges flexLeft">
                    <div class="card-data flexLeft">
                    </div>
                </div>
                <div class="card-info">
                    <p>
                        {{substr(strip_tags($data->description_lang),0,600) . " ..."}}    
                    </p>
                    <span class="free-badge"> {{ trans('courses.Free') }} </span>

                </div>
            </div>

        </div>
        <div class="col-md-3">

            <div class="card-rating">
                {!! $data->Rating !!}
            </div>
        </div>
    </div>
</div>