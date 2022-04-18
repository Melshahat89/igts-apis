<div class="trainers_item">
    
    <figure class="img rounded-circle">
        <a href="/instructors/view/{{$data->slug}}">
            <img src="{{medium($data->image)}}" loading="lazy" style="height: 200px; width: 100%; object-fit: cover;">
        </a>
    </figure>
    
    <footer class="trainers_item_content text_center">
        <h5 class="trainers_item_content_title mbxs">
            <a href="/instructors/view/{{$data->slug}}">{{$data->Fullname_lang}}</a>
        </h5>
        <p><small>{{$data->title_lang}}</small></p>
    </footer>
</div>