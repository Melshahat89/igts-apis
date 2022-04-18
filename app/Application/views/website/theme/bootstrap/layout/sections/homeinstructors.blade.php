<div class="trainers_item">

    <figure class="img rounded-circle">
        <a href="/instructors/view/{{$data->slug}}">
            <img src="{{ large1($data->image) }}" loading="lazy" alt="{{ $data->fullname_lang }}" style="height: 235px; width: 100%;
    object-fit: cover;
    width: 100%;">
        </a>
    </figure>   

    <footer class="trainers_item_content text_center">
        <h5 class="trainers_item_content_title mbxs">
            <a href="/instructors/view/{{$data->slug}}">{{ $data->fullname_lang }}</a>
        </h5>
        <p><small>{{ $data->title_lang }}</small></p>
    </footer>
</div>