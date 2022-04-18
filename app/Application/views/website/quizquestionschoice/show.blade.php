@extends(layoutExtend('website'))
  @section('title')
    {{ trans('quizquestionschoice.quizquestionschoice') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('quizquestionschoice') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("quizquestionschoice.choice") }}</th>
     <td>{{ nl2br($item->choice_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizquestionschoice.is_correct") }}</th>
     <td>
    {{ $item->is_correct == 1 ? trans("quizquestionschoice.Yes") : trans("quizquestionschoice.No")  }}
     </td>
    </tr>
  </table>
          @include('website.quizquestionschoice.buttons.delete' , ['id' => $item->id])
        @include('website.quizquestionschoice.buttons.edit' , ['id' => $item->id])
</div>
@endsection
