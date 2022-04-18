@extends(layoutExtend())
@section('title')
{{ trans('courses.courses') }} {{ isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
@section('style')
<link rel="stylesheet" href="{{ url('/public/admin/plugins/multi-select/css/multi-select.css') }}">
{{ Html::style('/public/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}
@endsection
@section('content')
@component(layoutForm() , ['title' => trans('courses.courses') , 'model' => 'courses' , 'action' => isset($item) ? trans('home.edit') : trans('home.add') ])
@include(layoutMessage())


<div class="tabs-container">

    <ul class="nav nav-pills flexBetween custom-tab" style="width: 50%;" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="false">Curriculum</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Resources</a>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane  show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
            <!--    START CURRICULUM CONTENT    -->

            <div class="admin-course-content">
                <button class="btn btn-primary pb-4" type="button" data-toggle="modal" data-target="#exampleModal" onclick="loadWidget('/coursesections/item', '', {{$item->id}})">Add new section</button>
            </div>

            <div class="accordion" id="accordionSections">
                <div id="sortable-sections"> 
                @foreach($data['sections'] as $section)
                <div class="list-sections" id="{{$section->id}}">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#sec-{{$section->id}}" aria-expanded="true" aria-controls="collapseOne">
                                Section Title: {{ $section->title_lang }}
                            </button>
                            <button class="btn btn-primary test" type="button" data-toggle="modal" data-target="#exampleModal" onclick="loadWidget('/coursesections/item/', {{$section->id}})">
                                Edit
                            </button>
                            <a href="/lazyadmin/coursesections/{{$section->id}}/delete" class="btn btn-danger" type="button" onclick="return confirm('Are you sure you want to delete this item?');">
                                Remove
                            </a>
                            <button class="btn btn-primary pb-4" type="button" data-toggle="modal" data-target="#exampleModal" onclick="loadWidget('/courselectures/item', '', {{$section->id}})">Add new lecture</button>
                        </h5>
                    </div>

                    <div id="sec-{{$section->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionSections">
                        <div class="card-body">
                            <ul class="sortable sortable-style" id="{{$section->id}}">
                                @foreach($section->courselectures as $lecture)

                                <li class="ui-state-default lecture-li row list-lectures-{{$section->id}}" id="{{$lecture->id}}">
                                    <div class="d-flex justify-content-between">
                                        <p>{{ $lecture->title_lang }}</p>
                                        <button class="btn btn-primary test" type="button" data-toggle="modal" data-target="#exampleModal" onclick="loadWidget('/courselectures/item/', {{$lecture->id}})">
                                            Edit
                                        </button>
                                        <a href="/lazyadmin/courselectures/{{$lecture->id}}/delete" class="btn btn-danger" type="button" onclick="return confirm('Are you sure you want to delete this item?');">
                                            Remove
                                        </a>
                                    </div>

                                </li>


                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
</div>
                @endforeach
</div>
            </div>
            <!--    END CURRICULUM CONTENT    -->

        </div>
        <div class="tab-pane  show" id="tab-2" role="tabpanel" aria-labelledby="tab-2">

        <!--    START RESOURCES CONTENT    -->

        <div class="admin-course-content">
            <button class="btn btn-primary pb-4" type="button" data-toggle="modal" data-target="#exampleModal" onclick="loadWidget('/courseresources/item')">Add new resource</button>
        </div>

        <ul id="sortable-resources" class="sortable-style">

        @foreach($data['resources'] as $resource)
            <li class="list-resources" id="{{$resource->id}}">
                <div class="d-flex justify-content-between">
                    <p>{{ $resource->title_lang }}</p>
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" onclick="loadWidget('/courseresources/item/', {{$resource->id}})">
                        Edit
                    </button>
                    <a href="/public/uploads/files/{{$resource->file}}" target="_blank" class="btn btn-info" type="button" >
                        View
                    </a>
                    <a href="/lazyadmin/courseresources/{{$resource->id}}/delete" class="btn btn-danger" type="button" onclick="return confirm('Are you sure you want to delete this item?');">
                        Remove
                    </a>
                </div>
            </li>
        @endforeach

        </ul>


        <!--    END RESOURCES CONTENT    -->
        </div>
    </div>

</div>




@endcomponent
@endsection

<script>
    window.addEventListener('load', (event) => {

        $(function() {
            $(".sortable").sortable({
                update: function (event, ui) {
                    
                    let sectionId = $(this).attr('id');

                    $('.list-lectures-' + sectionId).each(function(index) {

                        
                        index = index + 1;

                            $.ajax({
                            
                            type: 'GET',
                            url: '/lazyadmin/courselectures/item/' + $( this ).attr('id') + '/updatePosition',
                            data: {index: index,  _token: '{{csrf_token()}}'},

                            success: function(response) {
                                
                            }
                        });

                    });


                    
                }
            });
            
            $('#sortable-sections').sortable({

                update: function (event, ui) {

                    $('.list-sections').each(function(index) {

                        index = index + 1;

                        $.ajax({
                            
                            type: 'GET',
                            url: '/lazyadmin/coursesections/item/' + $( this ).attr('id') + '/updatePosition',
                            data: {index: index,  _token: '{{csrf_token()}}'},

                            success: function(response) {
                                
                            }
                        });

                    });

                }

            });

            $('#sortable-resources').sortable({

                update: function (event, ui) {

                    $('.list-resources').each(function(index) {

                        index = index + 1;

                        $.ajax({

                            type: 'GET',
                            url: '/lazyadmin/courseresources/item/' + $( this ).attr('id') + '/updatePosition',
                            data: {index: index,  _token: '{{csrf_token()}}'},

                            success: function(response) {
                                
                            }

                        });

                    });
                }
            });
            
        });


    });
    
</script>
