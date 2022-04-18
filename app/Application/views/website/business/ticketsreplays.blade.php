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
            <h3 class="panel-title">{{ trans('ticketsreplay.ticketsreplay') }}</h3>
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
                            <th>{{ trans('tickets.message') }}</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @isset($Ticketsreplay)
                            @foreach($Ticketsreplay as $key => $replay)   
                                <tr>
                                    <td>
                                        <label class="fancy-checkbox">
                                            {{ ++$key }}
                                        </label>
                                    </td>
                                    <td>{{ $replay->message }}</td>
                                    
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
