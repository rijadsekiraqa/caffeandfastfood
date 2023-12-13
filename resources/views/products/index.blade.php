@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')
    <div class="content-wrapper" style="min-height: 567.854px;">

        <!-- Main content -->
        <section class="content  text-dark">
            <div class="container-fluid">
                <div class="card card-outline rounded-0 card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Lista e Produkteve</h3>
                        <div class="card-tools">
                            @include('products.create')
                            <a href="#create-product" data-toggle="modal" class="btn btn-flat btn-primary"><span
                                    class="fas fa-plus"></span> Krijo Produkt</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="container-fluid">
                            <table class="table table-hover table-striped table-bordered" data-sort-order="asc" id="list">
                                <colgroup>
                                    <col width="5%">
                                    <col width="15%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="15%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Emri</th>
                                    <th>Kategoria</th>
                                    <th>Qmimi</th>
                                    <th>Vepro</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{ number_format($product->price, 2, '.', '') }}</td>
                                    <td>
                                            @include('products.view')
                                            <a href="#view-product-{{$product->id}}" data-toggle="modal"><span class="fa fa-eye text-dark"></span> </a>&nbsp;&nbsp;
                                            @include('products.edit')
                                            <a href="#edit-product-{{$product->id}}" data-toggle="modal"><span class="fa fa-edit text-primary"></span> </a>&nbsp;&nbsp;
                                            <a href="{{ route('products.destroy', ['product' => $product->id]) }}" onclick="return confirm('A jeni i sigurt qe deshironi te fshini kete produkt');"><span class="fa fa-trash text-danger"></span> </a>

                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>




    @push('scripts')
        <script src="{{ asset('js/decimal-places-product.js') }}"></script>
    @endpush

    @include('layouts.footer-admin')
@endsection
