@extends(layoutExtend('website'))
 
@section('title')
    {{ trans('careers.careers') }}
@endsection
 
@section('content')

@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('careers.careers')]) 

@if($careers)

<section class="careers-content">
  <div class="container">
    <div id="accordion">

    @foreach($careers as $career)
      <div class="card mb-10">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <a class="btn btn-link flexBetween" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> 
              <span>{{$career->title_lang}}</span>
              <i class="fa" aria-hidden="true"></i>
            </a>
          </h2>
        </div>
  
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
            <div class="careers-contetn-area">
              @if($career->image)
              <div class="d-flex justify-content-center">
                <img src="{{large1($career->image)}}" class="w-100">
              </div>
              @endif
            {!! $career->description_lang !!}
            
            </div>
            <div class="text-right">

              <a class="add-to-cart" target="_blank" href="{{$career->link}}">
                {{ trans('careers.Apply Now') }}
              </a>
              
            </div>

          </div>
        </div>
      </div>
    @endforeach

    </div>
  </div>
</section>

@endif

<div class="modal fade" id="applymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header flexRight">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="login-form" action="{{ concatenateLangToUrl('careers') }}" name="careerForm" method="post">
          <div class="input-group">
            <input type="text" class="form-control input-item user-login-ico" placeholder="Jop Title" aria-label="Tilte">
          </div>
          
            <div class="file-upload">
              <div class="file-select">
                <div class="file-select-button" id="fileName">Choose File</div>
                <div class="file-select-name" id="noFile">No file chosen...</div> 
                <input type="file" name="chooseFile" id="chooseFile">
              </div>
            </div>
                    
          <div class="text-center">

            <button class="add-to-cart">
              Apply Now
            </button>
            

          </div>
         
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="applymodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header flexRight">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="login-form">
          <div class="input-group">
            <input type="text" class="form-control input-item user-login-ico" placeholder="Jop Title" aria-label="Tilte">
          </div>
          
            <div class="file-upload">
              <div class="file-select">
                <div class="file-select-button" id="fileName">Choose File</div>
                <div class="file-select-name" id="noFile">No file chosen...</div> 
                <input type="file" name="chooseFile" id="chooseFile">
              </div>
            </div>
                    
          <div class="text-center">

            <button class="add-to-cart">
              Apply Now
            </button>
            

          </div>
         
        </form>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->



  <div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header flexRight">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-0">
            <div class="m-search-modal">
                <form action="#" method="get" class="search-form-popup">
                    <div class="search-form-popup-wrapper">
                    <input type="text" placeholder="Search for the skills you want to learn" name="s" class="apus-search form-control" autocomplete="off">
                    <button type="submit" class="btn-search-icon"><i class="flaticon-magnifying-glass"></i></button>
                    </div>
                    </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    @endsection
