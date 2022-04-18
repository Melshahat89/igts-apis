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

            <!-- TABBED CONTENT -->
            <div class="custom-tabs-line tabs-line-bottom left-aligned">
                <ul class="nav" role="tablist">
                    <li class="active"><a href="#tab-bottom-left2" role="tab" data-toggle="tab">{{ trans('businessdata.Notes') }}</a></li>
                    <li ><a href="#tab-bottom-left3" role="tab"
                            data-toggle="tab">{{ trans('businessdata.Courses Enrolled') }}</a></li>
                    <li><a href="#tab-bottom-left4" role="tab"
                            data-toggle="tab">{{ trans('businessdata.Finished Exams') }}</a></li>
                </ul>
            </div>

            <div class="tab-content">

                <div class="tab-pane fade active p-0 " id="tab-bottom-left2">
                    <h2>{{ trans('businessdata.Notes') }}</h2>
                </div>
                <div class="tab-pane fade " id="tab-bottom-left3">
                    <h2>{{ trans('businessdata.Courses Enrolled') }}</h2>
                    <div class="mt-40">
                        @isset($User->courseenrollment)
                            @foreach ($User->courseenrollment as $key => $enroll)
                                <div class="activity-card flexCenteralign flexColmres mt-30">
                                    <div class="mr-15">
                                        <img src="{{ large($enroll->courses['image']) }}" height="100px" class="img-circle"
                                            alt="Avatar">
                                    </div>
                                    <div>
                                        <h4 class="bold">{{ $enroll->courses['title_lang'] }}</h4>
                                        <p>
                                            {{ $enroll->courses['description_lang'] }}
                                        </p>
                                        <span>{{ $enroll->created_at }}</span>
                                    </div>
                                </div>
                            @endforeach

                        @endisset

                    </div>
                </div>
                <div class="tab-pane fade" id="tab-bottom-left4">
                    <h2>{{ trans('businessdata.Finished Exams') }}</h2>
                    <div class="mt-40">

                        @isset($FinishedExams)
                            @foreach($FinishedExams as $key => $exam)
                            <div class="activity-card flexCenteralign flexColmres mt-30">
                                <div class="mr-15">
                                    <img src="{{ large($exam['quiz']['courses']['image']) }}" height="100px" class="img-circle" alt="Avatar">
                                </div>
                                <div>
                                        <h4 class="bold">{{ $exam['quiz']['courses']['title_lang'] }}</h4>
                                        <p>
                                            {{ $exam['quiz']['courses']['description_lang'] }}
                                        </p>
                                        <span>{{ $exam['quiz']['title_lang'] }}</span> 
                                        <h2>{{ $exam['CurrentStudentPercentage'] }} %</h2>
                                </div>
                        </div> 
                            @endforeach
                            
                        @endisset
                        
                    </div>
                </div>
            </div>
            <!-- END TABBED CONTENT -->






        </div>
    </div>
@endsection
