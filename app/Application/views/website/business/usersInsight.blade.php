@extends(layoutBusiness())
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.Users insight') }}
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
            <h3 class="panel-title">{{ trans('businessdata.Users insight') }}</h3>
        </div>

        <div class="panel-body">
            <div class="table-res-scroll">
                <table class="table table-striped" id="user-insights-table">
                    <thead>
                        <tr>
                            
                            <th>{{ trans('businessdata.Users') }}</th>
                            <th>{{ trans('businessdata.Enrollment Courses') }}</th>
                            <th>{{ trans('businessdata.Passed Exams') }}</th>
                            <th>
                                {{ trans('businessdata.Activity') }}
                            </th>
                            <th>
                               {{ trans('businessdata.Appreciation') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @isset($Enrollments)
                        @foreach($Enrollments as $key => $user)
                            <tr>
                                <td>{{ $user->user['name'] }}</td>
                                <td>{{ $user->Count }} {{ trans('website.courses') }}</td>
                                <td>{{ count($user->user->passedexams) }}</td>
                                <td>
                                    <a href="{{ url('business/user-activity/'.$user->user_id) }}" class="btn btn-primary"><i class="lnr lnr-chevron-right "></i></a>
                                </td>
                                <td><button type="button" onclick="sendCertificate()" class="btn btn-primary mr-15"><i class="lnr lnr-plus-circle"></i></button></td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
        </table>
            </div>
            <div class="row mt-40">
                
                <div class="col-md-8 flexLeft">
                    <div>
                        <h3 class="bold">{{ trans('businessdata.Activity Insight') }} </h3>
                        
                    </div>
                </div>

                <div class="col-md-2 text-center">
                    <div id="active-load" class="easy-pie-chart" data-percent="{{$businessdata->ActiveUsers}}">
                        <span class="percent">{{ $businessdata->ActiveUsers }}</span>
                    <canvas height="130" width="130"></canvas>
                    </div>
                    <h4><strong>{{ trans('businessdata.Active Users') }}</strong></h4>
                </div>

                <div class="col-md-2 text-center" style="display: none;">
                    <div id="pending-load" class="easy-pie-chart" data-percent="{{ ($businessdata->InActiveUsers > 0)?(count($businessdata->mystudents)/$businessdata->InActiveUsers):0 }}">
                        <span class="percent">{{ $businessdata->InActiveUsers }}</span>
                    <canvas height="130" width="130"></canvas>
                    </div>
                    <h4><strong>{{ trans('businessdata.In Active Users') }}</strong></h4>
                </div>

            </div>
        
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('businessdata.Most Enrolled Users') }}</h3>
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

    // active-load pie chart
    var sysLoad = $('#active-load').easyPieChart({
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


    // pending-load pie chart
    var sysLoad = $('#pending-load').easyPieChart({
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
                    @php $i = 0; @endphp
                    @foreach($Enrollments as $key => $value)
                    @php $i++; @endphp
                    @if($i <= 5)
                        '{{$value->user['name']}}',
                    @endif
                    @endforeach
                ],
                series: [
                    
                    [

                    @php $i = 0; @endphp
                    @foreach($Enrollments as $key => $value)
                    @php $i++; @endphp
                    @if($i <= 5)
                        '{{$value['Count']}}',
                    @endif
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
    $('#user-insights-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );


</script>

<script>

    function sendCertificate() {

        var proceed = confirm('Are you sure you want to send this user a certificate of appreciation for his/her hardwork?');
        if(proceed){
            alert("done");
        } else {

        }

    }

</script>
@endpush