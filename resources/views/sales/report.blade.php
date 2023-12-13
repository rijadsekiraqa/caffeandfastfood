@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')

    <div class="content-wrapper" style="min-height: 567.854px;">

        <!-- Main content -->
        <section class="content  text-dark">
            <div class="container-fluid">
                <div class="card card-outline rounded-0 card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Raporti i Shitjeve</h3>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <fieldset class="border px-2 mb-2 ,x-2">
                                <legend class="w-auto px-2">Filtro Shitjet</legend>
                                <form id="filter-form" method="get" onsubmit="submitForm(event)">
                                    @csrf
                                    @method("GET")
                                    <div class="row align-items-end justify-content-center">
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="date">Nga Data</label>
                                                <input type="date" name="from_date" value="{{ $fromDate }}"
                                                       class="form-control form-control-sm rounded-0" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="date">Deri ne Daten</label>
                                                <input type="date" name="to_date" value="{{ $toDate }}"
                                                       class="form-control form-control-sm rounded-0" required>
                                            </div>
                                        </div>
                                        @role('admin')
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="user_id">Perdoruesit</label>
                                                <select name="user_id" class="form-control form-control-sm" required>
                                                    <option value="">Zgjidhni nje Perdorues</option>
                                                    <option value="all" {{ $userId === 'all' ? 'selected' : '' }}>Te
                                                        Gjithe Perdoruesit
                                                    </option> <!-- New option for All users -->
                                                    <!-- New option for All users -->
                                                    @foreach($users as $user)
                                                        <option
                                                            value="{{ $user->id }}" {{ $user->id == $userId ? 'selected' : '' }}>
                                                            {{ $user->firstname }} {{ $user->lastname }} -
                                                            @foreach($user->roles as $role)
                                                                {{ ucfirst($role->name) }}
                                                            @endforeach
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        @endrole
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary rounded-0 btn-sm"><i
                                                        class="fa fa-filter"></i> Filtro
                                                </button>
                                                <button type="submit" class="btn btn-light border rounded-0 btn-sm"
                                                        type="button" id="print"><i class="fa fa-print"></i> Printo
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </fieldset>
                            <div class="container-fluid" id="printout">
                                <table class="table table-hover table-striped table-bordered" data-sort-order="dsc"
                                       id="report-list" style="display: none;">
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
                                        <th>Perdoruesi</th>
                                        <th>Totali i Faktures</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sales as $index => $sale)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td><p class="m-0">{{ $sale->created_at }}</p></td>
                                            <td><p class="m-0">{{ $sale->payment_code }}</p></td>
                                            <td class=''>{{ $sale->user->firstname ?? '' }} {{ $sale->user->lastname ?? '' }}</td>
                                            <td>{{ number_format($sale->amount, 2, '.', '') }}</td>
                                        </tr>
                                    @endforeach
                                    @if($sales->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">Nuk u gjet asnje shitje e regjistuar nga
                                                ky perdorues ne kete periudhe kohore
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-center">Gjate kesaj periudhe kohore ky perdorues ka
                                            regjistruar shitje ne total
                                        </th>
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
            html, body {
                background: unset !important;
                min-height: unset !important
            }
        </style>
        <div class="d-flex w-100">
            <div class="col-2 text-center">
            </div>
            <div class="col-8 text-center" style="line-height:.9em">
                <h4 class="text-center m-0"></h4>
                <h3 class="text-center m-0"><b>Raporti i Shitjeve </b></h3>
                <h3 class="text-center m-0"><b></b></h3>
            </div>
        </div>
        <hr>
    </noscript>



    @push('scripts')
        <script src="{{ asset('js/salesdate-compare.js') }}"></script>
        <script src="{{ asset('js/reportsales-print.js') }}"></script>
        <script>
            function submitForm(event) {
                event.preventDefault();

                var formData = $('#filter-form').serialize();

                $.ajax({
                    url: "{{ route('sales-report') }}",
                    type: 'get',
                    data: formData,
                    success: function (data) {
                        // Extract the relevant data from the response
                        var salesData = $(data).find('#report-list tbody').html();
                        var totalAmount = $(data).find('#report-list tfoot th.text-left').text();

                        // Update the existing table with the new data
                        $('#report-list tbody').html(salesData);
                        $('#report-list tfoot th.text-left').text(totalAmount);

                        // Show the table (remove display: none)
                        $('#report-list').show();
                    },
                    error: function (error) {
                        console.log('Error:', error);
                    }
                });
            }
        </script>
    @endpush
    @include('layouts.footer-admin')
@endsection
