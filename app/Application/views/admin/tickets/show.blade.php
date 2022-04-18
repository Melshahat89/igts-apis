@extends(layoutExtend())
  @section('title')
    {{ trans('tickets.tickets') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('tickets.tickets') , 'model' => 'tickets' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans( "user.user") }}</th>
     <td>
      @php $user = App\Application\Model\User::find($item->user_id);  @endphp
      {{ is_json($user->name) ? getDefaultValueKey($user->name) :  $user->name}}
     </td>
    </tr>
    {{--  <tr>
      <th width="200">{{ trans("tickets.status") }}</th>
      <td>{{ nl2br($item->status) }}</td>
    </tr>  --}}
    {{--  <tr>
    <th width="200">{{ trans("tickets.type") }}</th>
     <td>{{ nl2br($item->type) }}</td>
    </tr>  --}}
    <tr>
    <th width="200">{{ trans("tickets.title") }}</th>
     <td>{{ nl2br($item->title) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("tickets.message") }}</th>
     <td>{{ nl2br($item->message) }}</td>
    </tr>
    {{--  <tr>
    <th width="200">{{ trans("tickets.priority") }}</th>
     <td>{{ nl2br($item->priority) }}</td>
    </tr>  --}}
  </table>
          {{--  @include('admin.tickets.buttons.delete' , ['id' => $item->id])  --}}
        {{--  @include('admin.tickets.buttons.edit' , ['id' => $item->id])  --}}
    @endcomponent


    @if($data['replay'])
      <h2> Replay </h2>
      <table class="table table-bordered  table-striped" > 
        @foreach($data['replay'] as $key => $value)
          <th width="200">{{ trans("tickets.message") }}</th>
            <td>{{ nl2br($value->message) }}</td>
          </tr>
        @endforeach      
      </table>

    @endif
@endsection
