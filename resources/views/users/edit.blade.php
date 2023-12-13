@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')
    <div class="content-wrapper" style="min-height: 567.854px;">
        <section class="content  text-dark">
            <div class="container-fluid">
        <div class="card card-outline rounded-0 card-navy">
            <div class="card-body">
                <div class="container-fluid">
                    <div id="msg"></div>
                    <form method="post" action="{{ route('users.update',['user' => $user->id]) }}">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="name">Emri</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" value="{{$user->firstname}}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Mbiemri</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" value="{{$user->lastname}}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Emri Perdorues</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{$user->username}}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Fjalekalimi i ri</label>
                            <input type="password" name="password" id="password" class="form-control" value="">
                            <small><i>Lereni te zbrazet nese nuk deshironi te nderroni passwordin</i></small>
                        </div>
                        <div class="form-group">
                            <label for="password">Roli</label>
                            <select class="form-control form-control-sm rounded-0" id="role" name="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @if ($user->roles->contains('name', $role->name)) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary rounded-0 mr-3">Ruaj</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </div>
    </div>
        </section>

        <style>
            img#cimg{
                height: 15vh;
                width: 15vh;
                object-fit: cover;
                border-radius: 100% 100%;
            }
        </style>


    @include('layouts.footer-admin')
@endsection
