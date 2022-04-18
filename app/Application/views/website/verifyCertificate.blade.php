@extends(layoutExtend('website'))
 
@section('title')
    {{ trans('page.Certificate Verification') }}
@endsection
 
@section('content')

@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('page.Certificate Verification')]) 

<div class="container p-4">

<form id="verify-certificate" class="validate_form mtlg"
                action="{{ concatenateLangToUrl('verifycertificate') }}"
                method="post" >
                {{ csrf_field() }}

    <label class="m-2" style="font-weight: bold;" for="certificate_id">{{trans('page.Certificate ID')}}</label>
        <input id="certificate_id" type="text"
            class="form-control input-item user-login-ico" name="certificate_id"
            placeholder='* {{ trans('page.Certificate ID') }}' aria-label="pages.certificate id"
            required autofocus>


            <div class="col-md-12 mt-20 mb-20">
                        <div class="flexRight">
                            <button type="submit" class="btn btn-secondary">
                                {{ trans('page.search') }} <i class="flaticon-right-arrow-1"></i>
                            </button>
                        </div>
                    </div>
</form>

@if(isset($certificate))
    <table class="table" id="certificatesVerification">
        <thead>
            <tr>
                <th>
                    Certificate ID
                </th>
                <th>
                    Student
                </th>
                <th>
                    Course
                </th>
                <th>
                    Certified at
                </th>
                <th>
                    Certificate
                </th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        {{$certificate->id}}
                    </td>
                    <td>
                        {{$certificate->user->name}}
                    </td>
                    <td>
                        {{$certificate->quiz->courses->title_lang}}
                    </td>
                    <td>
                        {{$certificate->created_at}}
                    </td>
                    <td>
                        <a type="button" href="{{ url(env('CERTIFICATE_PATH_1') . '/' . getCertificateFromId($certificate->id)) }}" target="_blank" class="btn btn-primary certBtn" id="{{$certificate->id}}">{{trans('page.View')}}</a>
                    </td>

                </tr>
        </tbody>
    </table>
    @endif
</div>
 
 
 
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

@endpush
 
@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>


<script>
$(document).ready(function() {
    $('#certificatesVerification').DataTable( {
        searching: false,
        "lengthChange": false, // Will Disabled Record number per page
        "info": true,         // Will show "1 to n of n entries" Text at bottom
        "scrollX": true,


        "order": [[0, "desc"]]

    } );
} );


</script>

@endpush
