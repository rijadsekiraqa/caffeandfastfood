@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')
    <div class="content-wrapper" style="min-height: 567.854px;">

        <!-- Main content -->
        <section class="content  text-dark">
            <div class="container-fluid">
    <div class="content py-3">
        <div class="card card-outline card-navy rounded-0 shadow">
            <div class="card-header">
                <h4 class="card-title">Kodi i Shitjes: <b>{{$sale->payment_code}}</b></h4>
                <div class="card-tools">
                    <a href="/admin-dashboard/sales" class="btn btn-default border btn-sm"><i class="fa fa-angle-left"></i> Kthehu Mrapa</a>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12"  id="printout">
                        <div class="d-flex">
                            <div class="col-auto"><b>Kodi i Shitjes:</b></div>
                            <div class="col-auto ps-1 flex-shrink-1 flex-grow-1 border-bottom border-dark">{{$sale->payment_code}}</div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto"><b>Data e Regjistrimit:</b></div>
                            <div class="col-auto ps-1 flex-shrink-1 flex-grow-1 border-bottom border-dark">{{$sale->created_at}}</div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto"><b>Procesuar nga:</b></div>
                            <div class="col-auto ps-1 flex-shrink-1 flex-grow-1 border-bottom border-dark">
                                {{ optional($sale->user)->firstname ?? 'Ky Perdorues nuk Ekziston' }}
                                {{ optional($sale->user)->lastname ?? '' }}
                            </div>
                        </div>
                        <div class="mb-2"></div>
                        <h4 class="d-flex border-bottom border-dark font-weight-bold" id="sale-title">
                            <div class="col-2 text-center">Sasia</div>
                            <div class="col-7 text-center">Produkti</div>
                            <div class="col-3 text-right">Qmimi</div>
                        </h4>

                        @foreach($sale->salesProducts as $salesProduct)
                        <div class="d-flex border-bottom border-dark">
                            <div class="col-2 text-center mt-1">{{ $salesProduct->qty }}</div>
                            <div class="col-7 text-center" style="line-height:.9em">
                                <p class="mt-2 mb-0">{{ $salesProduct->product->name }}</p>
                                <p class="m-0"><small>x {{ number_format($salesProduct->price, 2, '.', '')}}</small></p>
                            </div>
                            <div class="col-3 text-center mt-1">{{ number_format($salesProduct->qty * $salesProduct->price, 2, '.', ',') }}
                            </div>
                        </div>
                        @endforeach
                        <h3 class="d-flex border-top border-dark font-weight-bold sale-info">
                            <div class="col-4">Totali i Faktures</div>
                            <div class="col-8 text-right">{{ number_format($sale->amount, 2, '.', '') }}</div>
                        </h3>
                        <h5 class="d-flex  border-dark font-weight-bold sale-info">
                            <div class="col-5">Paguar me:</div>
                            <div class="col-7 text-right">{{ number_format($sale->tendered, 2, '.', '')}}</div>
                        </h5>
                        <h5 class="d-flex border-top border-dark font-weight-bold sale-info">
                            <div class="col-4">Kusuri</div>
                            <div class="col-8 text-right">{{ number_format($sale->return, 2, '.', '')}}</div>
                        </h5>

                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <a class="btn btn-primary bg-gradient-primary border col-lg-3 col-md-4 col-sm-12 col-xs-12 rounded-pill" href="{{ route('sales.show', ['sale' => $sale->id]) }}"><i class="fa fa-edit"></i> Ndrysho Fakturen</a>
                    <button class="btn btn-light bg-gradient-light border col-lg-3 col-md-4 col-sm-12 col-xs-12 rounded-pill" id="print"><i class="fa fa-print"></i> Printo</button>
                    <a class="btn btn-danger bg-gradient-danger border col-lg-3 col-md-4 col-sm-12 col-xs-12 rounded-pill" href="{{ route('sales.destroy', ['sale' => $sale->id]) }}" onclick="return confirm('A jeni i sigurt qe deshironi te fshini kete fakture?');"><i class="fa fa-trash"></i> Fshije Fakturen</a>
                </div>
            </div>
        </div>
    </div>
            </div>
        </section>
    </div>
{{--    <script>--}}
{{--        $(function(){--}}
{{--            $('#print').click(function(){--}}
{{--                var head = $('head').clone()--}}
{{--                var p = $($('#printout').html()).clone()--}}
{{--                var phead = $($('noscript#print-header').html()).clone()--}}
{{--                var el = $('<div class="container-fluid">')--}}
{{--                head.find('title').text("Sale Details-Print View")--}}
{{--                el.append(phead)--}}
{{--                el.append(p)--}}
{{--                el.find('.bg-gradient-navy').css({'background':'#001f3f linear-gradient(180deg, #26415c, #001f3f) repeat-x !important','color':'#fff'})--}}
{{--                el.find('.bg-gradient-secondary').css({'background':'#6c757d linear-gradient(180deg, #828a91, #6c757d) repeat-x !important','color':'#fff'})--}}
{{--                el.find('tr.bg-gradient-navy').attr('style',"color:#000")--}}
{{--                el.find('tr.bg-gradient-secondary').attr('style',"color:#000")--}}
{{--                start_loader();--}}
{{--                var nw = window.open("", "_blank", "width=1000, height=900")--}}
{{--                nw.document.querySelector('head').innerHTML = head.prop('outerHTML')--}}
{{--                nw.document.querySelector('body').innerHTML = el.prop('outerHTML')--}}
{{--                nw.document.close()--}}
{{--                setTimeout(()=>{--}}
{{--                    nw.print()--}}
{{--                    setTimeout(()=>{--}}
{{--                        nw.close()--}}
{{--                        end_loader()--}}
{{--                    },300)--}}
{{--                },500)--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
    @push('scripts')
        <script src="{{ asset('js/reportsales-print.js') }}"></script>
    @endpush
    @include('layouts.footer-admin')
@endsection
