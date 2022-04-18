@extends(layoutBusiness())
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.Courses Insight') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')


    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('businessdata.Courses Insight') }}</h3>
        </div>

        <div class="panel-body">
            <div class="table-res-scroll">
                <table class="table table-striped" id="course-insights-table">
                    <thead>
                        <tr>

                            <th>{{ trans('businessdata.Course Name') }}</th>

                            <th>
                                {{ trans('businessdata.Number of enrollments') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($Enrollments)
                            @foreach ($Enrollments as $key => $enroll)
                                <tr>
                                    <td>{{ $enroll->courses['title_lang'] }}</td>

                                    <td>
                                        {{ $enroll->Count }} {{ trans('businessdata.enrollment') }}
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                aria-valuenow="{{ $businessdata->CoutEnrollments > 0 ? ($enroll->Count / $businessdata->CoutEnrollments) * 100 : 0 }}"
                                                aria-valuemin="0" aria-valuemax="100"
                                                style="width: {{ $businessdata->CoutEnrollments > 0 ? ($enroll->Count / $businessdata->CoutEnrollments) * 100 : 0 }}%;">
                                                <span>{{ $businessdata->CoutEnrollments > 0 ? ($enroll->Count / $businessdata->CoutEnrollments) * 100 : 0 }}%</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        @endisset

                    </tbody>
                </table>
            </div>

            <div class="row mt-40" style="display: none;">
                <div class="col-md-2 text-center">
                    <div id="enrollment-load" class="easy-pie-chart" data-percent="{{ $businessdata->licenses > 0 ? ($businessdata->CoutEnrollments / $businessdata->licenses) * 100 : 0 }}">
                        <span class="percent">{{ $businessdata->licenses > 0 ? ($businessdata->CoutEnrollments / $businessdata->licenses) * 100 : 0 }}</span>
                        <canvas height="130" width="130"></canvas>
                       
                    </div>
                    <h4><strong>{{ trans('businessdata.Enrollments') }}</strong></h4>
                </div>
                <div class="col-md-10 flexCenter">
                    <div>
                        <h3 class="bold">{{ $businessdata->CoutEnrollments }} {{ trans('businessdata.Enrollments') }} </h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Bibendum est ultricies integer quis. Iaculis urna id volutpat
                            lacus laoreet. Mauris vitae ultricies leo integer malesuada. Ac odio tempor orci dapibus
                            ultrices in. Egestas diam in arcu cursus euismod. Dictum fusce ut placerat orci nulla. Tincidunt
                            ornare massa eget egestas purus viverra accumsan in nisl. Tempor id eu nisl nunc
                        </p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('businessdata.Most Enrolled Courses') }}</h3>
                        </div>
                        <div class="panel-body">
                            <div id="demo-line-chart" class="ct-chart"></div>
                        </div>
                    </div>
                </div>
                
            </div>



        </div>
    </div>
@endsection
@push('js')
<script src="{{ asset('public/business') }}/vendor/chartist/js/chartist.min.js"></script>
<script>
    $(function() {
    var data, options;

    // enrollment-load pie chart
    var sysLoad = $('#enrollment-load').easyPieChart({
        size: 130,
        barColor: function(percent) {
            return (percent < 50 ? '#FF0000' : percent < 85 ? '#00CB14' : '#00CB14');
        },
        trackColor: 'rgba(245, 245, 245, 0.8)',
        scaleColor: false,
        lineWidth: 15,
        lineCap: "square",
        animate: 800
    });

    


});
    </script>
    <script>
        $(function() {
            var options;
    
            var data = {
                labels: [
                    @foreach($Enrollments as $key => $value)
                        '{{$value->courses['title_lang']}}',
                    @endforeach
                ],
                series: [
                    
                    [
    
                    @foreach($Enrollments as $key => $value)
                        '{{$value['Count']}}',
                    @endforeach
                    
                    
                    ],
                ]
            };
    
            // line chart
            options = {
                height: "300px",
                showPoint: true,
                axisX: {
                    showGrid: false
                },
                lineSmooth: false,
            };
    
            new Chartist.Line('#demo-line-chart', data, options);
    
    
    
    
    
    
            var options = {
                fullWidth: true,
                lineSmooth: false,
                height: "270px",
                low: 0,
                high: 'auto',
                series: {
                    'series-projection': {
                        showArea: true,
                        showPoint: false,
                        showLine: false
                    },
                },
                axisX: {
                    showGrid: false,
    
                },
                axisY: {
                    showGrid: false,
                    onlyInteger: true,
                    offset: 0,
                },
                chartPadding: {
                    left: 20,
                    right: 20
                }
            };
    
            new Chartist.Line('#multiple-chart', data, options);
    
        });
        </script>

<script>

$(document).ready(function() {
    $('#course-insights-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );


</script>
@endpush