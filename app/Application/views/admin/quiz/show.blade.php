@extends(layoutExtend())
  @section('title')
    {{ trans('quiz.quiz') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('quiz.quiz') , 'model' => 'quiz' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("quiz.title") }}</th>
     <td>{{ nl2br($item->title_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quiz.description") }}</th>
     <td>{{ nl2br($item->description_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quiz.instructions") }}</th>
     <td>{{ nl2br($item->instructions) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quiz.time") }}</th>
     <td>{{ nl2br($item->time) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quiz.time_in_mins") }}</th>
     <td>{{ nl2br($item->time_in_mins) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quiz.type") }}</th>
     <td>{{ nl2br($item->type) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quiz.pass_percentage") }}</th>
     <td>{{ nl2br($item->pass_percentage) }}</td>
    </tr>
  </table>
          @include('admin.quiz.buttons.delete' , ['id' => $item->id])
        @include('admin.quiz.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
