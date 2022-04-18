@extends(layoutExtend())
  @section('title')
    {{ trans('orders.orders') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('orders.orders') , 'model' => 'orders' , 'action' => trans('home.view')  ])
@php
use App\Application\Model\Ordersposition;
@endphp
    <div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a href="javascript:void(0)">
                            <img style="height: 100px;" src="{{ asset('public/website/business/new') }}/images/igts-logo.png" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a href="javascript:void(0)">
                            {{ trans('home.IGTS') }}
                            </a>
                        </h2>
                        <div>{{ trans('website.Address Text') }}</div>
                        <div>info@igtsservice.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">{{ trans('orders.INVOICE TO:') }}</div>
                        <h2 class="to">{{ $item->user->name }}</h2>
                        <div class="email"><a href="mailto:{{$item->user->email}}">{{ $item->user->email }}</a></div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">{{ trans('orders.INVOICE #') }} {{ $item->id }}</h1>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">{{ trans('orders.ITEM') }}</th>
                            <th class="text-right">{{ trans('orders.PRICE') }}</th>
                            <th class="text-right">{{ trans('orders.QUANTITY') }}</th>
                            <th class="text-right">{{ trans('orders.TOTAL') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php $counter = 1; $sum = 0; @endphp

                      @foreach($item->ordersposition as $orderposition)
                      @php $sum += $orderposition->amount; @endphp

                            <td class="no">{{ $counter++ }}</td>
                            <td class="text-left"><h3>
                                <a target="_blank" href="{{ ($orderposition->courses_id) ? '/courses/view/' . $orderposition->courses->slug : '#' }}">
                                {{ ($orderposition->type == Ordersposition::TYPE_CERTIFICATE && isset($orderposition->certificates)) ? $orderposition->certificates->title_lang : (($orderposition->type == Ordersposition::TYPE_Course && isset($orderposition->courses)) ? ($orderposition->courses->title_lang) : ('DIRECT PAY'))  }}
                                </a>
                                </h3>
                            </td>
                            <td class="unit">{{$orderposition->amount}} {{$orderposition->currency}}</td>
                            <td class="qty">1</td>
                            <td class="total">{{$orderposition->amount}} {{$orderposition->currency}}</td>
                        </tr>
                      @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>{{ $sum }} {{$item->ordersposition[0]->currency}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">STATUS</td>
                            <td>{{ ($item->payments && $item->status == 2) ? 'PAID' : 'UNPAID' }}</td>
                        </tr>
                        @if($item->payments && $item->status == 2)
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>{{ $item->payments->amount }} EGP</td>
                        </tr>
                        @endif
                    </tfoot>
                </table>
                @if(count($item->promotionusers) > 0)
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">The coupon code "{{$item->promotionusers[0]->promotions->code}}" was used in this order</div>
                </div>
                @endif
            </main>
            <footer>
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
          {{-- @include('admin.orders.buttons.delete' , ['id' => $item->id])
        @include('admin.orders.buttons.edit' , ['id' => $item->id]) --}}
    @endcomponent
@endsection
