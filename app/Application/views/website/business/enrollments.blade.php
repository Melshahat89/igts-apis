@extends(layoutBusiness())
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.Enrollments') }}
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
            <h3 class="panel-title">{{ trans('businessdata.Enrollments') }}</h3>
        </div>

        <div class="panel-body">

            <div class="row brdr-top brdr-bottom ptm-20 m-0">
                <div class="flexCenter col-md-6">
                     <span class="mr-15">{{ trans('businessdata.Filter') }}</span>
                     <select name="filter-group" id="filter-group" class="form-control filter-group">
                        <option value=""></option>
                        @isset($groups)
                            @foreach ($groups as $key => $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                

                <div class="col-md-6 mt-res-15">
                    {{-- <form>
                        <div class="input-group">
                            <input type="text" value="" class="form-control" placeholder="Search users by Course Name ...">
                            <span class="input-group-btn"><button type="button" class="btn btn-primary"><i
                                        class="lnr lnr-magnifier"></i></button></span>
                        </div>
                    </form> --}}
                </div>
            </div>

            <div class="form-group col-md-3">
            <input type="text" id="min" name="min" class="form-control datepicker2" placeholder="{{ trans('admin.from') }}" value="{{ request()->has('from') ? request()->get('from') : '' }}">
        </div>
        <div class="form-group col-md-3">
            <input type="text" id="max" name="max" class="form-control datepicker2" placeholder="{{ trans('admin.to') }}" value="{{ request()->has('to') ? request()->get('to') : '' }}">
        </div>
           

            <h3 class="custom-panel-title mt-40 mb-30 col-md-12">{{ trans('businessdata.Enrollments Activity Log') }}</h3>

            <span class="dividar-grey"></span>
            <div class="table-res-scroll">
                
                <table class="table table-striped" id="enrollments-table">
                    <thead>
                        <tr>
                            <th>{{ trans('businessdata.User Name') }}</th>
                            <th>{{ trans('businessdata.Course Name') }}</th>
                            <th>{{ trans('businessdata.Progress') }}</th>
                            <th>
                                {{ trans('businessdata.Enrollment Date') }}
                            </th>
                            <th>{{ trans('businessdata.Group Name') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($EnrollmentsLog)
                            @foreach ($EnrollmentsLog as $key => $log)
                                <tr>
                                    <td>{{ $log->user['name'] }}</td>
                                    <td>{{ $log->courses['title_lang'] }}</td>
                                    <td><div class="progress">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ round(\App\Application\Model\Progress::getLectureProgress($log->user['id'],$log->courses['id'])) }}%; color: black;">
													<span>{{ round(\App\Application\Model\Progress::getLectureProgress($log->user['id'],$log->courses['id'])) }}%</span>
												</div>
                                            </div></td>
                                            
                                    <td>
                                        {{ $log->created_at }}
                                    </td>
                                    <td>
                                    {{ (isset($log->user->businessgroupsusers) && count($log->user->businessgroupsusers) > 0) ? $log->user->businessgroupsusers[0]->businessgroups->name : '' }}
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Most Enrolled Courses</h3>
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
		var options;

		var data = {
			labels: [
                @php $i = 0; @endphp
                @foreach($Enrollments as $key => $value)
                @php $i++; @endphp
                @if($i <= 5)
                    '{{$value->courses['title_lang']}}',
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

var minDate, maxDate, table, groupValue;


// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();

        var date = new Date( data[3] );
        var group = data[4];
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max ) || (groupValue)
        ) {
            return true;
        }
        return false;
    }
);



$(document).ready(function() {

        // Create date inputs
        minDate = new DateTime($('#min'), {
    });
    maxDate = new DateTime($('#max'), {

    });

    groupValue = $('#filter-group option:selected').text();

 
    // DataTables initialisation
    table = $('#enrollments-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
 
    // Refilter the table
    $('#min, #max, #filter-group option:selected').on('change', function () {
        //alert('test');
        table.draw();
    });

 
    

} );


</script>
@endpush
