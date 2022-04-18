@php $resources = App\Application\Model\Courseresources::where('courses_id', $id)->first();  @endphp

@if(isset($resources))
    <a href="{{ url('/lazyadmin/courseresources') }}" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
        <i class="file-icons">Resources</i>
    </a>
@else
    <button class="btn btn-danger">Missing</button>
@endif