@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')

    <div class="content-wrapper" style="min-height: 567.854px;">
        <section class="content text-dark">
            <div class="container-fluid">
                <div class="card card-outline rounded-0 card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Lista e Perdoruesve</h3>
                        <div class="card-tools">
                            <a href="{{ route('users.create') }}" id="create_new" class="btn btn-flat btn-primary">
                                <span class="fas fa-plus"></span> Shto Perdorues
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <table class="table table-hover table-striped table-bordered" data-sort-order="dsc" id="list">
                                <colgroup>
                                    <col width="5%">
                                    <col width="15%">
                                    <col width="15%">
                                    <col width="25%">
                                    <col width="15%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Emri</th>
                                    <th>Email</th>
                                    <th>Roli</th>
                                    <th>Vepro</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                {{ $role->name }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('users.show', ['user' => $user->id]) }}">
                                                <span class="fa fa-edit text-primary"></span>
                                            </a>&nbsp;&nbsp;
                                            <a href="{{ route('users.destroy', ['user' => $user->id]) }}"
                                               onclick="return confirm('A jeni i sigurt qe deshironi te fshini kete perdorues?');">
                                                <span class="fa fa-trash text-danger"></span>
                                            </a>
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

    @include('layouts.footer-admin')


@endsection
