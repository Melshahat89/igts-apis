@extends(layoutBusiness())
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.User activity log') }}
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
            <h3 class="panel-title">{{ trans('businessdata.User activity log') }}</h3>
            
        </div>

        <div class="panel-body">
            <div class="row brdr-top brdr-bottom ptm-20 m-0">
                <div class="flexCenter col-md-6">
                    {{-- <span class="mr-15">{{ trans('businessdata.Filter') }}</span>
                    <select class="form-control">
                        <option value="Courses">Most Enrolled Courses</option>

                    </select> --}}
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
        
            <span class="dividar-grey"></span>
            <div class="table-res-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ trans('businessdata.User Name') }}</th>
                            <th>{{ trans('website.Email') }}</th>
                            <th>{{ trans('website.Courses') }}</th>
                            <th>
                                {{ trans('businessdata.Enrollment Date') }}
                            </th>
                            <th>
                                {{ trans('businessdata.Activity Log') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($Users)
                            @foreach ($Users as $key => $log)
                                <tr>
                                    <td>{{ $log['name'] }}</td>
                                    <td>{{ $log['email'] }}</td>
                                    <td>
                                        @if($log->courseenrollment)
                                            @foreach($log->courseenrollment as $key => $course)
                                                {{ $course['courses']['title_lang'] }} ,
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        {{ $log->created_at }}
                                    </td>
                                    <td>
                                        <a href="{{ url('business/user-activity/'.$log->id) }}" class="btn btn-primary"><i class="lnr lnr-chevron-right "></i></a>
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
