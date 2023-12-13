@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')
    <div class="content-wrapper" style="min-height: 567.854px;">

        <!-- Main content -->
        <section class="content text-dark">
            <div class="container-fluid">

    <div class="card card-outline rounded-0 card-navy">
        <div class="card-body">
            <div class="container-fluid">
                <div id="msg"></div>
                <form action="{{ route('adminprofile.update', ['id' => $user->id]) }}" method="post" id="manage-user">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name">Emri</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $user->firstname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Mbiemri</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $user->lastname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Emri i Perdoruesit</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="">
                        <small><i>Lereni te zbrazet nese nuk deshironi te nderroni passwordin</i></small>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12">
                            <div class="row">
                                <button type="submit" class="btn btn-sm btn-primary" form="manage-user">Perditeso</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
            </div>
        </section>
    </div>
    @include('layouts.footer-admin')
@endsection
