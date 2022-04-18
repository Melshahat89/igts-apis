<div class="tabs-container">
    <ul class="nav nav-pills flexBetween custom-tab" id="pills-tab" role="tablist" style="width: {{($tabsWidth) ? $tabsWidth:35 }}%; justify-content: center;">
        
        <li class="nav-item">
            <a class="nav-link {{ ($active == 'all') ? 'active' : '' }}" href="#" onclick="window.location='{{ ($key) ? url('allcourses/category?key=' . $key) : url('allcourses/category') }}'" > {{ trans('website.All') }} </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ ($active == 'courses') ? 'active' : '' }}" href="#" onclick="window.location='{{ ($key) ? url('courses/category?key=' . $key) : (($slug) ?  url('courses/category/' . $slug) : url('courses/category')) }}'" > {{ trans('website.Courses') }} </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ ($active == 'diplomas') ? 'active' : '' }}" href="#" onclick="window.location='{{ ($key) ? url('diplomas/category?key=' . $key) : (($slug) ?  url('diplomas/category/' . $slug) : url('diplomas/category')) }}'" > {{ trans('home.diplomas') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ ($active == 'masters') ? 'active' : '' }}" href="#" onclick="window.location='{{ ($key) ? url('masters/category?key=' . $key) : (($slug) ?  url('masters/category/' . $slug) : url('masters/category')) }}'"> {{ trans('website.Masters') }}</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ ($active == 'bundles') ? 'active' : '' }}" href="#" onclick="window.location='{{ ($key) ? url('bundles/category?key=' . $key) : (($slug) ?  url('bundles/category/' . $slug) : url('bundles/category')) }}'" > {{ trans('website.Bundles') }}</a>
        </li>

        <li class="nav-item d-none">
            <a class="nav-link {{ ($active == 'events') ? 'active' : '' }}" href="#" onclick="window.location='{{ ($key) ? url('events/category?key=' . $key) : (($slug) ?  url('events/category/' . $slug) : url('events/category')) }}'"> {{ trans('website.events') }}</a>
        </li>
        
        <li class="nav-item d-none">
            <a class="nav-link {{ ($active == 'talks') ? 'active' : '' }}" href="#" onclick="window.location='{{ ($key) ? url('talks/category?key=' . $key) : (($slug) ?  url('talks/category/' . $slug) : url('talks/category')) }}'"> {{ trans('website.Free Talks') }}</a>
        </li>

    </ul>
</div>