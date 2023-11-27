@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')
<style>
    #sales-panel{
        height:93vh;
    }
    #panel-left, #item-list{
        background:rgb(255 255 255 / 17%);
    }
    #item-list{
        height:60%;
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
                    <form method="post" action="/sales" id="sale-form">
                        @csrf
                        @method("POST")

                        <input type="hidden" name="amount" value="">
                        <div class="border rounded-0 shadow bg-gradient-navy px-1 py-1" id="sales-panel">
                            <div class="d-flex h-100 w-100">
                                <div class="col-7 px-0 h-100" id="panel-left">
                                    <div class="card card-primary bg-transparent border-0 h-100 card-tabs rounded-0">
                                        <div class="card-header bg-gradient-dark p-0 pt-1">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                @foreach($categories as $category)
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="custom-tabs-one-{{ $category->id }}-tab" data-toggle="pill" href="#cat-tab-{{ $category->id }}" aria-selected="">
                                                            {{ $category->name }} <!-- Assuming you have a 'name' column in your categories table -->
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                @foreach($categories as $category)
                                                    <div class="tab-pane fade" id="cat-tab-{{ $category->id }}" role="tabpanel" aria-labelledby="cat-tab-{{ $category->id }}-tab">
                                                        <div class="row">
                                                            @foreach($category->products as $product)
                                                                <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 px-2 py-3">
                                                                    <a href="javascript:void(0)" class="card rounded-pill text-dark text-decoration-none prod-item" data-price="{{ $product->price }}" data-id="{{ $product->id }}">
                                                                        <div class="card-body text-center">
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
                                            <th class="text-center px-2 py-1">Totali</th>
                                            <th class="text-center px-2 py-1"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr></tr>
                                        </tbody>
                                    </table>
                                    <div id="item-list" class="overflow-auto">
                                        <table class="table table-bordered table-striped " id="product-list">
                                            <colgroup>
                                                <col width="20%">
                                                <col width="45%">
                                                <col width="25%">
                                                <col width="10%">
                                            </colgroup>
                                            <tbody>
{{--                                            <tr>--}}
{{--                                                <td class="px-2 py-1 align-middle">--}}
{{--                                                    <input type="hidden" name="product_id[]" value="">--}}
{{--                                                    <input type="hidden" name="product_price[]" value="">--}}
{{--                                                    <input type="number" class="form-control form-control-sm rounded-0 text-center" min="0" name="product_qty[]" value="" required>--}}
{{--                                                </td>--}}
{{--                                                <td class="px-2 py-1 align-middle" style="line-height:.9em">--}}
{{--                                                    <p class="product_name m-0 truncate-1"></p>--}}
{{--                                                    <p class="m-0"><small class="product_price">x </small></p>--}}
{{--                                                </td>--}}
{{--                                                <td class="px-2 py-1 align-middle text-right product_total"></td>--}}
{{--                                                <td class="px-2 py-1 align-middle text-center"><button class="btn btn-outline-danger border-0 btn-sm rounded-0 rem-product p-1" type="button"><i class="fa fa-times"></i></button></td>--}}
{{--                                            </tr>--}}

                                            </tbody>

                                        </table>
                                    </div>
                                    <h3 class="text-light w-100 d-flex">
                                        <div class="col-auto">Totali:</div>
                                        <div class="col-auto flex-shrink-1 flex-grow-1 truncate-1 text-right" id="amount"></div>
                                    </h3>
                                    <h3 class="d-flex w-100 align-items-center">
                                        <div class="col-4">Paguar:</div>
                                        <div class="col-8">
                                            <input type="text" pattern="[0-9\.]*$" class="form-control form-control-lg rounded-0 text-right" id="tendered" name="tendered" value="" required />
                                        </div>
                                    </h3>
                                    <h3 class="d-flex w-100 align-items-center">
                                        <div class="col-4">Kthimi:</div>
                                        <div class="col-8">
                                            <input type="text" pattern="[0-9\.]*$" class="form-control form-control-lg rounded-0 text-right" id="change" name="return" value="" readonly />
                                        </div>
                                    </h3>
                                    <input type="text" id="payment_code" class="form-control form-control-sm rounded-0 d-none" name="payment_code" value="" placeholder="Payment Code">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer py-5 text-right">
                <button class="btn btn-primary rounded-0" form="sale-form">Ruaj</button>
                <a class="btn btn-default border rounded-0" href="{{route('sales.index')}}">Kthehu</a>
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
            <input type="number" class="form-control form-control-sm rounded-0 text-center" min="0" name="product_qty[]" value="1" required>
        </td>
        <td class="px-2 py-1 align-middle text-center" style="line-height:.9em">
            <p class="product_name m-0">sasasasa</p>
            <p class="m-0"><small class="product_price">x 123.00</small></p>
        </td>
        <td class="px-2 py-1 align-middle text-center product_total"></td>
        <td class="px-2 py-1 align-middle text-center"><button class="btn btn-outline-danger border-0 btn-sm rounded-0 rem-product p-1" type="button"><i class="fa fa-times"></i></button></td>
    </tr>
</noscript>


    <!-- Here i want to call scriot -->

    @push('scripts')
        <script src="{{ asset('js/calcproduct.js') }}"></script>
    @endpush

    @include('layouts.footer-admin')
@endsection
