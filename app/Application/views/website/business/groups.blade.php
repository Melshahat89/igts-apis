@extends(layoutBusiness())
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.Groups') }}
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
            <h3 class="panel-title">{{ trans('businessdata.Create Group') }}</h3>
        </div>
        <div class="panel-body">
           
            <form action="{{ concatenateLangToUrl('business/addGroup') }}" method="post" enctype="multipart/form-data">
            
                {{ csrf_field() }}
                <ul class="list-unstyled activity-timeline">
                    
                    <li>
                        <span class="activity-icon">1</span>
                        <div>
                            <h4>{{ trans('businessdata.Group Name') }}</h4>
                            <input type="text" name="name" class="form-control" placeholder="General Group" value="{{ (isset($group)) ? $group->name : "" }}">
                        </div>
                    </li>

                    <li>
										<span class="activity-icon">2</span>
										<div>
                                            <h4>Assign Courses to the group</h4>


                                            <select multiple="multiple" class="multi-select select2" id="businessgroupscourses" name="businessgroupscourses[]" style="width: 100%">
                                            @php $categoriesArr = array(); @endphp   
                                            @foreach($businessCourses as $course)
                                                @if(!in_array($course->categories->id, $categoriesArr))
                                               <optgroup label="{{$course->categories->name_lang}}" value="{{$course->categories->id}}">
                                                    @foreach($course->categories->courses as $course)
                                                        @if(in_array($course->title_lang, $businessCoursesArr))
                                                        <option value="{{$course->id}}"> {{ $course->title_lang }} </option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                                @php array_push($categoriesArr, $course->categories->id); @endphp
                                                @endif
                                            @endforeach
                                            </select>
                                            

											<div class="clear"></div>
										</div>
									</li>

                </ul>

                <div class="flexRight mt-40">
                    <button type="submit" class="btn btn-primary btn-lg">{{ trans('businessdata.add') }}</button>
                </div>
            </form>



            <span class="dividar-grey mt-30 mb-30"></span>

            <div class="panel-heading">
                <h3 class="panel-title m-0">{{ trans('businessdata.Groups') }}</h3>
            </div>

            <span class="dividar-grey"></span>

            @isset($allGroups)
                <div class="table-res-scroll">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th valign="center">{{ trans('businessdata.Group Name') }}</th>
                                <th>Courses</th>

                                <th class="flexRight">

                                    <!-- <button type="button" class="btn btn-danger mr-15"><i class="lnr lnr-trash"></i></button> -->

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allGroups as $key => $group)
                                <tr>
                                    <td>
                                        <label class="fancy-checkbox">

                                            <span>{{ $group->id }}</span>
                                        </label>
                                    </td>
                                    <td>{{ $group->name }}</td>
                                    <td>
                                    @foreach($group->businessgroupscourses as $course)
                                    {{$course->title_lang}}, 
                                    @endforeach
                                    </td>

                                    <td class="flexRight">
                                        <a type="button" href="{{ url('businessgroups/' . $group->id . '/delete') }}"
                                            class="btn btn-danger mr-15"><i class="lnr lnr-trash"></i></a>
                                            <a type="button" href="{{ url('business/editgroup/' . $group->id) }}"
                                            class="btn btn-success mr-15"><i class="lnr lnr-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endisset
        </div>
    </div>

@endsection
