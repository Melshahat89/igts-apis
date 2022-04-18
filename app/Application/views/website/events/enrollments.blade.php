@extends(layoutEvents())
@section('title')
    {{ trans('eventsdata.Events Dashboard') }} | {{ trans('eventsdata.enrollments') }}
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
            <h3 class="panel-title">{{ trans('eventsdata.enrollments') }}</h3>
        </div>

        <div class="flexCenter col-md-6" style="margin-bottom: 20px;">
                     <span class="mr-15">{{ trans('businessdata.Filter') }}</span>
                     <select name="filter-group" id="filter-group" class="form-control filter-group">
                        <option value=""></option>
                        @isset($Events)
                            @foreach ($Events as $event)
                                <option value="{{ $event->title_lang }}">{{ $event->title_lang }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
        
        <div class="panel-body">
            <table class="table table-responsive table-striped table-bordered" id="enrollments-table">
                <thead>
                    <tr>
                        <th>{{ trans('eventstickets.name') }}</th>
                        <th>{{ trans('eventstickets.email') }}</th>
                        <th>Mobile</th>
                        <th>Specialization</th>
                        <th>{{ trans('events.events') }}</th>
                        <th>{{ trans('events.Start Date') }}</th>
                </thead>
                <tbody>
                    @if (count($items) > 0)
                        @foreach ($items as $d)
                            <tr>
                                <td>{{ $d->user['name'] }}</td>
                                <td>{{ $d->user['email'] }}</td>
                                <td>{{ $d->user['mobile'] }}</td>
                                <td>{{ $d->user->categories2['name_lang'] }}</td>
                                <td>
                                   {{$d->events['title_lang']}}
                                </td>
                                <td>
                                    {{ $d->events['start_date'] }}
                                </td>
                           
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('js')
<script>
// DataTables initialisation
    table = $('#enrollments-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    $('#filter-group').change(function() {


if(table.column(4).search() !== $(this).val()) {

    table.column(4).search($(this).val()).draw();
}



});
</script>

@endpush