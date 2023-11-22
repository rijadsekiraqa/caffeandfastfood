@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')

    <div class="content-wrapper" style="min-height: 567.854px;">

        <!-- Main content -->
        <section class="content  text-dark">
            <div class="container-fluid">
                <div class="card card-outline rounded-0 card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Raporti Ditor i Shitjeve</h3>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <fieldset class="border px-2 mb-2 ,x-2">
                                <legend class="w-auto px-2">Filter</legend>
                                <form id="filter-form" action="{{ route('sales-report') }}" method="get">
                                    @csrf
                                    <div class="row align-items-end">
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="date">Data</label>
                                                <input type="date" name="date" value="{{ $date }}" class="form-control form-control-sm rounded-0" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="user_id">User</label>
                                                <select name="user_id" class="form-control form-control-sm" required>
                                                    <option value="">Selektoni nje Perdorues </option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ $user->id == $userId ? 'selected' : '' }}>
                                                            {{ $user->firstname }} {{ $user->lastname }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary rounded-0 btn-sm"><i class="fa fa-filter"></i> Filtro</button>
                                                <button type="submit" class="btn btn-light border rounded-0 btn-sm" type="button" id="print"><i class="fa fa-print"></i> Printo</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </fieldset>
                            <div class="container-fluid" id="printout">
                                <table class="table table-hover table-striped table-bordered" data-sort-order="dsc" id="report-list">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="25%">
                                        <col width="25%">
{{--                                        <col width="25%">--}}
                                        <col width="25%">
                                        <col width="20%">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data</th>
                                        <th>Kodi i shitjeve</th>
{{--                                        <th>Emri i Klientit</th>--}}
                                        <th>User</th>
                                        <th>Shuma</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sales as $index => $sale)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td><p class="m-0">{{ $sale->created_at }}</p></td>
                                        <td><p class="m-0">{{ $sale->payment_code }}</p></td>
{{--                                        <td><p class="m-0"></p></td>--}}
                                        <td class=''>{{ $sale->user->firstname ?? '' }} {{ $sale->user->lastname ?? '' }}</td>
                                        <td>{{ number_format($sale->amount, 2, '.', '') }}</td>
                                    </tr>
                                    @endforeach
                                    @if($sales->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">Nuk u gjet asnje shitje e regjistuar nga ky perdorues</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-center">Totali</th>
                                        <th class="text-left">{{ number_format( $totalAmount, 2, '.', '') }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
                <noscript id="print-header">
                    <style>
                        html, body{
                            background:unset !important;
                            min-height:unset !important
                        }
                    </style>
                    <div class="d-flex w-100">
                        <div class="col-2 text-center">
                        </div>
                        <div class="col-8 text-center" style="line-height:.9em">
                            <h4 class="text-center m-0"></h4>
                            <h3 class="text-center m-0"><b>Daily Sales Report</b></h3>
                            <h5 class="text-center m-0"><b>as of</b></h5>
                            <h3 class="text-center m-0"><b></b></h3>
                        </div>
                    </div>
                    <hr>
                </noscript>
                <script>
                    $(document).ready(function(){
                        $('#report-list td,#report-list th').addClass('py-1 px-2 align-middle')
                        $('#print').click(function(){
                            var head = $('head').clone()
                            var p = $($('#printout').html()).clone()
                            var phead = $($('noscript#print-header').html()).clone()
                            var el = $('<div class="container-fluid">')
                            head.find('title').text("Daily Sales Report-Print View")
                            el.append(phead)
                            el.append(p)
                            el.find('.bg-gradient-navy').css({'background':'#001f3f linear-gradient(180deg, #26415c, #001f3f) repeat-x !important','color':'#fff'})
                            el.find('.bg-gradient-secondary').css({'background':'#6c757d linear-gradient(180deg, #828a91, #6c757d) repeat-x !important','color':'#fff'})
                            el.find('tr.bg-gradient-navy').attr('style',"color:#000")
                            el.find('tr.bg-gradient-secondary').attr('style',"color:#000")
                            start_loader();
                            var nw = window.open("", "_blank", "width=1000, height=900")
                            nw.document.querySelector('head').innerHTML = head.prop('outerHTML')
                            nw.document.querySelector('body').innerHTML = el.prop('outerHTML')
                            nw.document.close()
                            setTimeout(()=>{
                                nw.print()
                                setTimeout(()=>{
                                    nw.close()
                                    end_loader()
                                },300)
                            },500)
                        })
                    })

                </script>
    @include('layouts.footer-admin')
@endsection
