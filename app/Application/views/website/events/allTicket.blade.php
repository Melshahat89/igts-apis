@extends(layoutEvents())
@section('title')
    {{ trans('eventsdata.Events Dashboard') }} | {{ trans('eventsdata.All Ticket') }}
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
            <h3 class="panel-title">{{ trans('eventsdata.All Ticket') }}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th>{{ trans('eventstickets.name') }}</th>
                        <th>{{ trans('eventstickets.email') }}</th>
                        <th>{{ trans('eventstickets.code') }}</th>
                
                        <th>{{ trans('events.delete') }}</th>
                </thead>
                <tbody>
                    @if (count($items) > 0)
                        @foreach ($items as $d)
                            <tr>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->email }}</td>
                                <td><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl={{ $d->code }}&choe=UTF-8" title="{{ $d->code }}" />
                                    </td>
                           

                                <td>
                                  <a  href="{{ url('eventstickets/'.$d->id.'/delete') }}" class="btn btn-primary" >
                                    <i class="fa fa-trash"></i>
                                  </a>
                                  
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @include(layoutPaginate() , ["items" => $items])
        </div>
    </div>

@endsection
