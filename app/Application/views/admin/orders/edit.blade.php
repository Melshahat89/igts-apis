@extends(layoutExtend())
 @section('title')
    {{ trans('orders.orders') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('orders.orders') , 'model' => 'orders' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
    <form action="{{ concatenateLangToUrl('lazyadmin/orders/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
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
            
            {{-- <div class="row contacts">
                <div class="col invoice-to">
                    <!-- START SELECT USER -->
                    <div class="form-group {{ $errors->has("user") ? "has-error" : "" }}">
                        <label for="user">{{ trans('orders.INVOICE TO:') }}</label>
                        @php $users = App\Application\Model\User::pluck("email" ,"id")->all()  @endphp
                        @php  $user_id = isset($item) ? $item->user_id : null @endphp
                        <select name="user_id"  class="form-control" >
                        @foreach( $users as $key => $relatedItem)
                        <option value="{{ $key }}" {{ $key == $user_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
                        @endforeach
                        </select>
                        @if ($errors->has("user"))
                            <div class="alert alert-danger">
                                <span class="help-block">
                                    <strong>{{ $errors->first("user") }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>
                    <!-- END SELECT USER -->
                    <div class="email"><a href="#"></a></div>
                </div>
                <div class="col invoice-details">
                    <h1 class="invoice-id">{{ trans('orders.INVOICE #') }} {{isset($item) ? $item->id : ''}}</h1>
                </div>
            </div> --}}

            <div class="row contacts">
                <div class="col invoice-to">
                    <!-- START SELECT USER -->
                    <div class="form-group {{ $errors->has("user") ? "has-error" : "" }}">
                        <label for="user">{{ trans('orders.INVOICE TO:') }}</label>
                        @php
                            use App\Application\Model\User;
                            $user_id = isset($item) ? $item->user_id : null 
                        @endphp
                        <select id="users-select" name="user_id"  class="form-control" >
                            <option value="{{ $user_id ? $user_id : '' }}">{{ $user_id ? User::findOrFail($user_id)->email : 'Select Email' }}</option>
                        </select>
                        @if ($errors->has("user"))
                            <div class="alert alert-danger">
                                <span class="help-block">
                                    <strong>{{ $errors->first("user") }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>
                    <!-- END SELECT USER -->
                    <div class="email"><a href="#"></a></div>
                </div>
                <div class="col invoice-details">
                    <h1 class="invoice-id">{{ trans('orders.INVOICE #') }} {{isset($item) ? $item->id : ''}}</h1>
                </div>
            </div>

            <div class="form-group {{ $errors->has("currency") ? "has-error" : "" }}">
                <label for="currency">{{ trans('orders.Select Currency') }}</label>
                <select name="currency"  class="form-control select2-input">
                    <option {{isset($item) && isset($item->payments) && $item->payments->currency_id == '34' ? 'selected' : ''}} value="EGP">EGP</option>
                    <option {{isset($item) && isset($item->payments) && $item->payments->currency_id != '34' ? 'selected' : ''}} value="USD">USD</option>
                </select>
            </div>
            
            <!-- <div class="form-group {{ $errors->has("installment") ? "has-error" : "" }}">
                <label for="installment">{{ trans('orders.Select Installment') }}</label>
                <select name="installment"  class="form-control select2-input">
                    <option value="0" selected>No</option>
                    <option value="1">Yes</option>
                </select>
            </div> -->
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-left">{{ trans('orders.ITEM') }}</th>
                        <th class="text-right">{{ trans('orders.PRICE') }}</th>
                        <th class="text-right">{{ trans('orders.ACTION') }}</th>
                        <th class="text-right">{{ trans('orders.TOTAL') }}</th>
                    </tr>
                </thead>
                @if($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger" role="alert"><strong>:message</strong></div>')) !!}
                @endif
                <tbody id="offlineorders-table-body">
                    @if(isset($item) && $item->ordersposition)
                    @php $counter = 1; $certificated = false; $sumCertificatesAmount = 0; @endphp
                    @foreach($item->ordersposition as $orderPosition)
                        @if($orderPosition->type == 3) <!-- TYPE CERTIFICATES -->
                            @php $sumCertificatesAmount += $orderPosition->amount; @endphp
                                @if(!$certificated)
                                    <tr class="courseitem">
                                        <td class="no">{{$counter++}}</td>
                                        <td class="text-left">
                                            @if(!$certificated && $orderPosition->certificate_id)
                                                {!! allCertificatesSelect($item) !!}
                                            @endif
                                        </td>
                                        <td class="unit">1</td>
                                        <td class="qty">
                                        <a class='button btn-danger'><span onclick='removeItem(this)' class='btn bg-deep-purple btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>delete</i></span></a>
                                        </td>
                                        <td class="total">
                                            <input id="cost-of-certificates" type="number" name="certificates-cost" class="cost-input">
                                        </td>
                                    </tr>
                                    @php $certificated = true; @endphp
                                @endif

                        @elseif($orderPosition->type == 1) <!-- TYPE COURSES -->
                            <tr class="courseitem">
                                <td class="no">{{$counter++}}</td>
                                <td class="text-left">
                                    {!! allCoursesSelect($orderPosition->courses) !!}
                                </td>
                                <td class="unit">1</td>
                                <td class="qty">
                                <a class='button btn-danger'><span onclick='removeItem(this)' class='btn bg-deep-purple btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>delete</i></span></a>
                                </td>
                                <td class="total">
                                    <input type="number" name="coursesCost[]" class="cost-input" value="{{ isset($item) ? $orderPosition->amount : 0 }}">
                                </td>
                            </tr>
                        @endif
                    
                    @endforeach
                    <script>
                        let certCostSum = {{$sumCertificatesAmount}};
                        let certCostInput = document.getElementById('cost-of-certificates');
                        certCostInput.value = certCostSum;
                        </script>
                    @endif
                </tbody>
                <tfoot>
                    
                   
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">GRAND TOTAL</td>
                        <td id="grand-total">
                            {{ isset($item) && isset($item->payments) ? $item->payments->amount : 0 }}
                        </td>
                    </tr>
                </tfoot>
            </table>
            <span class="btn btn-success" onclick="addNewCourseItem()">{{trans('orders.Add Course')}} <i class="fa fa-plus"></i></span>
            <span class="btn btn-success" onclick="addNewCertificateItem()">{{trans('orders.Add Certificate')}} <i class="fa fa-plus"></i></span>

            <input id="grand-total-input"  {{ isset($item) && isset($item->payments) ? 'value = ' . $item->payments->amount   : '' }} type="hidden" name="grand-total">

        </main>
        <footer>
        </footer>
    </div>
    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
    <div></div>
</div>
</div>

              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('orders.orders') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection

@section('script')
<script src="{{ url('/public/admin/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ url('/public/admin/js/search.js') }}"></script>

<script>
    $('.certificates').multiSelect(search("Certificates"));
    function search(name){
        return {
            selectableOptgroup: true,
            selectableHeader: "<input type='text' class='form-control' autocomplete='off'  placeholder='"+name+"'>",
            selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='"+name+"'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });
                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            }
        }
    }
</script>

<script>
$('#users-select').select2({
    ajax: {
        url: "/lazyadmin/loadAllUsers",
        method: "GET",
        dataType: "json",
        data: function(params)
        {
            return {
                searchTerm: params.term
            };
        },
        processResults: function(response){
            return {
                results:response
            };
        }
    }
});
</script>
@endsection