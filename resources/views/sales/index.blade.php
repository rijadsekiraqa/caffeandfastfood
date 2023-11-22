@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')
    <div class="content-wrapper" style="min-height: 567.854px;">

        <!-- Main content -->
        <section class="content  text-dark">
            <div class="container-fluid">
                <div class="card card-outline rounded-0 card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Lista e Shitjeve</h3>
                        <div class="card-tools">
                            <a href="{{route('sales.create')}}" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Regjistro Shitje</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="container-fluid">
                            <div class="container-fluid">
                                <table class="table table-hover table-striped table-bordered" data-sort-order="dsc">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="20%">
                                        <col width="20%">
{{--                                        <col width="25%">--}}
                                        <col width="15%">
                                        <col width="5%">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data</th>
                                        <th>Kodi</th>
{{--                                        <th>Klienti</th>--}}
                                        <th>Shuma</th>
                                        <th class="text-center">Vepro</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sales as $sale)
                                    <tr>
                                        <td>{{$sale->id}}</td>
                                        <td>{{$sale->created_at}}</td>
                                        <td>{{$sale->payment_code}}</td>
                                        <td>{{ number_format($sale->amount, 2, '.', '') }}</td>
                                        <td class="text-center">
                                            <a class="" href="{{ route('sales.view-product', ['sale' => $sale->id]) }}" data-id=""><span class="fa fa-eye text-dark"></span> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



    @include('layouts.footer-admin')

@endsection
