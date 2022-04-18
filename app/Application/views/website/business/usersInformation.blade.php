@extends(layoutBusiness())
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.Users information') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')

    <div class="panel panel-headline d-flex">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('businessdata.Users information') }}</h3>
           <button type="button" class="btn btn-primary" style="background-color: #3ebfb4; padding: 9px; display: none;"><i class="fas fa-download p-2" style="padding-right: 13px;"></i>Export Data</button>
            
        </div>

    
        <div class="panel-body">

            

            <span class="dividar-grey"></span>
            <div class="table-res-scroll">
                <table class="table table-striped" id="businessusers-table">
                    <thead>
                        <tr>
                           
                            <th>
                                <label class="fancy-checkbox">
													<input type="checkbox" onclick="toggle(this);">
													<span></span>
                                </label>
                            </th>
                            <th valign="center">{{ trans('businessdata.User Name') }}</th>
                            <th>{{ trans('businessdata.Email') }}</th>
                            <th>{{ trans('businessdata.Phone Number') }}</th>
                            <th>{{ trans('businessdata.Speciality') }}</th>
                            <th>{{ trans('businessdata.Group Name') }}</th>
                            @foreach($users[0]->businessusersdata->businessinputfields as $data)
                            <th>
                                {{$data->field_name}}
                            </th>
                            @endforeach
                            <th class="">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($users)
                            @foreach($users as $key => $user)   

<?php //dd($user->business); ?>
                                <tr>
                                    <td>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->specialization }}</td>
                                    <td>{{ (isset($user->businessgroupsusers) && count($user->businessgroupsusers) > 0) ? $user->businessgroupsusers[0]->businessgroups->name : '' }}</td>
                                    @foreach($users[0]->businessusersdata->businessinputfields as $data)
                                    <td>
                                        {{(getBusinessInputFieldResponses($data->id, $user->id)) ? getBusinessInputFieldResponses($data->id, $user->id)->answer : '' }}
                                    </td>
                                    @endforeach
                                    <td class="flexRight">
                                        <button type="button" class="btn btn-danger mr-15"><i class="lnr lnr-trash"></i></button>
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

@push('js')
<script>



$(document).ready(function() {
    $('#businessusers-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );


</script>
@endpush