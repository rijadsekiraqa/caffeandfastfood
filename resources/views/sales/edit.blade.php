    @extends('layouts.header')

    @section('content')
    @include('layouts.sidebar')
    <style>
    #sales-panel {
    height: 93vh;
    }

    #panel-left, #item-list {
    background: rgb(255 255 255 / 17%);
    }

    #item-list {
    height: 60%;
    }
    </style>
    <div class="content-wrapper" style="min-height: 567.854px;">

    <!-- Main content -->
    <section class="content  text-dark">
    <div class="container-fluid">
    <div class="content py-3">
    <div class="container-fluid">
    <div class="card card-outline card-outline rounded-0 shadow blur">
    <div class="card-header">
    <h5 class="card-title">Shitje e Re</h5>
    </div>
    <div class="card-body">
    <div class="container-fluid">
    <form method="post" action="{{ route('sales.update',['sale' => $sale->id]) }}"
    id="sale-form">
    @csrf
    @method("PUT")
    <input type="hidden" name="id" value="">
    <input type="hidden" name="amount" value="">
    <div class="border rounded-0 shadow bg-gradient-navy px-1 py-1"
    id="sales-panel">
    <div class="d-flex h-100 w-100">
    <div class="col-7 px-0 h-100" id="panel-left">
        <div
            class="card card-primary bg-transparent border-0 h-100 card-tabs rounded-0">
            <div class="card-header bg-gradient-dark p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab"
                    role="tablist">
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link"
                               id="custom-tabs-one-{{ $category->id }}-tab"
                               data-toggle="pill"
                               href="#cat-tab-{{ $category->id }}"
                               aria-selected="">
                                {{ $category->name }} <!-- Assuming you have a 'name' column in your categories table -->
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    @foreach($categories as $category)
                        <div class="tab-pane fade"
                             id="cat-tab-{{ $category->id }}"
                             role="tabpanel"
                             aria-labelledby="cat-tab-{{ $category->id }}-tab">
                            <div class="row">
                                @foreach($category->products as $product)
                                    <div
                                        class="col-lg-3 col-md-4 col-sm-12 col-xs-12 px-2 py-3">
                                        <a href="javascript:void(0)"
                                           class="card rounded-pill text-dark text-decoration-none prod-item"
                                           data-price="{{ $product->price }}"
                                           data-id="{{ $product->id }}">
                                            <div
                                                class="card-body text-center">
                                                {{ $product->name }}
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="col-5 h-100">
        <table class="table table-bordered table-striped mb-0 ">
            <colgroup>
                <col width="20%">
                <col width="45%">
                <col width="25%">
                <col width="10%">
            </colgroup>
            <thead>
            <tr class="bg-gradient-navy-dark">
                <th class="text-center px-2 py-1">Sasia</th>
                <th class="text-center px-2 py-1">Produkti</th>
                <th class="text-center px-2 py-1">Qmimi</th>
                <th class="text-center px-2 py-1"></th>
            </tr>
            </thead>
            <tbody>
            <tr></tr>
            </tbody>
        </table>
        <div id="item-list" class="overflow-auto">
            <table class="table table-bordered table-striped "
                   id="product-list">
                <colgroup>
                    <col width="20%">
                    <col width="45%">
                    <col width="25%">
                    <col width="10%">
                </colgroup>
                <tbody>
                @foreach($sale->salesProducts as $salesProduct)
                    <tr>
                        <td class="px-2 py-1 align-middle">
                            <input type="hidden" name="product_id[]"
                                   value="{{ $salesProduct->product->id }}">
                            <input type="hidden" name="product_price[]"
                                   value="{{$salesProduct->product->price}}">
                            <input type="number"
                                   class="form-control form-control-sm rounded-0 text-center"
                                   min="0" name="product_qty[]"
                                   value="{{$salesProduct->qty}}" required>
                        </td>
                        <td class="px-2 py-1 align-middle"
                            style="line-height:.9em">
                            <p class="product_name m-0 truncate-1 text-center">{{ $salesProduct->product->name }}</p>
                            <p class="m-0 text-center"><small
                                    class="product_price">x {{ number_format ($salesProduct->product->price, 2) }}</small>
                            </p>
                        </td>
                        <td class="px-2 py-1 align-middle text-right product_total"> {{ number_format($salesProduct->qty * $salesProduct->price, 2) }}</td>
                        <td class="px-2 py-1 align-middle text-center">
                            <button
                                class="btn btn-outline-danger border-0 btn-sm rounded-0 rem-product p-1"
                                type="button"><i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <h3 class="text-light w-100 d-flex">
            <div class="col-auto">Totali:</div>
            <div
                class="col-auto flex-shrink-1 flex-grow-1 truncate-1 text-right"
                id="amount">{{ number_format($sale->amount, 2) }}</div>
        </h3>
        <h3 class="d-flex w-100 align-items-center">
            <div class="col-4">Paguar:</div>
            <div class="col-8">
                <input type="text" pattern="[0-9\.]*$"
                       class="form-control form-control-lg rounded-0 text-right"
                       id="tendered" name="tendered" value="" required/>
            </div>
        </h3>
        <h3 class="d-flex w-100 align-items-center">
            <div class="col-4">Kthimi:</div>
            <div class="col-8">
                <input type="text" pattern="[0-9\.]*$"
                       class="form-control form-control-lg rounded-0 text-right"
                       id="change" name="return" value="{{$sale->return}}"
                       readonly/>
            </div>
        </h3>
        <input type="text" id="payment_code"
               class="form-control form-control-sm rounded-0 d-none"
               name="payment_code" value="" placeholder="Payment Code">
    </div>
    </div>
    </div>
    <div class="card-footer py-5 text-right">
    <button type="submit" class="btn btn-primary rounded-0" form="sale-form">
    Ruaj
    </button>
    <a class="btn btn-default border rounded-0" href="{{route('sales.index')}}">Kthehu</a>
    </div>
    </form>
    </div>
    </div>

    </div>
    </div>
    </div>
    </div>
    </section>
    </div>

    <noscript id="product-clone">
    <tr>
    <td class="px-2 py-1 align-middle">
    <input type="hidden" name="product_id[]">
    <input type="hidden" name="product_price[]">
    <input type="number" class="form-control form-control-sm rounded-0 text-center" min="0"
    name="product_qty[]" value="{{$salesProduct->qty}}" required>
    </td>
    <td class="px-2 py-1 align-middle text-center" style="line-height:.9em">
    <p class="product_name m-0">sasasasa</p>
    <p class="m-0"><small class="product_price">x 123.00</small></p>
    </td>
    <td class="px-2 py-1 align-middle text-right product_total"></td>
    <td class="px-2 py-1 align-middle text-center">
    <button class="btn btn-outline-danger border-0 btn-sm rounded-0 rem-product p-1" type="button"><i
    class="fa fa-times"></i></button>
    </td>
    </tr>
    </noscript>
    {{--    <script>--}}

    {{--        function calc_change() {--}}
    {{--            var amount = parseFloat($('[name="amount"]').val()) || 0;--}}
    {{--            var tendered = parseFloat($('[name="tendered"]').val()) || 0;--}}
    {{--            var change = tendered - amount;--}}

    {{--            // Display the change value with two decimal places--}}
    {{--            $('#change').val(change.toFixed(2).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));--}}
    {{--        }--}}
    {{--        function calc_total_amount() {--}}
    {{--            var total = 0;--}}
    {{--            $('#product-list tbody tr').each(function () {--}}
    {{--                var qty = parseFloat($(this).find('[name="product_qty[]"]').val()) || 0;--}}
    {{--                total += (parseFloat($(this).find('[name="product_price[]"]').val()) * qty);--}}
    {{--            });--}}

    {{--            // Round the total amount to 2 decimal places--}}
    {{--            total = total.toFixed(2);--}}

    {{--            $('[name="amount"]').val(total);--}}
    {{--            $('#amount').text(total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));--}}
    {{--            calc_change();--}}
    {{--        }--}}
    {{--        function calc_product() {--}}
    {{--            var total = 0;--}}
    {{--            $('#product-list tbody tr').each(function () {--}}
    {{--                var qty = parseFloat($(this).find('[name="product_qty[]"]').val()) || 0;--}}
    {{--                var price = parseFloat($(this).find('[name="product_price[]"]').val()) || 0;--}}

    {{--                // Ensure qty is at least 1--}}
    {{--                qty = Math.max(1, qty);--}}
    {{--                $(this).find('[name="product_qty[]"]').val(Math.round(qty)); // Round the quantity to the nearest whole number--}}

    {{--                var productTotal = qty * price;--}}
    {{--                total += productTotal;--}}

    {{--                $(this).find('.product_total').text(productTotal.toFixed(2));--}}
    {{--            });--}}

    {{--            $('#product_total').text(total.toFixed(2));--}}
    {{--            calc_total_amount();--}}
    {{--        }--}}

    {{--        $(function(){--}}
    {{--            $('body').addClass('sidebar-collapse')--}}
    {{--            $('#payment_type').change(function(){--}}
    {{--                var type = $(this).val()--}}
    {{--                if(type == 1){--}}
    {{--                    $('#payment_code').addClass('d-none').attr('required', false)--}}
    {{--                }else{--}}
    {{--                    $('#payment_code').removeClass('d-none').attr('required', true)--}}
    {{--                }--}}
    {{--            })--}}
    {{--            $('#product-list tbody tr').find('.rem-product').click(function(){--}}
    {{--                var tr = $(this).closest('tr')--}}
    {{--                if(confirm("Are you sure to remove "+(tr.find('.product_name').text())+" from product list?") === true){--}}
    {{--                    tr.remove()--}}
    {{--                    calc_product()--}}
    {{--                }--}}
    {{--            })--}}
    {{--            $('#product-list tbody tr').find('[name="product_qty[]"]').on('input change', function(){--}}
    {{--                var tr = $(this).closest('tr')--}}
    {{--                var price = tr.find('[name="product_price[]"]').val()--}}
    {{--                var qty = $(this).val()--}}
    {{--                qty = qty > 0 ? qty : 0--}}
    {{--                price = price > 0 ? price : 0--}}
    {{--                var total = parseFloat(qty) * parseFloat(price)--}}
    {{--                tr.find('.product_total').text(parseFloat(total).toLocaleString())--}}
    {{--                calc_product()--}}

    {{--            })--}}
    {{--            $('#tendered').on('input',function(){--}}
    {{--                calc_change()--}}
    {{--            })--}}
    {{--            $('.prod-item').click(function () {--}}
    {{--                var id = $(this).attr('data-id');--}}
    {{--                if ($('#product-list tbody tr input[name="product_id[]"][value="' + id + '"]').length > 0) {--}}
    {{--                    alert("Produkti eshte ne listen e shitjeve");--}}
    {{--                    return false;--}}
    {{--                }--}}

    {{--                var name = ($(this).find('.card-body').text()).trim();--}}
    {{--                var price = $(this).attr('data-price');--}}
    {{--                var tr = $($('noscript#product-clone').html()).clone();--}}

    {{--                tr.find('input[name="product_id[]"]').val(id);--}}
    {{--                tr.find('input[name="product_price[]"]').val(price);--}}
    {{--                tr.find('input[name="product_qty[]"]').val(1); // Set the default quantity to 1 for new products--}}

    {{--                tr.find('.product_name').text(name);--}}
    {{--                tr.find('.product_price').text('x ' + parseFloat(price).toLocaleString());--}}
    {{--                tr.find('.product_total').text(parseFloat(price).toLocaleString());--}}

    {{--                $('#product-list tbody').append(tr);--}}
    {{--                calc_product();--}}

    {{--                tr.find('.rem-product').click(function () {--}}
    {{--                    if (confirm("A jeni i sigurt qe doni ta fshini " + name + " nga lista e shitjeve?") === true) {--}}
    {{--                        tr.remove();--}}
    {{--                        calc_product();--}}
    {{--                    }--}}
    {{--                });--}}

    {{--                tr.find('[name="product_qty[]"]').on('input change', function () {--}}
    {{--                    var qty = $(this).val();--}}
    {{--                    qty = qty > 0 ? qty : 0;--}}
    {{--                    var total = parseFloat(qty) * parseFloat(price);--}}
    {{--                    tr.find('.product_total').text(parseFloat(total).toLocaleString());--}}
    {{--                    calc_product();--}}
    {{--                });--}}
    {{--            });--}}


    {{--        })--}}
    {{--    </script>--}}

    @push('scripts')
    <script src="{{ asset('js/calcproduct.js') }}"></script>
    @endpush
    @include('layouts.footer-admin')
    @endsection
