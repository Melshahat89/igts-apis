@extends(layoutEvents())
@section('title')
    {{ trans('eventsdata.Events Dashboard') }} | {{ trans('eventsdata.All') }}
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
            <h3 class="panel-title">{{ trans('eventsdata.All') }}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th>{{ trans('events.title') }}</th>
                        <th>{{ trans('events.show') }}</th>
                        <th>{{ trans('events.delete') }}</th>
                </thead>
                <tbody>
                    @if (count($items) > 0)
                        @foreach ($items as $d)
                            <tr>
                                <td>{{ str_limit($d->title_lang, 20) }}</td>
                                <td>
                                    <a href="{{ url('events/add-event/' . $d->id) }}" class="btn btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                                <td>
                                  <a  href="{{ url('events/'.$d->id.'/delete') }}" class="btn btn-primary" >
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
