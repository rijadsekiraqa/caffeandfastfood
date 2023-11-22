@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')

    <div class="content-wrapper" style="min-height: 567.854px;">

        <!-- Main content -->
        <section class="content  text-dark">
            <div class="container-fluid">
                <div class="card card-outline rounded-0 card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Lista e Kategorive</h3>
                        <div class="card-tools">
                            @include('categories.create')
                            <a href="#create-category" data-toggle="modal"  class="btn btn-flat btn-primary">
                                <span class="fas fa-plus"></span> Regjistro Kategori
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="container-fluid pr-0 pl-0">
                            <table class="table table-hover table-striped table-bordered" id="list">
                                <colgroup>
                                    <col width="5%">
                                    <col width="15%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Emri</th>
                                    <th>Vepro</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)

                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            @include('categories.edit')
                                            <a href="#edit-category-{{ $category->id }}" data-toggle="modal"><span class="fa fa-edit text-primary"></span> </a>&nbsp;&nbsp;
                                            <a href="{{ route('categories.destroy', ['category' => $category->id]) }}" onclick="return confirm('A jeni i sigurt qe deshironi te fshini kete kategori?');"><span class="fa fa-trash text-danger"></span> </a>

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
