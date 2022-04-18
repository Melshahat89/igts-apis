@extends(layoutExtend('website'))
  @section('title')
    {{ trans('quizstudentsanswers.quizstudentsanswers') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('quizstudentsanswers') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("quizstudentsanswers.is_correct") }}</th>
     <td>
    {{ $item->is_correct == 1 ? trans("quizstudentsanswers.Yes") : trans("quizstudentsanswers.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizstudentsanswers.answered") }}</th>
     <td>
    {{ $item->answered == 1 ? trans("quizstudentsanswers.Yes") : trans("quizstudentsanswers.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizstudentsanswers.mark") }}</th>
     <td>{{ nl2br($item->mark) }}</td>
    </tr>
  </table>
          @include('website.quizstudentsanswers.buttons.delete' , ['id' => $item->id])
        @include('website.quizstudentsanswers.buttons.edit' , ['id' => $item->id])
</div>
@endsection
