@extends(layoutExtend('website'))

@section('title')
    {{ trans('institution.Institution Dashboard') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@push('css')
<style>
    .btn-default{
        background-color: #7e7e7e;
        color: aliceblue;
    }
    .partnership_form {
        width: 70%;
    }
</style>
@endpush

@section('content')

    <div class="bread-crumb">
        <div class="container">
            <a href="/"> {{ trans('website.home') }} </a> > <span>{{ trans('institution.Institution Dashboard') }}</span>
        </div>
    </div>

    <div class="page-title general-gred">
        <div class="container">
            <h1>{{ trans('institution.Institution Dashboard') }}</h1>
            <p class="mt-15">
            </p>

        </div>
    </div>

    <i class="divid"></i>

    <section class="settings-container">
        <div class="container">
            <div class="cntrls_btns">
                <a class="active  cntrl-btn">{{ trans('masterrequest.masterrequest') }}</a>
            </div>
            <div class="partnership_form">
                

               
                <table class="table table-responsive table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('masterrequest.name') }}</th>
                            <th>{{ trans('masterrequest.course name') }}</th>
                            <th>{{ trans('masterrequest.collage_name') }}</th>
                            <th>{{ trans('masterrequest.g_year') }}</th>
                            <th>{{ trans('masterrequest.yes') }}</th>
                            <th>{{ trans('masterrequest.show') }}</th>
                    </thead>
                    <tbody>
                        @if (count($items) > 0)
                            @foreach ($items as $d)
                                <tr>
                                    <td>
                                        {{ $d->user['name'] }}
                                    </td>
                                    <td>
                                        {{ $d->courses['title_lang'] }}
                                    </td>
                                    <td>
                                        {{ $d->collage_name }}
                                    </td>
                                    <td>
                                        {{ $d->g_year }}
                                    </td>
                                    <td>
                                        @if($d->status == 1)
                                            <span class="btn btn-success">{{ trans('masterrequest.yes') }}</span>
                                        @else
                                            <span class="btn btn-danger">{{ trans('masterrequest.no') }}</span>
                                        @endif
                                    </td>
                                    <td> @include("website.masterrequest.buttons.view", ["id" => $d->id])</td>

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @include(layoutPaginate() , ["items" => $items])

            </div>
        </div>
    </section>

@endsection
