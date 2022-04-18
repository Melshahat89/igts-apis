@extends(layoutExtend())

@section('title')
    {{ trans('certificates.certificates') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('certificates.certificates') , 'model' => 'certificates' , 'action' => trans('home.view')  ])
        <table class="table table-bordered table-striped">
            <tr>
                <th width="150">{{ trans("certificates.title") }}</th>
                <td>{{ nl2br($item->title_lang) }}</td>
            </tr>
        </table>

        @include('admin.certificates.buttons.delete' , ['id' => $item->id])
        @include('admin.certificates.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
