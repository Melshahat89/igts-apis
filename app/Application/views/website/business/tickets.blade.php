@extends(layoutBusiness())
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.tickets') }}
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
            <h3 class="panel-title">{{ trans('businessdata.tickets') }}</h3>
        </div>

        <div class="card-header no-bg b-a-0">
            
                                 
            <h2 class="pull-right">                   
                <a href="{{ url('tickets/item') }}" class="btn bg-cyan btn-icon m-r-xs m-b-xs waves-effect">        
                    <i class="fa fa-save"></i> Add Tickets
                </a> 
            <div class="clearfix"></div>
            </h2>
        </div>
        <div class="panel-body">

            <div class="row brdr-top brdr-bottom ptm-20 m-0">
                <div class="flexCenter col-md-6">
                   
                </div>
                <div class="col-md-6 mt-res-15">
                    
                </div>


            </div>

            <span class="dividar-grey"></span>
            <div class="table-res-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                <label class="fancy-checkbox">
                                    <span>ID</span>
                                </label>
                            </th>
                            <th valign="center">{{ trans('tickets.title') }}</th>
                            <th>{{ trans('tickets.message') }}</th>
                            <th>{{ trans('ticketsreplay.ticketsreplay') }}</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @isset($tickets)
                            @foreach($tickets as $key => $ticket)   
                                <tr>
                                    <td>
                                        <label class="fancy-checkbox">
                                            {{ ++$key }}
                                        </label>
                                    </td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->message }}</td>
                                    <td>
                                        <a href="{{url('business/tickets/replays/'.$ticket->id)}}">
                                            {{ trans('ticketsreplay.ticketsreplay') }}
                                        </a>

                                    </td>
                                    
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
